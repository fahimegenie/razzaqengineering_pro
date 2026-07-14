<?php

namespace App\Livewire\Admin\SEO;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\SeoData;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('SEO Data Form - Admin Panel')]
class SeoDataForm extends Component
{
    use WithFileUploads;

    public $seoId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    public $seo_og_image;
    public $seo_twitter_image;
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
    public $seo_page_type = 'website';
    
    #[Validate('nullable|string|max:500')]
    public $seo_page_url = '';
    
    #[Validate('nullable|string|max:255')]
    public $seo_slug = '';
    
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

    // Page type options
    public $pageTypes = [
        'website' => 'Website (Global)',
        'home' => 'Home Page',
        'about' => 'About Page',
        'contact' => 'Contact Page',
        'service' => 'Service Page',
        'product' => 'Product Page',
        'project' => 'Project Page',
        'blog' => 'Blog Page',
        'blog-post' => 'Blog Post',
        'gallery' => 'Gallery Page',
        'team' => 'Team Page',
        'faq' => 'FAQ Page',
        'testimonial' => 'Testimonial Page',
        'custom' => 'Custom Page',
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
        if ($seoId) {
            $seo = $seoId instanceof SeoData ? $seoId : SeoData::find($seoId);
            
            if ($seo) {
                $this->seoId = $seo->id;
                $this->isEditing = true;
                
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
                
                // Format dates
                if ($seo->seo_published_date) {
                    $this->seo_published_date = $seo->seo_published_date->format('Y-m-d');
                }
                if ($seo->seo_modified_date) {
                    $this->seo_modified_date = $seo->seo_modified_date->format('Y-m-d');
                }
                
                $this->ogImagePreview = $seo->og_image_url;
                $this->twitterImagePreview = $seo->twitter_image_url;
            }
        }
    }

    public function updatedSeoPageType()
    {
        if (!$this->isEditing) {
            $this->seo_slug = \Illuminate\Support\Str::slug($this->seo_page_type);
        }
    }

    public function updatedSeoOgImage()
    {
        $this->validateOnly('seo_og_image', ['seo_og_image' => 'image|max:2048']);
        try { $this->ogImagePreview = $this->seo_og_image->temporaryUrl(); } catch (\Exception $e) {}
    }

    public function updatedSeoTwitterImage()
    {
        $this->validateOnly('seo_twitter_image', ['seo_twitter_image' => 'image|max:2048']);
        try { $this->twitterImagePreview = $this->seo_twitter_image->temporaryUrl(); } catch (\Exception $e) {}
    }

    public function removeOgImage() { $this->seo_og_image = null; $this->ogImagePreview = null; }
    public function removeTwitterImage() { $this->seo_twitter_image = null; $this->twitterImagePreview = null; }

    public function validateSchema()
    {
        if (!empty($this->seo_schema_markup)) {
            $decoded = json_decode($this->seo_schema_markup);
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->dispatch('toast', type: 'success', message: 'Valid JSON Schema!');
            } else {
                $this->dispatch('toast', type: 'error', message: 'Invalid JSON: ' . json_last_error_msg());
            }
        }
    }

    public function save()
    {
        $this->validate([
            'seo_page_type' => 'required|string|max:50',
            'seo_canonical' => 'nullable|url|max:500',
        ]);
        
        $this->isSaving = true;
        
        try {
            $seo = $this->isEditing ? SeoData::findOrFail($this->seoId) : new SeoData();
            
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
            
            $seo->seo_no_index = (bool) $this->seo_no_index;
            $seo->seo_no_follow = (bool) $this->seo_no_follow;
            $seo->seo_sitemap_include = (bool) $this->seo_sitemap_include;
            $seo->seo_sitemap_priority = (int) ($this->seo_sitemap_priority ?? 50);
            
            // OG Image
            if ($this->seo_og_image) {
                if ($seo->seo_og_image) @unlink(public_path('uploads/seo/' . $seo->seo_og_image));
                $name = 'og_' . time() . '_' . uniqid() . '.' . $this->seo_og_image->getClientOriginalExtension();
                $path = public_path('uploads/seo');
                if (!is_dir($path)) mkdir($path, 0777, true);
                copy($this->seo_og_image->getRealPath(), $path . '/' . $name);
                @unlink($this->seo_og_image->getRealPath());
                $seo->seo_og_image = $name;
            }
            
            // Twitter Image
            if ($this->seo_twitter_image) {
                if ($seo->seo_twitter_image) @unlink(public_path('uploads/seo/' . $seo->seo_twitter_image));
                $name = 'tw_' . time() . '_' . uniqid() . '.' . $this->seo_twitter_image->getClientOriginalExtension();
                $path = public_path('uploads/seo');
                if (!is_dir($path)) mkdir($path, 0777, true);
                copy($this->seo_twitter_image->getRealPath(), $path . '/' . $name);
                @unlink($this->seo_twitter_image->getRealPath());
                $seo->seo_twitter_image = $name;
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
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.seo.seo-form');
    }
}