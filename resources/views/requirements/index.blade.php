@extends('layouts.app')

@section('title', 'Live Buy Requirements (RFQs) & Tender Leads - NexTrade')
@section('meta_description', 'Browse active wholesale buy requirements, supply tenders, and bulk RFQ leads from verified buyers across India.')

@section('content')

    <div class="bg-slate-900 text-white py-10 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-amber-400">Live Procurement Marketplace</span>
                <h1 class="text-2xl sm:text-3xl font-extrabold font-heading text-white mt-1">
                    Active Buy Requirements & RFQ Leads
                </h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1">Explore real-time buying requests from verified procurement buyers.</p>
            </div>
            <div>
                <a href="{{ route('requirements.create') }}" class="px-6 py-3 rounded-full bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs shadow-lg shadow-amber-500/25 transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Post Requirement
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Filter Form -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 mb-8 shadow-sm">
            <form action="{{ route('requirements.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search RFQ requirement keyword..." class="px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                
                <select name="category" class="px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>

                <div class="flex items-center gap-2">
                    <button type="submit" class="flex-1 py-2 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md transition">Filter RFQs</button>
                    <a href="{{ route('requirements.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 font-bold text-xs rounded-xl transition">Reset</a>
                </div>
            </form>
        </div>

        <!-- RFQ Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($requirements as $rfq)
                <div class="bg-white rounded-3xl border border-slate-200 hover:border-brand-500 hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between relative group">
                    <div>
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-brand-600 bg-brand-50 px-2.5 py-0.5 rounded-full">
                                {{ $rfq->category->name ?? 'General' }}
                            </span>
                            <span class="text-[11px] text-slate-400">{{ $rfq->created_at->diffForHumans() }}</span>
                        </div>

                        <h3 class="text-sm font-bold font-heading text-slate-900 group-hover:text-brand-600 transition leading-snug line-clamp-2">
                            <a href="{{ route('requirements.show', $rfq->id) }}">{{ $rfq->title }}</a>
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

                        <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-3">
                            <i class="fa-solid fa-location-dot text-slate-400 text-xs"></i>
                            <span class="truncate">{{ $rfq->delivery_location }}</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs text-slate-400">{{ $rfq->quotes->count() }} quotes submitted</span>
                        
                        @if(Auth::check() && Auth::user()->isSupplier())
                            <a href="{{ route('supplier.requirements.show', $rfq->id) }}" class="px-4 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs shadow-md transition">
                                Submit Quote
                            </a>
                        @else
                            <a href="{{ route('requirements.show', $rfq->id) }}" class="px-4 py-2 rounded-xl bg-brand-50 hover:bg-brand-600 text-brand-700 hover:text-white font-bold text-xs transition">
                                View Details
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 bg-white rounded-3xl p-12 text-center border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-800">No active requirements found</h3>
                    <p class="text-xs text-slate-500 mt-1">Be the first to post a buy requirement today!</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $requirements->links() }}
        </div>

    </div>

@endsection
