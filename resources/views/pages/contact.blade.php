@extends('layouts.app')

@section('title', 'Contact Support & Corporate Inquiries - NexTrade')

@section('content')

    <div class="bg-slate-900 text-white py-12">
        <div class="max-w-4xl mx-auto px-4 text-center space-y-2">
            <h1 class="text-3xl font-extrabold font-heading">Get in Touch with NexTrade</h1>
            <p class="text-xs sm:text-sm text-slate-300">Our enterprise customer success and supplier onboarding teams are here 24/7.</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6 text-xs">
                <h3 class="text-base font-bold font-heading text-slate-900">Headquarters & Support</h3>
                
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-location-dot"></i></div>
                        <div>
                            <strong class="text-slate-900 block">Corporate Office</strong>
                            <p class="text-slate-500">NexTrade Tower, Sector 62, Electronic City, Noida, Uttar Pradesh 201301, India</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-envelope"></i></div>
                        <div>
                            <strong class="text-slate-900 block">Email Support</strong>
                            <p class="text-brand-600">support@nextrade.com • sales@nextrade.com</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-phone"></i></div>
                        <div>
                            <strong class="text-slate-900 block">Toll-Free Helpline</strong>
                            <p class="text-slate-700 font-bold">+91 1800 123 4567 (Mon-Sat, 9AM - 8PM)</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-4">
                <h3 class="text-base font-bold font-heading text-slate-900">Send us a Message</h3>
                
                <form onsubmit="event.preventDefault(); alert('Thank you for contacting us. Our enterprise representative will reach out within 2 hours.');" class="space-y-3 text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Your Name *</label>
                        <input type="text" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Business Email *</label>
                        <input type="email" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Subject / Inquiry Type *</label>
                        <select class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl">
                            <option>Supplier Onboarding & Plan Upgrade</option>
                            <option>Buyer Bulk Procurement Assistance</option>
                            <option>KYC / Document Verification Support</option>
                            <option>API & Enterprise Integration</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Message *</label>
                        <textarea rows="3" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl"></textarea>
                    </div>
                    <button type="submit" class="w-full py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md transition">
                        Submit Message
                    </button>
                </form>
            </div>

        </div>
    </div>

@endsection
