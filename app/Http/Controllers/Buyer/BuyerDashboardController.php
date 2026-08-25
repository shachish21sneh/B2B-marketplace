<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use App\Models\Quote;
use App\Models\Inquiry;
use App\Models\Favorite;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $buyer = $user->buyer;

        if (!$buyer) {
            $buyer = \App\Models\Buyer::create([
                'user_id' => $user->id,
                'company_name' => $user->name,
            ]);
        }

        $stats = [
            'requirements_count' => $buyer->requirements()->count(),
            'quotes_received' => Quote::where('buyer_id', $buyer->id)->count(),
            'active_inquiries' => $buyer->inquiries()->count(),
            'saved_suppliers' => Favorite::where('user_id', $user->id)->whereNotNull('supplier_id')->count(),
            'saved_products' => Favorite::where('user_id', $user->id)->whereNotNull('product_id')->count(),
        ];

        $recentRequirements = $buyer->requirements()->with('category')->withCount('quotes')->latest()->take(5)->get();
        $recentQuotes = Quote::where('buyer_id', $buyer->id)->with(['requirement', 'supplier'])->latest()->take(5)->get();
        $recentInquiries = $buyer->inquiries()->with(['product', 'supplier'])->latest()->take(5)->get();
        $notifications = $user->notifications()->take(5)->get();

        return view('buyer.dashboard', compact('stats', 'recentRequirements', 'recentQuotes', 'recentInquiries', 'notifications', 'buyer'));
    }
}
