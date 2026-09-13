<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Models\FleetItem;
use App\Models\FleetCategory;
use Illuminate\Support\Facades\Cache;

#[Layout('components.layouts.app-layout')]
#[Title('Our Fleet & Machinery - Razzaq Engineering Services')]
class FleetPage extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = 'all';
    public $isLoading = false;
    public $errorMessage = null;
    public $perPage = 9;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    public function filterCategory($categorySlug)
    {
        $this->isLoading = true;
        $this->selectedCategory = $categorySlug;
        $this->resetPage();
        $this->isLoading = false;
    }

    public function clearFilters()
    {
        $this->isLoading = true;
        $this->search = '';
        $this->selectedCategory = 'all';
        $this->resetPage();
        $this->isLoading = false;
    }

    public function loadMore()
    {
        $this->perPage += 9;
    }

    private function applySearch($query)
    {
        return $query->where(function ($q) {
            $q->where('title', 'like', '%' . $this->search . '%')
              ->orWhere('manufacturer', 'like', '%' . $this->search . '%')
              ->orWhere('model_number', 'like', '%' . $this->search . '%')
              ->orWhere('description', 'like', '%' . $this->search . '%');
        });
    }

    #[\Livewire\Attributes\Computed]
    public function featuredItems()
    {
        if (!empty($this->search) || $this->selectedCategory !== 'all') {
            return collect();
        }
        
        return Cache::remember('featured_fleet_items', 1800, function () {
            return FleetItem::active()
                ->where('is_featured', true)
                ->with(['category', 'primaryMedia'])
                ->ordered()
                ->take(3)
                ->get();
        });
    }

    public function render()
    {
        try {
            $categories = Cache::remember('active_fleet_categories', 3600, function () {
                return FleetCategory::active()
                    ->ordered()
                    ->withCount(['activeFleetItems' => function ($query) {
                        $query->active();
                    }])
                    ->get();
            });

            $fleetItems = FleetItem::active()
                ->with(['category', 'primaryMedia'])
                ->when($this->selectedCategory !== 'all', function ($query) {
                    $query->whereHas('category', function ($q) {
                        $q->where('slug', $this->selectedCategory);
                    });
                })
                ->when($this->search, function ($query) {
                    $this->applySearch($query);
                })
                ->ordered()
                ->paginate($this->perPage);

            return view('livewire.website.fleet-page', [
                'categories' => $categories,
                'fleetItems' => $fleetItems,
                'featuredItems' => $this->featuredItems,
            ]);
            
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred while loading the fleet page. Please try again later.';
            \Log::error('FleetPage render error: ' . $e->getMessage());
            
            return view('livewire.website.fleet-page', [
                'categories' => collect(),
                'fleetItems' => collect(),
                'featuredItems' => collect(),
            ]);
        }
    }
}