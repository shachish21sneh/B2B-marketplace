<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use App\Models\Subscription;
use App\Models\SubscriptionPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SupplierSubscriptionController extends Controller
{
    public function index()
    {
        $supplier = Auth::user()->getOrCreateSupplier();
        $plans = SubscriptionPlan::where('is_active', true)->get();
        $currentPlan = $supplier->subscriptionPlan;
        $currentSubscription = Subscription::where('supplier_id', $supplier->id)->where('status', 'active')->latest()->first();
        $payments = SubscriptionPayment::where('supplier_id', $supplier->id)->latest()->take(10)->get();

        return view('supplier.subscription', compact('plans', 'supplier', 'currentPlan', 'currentSubscription', 'payments'));
    }

    public function upgrade(Request $request)
    {
        $supplier = Auth::user()->getOrCreateSupplier();
        $plan = SubscriptionPlan::findOrFail($request->plan_id);

        $paymentId = 'pay_razor_' . Str::random(12);

        // Record payment
        SubscriptionPayment::create([
            'supplier_id' => $supplier->id,
            'plan_id' => $plan->id,
            'amount' => $plan->price,
            'payment_gateway' => 'Razorpay (Test / Live)',
            'transaction_id' => $paymentId,
            'status' => 'success',
            'gateway_response' => [
                'razorpay_payment_id' => $paymentId,
                'method' => 'card / upi',
                'timestamp' => now()->toIso8601String(),
            ],
        ]);

        // Update active subscription
        Subscription::create([
            'supplier_id' => $supplier->id,
            'plan_id' => $plan->id,
            'starts_at' => now(),
            'ends_at' => now()->addYear(),
            'status' => 'active',
            'payment_id' => $paymentId,
        ]);

        // Upgrade supplier profile privileges
        $verificationLevel = $supplier->verification_level;
        if ($plan->has_verified_badge && $verificationLevel === 'None') {
            $verificationLevel = 'GST';
        }
        if ($plan->slug === 'enterprise-elite') {
            $verificationLevel = 'Premium';
        }

        $supplier->update([
            'subscription_plan_id' => $plan->id,
            'is_verified' => $plan->has_verified_badge ? true : $supplier->is_verified,
            'verification_level' => $verificationLevel,
            'is_featured' => $plan->has_priority_listing,
        ]);

        return redirect()->route('supplier.subscription')->with('success', "Congratulations! Your account has been upgraded to {$plan->name}. All premium privileges and RFQ lead access are now active.");
    }
}
