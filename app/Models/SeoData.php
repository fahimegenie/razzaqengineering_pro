<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class SeoData extends Model
{
    use HasFactory;

    protected $table = 'seo_data';

    protected $fillable = [
        'seo_main_title',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_focus_keyword',
        'seo_canonical',
        'seo_page_type',
        'seo_page_url',
        'seo_slug',
        'seo_robots',
        'seo_no_index',
        'seo_no_follow',
        'seo_og_title',
        'seo_og_description',
        'seo_og_image',
        'seo_og_type',
        'seo_twitter_card',
        'seo_twitter_title',
        'seo_twitter_description',
        'seo_twitter_image',
        'seo_schema_markup',
        'seo_schema_type',
        'seo_breadcrumb_schema',
        'seo_author',
        'seo_publisher',
        'seo_published_date',
        'seo_modified_date',
        'google_site_verification',
        'bing_site_verification',
        'yandex_site_verification',
        'google_analytics_id',
        'google_tag_manager_id',
        'facebook_pixel_id',
        'seo_sitemap_include',
        'seo_sitemap_priority',
        'seo_sitemap_frequency',
        'seo_hreflang',
        'seo_extra_data',
    ];

    protected $casts = [
        'seo_no_index' => 'boolean',
        'seo_no_follow' => 'boolean',
        'seo_sitemap_include' => 'boolean',
        'seo_sitemap_priority' => 'integer',
        'seo_published_date' => 'date',
        'seo_modified_date' => 'date',
        'seo_extra_data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ============================================
    // SCOPES
    // ============================================
    
    public function scopeByPageType($query, $pageType)
    {
        return $query->where('seo_page_type', $pageType);
    }

    public function scopeIndexable($query)
    {
        return $query->where('seo_no_index', false);
    }

    public function scopeFollowable($query)
    {
        return $query->where('seo_no_follow', false);
    }

    public function scopeInSitemap($query)
    {
        return $query->where('seo_sitemap_include', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('seo_page_type', 'ASC')->orderBy('seo_title', 'ASC');
    }

    // ============================================
    // ACCESSORS
    // ============================================
    
    public function getMetaTitleAttribute(): string
    {
        return $this->seo_title ?? $this->seo_main_title ?? config('app.name', 'Website');
    }

    public function getMetaDescriptionAttribute(): string
    {
        return $this->seo_description ?? '';
    }

    public function getMetaKeywordsAttribute(): string
    {
        return $this->seo_keywords ?? '';
    }

    public function getOgImageUrlAttribute(): string
    {
        if ($this->seo_og_image) {
            $path = public_path('uploads/seo/' . $this->seo_og_image);
            if (file_exists($path)) return asset('uploads/seo/' . $this->seo_og_image);
        }
        return asset('images/og-default.jpg');
    }

    public function getTwitterImageUrlAttribute(): string
    {
        if ($this->seo_twitter_image) {
            $path = public_path('uploads/seo/' . $this->seo_twitter_image);
            if (file_exists($path)) return asset('uploads/seo/' . $this->seo_twitter_image);
        }
        return $this->og_image_url;
    }

    public function getRobotsContentAttribute(): string
    {
        $parts = [];
        $parts[] = $this->seo_no_index ? 'noindex' : 'index';
        $parts[] = $this->seo_no_follow ? 'nofollow' : 'follow';
        return implode(', ', $parts);
    }

    public function getSitemapPriorityFormattedAttribute(): string
    {
        return number_format(($this->seo_sitemap_priority ?? 50) / 100, 1);
    }

    public function getPageTypeLabelAttribute(): string
    {
        return ucwords(str_replace(['-', '_'], ' ', $this->seo_page_type ?? 'website'));
    }

    public function getHasSchemaMarkupAttribute(): bool
    {
        return !empty($this->seo_schema_markup);
    }

    public function getHasVerificationAttribute(): bool
    {
        return !empty($this->google_site_verification) || 
               !empty($this->bing_site_verification) || 
               !empty($this->yandex_site_verification);
    }

    public function getHasAnalyticsAttribute(): bool
    {
        return !empty($this->google_analytics_id) || 
               !empty($this->google_tag_manager_id) || 
               !empty($this->facebook_pixel_id);
    }

    // ============================================
    // STATIC METHODS
    // ============================================
    
    public static function getTotalSeoRecords(): int
    {
        return self::count();
    }

    public static function getIndexableRecords(): int
    {
        return self::indexable()->count();
    }

    public static function getInSitemapRecords(): int
    {
        return self::inSitemap()->count();
    }

    public static function getPageTypes(): array
    {
        return self::distinct()->pluck('seo_page_type')->filter()->toArray();
    }

    public static function getByPageType($pageType)
    {
        return self::where('seo_page_type', $pageType)->first();
    }

    // ============================================
    // BOOT
    // ============================================
    
    protected static function booted(): void
    {
        static::creating(function (SeoData $seo) {
            if (empty($seo->seo_robots)) {
                $seo->seo_robots = 'index,follow';
            }
            if (empty($seo->seo_og_type)) {
                $seo->seo_og_type = 'website';
            }
            if (empty($seo->seo_twitter_card)) {
                $seo->seo_twitter_card = 'summary_large_image';
            }
        });
    }
}