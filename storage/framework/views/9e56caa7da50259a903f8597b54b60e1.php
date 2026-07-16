<div class="blog-page-wrapper"
     x-data="{
        observer: null,
        init() {
            this.$nextTick(() => { this.setupObserver(); });
        },
        setupObserver() {
            if (this.observer) this.observer.disconnect();
            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && $wire.totalCount > $wire.loadedCount) $wire.loadMore();
                });
            }, { threshold: 0.1 });
            const sentinel = this.$refs.loadMoreSentinel;
            if (sentinel) this.observer.observe(sentinel);
        }
     }">
    
    <!-- HERO -->
    <section class="blog-hero" wire:ignore>
        <div class="container blog-hero-content">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="blog-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Blog</li>
                        </ol>
                    </nav>
                    <h1 class="blog-hero-title">Our Blog</h1>
                    <p class="blog-hero-subtitle">Insights, guides & industry updates from our engineering experts</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="blog-section">
        <div class="container">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="text-center py-5" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'blog-loading'; ?>wire:key="blog-loading">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                </div>
            <?php elseif($errorMessage): ?>
                <div class="alert alert-danger text-center rounded-3 border-0 shadow-sm" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'blog-error'; ?>wire:key="blog-error">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e($errorMessage); ?>

                </div>
            <?php else: ?>
                <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'blog-main-content'; ?>wire:key="blog-main-content">
                    
                    <div class="row g-5">
                        
                        
                        <div class="col-lg-8">
                            
                            
                            <div class="blog-search mb-4" data-aos="fade-up" wire:ignore.self>
                                <div class="position-relative">
                                    <i class="fas fa-search position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
                                    <input type="text" class="form-control form-control-lg ps-5 rounded-3 border-2"
                                           wire:model.live.debounce.400ms="search" placeholder="Search articles...">
                                </div>
                            </div>
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($posts->count() > 0): ?>
                                <div class="blog-posts" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'blog-posts-'.e(md5($search.$selectedCategory.$selectedTag)).''; ?>wire:key="blog-posts-<?php echo e(md5($search.$selectedCategory.$selectedTag)); ?>">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="blog-post-card mb-4" data-aos="fade-up" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'post-'.e($post->id).''; ?>wire:key="post-<?php echo e($post->id); ?>">
                                            <div class="row g-4">
                                                <div class="col-md-5" wire:ignore>
                                                    <a href="<?php echo e(route('blog.detail', $post->bp_slug)); ?>" class="blog-post-img-link">
                                                        <img src="<?php echo e($post->image_url); ?>" alt="<?php echo e($post->bp_title); ?>" class="blog-post-img rounded-3" loading="lazy">
                                                    </a>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="blog-post-meta mb-2">
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->category): ?>
                                                            <a href="?category=<?php echo e($post->category->bc_slug); ?>" class="blog-cat-tag"><?php echo e($post->category->bc_name); ?></a>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        <span class="blog-date"><i class="far fa-calendar-alt me-1"></i> <?php echo e($post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y')); ?></span>
                                                        <span class="blog-read-time"><i class="far fa-clock me-1"></i> <?php echo e($post->reading_time ?? 5); ?> min read</span>
                                                    </div>
                                                    <h3 class="blog-post-title">
                                                        <a href="<?php echo e(route('blog.detail', $post->bp_slug)); ?>"><?php echo e($post->bp_title); ?></a>
                                                    </h3>
                                                    <p class="blog-post-excerpt"><?php echo e(Str::limit($post->bp_excerpt ?? strip_tags($post->bp_content), 180)); ?></p>
                                                    <a href="<?php echo e(route('blog.detail', $post->bp_slug)); ?>" class="blog-read-more">
                                                        Read More <i class="fas fa-arrow-right ms-1"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                                
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalCount > $loadedCount): ?>
                                    <div x-ref="loadMoreSentinel" class="text-center py-3">
                                        <button wire:click="loadMore" class="btn btn-outline-success rounded-pill px-5 py-2 fw-semibold">
                                            <span wire:loading.remove wire:target="loadMore">Load More <i class="fas fa-chevron-down ms-2"></i></span>
                                            <span wire:loading wire:target="loadMore"><span class="spinner-border spinner-border-sm me-2"></span> Loading...</span>
                                        </button>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-newspaper fa-3x text-muted opacity-25 mb-3"></i>
                                    <h5 class="fw-bold">No Articles Found</h5>
                                    <p class="text-muted">Try different search terms.</p>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                        </div>
                        
                        
                        <div class="col-lg-4" data-aos="fade-left">
                            
                            
                            <div class="blog-sidebar-card mb-4">
                                <h5 class="fw-bold mb-3"><i class="fas fa-folder text-success me-2"></i> Categories</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <a href="#" wire:click.prevent="filterByCategory('all')" class="blog-sidebar-link <?php echo e($selectedCategory === 'all' ? 'active' : ''); ?>">
                                            All Categories
                                        </a>
                                    </li>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <li class="mb-2">
                                            <a href="#" wire:click.prevent="filterByCategory('<?php echo e($cat->id); ?>')" class="blog-sidebar-link <?php echo e($selectedCategory == $cat->id ? 'active' : ''); ?>">
                                                <?php echo e($cat->bc_name); ?> <span class="text-muted">(<?php echo e($cat->posts_count); ?>)</span>
                                            </a>
                                        </li>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </ul>
                            </div>
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recentPosts->count() > 0): ?>
                                <div class="blog-sidebar-card mb-4">
                                    <h5 class="fw-bold mb-3"><i class="fas fa-clock text-success me-2"></i> Recent Posts</h5>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $recentPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <a href="<?php echo e(route('blog.detail', $rp->bp_slug)); ?>" class="blog-recent-item">
                                            <img src="<?php echo e($rp->image_url); ?>" alt="<?php echo e($rp->bp_title); ?>" loading="lazy">
                                            <div>
                                                <h6><?php echo e(Str::limit($rp->bp_title, 40)); ?></h6>
                                                <small><?php echo e($rp->published_at?->format('M d, Y')); ?></small>
                                            </div>
                                        </a>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tags->count() > 0): ?>
                                <div class="blog-sidebar-card">
                                    <h5 class="fw-bold mb-3"><i class="fas fa-tags text-success me-2"></i> Tags</h5>
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <a href="#" wire:click.prevent="filterByTag('<?php echo e($tag->id); ?>')" 
                                               class="blog-tag-btn <?php echo e($selectedTag == $tag->id ? 'active' : ''); ?>">
                                                <?php echo e($tag->bt_name); ?>

                                            </a>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                        </div>
                        
                    </div>
                    
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

</div>

<?php $__env->startPush('styles'); ?>
<style>
    .blog-hero { background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%); min-height: 250px; display: flex; align-items: center; }
    .blog-hero-content { width: 100%; }
    .blog-breadcrumb { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 10px; }
    .blog-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .blog-breadcrumb li a { color: #fff; text-decoration: none; }
    .blog-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .blog-hero-title { color: #fff; font-size: 2.5rem; font-weight: 800; }
    .blog-hero-subtitle { color: rgba(255,255,255,0.8); font-size: 1rem; }
    .blog-section { padding: 60px 0; background: #f8f9fa; }

    .blog-post-card { background: #fff; border-radius: 16px; padding: 20px; box-shadow: 0 3px 20px rgba(0,0,0,0.04); border: 1px solid #eef0f2; transition: all 0.3s; }
    .blog-post-card:hover { box-shadow: 0 10px 35px rgba(0,0,0,0.08); }
    .blog-post-img-link { display: block; border-radius: 12px; overflow: hidden; }
    .blog-post-img { width: 100%; height: 220px; object-fit: cover; transition: transform 0.5s; }
    .blog-post-img-link:hover .blog-post-img { transform: scale(1.03); }
    .blog-post-meta { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; font-size: 0.78rem; color: #888; }
    .blog-cat-tag { background: rgba(0,86,179,0.08); color: #0056b3; padding: 3px 12px; border-radius: 50px; font-weight: 600; text-decoration: none; font-size: 0.72rem; }
    .blog-post-title { font-size: 1.2rem; font-weight: 700; margin-bottom: 8px; }
    .blog-post-title a { color: #0a1628; text-decoration: none; }
    .blog-post-title a:hover { color: #0056b3; }
    .blog-post-excerpt { font-size: 0.88rem; color: #888; line-height: 1.6; margin-bottom: 10px; }
    .blog-read-more { font-size: 0.85rem; font-weight: 600; color: #28a745; text-decoration: none; }
    .blog-read-more:hover { color: #1e7e34; }

    .blog-sidebar-card { background: #fff; border-radius: 14px; padding: 22px; box-shadow: 0 3px 15px rgba(0,0,0,0.03); border: 1px solid #eef0f2; }
    .blog-sidebar-link { color: #555; text-decoration: none; font-size: 0.88rem; transition: color 0.2s; display: block; padding: 4px 0; }
    .blog-sidebar-link:hover, .blog-sidebar-link.active { color: #28a745; font-weight: 600; }
    .blog-recent-item { display: flex; align-items: center; gap: 10px; padding: 8px 0; border-bottom: 1px solid #f0f0f0; text-decoration: none; }
    .blog-recent-item:last-child { border-bottom: none; }
    .blog-recent-item img { width: 55px; height: 55px; border-radius: 8px; object-fit: cover; }
    .blog-recent-item h6 { font-size: 0.82rem; color: #0a1628; margin-bottom: 2px; }
    .blog-tag-btn { font-size: 0.72rem; padding: 5px 14px; background: #f0f4f8; color: #555; border-radius: 50px; text-decoration: none; font-weight: 500; transition: all 0.2s; }
    .blog-tag-btn:hover, .blog-tag-btn.active { background: #28a745; color: #fff; }

    @media (max-width: 767px) {
        .blog-hero { min-height: 180px; }
        .blog-hero-title { font-size: 1.6rem; }
        .blog-section { padding: 40px 0; }
        .blog-post-img { height: 180px; }
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/blog-page.blade.php ENDPATH**/ ?>