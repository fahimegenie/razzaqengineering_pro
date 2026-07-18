<?php

namespace App\Livewire\Admin\SEO;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\SeoData;
use App\Models\City;
use App\Models\ServiceDetail;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

#[Layout('components.layouts.admin-layout')]
#[Title('SEO Data Form - Admin Panel')]
class SeoDataForm extends Component
{
    use WithFileUploads;

    public $seoId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    // File uploads
    public $seo_og_image;
    public $seo_twitter_image;
    public $existing_og_image = null;
    public $existing_twitter_image = null;
    public $ogImagePreview;
    public $twitterImagePreview;
    
    // Basic SEO
    #[Validate('nullable|string|max:255')]
    public $seo_main_title = '';
    
    #[Validate('nullable|string|max:255')]
    public $seo_title = '';
    
    #[Validate('nullable|string|max:500')]
    public $seo_description = '';
    
    #[Validate('nullable|string|max:500')]
    public $seo_keywords = '';
    
    #[Validate('nullable|string|max:255')]
    public $seo_focus_keyword = '';
    
    #[Validate('nullable|url|max:500')]
    public $seo_canonical = '';
    
    // Page Info
    #[Validate('required|string|max:50')]
    public $seo_page_type = 'home';
    
    #[Validate('nullable|string|max:500')]
    public $seo_page_url = '';
    
    #[Validate('nullable|string|max:255')]
    public $seo_slug = '';
    
    // Dynamic entity selection
    public $selected_service_id = null;
    public $selected_product_category_id = null;
    public $selected_city_id = null;
    public $is_city_specific = false;
    
    // Robots
    #[Validate('nullable|string|max:50')]
    public $seo_robots = 'index,follow';
    
    #[Validate('boolean')]
    public $seo_no_index = false;
    
    #[Validate('boolean')]
    public $seo_no_follow = false;
    
    // Open Graph
    #[Validate('nullable|string|max:255')]
    public $seo_og_title = '';
    
    #[Validate('nullable|string|max:500')]
    public $seo_og_description = '';
    
    #[Validate('nullable|string|max:50')]
    public $seo_og_type = 'website';
    
    // Twitter
    #[Validate('nullable|string|max:50')]
    public $seo_twitter_card = 'summary_large_image';
    
    #[Validate('nullable|string|max:255')]
    public $seo_twitter_title = '';
    
    #[Validate('nullable|string|max:500')]
    public $seo_twitter_description = '';
    
    // Schema
    #[Validate('nullable|string')]
    public $seo_schema_markup = '';
    
    #[Validate('nullable|string|max:50')]
    public $seo_schema_type = '';
    
    #[Validate('nullable|string')]
    public $seo_breadcrumb_schema = '';
    
    // Advanced
    #[Validate('nullable|string|max:255')]
    public $seo_author = '';
    
    #[Validate('nullable|string|max:255')]
    public $seo_publisher = '';
    
    #[Validate('nullable|date')]
    public $seo_published_date = null;
    
    #[Validate('nullable|date')]
    public $seo_modified_date = null;
    
    // Verification
    #[Validate('nullable|string')]
    public $google_site_verification = '';
    
    #[Validate('nullable|string')]
    public $bing_site_verification = '';
    
    #[Validate('nullable|string')]
    public $yandex_site_verification = '';
    
    // Analytics
    #[Validate('nullable|string')]
    public $google_analytics_id = '';
    
    #[Validate('nullable|string')]
    public $google_tag_manager_id = '';
    
    #[Validate('nullable|string')]
    public $facebook_pixel_id = '';
    
    // Sitemap
    #[Validate('boolean')]
    public $seo_sitemap_include = true;
    
    #[Validate('nullable|integer|min:0|max:100')]
    public $seo_sitemap_priority = 50;
    
    #[Validate('nullable|string|max:20')]
    public $seo_sitemap_frequency = 'weekly';
    
    // Hreflang
    #[Validate('nullable|string|max:255')]
    public $seo_hreflang = '';

    // Dropdown options
    public $services = [];
    public $productCategories = [];
    public $cities = [];
    public $showDynamicFields = false;
    public $dynamicPreview = null;

    // Page type groups
    public $pageTypeGroups = [
        'Static Pages' => [
            'home' => 'Home Page',
            'about' => 'About Page',
            'contact' => 'Contact Page',
            'faq' => 'FAQ Page',
            'gallery' => 'Gallery Page',
            'team' => 'Team Page',
            'testimonials' => 'Testimonials Page',
            'quote' => 'Quote Page',
            'services' => 'Services Listing Page',
            'products' => 'Products Listing Page',
            'projects' => 'Projects Listing Page',
            'blog' => 'Blog Listing Page',
        ],
        'Dynamic Entity Pages' => [
            'service_detail' => 'Service Detail Page',
            'project_detail' => 'Project Detail Page',
            'product_detail' => 'Product Detail Page',
            'blog_detail' => 'Blog Detail Page',
        ],
        'City/Location Pages' => [
            'city' => 'City Page (All Services)',
            'city_service' => 'City + Service Page',
            'city_product' => 'City + Product Category Page',
        ],
    ];

    public $ogTypes = [
        'website' => 'Website',
        'article' => 'Article',
        'product' => 'Product',
        'profile' => 'Profile',
        'video' => 'Video',
    ];

    public $twitterCards = [
        'summary' => 'Summary',
        'summary_large_image' => 'Summary Large Image',
        'app' => 'App',
        'player' => 'Player',
    ];

    public $schemaTypes = [
        '' => 'None',
        'Organization' => 'Organization',
        'LocalBusiness' => 'Local Business',
        'WebSite' => 'WebSite',
        'Article' => 'Article',
        'Product' => 'Product',
        'Service' => 'Service',
        'FAQ' => 'FAQ',
        'BreadcrumbList' => 'Breadcrumb List',
    ];

    public $sitemapFrequencies = [
        'always' => 'Always',
        'hourly' => 'Hourly',
        'daily' => 'Daily',
        'weekly' => 'Weekly',
        'monthly' => 'Monthly',
        'yearly' => 'Yearly',
        'never' => 'Never',
    ];

    public function mount($seoId = null)
    {
        $this->loadDropdownData();
        
        if ($seoId) {
            $seo = $seoId instanceof SeoData ? $seoId : SeoData::find($seoId);
            
            if ($seo) {
                $this->seoId = $seo->id;
                $this->isEditing = true;
                $this->loadSeoData($seo);
            }
        } else {
            // Default for new record
            $this->generateDynamicPreview();
        }
    }

    // Add this method to handle the page type change more reliably
    #[On('pageTypeChanged')]
    public function handlePageTypeChange($value): void
    {
        $this->seo_page_type = $value;
        $this->updatedSeoPageType();
    }

    protected function loadDropdownData(): void
    {
        $this->services = ServiceDetail::orderBy('sd_title')->get(['id', 'sd_title']);
        $this->productCategories = ProductCategory::where('is_active', true)->orderBy('pc_name')->get(['id', 'pc_name']);
        $this->cities = City::where('is_active', true)->orderBy('name')->get(['id', 'name', 'slug']);
    }

    protected function loadSeoData($seo): void
    {
        $fillable = [
            'seo_main_title', 'seo_title', 'seo_description', 'seo_keywords',
            'seo_focus_keyword', 'seo_canonical', 'seo_page_type', 'seo_page_url',
            'seo_slug', 'seo_robots', 'seo_no_index', 'seo_no_follow',
            'seo_og_title', 'seo_og_description', 'seo_og_type',
            'seo_twitter_card', 'seo_twitter_title', 'seo_twitter_description',
            'seo_schema_markup', 'seo_schema_type', 'seo_breadcrumb_schema',
            'seo_author', 'seo_publisher', 'seo_published_date', 'seo_modified_date',
            'google_site_verification', 'bing_site_verification', 'yandex_site_verification',
            'google_analytics_id', 'google_tag_manager_id', 'facebook_pixel_id',
            'seo_sitemap_include', 'seo_sitemap_priority', 'seo_sitemap_frequency',
            'seo_hreflang',
        ];
        
        foreach ($fillable as $field) {
            if (isset($seo->$field)) {
                $this->$field = $seo->$field;
            }
        }
        
        // Load extra data
        if ($seo->seo_extra_data) {
            $extra = is_array($seo->seo_extra_data) ? $seo->seo_extra_data : json_decode($seo->seo_extra_data, true);
            $this->selected_service_id = $extra['service_id'] ?? null;
            $this->selected_product_category_id = $extra['product_category_id'] ?? null;
            $this->selected_city_id = $extra['city_id'] ?? null;
            $this->is_city_specific = $extra['is_city_specific'] ?? false;
        }
        
        // Format dates
        if ($seo->seo_published_date) {
            $this->seo_published_date = $seo->seo_published_date instanceof \Carbon\Carbon 
                ? $seo->seo_published_date->format('Y-m-d') 
                : $seo->seo_published_date;
        }
        if ($seo->seo_modified_date) {
            $this->seo_modified_date = $seo->seo_modified_date instanceof \Carbon\Carbon 
                ? $seo->seo_modified_date->format('Y-m-d') 
                : $seo->seo_modified_date;
        }
        
        // Images
        $this->existing_og_image = $seo->seo_og_image;
        if ($this->existing_og_image && Storage::disk('public')->exists($this->existing_og_image)) {
            $this->ogImagePreview = Storage::disk('public')->url($this->existing_og_image);
        }
        
        $this->existing_twitter_image = $seo->seo_twitter_image;
        if ($this->existing_twitter_image && Storage::disk('public')->exists($this->existing_twitter_image)) {
            $this->twitterImagePreview = Storage::disk('public')->url($this->existing_twitter_image);
        }
        
        $this->checkDynamicFields();
    }

    // ============================================
    // DYNAMIC FIELD HANDLERS
    // ============================================
    
    public function updatedSeoPageType(): void
    {
        // Reset dynamic selections when page type changes
        if (!in_array($this->seo_page_type, ['service_detail', 'city_service'])) {
            $this->selected_service_id = null;
        }
        if (!in_array($this->seo_page_type, ['product_detail', 'city_product'])) {
            $this->selected_product_category_id = null;
        }
        if (!in_array($this->seo_page_type, ['city', 'city_service', 'city_product'])) {
            $this->selected_city_id = null;
        }

        $this->checkDynamicFields();
        $this->generateDynamicPreview();
        $this->autoFillSlug();
    }

    public function updatedSelectedServiceId(): void
    {
        $this->generateDynamicPreview();
        $this->autoFillSlug();
    }

    public function updatedSelectedProductCategoryId(): void
    {
        $this->generateDynamicPreview();
        $this->autoFillSlug();
    }

    public function updatedSelectedCityId(): void
    {
        $this->generateDynamicPreview();
        $this->autoFillSlug();
    }

    public function updatedIsCitySpecific(): void
    {
        $this->generateDynamicPreview();
    }

    protected function checkDynamicFields(): void
    {
        $dynamicTypes = ['service_detail', 'product_detail', 'project_detail', 'blog_detail', 'city', 'city_service', 'city_product'];
        $this->showDynamicFields = in_array($this->seo_page_type, $dynamicTypes);
    }

    protected function autoFillSlug(): void
    {
        if ($this->isEditing) return;
        
        $slug = '';
        
        if ($this->selected_service_id) {
            $service = ServiceDetail::find($this->selected_service_id);
            $slug = $service ? $service->slug : '';
        } elseif ($this->selected_product_category_id) {
            $category = ProductCategory::find($this->selected_product_category_id);
            $slug = $category ? $category->slug : '';
        }
        
        if ($this->selected_city_id) {
            $city = City::find($this->selected_city_id);
            $citySlug = $city ? $city->slug : '';
            $slug = $slug ? "{$slug}-{$citySlug}" : $citySlug;
        }
        
        $this->seo_slug = $slug ?: Str::slug($this->seo_page_type);
    }

    /**
     * Generate dynamic SEO preview based on selections
     */
    protected function generateDynamicPreview(): void
    {
        $companyName = config('app.name', 'Razzaq Engineering');
        $phone = config('app.phone', '0300-1234567');
        
        $serviceName = '';
        $cityName = '';
        $categoryName = '';
        
        if ($this->selected_service_id) {
            $service = ServiceDetail::find($this->selected_service_id);
            $serviceName = $service ? $service->title : '';
        }
        
        if ($this->selected_city_id) {
            $city = City::find($this->selected_city_id);
            $cityName = $city ? $city->name : '';
        }
        
        if ($this->selected_product_category_id) {
            $category = ProductCategory::find($this->selected_product_category_id);
            $categoryName = $category ? $category->name : '';
        }
        
        switch ($this->seo_page_type) {
            case 'service_detail':
                if ($cityName) {
                    $this->dynamicPreview = [
                        'title' => "{$serviceName} in {$cityName} - {$companyName} | Professional {$serviceName} Services",
                        'description' => "Best {$serviceName} in {$cityName} by {$companyName}. ✓ Affordable ✓ Professional ✓ Quick Service. Call {$phone} for free quote!",
                        'keywords' => "{$serviceName} in {$cityName}, {$serviceName} {$cityName}, best {$serviceName}, {$serviceName} services {$cityName}",
                    ];
                } else {
                    $this->dynamicPreview = [
                        'title' => "{$serviceName} - {$companyName} | Professional Engineering Services",
                        'description' => "Professional {$serviceName} by {$companyName}. Top-quality service across Pakistan. Call {$phone}!",
                        'keywords' => "{$serviceName}, {$serviceName} Pakistan, professional {$serviceName}, {$companyName}",
                    ];
                }
                break;
                
            case 'city':
                $this->dynamicPreview = [
                    'title' => "Engineering Services in {$cityName} - {$companyName}",
                    'description' => "{$companyName} provides professional RCC cutting, concrete drilling & construction services in {$cityName}. Call {$phone}!",
                    'keywords' => "engineering services in {$cityName}, RCC cutting {$cityName}, construction services {$cityName}",
                ];
                break;
                
            case 'city_service':
                $this->dynamicPreview = [
                    'title' => "{$serviceName} in {$cityName} - {$companyName} | Best {$serviceName}",
                    'description' => "Professional {$serviceName} in {$cityName} by {$companyName}. ✓ Expert Team ✓ Affordable Rates. Call {$phone}!",
                    'keywords' => "{$serviceName} in {$cityName}, {$serviceName} {$cityName}, best {$serviceName} {$cityName}",
                ];
                break;
                
            case 'product_detail':
                $this->dynamicPreview = [
                    'title' => "{$categoryName} - {$companyName} | Buy Online",
                    'description' => "Buy {$categoryName} from {$companyName} at best price in Pakistan. Call {$phone} to order!",
                    'keywords' => "buy {$categoryName}, {$categoryName} price, {$categoryName} Pakistan",
                ];
                break;
                
            case 'city_product':
                $this->dynamicPreview = [
                    'title' => "{$categoryName} in {$cityName} - {$companyName} | Shop Online",
                    'description' => "Shop {$categoryName} in {$cityName} at {$companyName}. ✓ Best Prices ✓ Quality Products. Call {$phone}!",
                    'keywords' => "{$categoryName} in {$cityName}, buy {$categoryName} {$cityName}, {$categoryName} price {$cityName}",
                ];
                break;
                
            default:
                $this->dynamicPreview = null;
                break;
        }
        
        // Auto-fill fields if creating new
        if (!$this->isEditing && $this->dynamicPreview) {
            if (empty($this->seo_title)) $this->seo_title = $this->dynamicPreview['title'];
            if (empty($this->seo_description)) $this->seo_description = $this->dynamicPreview['description'];
            if (empty($this->seo_keywords)) $this->seo_keywords = $this->dynamicPreview['keywords'];
        }
    }

    public function applyDynamicPreview(): void
    {
        if ($this->dynamicPreview) {
            $this->seo_title = $this->dynamicPreview['title'];
            $this->seo_description = $this->dynamicPreview['description'];
            $this->seo_keywords = $this->dynamicPreview['keywords'];
            $this->dispatch('toast', type: 'success', message: 'Dynamic SEO preview applied!');
        }
    }

    // ============================================
    // IMAGE HANDLERS
    // ============================================
    
    public function updatedSeoOgImage(): void
    {
        $this->validateOnly('seo_og_image', ['seo_og_image' => 'nullable|image|max:2048']);
        try { 
            $this->ogImagePreview = $this->seo_og_image->temporaryUrl(); 
        } catch (\Exception $e) {
            Log::error('OG Image Preview: ' . $e->getMessage());
        }
    }

    public function updatedSeoTwitterImage(): void
    {
        $this->validateOnly('seo_twitter_image', ['seo_twitter_image' => 'nullable|image|max:2048']);
        try { 
            $this->twitterImagePreview = $this->seo_twitter_image->temporaryUrl(); 
        } catch (\Exception $e) {
            Log::error('Twitter Image Preview: ' . $e->getMessage());
        }
    }

    public function removeOgImage(): void 
    { 
        $this->seo_og_image = null; 
        $this->ogImagePreview = null;
        $this->existing_og_image = null;
    }
    
    public function removeTwitterImage(): void 
    { 
        $this->seo_twitter_image = null; 
        $this->twitterImagePreview = null;
        $this->existing_twitter_image = null;
    }

    // ============================================
    // SCHEMA VALIDATION
    // ============================================
    
    public function validateSchema(): void
    {
        if (!empty($this->seo_schema_markup)) {
            $decoded = json_decode($this->seo_schema_markup);
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->dispatch('toast', type: 'success', message: '✅ Valid JSON Schema!');
            } else {
                $this->dispatch('toast', type: 'error', message: '❌ Invalid JSON: ' . json_last_error_msg());
            }
        } else {
            $this->dispatch('toast', type: 'warning', message: 'Schema markup is empty.');
        }
    }

    public function generateDefaultSchema(): void
    {
        $companyName = config('app.name', 'Razzaq Engineering');
        $url = url('/');
        
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => $companyName,
            'url' => $url,
            'telephone' => config('app.phone', '0300-1234567'),
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'PK',
            ],
        ];
        
        $this->seo_schema_markup = json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $this->seo_schema_type = 'LocalBusiness';
        $this->dispatch('toast', type: 'success', message: 'Default schema generated!');
    }

    // ============================================
    // SAVE
    // ============================================
    
    public function save()
    {
        $this->validate([
            'seo_page_type' => 'required|string|max:50',
            'seo_canonical' => 'nullable|string|max:500',
            'seo_og_image' => 'nullable|image|max:2048',
            'seo_twitter_image' => 'nullable|image|max:2048',
        ]);
        
        $this->isSaving = true;
        
        try {
            $seo = $this->isEditing ? SeoData::findOrFail($this->seoId) : new SeoData();
            
            if (empty($this->seo_main_title) && !empty($this->seo_title)) {
                $this->seo_main_title = $this->seo_title;
            }

            // Basic fields
            $fields = [
                'seo_main_title', 'seo_title', 'seo_description', 'seo_keywords',
                'seo_focus_keyword', 'seo_canonical', 'seo_page_type', 'seo_page_url',
                'seo_slug', 'seo_robots', 'seo_og_title', 'seo_og_description',
                'seo_og_type', 'seo_twitter_card', 'seo_twitter_title',
                'seo_twitter_description', 'seo_schema_markup', 'seo_schema_type',
                'seo_breadcrumb_schema', 'seo_author', 'seo_publisher',
                'seo_published_date', 'seo_modified_date', 'google_site_verification',
                'bing_site_verification', 'yandex_site_verification',
                'google_analytics_id', 'google_tag_manager_id', 'facebook_pixel_id',
                'seo_sitemap_frequency', 'seo_hreflang',
            ];
            
            foreach ($fields as $field) {
                if (property_exists($this, $field)) {
                    $seo->$field = $this->$field ?: null;
                }
            }
            
            // Boolean fields
            $seo->seo_no_index = (bool) $this->seo_no_index;
            $seo->seo_no_follow = (bool) $this->seo_no_follow;
            $seo->seo_sitemap_include = (bool) $this->seo_sitemap_include;
            $seo->seo_sitemap_priority = (int) ($this->seo_sitemap_priority ?? 50);
            
            // Store extra data for dynamic pages
            $seo->seo_extra_data = [
                'service_id' => $this->selected_service_id,
                'product_category_id' => $this->selected_product_category_id,
                'city_id' => $this->selected_city_id,
                'is_city_specific' => $this->is_city_specific,
            ];
            
            // Handle OG Image upload
            if ($this->seo_og_image) {
                // Delete old image
                if ($this->existing_og_image && Storage::disk('public')->exists($this->existing_og_image)) {
                    Storage::disk('public')->delete($this->existing_og_image);
                }
                $path = $this->seo_og_image->store('seo/og', 'public');
                $seo->seo_og_image = $path;
            }
            
            // Handle Twitter Image upload
            if ($this->seo_twitter_image) {
                if ($this->existing_twitter_image && Storage::disk('public')->exists($this->existing_twitter_image)) {
                    Storage::disk('public')->delete($this->existing_twitter_image);
                }
                $path = $this->seo_twitter_image->store('seo/twitter', 'public');
                $seo->seo_twitter_image = $path;
            }
            
            // Auto-generate canonical if empty
            if (empty($seo->seo_canonical)) {
                $seo->seo_canonical = $this->generateCanonicalUrl();
            }
            
            $seo->save();
            $this->isSaving = false;
            
            $message = $this->isEditing ? 'SEO data updated successfully!' : 'SEO data created successfully!';
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            $this->dispatch($this->isEditing ? 'seo-updated' : 'seo-created');
            
            return redirect()->route('admin.seo.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('SEO save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: 'Failed to save: ' . $e->getMessage());
        }
    }

    protected function generateCanonicalUrl(): string
    {
        $baseUrl = rtrim(config('app.url'), '/');
        
        switch ($this->seo_page_type) {
            case 'home':
                return $baseUrl;
            case 'service_detail':
                $service = $this->selected_service_id ? ServiceDetail::find($this->selected_service_id) : null;
                $city = $this->selected_city_id ? City::find($this->selected_city_id) : null;
                if ($service && $city) {
                    return "{$baseUrl}/{$city->slug}/{$service->slug}";
                } elseif ($service) {
                    return "{$baseUrl}/service-detail/{$service->slug}";
                }
                return $baseUrl;
            case 'city':
                $city = $this->selected_city_id ? City::find($this->selected_city_id) : null;
                return $city ? "{$baseUrl}/{$city->slug}" : $baseUrl;
            case 'product_detail':
                $category = $this->selected_product_category_id ? ProductCategory::find($this->selected_product_category_id) : null;
                return $category ? "{$baseUrl}/product/{$category->slug}" : $baseUrl;
            default:
                return $this->seo_page_url ?: $baseUrl;
        }
    }

    // ============================================
    // RENDER
    // ============================================
    
    public function render()
    {
        return view('livewire.admin.seo.seo-form', [
            'pageTypeGroups' => $this->pageTypeGroups,
        ]);
    }
}