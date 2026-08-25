<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NexTrade B2B - India\'s Leading B2B Marketplace & Wholesale Platform')</title>
    <meta name="description" content="@yield('meta_description', 'Connect with verified manufacturers, suppliers, exporters and wholesalers across India and global markets. Post buy requirements, get instant quotations and trade securely.')">
    <meta name="keywords" content="@yield('meta_keywords', 'B2B marketplace, manufacturers, suppliers, wholesale products, buy requirements, RFQ, exporters, industrial machinery, solar, textiles')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- OpenGraph & Twitter Cards -->
    <meta property="og:title" content="@yield('title', 'NexTrade B2B Marketplace')">
    <meta property="og:description" content="@yield('meta_description', 'Source directly from verified manufacturers and wholesale suppliers.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Google Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                            950: '#0f172a',
                        },
                        accent: {
                            500: '#f59e0b',
                            600: '#d97706',
                        },
                        emerald: {
                            500: '#10b981',
                            600: '#059669',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .glass-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .badge-pulse {
            animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse-ring {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>

    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen antialiased">

    <!-- Top Announcement Bar -->
    <div class="bg-slate-900 text-slate-200 text-xs py-2 px-4 border-b border-slate-800">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1.5 text-emerald-400 font-medium">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    Verified B2B Marketplace
                </span>
                <span class="hidden md:inline text-slate-400">|</span>
                <span class="hidden md:inline text-slate-300">Over 50,000+ Verified Suppliers & Manufacturers</span>
            </div>
            <div class="flex items-center gap-4 text-slate-300">
                <a href="{{ route('city.suppliers', 'delhi') }}" class="hover:text-white transition">City Hubs</a>
                <a href="{{ route('requirements.index') }}" class="hover:text-white transition">RFQ Leads</a>
                <a href="{{ route('pages.faq') }}" class="hover:text-white transition">Help & Support</a>
                <a href="tel:+911800123456" class="hidden sm:flex items-center gap-1 text-amber-400 hover:underline">
                    <i class="fa-solid fa-phone-volume text-xs"></i> 1800-123-456
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header (Sticky) -->
    <header class="sticky top-0 z-40 bg-white border-b border-slate-200 shadow-sm glass-header transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 gap-4 lg:gap-8">
                
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 flex-shrink-0">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-brand-700 via-brand-600 to-indigo-500 flex items-center justify-center text-white shadow-lg shadow-brand-500/25">
                        <i class="fa-solid fa-cubes text-xl"></i>
                    </div>
                    <div>
                        <span class="text-2xl font-bold font-heading tracking-tight text-slate-900">Nex<span class="text-brand-600">Trade</span></span>
                        <span class="block text-[10px] uppercase font-bold tracking-widest text-slate-400 -mt-1">B2B Marketplace</span>
                    </div>
                </a>

                <!-- Mega Search Bar with Category Selector, City Selector & Live Autocomplete -->
                <div class="hidden md:flex flex-1 max-w-3xl relative">
                    <form action="{{ route('products.index') }}" method="GET" class="w-full flex items-center bg-slate-100/90 hover:bg-slate-100 focus-within:bg-white focus-within:ring-2 focus-within:ring-brand-500 border border-slate-300 focus-within:border-brand-500 rounded-full transition-all shadow-inner overflow-hidden" id="headerSearchForm">
                        
                        <!-- Category Selector -->
                        <div class="relative flex-shrink-0 border-r border-slate-200">
                            <select name="category" class="h-12 pl-4 pr-8 bg-transparent text-xs font-semibold text-slate-700 focus:outline-none cursor-pointer appearance-none">
                                <option value="">All Categories</option>
                                <option value="industrial-machinery" {{ request('category') == 'industrial-machinery' ? 'selected' : '' }}>Industrial Machinery</option>
                                <option value="solar-products" {{ request('category') == 'solar-products' ? 'selected' : '' }}>Solar & Energy</option>
                                <option value="electronics-electrical" {{ request('category') == 'electronics-electrical' ? 'selected' : '' }}>Electronics & Electrical</option>
                                <option value="construction-materials" {{ request('category') == 'construction-materials' ? 'selected' : '' }}>Construction Materials</option>
                                <option value="packaging-materials" {{ request('category') == 'packaging-materials' ? 'selected' : '' }}>Packaging Materials</option>
                                <option value="chemicals-minerals" {{ request('category') == 'chemicals-minerals' ? 'selected' : '' }}>Chemicals & Minerals</option>
                                <option value="textile-products" {{ request('category') == 'textile-products' ? 'selected' : '' }}>Textiles & Workwear</option>
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-2.5 top-4 text-[10px] text-slate-400 pointer-events-none"></i>
                        </div>

                        <!-- Location Selector Dropdown -->
                        <div class="relative flex-shrink-0 border-r border-slate-200 hidden lg:block">
                            <div class="flex items-center pl-3 pr-2 text-slate-500 text-xs">
                                <i class="fa-solid fa-location-dot text-brand-600 mr-1.5 text-xs"></i>
                                <select name="city" class="h-12 bg-transparent text-xs font-medium text-slate-700 focus:outline-none cursor-pointer appearance-none pr-5">
                                    <option value="">All India</option>
                                    <option value="Delhi" {{ request('city') == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                                    <option value="Mumbai" {{ request('city') == 'Mumbai' ? 'selected' : '' }}>Mumbai</option>
                                    <option value="Bengaluru" {{ request('city') == 'Bengaluru' ? 'selected' : '' }}>Bengaluru</option>
                                    <option value="Hyderabad" {{ request('city') == 'Hyderabad' ? 'selected' : '' }}>Hyderabad</option>
                                    <option value="Ahmedabad" {{ request('city') == 'Ahmedabad' ? 'selected' : '' }}>Ahmedabad</option>
                                    <option value="Pune" {{ request('city') == 'Pune' ? 'selected' : '' }}>Pune</option>
                                    <option value="Surat" {{ request('city') == 'Surat' ? 'selected' : '' }}>Surat</option>
                                </select>
                            </div>
                        </div>

                        <!-- Search Input -->
                        <div class="flex-1 relative flex items-center">
                            <input 
                                type="text" 
                                name="q" 
                                id="headerSearchInput"
                                value="{{ request('q') }}"
                                placeholder="What product, machinery or supplier are you looking for?"
                                autocomplete="off"
                                class="w-full h-12 px-4 bg-transparent text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none"
                            >
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="h-10 px-5 mr-1 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-full flex items-center gap-2 transition shadow-md shadow-brand-500/20 flex-shrink-0">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            <span class="hidden sm:inline">Search</span>
                        </button>
                    </form>

                    <!-- Live Autocomplete Suggestion Dropdown -->
                    <div id="autocompleteDropdown" class="absolute left-0 right-0 top-14 bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden hidden z-50 transition-all">
                        <div id="autocompleteResults" class="p-2 divide-y divide-slate-100 text-sm">
                            <!-- Populated dynamically via AJAX -->
                        </div>
                    </div>
                </div>

                <!-- Right Actions & CTAs -->
                <div class="flex items-center gap-3">
                    
                    <!-- Post Buy Requirement CTA Button -->
                    <a href="{{ route('requirements.create') }}" class="hidden sm:flex items-center gap-2 px-4 py-2.5 rounded-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white text-xs lg:text-sm font-bold shadow-md shadow-amber-500/20 transition transform active:scale-95 flex-shrink-0">
                        <i class="fa-solid fa-bullhorn text-xs"></i>
                        <span>Post Requirement</span>
                    </a>

                    <!-- User Account / Dropdown or Login -->
                    @auth
                        <div class="relative group" id="userMenuDropdown">
                            <button class="flex items-center gap-2.5 p-1.5 pr-3 rounded-full hover:bg-slate-100 border border-slate-200 transition">
                                <div class="w-8 h-8 rounded-full bg-brand-600 text-white flex items-center justify-center font-bold text-xs shadow-inner">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="text-left hidden lg:block">
                                    <div class="text-xs font-bold text-slate-800 leading-none">{{ Str::limit(Auth::user()->name, 14) }}</div>
                                    <span class="text-[10px] font-semibold uppercase text-brand-600">{{ Auth::user()->role }}</span>
                                </div>
                                <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 top-12 w-60 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 hidden group-hover:block hover:block z-50">
                                <div class="px-4 py-2.5 border-b border-slate-100">
                                    <p class="text-xs text-slate-500">Signed in as</p>
                                    <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->email }}</p>
                                </div>

                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-600 font-medium">
                                        <i class="fa-solid fa-gauge-high text-brand-600 w-4"></i> Admin Control Panel
                                    </a>
                                @endif

                                @if(Auth::user()->isSupplier() || Auth::user()->isAdmin())
                                    <a href="{{ route('supplier.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-600 font-medium">
                                        <i class="fa-solid fa-store text-emerald-600 w-4"></i> Supplier Dashboard
                                    </a>
                                    <a href="{{ route('supplier.products') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-600 font-medium">
                                        <i class="fa-solid fa-box text-blue-600 w-4"></i> My Product Catalog
                                    </a>
                                    <a href="{{ route('supplier.requirements') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-600 font-medium">
                                        <i class="fa-solid fa-file-invoice text-amber-600 w-4"></i> RFQ Lead Marketplace
                                    </a>
                                    <a href="{{ route('supplier.messages') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-600 font-medium">
                                        <i class="fa-solid fa-comments text-indigo-600 w-4"></i> Messages / Chat
                                    </a>
                                @endif

                                @if(Auth::user()->isBuyer() || Auth::user()->isAdmin())
                                    <a href="{{ route('buyer.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-600 font-medium">
                                        <i class="fa-solid fa-cart-flatbed text-brand-600 w-4"></i> Buyer Dashboard
                                    </a>
                                    <a href="{{ route('buyer.requirements') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-600 font-medium">
                                        <i class="fa-solid fa-list-check text-purple-600 w-4"></i> My Posted RFQs
                                    </a>
                                    <a href="{{ route('buyer.messages') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-600 font-medium">
                                        <i class="fa-solid fa-comments text-indigo-600 w-4"></i> Buyer Messages
                                    </a>
                                    <a href="{{ route('buyer.favorites') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-600 font-medium">
                                        <i class="fa-solid fa-heart text-red-500 w-4"></i> Saved Wishlist
                                    </a>
                                @endif

                                <div class="border-t border-slate-100 mt-2 pt-1">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-medium text-left">
                                            <i class="fa-solid fa-arrow-right-from-bracket w-4"></i> Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-2">
                            <a href="{{ route('login') }}" class="px-4 py-2 text-xs lg:text-sm font-bold text-slate-700 hover:text-brand-600 hover:bg-slate-100 rounded-full transition">
                                Sign In
                            </a>
                            <div class="relative group">
                                <button class="px-4 py-2 rounded-full bg-brand-600 hover:bg-brand-700 text-white text-xs lg:text-sm font-bold shadow-md shadow-brand-500/20 transition flex items-center gap-1.5">
                                    <span>Register</span>
                                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                </button>
                                <div class="absolute right-0 top-10 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 hidden group-hover:block hover:block z-50">
                                    <a href="{{ route('buyer.register') }}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-brand-50 transition">
                                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-sm font-bold">
                                            <i class="fa-solid fa-user-tag"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-slate-800">Join as Buyer</p>
                                            <p class="text-[11px] text-slate-500">Source products & RFQs</p>
                                        </div>
                                    </a>
                                    <a href="{{ route('supplier.register') }}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-emerald-50 transition">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center text-sm font-bold">
                                            <i class="fa-solid fa-building"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-slate-800">Join as Supplier</p>
                                            <p class="text-[11px] text-slate-500">Sell & receive verified leads</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuBtn" class="md:hidden p-2.5 rounded-xl text-slate-600 hover:bg-slate-100 focus:outline-none">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>

            </div>

            <!-- Mobile Search Bar (Collapsible / Visible on Small screens) -->
            <div class="md:hidden pb-3">
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center bg-slate-100 border border-slate-300 rounded-full px-3 py-1.5">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 mr-2 text-xs"></i>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products, machinery, suppliers..." class="w-full bg-transparent text-xs text-slate-900 focus:outline-none">
                    <button type="submit" class="text-xs font-bold text-brand-600 px-2">Go</button>
                </form>
            </div>
        </div>

        <!-- Secondary Categories Sub-Header Bar -->
        <nav class="hidden md:block bg-slate-900 text-white text-xs border-t border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                <div class="flex items-center space-x-1 overflow-x-auto py-2.5 scrollbar-none">
                    <a href="{{ route('products.index') }}" class="px-3 py-1 rounded-md text-slate-300 hover:text-white hover:bg-slate-800 font-medium transition flex items-center gap-1.5 whitespace-nowrap">
                        <i class="fa-solid fa-grid-2 text-brand-400"></i> All Products
                    </a>
                    <a href="{{ route('category.show', 'industrial-machinery') }}" class="px-3 py-1 rounded-md text-slate-300 hover:text-white hover:bg-slate-800 font-medium transition whitespace-nowrap">
                        Industrial Machinery
                    </a>
                    <a href="{{ route('category.show', 'solar-products') }}" class="px-3 py-1 rounded-md text-slate-300 hover:text-white hover:bg-slate-800 font-medium transition whitespace-nowrap">
                        Solar & Renewable
                    </a>
                    <a href="{{ route('category.show', 'construction-materials') }}" class="px-3 py-1 rounded-md text-slate-300 hover:text-white hover:bg-slate-800 font-medium transition whitespace-nowrap">
                        Construction & Steel
                    </a>
                    <a href="{{ route('category.show', 'packaging-materials') }}" class="px-3 py-1 rounded-md text-slate-300 hover:text-white hover:bg-slate-800 font-medium transition whitespace-nowrap">
                        Packaging Materials
                    </a>
                    <a href="{{ route('category.show', 'chemicals-minerals') }}" class="px-3 py-1 rounded-md text-slate-300 hover:text-white hover:bg-slate-800 font-medium transition whitespace-nowrap">
                        Chemicals & Polymers
                    </a>
                    <a href="{{ route('category.show', 'textile-products') }}" class="px-3 py-1 rounded-md text-slate-300 hover:text-white hover:bg-slate-800 font-medium transition whitespace-nowrap">
                        Textiles & Workwear
                    </a>
                    <a href="{{ route('suppliers.index') }}" class="px-3 py-1 rounded-md text-slate-300 hover:text-white hover:bg-slate-800 font-medium transition whitespace-nowrap">
                        Supplier Directory
                    </a>
                </div>
                <div class="flex items-center gap-3 pl-4 flex-shrink-0">
                    <a href="{{ route('requirements.index') }}" class="text-amber-400 hover:text-amber-300 font-bold flex items-center gap-1.5 py-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping"></span>
                        Live RFQs
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Flash Messages Alerts -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-sm animate-fade-in">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <p class="text-sm font-semibold">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 text-sm"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 flex items-center justify-between shadow-sm animate-fade-in">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <p class="text-sm font-semibold">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 text-sm"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
    @endif

    <!-- Main Dynamic Body Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Global Quick Inquiry Modal -->
    <div id="globalInquiryModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full shadow-2xl overflow-hidden border border-slate-100 transform transition-all">
            <div class="bg-gradient-to-r from-brand-700 to-indigo-700 p-6 text-white flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold font-heading">Send Direct Inquiry to Supplier</h3>
                    <p class="text-xs text-brand-200" id="inquiryModalSub">Get instant quotation and competitive wholesale pricing</p>
                </div>
                <button onclick="closeInquiryModal()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('inquiries.store') }}" method="POST" class="p-6 space-y-4" id="globalInquiryForm">
                @csrf
                <input type="hidden" name="supplier_id" id="inquirySupplierId" value="">
                <input type="hidden" name="product_id" id="inquiryProductId" value="">

                <div class="p-3 bg-slate-50 border border-slate-200 rounded-2xl flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-white border border-slate-200 overflow-hidden flex-shrink-0">
                        <img id="inquiryProductImg" src="" alt="Product" class="w-full h-full object-cover">
                    </div>
                    <div class="overflow-hidden">
                        <h4 id="inquiryProductName" class="text-xs font-bold text-slate-900 truncate">Product Name</h4>
                        <p id="inquirySupplierName" class="text-[11px] text-slate-500 truncate">Supplier</p>
                    </div>
                </div>

                @guest
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Your Full Name *</label>
                        <input type="text" name="buyer_name" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none" placeholder="Rajesh Kumar">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Mobile / WhatsApp *</label>
                        <input type="text" name="buyer_phone" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none" placeholder="+91 98765 43210">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Business Email *</label>
                    <input type="email" name="buyer_email" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none" placeholder="rajesh@company.com">
                </div>
                @endguest

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Required Quantity *</label>
                        <input type="number" name="quantity" min="1" value="10" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Delivery City / State</label>
                        <input type="text" name="delivery_location" placeholder="e.g. Mumbai, MH" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Requirement Details / Questions *</label>
                    <textarea name="message" rows="3" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none" placeholder="Please share best unit price for our quantity, delivery timeline, and product test certificates..."></textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm shadow-lg shadow-brand-500/25 transition">
                        Submit Inquiry & Contact Supplier
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 text-xs mt-16 border-t border-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
                
                <!-- Col 1: Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-10 h-10 rounded-xl bg-brand-600 flex items-center justify-center text-white font-bold">
                            <i class="fa-solid fa-cubes text-lg"></i>
                        </div>
                        <span class="text-2xl font-bold font-heading text-white">Nex<span class="text-brand-400">Trade</span></span>
                    </div>
                    <p class="text-slate-400 text-xs leading-relaxed max-w-sm">
                        NexTrade is an enterprise B2B e-commerce marketplace platform connecting verified manufacturers, wholesalers, suppliers, and procurement buyers across India and worldwide.
                    </p>
                    <div class="flex items-center gap-3 pt-2">
                        <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-900 border border-slate-800 text-[11px] text-emerald-400 font-semibold">
                            <i class="fa-solid fa-shield-halved"></i> 100% Verified Sellers
                        </div>
                        <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-900 border border-slate-800 text-[11px] text-amber-400 font-semibold">
                            <i class="fa-solid fa-lock"></i> SSL Secure Gateway
                        </div>
                    </div>
                </div>

                <!-- Col 2: Categories -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider font-heading">Top Categories</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('category.show', 'industrial-machinery') }}" class="hover:text-white transition">Industrial Machinery</a></li>
                        <li><a href="{{ route('category.show', 'solar-products') }}" class="hover:text-white transition">Solar & Renewable</a></li>
                        <li><a href="{{ route('category.show', 'construction-materials') }}" class="hover:text-white transition">Construction & Steel</a></li>
                        <li><a href="{{ route('category.show', 'packaging-materials') }}" class="hover:text-white transition">Packaging Materials</a></li>
                        <li><a href="{{ route('category.show', 'chemicals-minerals') }}" class="hover:text-white transition">Chemicals & Minerals</a></li>
                        <li><a href="{{ route('category.show', 'medical-equipment') }}" class="hover:text-white transition">Medical & Healthcare</a></li>
                    </ul>
                </div>

                <!-- Col 3: Popular Cities -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider font-heading">Supplier Hubs</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('city.suppliers', 'Delhi') }}" class="hover:text-white transition">Suppliers in Delhi</a></li>
                        <li><a href="{{ route('city.suppliers', 'Mumbai') }}" class="hover:text-white transition">Suppliers in Mumbai</a></li>
                        <li><a href="{{ route('city.suppliers', 'Bengaluru') }}" class="hover:text-white transition">Suppliers in Bengaluru</a></li>
                        <li><a href="{{ route('city.suppliers', 'Ahmedabad') }}" class="hover:text-white transition">Suppliers in Ahmedabad</a></li>
                        <li><a href="{{ route('city.suppliers', 'Pune') }}" class="hover:text-white transition">Suppliers in Pune</a></li>
                        <li><a href="{{ route('city.suppliers', 'Hyderabad') }}" class="hover:text-white transition">Suppliers in Hyderabad</a></li>
                    </ul>
                </div>

                <!-- Col 4: Quick Links & Support -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider font-heading">Platform & Support</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('requirements.create') }}" class="hover:text-white transition">Post Buy Requirement</a></li>
                        <li><a href="{{ route('supplier.register') }}" class="hover:text-white transition">Sell on NexTrade</a></li>
                        <li><a href="{{ route('pages.about') }}" class="hover:text-white transition">About Us</a></li>
                        <li><a href="{{ route('pages.contact') }}" class="hover:text-white transition">Contact Enterprise Support</a></li>
                        <li><a href="{{ route('pages.terms') }}" class="hover:text-white transition">Terms & Conditions</a></li>
                        <li><a href="{{ route('pages.privacy') }}" class="hover:text-white transition">Privacy Policy</a></li>
                    </ul>
                </div>

            </div>

            <div class="border-t border-slate-900 mt-12 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-slate-500">
                <p>&copy; {{ date('Y') }} NexTrade B2B Marketplace Platform. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('seo.sitemap') }}" class="hover:text-slate-400">Sitemap</a>
                    <a href="{{ route('pages.privacy') }}" class="hover:text-slate-400">Privacy</a>
                    <a href="{{ route('pages.terms') }}" class="hover:text-slate-400">Terms</a>
                    <span>Powered by Laravel & MySQL</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation Bar (Fixed) -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200 px-4 py-2 flex items-center justify-between text-slate-600 shadow-lg">
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 text-[10px] font-semibold {{ request()->routeIs('home') ? 'text-brand-600' : '' }}">
            <i class="fa-solid fa-house text-sm"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('products.index') }}" class="flex flex-col items-center gap-1 text-[10px] font-semibold {{ request()->routeIs('products.*') ? 'text-brand-600' : '' }}">
            <i class="fa-solid fa-boxes-stacked text-sm"></i>
            <span>Catalog</span>
        </a>
        <a href="{{ route('requirements.create') }}" class="flex flex-col items-center gap-1 text-[10px] font-semibold text-amber-600">
            <div class="w-8 h-8 -mt-5 rounded-full bg-amber-500 text-white flex items-center justify-center shadow-md">
                <i class="fa-solid fa-plus text-sm"></i>
            </div>
            <span>Post RFQ</span>
        </a>
        <a href="{{ Auth::check() && Auth::user()->isSupplier() ? route('supplier.messages') : (Auth::check() ? route('buyer.messages') : route('login')) }}" class="flex flex-col items-center gap-1 text-[10px] font-semibold">
            <i class="fa-solid fa-comments text-sm"></i>
            <span>Messages</span>
        </a>
        <a href="{{ Auth::check() ? (Auth::user()->isAdmin() ? route('admin.dashboard') : (Auth::user()->isSupplier() ? route('supplier.dashboard') : route('buyer.dashboard'))) : route('login') }}" class="flex flex-col items-center gap-1 text-[10px] font-semibold">
            <i class="fa-solid fa-user text-sm"></i>
            <span>Account</span>
        </a>
    </div>

    <!-- Core Scripts: Autocomplete & Inquiry Modal Trigger -->
    <script>
        // Autocomplete search logic
        const searchInput = document.getElementById('headerSearchInput');
        const dropdown = document.getElementById('autocompleteDropdown');
        const resultsContainer = document.getElementById('autocompleteResults');
        let debounceTimer;

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();
                clearTimeout(debounceTimer);

                if (query.length < 2) {
                    dropdown.classList.add('hidden');
                    return;
                }

                debounceTimer = setTimeout(() => {
                    fetch(`/api/search/suggestions?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            let html = '';
                            let hasResults = false;

                            if (data.products && data.products.length > 0) {
                                hasResults = true;
                                html += `<div class="p-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">Products</div>`;
                                data.products.forEach(p => {
                                    html += `
                                        <a href="/products/${p.slug}" class="flex items-center gap-3 p-2 hover:bg-slate-50 rounded-xl transition">
                                            <img src="${p.main_image || '/placeholder.jpg'}" class="w-9 h-9 rounded-lg object-cover flex-shrink-0 border border-slate-200">
                                            <div class="flex-1 min-w-0">
                                                <p class="font-semibold text-slate-800 text-xs truncate">${p.name}</p>
                                                <p class="text-[11px] text-brand-600 font-bold">₹${parseFloat(p.price).toLocaleString()} / ${p.price_unit}</p>
                                            </div>
                                        </a>
                                    `;
                                });
                            }

                            if (data.categories && data.categories.length > 0) {
                                hasResults = true;
                                html += `<div class="p-2 text-[11px] font-bold uppercase tracking-wider text-slate-400 mt-2">Categories</div>`;
                                data.categories.forEach(c => {
                                    html += `
                                        <a href="/category/${c.slug}" class="flex items-center gap-2 p-2 hover:bg-slate-50 rounded-xl transition text-xs font-semibold text-slate-700">
                                            <i class="fa-solid fa-tag text-brand-500 text-xs"></i>
                                            <span>${c.name}</span>
                                        </a>
                                    `;
                                });
                            }

                            if (data.suppliers && data.suppliers.length > 0) {
                                hasResults = true;
                                html += `<div class="p-2 text-[11px] font-bold uppercase tracking-wider text-slate-400 mt-2">Verified Suppliers</div>`;
                                data.suppliers.forEach(s => {
                                    html += `
                                        <a href="/suppliers/${s.slug}" class="flex items-center gap-3 p-2 hover:bg-slate-50 rounded-xl transition">
                                            <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-700 border border-slate-200">
                                                ${s.company_name.charAt(0)}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-semibold text-slate-800 text-xs truncate">${s.company_name}</p>
                                                <p class="text-[11px] text-slate-400">${s.city}, ${s.state}</p>
                                            </div>
                                        </a>
                                    `;
                                });
                            }

                            if (hasResults) {
                                resultsContainer.innerHTML = html;
                                dropdown.classList.remove('hidden');
                            } else {
                                dropdown.classList.add('hidden');
                            }
                        })
                        .catch(() => dropdown.classList.add('hidden'));
                }, 250);
            });

            // Close on click outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        }

        // Global Inquiry Modal Logic
        function openInquiryModal(supplierId, supplierName, productId = '', productName = '', productImg = '') {
            document.getElementById('inquirySupplierId').value = supplierId;
            document.getElementById('inquiryProductId').value = productId;
            document.getElementById('inquirySupplierName').textContent = supplierName;
            document.getElementById('inquiryProductName').textContent = productName || 'Direct Company Inquiry';
            document.getElementById('inquiryProductImg').src = productImg || 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=200';
            
            const modal = document.getElementById('globalInquiryModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeInquiryModal() {
            const modal = document.getElementById('globalInquiryModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

    @stack('scripts')
</body>
</html>
