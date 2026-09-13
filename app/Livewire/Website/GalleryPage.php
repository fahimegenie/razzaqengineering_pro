<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\WorkGallery;
use App\Models\SeoData;
use App\Models\Service;
use App\Models\ProductCategory;
use App\Traits\HasDynamicSEO;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app-layout', ['seo' => []])]
#[Title('Gallery - Razzaq Engineering Services')]
class GalleryPage extends Component
{
    use HasDynamicSEO;
    
    public $selectedCategory = 'all';
    public $selectedCategoryName = 'All';
    public $isLoading = true;
    public $errorMessage = '';

    public $categories = [];
    public $seo = null;
    public $services = [];
    public $pc = [];
    
    public $activeImage = null;
    public $activeImageIndex = 0;
    public $filteredImages = [];
    public $totalCount = 0;
    public $totalGalleriesCount = 0;

    public function mount()
    {
        try {
            $this->isLoading = true;

            $this->initializeSEO('gallery');
            $this->seo = SeoData::where('seo_page_type', 'Gallery')->first();
            
            $galleries = WorkGallery::active()->ordered()->get();
            $this->totalGalleriesCount = $galleries->count();
            
            $this->categories = $galleries
                ->pluck('wg_type')
                ->filter()
                ->unique()
                ->sort()
                ->values()
                ->toArray();
            
            $this->services = Service::active()->ordered()->get();
            $this->pc = ProductCategory::active()->select('pc_name')->get();

            $this->applyFilter();
            $this->isLoading = false;
            
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load gallery. Please try again.';
            $this->isLoading = false;
            Log::error('GalleryPage error: ' . $e->getMessage());
        }
    }

    public function filterByCategory($category)
    {
        $this->selectedCategory = $category;
        $this->selectedCategoryName = $category === 'all' ? 'All' : $category;
        $this->applyFilter();
        $this->activeImage = null;
    }

    private function applyFilter()
    {
        $allGalleries = WorkGallery::active()->ordered()->get();
        
        if ($this->selectedCategory === 'all') {
            $this->filteredImages = $allGalleries;
        } else {
            $this->filteredImages = $allGalleries->filter(function ($item) {
                return $item->wg_type === $this->selectedCategory;
            })->values();
        }
        $this->totalCount = count($this->filteredImages);
    }

    public function openLightbox($imageIndex)
    {
        if (isset($this->filteredImages[$imageIndex])) {
            $this->activeImage = $this->filteredImages[$imageIndex];
            $this->activeImageIndex = (int) $imageIndex;
        }
    }

    public function closeLightbox()
    {
        $this->activeImage = null;
    }

    public function nextImage()
    {
        $total = $this->totalCount;
        if ($total > 0) {
            $this->activeImageIndex = ($this->activeImageIndex + 1) % $total;
            $this->activeImage = $this->filteredImages[$this->activeImageIndex] ?? null;
        }
    }

    public function prevImage()
    {
        $total = $this->totalCount;
        if ($total > 0) {
            $this->activeImageIndex = ($this->activeImageIndex - 1 + $total) % $total;
            $this->activeImage = $this->filteredImages[$this->activeImageIndex] ?? null;
        }
    }

    public function render()
    {
        $seo = $this->getSeoData();
        return view('livewire.website.gallery-page')->layoutData(['seo' => $seo]);
    }
}