@extends('layouts.dashboard')

@section('title', 'User Directory & RBAC - Super Admin')
@section('page_title', 'User Accounts & Roles')
@section('page_subtitle', 'Manage buyers, suppliers, administrators and control account access.')

@section('content')

    <div class="space-y-6">
        
        <!-- Filter Controls -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 shadow-sm">
            <form action="{{ route('admin.users') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by name, email or phone..." class="px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                
                <select name="role" class="px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="supplier" {{ request('role') == 'supplier' ? 'selected' : '' }}>Supplier</option>
                    <option value="buyer" {{ request('role') == 'buyer' ? 'selected' : '' }}>Buyer</option>
                </select>

                <select name="status" class="px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:outline-none">
                    <option value="">All Statuses</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive / Banned</option>
                </select>

                <div class="flex items-center gap-2">
                    <button type="submit" class="flex-1 py-2 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md transition">Filter</button>
                    <a href="{{ route('admin.users') }}" class="px-3.5 py-2 bg-slate-100 text-slate-700 font-bold text-xs rounded-xl transition">Reset</a>
                </div>
            </form>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 border-b border-slate-200 uppercase tracking-wider text-[10px]">
                            <th class="py-4 px-6 font-bold">User Name & Email</th>
                            <th class="py-4 px-4 font-bold">Role</th>
                            <th class="py-4 px-4 font-bold">Mobile</th>
                            <th class="py-4 px-4 font-bold">Entity Name</th>
                            <th class="py-4 px-4 font-bold">Joined Date</th>
                            <th class="py-4 px-4 font-bold">Status</th>
                            <th class="py-4 px-6 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($users as $u)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-4 px-6">
                                    <div class="font-bold text-slate-900 text-sm">{{ $u->name }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $u->email }}</div>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $u->role === 'supplier' ? 'bg-amber-100 text-amber-800' : ($u->role === 'buyer' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                        {{ $u->role }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 font-semibold">{{ $u->mobile ?: 'N/A' }}</td>
                                <td class="py-4 px-4 font-medium text-slate-800">
                                    {{ $u->supplier ? $u->supplier->company_name : ($u->buyer ? $u->buyer->company_name : 'Platform Staff') }}
                                </td>
                                <td class="py-4 px-4 text-slate-500">{{ $u->created_at->format('M d, Y') }}</td>
                                <td class="py-4 px-4">
                                    <form action="{{ route('admin.users.toggle', $u->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $u->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $u->status }}
                                        </button>
                                    </form>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    @if($u->supplier)
                                        <a href="{{ route('suppliers.show', $u->supplier->slug) }}" target="_blank" class="text-brand-600 font-bold hover:underline text-xs">
                                            Storefront
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">No users found matching criteria.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $users->links() }}
            </div>
        </div>

    </div>

@endsection
