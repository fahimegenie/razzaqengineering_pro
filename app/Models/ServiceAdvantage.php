<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'sa_st_id',
    'sa_title',
    'sa_description',
    'sa_image',
    'sa_t1',
    'sa_t2',
    'sa_t3',
    'sa_t4',
    'sort_order'
])]
class ServiceAdvantage extends Model
{
    use HasFactory;

    protected $table = 'service_advantage';

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function serviceDetail(): BelongsTo
    {
        return $this->belongsTo(ServiceDetail::class, 'sa_st_id');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->sa_image 
            ? asset('uploads/services/advantages/' . $this->sa_image) 
            : asset('images/placeholder-advantage.jpg');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}