<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use App\Models\Category;
use App\Models\Quote;
use App\Models\Notification;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierRequirementController extends Controller
{
    public function index(Request $request)
    {
        $supplier = Auth::user()->getOrCreateSupplier();
        $query = Requirement::where('status', 'open')->with(['buyer.user', 'category', 'quotes']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('city')) {
            $query->where('delivery_location', 'like', "%{$request->city}%");
        }

        if ($request->filled('q')) {
            $term = trim($request->q);
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")->orWhere('description', 'like', "%{$term}%");
            });
        }

        $requirements = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::where('is_active', true)->get();

        return view('supplier.requirements.index', compact('requirements', 'categories', 'supplier'));
    }

    public function show($id)
    {
        $supplier = Auth::user()->getOrCreateSupplier();
        $requirement = Requirement::where('id', $id)->with(['buyer.user', 'category', 'quotes'])->firstOrFail();
        $existingQuote = Quote::where('requirement_id', $id)->where('supplier_id', $supplier->id)->first();

        return view('supplier.requirements.show', compact('requirement', 'existingQuote', 'supplier'));
    }

    public function submitQuote(Request $request, $id)
    {
        $supplier = Auth::user()->getOrCreateSupplier();
        $requirement = Requirement::where('id', $id)->where('status', 'open')->firstOrFail();

        $request->validate([
            'unit_price' => 'required|numeric|min:0.01',
            'quantity' => 'required|integer|min:1',
            'moq' => 'required|integer|min:1',
            'delivery_time_days' => 'required|integer|min:1|max:365',
            'shipping_charges' => 'nullable|numeric|min:0',
            'payment_terms' => 'required|string|max:255',
            'validity_date' => 'nullable|date|after_or_equal:today',
            'notes' => 'nullable|string|max:2000',
        ]);

        $quote = Quote::updateOrCreate([
            'requirement_id' => $requirement->id,
            'supplier_id' => $supplier->id,
        ], [
            'buyer_id' => $requirement->buyer_id,
            'unit_price' => $request->unit_price,
            'quantity' => $request->quantity,
            'moq' => $request->moq,
            'delivery_time_days' => $request->delivery_time_days,
            'shipping_charges' => $request->shipping_charges ?: 0.00,
            'payment_terms' => $request->payment_terms,
            'validity_date' => $request->validity_date ?: now()->addDays(15),
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        // Send Notification to Buyer
        Notification::create([
            'user_id' => $requirement->buyer->user_id,
            'type' => 'quote',
            'title' => "New Quotation Received from {$supplier->company_name}",
            'message' => "{$supplier->company_name} submitted a quotation of ₹" . number_format($quote->unit_price, 2) . "/{$requirement->quantity_unit} for \"{$requirement->title}\".",
            'link' => '/buyer/quotes',
        ]);

        return redirect()->route('supplier.quotes')->with('success', 'Your quotation has been delivered directly to the buyer!');
    }
}
