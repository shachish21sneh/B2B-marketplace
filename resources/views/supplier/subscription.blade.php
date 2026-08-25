@extends('layouts.dashboard')

@section('title', 'Subscription Plans & Monetization - Supplier Dashboard')
@section('page_title', 'Monetization & Subscription Plans')
@section('page_subtitle', 'Unlock premium seller badges, unlimited product listings, and priority RFQ lead access.')

@section('content')

    <div class="space-y-10">
        
        <!-- Active Subscription Banner -->
        <div class="bg-gradient-to-r from-slate-900 to-brand-950 text-white rounded-3xl p-6 sm:p-8 shadow-xl flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="space-y-1">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-400">Current Membership Status</span>
                <div class="flex items-center gap-3">
                    <h2 class="text-2xl font-extrabold font-heading">{{ $currentPlan ? $currentPlan->name : 'Free Starter Tier' }}</h2>
                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold uppercase">Active</span>
                </div>
                <p class="text-xs text-slate-300">
                    Product Limit: <strong class="text-white">{{ $currentPlan && $currentPlan->product_limit ? $currentPlan->product_limit . ' Products' : 'Unlimited' }}</strong>
                    • RFQ Lead Access: <strong class="text-emerald-400">Enabled</strong>
                </p>
            </div>

            @if($currentSubscription && $currentSubscription->expires_at)
                <div class="text-right">
                    <span class="text-xs text-slate-400 block">Renews on</span>
                    <strong class="text-sm font-bold text-white">{{ $currentSubscription->expires_at->format('d M, Y') }}</strong>
                </div>
            @endif
        </div>

        <!-- Pricing Plans Grid (3 Tiers) -->
        <div>
            <div class="text-center max-w-xl mx-auto mb-8 space-y-2">
                <h3 class="text-xl sm:text-2xl font-extrabold font-heading text-slate-900">Choose the Best Plan for Your Factory</h3>
                <p class="text-xs text-slate-500">Accelerate your B2B sales pipeline with top rankings and instant lead alerts.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($plans as $plan)
                    @php
                        $isCurrent = $currentPlan && $currentPlan->id == $plan->id;
                        $isPopular = $plan->slug === 'gold-supplier' || $plan->slug === 'business-gold';
                    @endphp
                    <div class="bg-white rounded-3xl border {{ $isPopular ? 'border-brand-500 shadow-2xl ring-2 ring-brand-500/20' : 'border-slate-200 shadow-sm' }} p-6 sm:p-8 flex flex-col justify-between relative">
                        
                        @if($isPopular)
                            <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-brand-600 to-indigo-600 text-white text-[10px] font-extrabold uppercase tracking-wider px-3.5 py-1 rounded-full shadow-md">
                                Most Popular for Manufacturers
                            </div>
                        @endif

                        <div>
                            <h4 class="text-lg font-bold font-heading text-slate-900">{{ $plan->name }}</h4>
                            <p class="text-xs text-slate-500 mt-1 min-h-[32px]">{{ $plan->description }}</p>

                            <div class="mt-4 pb-4 border-b border-slate-100 flex items-baseline gap-1">
                                <span class="text-3xl font-extrabold font-heading text-slate-900">₹{{ number_format($plan->price) }}</span>
                                <span class="text-xs text-slate-500 font-semibold">/ year</span>
                            </div>

                            <!-- Features List -->
                            <ul class="mt-6 space-y-3 text-xs text-slate-600">
                                <li class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i>
                                    <span><strong>{{ $plan->product_limit ? $plan->product_limit . ' Products' : 'Unlimited Products' }}</strong> Catalog</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i>
                                    <span><strong>{{ $plan->rfq_quota ? $plan->rfq_quota . ' Quotes / mo' : 'Unlimited Quotes' }}</strong> on Buy Leads</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i>
                                    <span>{{ $plan->badge_type }} Trust Badge</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i>
                                    <span>Priority Search Ranking</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i>
                                    <span>Direct WhatsApp Lead Alerts</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i>
                                    <span>24/7 Dedicated Account Manager</span>
                                </li>
                            </ul>
                        </div>

                        <!-- CTA Button -->
                        <div class="mt-8 pt-4 border-t border-slate-100">
                            @if($isCurrent)
                                <button disabled class="w-full py-3 rounded-2xl bg-slate-100 text-slate-500 font-bold text-xs cursor-default">
                                    Current Active Plan
                                </button>
                            @else
                                <form action="{{ route('supplier.subscription.checkout') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                    <button type="submit" class="w-full py-3 rounded-2xl {{ $isPopular ? 'bg-gradient-to-r from-brand-600 to-indigo-600 text-white shadow-lg shadow-brand-500/25' : 'bg-slate-900 text-white hover:bg-slate-800' }} font-bold text-xs transition">
                                        Upgrade to {{ $plan->name }}
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        </div>

        <!-- Payment Invoices & Transaction History -->
        @if($payments && $payments->isNotEmpty())
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                <h3 class="text-base font-bold font-heading text-slate-900">Billing History & GST Invoices</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-100 uppercase text-[10px]">
                                <th class="pb-3">Transaction ID</th>
                                <th class="pb-3">Plan</th>
                                <th class="pb-3">Amount</th>
                                <th class="pb-3">Gateway</th>
                                <th class="pb-3">Date</th>
                                <th class="pb-3 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @foreach($payments as $pm)
                                <tr>
                                    <td class="py-3 font-mono font-bold text-slate-900">{{ $pm->transaction_id }}</td>
                                    <td class="py-3 font-semibold">{{ $pm->plan ? $pm->plan->name : 'Subscription' }}</td>
                                    <td class="py-3 font-bold text-emerald-600">₹{{ number_format($pm->amount, 2) }}</td>
                                    <td class="py-3 uppercase text-[10px] font-bold">{{ $pm->payment_gateway }}</td>
                                    <td class="py-3">{{ $pm->created_at->format('M d, Y') }}</td>
                                    <td class="py-3 text-right">
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-100 text-emerald-700">
                                            {{ $pm->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>

@endsection
