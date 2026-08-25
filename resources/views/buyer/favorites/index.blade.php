@extends('layouts.dashboard')

@section('title', 'Saved Favorites - Buyer Dashboard')
@section('page_title', 'Saved Products & Suppliers')
@section('page_subtitle', 'Quick access to bookmarked machinery, products, and preferred vendors.')

@section('content')

    <div class="space-y-8">
        
        <!-- Saved Products Section -->
        <div class="space-y-4">
            <h2 class="text-base font-bold font-heading text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-heart text-red-500"></i> Saved Products ({{ $favoriteProducts->count() }})
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($favoriteProducts as $fav)
                    @if($fav->product)
                        <x-product_card :product="$fav->product" viewMode="grid" />
                    @endif
                @empty
                    <div class="col-span-4 p-8 text-center bg-white rounded-3xl border border-slate-200 text-slate-500 text-xs">
                        No products bookmarked yet. Browse catalog and click the wishlist button to save items!
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Saved Suppliers Section -->
        <div class="space-y-4 pt-4 border-t border-slate-200">
            <h2 class="text-base font-bold font-heading text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-building-circle-check text-brand-600"></i> Saved Verified Suppliers ({{ $favoriteSuppliers->count() }})
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($favoriteSuppliers as $fav)
                    @if($fav->supplier)
                        <x-supplier_card :supplier="$fav->supplier" />
                    @endif
                @empty
                    <div class="col-span-3 p-8 text-center bg-white rounded-3xl border border-slate-200 text-slate-500 text-xs">
                        No suppliers bookmarked yet.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

@endsection
