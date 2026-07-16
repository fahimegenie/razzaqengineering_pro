<div class="services-page-wrapper"
     x-data="{
        observer: null,
        init() {
            // Intersection Observer tabhi chalega jab sentinel element dynamically appear hoga
            this.$nextTick(() => {
                this.setupObserver();
            });
            
            // Livewire jab bhi services refresh karega, AOS automatically refresh hoga
            this.$watch('$wire.services', () => {
                if (typeof AOS !== 'undefined') {
                    setTimeout(() => AOS.refresh(), 200);
                }
            });
        },
        setupObserver() {
            if (this.observer) this.observer.disconnect();

            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && $wire.hasMore) {
                        $wire.loadMore();
                    }
                });
            }, { threshold: 0.1 });
            
            const sentinel = this.$refs.loadMoreSentinel;
            if (sentinel) {
                this.observer.observe(sentinel);
            }
        }
     }">
    
    <!-- ============================================
         HERO SECTION
         ============================================ -->
    <section class="services-hero" wire:ignore>
        <div class="container services-hero-content">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="services-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Services</li>
                        </ol>
                    </nav>
                    <h1 class="services-hero-title">Our Professional Services</h1>
                    <p class="services-hero-subtitle">Comprehensive engineering solutions across Pakistan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         SERVICES CONTENT
         ============================================ -->
    <section class="services-section">
        <div class="container">
            
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="text-center py-5" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'services-loading-state'; ?>wire:key="services-loading-state">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-2">Loading services...</p>
                </div>
            <?php elseif($errorMessage): ?>
                
                <div class="alert alert-danger text-center rounded-3 shadow-sm border-0" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'services-error-state'; ?>wire:key="services-error-state">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e($errorMessage); ?>

                </div>
            <?php else: ?>
                
                <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'services-main-content'; ?>wire:key="services-main-content">
                    
                    
                    <div class="services-controls" data-aos="fade-up" wire:ignore.self>
                        <div class="row g-3 align-items-end mb-5">
                            <div class="col-lg-5">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Search Services</label>
                                <div class="position-relative">
                                    <i class="fas fa-search position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
                                    <input type="text" 
                                           class="form-control ps-5 py-3 rounded-3 border-2"
                                           wire:model.live.debounce.300ms="search"
                                           placeholder="Search services...">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Filter by City</label>
                                
                                <!-- Alpine Managed Searchable Dropdown Container -->
                                <div class="position-relative city-search-dropdown" 
                                    x-data="{ open: false }" 
                                    @click.outside="open = false">
                                    
                                    <!-- Dropdown Trigger Button -->
                                    <button type="button" 
                                            class="form-select py-3 rounded-3 border-2 text-start bg-white d-flex justify-content-between align-items-center"
                                            @click="open = !open">
                                        <span><?php echo e($selectedCityName); ?></span>
                                    </button>

                                    <!-- Dropdown Menu Body -->
                                    <div class="position-absolute w-100 bg-white border border-2 rounded-3 mt-1 shadow-lg p-2" 
                                        x-show="open"
                                        x-transition>
                                        
                                        <!-- Livewire Connected Search Input Inside Dropdown -->
                                        <div class="position-relative mb-2">
                                            <i class="fas fa-search position-absolute top-50 translate-middle-y ms-2 text-muted small"></i>
                                            <input type="text" 
                                                class="form-control form-control-sm ps-4 py-2 border-1" 
                                                placeholder="Search city..."
                                                wire:model.live.debounce.150ms="citySearch"
                                                @keydown.escape="open = false">
                                        </div>

                                        <!-- Cities List Options -->
                                        <div class="overflow-y-auto" style="max-height: 200px;">
                                            <!-- All Cities Option -->
                                            <button type="button" 
                                                    class="dropdown-item py-2 px-3 rounded-2 text-start w-100 <?php echo e($selectedCity === 'all' ? 'bg-success text-white' : ''); ?>"
                                                    wire:click="selectCity('all', 'All Cities')"
                                                    @click="open = false">
                                                All Cities
                                            </button>

                                            <!-- Filtered Cities Loop -->
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filteredCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                <button type="button" 
                                                        class="dropdown-item py-2 px-3 rounded-2 text-start w-100 <?php echo e($selectedCity == $city->id ? 'bg-success text-white' : ''); ?>"
                                                        wire:click="selectCity('<?php echo e($city->id); ?>', '<?php echo e($city->name); ?>')"
                                                        @click="open = false"
                                                        <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'city-opt-'.e($city->id).''; ?>wire:key="city-opt-<?php echo e($city->id); ?>">
                                                    <?php echo e($city->name); ?>

                                                </button>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                                            <!-- No City Found Alert -->
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filteredCities->count() === 0): ?>
                                                <div class="text-muted text-center small py-2">No cities found</div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <p class="mb-0 text-muted small" style="margin-top: -10px;">
                                    Showing <strong><?php echo e(count($services)); ?></strong> of <strong><?php echo e($totalCount); ?></strong> services
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredServices->count() > 0 && empty($search) && $selectedCity === 'all'): ?>
                        <div class="featured-services mb-5" data-aos="fade-up" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'featured-services-panel'; ?>wire:key="featured-services-panel">
                            <h3 class="fw-bold mb-4">
                                <i class="fas fa-star text-warning me-2"></i> Featured Services
                            </h3>
                            <div class="row g-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $featuredServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div class="col-lg-4 col-md-6" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'fs-card-'.e($fs->id).''; ?>wire:key="fs-card-<?php echo e($fs->id); ?>">
                                        <div class="service-card featured">
                                            <div class="service-card-img" wire:ignore>
                                                <img src="<?php echo e($fs->image_url); ?>" 
                                                    alt="<?php echo e($fs->os_name); ?>" 
                                                    class="img-fluid"
                                                    loading="lazy">
                                                <span class="featured-badge">Featured</span>
                                            </div>
                                            <div class="service-card-body">
                                                <h4>
                                                    <a href="<?php echo e(url('service-detail/'.Str::slug($fs->os_name))); ?>">
                                                        <?php echo e($fs->os_name); ?>

                                                    </a>
                                                </h4>
                                                <p><?php echo e(Str::limit($fs->os_short_description ?? $fs->os_description, 100)); ?></p>
                                                <a href="<?php echo e(url('service-detail/'.Str::slug($fs->os_name))); ?>" class="btn-service-link">
                                                    Learn More <i class="fas fa-arrow-right ms-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                    
                    <div class="all-services" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'all-services-panel-'.e($selectedCity).'-'.e(md5($search)).''; ?>wire:key="all-services-panel-<?php echo e($selectedCity); ?>-<?php echo e(md5($search)); ?>">
                        <h3 class="fw-bold mb-4" data-aos="fade-up">
                            <i class="fas fa-th-list text-success me-2"></i> 
                            <?php echo e($selectedCity !== 'all' && $cities->find($selectedCity) ? 'Services in ' . $cities->find($selectedCity)->name : 'All Services'); ?>

                        </h3>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($services) > 0): ?>
                            <div class="row g-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index % 3 * 100); ?>" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'service-card-'.e($service->id).''; ?>wire:key="service-card-<?php echo e($service->id); ?>">
                                        <div class="service-card">
                                            <div class="service-card-img" wire:ignore>
                                                <img src="<?php echo e($service->image_url); ?>" 
                                                     alt="<?php echo e($service->os_name); ?>"
                                                     class="img-fluid"
                                                     loading="lazy">
                                            </div>
                                            <div class="service-card-body">
                                                <h4>
                                                    <a href="<?php echo e(url('service-detail/'.Str::slug($service->os_name))); ?>">
                                                        <?php echo e($service->os_name); ?>

                                                    </a>
                                                </h4>
                                                <p><?php echo e(Str::limit($service->os_short_description ?? $service->os_description, 100)); ?></p>
                                                
                                                
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->cityServices->count() > 0): ?>
                                                    <div class="service-cities">
                                                        <small class="text-muted">Available in:</small>
                                                        <div class="city-tags">
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $service->cityServices->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                                <a href="<?php echo e(url($cs->city->slug . '/' . Str::slug($service->os_name))); ?>" 
                                                                   class="city-tag" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'city-tag-'.e($cs->id).''; ?>wire:key="city-tag-<?php echo e($cs->id); ?>">
                                                                    <?php echo e($cs->city->name); ?>

                                                                </a>
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                
                                                <div class="service-card-footer">
                                                    <a href="<?php echo e(url('service-detail/'.Str::slug($service->os_name))); ?>" class="btn-service-link">
                                                        View Details <i class="fas fa-arrow-right ms-1"></i>
                                                    </a>
                                                    <a href="<?php echo e(route('quote.index')); ?>" class="btn-service-quote">
                                                        <i class="fas fa-file-invoice me-1"></i> Quote
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                            
                            
                            <div x-ref="loadMoreSentinel" class="text-center py-4" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'sentinel-wrapper'; ?>wire:key="sentinel-wrapper">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasMore): ?>
                                    <div wire:loading wire:target="loadMore" class="spinner-border text-success"></div>
                                    <button wire:click="loadMore" wire:loading.remove 
                                            class="btn btn-outline-success rounded-pill px-5 py-2 fw-semibold mt-3">
                                        Load More Services <i class="fas fa-chevron-down ms-2"></i>
                                    </button>
                                <?php else: ?>
                                    <p class="text-muted">All <?php echo e($totalCount); ?> services loaded</p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            
                        <?php else: ?>
                            <div class="text-center py-5" data-aos="fade-up" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'no-services-found'; ?>wire:key="no-services-found">
                                <i class="fas fa-tools fa-3x text-muted opacity-25 mb-3"></i>
                                <h5 class="fw-bold">No Services Found</h5>
                                <p class="text-muted">Try different search terms or select another city.</p>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    <!-- ============================================
         CITY LINKS SECTION (SEO)
         ============================================ -->
    <section class="city-links-section py-5 bg-light" wire:ignore>
        <div class="container">
            <div class="text-center mb-4" data-aos="fade-up">
                <h3 class="fw-bold">Our Services by City</h3>
                <p class="text-muted">Find our services in your city</p>
            </div>
            <div class="row g-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cityServiceLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 50); ?>">
                        <div class="city-service-card">
                            <div class="city-service-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h5>
                                <a href="<?php echo e(url($item['city']->slug)); ?>"><?php echo e($item['city']->name); ?></a>
                            </h5>
                            <ul class="list-unstyled small mb-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $item['services']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $svc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <li>
                                        <a href="<?php echo e(url($item['city']->slug . '/' . Str::slug($svc->os_name))); ?>">
                                            <?php echo e(Str::limit($svc->os_name, 25)); ?>

                                        </a>
                                    </li>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($item['services']) === 0): ?>
                                    <li class="text-muted">Services coming soon</li>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                            <a href="<?php echo e(url($item['city']->slug)); ?>" class="small fw-semibold text-success">
                                View All <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </section>

</div>

<?php $__env->startPush('styles'); ?>
<style>
    /* Aapka purana CSS same rahega... */
    .services-hero {
        background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%);
        min-height: 250px; display: flex; align-items: center;
    }
    .services-hero-content { width: 100%; }
    .services-breadcrumb {
        display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 10px;
    }
    .services-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .services-breadcrumb li a { color: #fff; text-decoration: none; }
    .services-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .services-hero-title { color: #fff; font-size: 2.5rem; font-weight: 800; }
    .services-hero-subtitle { color: rgba(255,255,255,0.8); font-size: 1rem; }
    .services-section { padding: 60px 0; background: #fff; }
    .service-card {
        background: #fff; border-radius: 14px; overflow: hidden;
        box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
        transition: all 0.3s ease; height: 100%;
    }
    .service-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
    .service-card-img { position: relative; height: 200px; overflow: hidden; background: #f0f4f8; }
    .service-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
    .service-card:hover .service-card-img img { transform: scale(1.05); }
    .featured-badge {
        position: absolute; top: 10px; right: 10px;
        background: linear-gradient(135deg, #ffc107, #ff9800);
        color: #000; padding: 4px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700;
    }
    .service-card-body { padding: 18px; }
    .service-card-body h4 { font-size: 1.05rem; font-weight: 700; margin-bottom: 6px; }
    .service-card-body h4 a { color: #0a1628; text-decoration: none; }
    .service-card-body h4 a:hover { color: #0056b3; }
    .service-card-body p { font-size: 0.85rem; color: #888; line-height: 1.5; margin-bottom: 12px; }
    .city-tags { display: flex; flex-wrap: wrap; gap: 4px; margin: 6px 0 10px; }
    .city-tag {
        font-size: 0.68rem; padding: 2px 8px; background: #f0faf3;
        color: #28a745; border-radius: 50px; text-decoration: none; font-weight: 500;
    }
    .city-tag:hover { background: #28a745; color: #fff; }
    .service-card-footer {
        display: flex; justify-content: space-between; align-items: center;
        padding-top: 12px; border-top: 1px solid #f0f0f0; margin-top: auto;
    }
    .btn-service-link { font-size: 0.82rem; font-weight: 600; color: #0056b3; text-decoration: none; }
    .btn-service-link:hover { color: #28a745; }
    .btn-service-quote {
        font-size: 0.78rem; padding: 5px 14px; background: #28a745; color: #fff;
        border-radius: 50px; text-decoration: none; font-weight: 600;
    }
    .btn-service-quote:hover { background: #1e7e34; color: #fff; }
    .city-service-card {
        background: #fff; border-radius: 12px; padding: 18px; text-align: center;
        border: 1px solid #eef0f2; transition: all 0.3s;
    }
    .city-service-card:hover { box-shadow: 0 5px 20px rgba(0,0,0,0.06); }
    .city-service-icon {
        width: 45px; height: 45px; background: rgba(40,167,69,0.1);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        margin: 0 auto 10px; color: #28a745; font-size: 18px;
    }
    .city-service-card h5 { font-size: 0.95rem; margin-bottom: 8px; }
    .city-service-card h5 a { color: #0a1628; text-decoration: none; }
    .city-service-card ul li { margin-bottom: 4px; }
    .city-service-card ul li a { color: #888; text-decoration: none; font-size: 0.78rem; }
    .city-service-card ul li a:hover { color: #0056b3; }

    @media (max-width: 767.98px) {
        .services-hero { min-height: 180px; }
        .services-hero-title { font-size: 1.6rem; }
        .services-section { padding: 40px 0; }
        .service-card-img { height: 180px; }
    }

</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/services-page.blade.php ENDPATH**/ ?>