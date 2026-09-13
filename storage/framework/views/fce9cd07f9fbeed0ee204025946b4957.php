<div class="services-page" 
     x-data="{
        init() {
            this.$watch('$wire.services', () => {
                if (typeof AOS !== 'undefined') setTimeout(() => AOS.refresh(), 200);
            });
        }
     }">
    
    
    <div class="svc-mobile-cta d-lg-none">
        <a href="tel:+923048902805" class="svc-mobile-btn svc-mobile-call">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/923048902805" target="_blank" class="svc-mobile-btn svc-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="<?php echo e(route('quote.index')); ?>" class="svc-mobile-btn svc-mobile-quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    
    <section class="svc-hero">
        <div class="svc-hero-bg"></div>
        <div class="svc-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-30">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="svc-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Services</li>
                        </ol>
                    </nav>
                    
                    <div class="svc-hero-badge">
                        <i class="fas fa-tools"></i> Professional Solutions
                    </div>
                    
                    <h1 class="svc-hero-title">Our Engineering Services</h1>
                    <p class="svc-hero-subtitle">Comprehensive construction and engineering solutions delivered with precision across Pakistan</p>
                    
                    <div class="svc-hero-stats">
                        <div class="svc-stat-item">
                            <span class="svc-stat-number"><?php echo e($totalCount); ?>+</span>
                            <span class="svc-stat-label">Services</span>
                        </div>
                        <div class="svc-stat-item">
                            <span class="svc-stat-number"><?php echo e($cities->count()); ?>+</span>
                            <span class="svc-stat-label">Cities</span>
                        </div>
                        <div class="svc-stat-item">
                            <span class="svc-stat-number">24/7</span>
                            <span class="svc-stat-label">Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="svc-trust-bar">
        <div class="container">
            <div class="svc-trust-grid">
                <div class="svc-trust-card">
                    <div class="svc-trust-icon"><i class="fas fa-users"></i></div>
                    <div>
                        <strong>1000+</strong>
                        <span>Projects Done</span>
                    </div>
                </div>
                <div class="svc-trust-card">
                    <div class="svc-trust-icon"><i class="fas fa-calendar-check"></i></div>
                    <div>
                        <strong>24+ Years</strong>
                        <span>Experience</span>
                    </div>
                </div>
                <div class="svc-trust-card">
                    <div class="svc-trust-icon"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <strong>Licensed</strong>
                        <span>& Insured</span>
                    </div>
                </div>
                <div class="svc-trust-card">
                    <div class="svc-trust-icon"><i class="fas fa-certificate"></i></div>
                    <div>
                        <strong>Certified</strong>
                        <span>Engineers</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="svc-main-section">
        <div class="container">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="svc-state-box">
                    <div class="spinner-grow text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-3 fw-semibold">Loading services...</p>
                </div>
            
            <?php elseif($errorMessage): ?>
                <div class="svc-error-card">
                    <i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;"></i>
                    <h4 class="fw-bold mt-3">Oops! Something went wrong</h4>
                    <p class="text-muted"><?php echo e($errorMessage); ?></p>
                    <button class="btn btn-primary mt-3" wire:click="clearFilters">
                        <i class="fas fa-redo me-2"></i> Refresh
                    </button>
                </div>
            
            <?php else: ?>
                
                <div class="svc-filters-card" data-aos="fade-up">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-5">
                            <label class="svc-filter-label"><i class="fas fa-search me-1"></i> Search Services</label>
                            <div class="svc-input-wrapper">
                                <i class="fas fa-search svc-input-icon"></i>
                                <input type="text" 
                                       class="svc-form-input" 
                                       placeholder="Search by service name..."
                                       wire:model.live.debounce.300ms="search">
                            </div>
                        </div>
                        
                        <div class="col-lg-5" x-data="{ open: false }" @click.outside="open = false">
                            <label class="svc-filter-label"><i class="fas fa-map-marker-alt me-1"></i> Filter by City</label>
                            <div class="svc-input-wrapper svc-dropdown-wrapper">
                                <button type="button" class="svc-form-input svc-dropdown-toggle" @click="open = !open">
                                    <span><?php echo e($selectedCityName); ?></span>
                                    <i class="fas fa-chevron-down svc-chevron" :class="{ 'rotate': open }"></i>
                                </button>
                                <div class="svc-dropdown-menu" x-show="open" x-transition>
                                    <div class="svc-dropdown-search">
                                        <i class="fas fa-search"></i>
                                        <input type="text" placeholder="Search city..." wire:model.live.debounce.150ms="citySearch">
                                    </div>
                                    <div class="svc-dropdown-items">
                                        <button type="button" 
                                                class="svc-dropdown-item <?php echo e($selectedCity === 'all' ? 'active' : ''); ?>"
                                                wire:click="selectCity('all', 'All Cities')" 
                                                @click="open = false">
                                            <i class="fas fa-globe-asia"></i> All Cities
                                        </button>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filteredCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <button type="button" 
                                                    class="svc-dropdown-item <?php echo e($selectedCity == $city->id ? 'active' : ''); ?>"
                                                    wire:click="selectCity('<?php echo e($city->id); ?>', '<?php echo e($city->name); ?>')"
                                                    @click="open = false">
                                                <?php echo e($city->name); ?>

                                            </button>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-2 d-flex align-items-end">
                            <div class="d-flex align-items-center gap-2 w-100">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search || $selectedCity !== 'all'): ?>
                                    <button class="svc-btn-clear" wire:click="clearFilters" title="Clear filters">
                                        <i class="fas fa-times"></i>
                                    </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <span class="svc-count-badge">
                                    <strong><?php echo e($totalCount); ?></strong> services
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredServices->count() > 0 && empty($search) && $selectedCity === 'all'): ?>
                    <div class="svc-featured-section" data-aos="fade-up">
                        <div class="svc-section-header">
                            <span class="svc-section-badge"><i class="fas fa-star"></i> Featured</span>
                            <h2>Most Popular Services</h2>
                            <p>Our most in-demand engineering and construction solutions</p>
                        </div>
                        <div class="row g-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $featuredServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 100); ?>" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'fs-'.e($fs->id).''; ?>wire:key="fs-<?php echo e($fs->id); ?>">
                                    <div class="svc-card featured">
                                        <div class="svc-card-image">
                                            <img src="<?php echo e($fs->image_url); ?>" alt="<?php echo e($fs->os_name); ?>" loading="lazy">
                                            <div class="svc-card-badges">
                                                <span class="svc-badge-featured"><i class="fas fa-star"></i> Featured</span>
                                            </div>
                                            <div class="svc-card-overlay">
                                                <a href="<?php echo e(url('services/'.$fs->os_slug)); ?>" class="svc-overlay-btn">
                                                    <i class="fas fa-eye me-1"></i> View Details
                                                </a>
                                            </div>
                                        </div>
                                        <div class="svc-card-body">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fs->os_icon): ?>
                                                <div class="svc-card-icon">
                                                    <i class="<?php echo e($fs->os_icon); ?>"></i>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <h3>
                                                <a href="<?php echo e(url('services/'.$fs->os_slug)); ?>"><?php echo e($fs->os_name); ?></a>
                                            </h3>
                                            <p><?php echo e(Str::limit($fs->os_short_description ?? $fs->os_description, 90)); ?></p>
                                            <div class="svc-card-footer">
                                                <a href="<?php echo e(url('services/'.$fs->os_slug)); ?>" class="svc-card-link">
                                                    Learn More <i class="fas fa-arrow-right ms-1"></i>
                                                </a>
                                                <a href="<?php echo e(route('quote.index')); ?>" class="svc-card-quote">
                                                    <i class="fas fa-paper-plane"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalCount > 0): ?>
                        <div class="svc-divider">
                            <span>All Services</span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalCount > 0): ?>
                    <div class="svc-all-services" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'services-'.e($selectedCity).'-'.e(md5($search)).''; ?>wire:key="services-<?php echo e($selectedCity); ?>-<?php echo e(md5($search)); ?>">
                        <div class="row g-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="col-lg-4 col-md-6" 
                                     data-aos="fade-up" 
                                     data-aos-delay="<?php echo e(($loop->index % 3) * 80); ?>" 
                                     <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'svc-'.e($service->id).''; ?>wire:key="svc-<?php echo e($service->id); ?>">
                                    <div class="svc-card">
                                        <div class="svc-card-image">
                                            <img src="<?php echo e($service->image_url); ?>" alt="<?php echo e($service->os_name); ?>" loading="lazy">
                                            <div class="svc-card-overlay">
                                                <a href="<?php echo e(url('services/'.Str::slug($service->os_name))); ?>" class="svc-overlay-btn">
                                                    <i class="fas fa-eye me-1"></i> View Details
                                                </a>
                                            </div>
                                        </div>
                                        <div class="svc-card-body">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->os_icon): ?>
                                                <div class="svc-card-icon">
                                                    <i class="<?php echo e($service->os_icon); ?>"></i>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <h3>
                                                <a href="<?php echo e(url('services/'.Str::slug($service->os_name))); ?>"><?php echo e($service->os_name); ?></a>
                                            </h3>
                                            <p><?php echo e(Str::limit($service->os_short_description ?? $service->os_description, 90)); ?></p>
                                            
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->cityServices->count() > 0): ?>
                                                <div class="svc-card-cities">
                                                    <span class="svc-cities-label">Available in:</span>
                                                    <div class="svc-cities-tags">
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $service->cityServices->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                            <a href="<?php echo e(url($cs->city->slug . '/' . Str::slug($service->os_name))); ?>" 
                                                               class="svc-city-tag"><?php echo e($cs->city->name); ?></a>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->cityServices->count() > 3): ?>
                                                            <span class="svc-city-more">+<?php echo e($service->cityServices->count() - 3); ?></span>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            
                                            <div class="svc-card-footer">
                                                <a href="<?php echo e(url('services/'.Str::slug($service->os_name))); ?>" class="svc-card-link">
                                                    Learn More <i class="fas fa-arrow-right ms-1"></i>
                                                </a>
                                                <a href="<?php echo e(route('quote.index')); ?>" class="svc-card-quote">
                                                    <i class="fas fa-paper-plane"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        
                        
                        <div class="svc-load-more" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'load-more-'.e($loadedCount).''; ?>wire:key="load-more-<?php echo e($loadedCount); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasMore): ?>
                                <button wire:click="loadMore" 
                                        wire:loading.attr="disabled"
                                        class="svc-load-btn">
                                    <span wire:loading.remove>Load More Services</span>
                                    <span wire:loading>
                                        <span class="spinner-border spinner-border-sm me-2"></span> Loading...
                                    </span>
                                    <i class="fas fa-chevron-down ms-2" wire:loading.remove></i>
                                </button>
                                <p class="svc-load-info">Showing <?php echo e(count($services)); ?> of <?php echo e($totalCount); ?> services</p>
                            <?php else: ?>
                                <div class="svc-all-loaded">
                                    <i class="fas fa-check-circle"></i>
                                    <span>All <?php echo e($totalCount); ?> services loaded</span>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="svc-empty-state" data-aos="fade-up">
                        <div class="svc-empty-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h3>No Services Found</h3>
                        <p>Try adjusting your search or select a different city.</p>
                        <button class="btn btn-outline-primary mt-3" wire:click="clearFilters">
                            <i class="fas fa-redo me-2"></i> Clear Filters
                        </button>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cityServiceLinks && count($cityServiceLinks) > 0): ?>
        <section class="svc-cities-section">
            <div class="container">
                <div class="svc-section-header" data-aos="fade-up">
                    <span class="svc-section-badge"><i class="fas fa-map-marker-alt"></i> Locations</span>
                    <h2>Our Services by City</h2>
                    <p>Find professional engineering services in your area</p>
                </div>
                <div class="row g-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cityServiceLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 60); ?>">
                            <div class="svc-city-card">
                                <div class="svc-city-icon">
                                    <i class="fas fa-city"></i>
                                </div>
                                <h4>
                                    <a href="<?php echo e(url($item['city']->slug)); ?>"><?php echo e($item['city']->name); ?></a>
                                </h4>
                                <ul>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $item['services']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $svc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <li>
                                            <a href="<?php echo e(url($item['city']->slug . '/' . Str::slug($svc->os_name))); ?>">
                                                <i class="fas fa-angle-right me-1"></i> <?php echo e(Str::limit($svc->os_name, 25)); ?>

                                            </a>
                                        </li>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </ul>
                                <a href="<?php echo e(url($item['city']->slug)); ?>" class="svc-city-view-all">
                                    All Services <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <section class="svc-final-cta">
        <div class="container text-center">
            <h2>Need a Custom Solution?</h2>
            <p class="mb-4">Our engineering experts are ready to discuss your project requirements and provide a tailored solution.</p>
            <div class="svc-final-cta-buttons">
                <a href="<?php echo e(route('quote.index')); ?>" class="svc-btn svc-btn-lg svc-btn-accent">
                    <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                </a>
                <a href="tel:+923048902805" class="svc-btn svc-btn-lg svc-btn-white-outline-dark">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>

</div>


<style>
/* ============================================
   SERVICES PAGE - ENTERPRISE GRADE DESIGN
   Laravel 13 + Livewire 4 Compatible
   ============================================ */

/* --- Mobile Sticky CTA --- */
.svc-mobile-cta {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 998;
    display: flex; background: #fff; box-shadow: 0 -4px 20px rgba(0,0,0,0.12);
}

.svc-mobile-btn {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
    padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none;
    border: none; cursor: pointer; transition: all 0.2s;
}

.svc-mobile-call { background: #f8f9fa; color: #0a1628; }
.svc-mobile-whatsapp { background: #25D366; color: #fff; }
.svc-mobile-quote { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; }

/* --- Hero Section --- */
.svc-hero {
    position: relative; padding: 90px 0 70px; overflow: hidden;
    min-height: 450px; display: flex; align-items: center;
}

.svc-hero-bg {
    position: absolute; inset: 0;
    background: url('<?php echo e(asset("images/services-hero-bg.jpg")); ?>') center/cover no-repeat;
    filter: brightness(0.3);
}

.svc-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,61,128,0.88) 0%, rgba(26,92,42,0.82) 100%);
}

.svc-hero .container { position: relative; z-index: 2; }

.svc-breadcrumb {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px;
    font-size: 0.84rem; color: rgba(255,255,255,0.7);
}

.svc-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.svc-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.svc-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.svc-breadcrumb a:hover { color: #fff; }
.svc-breadcrumb .active { color: rgba(255,255,255,0.6); }

.svc-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
    color: #fff; padding: 8px 18px; border-radius: 50px;
    font-size: 0.85rem; font-weight: 600; margin-bottom: 18px;
}

.svc-hero-title { color: #fff; font-size: clamp(2.2rem, 5vw, 3rem); font-weight: 800; margin: 0 0 12px; line-height: 1.15; }
.svc-hero-subtitle { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 550px; margin: 0 0 25px; line-height: 1.6; }

.svc-hero-stats { display: flex; gap: 30px; flex-wrap: wrap; }
.svc-stat-item { text-align: center; }
.svc-stat-number { display: block; font-size: 1.8rem; font-weight: 800; color: #28a745; }
.svc-stat-label { font-size: 0.78rem; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 1px; }

/* --- Trust Bar --- */
.svc-trust-bar { background: #fff; border-bottom: 1px solid #eef0f2; }
.svc-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); }

.svc-trust-card {
    display: flex; align-items: center; gap: 12px; padding: 20px;
    border-right: 1px solid #f0f0f0;
}
.svc-trust-card:last-child { border-right: none; }

.svc-trust-icon {
    width: 44px; height: 44px; min-width: 44px; background: rgba(40,167,69,0.1);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #28a745; font-size: 1.1rem;
}

.svc-trust-card strong { display: block; font-size: 1.1rem; color: #0a1628; }
.svc-trust-card span { font-size: 0.75rem; color: #888; }

/* --- Main Section --- */
.svc-main-section { padding: 40px 0 60px; background: #f8f9fa; }

/* --- Filters Card --- */
.svc-filters-card {
    background: #fff; border-radius: 16px; padding: 22px 25px; margin-bottom: 30px;
    box-shadow: 0 8px 35px rgba(0,0,0,0.06); border: 1px solid #eef0f2;
}

.svc-filter-label {
    font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 1.5px; color: #888; margin-bottom: 6px; display: block;
}

.svc-input-wrapper { position: relative; }

.svc-form-input {
    width: 100%; padding: 12px 16px 12px 42px; border: 2px solid #e9ecef;
    border-radius: 10px; font-size: 0.88rem; color: #333; background: #fff;
    transition: all 0.3s ease; outline: none;
}

.svc-form-input:focus { border-color: #28a745; box-shadow: 0 0 0 3px rgba(40,167,69,0.1); }

.svc-input-icon {
    position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
    color: #aaa; font-size: 0.9rem; z-index: 1; pointer-events: none;
}

.svc-dropdown-wrapper { position: relative; }
.svc-dropdown-toggle {
    display: flex; align-items: center; justify-content: space-between;
    cursor: pointer; text-align: left; padding-left: 16px !important;
}
.svc-chevron { transition: transform 0.3s; font-size: 0.75rem; color: #888; }
.svc-chevron.rotate { transform: rotate(180deg); }

.svc-dropdown-menu {
    position: absolute; top: calc(100% + 5px); left: 0; right: 0;
    background: #fff; border: 2px solid #e9ecef; border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1); z-index: 1000; overflow: hidden;
}

.svc-dropdown-search {
    position: relative; padding: 10px; border-bottom: 1px solid #f0f0f0;
}

.svc-dropdown-search i {
    position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #aaa;
}

.svc-dropdown-search input {
    width: 100%; padding: 8px 12px 8px 35px; border: 1px solid #e9ecef;
    border-radius: 8px; font-size: 0.82rem; outline: none;
}

.svc-dropdown-items { max-height: 200px; overflow-y: auto; padding: 5px; }

.svc-dropdown-item {
    display: flex; align-items: center; gap: 8px; width: 100%;
    padding: 10px 12px; border: none; background: none; cursor: pointer;
    font-size: 0.85rem; color: #555; border-radius: 8px; transition: all 0.15s;
}

.svc-dropdown-item:hover { background: #f0faf3; color: #28a745; }
.svc-dropdown-item.active { background: #28a745; color: #fff; font-weight: 600; }

.svc-btn-clear {
    width: 40px; height: 40px; border-radius: 10px; border: 2px solid #e9ecef;
    background: #fff; color: #dc3545; cursor: pointer; display: flex;
    align-items: center; justify-content: center; transition: all 0.3s;
}

.svc-btn-clear:hover { background: #dc3545; color: #fff; border-color: #dc3545; }

.svc-count-badge {
    background: #f0faf3; color: #28a745; padding: 8px 14px; border-radius: 8px;
    font-size: 0.82rem; font-weight: 600;
}

/* --- Section Header --- */
.svc-section-header { text-align: center; margin-bottom: 35px; }

.svc-section-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(40,167,69,0.1); color: #28a745; padding: 6px 16px;
    border-radius: 50px; font-size: 0.78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px;
}

.svc-section-header h2 { font-size: 1.8rem; font-weight: 800; color: #0a1628; margin-bottom: 5px; }
.svc-section-header p { color: #888; }

.svc-divider {
    display: flex; align-items: center; gap: 15px; margin: 40px 0 30px;
}

.svc-divider::before, .svc-divider::after {
    content: ''; flex: 1; height: 1px; background: #ddd;
}

.svc-divider span {
    font-size: 0.85rem; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 2px;
}

/* --- Service Card --- */
.svc-card {
    background: #fff; border-radius: 16px; overflow: hidden;
    box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); height: 100%;
    display: flex; flex-direction: column;
}

.svc-card:hover {
    transform: translateY(-6px); 
    box-shadow: 0 18px 45px rgba(0,0,0,0.1);
}

.svc-card.featured { border: 2px solid rgba(245,158,11,0.3); }

.svc-card-image {
    position: relative; height: 220px; overflow: hidden; background: #f0f4f8;
}

.svc-card-image img {
    width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;
}

.svc-card:hover .svc-card-image img { transform: scale(1.08); }

.svc-card-badges {
    position: absolute; top: 12px; left: 12px; right: 12px;
    display: flex; justify-content: space-between;
}

.svc-badge-featured {
    background: linear-gradient(135deg, #f59e0b, #d97706); color: #000;
    padding: 5px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700;
    display: flex; align-items: center; gap: 4px;
}

.svc-card-overlay {
    position: absolute; inset: 0; background: rgba(0,0,0,0.5);
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.3s ease;
}

.svc-card:hover .svc-card-overlay { opacity: 1; }

.svc-overlay-btn {
    background: #28a745; color: #fff; padding: 10px 22px; border-radius: 50px;
    font-weight: 600; font-size: 0.85rem; text-decoration: none;
    transform: translateY(10px); transition: transform 0.3s ease;
}

.svc-card:hover .svc-overlay-btn { transform: translateY(0); }
.svc-overlay-btn:hover { background: #1e7e34; color: #fff; }

.svc-card-body {
    padding: 20px; flex: 1; display: flex; flex-direction: column;
}

.svc-card-icon {
    width: 40px; height: 40px; background: rgba(40,167,69,0.1);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #28a745; font-size: 1.1rem; margin-bottom: 10px;
}

.svc-card-body h3 { font-size: 1.05rem; font-weight: 700; margin: 0 0 8px; }
.svc-card-body h3 a { color: #0a1628; text-decoration: none; }
.svc-card-body h3 a:hover { color: #0056b3; }

.svc-card-body p { font-size: 0.85rem; color: #888; line-height: 1.6; margin-bottom: 12px; flex: 1; }

.svc-card-cities { margin-bottom: 12px; }
.svc-cities-label { font-size: 0.7rem; color: #aaa; display: block; margin-bottom: 6px; }
.svc-cities-tags { display: flex; flex-wrap: wrap; gap: 5px; }

.svc-city-tag {
    font-size: 0.68rem; padding: 3px 10px; background: #f0f7ff; color: #0056b3;
    border-radius: 50px; text-decoration: none; font-weight: 500; transition: all 0.2s;
}

.svc-city-tag:hover { background: #0056b3; color: #fff; }

.svc-city-more {
    font-size: 0.68rem; padding: 3px 10px; background: #f0f0f0; color: #888;
    border-radius: 50px; font-weight: 500;
}

.svc-card-footer {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 12px; border-top: 1px solid #f0f0f0; margin-top: auto;
}

.svc-card-link { font-size: 0.84rem; font-weight: 600; color: #0056b3; text-decoration: none; }
.svc-card-link:hover { color: #28a745; }

.svc-card-quote {
    width: 36px; height: 36px; background: #28a745; color: #fff;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    text-decoration: none; font-size: 0.85rem; transition: all 0.3s;
}

.svc-card-quote:hover { background: #1e7e34; color: #fff; transform: scale(1.1); }

/* --- Load More --- */
.svc-load-more { text-align: center; padding: 40px 0 20px; }

.svc-load-btn {
    background: #fff; color: #28a745; border: 2px solid #28a745;
    padding: 12px 30px; border-radius: 50px; font-weight: 700; font-size: 0.9rem;
    cursor: pointer; transition: all 0.3s ease;
}

.svc-load-btn:hover:not(:disabled) { background: #28a745; color: #fff; }
.svc-load-btn:disabled { opacity: 0.6; cursor: not-allowed; }

.svc-load-info { font-size: 0.82rem; color: #aaa; margin-top: 10px; }

.svc-all-loaded {
    display: inline-flex; align-items: center; gap: 8px; color: #28a745;
    font-weight: 600; font-size: 0.9rem;
}

/* --- Cities Section --- */
.svc-cities-section { padding: 60px 0; background: #fff; }

.svc-city-card {
    background: #f8f9fa; border-radius: 14px; padding: 22px; text-align: center;
    border: 1px solid #eef0f2; transition: all 0.3s; height: 100%;
}

.svc-city-card:hover { box-shadow: 0 8px 30px rgba(0,0,0,0.06); transform: translateY(-3px); }

.svc-city-icon {
    width: 50px; height: 50px; margin: 0 auto 12px; background: linear-gradient(135deg, #0056b3, #28a745);
    border-radius: 14px; display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 1.3rem;
}

.svc-city-card h4 { font-size: 0.95rem; margin-bottom: 10px; }
.svc-city-card h4 a { color: #0a1628; text-decoration: none; }
.svc-city-card h4 a:hover { color: #0056b3; }

.svc-city-card ul { list-style: none; padding: 0; margin: 0 0 12px; text-align: left; }
.svc-city-card ul li { margin-bottom: 5px; }
.svc-city-card ul li a { color: #888; text-decoration: none; font-size: 0.8rem; display: flex; align-items: center; }
.svc-city-card ul li a:hover { color: #28a745; }
.svc-city-card ul li i { font-size: 0.6rem; color: #28a745; }

.svc-city-view-all {
    font-size: 0.8rem; font-weight: 600; color: #28a745; text-decoration: none;
}

/* --- Final CTA --- */
.svc-final-cta { padding: 60px 0; background: #f8f9fa; }
.svc-final-cta h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 10px; }
.svc-final-cta p { font-size: 1rem; color: #666; max-width: 500px; margin: 0 auto 20px; }
.svc-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

.svc-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 0.9rem;
    text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none;
    white-space: nowrap;
}

.svc-btn-lg { padding: 14px 28px; font-size: 0.95rem; border-radius: 10px; }
.svc-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.svc-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; }

.svc-btn-white-outline-dark { background: transparent; color: #0a1628; border: 2px solid #0a1628; }
.svc-btn-white-outline-dark:hover { background: #0a1628; color: #fff; }

/* --- States --- */
.svc-state-box { text-align: center; padding: 60px 20px; }
.svc-error-card { max-width: 500px; margin: 40px auto; padding: 40px 30px; background: #fff; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); text-align: center; }
.svc-empty-state { text-align: center; padding: 60px 20px; }
.svc-empty-icon { width: 100px; height: 100px; margin: 0 auto 20px; background: rgba(40,167,69,0.08); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: #28a745; }
.svc-empty-state h3 { font-size: 1.3rem; font-weight: 700; color: #0a1628; }
.svc-empty-state p { color: #888; max-width: 400px; margin: 0 auto; }

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 1199.98px) {
    .svc-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .svc-trust-card:nth-child(2) { border-right: none; }
    .svc-card-image { height: 200px; }
}

@media (max-width: 991.98px) {
    .svc-hero { padding: 60px 0 50px; min-height: auto; }
    .svc-hero-title { font-size: 1.8rem; }
    .svc-filters-card { padding: 18px 20px; }
}

@media (max-width: 767.98px) {
    .svc-hero { padding: 45px 0 40px; }
    .svc-hero-title { font-size: 1.5rem; }
    .svc-hero-subtitle { font-size: 0.9rem; }
    .svc-hero-stats { gap: 15px; }
    .svc-stat-number { font-size: 1.4rem; }
    .svc-trust-grid { grid-template-columns: 1fr 1fr; }
    .svc-trust-card { padding: 14px; gap: 8px; }
    .svc-card-image { height: 180px; }
}

@media (max-width: 575.98px) {
    .svc-hero { padding: 35px 0 30px; }
    .svc-hero-title { font-size: 1.3rem; }
    .svc-hero-badge { font-size: 0.75rem; padding: 6px 14px; }
    .svc-breadcrumb { font-size: 0.75rem; }
    .svc-filters-card { padding: 15px; border-radius: 12px; }
    .svc-trust-grid { grid-template-columns: 1fr 1fr; }
    .svc-trust-card { padding: 12px 10px; border-bottom: 1px solid #f0f0f0; }
    .svc-trust-card:nth-child(even) { border-right: none; }
    .svc-trust-icon { width: 34px; height: 34px; min-width: 34px; font-size: 0.9rem; }
    .svc-card-image { height: 200px; }
    .svc-section-header h2 { font-size: 1.3rem; }
    .svc-city-card { padding: 16px; }
    .svc-final-cta { padding: 40px 0; }
    .svc-final-cta-buttons { flex-direction: column; }
    .svc-final-cta-buttons .svc-btn { width: 100%; justify-content: center; }
    body { padding-bottom: 55px; }
}
</style>


<script>
document.addEventListener('livewire:navigated', () => {
    if (typeof AOS !== 'undefined') AOS.refresh();
});
</script><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/services-page.blade.php ENDPATH**/ ?>