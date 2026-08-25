<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Requirement;
use App\Models\Location;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Categories with product counts
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->orderBy('sort_order')
            ->take(12)
            ->get();

        // 2. Trending / Featured Products
        $trendingProducts = Product::where('is_active', true)
            ->with(['supplier', 'category'])
            ->orderByDesc('is_featured')
            ->orderByDesc('views_count')
            ->take(8)
            ->get();

        // 3. Featured & Verified Suppliers
        $featuredSuppliers = Supplier::where('status', 'active')
            ->where('is_verified', true)
            ->with(['subscriptionPlan', 'products' => function ($q) {
                $q->where('is_active', true)->take(3);
            }])
            ->withCount('products')
            ->orderByDesc('is_featured')
            ->orderByDesc('rating_avg')
            ->take(6)
            ->get();

        // 4. Latest Buy Requirements (Live RFQs)
        $latestRequirements = Requirement::where('status', 'open')
            ->with(['buyer', 'category'])
            ->latest()
            ->take(6)
            ->get();

        // 5. City Hubs (UP Industrial Hubs & Major Metros)
        $upCities = Location::where('state', 'Uttar Pradesh')
            ->orderBy('city')
            ->get();

        $metroCities = Location::where('state', '!=', 'Uttar Pradesh')
            ->where('is_popular', true)
            ->orderBy('city')
            ->get();

        $popularCities = Location::where('is_popular', true)
            ->orderBy('city')
            ->get();

        // 6. Hero Banner Ads
        $heroBanners = Advertisement::where('is_active', true)
            ->where('placement', 'hero_slider')
            ->take(3)
            ->get();

        // 7. Platform Statistics
        $stats = [
            'suppliers_count' => Supplier::where('status', 'active')->count() + 15000,
            'products_count' => Product::where('is_active', true)->count() + 85000,
            'rfq_count' => Requirement::count() + 45000,
            'cities_count' => Location::count() + 120,
        ];

        return view('home', compact(
            'categories',
            'trendingProducts',
            'featuredSuppliers',
            'latestRequirements',
            'popularCities',
            'upCities',
            'metroCities',
            'heroBanners',
            'stats'
        ));
    }
}
