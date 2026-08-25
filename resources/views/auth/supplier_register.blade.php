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
            
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
                    <div class="font-bold flex items-center gap-2 mb-2 text-sm text-rose-900">
                        <i class="fa-solid fa-circle-exclamation text-rose-600"></i> Please check the following:
                    </div>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Step Indicators -->
            <div class="flex items-center justify-between mb-8 overflow-x-auto pb-2 text-xs font-bold scrollbar-none">
                <div class="flex items-center gap-2 text-brand-600 flex-shrink-0 cursor-pointer" id="stepPill1" onclick="goToStep(1)">
                    <span class="w-7 h-7 rounded-full bg-brand-600 text-white flex items-center justify-center text-xs">1</span>
                    <span>Owner Info</span>
                </div>
                <div class="w-10 h-0.5 bg-slate-200 flex-shrink-0"></div>
                <div class="flex items-center gap-2 text-slate-400 flex-shrink-0 cursor-pointer" id="stepPill2" onclick="goToStep(2)">
                    <span class="w-7 h-7 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-xs">2</span>
                    <span>Company</span>
                </div>
                <div class="w-10 h-0.5 bg-slate-200 flex-shrink-0"></div>
                <div class="flex items-center gap-2 text-slate-400 flex-shrink-0 cursor-pointer" id="stepPill3" onclick="goToStep(3)">
                    <span class="w-7 h-7 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-xs">3</span>
                    <span>Location</span>
                </div>
                <div class="w-10 h-0.5 bg-slate-200 flex-shrink-0"></div>
                <div class="flex items-center gap-2 text-slate-400 flex-shrink-0 cursor-pointer" id="stepPill4" onclick="goToStep(4)">
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
                            <input type="text" name="name" id="field_name" value="{{ old('name') }}" required placeholder="Arunachalam Murthy" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Mobile / WhatsApp Number *</label>
                            <input type="text" name="mobile" id="field_mobile" value="{{ old('mobile') }}" required placeholder="+91 94432 10987" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Official Business Email *</label>
                            <input type="email" name="email" id="field_email" value="{{ old('email') }}" required placeholder="contact@apexmachinery.com" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Account Password (Min 6 chars) *</label>
                            <input type="password" name="password" id="field_password" required minlength="6" placeholder="••••••••" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                    </div>
                    <div class="pt-4 flex justify-end">
                        <button type="button" onclick="nextStep(2)" class="px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-1.5">
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
                            <input type="text" name="company_name" id="field_company_name" value="{{ old('company_name') }}" required placeholder="Apex Industrial Machineries Pvt Ltd" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Primary Business Role *</label>
                            <select name="business_type" id="field_business_type" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                                <option value="Manufacturer" {{ old('business_type') === 'Manufacturer' ? 'selected' : '' }}>Manufacturer / OEM</option>
                                <option value="Wholesaler" {{ old('business_type') === 'Wholesaler' ? 'selected' : '' }}>Wholesaler / Bulk Trader</option>
                                <option value="Distributor" {{ old('business_type') === 'Distributor' ? 'selected' : '' }}>Authorized Distributor</option>
                                <option value="Exporter" {{ old('business_type') === 'Exporter' ? 'selected' : '' }}>Exporter / Importer</option>
                                <option value="Service Provider" {{ old('business_type') === 'Service Provider' ? 'selected' : '' }}>Service Provider</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Year Established</label>
                            <input type="number" name="year_established" min="1900" max="{{ date('Y') }}" value="{{ old('year_established', '2012') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">GST Number (Optional for Badge)</label>
                            <input type="text" name="gst_number" value="{{ old('gst_number') }}" placeholder="22AAAAA0000A1Z5" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none uppercase">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">PAN Number</label>
                            <input type="text" name="pan_number" value="{{ old('pan_number') }}" placeholder="AAAAA0000A" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none uppercase">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Number of Employees</label>
                            <select name="employees_count" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                                <option value="1-10 People" {{ old('employees_count') === '1-10 People' ? 'selected' : '' }}>1-10 People</option>
                                <option value="11-50 People" {{ old('employees_count') === '11-50 People' ? 'selected' : '' }}>11-50 People</option>
                                <option value="51-100 People" {{ old('employees_count') === '51-100 People' ? 'selected' : '' }}>51-100 People</option>
                                <option value="101-250 People" {{ old('employees_count') === '101-250 People' ? 'selected' : '' }}>101-250 People</option>
                                <option value="250+ People" {{ old('employees_count') === '250+ People' ? 'selected' : '' }}>250+ People</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Website URL</label>
                            <input type="url" name="website" value="{{ old('website') }}" placeholder="https://www.mycompany.com" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                    </div>
                    <div class="pt-4 flex justify-between">
                        <button type="button" onclick="goToStep(1)" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition">Back</button>
                        <button type="button" onclick="nextStep(3)" class="px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-1.5">
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
                            <input type="text" name="address" id="field_address" value="{{ old('address') }}" required placeholder="Plot 42, GIDC Industrial Estate, Phase 2" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">City *</label>
                            <input type="text" name="city" id="field_city" value="{{ old('city') }}" required placeholder="Ahmedabad" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">State *</label>
                            <input type="text" name="state" id="field_state" value="{{ old('state') }}" required placeholder="Gujarat" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Pincode *</label>
                            <input type="text" name="pincode" id="field_pincode" value="{{ old('pincode') }}" required placeholder="380001" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Subscription Plan</label>
                            <select name="subscription_plan_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                                @foreach($plans as $p)
                                    <option value="{{ $p->id }}" {{ $p->slug === 'free-starter' ? 'selected' : '' }}>{{ $p->name }} (₹{{ number_format($p->price) }}/yr)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Company Description & Capabilities</label>
                            <textarea name="description" id="field_description" rows="3" placeholder="Describe your manufacturing plant, key products, ISO certifications, production capacity..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">{{ old('description', 'Leading manufacturer and bulk supplier of high quality industrial equipment and products with state of the art facility.') }}</textarea>
                        </div>
                    </div>
                    <div class="pt-4 flex justify-between">
                        <button type="button" onclick="goToStep(2)" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition">Back</button>
                        <button type="button" onclick="nextStep(4)" class="px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-1.5">
                            Next: Final Review <i class="fa-solid fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 4: REVIEW & LAUNCH -->
                <div id="step4" class="space-y-4 hidden">
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3">
                        Step 4: Final Confirmation & Storefront Activation
                    </h3>
                    <div class="p-5 rounded-2xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-900 space-y-3">
                        <p class="font-bold flex items-center gap-2 text-sm text-emerald-800">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i> Everything is ready to launch!
                        </p>
                        <p class="text-emerald-700 leading-relaxed">
                            Upon registration, your verified supplier storefront will be activated instantly on <strong>Ozura B2B Marketplace</strong>. You will receive immediate access to list products, quote on live buyer RFQs, and receive direct inquiries.
                        </p>
                    </div>

                    <div class="pt-4 flex justify-between items-center">
                        <button type="button" onclick="goToStep(3)" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition">Back</button>
                        <button type="button" id="submitBtn" onclick="submitSupplierForm()" class="px-8 py-3.5 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-extrabold text-sm rounded-2xl shadow-xl shadow-emerald-600/25 transition flex items-center gap-2">
                            <span id="btnText">Launch My Supplier Storefront Now</span>
                            <i id="btnIcon" class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </div>

    <script>
        function validateStep(step) {
            const stepDiv = document.getElementById('step' + step);
            if (!stepDiv) return true;
            
            const inputs = stepDiv.querySelectorAll('input, select, textarea');
            for (let el of inputs) {
                if (el.hasAttribute('required') && !el.value.trim()) {
                    el.focus();
                    el.reportValidity();
                    return false;
                }
                if (el.type === 'email' && el.value.trim()) {
                    if (!el.checkValidity()) {
                        el.focus();
                        el.reportValidity();
                        return false;
                    }
                }
                if (el.type === 'password' && el.value && el.value.length < 6) {
                    el.setCustomValidity('Password must be at least 6 characters.');
                    el.focus();
                    el.reportValidity();
                    return false;
                } else if (el.type === 'password') {
                    el.setCustomValidity('');
                }
            }
            return true;
        }

        function nextStep(step) {
            const currentStep = step - 1;
            if (validateStep(currentStep)) {
                goToStep(step);
            }
        }

        function goToStep(step) {
            [1, 2, 3, 4].forEach(s => {
                const el = document.getElementById('step' + s);
                if (el) el.classList.add('hidden');
                
                const pill = document.getElementById('stepPill' + s);
                if (pill) {
                    if (s <= step) {
                        pill.classList.remove('text-slate-400');
                        pill.classList.add('text-brand-600');
                        pill.querySelector('span:first-child').className = 'w-7 h-7 rounded-full bg-brand-600 text-white flex items-center justify-center text-xs';
                    } else {
                        pill.classList.add('text-slate-400');
                        pill.classList.remove('text-brand-600');
                        pill.querySelector('span:first-child').className = 'w-7 h-7 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-xs';
                    }
                }
            });
            const target = document.getElementById('step' + step);
            if (target) target.classList.remove('hidden');
        }

        function submitSupplierForm() {
            // Validate all previous steps
            for (let s = 1; s <= 3; s++) {
                if (!validateStep(s)) {
                    goToStep(s);
                    return false;
                }
            }

            const btn = document.getElementById('submitBtn');
            const text = document.getElementById('btnText');
            const icon = document.getElementById('btnIcon');

            if (btn) {
                btn.disabled = true;
                btn.classList.add('opacity-75', 'cursor-not-allowed');
            }
            if (text) text.innerText = 'Activating Your Storefront...';
            if (icon) icon.className = 'fa-solid fa-spinner fa-spin';

            // Submit the form
            document.getElementById('supplierForm').submit();
        }
    </script>

@endsection
