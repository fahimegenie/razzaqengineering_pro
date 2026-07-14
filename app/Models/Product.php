<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'p_name',
        'p_slug',
        'p_description',
        'p_short_description',
        'p_image',
        'p_price',
        'p_contact',
        'pc_type',
        'product_category_id',
        'p_gallery',
        'p_specifications',
        'in_stock',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'p_gallery' => 'array',
        'p_specifications' => 'array',
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            if (empty($product->p_slug)) {
                $product->p_slug = Str::slug($product->p_name);
            }
            if (empty($product->sort_order)) {
                $product->sort_order = self::max('sort_order') + 1;
            }
        });
        
        static::updating(function (Product $product) {
            if ($product->isDirty('p_name') && !$product->isDirty('p_slug')) {
                $product->p_slug = Str::slug($product->p_name);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }

    public function scopeInStock($query)
    {
        return $query->where('in_stock', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'ASC')->orderBy('p_name', 'ASC');
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('product_category_id', $categoryId);
    }

    // Accessors
    public function getImageUrlAttribute(): string
    {
        if ($this->p_image) {
            $paths = [
                public_path('uploads/products/' . $this->p_image),
                public_path('storage/products/' . $this->p_image),
            ];
            
            foreach ($paths as $path) {
                if (file_exists($path)) {
                    return asset(str_replace(public_path(), '', $path));
                }
            }
        }
        return asset('images/placeholder-product.jpg');
    }

    public function getGalleryUrlsAttribute(): array
    {
        return collect($this->p_gallery ?? [])->map(function ($image) {
            if (file_exists(public_path('uploads/products/gallery/' . $image))) {
                return asset('uploads/products/gallery/' . $image);
            }
            return null;
        })->filter()->values()->toArray();
    }

    public function getFormattedPriceAttribute(): string
    {
        if (!$this->p_price) return 'Price on Request';
        return 'PKR ' . number_format((float) $this->p_price, 2);
    }

    public function getSpecificationsListAttribute(): array
    {
        if (empty($this->p_specifications)) return [];
        
        if (is_string($this->p_specifications)) {
            $decoded = json_decode($this->p_specifications, true);
            return is_array($decoded) ? $decoded : [];
        }
        
        return is_array($this->p_specifications) ? $this->p_specifications : [];
    }

    public function getStockStatusAttribute(): string
    {
        return $this->in_stock ? 'In Stock' : 'Out of Stock';
    }

    public function getStockBadgeAttribute(): string
    {
        return $this->in_stock 
            ? '<span class="badge bg-success">In Stock</span>' 
            : '<span class="badge bg-danger">Out of Stock</span>';
    }

    // Static Methods
    public static function getTotalProducts(): int
    {
        return self::count();
    }

    public static function getActiveProducts(): int
    {
        return self::active()->count();
    }

    public static function getFeaturedProducts(): int
    {
        return self::featured()->count();
    }

    public function getRouteKeyName(): string
    {
        return 'p_slug';
    }
}