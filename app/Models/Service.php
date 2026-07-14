<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $table = 'our_service';
    
    protected $fillable = [
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
        'meta_keywords',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Service $service) {
            if (empty($service->os_slug)) {
                $service->os_slug = Str::slug($service->os_name);
            }
            if (empty($service->sort_order)) {
                $service->sort_order = self::max('sort_order') + 1;
            }
        });
        
        static::updating(function (Service $service) {
            if ($service->isDirty('os_name') && !$service->isDirty('os_slug')) {
                $service->os_slug = Str::slug($service->os_name);
            }
        });
    }
    
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }
    
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'ASC')->orderBy('os_name', 'ASC');
    }
    
    // Relationships
    public function serviceDetails()
    {
        return $this->hasMany(ServiceDetail::class, 'os_id', 'id');
    }
    
    public function serviceAdvantages()
    {
        return $this->hasMany(ServiceAdvantage::class, 'sa_st_id', 'id');
    }

    public function cityServices()
    {
        return $this->hasMany(\App\Models\CityService::class, 'service_id', 'id');
    }

    public function cities()
    {
        return $this->belongsToMany(\App\Models\City::class, 'city_service_seo', 'service_id', 'city_id')
            ->withPivot(['title', 'meta_title', 'meta_description', 'content', 'faq', 'is_active'])
            ->wherePivot('is_active', 1);
    }

    // Accessors
    public function getImageUrlAttribute(): string
    {
        if ($this->os_image) {
            $paths = [
                public_path('slider_image/' . $this->os_image),
                public_path('storage/slider_image/' . $this->os_image),
            ];
            foreach ($paths as $path) {
                if (file_exists($path)) {
                    return asset(str_replace(public_path(), '', $path));
                }
            }
        }
        return asset('images/placeholder-service.jpg');
    }

    public function getBannerUrlAttribute(): string
    {
        if ($this->os_banner) {
            $paths = [
                public_path('slider_image/' . $this->os_banner),
                public_path('storage/slider_image/' . $this->os_banner),
            ];
            foreach ($paths as $path) {
                if (file_exists($path)) {
                    return asset(str_replace(public_path(), '', $path));
                }
            }
        }
        return $this->image_url;
    }

    public function getShortDescriptionAttribute($value): string
    {
        return $value ?: Str::limit(strip_tags($this->os_description ?? ''), 150);
    }

    // Static Methods
    public static function getTotalServices(): int
    {
        return self::count();
    }

    public static function getActiveServices(): int
    {
        return self::active()->count();
    }

    public static function getFeaturedServices(): int
    {
        return self::featured()->count();
    }

    public function getRouteKeyName(): string
    {
        return 'os_slug';
    }
}