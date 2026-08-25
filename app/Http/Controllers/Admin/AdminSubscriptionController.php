<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionPayment;
use App\Models\Subscription;
use Illuminate\Http\Request;

class AdminSubscriptionController extends Controller
{
    public function index()
    {
        $plans = SubscriptionPlan::withCount('suppliers')->get();
        $payments = SubscriptionPayment::with(['supplier', 'plan'])->latest()->paginate(15);
        $totalRevenue = SubscriptionPayment::where('status', 'success')->sum('amount');

        return view('admin.subscriptions.index', compact('plans', 'payments', 'totalRevenue'));
    }

    public function updatePlan(Request $request, $id)
    {
        $plan = SubscriptionPlan::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'product_limit' => 'required|integer',
            'inquiry_limit' => 'required|integer',
            'has_verified_badge' => 'boolean',
            'has_priority_listing' => 'boolean',
            'has_rfq_access' => 'boolean',
            'has_analytics' => 'boolean',
        ]);

        $plan->update([
            'name' => $request->name,
            'price' => $request->price,
            'product_limit' => $request->product_limit,
            'inquiry_limit' => $request->inquiry_limit,
            'has_verified_badge' => $request->boolean('has_verified_badge'),
            'has_priority_listing' => $request->boolean('has_priority_listing'),
            'has_rfq_access' => $request->boolean('has_rfq_access'),
            'has_analytics' => $request->boolean('has_analytics'),
        ]);

        return back()->with('success', 'Plan settings updated.');
    }
}
