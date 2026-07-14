<div class="gallery-page-wrapper"
     x-data="{
        activeFilter: <?php if ((object) ('selectedCategory') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('selectedCategory'->value()); ?>')<?php echo e('selectedCategory'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('selectedCategory'); ?>')<?php endif; ?>,
        
        filter(category) {
            this.activeFilter = category;
            $wire.filterByCategory(category);
        },
        
        openLightbox(index) {
            $wire.openLightbox(index);
        },
        
        closeLightbox() {
            $wire.closeLightbox();
        },
        
        nextImage() {
            $wire.nextImage();
        },
        
        prevImage() {
            $wire.prevImage();
        }
     }">
    
    <!-- HERO -->
    <section class="gal-hero" wire:ignore>
        <div class="container gal-hero-content">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="gal-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Gallery</li>
                        </ol>
                    </nav>
                    <h1 class="gal-hero-title">Our Work Gallery</h1>
                    <p class="gal-hero-subtitle">Showcasing our engineering excellence and completed projects</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="gal-section">
        <div class="container">
            
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="text-center py-5" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('gal-loading', get_defined_vars()); ?>wire:key="gal-loading">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-2">Loading gallery...</p>
                </div>
                
            
            <?php elseif($errorMessage): ?>
                <div class="alert alert-danger text-center rounded-3 border-0 shadow-sm" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('gal-error', get_defined_vars()); ?>wire:key="gal-error">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e($errorMessage); ?>

                </div>
                
            
            <?php else: ?>
                <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('gal-main-content', get_defined_vars()); ?>wire:key="gal-main-content">
                    
                    
                    <div class="gal-filters" data-aos="fade-up" wire:ignore.self>
                        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
                            <button class="gal-filter-btn <?php echo e($selectedCategory === 'all' ? 'active' : ''); ?>"
                                    wire:click="filterByCategory('all')"
                                    <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('filter-all', get_defined_vars()); ?>wire:key="filter-all">
                                <i class="fas fa-th me-1"></i> All
                            </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <button class="gal-filter-btn <?php echo e($selectedCategory === $cat ? 'active' : ''); ?>"
                                        wire:click="filterByCategory('<?php echo e($cat); ?>')"
                                        <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('filter-{{ Str::slug($cat) }}', get_defined_vars()); ?>wire:key="filter-<?php echo e(Str::slug($cat)); ?>">
                                    <?php echo e($cat); ?>

                                </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                    
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalCount > 0): ?>
                        <div class="gal-grid" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('gal-grid-{{ $selectedCategory }}', get_defined_vars()); ?>wire:key="gal-grid-<?php echo e($selectedCategory); ?>">
                            <div class="row g-3">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filteredImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6" 
                                         data-aos="fade-up" 
                                         data-aos-delay="<?php echo e($index % 4 * 100); ?>"
                                         <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('gal-item-{{ $item->wg_id }}', get_defined_vars()); ?>wire:key="gal-item-<?php echo e($item->wg_id); ?>">
                                        <div class="gal-item" @click="openLightbox(<?php echo e($index); ?>)">
                                            <div class="gal-img-wrap" wire:ignore>
                                                <img src="<?php echo e(asset('wg_image/'.$item->wg_image)); ?>" 
                                                     alt="<?php echo e($item->wg_title); ?>" 
                                                     class="gal-img" loading="lazy">
                                                <div class="gal-overlay">
                                                    <div class="gal-overlay-inner">
                                                        <i class="fas fa-search-plus gal-zoom-icon"></i>
                                                        <h5 class="gal-title"><?php echo e($item->wg_title); ?></h5>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->wg_type): ?>
                                                            <span class="gal-category"><?php echo e($item->wg_type); ?></span>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                        
                        
                        <div class="text-center mt-4" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('gal-count', get_defined_vars()); ?>wire:key="gal-count">
                            <p class="text-muted small">
                                Showing <strong><?php echo e($totalCount); ?></strong> of <strong><?php echo e($galleries->count()); ?></strong> images
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedCategory !== 'all'): ?>
                                    in <strong><?php echo e($selectedCategoryName); ?></strong>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </p>
                        </div>
                        
                    <?php else: ?>
                        <div class="text-center py-5" data-aos="fade-up" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('gal-empty', get_defined_vars()); ?>wire:key="gal-empty">
                            <i class="fas fa-images fa-3x text-muted opacity-25 mb-3"></i>
                            <h5 class="fw-bold">No Images Found</h5>
                            <p class="text-muted">No images available in this category.</p>
                            <button class="btn btn-outline-success rounded-pill px-4" wire:click="filterByCategory('all')">
                                <i class="fas fa-redo me-2"></i> Show All
                            </button>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    <!-- ============================================
         LIGHTBOX MODAL
         ============================================ -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeImage): ?>
        <div class="gal-lightbox" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('lightbox-{{ $activeImage->wg_id }}', get_defined_vars()); ?>wire:key="lightbox-<?php echo e($activeImage->wg_id); ?>" @keydown.escape.window="closeLightbox">
            <div class="gal-lightbox-backdrop" @click="closeLightbox"></div>
            <div class="gal-lightbox-content">
                <button class="gal-lightbox-close" @click="closeLightbox">&times;</button>
                
                <button class="gal-lightbox-nav gal-lightbox-prev" @click="prevImage">
                    <i class="fas fa-chevron-left"></i>
                </button>
                
                <img src="<?php echo e(asset('wg_image/'.$activeImage->wg_image)); ?>" 
                     alt="<?php echo e($activeImage->wg_title); ?>" 
                     class="gal-lightbox-img">
                
                <button class="gal-lightbox-nav gal-lightbox-next" @click="nextImage">
                    <i class="fas fa-chevron-right"></i>
                </button>
                
                <div class="gal-lightbox-info">
                    <h5><?php echo e($activeImage->wg_title); ?></h5>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeImage->wg_type): ?>
                        <span><?php echo e($activeImage->wg_type); ?></span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <span class="gal-lightbox-counter"><?php echo e($activeImageIndex + 1); ?> / <?php echo e($totalCount); ?></span>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>

<?php $__env->startPush('styles'); ?>
<style>
    .gal-hero { background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%); min-height: 250px; display: flex; align-items: center; }
    .gal-hero-content { width: 100%; }
    .gal-breadcrumb { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 10px; }
    .gal-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .gal-breadcrumb li a { color: #fff; text-decoration: none; }
    .gal-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .gal-hero-title { color: #fff; font-size: 2.5rem; font-weight: 800; }
    .gal-hero-subtitle { color: rgba(255,255,255,0.8); font-size: 1rem; }
    .gal-section { padding: 60px 0; background: #fff; }

    .gal-filter-btn {
        padding: 10px 22px; background: #fff; border: 2px solid #e9ecef;
        border-radius: 50px; font-size: 0.85rem; font-weight: 600; color: #555;
        cursor: pointer; transition: all 0.3s ease;
    }
    .gal-filter-btn:hover { border-color: #28a745; color: #28a745; background: #f0faf3; }
    .gal-filter-btn.active { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; border-color: transparent; box-shadow: 0 5px 20px rgba(40,167,69,0.3); }

    .gal-item { cursor: pointer; }
    .gal-img-wrap {
        position: relative; border-radius: 12px; overflow: hidden;
        box-shadow: 0 3px 15px rgba(0,0,0,0.06); transition: all 0.3s;
    }
    .gal-item:hover .gal-img-wrap { transform: translateY(-5px); box-shadow: 0 12px 35px rgba(0,0,0,0.12); }
    .gal-img { width: 100%; height: 240px; object-fit: cover; display: block; transition: transform 0.5s; }
    .gal-item:hover .gal-img { transform: scale(1.06); }
    .gal-overlay {
        position: absolute; inset: 0; background: rgba(0,54,108,0.75);
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.3s ease;
    }
    .gal-item:hover .gal-overlay { opacity: 1; }
    .gal-overlay-inner { text-align: center; color: #fff; padding: 15px; }
    .gal-zoom-icon { font-size: 2rem; margin-bottom: 8px; display: block; }
    .gal-title { font-size: 1rem; font-weight: 700; margin-bottom: 4px; }
    .gal-category { font-size: 0.75rem; background: rgba(255,255,255,0.2); padding: 3px 12px; border-radius: 50px; }

    .gal-lightbox { position: fixed; inset: 0; z-index: 99999; display: flex; align-items: center; justify-content: center; }
    .gal-lightbox-backdrop { position: absolute; inset: 0; background: rgba(0,0,0,0.92); }
    .gal-lightbox-content { position: relative; max-width: 90vw; max-height: 85vh; display: flex; align-items: center; }
    .gal-lightbox-img { max-width: 85vw; max-height: 80vh; border-radius: 10px; object-fit: contain; }
    .gal-lightbox-close { position: absolute; top: -45px; right: 0; background: none; border: none; color: #fff; font-size: 2.5rem; cursor: pointer; }
    .gal-lightbox-close:hover { color: #dc3545; }
    .gal-lightbox-nav { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.12); color: #fff; border: none; width: 48px; height: 48px; border-radius: 50%; font-size: 1.3rem; cursor: pointer; display: flex; align-items: center; justify-content: center; }
    .gal-lightbox-nav:hover { background: rgba(255,255,255,0.25); }
    .gal-lightbox-prev { left: -65px; }
    .gal-lightbox-next { right: -65px; }
    .gal-lightbox-info { position: absolute; bottom: -50px; left: 50%; transform: translateX(-50%); text-align: center; color: #fff; }
    .gal-lightbox-info h5 { font-size: 1rem; font-weight: 700; }
    .gal-lightbox-info span { font-size: 0.8rem; opacity: 0.7; }
    .gal-lightbox-counter { display: block; font-size: 0.75rem; opacity: 0.5; margin-top: 4px; }

    @media (max-width: 991px) {
        .gal-hero { min-height: 200px; }
        .gal-hero-title { font-size: 2rem; }
        .gal-img { height: 200px; }
        .gal-lightbox-nav { width: 40px; height: 40px; }
        .gal-lightbox-prev { left: -10px; }
        .gal-lightbox-next { right: -10px; }
    }
    @media (max-width: 767px) {
        .gal-hero { min-height: 170px; }
        .gal-hero-title { font-size: 1.6rem; }
        .gal-section { padding: 40px 0; }
        .gal-img { height: 220px; }
        .gal-filter-btn { padding: 8px 16px; font-size: 0.78rem; }
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/gallery-page.blade.php ENDPATH**/ ?>