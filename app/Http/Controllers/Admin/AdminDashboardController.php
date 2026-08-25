<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Buyer;
use App\Models\Supplier;
use App\Models\SupplierDocument;
use App\Models\Product;
use App\Models\Requirement;
use App\Models\Inquiry;
use App\Models\Quote;
use App\Models\SubscriptionPayment;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_suppliers' => Supplier::count(),
            'total_buyers' => Buyer::count(),
            'verified_suppliers' => Supplier::where('verification_level', '!=', 'Basic')->count(),
            'total_products' => Product::count(),
            'total_requirements' => Requirement::count(),
            'total_inquiries' => Inquiry::count(),
            'total_quotes' => Quote::count(),
            'total_revenue' => SubscriptionPayment::where('status', 'success')->sum('amount'),
            'pending_kyc' => SupplierDocument::where('status', 'pending')->count(),
            'pending_verifications' => SupplierDocument::where('status', 'pending')->count(),
            'new_registrations_this_month' => User::where('created_at', '>=', now()->startOfMonth())->count(),
            'active_suppliers' => Supplier::where('status', 'active')->count(),
        ];

        $pendingDocuments = SupplierDocument::where('status', 'pending')
            ->with('supplier.user')
            ->latest()
            ->take(5)
            ->get();

        $recentUsers = User::latest()->take(6)->get();
        $recentProducts = Product::with('supplier')->latest()->take(5)->get();
        $recentRequirements = Requirement::with('buyer')->latest()->take(5)->get();
        $recentPayments = SubscriptionPayment::with(['supplier', 'plan'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stats',
            'pendingDocuments',
            'recentUsers',
            'recentProducts',
            'recentRequirements',
            'recentPayments'
        ));
    }
}
