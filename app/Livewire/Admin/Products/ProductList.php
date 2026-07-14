<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Product;
use App\Models\ProductCategory;

#[Layout('components.layouts.admin-layout')]
#[Title('Products - Admin Panel')]
class ProductList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $categoryFilter = '';
    public $stockFilter = '';
    public $featuredFilter = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 12;
    public $selectedProducts = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $productToDelete = null;
    public $showViewModal = false;
    public $viewProduct = null;

    public $totalProducts = 0;
    public $activeProducts = 0;
    public $featuredProducts = 0;
    public $inStockProducts = 0;
    public $categories = [];

    public function mount()
    {
        $this->loadStats();
        $this->categories = ProductCategory::active()->orderBy('pc_name')->get();
    }

    public function loadStats()
    {
        $this->totalProducts = Product::getTotalProducts();
        $this->activeProducts = Product::getActiveProducts();
        $this->featuredProducts = Product::getFeaturedProducts();
        $this->inStockProducts = Product::inStock()->count();
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedCategoryFilter() { $this->resetPage(); }
    public function updatedStockFilter() { $this->resetPage(); }
    public function updatedFeaturedFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedProducts = $this->selectAll ? $this->getProductsProperty()->pluck('id')->toArray() : [];
    }

    public function toggleProductSelection($productId)
    {
        if (in_array($productId, $this->selectedProducts)) {
            $this->selectedProducts = array_values(array_diff($this->selectedProducts, [$productId]));
            $this->selectAll = false;
        } else {
            $this->selectedProducts[] = $productId;
        }
    }

    public function clearSearch() { $this->search = ''; $this->resetPage(); }
    public function clearFilters()
    {
        $this->search = ''; $this->statusFilter = ''; $this->categoryFilter = '';
        $this->stockFilter = ''; $this->featuredFilter = ''; $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    #[On('product-created'), On('product-updated')]
    public function refreshList() { $this->resetPage(); $this->loadStats(); }

    public function toggleStatus($productId)
    {
        $product = Product::find($productId);
        if ($product) { $product->update(['is_active' => !$product->is_active]); $this->loadStats(); $this->dispatch('toast', type: 'success', message: 'Status updated.'); }
    }

    public function toggleStock($productId)
    {
        $product = Product::find($productId);
        if ($product) { $product->update(['in_stock' => !$product->in_stock]); $this->loadStats(); $this->dispatch('toast', type: 'success', message: 'Stock status updated.'); }
    }

    public function toggleFeatured($productId)
    {
        $product = Product::find($productId);
        if ($product) { $product->update(['is_featured' => !$product->is_featured]); $this->loadStats(); $this->dispatch('toast', type: 'success', message: 'Featured status updated.'); }
    }

    public function confirmDelete($productId) { $this->productToDelete = $productId; $this->showDeleteModal = true; }

    public function deleteProduct()
    {
        if ($this->productToDelete) {
            $product = Product::find($this->productToDelete);
            if ($product) {
                if ($product->p_image) @unlink(public_path('uploads/products/' . $product->p_image));
                foreach ($product->gallery_urls as $img) {
                    $path = public_path('uploads/products/gallery/' . basename($img));
                    if (file_exists($path)) @unlink($path);
                }
                $product->delete();
            }
            $this->showDeleteModal = false; $this->productToDelete = null;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Product deleted.');
        }
    }

    public function viewProductDetails($productId) { $this->viewProduct = Product::with('category')->find($productId); $this->showViewModal = true; }
    public function closeModals() { $this->showDeleteModal = false; $this->showViewModal = false; $this->productToDelete = null; $this->viewProduct = null; }

    public function bulkDelete()
    {
        if (count($this->selectedProducts) > 0) {
            $count = count($this->selectedProducts);
            $products = Product::whereIn('id', $this->selectedProducts)->get();
            foreach ($products as $product) {
                if ($product->p_image) @unlink(public_path('uploads/products/' . $product->p_image));
                $product->delete();
            }
            $this->selectedProducts = []; $this->selectAll = false; $this->loadStats();
            $this->dispatch('toast', type: 'success', message: $count . ' products deleted.');
        }
    }

    public function bulkActivate() { Product::whereIn('id', $this->selectedProducts)->update(['is_active' => true]); $this->selectedProducts = []; $this->loadStats(); $this->dispatch('toast', type: 'success', message: 'Products activated.'); }
    public function bulkDeactivate() { Product::whereIn('id', $this->selectedProducts)->update(['is_active' => false]); $this->selectedProducts = []; $this->loadStats(); $this->dispatch('toast', type: 'success', message: 'Products deactivated.'); }

    public function getProductsProperty()
    {
        return Product::query()
            ->with('category')
            ->when($this->search, fn($q) => $q->where(fn($sq) => $sq->where('p_name', 'like', "%{$this->search}%")->orWhere('p_description', 'like', "%{$this->search}%")))
            ->when($this->statusFilter !== '', fn($q) => $q->where('is_active', (int) $this->statusFilter))
            ->when($this->categoryFilter !== '', fn($q) => $q->where('product_category_id', $this->categoryFilter))
            ->when($this->stockFilter !== '', fn($q) => $q->where('in_stock', (int) $this->stockFilter))
            ->when($this->featuredFilter !== '', fn($q) => $q->where('is_featured', (int) $this->featuredFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.products.product-list', ['products' => $this->getProductsProperty()]);
    }
}