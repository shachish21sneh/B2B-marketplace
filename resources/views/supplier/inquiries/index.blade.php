@extends('layouts.dashboard')

@section('title', 'Inquiries Inbox - Supplier Dashboard')
@section('page_title', 'Buyer Inquiries Inbox')
@section('page_subtitle', 'Incoming product inquiries, commercial questions and requests for quotes.')

@section('content')

    <div class="space-y-6">
        
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 border-b border-slate-200 uppercase tracking-wider text-[10px]">
                            <th class="py-4 px-6 font-bold">Buyer / Company</th>
                            <th class="py-4 px-4 font-bold">Product Inquired</th>
                            <th class="py-4 px-4 font-bold">Quantity</th>
                            <th class="py-4 px-4 font-bold">Location</th>
                            <th class="py-4 px-4 font-bold">Status</th>
                            <th class="py-4 px-6 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($inquiries as $inq)
                            <tr class="hover:bg-slate-50/60 transition {{ $inq->status === 'new' ? 'bg-amber-50/30 font-semibold' : '' }}">
                                <td class="py-4 px-6">
                                    <div class="font-bold text-slate-900 text-sm flex items-center gap-2">
                                        {{ $inq->buyer_name }}
                                        @if($inq->status === 'new')
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        @endif
                                    </div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">{{ $inq->buyer_email }} • {{ $inq->buyer_phone }}</div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="font-bold text-brand-600 truncate max-w-xs">
                                        {{ $inq->product ? $inq->product->name : 'Storefront General Inquiry' }}
                                    </div>
                                    <p class="text-[11px] text-slate-400 line-clamp-1 italic mt-0.5">"{{ $inq->message }}"</p>
                                </td>
                                <td class="py-4 px-4 font-bold text-slate-800">{{ number_format($inq->quantity) }}</td>
                                <td class="py-4 px-4 text-slate-600">{{ $inq->delivery_location ?: 'India' }}</td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $inq->status === 'new' ? 'bg-amber-100 text-amber-700' : ($inq->status === 'accepted' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600') }}">
                                        {{ $inq->status }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('supplier.inquiries.show', $inq->id) }}" class="px-3.5 py-1.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl transition inline-flex items-center gap-1.5 shadow-sm">
                                        Review & Reply
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400">
                                    No incoming inquiries yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $inquiries->links() }}
            </div>
        </div>

    </div>

@endsection
