<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\BlogComment;
use App\Models\SeoData;
use App\Models\Service;
use App\Models\ProductCategory;
use App\Traits\HasDynamicSEO;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app-layout', ['seo' => []])]
class BlogDetailPage extends Component
{

    use HasDynamicSEO;

    public $slug;
    public $isLoading = false;
    public $errorMessage = '';

    // Comment form fields
    public $commenter_name = '';
    public $commenter_email = '';
    public $comment_content = '';

    public function mount($slug)
    {
        $this->slug = $slug;
        
        $this->initializeSEO('blog_detail');
        // Views increment call mount mein hi theek hai taake page hit par sirf ek baar chale
        try {
            $post = BlogPost::where('bp_slug', $slug)->published()->first();
            if ($post) {
                $post->incrementViews();
            } else {
                $this->errorMessage = 'Blog post not found. <a href="' . route('blog.index') . '">Browse all posts</a>';
            }
        } catch (\Exception $e) {
            Log::error('BlogDetail View Increment error: ' . $e->getMessage());
        }
    }

    /**
     * Submit a comment
     */
    public function submitComment()
    {
        $this->validate([
            'commenter_name' => 'required|min:3|max:255',
            'commenter_email' => 'required|email|max:255',
            'comment_content' => 'required|min:5|max:2000',
        ]);

        try {
            // Re-fetch post safely to ensure we have the correct ID
            $post = BlogPost::where('bp_slug', $this->slug)->published()->first();

            if (!$post) {
                session()->flash('comment_error', 'Something went wrong. Post not found.');
                return;
            }

            BlogComment::create([
                'post_id'         => $post->id,
                'commenter_name'  => $this->commenter_name,
                'commenter_email' => $this->commenter_email,
                'comment_content' => $this->comment_content,
                'comment_status'  => 'approved', // Auto-approve
                'ip_address'      => request()->ip(),
                'user_agent'      => request()->userAgent(),
            ]);

            // Form clear karein
            $this->reset(['commenter_name', 'commenter_email', 'comment_content']);

            session()->flash('comment_success', 'Comment posted successfully!');

        } catch (\Exception $e) {
            Log::error('Comment submit error: ' . $e->getMessage());
            session()->flash('comment_error', 'Failed to submit comment. Please try again.');
        }
    }

    /**
     * Dynamic and Hydration-Safe Rendering
     */
    #[Title('Blog Details - Razzaq Engineering Services')]
    public function render()
    {
        // 1. Fetch Post with relations
        $post = BlogPost::where('bp_slug', $this->slug)
            ->published()
            ->with(['category', 'tags'])
            ->first();

        // 2. Fetch Comments separately to avoid nesting level hydration bugs
        $comments = [];
        $relatedPosts = [];
        
        if ($post) {
            $comments = BlogComment::approved()
                ->where('post_id', $post->id)
                ->whereNull('parent_id')
                ->with('replies')
                ->latest()
                ->get();

            // 3. Related Posts
            $relatedPosts = BlogPost::published()
                ->where('id', '!=', $post->id)
                ->where(function ($q) use ($post) {
                    $q->where('category_id', $post->category_id)
                      ->orWhereHas('tags', function ($q2) use ($post) {
                          $tagIds = $post->tags->pluck('id')->toArray();
                          if (!empty($tagIds)) {
                              $q2->whereIn('blog_tags.id', $tagIds);
                          }
                      });
                })
                ->latest()
                ->limit(3)
                ->get();
        }

        // 4. Sidebar Collections
        $categories = BlogCategory::active()->withCount(['posts' => function($query) {
            $query->published();
        }])->ordered()->get();
        
        $tags = BlogTag::where('is_active', 1)->orderBy('sort_order')->get();
        
        $recentPosts = BlogPost::published()
            ->when($post, function($q) use ($post) {
                return $q->where('id', '!=', $post->id);
            })
            ->latest()
            ->limit(4)
            ->get();

        $seo = $this->getSeoData();

        return view('livewire.website.blog-detail-page', [
            'post'         => $post,
            'comments'     => $comments,
            'categories'   => $categories,
            'tags'         => $tags,
            'recentPosts'  => $recentPosts,
            'relatedPosts' => $relatedPosts,
            'services'     => Service::active()->ordered()->get(),
            'pc'           => ProductCategory::active()->select('pc_name')->get(),
            'seo'          => SeoData::where('seo_page_type', 'Blog_detail')->first(),
        ])->layoutData(['seo' => $seo]);
    }
}