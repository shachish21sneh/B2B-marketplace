@extends('layouts.dashboard')

@section('title', 'Subscriptions & Revenue - Super Admin')
@section('page_title', 'Monetization & Membership Tiers')
@section('page_subtitle', 'Manage pricing plans, subscriber quotas, and track marketplace recurring revenue.')

@section('content')

    <div class="space-y-8">
        
        <!-- Active Subscription Plans Table -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 space-y-4">
            <h3 class="text-base font-bold font-heading text-slate-900">Subscription Tiers & Quota Configurations</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($plans as $plan)
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                        <div class="flex items-center justify-between">
                            <h4 class="text-base font-bold text-slate-900">{{ $plan->name }}</h4>
                            <span class="px-2.5 py-0.5 rounded-full bg-brand-100 text-brand-700 text-[10px] font-bold uppercase">{{ $plan->badge_type }}</span>
                        </div>
                        <div class="text-2xl font-extrabold font-heading text-slate-900">₹{{ number_format($plan->price) }} <span class="text-xs text-slate-500 font-normal">/ yr</span></div>
                        <div class="space-y-1.5 text-xs text-slate-600">
                            <div>Product Limit: <strong>{{ $plan->product_limit ?: 'Unlimited' }}</strong></div>
                            <div>RFQ Quota: <strong>{{ $plan->rfq_quota ? $plan->rfq_quota . ' / mo' : 'Unlimited' }}</strong></div>
                            <div>Subscribers: <strong class="text-brand-600">{{ $plan->suppliers->count() }} active</strong></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Payments Log Table -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100">
                <h3 class="text-base font-bold font-heading text-slate-900">Recent Subscription Payments & Transactions</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 border-b border-slate-200 uppercase tracking-wider text-[10px]">
                            <th class="py-4 px-6 font-bold">Transaction ID</th>
                            <th class="py-4 px-4 font-bold">Supplier</th>
                            <th class="py-4 px-4 font-bold">Plan</th>
                            <th class="py-4 px-4 font-bold">Amount</th>
                            <th class="py-4 px-4 font-bold">Gateway</th>
                            <th class="py-4 px-4 font-bold">Date</th>
                            <th class="py-4 px-6 font-bold text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($payments as $pm)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-4 px-6 font-mono font-bold text-slate-900">{{ $pm->transaction_id }}</td>
                                <td class="py-4 px-4 font-bold text-slate-800">{{ $pm->supplier->company_name ?? 'Supplier' }}</td>
                                <td class="py-4 px-4 font-semibold text-brand-600">{{ $pm->plan->name ?? 'Tier' }}</td>
                                <td class="py-4 px-4 font-bold text-emerald-600">₹{{ number_format($pm->amount, 2) }}</td>
                                <td class="py-4 px-4 uppercase text-[10px] font-bold">{{ $pm->payment_gateway }}</td>
                                <td class="py-4 px-4 text-slate-500">{{ $pm->created_at->format('M d, Y') }}</td>
                                <td class="py-4 px-6 text-right">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-100 text-emerald-700">
                                        {{ $pm->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">No payment logs recorded.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $payments->links() }}
            </div>
        </div>

    </div>

@endsection
