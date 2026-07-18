<?php

namespace App\Traits;

use App\Models\SeoData;
use App\Models\City;
use App\Services\SEO\DynamicSEOService;

trait HasDynamicSEO
{
    protected SeoData $seoData;
    protected DynamicSEOService $seoService;
    protected ?City $currentCity = null;
    protected ?string $currentCityName = null;
    
    /**
     * Initialize SEO with auto city detection and variable replacement
     */
    protected function initializeSEO(string $pageType, ?string $slug = null, ?string $citySlug = null): void
    {
        $this->seoService = app(DynamicSEOService::class);
        
        // Auto-detect city from URL
        $this->detectCity();
        
        // Get SEO from database
        $this->seoData = $this->seoService->getSEO($pageType, $slug, $citySlug);
        
        // Auto-replace all variables
        $this->replaceSeoVariables();
    }
    
    /**
     * Auto-detect city from URL
     */
    protected function detectCity(): void
    {
        $segments = request()->segments();
        $firstSegment = $segments[0] ?? null;
        
        if ($firstSegment && !in_array($firstSegment, [
            'about-us', 'faq', 'contact-us', 'services', 'service-detail',
            'products', 'product', 'projects', 'project', 'gallery', 'team',
            'blog', 'get-quote', 'quote-thank-you', 'login', 'register',
            'admin', 'storage', 'api', 'livewire', 'sitemap.xml'
        ])) {
            $city = City::where('slug', $firstSegment)->where('is_active', true)->first();
            if ($city) {
                $this->currentCity = $city;
                $this->currentCityName = $city->name;
            }
        }
    }
    
    /**
     * Replace all {VARIABLES} with actual values
     */
    protected function replaceSeoVariables(): void
    {
        $replacements = [
            '{COMPANY}' => config('app.name', 'Razzaq Engineering'),
            '{PHONE}' => $this->currentCity->phone ?? config('app.phone', '0300-1234567'),
            '{YEAR}' => date('Y'),
            '{CITY}' => $this->currentCityName ?? 'Pakistan',
            '{LOCATION}' => $this->currentCityName ?? 'Pakistan',
            '{SERVICE}' => $this->getServiceName() ?? '',
            '{AREAS}' => $this->currentCity->areas_covered ?? 'all major areas',
            '{LAT}' => $this->currentCity->lat ?? '',
            '{LNG}' => $this->currentCity->lng ?? '',
        ];
        
        // Replace in all SEO fields
        $fields = [
            'seo_title', 'seo_description', 'seo_keywords', 'seo_main_title',
            'seo_focus_keyword', 'seo_og_title', 'seo_og_description',
            'seo_twitter_title', 'seo_twitter_description',
            'seo_schema_markup', 'seo_breadcrumb_schema', 'seo_canonical',
            'seo_page_url', 'seo_slug',
        ];
        
        foreach ($fields as $field) {

            if (!isset($this->seoData->$field)) {
                continue;
            }

            if (is_string($this->seoData->$field)) {
                $this->seoData->$field = str_replace(
                    array_keys($replacements),
                    array_values($replacements),
                    $this->seoData->$field
                );
            } elseif (is_array($this->seoData->$field)) {
                $this->seoData->$field = $this->replaceVariables(
                    $this->seoData->$field,
                    $replacements
                );
            }
        }


    }

    protected function replaceVariables($data, array $replacements)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->replaceVariables($value, $replacements);
            }

            return $data;
        }

        if (is_string($data)) {
            return str_replace(
                array_keys($replacements),
                array_values($replacements),
                $data
            );
        }

        return $data;
    }
    
    /**
     * Override this in component if service is available
     */
    protected function getServiceName(): ?string
    {
        return null;
    }
    
    /**
     * Get SEO data for blade layout
     */
    public function getSeoData(): array
    {
        return $this->seoData->toSEOArray();
    }
    
    /**
     * Get current city
     */
    public function getCurrentCity(): ?City
    {
        return $this->currentCity;
    }
    
    /**
     * Get current city name
     */
    public function getCurrentCityName(): ?string
    {
        return $this->currentCityName;
    }
    
    /**
     * Get location-specific phone number
     */
    public function getLocationPhone(): string
    {
        return $this->currentCity->phone ?? config('app.phone', '0300-1234567');
    }
}