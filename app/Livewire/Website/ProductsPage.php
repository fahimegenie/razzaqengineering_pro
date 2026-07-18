<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SeoData;
use App\Models\Service;
use App\Traits\HasDynamicSEO;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

#[Layout('components.layouts.app-layout', ['seo' => []])]
#[Title('Our Products - Razzaq Engineering Services')]
class ProductsPage extends Component
{
    use HasDynamicSEO;
    
    public $search = '';
    public $selectedCategory = 'all';
    public $selectedCategoryName = 'All Products';
    public $isLoading = false;
    public $errorMessage = '';

    public $products = [];
    public $categories = [];
    public $seo = null;
    public $services = [];
    public $pc = [];
    public $totalCount = 0;

    public $loadedCount = 8;
    public $hasMore = true;

    // Dropdown
    public $showCategoryDropdown = false;
    public $categorySearch = '';

    // URL category parameter
    public $urlCategory = null;

    public function mount($pc_name = null)
    {
        // try {
            $this->isLoading = true;

            $this->initializeSEO('products');

            $this->urlCategory = $pc_name;

            $this->seo = SeoData::where('seo_page_type', 'product')->first();
            $this->categories = ProductCategory::active()->get();
            $this->services = Service::active()->ordered()->get();
            $this->pc = ProductCategory::active()->select('pc_name')->get();

            // If URL has category, pre-select it
            $matchedCategory = $this->categories->first(function ($cat) use ($pc_name) {
                return Str::slug($cat->pc_name) === Str::slug($pc_name) ||
                    stripos($cat->pc_name, str_replace('-', ' ', $pc_name)) !== false;
            });
            if ($matchedCategory) {
                $this->selectedCategory = $matchedCategory->pc_id;
                $this->selectedCategoryName = $matchedCategory->pc_name;
            }

            $this->fetchProducts();
            $this->isLoading = false;

        // } catch (\Exception $e) {
        //     $this->errorMessage = 'Failed to load products.';
        //     $this->isLoading = false;
        //     Log::error('ProductsPage error: ' . $e->getMessage());
        // }
    }

    // ============================================
    // COMPUTED PROPERTIES
    // ============================================
    
    public function getFilteredCategoriesProperty()
    {
        if (empty($this->categorySearch)) return $this->categories;
        return $this->categories->filter(fn($cat) => stripos($cat->pc_name, $this->categorySearch) !== false);
    }

    // ============================================
    // DATA FETCH
    // ============================================
    private function fetchProducts()
    {
        $query = Product::active();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('p_name', 'like', '%' . $this->search . '%')
                  ->orWhere('p_description', 'like', '%' . $this->search . '%')
                  ->orWhere('p_short_description', 'like', '%' . $this->search . '%')
                  ->orWhere('pc_type', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedCategory !== 'all') {
            $categoryName = ProductCategory::find($this->selectedCategory)->pc_name ?? '';
            $query->where(function ($q) use ($categoryName) {
                $q->where('pc_type', 'like', '%' . $categoryName . '%')
                  ->orWhere('pc_type', $categoryName)
                  ->orWhere('product_category_id', $this->selectedCategory);
            });
        }

        $this->totalCount = $query->count();
        $this->products = $query->take($this->loadedCount)->get();
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
        $this->loadedCount = 8;
        $this->fetchProducts();
    }

    public function toggleCategoryDropdown()
    {
        $this->showCategoryDropdown = !$this->showCategoryDropdown;
        $this->categorySearch = '';
    }

    public function closeCategoryDropdown()
    {
        $this->showCategoryDropdown = false;
    }

    public function updatedSearch()
    {
        $this->loadedCount = 8;
        $this->fetchProducts();
    }

    public function loadMore()
    {
        $this->loadedCount += 8;
        $this->fetchProducts();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->selectedCategory = 'all';
        $this->selectedCategoryName = 'All Products';
        $this->loadedCount = 8;
        $this->fetchProducts();
    }

    public function render()
    {
        $seo = $this->getSeoData();
        return view('livewire.website.products-page', [
            'filteredCategories' => $this->filteredCategories,
        ])->layoutData(['seo' => $seo]);
    }
}