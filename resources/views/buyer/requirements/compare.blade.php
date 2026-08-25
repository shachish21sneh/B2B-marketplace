@extends('layouts.dashboard')

@section('title', 'Side-by-Side Quote Comparison - Ozura')
@section('page_title', 'Side-by-Side Quotation Comparison')
@section('page_subtitle', 'Evaluate supplier bids, delivery lead times, MOQs and verification badges.')

@section('content')

    <div class="space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('buyer.requirements.show', $requirement->id) }}" class="text-xs font-bold text-brand-600 hover:underline flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Back to Requirement Details
            </a>
            <span class="text-xs text-slate-500 font-semibold">Comparing {{ $quotes->count() }} Supplier Quotations</span>
        </div>

        <!-- Requirement Summary Card -->
        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-brand-600 bg-brand-50 px-2.5 py-0.5 rounded-full">
                        {{ $requirement->category->name ?? 'General' }}
                    </span>
                    <h2 class="text-lg font-bold font-heading text-slate-900 mt-1">{{ $requirement->title }}</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Required Quantity: <strong class="text-slate-800">{{ number_format($requirement->quantity) }} {{ $requirement->quantity_unit }}</strong> | Destination: {{ $requirement->delivery_location }}</p>
                </div>
                <div>
                    <span class="text-xs text-slate-400 block">Target Budget</span>
                    <span class="text-lg font-extrabold font-heading text-slate-900">{{ $requirement->target_price ? '₹' . number_format($requirement->target_price, 2) : 'Negotiable' }}</span>
                </div>
            </div>
        </div>

        <!-- Side-by-Side Comparison Matrix Table -->
        @if($quotes->isEmpty())
            <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 text-slate-500 text-xs">
                No quotations submitted for this requirement yet.
            </div>
        @else
            <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-x-auto">
                <table class="w-full text-left text-xs min-w-[700px]">
                    <thead>
                        <tr class="bg-slate-900 text-white divide-x divide-slate-800 text-xs">
                            <th class="p-5 font-bold uppercase tracking-wider w-48 bg-slate-950">Comparison Metric</th>
                            @foreach($quotes as $q)
                                <th class="p-5 font-bold text-center">
                                    <div class="text-sm font-extrabold font-heading text-white truncate">{{ $q->supplier->company_name }}</div>
                                    <div class="mt-1 flex items-center justify-center gap-1.5">
                                        <x-verification_badge :level="$q->supplier->verification_level" />
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 divide-x divide-slate-100">
                        
                        <!-- Metric 1: Unit Price -->
                        <tr class="bg-slate-50/70 font-bold">
                            <td class="p-4 text-slate-900">Quoted Unit Price</td>
                            @foreach($quotes as $q)
                                <td class="p-4 text-center">
                                    <div class="text-base font-extrabold text-emerald-600 font-heading">
                                        ₹{{ number_format($q->unit_price, 2) }}
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-normal">per {{ $requirement->quantity_unit }}</span>
                                </td>
                            @endforeach
                        </tr>

                        <!-- Metric 2: Total Estimated Cost -->
                        <tr>
                            <td class="p-4 font-bold text-slate-900">Total Order Cost</td>
                            @foreach($quotes as $q)
                                <td class="p-4 text-center font-extrabold text-slate-900">
                                    ₹{{ number_format(($q->unit_price * $requirement->quantity) + $q->shipping_charges, 2) }}
                                    @if($q->shipping_charges > 0)
                                        <span class="block text-[10px] text-slate-400 font-normal">(Incl. ₹{{ number_format($q->shipping_charges) }} shipping)</span>
                                    @else
                                        <span class="block text-[10px] text-emerald-600 font-semibold">(Free Shipping)</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>

                        <!-- Metric 3: Minimum Order Quantity (MOQ) -->
                        <tr class="bg-slate-50/40">
                            <td class="p-4 font-bold text-slate-900">Supplier MOQ</td>
                            @foreach($quotes as $q)
                                <td class="p-4 text-center font-semibold text-slate-800">
                                    {{ number_format($q->moq) }} {{ $requirement->quantity_unit }}
                                </td>
                            @endforeach
                        </tr>

                        <!-- Metric 4: Lead Time / Delivery Days -->
                        <tr>
                            <td class="p-4 font-bold text-slate-900">Estimated Delivery Time</td>
                            @foreach($quotes as $q)
                                <td class="p-4 text-center font-semibold text-slate-800">
                                    <span class="px-2.5 py-1 rounded-full bg-blue-50 text-brand-700 text-xs font-bold">
                                        <i class="fa-solid fa-truck text-[10px] mr-1"></i> {{ $q->delivery_time_days }} Days
                                    </span>
                                </td>
                            @endforeach
                        </tr>

                        <!-- Metric 5: Payment Terms -->
                        <tr class="bg-slate-50/40">
                            <td class="p-4 font-bold text-slate-900">Payment Terms</td>
                            @foreach($quotes as $q)
                                <td class="p-4 text-center text-xs font-medium text-slate-700">
                                    {{ $q->payment_terms }}
                                </td>
                            @endforeach
                        </tr>

                        <!-- Metric 6: Supplier Rating & Location -->
                        <tr>
                            <td class="p-4 font-bold text-slate-900">Supplier Reputation</td>
                            @foreach($quotes as $q)
                                <td class="p-4 text-center text-xs">
                                    <div class="font-bold text-amber-500 flex items-center justify-center gap-1">
                                        <i class="fa-solid fa-star"></i> {{ $q->supplier->rating_avg ?: '4.9' }}
                                        <span class="text-slate-400 font-normal">({{ $q->supplier->reviews_count }} reviews)</span>
                                    </div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">
                                        {{ $q->supplier->city }}, {{ $q->supplier->state }}
                                    </div>
                                </td>
                            @endforeach
                        </tr>

                        <!-- Metric 7: Quote Validity -->
                        <tr class="bg-slate-50/40">
                            <td class="p-4 font-bold text-slate-900">Quote Validity</td>
                            @foreach($quotes as $q)
                                <td class="p-4 text-center text-xs text-slate-600">
                                    {{ $q->validity_date ? $q->validity_date->format('d M Y') : '14 Days' }}
                                </td>
                            @endforeach
                        </tr>

                        <!-- Metric 8: Additional Notes -->
                        <tr>
                            <td class="p-4 font-bold text-slate-900">Supplier Remarks</td>
                            @foreach($quotes as $q)
                                <td class="p-4 text-center text-xs text-slate-600 italic">
                                    "{{ $q->notes ?: 'Standard quotation provided.' }}"
                                </td>
                            @endforeach
                        </tr>

                        <!-- Metric 9: Actions -->
                        <tr class="bg-slate-100/60">
                            <td class="p-5 font-bold text-slate-900">Decision / Action</td>
                            @foreach($quotes as $q)
                                <td class="p-5 text-center space-y-2">
                                    @if($q->status === 'accepted')
                                        <div class="px-4 py-2 rounded-xl bg-emerald-600 text-white font-bold text-xs flex items-center justify-center gap-1.5 shadow-md">
                                            <i class="fa-solid fa-check"></i> Accepted
                                        </div>
                                    @else
                                        <form action="{{ route('buyer.quotes.accept', $q->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition">
                                                Accept Quotation
                                            </button>
                                        </form>
                                        <a href="{{ route('buyer.messages', ['user' => $q->supplier->user_id]) }}" class="block w-full py-2 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-800 font-semibold text-[11px] transition">
                                            <i class="fa-solid fa-comments text-brand-600 mr-1"></i> Negotiate in Chat
                                        </a>
                                    @endif
                                </td>
                            @endforeach
                        </tr>

                    </tbody>
                </table>
            </div>
        @endif

    </div>

@endsection
