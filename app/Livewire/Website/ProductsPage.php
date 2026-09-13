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
    public $selectedCategory = 'all';          // holds pc_id or 'all'
    public $selectedCategoryName = 'All Products';
    public $selectedCategorySlug = null;       // for URL sync
    public $isLoading = false;
    public $errorMessage = '';

    public $products = [];
    public $categories = [];
    public $seo = null;
    public $services = [];
    public $totalCount = 0;

    public $loadedCount = 8;
    public $hasMore = true;

    // Dropdown
    public $showCategoryDropdown = false;
    public $categorySearch = '';

    // Bound URL param
    public $pc_slug = null;

    public function mount($pc_slug = null)
    {
        $this->isLoading = true;

        try {
            $this->initializeSEO('products');
            $this->pc_slug = $pc_slug;

            $this->seo        = SeoData::where('seo_page_type', 'product')->first();
            $this->categories = ProductCategory::active()->ordered()->get();
            $this->services   = Service::active()->ordered()->get();

            // Pre-select category from URL slug
            if ($pc_slug) {
                $matched = $this->categories->firstWhere('pc_slug', $pc_slug)
                        ?? $this->categories->first(fn ($c) => Str::slug($c->pc_name) === $pc_slug);

                if ($matched) {
                    $this->selectedCategory     = (string) $matched->id;
                    $this->selectedCategoryName = $matched->pc_name;
                    $this->selectedCategorySlug = $matched->pc_slug;
                }
            }

          
            $this->fetchProducts();
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load products.';
            Log::error('ProductsPage error: ' . $e->getMessage());
        }

        $this->isLoading = false;
    }

    // ============================================
    // COMPUTED
    // ============================================
    public function getFilteredCategoriesProperty()
    {
        if (empty($this->categorySearch)) {
            return $this->categories;
        }
        return $this->categories->filter(
            fn ($cat) => stripos($cat->pc_name, $this->categorySearch) !== false
        );
    }

    // ============================================
    // DATA FETCH
    // ============================================
    private function fetchProducts()
    {
        $query = Product::active();

        // ----- Search -----
        if (!empty($this->search)) {
            $term = $this->search;
            $query->where(function ($q) use ($term) {
                $q->where('p_name', 'like', "%{$term}%")
                  ->orWhere('p_description', 'like', "%{$term}%")
                  ->orWhere('p_short_description', 'like', "%{$term}%")
                  ->orWhere('brand_name', 'like', "%{$term}%")
                  ->orWhere('pc_type', 'like', "%{$term}%");
            });
        }

        // ----- Category filter -----
        if ($this->selectedCategory !== 'all') {
            $catId = $this->selectedCategory;

            $category = ProductCategory::find($catId);
            $catName  = $category->pc_name ?? null;

            $query->where(function ($q) use ($catId, $catName) {
                $q->where('product_category_id', $catId);

                if ($catName) {
                    $q->orWhere('pc_type', $catName)
                      ->orWhere('pc_type', 'like', "%{$catName}%");
                }
            });
        }

        $this->totalCount = $query->count();

        $this->products = $query->ordered()
                                ->take($this->loadedCount)
                                ->get();

        $this->hasMore = $this->loadedCount < $this->totalCount;
    }

    // ============================================
    // ACTIONS
    // ============================================
    public function selectCategory($catId, $catName, $catSlug = null)
    {
        $this->selectedCategory     = (string) $catId;
        $this->selectedCategoryName = $catName;
        $this->selectedCategorySlug = $catSlug;

        $this->showCategoryDropdown = false;
        $this->categorySearch       = '';
        $this->loadedCount          = 8;

        // Sync URL
        if ($catId === 'all' || $catSlug === null) {
            $this->dispatch('url-changed', url: route('products'));
        } else {
            $this->dispatch('url-changed', url: route('products.category', ['pc_slug' => $catSlug]));
        }

        $this->fetchProducts();
    }

    public function toggleCategoryDropdown()
    {
        $this->showCategoryDropdown = ! $this->showCategoryDropdown;
        $this->categorySearch       = '';
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
        $this->search               = '';
        $this->selectedCategory     = 'all';
        $this->selectedCategoryName = 'All Products';
        $this->selectedCategorySlug = null;
        $this->loadedCount          = 8;

        $this->dispatch('url-changed', url: route('products'));

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