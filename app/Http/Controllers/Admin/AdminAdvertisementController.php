<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AdminAdvertisementController extends Controller
{
    public function index()
    {
        $ads = Advertisement::with('supplier')->latest()->paginate(15);
        $suppliers = Supplier::where('status', 'active')->get();

        return view('admin.advertisements.index', compact('ads', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'placement' => 'required|in:hero_slider,category_top,search_sponsored,sidebar_banner,homepage_featured',
            'image_path' => 'required|string|max:500',
            'target_url' => 'nullable|string|max:500',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        Advertisement::create([
            'title' => $request->title,
            'placement' => $request->placement,
            'image_path' => $request->image_path,
            'target_url' => $request->target_url,
            'supplier_id' => $request->supplier_id,
            'starts_at' => now(),
            'ends_at' => now()->addMonth(),
            'is_active' => true,
        ]);

        return back()->with('success', 'Advertisement campaign created successfully.');
    }

    public function toggleStatus($id)
    {
        $ad = Advertisement::findOrFail($id);
        $ad->update(['is_active' => !$ad->is_active]);

        return back()->with('success', 'Ad campaign status updated.');
    }

    public function destroy($id)
    {
        $ad = Advertisement::findOrFail($id);
        $ad->delete();

        return back()->with('success', 'Ad banner deleted.');
    }
}
