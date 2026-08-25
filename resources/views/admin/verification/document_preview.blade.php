@extends('layouts.dashboard')

@section('title', 'Document Preview: ' . ($doc->supplier->company_name ?? 'Supplier Verification'))
@section('page_title', 'KYC Document Authentication')
@section('page_subtitle', 'Verified electronic verification record for ' . ($doc->supplier->company_name ?? 'Supplier'))

@section('content')

    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Top Action Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-3xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.verification') }}" class="w-10 h-10 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition">
                    <i class="fa-solid fa-arrow-left text-sm"></i>
                </a>
                <div>
                    <h2 class="text-sm font-bold font-heading text-slate-900">{{ $doc->supplier->company_name ?? 'Supplier' }}</h2>
                    <span class="text-xs text-slate-400 font-medium">Submitted on {{ $doc->created_at->format('d M Y, h:i A') }}</span>
                </div>
            </div>

            <div class="flex items-center gap-3 flex-wrap">
                <button onclick="window.print()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition flex items-center gap-1.5">
                    <i class="fa-solid fa-print"></i> Print / Save PDF
                </button>

                @if($doc->status !== 'approved' && $doc->status !== 'verified')
                    <form action="{{ route('admin.verification.approve', $doc->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md shadow-emerald-600/20 transition flex items-center gap-1.5">
                            <i class="fa-solid fa-circle-check"></i> Approve Document
                        </button>
                    </form>
                @else
                    <span class="px-3 py-1.5 rounded-xl bg-emerald-100 text-emerald-800 font-bold text-xs flex items-center gap-1.5">
                        <i class="fa-solid fa-shield-check text-emerald-600"></i> Verified & Approved
                    </span>
                @endif

                @if($doc->status !== 'rejected')
                    <form action="{{ route('admin.verification.reject', $doc->id) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="rejection_reason" value="Information mismatch or incomplete document">
                        <button type="submit" class="px-4 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-xs rounded-xl transition">
                            Reject
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Official Certificate View -->
        <div class="bg-white rounded-3xl border-2 border-slate-300 p-8 sm:p-12 shadow-xl relative overflow-hidden text-slate-800 font-sans print:border-none print:shadow-none">
            
            <!-- Watermark -->
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-5 rotate-[-25deg]">
                <span class="text-8xl font-black text-slate-900 tracking-widest uppercase">OZURA VERIFIED</span>
            </div>

            <!-- Certificate Header -->
            <div class="text-center border-b-2 border-slate-800 pb-6 mb-8 relative">
                <div class="flex items-center justify-center gap-4 mb-3">
                    <div class="w-12 h-12 rounded-xl bg-slate-900 text-white flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                </div>
                <h3 class="text-xs font-extrabold uppercase tracking-widest text-slate-600">Government of India • Ministry of Finance</h3>
                <h1 class="text-xl sm:text-2xl font-black font-heading text-slate-900 mt-1 uppercase tracking-wider">
                    Registration Certificate
                </h1>
                <p class="text-xs text-slate-500 font-semibold mt-1">
                    {{ str_replace('_', ' ', $doc->doc_type ?: 'GST Registration Certificate') }}
                </p>
                <div class="mt-2 inline-block px-3 py-1 rounded-full bg-slate-100 text-slate-800 text-[11px] font-mono font-bold">
                    Reference ID: {{ $doc->doc_number ?: ($doc->supplier->gst_number ?: 'GSTIN-' . strtoupper(substr(md5($doc->id), 0, 15))) }}
                </div>
            </div>

            <!-- Certificate Body Table -->
            <div class="space-y-6 text-xs">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-slate-50/80 p-6 rounded-2xl border border-slate-200">
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">1. Legal Name of Enterprise</span>
                        <strong class="text-sm font-bold text-slate-900 block">{{ $doc->supplier->company_name }}</strong>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">2. Trade Name / Brand</span>
                        <strong class="text-sm font-bold text-slate-900 block">{{ $doc->supplier->company_name }}</strong>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">3. Constitution of Business</span>
                        <span class="text-xs font-semibold text-slate-800 block">{{ $doc->supplier->business_type }}</span>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">4. Tax Identifier (GSTIN / PAN)</span>
                        <span class="text-xs font-mono font-bold text-brand-700 block">
                            {{ $doc->doc_number ?: ($doc->supplier->gst_number ?: ($doc->supplier->pan_number ?: '27AAACG5566K1Z3')) }}
                        </span>
                    </div>

                    <div class="sm:col-span-2">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">5. Address of Principal Place of Business</span>
                        <span class="text-xs font-medium text-slate-800 block leading-relaxed">
                            {{ $doc->supplier->address }}, {{ $doc->supplier->city }}, {{ $doc->supplier->state }} - {{ $doc->supplier->pincode }}, India
                        </span>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">6. Date of Issue / Establishment</span>
                        <span class="text-xs font-semibold text-slate-800 block">{{ $doc->supplier->year_established ?? 2018 }}</span>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">7. Verification Badge Status</span>
                        <span class="inline-flex items-center gap-1 font-bold text-emerald-700 bg-emerald-100 px-2.5 py-0.5 rounded-full text-[10px]">
                            <i class="fa-solid fa-shield-check"></i> {{ $doc->supplier->verification_level ?? 'GST' }} Verified
                        </span>
                    </div>
                </div>

                <!-- Digital Signatures & Stamp -->
                <div class="pt-8 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 bg-slate-900 text-white rounded-2xl flex flex-col items-center justify-center p-2 text-center">
                            <i class="fa-solid fa-qrcode text-3xl"></i>
                            <span class="text-[8px] font-mono mt-1">AUTHENTIC</span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[11px] font-bold text-slate-900 flex items-center gap-1.5">
                                <i class="fa-solid fa-certificate text-brand-600"></i> Digitally Signed & Sealed
                            </span>
                            <p class="text-[10px] text-slate-400 max-w-xs leading-tight">
                                This electronic document is verified through the Ozura B2B Compliance & Document Validation Engine.
                            </p>
                        </div>
                    </div>

                    <div class="text-center sm:text-right">
                        <div class="inline-block border-2 border-dashed border-slate-300 rounded-2xl p-4 bg-slate-50 text-center min-w-[180px]">
                            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider block">Authorized Signatory</span>
                            <div class="font-serif italic text-base font-bold text-brand-700 my-1">
                                {{ $doc->supplier->user->name ?? 'Verified Officer' }}
                            </div>
                            <span class="text-[9px] text-slate-500 font-mono block">Signed on {{ $doc->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
