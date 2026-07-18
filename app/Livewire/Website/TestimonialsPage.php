<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Testimonial;
use App\Models\SeoData;
use App\Models\Service;
use App\Models\ProductCategory;
use App\Traits\HasDynamicSEO;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app-layout', ['seo' => []])]
#[Title('Testimonials - Razzaq Engineering Services')]
class TestimonialsPage extends Component
{
    use HasDynamicSEO;
    
    public $isLoading = true;
    public $errorMessage = '';
    public $search = '';
    public $filterRating = 'all';
    public $filterCity = 'all';

    public $testimonials = [];
    public $cities = [];
    public $seo = null;
    public $services = [];
    public $pc = [];
    
    // Stats
    public $totalTestimonials = 0;
    public $averageRating = 0;
    public $ratingDistribution = [];

    // Load more
    public $loadedCount = 6;
    public $hasMore = true;

    public function mount()
    {
        try {
            $this->isLoading = true;
            
            $this->initializeSEO('testimonials');

            $this->seo = SeoData::where('seo_page_type', 'Testimonial')->first();
            $this->testimonials = Testimonial::active()->ordered()->get();
            $this->cities = Testimonial::active()
                ->whereNotNull('t_location')
                ->distinct()
                ->pluck('t_location')
                ->filter()
                ->sort()
                ->values()
                ->toArray();
            $this->services = Service::active()->ordered()->get();
            $this->pc = ProductCategory::active()->select('pc_name')->get();

            // Calculate stats
            $this->totalTestimonials = $this->testimonials->count();
            $this->averageRating = round(Testimonial::getAverageRating(), 1);
            $this->ratingDistribution = Testimonial::getRatingDistribution();

            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load testimonials.';
            $this->isLoading = false;
            Log::error('TestimonialsPage error: ' . $e->getMessage());
        }
    }

    /**
     * Computed property for filtered testimonials
     */
    public function getFilteredTestimonialsProperty()
    {
        $filtered = $this->testimonials;

        // Search filter
        if (!empty($this->search)) {
            $filtered = $filtered->filter(function ($item) {
                return stripos($item->t_name, $this->search) !== false ||
                       stripos($item->t_content, $this->search) !== false ||
                       stripos($item->t_company ?? '', $this->search) !== false ||
                       stripos($item->t_location ?? '', $this->search) !== false;
            });
        }

        // Rating filter
        if ($this->filterRating !== 'all') {
            $filtered = $filtered->where('t_rating', (int) $this->filterRating);
        }

        // City filter
        if ($this->filterCity !== 'all') {
            $filtered = $filtered->where('t_location', $this->filterCity);
        }

        return $filtered->values();
    }

    /**
     * Get paginated testimonials
     */
    public function getDisplayedTestimonialsProperty()
    {
        return $this->filteredTestimonials->take($this->loadedCount);
    }

    /**
     * Filter by rating
     */
    public function filterByRating($rating)
    {
        $this->filterRating = $rating;
        $this->loadedCount = 6;
    }

    /**
     * Filter by city
     */
    public function filterByCity($city)
    {
        $this->filterCity = $city;
        $this->loadedCount = 6;
    }

    /**
     * Updated search
     */
    public function updatedSearch()
    {
        $this->loadedCount = 6;
    }

    /**
     * Load more
     */
    public function loadMore()
    {
        $this->loadedCount += 6;
        $this->hasMore = $this->loadedCount < $this->filteredTestimonials->count();
    }

    /**
     * Clear all filters
     */
    public function clearFilters()
    {
        $this->search = '';
        $this->filterRating = 'all';
        $this->filterCity = 'all';
        $this->loadedCount = 6;
    }

    public function render()
    {
        $seo = $this->getSeoData();
        return view('livewire.website.testimonials-page')->layoutData(['seo' => $seo]);
    }
}