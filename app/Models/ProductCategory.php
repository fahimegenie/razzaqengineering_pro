<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

#[Fillable([
    'pc_name',
    'pc_slug',
    'pc_description',
    'pc_image',
    'is_active',
    'sort_order'
])]
class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category';

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (ProductCategory $category) {
            if (empty($category->pc_slug)) {
                $category->pc_slug = Str::slug($category->pc_name);
            }
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->pc_image 
            ? asset('uploads/product-categories/' . $this->pc_image) 
            : asset('images/placeholder-category.jpg');
    }

    public function getRouteKeyName(): string
    {
        return 'pc_slug';
    }
}