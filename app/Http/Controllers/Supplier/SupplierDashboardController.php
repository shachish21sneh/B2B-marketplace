<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Inquiry;
use App\Models\Quote;
use App\Models\Requirement;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $supplier = $user->supplier;

        if (!$supplier) {
            return redirect()->route('supplier.register');
        }

        $totalInquiries = $supplier->inquiries()->count();
        $quotesSent = $supplier->quotes()->count();
        $acceptedQuotes = $supplier->quotes()->where('status', 'accepted')->count();
        $conversionRate = $quotesSent > 0 ? round(($acceptedQuotes / $quotesSent) * 100, 1) : 0;

        $stats = [
            'product_views' => $supplier->products()->sum('views_count'),
            'profile_views' => $supplier->views_count,
            'total_inquiries' => $totalInquiries,
            'new_leads' => $supplier->inquiries()->where('status', 'new')->count(),
            'quotes_sent' => $quotesSent,
            'conversion_rate' => $conversionRate . '%',
            'active_products' => $supplier->products()->where('is_active', true)->count(),
            'rating_avg' => $supplier->rating_avg,
            'reviews_count' => $supplier->reviews_count,
        ];

        // Recent inquiries
        $recentInquiries = $supplier->inquiries()->with(['product', 'buyer.user'])->latest()->take(5)->get();

        // Matching Buy Requirements (RFQ Leads)
        $supplierCategoryIds = $supplier->products()->pluck('category_id')->unique();
        $matchingRequirements = Requirement::where('status', 'open')
            ->where(function ($q) use ($supplierCategoryIds, $supplier) {
                if ($supplierCategoryIds->isNotEmpty()) {
                    $q->whereIn('category_id', $supplierCategoryIds)
                      ->orWhere('delivery_location', 'like', "%{$supplier->city}%");
                }
            })
            ->with(['buyer', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // Recent quotes
        $recentQuotes = $supplier->quotes()->with(['requirement', 'buyer'])->latest()->take(5)->get();

        return view('supplier.dashboard', compact(
            'supplier',
            'stats',
            'recentInquiries',
            'matchingRequirements',
            'recentQuotes'
        ));
    }
}
