<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - NexTrade B2B')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts & FontAwesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a',
                            950: '#0f172a',
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
    </style>
    @stack('styles')
</head>
<body class="h-full flex flex-col antialiased text-slate-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar Navigation -->
        <aside id="dashboardSidebar" class="hidden md:flex md:flex-shrink-0 w-64 flex-col bg-slate-950 text-slate-300 border-r border-slate-900 transition-all z-30">
            <!-- Brand header -->
            <div class="flex items-center justify-between h-20 px-6 bg-slate-900/60 border-b border-slate-900">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-brand-600 to-indigo-600 flex items-center justify-center text-white font-bold shadow-md shadow-brand-500/20">
                        <i class="fa-solid fa-cubes text-sm"></i>
                    </div>
                    <div>
                        <span class="text-xl font-bold font-heading text-white">Nex<span class="text-brand-400">Trade</span></span>
                        <span class="block text-[9px] uppercase font-bold tracking-widest text-slate-400">
                            @if(request()->is('admin*')) Admin Console
                            @elseif(request()->is('supplier*')) Supplier Hub
                            @else Buyer Portal @endif
                        </span>
                    </div>
                </a>
            </div>

            <!-- Nav Links by Role -->
            <div class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5 scrollbar-thin">
                
                @if(request()->is('buyer*'))
                    <!-- BUYER SIDEBAR -->
                    <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Main Menu</p>
                    
                    <a href="{{ route('buyer.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('buyer.dashboard') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/25' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-gauge-high w-5 text-center"></i>
                        <span>Overview</span>
                    </a>

                    <a href="{{ route('requirements.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition bg-amber-500/10 text-amber-400 hover:bg-amber-500/20 border border-amber-500/20">
                        <i class="fa-solid fa-bullhorn w-5 text-center"></i>
                        <span>Post Buy Requirement</span>
                    </a>

                    <a href="{{ route('buyer.requirements') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('buyer.requirements*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-list-check w-5 text-center"></i>
                        <span>My RFQs & Quotes</span>
                    </a>

                    <a href="{{ route('buyer.inquiries') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('buyer.inquiries*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-paper-plane w-5 text-center"></i>
                        <span>Product Inquiries</span>
                    </a>

                    <a href="{{ route('buyer.messages') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('buyer.messages*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-comments w-5 text-center"></i>
                        <span>Messages & Chat</span>
                    </a>

                    <a href="{{ route('buyer.favorites') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('buyer.favorites*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-heart w-5 text-center"></i>
                        <span>Saved Wishlist</span>
                    </a>

                    <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 mt-6 mb-2">Account</p>
                    
                    <a href="{{ route('buyer.profile') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('buyer.profile') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-user-gear w-5 text-center"></i>
                        <span>Company Profile</span>
                    </a>

                @elseif(request()->is('supplier*'))
                    <!-- SUPPLIER SIDEBAR -->
                    <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Operations</p>

                    <a href="{{ route('supplier.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('supplier.dashboard') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/25' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-gauge-high w-5 text-center"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('supplier.products.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500/20 border border-emerald-500/20">
                        <i class="fa-solid fa-circle-plus w-5 text-center"></i>
                        <span>Add New Product</span>
                    </a>

                    <a href="{{ route('supplier.products') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('supplier.products') || request()->routeIs('supplier.products.edit') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-boxes-stacked w-5 text-center"></i>
                        <span>Products Catalog</span>
                    </a>

                    <a href="{{ route('supplier.requirements') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('supplier.requirements*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-magnifying-glass-chart w-5 text-center"></i>
                        <span>RFQ Lead Market</span>
                    </a>

                    <a href="{{ route('supplier.inquiries') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('supplier.inquiries*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-inbox w-5 text-center"></i>
                        <span>Inquiries Inbox</span>
                    </a>

                    <a href="{{ route('supplier.quotes') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('supplier.quotes*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-file-invoice-dollar w-5 text-center"></i>
                        <span>Quotes Sent</span>
                    </a>

                    <a href="{{ route('supplier.messages') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('supplier.messages*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-comments w-5 text-center"></i>
                        <span>Chat & Messages</span>
                    </a>

                    <a href="{{ route('supplier.reviews') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('supplier.reviews*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-star-half-stroke w-5 text-center"></i>
                        <span>Customer Reviews</span>
                    </a>

                    <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 mt-6 mb-2">Growth & Profile</p>

                    <a href="{{ route('supplier.profile') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('supplier.profile*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-building-shield w-5 text-center"></i>
                        <span>Profile & KYC</span>
                    </a>

                    <a href="{{ route('supplier.subscription') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('supplier.subscription*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-gem w-5 text-center text-amber-400"></i>
                        <span>Plan & Monetization</span>
                    </a>

                @elseif(request()->is('admin*'))
                    <!-- ADMIN SIDEBAR -->
                    <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Administration</p>

                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-brand-600 text-white shadow-md shadow-brand-600/25' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-chart-pie w-5 text-center"></i>
                        <span>Overview & KPIs</span>
                    </a>

                    <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.users*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-users w-5 text-center"></i>
                        <span>Users & RBAC</span>
                    </a>

                    <a href="{{ route('admin.verification') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.verification*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-shield-check w-5 text-center text-emerald-400"></i>
                        <span>KYC & Verification</span>
                    </a>

                    <a href="{{ route('admin.products') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.products*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-boxes-stacked w-5 text-center"></i>
                        <span>Moderate Products</span>
                    </a>

                    <a href="{{ route('admin.categories') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.categories*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-sitemap w-5 text-center"></i>
                        <span>Categories & SEO</span>
                    </a>

                    <a href="{{ route('admin.requirements') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.requirements*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-bullhorn w-5 text-center"></i>
                        <span>Buy RFQ Feeds</span>
                    </a>

                    <a href="{{ route('admin.subscriptions') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.subscriptions*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-money-bills w-5 text-center text-amber-400"></i>
                        <span>Plans & Revenue</span>
                    </a>

                    <a href="{{ route('admin.advertisements') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.advertisements*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-rectangle-ad w-5 text-center"></i>
                        <span>Ad Banners</span>
                    </a>

                    <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.settings*') ? 'bg-brand-600 text-white' : 'hover:bg-slate-900 hover:text-white' }}">
                        <i class="fa-solid fa-sliders w-5 text-center"></i>
                        <span>System Settings</span>
                    </a>

                @endif

            </div>

            <!-- User Footer in Sidebar -->
            <div class="p-4 border-t border-slate-900 bg-slate-900/40">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 rounded-full bg-brand-600 text-white flex items-center justify-center font-bold text-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="truncate">
                            <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-slate-400 uppercase font-semibold">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Logout" class="p-2 text-slate-400 hover:text-red-400 rounded-lg hover:bg-slate-800 transition">
                            <i class="fa-solid fa-power-off text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden bg-slate-50">
            
            <!-- Top Dashboard Bar -->
            <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-6 z-20">
                
                <div class="flex items-center gap-4">
                    <button id="mobileSidebarToggle" class="md:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>
                    <div>
                        <h1 class="text-lg lg:text-xl font-bold font-heading text-slate-900 leading-tight">
                            @yield('page_title', 'Dashboard')
                        </h1>
                        <p class="text-xs text-slate-500 hidden sm:block">
                            @yield('page_subtitle', 'Manage operations, leads, inquiries and profile.')
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    
                    <!-- Marketplace Quick Switch -->
                    <a href="{{ route('home') }}" target="_blank" class="hidden sm:flex items-center gap-1.5 px-3.5 py-2 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        <span>View Marketplace</span>
                    </a>

                    <!-- Notifications Dropdown -->
                    <div class="relative group">
                        <button class="w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center relative transition">
                            <i class="fa-regular fa-bell text-sm"></i>
                            @if(Auth::user()->unreadNotificationsCount() > 0)
                                <span class="absolute top-2 right-2 w-2.5 h-2.5 rounded-full bg-red-500 border-2 border-white"></span>
                            @endif
                        </button>
                        <div class="absolute right-0 top-12 w-80 bg-white rounded-2xl shadow-xl border border-slate-100 py-3 hidden group-hover:block z-50">
                            <div class="px-4 py-2 border-b border-slate-100 flex items-center justify-between">
                                <h4 class="text-xs font-bold text-slate-800">Notifications</h4>
                                <span class="text-[10px] text-brand-600 font-semibold">{{ Auth::user()->unreadNotificationsCount() }} new</span>
                            </div>
                            <div class="divide-y divide-slate-50 max-h-72 overflow-y-auto">
                                @forelse(Auth::user()->notifications()->take(5)->get() as $n)
                                    <div class="p-3 hover:bg-slate-50 transition">
                                        <p class="text-xs font-bold text-slate-800">{{ $n->title }}</p>
                                        <p class="text-[11px] text-slate-500 mt-0.5">{{ $n->message }}</p>
                                        <span class="text-[9px] text-slate-400 mt-1 block">{{ $n->created_at->diffForHumans() }}</span>
                                    </div>
                                @empty
                                    <div class="p-4 text-center text-xs text-slate-400">No new notifications.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Role badge -->
                    <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-brand-100 text-brand-700 uppercase tracking-wider">
                        {{ Auth::user()->role }}
                    </span>

                </div>

            </header>

            <!-- Main Page Content Scrollable -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                            <p class="text-sm font-semibold">{{ session('success') }}</p>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-emerald-500"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-triangle-exclamation text-red-600 text-lg"></i>
                            <p class="text-sm font-semibold">{{ session('error') }}</p>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-red-500"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                @endif

                @yield('content')
            </main>

        </div>

    </div>

    @stack('scripts')
</body>
</html>
