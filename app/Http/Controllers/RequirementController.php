<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use App\Models\Category;
use App\Models\Location;
use App\Models\Buyer;
use App\Models\Supplier;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RequirementController extends Controller
{
    public function index(Request $request)
    {
        $query = Requirement::where('status', 'open')->with(['buyer', 'category', 'quotes']);

        if ($request->filled('q')) {
            $term = trim($request->q);
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%")
                  ->orWhere('delivery_location', 'like', "%{$term}%");
            });
        }

        if ($request->filled('category')) {
            $catSlug = $request->category;
            $query->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        if ($request->filled('city')) {
            $query->where('delivery_location', 'like', "%{$request->city}%");
        }

        $requirements = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::where('is_active', true)->get();
        $cities = Location::where('is_popular', true)->get();

        return view('requirements.index', compact('requirements', 'categories', 'cities'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->with('subcategories')->get();
        $cities = Location::where('is_popular', true)->get();

        return view('requirements.create', compact('categories', 'cities'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|min:20|max:5000',
            'quantity' => 'required|integer|min:1',
            'quantity_unit' => 'required|string|max:50',
            'target_price' => 'nullable|numeric|min:0',
            'preferred_location' => 'nullable|string|max:255',
            'delivery_location' => 'required|string|max:255',
            'pincode' => 'nullable|string|max:20',
            'required_by' => 'nullable|date|after_or_equal:today',
            'payment_terms' => 'nullable|string|max:255',
            'additional_requirements' => 'nullable|string|max:1000',
        ];

        // If user is guest, collect contact details & create buyer account seamlessly
        if (!Auth::check()) {
            $rules['buyer_name'] = 'required|string|max:255';
            $rules['buyer_email'] = 'required|email|max:255';
            $rules['buyer_mobile'] = 'required|string|max:20';
            $rules['company_name'] = 'nullable|string|max:255';
        }

        $request->validate($rules);

        $buyer = null;

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->buyer) {
                $buyer = $user->buyer;
            } else {
                // User is supplier or admin posting requirement, create buyer profile
                $buyer = Buyer::firstOrCreate(['user_id' => $user->id], [
                    'company_name' => $user->name,
                    'city' => $request->delivery_location,
                ]);
            }
        } else {
            // Find or create guest user as buyer
            $user = User::where('email', $request->buyer_email)->first();
            if (!$user) {
                $user = User::create([
                    'name' => $request->buyer_name,
                    'email' => $request->buyer_email,
                    'mobile' => $request->buyer_mobile,
                    'role' => 'buyer',
                    'status' => 'active',
                    'password' => Hash::make('password123'),
                ]);
            }

            $buyer = Buyer::firstOrCreate(['user_id' => $user->id], [
                'company_name' => $request->company_name ?: $request->buyer_name,
                'city' => $request->delivery_location,
                'pincode' => $request->pincode,
            ]);

            Auth::login($user);
        }

        $requirement = Requirement::create([
            'buyer_id' => $buyer->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'quantity_unit' => $request->quantity_unit,
            'target_price' => $request->target_price,
            'preferred_location' => $request->preferred_location,
            'delivery_location' => $request->delivery_location,
            'pincode' => $request->pincode,
            'required_by' => $request->required_by,
            'payment_terms' => $request->payment_terms,
            'additional_requirements' => $request->additional_requirements,
            'status' => 'open',
        ]);

        // Auto-match and notify verified suppliers in this category
        $matchingSuppliers = Supplier::where('status', 'active')
            ->whereHas('products', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            })
            ->get();

        foreach ($matchingSuppliers as $supplier) {
            Notification::create([
                'user_id' => $supplier->user_id,
                'type' => 'match',
                'title' => 'New Matching Buy Requirement (RFQ)',
                'message' => "A new buyer posted: \"{$requirement->title}\" in your category.",
                'link' => '/supplier/requirements',
            ]);
        }

        return redirect()->route('buyer.requirements')->with('success', 'Your Buy Requirement has been submitted successfully! Relevant verified suppliers have been notified to send you competitive quotes.');
    }

    public function show($id)
    {
        $requirement = Requirement::where('id', $id)
            ->with(['buyer.user', 'category', 'quotes.supplier'])
            ->firstOrFail();

        return view('requirements.show', compact('requirement'));
    }
}
