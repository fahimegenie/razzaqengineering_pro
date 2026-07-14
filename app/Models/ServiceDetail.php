<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'os_id',
    'sd_title',
    'sd_description',
    'sd_t1',
    'sd_t2',
    'sd_t3',
    'sd_image1',
    'sd_image2',
    'sd_features',
    'sort_order'
])]
class ServiceDetail extends Model
{
    use HasFactory;

    protected $table = 'service_detail';

    protected function casts(): array
    {
        return [
            'sd_features' => 'array',
            'sort_order' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(OurService::class, 'id');
    }

    public function advantages(): HasMany
    {
        return $this->hasMany(ServiceAdvantage::class, 'sa_st_id', 'id');
    }

    public function getImageOneUrlAttribute(): string
    {
        return $this->sd_image1 
            ? asset('uploads/services/details/' . $this->sd_image1) 
            : asset('images/placeholder-service-detail.jpg');
    }

    public function getImageTwoUrlAttribute(): string
    {
        return $this->sd_image2 
            ? asset('uploads/services/details/' . $this->sd_image2) 
            : asset('images/placeholder-service-detail.jpg');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}