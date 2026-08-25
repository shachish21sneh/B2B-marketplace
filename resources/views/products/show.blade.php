@extends('layouts.app')

@section('title', $product->name . ' - Buy Wholesale at Best Price | Ozura')
@section('meta_description', Str::limit(strip_tags($product->description), 160))
@section('meta_keywords', $product->name . ', ' . ($product->brand ? $product->brand . ', ' : '') . ($product->category ? $product->category->name . ', ' : '') . 'wholesale supplier, manufacturer price')

@push('styles')
<script type="application/ld+json">
{
  "@@context": "https://schema.org/",
  "@@type": "Product",
  "name": "{{ $product->name }}",
  "image": [
    "{{ $product->main_image }}"
  ],
  "description": "{{ Str::limit(strip_tags($product->description), 200) }}",
  "sku": "{{ $product->sku ?: 'SKU-' . $product->id }}",
  "brand": {
    "@@type": "Brand",
    "name": "{{ $product->brand ?: ($product->supplier ? $product->supplier->company_name : 'Ozura') }}"
  },
  "offers": {
    "@@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "INR",
    "price": "{{ $product->price }}",
    "itemCondition": "https://schema.org/NewCondition",
    "availability": "https://schema.org/InStock",
    "seller": {
      "@@type": "Organization",
      "name": "{{ $product->supplier ? $product->supplier->company_name : 'Verified Supplier' }}"
    }
  }
}
</script>
@endpush

@section('content')

    <!-- Breadcrumb Header -->
    <div class="bg-white border-b border-slate-200 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-brand-600">Home</a>
                <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                <a href="{{ route('products.index') }}" class="hover:text-brand-600">Products</a>
                @if($product->category)
                    <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                    <a href="{{ route('category.show', $product->category->slug) }}" class="hover:text-brand-600">{{ $product->category->name }}</a>
                @endif
                <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                <span class="text-slate-800 font-semibold truncate max-w-xs">{{ $product->name }}</span>
            </nav>
        </div>
    </div>

    <!-- Main Product Details Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- LEFT: GALLERY & SPECS (8 COLS) -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Main Product Card: Gallery + Core Info -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- Product Gallery -->
                        <div>
                            <div class="w-full h-80 rounded-2xl overflow-hidden bg-slate-100 border border-slate-200 relative">
                                <img id="mainProductImage" src="{{ $product->main_image ?: 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800' }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @if($product->is_featured)
                                    <span class="absolute top-3 left-3 bg-amber-500 text-white text-[10px] font-bold uppercase px-3 py-1 rounded-full shadow-md">
                                        <i class="fa-solid fa-star text-[9px] mr-1"></i> Featured Product
                                    </span>
                                @endif
                            </div>

                            @if($product->images && $product->images->count() > 1)
                                <div class="flex items-center gap-3 mt-4 overflow-x-auto pb-2">
                                    @foreach($product->images as $img)
                                        <button type="button" onclick="document.getElementById('mainProductImage').src='{{ $img->image_path }}'" class="w-16 h-16 rounded-xl border-2 border-slate-200 hover:border-brand-600 overflow-hidden flex-shrink-0 transition">
                                            <img src="{{ $img->image_path }}" class="w-full h-full object-cover">
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Core Details -->
                        <div class="flex flex-col justify-between space-y-4">
                            <div>
                                <div class="flex items-center gap-2 mb-2">
                                    @if($product->category)
                                        <span class="text-xs font-bold uppercase tracking-wider text-brand-600 bg-brand-50 px-2.5 py-0.5 rounded-full">
                                            {{ $product->category->name }}
                                        </span>
                                    @endif
                                    @if($product->brand)
                                        <span class="text-xs text-slate-500 font-semibold">Brand: {{ $product->brand }}</span>
                                    @endif
                                </div>

                                <h1 class="text-xl sm:text-2xl font-extrabold font-heading text-slate-900 leading-tight">
                                    {{ $product->name }}
                                </h1>

                                @if($product->sku)
                                    <p class="text-xs text-slate-400 mt-1">SKU: <strong class="text-slate-600">{{ $product->sku }}</strong></p>
                                @endif

                                <!-- Pricing Box -->
                                <div class="mt-4 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                                    <div class="flex items-baseline gap-2">
                                        <span class="text-3xl font-extrabold font-heading text-slate-900">₹{{ number_format($product->price, 2) }}</span>
                                        <span class="text-sm text-slate-500 font-semibold">/ {{ $product->price_unit }}</span>
                                    </div>
                                    <div class="flex items-center gap-4 mt-2 text-xs text-slate-600">
                                        <span>MOQ: <strong class="text-slate-900">{{ $product->moq }} {{ $product->price_unit }}s</strong></span>
                                        <span>•</span>
                                        <span>Stock: <strong class="text-emerald-600">{{ number_format($product->stock_qty) }} In Stock</strong></span>
                                    </div>
                                </div>

                                <!-- Quick Highlight Badges -->
                                <div class="grid grid-cols-2 gap-2 mt-4 text-xs text-slate-600">
                                    <div class="flex items-center gap-2 p-2 rounded-xl bg-slate-50">
                                        <i class="fa-solid fa-truck-fast text-brand-600"></i>
                                        <span>Fast Dispatch</span>
                                    </div>
                                    <div class="flex items-center gap-2 p-2 rounded-xl bg-slate-50">
                                        <i class="fa-solid fa-shield-check text-emerald-600"></i>
                                        <span>Verified Quality</span>
                                    </div>
                                </div>
                            </div>

                            <!-- CTAs -->
                            <div class="space-y-2 pt-2">
                                <button 
                                    type="button" 
                                    onclick="openInquiryModal('{{ $product->supplier_id }}', '{{ addslashes($product->supplier ? $product->supplier->company_name : 'Supplier') }}', '{{ $product->id }}', '{{ addslashes($product->name) }}', '{{ $product->main_image }}')"
                                    class="w-full py-3.5 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm shadow-lg shadow-brand-500/25 transition flex items-center justify-center gap-2"
                                >
                                    <i class="fa-solid fa-paper-plane"></i> Send Product Inquiry
                                </button>
                                <div class="grid grid-cols-2 gap-2">
                                    <a href="https://wa.me/?text=Inquiry%20for%20{{ urlencode($product->name) }}%20at%20{{ url()->current() }}" target="_blank" class="py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs text-center transition flex items-center justify-center gap-1.5">
                                        <i class="fa-brands fa-whatsapp text-sm"></i> WhatsApp
                                    </a>
                                    <form action="{{ route('favorites.toggle') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="w-full py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition flex items-center justify-center gap-1.5">
                                            <i class="fa-solid fa-heart text-red-500"></i> Save Wishlist
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- Product Specifications Table -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                    <h2 class="text-lg font-bold font-heading text-slate-900 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-list-check text-brand-600"></i> Product Specifications
                    </h2>

                    @if($product->specifications && is_array($product->specifications))
                        <div class="rounded-2xl border border-slate-200 overflow-hidden divide-y divide-slate-100 text-xs">
                            @foreach($product->specifications as $spec)
                                <div class="grid grid-cols-3 p-3.5 {{ $loop->even ? 'bg-slate-50/60' : 'bg-white' }}">
                                    <span class="font-bold text-slate-600">{{ $spec['key'] ?? '' }}</span>
                                    <span class="col-span-2 text-slate-900 font-medium">{{ $spec['value'] ?? '' }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="rounded-2xl border border-slate-200 overflow-hidden divide-y divide-slate-100 text-xs">
                            <div class="grid grid-cols-3 p-3.5 bg-slate-50/60">
                                <span class="font-bold text-slate-600">Brand</span>
                                <span class="col-span-2 text-slate-900 font-medium">{{ $product->brand ?: 'Standard OEM' }}</span>
                            </div>
                            <div class="grid grid-cols-3 p-3.5 bg-white">
                                <span class="font-bold text-slate-600">Minimum Order Quantity</span>
                                <span class="col-span-2 text-slate-900 font-medium">{{ $product->moq }} {{ $product->price_unit }}</span>
                            </div>
                            <div class="grid grid-cols-3 p-3.5 bg-slate-50/60">
                                <span class="font-bold text-slate-600">Delivery Location</span>
                                <span class="col-span-2 text-slate-900 font-medium">Pan India & Global Export</span>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Product Description & Features -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
                    <div>
                        <h2 class="text-lg font-bold font-heading text-slate-900 mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-align-left text-brand-600"></i> Product Description
                        </h2>
                        <div class="text-sm text-slate-600 leading-relaxed space-y-3 whitespace-pre-line">
                            {{ $product->description }}
                        </div>
                    </div>

                    @if($product->features)
                        <div class="pt-4 border-t border-slate-100">
                            <h3 class="text-sm font-bold font-heading text-slate-900 mb-2">Key Features & Benefits</h3>
                            <div class="text-xs text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50 p-4 rounded-2xl border border-slate-200">
                                {{ $product->features }}
                            </div>
                        </div>
                    @endif

                    <!-- Packaging, Delivery & Payment Terms Grid -->
                    <div class="pt-4 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                            <h4 class="font-bold text-slate-900 flex items-center gap-1.5 mb-1">
                                <i class="fa-solid fa-box text-brand-600"></i> Packaging
                            </h4>
                            <p class="text-slate-500 leading-relaxed">{{ $product->packaging_details ?: 'Export standard packaging in corrugated cartons or wooden crates.' }}</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                            <h4 class="font-bold text-slate-900 flex items-center gap-1.5 mb-1">
                                <i class="fa-solid fa-truck text-brand-600"></i> Delivery Info
                            </h4>
                            <p class="text-slate-500 leading-relaxed">{{ $product->delivery_info ?: 'Dispatched within 3-7 business days across India.' }}</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                            <h4 class="font-bold text-slate-900 flex items-center gap-1.5 mb-1">
                                <i class="fa-solid fa-credit-card text-brand-600"></i> Payment Terms
                            </h4>
                            <p class="text-slate-500 leading-relaxed">{{ $product->payment_terms ?: 'LC, Bank Transfer, RTGS, 100% Advance or Net 30.' }}</p>
                        </div>
                    </div>

                </div>

            </div>

            <!-- RIGHT: STICKY SUPPLIER PROFILE BOX (4 COLS) -->
            <div class="lg:col-span-4 space-y-6">
                
                @if($product->supplier)
                    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm sticky top-28 space-y-5">
                        
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Sold By Supplier</span>
                            <div class="flex items-start gap-4 mt-2">
                                <div class="w-16 h-16 rounded-2xl bg-slate-50 border border-slate-200 overflow-hidden flex-shrink-0">
                                    <img src="{{ $product->supplier->logo ?: 'https://images.unsplash.com/photo-1560179707-f14e90ef3623?w=200' }}" alt="{{ $product->supplier->company_name }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h3 class="text-base font-bold font-heading text-slate-900 leading-snug">
                                        <a href="{{ route('suppliers.show', $product->supplier->slug) }}" class="hover:text-brand-600 transition">{{ $product->supplier->company_name }}</a>
                                    </h3>
                                    <div class="mt-1">
                                        <x-verification_badge :level="$product->supplier->verification_level" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Trust info list -->
                        <div class="space-y-2.5 pt-3 border-t border-slate-100 text-xs text-slate-600">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Business Type</span>
                                <span class="font-bold text-slate-800">{{ $product->supplier->business_type }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Location</span>
                                <span class="font-bold text-slate-800">{{ $product->supplier->city }}, {{ $product->supplier->state }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Year Established</span>
                                <span class="font-bold text-slate-800">{{ $product->supplier->year_established ?: '2012' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">GST Verification</span>
                                <span class="font-bold text-emerald-600 flex items-center gap-1">
                                    <i class="fa-solid fa-check"></i> {{ $product->supplier->gst_number ? 'GST Verified' : 'Registered' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Rating & Reviews</span>
                                <span class="font-bold text-amber-500 flex items-center gap-1">
                                    <i class="fa-solid fa-star"></i> {{ $product->supplier->rating_avg ?: '4.9' }} ({{ $product->supplier->reviews_count }} reviews)
                                </span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="pt-3 border-t border-slate-100 space-y-2.5">
                            <button 
                                type="button" 
                                onclick="openInquiryModal('{{ $product->supplier_id }}', '{{ addslashes($product->supplier->company_name) }}', '{{ $product->id }}', '{{ addslashes($product->name) }}', '{{ $product->main_image }}')"
                                class="w-full py-3 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-500/20 transition flex items-center justify-center gap-2"
                            >
                                <i class="fa-solid fa-paper-plane text-xs"></i> Contact Supplier
                            </button>
                            <a href="{{ route('suppliers.show', $product->supplier->slug) }}" class="block w-full py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs text-center transition">
                                View Supplier Storefront
                            </a>
                        </div>

                    </div>
                @endif

            </div>

        </div>

        <!-- SIMILAR PRODUCTS SECTION -->
        @if($similarProducts && $similarProducts->isNotEmpty())
            <div class="mt-16 pt-12 border-t border-slate-200">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold font-heading text-slate-900">Similar Wholesale Products</h3>
                    @if($product->category)
                        <a href="{{ route('category.show', $product->category->slug) }}" class="text-xs font-bold text-brand-600 hover:underline">View More</a>
                    @endif
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($similarProducts as $sim)
                        <x-product_card :product="$sim" viewMode="grid" />
                    @endforeach
                </div>
            </div>
        @endif

    </div>

@endsection
