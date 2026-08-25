@extends('layouts.app')

@section('title', 'About Ozura - Leading B2B Marketplace Platform')
@section('meta_description', 'Learn about Ozura B2B, our mission to empower industrial manufacturers and wholesale buyers across India and globally.')

@section('content')

    <div class="bg-gradient-to-b from-brand-950 to-slate-900 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
            <span class="px-3 py-1 rounded-full bg-brand-500/20 text-brand-300 text-xs font-bold uppercase tracking-wider">Our Mission</span>
            <h1 class="text-3xl sm:text-5xl font-extrabold font-heading">Empowering Global B2B Commerce</h1>
            <p class="text-sm sm:text-base text-slate-300 max-w-2xl mx-auto">
                Ozura is the premier digital marketplace connecting authentic Indian manufacturers, industrial suppliers, and verified corporate buyers.
            </p>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-16">
        
        <!-- 3 Pillars -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm text-center space-y-3">
                <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center mx-auto text-2xl">
                    <i class="fa-solid fa-shield-check"></i>
                </div>
                <h3 class="text-base font-bold font-heading text-slate-900">100% Verified Suppliers</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Multi-tier KYC, GST validation and physical factory verification to guarantee commercial authenticity.</p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm text-center space-y-3">
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto text-2xl">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <h3 class="text-base font-bold font-heading text-slate-900">Instant RFQ Bidding</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Buyers receive competitive side-by-side quotations from verified manufacturers in under 2 hours.</p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm text-center space-y-3">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto text-2xl">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <h3 class="text-base font-bold font-heading text-slate-900">Direct Negotiation</h3>
                <p class="text-xs text-slate-500 leading-relaxed">WhatsApp-style real-time messaging allows seamless price negotiation and technical discussions.</p>
            </div>
        </div>

        <!-- Vision statement -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 sm:p-12 shadow-sm space-y-4">
            <h2 class="text-2xl font-extrabold font-heading text-slate-900">Revolutionizing Procurement for SMEs & Enterprises</h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                Whether you're sourcing high-precision CNC machinery, solar equipment, construction raw materials, or textiles, Ozura eliminates middle-tier brokers, providing transparent pricing directly from original factory floors.
            </p>
        </div>

    </div>

@endsection
