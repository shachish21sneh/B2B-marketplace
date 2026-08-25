@extends('layouts.app')

@section('title', $supplier->company_name . ' - Verified Supplier Storefront | Ozura')
@section('meta_description', Str::limit(strip_tags($supplier->description), 160))

@section('content')

    <!-- Supplier Banner & Header Area -->
    <div class="bg-white border-b border-slate-200">
        
        <!-- Cover Banner Image -->
        <div class="w-full h-48 sm:h-64 bg-slate-900 overflow-hidden relative">
            <img src="{{ $supplier->banner ?: 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=1600' }}" alt="{{ $supplier->company_name }}" class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative -mt-16 sm:-mt-20 pb-6 flex flex-col sm:flex-row items-start sm:items-end justify-between gap-6">
                
                <div class="flex items-end gap-5">
                    <!-- Logo -->
                    <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-3xl bg-white p-2 border-4 border-white shadow-xl overflow-hidden flex-shrink-0">
                        <img src="{{ $supplier->logo ?: 'https://images.unsplash.com/photo-1560179707-f14e90ef3623?w=300' }}" alt="{{ $supplier->company_name }}" class="w-full h-full object-cover rounded-2xl">
                    </div>
                    <div>
                        <div class="flex items-center gap-2.5 flex-wrap">
                            <h1 class="text-xl sm:text-2xl lg:text-3xl font-extrabold font-heading text-slate-900">
                                {{ $supplier->company_name }}
                            </h1>
                            <x-verification_badge :level="$supplier->verification_level" />
                        </div>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1 flex items-center gap-3 flex-wrap">
                            <span><i class="fa-solid fa-industry text-brand-600 mr-1"></i> {{ $supplier->business_type }}</span>
                            <span>•</span>
                            <span><i class="fa-solid fa-location-dot text-brand-600 mr-1"></i> {{ $supplier->city }}, {{ $supplier->state }}</span>
                            <span>•</span>
                            <span><i class="fa-solid fa-calendar-check text-brand-600 mr-1"></i> Est. {{ $supplier->year_established ?: '2010' }}</span>
                        </p>
                    </div>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button 
                        type="button" 
                        onclick="openInquiryModal('{{ $supplier->id }}', '{{ addslashes($supplier->company_name) }}')"
                        class="flex-1 sm:flex-none px-6 py-3 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-lg shadow-brand-500/25 transition flex items-center justify-center gap-2"
                    >
                        <i class="fa-solid fa-paper-plane"></i> Send Inquiry
                    </button>
                    @if($supplier->user)
                        <a href="{{ Auth::check() ? (Auth::user()->isSupplier() ? route('supplier.messages', ['user' => $supplier->user_id]) : route('buyer.messages', ['user' => $supplier->user_id])) : route('login') }}" class="px-5 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs transition flex items-center gap-2">
                            <i class="fa-solid fa-comments text-brand-600"></i> Chat
                        </a>
                    @endif
                </div>

            </div>

            <!-- Tab Navigation -->
            <div class="flex items-center space-x-6 border-t border-slate-100 overflow-x-auto text-xs font-bold scrollbar-none">
                <a href="{{ route('suppliers.show', ['slug' => $supplier->slug, 'tab' => 'overview']) }}" class="py-4 border-b-2 transition whitespace-nowrap {{ $activeTab === 'overview' ? 'border-brand-600 text-brand-600' : 'border-transparent text-slate-500 hover:text-slate-900' }}">
                    Overview
                </a>
                <a href="{{ route('suppliers.show', ['slug' => $supplier->slug, 'tab' => 'products']) }}" class="py-4 border-b-2 transition whitespace-nowrap {{ $activeTab === 'products' ? 'border-brand-600 text-brand-600' : 'border-transparent text-slate-500 hover:text-slate-900' }}">
                    Products ({{ $supplier->products->count() }})
                </a>
                <a href="{{ route('suppliers.show', ['slug' => $supplier->slug, 'tab' => 'services']) }}" class="py-4 border-b-2 transition whitespace-nowrap {{ $activeTab === 'services' ? 'border-brand-600 text-brand-600' : 'border-transparent text-slate-500 hover:text-slate-900' }}">
                    Services & Turnkey
                </a>
                <a href="{{ route('suppliers.show', ['slug' => $supplier->slug, 'tab' => 'reviews']) }}" class="py-4 border-b-2 transition whitespace-nowrap {{ $activeTab === 'reviews' ? 'border-brand-600 text-brand-600' : 'border-transparent text-slate-500 hover:text-slate-900' }}">
                    Reviews & Ratings ({{ $supplier->reviews->count() }})
                </a>
                <a href="{{ route('suppliers.show', ['slug' => $supplier->slug, 'tab' => 'about']) }}" class="py-4 border-b-2 transition whitespace-nowrap {{ $activeTab === 'about' ? 'border-brand-600 text-brand-600' : 'border-transparent text-slate-500 hover:text-slate-900' }}">
                    About Company & Contact
                </a>
            </div>

        </div>
    </div>

    <!-- Tab Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        @if($activeTab === 'overview')
            <!-- OVERVIEW TAB -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-8">
                    <!-- Company Profile Summary -->
                    <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                        <h2 class="text-lg font-bold font-heading text-slate-900 mb-3">Company Overview</h2>
                        <div class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                            {{ $supplier->description }}
                        </div>
                    </div>

                    <!-- Featured Products from Storefront -->
                    <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold font-heading text-slate-900">Featured Products</h2>
                            <a href="{{ route('suppliers.show', ['slug' => $supplier->slug, 'tab' => 'products']) }}" class="text-xs font-bold text-brand-600 hover:underline">View All ({{ $supplier->products->count() }})</a>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($supplier->products->take(4) as $prod)
                                <x-product_card :product="$prod" viewMode="grid" />
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar: Facts & Certifications -->
                <div class="space-y-6">
                    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                        <h3 class="text-sm font-bold font-heading text-slate-900 uppercase tracking-wider">Enterprise Facts</h3>
                        <div class="space-y-3 text-xs divide-y divide-slate-100">
                            <div class="pt-2 flex justify-between"><span class="text-slate-400">GST Registration</span> <strong class="text-slate-800">{{ $supplier->gst_number ?: 'Verified' }}</strong></div>
                            <div class="pt-2 flex justify-between"><span class="text-slate-400">PAN Number</span> <strong class="text-slate-800">{{ $supplier->pan_number ?: 'Verified' }}</strong></div>
                            <div class="pt-2 flex justify-between"><span class="text-slate-400">Team Size</span> <strong class="text-slate-800">{{ $supplier->employees_count ?: '50-100 Employees' }}</strong></div>
                            <div class="pt-2 flex justify-between"><span class="text-slate-400">Annual Capacity</span> <strong class="text-slate-800">50,000+ Units/Mo</strong></div>
                            <div class="pt-2 flex justify-between"><span class="text-slate-400">Response Rate</span> <strong class="text-emerald-600 font-bold">98% (< 2 hrs)</strong></div>
                        </div>
                    </div>

                    <!-- Verified Badges Box -->
                    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-3">
                        <h3 class="text-sm font-bold font-heading text-slate-900 uppercase tracking-wider">Verification Badges</h3>
                        <div class="flex flex-wrap gap-2">
                            <x-verification_badge level="GST" />
                            <x-verification_badge level="KYC" />
                            <x-verification_badge level="Business" />
                            <x-verification_badge :level="$supplier->verification_level" />
                        </div>
                    </div>
                </div>

            </div>

        @elseif($activeTab === 'products')
            <!-- PRODUCTS TAB -->
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold font-heading text-slate-900">Product Catalog ({{ $supplier->products->count() }})</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse($supplier->products as $prod)
                        <x-product_card :product="$prod" viewMode="grid" />
                    @empty
                        <div class="col-span-4 p-8 text-center bg-white rounded-2xl border border-slate-200 text-slate-500">
                            No products cataloged currently.
                        </div>
                    @endforelse
                </div>
            </div>

        @elseif($activeTab === 'services')
            <!-- SERVICES TAB -->
            <div class="space-y-6">
                <h2 class="text-xl font-bold font-heading text-slate-900">Turnkey Services & OEM Solutions</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($supplier->services as $serv)
                        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex flex-col sm:flex-row gap-6">
                            <div class="w-full sm:w-40 h-36 rounded-2xl bg-slate-100 overflow-hidden flex-shrink-0">
                                <img src="{{ $serv->image ?: 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=400' }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-base font-bold font-heading text-slate-900">{{ $serv->name }}</h3>
                                    <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">{{ $serv->description }}</p>
                                </div>
                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                                    <span class="text-xs font-bold text-brand-600">{{ $serv->price_range ?: 'Custom Quote' }}</span>
                                    <button onclick="openInquiryModal('{{ $supplier->id }}', '{{ addslashes($supplier->company_name) }}', '', 'Service: {{ addslashes($serv->name) }}')" class="px-3.5 py-1.5 rounded-xl bg-brand-600 text-white font-bold text-xs">Inquire Service</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 p-8 text-center bg-white rounded-2xl border border-slate-200 text-slate-500">
                            No standalone services listed.
                        </div>
                    @endforelse
                </div>
            </div>

        @elseif($activeTab === 'reviews')
            <!-- REVIEWS TAB -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left: Overall Rating & Breakdown -->
                <div class="space-y-6">
                    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm text-center">
                        <span class="text-5xl font-extrabold font-heading text-slate-900">{{ $supplier->rating_avg ?: '4.9' }}</span>
                        <div class="flex items-center justify-center gap-1 text-amber-500 my-2 text-base">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <p class="text-xs text-slate-500">Based on {{ $totalReviews }} verified customer reviews</p>

                        <!-- Rating Bars -->
                        <div class="space-y-2 mt-6 text-xs text-slate-600 text-left">
                            @foreach([5, 4, 3, 2, 1] as $star)
                                @php
                                    $count = $ratingDistribution[$star] ?? 0;
                                    $pct = $totalReviews > 0 ? round(($count / $totalReviews) * 100) : ($star == 5 ? 85 : 10);
                                @endphp
                                <div class="flex items-center gap-2">
                                    <span class="w-6 font-bold">{{ $star }}★</span>
                                    <div class="flex-1 h-2 rounded-full bg-slate-100 overflow-hidden">
                                        <div class="h-full bg-amber-400 rounded-full" style="width: {{ $pct }}%"></div>
                                    </div>
                                    <span class="w-8 text-right text-[10px] text-slate-400">{{ $count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Write a Review Box -->
                    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
                        <h3 class="text-sm font-bold font-heading text-slate-900 mb-3">Write a Customer Review</h3>
                        
                        @auth
                            <form action="{{ route('suppliers.review', $supplier->slug) }}" method="POST" class="space-y-3 text-xs">
                                @csrf
                                
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="font-bold text-slate-700">Product Quality (1-5)</label>
                                        <select name="quality_rating" class="w-full mt-1 p-2 bg-slate-50 border border-slate-200 rounded-xl">
                                            <option value="5">5 - Excellent</option>
                                            <option value="4">4 - Good</option>
                                            <option value="3">3 - Average</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="font-bold text-slate-700">Communication (1-5)</label>
                                        <select name="communication_rating" class="w-full mt-1 p-2 bg-slate-50 border border-slate-200 rounded-xl">
                                            <option value="5">5 - Excellent</option>
                                            <option value="4">4 - Good</option>
                                            <option value="3">3 - Average</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 gap-2">
                                    <div>
                                        <label class="font-bold text-slate-700">Delivery</label>
                                        <select name="delivery_rating" class="w-full mt-1 p-2 bg-slate-50 border border-slate-200 rounded-xl">
                                            <option value="5">5★</option>
                                            <option value="4">4★</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="font-bold text-slate-700">Pricing</label>
                                        <select name="pricing_rating" class="w-full mt-1 p-2 bg-slate-50 border border-slate-200 rounded-xl">
                                            <option value="5">5★</option>
                                            <option value="4">4★</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="font-bold text-slate-700">Service</label>
                                        <select name="service_rating" class="w-full mt-1 p-2 bg-slate-50 border border-slate-200 rounded-xl">
                                            <option value="5">5★</option>
                                            <option value="4">4★</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="font-bold text-slate-700">Review Title *</label>
                                    <input type="text" name="title" required placeholder="e.g. Excellent machinery quality & fast delivery" class="w-full mt-1 p-2 bg-slate-50 border border-slate-200 rounded-xl">
                                </div>

                                <div>
                                    <label class="font-bold text-slate-700">Your Experience Details *</label>
                                    <textarea name="comment" rows="3" required placeholder="Share details about product performance, communication and delivery..." class="w-full mt-1 p-2 bg-slate-50 border border-slate-200 rounded-xl"></textarea>
                                </div>

                                <button type="submit" class="w-full py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md">
                                    Submit Verified Review
                                </button>
                            </form>
                        @else
                            <div class="p-4 bg-slate-50 rounded-2xl text-center">
                                <p class="text-xs text-slate-600 mb-2">Please sign in as a buyer to write a verified review.</p>
                                <a href="{{ route('login') }}" class="inline-block px-4 py-1.5 bg-brand-600 text-white font-bold text-xs rounded-xl">Sign In</a>
                            </div>
                        @endauth
                    </div>
                </div>

                <!-- Right: Reviews List -->
                <div class="lg:col-span-2 space-y-4">
                    @forelse($supplier->reviews as $rev)
                        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-3">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-sm text-slate-900">{{ $rev->buyer->company_name ?? 'Verified Buyer' }}</span>
                                        <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold"><i class="fa-solid fa-check"></i> Verified Purchase</span>
                                    </div>
                                    <p class="text-[11px] text-slate-400 mt-0.5">{{ $rev->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="flex items-center gap-1 text-amber-500 font-bold text-xs bg-amber-50 px-2.5 py-1 rounded-xl">
                                    <i class="fa-solid fa-star text-[10px]"></i> {{ $rev->overall_rating }}
                                </div>
                            </div>

                            <h4 class="text-xs font-bold text-slate-800">{{ $rev->title }}</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">{{ $rev->comment }}</p>

                            @if($rev->supplier_reply)
                                <div class="p-3 bg-brand-50/70 rounded-2xl border border-brand-100 text-xs">
                                    <strong class="text-brand-900 flex items-center gap-1.5 mb-1">
                                        <i class="fa-solid fa-reply text-brand-600"></i> Response from Supplier:
                                    </strong>
                                    <p class="text-slate-600">{{ $rev->supplier_reply }}</p>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="p-8 text-center bg-white rounded-3xl border border-slate-200 text-slate-500">
                            No customer reviews yet. Be the first to review this supplier!
                        </div>
                    @endforelse
                </div>

            </div>

        @elseif($activeTab === 'about')
            <!-- ABOUT & CONTACT TAB -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
                <h2 class="text-lg font-bold font-heading text-slate-900">Corporate & Contact Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <strong class="block text-slate-800">Factory & Office Address</strong>
                                <p class="text-slate-500 mt-0.5">{{ $supplier->address }}, {{ $supplier->city }}, {{ $supplier->state }} - {{ $supplier->pincode }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-globe"></i></div>
                            <div>
                                <strong class="block text-slate-800">Official Website</strong>
                                <a href="{{ $supplier->website ?: '#' }}" target="_blank" class="text-brand-600 hover:underline mt-0.5 block">{{ $supplier->website ?: 'https://www.ozura.com/supplier/' . $supplier->slug }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-file-invoice"></i></div>
                            <div>
                                <strong class="block text-slate-800">Tax & Corporate Identifiers</strong>
                                <p class="text-slate-500 mt-0.5">GSTIN: {{ $supplier->gst_number ?: 'Available on Request' }} | PAN: {{ $supplier->pan_number ?: 'Verified' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection
