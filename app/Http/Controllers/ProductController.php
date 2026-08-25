<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Supplier;
use App\Models\Location;
use App\Models\SearchHistory;
use App\Models\RecentlyViewed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request, $categorySlug = null, $subcategorySlug = null)
    {
        $query = Product::where('is_active', true)->with(['supplier.subscriptionPlan', 'category', 'subcategory']);

        // Category / Subcategory route or query filter
        $currentCategory = null;
        $currentSubcategory = null;

        if ($categorySlug) {
            $currentCategory = Category::where('slug', $categorySlug)->firstOrFail();
            $query->where('category_id', $currentCategory->id);
        } elseif ($request->filled('category')) {
            $currentCategory = Category::where('slug', $request->category)->orWhere('id', $request->category)->first();
            if ($currentCategory) {
                $query->where('category_id', $currentCategory->id);
            }
        }

        if ($subcategorySlug) {
            $currentSubcategory = Subcategory::where('slug', $subcategorySlug)->firstOrFail();
            $query->where('subcategory_id', $currentSubcategory->id);
        } elseif ($request->filled('subcategory')) {
            $currentSubcategory = Subcategory::where('slug', $request->subcategory)->orWhere('id', $request->subcategory)->first();
            if ($currentSubcategory) {
                $query->where('subcategory_id', $currentSubcategory->id);
            }
        }

        // Keyword Search
        if ($request->filled('q')) {
            $searchTerm = trim($request->q);
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('brand', 'like', "%{$searchTerm}%")
                  ->orWhere('sku', 'like', "%{$searchTerm}%")
                  ->orWhereHas('supplier', function ($sq) use ($searchTerm) {
                      $sq->where('company_name', 'like', "%{$searchTerm}%")
                         ->orWhere('city', 'like', "%{$searchTerm}%");
                  });
            });

            // Log search history
            SearchHistory::create([
                'user_id' => Auth::id(),
                'query' => $searchTerm,
                'results_count' => 0,
                'ip_address' => $request->ip(),
            ]);
        }

        // Location Filter (City / State / Pincode)
        if ($request->filled('city')) {
            $query->whereHas('supplier', function ($q) use ($request) {
                $q->where('city', $request->city);
            });
        }
        if ($request->filled('state')) {
            $query->whereHas('supplier', function ($q) use ($request) {
                $q->where('state', $request->state);
            });
        }
        if ($request->filled('pincode')) {
            $query->whereHas('supplier', function ($q) use ($request) {
                $q->where('pincode', $request->pincode);
            });
        }

        // Supplier Type Filter (Manufacturer, Wholesaler, Distributor, etc.)
        if ($request->filled('supplier_type')) {
            $types = (array) $request->supplier_type;
            $query->whereHas('supplier', function ($q) use ($types) {
                $q->whereIn('business_type', $types);
            });
        }

        // Verified Suppliers Only
        if ($request->boolean('verified_only')) {
            $query->whereHas('supplier', function ($q) {
                $q->where('is_verified', true);
            });
        }

        // Rating Filter (e.g. 4+ stars)
        if ($request->filled('min_rating')) {
            $minRating = (float) $request->min_rating;
            $query->whereHas('supplier', function ($q) use ($minRating) {
                $q->where('rating_avg', '>=', $minRating);
            });
        }

        // Price Filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->max_price);
        }

        // MOQ Filter
        if ($request->filled('max_moq')) {
            $query->where('moq', '<=', (int) $request->max_moq);
        }

        // Sorting
        $sortBy = $request->get('sort', 'relevance');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'rating':
                $query->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
                      ->orderByDesc('suppliers.rating_avg')
                      ->select('products.*');
                break;
            case 'relevance':
            default:
                $query->orderByDesc('is_sponsored')
                      ->orderByDesc('is_featured')
                      ->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        // Data for sidebar filters
        $categories = Category::where('is_active', true)->withCount('products')->get();
        $subcategories = $currentCategory ? $currentCategory->subcategories()->withCount('products')->get() : collect();
        $cities = Location::where('is_popular', true)->get();

        $viewMode = $request->get('view', 'grid'); // 'grid' or 'list'

        return view('products.index', compact(
            'products',
            'categories',
            'subcategories',
            'currentCategory',
            'currentSubcategory',
            'cities',
            'viewMode',
            'sortBy'
        ));
    }

    public function show(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['supplier.subscriptionPlan', 'supplier.reviews', 'category', 'subcategory', 'images'])
            ->firstOrFail();

        // Increment view count
        $product->increment('views_count');
        $product->supplier->increment('views_count');

        // Track recently viewed
        RecentlyViewed::updateOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'session_id' => $request->session()->getId(),
        ]);

        // Similar products in same category
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with('supplier')
            ->take(4)
            ->get();

        // More products from this supplier
        $moreFromSupplier = Product::where('supplier_id', $product->supplier_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        // Related categories
        $relatedCategories = Category::where('id', '!=', $product->category_id)
            ->where('is_active', true)
            ->take(6)
            ->get();

        return view('products.show', compact(
            'product',
            'similarProducts',
            'moreFromSupplier',
            'relatedCategories'
        ));
    }
}
