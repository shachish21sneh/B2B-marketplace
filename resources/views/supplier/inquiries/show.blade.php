@extends('layouts.dashboard')

@section('title', 'Review Inquiry - Supplier Dashboard')
@section('page_title', 'Product Inquiry Details')
@section('page_subtitle', 'Review buyer requirements and reply directly.')

@section('content')

    <div class="max-w-4xl space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('supplier.inquiries') }}" class="text-xs font-bold text-brand-600 hover:underline flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Back to Inquiries Inbox
            </a>
            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $inqStatusBadge ?? 'bg-blue-100 text-blue-700' }}">
                Status: {{ $inquiry->status }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
            
            <!-- Left: Inquiry Content -->
            <div class="md:col-span-7 space-y-6">
                <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-4">
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3">
                        Buyer Inquiry Message
                    </h3>

                    @if($inquiry->product)
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-2xl flex items-center gap-3">
                            <img src="{{ $inquiry->product->main_image }}" class="w-12 h-12 rounded-xl object-cover border border-slate-200 flex-shrink-0">
                            <div>
                                <h4 class="text-xs font-bold text-slate-900">{{ $inquiry->product->name }}</h4>
                                <span class="text-xs font-bold text-brand-600">₹{{ number_format($inquiry->product->price, 2) }} / {{ $inquiry->product->price_unit }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl text-xs text-slate-700 leading-relaxed whitespace-pre-line">
                        {{ $inquiry->message }}
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-xs pt-2">
                        <div class="p-3 bg-slate-50 rounded-xl">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Quantity Needed</span>
                            <strong class="text-slate-900 text-sm">{{ number_format($inquiry->quantity) }} Units</strong>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-xl">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Target / Expected Price</span>
                            <strong class="text-emerald-600 text-sm">{{ $inquiry->expected_price ? '₹' . number_format($inquiry->expected_price, 2) : 'Open Quote' }}</strong>
                        </div>
                    </div>
                </div>

                <!-- Supplier Reply Form -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-4">
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3">
                        Send Official Response to Buyer
                    </h3>

                    <form action="{{ route('supplier.inquiries.reply', $inquiry->id) }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Your Response Message *</label>
                            <textarea name="reply" rows="4" required placeholder="Dear Buyer, thank you for your inquiry. We can fulfill your requirement at ₹... with delivery in ... days." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">{{ old('reply', $inquiry->supplier_reply) }}</textarea>
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit" name="action" value="accepted" class="flex-1 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition">
                                <i class="fa-solid fa-check mr-1"></i> Accept & Send Response
                            </button>
                            <button type="submit" name="action" value="rejected" class="py-3 px-4 bg-slate-100 hover:bg-red-50 hover:text-red-600 text-slate-700 font-bold text-xs rounded-xl transition">
                                Decline
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: Buyer Contact Card -->
            <div class="md:col-span-5 space-y-6">
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4 text-xs">
                    <h3 class="text-sm font-bold font-heading text-slate-900 uppercase tracking-wider">Buyer Contact Details</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Buyer Name</span>
                            <strong class="text-slate-900 text-sm">{{ $inquiry->buyer_name }}</strong>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Email Address</span>
                            <a href="mailto:{{ $inquiry->buyer_email }}" class="text-brand-600 font-semibold">{{ $inquiry->buyer_email }}</a>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Phone / WhatsApp</span>
                            <a href="tel:{{ $inquiry->buyer_phone }}" class="text-slate-800 font-bold">{{ $inquiry->buyer_phone }}</a>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Delivery Destination</span>
                            <strong class="text-slate-800">{{ $inquiry->delivery_location ?: 'India' }}</strong>
                        </div>
                    </div>

                    @if($inquiry->buyer && $inquiry->buyer->user_id)
                        <div class="pt-4 border-t border-slate-100">
                            <a href="{{ route('supplier.messages', ['user' => $inquiry->buyer->user_id]) }}" class="w-full py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl text-center shadow-md transition flex items-center justify-center gap-2">
                                <i class="fa-solid fa-comments"></i> Open Live Chat Thread
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

@endsection
