<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\OurService;
use App\Models\Project;
use App\Models\Product;
use App\Models\Blog;
use App\Models\BlogPost;
use App\Models\City;
use App\Models\Career;
use App\Models\WorkGallery;
use App\Models\OurTeam;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;

#[Layout('components.layouts.sitemap-layout')]
class SitemapPage extends Component
{
    public $urls = [];
    public $lastModified;

    public function mount()
    {
        $this->lastModified = now()->toAtomString();
        $this->generateSitemap();
    }

    private function generateSitemap()
    {
        // Cache for 6 hours
        $this->urls = Cache::remember('sitemap_urls', 21600, function () {
            $urls = [];
            $baseUrl = config('app.url');
            $today = now()->toDateString();

            // ============================================
            // 1. STATIC PAGES (High Priority)
            // ============================================
            $staticPages = [
                ['url' => '/', 'priority' => '1.0', 'changefreq' => 'daily'],
                ['url' => '/about-us', 'priority' => '0.9', 'changefreq' => 'weekly'],
                ['url' => '/contact-us', 'priority' => '0.9', 'changefreq' => 'weekly'],
                ['url' => '/services', 'priority' => '0.9', 'changefreq' => 'weekly'],
                ['url' => '/projects', 'priority' => '0.9', 'changefreq' => 'weekly'],
                ['url' => '/products', 'priority' => '0.9', 'changefreq' => 'weekly'],
                ['url' => '/gallery', 'priority' => '0.8', 'changefreq' => 'weekly'],
                ['url' => '/team', 'priority' => '0.7', 'changefreq' => 'monthly'],
                ['url' => '/testimonials', 'priority' => '0.7', 'changefreq' => 'monthly'],
                ['url' => '/blog', 'priority' => '0.8', 'changefreq' => 'weekly'],
                ['url' => '/faq', 'priority' => '0.7', 'changefreq' => 'monthly'],
                ['url' => '/get-quote', 'priority' => '0.8', 'changefreq' => 'weekly'],
                ['url' => '/our-fleet', 'priority' => '0.7', 'changefreq' => 'monthly'],
                ['url' => '/careers', 'priority' => '0.7', 'changefreq' => 'weekly'],
                ['url' => '/privacy-policy', 'priority' => '0.4', 'changefreq' => 'yearly'],
                ['url' => '/terms-conditions', 'priority' => '0.4', 'changefreq' => 'yearly'],
                ['url' => '/refund-policy', 'priority' => '0.4', 'changefreq' => 'yearly'],
            ];

            foreach ($staticPages as $page) {
                $urls[] = [
                    'loc' => $baseUrl . $page['url'],
                    'lastmod' => $today,
                    'priority' => $page['priority'],
                    'changefreq' => $page['changefreq'],
                ];
            }

            // ============================================
            // 2. SERVICES
            // ============================================
            $services = OurService::active()->ordered()->get();
            foreach ($services as $service) {
                $urls[] = [
                    'loc' => $baseUrl . '/service/' . $service->os_slug,
                    'lastmod' => $service->updated_at ? $service->updated_at->toDateString() : $today,
                    'priority' => '0.9',
                    'changefreq' => 'weekly',
                ];
            }

            // ============================================
            // 3. PROJECTS
            // ============================================
            $projects = Project::active()->ordered()->get();
            foreach ($projects as $project) {
                $urls[] = [
                    'loc' => $baseUrl . '/project/' . ($project->p_slug ?? $project->id),
                    'lastmod' => $project->updated_at ? $project->updated_at->toDateString() : $today,
                    'priority' => '0.8',
                    'changefreq' => 'monthly',
                ];
            }

            // ============================================
            // 4. PRODUCTS
            // ============================================
            $products = Product::active()->get();
            foreach ($products as $product) {
                $urls[] = [
                    'loc' => $baseUrl . '/product/' . ($product->p_slug ?? $product->id),
                    'lastmod' => $product->updated_at ? $product->updated_at->toDateString() : $today,
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                ];
            }

            // ============================================
            // 5. BLOG POSTS
            // ============================================
            $blogs = BlogPost::active()->latest()->get();
            foreach ($blogs as $blog) {
                $urls[] = [
                    'loc' => $baseUrl . '/blog/' . $blog->slug,
                    'lastmod' => $blog->updated_at ? $blog->updated_at->toDateString() : $today,
                    'priority' => '0.7',
                    'changefreq' => 'monthly',
                ];
            }

            // ============================================
            // 6. CAREERS / JOBS
            // ============================================
            $careers = Career::active()->get();
            foreach ($careers as $career) {
                $urls[] = [
                    'loc' => $baseUrl . '/careers/' . $career->slug,
                    'lastmod' => $career->updated_at ? $career->updated_at->toDateString() : $today,
                    'priority' => '0.6',
                    'changefreq' => 'weekly',
                ];
            }

            // ============================================
            // 7. CITIES (SEO Pages)
            // ============================================
            $cities = City::active()->orderBy('sort_order')->get();
            foreach ($cities as $city) {
                // City main page
                $urls[] = [
                    'loc' => $baseUrl . '/' . $city->slug,
                    'lastmod' => $today,
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                ];

                // City + Service pages
                foreach ($services->take(10) as $service) {
                    $urls[] = [
                        'loc' => $baseUrl . '/' . $city->slug . '/' . $service->os_slug,
                        'lastmod' => $today,
                        'priority' => '0.7',
                        'changefreq' => 'monthly',
                    ];
                }
            }

            // ============================================
            // 8. GALLERY ITEMS
            // ============================================
            $galleries = WorkGallery::active()->ordered()->get();
            foreach ($galleries as $gallery) {
                $urls[] = [
                    'loc' => $baseUrl . '/gallery#' . $gallery->id,
                    'lastmod' => $gallery->updated_at ? $gallery->updated_at->toDateString() : $today,
                    'priority' => '0.5',
                    'changefreq' => 'monthly',
                ];
            }

            return $urls;
        });
    }

    public function render()
    {
        return response()->view('livewire.website.sitemap-page', [
            'urls' => $this->urls,
            'lastModified' => $this->lastModified,
        ])->header('Content-Type', 'text/xml');
    }
}