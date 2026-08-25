@extends('layouts.app')

@section('title', 'Verified Manufacturers & B2B Suppliers Directory - Ozura')
@section('meta_description', 'Discover top verified manufacturers, exporters, wholesalers and distributors across India. Connect directly and request quotations.')

@section('content')

    <!-- Header Banner -->
    <div class="bg-white border-b border-slate-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-900">
                Verified B2B Suppliers & Manufacturers Directory
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Connect directly with authentic manufacturers and authorized distributors across all industrial hubs.</p>
        </div>
    </div>

    <!-- Main Directory Layout -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Search & Filter Bar -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 mb-8 shadow-sm">
            <form action="{{ route('suppliers.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Search Company</label>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Supplier name or product..." class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">City Hub</label>
                    <select name="city" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                        <option value="">All Cities</option>
                        @foreach($cities as $c)
                            <option value="{{ $c->city }}" {{ request('city') == $c->city ? 'selected' : '' }}>{{ $c->city }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Business Type</label>
                    <select name="business_type" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                        <option value="">All Business Types</option>
                        <option value="Manufacturer" {{ request('business_type') == 'Manufacturer' ? 'selected' : '' }}>Manufacturer</option>
                        <option value="Wholesaler" {{ request('business_type') == 'Wholesaler' ? 'selected' : '' }}>Wholesaler</option>
                        <option value="Distributor" {{ request('business_type') == 'Distributor' ? 'selected' : '' }}>Distributor</option>
                        <option value="Trader" {{ request('business_type') == 'Trader' ? 'selected' : '' }}>Trader / Exporter</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-500/20 transition">
                        Filter Suppliers
                    </button>
                    <a href="{{ route('suppliers.index') }}" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition">
                        Reset
                    </a>
                </div>

            </form>
        </div>

        <!-- Supplier Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($suppliers as $supplier)
                <x-supplier_card :supplier="$supplier" />
            @empty
                <div class="col-span-3 bg-white rounded-3xl p-12 text-center border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-800">No suppliers found matching your query</h3>
                    <p class="text-xs text-slate-500 mt-1">Try broadening your search or city filter.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $suppliers->links() }}
        </div>

    </div>

@endsection
