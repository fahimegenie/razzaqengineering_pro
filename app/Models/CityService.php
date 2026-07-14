<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityService extends Model
{
    protected $table = 'city_service_seo';
    
    protected $fillable = [
        'city_id',
        'service_id',
        'title',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical',
        'schema',
        'content',
        'introduction',
        'benefits',
        'applications',
        'machines',
        'areas_covered',
        'faq',
        'is_active',
        'sort_order',
        'og_image',
        'meta_robots',
        'featured_image',
        'banner_image',
    ];

    protected $casts = [
        'faq' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // ============================================
    // SCOPES
    // ============================================
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'ASC');
    }

    // ============================================
    // RELATIONSHIPS
    // ============================================
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    // ============================================
    // ACCESSORS
    // ============================================
    public function getMetaTitleAttribute($value)
    {
        if ($value) return $value;
        return ($this->service->os_name ?? 'Service') . ' in ' . ($this->city->name ?? 'Pakistan') . ' | Razzaq Engineering';
    }

    public function getMetaDescriptionAttribute($value)
    {
        if ($value) return $value;
        $serviceName = $this->service->os_name ?? 'engineering';
        $cityName = $this->city->name ?? 'Pakistan';
        return "Professional {$serviceName} services in {$cityName}. Diamond Core Drilling, Wall Saw Cutting, Concrete Cutting. Call +92 304 8902805 for free quote.";
    }

    public function getCanonicalUrlAttribute($value)
    {
        if ($value) return $value;
        $citySlug = $this->city->slug ?? 'city';
        $serviceSlug = $this->service->os_slug ?? 'service';
        return url($citySlug . '/' . $serviceSlug);
    }

    public function getFaqsAttribute()
    {
        $faq = $this->faq;
        if (is_string($faq)) {
            return json_decode($faq, true) ?? [];
        }
        return is_array($faq) ? $faq : [];
    }

    public function getSchemaMarkupAttribute()
    {
        if ($this->schema) return $this->schema;
        
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $this->meta_title,
            'description' => $this->meta_description,
            'provider' => [
                '@type' => 'LocalBusiness',
                'name' => 'Razzaq Engineering Services',
                'telephone' => '+923048902805',
                'areaServed' => $this->city->name ?? 'Pakistan',
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}