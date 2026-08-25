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
        $advertisements = Advertisement::with('supplier')->latest()->paginate(15);
        $ads = $advertisements;
        $suppliers = Supplier::where('status', 'active')->get();

        return view('admin.advertisements.index', compact('advertisements', 'ads', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'placement' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:100',
            'image_path' => 'nullable|string|max:500',
            'image' => 'nullable|string|max:500',
            'target_url' => 'nullable|string|max:500',
            'link_url' => 'nullable|string|max:500',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        $placement = $request->placement ?: ($request->position === 'hero_banner' ? 'hero_slider' : ($request->position === 'sidebar' ? 'sidebar_banner' : ($request->position ?: 'hero_slider')));
        $imagePath = $request->image_path ?: ($request->image ?: '');
        $targetUrl = $request->target_url ?: $request->link_url;
        $startsAt = $request->starts_at ?: ($request->start_date ?: now());
        $endsAt = $request->ends_at ?: ($request->end_date ?: now()->addMonth());

        Advertisement::create([
            'title' => $request->title,
            'placement' => $placement,
            'image_path' => $imagePath,
            'target_url' => $targetUrl,
            'supplier_id' => $request->supplier_id,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
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
