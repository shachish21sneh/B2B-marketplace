@extends('layouts.dashboard')

@section('title', 'Super Admin Control Panel - Ozura')
@section('page_title', 'Super Admin Control Panel')
@section('page_subtitle', 'Platform oversight, verification approvals, revenue metrics and moderation.')

@section('content')

    <div class="space-y-8">
        
        <!-- Platform KPI Cards (6 KPIs) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
            
            <div class="bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Users</span>
                <h3 class="text-2xl font-extrabold font-heading text-slate-900 mt-1">{{ number_format($stats['total_users'] ?? 0) }}</h3>
                <span class="text-[10px] text-slate-500 font-semibold">{{ $stats['total_buyers'] ?? 0 }} Buyers registered</span>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Suppliers</span>
                <h3 class="text-2xl font-extrabold font-heading text-brand-600 mt-1">{{ number_format($stats['total_suppliers'] ?? 0) }}</h3>
                <span class="text-[10px] text-emerald-600 font-semibold">{{ $stats['verified_suppliers'] ?? 0 }} Verified Badges</span>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Pending KYC Queue</span>
                <h3 class="text-2xl font-extrabold font-heading text-amber-500 mt-1">{{ $stats['pending_kyc'] ?? ($stats['pending_verifications'] ?? 0) }}</h3>
                <a href="{{ route('admin.verification') }}" class="text-[10px] text-amber-600 font-bold hover:underline">Review Documents &rarr;</a>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Catalog Products</span>
                <h3 class="text-2xl font-extrabold font-heading text-slate-900 mt-1">{{ number_format($stats['total_products'] ?? 0) }}</h3>
                <a href="{{ route('admin.products') }}" class="text-[10px] text-brand-600 font-semibold hover:underline">Manage Catalog &rarr;</a>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Active RFQs</span>
                <h3 class="text-2xl font-extrabold font-heading text-indigo-600 mt-1">{{ number_format($stats['total_requirements'] ?? 0) }}</h3>
                <span class="text-[10px] text-slate-400">Procurement Leads</span>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Subscription Rev</span>
                <h3 class="text-2xl font-extrabold font-heading text-emerald-600 mt-1">₹{{ number_format($stats['total_revenue'] ?? 0) }}</h3>
                <span class="text-[10px] text-emerald-600 font-semibold">Tier Monetization</span>
            </div>

        </div>

        <!-- Quick Administration Actions -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <a href="{{ route('admin.verification') }}" class="p-5 rounded-3xl bg-white border border-slate-200 hover:border-amber-500 shadow-sm flex items-center gap-4 transition group">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl group-hover:scale-110 transition">
                    <i class="fa-solid fa-id-card-clip"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-slate-900 font-heading">KYC Verification</h4>
                    <p class="text-[10px] text-slate-400">Review GST & Docs</p>
                </div>
            </a>

            <a href="{{ route('admin.users') }}" class="p-5 rounded-3xl bg-white border border-slate-200 hover:border-brand-500 shadow-sm flex items-center gap-4 transition group">
                <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center text-xl group-hover:scale-110 transition">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-slate-900 font-heading">User Directory</h4>
                    <p class="text-[10px] text-slate-400">RBAC & Accounts</p>
                </div>
            </a>

            <a href="{{ route('admin.categories') }}" class="p-5 rounded-3xl bg-white border border-slate-200 hover:border-purple-500 shadow-sm flex items-center gap-4 transition group">
                <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl group-hover:scale-110 transition">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-slate-900 font-heading">Categories Tree</h4>
                    <p class="text-[10px] text-slate-400">Manage Taxonomy</p>
                </div>
            </a>

            <a href="{{ route('admin.advertisements') }}" class="p-5 rounded-3xl bg-white border border-slate-200 hover:border-emerald-500 shadow-sm flex items-center gap-4 transition group">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl group-hover:scale-110 transition">
                    <i class="fa-solid fa-rectangle-ad"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-slate-900 font-heading">Banners & Ads</h4>
                    <p class="text-[10px] text-slate-400">Promotions</p>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Pending Verification Queue Table -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-bold font-heading text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-shield-halved text-amber-500"></i>
                        Pending KYC Verification Queue
                    </h3>
                    <a href="{{ route('admin.verification') }}" class="text-xs font-bold text-brand-600 hover:underline">View All</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-100 uppercase text-[10px]">
                                <th class="pb-3">Supplier</th>
                                <th class="pb-3">Doc Type</th>
                                <th class="pb-3">Date</th>
                                <th class="pb-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse($pendingDocuments as $doc)
                                <tr>
                                    <td class="py-3 font-bold text-slate-900 truncate max-w-[140px]">
                                        {{ $doc->supplier->company_name ?? 'Supplier' }}
                                    </td>
                                    <td class="py-3 uppercase text-[10px] font-bold text-brand-600">{{ str_replace('_', ' ', $doc->document_type) }}</td>
                                    <td class="py-3 text-slate-400">{{ $doc->created_at->diffForHumans() }}</td>
                                    <td class="py-3 text-right">
                                        <a href="{{ route('admin.verification') }}" class="px-2.5 py-1 rounded-lg bg-amber-500 text-slate-950 font-bold text-[10px] shadow-xs">Review</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-slate-400">No documents waiting for verification.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Registered Users Table -->
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-bold font-heading text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-user-plus text-brand-600"></i>
                        Recently Registered Accounts
                    </h3>
                    <a href="{{ route('admin.users') }}" class="text-xs font-bold text-brand-600 hover:underline">View All</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-100 uppercase text-[10px]">
                                <th class="pb-3">User</th>
                                <th class="pb-3">Role</th>
                                <th class="pb-3">Joined</th>
                                <th class="pb-3 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse($recentUsers as $u)
                                <tr>
                                    <td class="py-3">
                                        <div class="font-bold text-slate-900">{{ $u->name }}</div>
                                        <div class="text-[10px] text-slate-400">{{ $u->email }}</div>
                                    </td>
                                    <td class="py-3">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $u->role === 'supplier' ? 'bg-amber-100 text-amber-800' : ($u->role === 'buyer' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                            {{ $u->role }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-slate-400">{{ $u->created_at->format('M d') }}</td>
                                    <td class="py-3 text-right">
                                        <span class="text-emerald-600 font-bold text-[10px] uppercase">{{ $u->status }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-slate-400">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

@endsection
