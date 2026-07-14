<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\BlogCategory;

#[Layout('components.layouts.admin-layout')]
#[Title('Blog Categories - Admin Panel')]
class BlogCategoryList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $featuredFilter = '';
    public $parentFilter = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 15;
    public $selectedCategories = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $categoryToDelete = null;

    public $totalCategories = 0;
    public $activeCategories = 0;
    public $featuredCategories = 0;
    public $parentCategories = 0;

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $this->totalCategories = BlogCategory::count();
        $this->activeCategories = BlogCategory::where('is_active', 1)->count();
        $this->featuredCategories = BlogCategory::where('is_featured', 1)->count();
        $this->parentCategories = BlogCategory::whereNull('parent_id')->count();
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedFeaturedFilter() { $this->resetPage(); }
    public function updatedParentFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedCategories = $this->selectAll 
            ? $this->getCategoriesProperty()->pluck('id')->toArray() 
            : [];
    }

    public function toggleCategorySelection($categoryId)
    {
        if (in_array($categoryId, $this->selectedCategories)) {
            $this->selectedCategories = array_values(array_diff($this->selectedCategories, [$categoryId]));
            $this->selectAll = false;
        } else {
            $this->selectedCategories[] = $categoryId;
        }
    }

    public function clearSearch() { $this->search = ''; $this->resetPage(); }
    
    public function clearFilters()
    {
        $this->search = '';
        $this->statusFilter = '';
        $this->featuredFilter = '';
        $this->parentFilter = '';
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

    #[On('category-created'), On('category-updated')]
    public function refreshList()
    {
        $this->resetPage();
        $this->loadStats();
    }

    public function toggleStatus($categoryId)
    {
        $category = BlogCategory::find($categoryId);
        if ($category) {
            $category->update(['is_active' => !$category->is_active]);
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Status updated.');
        }
    }

    public function toggleFeatured($categoryId)
    {
        $category = BlogCategory::find($categoryId);
        if ($category) {
            $category->update(['is_featured' => !$category->is_featured]);
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Featured status updated.');
        }
    }

    public function confirmDelete($categoryId)
    {
        $this->categoryToDelete = $categoryId;
        $this->showDeleteModal = true;
    }

    public function deleteCategory()
    {
        if ($this->categoryToDelete) {
            $category = BlogCategory::find($this->categoryToDelete);
            if ($category) {
                if ($category->bc_image) {
                    @unlink(public_path('uploads/blog/categories/' . $category->bc_image));
                }
                $category->delete();
            }
            $this->showDeleteModal = false;
            $this->categoryToDelete = null;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Category deleted.');
        }
    }

    public function closeModals()
    {
        $this->showDeleteModal = false;
        $this->categoryToDelete = null;
    }

    public function bulkDelete()
    {
        if (count($this->selectedCategories) > 0) {
            $count = count($this->selectedCategories);
            $categories = BlogCategory::whereIn('id', $this->selectedCategories)->get();
            foreach ($categories as $category) {
                if ($category->bc_image) {
                    @unlink(public_path('uploads/blog/categories/' . $category->bc_image));
                }
                $category->delete();
            }
            $this->selectedCategories = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: $count . ' categories deleted.');
        }
    }

    public function bulkActivate()
    {
        if (count($this->selectedCategories) > 0) {
            BlogCategory::whereIn('id', $this->selectedCategories)->update(['is_active' => true]);
            $this->selectedCategories = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Categories activated.');
        }
    }

    public function bulkDeactivate()
    {
        if (count($this->selectedCategories) > 0) {
            BlogCategory::whereIn('id', $this->selectedCategories)->update(['is_active' => false]);
            $this->selectedCategories = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Categories deactivated.');
        }
    }

    public function getCategoriesProperty()
    {
        return BlogCategory::query()
            ->withCount(['posts' => fn($q) => $q->published()])
            ->when($this->search, function($q) {
                $q->where(function($sq) {
                    $sq->where('bc_name', 'like', "%{$this->search}%")
                       ->orWhere('bc_description', 'like', "%{$this->search}%");
                });
            })
            ->when($this->statusFilter !== '', fn($q) => $q->where('is_active', (int) $this->statusFilter))
            ->when($this->featuredFilter !== '', fn($q) => $q->where('is_featured', (int) $this->featuredFilter))
            ->when($this->parentFilter !== '', function($q) {
                if ($this->parentFilter === 'parent') {
                    $q->whereNull('parent_id');
                } elseif ($this->parentFilter === 'child') {
                    $q->whereNotNull('parent_id');
                }
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.blog.category-list', [
            'categories' => $this->getCategoriesProperty(),
        ]);
    }
}