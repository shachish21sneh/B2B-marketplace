<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'requirement_id',
        'supplier_id',
        'buyer_id',
        'unit_price',
        'quantity',
        'moq',
        'delivery_time_days',
        'shipping_charges',
        'payment_terms',
        'validity_date',
        'notes',
        'attachment',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
            'shipping_charges' => 'decimal:2',
            'quantity' => 'integer',
            'moq' => 'integer',
            'delivery_time_days' => 'integer',
            'validity_date' => 'date',
        ];
    }

    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
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

    public function getTotalCostAttribute(): float
    {
        return ($this->unit_price * $this->quantity) + $this->shipping_charges;
    }
}
