<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'buyer_id',
        'product_id',
        'quality_rating',
        'communication_rating',
        'delivery_rating',
        'pricing_rating',
        'service_rating',
        'overall_rating',
        'title',
        'comment',
        'supplier_reply',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'quality_rating' => 'integer',
            'communication_rating' => 'integer',
            'delivery_rating' => 'integer',
            'pricing_rating' => 'integer',
            'service_rating' => 'integer',
            'overall_rating' => 'decimal:2',
        ];
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
