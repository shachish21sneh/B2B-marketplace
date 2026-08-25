@extends('layouts.app')

@section('title', 'Post Buy Requirement (RFQ) - Get Free Competitive Quotes | Ozura')
@section('meta_description', 'Post your product or raw material buying requirement and get fast wholesale quotations from verified manufacturers across India.')

@section('content')

    <div class="bg-gradient-to-b from-brand-950 to-slate-900 text-white py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-bold uppercase tracking-wider">
                <i class="fa-solid fa-bullhorn text-xs"></i> 100% Free Service
            </span>
            <h1 class="text-2xl sm:text-4xl font-extrabold font-heading text-white">
                Tell Us What You Need, Get Instant Quotes
            </h1>
            <p class="text-xs sm:text-sm text-slate-300 max-w-xl mx-auto">
                Verified manufacturers and wholesale distributors matching your category will compete to provide you the best rates.
            </p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-16">
        
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-10 shadow-xl">
            
            <form action="{{ route('requirements.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Section 1: Requirement Specification -->
                <div>
                    <h2 class="text-base font-bold font-heading text-slate-900 flex items-center gap-2 border-b border-slate-100 pb-3">
                        <span class="w-6 h-6 rounded-full bg-brand-600 text-white flex items-center justify-center text-xs">1</span>
                        Product / Sourcing Requirement Details
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Product or Service Name *</label>
                            <input type="text" name="title" required value="{{ old('title') }}" placeholder="e.g. 500kW Mono PERC Solar Panels or 5-Ply Corrugated Cartons" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            @error('title') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Industry Category *</label>
                            <select name="category_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Quantity *</label>
                                <input type="number" name="quantity" min="1" required value="{{ old('quantity', 100) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Unit *</label>
                                <select name="quantity_unit" required class="w-full px-3 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                                    <option value="Pieces">Pieces</option>
                                    <option value="Metric Tons">Metric Tons</option>
                                    <option value="Kilograms (Kg)">Kg</option>
                                    <option value="Sets">Sets</option>
                                    <option value="Boxes">Boxes</option>
                                    <option value="Meters">Meters</option>
                                    <option value="Liters">Liters</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Target / Expected Price (₹ per Unit)</label>
                            <input type="number" name="target_price" step="0.01" value="{{ old('target_price') }}" placeholder="Leave blank if negotiable" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Required By Date</label>
                            <input type="date" name="required_by" value="{{ old('required_by') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Detailed Description & Specifications *</label>
                            <textarea name="description" rows="4" required placeholder="Describe technical specifications, quality standards (BIS/ISO), dimensions, packaging, and any customization required..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">{{ old('description') }}</textarea>
                            @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 2: Delivery & Commercial Terms -->
                <div class="pt-4">
                    <h2 class="text-base font-bold font-heading text-slate-900 flex items-center gap-2 border-b border-slate-100 pb-3">
                        <span class="w-6 h-6 rounded-full bg-brand-600 text-white flex items-center justify-center text-xs">2</span>
                        Delivery & Logistics Preferences
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Delivery Location / City *</label>
                            <input type="text" name="delivery_location" required value="{{ old('delivery_location') }}" placeholder="e.g. Mumbai, Maharashtra" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            @error('delivery_location') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Destination Pincode</label>
                            <input type="text" name="pincode" value="{{ old('pincode') }}" placeholder="e.g. 400001" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Preferred Supplier Hub / Location</label>
                            <input type="text" name="preferred_location" value="{{ old('preferred_location') }}" placeholder="e.g. Any India, or Maharashtra / Gujarat only" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Payment Terms</label>
                            <input type="text" name="payment_terms" value="{{ old('payment_terms') }}" placeholder="e.g. 100% LC, 30% Advance, Net 30, RTGS" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Contact Details (If Guest) -->
                @guest
                <div class="pt-4">
                    <h2 class="text-base font-bold font-heading text-slate-900 flex items-center gap-2 border-b border-slate-100 pb-3">
                        <span class="w-6 h-6 rounded-full bg-brand-600 text-white flex items-center justify-center text-xs">3</span>
                        Buyer Contact Details
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Your Full Name *</label>
                            <input type="text" name="buyer_name" required value="{{ old('buyer_name') }}" placeholder="Rajesh Kumar" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Company / Business Name</label>
                            <input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="Apex Enterprises Ltd" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Business Email *</label>
                            <input type="email" name="buyer_email" required value="{{ old('buyer_email') }}" placeholder="rajesh@company.com" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Mobile / WhatsApp Number *</label>
                            <input type="text" name="buyer_mobile" required value="{{ old('buyer_mobile') }}" placeholder="+91 98765 43210" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                    </div>
                </div>
                @endguest

                <!-- Submission CTA -->
                <div class="pt-6 border-t border-slate-100">
                    <button type="submit" class="w-full py-4 rounded-2xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-extrabold text-base shadow-xl shadow-amber-500/25 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-bullhorn text-sm"></i>
                        <span>Submit Buy Requirement & Notify Suppliers</span>
                    </button>
                    <p class="text-center text-[11px] text-slate-400 mt-2">
                        By submitting, you agree to receive quotes and messages from verified Ozura suppliers.
                    </p>
                </div>

            </form>

        </div>

    </div>

@endsection
