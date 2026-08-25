<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupplierDocument;
use App\Models\Supplier;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminVerificationController extends Controller
{
    public function index(Request $request)
    {
        $query = SupplierDocument::with('supplier.user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $documents = $query->latest()->paginate(15)->withQueryString();

        return view('admin.verification.index', compact('documents'));
    }

    public function approve(Request $request, $id)
    {
        $doc = SupplierDocument::with('supplier')->findOrFail($id);
        $supplier = $doc->supplier;

        $doc->update([
            'status' => 'approved',
            'verified_at' => now(),
            'rejection_reason' => null,
        ]);

        // Upgrade supplier verification badge level
        $level = $request->get('verification_level', 'GST');
        $supplier->update([
            'is_verified' => true,
            'verification_level' => $level,
        ]);

        Notification::create([
            'user_id' => $supplier->user_id,
            'type' => 'verification_approved',
            'title' => 'Verification Document Approved! 🎉',
            'message' => "Your {$doc->doc_type} has been verified and your profile has been awarded the {$level} Verified Badge.",
            'link' => '/supplier/profile',
        ]);

        return back()->with('success', "Document approved! {$supplier->company_name} is now {$level} Verified.");
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $doc = SupplierDocument::with('supplier')->findOrFail($id);
        $supplier = $doc->supplier;

        $doc->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        Notification::create([
            'user_id' => $supplier->user_id,
            'type' => 'verification_rejected',
            'title' => 'Verification Document Rejected',
            'message' => "Your {$doc->doc_type} could not be verified. Reason: {$request->rejection_reason}",
            'link' => '/supplier/profile',
        ]);

        return back()->with('info', 'Document has been rejected with feedback sent to supplier.');
    }
}
