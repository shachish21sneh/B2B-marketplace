<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'doc_type',
        'doc_number',
        'file_path',
        'status',
        'rejection_reason',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
        ];
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getDocumentTypeAttribute()
    {
        return $this->doc_type;
    }

    public function getDocumentNameAttribute()
    {
        return $this->doc_number ?: (str_replace('_', ' ', $this->doc_type ?: 'GST Certificate') . ' Document');
    }
}
