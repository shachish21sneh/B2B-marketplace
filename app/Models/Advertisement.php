<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'title',
        'placement',
        'image_path',
        'target_url',
        'starts_at',
        'ends_at',
        'is_active',
        'clicks_count',
        'impressions_count',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'is_active' => 'boolean',
            'clicks_count' => 'integer',
            'impressions_count' => 'integer',
        ];
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getImageAttribute()
    {
        return $this->image_path;
    }

    public function getLinkUrlAttribute()
    {
        return $this->target_url;
    }

    public function getPositionAttribute()
    {
        return $this->placement;
    }

    public function getStartDateAttribute()
    {
        return $this->starts_at;
    }

    public function getEndDateAttribute()
    {
        return $this->ends_at;
    }
}
