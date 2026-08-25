@extends('layouts.dashboard')

@section('title', 'RFQs & Buy Requirements Moderation - Super Admin')
@section('page_title', 'Buy Requirements & RFQs Moderation')
@section('page_subtitle', 'Audit public buying tenders, verify genuine buyer intent and manage quotes.')

@section('content')

    <div class="space-y-6">
        
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 border-b border-slate-200 uppercase tracking-wider text-[10px]">
                            <th class="py-4 px-6 font-bold">Requirement Title</th>
                            <th class="py-4 px-4 font-bold">Buyer</th>
                            <th class="py-4 px-4 font-bold">Category</th>
                            <th class="py-4 px-4 font-bold">Quantity</th>
                            <th class="py-4 px-4 font-bold">Quotes</th>
                            <th class="py-4 px-4 font-bold">Status</th>
                            <th class="py-4 px-6 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($requirements as $rfq)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-4 px-6">
                                    <a href="{{ route('requirements.show', $rfq->id) }}" target="_blank" class="font-bold text-slate-900 hover:text-brand-600 truncate max-w-xs block">
                                        {{ $rfq->title }}
                                    </a>
                                    <span class="text-[10px] text-slate-400">Target: {{ $rfq->target_price ? '₹' . number_format($rfq->target_price, 2) : 'Open' }} • {{ $rfq->delivery_location }}</span>
                                </td>
                                <td class="py-4 px-4 font-semibold text-slate-800">{{ $rfq->buyer->company_name ?? 'Buyer' }}</td>
                                <td class="py-4 px-4 text-slate-600">{{ $rfq->category->name ?? 'General' }}</td>
                                <td class="py-4 px-4 font-bold text-slate-900">{{ number_format($rfq->quantity) }} {{ $rfq->quantity_unit }}</td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $rfq->quotes->count() > 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $rfq->quotes->count() }} Bids
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $rfq->status === 'open' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $rfq->status }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <form action="{{ route('admin.requirements.destroy', $rfq->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this requirement?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1.5 bg-slate-100 hover:bg-red-50 hover:text-red-600 rounded-xl font-bold text-xs transition">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">No requirements found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $requirements->links() }}
            </div>
        </div>

    </div>

@endsection
