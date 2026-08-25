@extends('layouts.app')

@section('title', 'Join as Buyer - Source Wholesale Products | Ozura')

@section('content')

    <div class="min-h-[85vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl w-full space-y-6">
            
            <div class="text-center space-y-2">
                <div class="w-12 h-12 rounded-2xl bg-brand-600 text-white flex items-center justify-center mx-auto text-xl font-bold shadow-lg shadow-brand-500/25">
                    <i class="fa-solid fa-cart-flatbed"></i>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-900">Create Buyer Account</h1>
                <p class="text-xs text-slate-500">Post buy requirements, receive wholesale quotations and chat with verified suppliers.</p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-8 sm:p-10 shadow-xl">
                
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
                        <div class="font-bold flex items-center gap-2 mb-2 text-sm text-rose-900">
                            <i class="fa-solid fa-circle-exclamation text-rose-600"></i> Registration Errors:
                        </div>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('buyer.register') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Full Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Rajesh Kumar" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Mobile Number *</label>
                            <input type="text" name="mobile" value="{{ old('mobile') }}" required placeholder="+91 98765 43210" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            @error('mobile') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Company / Business Name *</label>
                            <input type="text" name="company_name" value="{{ old('company_name') }}" required placeholder="Apex Infra Projects Ltd" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            @error('company_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Business Type *</label>
                            <select name="business_type" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                                <option value="Corporate Buyer">Corporate Buyer</option>
                                <option value="Retailer / Reseller">Retailer / Reseller</option>
                                <option value="Contractor / Builder">Contractor / Builder</option>
                                <option value="Wholesaler">Wholesaler</option>
                                <option value="Individual Procurement">Individual Procurement</option>
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Business Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="rajesh@apexinfra.com" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">City *</label>
                            <input type="text" name="city" value="{{ old('city', 'Mumbai') }}" required placeholder="Mumbai" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">State</label>
                            <input type="text" name="state" value="{{ old('state', 'Maharashtra') }}" placeholder="Maharashtra" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Password *</label>
                            <input type="password" name="password" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                            @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Confirm Password *</label>
                            <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full py-4 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm shadow-lg shadow-brand-500/25 transition">
                            Complete Buyer Registration & Enter Dashboard
                        </button>
                    </div>

                </form>

                <div class="mt-6 pt-6 border-t border-slate-100 text-center text-xs text-slate-500">
                    <p>Already have an account? <a href="{{ route('login') }}" class="font-bold text-brand-600 hover:underline">Sign In</a></p>
                </div>

            </div>

        </div>
    </div>

@endsection
