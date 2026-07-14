<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    use HasFactory;

    protected $table = 'blog_categories';

    protected $fillable = [
        'bc_name',
        'bc_slug',
        'bc_description',
        'bc_image',
        'bc_color',
        'parent_id',
        'is_active',
        'is_featured',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

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
        static::creating(function (BlogCategory $category) {
            if (empty($category->bc_slug)) {
                $category->bc_slug = Str::slug($category->bc_name);
            }
        });
    }

    // ============================================
    // RELATIONSHIPS
    // ============================================
    
    public function parent(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(BlogCategory::class, 'parent_id')->orderBy('sort_order');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'category_id');
    }

    // ============================================
    // SCOPES
    // ============================================
    
    /**
     * ✅ FIX: Added ordered() scope
     */
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
                     ->orderBy('bc_name', 'ASC');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }

    public function scopeWithPublishedPosts($query)
    {
        return $query->whereHas('posts', function ($q) {
            $q->published();
        });
    }

    // ============================================
    // ACCESSORS
    // ============================================
    
    public function getImageUrlAttribute(): string
    {
        if ($this->bc_image) {
            if (file_exists(public_path('uploads/blog/categories/' . $this->bc_image))) {
                return asset('uploads/blog/categories/' . $this->bc_image);
            }
        }
        return asset('images/placeholder-category.jpg');
    }

    public function getPostsCountAttribute(): int
    {
        return $this->posts()->published()->count();
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'bc_slug';
    }
}