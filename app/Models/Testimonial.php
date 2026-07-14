<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
    
    public function scopeByLocation($query, $location)
    {
        return $query->where('t_location', $location);
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
    
    // Accessors (Virtual Attributes)
    public function getImageUrlAttribute()
    {
        if ($this->t_image) {
            return asset('storage/testimonials/' . $this->t_image);
        }
        return asset('images/default-avatar.jpg');
    }
    
    public function getRatingStarsAttribute()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->t_rating) {
                $stars .= '★'; // Filled star
            } else {
                $stars .= '☆'; // Empty star
            }
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
        if ($this->t_location) {
            return '📍 ' . $this->t_location;
        }
        return null;
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
    
    public function hasProject()
    {
        return !is_null($this->project_id);
    }
    
    public function hasService()
    {
        return !is_null($this->service_id);
    }
    
    // Static Methods for Dashboard/Analytics
    public static function getAverageRating()
    {
        return self::active()->avg('t_rating') ?? 0;
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
    
    public static function getFeaturedTestimonials($limit = 6)
    {
        return self::active()
            ->featured()
            ->ordered()
            ->limit($limit)
            ->get();
    }
    
    public static function getRandomTestimonials($limit = 3)
    {
        return self::active()
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }
    
    // Boot Method
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($testimonial) {
            // Auto-set sort order if not provided
            if (empty($testimonial->sort_order)) {
                $testimonial->sort_order = self::max('sort_order') + 1;
            }
            
            // Validate rating range
            if ($testimonial->t_rating < 1) {
                $testimonial->t_rating = 1;
            }
            if ($testimonial->t_rating > 5) {
                $testimonial->t_rating = 5;
            }
        });
        
        static::saving(function ($testimonial) {
            // Ensure rating is within valid range
            $testimonial->t_rating = max(1, min(5, $testimonial->t_rating));
        });
    }
}