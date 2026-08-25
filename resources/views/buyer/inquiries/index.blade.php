@extends('layouts.dashboard')

@section('title', 'Product Inquiries - Buyer Dashboard')
@section('page_title', 'My Product Inquiries')
@section('page_subtitle', 'Track direct inquiries sent to suppliers and review vendor responses.')

@section('content')

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 border-b border-slate-200 uppercase tracking-wider text-[10px]">
                        <th class="py-4 px-6 font-bold">Product / Supplier</th>
                        <th class="py-4 px-4 font-bold">Required Qty</th>
                        <th class="py-4 px-4 font-bold">Target Price</th>
                        <th class="py-4 px-4 font-bold">Status</th>
                        <th class="py-4 px-6 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($inquiries as $inq)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900 text-sm">
                                    {{ $inq->product ? $inq->product->name : 'Direct Company Inquiry' }}
                                </div>
                                <div class="text-xs text-slate-500 font-semibold mt-0.5">
                                    Supplier: <a href="{{ route('suppliers.show', $inq->supplier->slug) }}" class="text-brand-600 hover:underline">{{ $inq->supplier->company_name }}</a>
                                </div>
                                <p class="text-[11px] text-slate-400 mt-1 line-clamp-1 italic">"{{ $inq->message }}"</p>
                            </td>
                            <td class="py-4 px-4 font-bold text-slate-800">{{ number_format($inq->quantity) }}</td>
                            <td class="py-4 px-4 font-bold text-emerald-600">{{ $inq->expected_price ? '₹' . number_format($inq->expected_price, 2) : 'Open' }}</td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $inq->status === 'accepted' ? 'bg-emerald-100 text-emerald-700' : ($inq->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700') }}">
                                    {{ $inq->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('buyer.messages', ['user' => $inq->supplier->user_id]) }}" class="px-3.5 py-1.5 bg-brand-50 hover:bg-brand-600 text-brand-700 hover:text-white font-bold text-xs rounded-xl transition inline-flex items-center gap-1">
                                    <i class="fa-solid fa-comments"></i> Chat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                You have not sent any product inquiries yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
