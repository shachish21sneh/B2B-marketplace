<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BuyerProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $buyer = $user->buyer;
        $locations = Location::where('is_popular', true)->get();

        return view('buyer.profile', compact('user', 'buyer', 'locations'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $buyer = $user->buyer;

        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'nullable|string|max:20',
            'company_name' => 'required|string|max:255',
            'business_type' => 'nullable|string|max:100',
            'gst_number' => 'nullable|string|max:20',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
        ]);

        $buyer->update([
            'company_name' => $request->company_name,
            'business_type' => $request->business_type,
            'gst_number' => $request->gst_number,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }
}
