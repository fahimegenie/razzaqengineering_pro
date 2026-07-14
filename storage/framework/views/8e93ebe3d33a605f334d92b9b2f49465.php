<div class="blog-detail-wrapper">
    
    <!-- HERO -->
    <section class="bld-hero" wire:ignore>
        <div class="container bld-hero-content">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="bld-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li><a href="<?php echo e(route('blog.index')); ?>">Blog</a></li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post && $post->category): ?>
                                <li><a href="<?php echo e(route('blog.category', $post->category->bc_slug)); ?>"><?php echo e($post->category->bc_name); ?></a></li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <li class="active"><?php echo e($post->bp_title ?? 'Blog Detail'); ?></li>
                        </ol>
                    </nav>
                    <h1 class="bld-hero-title"><?php echo e($post->bp_title ?? 'Blog Detail'); ?></h1>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post): ?>
                        <div class="bld-hero-meta">
                            <span><i class="far fa-calendar-alt me-1"></i> <?php echo e($post->published_at?->format('M d, Y')); ?></span>
                            <span><i class="far fa-clock me-1"></i> <?php echo e($post->reading_time ?? 5); ?> min read</span>
                            <span><i class="far fa-eye me-1"></i> <?php echo e($post->views_count); ?> views</span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="bld-section">
        <div class="container">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="text-center py-5" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('bld-loading', get_defined_vars()); ?>wire:key="bld-loading">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                </div>
            <?php elseif($errorMessage): ?>
                <div class="alert alert-danger text-center rounded-3 border-0 shadow-sm" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('bld-error', get_defined_vars()); ?>wire:key="bld-error">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo $errorMessage; ?>

                    <a href="<?php echo e(route('blog.index')); ?>" class="btn btn-outline-danger btn-sm ms-3 rounded-pill">Back to Blog</a>
                </div>
            <?php elseif($post): ?>
                
                <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('bld-content-wrapper-{{ $post->id }}', get_defined_vars()); ?>wire:key="bld-content-wrapper-<?php echo e($post->id); ?>">
                    
                    <div class="row g-5">
                        
                        
                        <div class="col-lg-8" data-aos="fade-up">
                            
                            
                            <div class="bld-featured-img mb-4" wire:ignore>
                                <img src="<?php echo e($post->banner_url); ?>" alt="<?php echo e($post->bp_title); ?>" class="img-fluid rounded-3 shadow-sm" loading="lazy">
                            </div>
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->tags && $post->tags->count() > 0): ?>
                                <div class="bld-tags mb-3" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('post-tags-{{ $post->id }}', get_defined_vars()); ?>wire:key="post-tags-<?php echo e($post->id); ?>">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <a href="<?php echo e(route('blog.tag', $tag->bt_slug)); ?>" class="bld-tag" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('tag-{{ $tag->id }}', get_defined_vars()); ?>wire:key="tag-<?php echo e($tag->id); ?>"><?php echo e($tag->bt_name); ?></a>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            
                            <div class="bld-content" wire:ignore>
                                <?php echo $post->bp_content; ?>

                            </div>
                            
                            
                            <div class="bld-share mt-4 pt-3 border-top" wire:ignore>
                                <span class="fw-semibold me-3">Share:</span>
                                <a href="https://facebook.com/sharer/sharer.php?u=<?php echo e(url()->current()); ?>" target="_blank" class="bld-share-btn"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo e(url()->current()); ?>" target="_blank" class="bld-share-btn"><i class="fab fa-twitter"></i></a>
                                <a href="https://wa.me/?text=<?php echo e(urlencode($post->bp_title . ' ' . url()->current())); ?>" target="_blank" class="bld-share-btn"><i class="fab fa-whatsapp"></i></a>
                                <a href="https://linkedin.com/shareArticle?url=<?php echo e(url()->current()); ?>" target="_blank" class="bld-share-btn"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                            
                            
                            <div class="bld-comments mt-5" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('comments-section-block', get_defined_vars()); ?>wire:key="comments-section-block">
                                <h4 class="fw-bold mb-4">Comments (<?php echo e(count($comments)); ?>)</h4>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($comments)): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div class="bld-comment" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('comment-card-{{ $comment->id }}', get_defined_vars()); ?>wire:key="comment-card-<?php echo e($comment->id); ?>">
                                        <div class="d-flex gap-3">
                                            <img src="<?php echo e($comment->gravatar_url); ?>" alt="<?php echo e($comment->commenter_name); ?>" class="bld-comment-avatar">
                                            <div>
                                                <h6 class="fw-bold mb-1"><?php echo e($comment->commenter_name); ?></h6>
                                                <small class="text-muted"><?php echo e($comment->created_at->format('M d, Y')); ?></small>
                                                <p class="mt-2 mb-0"><?php echo e($comment->comment_content); ?></p>
                                            </div>
                                        </div>
                                        
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($comment->replies && $comment->replies->count() > 0): ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                <div class="bld-comment bld-comment-reply" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('reply-card-{{ $reply->id }}', get_defined_vars()); ?>wire:key="reply-card-<?php echo e($reply->id); ?>">
                                                    <div class="d-flex gap-3">
                                                        <img src="<?php echo e($reply->gravatar_url); ?>" alt="<?php echo e($reply->commenter_name); ?>" class="bld-comment-avatar">
                                                        <div>
                                                            <h6 class="fw-bold mb-1"><?php echo e($reply->commenter_name); ?></h6>
                                                            <small class="text-muted"><?php echo e($reply->created_at->format('M d, Y')); ?></small>
                                                            <p class="mt-2 mb-0"><?php echo e($reply->comment_content); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <?php else: ?>
                                    <p class="text-muted" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('no-comments-msg', get_defined_vars()); ?>wire:key="no-comments-msg">No comments yet. Be the first to comment!</p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                
                                <div class="bld-comment-form mt-4" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('comment-form-container', get_defined_vars()); ?>wire:key="comment-form-container">
                                    <h5 class="fw-bold mb-3">Leave a Comment</h5>
                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('comment_success')): ?>
                                        <div class="alert alert-success rounded-3 border-0" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('msg-success', get_defined_vars()); ?>wire:key="msg-success"><?php echo e(session('comment_success')); ?></div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('comment_error')): ?>
                                        <div class="alert alert-danger rounded-3 border-0" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('msg-error', get_defined_vars()); ?>wire:key="msg-error"><?php echo e(session('comment_error')); ?></div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    
                                    <form wire:submit.prevent="submitComment">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <input type="text" wire:model="commenter_name" class="form-control rounded-3" placeholder="Your Name" required>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['commenter_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" wire:model="commenter_email" class="form-control rounded-3" placeholder="Your Email" required>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['commenter_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                            <div class="col-12">
                                                <textarea wire:model="comment_content" class="form-control rounded-3" rows="4" placeholder="Your Comment" required></textarea>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['comment_content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                        
                        
                        <div class="col-lg-4" data-aos="fade-left" wire:ignore.self>
                            
                            
                            <div class="blog-sidebar-card mb-4" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('sidebar-categories-card', get_defined_vars()); ?>wire:key="sidebar-categories-card">
                                <h5 class="fw-bold mb-3"><i class="fas fa-folder text-success me-2"></i> Categories</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <a href="<?php echo e(route('blog.index')); ?>" class="blog-sidebar-link">All Categories</a>
                                    </li>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <li class="mb-2" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('sidebar-cat-{{ $cat->id }}', get_defined_vars()); ?>wire:key="sidebar-cat-<?php echo e($cat->id); ?>">
                                            <a href="<?php echo e(route('blog.category', $cat->bc_slug)); ?>" class="blog-sidebar-link">
                                                <?php echo e($cat->bc_name); ?>

                                                <span class="text-muted">(<?php echo e($cat->posts_count ?? 0); ?>)</span>
                                            </a>
                                        </li>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </ul>
                            </div>
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($recentPosts) > 0): ?>
                                <div class="blog-sidebar-card mb-4" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('sidebar-recent-card', get_defined_vars()); ?>wire:key="sidebar-recent-card">
                                    <h5 class="fw-bold mb-3"><i class="fas fa-clock text-success me-2"></i> Recent Posts</h5>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $recentPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <a href="<?php echo e(route('blog.detail', $rp->bp_slug)); ?>" class="blog-recent-item" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('sidebar-rp-{{ $rp->id }}', get_defined_vars()); ?>wire:key="sidebar-rp-<?php echo e($rp->id); ?>"  exec:ignore>
                                            <img src="<?php echo e($rp->image_url); ?>" alt="<?php echo e($rp->bp_title); ?>" loading="lazy">
                                            <div>
                                                <h6><?php echo e(Str::limit($rp->bp_title, 40)); ?></h6>
                                                <small><?php echo e($rp->published_at?->format('M d, Y')); ?></small>
                                            </div>
                                        </a>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($tags) > 0): ?>
                                <div class="blog-sidebar-card mb-4" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('sidebar-tags-card', get_defined_vars()); ?>wire:key="sidebar-tags-card">
                                    <h5 class="fw-bold mb-3"><i class="fas fa-tags text-success me-2"></i> Tags</h5>
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <a href="<?php echo e(route('blog.tag', $tag->bt_slug)); ?>" class="blog-tag-btn" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('sidebar-tag-{{ $tag->id }}', get_defined_vars()); ?>wire:key="sidebar-tag-<?php echo e($tag->id); ?>"><?php echo e($tag->bt_name); ?></a>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($relatedPosts) > 0): ?>
                                <div class="blog-sidebar-card" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('sidebar-related-card', get_defined_vars()); ?>wire:key="sidebar-related-card">
                                    <h5 class="fw-bold mb-3"><i class="fas fa-link text-success me-2"></i> Related Posts</h5>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <a href="<?php echo e(route('blog.detail', $rp->bp_slug)); ?>" class="blog-recent-item" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('sidebar-rel-{{ $rp->id }}', get_defined_vars()); ?>wire:key="sidebar-rel-<?php echo e($rp->id); ?>">
                                            <img src="<?php echo e($rp->image_url); ?>" alt="<?php echo e($rp->bp_title); ?>" loading="lazy">
                                            <div>
                                                <h6><?php echo e(Str::limit($rp->bp_title, 40)); ?></h6>
                                                <small><?php echo e($rp->published_at?->format('M d, Y')); ?></small>
                                            </div>
                                        </a>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/blog-detail-page.blade.php ENDPATH**/ ?>