<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\City;
use App\Models\Service;
use App\Models\CityService;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\SeoData;
use App\Models\ProductCategory;
use App\Models\Setting;
use App\Traits\HasDynamicSEO;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

#[Layout('components.layouts.app-layout', ['seo' => []])]
#[Title('Service Details - Razzaq Engineering')]
class CityServicePage extends Component
{
    use HasDynamicSEO;
    
    public $city;
    public $service;
    public $cityService;
    public $projects = [];
    public $testimonials = [];
    public $faqs = [];
    public $relatedServices = [];
    public $otherCities = [];
    public $seo;
    public $pc = [];
    public $settings;
    public $isLoading = true;
    public $errorMessage = '';

    public function mount($city, $service)
    {
        try {
            $this->isLoading = true;
            
            // Load settings first - always needed
            $this->settings = Setting::getCached();
            
            // Initialize SEO
            $this->initializeSEO('city_service');
            
            // Find city by slug
            $this->city = City::where('slug', $city)
                ->where('is_active', 1)
                ->first();
            
            // Find service by slug or name
            $this->service = Service::where('is_active', 1)
                ->where(function ($query) use ($service) {
                    $query->where('os_slug', $service)
                          ->orWhere('os_name', 'like', '%' . str_replace('-', ' ', $service) . '%')
                          ->orWhereRaw("REPLACE(LOWER(os_name), ' ', '-') = ?", [$service]);
                })
                ->first();
            
            // If city or service not found, set error but don't abort
            if (!$this->city) {
                $this->errorMessage = 'City not found. Please check the URL or browse our services.';
                $this->isLoading = false;
                return;
            }
            
            if (!$this->service) {
                $this->errorMessage = 'Service not found in ' . $this->city->name . '. Please browse our available services.';
                $this->isLoading = false;
                return;
            }
            
            // Find city-service relationship and SEO data
            $this->cityService = CityService::where('city_id', $this->city->id)
                ->where('service_id', $this->service->id)
                ->where('is_active', 1)
                ->first();
            
            // Get SEO data for city-service page
            $this->seo = SeoData::where('page_name', 'city_service')
                ->where('is_active', 1)
                ->first();
            
            // Get related projects
            $this->projects = Project::active()
                ->where(function ($q) {
                    $q->where('p_location', 'like', '%' . $this->city->name . '%')
                      ->orWhere('p_title', 'like', '%' . $this->service->os_name . '%');
                })
                ->latest()
                ->limit(4)
                ->get();
            
            // Get testimonials
            $this->testimonials = Testimonial::active()
                ->where(function ($q) {
                    $q->where('t_location', 'like', '%' . $this->city->name . '%')
                      ->orWhere('service_id', $this->service->id);
                })
                ->ordered()
                ->limit(4)
                ->get();
            
            // Get FAQs
            if ($this->cityService && $this->cityService->faq) {
                $faqData = $this->cityService->faq;
                $this->faqs = is_array($faqData) ? $faqData : (json_decode($faqData, true) ?? []);
            }
            
            // Get other services in this city
            $this->relatedServices = Service::active()
                ->where('id', '!=', $this->service->id)
                ->whereHas('cityServices', function ($q) {
                    $q->where('city_id', $this->city->id)->where('is_active', 1);
                })
                ->ordered()
                ->limit(6)
                ->get();
            
            // Get other cities for this service
            $this->otherCities = City::active()
                ->where('id', '!=', $this->city->id)
                ->whereHas('services', function ($q) {
                    $q->where('service_id', $this->service->id);
                })
                ->limit(6)
                ->get();
            
            $this->pc = ProductCategory::active()->select('pc_name')->get();
            
            $this->isLoading = false;
            
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load page. Please try again.';
            $this->isLoading = false;
            Log::error('CityService page error: ' . $e->getMessage(), [
                'city' => $city ?? 'unknown',
                'service' => $service ?? 'unknown'
            ]);
        }
    }

    /**
     * Get SEO data with proper city and service names
     */
    public function getSeoData()
    {
        // ✅ CASE 1: City and Service BOTH found
        if ($this->city && $this->service) {
            $cityName = $this->city->name;
            $serviceName = $this->service->os_name;
            $citySlug = $this->city->slug;
            $serviceSlug = $this->service->os_slug;
            $serviceNameLower = strtolower($serviceName);
            $cityNameLower = strtolower($cityName);
            
            // ✅ CASE 1A: CityService record with its own SEO data
            if ($this->cityService) {
                $seoTitle = $this->cityService->meta_title 
                    ?: $serviceName . ' Services in ' . $cityName . ' | Razzaq Engineering';
                
                $seoDescription = $this->cityService->meta_description 
                    ?: 'Professional ' . $serviceNameLower . ' services in ' . $cityName . '. Expert team with latest equipment, 24/7 availability. Contact Razzaq Engineering for free quote and consultation.';
                
                $seoKeywords = $this->cityService->meta_keywords 
                    ?: $serviceNameLower . ' in ' . $cityName . ', ' 
                       . $serviceNameLower . ' services ' . $cityName . ', ' 
                       . $cityName . ' ' . $serviceNameLower . ', '
                       . 'Razzaq Engineering ' . $cityName . ', '
                       . $serviceNameLower . ' near me ' . $cityName;
                
                $ogTitle = $serviceName . ' Services in ' . $cityName . ' | Razzaq Engineering';
                $ogDescription = 'Expert ' . $serviceNameLower . ' services in ' . $cityName . '. Available 24/7 with free consultation. 500+ projects completed.';
                $ogImage = $this->cityService->og_image_url ?? $this->seo->og_image_url ?? asset('images/og-default.jpg');
                $canonicalUrl = url($citySlug . '/' . $serviceSlug);
                
                return $this->buildSeoArray($seoTitle, $seoDescription, $seoKeywords, $ogTitle, $ogDescription, $ogImage, $canonicalUrl);
            }
            
            // ✅ CASE 1B: Use general SeoData with replacements
            if ($this->seo) {
                $replacements = [
                    '{city}' => $cityName,
                    '{service}' => $serviceName,
                    '{city_lower}' => $cityNameLower,
                    '{service_lower}' => $serviceNameLower,
                ];
                
                $seoTitle = str_replace(
                    array_keys($replacements), 
                    array_values($replacements), 
                    $this->seo->meta_title ?? '{service} Services in {city} | Razzaq Engineering'
                );
                
                $seoDescription = str_replace(
                    array_keys($replacements), 
                    array_values($replacements), 
                    $this->seo->meta_description ?? 'Professional {service_lower} services in {city}. Expert team with latest equipment. Contact for free quote.'
                );
                
                $seoKeywords = str_replace(
                    array_keys($replacements), 
                    array_values($replacements), 
                    $this->seo->meta_keywords ?? '{service_lower} in {city}, {service_lower} services {city}, {city} {service_lower}, Razzaq Engineering'
                );
                
                $ogTitle = str_replace(
                    array_keys($replacements), 
                    array_values($replacements), 
                    $this->seo->og_title ?? '{service} Services in {city} | Razzaq Engineering'
                );
                
                $ogDescription = str_replace(
                    array_keys($replacements), 
                    array_values($replacements), 
                    $this->seo->og_description ?? 'Expert {service_lower} services in {city}. Available 24/7.'
                );
                
                $ogImage = $this->seo->og_image_url ?? asset('images/og-default.jpg');
                $canonicalUrl = url($citySlug . '/' . $serviceSlug);
                
                return $this->buildSeoArray($seoTitle, $seoDescription, $seoKeywords, $ogTitle, $ogDescription, $ogImage, $canonicalUrl);
            }
            
            // ✅ CASE 1C: No SEO data at all - Generate default with city/service names
            return $this->buildDefaultSeo($cityName, $serviceName, $citySlug, $serviceSlug);
        }
        
        // ✅ CASE 2: City found but Service NOT found
        if ($this->city && !$this->service) {
            $cityName = $this->city->name;
            return [
                'title' => 'Engineering Services in ' . $cityName . ' | Razzaq Engineering',
                'description' => 'Professional engineering services in ' . $cityName . '. RCC core cutting, diamond drilling, wall sawing, plumbing & fire fighting. Contact for free quote.',
                'keywords' => 'engineering services ' . $cityName . ', ' . strtolower($cityName) . ' engineering, core cutting ' . $cityName . ', Razzaq Engineering ' . $cityName,
                'og_title' => 'Engineering Services in ' . $cityName . ' | Razzaq Engineering',
                'og_description' => 'Expert engineering services in ' . $cityName . '. Available 24/7 with free consultation.',
                'og_image' => asset('images/og-default.jpg'),
                'canonical_url' => url($this->city->slug),
            ];
        }
        
        // ✅ CASE 3: Service found but City NOT found
        if ($this->service && !$this->city) {
            $serviceName = $this->service->os_name;
            return [
                'title' => $serviceName . ' Services | Razzaq Engineering Pakistan',
                'description' => 'Professional ' . strtolower($serviceName) . ' services across Pakistan. Expert team, latest equipment, 24/7 availability.',
                'keywords' => strtolower($serviceName) . ' services, ' . strtolower($serviceName) . ' Pakistan, Razzaq Engineering ' . strtolower($serviceName),
                'og_title' => $serviceName . ' Services | Razzaq Engineering',
                'og_description' => 'Expert ' . strtolower($serviceName) . ' services. Available 24/7 across Pakistan.',
                'og_image' => asset('images/og-default.jpg'),
                'canonical_url' => url()->current(),
            ];
        }
        
        // ✅ CASE 4: Complete fallback - Nothing found
        return [
            'title' => 'Engineering Services Pakistan | Razzaq Engineering',
            'description' => 'Professional engineering services across Pakistan. RCC core cutting, diamond drilling, wall sawing, plumbing & fire fighting services. 24+ years experience.',
            'keywords' => 'engineering services Pakistan, core cutting, diamond drilling, wall sawing, plumbing services, Razzaq Engineering',
            'og_title' => 'Engineering Services | Razzaq Engineering',
            'og_description' => 'Expert engineering services. Contact us for RCC core cutting, diamond drilling, and more. Available 24/7.',
            'og_image' => asset('images/og-default.jpg'),
            'canonical_url' => url()->current(),
        ];
    }

    /**
     * Build SEO array with all required fields
     */
    private function buildSeoArray($title, $description, $keywords, $ogTitle, $ogDescription, $ogImage, $canonicalUrl)
    {
        return [
            'title' => $title,
            'description' => Str::limit($description, 160), // Meta description max 160 chars
            'keywords' => $keywords,
            'og_title' => $ogTitle,
            'og_description' => Str::limit($ogDescription, 200),
            'og_image' => $ogImage,
            'og_type' => 'website',
            'og_url' => $canonicalUrl,
            'canonical_url' => $canonicalUrl,
            'twitter_card' => 'summary_large_image',
            'twitter_title' => $ogTitle,
            'twitter_description' => Str::limit($ogDescription, 200),
            'twitter_image' => $ogImage,
            'robots' => 'index, follow',
        ];
    }

    /**
     * Build default SEO when no SEO data exists
     */
    private function buildDefaultSeo($cityName, $serviceName, $citySlug, $serviceSlug)
    {
        $serviceNameLower = strtolower($serviceName);
        $cityNameLower = strtolower($cityName);
        
        $title = $serviceName . ' Services in ' . $cityName . ' | Razzaq Engineering';
        $description = 'Professional ' . $serviceNameLower . ' services in ' . $cityName . '. ✓ 24+ Years Experience ✓ Latest Equipment ✓ 24/7 Emergency Service ✓ Free Consultation. Contact Razzaq Engineering today!';
        $keywords = $serviceNameLower . ' in ' . $cityName . ', ' 
                   . $serviceNameLower . ' services ' . $cityName . ', '
                   . $cityName . ' ' . $serviceNameLower . ', '
                   . $serviceNameLower . ' near me ' . $cityName . ', '
                   . 'Razzaq Engineering ' . $cityName;
        
        return $this->buildSeoArray(
            $title, 
            $description, 
            $keywords,
            $title,
            'Expert ' . $serviceNameLower . ' services in ' . $cityName . '. Available 24/7 with free consultation. Trusted by 500+ clients.',
            asset('images/og-default.jpg'),
            url($citySlug . '/' . $serviceSlug)
        );
    }

    public function render()
    {
        $seo = $this->getSeoData();
        return view('livewire.website.city-service-page')->layoutData(['seo' => $seo]);
    }
}