<div class="pdp-page" 
     x-data="{ 
        showFullDesc: false,
        galleryOpen: <?php if ((object) ('activeGalleryImage') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('activeGalleryImage'->value()); ?>')<?php echo e('activeGalleryImage'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('activeGalleryImage'); ?>')<?php endif; ?>,
        
        openGallery(index) { $wire.openGallery(index); },
        closeGallery() { $wire.closeGallery(); },
        nextImage() { $wire.nextGalleryImage(); },
        prevImage() { $wire.prevGalleryImage(); },
        
        handleKeydown(e) {
            if (this.galleryOpen !== null) {
                if (e.key === 'Escape') this.closeGallery();
                if (e.key === 'ArrowRight') this.nextImage();
                if (e.key === 'ArrowLeft') this.prevImage();
            }
        }
     }"
     @keydown.window="handleKeydown">
    
    
    <div class="pdp-mobile-cta d-lg-none">
        <a href="tel:+923048902805" class="pdp-mobile-btn pdp-mobile-call">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/923048902805" target="_blank" class="pdp-mobile-btn pdp-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="<?php echo e(route('quote.index')); ?>" class="pdp-mobile-btn pdp-mobile-quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    
    <section class="pdp-hero">
        <div class="pdp-hero-bg" style="background-image: url('<?php echo e($project->image_url ?? asset('images/hero-construction.jpg')); ?>');"></div>
        <div class="pdp-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-30">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="pdp-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li><a href="<?php echo e(route('projects')); ?>">Projects</a></li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project && $project->category): ?>
                                <li><a href="<?php echo e(url('projects?category='.$project->pc_id)); ?>"><?php echo e($project->category->pc_name); ?></a></li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <li class="active"><?php echo e($project->p_title ?? 'Project Details'); ?></li>
                        </ol>
                    </nav>
                    
                    <div class="pdp-hero-badge">
                        <i class="fas fa-hard-hat"></i> 
                        <?php echo e($project->category->pc_name ?? 'Project'); ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_status): ?>
                            <span class="pdp-hero-status status-<?php echo e($project->p_status); ?>"><?php echo e(ucfirst($project->p_status)); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    
                    <h1 class="pdp-hero-title"><?php echo e($project->p_title ?? 'Project Details'); ?></h1>
                    
                    <p class="pdp-hero-subtitle"><?php echo e($project->p_short_description ?? 'Professional engineering project executed with precision and quality workmanship.'); ?></p>
                    
                    <div class="pdp-hero-meta">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_location): ?>
                            <span><i class="fas fa-map-marker-alt"></i> <?php echo e($project->p_location); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_client): ?>
                            <span><i class="fas fa-building"></i> <?php echo e($project->p_client); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_start_date): ?>
                            <span><i class="far fa-calendar-alt"></i> <?php echo e($project->p_start_date->format('M Y')); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    
                    <div class="pdp-hero-cta">
                        <a href="<?php echo e(route('quote.index')); ?>" class="pdp-btn pdp-btn-lg pdp-btn-accent">
                            <i class="fas fa-paper-plane me-2"></i> Get Free Estimate
                        </a>
                        <a href="tel:+923048902805" class="pdp-btn pdp-btn-lg pdp-btn-white-outline">
                            <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-block text-center" data-aos="fade-left">
                    <div class="pdp-hero-image-wrapper">
                        <img src="<?php echo e($project->image_url ?? asset('images/project-default.jpg')); ?>" 
                             alt="<?php echo e($project->p_title ?? 'Project'); ?>" 
                             class="pdp-hero-image"
                             loading="eager">
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="pdp-trust-bar">
        <div class="container">
            <div class="pdp-trust-grid">
                <div class="pdp-trust-card">
                    <div class="pdp-trust-icon"><i class="fas fa-users"></i></div>
                    <div>
                        <strong>1000+</strong>
                        <span>Projects Completed</span>
                    </div>
                </div>
                <div class="pdp-trust-card">
                    <div class="pdp-trust-icon"><i class="fas fa-calendar-check"></i></div>
                    <div>
                        <strong>24+ Years</strong>
                        <span>Experience</span>
                    </div>
                </div>
                <div class="pdp-trust-card">
                    <div class="pdp-trust-icon"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <strong>100%</strong>
                        <span>Quality Assured</span>
                    </div>
                </div>
                <div class="pdp-trust-card">
                    <div class="pdp-trust-icon"><i class="fas fa-certificate"></i></div>
                    <div>
                        <strong>Certified</strong>
                        <span>Professionals</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="pdp-main-section">
        <div class="container">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="pdp-state-box">
                    <div class="spinner-grow text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-3 fw-semibold">Loading project details...</p>
                </div>
            
            <?php elseif($errorMessage): ?>
                <div class="pdp-error-card">
                    <i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;"></i>
                    <h4 class="fw-bold mt-3">Oops! Something went wrong</h4>
                    <p class="text-muted"><?php echo e($errorMessage); ?></p>
                    <a href="<?php echo e(route('projects')); ?>" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-left me-2"></i> Back to Projects
                    </a>
                </div>
            
            <?php elseif($project): ?>
                <div class="row g-4">
                    
                    
                    <div class="col-lg-8">
                        
                        
                        <div class="pdp-content-card" data-aos="fade-up">
                            <div class="pdp-image-hero">
                                <img src="<?php echo e($project->image_url); ?>" 
                                     alt="<?php echo e($project->p_title); ?>" 
                                     class="pdp-img-full"
                                     loading="lazy">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($galleryImages) > 0): ?>
                                    <button class="pdp-gallery-trigger" @click="openGallery(0)">
                                        <i class="fas fa-images me-2"></i> View Gallery (<?php echo e(count($galleryImages)); ?> photos)
                                    </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div class="pdp-image-gradient"></div>
                            </div>
                            
                            <div class="pdp-content-body">
                                <h2 class="pdp-section-title">Project Overview</h2>
                                
                                <div class="pdp-description">
                                    <?php echo Str::words(strip_tags($project->p_description ?? ''), 80, '...'); ?>

                                </div>
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_description && Str::wordCount(strip_tags($project->p_description)) > 80): ?>
                                    <div x-show="showFullDesc" x-transition class="pdp-description">
                                        <?php echo nl2br(e($project->p_description)); ?>

                                    </div>
                                    <button @click="showFullDesc = !showFullDesc" 
                                            class="pdp-read-more"
                                            x-text="showFullDesc ? 'Show Less' : 'Read Full Description'">
                                    </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                
                                <div class="pdp-mid-cta">
                                    <div class="pdp-mid-cta-inner">
                                        <i class="fas fa-phone-alt pdp-mid-cta-icon"></i>
                                        <div>
                                            <strong>Want a Similar Project?</strong>
                                            <span>Contact us for a free consultation and estimate</span>
                                        </div>
                                        <a href="tel:+923048902805" class="pdp-btn pdp-btn-accent">+92 304 8902805</a>
                                    </div>
                                </div>
                                
                                
                                <div class="pdp-info-grid">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->category): ?>
                                        <div class="pdp-info-item-card">
                                            <i class="fas fa-folder"></i>
                                            <span>Category</span>
                                            <strong><?php echo e($project->category->pc_name); ?></strong>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_status): ?>
                                        <div class="pdp-info-item-card">
                                            <i class="fas fa-tasks"></i>
                                            <span>Status</span>
                                            <strong class="status-<?php echo e($project->p_status); ?>"><?php echo e(ucfirst($project->p_status)); ?></strong>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_location): ?>
                                        <div class="pdp-info-item-card">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>Location</span>
                                            <strong><?php echo e($project->p_location); ?></strong>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_client): ?>
                                        <div class="pdp-info-item-card">
                                            <i class="fas fa-building"></i>
                                            <span>Client</span>
                                            <strong><?php echo e($project->p_client); ?></strong>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_start_date): ?>
                                        <div class="pdp-info-item-card">
                                            <i class="far fa-calendar-check"></i>
                                            <span>Start Date</span>
                                            <strong><?php echo e($project->p_start_date->format('M d, Y')); ?></strong>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_end_date): ?>
                                        <div class="pdp-info-item-card">
                                            <i class="far fa-calendar-times"></i>
                                            <span>Completion Date</span>
                                            <strong><?php echo e($project->p_end_date->format('M d, Y')); ?></strong>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($galleryImages) > 0): ?>
                            <div class="pdp-content-card" data-aos="fade-up">
                                <div class="pdp-content-body">
                                    <h3 class="pdp-section-title">Project Gallery</h3>
                                    <div class="pdp-gallery-grid">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <div class="pdp-gallery-item" @click="openGallery(<?php echo e($index); ?>)">
                                                <img src="<?php echo e(asset($img)); ?>" 
                                                     alt="Gallery <?php echo e($index + 1); ?>" 
                                                     loading="lazy">
                                                <div class="pdp-gallery-item-overlay">
                                                    <i class="fas fa-search-plus"></i>
                                                </div>
                                            </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                    </div>
                    
                    
                    <div class="col-lg-4">
                        <div class="pdp-sidebar">
                            
                            <div class="pdp-sidebar-card pdp-sidebar-cta">
                                <i class="fas fa-file-invoice pdp-sidebar-icon"></i>
                                <h4>Get Free Estimate</h4>
                                <p>Interested in a similar project? We'll respond within 30 minutes.</p>
                                <a href="<?php echo e(route('quote.index')); ?>" class="pdp-btn pdp-btn-accent w-100">
                                    <i class="fas fa-paper-plane me-2"></i> Request Quote
                                </a>
                            </div>
                            
                            
                            <div class="pdp-sidebar-card">
                                <h5 class="pdp-sidebar-title">Quick Contact</h5>
                                <div class="pdp-contact-list">
                                    <a href="tel:+923048902805" class="pdp-contact-item">
                                        <i class="fas fa-phone-alt"></i>
                                        <span>+92 304 8902805</span>
                                    </a>
                                    <a href="https://wa.me/923048902805" target="_blank" class="pdp-contact-item">
                                        <i class="fab fa-whatsapp"></i>
                                        <span>WhatsApp Chat</span>
                                    </a>
                                    <a href="mailto:info@razzaqengineering.com" class="pdp-contact-item">
                                        <i class="fas fa-envelope"></i>
                                        <span>info@razzaqengineering.com</span>
                                    </a>
                                </div>
                            </div>
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedProjects->count() > 0): ?>
                                <div class="pdp-sidebar-card">
                                    <h5 class="pdp-sidebar-title">Related Projects</h5>
                                    <div class="pdp-related-list">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $relatedProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <a href="<?php echo e(route('project.detail', ['slug' => $rp->p_slug ?? $rp->id])); ?>" class="pdp-related-item">
                                                <img src="<?php echo e($rp->image_url); ?>" alt="<?php echo e($rp->p_title); ?>" loading="lazy">
                                                <div>
                                                    <h6><?php echo e(Str::limit($rp->p_title, 35)); ?></h6>
                                                    <small><i class="fas fa-map-marker-alt me-1"></i><?php echo e($rp->p_location ?? 'N/A'); ?></small>
                                                </div>
                                                <i class="fas fa-chevron-right pdp-related-arrow"></i>
                                            </a>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            
                            <div class="pdp-sidebar-trust">
                                <div class="pdp-trust-mini">
                                    <i class="fas fa-shield-alt"></i> Licensed & Insured
                                </div>
                                <div class="pdp-trust-mini">
                                    <i class="fas fa-star"></i> 5 Star Service
                                </div>
                                <div class="pdp-trust-mini">
                                    <i class="fas fa-clock"></i> Available 24/7
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>
    
    
    <section class="pdp-final-cta">
        <div class="container text-center">
            <h2>Have a Project in Mind?</h2>
            <p class="mb-4">Let's discuss your requirements and bring your vision to life with our engineering expertise.</p>
            <div class="pdp-final-cta-buttons">
                <a href="<?php echo e(route('quote.index')); ?>" class="pdp-btn pdp-btn-lg pdp-btn-accent">
                    <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                </a>
                <a href="tel:+923048902805" class="pdp-btn pdp-btn-lg pdp-btn-white-outline-dark">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>

    
    <div class="pdp-gallery-modal" 
         x-show="galleryOpen !== null" 
         x-transition.opacity
         @click.self="closeGallery"
         x-cloak>
        <button class="pdp-gallery-close" @click="closeGallery">&times;</button>
        <button class="pdp-gallery-nav pdp-gallery-prev" @click.stop="prevImage">
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="pdp-gallery-content">
            <img src="<?php echo e(asset('p_image/')); ?>/<?php echo e($galleryImages[$activeGalleryImage] ?? ''); ?>" 
                 alt="Gallery Image" 
                 class="pdp-gallery-img"
                 x-show="galleryOpen !== null">
        </div>
        <button class="pdp-gallery-nav pdp-gallery-next" @click.stop="nextImage">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="pdp-gallery-counter" x-show="galleryOpen !== null">
            <?php echo e(($activeGalleryImage ?? 0) + 1); ?> / <?php echo e(count($galleryImages)); ?>

        </div>
    </div>

</div>


<style>
/* ============================================
   PROJECT DETAIL PAGE - ENTERPRISE GRADE
   Laravel 13 + Livewire 4 Compatible
   ============================================ */

[x-cloak] { display: none !important; }

/* --- Mobile Sticky CTA --- */
.pdp-mobile-cta {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 998;
    display: flex; background: #fff; box-shadow: 0 -4px 20px rgba(0,0,0,0.12);
}

.pdp-mobile-btn {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
    padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none;
    border: none; cursor: pointer; transition: all 0.2s;
}

.pdp-mobile-call { background: #f8f9fa; color: #0a1628; }
.pdp-mobile-whatsapp { background: #25D366; color: #fff; }
.pdp-mobile-quote { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; }

/* --- Hero Section --- */
.pdp-hero {
    position: relative; padding: 90px 0 70px; overflow: hidden;
    min-height: 520px; display: flex; align-items: center;
}

.pdp-hero-bg {
    position: absolute; inset: 0; background-size: cover; background-position: center;
    filter: brightness(0.3);
}

.pdp-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,61,128,0.88) 0%, rgba(26,92,42,0.82) 100%);
}

.pdp-hero .container { position: relative; z-index: 2; }

.pdp-breadcrumb {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px;
    font-size: 0.84rem; color: rgba(255,255,255,0.7); flex-wrap: wrap;
}

.pdp-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.pdp-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.pdp-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.pdp-breadcrumb a:hover { color: #fff; }
.pdp-breadcrumb .active { color: rgba(255,255,255,0.6); }

.pdp-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
    color: #fff; padding: 8px 18px; border-radius: 50px;
    font-size: 0.82rem; font-weight: 600; margin-bottom: 18px;
}

.pdp-hero-status {
    padding: 3px 12px; border-radius: 50px; font-size: 0.72rem; font-weight: 600;
}

.status-completed { background: #28a745; color: #fff; }
.status-ongoing { background: #0056b3; color: #fff; }
.status-planning { background: #f59e0b; color: #000; }
.status-on-hold { background: #6c757d; color: #fff; }

.pdp-hero-title { color: #fff; font-size: clamp(2rem, 5vw, 3rem); font-weight: 800; margin: 0 0 12px; line-height: 1.15; }
.pdp-hero-subtitle { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 550px; margin: 0 0 18px; line-height: 1.6; }

.pdp-hero-meta {
    display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 22px;
}

.pdp-hero-meta span {
    display: flex; align-items: center; gap: 6px; color: rgba(255,255,255,0.8);
    font-size: 0.84rem; font-weight: 500;
}

.pdp-hero-meta i { color: #28a745; }

.pdp-hero-cta { display: flex; gap: 12px; flex-wrap: wrap; }

.pdp-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 0.9rem;
    text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none;
    white-space: nowrap;
}

.pdp-btn-lg { padding: 14px 28px; font-size: 0.95rem; border-radius: 10px; }

.pdp-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.pdp-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; }

.pdp-btn-white-outline { background: transparent; color: #fff; border: 2px solid rgba(255,255,255,0.5); }
.pdp-btn-white-outline:hover { background: #fff; color: #003d80; border-color: #fff; }

.pdp-btn-white-outline-dark { background: transparent; color: #0a1628; border: 2px solid #0a1628; }
.pdp-btn-white-outline-dark:hover { background: #0a1628; color: #fff; }

.pdp-hero-image-wrapper { perspective: 1000px; }
.pdp-hero-image {
    max-height: 320px; border-radius: 16px; box-shadow: 0 25px 60px rgba(0,0,0,0.4);
    border: 4px solid rgba(255,255,255,0.2); transform: rotateY(-5deg);
    transition: transform 0.5s ease;
}

.pdp-hero-image-wrapper:hover .pdp-hero-image { transform: rotateY(0deg); }

/* --- Trust Bar --- */
.pdp-trust-bar { background: #fff; border-bottom: 1px solid #eef0f2; }

.pdp-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); }

.pdp-trust-card {
    display: flex; align-items: center; gap: 12px; padding: 20px;
    border-right: 1px solid #f0f0f0;
}

.pdp-trust-card:last-child { border-right: none; }

.pdp-trust-icon {
    width: 44px; height: 44px; min-width: 44px; background: rgba(40,167,69,0.1);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #28a745; font-size: 1.1rem;
}

.pdp-trust-card strong { display: block; font-size: 1.1rem; color: #0a1628; }
.pdp-trust-card span { font-size: 0.75rem; color: #888; }

/* --- Main Section --- */
.pdp-main-section { padding: 40px 0 60px; background: #f8f9fa; }

/* --- Content Card --- */
.pdp-content-card {
    background: #fff; border-radius: 14px; overflow: hidden; margin-bottom: 20px;
    box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
}

.pdp-image-hero { position: relative; }

.pdp-img-full { width: 100%; height: 350px; object-fit: cover; display: block; }

.pdp-image-gradient {
    position: absolute; bottom: 0; left: 0; right: 0; height: 80px;
    background: linear-gradient(transparent, rgba(0,0,0,0.4));
}

.pdp-gallery-trigger {
    position: absolute; bottom: 18px; right: 18px; z-index: 2;
    background: rgba(0,0,0,0.7); backdrop-filter: blur(8px);
    color: #fff; border: none; padding: 9px 20px; border-radius: 50px;
    font-size: 0.82rem; font-weight: 600; cursor: pointer; transition: all 0.3s;
}

.pdp-gallery-trigger:hover { background: #28a745; }

.pdp-content-body { padding: 25px; }

.pdp-section-title { font-size: clamp(1.3rem, 2.5vw, 1.6rem); font-weight: 800; color: #0a1628; margin: 0 0 15px; line-height: 1.3; }

.pdp-description { font-size: 0.92rem; color: #666; line-height: 1.8; margin-bottom: 15px; }

.pdp-read-more {
    background: none; border: none; color: #0056b3; font-weight: 700; cursor: pointer;
    padding: 0; font-size: 0.85rem; margin-bottom: 15px;
}

.pdp-read-more:hover { color: #28a745; }

/* Mid CTA */
.pdp-mid-cta { margin: 20px 0; }

.pdp-mid-cta-inner {
    display: flex; align-items: center; gap: 15px; background: #f0f7ff;
    border-radius: 12px; padding: 18px 20px; border: 2px dashed #0056b3;
}

.pdp-mid-cta-icon { font-size: 1.8rem; color: #0056b3; }

.pdp-mid-cta-inner strong { display: block; font-size: 0.9rem; color: #0a1628; }
.pdp-mid-cta-inner span { font-size: 0.78rem; color: #888; }
.pdp-mid-cta-inner .pdp-btn { margin-left: auto; flex-shrink: 0; }

/* Info Grid */
.pdp-info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-top: 20px; }

.pdp-info-item-card {
    display: flex; flex-direction: column; gap: 4px; background: #f8faf9;
    padding: 14px 16px; border-radius: 10px;
}

.pdp-info-item-card i { color: #28a745; font-size: 1rem; }
.pdp-info-item-card span { font-size: 0.7rem; color: #888; text-transform: uppercase; letter-spacing: 1px; }
.pdp-info-item-card strong { font-size: 0.9rem; color: #0a1628; }

/* Gallery Grid */
.pdp-gallery-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }

.pdp-gallery-item {
    position: relative; border-radius: 10px; overflow: hidden; cursor: pointer;
    aspect-ratio: 4/3;
}

.pdp-gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
.pdp-gallery-item:hover img { transform: scale(1.08); }

.pdp-gallery-item-overlay {
    position: absolute; inset: 0; background: rgba(0,0,0,0.4);
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.3s; color: #fff; font-size: 1.5rem;
}

.pdp-gallery-item:hover .pdp-gallery-item-overlay { opacity: 1; }

/* --- Sidebar --- */
.pdp-sidebar { position: sticky; top: 20px; }

.pdp-sidebar-card {
    background: #fff; border-radius: 12px; padding: 20px; margin-bottom: 15px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
}

.pdp-sidebar-cta {
    text-align: center; background: linear-gradient(135deg, #0056b3, #003d80); color: #fff;
    border: none;
}

.pdp-sidebar-cta .pdp-sidebar-icon { font-size: 2rem; margin-bottom: 10px; display: block; }
.pdp-sidebar-cta h4 { font-size: 1.1rem; font-weight: 800; margin: 0 0 5px; }
.pdp-sidebar-cta p { font-size: 0.8rem; opacity: 0.8; margin-bottom: 15px; }

.pdp-sidebar-title { font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #888; margin: 0 0 12px; }

.pdp-contact-item {
    display: flex; align-items: center; gap: 10px; padding: 10px 0; text-decoration: none;
    color: #555; font-size: 0.85rem; border-bottom: 1px solid #f5f5f5; transition: all 0.2s;
}

.pdp-contact-item:last-child { border-bottom: none; }
.pdp-contact-item:hover { color: #28a745; }
.pdp-contact-item i { width: 20px; color: #28a745; text-align: center; }

.pdp-related-item {
    display: flex; align-items: center; gap: 12px; padding: 12px 0;
    border-bottom: 1px solid #f0f0f0; text-decoration: none; transition: all 0.2s;
}

.pdp-related-item:last-child { border-bottom: none; }
.pdp-related-item:hover { padding-left: 5px; }

.pdp-related-item img { width: 50px; height: 50px; border-radius: 8px; object-fit: cover; flex-shrink: 0; }

.pdp-related-item h6 { font-size: 0.84rem; color: #0a1628; margin: 0 0 3px; }
.pdp-related-item small { font-size: 0.75rem; color: #888; }
.pdp-related-arrow { margin-left: auto; color: #ccc; font-size: 0.75rem; transition: color 0.2s; }
.pdp-related-item:hover .pdp-related-arrow { color: #28a745; }

.pdp-sidebar-trust { display: flex; flex-direction: column; gap: 8px; }

.pdp-trust-mini {
    display: flex; align-items: center; gap: 8px; padding: 10px 14px; background: #fff;
    border-radius: 8px; font-size: 0.78rem; font-weight: 600; color: #0a1628;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04); border: 1px solid #eef0f2;
}

.pdp-trust-mini i { color: #28a745; }

/* --- Gallery Modal --- */
.pdp-gallery-modal {
    position: fixed; inset: 0; z-index: 99999; background: rgba(0,0,0,0.92);
    display: flex; align-items: center; justify-content: center;
}

.pdp-gallery-close {
    position: absolute; top: 20px; right: 25px; background: none; border: none;
    color: #fff; font-size: 2.5rem; cursor: pointer; z-index: 10; transition: color 0.3s;
}

.pdp-gallery-close:hover { color: #dc3545; }

.pdp-gallery-nav {
    position: absolute; top: 50%; transform: translateY(-50%);
    background: rgba(255,255,255,0.12); color: #fff; border: none;
    width: 50px; height: 50px; border-radius: 50%; font-size: 1.3rem;
    cursor: pointer; transition: all 0.3s; display: flex; align-items: center;
    justify-content: center; z-index: 10;
}

.pdp-gallery-nav:hover { background: rgba(255,255,255,0.25); }
.pdp-gallery-prev { left: 25px; }
.pdp-gallery-next { right: 25px; }

.pdp-gallery-content { max-width: 85vw; max-height: 80vh; }

.pdp-gallery-img { max-width: 85vw; max-height: 80vh; border-radius: 10px; object-fit: contain; }

.pdp-gallery-counter {
    position: absolute; bottom: 25px; left: 50%; transform: translateX(-50%);
    color: rgba(255,255,255,0.7); font-size: 0.9rem; font-weight: 600;
    background: rgba(0,0,0,0.5); padding: 6px 18px; border-radius: 50px;
}

/* --- Final CTA --- */
.pdp-final-cta { padding: 60px 0; background: #fff; }

.pdp-final-cta h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 10px; }
.pdp-final-cta p { font-size: 1rem; color: #666; max-width: 500px; margin: 0 auto 20px; }

.pdp-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

/* --- States --- */
.pdp-state-box { text-align: center; padding: 50px 20px; }

.pdp-error-card {
    max-width: 450px; margin: 0 auto; padding: 35px 25px; background: #fff;
    border-radius: 14px; box-shadow: 0 5px 30px rgba(0,0,0,0.08); text-align: center;
}

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 1199.98px) {
    .pdp-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .pdp-trust-card:nth-child(2) { border-right: none; }
    .pdp-gallery-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 991.98px) {
    .pdp-hero { padding: 60px 0 50px; min-height: auto; }
    .pdp-hero-title { font-size: 1.7rem; }
    .pdp-mid-cta-inner { flex-wrap: wrap; }
    .pdp-mid-cta-inner .pdp-btn { margin-left: 0; width: 100%; }
    .pdp-sidebar { position: static; margin-top: 20px; }
    .pdp-info-grid { grid-template-columns: 1fr 1fr; }
}

@media (max-width: 767.98px) {
    .pdp-hero { padding: 45px 0 40px; }
    .pdp-hero-title { font-size: 1.4rem; }
    .pdp-hero-subtitle { font-size: 0.9rem; }
    .pdp-hero-cta { flex-direction: column; }
    .pdp-hero-cta .pdp-btn { width: 100%; justify-content: center; }
    .pdp-hero-meta { gap: 12px; }
    .pdp-trust-grid { grid-template-columns: 1fr 1fr; }
    .pdp-trust-card { padding: 14px; gap: 8px; }
    .pdp-img-full { height: 250px; }
    .pdp-content-body { padding: 18px; }
    .pdp-gallery-grid { grid-template-columns: repeat(2, 1fr); }
    .pdp-gallery-nav { width: 40px; height: 40px; }
    .pdp-gallery-prev { left: 10px; }
    .pdp-gallery-next { right: 10px; }
}

@media (max-width: 575.98px) {
    .pdp-hero { padding: 35px 0 30px; }
    .pdp-hero-title { font-size: 1.2rem; }
    .pdp-breadcrumb { font-size: 0.72rem; }
    .pdp-hero-badge { font-size: 0.72rem; padding: 6px 12px; }
    .pdp-hero-meta span { font-size: 0.75rem; }
    .pdp-trust-grid { grid-template-columns: 1fr 1fr; }
    .pdp-trust-card { padding: 12px 10px; border-bottom: 1px solid #f0f0f0; }
    .pdp-trust-card:nth-child(even) { border-right: none; }
    .pdp-trust-icon { width: 34px; height: 34px; min-width: 34px; font-size: 0.9rem; }
    .pdp-trust-card strong { font-size: 0.9rem; }
    .pdp-trust-card span { font-size: 0.68rem; }
    .pdp-img-full { height: 200px; }
    .pdp-content-body { padding: 14px; }
    .pdp-section-title { font-size: 1.15rem; }
    .pdp-description { font-size: 0.84rem; }
    .pdp-info-grid { grid-template-columns: 1fr; }
    .pdp-gallery-grid { grid-template-columns: 1fr; }
    .pdp-gallery-trigger { bottom: 10px; right: 10px; padding: 7px 14px; font-size: 0.75rem; }
    .pdp-final-cta { padding: 40px 0; }
    .pdp-final-cta-buttons { flex-direction: column; }
    .pdp-final-cta-buttons .pdp-btn { width: 100%; justify-content: center; }
    .pdp-gallery-nav { width: 36px; height: 36px; font-size: 1rem; }
    .pdp-gallery-close { top: 12px; right: 15px; font-size: 2rem; }
    body { padding-bottom: 55px; }
}
</style>


<script>
document.addEventListener('livewire:navigated', () => {
    if (typeof AOS !== 'undefined') AOS.refresh();
});
</script><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/project-detail-page.blade.php ENDPATH**/ ?>