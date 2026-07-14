<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'our_service';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'os_name', 'os_icon', 'os_image', 'os_description',
        'os_slug', 'os_short_description', 'os_banner',
        'is_active', 'is_featured', 'sort_order',
        'meta_title', 'meta_description', 'meta_keywords'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];
    
    // Scopes
    public function scopeActive($query){
        return $query->where('is_active', 1);
    }
    
    public function scopeFeatured($query){
        return $query->where('is_featured', 1);
    }
    
    public function scopeOrdered($query){
        return $query->orderBy('sort_order', 'ASC');
    }
    
    // Relationships
    public function serviceDetails(){
        return $this->hasMany(ServiceDetail::class, 'id', 'id');
    }
    
    public function serviceAdvantages(){
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
}