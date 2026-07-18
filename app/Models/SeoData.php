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
        'seo_schema_markup' => 'array',
        'seo_breadcrumb_schema' => 'array'
    ];

    // ============================================
    // ACCESSORS
    // ============================================
    
    public function getMetaTitleAttribute(): string
    {
        return $this->seo_title ?? $this->seo_main_title ?? 'Razzaq Engineering';
    }

    public function getMetaDescriptionAttribute(): string
    {
        return Str::limit($this->seo_description ?? '', 160);
    }

    public function getMetaKeywordsAttribute(): string
    {
        return $this->seo_keywords ?? '';
    }

    public function getOgTitleAttribute(): string
    {
        return $this->seo_og_title ?? $this->meta_title;
    }

    public function getOgDescriptionAttribute(): string
    {
        return $this->seo_og_description ?? $this->meta_description;
    }

    public function getOgImageUrlAttribute(): string
    {
        if ($this->seo_og_image && file_exists(public_path($this->seo_og_image))) {
            return asset($this->seo_og_image);
        }
        return asset('images/og-default.jpg');
    }

    public function getTwitterImageUrlAttribute(): string
    {
        if ($this->seo_twitter_image && file_exists(public_path($this->seo_twitter_image))) {
            return asset($this->seo_twitter_image);
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

    // ============================================
    // SCOPES
    // ============================================
    
    public function scopeByPageType($query, $pageType)
    {
        return $query->where('seo_page_type', $pageType);
    }

    public function scopeBySlug($query, $slug)
    {
        return $query->where('seo_slug', $slug);
    }

    // ============================================
    // STATIC METHODS FOR DYNAMIC SEO
    // ============================================
    
    /**
     * Get SEO data - first check database, then generate from template
     */
    public static function getSeo(string $pageType, ?string $slug = null, ?string $citySlug = null): self
    {
        $query = self::where('is_active', 1)->where('seo_page_type', $pageType);
        
        if ($slug) {
            $query->where('seo_slug', $slug);
        }
        
        $seo = $query->first();
        
        if (!$seo) {
            $seo = self::generateDynamic($pageType, $slug, $citySlug);
        }
        
        return $seo;
    }
    
    /**
     * Generate dynamic SEO from templates
     */
    public static function generateDynamic(string $pageType, ?string $slug = null, ?string $citySlug = null): self
    {
        $companyName = config('app.name', 'Razzaq Engineering');
        $phone = config('app.phone', '0300-1234567');
        
        // Get entity name from slug
        $entityName = self::slugToTitle($slug);
        $cityName = $citySlug ? self::slugToTitle($citySlug) : '';
        
        $seo = new self();
        $seo->seo_page_type = $pageType;
        $seo->seo_slug = $slug;
        $seo->seo_robots = 'index, follow';
        $seo->seo_sitemap_include = true;
        $seo->seo_sitemap_priority = 80;
        $seo->seo_sitemap_frequency = 'weekly';
        
        switch ($pageType) {
            case 'home':
                $seo->seo_main_title = "{$companyName} - Professional Engineering Services in Pakistan";
                $seo->seo_title = "{$companyName} | RCC Core Cutting, Concrete Drilling & Construction Services";
                $seo->seo_description = "{$companyName} provides top-quality RCC core cutting, concrete drilling, wall sawing, demolition & construction services across Pakistan. ✓ Free Quote ✓ Professional Team. Call {$phone}!";
                $seo->seo_keywords = "Razzaq Engineering, engineering services Pakistan, RCC core cutting, concrete drilling, construction services, wall sawing, concrete demolition";
                break;
                
            case 'about':
                $seo->seo_main_title = "About Us - {$companyName} | Leading Engineering Services Provider";
                $seo->seo_title = "About {$companyName} - Trusted Engineering Services in Pakistan";
                $seo->seo_description = "Learn about {$companyName}, a trusted provider of professional RCC cutting, concrete drilling & construction services in Pakistan with years of experience. Call {$phone}!";
                $seo->seo_keywords = "about {$companyName}, engineering company Pakistan, construction services, RCC cutting experts";
                break;
                
            case 'faq':
                $seo->seo_main_title = "FAQ - {$companyName} | Frequently Asked Questions";
                $seo->seo_title = "Frequently Asked Questions - {$companyName} Engineering Services";
                $seo->seo_description = "Find answers to frequently asked questions about our RCC cutting, concrete drilling, pricing, and engineering services at {$companyName}. Contact us at {$phone}.";
                $seo->seo_keywords = "FAQ, frequently asked questions, engineering services FAQ, RCC cutting FAQ, concrete drilling questions";
                break;
                
            case 'contact':
                $seo->seo_main_title = "Contact Us - {$companyName} | Get Free Quote";
                $seo->seo_title = "Contact {$companyName} - Get Free Quote for Engineering Services";
                $seo->seo_description = "Contact {$companyName} for professional RCC cutting, concrete drilling & construction services. Call {$phone} or fill our online form for free consultation and quote.";
                $seo->seo_keywords = "contact {$companyName}, get free quote, engineering services contact, RCC cutting quote, concrete drilling contact";
                break;
                
            case 'services':
                $seo->seo_main_title = "Our Services - {$companyName} | Professional Engineering Services";
                $seo->seo_title = "Professional Engineering Services by {$companyName} | RCC Cutting & More";
                $seo->seo_description = "Explore our range of professional engineering services including RCC core cutting, concrete drilling, wall sawing, wire sawing, demolition & more. Call {$phone} for free quote!";
                $seo->seo_keywords = "engineering services, RCC cutting services, concrete drilling, wall sawing, wire sawing, demolition services, construction services Pakistan";
                break;
                
            case 'service_detail':
                if ($cityName) {
                    $seo->seo_main_title = "{$entityName} in {$cityName} - {$companyName} | Professional Services";
                    $seo->seo_title = "Best {$entityName} in {$cityName} | {$companyName} - Free Quote";
                    $seo->seo_description = "Professional {$entityName} in {$cityName} by {$companyName}. ✓ Affordable Rates ✓ Expert Team ✓ Quick Service. Serving all areas of {$cityName}. Call {$phone} for free quote!";
                    $seo->seo_keywords = "{$entityName} in {$cityName}, {$entityName} {$cityName}, best {$entityName} in {$cityName}, affordable {$entityName} {$cityName}, {$entityName} services {$cityName}, {$companyName} {$cityName}";
                } else {
                    $seo->seo_main_title = "{$entityName} - {$companyName} | Professional Engineering Services";
                    $seo->seo_title = "{$entityName} by {$companyName} | Professional Service in Pakistan";
                    $seo->seo_description = "Professional {$entityName} services by {$companyName}. We provide top-quality solutions across Pakistan with experienced team. Call {$phone} for free consultation!";
                    $seo->seo_keywords = "{$entityName}, {$entityName} Pakistan, professional {$entityName}, {$entityName} services, {$companyName} {$entityName}";
                }
                break;
                
            case 'projects':
                $seo->seo_main_title = "Our Projects - {$companyName} | Completed Engineering Projects";
                $seo->seo_title = "Completed Projects by {$companyName} | Engineering Portfolio";
                $seo->seo_description = "View our portfolio of completed engineering projects including RCC cutting, concrete drilling, demolition & construction work across Pakistan. Call {$phone}!";
                $seo->seo_keywords = "completed projects, engineering projects, RCC cutting projects, construction portfolio, {$companyName} projects";
                break;
                
            case 'project_detail':
                $seo->seo_main_title = "{$entityName} - {$companyName} | Project Details";
                $seo->seo_title = "{$entityName} | Project by {$companyName}";
                $seo->seo_description = "View details of {$entityName} project completed by {$companyName}. Professional engineering services with quality workmanship.";
                $seo->seo_keywords = "{$entityName}, project details, {$companyName} project, engineering project";
                break;
                
            case 'products':
                $seo->seo_main_title = "Our Products - {$companyName} | Engineering Products & Equipment";
                $seo->seo_title = "Engineering Products & Equipment by {$companyName} | Buy Online";
                $seo->seo_description = "Shop engineering products & equipment at {$companyName}. We offer RCC cutting machines, diamond core bits, concrete cutter blades & more. Call {$phone} to order!";
                $seo->seo_keywords = "engineering products, RCC cutting machines, diamond core bits, concrete cutter blades, construction equipment, {$companyName} products";
                break;
                
            case 'product_detail':
                $seo->seo_main_title = "{$entityName} - {$companyName} | Buy Online";
                $seo->seo_title = "Buy {$entityName} Online | {$companyName} - Best Price";
                $seo->seo_description = "Buy {$entityName} from {$companyName} at best price in Pakistan. ✓ Quality Products ✓ Fast Delivery ✓ Best Rates. Call {$phone} to order now!";
                $seo->seo_keywords = "buy {$entityName}, {$entityName} price, {$entityName} Pakistan, {$entityName} online, {$companyName} {$entityName}";
                break;
                
            case 'gallery':
                $seo->seo_main_title = "Gallery - {$companyName} | Our Work Portfolio";
                $seo->seo_title = "Photo Gallery | {$companyName} Engineering Work Portfolio";
                $seo->seo_description = "View our photo gallery showcasing RCC cutting, concrete drilling, demolition & construction work by {$companyName} across Pakistan. Call {$phone}!";
                $seo->seo_keywords = "photo gallery, work portfolio, engineering photos, RCC cutting photos, construction gallery, {$companyName} gallery";
                break;
                
            case 'team':
                $seo->seo_main_title = "Our Team - {$companyName} | Professional Engineers & Workers";
                $seo->seo_title = "Meet Our Expert Team | {$companyName} Professional Engineers";
                $seo->seo_description = "Meet our professional team of engineers and skilled workers at {$companyName}. Dedicated to delivering quality RCC cutting & construction services. Call {$phone}!";
                $seo->seo_keywords = "our team, professional engineers, skilled workers, {$companyName} team, engineering experts";
                break;
                
            case 'blog':
                $seo->seo_main_title = "Blog - {$companyName} | Engineering Tips & Insights";
                $seo->seo_title = "Engineering Blog | Tips, Guides & Insights by {$companyName}";
                $seo->seo_description = "Read our engineering blog for tips, guides, and insights about RCC cutting, concrete drilling, construction techniques & more from {$companyName} experts.";
                $seo->seo_keywords = "engineering blog, RCC cutting tips, construction guides, concrete drilling insights, {$companyName} blog";
                break;
                
            case 'blog_detail':
                $seo->seo_main_title = "{$entityName} - {$companyName} Blog";
                $seo->seo_title = "{$entityName} | {$companyName} Engineering Blog";
                $seo->seo_description = "Read about {$entityName} on {$companyName} blog. Expert insights and professional tips for engineering and construction projects.";
                $seo->seo_keywords = "{$entityName}, engineering article, construction blog, {$companyName} article";
                break;
                
            case 'quote':
                $seo->seo_main_title = "Get Free Quote - {$companyName} | Engineering Services";
                $seo->seo_title = "Get Free Quote for Engineering Services | {$companyName}";
                $seo->seo_description = "Get a free quote for RCC cutting, concrete drilling & construction services from {$companyName}. Fill our simple form or call {$phone} for instant pricing!";
                $seo->seo_keywords = "get free quote, engineering quote, RCC cutting quote, construction estimate, {$companyName} quote";
                break;
                
            case 'city':
                $seo->seo_main_title = "Engineering Services in {$cityName} - {$companyName}";
                $seo->seo_title = "Best Engineering Services in {$cityName} | {$companyName}";
                $seo->seo_description = "{$companyName} provides professional RCC cutting, concrete drilling & construction services in {$cityName}. ✓ Free Quote ✓ Expert Team. Call {$phone} now!";
                $seo->seo_keywords = "engineering services in {$cityName}, RCC cutting {$cityName}, concrete drilling {$cityName}, construction services {$cityName}, {$companyName} {$cityName}";
                break;
                
            case 'testimonials':
                $seo->seo_main_title = "Testimonials - {$companyName} | Client Reviews";
                $seo->seo_title = "Client Testimonials & Reviews | {$companyName}";
                $seo->seo_description = "Read what our clients say about {$companyName} engineering services. Real reviews from satisfied customers across Pakistan. Call {$phone}!";
                $seo->seo_keywords = "testimonials, client reviews, customer feedback, {$companyName} reviews, engineering services reviews";
                break;
                
            default:
                $seo->seo_main_title = "{$companyName} - Professional Engineering Services";
                $seo->seo_title = "{$companyName} | Engineering Services Pakistan";
                $seo->seo_description = "{$companyName} provides professional engineering services including RCC cutting, concrete drilling & construction across Pakistan. Call {$phone}!";
                $seo->seo_keywords = "{$companyName}, engineering services, RCC cutting, construction Pakistan";
                break;
        }
        
        // Auto-generate canonical URL
        $seo->seo_canonical = url()->current();
        
        // Auto-generate OG and Twitter titles
        $seo->seo_og_title = $seo->seo_title;
        $seo->seo_og_description = $seo->seo_description;
        $seo->seo_twitter_title = $seo->seo_title;
        $seo->seo_twitter_description = $seo->seo_description;
        
        return $seo;
    }
    
    /**
     * Convert slug to readable title
     */
    public static function slugToTitle(?string $slug): string
    {
        if (!$slug) return '';
        
        // Remove common words and clean up
        $title = str_replace(['-', '_'], ' ', $slug);
        $title = ucwords($title);
        
        // Special replacements
        $replacements = [
            'Rcc' => 'RCC',
            'Faq' => 'FAQ',
            'And' => '&',
            'amp' => '&',
        ];
        
        foreach ($replacements as $search => $replace) {
            $title = preg_replace('/\b' . $search . '\b/', $replace, $title);
        }
        
        return $title;
    }
    
    /**
     * Get all SEO data as array for views
     */
    public function toSEOArray(): array
    {
        return [
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'canonical' => $this->seo_canonical ?? url()->current(),
            'robots' => $this->robots_content,
            'og_title' => $this->og_title,
            'og_description' => $this->og_description,
            'og_image' => $this->og_image_url,
            'og_type' => $this->seo_og_type ?? 'website',
            'twitter_card' => $this->seo_twitter_card ?? 'summary_large_image',
            'twitter_title' => $this->seo_twitter_title ?? $this->meta_title,
            'twitter_description' => $this->seo_twitter_description ?? $this->meta_description,
            'twitter_image' => $this->twitter_image_url,
            'schema_markup' => $this->seo_schema_markup,
            'breadcrumb_schema' => $this->seo_breadcrumb_schema,
            'google_verification' => $this->google_site_verification,
            'bing_verification' => $this->bing_site_verification,
            'google_analytics' => $this->google_analytics_id,
            'google_tag_manager' => $this->google_tag_manager_id,
            'facebook_pixel' => $this->facebook_pixel_id,
            'hreflang' => $this->seo_hreflang,
            'author' => $this->seo_author,
            'publisher' => $this->seo_publisher,
        ];
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