<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SupplierProductController extends Controller
{
    public function index(Request $request)
    {
        $supplier = Auth::user()->supplier;
        $query = $supplier->products()->with(['category', 'subcategory']);

        if ($request->filled('q')) {
            $term = trim($request->q);
            $query->where('name', 'like', "%{$term}%")->orWhere('sku', 'like', "%{$term}%");
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $products = $query->latest()->paginate(10)->withQueryString();

        return view('supplier.products.index', compact('products', 'supplier'));
    }

    public function create()
    {
        $supplier = Auth::user()->supplier;
        $plan = $supplier->subscriptionPlan;
        $productCount = $supplier->products()->count();

        if ($plan && $plan->product_limit > 0 && $productCount >= $plan->product_limit) {
            return redirect()->route('supplier.subscription')
                ->with('error', "You have reached your limit of {$plan->product_limit} products on the {$plan->name} plan. Please upgrade to add more products.");
        }

        $categories = Category::where('is_active', true)->with('subcategories')->get();

        return view('supplier.products.create', compact('categories', 'supplier'));
    }

    public function store(Request $request)
    {
        $supplier = Auth::user()->supplier;

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'brand' => 'nullable|string|max:100',
            'sku' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0.01',
            'price_unit' => 'required|string|max:50',
            'moq' => 'required|integer|min:1',
            'stock_qty' => 'required|integer|min:0',
            'description' => 'required|string|min:20|max:5000',
            'main_image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|max:5120',
            'features' => 'nullable|string|max:2000',
            'packaging_details' => 'nullable|string|max:1000',
            'delivery_info' => 'nullable|string|max:1000',
            'payment_terms' => 'nullable|string|max:255',
        ]);

        $slug = Str::slug($request->name);
        if (Product::where('slug', $slug)->exists()) {
            $slug .= '-' . Str::random(5);
        }

        $imagePath = $request->main_image ?: 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800&auto=format&fit=crop&q=80';

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $imagePath = '/storage/' . $path;
        }

        // Process specifications key-value pairs
        $specifications = [];
        if ($request->has('spec_keys') && is_array($request->spec_keys)) {
            foreach ($request->spec_keys as $index => $key) {
                $val = $request->spec_values[$index] ?? '';
                if (!empty($key) && !empty($val)) {
                    $specifications[] = ['key' => trim($key), 'value' => trim($val)];
                }
            }
        }

        $product = Product::create([
            'supplier_id' => $supplier->id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'slug' => $slug,
            'brand' => $request->brand,
            'sku' => $request->sku ?: 'SKU-' . strtoupper(Str::random(6)),
            'price' => $request->price,
            'price_unit' => $request->price_unit,
            'moq' => $request->moq,
            'stock_qty' => $request->stock_qty,
            'description' => $request->description,
            'main_image' => $imagePath,
            'video_url' => $request->video_url,
            'specifications' => $specifications,
            'features' => $request->features,
            'packaging_details' => $request->packaging_details,
            'delivery_info' => $request->delivery_info,
            'payment_terms' => $request->payment_terms,
            'is_active' => true,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $imagePath,
            'is_primary' => true,
            'sort_order' => 1,
        ]);

        return redirect()->route('supplier.products')->with('success', 'Product published successfully to the B2B catalog!');
    }

    public function edit($id)
    {
        $supplier = Auth::user()->supplier;
        $product = Product::where('id', $id)->where('supplier_id', $supplier->id)->firstOrFail();
        $categories = Category::where('is_active', true)->with('subcategories')->get();

        return view('supplier.products.edit', compact('product', 'categories', 'supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Auth::user()->supplier;
        $product = Product::where('id', $id)->where('supplier_id', $supplier->id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'brand' => 'nullable|string|max:100',
            'sku' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0.01',
            'price_unit' => 'required|string|max:50',
            'moq' => 'required|integer|min:1',
            'stock_qty' => 'required|integer|min:0',
            'description' => 'required|string|min:20|max:5000',
            'main_image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|max:5120',
            'features' => 'nullable|string|max:2000',
            'packaging_details' => 'nullable|string|max:1000',
            'delivery_info' => 'nullable|string|max:1000',
            'payment_terms' => 'nullable|string|max:255',
        ]);

        $imagePath = $product->main_image;
        if ($request->filled('main_image')) {
            $imagePath = $request->main_image;
        }
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $imagePath = '/storage/' . $path;
        }

        $specifications = [];
        if ($request->has('spec_keys') && is_array($request->spec_keys)) {
            foreach ($request->spec_keys as $index => $key) {
                $val = $request->spec_values[$index] ?? '';
                if (!empty($key) && !empty($val)) {
                    $specifications[] = ['key' => trim($key), 'value' => trim($val)];
                }
            }
        }

        $product->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'brand' => $request->brand,
            'sku' => $request->sku,
            'price' => $request->price,
            'price_unit' => $request->price_unit,
            'moq' => $request->moq,
            'stock_qty' => $request->stock_qty,
            'description' => $request->description,
            'main_image' => $imagePath,
            'video_url' => $request->video_url,
            'specifications' => $specifications,
            'features' => $request->features,
            'packaging_details' => $request->packaging_details,
            'delivery_info' => $request->delivery_info,
            'payment_terms' => $request->payment_terms,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('supplier.products')->with('success', 'Product updated successfully.');
    }

    public function toggleStatus($id)
    {
        $supplier = Auth::user()->supplier;
        $product = Product::where('id', $id)->where('supplier_id', $supplier->id)->firstOrFail();

        $product->update(['is_active' => !$product->is_active]);

        $statusStr = $product->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Product has been {$statusStr}.");
    }

    public function destroy($id)
    {
        $supplier = Auth::user()->supplier;
        $product = Product::where('id', $id)->where('supplier_id', $supplier->id)->firstOrFail();

        $product->delete();

        return redirect()->route('supplier.products')->with('success', 'Product removed successfully.');
    }
}
