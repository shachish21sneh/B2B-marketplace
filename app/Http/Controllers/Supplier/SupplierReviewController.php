<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierReviewController extends Controller
{
    public function index()
    {
        $supplier = Auth::user()->supplier;
        $reviews = $supplier->allReviews()->with(['buyer.user', 'product'])->paginate(10);

        return view('supplier.reviews.index', compact('reviews', 'supplier'));
    }

    public function reply(Request $request, $id)
    {
        $supplier = Auth::user()->supplier;
        $review = Review::where('id', $id)->where('supplier_id', $supplier->id)->firstOrFail();

        $request->validate([
            'supplier_reply' => 'required|string|min:5|max:1000',
        ]);

        $review->update([
            'supplier_reply' => $request->supplier_reply,
        ]);

        return back()->with('success', 'Your reply to the buyer review has been posted.');
    }
}
