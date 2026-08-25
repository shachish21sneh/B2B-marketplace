@extends('layouts.dashboard')

@section('title', $requirement->title . ' - Quotes Received')
@section('page_title', 'Requirement Details & Quotes')
@section('page_subtitle', 'Review individual bids submitted by suppliers.')

@section('content')

    <div class="space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('buyer.requirements') }}" class="text-xs font-bold text-brand-600 hover:underline flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Back to My Requirements
            </a>
            @if($requirement->quotes->count() > 1)
                <a href="{{ route('buyer.requirements.compare', $requirement->id) }}" class="px-4 py-2 rounded-xl bg-gradient-to-r from-brand-600 to-indigo-600 text-white font-bold text-xs shadow-md">
                    <i class="fa-solid fa-code-compare mr-1"></i> Compare Quotes Side-by-Side
                </a>
            @endif
        </div>

        <!-- RFQ Details Card -->
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-4">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-brand-600 bg-brand-50 px-2.5 py-0.5 rounded-full">
                        {{ $requirement->category->name ?? 'General' }}
                    </span>
                    <h2 class="text-xl font-bold font-heading text-slate-900 mt-2">{{ $requirement->title }}</h2>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $requirement->status === 'open' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700' }}">
                    {{ $requirement->status }}
                </span>
            </div>

            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50 p-4 rounded-2xl border border-slate-200">
                {{ $requirement->description }}
            </p>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs pt-2">
                <div class="p-3 bg-slate-50 rounded-xl">
                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Quantity</span>
                    <strong class="text-slate-900">{{ number_format($requirement->quantity) }} {{ $requirement->quantity_unit }}</strong>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl">
                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Target Price</span>
                    <strong class="text-emerald-600">{{ $requirement->target_price ? '₹' . number_format($requirement->target_price, 2) : 'Negotiable' }}</strong>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl">
                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Delivery Destination</span>
                    <strong class="text-slate-900 truncate block">{{ $requirement->delivery_location }}</strong>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl">
                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Required By</span>
                    <strong class="text-slate-900">{{ $requirement->required_by ? $requirement->required_by->format('d M Y') : 'Immediate' }}</strong>
                </div>
            </div>
        </div>

        <!-- Submitted Quotes List -->
        <div>
            <h3 class="text-base font-bold font-heading text-slate-900 mb-4">
                Received Supplier Quotations ({{ $requirement->quotes->count() }})
            </h3>

            <div class="space-y-4">
                @forelse($requirement->quotes as $q)
                    <div class="bg-white rounded-3xl border {{ $q->status === 'accepted' ? 'border-emerald-500 ring-2 ring-emerald-500/20' : 'border-slate-200' }} p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6">
                        
                        <div class="space-y-3 flex-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <h4 class="text-base font-bold text-slate-900">
                                    <a href="{{ route('suppliers.show', $q->supplier->slug) }}" class="hover:text-brand-600">{{ $q->supplier->company_name }}</a>
                                </h4>
                                <x-verification_badge :level="$q->supplier->verification_level" />
                                <span class="text-xs text-amber-500 font-bold"><i class="fa-solid fa-star text-[10px]"></i> {{ $q->supplier->rating_avg ?: '4.9' }}</span>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                                <div>
                                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Unit Price</span>
                                    <strong class="text-base font-bold text-emerald-600 font-heading">₹{{ number_format($q->unit_price, 2) }}</strong>
                                </div>
                                <div>
                                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Total Order Value</span>
                                    <strong class="text-slate-900 font-bold">₹{{ number_format($q->total_cost, 2) }}</strong>
                                </div>
                                <div>
                                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Lead Time</span>
                                    <strong class="text-slate-900 font-bold">{{ $q->delivery_time_days }} Days</strong>
                                </div>
                                <div>
                                    <span class="text-slate-400 block text-[10px] uppercase font-bold">MOQ</span>
                                    <strong class="text-slate-900 font-bold">{{ $q->moq }} Units</strong>
                                </div>
                            </div>

                            @if($q->notes)
                                <p class="text-xs text-slate-600 bg-slate-50 p-3 rounded-xl border border-slate-100 italic">
                                    "{{ $q->notes }}"
                                </p>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="flex-shrink-0 flex flex-col gap-2 min-w-[160px]">
                            @if($q->status === 'accepted')
                                <div class="py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-xs text-center flex items-center justify-center gap-1.5 shadow-md">
                                    <i class="fa-solid fa-check"></i> Quote Accepted
                                </div>
                            @else
                                <form action="{{ route('buyer.quotes.accept', $q->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition">
                                        Accept Quote
                                    </button>
                                </form>
                                <form action="{{ route('buyer.quotes.reject', $q->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-2 rounded-xl bg-slate-100 hover:bg-red-50 hover:text-red-600 text-slate-600 font-semibold text-xs transition">
                                        Decline
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('buyer.messages', ['user' => $q->supplier->user_id]) }}" class="w-full py-2 rounded-xl bg-brand-50 hover:bg-brand-100 text-brand-700 font-bold text-xs text-center transition flex items-center justify-center gap-1.5">
                                <i class="fa-solid fa-comments"></i> Chat with Supplier
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="p-8 text-center bg-white rounded-3xl border border-slate-200 text-slate-500 text-xs">
                        No quotes submitted yet. Verified suppliers matching this category will respond shortly.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

@endsection
