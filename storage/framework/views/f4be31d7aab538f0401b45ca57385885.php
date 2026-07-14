<div class="testimonials-page-wrapper"
     x-data="{
        observer: null,
        init() {
            this.$nextTick(() => { this.setupObserver(); });
        },
        setupObserver() {
            if (this.observer) this.observer.disconnect();
            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && $wire.hasMore) $wire.loadMore();
                });
            }, { threshold: 0.1 });
            const sentinel = this.$refs.loadMoreSentinel;
            if (sentinel) this.observer.observe(sentinel);
        }
     }">
    
    <!-- HERO -->
    <section class="testi-hero" wire:ignore>
        <div class="container testi-hero-content">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="testi-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Testimonials</li>
                        </ol>
                    </nav>
                    <h1 class="testi-hero-title">Client Testimonials</h1>
                    <p class="testi-hero-subtitle">What our valued clients say about our services</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="testi-section">
        <div class="container">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="text-center py-5" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('testi-loading', get_defined_vars()); ?>wire:key="testi-loading">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-2">Loading testimonials...</p>
                </div>
            <?php elseif($errorMessage): ?>
                <div class="alert alert-danger text-center rounded-3 border-0 shadow-sm" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('testi-error', get_defined_vars()); ?>wire:key="testi-error">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e($errorMessage); ?>

                </div>
            <?php else: ?>
                <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('testi-main-content', get_defined_vars()); ?>wire:key="testi-main-content">
                    
                    
                    <div class="testi-stats-bar" data-aos="fade-up" wire:ignore.self>
                        <div class="row g-3 text-center">
                            <div class="col-md-4">
                                <div class="testi-stat-item">
                                    <span class="testi-stat-number"><?php echo e($totalTestimonials); ?>+</span>
                                    <span class="testi-stat-label">Happy Clients</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="testi-stat-item">
                                    <span class="testi-stat-number"><?php echo e($averageRating); ?></span>
                                    <span class="testi-stat-label">
                                        Average Rating
                                        <div class="testi-stars-small">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                <i class="fas fa-star<?php echo e($i <= round($averageRating) ? ' text-warning' : ' text-muted'); ?> small"></i>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="testi-stat-item">
                                    <span class="testi-stat-number"><?php echo e(count($cities)); ?>+</span>
                                    <span class="testi-stat-label">Cities Served</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="testi-filters" data-aos="fade-up" wire:ignore.self>
                        <div class="row g-3 align-items-end mb-5">
                            <div class="col-md-5">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Search</label>
                                <div class="position-relative">
                                    <i class="fas fa-search position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
                                    <input type="text" class="form-control ps-5 py-2 rounded-3"
                                           wire:model.live.debounce.300ms="search" placeholder="Search testimonials...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Rating</label>
                                <select class="form-select py-2 rounded-3" wire:model.live="filterRating">
                                    <option value="all">All Ratings</option>
                                    <option value="5">★★★★★ (5)</option>
                                    <option value="4">★★★★☆ (4)</option>
                                    <option value="3">★★★☆☆ (3)</option>
                                    <option value="2">★★☆☆☆ (2)</option>
                                    <option value="1">★☆☆☆☆ (1)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold small text-uppercase text-muted">City</label>
                                <select class="form-select py-2 rounded-3" wire:model.live="filterCity">
                                    <option value="all">All Cities</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <option value="<?php echo e($city); ?>"><?php echo e($city); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search || $filterRating !== 'all' || $filterCity !== 'all'): ?>
                                    <button class="btn btn-outline-secondary btn-sm w-100 rounded-3" wire:click="clearFilters">
                                        <i class="fas fa-redo"></i>
                                    </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    
                    <?php $displayed = $this->displayedTestimonials; ?>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($displayed->count() > 0): ?>
                        <div class="testi-grid" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('testi-grid-{{ md5($search.$filterRating.$filterCity) }}', get_defined_vars()); ?>wire:key="testi-grid-<?php echo e(md5($search.$filterRating.$filterCity)); ?>">
                            <div class="row g-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $displayed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div class="col-lg-4 col-md-6" 
                                         data-aos="fade-up" 
                                         data-aos-delay="<?php echo e($loop->index % 3 * 100); ?>"
                                         <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('testi-item-{{ $item->id }}', get_defined_vars()); ?>wire:key="testi-item-<?php echo e($item->id); ?>">
                                        <div class="testi-card">
                                            
                                            
                                            <div class="testi-rating mb-2">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                    <i class="fas fa-star<?php echo e($i <= $item->t_rating ? ' text-warning' : ' text-muted'); ?>"></i>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                            </div>
                                            
                                            
                                            <p class="testi-content">
                                                <i class="fas fa-quote-left text-success opacity-25 me-1"></i>
                                                <?php echo e(Str::limit($item->t_content, 200)); ?>

                                            </p>
                                            
                                            
                                            <div class="testi-author">
                                                <div class="testi-author-avatar" wire:ignore>
                                                    <img src="<?php echo e($item->image_url); ?>" 
                                                         alt="<?php echo e($item->t_name); ?>" 
                                                         class="testi-avatar-img" loading="lazy">
                                                </div>
                                                <div class="testi-author-info">
                                                    <h5 class="testi-author-name"><?php echo e($item->t_name); ?></h5>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->t_designation): ?>
                                                        <span class="testi-author-role"><?php echo e($item->t_designation); ?></span>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->t_company): ?>
                                                        <span class="testi-author-company">@ <?php echo e($item->t_company); ?></span>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="testi-meta mt-2">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->t_location): ?>
                                                    <span class="testi-location">
                                                        <i class="fas fa-map-marker-alt text-danger me-1"></i> <?php echo e($item->t_location); ?>

                                                    </span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->service): ?>
                                                    <span class="testi-service">
                                                        <i class="fas fa-tools text-primary me-1"></i> <?php echo e($item->service->os_name); ?>

                                                    </span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                            
                                        </div>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                        
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->filteredTestimonials->count() > $loadedCount): ?>
                            <div x-ref="loadMoreSentinel" class="text-center py-4" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('sentinel-wrapper', get_defined_vars()); ?>wire:key="sentinel-wrapper">
                                <button wire:click="loadMore" wire:loading.attr="disabled"
                                        class="btn btn-outline-success rounded-pill px-5 py-2 fw-semibold">
                                    <span wire:loading.remove wire:target="loadMore">Load More <i class="fas fa-chevron-down ms-2"></i></span>
                                    <span wire:loading wire:target="loadMore"><span class="spinner-border spinner-border-sm me-2"></span> Loading...</span>
                                </button>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                    <?php else: ?>
                        <div class="text-center py-5" data-aos="fade-up" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('testi-empty', get_defined_vars()); ?>wire:key="testi-empty">
                            <i class="fas fa-comment-slash fa-3x text-muted opacity-25 mb-3"></i>
                            <h5 class="fw-bold">No Testimonials Found</h5>
                            <p class="text-muted">Try different search terms or adjust filters.</p>
                            <button class="btn btn-outline-success rounded-pill px-4" wire:click="clearFilters">
                                <i class="fas fa-redo me-2"></i> Reset Filters
                            </button>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

</div>

<?php $__env->startPush('styles'); ?>
<style>
    .testi-hero { background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%); min-height: 250px; display: flex; align-items: center; }
    .testi-hero-content { width: 100%; }
    .testi-breadcrumb { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 10px; }
    .testi-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .testi-breadcrumb li a { color: #fff; text-decoration: none; }
    .testi-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .testi-hero-title { color: #fff; font-size: 2.5rem; font-weight: 800; }
    .testi-hero-subtitle { color: rgba(255,255,255,0.8); font-size: 1rem; }
    .testi-section { padding: 60px 0; background: #f8f9fa; }

    /* Stats Bar */
    .testi-stats-bar {
        background: #fff; border-radius: 16px; padding: 25px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.05); border: 1px solid #eef0f2; margin-bottom: 30px;
    }
    .testi-stat-item { padding: 10px; }
    .testi-stat-number { display: block; font-size: 2rem; font-weight: 800; color: #0056b3; line-height: 1; }
    .testi-stat-label { display: block; font-size: 0.8rem; color: #888; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-top: 4px; }
    .testi-stars-small { margin-top: 3px; }

    /* Testimonial Card */
    .testi-card {
        background: #fff; border-radius: 16px; padding: 25px;
        box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
        transition: all 0.3s; height: 100%; display: flex; flex-direction: column;
    }
    .testi-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
    .testi-rating { font-size: 0.9rem; }
    .testi-content { font-size: 0.9rem; color: #666; line-height: 1.7; flex: 1; margin-bottom: 15px; font-style: italic; }
    .testi-author { display: flex; align-items: center; gap: 12px; padding-top: 12px; border-top: 1px solid #f0f0f0; }
    .testi-author-avatar { width: 50px; height: 50px; min-width: 50px; border-radius: 50%; overflow: hidden; background: #f0f4f8; }
    .testi-avatar-img { width: 100%; height: 100%; object-fit: cover; }
    .testi-author-name { font-size: 0.95rem; font-weight: 700; margin-bottom: 1px; }
    .testi-author-role { font-size: 0.78rem; color: #28a745; font-weight: 600; display: block; }
    .testi-author-company { font-size: 0.75rem; color: #aaa; }
    .testi-meta { display: flex; flex-wrap: wrap; gap: 8px; font-size: 0.75rem; color: #888; }

    @media (max-width: 991px) {
        .testi-hero { min-height: 200px; }
        .testi-hero-title { font-size: 2rem; }
    }
    @media (max-width: 767px) {
        .testi-hero { min-height: 170px; }
        .testi-hero-title { font-size: 1.6rem; }
        .testi-section { padding: 40px 0; }
        .testi-card { padding: 18px; }
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/testimonials-page.blade.php ENDPATH**/ ?>