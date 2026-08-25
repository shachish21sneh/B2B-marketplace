@extends('layouts.dashboard')

@section('title', 'Supplier Profile & KYC Verification - Ozura')
@section('page_title', 'Storefront Profile & Trust Verification')
@section('page_subtitle', 'Manage company details, branding, certifications, and upload KYC verification documents.')

@section('content')

    <div class="max-w-4xl space-y-8">
        
        <!-- Verification Status Banner -->
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Current Trust Level</span>
                    <div class="flex items-center gap-3 mt-1">
                        <h2 class="text-xl font-extrabold font-heading text-slate-900">{{ $supplier->verification_level }} Supplier</h2>
                        <x-verification_badge :level="$supplier->verification_level" />
                    </div>
                    <p class="text-xs text-slate-500 mt-1">
                        Status: <strong class="text-emerald-600 font-bold uppercase">{{ $supplier->verification_status }}</strong>
                        • Verified suppliers receive 8x more inquiries and higher search placement.
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <span class="px-3 py-1.5 rounded-xl bg-emerald-50 text-emerald-700 text-xs font-bold flex items-center gap-1.5">
                        <i class="fa-solid fa-shield-check text-emerald-600"></i> GST Verified
                    </span>
                    <span class="px-3 py-1.5 rounded-xl bg-blue-50 text-brand-700 text-xs font-bold flex items-center gap-1.5">
                        <i class="fa-solid fa-certificate text-brand-600"></i> ISO Compliant
                    </span>
                </div>
            </div>
        </div>

        <!-- Section 1: Storefront Profile & Details -->
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
            <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3">
                1. Company Branding & Details
            </h3>

            <form action="{{ route('supplier.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Company / Enterprise Legal Name *</label>
                        <input type="text" name="company_name" value="{{ old('company_name', $supplier->company_name) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Primary Business Type *</label>
                        <select name="business_type" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            <option value="Manufacturer" {{ $supplier->business_type == 'Manufacturer' ? 'selected' : '' }}>Manufacturer / OEM</option>
                            <option value="Wholesaler" {{ $supplier->business_type == 'Wholesaler' ? 'selected' : '' }}>Wholesaler / Bulk Trader</option>
                            <option value="Distributor" {{ $supplier->business_type == 'Distributor' ? 'selected' : '' }}>Authorized Distributor</option>
                            <option value="Exporter" {{ $supplier->business_type == 'Exporter' ? 'selected' : '' }}>Exporter / Importer</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Year Established</label>
                        <input type="number" name="year_established" value="{{ old('year_established', $supplier->year_established) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">GST Identification Number (GSTIN)</label>
                        <input type="text" name="gst_number" value="{{ old('gst_number', $supplier->gst_number) }}" placeholder="27AAACA9876Q1Z2" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Permanent Account Number (PAN)</label>
                        <input type="text" name="pan_number" value="{{ old('pan_number', $supplier->pan_number) }}" placeholder="AAACA9876Q" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Total Employee Count</label>
                        <input type="text" name="employees_count" value="{{ old('employees_count', $supplier->employees_count) }}" placeholder="e.g. 50-100 Employees" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Official Website URL</label>
                        <input type="url" name="website" value="{{ old('website', $supplier->website) }}" placeholder="https://..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Factory / Office Address *</label>
                        <input type="text" name="address" value="{{ old('address', $supplier->address) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">City *</label>
                        <input type="text" name="city" value="{{ old('city', $supplier->city) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">State *</label>
                        <input type="text" name="state" value="{{ old('state', $supplier->state) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Company Description & Manufacturing Infrastructure *</label>
                        <textarea name="description" rows="3" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">{{ old('description', $supplier->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Company Logo URL / File</label>
                        <input type="text" name="logo" value="{{ old('logo', $supplier->logo) }}" placeholder="https://..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Storefront Banner Image URL</label>
                        <input type="text" name="banner" value="{{ old('banner', $supplier->banner) }}" placeholder="https://..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>
                </div>

                <div class="pt-3">
                    <button type="submit" class="px-6 py-3 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md transition">
                        Update Storefront Profile
                    </button>
                </div>
            </form>
        </div>

        <!-- Section 2: KYC & Compliance Documents Center -->
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
            <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3 flex items-center justify-between">
                <span>2. Upload Verification & Compliance Documents</span>
                <span class="text-xs font-normal text-slate-500">For Gold/Premium Badges</span>
            </h3>

            <!-- Existing Documents Table -->
            @if($supplier->documents && $supplier->documents->isNotEmpty())
                <div class="border border-slate-200 rounded-2xl overflow-hidden divide-y divide-slate-100 text-xs">
                    @foreach($supplier->documents as $doc)
                        <div class="p-3.5 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-file-pdf text-red-500 text-base"></i>
                                <div>
                                    <strong class="text-slate-800">{{ $doc->document_name }}</strong>
                                    <span class="text-[10px] text-slate-400 block">Type: {{ $doc->document_type }}</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $doc->status === 'verified' ? 'bg-emerald-100 text-emerald-700' : ($doc->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                                {{ $doc->status }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Upload New Document Form -->
            <form action="{{ route('supplier.documents.upload') }}" method="POST" enctype="multipart/form-data" class="p-5 bg-slate-50 border border-slate-200 rounded-2xl space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Document Type *</label>
                        <select name="document_type" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs">
                            <option value="gst_certificate">GST Certificate</option>
                            <option value="pan_card">Company PAN Card</option>
                            <option value="business_license">Udyam / MSME Registration</option>
                            <option value="iso_certificate">ISO Quality Certification</option>
                            <option value="factory_photo">Factory & Machine Photos</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Document Name / Title *</label>
                        <input type="text" name="document_name" required placeholder="e.g. GST Registration Certificate 2026" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Choose File (PDF/Image) *</label>
                        <input type="file" name="file" required class="w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                    </div>
                </div>

                <button type="submit" class="px-5 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition">
                    Upload for Admin KYC Verification
                </button>
            </form>
        </div>

    </div>

@endsection
