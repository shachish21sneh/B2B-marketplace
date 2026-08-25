@extends('layouts.dashboard')

@section('title', 'KYC & GST Verification Center - Super Admin')
@section('page_title', 'Supplier Verification & KYC Approvals')
@section('page_subtitle', 'Review uploaded documents, authenticate GST/PAN/ISO and grant trust badges.')

@section('content')

    <div class="space-y-8">
        
        <!-- Verification Queue Table -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-base font-bold font-heading text-slate-900">Document Review Queue ({{ $documents->count() }})</h3>
                <span class="text-xs text-slate-400 font-semibold">Verify authentic documents to prevent fraud</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 border-b border-slate-200 uppercase tracking-wider text-[10px]">
                            <th class="py-4 px-6 font-bold">Supplier / Company</th>
                            <th class="py-4 px-4 font-bold">Document Type</th>
                            <th class="py-4 px-4 font-bold">File / Title</th>
                            <th class="py-4 px-4 font-bold">Submitted Date</th>
                            <th class="py-4 px-4 font-bold">Current Status</th>
                            <th class="py-4 px-6 font-bold text-right">Verification Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($documents as $doc)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-4 px-6">
                                    <div class="font-bold text-slate-900 text-sm">
                                        {{ $doc->supplier->company_name ?? 'Supplier' }}
                                    </div>
                                    <div class="text-[10px] text-slate-400">
                                        GSTIN: {{ $doc->supplier->gst_number ?: 'Not provided' }} • {{ $doc->supplier->city }}, {{ $doc->supplier->state }}
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 font-bold uppercase text-[10px]">
                                        {{ str_replace('_', ' ', $doc->document_type) }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <strong class="text-slate-800 block">{{ $doc->document_name }}</strong>
                                    <a href="{{ $doc->file_path }}" target="_blank" class="text-brand-600 font-bold hover:underline text-[10px] inline-flex items-center gap-1 mt-0.5">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Attachment
                                    </a>
                                </td>
                                <td class="py-4 px-4 text-slate-500">{{ $doc->created_at->format('M d, Y') }}</td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $doc->status === 'verified' ? 'bg-emerald-100 text-emerald-700' : ($doc->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                                        {{ $doc->status }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    @if($doc->status !== 'verified')
                                        <form action="{{ route('admin.verification.approve', $doc->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px] rounded-xl shadow-xs transition">
                                                <i class="fa-solid fa-check mr-1"></i> Approve
                                            </button>
                                        </form>
                                    @endif
                                    @if($doc->status !== 'rejected')
                                        <form action="{{ route('admin.verification.reject', $doc->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 font-bold text-[11px] rounded-xl transition">
                                                Reject
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400">
                                    No pending verification documents in queue.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $documents->links() }}
            </div>
        </div>

        <!-- Supplier Level & Badging Quick Manager -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 space-y-4">
            <h3 class="text-base font-bold font-heading text-slate-900">Assign Trust & Verification Levels to Suppliers</h3>
            <p class="text-xs text-slate-500">Upgrade suppliers between Basic, GST Verified, Business Verified, KYC Verified, and Premium Platinum.</p>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-100 uppercase text-[10px]">
                            <th class="pb-3">Company</th>
                            <th class="pb-3">GSTIN</th>
                            <th class="pb-3">Current Trust Level</th>
                            <th class="pb-3 text-right">Update Trust Level</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach($suppliers as $s)
                            <tr>
                                <td class="py-3 font-bold text-slate-900">{{ $s->company_name }}</td>
                                <td class="py-3 font-mono">{{ $s->gst_number ?: 'N/A' }}</td>
                                <td class="py-3">
                                    <x-verification_badge :level="$s->verification_level" />
                                </td>
                                <td class="py-3 text-right">
                                    <form action="{{ route('admin.verification.level', $s->id) }}" method="POST" class="inline-flex items-center gap-2">
                                        @csrf
                                        <select name="verification_level" class="px-2.5 py-1 bg-slate-50 border border-slate-200 rounded-lg text-xs font-semibold">
                                            <option value="Basic" {{ $s->verification_level == 'Basic' ? 'selected' : '' }}>Basic</option>
                                            <option value="GST" {{ $s->verification_level == 'GST' ? 'selected' : '' }}>GST Verified</option>
                                            <option value="Business" {{ $s->verification_level == 'Business' ? 'selected' : '' }}>Business Verified</option>
                                            <option value="KYC" {{ $s->verification_level == 'KYC' ? 'selected' : '' }}>KYC Verified</option>
                                            <option value="Premium" {{ $s->verification_level == 'Premium' ? 'selected' : '' }}>Premium Gold</option>
                                        </select>
                                        <button type="submit" class="px-3 py-1 bg-brand-600 text-white font-bold rounded-lg text-[11px]">Save</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
