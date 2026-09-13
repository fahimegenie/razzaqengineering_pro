<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurService;
use App\Models\Project;
use App\Models\Product;
use App\Models\BlogPost;
use App\Models\City;
use App\Models\Career;
use App\Models\WorkGallery;
use App\Models\ServiceDetail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    /**
     * Main Sitemap - All URLs
     * GET /sitemap.xml
     */
    public function index()
    {
        $urls = Cache::remember('sitemap_urls', 21600, function () {
            $urls = [];
            $baseUrl = config('app.url');
            $today = now()->toDateString();

            // 1. STATIC PAGES
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

            // 2. SERVICES
            $services = OurService::active()->ordered()->get();
            foreach ($services as $service) {
                $urls[] = [
                    'loc' => $baseUrl . '/service/' . $service->os_slug,
                    'lastmod' => $service->updated_at ? $service->updated_at->toDateString() : $today,
                    'priority' => '0.9',
                    'changefreq' => 'weekly',
                ];
            }

            // 3. PROJECTS
            $projects = Project::active()->ordered()->get();
            foreach ($projects as $project) {
                $urls[] = [
                    'loc' => $baseUrl . '/project/' . ($project->p_slug ?? $project->id),
                    'lastmod' => $project->updated_at ? $project->updated_at->toDateString() : $today,
                    'priority' => '0.8',
                    'changefreq' => 'monthly',
                ];
            }

            // 4. PRODUCTS
            $products = Product::active()->get();
            foreach ($products as $product) {
                $urls[] = [
                    'loc' => $baseUrl . '/product/' . ($product->p_slug ?? $product->id),
                    'lastmod' => $product->updated_at ? $product->updated_at->toDateString() : $today,
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                ];
            }

            // 5. BLOG POSTS
            $blogs = BlogPost::active()->latest()->get();
            foreach ($blogs as $blog) {
                $urls[] = [
                    'loc' => $baseUrl . '/blog/' . $blog->bp_slug,
                    'lastmod' => $blog->updated_at ? $blog->updated_at->toDateString() : $today,
                    'priority' => '0.7',
                    'changefreq' => 'monthly',
                ];
            }

            // 6. CAREERS
            $careers = Career::active()->get();
            foreach ($careers as $career) {
                $urls[] = [
                    'loc' => $baseUrl . '/careers/' . $career->slug,
                    'lastmod' => $career->updated_at ? $career->updated_at->toDateString() : $today,
                    'priority' => '0.6',
                    'changefreq' => 'weekly',
                ];
            }

            // 7. CITIES + CITY SERVICES
            $cities = City::active()->orderBy('sort_order')->get();
            foreach ($cities as $city) {
                $urls[] = [
                    'loc' => $baseUrl . '/' . $city->slug,
                    'lastmod' => $today,
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                ];

                foreach ($services->take(10) as $service) {
                    $urls[] = [
                        'loc' => $baseUrl . '/' . $city->slug . '/' . $service->os_slug,
                        'lastmod' => $today,
                        'priority' => '0.7',
                        'changefreq' => 'monthly',
                    ];
                }
            }

            // 8. GALLERY
            $galleries = WorkGallery::active()->ordered()->get();
            foreach ($galleries as $gallery) {
                $urls[] = [
                    'loc' => $baseUrl . '/gallery',
                    'lastmod' => $gallery->updated_at ? $gallery->updated_at->toDateString() : $today,
                    'priority' => '0.5',
                    'changefreq' => 'monthly',
                ];
            }

            return $urls;
        });

        $lastModified = now()->toAtomString();
    
        return response()->view('sitemaps.main', [
            'urls' => $urls,
            'lastModified' => $lastModified,
        ])->header('Content-Type', 'text/xml; charset=UTF-8');
    }

    /**
     * Sitemap Index - List of all sitemaps
     * GET /sitemap-index.xml
     */
    public function sitemapIndex()
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
            ['loc' => $baseUrl . '/sitemap-careers.xml', 'lastmod' => $today],
        ];

        return response()->view('sitemaps.index', [
            'sitemaps' => $sitemaps,
        ])->header('Content-Type', 'text/xml; charset=UTF-8');
    }

    /**
     * City Sitemap - City pages + City Service pages
     * GET /sitemap-cities.xml
     */
    public function cities()
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

        return response()->view('sitemaps.cities', [
            'urls' => $urls,
        ])->header('Content-Type', 'text/xml; charset=UTF-8');
    }

    /**
     * Service Sitemap - Services + Service Details
     * GET /sitemap-services.xml
     */
    public function services()
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

        return response()->view('sitemaps.services', [
            'urls' => $urls,
        ])->header('Content-Type', 'text/xml; charset=UTF-8');
    }

    /**
     * Projects Sitemap
     * GET /sitemap-projects.xml
     */
    public function projects()
    {
        $baseUrl = config('app.url');
        $projects = Project::active()->ordered()->get();
        $urls = [];
        $today = now()->toDateString();

        foreach ($projects as $project) {
            $urls[] = [
                'loc' => $baseUrl . '/project/' . ($project->p_slug ?? $project->id),
                'lastmod' => $project->updated_at ? $project->updated_at->toDateString() : $today,
                'priority' => '0.8',
                'changefreq' => 'monthly',
            ];
        }

        return response()->view('sitemaps.projects', [
            'urls' => $urls,
        ])->header('Content-Type', 'text/xml; charset=UTF-8');
    }

    /**
     * Products Sitemap
     * GET /sitemap-products.xml
     */
    public function products()
    {
        $baseUrl = config('app.url');
        $products = Product::active()->get();
        $urls = [];
        $today = now()->toDateString();

        foreach ($products as $product) {
            $urls[] = [
                'loc' => $baseUrl . '/product/' . ($product->p_slug ?? $product->id),
                'lastmod' => $product->updated_at ? $product->updated_at->toDateString() : $today,
                'priority' => '0.8',
                'changefreq' => 'weekly',
            ];
        }

        return response()->view('sitemaps.products', [
            'urls' => $urls,
        ])->header('Content-Type', 'text/xml; charset=UTF-8');
    }

    /**
     * Blogs Sitemap
     * GET /sitemap-blogs.xml
     */
    public function blogs()
    {
        $baseUrl = config('app.url');
        $blogs = BlogPost::active()->latest()->get();
        $urls = [];
        $today = now()->toDateString();

        foreach ($blogs as $blog) {
            $urls[] = [
                'loc' => $baseUrl . '/blog/' . $blog->bp_slug,
                'lastmod' => $blog->updated_at ? $blog->updated_at->toDateString() : $today,
                'priority' => '0.7',
                'changefreq' => 'monthly',
                'image' => $blog->image_url ?? null,
                'image_title' => $blog->bp_title ?? null,
            ];
        }

        return response()->view('sitemaps.blogs', [
            'urls' => $urls,
        ])->header('Content-Type', 'text/xml; charset=UTF-8');
    }

    /**
     * Careers Sitemap
     * GET /sitemap-careers.xml
     */
    public function careers()
    {
        $baseUrl = config('app.url');
        $careers = Career::active()->get();
        $urls = [];
        $today = now()->toDateString();

        $urls[] = [
            'loc' => $baseUrl . '/careers',
            'lastmod' => $today,
            'priority' => '0.7',
            'changefreq' => 'weekly',
        ];

        foreach ($careers as $career) {
            $urls[] = [
                'loc' => $baseUrl . '/careers/' . $career->slug,
                'lastmod' => $career->updated_at ? $career->updated_at->toDateString() : $today,
                'priority' => '0.6',
                'changefreq' => 'weekly',
            ];
        }

        return response()->view('sitemaps.careers', [
            'urls' => $urls,
        ])->header('Content-Type', 'text/xml; charset=UTF-8');
    }

    /**
     * Clear sitemap cache
     */
    public function clearCache()
    {
        Cache::forget('sitemap_urls');
        return redirect()->back()->with('success', 'Sitemap cache cleared!');
    }
}