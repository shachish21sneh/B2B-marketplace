<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Notification;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierInquiryController extends Controller
{
    public function index(Request $request)
    {
        $supplier = Auth::user()->getOrCreateSupplier();
        $query = $supplier->inquiries()->with(['product', 'buyer.user']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $inquiries = $query->latest()->paginate(10)->withQueryString();

        return view('supplier.inquiries.index', compact('inquiries', 'supplier'));
    }

    public function show($id)
    {
        $supplier = Auth::user()->getOrCreateSupplier();
        $inquiry = Inquiry::where('id', $id)->where('supplier_id', $supplier->id)->with(['product', 'buyer.user'])->firstOrFail();

        if ($inquiry->status === 'new') {
            $inquiry->update(['status' => 'read']);
        }

        return view('supplier.inquiries.show', compact('inquiry', 'supplier'));
    }

    public function reply(Request $request, $id)
    {
        $supplier = Auth::user()->getOrCreateSupplier();
        $inquiry = Inquiry::where('id', $id)->where('supplier_id', $supplier->id)->firstOrFail();

        $request->validate([
            'reply' => 'required|string|min:5|max:3000',
            'action' => 'required|in:accepted,rejected,reply_only',
        ]);

        $status = $request->action === 'rejected' ? 'rejected' : 'accepted';

        $inquiry->update([
            'supplier_reply' => $request->reply,
            'status' => $status,
        ]);

        // Send message in chat thread if buyer has account
        if ($inquiry->buyer && $inquiry->buyer->user) {
            Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $inquiry->buyer->user_id,
                'inquiry_id' => $inquiry->id,
                'message' => "Response to your inquiry: " . $request->reply,
            ]);

            Notification::create([
                'user_id' => $inquiry->buyer->user_id,
                'type' => 'inquiry_reply',
                'title' => "Supplier Response from {$supplier->company_name}",
                'message' => "{$supplier->company_name} replied to your inquiry: \"" . \Illuminate\Support\Str::limit($request->reply, 80) . "\"",
                'link' => '/buyer/inquiries',
            ]);
        }

        return redirect()->route('supplier.inquiries')->with('success', 'Your reply has been sent to the buyer successfully.');
    }
}
