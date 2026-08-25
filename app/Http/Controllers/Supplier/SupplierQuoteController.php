<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierQuoteController extends Controller
{
    public function index(Request $request)
    {
        $supplier = Auth::user()->getOrCreateSupplier();
        $query = $supplier->quotes()->with(['requirement.category', 'buyer.user']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $quotes = $query->latest()->paginate(10)->withQueryString();

        return view('supplier.quotes.index', compact('quotes', 'supplier'));
    }
}
