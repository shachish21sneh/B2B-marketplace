@extends('layouts.dashboard')

@section('title', 'Supplier Command Center - Ozura')
@section('page_title', 'Supplier Command Center')
@section('page_subtitle', 'Real-time sales leads, buyer inquiries, catalog analytics and quotation status.')

@section('content')

    <div class="space-y-8">
        
        <!-- Top Metrics Cards (6 KPIs) -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            
            <div class="bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Product Views</span>
                <h3 class="text-xl font-extrabold font-heading text-slate-900 mt-1">{{ number_format($stats['product_views']) }}</h3>
                <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-arrow-trend-up"></i> Active Catalog</span>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Profile Views</span>
                <h3 class="text-xl font-extrabold font-heading text-brand-600 mt-1">{{ number_format($stats['profile_views']) }}</h3>
                <span class="text-[10px] text-slate-400">Storefront Visits</span>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Inquiries</span>
                <h3 class="text-xl font-extrabold font-heading text-indigo-600 mt-1">{{ $stats['total_inquiries'] }}</h3>
                <span class="text-[10px] text-indigo-500 font-semibold">{{ $stats['new_leads'] }} New Leads</span>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Quotes Sent</span>
                <h3 class="text-xl font-extrabold font-heading text-amber-600 mt-1">{{ $stats['quotes_sent'] }}</h3>
                <span class="text-[10px] text-slate-400">Tenders Bid</span>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Win Rate</span>
                <h3 class="text-xl font-extrabold font-heading text-emerald-600 mt-1">{{ $stats['conversion_rate'] }}</h3>
                <span class="text-[10px] text-emerald-600 font-semibold">Accepted Bids</span>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Store Rating</span>
                <h3 class="text-xl font-extrabold font-heading text-amber-500 mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-star text-sm"></i> {{ $stats['rating_avg'] ?: '4.9' }}
                </h3>
                <span class="text-[10px] text-slate-400">{{ $stats['reviews_count'] }} Reviews</span>
            </div>

        </div>

        <!-- Supplier Verification & Tier Status Banner -->
        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-slate-50 border border-slate-200 overflow-hidden flex-shrink-0">
                    <img src="{{ $supplier->logo ?: 'https://images.unsplash.com/photo-1560179707-f14e90ef3623?w=200' }}" alt="{{ $supplier->company_name }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h2 class="text-base font-bold font-heading text-slate-900">{{ $supplier->company_name }}</h2>
                        <x-verification_badge :level="$supplier->verification_level" />
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Current Plan: <strong class="text-brand-600 font-bold">{{ $supplier->subscriptionPlan ? $supplier->subscriptionPlan->name : 'Free Plan' }}</strong>
                        • Products: <strong class="text-slate-800">{{ $stats['active_products'] }} Active</strong>
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a href="{{ route('supplier.products.create') }}" class="flex-1 sm:flex-none px-5 py-2.5 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-500/20 transition flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-plus text-[10px]"></i> Add Product
                </a>
                <a href="{{ route('supplier.subscription') }}" class="flex-1 sm:flex-none px-5 py-2.5 rounded-2xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs shadow-md transition flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-gem text-xs"></i> Upgrade Plan
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Matching RFQ Leads Box -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold font-heading text-slate-900 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                            Live Matching RFQs (Leads)
                        </h3>
                        <p class="text-[11px] text-slate-400">Buyers looking for products in your category</p>
                    </div>
                    <a href="{{ route('supplier.requirements') }}" class="text-xs font-bold text-brand-600 hover:underline">View All Leads</a>
                </div>

                <div class="space-y-3">
                    @forelse($matchingRequirements as $rfq)
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:border-amber-400/60 transition flex items-center justify-between gap-4">
                            <div class="min-w-0">
                                <span class="text-[9px] font-bold uppercase text-brand-600 bg-brand-50 px-2 py-0.5 rounded-md">{{ $rfq->category->name ?? 'General' }}</span>
                                <h4 class="text-xs font-bold text-slate-900 truncate mt-1">
                                    <a href="{{ route('supplier.requirements.show', $rfq->id) }}" class="hover:text-brand-600">{{ $rfq->title }}</a>
                                </h4>
                                <div class="text-[11px] text-slate-500 mt-1 flex items-center gap-3">
                                    <span>Qty: <strong class="text-slate-800">{{ number_format($rfq->quantity) }} {{ $rfq->quantity_unit }}</strong></span>
                                    <span>•</span>
                                    <span>{{ $rfq->delivery_location }}</span>
                                </div>
                            </div>
                            <a href="{{ route('supplier.requirements.show', $rfq->id) }}" class="px-3.5 py-1.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs whitespace-nowrap shadow-sm transition">
                                Quote Now
                            </a>
                        </div>
                    @empty
                        <div class="p-6 text-center text-xs text-slate-400">
                            No matching RFQ leads currently. Browse all marketplace requirements.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Inquiries Inbox Box -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold font-heading text-slate-900">Direct Product Inquiries</h3>
                        <p class="text-[11px] text-slate-400">Inquiries submitted by buyers for your catalog</p>
                    </div>
                    <a href="{{ route('supplier.inquiries') }}" class="text-xs font-bold text-brand-600 hover:underline">View Inbox</a>
                </div>

                <div class="space-y-3">
                    @forelse($recentInquiries as $inq)
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:border-brand-300 transition flex items-center justify-between gap-4">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-slate-900 truncate">{{ $inq->buyer_name }}</span>
                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase {{ $inq->status === 'new' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700' }}">{{ $inq->status }}</span>
                                </div>
                                <p class="text-[11px] text-brand-600 font-semibold truncate mt-0.5">{{ $inq->product ? $inq->product->name : 'Storefront Inquiry' }}</p>
                                <p class="text-[11px] text-slate-500 line-clamp-1 italic mt-0.5">"{{ $inq->message }}"</p>
                            </div>
                            <a href="{{ route('supplier.inquiries.show', $inq->id) }}" class="px-3.5 py-1.5 rounded-xl bg-brand-50 hover:bg-brand-600 text-brand-700 hover:text-white font-bold text-xs whitespace-nowrap transition">
                                Reply
                            </a>
                        </div>
                    @empty
                        <div class="p-6 text-center text-xs text-slate-400">
                            No product inquiries received yet.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

@endsection
