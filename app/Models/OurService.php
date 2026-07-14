<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

#[Fillable([
    'os_name',
    'os_slug',
    'os_icon',
    'os_image',
    'os_description',
    'os_short_description',
    'os_banner',
    'is_active',
    'is_featured',
    'sort_order',
    'meta_title',
    'meta_description',
    'meta_keywords'
])]
class OurService extends Model
{
    use HasFactory;

    protected $table = 'our_service';

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (OurService $service) {
            if (empty($service->os_slug)) {
                $service->os_slug = Str::slug($service->os_name);
            }
        });

        static::updating(function (OurService $service) {
            if ($service->isDirty('os_name') && !$service->isDirty('os_slug')) {
                $service->os_slug = Str::slug($service->os_name);
            }
        });
    }

    public function serviceDetails(): HasMany
    {
        return $this->hasMany(ServiceDetail::class, 'id');
    }

    public function serviceAdvantages(): HasMany
    {
        return $this->hasMany(ServiceAdvantage::class, 'sa_st_id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): void
    {
        $query->orderBy('sort_order')->orderBy('os_name');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->os_image 
            ? asset('uploads/services/' . $this->os_image) 
            : asset('images/placeholder-service.jpg');
    }

    public function getIconUrlAttribute(): string
    {
        return $this->os_icon 
            ? asset('uploads/services/icons/' . $this->os_icon) 
            : '';
    }

    public function getBannerUrlAttribute(): string
    {
        return $this->os_banner 
            ? asset('uploads/services/banners/' . $this->os_banner) 
            : $this->image_url;
    }

    public function getRouteKeyName(): string
    {
        return 'os_slug';
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?? $this->os_name . ' - Professional Services | Razzaq Engineering';
    }

    public function getMetaDescriptionAttribute($value): string
    {
        return $value ?? $this->os_short_description ?? Str::limit(strip_tags($this->os_description), 160);
    }
}