@extends('layouts.dashboard')

@section('title', 'Product Catalog Moderation - Super Admin')
@section('page_title', 'Product Catalog Moderation')
@section('page_subtitle', 'Audit catalog listings, toggle featured status and moderate wholesale products.')

@section('content')

    <div class="space-y-6">
        
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 border-b border-slate-200 uppercase tracking-wider text-[10px]">
                            <th class="py-4 px-6 font-bold">Product</th>
                            <th class="py-4 px-4 font-bold">Supplier</th>
                            <th class="py-4 px-4 font-bold">Category</th>
                            <th class="py-4 px-4 font-bold">Price & MOQ</th>
                            <th class="py-4 px-4 font-bold">Featured</th>
                            <th class="py-4 px-4 font-bold">Status</th>
                            <th class="py-4 px-6 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($products as $prod)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $prod->main_image }}" class="w-10 h-10 rounded-xl object-cover border border-slate-200 flex-shrink-0">
                                        <div class="min-w-0">
                                            <a href="{{ route('products.show', $prod->slug) }}" target="_blank" class="font-bold text-slate-900 hover:text-brand-600 truncate max-w-xs block">
                                                {{ $prod->name }}
                                            </a>
                                            <span class="text-[10px] text-slate-400">SKU: {{ $prod->sku ?: 'N/A' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 font-semibold text-slate-800">{{ $prod->supplier->company_name ?? 'Supplier' }}</td>
                                <td class="py-4 px-4 text-slate-600">{{ $prod->category->name ?? 'General' }}</td>
                                <td class="py-4 px-4">
                                    <div class="font-bold text-slate-900">₹{{ number_format($prod->price, 2) }}</div>
                                    <span class="text-[10px] text-slate-400">MOQ: {{ $prod->moq }}</span>
                                </td>
                                <td class="py-4 px-4">
                                    <form action="{{ route('admin.products.featured', $prod->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $prod->is_featured ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-500' }}">
                                            <i class="fa-solid fa-star text-[9px] mr-1"></i> {{ $prod->is_featured ? 'Featured' : 'Standard' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $prod->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $prod->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this product permanently?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1.5 bg-slate-100 hover:bg-red-50 hover:text-red-600 rounded-xl font-bold text-xs transition">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">No products found.</td>
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
