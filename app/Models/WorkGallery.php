<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class WorkGallery extends Model
{
    use HasFactory;

    protected $table = 'work_gallery';
    protected $primaryKey = 'id'; // Fixed: Using 'id' as per migration

    protected $fillable = [
        'wg_type',
        'wg_title',
        'wg_image',
        'wg_description',
        'wg_category',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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
        return $query->orderBy('sort_order', 'ASC')
                     ->orderBy('created_at', 'DESC');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('wg_type', $type);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('wg_category', $category);
    }

    // ============================================
    // ACCESSORS
    // ============================================
    
    public function getImageUrlAttribute(): string
    {
        if ($this->wg_image) {
            // Check multiple possible paths
            $paths = [
                public_path('wg_image/' . $this->wg_image),
                public_path('uploads/gallery/' . $this->wg_image),
                public_path('storage/gallery/' . $this->wg_image),
            ];
            
            foreach ($paths as $path) {
                if (file_exists($path)) {
                    return asset(str_replace(public_path(), '', $path));
                }
            }
        }
        
        // Default placeholder
        return asset('images/placeholder-gallery.jpg');
    }

    public function getTypeLabelAttribute(): string
    {
        return ucwords(str_replace(['-', '_'], ' ', $this->wg_type ?? ''));
    }

    public function getCategoryLabelAttribute(): string
    {
        return ucwords(str_replace(['-', '_'], ' ', $this->wg_category ?? ''));
    }

    public function getShortDescriptionAttribute($length = 100): string
    {
        return Str::limit(strip_tags($this->wg_description ?? ''), $length);
    }

    // ============================================
    // HELPER METHODS
    // ============================================
    
    public function hasImage(): bool
    {
        return !empty($this->wg_image);
    }

    // ============================================
    // STATIC METHODS
    // ============================================
    
    public static function getTotalItems(): int
    {
        return self::active()->count();
    }

    public static function getTypes(): array
    {
        return self::distinct()->whereNotNull('wg_type')->pluck('wg_type')->toArray();
    }

    public static function getCategories(): array
    {
        return self::distinct()->whereNotNull('wg_category')->pluck('wg_category')->toArray();
    }

    // ============================================
    // BOOT
    // ============================================
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($gallery) {
            if (empty($gallery->sort_order)) {
                $gallery->sort_order = self::max('sort_order') + 1;
            }
        });
    }
}