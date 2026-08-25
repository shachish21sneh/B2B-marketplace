@extends('layouts.dashboard')

@section('title', 'RFQ Lead Marketplace - Supplier Dashboard')
@section('page_title', 'RFQ Lead Marketplace')
@section('page_subtitle', 'Browse live buyer requirements matching your manufacturing category and submit quotations.')

@section('content')

    <div class="space-y-6">
        
        <!-- Filter Bar -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 shadow-sm">
            <form action="{{ route('supplier.requirements') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by requirement title or spec..." class="px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                
                <select name="category" class="px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>

                <div class="flex items-center gap-2">
                    <button type="submit" class="flex-1 py-2 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md transition">Filter Leads</button>
                    <a href="{{ route('supplier.requirements') }}" class="px-4 py-2 bg-slate-100 text-slate-700 font-bold text-xs rounded-xl transition">Reset</a>
                </div>
            </form>
        </div>

        <!-- RFQ Leads Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($requirements as $rfq)
                <div class="bg-white rounded-3xl border border-slate-200 hover:border-amber-500 hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between relative group">
                    <div>
                        <div class="flex items-center justify-between gap-2 mb-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-600 bg-amber-50 px-2.5 py-0.5 rounded-full border border-amber-200">
                                {{ $rfq->category->name ?? 'General' }}
                            </span>
                            <span class="text-[11px] text-slate-400">{{ $rfq->created_at->diffForHumans() }}</span>
                        </div>

                        <h3 class="text-sm font-bold font-heading text-slate-900 group-hover:text-brand-600 transition leading-snug line-clamp-2 mt-1">
                            <a href="{{ route('supplier.requirements.show', $rfq->id) }}">{{ $rfq->title }}</a>
                        </h3>

                        <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">
                            {{ $rfq->description }}
                        </p>

                        <div class="grid grid-cols-2 gap-2 mt-4 py-3 px-3.5 bg-slate-50 rounded-2xl text-xs border border-slate-100">
                            <div>
                                <span class="block text-[10px] text-slate-400 font-semibold uppercase">Quantity</span>
                                <strong class="text-slate-900">{{ number_format($rfq->quantity) }} {{ $rfq->quantity_unit }}</strong>
                            </div>
                            <div>
                                <span class="block text-[10px] text-slate-400 font-semibold uppercase">Target Price</span>
                                <strong class="text-emerald-600">{{ $rfq->target_price ? '₹' . number_format($rfq->target_price, 2) : 'Negotiable' }}</strong>
                            </div>
                        </div>

                        <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-3 truncate">
                            <i class="fa-solid fa-location-dot text-slate-400 text-xs"></i>
                            <span class="truncate">{{ $rfq->delivery_location }}</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[11px] text-slate-400">{{ $rfq->quotes->count() }} bids submitted</span>
                        <a href="{{ route('supplier.requirements.show', $rfq->id) }}" class="px-4 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs shadow-md shadow-amber-500/20 transition">
                            Submit Quote &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 bg-white rounded-3xl p-12 text-center border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-800">No matching RFQ leads currently</h3>
                    <p class="text-xs text-slate-500 mt-1">Check back soon as new buyers post requirements daily.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $requirements->links() }}
        </div>

    </div>

@endsection
