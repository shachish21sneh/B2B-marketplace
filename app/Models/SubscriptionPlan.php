<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'billing_cycle',
        'product_limit',
        'inquiry_limit',
        'has_verified_badge',
        'has_priority_listing',
        'has_rfq_access',
        'has_analytics',
        'features',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'has_verified_badge' => 'boolean',
            'has_priority_listing' => 'boolean',
            'has_rfq_access' => 'boolean',
            'has_analytics' => 'boolean',
            'is_active' => 'boolean',
            'price' => 'decimal:2',
        ];
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }
}
