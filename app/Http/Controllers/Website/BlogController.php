<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\BlogComment;
use App\Models\SEO\SeoData;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $seo = SeoData::where('seo_page_type', 'blog')->first();
        
        $posts = BlogPost::published()
            ->with(['category', 'author', 'tags'])
            ->latest('published_at');
            
        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $posts->where(function($q) use ($search) {
                $q->where('bp_title', 'like', "%{$search}%")
                  ->orWhere('bp_excerpt', 'like', "%{$search}%")
                  ->orWhere('bp_content', 'like', "%{$search}%");
            });
        }
        
        $posts = $posts->paginate(9);
        
        $featuredPosts = BlogPost::published()
            ->featured()
            ->latest('published_at')
            ->take(3)
            ->get();
            
        $categories = BlogCategory::active()
            ->withCount(['posts' => function($q) {
                $q->published();
            }])
            ->get();
            
        $tags = BlogTag::has('posts', '>', 0)->get();
        
        $trendingPosts = BlogPost::published()
            ->trending()
            ->take(5)
            ->get();
        
        return view('website.blog.index', compact(
            'posts', 'featuredPosts', 'categories', 'tags', 'trendingPosts', 'seo'
        ));
    }

    public function show($slug)
    {
        $post = BlogPost::published()
            ->where('bp_slug', $slug)
            ->with(['category', 'author', 'tags', 'comments' => function($q) {
                $q->approved()->whereNull('parent_id')->with('replies');
            }])
            ->firstOrFail();
        
        $post->incrementViews();
        
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->latest('published_at')
            ->take(3)
            ->get();
        
        $seo = new SeoData([
            'seo_title' => $post->meta_title ?? $post->bp_title,
            'seo_description' => $post->meta_description ?? $post->bp_excerpt,
            'seo_keywords' => $post->meta_keywords,
            'seo_canonical' => $post->canonical_url ?? url()->current(),
            'seo_og_image' => $post->og_image,
            'seo_schema_markup' => $post->schema_markup,
        ]);
        
        return view('website.blog.show', compact('post', 'relatedPosts', 'seo'));
    }

    public function category($slug)
    {
        $category = BlogCategory::where('bc_slug', $slug)->firstOrFail();
        
        $posts = BlogPost::published()
            ->where('category_id', $category->id)
            ->with(['author', 'tags'])
            ->latest('published_at')
            ->paginate(9);
        
        $seo = new SeoData([
            'seo_title' => $category->meta_title ?? $category->bc_name . ' - Blog Categories',
            'seo_description' => $category->meta_description ?? 'Browse all posts in ' . $category->bc_name,
        ]);
        
        return view('website.blog.category', compact('category', 'posts', 'seo'));
    }

    public function tag($slug)
    {
        $tag = BlogTag::where('bt_slug', $slug)->firstOrFail();
        
        $posts = BlogPost::published()
            ->whereHas('tags', function($q) use ($tag) {
                $q->where('blog_tags.id', $tag->id);
            })
            ->with(['category', 'author'])
            ->latest('published_at')
            ->paginate(9);
        
        return view('website.blog.tag', compact('tag', 'posts'));
    }

    public function search(Request $request)
    {
        $search = $request->q;
        
        $posts = BlogPost::published()
            ->where(function($q) use ($search) {
                $q->where('bp_title', 'like', "%{$search}%")
                  ->orWhere('bp_excerpt', 'like', "%{$search}%")
                  ->orWhere('bp_content', 'like', "%{$search}%");
            })
            ->with(['category', 'author'])
            ->latest('published_at')
            ->paginate(12);
        
        return view('website.blog.search', compact('posts', 'search'));
    }

    public function author($id)
    {
        $author = User::findOrFail($id);
        
        $posts = BlogPost::published()
            ->where('author_id', $id)
            ->with(['category', 'tags'])
            ->latest('published_at')
            ->paginate(9);
        
        return view('website.blog.author', compact('author', 'posts'));
    }

    public function storeComment(Request $request, $slug)
    {
        $request->validate([
            'commenter_name' => 'required|string|max:255',
            'commenter_email' => 'required|email|max:255',
            'comment_content' => 'required|string|min:5|max:1000',
        ]);
        
        $post = BlogPost::where('bp_slug', $slug)->firstOrFail();
        
        if (!$post->allow_comments) {
            return back()->with('error', 'Comments are disabled for this post.');
        }
        
        BlogComment::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'commenter_name' => $request->commenter_name,
            'commenter_email' => $request->commenter_email,
            'commenter_website' => $request->commenter_website,
            'comment_content' => $request->comment_content,
            'comment_status' => 'pending',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        
        return back()->with('success', 'Your comment has been submitted for review.');
    }
}