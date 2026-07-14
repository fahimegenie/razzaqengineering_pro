<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\SeoData;
use App\Models\ProductCategory;
use App\Models\City;

#[Layout('components.layouts.app-layout')]
#[Title('Our Projects - Razzaq Engineering Services')]
class ProjectsPage extends Component
{
    public $search = '';
    public $selectedCategory = 'all';
    public $selectedCategoryName = 'All Projects';
    public $selectedCity = 'all';
    public $selectedCityName = 'All Cities';
    public $selectedStatus = 'all';
    public $isLoading = false;
    public $errorMessage = '';

    public $projects = [];
    public $categories = [];
    public $cities = [];
    public $seo = null;
    public $pc = [];
    public $featuredProjects = [];
    public $totalCount = 0;

    public $loadedCount = 6;
    public $hasMore = true;

    // Dropdown states
    public $showCategoryDropdown = false;
    public $categorySearch = '';
    public $showCityDropdown = false;
    public $citySearch = '';

    // Status options
    public $statusOptions = [
        'all' => 'All Status',
        'completed' => 'Completed',
        'ongoing' => 'Ongoing',
        'planning' => 'Planning',
        'on-hold' => 'On Hold',
    ];

    public function mount()
    {
        try {
            $this->isLoading = true;
            
            $this->seo = SeoData::where('seo_page_type', 'Projects')->first();
            $this->categories = ProjectCategory::active()->ordered()->get();
            $this->cities = City::active()->orderBy('sort_order')->get();
            $this->pc = ProductCategory::active()->select('pc_name')->get();
            $this->featuredProjects = Project::active()->featured()->ordered()->limit(6)->get();
            
            $this->fetchProjects();
            
            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load projects.';
            $this->isLoading = false;
            \Log::error('ProjectsPage error: ' . $e->getMessage());
        }
    }

    // ============================================
    // COMPUTED PROPERTIES
    // ============================================
    
    public function getFilteredCategoriesProperty()
    {
        if (empty($this->categorySearch)) return $this->categories;
        return $this->categories->filter(fn($cat) => stripos($cat->pc_name, $this->categorySearch) !== false);
    }

    public function getFilteredCitiesProperty()
    {
        if (empty($this->citySearch)) return $this->cities;
        return $this->cities->filter(fn($city) => stripos($city->name, $this->citySearch) !== false);
    }

    // ============================================
    // DATA FETCH
    // ============================================
    private function fetchProjects()
    {
        $query = Project::active()->ordered();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('p_title', 'like', '%' . $this->search . '%')
                  ->orWhere('p_description', 'like', '%' . $this->search . '%')
                  ->orWhere('p_short_description', 'like', '%' . $this->search . '%')
                  ->orWhere('p_location', 'like', '%' . $this->search . '%')
                  ->orWhere('p_client', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedCategory !== 'all') {
            $query->where('pc_id', $this->selectedCategory);
        }

        if ($this->selectedCity !== 'all') {
            $query->where('p_location', 'like', '%' . City::find($this->selectedCity)->name . '%');
        }

        if ($this->selectedStatus !== 'all') {
            $query->where('p_status', $this->selectedStatus);
        }

        $this->totalCount = $query->count();
        $this->projects = $query->take($this->loadedCount)->get();
        $this->hasMore = $this->loadedCount < $this->totalCount;
    }

    // ============================================
    // ACTIONS
    // ============================================
    
    public function selectCategory($catId, $catName)
    {
        $this->selectedCategory = (string) $catId;
        $this->selectedCategoryName = $catName;
        $this->showCategoryDropdown = false;
        $this->categorySearch = '';
        $this->loadedCount = 6;
        $this->fetchProjects();
    }

    public function selectCity($cityId, $cityName)
    {
        $this->selectedCity = (string) $cityId;
        $this->selectedCityName = $cityName;
        $this->showCityDropdown = false;
        $this->citySearch = '';
        $this->loadedCount = 6;
        $this->fetchProjects();
    }

    public function filterByStatus($status)
    {
        $this->selectedStatus = $status;
        $this->loadedCount = 6;
        $this->fetchProjects();
    }

    public function toggleCategoryDropdown() { $this->showCategoryDropdown = !$this->showCategoryDropdown; $this->categorySearch = ''; }
    public function closeCategoryDropdown() { $this->showCategoryDropdown = false; }
    public function toggleCityDropdown() { $this->showCityDropdown = !$this->showCityDropdown; $this->citySearch = ''; }
    public function closeCityDropdown() { $this->showCityDropdown = false; }

    public function updatedSearch()
    {
        $this->loadedCount = 6;
        $this->fetchProjects();
    }

    public function loadMore()
    {
        $this->loadedCount += 6;
        $this->fetchProjects();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->selectedCategory = 'all';
        $this->selectedCategoryName = 'All Projects';
        $this->selectedCity = 'all';
        $this->selectedCityName = 'All Cities';
        $this->selectedStatus = 'all';
        $this->loadedCount = 6;
        $this->fetchProjects();
    }

    public function render()
    {
        return view('livewire.website.projects-page', [
            'filteredCategories' => $this->filteredCategories,
            'filteredCities' => $this->filteredCities,
        ]);
    }
}