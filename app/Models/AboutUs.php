<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AboutUs extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'aboutus';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // Basic Info
        'about_title',
        'about_subtitle',
        'about_short_description',
        'about_description_1',
        'about_description_2',
        'a_image',
        'about_banner',
        'about_video_url',
        'about_gallery',
        
        // Mission, Vision, Values
        'mission_title',
        'mission_description',
        'vision_title',
        'vision_description',
        'values_title',
        'values_description',
        
        // Statistics
        'years_experience',
        'projects_completed',
        'happy_clients',
        
        // Certifications & Awards
        'certifications',
        'awards',
        
        // Content Sections
        'our_story',
        'why_choose_us',
        'key_points',
        'statistics',
        
        // CEO/Director Info
        'ceo_name',
        'ceo_image',
        'ceo_message',
        'ceo_designation',
        
        // Status
        'is_active',
        'sort_order',
        
        // SEO Meta
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_robots',
        'og_image',
        'canonical_url',
        'schema_markup',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [
            'about_gallery' => 'array',
            'certifications' => 'array',
            'awards' => 'array',
            'key_points' => 'array',
            'statistics' => 'array',
            'years_experience' => 'integer',
            'projects_completed' => 'integer',
            'happy_clients' => 'integer',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // ============================================
    // SCOPES
    // ============================================
    
    /**
     * Scope a query to only include active records.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'ASC');
    }

    // ============================================
    // CACHING
    // ============================================

    /**
     * Get cached about us data.
     */
    public static function getCached(): ?self
    {
        $cacheKey = 'about_us_data';
        $cacheDuration = 3600; // 1 hour

        return Cache::remember($cacheKey, $cacheDuration, function () {
            return static::active()->ordered()->first();
        });
    }

    /**
     * Clear cache on model events.
     */
    protected static function booted(): void
    {
        static::saved(function ($model) {
            Cache::forget('about_us_data');
        });

        static::deleted(function ($model) {
            Cache::forget('about_us_data');
            // Clean up files
            if ($model->a_image) {
                Storage::disk('public')->delete('about/' . $model->a_image);
            }
            if ($model->about_banner) {
                Storage::disk('public')->delete('about/' . $model->about_banner);
            }
            if ($model->ceo_image) {
                Storage::disk('public')->delete('about/' . $model->ceo_image);
            }
        });
    }

    // ============================================
    // IMAGE ACCESSORS
    // ============================================

    /**
     * Get the main image URL with fallback.
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->a_image) {
                    if (file_exists(public_path($this->a_image))) {
                        return asset($this->a_image);
                    }
                    if (file_exists(public_path($this->a_image))) {
                        return asset($this->a_image);
                    }
                    if (file_exists(public_path($this->a_image))) {
                        return asset($this->a_image);
                    }
                }
                return asset('assets/images/placeholder-about.jpg');
            }
        );
    }

    /**
     * Get the banner image URL with fallback.
     */
    protected function bannerUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->about_banner) {
                    if (file_exists(public_path($this->about_banner))) {
                        return asset($this->about_banner);
                    }
                    if (file_exists(public_path($this->about_banner))) {
                        return asset( $this->about_banner);
                    }
                }
                return $this->image_url;
            }
        );
    }

    /**
     * Get the CEO image URL with fallback.
     */
    protected function ceoImageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->ceo_image) {
                    if (file_exists(public_path($this->ceo_image))) {
                        return asset($this->ceo_image);
                    }
                    if (file_exists(public_path($this->ceo_image))) {
                        return asset($this->ceo_image);
                    }
                    if (file_exists(public_path($this->ceo_image))) {
                        return asset($this->ceo_image);
                    }
                }
                return asset('assets/images/placeholder-ceo.jpg');
            }
        );
    }

    /**
     * Get gallery image URLs.
     */
    protected function galleryUrls(): Attribute
    {
        return Attribute::make(
            get: function () {
                return collect($this->about_gallery ?? [])->map(function ($image) {
                    if (file_exists(public_path($image))) {
                        return asset($image);
                    }
                    if (file_exists(public_path($image))) {
                        return asset($image);
                    }
                    return asset('assets/images/placeholder-gallery.jpg');
                })->toArray();
            }
        );
    }

    /**
     * Get OG image URL.
     */
    protected function ogImageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->og_image) {
                    $path = 'about/' . $this->og_image;
                    if (file_exists(public_path($path))) {
                        return asset($path);
                    }
                }
                return $this->image_url;
            }
        );
    }

    // ============================================
    // STATISTICS ACCESSORS
    // ============================================

    /**
     * Get formatted years experience.
     */
    protected function formattedYearsExperience(): Attribute
    {
        return Attribute::make(
            get: fn() => ($this->years_experience ?? 0) . '+'
        );
    }

    /**
     * Get formatted projects completed.
     */
    protected function formattedProjectsCompleted(): Attribute
    {
        return Attribute::make(
            get: fn() => number_format($this->projects_completed ?? 0) . '+'
        );
    }

    /**
     * Get formatted happy clients.
     */
    protected function formattedHappyClients(): Attribute
    {
        return Attribute::make(
            get: fn() => number_format($this->happy_clients ?? 0) . '+'
        );
    }

    /**
     * Get all statistics as array for frontend.
     */
    protected function statisticsArray(): Attribute
    {
        return Attribute::make(
            get: function () {
                $stats = [
                    [
                        'label' => 'Years Experience',
                        'value' => $this->formatted_years_experience,
                        'number' => $this->years_experience ?? 0,
                        'icon' => 'fas fa-calendar-alt',
                        'color' => '#28a745',
                    ],
                    [
                        'label' => 'Projects Completed',
                        'value' => $this->formatted_projects_completed,
                        'number' => $this->projects_completed ?? 0,
                        'icon' => 'fas fa-check-circle',
                        'color' => '#0056b3',
                    ],
                    [
                        'label' => 'Happy Clients',
                        'value' => $this->formatted_happy_clients,
                        'number' => $this->happy_clients ?? 0,
                        'icon' => 'fas fa-smile',
                        'color' => '#ffc107',
                    ],
                ];

                // Add custom statistics if available
                if ($this->statistics && is_array($this->statistics)) {
                    foreach ($this->statistics as $key => $stat) {
                        $stats[] = [
                            'label' => $stat['label'] ?? 'Stat ' . ($key + 4),
                            'value' => ($stat['value'] ?? '0') . '+',
                            'number' => (int)($stat['value'] ?? 0),
                            'icon' => $stat['icon'] ?? 'fas fa-star',
                            'color' => $stat['color'] ?? '#6c757d',
                        ];
                    }
                }

                return $stats;
            }
        );
    }

    // ============================================
    // CONTENT ACCESSORS
    // ============================================

    /**
     * Get key points as clean array.
     */
    protected function keyPointsList(): Attribute
    {
        return Attribute::make(
            get: function () {
                $points = $this->key_points ?? [];
                
                // If empty, return default points
                if (empty($points)) {
                    return [
                        'Licensed & Certified Company',
                        '24/7 Emergency Services Available',
                        '100% Quality Guaranteed Workmanship',
                        'Nationwide Coverage Across Pakistan',
                    ];
                }
                
                return $points;
            }
        );
    }

    /**
     * Get certifications as clean array.
     */
    protected function certificationsList(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->certifications ?? []
        );
    }

    /**
     * Get awards as clean array.
     */
    protected function awardsList(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->awards ?? []
        );
    }

    /**
     * Get why choose us points.
     */
    protected function whyChooseUsList(): Attribute
    {
        return Attribute::make(
            get: function () {
                $points = $this->why_choose_us ?? [];
                
                if (empty($points)) {
                    return [
                        ['icon' => 'fa-hand-holding-usd', 'title' => 'No Extra Charges', 'desc' => 'Transparent pricing with no hidden fees.'],
                        ['icon' => 'fa-clock', 'title' => '24/7 Emergency Service', 'desc' => 'Available anytime, anywhere in Pakistan.'],
                        ['icon' => 'fa-certificate', 'title' => 'Licensed & Certified', 'desc' => 'Fully registered with professional certifications.'],
                        ['icon' => 'fa-tags', 'title' => 'Special Offers', 'desc' => 'Exclusive deals for our valued clients.'],
                        ['icon' => 'fa-smile', 'title' => 'Customer Satisfaction', 'desc' => '100% client satisfaction priority.'],
                        ['icon' => 'fa-truck-fast', 'title' => 'On-Time Delivery', 'desc' => 'Projects delivered on schedule.'],
                    ];
                }
                
                return $points;
            }
        );
    }

    /**
     * Get short description with fallback.
     */
    protected function shortDescription(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->about_short_description) {
                    return $this->about_short_description;
                }
                return Str::limit(strip_tags($this->about_description_1 ?? ''), 200);
            }
        );
    }

    // ============================================
    // SEO ACCESSORS
    // ============================================

    /**
     * Get meta title with fallback.
     */
    protected function seoMetaTitle(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->meta_title 
                    ?? $this->about_title . ' - ' . config('app.name', 'Razzaq Engineering');
            }
        );
    }

    /**
     * Get meta description with fallback.
     */
    protected function seoMetaDescription(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->meta_description 
                    ?? $this->about_short_description 
                    ?? Str::limit(strip_tags($this->about_description_1 ?? ''), 160);
            }
        );
    }

    /**
     * Get meta keywords.
     */
    protected function seoMetaKeywords(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->meta_keywords 
                    ?? 'RCC core cutting, diamond drilling, wall saw cutting, engineering services Pakistan';
            }
        );
    }

    /**
     * Get canonical URL.
     */
    protected function seoCanonicalUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->canonical_url ?? url('about-us');
            }
        );
    }

    /**
     * Get robots meta.
     */
    protected function seoMetaRobots(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->meta_robots ?? 'index, follow, max-snippet:-1, max-image-preview:large'
        );
    }

    /**
     * Get schema markup as array.
     */
    protected function schemaMarkupArray(): Attribute
    {
        return Attribute::make(
            get: function () {
                // Return custom schema if set
                if ($this->schema_markup) {
                    $decoded = json_decode($this->schema_markup, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        return $decoded;
                    }
                }

                // Default Organization schema
                return [
                    '@context' => 'https://schema.org',
                    '@type' => 'Organization',
                    'name' => config('app.name', 'Razzaq Engineering Services'),
                    'url' => url('/'),
                    'description' => $this->about_short_description ?? strip_tags($this->about_description_1 ?? ''),
                    'foundingDate' => $this->years_experience ? (date('Y') - $this->years_experience) : null,
                    'founder' => $this->ceo_name ? [
                        '@type' => 'Person',
                        'name' => $this->ceo_name,
                        'jobTitle' => $this->ceo_designation ?? 'Founder & CEO',
                        'image' => $this->ceo_image_url,
                    ] : null,
                    'image' => $this->image_url,
                    'sameAs' => [
                        'https://web.facebook.com/razzaqengineering/',
                        'https://www.instagram.com/razzaq_engineering',
                        'https://www.linkedin.com/in/razzaq-engineering-services-265b15401/',
                    ],
                ];
            }
        );
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    /**
     * Check if model has complete data.
     */
    public function isComplete(): bool
    {
        return !empty($this->about_title) 
            && !empty($this->about_description_1) 
            && !empty($this->a_image);
    }

    /**
     * Get the founding year.
     */
    public function getFoundingYearAttribute(): ?int
    {
        return $this->years_experience ? (date('Y') - $this->years_experience) : null;
    }

    /**
     * Get CEO full info as array.
     */
    public function getCeoInfoAttribute(): array
    {
        return [
            'name' => $this->ceo_name ?? 'Muhammad Razzaq',
            'designation' => $this->ceo_designation ?? 'Founder & CEO',
            'message' => $this->ceo_message ?? '',
            'image' => $this->ceo_image_url,
            'has_image' => !empty($this->ceo_image),
        ];
    }

    /**
     * Get the model as SEO array for frontend.
     */
    public function getSeoDataAttribute(): array
    {
        return [
            'seo_title' => $this->seo_meta_title,
            'seo_description' => $this->seo_meta_description,
            'seo_keywords' => $this->seo_meta_keywords,
            'seo_canonical' => $this->seo_canonical_url,
            'seo_robots' => $this->seo_meta_robots,
            'seo_og_image' => $this->og_image_url,
            'seo_schema_markup' => json_encode($this->schema_markup_array, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT),
        ];
    }

    /**
     * Reload the model and clear cache.
     */
    public static function refreshCache(): ?self
    {
        Cache::forget('about_us_data');
        return static::getCached();
    }
}