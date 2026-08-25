@extends('layouts.dashboard')

@section('title', 'Buyer Profile Settings - Ozura')
@section('page_title', 'Buyer Profile & Preferences')
@section('page_subtitle', 'Manage company details and security settings.')

@section('content')

    <div class="max-w-4xl space-y-8">
        
        <!-- Company & Contact Profile -->
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
            <h2 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3">
                Business & Contact Profile
            </h2>

            <form action="{{ route('buyer.profile.update') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Contact Person Name *</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Mobile / WhatsApp Number</label>
                        <input type="text" name="mobile" value="{{ old('mobile', $user->mobile) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Company Name *</label>
                        <input type="text" name="company_name" value="{{ old('company_name', $buyer->company_name ?? '') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Business Type</label>
                        <input type="text" name="business_type" value="{{ old('business_type', $buyer->business_type ?? '') }}" placeholder="e.g. Infrastructure Contractor, Retailer" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">GST Number (Optional)</label>
                        <input type="text" name="gst_number" value="{{ old('gst_number', $buyer->gst_number ?? '') }}" placeholder="27AAACA9876Q1Z2" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">City *</label>
                        <input type="text" name="city" value="{{ old('city', $buyer->city ?? '') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">State</label>
                        <input type="text" name="state" value="{{ old('state', $buyer->state ?? '') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Pincode</label>
                        <input type="text" name="pincode" value="{{ old('pincode', $buyer->pincode ?? '') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Office / Delivery Address</label>
                        <textarea name="address" rows="2" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">{{ old('address', $buyer->address ?? '') }}</textarea>
                    </div>
                </div>

                <div class="pt-3">
                    <button type="submit" class="px-6 py-3 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md transition">
                        Save Profile Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Security / Password change -->
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
            <h2 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3">
                Security & Password
            </h2>

            <form action="{{ route('buyer.profile.password') }}" method="POST" class="space-y-4 max-w-md">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Current Password *</label>
                    <input type="password" name="current_password" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    @error('current_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">New Password *</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Confirm New Password *</label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-6 py-3 rounded-2xl bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs shadow-md transition">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

    </div>

@endsection
