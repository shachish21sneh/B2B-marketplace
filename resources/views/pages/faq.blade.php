@extends('layouts.app')

@section('title', 'Frequently Asked Questions (FAQ) - NexTrade')

@section('content')

    <div class="bg-white border-b border-slate-200 py-12">
        <div class="max-w-4xl mx-auto px-4 text-center space-y-2">
            <h1 class="text-3xl font-extrabold font-heading text-slate-900">Frequently Asked Questions</h1>
            <p class="text-xs sm:text-sm text-slate-500">Everything you need to know about buying, selling, RFQs, and trust verification.</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 py-12 space-y-4">
        
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-2">
            <h3 class="text-sm font-bold text-slate-900 font-heading">1. How does Post Buy Requirement (RFQ) work?</h3>
            <p class="text-xs text-slate-600 leading-relaxed">
                As a buyer, you post your specific product requirements, desired quantity, target price, and destination. Verified suppliers matching your industry category are immediately notified and submit competitive quotations. You can compare all bids side-by-side and accept the best one.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-2">
            <h3 class="text-sm font-bold text-slate-900 font-heading">2. Is it free for buyers to use NexTrade?</h3>
            <p class="text-xs text-slate-600 leading-relaxed">
                Yes! Posting buy requirements, browsing wholesale catalogs, receiving quotations, and chatting with manufacturers is 100% free for all buyers.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-2">
            <h3 class="text-sm font-bold text-slate-900 font-heading">3. How are suppliers verified on NexTrade?</h3>
            <p class="text-xs text-slate-600 leading-relaxed">
                Suppliers undergo multi-tier authentication: GSTIN tax validation, PAN card verification, factory address checks, and ISO/MSME certificate audits. Verified suppliers receive specialized trust badges (GST, Business, KYC, Premium).
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-2">
            <h3 class="text-sm font-bold text-slate-900 font-heading">4. What membership plans are available for suppliers?</h3>
            <p class="text-xs text-slate-600 leading-relaxed">
                Suppliers can start with our Free Starter plan or upgrade to Business Gold (₹24,999/yr) or Enterprise Platinum (₹49,999/yr) for priority search ranking, unlimited RFQ bids, and dedicated account support.
            </p>
        </div>

    </div>

@endsection
