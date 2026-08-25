@extends('layouts.app')

@section('title', ($currentCategory ? $currentCategory->name . ' - ' : '') . 'Search Wholesale Products & Machinery - NexTrade B2B')
@section('meta_description', 'Browse and source industrial products, machinery, electronics, construction materials and wholesale goods directly from verified manufacturers.')

@section('content')

    <!-- Breadcrumb & Header Title -->
    <div class="bg-white border-b border-slate-200 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('home') }}" class="hover:text-brand-600">Home</a>
                <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                <a href="{{ route('products.index') }}" class="hover:text-brand-600">Products</a>
                @if($currentCategory)
                    <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                    <span class="text-slate-800 font-semibold">{{ $currentCategory->name }}</span>
                @endif
                @if($currentSubcategory)
                    <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                    <span class="text-brand-600 font-semibold">{{ $currentSubcategory->name }}</span>
                @endif
            </nav>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-900">
                        @if($currentSubcategory)
                            {{ $currentSubcategory->name }}
                        @elseif($currentCategory)
                            {{ $currentCategory->name }}
                        @elseif(request('q'))
                            Search Results for "{{ request('q') }}"
                        @else
                            All Wholesale Products & Industrial Equipment
                        @endif
                    </h1>
                    <p class="text-xs text-slate-500 mt-1">Showing {{ $products->total() }} verified products matching your criteria.</p>
                </div>

                <!-- Sort & View Controls -->
                <div class="flex items-center gap-3">
                    <!-- Sort Dropdown -->
                    <form action="{{ url()->current() }}" method="GET" class="flex items-center gap-2">
                        @foreach(request()->except('sort', 'page') as $k => $v)
                            @if(is_array($v))
                                @foreach($v as $arrV)
                                    <input type="hidden" name="{{ $k }}[]" value="{{ $arrV }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                            @endif
                        @endforeach

                        <label class="text-xs text-slate-500 font-medium whitespace-nowrap">Sort By:</label>
                        <select name="sort" onchange="this.form.submit()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500">
                            <option value="relevance" {{ request('sort') == 'relevance' ? 'selected' : '' }}>Featured & Relevance</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Supplier Rating</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        </select>
                    </form>

                    <!-- Grid / List Switcher -->
                    <div class="flex items-center bg-slate-100 p-1 rounded-xl border border-slate-200">
                        <a href="{{ request()->fullUrlWithQuery(['view' => 'grid']) }}" class="p-1.5 rounded-lg {{ $viewMode === 'grid' ? 'bg-white shadow-sm text-brand-600' : 'text-slate-500 hover:text-slate-800' }}">
                            <i class="fa-solid fa-grid-2 text-xs"></i>
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}" class="p-1.5 rounded-lg {{ $viewMode === 'list' ? 'bg-white shadow-sm text-brand-600' : 'text-slate-500 hover:text-slate-800' }}">
                            <i class="fa-solid fa-list text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Container: Sidebar Filters + Products Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- LEFT SIDEBAR FILTERS -->
            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-6">
                    
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold font-heading text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-sliders text-brand-600 text-xs"></i> Filters
                        </h3>
                        <a href="{{ route('products.index') }}" class="text-[11px] font-semibold text-brand-600 hover:underline">Reset All</a>
                    </div>

                    <form action="{{ url()->current() }}" method="GET" id="filterForm" class="space-y-6">
                        @if(request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif
                        @if(request('view'))
                            <input type="hidden" name="view" value="{{ request('view') }}">
                        @endif

                        <!-- Filter: Categories -->
                        <div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-3">Categories</h4>
                            <div class="space-y-1.5 max-h-48 overflow-y-auto scrollbar-thin text-xs">
                                @foreach($categories as $cat)
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('category.show', $cat->slug) }}" class="flex items-center gap-2 text-slate-600 hover:text-brand-600 {{ $currentCategory && $currentCategory->id == $cat->id ? 'font-bold text-brand-600' : '' }}">
                                            <i class="fa-solid fa-angle-right text-[9px] text-slate-400"></i>
                                            <span>{{ $cat->name }}</span>
                                        </a>
                                        <span class="text-[10px] text-slate-400">({{ $cat->products_count }})</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Filter: Verified Suppliers Only -->
                        <div class="pt-4 border-t border-slate-100">
                            <label class="flex items-center gap-2.5 cursor-pointer">
                                <input type="checkbox" name="verified_only" value="1" {{ request('verified_only') ? 'checked' : '' }} onchange="this.form.submit()" class="w-4 h-4 text-brand-600 rounded border-slate-300 focus:ring-brand-500">
                                <span class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                                    <i class="fa-solid fa-shield-check text-emerald-600"></i> Verified Suppliers Only
                                </span>
                            </label>
                        </div>

                        <!-- Filter: Location / City -->
                        <div class="pt-4 border-t border-slate-100">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-3">Supplier City</h4>
                            <select name="city" onchange="this.form.submit()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500">
                                <option value="">All Cities</option>
                                @foreach($cities as $c)
                                    <option value="{{ $c->city }}" {{ request('city') == $c->city ? 'selected' : '' }}>{{ $c->city }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter: Supplier Business Type -->
                        <div class="pt-4 border-t border-slate-100">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-3">Business Type</h4>
                            <div class="space-y-2 text-xs">
                                @foreach(['Manufacturer', 'Wholesaler', 'Distributor', 'Trader'] as $type)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="supplier_type[]" value="{{ $type }}" {{ in_array($type, (array) request('supplier_type', [])) ? 'checked' : '' }} onchange="this.form.submit()" class="w-4 h-4 text-brand-600 rounded border-slate-300 focus:ring-brand-500">
                                        <span class="text-slate-600">{{ $type }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Filter: Price Range -->
                        <div class="pt-4 border-t border-slate-100">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-3">Price Range (₹)</h4>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-brand-500">
                                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-brand-500">
                            </div>
                            <button type="submit" class="w-full mt-2.5 py-1.5 bg-slate-800 hover:bg-slate-900 text-white rounded-xl text-xs font-bold transition">Apply Price</button>
                        </div>

                        <!-- Filter: Minimum Rating -->
                        <div class="pt-4 border-t border-slate-100">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-3">Supplier Rating</h4>
                            <div class="space-y-1.5 text-xs">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="min_rating" value="4.5" {{ request('min_rating') == '4.5' ? 'checked' : '' }} onchange="this.form.submit()" class="text-brand-600">
                                    <span class="flex items-center text-amber-500 gap-1 font-semibold"><i class="fa-solid fa-star"></i> 4.5 & above</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="min_rating" value="4.0" {{ request('min_rating') == '4.0' ? 'checked' : '' }} onchange="this.form.submit()" class="text-brand-600">
                                    <span class="flex items-center text-amber-500 gap-1 font-semibold"><i class="fa-solid fa-star"></i> 4.0 & above</span>
                                </label>
                            </div>
                        </div>

                    </form>
                </div>

                <!-- Post RFQ Banner in Sidebar -->
                <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl p-5 text-white shadow-lg shadow-amber-500/20">
                    <i class="fa-solid fa-bullhorn text-2xl mb-2"></i>
                    <h4 class="text-sm font-bold font-heading">Need a custom bulk quote?</h4>
                    <p class="text-xs text-amber-100 mt-1">Post your requirement and verified suppliers will quote directly.</p>
                    <a href="{{ route('requirements.create') }}" class="mt-4 block w-full py-2 bg-white text-slate-900 text-center font-bold text-xs rounded-xl shadow-md transition hover:bg-amber-50">
                        Post Buy Requirement
                    </a>
                </div>

            </div>

            <!-- RIGHT MAIN AREA: PRODUCTS GRID / LIST -->
            <div class="lg:col-span-3">
                
                @if($products->isEmpty())
                    <div class="bg-white rounded-3xl p-12 text-center border border-slate-200">
                        <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-2xl mb-4">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                        <h3 class="text-lg font-bold font-heading text-slate-800">No products found matching your filters</h3>
                        <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Try clearing some filter criteria or search using broader keywords.</p>
                        <div class="mt-6 flex items-center justify-center gap-3">
                            <a href="{{ route('products.index') }}" class="px-5 py-2.5 rounded-xl bg-brand-600 text-white font-bold text-xs shadow-md">Clear Filters</a>
                            <a href="{{ route('requirements.create') }}" class="px-5 py-2.5 rounded-xl bg-amber-500 text-slate-900 font-bold text-xs shadow-md">Post Buy Requirement</a>
                        </div>
                    </div>
                @else
                    <div class="{{ $viewMode === 'list' ? 'space-y-4' : 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6' }}">
                        @foreach($products as $product)
                            <x-product_card :product="$product" :viewMode="$viewMode" />
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-10">
                        {{ $products->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>

@endsection
