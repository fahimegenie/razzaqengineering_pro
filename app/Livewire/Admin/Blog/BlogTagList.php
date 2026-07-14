<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\BlogTag;

#[Layout('components.layouts.admin-layout')]
#[Title('Blog Tags - Admin Panel')]
class BlogTagList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 20;
    public $selectedTags = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $tagToDelete = null;

    public $totalTags = 0;
    public $activeTags = 0;

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $this->totalTags = BlogTag::count();
        $this->activeTags = BlogTag::where('is_active', 1)->count();
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedTags = $this->selectAll 
            ? $this->getTagsProperty()->pluck('id')->toArray() 
            : [];
    }

    public function toggleTagSelection($tagId)
    {
        if (in_array($tagId, $this->selectedTags)) {
            $this->selectedTags = array_values(array_diff($this->selectedTags, [$tagId]));
            $this->selectAll = false;
        } else {
            $this->selectedTags[] = $tagId;
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

    #[On('tag-created'), On('tag-updated')]
    public function refreshList()
    {
        $this->resetPage();
        $this->loadStats();
    }

    public function toggleStatus($tagId)
    {
        $tag = BlogTag::find($tagId);
        if ($tag) {
            $tag->update(['is_active' => !$tag->is_active]);
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Status updated.');
        }
    }

    public function confirmDelete($tagId)
    {
        $this->tagToDelete = $tagId;
        $this->showDeleteModal = true;
    }

    public function deleteTag()
    {
        if ($this->tagToDelete) {
            $tag = BlogTag::find($this->tagToDelete);
            if ($tag) {
                $tag->posts()->detach();
                $tag->delete();
            }
            $this->showDeleteModal = false;
            $this->tagToDelete = null;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Tag deleted.');
        }
    }

    public function closeModals()
    {
        $this->showDeleteModal = false;
        $this->tagToDelete = null;
    }

    public function bulkDelete()
    {
        if (count($this->selectedTags) > 0) {
            $count = count($this->selectedTags);
            $tags = BlogTag::whereIn('id', $this->selectedTags)->get();
            foreach ($tags as $tag) {
                $tag->posts()->detach();
                $tag->delete();
            }
            $this->selectedTags = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: $count . ' tags deleted.');
        }
    }

    public function bulkActivate()
    {
        if (count($this->selectedTags) > 0) {
            BlogTag::whereIn('id', $this->selectedTags)->update(['is_active' => true]);
            $this->selectedTags = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Tags activated.');
        }
    }

    public function bulkDeactivate()
    {
        if (count($this->selectedTags) > 0) {
            BlogTag::whereIn('id', $this->selectedTags)->update(['is_active' => false]);
            $this->selectedTags = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Tags deactivated.');
        }
    }

    public function getTagsProperty()
    {
        return BlogTag::query()
            ->withCount('posts')
            ->when($this->search, function($q) {
                $q->where(function($sq) {
                    $sq->where('bt_name', 'like', "%{$this->search}%")
                       ->orWhere('bt_description', 'like', "%{$this->search}%");
                });
            })
            ->when($this->statusFilter !== '', fn($q) => $q->where('is_active', (int) $this->statusFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.blog.tag-list', [
            'tags' => $this->getTagsProperty(),
        ]);
    }
}