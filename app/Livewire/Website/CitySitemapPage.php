<?php

namespace App\Livewire\Website;

use Livewire\Component;
use App\Models\City;
use App\Models\OurService;

class CitySitemapPage extends Component
{
    public function render()
    {
        $baseUrl = config('app.url');
        $cities = City::active()->orderBy('sort_order')->get();
        $services = OurService::active()->ordered()->take(15)->get();
        $urls = [];
        $today = now()->toDateString();

        foreach ($cities as $city) {
            $urls[] = [
                'loc' => $baseUrl . '/' . $city->slug,
                'lastmod' => $today,
                'priority' => '0.8',
                'changefreq' => 'weekly',
            ];

            foreach ($services as $service) {
                $urls[] = [
                    'loc' => $baseUrl . '/' . $city->slug . '/' . $service->os_slug,
                    'lastmod' => $today,
                    'priority' => '0.7',
                    'changefreq' => 'monthly',
                ];
            }
        }

        return response()->view('livewire.website.city-sitemap-page', [
            'urls' => $urls,
        ])->header('Content-Type', 'text/xml');
    }
}