<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\SupplierDocument;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierProfileController extends Controller
{
    public function index()
    {
        $supplier = Auth::user()->supplier;
        $documents = $supplier->documents()->latest()->get();
        $locations = Location::where('is_popular', true)->get();

        return view('supplier.profile', compact('supplier', 'documents', 'locations'));
    }

    public function update(Request $request)
    {
        $supplier = Auth::user()->supplier;

        $request->validate([
            'company_name' => 'required|string|max:255',
            'business_type' => 'required|in:Manufacturer,Wholesaler,Distributor,Trader,Service Provider,Exporter',
            'year_established' => 'nullable|integer|min:1900|max:' . date('Y'),
            'employees_count' => 'nullable|string|max:50',
            'gst_number' => 'nullable|string|max:20',
            'pan_number' => 'nullable|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:20',
            'website' => 'nullable|url|max:255',
            'description' => 'required|string|min:20|max:5000',
            'logo' => 'nullable|string|max:500',
            'banner' => 'nullable|string|max:500',
        ]);

        $logoPath = $supplier->logo;
        if ($request->filled('logo')) {
            $logoPath = $request->logo;
        }
        if ($request->hasFile('logo_file')) {
            $path = $request->file('logo_file')->store('suppliers/logos', 'public');
            $logoPath = '/storage/' . $path;
        }

        $bannerPath = $supplier->banner;
        if ($request->filled('banner')) {
            $bannerPath = $request->banner;
        }
        if ($request->hasFile('banner_file')) {
            $path = $request->file('banner_file')->store('suppliers/banners', 'public');
            $bannerPath = '/storage/' . $path;
        }

        $supplier->update([
            'company_name' => $request->company_name,
            'business_type' => $request->business_type,
            'year_established' => $request->year_established,
            'employees_count' => $request->employees_count,
            'gst_number' => $request->gst_number,
            'pan_number' => $request->pan_number,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'website' => $request->website,
            'description' => $request->description,
            'logo' => $logoPath,
            'banner' => $bannerPath,
        ]);

        return back()->with('success', 'Company profile and storefront branding updated successfully.');
    }

    public function uploadDocument(Request $request)
    {
        $supplier = Auth::user()->supplier;

        $request->validate([
            'doc_type' => 'required|in:GST_Certificate,PAN_Card,Business_License,ISO_Certificate,MSME_Udyam,Other',
            'doc_number' => 'nullable|string|max:50',
            'doc_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'file_url' => 'nullable|string|max:500',
        ]);

        $filePath = $request->file_url ?: 'documents/verification_doc.pdf';
        if ($request->hasFile('doc_file')) {
            $path = $request->file('doc_file')->store('supplier_docs', 'public');
            $filePath = '/storage/' . $path;
        }

        SupplierDocument::create([
            'supplier_id' => $supplier->id,
            'doc_type' => $request->doc_type,
            'doc_number' => $request->doc_number,
            'file_path' => $filePath,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Verification document submitted! Our compliance team will review and assign your verification badge within 24 hours.');
    }
}
