<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['products', 'subcategories'])->orderBy('sort_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'image' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:2000',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_keywords' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer',
        ]);

        $slug = Str::slug($request->name);
        if (Category::where('slug', $slug)->exists()) {
            $slug .= '-' . Str::random(4);
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'icon' => $request->icon ?: 'tag',
            'image' => $request->image ?: 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80',
            'description' => $request->description,
            'seo_title' => $request->seo_title ?: ($request->name . ' Manufacturers & Wholesale Suppliers'),
            'seo_description' => $request->seo_description ?: ('Source verified ' . $request->name . ' products at factory prices.'),
            'seo_keywords' => $request->seo_keywords ?: (strtolower($request->name) . ', suppliers, manufacturers'),
            'is_active' => true,
            'sort_order' => $request->sort_order ?: 0,
        ]);

        return back()->with('success', 'Category created successfully.');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'image' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:2000',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_keywords' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer',
        ]);

        $category->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'image' => $request->image,
            'description' => $request->description,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'seo_keywords' => $request->seo_keywords,
            'sort_order' => $request->sort_order ?: 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return back()->with('success', 'Category updated successfully.');
    }

    public function storeSubcategory(Request $request, $categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $slug = Str::slug($request->name);
        if (Subcategory::where('slug', $slug)->exists()) {
            $slug .= '-' . Str::random(4);
        }

        Subcategory::create([
            'category_id' => $category->id,
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'is_active' => true,
        ]);

        return back()->with('success', 'Subcategory added successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }
}
