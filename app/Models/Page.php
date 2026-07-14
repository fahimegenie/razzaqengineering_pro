<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

#[Fillable([
    'page_title',
    'page_slug',
    'page_subtitle',
    'page_content',
    'page_excerpt',
    'page_template',
    'page_layout',
    'featured_image',
    'banner_image',
    'page_icon',
    'parent_id',
    'sort_order',
    'is_active',
    'show_in_menu',
    'show_in_footer',
    'is_homepage',
    'menu_title',
    'menu_icon',
    'meta_title',
    'meta_description',
    'meta_keywords',
    'og_image',
    'canonical_url',
    'schema_markup',
    'custom_fields'
])]
class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pages';

    protected function casts(): array
    {
        return [
            'custom_fields' => 'array',
            'is_active' => 'boolean',
            'show_in_menu' => 'boolean',
            'show_in_footer' => 'boolean',
            'is_homepage' => 'boolean',
            'sort_order' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Page $page) {
            if (empty($page->page_slug)) {
                $page->page_slug = Str::slug($page->page_title);
            }
        });

        static::saving(function (Page $page) {
            if ($page->is_homepage) {
                static::where('is_homepage', true)
                    ->where('id', '!=', $page->id)
                    ->update(['is_homepage' => false]);
            }
        });
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id')->orderBy('sort_order');
    }

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'page_id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeMenuItems(Builder $query): void
    {
        $query->where('show_in_menu', true)->orderBy('sort_order');
    }

    public function scopeFooterItems(Builder $query): void
    {
        $query->where('show_in_footer', true)->orderBy('sort_order');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->featured_image 
            ? asset('uploads/pages/' . $this->featured_image) 
            : asset('images/placeholder-page.jpg');
    }

    public function getBannerUrlAttribute(): string
    {
        return $this->banner_image 
            ? asset('uploads/pages/banners/' . $this->banner_image) 
            : $this->image_url;
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?? $this->page_title . ' - ' . config('app.name');
    }

    public function getExcerptAttribute($value): string
    {
        return $value ?? Str::limit(strip_tags($this->page_content), 160);
    }

    public function getRouteKeyName(): string
    {
        return 'page_slug';
    }
}