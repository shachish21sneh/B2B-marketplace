<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'subscription_plan_id',
        'company_name',
        'slug',
        'business_type',
        'year_established',
        'employees_count',
        'gst_number',
        'pan_number',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'logo',
        'banner',
        'description',
        'website',
        'is_verified',
        'verification_level',
        'rating_avg',
        'reviews_count',
        'views_count',
        'is_featured',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',
            'is_featured' => 'boolean',
            'rating_avg' => 'decimal:2',
            'reviews_count' => 'integer',
            'views_count' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function documents()
    {
        return $this->hasMany(SupplierDocument::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function activeProducts()
    {
        return $this->hasMany(Product::class)->where('is_active', true);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('status', 'approved')->latest();
    }

    public function allReviews()
    {
        return $this->hasMany(Review::class)->latest();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class)->latest();
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function recalculateRating(): void
    {
        $approvedReviews = $this->reviews()->where('status', 'approved')->get();
        $count = $approvedReviews->count();
        $this->reviews_count = $count;
        $this->rating_avg = $count > 0 ? round($approvedReviews->avg('overall_rating'), 2) : 0.00;
        $this->save();
    }
}
