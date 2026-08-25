<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\Auth\AuthController;

// Buyer Controllers
use App\Http\Controllers\Buyer\BuyerDashboardController;
use App\Http\Controllers\Buyer\BuyerRequirementController;
use App\Http\Controllers\Buyer\BuyerInquiryController;
use App\Http\Controllers\Buyer\BuyerMessageController;
use App\Http\Controllers\Buyer\BuyerFavoriteController;
use App\Http\Controllers\Buyer\BuyerProfileController;

// Supplier Controllers
use App\Http\Controllers\Supplier\SupplierDashboardController;
use App\Http\Controllers\Supplier\SupplierProductController;
use App\Http\Controllers\Supplier\SupplierRequirementController;
use App\Http\Controllers\Supplier\SupplierQuoteController;
use App\Http\Controllers\Supplier\SupplierInquiryController;
use App\Http\Controllers\Supplier\SupplierMessageController;
use App\Http\Controllers\Supplier\SupplierProfileController;
use App\Http\Controllers\Supplier\SupplierReviewController;
use App\Http\Controllers\Supplier\SupplierSubscriptionController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminVerificationController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminRequirementController;
use App\Http\Controllers\Admin\AdminSubscriptionController;
use App\Http\Controllers\Admin\AdminAdvertisementController;
use App\Http\Controllers\Admin\AdminSettingController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products & Categories
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/product/{slug}', [ProductController::class, 'show']);
Route::get('/category/{categorySlug}', [ProductController::class, 'index'])->name('category.show');
Route::get('/category/{categorySlug}/{subcategorySlug}', [ProductController::class, 'index'])->name('subcategory.show');

// Suppliers
Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
Route::get('/suppliers/{slug}', [SupplierController::class, 'show'])->name('suppliers.show');
Route::post('/suppliers/{slug}/review', [SupplierController::class, 'storeReview'])->name('suppliers.review');
Route::get('/city/{city}/suppliers', [SupplierController::class, 'byCity'])->name('city.suppliers');

// Buy Requirements / RFQs
Route::get('/requirements', [RequirementController::class, 'index'])->name('requirements.index');
Route::get('/requirements/post', [RequirementController::class, 'create'])->name('requirements.create');
Route::get('/requirements/create', [RequirementController::class, 'create']);
Route::post('/requirements/post', [RequirementController::class, 'store'])->name('requirements.store');
Route::post('/requirements/create', [RequirementController::class, 'store']);
Route::get('/requirements/{id}', [RequirementController::class, 'show'])->name('requirements.show');

// Inquiries & Bookmarks
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
Route::post('/favorites/toggle', [BuyerFavoriteController::class, 'toggle'])->name('favorites.toggle');

// Live Search Autocomplete API
Route::get('/api/search/suggestions', [SearchController::class, 'suggestions'])->name('api.search.suggestions');

// SEO & CMS
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('seo.sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('seo.robots');
Route::get('/about-us', [SeoController::class, 'about'])->name('pages.about');
Route::get('/about', [SeoController::class, 'about']);
Route::get('/contact-us', [SeoController::class, 'contact'])->name('pages.contact');
Route::get('/contact', [SeoController::class, 'contact']);
Route::post('/contact-us', [SeoController::class, 'contactSubmit'])->name('pages.contact.submit');
Route::get('/terms', [SeoController::class, 'terms'])->name('pages.terms');
Route::get('/privacy-policy', [SeoController::class, 'privacy'])->name('pages.privacy');
Route::get('/faq', [SeoController::class, 'faq'])->name('pages.faq');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register/buyer', [AuthController::class, 'showBuyerRegister'])->name('buyer.register');
Route::post('/register/buyer', [AuthController::class, 'registerBuyer']);
Route::get('/register/supplier', [AuthController::class, 'showSupplierRegister'])->name('supplier.register');
Route::post('/register/supplier', [AuthController::class, 'registerSupplier']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Buyer Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:buyer,admin'])->prefix('buyer')->as('buyer.')->group(function () {
    Route::get('/dashboard', [BuyerDashboardController::class, 'index'])->name('dashboard');
    
    // Requirements & Quotes
    Route::get('/requirements', [BuyerRequirementController::class, 'index'])->name('requirements');
    Route::get('/requirements/{id}', [BuyerRequirementController::class, 'show'])->name('requirements.show');
    Route::get('/requirements/{id}/compare', [BuyerRequirementController::class, 'compareQuotes'])->name('requirements.compare');
    Route::post('/quotes/{id}/accept', [BuyerRequirementController::class, 'acceptQuote'])->name('quotes.accept');
    Route::post('/quotes/{id}/reject', [BuyerRequirementController::class, 'rejectQuote'])->name('quotes.reject');
    Route::post('/requirements/{id}/close', [BuyerRequirementController::class, 'closeRequirement'])->name('requirements.close');
    Route::get('/quotes', [BuyerRequirementController::class, 'index'])->name('quotes');

    // Inquiries
    Route::get('/inquiries', [BuyerInquiryController::class, 'index'])->name('inquiries');
    Route::get('/inquiries/{id}', [BuyerInquiryController::class, 'show'])->name('inquiries.show');

    // Live WhatsApp-style Messages
    Route::get('/messages', [BuyerMessageController::class, 'index'])->name('messages');
    Route::post('/messages/send', [BuyerMessageController::class, 'send'])->name('messages.send');
    Route::get('/messages/poll', [BuyerMessageController::class, 'poll'])->name('messages.poll');

    // Favorites & Profile
    Route::get('/favorites', [BuyerFavoriteController::class, 'index'])->name('favorites');
    Route::get('/profile', [BuyerProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [BuyerProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [BuyerProfileController::class, 'changePassword'])->name('profile.password');
});

/*
|--------------------------------------------------------------------------
| Supplier Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:supplier,admin'])->prefix('supplier')->as('supplier.')->group(function () {
    Route::get('/dashboard', [SupplierDashboardController::class, 'index'])->name('dashboard');
    
    // Products
    Route::get('/products', [SupplierProductController::class, 'index'])->name('products');
    Route::get('/products/create', [SupplierProductController::class, 'create'])->name('products.create');
    Route::post('/products', [SupplierProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [SupplierProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{id}/update', [SupplierProductController::class, 'update'])->name('products.update');
    Route::post('/products/{id}/toggle', [SupplierProductController::class, 'toggleStatus'])->name('products.toggle');
    Route::delete('/products/{id}', [SupplierProductController::class, 'destroy'])->name('products.destroy');

    // RFQ Lead Marketplace & Quotes
    Route::get('/requirements', [SupplierRequirementController::class, 'index'])->name('requirements');
    Route::get('/requirements/{id}', [SupplierRequirementController::class, 'show'])->name('requirements.show');
    Route::post('/requirements/{id}/quote', [SupplierRequirementController::class, 'submitQuote'])->name('requirements.quote');
    Route::get('/quotes', [SupplierQuoteController::class, 'index'])->name('quotes');

    // Inquiries
    Route::get('/inquiries', [SupplierInquiryController::class, 'index'])->name('inquiries');
    Route::get('/inquiries/{id}', [SupplierInquiryController::class, 'show'])->name('inquiries.show');
    Route::post('/inquiries/{id}/reply', [SupplierInquiryController::class, 'reply'])->name('inquiries.reply');

    // Live Messages
    Route::get('/messages', [SupplierMessageController::class, 'index'])->name('messages');
    Route::post('/messages/send', [SupplierMessageController::class, 'send'])->name('messages.send');

    // Profile & Verification
    Route::get('/profile', [SupplierProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [SupplierProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/document', [SupplierProfileController::class, 'uploadDocument'])->name('profile.document');
    Route::post('/documents/upload', [SupplierProfileController::class, 'uploadDocument'])->name('documents.upload');

    // Reviews
    Route::get('/reviews', [SupplierReviewController::class, 'index'])->name('reviews');
    Route::post('/reviews/{id}/reply', [SupplierReviewController::class, 'reply'])->name('reviews.reply');

    // Subscription & Monetization
    Route::get('/subscription', [SupplierSubscriptionController::class, 'index'])->name('subscription');
    Route::post('/subscription/upgrade', [SupplierSubscriptionController::class, 'upgrade'])->name('subscription.upgrade');
    Route::post('/subscription/checkout', [SupplierSubscriptionController::class, 'upgrade'])->name('subscription.checkout');
});

/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,staff'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Users
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::post('/users/{id}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle');
    Route::post('/users/{id}/role', [AdminUserController::class, 'changeRole'])->name('users.role');

    // Verification
    Route::get('/verification', [AdminVerificationController::class, 'index'])->name('verification');
    Route::get('/verification/documents/{id}', [AdminVerificationController::class, 'viewDocument'])->name('verification.document');
    Route::post('/verification/{id}/approve', [AdminVerificationController::class, 'approve'])->name('verification.approve');
    Route::post('/verification/{id}/reject', [AdminVerificationController::class, 'reject'])->name('verification.reject');
    Route::post('/verification/suppliers/{id}/level', [AdminVerificationController::class, 'updateLevel'])->name('verification.level');

    // Products
    Route::get('/products', [AdminProductController::class, 'index'])->name('products');
    Route::post('/products/{id}/featured', [AdminProductController::class, 'toggleFeatured'])->name('products.featured');
    Route::post('/products/{id}/sponsored', [AdminProductController::class, 'toggleSponsored'])->name('products.sponsored');
    Route::post('/products/{id}/toggle', [AdminProductController::class, 'toggleStatus'])->name('products.toggle');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    // Categories
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::post('/categories/{id}/update', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::post('/categories/{id}/subcategory', [AdminCategoryController::class, 'storeSubcategory'])->name('categories.subcategory');
    Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

    // Requirements
    Route::get('/requirements', [AdminRequirementController::class, 'index'])->name('requirements');
    Route::post('/requirements/{id}/close', [AdminRequirementController::class, 'close'])->name('requirements.close');
    Route::delete('/requirements/{id}', [AdminRequirementController::class, 'destroy'])->name('requirements.destroy');

    // Subscriptions
    Route::get('/subscriptions', [AdminSubscriptionController::class, 'index'])->name('subscriptions');
    Route::post('/subscriptions/plans/{id}', [AdminSubscriptionController::class, 'updatePlan'])->name('subscriptions.plan.update');

    // Advertisements
    Route::get('/advertisements', [AdminAdvertisementController::class, 'index'])->name('advertisements');
    Route::post('/advertisements', [AdminAdvertisementController::class, 'store'])->name('advertisements.store');
    Route::post('/advertisements/{id}/toggle', [AdminAdvertisementController::class, 'toggleStatus'])->name('advertisements.toggle');
    Route::delete('/advertisements/{id}', [AdminAdvertisementController::class, 'destroy'])->name('advertisements.destroy');

    // Settings
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
});
