<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceDetail extends Model
{
    use HasFactory;

    protected $table = 'service_detail';

    protected $fillable = [
        'os_id',
        'sd_title',
        'sd_description',
        'sd_t1',
        'sd_t2',
        'sd_t3',
        'sd_image1',
        'sd_image2',
        'sd_features',
        'sort_order',
    ];

    protected $casts = [
        'sd_features' => 'array',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'os_id', 'id');
    }

    public function getImageOneUrlAttribute(): string
    {
        if ($this->sd_image1) {
            $path = asset('storage/'.$this->sd_image1);
            if (file_exists($path)) return $path;
        }
        return asset('images/placeholder-service-detail.jpg');
    }

    public function getImageTwoUrlAttribute(): string
    {
        if ($this->sd_image2) {
            $path = asset('storage/'.$this->sd_image2);
            if (file_exists($path)) return $path;
        }
        return asset('images/placeholder-service-detail.jpg');
    }

    public function getFeaturesListAttribute(): array
    {
        if (empty($this->sd_features)) return [];
        if (is_string($this->sd_features)) {
            $decoded = json_decode($this->sd_features, true);
            return is_array($decoded) ? $decoded : [];
        }
        return is_array($this->sd_features) ? $this->sd_features : [];
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'ASC');
    }
}