@extends('layouts.dashboard')

@section('title', 'Submit Quotation - ' . $requirement->title)
@section('page_title', 'Submit Wholesale Quotation (Bid)')
@section('page_subtitle', 'Provide your competitive pricing, lead time, MOQ and terms to the buyer.')

@section('content')

    <div class="max-w-5xl space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('supplier.requirements') }}" class="text-xs font-bold text-brand-600 hover:underline flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Back to Lead Marketplace
            </a>
            @if($existingQuote)
                <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold">
                    <i class="fa-solid fa-check"></i> Quotation Already Submitted
                </span>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left: RFQ Details (5 Cols) -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-brand-600 bg-brand-50 px-2.5 py-0.5 rounded-full">
                        {{ $requirement->category->name ?? 'General' }}
                    </span>
                    <h2 class="text-lg font-bold font-heading text-slate-900 leading-snug">
                        {{ $requirement->title }}
                    </h2>
                    
                    <div class="text-xs text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50 p-4 rounded-2xl border border-slate-200">
                        {{ $requirement->description }}
                    </div>

                    <div class="space-y-2.5 text-xs text-slate-600 border-t border-slate-100 pt-3">
                        <div class="flex justify-between"><span class="text-slate-400">Required Quantity:</span> <strong class="text-slate-800">{{ number_format($requirement->quantity) }} {{ $requirement->quantity_unit }}</strong></div>
                        <div class="flex justify-between"><span class="text-slate-400">Target Unit Price:</span> <strong class="text-emerald-600 font-bold">{{ $requirement->target_price ? '₹' . number_format($requirement->target_price, 2) : 'Negotiable' }}</strong></div>
                        <div class="flex justify-between"><span class="text-slate-400">Delivery Destination:</span> <strong class="text-slate-800">{{ $requirement->delivery_location }}</strong></div>
                        <div class="flex justify-between"><span class="text-slate-400">Required By:</span> <strong class="text-slate-800">{{ $requirement->required_by ? $requirement->required_by->format('d M Y') : 'Immediate' }}</strong></div>
                        <div class="flex justify-between"><span class="text-slate-400">Buyer Type:</span> <strong class="text-slate-800">{{ $requirement->buyer->business_type ?? 'Corporate Buyer' }}</strong></div>
                    </div>
                </div>
            </div>

            <!-- Right: Quote Submission Form (7 Cols) -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-file-invoice-dollar text-amber-500"></i>
                        {{ $existingQuote ? 'Update Your Quotation' : 'Submit Formal Commercial Quotation' }}
                    </h3>

                    <form action="{{ route('supplier.requirements.quote', $requirement->id) }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Your Offered Unit Price (₹) *</label>
                                <input type="number" step="0.01" name="unit_price" value="{{ old('unit_price', $existingQuote?->unit_price ?? $requirement->target_price) }}" required placeholder="e.g. 9500.00" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Quantity Offered ({{ $requirement->quantity_unit }}) *</label>
                                <input type="number" name="quantity" value="{{ old('quantity', $existingQuote?->quantity ?? $requirement->quantity) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Minimum Order Qty (MOQ) *</label>
                                <input type="number" name="moq" value="{{ old('moq', $existingQuote?->moq ?? 1) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Delivery Lead Time (Days) *</label>
                                <input type="number" name="delivery_time_days" value="{{ old('delivery_time_days', $existingQuote?->delivery_time_days ?? 7) }}" min="1" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Shipping & Handling Charges (₹)</label>
                                <input type="number" step="0.01" name="shipping_charges" value="{{ old('shipping_charges', $existingQuote?->shipping_charges ?? 0) }}" placeholder="0 for Free Delivery" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Quotation Validity Until</label>
                                <input type="date" name="validity_date" value="{{ old('validity_date', $existingQuote?->validity_date?->format('Y-m-d') ?? now()->addDays(15)->format('Y-m-d')) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-1">Commercial & Payment Terms *</label>
                                <input type="text" name="payment_terms" value="{{ old('payment_terms', $existingQuote?->payment_terms ?? '100% LC at Sight / 20% Advance & 80% against BL') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-1">Technical Proposal & Additional Notes</label>
                                <textarea name="notes" rows="3" placeholder="Specify brand, test certificates (BIS/ISO) provided, warranty periods, and dispatch warehouses..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">{{ old('notes', $existingQuote?->notes) }}</textarea>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100">
                            <button type="submit" class="w-full py-3.5 rounded-2xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-sm shadow-lg shadow-amber-500/25 transition">
                                {{ $existingQuote ? 'Update Quotation' : 'Submit Quotation to Buyer' }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>

    </div>

@endsection
