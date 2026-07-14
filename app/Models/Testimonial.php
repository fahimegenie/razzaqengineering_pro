<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Testimonial extends Model
{
    protected $table = 'testimonials';
    
    protected $fillable = [
        't_name',
        't_designation',
        't_company',
        't_image',
        't_content',
        't_rating',
        't_location',
        'project_id',
        'service_id',
        'is_active',
        'is_featured',
        'sort_order',
    ];
    
    protected $casts = [
        't_rating' => 'integer',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];
    
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
        return $query->orderBy('sort_order', 'ASC');
    }
    
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
    
    public function scopeByRating($query, $rating)
    {
        return $query->where('t_rating', $rating);
    }
    
    public function scopeHighRated($query)
    {
        return $query->where('t_rating', '>=', 4);
    }
    
    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'p_id');
    }
    
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'os_id');
    }
    
    // Accessors
    public function getImageUrlAttribute()
    {
        if ($this->t_image && file_exists(public_path('testimonial_images/' . $this->t_image))) {
            return asset('testimonial_images/' . $this->t_image);
        }
        return asset('images/default-avatar.png');
    }
    
    public function getRatingStarsAttribute()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            $stars .= $i <= $this->t_rating ? '★' : '☆';
        }
        return $stars;
    }
    
    public function getRatingPercentageAttribute()
    {
        return ($this->t_rating / 5) * 100;
    }
    
    public function getShortContentAttribute($length = 150)
    {
        return Str::limit(strip_tags($this->t_content), $length);
    }
    
    public function getFullNameWithCompanyAttribute()
    {
        if ($this->t_company) {
            return $this->t_name . ' - ' . $this->t_company;
        }
        return $this->t_name;
    }
    
    public function getLocationBadgeAttribute()
    {
        return $this->t_location ? '📍 ' . $this->t_location : null;
    }
    
    // Helper Methods
    public function isHighRated()
    {
        return $this->t_rating >= 4;
    }
    
    public function hasImage()
    {
        return !empty($this->t_image);
    }
    
    // Static Methods
    public static function getAverageRating()
    {
        return number_format(self::active()->avg('t_rating') ?? 0, 1);
    }
    
    public static function getTotalTestimonials()
    {
        return self::active()->count();
    }
    
    public static function getRatingDistribution()
    {
        $distribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $distribution[$i] = self::active()->where('t_rating', $i)->count();
        }
        return $distribution;
    }
    
    // Boot Method
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($testimonial) {
            if (empty($testimonial->sort_order)) {
                $testimonial->sort_order = self::max('sort_order') + 1;
            }
            $testimonial->t_rating = max(1, min(5, $testimonial->t_rating ?? 5));
        });
        
        static::saving(function ($testimonial) {
            $testimonial->t_rating = max(1, min(5, $testimonial->t_rating));
        });
    }
}