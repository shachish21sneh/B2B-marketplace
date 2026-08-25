@props(['supplier'])

<div class="bg-white rounded-2xl border border-slate-200 hover:border-brand-500 hover:shadow-xl transition-all duration-300 p-5 flex flex-col justify-between relative group">
    
    <div>
        <!-- Top header: Logo + Badges -->
        <div class="flex items-start justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 rounded-2xl bg-slate-50 border border-slate-200 overflow-hidden flex-shrink-0 flex items-center justify-center">
                    <img src="{{ $supplier->logo ?: 'https://images.unsplash.com/photo-1560179707-f14e90ef3623?w=200' }}" alt="{{ $supplier->company_name }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <h3 class="text-sm font-bold font-heading text-slate-900 group-hover:text-brand-600 transition leading-snug">
                        <a href="{{ route('suppliers.show', $supplier->slug) }}">{{ $supplier->company_name }}</a>
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $supplier->business_type }} • {{ $supplier->city }}, {{ $supplier->state }}</p>
                </div>
            </div>
            <x-verification_badge :level="$supplier->verification_level" />
        </div>

        <p class="text-xs text-slate-500 mt-3 line-clamp-2 leading-relaxed">
            {{ $supplier->description }}
        </p>

        <!-- Metrics pills -->
        <div class="grid grid-cols-3 gap-2 mt-4 py-3 px-3 bg-slate-50 rounded-xl text-center border border-slate-100">
            <div>
                <span class="block text-[10px] text-slate-400 font-semibold uppercase">Rating</span>
                <span class="text-xs font-bold text-amber-600 flex items-center justify-center gap-1">
                    <i class="fa-solid fa-star text-[9px]"></i> {{ $supplier->rating_avg ?: '4.8' }}
                </span>
            </div>
            <div>
                <span class="block text-[10px] text-slate-400 font-semibold uppercase">Est. Year</span>
                <span class="text-xs font-bold text-slate-800">{{ $supplier->year_established ?: '2010' }}</span>
            </div>
            <div>
                <span class="block text-[10px] text-slate-400 font-semibold uppercase">Catalog</span>
                <span class="text-xs font-bold text-brand-600">{{ $supplier->products_count ?? $supplier->products()->count() }} items</span>
            </div>
        </div>

        <!-- Sample Products thumbs -->
        @if($supplier->products && $supplier->products->isNotEmpty())
            <div class="mt-4">
                <p class="text-[10px] uppercase font-bold text-slate-400 mb-2">Key Products</p>
                <div class="flex items-center gap-2">
                    @foreach($supplier->products->take(3) as $prod)
                        <a href="{{ route('products.show', $prod->slug) }}" title="{{ $prod->name }}" class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden hover:opacity-80 transition flex-shrink-0">
                            <img src="{{ $prod->main_image }}" alt="{{ $prod->name }}" class="w-full h-full object-cover">
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Actions -->
    <div class="flex items-center gap-2 mt-5 pt-3 border-t border-slate-100">
        <a href="{{ route('suppliers.show', $supplier->slug) }}" class="flex-1 py-2 rounded-xl bg-brand-50 hover:bg-brand-600 text-brand-700 hover:text-white text-xs font-bold text-center transition">
            View Profile
        </a>
        <button 
            type="button" 
            onclick="openInquiryModal('{{ $supplier->id }}', '{{ addslashes($supplier->company_name) }}')"
            class="px-3.5 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold transition flex items-center gap-1"
        >
            <i class="fa-solid fa-paper-plane text-[10px]"></i> Contact
        </button>
    </div>

</div>
