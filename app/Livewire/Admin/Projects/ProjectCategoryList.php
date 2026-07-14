<?php

namespace App\Livewire\Admin\Projects;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\ProjectCategory;

#[Layout('components.layouts.admin-layout')]
#[Title('Project Categories - Admin Panel')]
class ProjectCategoryList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 15;
    public $selectedCategories = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $categoryToDelete = null;
    public $showViewModal = false;
    public $viewCategory = null;

    public $totalCategories = 0;
    public $activeCategories = 0;

    public function mount() { $this->loadStats(); }
    
    public function loadStats()
    {
        $this->totalCategories = ProjectCategory::getTotalCategories();
        $this->activeCategories = ProjectCategory::getActiveCategories();
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedCategories = $this->selectAll ? $this->getCategoriesProperty()->pluck('id')->toArray() : [];
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
    public function clearFilters() { $this->search = ''; $this->statusFilter = ''; $this->resetPage(); }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    #[On('project-category-created'), On('project-category-updated')]
    public function refreshList() { $this->resetPage(); $this->loadStats(); }

    public function toggleStatus($categoryId)
    {
        $category = ProjectCategory::find($categoryId);
        if ($category) {
            $category->update(['is_active' => !$category->is_active]);
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Status updated.');
        }
    }

    public function viewCategoryDetails($categoryId)
    {
        $this->viewCategory = ProjectCategory::withCount('projects')->find($categoryId);
        $this->showViewModal = true;
    }

    public function confirmDelete($categoryId) { $this->categoryToDelete = $categoryId; $this->showDeleteModal = true; }

    public function deleteCategory()
    {
        if ($this->categoryToDelete) {
            $category = ProjectCategory::find($this->categoryToDelete);
            if ($category) {
                if ($category->pc_image) @unlink(public_path('uploads/project-categories/' . $category->pc_image));
                $category->delete();
            }
            $this->showDeleteModal = false; $this->categoryToDelete = null;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Category deleted.');
        }
    }

    public function closeModals() { $this->showDeleteModal = false; $this->showViewModal = false; $this->categoryToDelete = null; $this->viewCategory = null; }

    public function bulkDelete()
    {
        if (count($this->selectedCategories) > 0) {
            $count = count($this->selectedCategories);
            $categories = ProjectCategory::whereIn('id', $this->selectedCategories)->get();
            foreach ($categories as $cat) {
                if ($cat->pc_image) @unlink(public_path('uploads/project-categories/' . $cat->pc_image));
                $cat->delete();
            }
            $this->selectedCategories = []; $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: $count . ' categories deleted.');
        }
    }

    public function bulkActivate()
    {
        ProjectCategory::whereIn('id', $this->selectedCategories)->update(['is_active' => true]);
        $this->selectedCategories = []; $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Categories activated.');
    }

    public function bulkDeactivate()
    {
        ProjectCategory::whereIn('id', $this->selectedCategories)->update(['is_active' => false]);
        $this->selectedCategories = []; $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Categories deactivated.');
    }

    public function getCategoriesProperty()
    {
        return ProjectCategory::query()
            ->withCount('projects')
            ->when($this->search, fn($q) => $q->where(fn($sq) => $sq->where('pc_name', 'like', "%{$this->search}%")->orWhere('pc_description', 'like', "%{$this->search}%")))
            ->when($this->statusFilter !== '', fn($q) => $q->where('is_active', (int) $this->statusFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.projects.category-list', [
            'categories' => $this->getCategoriesProperty(),
        ]);
    }
}