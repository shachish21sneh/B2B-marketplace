<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'supplier_id',
        'buyer_id',
        'buyer_name',
        'buyer_email',
        'buyer_phone',
        'quantity',
        'expected_price',
        'delivery_location',
        'message',
        'status',
        'supplier_reply',
    ];

    protected function casts(): array
    {
        return [
            'expected_price' => 'decimal:2',
            'quantity' => 'integer',
        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
