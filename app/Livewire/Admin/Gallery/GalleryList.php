<?php

namespace App\Livewire\Admin\Gallery;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\WorkGallery;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Work Gallery Management - Admin Panel')]
class GalleryList extends Component
{
    use WithPagination;

    public $search = '';
    public $typeFilter = '';
    public $categoryFilter = '';
    public $statusFilter = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 12;
    public $selectedItems = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $itemToDelete = null;
    public $showViewModal = false;
    public $viewItem = null;

    // Statistics
    public $totalItems = 0;
    public $activeItems = 0;
    public $totalTypes = 0;
    public $totalCategories = 0;

    // Available options
    public $types = [];
    public $categories = [];

    public function mount()
    {
        $this->loadStats();
        $this->loadFilterOptions();
    }

    public function loadStats()
    {
        $this->totalItems = WorkGallery::count();
        $this->activeItems = WorkGallery::where('is_active', 1)->count();
        $this->totalTypes = WorkGallery::distinct('wg_type')->count();
        $this->totalCategories = WorkGallery::distinct('wg_category')->whereNotNull('wg_category')->count();
    }

    public function loadFilterOptions()
    {
        $this->types = WorkGallery::getTypes();
        $this->categories = WorkGallery::getCategories();
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedTypeFilter() { $this->resetPage(); }
    public function updatedCategoryFilter() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedItems = $this->selectAll 
            ? $this->getGalleryItemsProperty()->pluck('id')->toArray() 
            : [];
    }

    public function toggleItemSelection($itemId)
    {
        if (in_array($itemId, $this->selectedItems)) {
            $this->selectedItems = array_values(
                array_diff($this->selectedItems, [$itemId])
            );
            $this->selectAll = false;
        } else {
            $this->selectedItems[] = $itemId;
        }
    }

    public function clearSearch() 
    { 
        $this->search = ''; 
        $this->resetPage(); 
    }
    
    public function clearFilters()
    {
        $this->search = '';
        $this->typeFilter = '';
        $this->categoryFilter = '';
        $this->statusFilter = '';
        $this->resetPage();
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

    #[On('gallery-created'), On('gallery-updated')]
    public function refreshList()
    {
        $this->resetPage();
        $this->loadStats();
        $this->loadFilterOptions();
    }

    public function toggleStatus($itemId)
    {
        $item = WorkGallery::find($itemId);
        if ($item) {
            $item->update(['is_active' => !$item->is_active]);
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Gallery item status updated.');
        }
    }

    public function confirmDelete($itemId)
    {
        $this->itemToDelete = $itemId;
        $this->showDeleteModal = true;
    }

    public function deleteItem()
    {
        if ($this->itemToDelete) {
            $item = WorkGallery::find($this->itemToDelete);
            if ($item) {
                // Delete image
                if ($item->wg_image) {
                    $imagePaths = [
                        public_path('gallery_images/' . $item->wg_image),
                        public_path('uploads/gallery/' . $item->wg_image),
                    ];
                    foreach ($imagePaths as $path) {
                        if (file_exists($path)) {
                            @unlink($path);
                        }
                    }
                }
                $item->delete();
            }
            $this->showDeleteModal = false;
            $this->itemToDelete = null;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Gallery item deleted permanently.');
        }
    }

    public function viewItemDetails($itemId)
    {
        $this->viewItem = WorkGallery::find($itemId);
        $this->showViewModal = true;
    }

    public function closeModals()
    {
        $this->showDeleteModal = false;
        $this->showViewModal = false;
        $this->itemToDelete = null;
        $this->viewItem = null;
    }

    public function bulkDelete()
    {
        if (count($this->selectedItems) > 0) {
            $count = count($this->selectedItems);
            $items = WorkGallery::whereIn('id', $this->selectedItems)->get();
            foreach ($items as $item) {
                if ($item->wg_image) {
                    @unlink(public_path('gallery_images/' . $item->wg_image));
                    @unlink(public_path('uploads/gallery/' . $item->wg_image));
                }
                $item->delete();
            }
            $this->selectedItems = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: $count . ' items deleted.');
        }
    }

    public function bulkActivate()
    {
        if (count($this->selectedItems) > 0) {
            WorkGallery::whereIn('id', $this->selectedItems)
                ->update(['is_active' => true]);
            $this->selectedItems = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Items activated.');
        }
    }

    public function bulkDeactivate()
    {
        if (count($this->selectedItems) > 0) {
            WorkGallery::whereIn('id', $this->selectedItems)
                ->update(['is_active' => false]);
            $this->selectedItems = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Items deactivated.');
        }
    }

    public function getGalleryItemsProperty()
    {
        return WorkGallery::query()
            ->when($this->search, function($q) {
                $q->where(function($sq) {
                    $sq->where('wg_title', 'like', "%{$this->search}%")
                       ->orWhere('wg_description', 'like', "%{$this->search}%")
                       ->orWhere('wg_category', 'like', "%{$this->search}%")
                       ->orWhere('wg_type', 'like', "%{$this->search}%");
                });
            })
            ->when($this->typeFilter !== '', fn($q) => 
                $q->where('wg_type', $this->typeFilter)
            )
            ->when($this->categoryFilter !== '', fn($q) => 
                $q->where('wg_category', $this->categoryFilter)
            )
            ->when($this->statusFilter !== '', fn($q) => 
                $q->where('is_active', (int) $this->statusFilter)
            )
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.gallery.gallery-list', [
            'galleryItems' => $this->getGalleryItemsProperty(),
        ]);
    }
}