<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Location;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function suggestions(Request $request)
    {
        $q = trim($request->get('q', ''));
        if (strlen($q) < 2) {
            return response()->json([
                'products' => [],
                'categories' => [],
                'suppliers' => [],
                'locations' => [],
            ]);
        }

        $products = Product::where('is_active', true)
            ->where('name', 'like', "%{$q}%")
            ->with('supplier:id,company_name,city')
            ->select('id', 'name', 'slug', 'price', 'price_unit', 'main_image', 'supplier_id')
            ->take(5)
            ->get();

        $categories = Category::where('is_active', true)
            ->where('name', 'like', "%{$q}%")
            ->select('id', 'name', 'slug', 'icon')
            ->take(4)
            ->get();

        $suppliers = Supplier::where('status', 'active')
            ->where('company_name', 'like', "%{$q}%")
            ->select('id', 'company_name', 'slug', 'city', 'state', 'is_verified', 'verification_level', 'logo')
            ->take(4)
            ->get();

        $locations = Location::where('city', 'like', "%{$q}%")
            ->select('id', 'city', 'state')
            ->take(4)
            ->get();

        return response()->json([
            'query' => $q,
            'products' => $products,
            'categories' => $categories,
            'suppliers' => $suppliers,
            'locations' => $locations,
        ]);
    }
}
