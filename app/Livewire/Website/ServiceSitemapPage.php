<?php

namespace App\Livewire\Website;

use Livewire\Component;
use App\Models\OurService;
use App\Models\ServiceDetail;

class ServiceSitemapPage extends Component
{
    public function render()
    {
        $baseUrl = config('app.url');
        $services = OurService::active()->ordered()->get();
        $urls = [];
        $today = now()->toDateString();

        foreach ($services as $service) {
            $urls[] = [
                'loc' => $baseUrl . '/service/' . $service->os_slug,
                'lastmod' => $service->updated_at ? $service->updated_at->toDateString() : $today,
                'priority' => '0.9',
                'changefreq' => 'weekly',
            ];

            // Service details
            $details = ServiceDetail::where('os_id', $service->id)->get();
            foreach ($details as $detail) {
                $urls[] = [
                    'loc' => $baseUrl . '/services/' . ($detail->sd_slug ?? $service->os_slug),
                    'lastmod' => $detail->updated_at ? $detail->updated_at->toDateString() : $today,
                    'priority' => '0.7',
                    'changefreq' => 'monthly',
                ];
            }
        }

        return response()->view('livewire.website.service-sitemap-page', [
            'urls' => $urls,
        ])->header('Content-Type', 'text/xml');
    }
}