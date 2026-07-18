<?php

namespace App\Services\SEO;

use App\Models\SeoData;
use App\Models\City;
use Illuminate\Support\Str;

class DynamicSEOService
{
    protected $companyName;
    protected $phone;
    
    public function __construct()
    {
        $this->companyName = config('app.name', 'Razzaq Engineering');
        $this->phone = config('app.phone', '0300-1234567');
    }
    
    /**
     * Get SEO for any page
     */
    public function getSEO(string $pageType, ?string $slug = null, ?string $citySlug = null): SeoData
    {
        return SeoData::getSeo($pageType, $slug, $citySlug);
    }
    
    /**
     * Generate LocalBusiness schema for city-specific pages
     */
    public function generateLocalBusinessSchema(string $serviceName, string $cityName, string $phone, ?float $lat = null, ?float $lng = null): string
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => "{$this->companyName} - {$serviceName} in {$cityName}",
            'description' => "Professional {$serviceName} services in {$cityName} by {$this->companyName}.",
            'url' => url()->current(),
            'telephone' => $phone,
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => $cityName,
                'addressCountry' => 'PK',
            ],
            'areaServed' => [
                '@type' => 'City',
                'name' => $cityName,
            ],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                'opens' => '09:00',
                'closes' => '18:00',
            ],
        ];
        
        if ($lat && $lng) {
            $schema['geo'] = [
                '@type' => 'GeoCoordinates',
                'latitude' => $lat,
                'longitude' => $lng,
            ];
        }
        
        return json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
    
    /**
     * Generate BreadcrumbList schema
     */
    public function generateBreadcrumbSchema(array $items): string
    {
        $breadcrumb = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [],
        ];
        
        foreach ($items as $index => $item) {
            $breadcrumb['itemListElement'][] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => $item['url'] ?? url()->current(),
            ];
        }
        
        return json_encode($breadcrumb, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
    
    /**
     * Generate FAQ schema
     */
    public function generateFAQSchema(array $faqs): string
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => [],
        ];
        
        foreach ($faqs as $faq) {
            $schema['mainEntity'][] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ];
        }
        
        return json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}