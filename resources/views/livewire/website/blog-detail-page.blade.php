<div class="blog-detail-wrapper">
    
    <!-- HERO -->
    <section class="bld-hero" wire:ignore>
        <div class="container bld-hero-content">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="bld-breadcrumb">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li><a href="{{ route('blog.index') }}">Blog</a></li>
                            @if($post && $post->category)
                                <li><a href="{{ route('blog.category', $post->category->bc_slug) }}">{{ $post->category->bc_name }}</a></li>
                            @endif
                            <li class="active">{{ $post->bp_title ?? 'Blog Detail' }}</li>
                        </ol>
                    </nav>
                    <h1 class="bld-hero-title">{{ $post->bp_title ?? 'Blog Detail' }}</h1>
                    @if($post)
                        <div class="bld-hero-meta">
                            <span><i class="far fa-calendar-alt me-1"></i> {{ $post->published_at?->format('M d, Y') }}</span>
                            <span><i class="far fa-clock me-1"></i> {{ $post->reading_time ?? 5 }} min read</span>
                            <span><i class="far fa-eye me-1"></i> {{ $post->views_count }} views</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="bld-section">
        <div class="container">
            
            @if($isLoading)
                <div class="text-center py-5" wire:key="bld-loading">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                </div>
            @elseif($errorMessage)
                <div class="alert alert-danger text-center rounded-3 border-0 shadow-sm" wire:key="bld-error">
                    <i class="fas fa-exclamation-triangle me-2"></i> {!! $errorMessage !!}
                    <a href="{{ route('blog.index') }}" class="btn btn-outline-danger btn-sm ms-3 rounded-pill">Back to Blog</a>
                </div>
            @elseif($post)
                {{-- Hydration Safe Master Key --}}
                <div wire:key="bld-content-wrapper-{{ $post->id }}">
                    
                    <div class="row g-5">
                        
                        {{-- Main Content --}}
                        <div class="col-lg-8" data-aos="fade-up">
                            
                            {{-- Featured Image --}}
                            <div class="bld-featured-img mb-4" wire:ignore>
                                <img src="{{ $post->banner_url }}" alt="{{ $post->bp_title }}" class="img-fluid rounded-3 shadow-sm" loading="lazy">
                            </div>
                            
                            {{-- Tags --}}
                            @if($post->tags && $post->tags->count() > 0)
                                <div class="bld-tags mb-3" wire:key="post-tags-{{ $post->id }}">
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('blog.tag', $tag->bt_slug) }}" class="bld-tag" wire:key="tag-{{ $tag->id }}">{{ $tag->bt_name }}</a>
                                    @endforeach
                                </div>
                            @endif
                            
                            {{-- Content --}}
                            <div class="bld-content" wire:ignore>
                                {!! $post->bp_content !!}
                            </div>
                            
                            {{-- Share --}}
                            <div class="bld-share mt-4 pt-3 border-top" wire:ignore>
                                <span class="fw-semibold me-3">Share:</span>
                                <a href="https://facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="bld-share-btn"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank" class="bld-share-btn"><i class="fab fa-twitter"></i></a>
                                <a href="https://wa.me/?text={{ urlencode($post->bp_title . ' ' . url()->current()) }}" target="_blank" class="bld-share-btn"><i class="fab fa-whatsapp"></i></a>
                                <a href="https://linkedin.com/shareArticle?url={{ url()->current() }}" target="_blank" class="bld-share-btn"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                            
                            {{-- Comments Section --}}
                            <div class="bld-comments mt-5" wire:key="comments-section-block">
                                <h4 class="fw-bold mb-4">Comments ({{ count($comments) }})</h4>
                                @if(!empty($comments))
                                @foreach($comments as $comment)
                                    <div class="bld-comment" wire:key="comment-card-{{ $comment->id }}">
                                        <div class="d-flex gap-3">
                                            <img src="{{ $comment->gravatar_url }}" alt="{{ $comment->commenter_name }}" class="bld-comment-avatar">
                                            <div>
                                                <h6 class="fw-bold mb-1">{{ $comment->commenter_name }}</h6>
                                                <small class="text-muted">{{ $comment->created_at->format('M d, Y') }}</small>
                                                <p class="mt-2 mb-0">{{ $comment->comment_content }}</p>
                                            </div>
                                        </div>
                                        {{-- Replies --}}
                                        @if($comment->replies && $comment->replies->count() > 0)
                                            @foreach($comment->replies as $reply)
                                                <div class="bld-comment bld-comment-reply" wire:key="reply-card-{{ $reply->id }}">
                                                    <div class="d-flex gap-3">
                                                        <img src="{{ $reply->gravatar_url }}" alt="{{ $reply->commenter_name }}" class="bld-comment-avatar">
                                                        <div>
                                                            <h6 class="fw-bold mb-1">{{ $reply->commenter_name }}</h6>
                                                            <small class="text-muted">{{ $reply->created_at->format('M d, Y') }}</small>
                                                            <p class="mt-2 mb-0">{{ $reply->comment_content }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endforeach
                                @else
                                    <p class="text-muted" wire:key="no-comments-msg">No comments yet. Be the first to comment!</p>
                                @endif
                                
                                {{-- Comment Form --}}
                                <div class="bld-comment-form mt-4" wire:key="comment-form-container">
                                    <h5 class="fw-bold mb-3">Leave a Comment</h5>
                                    
                                    @if(session()->has('comment_success'))
                                        <div class="alert alert-success rounded-3 border-0" wire:key="msg-success">{{ session('comment_success') }}</div>
                                    @endif
                                    @if(session()->has('comment_error'))
                                        <div class="alert alert-danger rounded-3 border-0" wire:key="msg-error">{{ session('comment_error') }}</div>
                                    @endif
                                    
                                    <form wire:submit.prevent="submitComment">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <input type="text" wire:model="commenter_name" class="form-control rounded-3" placeholder="Your Name" required>
                                                @error('commenter_name') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" wire:model="commenter_email" class="form-control rounded-3" placeholder="Your Email" required>
                                                @error('commenter_email') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                            <div class="col-12">
                                                <textarea wire:model="comment_content" class="form-control rounded-3" rows="4" placeholder="Your Comment" required></textarea>
                                                @error('comment_content') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-gradient rounded-pill px-4 py-2 fw-semibold" wire:loading.attr="disabled">
                                                    <span wire:loading.remove wire:target="submitComment"><i class="fas fa-paper-plane me-2"></i> Submit Comment</span>
                                                    <span wire:loading wire:target="submitComment"><span class="spinner-border spinner-border-sm me-2"></span> Submitting...</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        
                        {{-- Sidebar --}}
                        <div class="col-lg-4" data-aos="fade-left" wire:ignore.self>
                            
                            {{-- Categories --}}
                            <div class="blog-sidebar-card mb-4" wire:key="sidebar-categories-card">
                                <h5 class="fw-bold mb-3"><i class="fas fa-folder text-success me-2"></i> Categories</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <a href="{{ route('blog.index') }}" class="blog-sidebar-link">All Categories</a>
                                    </li>
                                    @foreach($categories as $cat)
                                        <li class="mb-2" wire:key="sidebar-cat-{{ $cat->id }}">
                                            <a href="{{ route('blog.category', $cat->bc_slug) }}" class="blog-sidebar-link">
                                                {{ $cat->bc_name }}
                                                <span class="text-muted">({{ $cat->posts_count ?? 0 }})</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            
                            {{-- Recent Posts --}}
                            @if(count($recentPosts) > 0)
                                <div class="blog-sidebar-card mb-4" wire:key="sidebar-recent-card">
                                    <h5 class="fw-bold mb-3"><i class="fas fa-clock text-success me-2"></i> Recent Posts</h5>
                                    @foreach($recentPosts as $rp)
                                        <a href="{{ route('blog.detail', $rp->bp_slug) }}" class="blog-recent-item" wire:key="sidebar-rp-{{ $rp->id }}"  exec:ignore>
                                            <img src="{{ $rp->image_url }}" alt="{{ $rp->bp_title }}" loading="lazy">
                                            <div>
                                                <h6>{{ Str::limit($rp->bp_title, 40) }}</h6>
                                                <small>{{ $rp->published_at?->format('M d, Y') }}</small>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            
                            {{-- Tags --}}
                            @if(count($tags) > 0)
                                <div class="blog-sidebar-card mb-4" wire:key="sidebar-tags-card">
                                    <h5 class="fw-bold mb-3"><i class="fas fa-tags text-success me-2"></i> Tags</h5>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($tags as $tag)
                                            <a href="{{ route('blog.tag', $tag->bt_slug) }}" class="blog-tag-btn" wire:key="sidebar-tag-{{ $tag->id }}">{{ $tag->bt_name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            {{-- Related Posts --}}
                            @if(count($relatedPosts) > 0)
                                <div class="blog-sidebar-card" wire:key="sidebar-related-card">
                                    <h5 class="fw-bold mb-3"><i class="fas fa-link text-success me-2"></i> Related Posts</h5>
                                    @foreach($relatedPosts as $rp)
                                        <a href="{{ route('blog.detail', $rp->bp_slug) }}" class="blog-recent-item" wire:key="sidebar-rel-{{ $rp->id }}">
                                            <img src="{{ $rp->image_url }}" alt="{{ $rp->bp_title }}" loading="lazy">
                                            <div>
                                                <h6>{{ Str::limit($rp->bp_title, 40) }}</h6>
                                                <small>{{ $rp->published_at?->format('M d, Y') }}</small>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            
                        </div>
                        
                    </div>
                    
                </div>
            @endif
        </div>
    </section>

</div>

@push('styles')
<style>
    /* Aapka styling block unchanged aur safe hai */
    .bld-hero { background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%); min-height: 280px; display: flex; align-items: center; }
    .bld-hero-content { width: 100%; }
    .bld-breadcrumb { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px; }
    .bld-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .bld-breadcrumb li a { color: #fff; text-decoration: none; }
    .bld-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .bld-hero-title { color: #fff; font-size: 2.2rem; font-weight: 800; margin-bottom: 10px; }
    .bld-hero-meta { display: flex; flex-wrap: wrap; gap: 15px; color: rgba(255,255,255,0.75); font-size: 0.85rem; }
    .bld-section { padding: 50px 0; background: #f8f9fa; }
    .bld-featured-img img { width: 100%; max-height: 450px; object-fit: cover; }
    .bld-tag { font-size: 0.72rem; padding: 4px 14px; background: rgba(0,86,179,0.08); color: #0056b3; border-radius: 50px; text-decoration: none; font-weight: 600; margin-right: 6px; }
    .bld-content { font-size: 1rem; color: #444; line-height: 1.9; }
    .bld-share-btn { width: 36px; height: 36px; background: #f0f4f8; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #555; text-decoration: none; margin-right: 6px; transition: all 0.2s; }
    .bld-share-btn:hover { background: #0056b3; color: #fff; }
    .bld-comment { padding: 20px 0; border-bottom: 1px solid #eef0f2; }
    .bld-comment-reply { margin-left: 50px; }
    .bld-comment-avatar { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; }
    .blog-sidebar-card { background: #fff; border-radius: 14px; padding: 22px; box-shadow: 0 3px 15px rgba(0,0,0,0.03); border: 1px solid #eef0f2; }
    .blog-sidebar-link { color: #555; text-decoration: none; font-size: 0.88rem; transition: color 0.2s; display: block; padding: 4px 0; }
    .blog-sidebar-link:hover { color: #28a745; font-weight: 600; }
    .blog-recent-item { display: flex; align-items: center; gap: 10px; padding: 8px 0; border-bottom: 1px solid #f0f0f0; text-decoration: none; }
    .blog-recent-item:last-child { border-bottom: none; }
    .blog-recent-item img { width: 55px; height: 55px; border-radius: 8px; object-fit: cover; }
    .blog-recent-item h6 { font-size: 0.82rem; color: #0a1628; margin-bottom: 2px; }
    .blog-tag-btn { font-size: 0.72rem; padding: 5px 14px; background: #f0f4f8; color: #555; border-radius: 50px; text-decoration: none; font-weight: 500; transition: all 0.2s; }
    .blog-tag-btn:hover { background: #28a745; color: #fff; }
    @media (max-width: 767px) {
        .bld-hero { min-height: 200px; }
        .bld-hero-title { font-size: 1.5rem; }
        .bld-section { padding: 35px 0; }
        .bld-comment-reply { margin-left: 20px; }
    }
</style>
@endpush