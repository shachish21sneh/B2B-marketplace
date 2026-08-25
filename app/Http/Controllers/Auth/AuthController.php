<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Buyer;
use App\Models\Supplier;
use App\Models\SupplierDocument;
use App\Models\SubscriptionPlan;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->status === 'banned') {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account has been suspended. Please contact support.']);
            }

            return $this->redirectBasedOnRole($user);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showBuyerRegister()
    {
        $locations = Location::where('is_popular', true)->get();
        return view('auth.buyer_register', compact('locations'));
    }

    public function registerBuyer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'mobile' => 'required|string|unique:users,mobile|max:20',
            'password' => 'required|string|min:6|confirmed',
            'company_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'role' => 'buyer',
            'status' => 'active',
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
        ]);

        Buyer::create([
            'user_id' => $user->id,
            'company_name' => $request->company_name,
            'business_type' => $request->business_type,
            'city' => $request->city,
            'state' => $request->state ?: 'State',
            'country' => $request->country ?: 'India',
            'pincode' => $request->pincode,
        ]);

        Auth::login($user);

        return redirect()->route('buyer.dashboard')->with('success', 'Welcome to Ozura! Your Buyer account has been registered successfully.');
    }

    public function showSupplierRegister(Request $request)
    {
        $categories = Category::where('is_active', true)->get();
        $plans = SubscriptionPlan::where('is_active', true)->get();
        $locations = Location::where('is_popular', true)->get();

        return view('auth.supplier_register', compact('categories', 'plans', 'locations'));
    }

    public function registerSupplier(Request $request)
    {
        $request->validate([
            // Step 1: Owner Info
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'mobile' => 'required|string|unique:users,mobile|max:20',
            'password' => 'required|string|min:6',

            // Step 2: Company Info
            'company_name' => 'required|string|max:255',
            'business_type' => 'required|in:Manufacturer,Wholesaler,Distributor,Trader,Service Provider,Exporter',
            'gst_number' => 'nullable|string|max:20',
            'pan_number' => 'nullable|string|max:20',
            'year_established' => 'nullable|integer|min:1900|max:' . date('Y'),
            'employees_count' => 'nullable|string|max:50',

            // Step 3: Location
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:20',

            // Step 4 & 5: Business & Docs
            'description' => 'required|string|min:20|max:3000',
            'website' => 'nullable|url|max:255',
            'subscription_plan_id' => 'nullable|exists:subscription_plans,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'role' => 'supplier',
            'status' => 'active',
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
        ]);

        $defaultPlan = SubscriptionPlan::where('slug', 'free-starter')->first();
        $planId = $request->subscription_plan_id ?: ($defaultPlan ? $defaultPlan->id : null);

        $slug = Str::slug($request->company_name);
        if (Supplier::where('slug', $slug)->exists()) {
            $slug .= '-' . Str::random(4);
        }

        $supplier = Supplier::create([
            'user_id' => $user->id,
            'subscription_plan_id' => $planId,
            'company_name' => $request->company_name,
            'slug' => $slug,
            'business_type' => $request->business_type,
            'year_established' => $request->year_established ?: date('Y'),
            'employees_count' => $request->employees_count ?: '1-10 People',
            'gst_number' => $request->gst_number,
            'pan_number' => $request->pan_number,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => 'India',
            'pincode' => $request->pincode,
            'description' => $request->description,
            'website' => $request->website,
            'logo' => 'https://images.unsplash.com/photo-1560179707-f14e90ef3623?w=200&auto=format&fit=crop&q=80',
            'banner' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=1200&auto=format&fit=crop&q=80',
            'is_verified' => false,
            'verification_level' => 'Mobile',
            'status' => 'active',
        ]);

        // If GST provided, create pending document
        if ($request->gst_number) {
            SupplierDocument::create([
                'supplier_id' => $supplier->id,
                'doc_type' => 'GST_Certificate',
                'doc_number' => $request->gst_number,
                'file_path' => 'documents/pending_gst_' . $supplier->id . '.pdf',
                'status' => 'pending',
            ]);
        }

        Auth::login($user);

        return redirect()->route('supplier.dashboard')->with('success', 'Supplier onboarding complete! Welcome to your Supplier Command Center.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out safely.');
    }

    public function redirectBasedOnRole(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isSupplier()) {
            return redirect()->route('supplier.dashboard');
        } else {
            return redirect()->route('buyer.dashboard');
        }
    }
}
