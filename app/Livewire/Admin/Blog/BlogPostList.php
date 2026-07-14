<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Blog Posts - Admin Panel')]
class BlogPostList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $categoryFilter = '';
    public $authorFilter = '';
    public $featuredFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 12;
    public $selectedPosts = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $postToDelete = null;
    public $showViewModal = false;
    public $viewPost = null;

    public $totalPosts = 0;
    public $publishedPosts = 0;
    public $draftPosts = 0;
    public $totalViews = 0;
    public $categories = [];

    public function mount()
    {
        $this->loadStats();
        $this->categories = BlogCategory::active()->orderBy('bc_name')->get();
    }

    public function loadStats()
    {
        $this->totalPosts = BlogPost::count();
        $this->publishedPosts = BlogPost::where('bp_status', 'published')->count();
        $this->draftPosts = BlogPost::where('bp_status', 'draft')->count();
        $this->totalViews = BlogPost::sum('views_count') ?? 0;
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedCategoryFilter() { $this->resetPage(); }
    public function updatedAuthorFilter() { $this->resetPage(); }
    public function updatedFeaturedFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedPosts = $this->selectAll 
            ? $this->getPostsProperty()->pluck('id')->toArray() 
            : [];
    }

    public function togglePostSelection($postId)
    {
        if (in_array($postId, $this->selectedPosts)) {
            $this->selectedPosts = array_values(array_diff($this->selectedPosts, [$postId]));
            $this->selectAll = false;
        } else {
            $this->selectedPosts[] = $postId;
        }
    }

    public function clearSearch() { $this->search = ''; $this->resetPage(); }
    
    public function clearFilters()
    {
        $this->search = '';
        $this->statusFilter = '';
        $this->categoryFilter = '';
        $this->authorFilter = '';
        $this->featuredFilter = '';
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

    #[On('post-created'), On('post-updated')]
    public function refreshList()
    {
        $this->resetPage();
        $this->loadStats();
    }

    public function toggleFeatured($postId)
    {
        $post = BlogPost::find($postId);
        if ($post) {
            $post->update(['is_featured' => !$post->is_featured]);
            $this->dispatch('toast', type: 'success', message: 'Featured status updated.');
        }
    }

    public function toggleTrending($postId)
    {
        $post = BlogPost::find($postId);
        if ($post) {
            $post->update(['is_trending' => !$post->is_trending]);
            $this->dispatch('toast', type: 'success', message: 'Trending status updated.');
        }
    }

    public function confirmDelete($postId)
    {
        $this->postToDelete = $postId;
        $this->showDeleteModal = true;
    }

    public function deletePost()
    {
        if ($this->postToDelete) {
            $post = BlogPost::find($this->postToDelete);
            if ($post) {
                if ($post->featured_image) {
                    @unlink(public_path('uploads/blog/' . $post->featured_image));
                }
                if ($post->banner_image) {
                    @unlink(public_path('uploads/blog/banners/' . $post->banner_image));
                }
                $post->tags()->detach();
                $post->delete();
            }
            $this->showDeleteModal = false;
            $this->postToDelete = null;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Post deleted.');
        }
    }

    public function viewPostDetails($postId)
    {
        $this->viewPost = BlogPost::with(['category', 'author', 'tags'])->find($postId);
        $this->showViewModal = true;
    }

    public function closeModals()
    {
        $this->showDeleteModal = false;
        $this->showViewModal = false;
        $this->postToDelete = null;
        $this->viewPost = null;
    }

    public function bulkDelete()
    {
        if (count($this->selectedPosts) > 0) {
            $count = count($this->selectedPosts);
            $posts = BlogPost::whereIn('id', $this->selectedPosts)->get();
            foreach ($posts as $post) {
                @unlink(public_path('uploads/blog/' . $post->featured_image));
                @unlink(public_path('uploads/blog/banners/' . $post->banner_image));
                $post->tags()->detach();
                $post->delete();
            }
            $this->selectedPosts = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: $count . ' posts deleted.');
        }
    }

    public function bulkPublish()
    {
        if (count($this->selectedPosts) > 0) {
            BlogPost::whereIn('id', $this->selectedPosts)->update([
                'bp_status' => 'published',
                'published_at' => now(),
            ]);
            $this->selectedPosts = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Posts published.');
        }
    }

    public function getPostsProperty()
    {
        return BlogPost::query()
            ->with(['category', 'author', 'tags'])
            ->withCount(['comments' => fn($q) => $q->approved()])
            ->when($this->search, function($q) {
                $q->where(function($sq) {
                    $sq->where('bp_title', 'like', "%{$this->search}%")
                       ->orWhere('bp_excerpt', 'like', "%{$this->search}%")
                       ->orWhere('bp_content', 'like', "%{$this->search}%");
                });
            })
            ->when($this->statusFilter !== '', fn($q) => $q->where('bp_status', $this->statusFilter))
            ->when($this->categoryFilter !== '', fn($q) => $q->where('category_id', $this->categoryFilter))
            ->when($this->authorFilter !== '', fn($q) => $q->where('author_id', $this->authorFilter))
            ->when($this->featuredFilter !== '', fn($q) => $q->where('is_featured', (int) $this->featuredFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.blog.post-list', [
            'posts' => $this->getPostsProperty(),
        ]);
    }
}