@props(['product', 'viewMode' => 'grid'])

@if($viewMode === 'list')
    <!-- LIST VIEW CARD -->
    <div class="bg-white rounded-2xl border border-slate-200 hover:border-brand-500 hover:shadow-xl transition-all duration-300 p-4 flex flex-col sm:flex-row gap-5 relative group overflow-hidden">
        
        @if($product->is_featured)
            <div class="absolute top-0 right-0 bg-amber-500 text-white text-[9px] font-bold uppercase px-3 py-0.5 rounded-bl-xl shadow-sm z-10">
                <i class="fa-solid fa-star text-[8px] mr-1"></i> Featured
            </div>
        @elseif($product->is_sponsored)
            <div class="absolute top-0 right-0 bg-brand-600 text-white text-[9px] font-bold uppercase px-3 py-0.5 rounded-bl-xl shadow-sm z-10">
                Sponsored
            </div>
        @endif

        <div class="w-full sm:w-48 h-48 rounded-xl overflow-hidden bg-slate-100 relative flex-shrink-0">
            <a href="{{ route('products.show', $product->slug) }}">
                <img src="{{ $product->main_image ?: 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600' }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600';">
            </a>
        </div>

        <div class="flex-1 flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-2 mb-1.5 flex-wrap">
                    @if($product->category)
                        <span class="text-[11px] font-bold uppercase tracking-wider text-brand-600 bg-brand-50 px-2.5 py-0.5 rounded-full">
                            {{ $product->category->name }}
                        </span>
                    @endif
                    @if($product->brand)
                        <span class="text-xs text-slate-400 font-medium">Brand: {{ $product->brand }}</span>
                    @endif
                </div>

                <a href="{{ route('products.show', $product->slug) }}" class="block text-base font-bold font-heading text-slate-900 hover:text-brand-600 transition leading-snug">
                    {{ $product->name }}
                </a>

                <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">
                    {{ $product->description }}
                </p>

                <!-- Supplier info snippet -->
                @if($product->supplier)
                    <div class="flex items-center gap-3 mt-3 pt-3 border-t border-slate-100 flex-wrap">
                        <a href="{{ route('suppliers.show', $product->supplier->slug) }}" class="text-xs font-bold text-slate-700 hover:text-brand-600 transition flex items-center gap-1.5">
                            <i class="fa-solid fa-building text-slate-400"></i>
                            <span>{{ $product->supplier->company_name }}</span>
                        </a>
                        <x-verification_badge :level="$product->supplier->verification_level" />
                        <span class="text-xs text-slate-400 flex items-center gap-1">
                            <i class="fa-solid fa-location-dot text-slate-400 text-[10px]"></i>
                            {{ $product->supplier->city }}, {{ $product->supplier->state }}
                        </span>
                    </div>
                @endif
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mt-4 pt-3 border-t border-slate-100">
                <div>
                    <div class="text-lg font-bold font-heading text-slate-900">
                        ₹{{ number_format($product->price, 2) }}
                        <span class="text-xs text-slate-500 font-normal">/ {{ $product->price_unit }}</span>
                    </div>
                    <span class="text-[11px] text-slate-500 font-medium">MOQ: {{ $product->moq }} {{ $product->price_unit }}s</span>
                </div>

                <div class="flex items-center gap-2">
                    <button 
                        type="button"
                        onclick="openInquiryModal('{{ $product->supplier_id }}', '{{ addslashes($product->supplier->company_name ?? '') }}', '{{ $product->id }}', '{{ addslashes($product->name) }}', '{{ $product->main_image }}')"
                        class="px-4 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-md shadow-brand-500/20 transition flex items-center gap-1.5"
                    >
                        <i class="fa-solid fa-paper-plane text-[10px]"></i> Send Inquiry
                    </button>
                    @if($product->supplier)
                        <a href="https://wa.me/?text=Inquiry%20for%20{{ urlencode($product->name) }}" target="_blank" class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition text-sm">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>

    </div>
@else
    <!-- GRID VIEW CARD -->
    <div class="bg-white rounded-2xl border border-slate-200 hover:border-brand-500 hover:shadow-xl transition-all duration-300 flex flex-col justify-between relative group overflow-hidden">
        
        @if($product->is_featured)
            <div class="absolute top-3 right-3 bg-amber-500 text-white text-[9px] font-bold uppercase px-2.5 py-0.5 rounded-full shadow-md z-10 flex items-center gap-1">
                <i class="fa-solid fa-star text-[8px]"></i> Featured
            </div>
        @elseif($product->is_sponsored)
            <div class="absolute top-3 right-3 bg-brand-600 text-white text-[9px] font-bold uppercase px-2.5 py-0.5 rounded-full shadow-md z-10">
                Sponsored
            </div>
        @endif

        <div>
            <!-- Image Area -->
            <div class="w-full h-48 rounded-t-2xl overflow-hidden bg-slate-100 relative">
                <a href="{{ route('products.show', $product->slug) }}">
                    <img src="{{ $product->main_image ?: 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600' }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600';">
                </a>
            </div>

            <!-- Content Area -->
            <div class="p-4">
                <div class="flex items-center justify-between gap-2 mb-1.5">
                    @if($product->category)
                        <span class="text-[10px] font-bold uppercase tracking-wider text-brand-600 bg-brand-50 px-2 py-0.5 rounded-md">
                            {{ $product->category->name }}
                        </span>
                    @endif
                    @if($product->supplier)
                        <x-verification_badge :level="$product->supplier->verification_level" />
                    @endif
                </div>

                <a href="{{ route('products.show', $product->slug) }}" class="block text-sm font-bold font-heading text-slate-900 hover:text-brand-600 transition line-clamp-2 leading-snug">
                    {{ $product->name }}
                </a>

                <!-- Price & MOQ -->
                <div class="mt-3">
                    <div class="text-base font-bold font-heading text-slate-900">
                        ₹{{ number_format($product->price, 2) }}
                        <span class="text-xs text-slate-500 font-normal">/ {{ $product->price_unit }}</span>
                    </div>
                    <span class="text-[11px] text-slate-500 font-medium">MOQ: {{ $product->moq }} {{ $product->price_unit }}s</span>
                </div>

                <!-- Supplier Info -->
                @if($product->supplier)
                    <div class="mt-3 pt-3 border-t border-slate-100">
                        <a href="{{ route('suppliers.show', $product->supplier->slug) }}" class="text-xs font-bold text-slate-700 hover:text-brand-600 transition truncate block">
                            {{ $product->supplier->company_name }}
                        </a>
                        <div class="flex items-center justify-between text-[11px] text-slate-400 mt-1">
                            <span class="truncate flex items-center gap-1">
                                <i class="fa-solid fa-location-dot text-[10px]"></i> {{ $product->supplier->city }}
                            </span>
                            @if($product->supplier->rating_avg > 0)
                                <span class="text-amber-500 font-bold flex items-center gap-1">
                                    <i class="fa-solid fa-star text-[9px]"></i> {{ $product->supplier->rating_avg }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="p-4 pt-0">
            <button 
                type="button"
                onclick="openInquiryModal('{{ $product->supplier_id }}', '{{ addslashes($product->supplier->company_name ?? '') }}', '{{ $product->id }}', '{{ addslashes($product->name) }}', '{{ $product->main_image }}')"
                class="w-full py-2 rounded-xl bg-brand-50 hover:bg-brand-600 text-brand-700 hover:text-white text-xs font-bold transition flex items-center justify-center gap-2 group-hover:bg-brand-600 group-hover:text-white"
            >
                <i class="fa-solid fa-paper-plane text-[10px]"></i> Send Inquiry
            </button>
        </div>

    </div>
@endif
