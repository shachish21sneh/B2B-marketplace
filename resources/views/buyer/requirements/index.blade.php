@extends('layouts.dashboard')

@section('title', 'My Buy Requirements (RFQs) - Buyer Dashboard')
@section('page_title', 'My Buy Requirements (RFQs)')
@section('page_subtitle', 'Track your posted requirements, review incoming quotes, and compare bids.')

@section('content')

    <div class="space-y-6">
        
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold font-heading text-slate-900">All Requirements</h2>
            <a href="{{ route('requirements.create') }}" class="px-5 py-2.5 rounded-2xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs shadow-md shadow-amber-500/20 transition flex items-center gap-2">
                <i class="fa-solid fa-plus text-xs"></i> Post New Requirement
            </a>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 border-b border-slate-200 uppercase tracking-wider text-[10px]">
                            <th class="py-4 px-6 font-bold">Requirement Title</th>
                            <th class="py-4 px-4 font-bold">Category</th>
                            <th class="py-4 px-4 font-bold">Quantity</th>
                            <th class="py-4 px-4 font-bold">Target Price</th>
                            <th class="py-4 px-4 font-bold">Quotes</th>
                            <th class="py-4 px-4 font-bold">Status</th>
                            <th class="py-4 px-6 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($requirements as $req)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-4 px-6">
                                    <a href="{{ route('buyer.requirements.show', $req->id) }}" class="font-bold text-slate-900 hover:text-brand-600 text-sm block">
                                        {{ $req->title }}
                                    </a>
                                    <span class="text-[10px] text-slate-400">Posted on {{ $req->created_at->format('M d, Y') }} • {{ $req->delivery_location }}</span>
                                </td>
                                <td class="py-4 px-4 font-semibold text-slate-600">{{ $req->category->name ?? 'General' }}</td>
                                <td class="py-4 px-4 font-bold text-slate-800">{{ number_format($req->quantity) }} {{ $req->quantity_unit }}</td>
                                <td class="py-4 px-4 font-bold text-emerald-600">{{ $req->target_price ? '₹' . number_format($req->target_price, 2) : 'Negotiable' }}</td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $req->quotes_count > 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $req->quotes_count }} Quotes
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $req->status === 'open' ? 'bg-blue-100 text-blue-700' : ($req->status === 'quoted' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600') }}">
                                        {{ $req->status }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    @if($req->quotes_count > 1)
                                        <a href="{{ route('buyer.requirements.compare', $req->id) }}" class="px-3 py-1.5 bg-gradient-to-r from-brand-600 to-indigo-600 text-white font-bold rounded-xl text-[11px] shadow-sm hover:opacity-90 transition">
                                            Compare Bids
                                        </a>
                                    @endif
                                    <a href="{{ route('buyer.requirements.show', $req->id) }}" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold rounded-xl text-[11px] transition">
                                        View Quotes
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    You have not posted any buy requirements yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($requirements instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="p-4 border-t border-slate-100">
                    {{ $requirements->links() }}
                </div>
            @endif
        </div>

    </div>

@endsection
