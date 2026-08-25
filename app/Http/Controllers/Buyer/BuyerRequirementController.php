<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use App\Models\Quote;
use App\Models\Notification;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerRequirementController extends Controller
{
    public function index()
    {
        $buyer = Auth::user()->buyer;
        $requirements = $buyer ? $buyer->requirements()->with('category')->withCount('quotes')->latest()->paginate(10) : collect();

        return view('buyer.requirements.index', compact('requirements'));
    }

    public function show($id)
    {
        $buyer = Auth::user()->buyer;
        $requirement = Requirement::where('id', $id)
            ->where('buyer_id', $buyer->id)
            ->with(['category', 'quotes.supplier.subscriptionPlan'])
            ->firstOrFail();

        return view('buyer.requirements.show', compact('requirement'));
    }

    public function compareQuotes($id)
    {
        $buyer = Auth::user()->buyer;
        $requirement = Requirement::where('id', $id)
            ->where('buyer_id', $buyer->id)
            ->with(['category', 'quotes.supplier.subscriptionPlan'])
            ->firstOrFail();

        $quotes = $requirement->quotes()->with('supplier')->get();

        return view('buyer.requirements.compare', compact('requirement', 'quotes'));
    }

    public function acceptQuote($quoteId)
    {
        $buyer = Auth::user()->buyer;
        $quote = Quote::where('id', $quoteId)->where('buyer_id', $buyer->id)->firstOrFail();

        $quote->update(['status' => 'accepted']);
        $quote->requirement->update(['status' => 'quoted']);

        // Notify Supplier
        Notification::create([
            'user_id' => $quote->supplier->user_id,
            'type' => 'quote_accepted',
            'title' => 'Quotation Accepted by Buyer!',
            'message' => "{$buyer->company_name} has accepted your quotation for \"{$quote->requirement->title}\".",
            'link' => '/supplier/quotes',
        ]);

        // Start chat message
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $quote->supplier->user_id,
            'quote_id' => $quote->id,
            'message' => "Hello, I have accepted your quote of ₹" . number_format($quote->unit_price, 2) . "/{$quote->requirement->quantity_unit} for \"{$quote->requirement->title}\". Let's finalize the order and delivery logistics.",
        ]);

        return redirect()->route('buyer.messages', ['user' => $quote->supplier->user_id])
            ->with('success', 'Quotation accepted! A direct chat with the supplier has been initiated.');
    }

    public function rejectQuote(Request $request, $quoteId)
    {
        $buyer = Auth::user()->buyer;
        $quote = Quote::where('id', $quoteId)->where('buyer_id', $buyer->id)->firstOrFail();

        $quote->update(['status' => 'rejected']);

        Notification::create([
            'user_id' => $quote->supplier->user_id,
            'type' => 'quote_rejected',
            'title' => 'Quotation Status Update',
            'message' => "Your quotation for \"{$quote->requirement->title}\" was declined by the buyer.",
            'link' => '/supplier/quotes',
        ]);

        return back()->with('info', 'Quotation has been marked as rejected.');
    }

    public function closeRequirement($id)
    {
        $buyer = Auth::user()->buyer;
        $requirement = Requirement::where('id', $id)->where('buyer_id', $buyer->id)->firstOrFail();

        $requirement->update(['status' => 'closed']);

        return back()->with('success', 'Requirement closed successfully.');
    }
}
