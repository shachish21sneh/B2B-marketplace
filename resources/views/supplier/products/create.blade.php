@extends('layouts.dashboard')

@section('title', 'Add New Product - Supplier Dashboard')
@section('page_title', 'Add New Product / Machinery')
@section('page_subtitle', 'List your wholesale product with rich specifications and pricing.')

@section('content')

    <div class="max-w-4xl">
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-10 shadow-sm">
            
            <form action="{{ route('supplier.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Section 1: Basic Product Information -->
                <div>
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3 mb-4">
                        1. Product Identity & Category
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Product Title *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. UltraPrecision CNC Lathe Machine 3000 RPM" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Primary Category *</label>
                            <select name="category_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Brand Name</label>
                            <input type="text" name="brand" value="{{ old('brand', $supplier->company_name) }}" placeholder="e.g. Apex Industrial" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">SKU / Model Number</label>
                            <input type="text" name="sku" value="{{ old('sku') }}" placeholder="e.g. APX-CNC-3000" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Product Main Image URL / Upload</label>
                            <input type="text" name="main_image" value="{{ old('main_image') }}" placeholder="https://... or choose file below" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            <input type="file" name="image_file" accept="image/*" class="mt-2 text-xs text-slate-500">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Pricing & Inventory -->
                <div>
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3 mb-4">
                        2. Wholesale Pricing & Minimum Order Quantity
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Price (₹) *</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" required placeholder="10000.00" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Price Unit *</label>
                            <select name="price_unit" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                                <option value="Piece">Piece</option>
                                <option value="Set">Set</option>
                                <option value="Metric Ton">Metric Ton</option>
                                <option value="Kg">Kg</option>
                                <option value="Box">Box</option>
                                <option value="Meter">Meter</option>
                                <option value="Liter">Liter</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Minimum Order Qty (MOQ) *</label>
                            <input type="number" name="moq" value="{{ old('moq', 1) }}" min="1" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Available Stock Quantity *</label>
                            <input type="number" name="stock_qty" value="{{ old('stock_qty', 100) }}" min="0" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Accepted Payment Terms</label>
                            <input type="text" name="payment_terms" value="{{ old('payment_terms', '100% LC at Sight / 30% Advance, RTGS') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Dynamic Specifications Builder -->
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
                        <div class="grid grid-cols-12 gap-3 items-center spec-row">
                            <div class="col-span-5">
                                <input type="text" name="spec_keys[]" value="Material" placeholder="Attribute (e.g. Material)" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                            </div>
                            <div class="col-span-6">
                                <input type="text" name="spec_values[]" value="Grade 304 Stainless Steel" placeholder="Value (e.g. Stainless Steel 304)" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                            </div>
                            <div class="col-span-1 text-center">
                                <button type="button" onclick="this.closest('.spec-row').remove()" class="text-slate-400 hover:text-red-500 text-xs"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-3 items-center spec-row">
                            <div class="col-span-5">
                                <input type="text" name="spec_keys[]" value="Warranty" placeholder="Attribute (e.g. Warranty)" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                            </div>
                            <div class="col-span-6">
                                <input type="text" name="spec_values[]" value="2 Years Comprehensive" placeholder="Value" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                            </div>
                            <div class="col-span-1 text-center">
                                <button type="button" onclick="this.closest('.spec-row').remove()" class="text-slate-400 hover:text-red-500 text-xs"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Descriptions & Packaging -->
                <div>
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3 mb-4">
                        4. Product Description & Packaging Logistics
                    </h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Detailed Description *</label>
                            <textarea name="description" rows="4" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none" placeholder="Provide complete technical and functional description of this product...">{{ old('description') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Packaging Details</label>
                                <input type="text" name="packaging_details" value="{{ old('packaging_details', 'Export standard wooden crate / vacuum bubble packed.') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Delivery Lead Time</label>
                                <input type="text" name="delivery_info" value="{{ old('delivery_info', 'Dispatched within 3-5 business days.') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <a href="{{ route('supplier.products') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 font-bold text-xs rounded-xl">Cancel</a>
                    <button type="submit" class="px-8 py-3.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm rounded-2xl shadow-lg shadow-brand-500/25 transition">
                        Publish Product to Catalog
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
                    <input type="text" name="spec_keys[]" placeholder="Attribute (e.g. Weight)" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                </div>
                <div class="col-span-6">
                    <input type="text" name="spec_values[]" placeholder="Value (e.g. 250 kg)" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                </div>
                <div class="col-span-1 text-center">
                    <button type="button" onclick="this.closest('.spec-row').remove()" class="text-slate-400 hover:text-red-500 text-xs"><i class="fa-solid fa-trash"></i></button>
                </div>
            `;
            container.appendChild(row);
        }
    </script>

@endsection
