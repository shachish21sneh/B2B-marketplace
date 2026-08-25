<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerMessageController extends Controller
{
    public function index(Request $request)
    {
        $currentUserId = Auth::id();

        // Get all unique users with whom current user has exchanged messages
        $contactIds = Message::where('sender_id', $currentUserId)
            ->pluck('receiver_id')
            ->merge(
                Message::where('receiver_id', $currentUserId)->pluck('sender_id')
            )
            ->unique();

        // If target user query parameter is provided and not in contacts, include them
        if ($request->filled('user')) {
            $targetId = (int) $request->user;
            if (!$contactIds->contains($targetId) && $targetId !== $currentUserId) {
                $contactIds->push($targetId);
            }
        }

        $contacts = User::whereIn('id', $contactIds)
            ->with(['supplier', 'buyer'])
            ->get()
            ->map(function ($contact) use ($currentUserId) {
                $lastMessage = Message::where(function ($q) use ($currentUserId, $contact) {
                    $q->where('sender_id', $currentUserId)->where('receiver_id', $contact->id);
                })->orWhere(function ($q) use ($currentUserId, $contact) {
                    $q->where('sender_id', $contact->id)->where('receiver_id', $currentUserId);
                })->latest()->first();

                $unreadCount = Message::where('sender_id', $contact->id)
                    ->where('receiver_id', $currentUserId)
                    ->where('is_read', false)
                    ->count();

                $contact->last_message = $lastMessage;
                $contact->unread_count = $unreadCount;
                return $contact;
            })
            ->sortByDesc(function ($c) {
                return $c->last_message ? $c->last_message->created_at : now()->subYears(1);
            });

        $activeContactId = $request->filled('user') ? (int) $request->user : ($contacts->first()?->id ?? null);
        $activeContact = $activeContactId ? User::with(['supplier', 'buyer'])->find($activeContactId) : null;

        $messages = collect();
        if ($activeContact) {
            // Mark received messages from this contact as read
            Message::where('sender_id', $activeContact->id)
                ->where('receiver_id', $currentUserId)
                ->where('is_read', false)
                ->update(['is_read' => true, 'read_at' => now()]);

            $messages = Message::where(function ($q) use ($currentUserId, $activeContact) {
                $q->where('sender_id', $currentUserId)->where('receiver_id', $activeContact->id);
            })->orWhere(function ($q) use ($currentUserId, $activeContact) {
                $q->where('sender_id', $activeContact->id)->where('receiver_id', $currentUserId);
            })->orderBy('created_at', 'asc')->get();
        }

        return view('buyer.messages.index', compact('contacts', 'activeContact', 'messages'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:5000',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'is_read' => false,
        ]);

        // Send alert notification to receiver
        Notification::create([
            'user_id' => $request->receiver_id,
            'type' => 'message',
            'title' => 'New Message from ' . Auth::user()->name,
            'message' => Str::limit($request->message, 80),
            'link' => Auth::user()->isSupplier() ? '/buyer/messages?user=' . Auth::id() : '/supplier/messages?user=' . Auth::id(),
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'html' => view('components.message_bubble', ['msg' => $message, 'currentUserId' => Auth::id()])->render(),
            ]);
        }

        return redirect()->route('buyer.messages', ['user' => $request->receiver_id]);
    }

    public function poll(Request $request)
    {
        $currentUserId = Auth::id();
        $contactId = (int) $request->get('contact_id');
        $lastId = (int) $request->get('last_message_id', 0);

        $newMessages = Message::where('sender_id', $contactId)
            ->where('receiver_id', $currentUserId)
            ->where('id', '>', $lastId)
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark as read
        if ($newMessages->isNotEmpty()) {
            Message::whereIn('id', $newMessages->pluck('id'))->update(['is_read' => true, 'read_at' => now()]);
        }

        $html = '';
        foreach ($newMessages as $msg) {
            $html .= view('components.message_bubble', ['msg' => $msg, 'currentUserId' => $currentUserId])->render();
        }

        return response()->json([
            'count' => $newMessages->count(),
            'html' => $html,
            'last_id' => $newMessages->last()?->id ?? $lastId,
        ]);
    }
}
