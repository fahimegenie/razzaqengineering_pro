<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

#[Fillable([
    'seo_main_title',
    'seo_title',
    'seo_description',
    'seo_keywords',
    'seo_canonical',
    'seo_page_type',
    'seo_page_url',
    'seo_slug',
    'seo_robots',
    'seo_og_title',
    'seo_og_description',
    'seo_og_image',
    'seo_og_type',
    'seo_twitter_card',
    'seo_twitter_title',
    'seo_twitter_description',
    'seo_twitter_image',
    'seo_schema_markup',
    'seo_author',
    'seo_publisher',
    'seo_published_date',
    'seo_modified_date',
    'google_site_verification',
    'bing_site_verification',
    'google_analytics_id',
    'google_tag_manager_id',
    'seo_sitemap_include',
    'seo_sitemap_priority',
    'seo_sitemap_frequency'
])]
class SeoData extends Model
{
    use HasFactory;

    protected $table = 'seo_data';

    protected function casts(): array
    {
        return [
            'seo_published_date' => 'date',
            'seo_modified_date' => 'date',
            'seo_sitemap_include' => 'boolean',
            'seo_sitemap_priority' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function scopeByPageType(Builder $query, string $pageType): void
    {
        $query->where('seo_page_type', $pageType);
    }

    public function getMetaTitle(): string
    {
        return $this->seo_title ?? $this->seo_main_title ?? config('app.name');
    }

    public function getMetaDescription(): string
    {
        return $this->seo_description ?? 'Razzaq Engineering - Professional concrete cutting services in Pakistan';
    }

    public function getMetaKeywords(): string
    {
        return $this->seo_keywords ?? 'concrete cutting, core cutting, wall sawing, Pakistan';
    }

    public function getOgImageUrl(): string
    {
        return $this->seo_og_image 
            ? asset('uploads/seo/' . $this->seo_og_image) 
            : asset('images/og-default.jpg');
    }

    public function getTwitterImageUrl(): string
    {
        return $this->seo_twitter_image 
            ? asset('uploads/seo/' . $this->seo_twitter_image) 
            : $this->getOgImageUrl();
    }

    public function getSchemaArray(): array
    {
        return $this->seo_schema_markup 
            ? json_decode($this->seo_schema_markup, true) 
            : [];
    }

    public function getSitemapPriorityFormatted(): string
    {
        return number_format($this->seo_sitemap_priority / 100, 1);
    }
}