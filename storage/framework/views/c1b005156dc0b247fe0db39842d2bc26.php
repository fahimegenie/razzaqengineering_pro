<div class="glr-page" 
     x-data="{
        lightboxOpen: <?php if ((object) ('activeImage') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('activeImage'->value()); ?>')<?php echo e('activeImage'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('activeImage'); ?>')<?php endif; ?>.live,
        
        handleKeydown(e) {
            if (this.lightboxOpen) {
                if (e.key === 'Escape') $wire.closeLightbox();
                if (e.key === 'ArrowRight') $wire.nextImage();
                if (e.key === 'ArrowLeft') $wire.prevImage();
            }
        }
     }"
     @keydown.window="handleKeydown">
    
    
    <div class="glr-mobile-cta d-lg-none">
        <a href="tel:+923048902805" class="glr-mobile-btn glr-mobile-call">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/923048902805" target="_blank" class="glr-mobile-btn glr-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="<?php echo e(route('quote.index')); ?>" class="glr-mobile-btn glr-mobile-quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    
    <section class="glr-hero">
        <div class="glr-hero-bg" style="background-image: url('<?php echo e(asset("images/gallery-hero-bg.jpg")); ?>');"></div>
        <div class="glr-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-30">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="glr-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Gallery</li>
                        </ol>
                    </nav>
                    
                    <div class="glr-hero-badge">
                        <i class="fas fa-images"></i> Our Portfolio
                    </div>
                    
                    <h1 class="glr-hero-title">Work Gallery</h1>
                    <p class="glr-hero-subtitle">Explore our engineering excellence through real project images and completed works across Pakistan</p>
                    
                    <div class="glr-hero-stats">
                        <div class="glr-stat-item">
                            <span class="glr-stat-number"><?php echo e($totalGalleriesCount); ?>+</span>
                            <span class="glr-stat-label">Images</span>
                        </div>
                        <div class="glr-stat-item">
                            <span class="glr-stat-number"><?php echo e(count($categories)); ?></span>
                            <span class="glr-stat-label">Categories</span>
                        </div>
                        <div class="glr-stat-item">
                            <span class="glr-stat-number">100%</span>
                            <span class="glr-stat-label">Real Work</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="glr-trust-bar">
        <div class="container">
            <div class="glr-trust-grid">
                <div class="glr-trust-card">
                    <div class="glr-trust-icon"><i class="fas fa-camera"></i></div>
                    <div>
                        <strong><?php echo e($totalGalleriesCount); ?>+</strong>
                        <span>Real Photos</span>
                    </div>
                </div>
                <div class="glr-trust-card">
                    <div class="glr-trust-icon"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <strong>Verified</strong>
                        <span>Projects</span>
                    </div>
                </div>
                <div class="glr-trust-card">
                    <div class="glr-trust-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <strong>Nationwide</strong>
                        <span>Coverage</span>
                    </div>
                </div>
                <div class="glr-trust-card">
                    <div class="glr-trust-icon"><i class="fas fa-star"></i></div>
                    <div>
                        <strong>Quality</strong>
                        <span>Workmanship</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="glr-main-section">
        <div class="container">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="glr-state-box">
                    <div class="spinner-grow text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-3 fw-semibold">Loading gallery...</p>
                </div>
            
            <?php elseif($errorMessage): ?>
                <div class="glr-error-card">
                    <i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;"></i>
                    <h4 class="fw-bold mt-3">Oops! Something went wrong</h4>
                    <p class="text-muted"><?php echo e($errorMessage); ?></p>
                    <button class="btn btn-primary mt-3" wire:click="filterByCategory('all')">
                        <i class="fas fa-redo me-2"></i> Refresh
                    </button>
                </div>
            
            <?php else: ?>
                
                <div class="glr-section-header" data-aos="fade-up">
                    <span class="glr-section-badge"><i class="fas fa-th-large"></i> Browse Gallery</span>
                    <h2><?php echo e($selectedCategory !== 'all' ? $selectedCategoryName : 'All Work'); ?></h2>
                    <p>Click on any image to view it in full size and browse through our work</p>
                </div>

                
                <div class="glr-filters-wrapper" data-aos="fade-up">
                    <div class="glr-filters-scroll">
                        <button class="glr-filter-pill <?php echo e($selectedCategory === 'all' ? 'active' : ''); ?>"
                                wire:click="filterByCategory('all')"
                                <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'filter-btn-all'; ?>wire:key="filter-btn-all">
                            <i class="fas fa-th"></i> All
                            <span class="glr-filter-count"><?php echo e($totalGalleriesCount); ?></span>
                        </button>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <button class="glr-filter-pill <?php echo e($selectedCategory === $cat ? 'active' : ''); ?>"
                                    wire:click="filterByCategory('<?php echo e($cat); ?>')"
                                    <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'filter-btn-'.e(Str::slug($cat)).''; ?>wire:key="filter-btn-<?php echo e(Str::slug($cat)); ?>">
                                <?php echo e($cat); ?>

                            </button>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalCount > 0): ?>
                    <div class="glr-grid" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'grid-container-'.e($selectedCategory).''; ?>wire:key="grid-container-<?php echo e($selectedCategory); ?>">
                        <div class="row g-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filteredImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="col-lg-3 col-md-4 col-sm-6" 
                                     <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'gallery-item-'.e($item->id ?? $index).''; ?>wire:key="gallery-item-<?php echo e($item->id ?? $index); ?>">
                                    <div class="glr-card" wire:click="openLightbox(<?php echo e($index); ?>)">
                                        <div class="glr-card-image">
                                            <img src="<?php echo e($item->image_url); ?>" 
                                                 alt="<?php echo e($item->wg_title); ?>" 
                                                 loading="lazy">
                                            <div class="glr-card-overlay">
                                                <div class="glr-overlay-content">
                                                    <i class="fas fa-search-plus glr-zoom-icon"></i>
                                                    <h5><?php echo e($item->wg_title); ?></h5>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->wg_type): ?>
                                                        <span class="glr-overlay-tag"><?php echo e($item->wg_type); ?></span>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        
                        
                        <div class="glr-count-bar">
                            <i class="fas fa-images me-2"></i>
                            Showing <strong><?php echo e($totalCount); ?></strong> of <strong><?php echo e($totalGalleriesCount); ?></strong> images
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedCategory !== 'all'): ?>
                                in <strong><?php echo e($selectedCategoryName); ?></strong>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="glr-empty-state" data-aos="fade-up">
                        <div class="glr-empty-icon">
                            <i class="fas fa-images"></i>
                        </div>
                        <h3>No Images Found</h3>
                        <p>No images available in this category yet.</p>
                        <button class="btn btn-outline-primary mt-3" wire:click="filterByCategory('all')">
                            <i class="fas fa-redo me-2"></i> Show All Images
                        </button>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    
    <section class="glr-final-cta">
        <div class="container text-center">
            <h2>Want Similar Results for Your Project?</h2>
            <p class="mb-4">Let our expert team deliver the same quality workmanship for your engineering needs.</p>
            <div class="glr-final-cta-buttons">
                <a href="<?php echo e(route('quote.index')); ?>" class="glr-btn glr-btn-lg glr-btn-accent">
                    <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                </a>
                <a href="tel:+923048902805" class="glr-btn glr-btn-lg glr-btn-white-outline-dark">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>

    
    <div class="glr-lightbox" 
         x-show="lightboxOpen" 
         x-transition.opacity
         @click.self="$wire.closeLightbox()"
         x-cloak>
        <button class="glr-lightbox-close" wire:click="closeLightbox">&times;</button>
        
        <button class="glr-lightbox-nav glr-lightbox-prev" wire:click="prevImage">
            <i class="fas fa-chevron-left"></i>
        </button>
        
        <div class="glr-lightbox-content">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeImage): ?>
                <img src="<?php echo e(is_array($activeImage) ? $activeImage['image_url'] : $activeImage->image_url); ?>" 
                     alt="<?php echo e(is_array($activeImage) ? $activeImage['wg_title'] : $activeImage->wg_title); ?>" 
                     class="glr-lightbox-img">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        
        <button class="glr-lightbox-nav glr-lightbox-next" wire:click="nextImage">
            <i class="fas fa-chevron-right"></i>
        </button>
        
        <div class="glr-lightbox-info">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeImage): ?>
                <h5><?php echo e(is_array($activeImage) ? $activeImage['wg_title'] : $activeImage->wg_title); ?></h5>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_array($activeImage) ? ($activeImage['wg_type'] ?? false) : $activeImage->wg_type): ?>
                    <span class="glr-lightbox-tag"><?php echo e(is_array($activeImage) ? $activeImage['wg_type'] : $activeImage->wg_type); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <span class="glr-lightbox-counter"><?php echo e($activeImageIndex + 1); ?> / <?php echo e($totalCount); ?></span>
        </div>
    </div>

</div>

<style>
/* ============================================
   GALLERY PAGE - ENTERPRISE GRADE DESIGN
   Laravel 13 + Livewire 4 Compatible
   ============================================ */

[x-cloak] { display: none !important; }

/* --- Mobile Sticky CTA --- */
.glr-mobile-cta {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 998;
    display: flex; background: #fff; box-shadow: 0 -4px 20px rgba(0,0,0,0.12);
}

.glr-mobile-btn {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
    padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none;
    border: none; cursor: pointer; transition: all 0.2s;
}

.glr-mobile-call { background: #f8f9fa; color: #0a1628; }
.glr-mobile-whatsapp { background: #25D366; color: #fff; }
.glr-mobile-quote { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; }

/* --- Hero Section --- */
.glr-hero {
    position: relative; padding: 90px 0 70px; overflow: hidden;
    min-height: 420px; display: flex; align-items: center;
}

.glr-hero-bg {
    position: absolute; inset: 0;
    background: url('<?php echo e(asset("images/gallery-hero-bg.jpg")); ?>') center/cover no-repeat;
    filter: brightness(0.3);
}

.glr-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,61,128,0.88) 0%, rgba(26,92,42,0.82) 100%);
}

.glr-hero .container { position: relative; z-index: 2; }

.glr-breadcrumb {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px;
    font-size: 0.84rem; color: rgba(255,255,255,0.7);
}

.glr-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.glr-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.glr-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.glr-breadcrumb a:hover { color: #fff; }
.glr-breadcrumb .active { color: rgba(255,255,255,0.6); }

.glr-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
    color: #fff; padding: 8px 18px; border-radius: 50px;
    font-size: 0.85rem; font-weight: 600; margin-bottom: 18px;
}

.glr-hero-title { color: #fff; font-size: clamp(2.2rem, 5vw, 3rem); font-weight: 800; margin: 0 0 12px; line-height: 1.15; }
.glr-hero-subtitle { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 550px; margin: 0 0 25px; line-height: 1.6; }

.glr-hero-stats { display: flex; gap: 30px; flex-wrap: wrap; }
.glr-stat-item { text-align: center; }
.glr-stat-number { display: block; font-size: 1.8rem; font-weight: 800; color: #28a745; }
.glr-stat-label { font-size: 0.78rem; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 1px; }

/* --- Trust Bar --- */
.glr-trust-bar { background: #fff; border-bottom: 1px solid #eef0f2; }
.glr-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); }

.glr-trust-card {
    display: flex; align-items: center; gap: 12px; padding: 20px;
    border-right: 1px solid #f0f0f0;
}
.glr-trust-card:last-child { border-right: none; }

.glr-trust-icon {
    width: 44px; height: 44px; min-width: 44px; background: rgba(40,167,69,0.1);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #28a745; font-size: 1.1rem;
}

.glr-trust-card strong { display: block; font-size: 1.1rem; color: #0a1628; }
.glr-trust-card span { font-size: 0.75rem; color: #888; }

/* --- Main Section --- */
.glr-main-section { padding: 40px 0 60px; background: #f8f9fa; }

/* --- Section Header --- */
.glr-section-header { text-align: center; margin-bottom: 30px; }

.glr-section-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(40,167,69,0.1); color: #28a745; padding: 6px 16px;
    border-radius: 50px; font-size: 0.78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px;
}

.glr-section-header h2 { font-size: 1.8rem; font-weight: 800; color: #0a1628; margin-bottom: 5px; }
.glr-section-header p { color: #888; }

/* --- Filter Pills --- */
.glr-filters-wrapper { margin-bottom: 30px; }
.glr-filters-scroll {
    display: flex; gap: 8px; overflow-x: auto; scrollbar-width: none;
    justify-content: center; padding: 5px 0;
}
.glr-filters-scroll::-webkit-scrollbar { display: none; }

.glr-filter-pill {
    display: flex; align-items: center; gap: 8px; padding: 10px 20px;
    background: #fff; border: 2px solid #e9ecef; border-radius: 50px;
    font-size: 0.84rem; font-weight: 600; color: #555; cursor: pointer;
    transition: all 0.3s ease; white-space: nowrap; flex-shrink: 0;
}

.glr-filter-pill:hover { border-color: #28a745; color: #28a745; background: #f0faf3; }
.glr-filter-pill.active { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; border-color: transparent; box-shadow: 0 5px 20px rgba(40,167,69,0.3); }

.glr-filter-count {
    background: rgba(0,0,0,0.08); padding: 2px 8px; border-radius: 50px;
    font-size: 0.72rem; font-weight: 700;
}

.glr-filter-pill.active .glr-filter-count { background: rgba(255,255,255,0.25); }

/* --- Gallery Grid --- */
.glr-card {
    border-radius: 14px; overflow: hidden; cursor: pointer;
    box-shadow: 0 3px 20px rgba(0,0,0,0.05); transition: all 0.4s ease;
}

.glr-card:hover { transform: translateY(-6px); box-shadow: 0 15px 40px rgba(0,0,0,0.12); }

.glr-card-image {
    position: relative; aspect-ratio: 4/3; overflow: hidden; background: #f0f4f8;
}

.glr-card-image img {
    width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;
}

.glr-card:hover .glr-card-image img { transform: scale(1.08); }

.glr-card-overlay {
    position: absolute; inset: 0; background: rgba(0,54,108,0.8);
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.3s ease;
}

.glr-card:hover .glr-card-overlay { opacity: 1; }

.glr-overlay-content { text-align: center; color: #fff; padding: 20px; }
.glr-zoom-icon { font-size: 2.2rem; margin-bottom: 10px; display: block; }
.glr-overlay-content h5 { font-size: 0.95rem; font-weight: 700; margin-bottom: 6px; }
.glr-overlay-tag {
    display: inline-block; background: rgba(255,255,255,0.2); padding: 4px 12px;
    border-radius: 50px; font-size: 0.72rem;
}

.glr-count-bar {
    text-align: center; margin-top: 25px; padding: 12px 20px;
    background: #fff; border-radius: 10px; font-size: 0.85rem; color: #888;
    box-shadow: 0 2px 10px rgba(0,0,0,0.03); border: 1px solid #eef0f2;
}

/* --- Lightbox --- */
.glr-lightbox {
    position: fixed; inset: 0; z-index: 99999; background: rgba(0,0,0,0.94);
    display: flex; align-items: center; justify-content: center;
}

.glr-lightbox-close {
    position: absolute; top: 20px; right: 25px; background: none; border: none;
    color: #fff; font-size: 2.5rem; cursor: pointer; z-index: 10; transition: color 0.3s;
}

.glr-lightbox-close:hover { color: #dc3545; }

.glr-lightbox-nav {
    position: absolute; top: 50%; transform: translateY(-50%);
    background: rgba(255,255,255,0.12); color: #fff; border: none;
    width: 50px; height: 50px; border-radius: 50%; font-size: 1.3rem;
    cursor: pointer; transition: all 0.3s; display: flex; align-items: center;
    justify-content: center; z-index: 10;
}

.glr-lightbox-nav:hover { background: rgba(255,255,255,0.25); }
.glr-lightbox-prev { left: 25px; }
.glr-lightbox-next { right: 25px; }

.glr-lightbox-content { max-width: 85vw; max-height: 80vh; }

.glr-lightbox-img { max-width: 85vw; max-height: 80vh; border-radius: 10px; object-fit: contain; }

.glr-lightbox-info {
    position: absolute; bottom: 25px; left: 50%; transform: translateX(-50%);
    text-align: center; color: #fff;
}

.glr-lightbox-info h5 { font-size: 1rem; font-weight: 700; margin-bottom: 4px; }
.glr-lightbox-tag {
    display: inline-block; background: rgba(255,255,255,0.15);
    padding: 3px 12px; border-radius: 50px; font-size: 0.75rem; margin-bottom: 6px;
}

.glr-lightbox-counter {
    display: block; font-size: 0.8rem; opacity: 0.6;
    background: rgba(0,0,0,0.4); padding: 4px 14px; border-radius: 50px;
}

/* --- Final CTA --- */
.glr-final-cta { padding: 60px 0; background: #fff; }
.glr-final-cta h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 10px; }
.glr-final-cta p { font-size: 1rem; color: #666; max-width: 500px; margin: 0 auto 20px; }
.glr-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

.glr-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 0.9rem;
    text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none;
    white-space: nowrap;
}

.glr-btn-lg { padding: 14px 28px; font-size: 0.95rem; border-radius: 10px; }
.glr-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.glr-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; }

.glr-btn-white-outline-dark { background: transparent; color: #0a1628; border: 2px solid #0a1628; }
.glr-btn-white-outline-dark:hover { background: #0a1628; color: #fff; }

/* --- States --- */
.glr-state-box { text-align: center; padding: 60px 20px; }
.glr-error-card { max-width: 500px; margin: 40px auto; padding: 40px 30px; background: #fff; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); text-align: center; }
.glr-empty-state { text-align: center; padding: 60px 20px; }
.glr-empty-icon { width: 100px; height: 100px; margin: 0 auto 20px; background: rgba(40,167,69,0.08); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: #28a745; }
.glr-empty-state h3 { font-size: 1.3rem; font-weight: 700; color: #0a1628; }
.glr-empty-state p { color: #888; max-width: 400px; margin: 0 auto; }

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 1199.98px) {
    .glr-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .glr-trust-card:nth-child(2) { border-right: none; }
}

@media (max-width: 991.98px) {
    .glr-hero { padding: 60px 0 50px; min-height: auto; }
    .glr-hero-title { font-size: 1.8rem; }
    .glr-filters-scroll { justify-content: flex-start; }
    .glr-lightbox-nav { width: 40px; height: 40px; }
    .glr-lightbox-prev { left: 10px; }
    .glr-lightbox-next { right: 10px; }
}

@media (max-width: 767.98px) {
    .glr-hero { padding: 45px 0 40px; }
    .glr-hero-title { font-size: 1.5rem; }
    .glr-hero-subtitle { font-size: 0.9rem; }
    .glr-hero-stats { gap: 15px; }
    .glr-stat-number { font-size: 1.4rem; }
    .glr-trust-grid { grid-template-columns: 1fr 1fr; }
    .glr-trust-card { padding: 14px; gap: 8px; }
    .glr-filter-pill { padding: 8px 16px; font-size: 0.78rem; }
}

@media (max-width: 575.98px) {
    .glr-hero { padding: 35px 0 30px; }
    .glr-hero-title { font-size: 1.3rem; }
    .glr-hero-badge { font-size: 0.75rem; padding: 6px 14px; }
    .glr-breadcrumb { font-size: 0.75rem; }
    .glr-trust-grid { grid-template-columns: 1fr 1fr; }
    .glr-trust-card { padding: 12px 10px; border-bottom: 1px solid #f0f0f0; }
    .glr-trust-card:nth-child(even) { border-right: none; }
    .glr-trust-icon { width: 34px; height: 34px; min-width: 34px; font-size: 0.9rem; }
    .glr-filter-pill { padding: 7px 14px; font-size: 0.74rem; }
    .glr-lightbox-close { top: 12px; right: 15px; font-size: 2rem; }
    .glr-lightbox-nav { width: 36px; height: 36px; font-size: 1rem; }
    .glr-final-cta { padding: 40px 0; }
    .glr-final-cta-buttons { flex-direction: column; }
    .glr-final-cta-buttons .glr-btn { width: 100%; justify-content: center; }
    body { padding-bottom: 55px; }
}
</style>


<script>
document.addEventListener('livewire:navigated', () => {
    if (typeof AOS !== 'undefined') AOS.refresh();
});
</script><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/gallery-page.blade.php ENDPATH**/ ?>