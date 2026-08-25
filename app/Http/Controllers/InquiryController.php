<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Buyer;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'nullable|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'expected_price' => 'nullable|numeric|min:0',
            'delivery_location' => 'nullable|string|max:255',
            'message' => 'required|string|min:10|max:3000',
        ];

        if (!Auth::check()) {
            $rules['buyer_name'] = 'required|string|max:255';
            $rules['buyer_email'] = 'required|email|max:255';
            $rules['buyer_phone'] = 'required|string|max:20';
        }

        $request->validate($rules);

        $supplier = Supplier::findOrFail($request->supplier_id);
        $buyer = null;
        $name = $request->buyer_name;
        $email = $request->buyer_email;
        $phone = $request->buyer_phone;

        if (Auth::check()) {
            $user = Auth::user();
            $name = $user->name;
            $email = $user->email;
            $phone = $user->mobile ?: '+91 98000 00000';
            $buyer = $user->buyer;
        } else {
            // Find or create guest user
            $user = User::where('email', $email)->first();
            if (!$user) {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'mobile' => $phone,
                    'role' => 'buyer',
                    'status' => 'active',
                    'password' => Hash::make('password123'),
                ]);
            }
            $buyer = Buyer::firstOrCreate(['user_id' => $user->id], [
                'company_name' => $name,
                'city' => $request->delivery_location,
            ]);
            Auth::login($user);
        }

        $inquiry = Inquiry::create([
            'supplier_id' => $supplier->id,
            'product_id' => $request->product_id,
            'buyer_id' => $buyer?->id,
            'buyer_name' => $name,
            'buyer_email' => $email,
            'buyer_phone' => $phone,
            'quantity' => $request->quantity,
            'expected_price' => $request->expected_price,
            'delivery_location' => $request->delivery_location,
            'message' => $request->message,
            'status' => 'new',
        ]);

        // Notify Supplier
        $productName = $request->product_id ? Product::find($request->product_id)?->name : 'Supplier Storefront';
        Notification::create([
            'user_id' => $supplier->user_id,
            'type' => 'inquiry',
            'title' => 'New Product Inquiry Received',
            'message' => "{$name} sent an inquiry for \"{$productName}\".",
            'link' => '/supplier/inquiries',
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Your inquiry has been sent to the supplier successfully! You will receive response via chat/email.',
                'inquiry_id' => $inquiry->id,
            ]);
        }

        return back()->with('success', 'Your inquiry has been sent directly to the supplier successfully!');
    }
}
