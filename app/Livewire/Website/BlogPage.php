<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\SeoData;
use App\Models\Service;
use App\Models\ProductCategory;
use App\Traits\HasDynamicSEO;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app-layout', ['seo' => []])]
#[Title('Blog - Razzaq Engineering Services')]
class BlogPage extends Component
{
    use WithPagination, HasDynamicSEO;

    public $search = '';
    public $selectedCategory = 'all';
    public $selectedCategorySlug = null;
    public $selectedTag = 'all';
    public $selectedTagSlug = null;
    public $isLoading = true;
    public $errorMessage = '';

    public $categories = [];
    public $tags = [];
    public $recentPosts = [];
    public $seo = null;
    public $services = [];
    public $pc = [];

    public $loadedCount = 6;
    public $totalCount = 0;

    public function mount($category = null, $tag = null)
    {
        try {
            $this->isLoading = true;

            $this->initializeSEO('blog');

            // Handle category from URL
            if ($category) {
                $this->selectedCategorySlug = $category;
                $cat = BlogCategory::where('bc_slug', $category)->active()->first();
                if ($cat) {
                    $this->selectedCategory = $cat->id;
                }
            }

            // Handle tag from URL
            if ($tag) {
                $this->selectedTagSlug = $tag;
                $t = BlogTag::where('bt_slug', $tag)->first();
                if ($t) {
                    $this->selectedTag = $t->id;
                }
            }

            $this->seo = SeoData::where('seo_page_type', 'Blog')->first();
            
            // ✅ FIX: Use ordered() scope
            $this->categories = BlogCategory::active()->ordered()->get();
            
            $this->tags = BlogTag::where('is_active', 1)->orderBy('sort_order')->get();
            $this->recentPosts = BlogPost::published()->latest()->limit(5)->get();
            $this->services = Service::active()->ordered()->get();
            $this->pc = ProductCategory::active()->select('pc_name')->get();

            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load blog.';
            $this->isLoading = false;
            Log::error('BlogPage error: ' . $e->getMessage());
        }
    }

    /**
     * Computed property for posts
     */
    public function getPostsProperty()
    {
        $query = BlogPost::published()->with(['category', 'tags']);

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('bp_title', 'like', '%' . $this->search . '%')
                  ->orWhere('bp_excerpt', 'like', '%' . $this->search . '%')
                  ->orWhere('bp_content', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedCategory !== 'all') {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->selectedTag !== 'all') {
            $query->whereHas('tags', function ($q) {
                $q->where('blog_tags.id', $this->selectedTag);
            });
        }

        $this->totalCount = $query->count();
        return $query->latest()->take($this->loadedCount)->get();
    }

    /**
     * Filter by category
     */
    public function filterByCategory($catId)
    {
        $this->selectedCategory = $catId;
        $this->loadedCount = 6;
    }

    /**
     * Filter by tag
     */
    public function filterByTag($tagId)
    {
        $this->selectedTag = $tagId;
        $this->loadedCount = 6;
    }

    /**
     * Updated search handler
     */
    public function updatedSearch()
    {
        $this->loadedCount = 6;
    }

    /**
     * Load more posts
     */
    public function loadMore()
    {
        $this->loadedCount += 6;
    }

    /**
     * Clear all filters
     */
    public function clearFilters()
    {
        $this->search = '';
        $this->selectedCategory = 'all';
        $this->selectedTag = 'all';
        $this->loadedCount = 6;
    }

    public function render()
    {
        $seo = $this->getSeoData();
        
        return view('livewire.website.blog-page', [
            'posts' => $this->posts,
        ])->layoutData(['seo' => $seo]);
    }
}