@extends('layouts.app')

@section('title', 'Supplier Onboarding - Sell Wholesale on Ozura')

@section('content')

    <div class="bg-gradient-to-b from-slate-950 to-slate-900 text-white py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-2">
            <span class="px-3.5 py-1 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-bold uppercase tracking-wider">
                <i class="fa-solid fa-store mr-1"></i> Grow Your Business
            </span>
            <h1 class="text-2xl sm:text-4xl font-extrabold font-heading text-white">
                Register as a Verified Supplier & Manufacturer
            </h1>
            <p class="text-xs sm:text-sm text-slate-300 max-w-xl mx-auto">
                Connect with 100,000+ active buyers, receive direct product inquiries, and quote on high-value buy tenders.
            </p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-20">
        
        <!-- Multi-Step Onboarding Card -->
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-10 shadow-2xl">
            
            <!-- Step Indicators -->
            <div class="flex items-center justify-between mb-8 overflow-x-auto pb-2 text-xs font-bold scrollbar-none">
                <div class="flex items-center gap-2 text-brand-600 flex-shrink-0" id="stepPill1">
                    <span class="w-7 h-7 rounded-full bg-brand-600 text-white flex items-center justify-center text-xs">1</span>
                    <span>Owner Info</span>
                </div>
                <div class="w-10 h-0.5 bg-slate-200 flex-shrink-0"></div>
                <div class="flex items-center gap-2 text-slate-400 flex-shrink-0" id="stepPill2">
                    <span class="w-7 h-7 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-xs">2</span>
                    <span>Company</span>
                </div>
                <div class="w-10 h-0.5 bg-slate-200 flex-shrink-0"></div>
                <div class="flex items-center gap-2 text-slate-400 flex-shrink-0" id="stepPill3">
                    <span class="w-7 h-7 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-xs">3</span>
                    <span>Location</span>
                </div>
                <div class="w-10 h-0.5 bg-slate-200 flex-shrink-0"></div>
                <div class="flex items-center gap-2 text-slate-400 flex-shrink-0" id="stepPill4">
                    <span class="w-7 h-7 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-xs">4</span>
                    <span>Review & Launch</span>
                </div>
            </div>

            <form action="{{ route('supplier.register') }}" method="POST" id="supplierForm" class="space-y-6">
                @csrf

                <!-- STEP 1: OWNER INFORMATION -->
                <div id="step1" class="space-y-4">
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3">
                        Step 1: Authorized Account Manager / Owner Details
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Full Name *</label>
                            <input type="text" name="name" required placeholder="Arunachalam Murthy" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Mobile / WhatsApp Number *</label>
                            <input type="text" name="mobile" required placeholder="+91 94432 10987" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Official Business Email *</label>
                            <input type="email" name="email" required placeholder="contact@apexmachinery.com" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Account Password *</label>
                            <input type="password" name="password" required placeholder="Minimum 6 characters" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                    </div>
                    <div class="pt-4 flex justify-end">
                        <button type="button" onclick="goToStep(2)" class="px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md">
                            Next: Company Details & Tax <i class="fa-solid fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 2: COMPANY INFORMATION -->
                <div id="step2" class="space-y-4 hidden">
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3">
                        Step 2: Business Entity & Tax Identifiers
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Company / Enterprise Name *</label>
                            <input type="text" name="company_name" id="company_name" required placeholder="Apex Industrial Machineries Pvt Ltd" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Primary Business Role *</label>
                            <select name="business_type" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                                <option value="Manufacturer">Manufacturer / OEM</option>
                                <option value="Wholesaler">Wholesaler / Bulk Trader</option>
                                <option value="Distributor">Authorized Distributor</option>
                                <option value="Exporter">Exporter / Importer</option>
                                <option value="Service Provider">Service Provider</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Year Established</label>
                            <input type="number" name="year_established" min="1900" max="{{ date('Y') }}" value="2012" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">GST Number (Optional for Badge)</label>
                            <input type="text" name="gst_number" placeholder="22AAAAA0000A1Z5" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">PAN Number</label>
                            <input type="text" name="pan_number" placeholder="AAAAA0000A" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Number of Employees</label>
                            <select name="employees_count" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                                <option value="1-10 People">1-10 People</option>
                                <option value="11-50 People">11-50 People</option>
                                <option value="51-100 People">51-100 People</option>
                                <option value="101-250 People">101-250 People</option>
                                <option value="250+ People">250+ People</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Website URL</label>
                            <input type="url" name="website" placeholder="https://www.mycompany.com" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                    </div>
                    <div class="pt-4 flex justify-between">
                        <button type="button" onclick="goToStep(1)" class="px-5 py-2.5 bg-slate-100 text-slate-700 font-bold text-xs rounded-xl">Back</button>
                        <button type="button" onclick="goToStep(3)" class="px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md">
                            Next: Address & Location <i class="fa-solid fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 3: LOCATION & STOREFRONT -->
                <div id="step3" class="space-y-4 hidden">
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3">
                        Step 3: Factory / Office Address & Description
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Street Address / Industrial Estate *</label>
                            <input type="text" name="address" required placeholder="Plot 42, GIDC Industrial Estate, Phase 2" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">City *</label>
                            <input type="text" name="city" required placeholder="Ahmedabad" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">State *</label>
                            <input type="text" name="state" required placeholder="Gujarat" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Pincode *</label>
                            <input type="text" name="pincode" required placeholder="380001" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Subscription Tier</label>
                            <select name="subscription_plan_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                                @foreach($plans as $p)
                                    <option value="{{ $p->id }}" {{ $p->slug === 'free-starter' ? 'selected' : '' }}>{{ $p->name }} (₹{{ number_format($p->price) }}/yr)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Company Description & Manufacturing Capabilities *</label>
                            <textarea name="description" rows="3" required placeholder="Describe your manufacturing plant, key products, ISO certifications, production capacity, and export experience..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">Leading manufacturer and bulk supplier of high precision industrial tools and machinery with state of the art CNC setup.</textarea>
                        </div>
                    </div>
                    <div class="pt-4 flex justify-between">
                        <button type="button" onclick="goToStep(2)" class="px-5 py-2.5 bg-slate-100 text-slate-700 font-bold text-xs rounded-xl">Back</button>
                        <button type="button" onclick="goToStep(4)" class="px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md">
                            Next: Final Review <i class="fa-solid fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 4: REVIEW & LAUNCH -->
                <div id="step4" class="space-y-4 hidden">
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3">
                        Step 4: Final Confirmation & Storefront Activation
                    </h3>
                    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-800 space-y-2">
                        <p class="font-bold flex items-center gap-2 text-sm">
                            <i class="fa-solid fa-circle-check text-emerald-600"></i> Everything is ready!
                        </p>
                        <p>Upon registration, your verified supplier storefront will be activated instantly. You will receive access to add products, reply to buyer inquiries, and view matching RFQ leads.</p>
                    </div>

                    <div class="pt-4 flex justify-between">
                        <button type="button" onclick="goToStep(3)" class="px-5 py-2.5 bg-slate-100 text-slate-700 font-bold text-xs rounded-xl">Back</button>
                        <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-extrabold text-sm rounded-2xl shadow-xl shadow-emerald-600/25 transition">
                            Launch My Supplier Storefront Now
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </div>

    <script>
        function goToStep(step) {
            [1, 2, 3, 4].forEach(s => {
                document.getElementById('step' + s).classList.add('hidden');
                const pill = document.getElementById('stepPill' + s);
                if (s <= step) {
                    pill.classList.remove('text-slate-400');
                    pill.classList.add('text-brand-600');
                    pill.querySelector('span:first-child').className = 'w-7 h-7 rounded-full bg-brand-600 text-white flex items-center justify-center text-xs';
                } else {
                    pill.classList.add('text-slate-400');
                    pill.classList.remove('text-brand-600');
                    pill.querySelector('span:first-child').className = 'w-7 h-7 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-xs';
                }
            });
            document.getElementById('step' + step).classList.remove('hidden');
        }
    </script>

@endsection
