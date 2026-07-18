<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Company extends Model
{
    protected $table = 'our_company';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'oc_title',
        'oc_description',
        'oc_image1',
        'oc_image2',
        'oc_image3',
        'oc_image4',
        'ceo_name',
        'ceo_image',
        'ceo_message',
        'established_year',
        'company_type',
        'our_company_category',
        'sort_order',
        'is_active',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
    
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'ASC');
    }
    
    // Accessors (Virtual Attributes)
    public function getImage1UrlAttribute()
    {
        return $this->oc_image1 ? asset($this->oc_image1) : asset('images/default-company.jpg');
    }
    
    public function getImage2UrlAttribute()
    {
        return $this->oc_image2 ? asset($this->oc_image2) : asset('images/default-company.jpg');
    }
    
    public function getImage3UrlAttribute()
    {
        return $this->oc_image3 ? asset($this->oc_image3) : asset('images/default-company.jpg');
    }
    
    public function getImage4UrlAttribute()
    {
        return $this->oc_image4 ? asset($this->oc_image4) : asset('images/default-company.jpg');
    }
    
    public function getCeoImageUrlAttribute()
    {
        return $this->ceo_image ? asset($this->ceo_image) : asset('images/default-avatar.jpg');
    }
    
    // Helper Methods
    public function getShortDescription($length = 150)
    {
        return Str::limit(strip_tags($this->oc_description), $length);
    }
    
    public function getCeoShortMessage($length = 200)
    {
        return Str::limit(strip_tags($this->ceo_message), $length);
    }
    
    // Boot Method (Optional: Ensure only one active company)
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($company) {
            if (empty($company->sort_order)) {
                $company->sort_order = self::max('sort_order') + 1;
            }
        });
    }
}