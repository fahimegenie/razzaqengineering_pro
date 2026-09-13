<div class="fdp-page" 
     x-data="{ 
        showFullDesc: false,
        showFullSpecs: false,
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
    
    
    <div class="fdp-mobile-cta d-lg-none">
        <a href="tel:+923048902805" class="fdp-mobile-btn fdp-mobile-call">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/923048902805" target="_blank" class="fdp-mobile-btn fdp-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="<?php echo e(route('quote.index')); ?>" class="fdp-mobile-btn fdp-mobile-quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    
    <section class="fdp-hero">
        <div class="fdp-hero-bg" style="background-image: url('<?php echo e($fleetItem->image_url ?? asset('images/fleet-hero-bg.jpg')); ?>');"></div>
        <div class="fdp-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-30">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="fdp-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li><a href="<?php echo e(route('public.fleet')); ?>">Our Fleet</a></li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fleetItem && $fleetItem->category): ?>
                                <li><a href="<?php echo e(url('our-fleet?category='.$fleetItem->category->slug)); ?>"><?php echo e($fleetItem->category->name); ?></a></li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <li class="active"><?php echo e($fleetItem->title ?? 'Fleet Details'); ?></li>
                        </ol>
                    </nav>
                    
                    <div class="fdp-hero-badge">
                        <i class="fas fa-truck-monster"></i> 
                        <?php echo e($fleetItem->category->name ?? 'Heavy Machinery'); ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($fleetItem->manufacturer)): ?>
                            <span class="fdp-hero-badge-sub"><?php echo e($fleetItem->manufacturer); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    
                    <h1 class="fdp-hero-title"><?php echo e($fleetItem->title ?? 'Fleet Details'); ?></h1>
                    
                    <p class="fdp-hero-subtitle">
                        <?php echo e($fleetItem->description ? Str::limit($fleetItem->description, 120) : 'Professional heavy machinery available for your industrial and construction projects.'); ?>

                    </p>
                    
                    <div class="fdp-hero-meta">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fleetItem->manufacturer): ?>
                            <span><i class="fas fa-industry"></i> <?php echo e($fleetItem->manufacturer); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fleetItem->model_number): ?>
                            <span><i class="fas fa-tag"></i> Model: <?php echo e($fleetItem->model_number); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fleetItem->category): ?>
                            <span><i class="fas fa-layer-group"></i> <?php echo e($fleetItem->category->name); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    
                    <div class="fdp-hero-cta">
                        <a href="<?php echo e(route('quote.index')); ?>" class="fdp-btn fdp-btn-lg fdp-btn-accent">
                            <i class="fas fa-paper-plane me-2"></i> Rent This Equipment
                        </a>
                        <a href="tel:+923048902805" class="fdp-btn fdp-btn-lg fdp-btn-white-outline">
                            <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-block text-center" data-aos="fade-left">
                    <div class="fdp-hero-image-wrapper">
                        <img src="<?php echo e($fleetItem->image_url ?? asset('images/placeholder-fleet.jpg')); ?>" 
                             alt="<?php echo e($fleetItem->title ?? 'Fleet Item'); ?>" 
                             class="fdp-hero-image"
                             loading="eager">
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="fdp-trust-bar">
        <div class="container">
            <div class="fdp-trust-grid">
                <div class="fdp-trust-card">
                    <div class="fdp-trust-icon"><i class="fas fa-tools"></i></div>
                    <div>
                        <strong>500+</strong>
                        <span>Heavy Machines</span>
                    </div>
                </div>
                <div class="fdp-trust-card">
                    <div class="fdp-trust-icon"><i class="fas fa-calendar-check"></i></div>
                    <div>
                        <strong>Well-Maintained</strong>
                        <span>Regular Servicing</span>
                    </div>
                </div>
                <div class="fdp-trust-card">
                    <div class="fdp-trust-icon"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <strong>100%</strong>
                        <span>Operational Ready</span>
                    </div>
                </div>
                <div class="fdp-trust-card">
                    <div class="fdp-trust-icon"><i class="fas fa-certificate"></i></div>
                    <div>
                        <strong>Certified</strong>
                        <span>Operators</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="fdp-main-section">
        <div class="container">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="fdp-state-box">
                    <div class="spinner-grow text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-3 fw-semibold">Loading equipment details...</p>
                </div>
            
            <?php elseif($errorMessage): ?>
                <div class="fdp-error-card">
                    <i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;"></i>
                    <h4 class="fw-bold mt-3">Oops! Something went wrong</h4>
                    <p class="text-muted"><?php echo e($errorMessage); ?></p>
                    <a href="<?php echo e(route('public.fleet')); ?>" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-left me-2"></i> Back to Fleet
                    </a>
                </div>
            
            <?php elseif($fleetItem): ?>
                <div class="row g-4">
                    
                    
                    <div class="col-lg-8">
                        
                        
                        <div class="fdp-content-card" data-aos="fade-up">
                            <div class="fdp-image-hero">
                                <img src="<?php echo e($fleetItem->image_url); ?>" 
                                     alt="<?php echo e($fleetItem->title); ?>" 
                                     class="fdp-img-full"
                                     loading="lazy">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($galleryImages) > 0): ?>
                                    <button class="fdp-gallery-trigger" @click="openGallery(0)">
                                        <i class="fas fa-images me-2"></i> View Gallery (<?php echo e(count($galleryImages)); ?> photos)
                                    </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div class="fdp-image-gradient"></div>
                            </div>
                            
                            <div class="fdp-content-body">
                                <h2 class="fdp-section-title">Equipment Overview</h2>
                                
                                <div class="fdp-description">
                                    <?php echo Str::words(strip_tags($fleetItem->description ?? ''), 80, '...'); ?>

                                </div>
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fleetItem->description && Str::wordCount(strip_tags($fleetItem->description)) > 80): ?>
                                    <div x-show="showFullDesc" x-transition class="fdp-description">
                                        <?php echo $fleetItem->description; ?>

                                    </div>
                                    <button @click="showFullDesc = !showFullDesc" 
                                            class="fdp-read-more"
                                            x-text="showFullDesc ? 'Show Less' : 'Read Full Description'">
                                    </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                
                                <div class="fdp-mid-cta">
                                    <div class="fdp-mid-cta-inner">
                                        <i class="fas fa-phone-alt fdp-mid-cta-icon"></i>
                                        <div>
                                            <strong>Need This Equipment?</strong>
                                            <span>Contact us for availability and rental rates</span>
                                        </div>
                                        <a href="tel:+923048902805" class="fdp-btn fdp-btn-accent">+92 304 8902805</a>
                                    </div>
                                </div>
                                
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fleetItem->specifications && count($fleetItem->specifications) > 0): ?>
                                    <h3 class="fdp-section-title mt-4">Technical Specifications</h3>
                                    <div class="fdp-specs-grid">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = array_slice($fleetItem->specifications, 0, 6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <div class="fdp-spec-item">
                                                <span class="fdp-spec-label"><?php echo e($key); ?></span>
                                                <span class="fdp-spec-value"><?php echo e($value); ?></span>
                                            </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>
                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($fleetItem->specifications) > 6): ?>
                                        <div x-show="showFullSpecs" x-transition>
                                            <div class="fdp-specs-grid mt-2">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = array_slice($fleetItem->specifications, 6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                    <div class="fdp-spec-item">
                                                        <span class="fdp-spec-label"><?php echo e($key); ?></span>
                                                        <span class="fdp-spec-value"><?php echo e($value); ?></span>
                                                    </div>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                            </div>
                                        </div>
                                        <button @click="showFullSpecs = !showFullSpecs" 
                                                class="fdp-read-more mt-2"
                                                x-text="showFullSpecs ? 'Show Less' : 'View All Specifications'">
                                        </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fleetItem->features && count($fleetItem->features) > 0): ?>
                                    <h3 class="fdp-section-title mt-4">Key Features</h3>
                                    <div class="fdp-features-list">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $fleetItem->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <div class="fdp-feature-item">
                                                <i class="fas fa-check-circle"></i>
                                                <span><?php echo e($feature); ?></span>
                                            </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                
                                <h3 class="fdp-section-title mt-4">Equipment Information</h3>
                                <div class="fdp-info-grid">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fleetItem->category): ?>
                                        <div class="fdp-info-item-card">
                                            <i class="fas fa-folder"></i>
                                            <span>Category</span>
                                            <strong><?php echo e($fleetItem->category->name); ?></strong>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fleetItem->manufacturer): ?>
                                        <div class="fdp-info-item-card">
                                            <i class="fas fa-industry"></i>
                                            <span>Manufacturer</span>
                                            <strong><?php echo e($fleetItem->manufacturer); ?></strong>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fleetItem->model_number): ?>
                                        <div class="fdp-info-item-card">
                                            <i class="fas fa-tag"></i>
                                            <span>Model Number</span>
                                            <strong><?php echo e($fleetItem->model_number); ?></strong>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div class="fdp-info-item-card">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Status</span>
                                        <strong class="text-success">Available for Project</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($galleryImages) > 0): ?>
                            <div class="fdp-content-card" data-aos="fade-up">
                                <div class="fdp-content-body">
                                    <h3 class="fdp-section-title">Equipment Gallery</h3>
                                    <div class="fdp-gallery-grid">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <div class="fdp-gallery-item" @click="openGallery(<?php echo e($index); ?>)">
                                                <img src="<?php echo e(asset($img)); ?>" 
                                                     alt="Gallery <?php echo e($index + 1); ?>" 
                                                     loading="lazy">
                                                <div class="fdp-gallery-item-overlay">
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
                        <div class="fdp-sidebar">
                            
                            <div class="fdp-sidebar-card fdp-sidebar-cta">
                                <i class="fas fa-file-invoice fdp-sidebar-icon"></i>
                                <h4>Rent This Equipment</h4>
                                <p>Get competitive rates for your project. We respond within 30 minutes.</p>
                                <a href="<?php echo e(route('quote.index')); ?>" class="fdp-btn fdp-btn-accent w-100">
                                    <i class="fas fa-paper-plane me-2"></i> Request Quote
                                </a>
                            </div>
                            
                            
                            <div class="fdp-sidebar-card">
                                <h5 class="fdp-sidebar-title">Quick Contact</h5>
                                <div class="fdp-contact-list">
                                    <a href="tel:+923048902805" class="fdp-contact-item">
                                        <i class="fas fa-phone-alt"></i>
                                        <span>+92 304 8902805</span>
                                    </a>
                                    <a href="https://wa.me/923048902805" target="_blank" class="fdp-contact-item">
                                        <i class="fab fa-whatsapp"></i>
                                        <span>WhatsApp Chat</span>
                                    </a>
                                    <a href="mailto:info@razzaqengineering.com" class="fdp-contact-item">
                                        <i class="fas fa-envelope"></i>
                                        <span>info@razzaqengineering.com</span>
                                    </a>
                                </div>
                            </div>
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedFleetItems && $relatedFleetItems->count() > 0): ?>
                                <div class="fdp-sidebar-card">
                                    <h5 class="fdp-sidebar-title">Related Equipment</h5>
                                    <div class="fdp-related-list">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $relatedFleetItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <a href="<?php echo e(route('fleet.detail', ['slug' => $ri->slug])); ?>" class="fdp-related-item">
                                                <img src="<?php echo e($ri->image_url); ?>" alt="<?php echo e($ri->title); ?>" loading="lazy">
                                                <div>
                                                    <h6><?php echo e(Str::limit($ri->title, 35)); ?></h6>
                                                    <small>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ri->category): ?>
                                                            <i class="fas fa-layer-group me-1"></i><?php echo e($ri->category->name); ?>

                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    </small>
                                                </div>
                                                <i class="fas fa-chevron-right fdp-related-arrow"></i>
                                            </a>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            
                            <div class="fdp-sidebar-trust">
                                <div class="fdp-trust-mini">
                                    <i class="fas fa-shield-alt"></i> Fully Insured Equipment
                                </div>
                                <div class="fdp-trust-mini">
                                    <i class="fas fa-tools"></i> Regular Maintenance
                                </div>
                                <div class="fdp-trust-mini">
                                    <i class="fas fa-clock"></i> Available for Immediate Deployment
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>
    
    
    <section class="fdp-final-cta">
        <div class="container text-center">
            <h2>Need Heavy Equipment for Your Project?</h2>
            <p class="mb-4">Our fleet of modern machinery and experienced operators are ready to deploy for your next industrial project.</p>
            <div class="fdp-final-cta-buttons">
                <a href="<?php echo e(route('quote.index')); ?>" class="fdp-btn fdp-btn-lg fdp-btn-accent">
                    <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                </a>
                <a href="tel:+923048902805" class="fdp-btn fdp-btn-lg fdp-btn-white-outline-dark">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>

    
    <div class="fdp-gallery-modal" 
         x-show="galleryOpen !== null" 
         x-transition.opacity
         @click.self="closeGallery"
         x-cloak>
        <button class="fdp-gallery-close" @click="closeGallery">&times;</button>
        <button class="fdp-gallery-nav fdp-gallery-prev" @click.stop="prevImage">
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="fdp-gallery-content">
            <img src="<?php echo e(asset($galleryImages[$activeGalleryImage] ?? '')); ?>" 
                 alt="Gallery Image" 
                 class="fdp-gallery-img"
                 x-show="galleryOpen !== null">
        </div>
        <button class="fdp-gallery-nav fdp-gallery-next" @click.stop="nextImage">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="fdp-gallery-counter" x-show="galleryOpen !== null">
            <?php echo e(($activeGalleryImage ?? 0) + 1); ?> / <?php echo e(count($galleryImages)); ?>

        </div>
    </div>

</div>

<?php $__env->startPush('styles'); ?>

<style>
    
    /* ============================================
   FLEET DETAIL PAGE - ENTERPRISE GRADE
   Laravel 13 + Livewire 4 Compatible
   ============================================ */

[x-cloak] { display: none !important; }

/* --- Mobile Sticky CTA --- */
.fdp-mobile-cta {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 998;
    display: flex; background: #fff; box-shadow: 0 -4px 20px rgba(0,0,0,0.12);
}

.fdp-mobile-btn {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
    padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none;
    border: none; cursor: pointer; transition: all 0.2s;
}

.fdp-mobile-call { background: #f8f9fa; color: #0a1628; }
.fdp-mobile-whatsapp { background: #25D366; color: #fff; }
.fdp-mobile-quote { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; }

/* --- Hero Section --- */
.fdp-hero {
    position: relative; padding: 90px 0 70px; overflow: hidden;
    min-height: 520px; display: flex; align-items: center;
}

.fdp-hero-bg {
    position: absolute; inset: 0; background-size: cover; background-position: center;
    filter: brightness(0.3);
}

.fdp-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,61,128,0.88) 0%, rgba(26,92,42,0.82) 100%);
}

.fdp-hero .container { position: relative; z-index: 2; }

.fdp-breadcrumb {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px;
    font-size: 0.84rem; color: rgba(255,255,255,0.7); flex-wrap: wrap;
}

.fdp-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.fdp-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.fdp-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.fdp-breadcrumb a:hover { color: #fff; }
.fdp-breadcrumb .active { color: rgba(255,255,255,0.6); }

.fdp-hero-badge {
    display: inline-flex; align-items: center; gap: 10px;
    background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
    color: #fff; padding: 8px 18px; border-radius: 50px;
    font-size: 0.82rem; font-weight: 600; margin-bottom: 18px;
}

.fdp-hero-badge-sub {
    padding: 3px 12px; border-radius: 50px; font-size: 0.72rem;
    background: rgba(255,255,255,0.2); font-weight: 500;
}

.fdp-hero-title { color: #fff; font-size: clamp(2rem, 5vw, 3rem); font-weight: 800; margin: 0 0 12px; line-height: 1.15; }
.fdp-hero-subtitle { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 550px; margin: 0 0 18px; line-height: 1.6; }

.fdp-hero-meta {
    display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 22px;
}

.fdp-hero-meta span {
    display: flex; align-items: center; gap: 6px; color: rgba(255,255,255,0.8);
    font-size: 0.84rem; font-weight: 500;
}

.fdp-hero-meta i { color: #28a745; }

.fdp-hero-cta { display: flex; gap: 12px; flex-wrap: wrap; }

.fdp-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 0.9rem;
    text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none;
    white-space: nowrap;
}

.fdp-btn-lg { padding: 14px 28px; font-size: 0.95rem; border-radius: 10px; }

.fdp-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.fdp-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; }

.fdp-btn-white-outline { background: transparent; color: #fff; border: 2px solid rgba(255,255,255,0.5); }
.fdp-btn-white-outline:hover { background: #fff; color: #003d80; border-color: #fff; }

.fdp-btn-white-outline-dark { background: transparent; color: #0a1628; border: 2px solid #0a1628; }
.fdp-btn-white-outline-dark:hover { background: #0a1628; color: #fff; }

.fdp-hero-image-wrapper { perspective: 1000px; }
.fdp-hero-image {
    max-height: 320px; border-radius: 16px; box-shadow: 0 25px 60px rgba(0,0,0,0.4);
    border: 4px solid rgba(255,255,255,0.2); transform: rotateY(-5deg);
    transition: transform 0.5s ease; width: 100%; object-fit: cover;
}

.fdp-hero-image-wrapper:hover .fdp-hero-image { transform: rotateY(0deg); }

/* --- Trust Bar --- */
.fdp-trust-bar { background: #fff; border-bottom: 1px solid #eef0f2; }

.fdp-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); }

.fdp-trust-card {
    display: flex; align-items: center; gap: 12px; padding: 20px;
    border-right: 1px solid #f0f0f0;
}

.fdp-trust-card:last-child { border-right: none; }

.fdp-trust-icon {
    width: 44px; height: 44px; min-width: 44px; background: rgba(40,167,69,0.1);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #28a745; font-size: 1.1rem;
}

.fdp-trust-card strong { display: block; font-size: 1.1rem; color: #0a1628; }
.fdp-trust-card span { font-size: 0.75rem; color: #888; }

/* --- Main Section --- */
.fdp-main-section { padding: 40px 0 60px; background: #f8f9fa; }

/* --- Content Card --- */
.fdp-content-card {
    background: #fff; border-radius: 14px; overflow: hidden; margin-bottom: 20px;
    box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
}

.fdp-image-hero { position: relative; }

.fdp-img-full { width: 100%; height: 350px; object-fit: cover; display: block; }

.fdp-image-gradient {
    position: absolute; bottom: 0; left: 0; right: 0; height: 80px;
    background: linear-gradient(transparent, rgba(0,0,0,0.4));
}

.fdp-gallery-trigger {
    position: absolute; bottom: 18px; right: 18px; z-index: 2;
    background: rgba(0,0,0,0.7); backdrop-filter: blur(8px);
    color: #fff; border: none; padding: 9px 20px; border-radius: 50px;
    font-size: 0.82rem; font-weight: 600; cursor: pointer; transition: all 0.3s;
}

.fdp-gallery-trigger:hover { background: #28a745; }

.fdp-content-body { padding: 25px; }

.fdp-section-title { font-size: clamp(1.3rem, 2.5vw, 1.6rem); font-weight: 800; color: #0a1628; margin: 0 0 15px; line-height: 1.3; }

.fdp-description { font-size: 0.92rem; color: #666; line-height: 1.8; margin-bottom: 15px; }

.fdp-read-more {
    background: none; border: none; color: #0056b3; font-weight: 700; cursor: pointer;
    padding: 0; font-size: 0.85rem; margin-bottom: 15px; display: block;
}

.fdp-read-more:hover { color: #28a745; }

/* Mid CTA */
.fdp-mid-cta { margin: 20px 0; }

.fdp-mid-cta-inner {
    display: flex; align-items: center; gap: 15px; background: #f0f7ff;
    border-radius: 12px; padding: 18px 20px; border: 2px dashed #0056b3;
}

.fdp-mid-cta-icon { font-size: 1.8rem; color: #0056b3; }

.fdp-mid-cta-inner strong { display: block; font-size: 0.9rem; color: #0a1628; }
.fdp-mid-cta-inner span { font-size: 0.78rem; color: #888; }
.fdp-mid-cta-inner .fdp-btn { margin-left: auto; flex-shrink: 0; }

/* Specs Grid */
.fdp-specs-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-top: 15px; }

.fdp-spec-item {
    display: flex; flex-direction: column; gap: 3px; background: #f8faf9;
    padding: 12px 14px; border-radius: 8px; border-left: 3px solid #28a745;
}

.fdp-spec-label { font-size: 0.7rem; color: #888; text-transform: uppercase; letter-spacing: 0.5px; }
.fdp-spec-value { font-size: 0.88rem; color: #0a1628; font-weight: 600; }

/* Features List */
.fdp-features-list { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-top: 12px; }

.fdp-feature-item {
    display: flex; align-items: flex-start; gap: 8px; padding: 10px;
    background: #f8faf9; border-radius: 8px; font-size: 0.84rem; color: #555;
}

.fdp-feature-item i { color: #28a745; margin-top: 2px; flex-shrink: 0; }

/* Info Grid */
.fdp-info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-top: 15px; }

.fdp-info-item-card {
    display: flex; flex-direction: column; gap: 4px; background: #f8faf9;
    padding: 14px 16px; border-radius: 10px;
}

.fdp-info-item-card i { color: #28a745; font-size: 1rem; }
.fdp-info-item-card span { font-size: 0.7rem; color: #888; text-transform: uppercase; letter-spacing: 1px; }
.fdp-info-item-card strong { font-size: 0.9rem; color: #0a1628; }

/* Gallery Grid */
.fdp-gallery-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }

.fdp-gallery-item {
    position: relative; border-radius: 10px; overflow: hidden; cursor: pointer;
    aspect-ratio: 4/3;
}

.fdp-gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
.fdp-gallery-item:hover img { transform: scale(1.08); }

.fdp-gallery-item-overlay {
    position: absolute; inset: 0; background: rgba(0,0,0,0.4);
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.3s; color: #fff; font-size: 1.5rem;
}

.fdp-gallery-item:hover .fdp-gallery-item-overlay { opacity: 1; }

/* --- Sidebar --- */
.fdp-sidebar { position: sticky; top: 20px; }

.fdp-sidebar-card {
    background: #fff; border-radius: 12px; padding: 20px; margin-bottom: 15px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
}

.fdp-sidebar-cta {
    text-align: center; background: linear-gradient(135deg, #0056b3, #003d80); color: #fff;
    border: none;
}

.fdp-sidebar-cta .fdp-sidebar-icon { font-size: 2rem; margin-bottom: 10px; display: block; }
.fdp-sidebar-cta h4 { font-size: 1.1rem; font-weight: 800; margin: 0 0 5px; }
.fdp-sidebar-cta p { font-size: 0.8rem; opacity: 0.8; margin-bottom: 15px; }

.fdp-sidebar-title { font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #888; margin: 0 0 12px; }

.fdp-contact-item {
    display: flex; align-items: center; gap: 10px; padding: 10px 0; text-decoration: none;
    color: #555; font-size: 0.85rem; border-bottom: 1px solid #f5f5f5; transition: all 0.2s;
}

.fdp-contact-item:last-child { border-bottom: none; }
.fdp-contact-item:hover { color: #28a745; }
.fdp-contact-item i { width: 20px; color: #28a745; text-align: center; }

.fdp-related-item {
    display: flex; align-items: center; gap: 12px; padding: 12px 0;
    border-bottom: 1px solid #f0f0f0; text-decoration: none; transition: all 0.2s;
}

.fdp-related-item:last-child { border-bottom: none; }
.fdp-related-item:hover { padding-left: 5px; }

.fdp-related-item img { width: 50px; height: 50px; border-radius: 8px; object-fit: cover; flex-shrink: 0; }

.fdp-related-item h6 { font-size: 0.84rem; color: #0a1628; margin: 0 0 3px; }
.fdp-related-item small { font-size: 0.75rem; color: #888; }
.fdp-related-arrow { margin-left: auto; color: #ccc; font-size: 0.75rem; transition: color 0.2s; }
.fdp-related-item:hover .fdp-related-arrow { color: #28a745; }

.fdp-sidebar-trust { display: flex; flex-direction: column; gap: 8px; }

.fdp-trust-mini {
    display: flex; align-items: center; gap: 8px; padding: 10px 14px; background: #fff;
    border-radius: 8px; font-size: 0.78rem; font-weight: 600; color: #0a1628;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04); border: 1px solid #eef0f2;
}

.fdp-trust-mini i { color: #28a745; }

/* --- Gallery Modal --- */
.fdp-gallery-modal {
    position: fixed; inset: 0; z-index: 99999; background: rgba(0,0,0,0.92);
    display: flex; align-items: center; justify-content: center;
}

.fdp-gallery-close {
    position: absolute; top: 20px; right: 25px; background: none; border: none;
    color: #fff; font-size: 2.5rem; cursor: pointer; z-index: 10; transition: color 0.3s;
}

.fdp-gallery-close:hover { color: #dc3545; }

.fdp-gallery-nav {
    position: absolute; top: 50%; transform: translateY(-50%);
    background: rgba(255,255,255,0.12); color: #fff; border: none;
    width: 50px; height: 50px; border-radius: 50%; font-size: 1.3rem;
    cursor: pointer; transition: all 0.3s; display: flex; align-items: center;
    justify-content: center; z-index: 10;
}

.fdp-gallery-nav:hover { background: rgba(255,255,255,0.25); }
.fdp-gallery-prev { left: 25px; }
.fdp-gallery-next { right: 25px; }

.fdp-gallery-content { max-width: 85vw; max-height: 80vh; }

.fdp-gallery-img { max-width: 85vw; max-height: 80vh; border-radius: 10px; object-fit: contain; }

.fdp-gallery-counter {
    position: absolute; bottom: 25px; left: 50%; transform: translateX(-50%);
    color: rgba(255,255,255,0.7); font-size: 0.9rem; font-weight: 600;
    background: rgba(0,0,0,0.5); padding: 6px 18px; border-radius: 50px;
}

/* --- Final CTA --- */
.fdp-final-cta { padding: 60px 0; background: #fff; }

.fdp-final-cta h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 10px; }
.fdp-final-cta p { font-size: 1rem; color: #666; max-width: 500px; margin: 0 auto 20px; }

.fdp-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

/* --- States --- */
.fdp-state-box { text-align: center; padding: 50px 20px; }

.fdp-error-card {
    max-width: 450px; margin: 0 auto; padding: 35px 25px; background: #fff;
    border-radius: 14px; box-shadow: 0 5px 30px rgba(0,0,0,0.08); text-align: center;
}

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 1199.98px) {
    .fdp-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .fdp-trust-card:nth-child(2) { border-right: none; }
    .fdp-gallery-grid { grid-template-columns: repeat(2, 1fr); }
    .fdp-features-list { grid-template-columns: 1fr; }
}

@media (max-width: 991.98px) {
    .fdp-hero { padding: 60px 0 50px; min-height: auto; }
    .fdp-hero-title { font-size: 1.7rem; }
    .fdp-mid-cta-inner { flex-wrap: wrap; }
    .fdp-mid-cta-inner .fdp-btn { margin-left: 0; width: 100%; }
    .fdp-sidebar { position: static; margin-top: 20px; }
    .fdp-specs-grid { grid-template-columns: 1fr; }
}

@media (max-width: 767.98px) {
    .fdp-hero { padding: 45px 0 40px; }
    .fdp-hero-title { font-size: 1.4rem; }
    .fdp-hero-subtitle { font-size: 0.9rem; }
    .fdp-hero-cta { flex-direction: column; }
    .fdp-hero-cta .fdp-btn { width: 100%; justify-content: center; }
    .fdp-hero-meta { gap: 12px; }
    .fdp-trust-grid { grid-template-columns: 1fr 1fr; }
    .fdp-trust-card { padding: 14px; gap: 8px; }
    .fdp-img-full { height: 250px; }
    .fdp-content-body { padding: 18px; }
    .fdp-gallery-grid { grid-template-columns: repeat(2, 1fr); }
    .fdp-info-grid { grid-template-columns: 1fr; }
    .fdp-gallery-nav { width: 40px; height: 40px; }
    .fdp-gallery-prev { left: 10px; }
    .fdp-gallery-next { right: 10px; }
}

@media (max-width: 575.98px) {
    .fdp-hero { padding: 35px 0 30px; }
    .fdp-hero-title { font-size: 1.2rem; }
    .fdp-breadcrumb { font-size: 0.72rem; }
    .fdp-hero-badge { font-size: 0.72rem; padding: 6px 12px; }
    .fdp-hero-meta span { font-size: 0.75rem; }
    .fdp-trust-grid { grid-template-columns: 1fr 1fr; }
    .fdp-trust-card { padding: 12px 10px; border-bottom: 1px solid #f0f0f0; }
    .fdp-trust-card:nth-child(even) { border-right: none; }
    .fdp-trust-icon { width: 34px; height: 34px; min-width: 34px; font-size: 0.9rem; }
    .fdp-trust-card strong { font-size: 0.9rem; }
    .fdp-trust-card span { font-size: 0.68rem; }
    .fdp-img-full { height: 200px; }
    .fdp-content-body { padding: 14px; }
    .fdp-section-title { font-size: 1.15rem; }
    .fdp-description { font-size: 0.84rem; }
    .fdp-gallery-grid { grid-template-columns: 1fr; }
    .fdp-gallery-trigger { bottom: 10px; right: 10px; padding: 7px 14px; font-size: 0.75rem; }
    .fdp-final-cta { padding: 40px 0; }
    .fdp-final-cta-buttons { flex-direction: column; }
    .fdp-final-cta-buttons .fdp-btn { width: 100%; justify-content: center; }
    .fdp-gallery-nav { width: 36px; height: 36px; font-size: 1rem; }
    .fdp-gallery-close { top: 12px; right: 15px; font-size: 2rem; }
    body { padding-bottom: 55px; }
}
</style>

<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/fleet-detail-page.blade.php ENDPATH**/ ?>