@extends('layouts.dashboard')

@section('title', 'Platform Settings & Configurations - Super Admin')
@section('page_title', 'System Settings & Marketplace Config')
@section('page_subtitle', 'Global monetization switches, payment gateway keys, SEO settings and notification preferences.')

@section('content')

    <div class="max-w-4xl space-y-8">
        
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
            <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3">
                General Marketplace Configuration
            </h3>

            <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Platform Name *</label>
                        <input type="text" name="app_name" value="Ozura B2B Marketplace" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Support Email *</label>
                        <input type="email" name="support_email" value="support@ozura.com" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Helpline / WhatsApp Number</label>
                        <input type="text" name="support_phone" value="+91 1800 123 4567" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Default Currency Code</label>
                        <input type="text" name="currency" value="INR (₹)" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Default SEO Meta Title</label>
                        <input type="text" name="meta_title" value="Ozura - India's Leading B2B Marketplace & Manufacturer Portal" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Default SEO Meta Description</label>
                        <textarea name="meta_description" rows="2" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">Connect directly with verified manufacturers, industrial machinery suppliers, wholesalers and exporters across India. Post buy requirements and receive competitive quotes.</textarea>
                    </div>
                </div>

                <!-- Feature Toggles -->
                <div class="pt-4 border-t border-slate-100 space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">Operational Switches</h4>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <label class="flex items-center gap-2.5 p-3 rounded-xl bg-slate-50 border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="enable_gst_verification" checked class="w-4 h-4 text-brand-600 rounded">
                            <span class="font-bold text-slate-700">Auto GST Verification Check</span>
                        </label>
                        <label class="flex items-center gap-2.5 p-3 rounded-xl bg-slate-50 border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="enable_quote_bidding" checked class="w-4 h-4 text-brand-600 rounded">
                            <span class="font-bold text-slate-700">Public RFQ Lead Bidding</span>
                        </label>
                        <label class="flex items-center gap-2.5 p-3 rounded-xl bg-slate-50 border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="enable_live_chat" checked class="w-4 h-4 text-brand-600 rounded">
                            <span class="font-bold text-slate-700">Internal Real-Time Chat Engine</span>
                        </label>
                        <label class="flex items-center gap-2.5 p-3 rounded-xl bg-slate-50 border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="enable_subscriptions" checked class="w-4 h-4 text-brand-600 rounded">
                            <span class="font-bold text-slate-700">Supplier Monetization & Tiers</span>
                        </label>
                    </div>
                </div>

                <div class="pt-3">
                    <button type="submit" class="px-6 py-3 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md transition">
                        Save System Settings
                    </button>
                </div>
            </form>
        </div>

    </div>

@endsection
