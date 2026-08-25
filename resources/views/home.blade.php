@extends('layouts.app')

@section('title', 'Ozura B2B - India\'s Premier B2B Marketplace & Wholesale Trade Platform')
@section('meta_description', 'Connect with verified manufacturers, suppliers, exporters and wholesalers across India. Source industrial machinery, solar, steel, chemicals, packaging, textiles and post buy requirements.')

@section('content')

    <!-- HERO SECTION: What are you looking for? -->
    <section class="relative bg-gradient-to-br from-slate-950 via-slate-900 to-brand-950 text-white overflow-hidden py-14 lg:py-20">
        <!-- Background ambient glow -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-brand-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl mx-auto text-center space-y-4">
                
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/15 text-xs font-semibold text-brand-300 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    India's Leading Enterprise B2B Sourcing Platform
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-heading tracking-tight leading-tight">
                    Source Directly from <span class="bg-clip-text text-transparent bg-gradient-to-r from-brand-400 via-blue-300 to-indigo-300">Verified Manufacturers</span> & Suppliers
                </h1>

                <p class="text-sm sm:text-base text-slate-300 max-w-2xl mx-auto font-normal">
                    Discover over 85,000+ wholesale products, request instant quotations, compare supplier bids, and trade securely.
                </p>

                <!-- Big Search Box -->
                <div class="pt-4">
                    <form action="{{ route('products.index') }}" method="GET" class="bg-white p-2 sm:p-2.5 rounded-3xl sm:rounded-full shadow-2xl flex flex-col sm:flex-row items-center gap-2 text-slate-800 border border-white/20">
                        
                        <!-- City selector in Hero -->
                        <div class="w-full sm:w-44 flex-shrink-0 flex items-center px-4 py-2 border-b sm:border-b-0 sm:border-r border-slate-200">
                            <i class="fa-solid fa-location-dot text-brand-600 mr-2 text-sm"></i>
                            <select name="city" class="w-full bg-transparent text-xs font-bold text-slate-700 focus:outline-none cursor-pointer appearance-none">
                                <option value="">All India</option>
                                <option value="Delhi">Delhi NCR</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Bengaluru">Bengaluru</option>
                                <option value="Hyderabad">Hyderabad</option>
                                <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Pune">Pune</option>
                                <option value="Surat">Surat</option>
                            </select>
                        </div>

                        <!-- Main Input -->
                        <div class="w-full flex-1 flex items-center px-3 py-1">
                            <input 
                                type="text" 
                                name="q" 
                                placeholder="What are you looking for? (e.g. Solar Panels, CNC Lathe, 5-Ply Boxes...)" 
                                class="w-full bg-transparent text-xs sm:text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:outline-none"
                                required
                            >
                        </div>

                        <!-- Search CTA Button -->
                        <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-2xl sm:rounded-full bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-700 hover:to-indigo-700 text-white font-bold text-sm shadow-lg shadow-brand-500/30 transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            <span>Search Products</span>
                        </button>
                    </form>
                </div>

                <!-- Popular Keywords Chips -->
                <div class="pt-2 flex flex-wrap items-center justify-center gap-2 text-xs text-slate-400">
                    <span class="font-semibold text-slate-300">Popular:</span>
                    <a href="{{ route('products.index', ['q' => 'CNC Lathe Machine']) }}" class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 text-slate-200 transition">CNC Lathe</a>
                    <a href="{{ route('products.index', ['q' => 'Mono PERC Solar']) }}" class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 text-slate-200 transition">550W Solar Panel</a>
                    <a href="{{ route('products.index', ['q' => 'TMT Rebar']) }}" class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 text-slate-200 transition">Fe 550D TMT Steel</a>
                    <a href="{{ route('products.index', ['q' => 'Corrugated Boxes']) }}" class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 text-slate-200 transition">5-Ply Boxes</a>
                    <a href="{{ route('products.index', ['q' => 'Caustic Soda']) }}" class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 text-slate-200 transition">Caustic Soda</a>
                </div>

            </div>

            <!-- Key Platform Highlights / Badges -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12 pt-8 border-t border-slate-800/80">
                <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10">
                    <div class="w-10 h-10 rounded-xl bg-brand-500/20 text-brand-400 flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-white">GST & KYC Verified</p>
                        <p class="text-[11px] text-slate-400">Authentic manufacturers</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-white">Instant RFQ Quotes</p>
                        <p class="text-[11px] text-slate-400">Competitive side-by-side bids</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-white">Direct Live Chat</p>
                        <p class="text-[11px] text-slate-400">WhatsApp-style messaging</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10">
                    <div class="w-10 h-10 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-white">Nationwide Hubs</p>
                        <p class="text-[11px] text-slate-400">Suppliers across all states</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 1: POPULAR CATEGORIES -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="flex items-center justify-between mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-brand-600">Industry Directory</span>
                <h2 class="text-2xl font-bold font-heading text-slate-900 mt-1">Popular B2B Categories</h2>
            </div>
            <a href="{{ route('products.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                View All Categories <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($categories as $cat)
                <a href="{{ route('category.show', $cat->slug) }}" class="bg-white rounded-2xl border border-slate-200 p-4 hover:border-brand-500 hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center group">
                    <div class="w-20 h-20 rounded-2xl bg-slate-50 border border-slate-100 overflow-hidden mb-3 group-hover:scale-105 transition duration-300">
                        <img src="{{ $cat->image ?: 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=300' }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xs font-bold text-slate-900 group-hover:text-brand-600 transition line-clamp-2 leading-tight">
                        {{ $cat->name }}
                    </h3>
                    <span class="text-[10px] text-slate-400 font-semibold mt-1">
                        {{ $cat->products_count }} Products
                    </span>
                    <span class="mt-3 text-[11px] font-bold text-brand-600 group-hover:underline flex items-center gap-1">
                        Explore <i class="fa-solid fa-angle-right text-[9px]"></i>
                    </span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- SECTION 2: TRENDING WHOLESALE PRODUCTS -->
    <section class="bg-slate-100/70 py-14 border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-brand-600">Featured Catalog</span>
                    <h2 class="text-2xl font-bold font-heading text-slate-900 mt-1">Trending Products & Machinery</h2>
                </div>
                <a href="{{ route('products.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                    Browse All Products <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($trendingProducts as $product)
                    <x-product_card :product="$product" viewMode="grid" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION 3: FEATURED VERIFIED SUPPLIERS -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="flex items-center justify-between mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Trusted Partners</span>
                <h2 class="text-2xl font-bold font-heading text-slate-900 mt-1">Featured Verified Manufacturers</h2>
            </div>
            <a href="{{ route('suppliers.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                Explore All Suppliers <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredSuppliers as $supplier)
                <x-supplier_card :supplier="$supplier" />
            @endforeach
        </div>
    </section>

    <!-- SECTION 4: LIVE BUY REQUIREMENTS (RFQ MARKETPLACE TICKER) -->
    <section class="bg-slate-900 text-white py-14 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <div class="flex items-center gap-2 text-amber-400 text-xs font-bold uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                        Live RFQ Marketplace
                    </div>
                    <h2 class="text-2xl font-bold font-heading text-white mt-1">Latest Buyer Requirements</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Direct procurement inquiries looking for competitive quotes.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('requirements.create') }}" class="px-5 py-2.5 rounded-full bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs shadow-lg shadow-amber-500/20 transition flex items-center gap-2">
                        <i class="fa-solid fa-plus text-xs"></i> Post Buy Requirement
                    </a>
                    <a href="{{ route('requirements.index') }}" class="px-5 py-2.5 rounded-full bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs border border-slate-700 transition">
                        View All RFQs
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($latestRequirements as $rfq)
                    <div class="bg-slate-800/80 rounded-2xl p-5 border border-slate-700 hover:border-amber-400/50 transition-all flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-amber-400 bg-amber-500/10 px-2.5 py-0.5 rounded-full border border-amber-500/20">
                                    {{ $rfq->category->name ?? 'General' }}
                                </span>
                                <span class="text-[10px] text-slate-400">{{ $rfq->created_at->diffForHumans() }}</span>
                            </div>

                            <h3 class="text-sm font-bold text-white line-clamp-2 leading-snug">
                                <a href="{{ route('requirements.show', $rfq->id) }}" class="hover:text-amber-400 transition">{{ $rfq->title }}</a>
                            </h3>

                            <div class="grid grid-cols-2 gap-2 mt-4 py-2.5 px-3 bg-slate-900/60 rounded-xl text-xs border border-slate-800">
                                <div>
                                    <span class="block text-[10px] text-slate-400">Required Quantity</span>
                                    <span class="font-bold text-white">{{ number_format($rfq->quantity) }} {{ $rfq->quantity_unit }}</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] text-slate-400">Target Budget</span>
                                    <span class="font-bold text-emerald-400">
                                        {{ $rfq->target_price ? '₹' . number_format($rfq->target_price, 2) : 'Negotiable' }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 text-xs text-slate-400 mt-3 truncate">
                                <i class="fa-solid fa-location-dot text-slate-500 text-xs"></i>
                                <span>{{ $rfq->delivery_location }}</span>
                            </div>
                        </div>

                        <div class="mt-5 pt-3 border-t border-slate-700 flex items-center justify-between">
                            <span class="text-[11px] text-slate-400">Buyer: <strong class="text-slate-300">{{ $rfq->buyer->company_name ?? 'Verified Buyer' }}</strong></span>
                            @if(Auth::check() && Auth::user()->isSupplier())
                                <a href="{{ route('supplier.requirements.show', $rfq->id) }}" class="px-3.5 py-1.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs transition">
                                    Quote Now
                                </a>
                            @else
                                <a href="{{ route('requirements.show', $rfq->id) }}" class="px-3.5 py-1.5 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold text-xs transition">
                                    View Details
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- SECTION 5: POPULAR CITIES (REGIONAL DISCOVERY) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="flex items-center justify-between mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-brand-600">Location Discovery</span>
                <h2 class="text-2xl font-bold font-heading text-slate-900 mt-1">Find Suppliers by Industrial Cities</h2>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($popularCities as $city)
                <a href="{{ route('city.suppliers', $city->city) }}" class="bg-white rounded-2xl border border-slate-200 p-3 hover:border-brand-500 hover:shadow-lg transition flex items-center gap-3 group">
                    <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0 border border-slate-200">
                        <img src="{{ $city->image ?: 'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=200' }}" alt="{{ $city->city }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    </div>
                    <div class="truncate">
                        <h4 class="text-xs font-bold text-slate-900 group-hover:text-brand-600 transition truncate">{{ $city->city }}</h4>
                        <span class="text-[10px] text-slate-400">{{ $city->state }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- SECTION 6: HIGH IMPACT "POST BUY REQUIREMENT" BANNER -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-14">
        <div class="rounded-3xl bg-gradient-to-r from-brand-800 via-brand-700 to-indigo-800 text-white p-8 sm:p-12 shadow-2xl relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8">
            <div class="space-y-3 max-w-xl text-center lg:text-left">
                <span class="px-3 py-1 rounded-full bg-white/20 text-white text-xs font-bold uppercase tracking-wider">Fast & 100% Free</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold font-heading">Tell Us What You Need, Get Instant Quotes</h2>
                <p class="text-xs sm:text-sm text-brand-100 leading-relaxed">
                    Post your buying requirement and receive customized quotations directly from verified manufacturers and wholesalers in hours.
                </p>
                <div class="pt-2 flex flex-wrap items-center justify-center lg:justify-start gap-4 text-xs">
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-circle-check text-emerald-400"></i> Multiple competitive bids</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-circle-check text-emerald-400"></i> Direct vendor chat</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-circle-check text-emerald-400"></i> Zero commission fees</span>
                </div>
            </div>

            <div class="flex-shrink-0">
                <a href="{{ route('requirements.create') }}" class="px-8 py-4 rounded-2xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-extrabold text-sm shadow-xl shadow-amber-500/30 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                    <i class="fa-solid fa-bullhorn text-base"></i>
                    <span>Post Requirement Now</span>
                </a>
            </div>
        </div>
    </section>

@endsection
