<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerInquiryController extends Controller
{
    public function index()
    {
        $buyer = Auth::user()->buyer;
        $inquiries = $buyer ? $buyer->inquiries()->with(['product', 'supplier.user'])->latest()->paginate(10) : collect();

        return view('buyer.inquiries.index', compact('inquiries'));
    }

    public function show($id)
    {
        $buyer = Auth::user()->buyer;
        $inquiry = Inquiry::where('id', $id)->where('buyer_id', $buyer->id)->with(['product', 'supplier.user'])->firstOrFail();

        return view('buyer.inquiries.show', compact('inquiry'));
    }
}
