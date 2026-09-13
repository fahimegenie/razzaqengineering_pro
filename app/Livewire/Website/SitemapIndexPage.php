<?php

namespace App\Livewire\Website;

use Livewire\Component;

class SitemapIndexPage extends Component
{
    public function render()
    {
        $baseUrl = config('app.url');
        $today = now()->toDateString();

        $sitemaps = [
            ['loc' => $baseUrl . '/sitemap-main.xml', 'lastmod' => $today],
            ['loc' => $baseUrl . '/sitemap-cities.xml', 'lastmod' => $today],
            ['loc' => $baseUrl . '/sitemap-services.xml', 'lastmod' => $today],
            ['loc' => $baseUrl . '/sitemap-projects.xml', 'lastmod' => $today],
            ['loc' => $baseUrl . '/sitemap-products.xml', 'lastmod' => $today],
            ['loc' => $baseUrl . '/sitemap-blogs.xml', 'lastmod' => $today],
        ];

        return response()->view('livewire.website.sitemap-index-page', [
            'sitemaps' => $sitemaps,
        ])->header('Content-Type', 'text/xml');
    }
}