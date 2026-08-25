@extends('layouts.dashboard')

@section('title', 'Edit Product - ' . $product->name)
@section('page_title', 'Edit Product Listing')
@section('page_subtitle', 'Update wholesale specifications, pricing and stock availability.')

@section('content')

    <div class="max-w-4xl">
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-10 shadow-sm">
            
            <form action="{{ route('supplier.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Section 1: Basic Product Information -->
                <div>
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3 mb-4">
                        1. Product Identity & Category
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Product Title *</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Primary Category *</label>
                            <select name="category_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Brand Name</label>
                            <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">SKU / Model Number</label>
                            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Main Image URL / Upload</label>
                            <input type="text" name="main_image" value="{{ old('main_image', $product->main_image) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            <input type="file" name="image_file" accept="image/*" class="mt-2 text-xs text-slate-500">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Pricing & Inventory -->
                <div>
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3 mb-4">
                        2. Wholesale Pricing & Stock
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Price (₹) *</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Price Unit *</label>
                            <select name="price_unit" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                                <option value="Piece" {{ $product->price_unit == 'Piece' ? 'selected' : '' }}>Piece</option>
                                <option value="Set" {{ $product->price_unit == 'Set' ? 'selected' : '' }}>Set</option>
                                <option value="Metric Ton" {{ $product->price_unit == 'Metric Ton' ? 'selected' : '' }}>Metric Ton</option>
                                <option value="Kg" {{ $product->price_unit == 'Kg' ? 'selected' : '' }}>Kg</option>
                                <option value="Box" {{ $product->price_unit == 'Box' ? 'selected' : '' }}>Box</option>
                                <option value="Meter" {{ $product->price_unit == 'Meter' ? 'selected' : '' }}>Meter</option>
                                <option value="Liter" {{ $product->price_unit == 'Liter' ? 'selected' : '' }}>Liter</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Minimum Order Qty (MOQ) *</label>
                            <input type="number" name="moq" value="{{ old('moq', $product->moq) }}" min="1" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Stock Quantity *</label>
                            <input type="number" name="stock_qty" value="{{ old('stock_qty', $product->stock_qty) }}" min="0" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Payment Terms</label>
                            <input type="text" name="payment_terms" value="{{ old('payment_terms', $product->payment_terms) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Specifications -->
                <div>
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                        <h3 class="text-base font-bold font-heading text-slate-900">
                            3. Key Technical Specifications
                        </h3>
                        <button type="button" onclick="addSpecRow()" class="px-3 py-1 bg-brand-50 hover:bg-brand-100 text-brand-700 font-bold text-xs rounded-xl transition flex items-center gap-1">
                            <i class="fa-solid fa-plus text-[10px]"></i> Add Specification Row
                        </button>
                    </div>

                    <div id="specsContainer" class="space-y-3">
                        @if($product->specifications && is_array($product->specifications))
                            @foreach($product->specifications as $spec)
                                <div class="grid grid-cols-12 gap-3 items-center spec-row">
                                    <div class="col-span-5">
                                        <input type="text" name="spec_keys[]" value="{{ $spec['key'] ?? '' }}" placeholder="Attribute" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                                    </div>
                                    <div class="col-span-6">
                                        <input type="text" name="spec_values[]" value="{{ $spec['value'] ?? '' }}" placeholder="Value" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                                    </div>
                                    <div class="col-span-1 text-center">
                                        <button type="button" onclick="this.closest('.spec-row').remove()" class="text-slate-400 hover:text-red-500 text-xs"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Section 4: Description -->
                <div>
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3 mb-4">
                        4. Product Description
                    </h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Detailed Description *</label>
                            <textarea name="description" rows="4" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <a href="{{ route('supplier.products') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 font-bold text-xs rounded-xl">Cancel</a>
                    <button type="submit" class="px-8 py-3.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm rounded-2xl shadow-lg shadow-brand-500/25 transition">
                        Update Product
                    </button>
                </div>

            </form>

        </div>
    </div>

    <script>
        function addSpecRow() {
            const container = document.getElementById('specsContainer');
            const row = document.createElement('div');
            row.className = 'grid grid-cols-12 gap-3 items-center spec-row';
            row.innerHTML = `
                <div class="col-span-5">
                    <input type="text" name="spec_keys[]" placeholder="Attribute" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                </div>
                <div class="col-span-6">
                    <input type="text" name="spec_values[]" placeholder="Value" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                </div>
                <div class="col-span-1 text-center">
                    <button type="button" onclick="this.closest('.spec-row').remove()" class="text-slate-400 hover:text-red-500 text-xs"><i class="fa-solid fa-trash"></i></button>
                </div>
            `;
            container.appendChild(row);
        }
    </script>

@endsection
