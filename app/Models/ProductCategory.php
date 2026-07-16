<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category';

    protected $fillable = [
        'pc_name',
        'pc_slug',
        'pc_description',
        'pc_image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (ProductCategory $category) {
            if (empty($category->pc_slug)) {
                $category->pc_slug = Str::slug($category->pc_name);
            }
        });
        
        static::updating(function (ProductCategory $category) {
            if ($category->isDirty('pc_name') && !$category->isDirty('pc_slug')) {
                $category->pc_slug = Str::slug($category->pc_name);
            }
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'ASC')->orderBy('pc_name', 'ASC');
    }

    public function scopeWithProductCount($query)
    {
        return $query->withCount('products');
    }

    // Accessors
    public function getImageUrlAttribute(): string
    {
        if ($this->pc_image) {
             if (file_exists(storage_path('app/public/'.$this->pc_image))) {
            return asset('storage/'.$this->pc_image);
           }
        }
        return asset('images/placeholder-category.jpg');
    }

    public function getProductsCountAttribute(): int
    {
        return $this->products()->count();
    }

    public function getActiveProductsCountAttribute(): int
    {
        return $this->products()->active()->count();
    }

    // Static Methods
    public static function getTotalCategories(): int
    {
        return self::count();
    }

    public static function getActiveCategories(): int
    {
        return self::active()->count();
    }

    public function getRouteKeyName(): string
    {
        return 'pc_slug';
    }
}