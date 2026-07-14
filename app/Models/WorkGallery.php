<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class WorkGallery extends Model
{
    use HasFactory;

    protected $table = 'work_gallery';
    protected $primaryKey = 'wg_id';

    protected $fillable = [
        'wg_type',
        'wg_title',
        'wg_image',
        'wg_description',
        'wg_category',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // ============================================
    // SCOPES
    // ============================================
    
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * ✅ FIX: Added ordered() scope
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'ASC')
                     ->orderBy('wg_created_at', 'DESC')
                     ->orderBy('created_at', 'DESC');
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
            if (file_exists(public_path('public/wg_image/' . $this->wg_image))) {
                return asset('public/wg_image/' . $this->wg_image);
            }
            if (file_exists(public_path('uploads/gallery/' . $this->wg_image))) {
                return asset('uploads/gallery/' . $this->wg_image);
            }
        }
        return asset('images/placeholder-gallery.jpg');
    }

    public function getTypeLabelAttribute(): string
    {
        return ucwords(str_replace('-', ' ', $this->wg_type));
    }
}