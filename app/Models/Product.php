<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'brand',
        'sku',
        'description',
        'price',
        'price_unit',
        'moq',
        'stock_qty',
        'main_image',
        'video_url',
        'specifications',
        'features',
        'packaging_details',
        'delivery_info',
        'payment_terms',
        'is_active',
        'is_featured',
        'is_sponsored',
        'views_count',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'moq' => 'integer',
            'stock_qty' => 'integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'is_sponsored' => 'boolean',
            'views_count' => 'integer',
            'specifications' => 'array',
        ];
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('status', 'approved')->latest();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return '₹' . number_format($this->price, 2) . ' / ' . $this->price_unit;
    }
}
