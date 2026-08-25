@extends('layouts.app')

@section('title', $requirement->title . ' - Buy Requirement | Ozura')

@section('content')

    <div class="bg-white border-b border-slate-200 py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('home') }}" class="hover:text-brand-600">Home</a>
                <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                <a href="{{ route('requirements.index') }}" class="hover:text-brand-600">Buy Requirements</a>
                <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                <span class="text-slate-800 font-semibold truncate">{{ $requirement->title }}</span>
            </nav>
            <div class="flex items-center justify-between gap-4">
                <h1 class="text-xl sm:text-2xl font-extrabold font-heading text-slate-900 leading-tight">
                    {{ $requirement->title }}
                </h1>
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $requirement->status === 'open' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                    Status: {{ $requirement->status }}
                </span>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left: RFQ Details -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
                    <div>
                        <h2 class="text-base font-bold font-heading text-slate-900 mb-3">Requirement Specifications</h2>
                        <div class="text-xs sm:text-sm text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50 p-4 rounded-2xl border border-slate-200">
                            {{ $requirement->description }}
                        </div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-xs">
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Quantity</span>
                            <strong class="text-slate-900 text-sm">{{ number_format($requirement->quantity) }} {{ $requirement->quantity_unit }}</strong>
                        </div>
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Target Price</span>
                            <strong class="text-emerald-600 text-sm">{{ $requirement->target_price ? '₹' . number_format($requirement->target_price, 2) : 'Negotiable' }}</strong>
                        </div>
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Delivery Location</span>
                            <strong class="text-slate-900 text-xs">{{ $requirement->delivery_location }}</strong>
                        </div>
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Required By</span>
                            <strong class="text-slate-900 text-xs">{{ $requirement->required_by ? $requirement->required_by->format('d M Y') : 'Immediate' }}</strong>
                        </div>
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Payment Terms</span>
                            <strong class="text-slate-900 text-xs">{{ $requirement->payment_terms ?: 'Standard B2B Terms' }}</strong>
                        </div>
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Quotes Received</span>
                            <strong class="text-brand-600 text-sm">{{ $requirement->quotes->count() }} Quotes</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Submit Quote / Buyer Box -->
            <div class="space-y-6">
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                    <h3 class="text-sm font-bold font-heading text-slate-900 uppercase tracking-wider">Are you a Supplier?</h3>
                    <p class="text-xs text-slate-500">Submit your best quotation and commercial terms to this verified buyer.</p>

                    @if(Auth::check() && Auth::user()->isSupplier())
                        <a href="{{ route('supplier.requirements.show', $requirement->id) }}" class="block w-full py-3 rounded-2xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs text-center shadow-lg shadow-amber-500/25 transition">
                            Submit Quotation Now
                        </a>
                    @elseif(Auth::check())
                        <p class="text-xs text-amber-700 bg-amber-50 p-3 rounded-xl">You are logged in as a Buyer. Suppliers can submit quotes directly.</p>
                    @else
                        <a href="{{ route('login') }}" class="block w-full py-3 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs text-center shadow-md transition">
                            Log In to Quote
                        </a>
                        <a href="{{ route('supplier.register') }}" class="block w-full py-2.5 rounded-2xl bg-slate-100 text-slate-800 font-bold text-xs text-center transition">
                            Register as Supplier
                        </a>
                    @endif
                </div>

                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-3 text-xs">
                    <h4 class="font-bold text-slate-900">Buyer Information</h4>
                    <p class="text-slate-500">Company: <strong class="text-slate-800">{{ $requirement->buyer->company_name ?? 'Verified Procurement Buyer' }}</strong></p>
                    <p class="text-slate-500">Location: <strong class="text-slate-800">{{ $requirement->buyer->city ?? $requirement->delivery_location }}</strong></p>
                    <p class="text-slate-500">Posted on: <strong class="text-slate-800">{{ $requirement->created_at->format('M d, Y') }}</strong></p>
                </div>
            </div>

        </div>
    </div>

@endsection
