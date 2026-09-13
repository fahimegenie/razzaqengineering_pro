<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\City;
use App\Models\OurService;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\SeoData;
use App\Models\ProductCategory;
use App\Models\ServiceDetail;
use App\Models\Setting;
use App\Traits\HasDynamicSEO;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

#[Layout('components.layouts.app-layout', ['seo' => []])]
#[Title('Engineering Services - Razzaq Engineering')]
class CityPage extends Component
{
    use HasDynamicSEO;

    public $citySlug;
    public $city;
    public $services = [];
    public $projects = [];
    public $testimonials = [];
    public $serviceDetails = [];
    public $seo;
    public $pc = [];
    public $settings;
    public $isLoading = true;
    public $errorMessage = '';
    public $activeServiceTab = null;

    public function mount($city)
    {
        try {
            $this->isLoading = true;
            $this->citySlug = $city;
            
            // ✅ Load settings first - always needed
            $this->settings = Setting::getCached();
            
            // ✅ Initialize SEO with fallback
            $this->initializeSEO('city');

            // ✅ Find city by slug
            $this->city = City::where('slug', $city)
                ->where('is_active', 1)
                ->first();

            if (!$this->city) {
                // ✅ Set default SEO for city not found
                $this->seo = SeoData::where('page_name', 'city')
                    ->where('is_active', 1)
                    ->first();
                
                $this->errorMessage = 'City not found. Please check the URL or browse our services.';
                $this->isLoading = false;
                return;
            }

            // ✅ Get SEO data for this specific city
            $this->seo = SeoData::where('page_name', 'city')
                ->where('is_active', 1)
                ->first();

            // ✅ Get services available in this city
            $this->services = OurService::active()
                ->whereHas('cityServices', function ($q) {
                    $q->where('city_id', $this->city->id)->where('is_active', 1);
                })
                ->ordered()
                ->get();

            // ✅ Set first service as active tab
            if ($this->services->isNotEmpty()) {
                $this->activeServiceTab = $this->services->first()->id;
                $this->loadServiceDetails();
            }

            // ✅ Get projects in this city
            $this->projects = Project::active()
                ->where('p_location', 'like', '%' . $this->city->name . '%')
                ->ordered()
                ->limit(6)
                ->get();

            // ✅ Get testimonials
            $this->testimonials = Testimonial::active()
                ->where(function ($q) {
                    $q->where('t_location', 'like', '%' . $this->city->name . '%')
                      ->orWhere('t_location', 'like', '%' . strtolower($this->city->name) . '%');
                })
                ->highRated()
                ->latest()
                ->limit(6)
                ->get();

            // ✅ Get product categories
            $this->pc = ProductCategory::active()->select('pc_name')->get();
            
            $this->isLoading = false;

        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load page. Please try again.';
            $this->isLoading = false;
            Log::error('CityPage error: ' . $e->getMessage(), [
                'city' => $city ?? 'unknown',
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * Switch active service tab and load its details
     */
    public function switchServiceTab($serviceId)
    {
        $this->activeServiceTab = $serviceId;
        $this->loadServiceDetails();
    }

    /**
     * Load service details for the active tab
     */
    private function loadServiceDetails()
    {
        if ($this->activeServiceTab) {
            $this->serviceDetails = ServiceDetail::where('os_id', $this->activeServiceTab)
                ->ordered()
                ->get();
        } else {
            $this->serviceDetails = collect();
        }
    }

    /**
     * Get comprehensive SEO data with proper fallbacks
     */
    public function getSeoData()
    {
        // ✅ CASE 1: City found and SEO data exists
        if ($this->city && $this->seo) {
            $cityName = $this->city->name;
            $cityNameLower = strtolower($cityName);
            $citySlug = $this->city->slug;
            $servicesCount = count($this->services);
            $projectsCount = count($this->projects);
            
            $replacements = [
                '{city}' => $cityName,
                '{city_lower}' => $cityNameLower,
                '{services_count}' => $servicesCount,
                '{projects_count}' => $projectsCount,
            ];
            
            return [
                'title' => str_replace(
                    array_keys($replacements), 
                    array_values($replacements), 
                    $this->seo->meta_title ?? 'Professional Engineering Services in {city} | Razzaq Engineering'
                ),
                'description' => Str::limit(str_replace(
                    array_keys($replacements), 
                    array_values($replacements), 
                    $this->seo->meta_description ?? 'Professional engineering services in {city}. ✓ RCC Core Cutting ✓ Diamond Drilling ✓ Wall Sawing ✓ Plumbing & Fire Fighting. 24/7 emergency services by Razzaq Engineering. {services_count}+ services available.'
                ), 160),
                'keywords' => str_replace(
                    array_keys($replacements), 
                    array_values($replacements), 
                    $this->seo->meta_keywords ?? 'engineering services {city_lower}, core cutting {city_lower}, diamond drilling {city_lower}, wall sawing {city_lower}, plumbing services {city_lower}, Razzaq Engineering {city_lower}'
                ),
                'og_title' => str_replace(
                    array_keys($replacements), 
                    array_values($replacements), 
                    $this->seo->og_title ?? 'Professional Engineering Services in {city} | Razzaq Engineering'
                ),
                'og_description' => str_replace(
                    array_keys($replacements), 
                    array_values($replacements), 
                    $this->seo->og_description ?? 'Expert engineering services in {city}. 24+ years experience, {services_count}+ services, {projects_count}+ projects. Contact for free quote.'
                ),
                'og_image' => $this->seo->og_image_url ?? $this->city->og_image_url ?? asset('images/og-default.jpg'),
                'og_type' => 'website',
                'og_url' => url($citySlug),
                'canonical_url' => url($citySlug),
                'twitter_card' => 'summary_large_image',
                'twitter_title' => str_replace(
                    array_keys($replacements), 
                    array_values($replacements), 
                    $this->seo->og_title ?? 'Engineering Services in {city} - Razzaq Engineering'
                ),
                'twitter_description' => Str::limit(str_replace(
                    array_keys($replacements), 
                    array_values($replacements), 
                    $this->seo->og_description ?? 'Expert engineering services in {city}. Available 24/7.'
                ), 200),
                'twitter_image' => $this->seo->og_image_url ?? asset('images/og-default.jpg'),
                'robots' => 'index, follow',
            ];
        }
        
        // ✅ CASE 2: City found but NO SEO data exists
        if ($this->city && !$this->seo) {
            $cityName = $this->city->name;
            $cityNameLower = strtolower($cityName);
            $servicesCount = count($this->services);
            
            return [
                'title' => 'Engineering Services in ' . $cityName . ' | Razzaq Engineering',
                'description' => 'Professional engineering services in ' . $cityName . '. ✓ RCC Core Cutting ✓ Diamond Drilling ✓ Wall Sawing ✓ Plumbing Services. 24+ years experience, ' . $servicesCount . '+ services available. Contact Razzaq Engineering for free quote.',
                'keywords' => 'engineering services ' . $cityNameLower . ', core cutting ' . $cityNameLower . ', diamond drilling ' . $cityNameLower . ', ' . $cityNameLower . ' engineering, Razzaq Engineering ' . $cityNameLower,
                'og_title' => 'Engineering Services in ' . $cityName . ' | Razzaq Engineering',
                'og_description' => 'Expert engineering services in ' . $cityName . '. 24+ years experience. Available 24/7 with free consultation.',
                'og_image' => $this->city->og_image_url ?? asset('images/og-default.jpg'),
                'og_type' => 'website',
                'og_url' => url($this->city->slug),
                'canonical_url' => url($this->city->slug),
                'twitter_card' => 'summary_large_image',
                'twitter_title' => 'Engineering Services in ' . $cityName . ' | Razzaq Engineering',
                'twitter_description' => 'Expert engineering services in ' . $cityName . '. Available 24/7.',
                'twitter_image' => asset('images/og-default.jpg'),
                'robots' => 'index, follow',
            ];
        }
        
        // ✅ CASE 3: Complete fallback - Nothing found
        return [
            'title' => 'Engineering Services Pakistan | Razzaq Engineering',
            'description' => 'Professional engineering services across Pakistan. RCC core cutting, diamond drilling, wall sawing, plumbing & fire fighting services. 24+ years experience. 24/7 emergency services.',
            'keywords' => 'engineering services Pakistan, core cutting, diamond drilling, wall sawing, plumbing services, Razzaq Engineering',
            'og_title' => 'Engineering Services Pakistan | Razzaq Engineering',
            'og_description' => 'Expert engineering services across Pakistan. 24+ years experience. Contact for free quote.',
            'og_image' => asset('images/og-default.jpg'),
            'og_type' => 'website',
            'og_url' => url()->current(),
            'canonical_url' => url()->current(),
            'twitter_card' => 'summary_large_image',
            'twitter_title' => 'Engineering Services Pakistan | Razzaq Engineering',
            'twitter_description' => 'Expert engineering services. Contact us for RCC core cutting, diamond drilling, and more.',
            'twitter_image' => asset('images/og-default.jpg'),
            'robots' => 'index, follow',
        ];
    }

    /**
     * Get structured data for SEO
     */
    public function getStructuredData()
    {
        if (!$this->city) {
            return null;
        }
        
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'Razzaq Engineering - ' . $this->city->name,
            'description' => 'Professional engineering services in ' . $this->city->name . '. RCC core cutting, diamond drilling, wall sawing, plumbing & fire fighting.',
            'url' => url($this->city->slug),
            'telephone' => $this->settings->mobile_phone_1 ?? '+923048902805',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => $this->city->name,
                'addressCountry' => 'PK',
            ],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                'opens' => '00:00',
                'closes' => '23:59',
            ],
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => '4.9',
                'reviewCount' => count($this->testimonials) ?: '150',
            ],
        ];
        
        if (!empty($this->services) && $this->services->isNotEmpty()) {
            $structuredData['makesOffer'] = $this->services->map(function ($service) {
                return [
                    '@type' => 'Offer',
                    'name' => $service->os_name,
                    'url' => url($this->city->slug . '/' . $service->os_slug),
                ];
            })->toArray();
        }
        
        return $structuredData;
    }

    public function render()
    {
        $seo = $this->getSeoData();
        $structuredData = $this->getStructuredData();
        
        $pageTitle = $this->city 
            ? 'Engineering Services in ' . $this->city->name . ' | Razzaq Engineering'
            : 'Engineering Services | Razzaq Engineering';

        return view('livewire.website.city-page', [
            'pageTitle' => $pageTitle,
            'structuredData' => $structuredData,
        ])->layoutData(['seo' => $seo]);
    }
}