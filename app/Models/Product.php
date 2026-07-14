<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

#[Fillable([
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
    'sort_order'
])]
class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected function casts(): array
    {
        return [
            'p_gallery' => 'array',
            'p_specifications' => 'array',
            'in_stock' => 'boolean',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            if (empty($product->p_slug)) {
                $product->p_slug = Str::slug($product->p_name);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    public function scopeInStock(Builder $query): void
    {
        $query->where('in_stock', true);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->p_image 
            ? asset('uploads/products/' . $this->p_image) 
            : asset('images/placeholder-product.jpg');
    }

    public function getGalleryUrlsAttribute(): array
    {
        return collect($this->p_gallery ?? [])->map(function ($image) {
            return asset('uploads/products/gallery/' . $image);
        })->toArray();
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'PKR ' . number_format((float) $this->p_price, 2);
    }

    public function getRouteKeyName(): string
    {
        return 'p_slug';
    }
}