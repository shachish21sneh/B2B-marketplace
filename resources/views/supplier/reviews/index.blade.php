@extends('layouts.dashboard')

@section('title', 'Customer Reviews & Feedback - Supplier Dashboard')
@section('page_title', 'Customer Reviews & Reputation')
@section('page_subtitle', 'Monitor verified customer ratings and post vendor replies.')

@section('content')

    <div class="space-y-6">
        
        <!-- Reputation Summary Card -->
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                <div class="text-center">
                    <span class="text-4xl font-extrabold font-heading text-slate-900">{{ $supplier->rating_avg ?: '4.9' }}</span>
                    <div class="flex items-center justify-center gap-1 text-amber-500 my-1 text-sm">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <span class="text-[11px] text-slate-400 font-semibold">{{ $supplier->reviews_count }} Verified Reviews</span>
                </div>
                <div class="border-l border-slate-200 pl-6 text-xs text-slate-600 space-y-1">
                    <p><strong class="text-slate-800">Quality Score:</strong> 4.9 / 5.0</p>
                    <p><strong class="text-slate-800">Delivery Accuracy:</strong> 98% On-time</p>
                    <p><strong class="text-slate-800">Response Rate:</strong> < 2 Hours</p>
                </div>
            </div>

            <div class="text-right">
                <span class="px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold">
                    <i class="fa-solid fa-medal mr-1"></i> Top Rated Manufacturer
                </span>
            </div>
        </div>

        <!-- Reviews List with Supplier Reply Form -->
        <div class="space-y-4">
            @forelse($reviews as $rev)
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-sm text-slate-900">{{ $rev->buyer->company_name ?? 'Procurement Buyer' }}</span>
                                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold">Verified Buyer</span>
                            </div>
                            <span class="text-[11px] text-slate-400">{{ $rev->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex items-center gap-1 text-amber-500 font-bold text-xs bg-amber-50 px-2.5 py-1 rounded-xl">
                            <i class="fa-solid fa-star text-[10px]"></i> {{ $rev->overall_rating }} / 5.0
                        </div>
                    </div>

                    <h4 class="text-xs font-bold text-slate-800">{{ $rev->title }}</h4>
                    <p class="text-xs text-slate-600 leading-relaxed">{{ $rev->comment }}</p>

                    <!-- Existing Reply or Reply Box -->
                    @if($rev->supplier_reply)
                        <div class="p-4 bg-brand-50/60 rounded-2xl border border-brand-100 text-xs">
                            <strong class="text-brand-900 block mb-1">Your Official Response:</strong>
                            <p class="text-slate-600">{{ $rev->supplier_reply }}</p>
                        </div>
                    @else
                        <form action="{{ route('supplier.reviews.reply', $rev->id) }}" method="POST" class="pt-2 flex gap-2">
                            @csrf
                            <input type="text" name="reply" required placeholder="Write a professional thank you or resolution reply..." class="flex-1 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            <button type="submit" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-xs transition whitespace-nowrap">
                                Post Reply
                            </button>
                        </form>
                    @endif
                </div>
            @empty
                <div class="p-8 text-center bg-white rounded-3xl border border-slate-200 text-slate-500 text-xs">
                    No customer reviews yet. Maintain high quality and fulfillment speed to gain 5-star ratings!
                </div>
            @endforelse
        </div>

    </div>

@endsection
