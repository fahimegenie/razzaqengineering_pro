<div class="pdp-wrapper"
     x-data="{
        galleryOpen: <?php if ((object) ('activeGalleryImage') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('activeGalleryImage'->value()); ?>')<?php echo e('activeGalleryImage'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('activeGalleryImage'); ?>')<?php endif; ?>,
        
        openGallery(index) { $wire.openGallery(index); },
        closeGallery() { $wire.closeGallery(); },
        nextImage() { $wire.nextGalleryImage(); },
        prevImage() { $wire.prevGalleryImage(); }
     }">
    
    <!-- ============================================
         HERO
         ============================================ -->
    <section class="pdp-hero" wire:ignore>
        <div class="container pdp-hero-content">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="pdp-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li><a href="<?php echo e(url('projects')); ?>">Projects</a></li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project && $project->category): ?>
                                <li><a href="<?php echo e(url('projects?category='.$project->pc_id)); ?>"><?php echo e($project->category->pc_name); ?></a></li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <li class="active"><?php echo e($project->p_title ?? 'Project Details'); ?></li>
                        </ol>
                    </nav>
                    <h1 class="pdp-hero-title"><?php echo e($project->p_title ?? 'Project Details'); ?></h1>
                    <p class="pdp-hero-subtitle"><?php echo e($project->p_short_description ?? ''); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         CONTENT
         ============================================ -->
    <section class="pdp-section">
        <div class="container">
            
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="text-center py-5" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'pdp-loading'; ?>wire:key="pdp-loading">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-2">Loading project details...</p>
                </div>
                
            
            <?php elseif($errorMessage): ?>
                <div class="alert alert-danger text-center rounded-3 border-0 shadow-sm" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'pdp-error'; ?>wire:key="pdp-error">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e($errorMessage); ?>

                    <a href="<?php echo e(url('projects')); ?>" class="btn btn-outline-danger btn-sm ms-3 rounded-pill">
                        <i class="fas fa-arrow-left me-1"></i> Back to Projects
                    </a>
                </div>
                
            
            <?php elseif($project): ?>
                <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'pdp-content-'.e($project->id).''; ?>wire:key="pdp-content-<?php echo e($project->id); ?>">
                    
                    
                    <div class="pdp-info-bar" data-aos="fade-up" wire:ignore.self>
                        <div class="row g-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->category): ?>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="pdp-info-item">
                                        <span class="pdp-info-label">Category</span>
                                        <span class="pdp-info-value"><?php echo e($project->category->pc_name); ?></span>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_status): ?>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="pdp-info-item">
                                        <span class="pdp-info-label">Status</span>
                                        <span class="pdp-info-value">
                                            <span class="status-badge status-<?php echo e($project->p_status); ?>"><?php echo e(ucfirst($project->p_status)); ?></span>
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_location): ?>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="pdp-info-item">
                                        <span class="pdp-info-label">Location</span>
                                        <span class="pdp-info-value"><?php echo e($project->p_location); ?></span>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_client): ?>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="pdp-info-item">
                                        <span class="pdp-info-label">Client</span>
                                        <span class="pdp-info-value"><?php echo e($project->p_client); ?></span>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_start_date): ?>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="pdp-info-item">
                                        <span class="pdp-info-label">Start Date</span>
                                        <span class="pdp-info-value"><?php echo e($project->p_start_date->format('M d, Y')); ?></span>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_end_date): ?>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="pdp-info-item">
                                        <span class="pdp-info-label">End Date</span>
                                        <span class="pdp-info-value"><?php echo e($project->p_end_date->format('M d, Y')); ?></span>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->duration): ?>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="pdp-info-item">
                                        <span class="pdp-info-label">Duration</span>
                                        <span class="pdp-info-value"><?php echo e($project->duration); ?></span>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    
                    
                    <div class="row g-5 mt-3">
                        
                        
                        <div class="col-lg-8" data-aos="fade-up">
                            
                            
                            <div class="pdp-main-image" wire:ignore>
                                <img src="<?php echo e(asset('p_image/'.$project->p_image)); ?>" 
                                     alt="<?php echo e($project->p_title); ?>" 
                                     class="img-fluid rounded-3 shadow-sm" 
                                     loading="lazy">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($galleryImages) > 0): ?>
                                    <button class="pdp-gallery-btn" @click="openGallery(0)">
                                        <i class="fas fa-images me-2"></i> View Gallery (<?php echo e(count($galleryImages)); ?>)
                                    </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            
                            
                            <div class="pdp-description mt-4">
                                <h3 class="pdp-section-title">Project Description</h3>
                                <div class="pdp-text">
                                    <?php echo nl2br(e($project->p_description)); ?>

                                </div>
                            </div>
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($galleryImages) > 0): ?>
                                <div class="pdp-gallery-grid mt-4" wire:ignore>
                                    <h3 class="pdp-section-title">Project Gallery</h3>
                                    <div class="row g-3">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="pdp-gallery-item" @click="openGallery(<?php echo e($index); ?>)" style="cursor:pointer;">
                                                    <img src="<?php echo e(asset('p_image/'.$img)); ?>" 
                                                         alt="Gallery Image <?php echo e($index + 1); ?>" 
                                                         class="img-fluid rounded-3" loading="lazy">
                                                    <div class="pdp-gallery-overlay">
                                                        <i class="fas fa-search-plus"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                        </div>
                        
                        
                        <div class="col-lg-4" data-aos="fade-left">
                            
                            
                            <div class="pdp-sidebar-card mb-4">
                                <h5 class="fw-bold mb-3">
                                    <i class="fas fa-file-invoice text-success me-2"></i> Get Free Quote
                                </h5>
                                <p class="text-muted small">Interested in a similar project? Get in touch with us today.</p>
                                <a href="<?php echo e(route('quote.index')); ?>" class="btn btn-gradient w-100 rounded-pill py-2 fw-bold">
                                    <i class="fas fa-paper-plane me-2"></i> Request Quote
                                </a>
                                <a href="tel:+923048902805" class="btn btn-outline-success w-100 rounded-pill py-2 fw-bold mt-2">
                                    <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                                </a>
                            </div>
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->category): ?>
                                <div class="pdp-sidebar-card mb-4">
                                    <h5 class="fw-bold mb-3">
                                        <i class="fas fa-folder text-success me-2"></i> Project Category
                                    </h5>
                                    <p class="text-muted small mb-2"><?php echo e($project->category->pc_description ?? 'Projects in this category showcase our expertise and quality workmanship.'); ?></p>
                                    <a href="<?php echo e(url('projects?category='.$project->pc_id)); ?>" class="btn btn-outline-primary btn-sm rounded-pill">
                                        <i class="fas fa-arrow-right me-1"></i> View All <?php echo e($project->category->pc_name); ?> Projects
                                    </a>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedProjects->count() > 0): ?>
                                <div class="pdp-sidebar-card">
                                    <h5 class="fw-bold mb-3">
                                        <i class="fas fa-project-diagram text-success me-2"></i> Related Projects
                                    </h5>
                                    <div class="pdp-related-list">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $relatedProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <a href="<?php echo e(url('project/'.($rp->p_slug ?? $rp->id))); ?>" class="pdp-related-item">
                                                <img src="<?php echo e(asset('p_image/'.$rp->p_image)); ?>" alt="<?php echo e($rp->p_title); ?>" loading="lazy">
                                                <div>
                                                    <h6 class="mb-1"><?php echo e(Str::limit($rp->p_title, 40)); ?></h6>
                                                    <small class="text-muted"><?php echo e($rp->p_location ?? ''); ?></small>
                                                </div>
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

    <!-- ============================================
         GALLERY MODAL
         ============================================ -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeGalleryImage !== null && count($galleryImages) > 0): ?>
        <div class="pdp-gallery-modal" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'gallery-modal'; ?>wire:key="gallery-modal" @keydown.escape.window="closeGallery">
            <div class="pdp-gallery-backdrop" @click="closeGallery"></div>
            <div class="pdp-gallery-content">
                <button class="pdp-gallery-close" @click="closeGallery">&times;</button>
                <button class="pdp-gallery-nav pdp-gallery-prev" @click="prevImage"><i class="fas fa-chevron-left"></i></button>
                <img src="<?php echo e(asset('p_image/'.$galleryImages[$activeGalleryImage])); ?>" 
                     alt="Gallery Image <?php echo e($activeGalleryImage + 1); ?>" 
                     class="pdp-gallery-img">
                <button class="pdp-gallery-nav pdp-gallery-next" @click="nextImage"><i class="fas fa-chevron-right"></i></button>
                <div class="pdp-gallery-counter"><?php echo e($activeGalleryImage + 1); ?> / <?php echo e(count($galleryImages)); ?></div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>

<?php $__env->startPush('styles'); ?>
<style>
    /* Hero */
    .pdp-hero { background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%); min-height: 280px; display: flex; align-items: center; }
    .pdp-hero-content { width: 100%; }
    .pdp-breadcrumb { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 12px; }
    .pdp-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .pdp-breadcrumb li a { color: #fff; text-decoration: none; }
    .pdp-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .pdp-hero-title { color: #fff; font-size: 2.5rem; font-weight: 800; margin-bottom: 8px; }
    .pdp-hero-subtitle { color: rgba(255,255,255,0.8); font-size: 1rem; }
    .pdp-section { padding: 50px 0; background: #f8f9fa; }

    /* Info Bar */
    .pdp-info-bar {
        background: #fff; border-radius: 16px; padding: 22px 25px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
    }
    .pdp-info-item { padding: 5px 0; }
    .pdp-info-label { display: block; font-size: 0.7rem; color: #888; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 2px; }
    .pdp-info-value { font-size: 0.9rem; font-weight: 600; color: #0a1628; }
    .status-badge { padding: 2px 10px; border-radius: 50px; font-size: 0.72rem; color: #fff; }
    .status-completed { background: #28a745; }
    .status-ongoing { background: #0056b3; }
    .status-planning { background: #ffc107; color: #000; }
    .status-on-hold { background: #6c757d; }

    /* Main Image */
    .pdp-main-image { position: relative; border-radius: 14px; overflow: hidden; }
    .pdp-main-image img { width: 100%; max-height: 450px; object-fit: cover; }
    .pdp-gallery-btn {
        position: absolute; bottom: 15px; right: 15px;
        background: rgba(0,0,0,0.7); color: #fff; border: none;
        padding: 8px 18px; border-radius: 50px; font-size: 0.85rem; font-weight: 600;
        cursor: pointer; transition: all 0.3s; backdrop-filter: blur(5px);
    }
    .pdp-gallery-btn:hover { background: #28a745; }

    /* Description */
    .pdp-section-title { font-size: 1.3rem; font-weight: 700; color: #0a1628; margin-bottom: 15px; }
    .pdp-text { font-size: 0.92rem; color: #666; line-height: 1.8; }

    /* Gallery Grid */
    .pdp-gallery-item { position: relative; border-radius: 10px; overflow: hidden; }
    .pdp-gallery-item img { width: 100%; height: 180px; object-fit: cover; transition: transform 0.4s; }
    .pdp-gallery-item:hover img { transform: scale(1.05); }
    .pdp-gallery-overlay {
        position: absolute; inset: 0; background: rgba(0,0,0,0.4);
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.3s; color: #fff; font-size: 1.5rem;
    }
    .pdp-gallery-item:hover .pdp-gallery-overlay { opacity: 1; }

    /* Sidebar */
    .pdp-sidebar-card {
        background: #fff; border-radius: 14px; padding: 22px;
        box-shadow: 0 3px 20px rgba(0,0,0,0.04); border: 1px solid #eef0f2;
    }
    .pdp-related-item {
        display: flex; align-items: center; gap: 12px; padding: 10px 0;
        border-bottom: 1px solid #f0f0f0; text-decoration: none; transition: all 0.2s;
    }
    .pdp-related-item:last-child { border-bottom: none; }
    .pdp-related-item:hover { padding-left: 5px; }
    .pdp-related-item img { width: 55px; height: 55px; border-radius: 8px; object-fit: cover; }
    .pdp-related-item h6 { font-size: 0.85rem; color: #0a1628; }

    /* Gallery Modal */
    .pdp-gallery-modal { position: fixed; inset: 0; z-index: 99999; display: flex; align-items: center; justify-content: center; }
    .pdp-gallery-backdrop { position: absolute; inset: 0; background: rgba(0,0,0,0.9); }
    .pdp-gallery-content { position: relative; max-width: 90vw; max-height: 85vh; display: flex; align-items: center; }
    .pdp-gallery-img { max-width: 90vw; max-height: 85vh; border-radius: 10px; object-fit: contain; }
    .pdp-gallery-close {
        position: absolute; top: -40px; right: 0; background: none; border: none;
        color: #fff; font-size: 2rem; cursor: pointer; transition: color 0.3s;
    }
    .pdp-gallery-close:hover { color: #dc3545; }
    .pdp-gallery-nav {
        position: absolute; top: 50%; transform: translateY(-50%);
        background: rgba(255,255,255,0.15); color: #fff; border: none;
        width: 45px; height: 45px; border-radius: 50%; font-size: 1.2rem;
        cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center;
    }
    .pdp-gallery-nav:hover { background: rgba(255,255,255,0.3); }
    .pdp-gallery-prev { left: -60px; }
    .pdp-gallery-next { right: -60px; }
    .pdp-gallery-counter {
        position: absolute; bottom: -35px; left: 50%; transform: translateX(-50%);
        color: rgba(255,255,255,0.7); font-size: 0.85rem;
    }

    @media (max-width: 991px) {
        .pdp-hero { min-height: 220px; }
        .pdp-hero-title { font-size: 2rem; }
        .pdp-gallery-nav { width: 38px; height: 38px; }
        .pdp-gallery-prev { left: -10px; }
        .pdp-gallery-next { right: -10px; }
    }
    @media (max-width: 767px) {
        .pdp-hero { min-height: 180px; }
        .pdp-hero-title { font-size: 1.6rem; }
        .pdp-section { padding: 35px 0; }
        .pdp-main-image img { max-height: 300px; }
        .pdp-gallery-item img { height: 140px; }
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/project-detail-page.blade.php ENDPATH**/ ?>