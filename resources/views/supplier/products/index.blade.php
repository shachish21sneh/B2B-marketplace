@extends('layouts.dashboard')

@section('title', 'My Product Catalog - Supplier Dashboard')
@section('page_title', 'My Products Catalog')
@section('page_subtitle', 'Manage your wholesale listings, inventory, specifications and visibility.')

@section('content')

    <div class="space-y-6">
        
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold font-heading text-slate-900">Product Listings</h2>
            <a href="{{ route('supplier.products.create') }}" class="px-5 py-2.5 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-500/20 transition flex items-center gap-2">
                <i class="fa-solid fa-plus text-xs"></i> Add New Product
            </a>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 border-b border-slate-200 uppercase tracking-wider text-[10px]">
                            <th class="py-4 px-6 font-bold">Product</th>
                            <th class="py-4 px-4 font-bold">Category</th>
                            <th class="py-4 px-4 font-bold">Price & MOQ</th>
                            <th class="py-4 px-4 font-bold">Stock</th>
                            <th class="py-4 px-4 font-bold">Views</th>
                            <th class="py-4 px-4 font-bold">Status</th>
                            <th class="py-4 px-6 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($products as $prod)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden flex-shrink-0">
                                            <img src="{{ $prod->main_image }}" alt="{{ $prod->name }}" class="w-full h-full object-cover">
                                        </div>
                                        <div class="min-w-0">
                                            <a href="{{ route('products.show', $prod->slug) }}" target="_blank" class="font-bold text-slate-900 hover:text-brand-600 text-sm block truncate max-w-xs">
                                                {{ $prod->name }}
                                            </a>
                                            <span class="text-[10px] text-slate-400">SKU: {{ $prod->sku ?: 'N/A' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 font-semibold text-slate-600">{{ $prod->category->name ?? 'General' }}</td>
                                <td class="py-4 px-4">
                                    <div class="font-bold text-slate-900">₹{{ number_format($prod->price, 2) }}</div>
                                    <span class="text-[10px] text-slate-400">MOQ: {{ $prod->moq }} {{ $prod->price_unit }}s</span>
                                </td>
                                <td class="py-4 px-4 font-bold text-emerald-600">{{ number_format($prod->stock_qty) }}</td>
                                <td class="py-4 px-4 font-semibold text-slate-600">{{ number_format($prod->views_count) }}</td>
                                <td class="py-4 px-4">
                                    <form action="{{ route('supplier.products.toggle', $prod->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase transition {{ $prod->is_active ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                                            {{ $prod->is_active ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <a href="{{ route('supplier.products.edit', $prod->id) }}" class="px-3 py-1.5 bg-slate-100 hover:bg-brand-50 hover:text-brand-600 font-bold rounded-xl text-[11px] transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('supplier.products.destroy', $prod->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1.5 bg-slate-100 hover:bg-red-50 hover:text-red-600 font-bold rounded-xl text-[11px] transition">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    No products cataloged yet. Click "Add New Product" to start receiving buyer inquiries!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $products->links() }}
            </div>
        </div>

    </div>

@endsection
