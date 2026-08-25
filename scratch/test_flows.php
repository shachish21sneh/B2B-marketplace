<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Requirement;
use App\Models\Quote;
use App\Models\Inquiry;
use App\Models\Message;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

echo "========================================================\n";
echo "       OZURA B2B PLATFORM INTEGRATION TEST SUITE     \n";
echo "========================================================\n\n";

$testsPassed = 0;
$totalTests = 0;

function runTest($title, $callback) {
    global $testsPassed, $totalTests;
    $totalTests++;
    echo "[TEST $totalTests] $title ... ";
    try {
        $result = $callback();
        if ($result !== false) {
            echo "PASSED ✓\n";
            $testsPassed++;
        } else {
            echo "FAILED ✗\n";
        }
    } catch (\Throwable $e) {
        echo "ERROR ✗: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine() . "\n";
    }
}

// Test 1: Database Seed Integrity
runTest("Database Entity Counts Check", function() {
    $uCount = User::count();
    $pCount = Product::count();
    $sCount = Supplier::count();
    $rCount = Requirement::count();
    $qCount = Quote::count();
    $planCount = SubscriptionPlan::count();
    
    echo "(Users: $uCount, Suppliers: $sCount, Products: $pCount, RFQs: $rCount, Quotes: $qCount, Plans: $planCount) ";
    return $uCount > 0 && $pCount > 0 && $sCount > 0 && $rCount > 0 && $qCount > 0 && $planCount >= 3;
});

// Test 2: Public Home Page Render
runTest("Homepage View Rendering", function() {
    $view = view('home', [
        'heroBanners' => \App\Models\Advertisement::where('placement', 'hero_slider')->get(),
        'categories' => \App\Models\Category::withCount('products')->get(),
        'featuredProducts' => Product::with(['supplier', 'category'])->take(8)->get(),
        'trendingProducts' => Product::with(['supplier', 'category'])->take(8)->get(),
        'featuredSuppliers' => Supplier::withCount(['products', 'reviews'])->take(6)->get(),
        'latestRequirements' => Requirement::with('category')->take(6)->get(),
        'popularCities' => \App\Models\Location::take(8)->get(),
        'totalSuppliers' => Supplier::count(),
        'totalProducts' => Product::count(),
        'totalBuyers' => \App\Models\Buyer::count(),
        'statsRequirements' => Requirement::count(),
    ])->render();
    return strlen($view) > 1000 && str_contains($view, 'Ozura');
});

// Test 3: Product Search & Catalog View
runTest("Product Search View Rendering", function() {
    $products = Product::with(['supplier', 'category'])->paginate(12);
    $categories = \App\Models\Category::withCount('products')->get();
    $cities = \App\Models\Location::select('city')->distinct()->get();
    $view = view('products.index', [
        'products' => $products,
        'categories' => $categories,
        'cities' => $cities,
        'currentCategory' => null,
        'currentSubcategory' => null,
        'viewMode' => 'grid'
    ])->render();
    return strlen($view) > 1000 && str_contains($view, 'Filters');
});

// Test 4: Product Detail Page with Specifications
runTest("Product Detail View Rendering", function() {
    $product = Product::with(['supplier.reviews', 'images', 'category'])->first();
    $similar = Product::where('id', '!=', $product->id)->take(4)->get();
    $view = view('products.show', [
        'product' => $product,
        'similarProducts' => $similar,
    ])->render();
    return strlen($view) > 1000 && str_contains($view, $product->name);
});

// Test 5: Supplier Storefront Profile
runTest("Supplier Storefront View Rendering", function() {
    $supplier = Supplier::with(['products', 'services', 'reviews.buyer', 'documents'])->first();
    $view = view('suppliers.show', [
        'supplier' => $supplier,
        'activeTab' => 'overview',
        'totalReviews' => $supplier->reviews->count(),
        'ratingDistribution' => [5 => 10, 4 => 2, 3 => 0, 2 => 0, 1 => 0],
    ])->render();
    return strlen($view) > 1000 && str_contains($view, $supplier->company_name);
});

// Test 6: Buyer Dashboard & Side-by-Side Comparison
runTest("Buyer Side-by-Side Quote Comparison View", function() {
    $buyerUser = User::where('email', 'buyer@ozura.com')->first();
    Auth::login($buyerUser);
    
    $req = Requirement::with('quotes.supplier')->first();
    $quotes = $req->quotes;
    $view = view('buyer.requirements.compare', [
        'requirement' => $req,
        'quotes' => $quotes,
        'user' => $buyerUser,
        'buyer' => $buyerUser->buyer,
        'unreadNotificationsCount' => 0,
        'unreadMessagesCount' => 0,
    ])->render();
    return strlen($view) > 1000 && str_contains($view, 'Side-by-Side');
});

// Test 7: WhatsApp-style Real-time Chat View for Buyer
runTest("Buyer Real-time Chat Interface View", function() {
    $buyerUser = User::where('email', 'buyer@ozura.com')->first();
    Auth::login($buyerUser);
    $supplierUser = User::where('email', 'supplier@ozura.com')->first();
    
    $contacts = collect([$supplierUser]);
    $messages = Message::where(function($q) use ($buyerUser, $supplierUser) {
        $q->where('sender_id', $buyerUser->id)->where('receiver_id', $supplierUser->id);
    })->orWhere(function($q) use ($buyerUser, $supplierUser) {
        $q->where('sender_id', $supplierUser->id)->where('receiver_id', $buyerUser->id);
    })->get();

    $view = view('buyer.messages.index', [
        'contacts' => $contacts,
        'activeContact' => $supplierUser,
        'messages' => $messages,
        'user' => $buyerUser,
        'buyer' => $buyerUser->buyer,
        'unreadNotificationsCount' => 0,
        'unreadMessagesCount' => 0,
    ])->render();
    return strlen($view) > 1000 && str_contains($view, 'Live Chat');
});

// Test 8: Supplier Dashboard & Lead Marketplace
runTest("Supplier Dashboard View", function() {
    $supplierUser = User::where('email', 'supplier@ozura.com')->first();
    Auth::login($supplierUser);
    
    $supplier = $supplierUser->supplier;
    $stats = [
        'active_products' => $supplier->products()->count(),
        'product_views' => 1250,
        'profile_views' => 450,
        'total_inquiries' => 18,
        'new_leads' => 5,
        'quotes_sent' => 12,
        'conversion_rate' => '33%',
        'rating_avg' => 4.9,
        'reviews_count' => 8,
    ];

    $view = view('supplier.dashboard', [
        'supplier' => $supplier,
        'stats' => $stats,
        'matchingRequirements' => Requirement::take(5)->get(),
        'recentInquiries' => Inquiry::take(5)->get(),
        'recentQuotes' => Quote::take(5)->get(),
        'user' => $supplierUser,
        'unreadNotificationsCount' => 0,
        'unreadMessagesCount' => 0,
    ])->render();
    return strlen($view) > 1000 && str_contains($view, 'Supplier Command Center');
});

// Test 9: Supplier Subscription & Monetization Plans
runTest("Supplier Subscription Tier View", function() {
    $supplierUser = User::where('email', 'supplier@ozura.com')->first();
    Auth::login($supplierUser);
    
    $plans = SubscriptionPlan::all();
    $view = view('supplier.subscription', [
        'plans' => $plans,
        'currentPlan' => $supplierUser->supplier->subscriptionPlan,
        'currentSubscription' => $supplierUser->supplier->activeSubscription,
        'payments' => \App\Models\SubscriptionPayment::take(5)->get(),
        'user' => $supplierUser,
        'supplier' => $supplierUser->supplier,
        'unreadNotificationsCount' => 0,
        'unreadMessagesCount' => 0,
    ])->render();
    return strlen($view) > 1000 && str_contains($view, 'Choose the Best Plan');
});

// Test 10: Super Admin Control Panel & KYC Verification Queue
runTest("Admin Dashboard & KYC Queue View", function() {
    $adminUser = User::where('email', 'admin@ozura.com')->first();
    Auth::login($adminUser);
    
    $stats = [
        'total_users' => User::count(),
        'total_suppliers' => Supplier::count(),
        'total_buyers' => \App\Models\Buyer::count(),
        'verified_suppliers' => Supplier::where('verification_level', '!=', 'Basic')->count(),
        'total_products' => Product::count(),
        'total_requirements' => Requirement::count(),
        'pending_kyc' => \App\Models\SupplierDocument::where('status', 'pending')->count(),
        'total_revenue' => 450000,
    ];

    $view = view('admin.dashboard', [
        'stats' => $stats,
        'pendingDocuments' => \App\Models\SupplierDocument::with('supplier')->take(5)->get(),
        'recentUsers' => User::latest()->take(5)->get(),
        'user' => $adminUser,
        'unreadNotificationsCount' => 0,
        'unreadMessagesCount' => 0,
    ])->render();
    return strlen($view) > 1000 && str_contains($view, 'Super Admin Control Panel');
});

echo "\n========================================================\n";
echo "SUMMARY: $testsPassed / $totalTests tests passed successfully!\n";
echo "========================================================\n";
