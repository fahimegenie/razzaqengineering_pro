<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'country',
        'lat',
        'lng',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'content',
        'schema',
        'why_choose_us',
        'areas_covered',
        'banner_image',
        'featured_image',
        'og_image',
        'phone',
        'email',
        'address',
        'google_map_embed',
        'is_active',
        'is_featured',
        'sort_order',
        'canonical_url',
        'meta_robots',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'lat' => 'decimal:8',
        'lng' => 'decimal:8',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Scope for active cities
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for featured cities
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Accessor for full city info
    public function getFullNameAttribute()
    {
        return $this->name . ', ' . $this->country;
    }
}