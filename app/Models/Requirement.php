<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requirement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'buyer_id',
        'category_id',
        'title',
        'description',
        'quantity',
        'quantity_unit',
        'target_price',
        'preferred_location',
        'delivery_location',
        'pincode',
        'required_by',
        'payment_terms',
        'additional_requirements',
        'attachments',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'target_price' => 'decimal:2',
            'required_by' => 'date',
            'attachments' => 'array',
            'quantity' => 'integer',
        ];
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
