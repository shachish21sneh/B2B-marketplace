<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Category;
use App\Models\Location;
use App\Models\Review;
use App\Models\Inquiry;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::where('status', 'active')->with(['subscriptionPlan', 'products']);

        if ($request->filled('q')) {
            $term = trim($request->q);
            $query->where(function ($q) use ($term) {
                $q->where('company_name', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%")
                  ->orWhere('city', 'like', "%{$term}%")
                  ->orWhereHas('products', function ($pq) use ($term) {
                      $pq->where('name', 'like', "%{$term}%");
                  });
            });
        }

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }

        if ($request->filled('business_type')) {
            $types = (array) $request->business_type;
            $query->whereIn('business_type', $types);
        }

        if ($request->boolean('verified_only')) {
            $query->where('is_verified', true);
        }

        if ($request->filled('category')) {
            $catSlug = $request->category;
            $query->whereHas('products.category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        $suppliers = $query->orderByDesc('is_featured')
            ->orderByDesc('rating_avg')
            ->paginate(10)
            ->withQueryString();

        $categories = Category::where('is_active', true)->get();
        $cities = Location::where('is_popular', true)->get();

        return view('suppliers.index', compact('suppliers', 'categories', 'cities'));
    }

    public function show(Request $request, $slug)
    {
        $supplier = Supplier::where('slug', $slug)
            ->where('status', 'active')
            ->with([
                'subscriptionPlan',
                'products' => function ($q) {
                    $q->where('is_active', true)->with('category');
                },
                'services' => function ($q) {
                    $q->where('is_active', true);
                },
                'reviews' => function ($q) {
                    $q->where('status', 'approved')->with('buyer.user')->latest();
                },
                'documents' => function ($q) {
                    $q->where('status', 'approved');
                }
            ])
            ->firstOrFail();

        $supplier->increment('views_count');

        // Rating distribution calculation
        $allReviews = $supplier->reviews;
        $totalReviews = $allReviews->count();
        $ratingDistribution = [
            5 => $allReviews->where('overall_rating', '>=', 4.5)->count(),
            4 => $allReviews->whereBetween('overall_rating', [3.5, 4.49])->count(),
            3 => $allReviews->whereBetween('overall_rating', [2.5, 3.49])->count(),
            2 => $allReviews->whereBetween('overall_rating', [1.5, 2.49])->count(),
            1 => $allReviews->where('overall_rating', '<', 1.5)->count(),
        ];

        $activeTab = $request->get('tab', 'overview');

        return view('suppliers.show', compact('supplier', 'ratingDistribution', 'totalReviews', 'activeTab'));
    }

    public function byCity(Request $request, $city)
    {
        $location = Location::where('city', $city)->first();
        $suppliers = Supplier::where('status', 'active')
            ->where('city', $city)
            ->with(['subscriptionPlan', 'products' => function ($q) {
                $q->where('is_active', true)->take(3);
            }])
            ->orderByDesc('rating_avg')
            ->paginate(12);

        $categories = Category::where('is_active', true)->get();

        return view('suppliers.by_city', compact('suppliers', 'city', 'location', 'categories'));
    }

    public function storeReview(Request $request, $slug)
    {
        $request->validate([
            'quality_rating' => 'required|integer|min:1|max:5',
            'communication_rating' => 'required|integer|min:1|max:5',
            'delivery_rating' => 'required|integer|min:1|max:5',
            'pricing_rating' => 'required|integer|min:1|max:5',
            'service_rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:200',
            'comment' => 'required|string|min:10|max:2000',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to write a supplier review.');
        }

        $supplier = Supplier::where('slug', $slug)->firstOrFail();
        $buyer = Auth::user()->buyer;

        if (!$buyer) {
            return back()->with('error', 'Only registered buyers can post supplier reviews.');
        }

        $overall = round((
            $request->quality_rating +
            $request->communication_rating +
            $request->delivery_rating +
            $request->pricing_rating +
            $request->service_rating
        ) / 5, 2);

        Review::create([
            'supplier_id' => $supplier->id,
            'buyer_id' => $buyer->id,
            'quality_rating' => $request->quality_rating,
            'communication_rating' => $request->communication_rating,
            'delivery_rating' => $request->delivery_rating,
            'pricing_rating' => $request->pricing_rating,
            'service_rating' => $request->service_rating,
            'overall_rating' => $overall,
            'title' => $request->title,
            'comment' => $request->comment,
            'status' => 'approved',
        ]);

        $supplier->recalculateRating();

        // Notify supplier
        Notification::create([
            'user_id' => $supplier->user_id,
            'type' => 'review',
            'title' => 'New Customer Review Received',
            'message' => "You received a {$overall}★ review from {$buyer->company_name}.",
            'link' => "/suppliers/{$supplier->slug}?tab=reviews",
        ]);

        return back()->with('success', 'Thank you! Your review has been published successfully.');
    }
}
