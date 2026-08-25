@extends('layouts.app')

@section('title', 'Sign In to Your Account - NexTrade B2B')

@section('content')

    <div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-6">
            
            <div class="text-center space-y-2">
                <div class="w-12 h-12 rounded-2xl bg-brand-600 text-white flex items-center justify-center mx-auto text-xl font-bold shadow-lg shadow-brand-500/25">
                    <i class="fa-solid fa-cubes"></i>
                </div>
                <h1 class="text-2xl font-extrabold font-heading text-slate-900">Sign in to NexTrade</h1>
                <p class="text-xs text-slate-500">Access your Buyer or Supplier Dashboard</p>
            </div>

            <!-- Quick Demo Login Account Bar (For Instant Testing) -->
            <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 text-xs">
                <p class="font-bold text-amber-900 mb-2 flex items-center gap-1.5">
                    <i class="fa-solid fa-key text-amber-600"></i> Instant Demo Login (Click to Autofill):
                </p>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" onclick="fillLogin('admin@nextrade.com', 'password')" class="p-2 rounded-xl bg-white border border-amber-200 hover:border-amber-500 text-amber-950 font-bold text-center shadow-xs transition">
                        Admin
                    </button>
                    <button type="button" onclick="fillLogin('supplier@nextrade.com', 'password')" class="p-2 rounded-xl bg-white border border-amber-200 hover:border-amber-500 text-amber-950 font-bold text-center shadow-xs transition">
                        Supplier
                    </button>
                    <button type="button" onclick="fillLogin('buyer@nextrade.com', 'password')" class="p-2 rounded-xl bg-white border border-amber-200 hover:border-amber-500 text-amber-950 font-bold text-center shadow-xs transition">
                        Buyer
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-xl">
                
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Email Address *</label>
                        <input type="email" name="email" id="loginEmail" value="{{ old('email', 'supplier@nextrade.com') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs font-bold text-slate-700">Password *</label>
                        </div>
                        <input type="password" name="password" id="loginPassword" value="password" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-between text-xs">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                            <span class="text-slate-600">Remember me</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full py-3.5 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm shadow-lg shadow-brand-500/25 transition">
                        Sign In
                    </button>

                </form>

                <div class="mt-6 pt-6 border-t border-slate-100 text-center text-xs text-slate-500 space-y-2">
                    <p>Don't have an account yet?</p>
                    <div class="flex items-center justify-center gap-4 font-bold">
                        <a href="{{ route('buyer.register') }}" class="text-brand-600 hover:underline">Register as Buyer</a>
                        <span>•</span>
                        <a href="{{ route('supplier.register') }}" class="text-emerald-600 hover:underline">Register as Supplier</a>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>
        function fillLogin(email, pass) {
            document.getElementById('loginEmail').value = email;
            document.getElementById('loginPassword').value = pass;
        }
    </script>

@endsection
