<?php

namespace App\Livewire\Admin\SEO;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\SeoData;
use App\Models\Service;
use App\Models\Project;
use App\Models\Product;
use App\Models\BlogPost;
use App\Models\WorkGallery;
use App\Models\Testimonial;
use App\Models\OurTeam;
use App\Models\City;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

#[Layout('components.layouts.admin-layout')]
#[Title('Dynamic SEO Generator - Admin Panel')]
class DynamicSeoGenerator extends Component
{
    public $selectedPageType = '';
    
    // Explicitly casting arrays to handle Livewire hydration safely
    public $selectedItems = [];
    public $selectedCities = [];
    
    public $selectAll = false;
    public $selectAllCities = false;
    public $generateMode = 'both';
    public $previewData = [];
    public $showPreview = false;
    public $isGenerating = false;
    public $progressCount = 0;
    public $totalCount = 0;
    public $generationComplete = false;
    
    public $seoTitleTemplate = '{name} - Razzaq Engineering';
    public $seoDescriptionTemplate = 'Professional {name} services by Razzaq Engineering in Pakistan.';
    public $seoKeywordsTemplate = '{name}, razzaq engineering, pakistan';
    public $cityTitleTemplate = '{name} in {city} - Razzaq Engineering';
    public $cityDescriptionTemplate = 'Professional {name} services in {city} by Razzaq Engineering. Contact us for best {name} in {city}.';
    public $cityKeywordsTemplate = '{name}, {city}, razzaq engineering, pakistan';

    // Holds hydrated serializable arrays for reliable rendering
    public $availableItems = [];
    public $availableCities = [];

    public $totalServices = 0;
    public $totalProjects = 0;
    public $totalProducts = 0;
    public $totalBlogs = 0;
    public $totalGalleries = 0;
    public $totalTestimonials = 0;
    public $totalTeam = 0;
    public $totalCities = 0;

    public $pageTypes = [
        'service' => 'Services',
        'project' => 'Projects',
        'product' => 'Products',
        'blog' => 'Blog Posts',
        'gallery' => 'Gallery Items',
        'testimonial' => 'Testimonials',
        'team' => 'Team Members',
    ];

    public function mount()
    {
        $this->loadCounts();
        // Fixed: Converting Eloquent Collection to clean array to avoid hydration issues
        $this->availableCities = City::active()->orderBy('name')->get()->toArray();
        $this->availableItems = []; 
    }

    public function loadCounts()
    {
        $this->totalServices = Service::active()->count();
        $this->totalProjects = Project::active()->count();
        $this->totalProducts = Product::active()->count();
        $this->totalBlogs = BlogPost::where('bp_status', 'published')->count();
        $this->totalGalleries = WorkGallery::active()->count();
        $this->totalTestimonials = Testimonial::active()->count();
        $this->totalTeam = OurTeam::active()->count();
        $this->totalCities = City::active()->count();
    }

    public function updatedSelectedPageType()
    {
        // Reset selections to clear residual IDs from other models
        $this->selectedItems = [];
        $this->selectAll = false;
        $this->availableItems = $this->getItemsByType();
    }

    public function updatedSelectAll($value)
    {
        if (empty($this->selectedPageType)) {
            $this->selectedItems = [];
            return;
        }
        
        $this->selectedItems = $value 
            ? collect($this->availableItems)->pluck('id')->map(fn($id) => (string)$id)->toArray() 
            : [];
    }

    public function updatedSelectAllCities($value)
    {
        $this->selectedCities = $value 
            ? collect($this->availableCities)->pluck('id')->map(fn($id) => (string)$id)->toArray() 
            : [];
    }

    private function getItemsByType(): array
    {
        if (empty($this->selectedPageType)) {
            return [];
        }

        $itemsCollection = match ($this->selectedPageType) {
            'service' => Service::active()->ordered()->get(),
            'project' => Project::active()->ordered()->get(),
            'product' => Product::active()->ordered()->get(),
            'blog' => BlogPost::where('bp_status', 'published')->latest()->get(),
            'gallery' => WorkGallery::active()->ordered()->get(),
            'testimonial' => Testimonial::active()->ordered()->get(),
            'team' => OurTeam::active()->ordered()->get(),
            default => collect(),
        };

        // Fixed: Always return clean serializable arrays
        return $itemsCollection->toArray();
    }

    private function getItemName($item): string
    {
        if (!$item) return '';
        // Handles both Array & Object formats safely depending on Hydration phase
        $item = (object)$item; 

        return match ($this->selectedPageType) {
            'service' => $item->os_name ?? '',
            'project' => $item->p_title ?? '',
            'product' => $item->p_name ?? '',
            'blog' => $item->bp_title ?? '',
            'gallery' => $item->wg_title ?? '',
            'testimonial' => $item->t_name ?? '',
            'team' => $item->ot_name ?? '',
            default => '',
        };
    }

    private function getItemSlug($item): string
    {
        if (!$item) return '';
        $item = (object)$item;

        return match ($this->selectedPageType) {
            'service' => $item->os_slug ?? '',
            'project' => $item->p_slug ?? '',
            'product' => $item->p_slug ?? '',
            'blog' => $item->bp_slug ?? '',
            'gallery' => (string)($item->id ?? ''),
            'testimonial' => (string)($item->id ?? ''),
            'team' => (string)($item->id ?? ''),
            default => '',
        };
    }

    private function getItemUrl($item): string
    {
        if (!$item) return '/';
        return match ($this->selectedPageType) {
            'service' => '/services/' . $this->getItemSlug($item),
            'project' => '/projects/' . $this->getItemSlug($item),
            'product' => '/products/' . $this->getItemSlug($item),
            'blog' => '/blog/' . $this->getItemSlug($item),
            'gallery' => '/gallery/' . $this->getItemSlug($item),
            'testimonial' => '/testimonials',
            'team' => '/team',
            default => '/',
        };
    }

    public function preview()
    {
        if (empty($this->selectedPageType)) {
            $this->dispatch('toast', type: 'error', message: 'Please select a page type first.');
            return;
        }

        if (empty($this->selectedItems) && $this->generateMode !== 'cities') {
            $this->dispatch('toast', type: 'error', message: 'Please select at least one item.');
            return;
        }

        if (($this->generateMode === 'cities' || $this->generateMode === 'both') && empty($this->selectedCities)) {
            $this->dispatch('toast', type: 'error', message: 'Please select at least one city.');
            return;
        }

        $this->showPreview = true;
        $this->previewData = [];

        // Safe array matching
        $items = collect($this->availableItems)->whereIn('id', $this->selectedItems);
        $cities = collect($this->availableCities)->whereIn('id', $this->selectedCities);

        if ($this->generateMode === 'pages' || $this->generateMode === 'both') {
            foreach ($items as $item) {
                $name = $this->getItemName($item);
                $url = $this->getItemUrl($item);

                $this->previewData[] = [
                    'type' => $this->selectedPageType,
                    'name' => $name,
                    'url' => $url,
                    'seo_title' => str_replace('{name}', $name, $this->seoTitleTemplate),
                    'seo_description' => str_replace('{name}', $name, $this->seoDescriptionTemplate),
                    'seo_keywords' => str_replace('{name}', strtolower($name), $this->seoKeywordsTemplate),
                    'has_city' => false,
                ];
            }
        }

        if ($this->generateMode === 'cities' || $this->generateMode === 'both') {
            foreach ($items as $item) {
                $name = $this->getItemName($item);
                foreach ($cities as $city) {
                    $city = (object)$city;
                    $cityUrl = $this->getItemUrl($item) . '-in-' . $city->slug;
                    
                    $this->previewData[] = [
                        'type' => $this->selectedPageType,
                        'name' => $name . ' in ' . $city->name,
                        'url' => $cityUrl,
                        'seo_title' => str_replace(['{name}', '{city}'], [$name, $city->name], $this->cityTitleTemplate),
                        'seo_description' => str_replace(['{name}', '{city}'], [$name, $city->name], $this->cityDescriptionTemplate),
                        'seo_keywords' => str_replace(['{name}', '{city}'], [strtolower($name), strtolower($city->name)], $this->cityKeywordsTemplate),
                        'has_city' => true,
                        'city' => $city->name,
                    ];
                }
            }
        }

        $this->totalCount = count($this->previewData);
    }

    public function generate()
    {
        if (empty($this->selectedPageType)) {
            $this->dispatch('toast', type: 'error', message: 'Please select a page type first.');
            return;
        }

        if (empty($this->selectedItems) && $this->generateMode !== 'cities') {
            $this->dispatch('toast', type: 'error', message: 'Please select at least one item.');
            return;
        }

        $this->isGenerating = true;
        $this->progressCount = 0;
        $this->generationComplete = false;

        $items = collect($this->availableItems)->whereIn('id', $this->selectedItems);
        $cities = collect($this->availableCities)->whereIn('id', $this->selectedCities);

        $this->totalCount = 0;
        if ($this->generateMode === 'pages' || $this->generateMode === 'both') {
            $this->totalCount += count($items);
        }
        if ($this->generateMode === 'cities' || $this->generateMode === 'both') {
            $this->totalCount += count($items) * count($cities);
        }

        try {
            DB::beginTransaction();

            if ($this->generateMode === 'pages' || $this->generateMode === 'both') {
                foreach ($items as $item) {
                    $name = $this->getItemName($item);
                    $slug = $this->getItemSlug($item);
                    $url = $this->getItemUrl($item);

                    SeoData::updateOrCreate(
                        [
                            'seo_page_type' => $this->selectedPageType,
                            'seo_slug' => $slug,
                        ],
                        [
                            'seo_page_url' => $url,
                            'seo_title' => str_replace('{name}', $name, $this->seoTitleTemplate),
                            'seo_description' => str_replace('{name}', $name, $this->seoDescriptionTemplate),
                            'seo_keywords' => str_replace('{name}', strtolower($name), $this->seoKeywordsTemplate),
                            'seo_focus_keyword' => strtolower($name),
                            'seo_robots' => 'index,follow',
                            'seo_sitemap_include' => true,
                            'seo_sitemap_priority' => 80,
                            'seo_sitemap_frequency' => 'weekly',
                            'seo_og_title' => str_replace('{name}', $name, $this->seoTitleTemplate),
                            'seo_og_description' => str_replace('{name}', $name, $this->seoDescriptionTemplate),
                            'seo_og_type' => 'website',
                            'seo_twitter_card' => 'summary_large_image',
                            'seo_twitter_title' => str_replace('{name}', $name, $this->seoTitleTemplate),
                            'seo_twitter_description' => str_replace('{name}', $name, $this->seoDescriptionTemplate),
                            'seo_schema_type' => 'Service',
                        ]
                    );
                    $this->progressCount++;
                }
            }

            if ($this->generateMode === 'cities' || $this->generateMode === 'both') {
                foreach ($items as $item) {
                    $name = $this->getItemName($item);
                    $slug = $this->getItemSlug($item);
                    
                    foreach ($cities as $city) {
                        $city = (object)$city;
                        $cityUrl = $this->getItemUrl($item) . '-in-' . $city->slug;
                        $pageType = $this->selectedPageType . '-city';
                        $citySlug = $slug . '-in-' . $city->slug;

                        SeoData::updateOrCreate(
                            [
                                'seo_page_type' => $pageType,
                                'seo_slug' => $citySlug,
                            ],
                            [
                                'seo_page_url' => $cityUrl,
                                'seo_title' => str_replace(['{name}', '{city}'], [$name, $city->name], $this->cityTitleTemplate),
                                'seo_description' => str_replace(['{name}', '{city}'], [$name, $city->name], $this->cityDescriptionTemplate),
                                'seo_keywords' => str_replace(['{name}', '{city}'], [strtolower($name), strtolower($city->name)], $this->cityKeywordsTemplate),
                                'seo_focus_keyword' => strtolower($name) . ' in ' . strtolower($city->name),
                                'seo_robots' => 'index,follow',
                                'seo_sitemap_include' => true,
                                'seo_sitemap_priority' => 70,
                                'seo_sitemap_frequency' => 'weekly',
                                'seo_og_title' => str_replace(['{name}', '{city}'], [$name, $city->name], $this->cityTitleTemplate),
                                'seo_og_description' => str_replace(['{name}', '{city}'], [$name, $city->name], $this->cityDescriptionTemplate),
                                'seo_og_type' => 'website',
                                'seo_twitter_card' => 'summary_large_image',
                                'seo_twitter_title' => str_replace(['{name}', '{city}'], [$name, $city->name], $this->cityTitleTemplate),
                                'seo_twitter_description' => str_replace(['{name}', '{city}'], [$name, $city->name], $this->cityDescriptionTemplate),
                                'seo_schema_type' => 'LocalBusiness',
                            ]
                        );
                        $this->progressCount++;
                    }
                }
            }

            DB::commit();
            $this->generationComplete = true;
            $this->isGenerating = false;
            $this->dispatch('toast', type: 'success', message: "Successfully generated {$this->progressCount} SEO records!");

        } catch (\Exception $e) {
            DB::rollBack();
            $this->isGenerating = false;
            Log::error('SEO Generation error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', message: 'Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.seo.dynamic-seo-generator');
    }
}