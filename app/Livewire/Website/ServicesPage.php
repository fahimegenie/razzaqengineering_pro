<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Service;
use App\Models\SeoData;
use App\Models\ProductCategory;
use App\Models\City;

#[Layout('components.layouts.app-layout')]
#[Title('Our Services - Razzaq Engineering Services')]
class ServicesPage extends Component
{
    public $search = '';
    public $selectedCity = 'all';
    public $selectedCityName = 'All Cities';
    public $isLoading = false;
    public $errorMessage = '';

    public $services = [];
    public $cities = [];
    public $seo = null;
    public $pc = [];
    public $featuredServices = [];
    public $totalCount = 0;

    public $loadedCount = 6;
    public $hasMore = true;
    public $showCityDropdown = false;
    public $citySearch = '';

    public function mount()
    {
        try {
            $this->isLoading = true;
            
            $this->seo = SeoData::where('seo_page_type', 'Service')->first();
            $this->cities = City::active()->orderBy('sort_order')->get();
            $this->pc = ProductCategory::active()->select('pc_name')->get();
            $this->featuredServices = Service::active()->featured()->ordered()->limit(6)->get();
            
            $this->fetchServices();
            
            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load services.';
            $this->isLoading = false;
        }
    }

    // ============================================
    // COMPUTED PROPERTIES
    // ============================================
    
    /**
     * Filtered cities for searchable dropdown
     */
    public function getFilteredCitiesProperty()
    {
        if (empty($this->citySearch)) {
            return $this->cities;
        }
        return $this->cities->filter(function ($city) {
            return stripos($city->name, $this->citySearch) !== false;
        });
    }

    /**
     * City-service links for SEO section
     */
    public function getCityServiceLinksProperty()
    {
        $links = [];
        foreach ($this->cities->take(8) as $city) {
            $cityServices = Service::active()
                ->whereHas('cityServices', function ($q) use ($city) {
                    $q->where('city_id', $city->id)->where('is_active', 1);
                })
                ->ordered()
                ->take(4)
                ->get();
            
            $links[] = [
                'city' => $city,
                'services' => $cityServices,
            ];
        }
        return $links;
    }

    // ============================================
    // DATA FETCH
    // ============================================
    private function fetchServices()
    {
        $query = Service::active()->ordered();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('os_name', 'like', '%' . $this->search . '%')
                  ->orWhere('os_description', 'like', '%' . $this->search . '%')
                  ->orWhere('os_short_description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedCity !== 'all') {
            $query->whereHas('cityServices', function ($q) {
                $q->where('city_id', $this->selectedCity)->where('is_active', 1);
            });
        }

        $this->totalCount = $query->count();
        $this->services = $query->take($this->loadedCount)->get();
        $this->hasMore = $this->loadedCount < $this->totalCount;
    }

    // ============================================
    // ACTIONS
    // ============================================
    
    /**
     * Select city from dropdown
     */
    public function selectCity($cityId, $cityName)
    {
        $this->selectedCity = (string) $cityId;
        $this->selectedCityName = $cityId === 'all' ? 'All Cities' : $cityName;
        $this->showCityDropdown = false;
        $this->citySearch = '';
        $this->loadedCount = 6;
        $this->fetchServices();
    }

    /**
     * Toggle city dropdown
     */
    public function toggleCityDropdown()
    {
        $this->showCityDropdown = !$this->showCityDropdown;
        $this->citySearch = '';
    }

    /**
     * Close dropdown when clicking outside
     */
    public function closeCityDropdown()
    {
        $this->showCityDropdown = false;
        $this->citySearch = '';
    }

    /**
     * Search handler (debounced)
     */
    public function updatedSearch()
    {
        $this->loadedCount = 6;
        $this->fetchServices();
    }

    /**
     * Load more services
     */
    public function loadMore()
    {
        $this->loadedCount += 6;
        $this->fetchServices();
    }

    /**
     * Clear all filters
     */
    public function clearFilters()
    {
        $this->search = '';
        $this->selectedCity = 'all';
        $this->selectedCityName = 'All Cities';
        $this->loadedCount = 6;
        $this->fetchServices();
    }

    public function render()
    {
        return view('livewire.website.services-page', [
            'cityServiceLinks' => $this->cityServiceLinks,
            'filteredCities' => $this->filteredCities,
        ]);
    }
}
