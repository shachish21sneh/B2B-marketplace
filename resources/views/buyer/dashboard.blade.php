@extends('layouts.dashboard')

@section('title', 'Buyer Dashboard - NexTrade')
@section('page_title', 'Buyer Command Center')
@section('page_subtitle', 'Manage your sourcing RFQs, compare supplier bids, and track inquiries.')

@section('content')

    <div class="space-y-8">
        
        <!-- KPI Metrics Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Posted RFQs</span>
                    <h3 class="text-2xl font-extrabold font-heading text-slate-900 mt-1">{{ $stats['requirements_count'] }}</h3>
                    <a href="{{ route('buyer.requirements') }}" class="text-[11px] font-bold text-brand-600 hover:underline mt-2 inline-block">View All RFQs &rarr;</a>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-list-check"></i>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Quotes Received</span>
                    <h3 class="text-2xl font-extrabold font-heading text-emerald-600 mt-1">{{ $stats['quotes_received'] }}</h3>
                    <span class="text-[11px] font-semibold text-slate-500 mt-2 block">From Verified Sellers</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Active Inquiries</span>
                    <h3 class="text-2xl font-extrabold font-heading text-indigo-600 mt-1">{{ $stats['active_inquiries'] }}</h3>
                    <a href="{{ route('buyer.inquiries') }}" class="text-[11px] font-bold text-brand-600 hover:underline mt-2 inline-block">Track Inquiries &rarr;</a>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-paper-plane"></i>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Saved Wishlist</span>
                    <h3 class="text-2xl font-extrabold font-heading text-purple-600 mt-1">{{ $stats['saved_products'] + $stats['saved_suppliers'] }}</h3>
                    <a href="{{ route('buyer.favorites') }}" class="text-[11px] font-bold text-brand-600 hover:underline mt-2 inline-block">View Bookmarks &rarr;</a>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-heart"></i>
                </div>
            </div>

        </div>

        <!-- Quick CTA: Post New Requirement Banner -->
        <div class="bg-gradient-to-r from-brand-700 to-indigo-700 rounded-3xl p-6 sm:p-8 text-white shadow-xl flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="space-y-1 text-center sm:text-left">
                <h3 class="text-lg sm:text-xl font-bold font-heading">Need to source new products or machinery?</h3>
                <p class="text-xs text-brand-100">Post a new Buy Requirement and receive bids from multiple verified suppliers.</p>
            </div>
            <a href="{{ route('requirements.create') }}" class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-2xl shadow-lg shadow-amber-500/20 transition whitespace-nowrap flex items-center gap-2">
                <i class="fa-solid fa-bullhorn text-xs"></i> Post Buy Requirement
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Recent RFQs Table -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-bold font-heading text-slate-900">My Recent Buy Requirements</h3>
                    <a href="{{ route('buyer.requirements') }}" class="text-xs font-bold text-brand-600 hover:underline">View All</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-100 uppercase tracking-wider text-[10px]">
                                <th class="pb-3 font-semibold">Requirement</th>
                                <th class="pb-3 font-semibold">Qty</th>
                                <th class="pb-3 font-semibold">Quotes</th>
                                <th class="pb-3 font-semibold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse($recentRequirements as $req)
                                <tr class="hover:bg-slate-50/60 transition">
                                    <td class="py-3 font-bold text-slate-900 truncate max-w-[180px]">
                                        <a href="{{ route('buyer.requirements.show', $req->id) }}" class="hover:text-brand-600">{{ $req->title }}</a>
                                    </td>
                                    <td class="py-3">{{ number_format($req->quantity) }} {{ $req->quantity_unit }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $req->quotes_count > 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                            {{ $req->quotes_count }} Quotes
                                        </span>
                                    </td>
                                    <td class="py-3 text-right">
                                        @if($req->quotes_count > 1)
                                            <a href="{{ route('buyer.requirements.compare', $req->id) }}" class="px-2.5 py-1 bg-brand-50 text-brand-700 font-bold rounded-lg text-[10px] hover:bg-brand-600 hover:text-white transition">
                                                Compare
                                            </a>
                                        @else
                                            <a href="{{ route('buyer.requirements.show', $req->id) }}" class="text-brand-600 font-bold text-[11px] hover:underline">View</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-slate-400">No requirements posted yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Received Quotes Table -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-bold font-heading text-slate-900">Latest Supplier Quotes</h3>
                    <a href="{{ route('buyer.requirements') }}" class="text-xs font-bold text-brand-600 hover:underline">View All</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-100 uppercase tracking-wider text-[10px]">
                                <th class="pb-3 font-semibold">Supplier</th>
                                <th class="pb-3 font-semibold">Quote Rate</th>
                                <th class="pb-3 font-semibold">Lead Time</th>
                                <th class="pb-3 font-semibold text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse($recentQuotes as $q)
                                <tr class="hover:bg-slate-50/60 transition">
                                    <td class="py-3 font-bold text-slate-900">
                                        <div class="truncate max-w-[140px]">{{ $q->supplier->company_name }}</div>
                                        <div class="text-[10px] text-slate-400 truncate max-w-[140px]">{{ $q->requirement->title ?? '' }}</div>
                                    </td>
                                    <td class="py-3 font-bold text-emerald-600">₹{{ number_format($q->unit_price, 2) }}</td>
                                    <td class="py-3">{{ $q->delivery_time_days }} days</td>
                                    <td class="py-3 text-right">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $q->status === 'accepted' ? 'bg-emerald-100 text-emerald-700' : ($q->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                                            {{ $q->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-slate-400">No quotes received yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

@endsection
