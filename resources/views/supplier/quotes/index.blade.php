@extends('layouts.dashboard')

@section('title', 'Quotes Sent - Supplier Dashboard')
@section('page_title', 'Submitted Quotations Tracker')
@section('page_subtitle', 'Track status of your bids, accepted orders, and buyer feedback.')

@section('content')

    <div class="space-y-6">
        
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 border-b border-slate-200 uppercase tracking-wider text-[10px]">
                            <th class="py-4 px-6 font-bold">Requirement / Buyer</th>
                            <th class="py-4 px-4 font-bold">Quoted Unit Rate</th>
                            <th class="py-4 px-4 font-bold">Quantity</th>
                            <th class="py-4 px-4 font-bold">Lead Time</th>
                            <th class="py-4 px-4 font-bold">Validity</th>
                            <th class="py-4 px-4 font-bold">Status</th>
                            <th class="py-4 px-6 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($quotes as $q)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-4 px-6">
                                    <div class="font-bold text-slate-900 text-sm">
                                        <a href="{{ route('supplier.requirements.show', $q->requirement_id) }}" class="hover:text-brand-600">{{ $q->requirement->title ?? 'Buy Requirement' }}</a>
                                    </div>
                                    <span class="text-[10px] text-slate-400">Buyer: {{ $q->buyer->company_name ?? 'Procurement Buyer' }}</span>
                                </td>
                                <td class="py-4 px-4 font-extrabold text-emerald-600 text-sm font-heading">
                                    ₹{{ number_format($q->unit_price, 2) }}
                                </td>
                                <td class="py-4 px-4 font-bold text-slate-800">{{ number_format($q->quantity) }}</td>
                                <td class="py-4 px-4 font-semibold text-slate-700">{{ $q->delivery_time_days }} Days</td>
                                <td class="py-4 px-4 text-slate-500">{{ $q->validity_date ? $q->validity_date->format('d M Y') : '14 Days' }}</td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $q->status === 'accepted' ? 'bg-emerald-100 text-emerald-700' : ($q->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                                        {{ $q->status }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    @if($q->buyer && $q->buyer->user_id)
                                        <a href="{{ route('supplier.messages', ['user' => $q->buyer->user_id]) }}" class="px-3 py-1.5 bg-brand-50 hover:bg-brand-600 text-brand-700 hover:text-white font-bold text-xs rounded-xl transition inline-flex items-center gap-1">
                                            <i class="fa-solid fa-comments"></i> Chat
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    No quotations submitted yet. Browse the RFQ Lead Marketplace to submit bids!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $quotes->links() }}
            </div>
        </div>

    </div>

@endsection
