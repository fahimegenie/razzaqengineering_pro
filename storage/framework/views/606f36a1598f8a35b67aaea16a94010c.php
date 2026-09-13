<div class="city-page" 
     x-data="{ 
        activeServiceTab: <?php if ((object) ('activeServiceTab') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('activeServiceTab'->value()); ?>')<?php echo e('activeServiceTab'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('activeServiceTab'); ?>')<?php endif; ?>,
        showAllProjects: false,
        showAllTestimonials: false,
        scrolled: false
     }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 100 })">
    
    
    <div class="city-mobile-cta d-lg-none" x-show="scrolled" x-transition>
        <a href="tel:<?php echo e($settings->mobile_phone_1 ?? '+923048902805'); ?>" class="city-mobile-btn city-mobile-call">
            <i class="fas fa-phone-alt"></i> <span>Call</span>
        </a>
        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? $settings->mobile_phone_1 ?? '+923048902805')); ?>" target="_blank" class="city-mobile-btn city-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> <span>WhatsApp</span>
        </a>
        <a href="<?php echo e(route('quote.index')); ?>" class="city-mobile-btn city-mobile-quote">
            <i class="fas fa-paper-plane"></i> <span>Free Quote</span>
        </a>
    </div>

    
    <div class="city-floating-actions d-none d-lg-block">
        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? $settings->mobile_phone_1 ?? '+923048902805')); ?>" target="_blank" class="city-float-btn city-float-whatsapp" title="Chat on WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="tel:<?php echo e($settings->mobile_phone_1 ?? '+923048902805'); ?>" class="city-float-btn city-float-call" title="Call Now">
            <i class="fas fa-phone-alt"></i>
        </a>
        <a href="<?php echo e(route('quote.index')); ?>" class="city-float-btn city-float-quote" title="Get Free Quote">
            <i class="fas fa-paper-plane"></i>
        </a>
    </div>

    
    <section class="city-hero">
        <div class="city-hero-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
        <div class="city-hero-bg"></div>
        <div class="city-hero-overlay"></div>
        <div class="city-hero-shape">
            <svg viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="#f8f9fa" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,208C1248,224,1344,192,1392,176L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
        <div class="container position-relative">
            <div class="row align-items-center" style="min-height: 380px;">
                <div class="col-lg-8" data-aos="fade-up" data-aos-duration="800">
                    
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="city-breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('home.services')); ?>">Services</a></li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($city): ?>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e($city->name); ?></li>
                            <?php else: ?>
                                <li class="breadcrumb-item active" aria-current="page">City Not Found</li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ol>
                    </nav>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                        
                        <div class="city-hero-badge">
                            <i class="fas fa-spinner fa-spin"></i> 
                            <span>Loading...</span>
                        </div>
                        <h1 class="city-hero-title">Discovering Services in Your City</h1>
                        <p class="city-hero-subtitle">Please wait while we load the best engineering services for you.</p>
                        <div class="city-hero-loader">
                            <div class="loading-dots">
                                <span></span><span></span><span></span>
                            </div>
                        </div>
                    
                    <?php elseif($errorMessage || !$city): ?>
                        
                        <div class="city-hero-badge">
                            <i class="fas fa-exclamation-triangle pulse"></i> 
                            <span>Page Not Available</span>
                        </div>
                        <h1 class="city-hero-title"><?php echo e($errorMessage ?? 'City Not Found'); ?></h1>
                        <p class="city-hero-subtitle">
                            We couldn't find the city you're looking for. Please check the URL or explore our services available across Pakistan.
                        </p>
                        <div class="city-hero-cta">
                            <a href="<?php echo e(route('home.services')); ?>" class="city-btn city-btn-lg city-btn-accent">
                                <i class="fas fa-tools me-2"></i> Browse All Services
                            </a>
                            <a href="<?php echo e(url('/')); ?>" class="city-btn city-btn-lg city-btn-white-outline">
                                <i class="fas fa-home me-2"></i> Back to Home
                            </a>
                        </div>
                    
                    <?php else: ?>
                        
                        <div class="city-hero-badge animate__animated animate__fadeInDown">
                            <i class="fas fa-map-marker-alt pulse"></i> 
                            <span><?php echo e($city->name); ?> • <?php echo e(count($services)); ?>+ Services Available</span>
                        </div>
                        <h1 class="city-hero-title animate__animated animate__fadeInUp">
                            Professional Engineering Services in <?php echo e($city->name); ?>

                        </h1>
                        <p class="city-hero-subtitle animate__animated animate__fadeInUp">
                            Razzaq Engineering provides expert RCC core cutting, diamond drilling, wall sawing, plumbing & fire fighting services across <?php echo e($city->name); ?> with <strong>24+ years</strong> of excellence.
                        </p>
                        
                        <div class="city-hero-stats animate__animated animate__fadeInUp">
                            <div class="city-stat-item">
                                <span class="city-stat-number"><?php echo e(count($services)); ?>+</span>
                                <span class="city-stat-label">Services</span>
                            </div>
                            <div class="city-stat-divider"></div>
                            <div class="city-stat-item">
                                <span class="city-stat-number"><?php echo e(count($projects)); ?>+</span>
                                <span class="city-stat-label">Projects</span>
                            </div>
                            <div class="city-stat-divider"></div>
                            <div class="city-stat-item">
                                <span class="city-stat-number">24/7</span>
                                <span class="city-stat-label">Support</span>
                            </div>
                        </div>
                        
                        <div class="city-hero-cta animate__animated animate__fadeInUp">
                            <a href="<?php echo e(route('quote.index')); ?>" class="city-btn city-btn-lg city-btn-accent">
                                <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                                <span class="btn-shine"></span>
                            </a>
                            <a href="tel:<?php echo e($settings->mobile_phone_1 ?? '+923048902805'); ?>" class="city-btn city-btn-lg city-btn-white-outline">
                                <i class="fas fa-phone-alt me-2"></i> <?php echo e($settings->mobile_phone_1 ?? '+92 304 8902805'); ?>

                            </a>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isLoading && !$errorMessage && $city): ?>
                <div class="col-lg-4 d-none d-lg-block" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                    <div class="city-hero-illustration">
                        <div class="illustration-circle">
                            <i class="fas fa-hard-hat"></i>
                        </div>
                        <div class="floating-card card-1">
                            <i class="fas fa-check-circle text-success"></i>
                            <span>Verified</span>
                        </div>
                        <div class="floating-card card-2">
                            <i class="fas fa-star text-warning"></i>
                            <span>4.9 Rating</span>
                        </div>
                        <div class="floating-card card-3">
                            <i class="fas fa-clock text-info"></i>
                            <span>24/7 Available</span>
                        </div>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>
    

<section class="city-contact-strip">
    <div class="container">
        <div class="city-contact-strip-inner" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="strip-content">
                        <div class="strip-icon-wrapper">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="strip-text">
                            <h3>Call or WhatsApp us at <a href="tel:+923048902805" class="strip-phone">0304-8902805</a></h3>
                            <p>to book professional engineering services in your city. Our services are available in <strong>all cities across Pakistan</strong>.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <div class="strip-buttons">
                        <a href="tel:+923048902805" class="strip-btn strip-btn-call">
                            <i class="fas fa-phone-alt"></i> Call Now
                        </a>
                        <a href="https://wa.me/923048902805" target="_blank" class="strip-btn strip-btn-whatsapp">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



    
    <section class="city-trust-bar">
        <div class="container">
            <div class="city-trust-grid">
                <div class="city-trust-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="city-trust-icon"><i class="fas fa-certificate"></i></div>
                    <div class="city-trust-content">
                        <strong>Licensed</strong>
                        <span>& Insured Company</span>
                    </div>
                </div>
                <div class="city-trust-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="city-trust-icon"><i class="fas fa-shield-alt"></i></div>
                    <div class="city-trust-content">
                        <strong>Quality</strong>
                        <span>100% Assured</span>
                    </div>
                </div>
                <div class="city-trust-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="city-trust-icon"><i class="fas fa-clock"></i></div>
                    <div class="city-trust-content">
                        <strong>24/7</strong>
                        <span>Emergency Service</span>
                    </div>
                </div>
                <div class="city-trust-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="city-trust-icon"><i class="fas fa-star"></i></div>
                    <div class="city-trust-content">
                        <strong>4.9 Star</strong>
                        <span>Google Rating</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="city-main-section">
        <div class="container">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="city-state-box">
                    <div class="city-loader">
                        <div class="loader-gear">
                            <i class="fas fa-cog fa-spin"></i>
                        </div>
                    </div>
                    <h4 class="mt-4 fw-bold">Loading Services...</h4>
                    <p class="text-muted">Fetching the best engineering services in <?php echo e($city->name ?? 'your city'); ?></p>
                </div>
            
            <?php elseif($errorMessage || !$city): ?>
                <div class="city-error-card" data-aos="fade-up">
                    <div class="error-icon-wrapper">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h4 class="fw-bold mt-4"><?php echo e($errorMessage ?? 'City Not Found'); ?></h4>
                    <p class="text-muted mb-4">Don't worry! We provide engineering services across Pakistan.</p>
                    
                    <div class="city-action-buttons">
                        <a href="<?php echo e(route('home.services')); ?>" class="city-btn city-btn-accent">
                            <i class="fas fa-tools me-2"></i> Browse All Services
                        </a>
                        <a href="<?php echo e(url('/')); ?>" class="city-btn city-btn-outline">
                            <i class="fas fa-home me-2"></i> Back to Home
                        </a>
                        <a href="<?php echo e(route('home.contact')); ?>" class="city-btn city-btn-outline">
                            <i class="fas fa-envelope me-2"></i> Contact Us
                        </a>
                    </div>
                    
                    <div class="city-popular-services mt-5">
                        <h5 class="fw-bold mb-4">
                            <i class="fas fa-fire text-danger me-2"></i> Our Popular Services
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="<?php echo e(route('service.detail.slug', ['slug' => 'rcc-core-cutting'])); ?>" class="popular-service-link">
                                    <div class="popular-service-card">
                                        <div class="popular-service-icon bg-success">
                                            <i class="fas fa-cut"></i>
                                        </div>
                                        <strong>RCC Core Cutting</strong>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="<?php echo e(route('service.detail.slug', ['slug' => 'diamond-drilling'])); ?>" class="popular-service-link">
                                    <div class="popular-service-card">
                                        <div class="popular-service-icon bg-primary">
                                            <i class="fas fa-dot-circle"></i>
                                        </div>
                                        <strong>Diamond Drilling</strong>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="<?php echo e(route('service.detail.slug', ['slug' => 'wall-sawing'])); ?>" class="popular-service-link">
                                    <div class="popular-service-card">
                                        <div class="popular-service-icon bg-warning">
                                            <i class="fas fa-grip-lines"></i>
                                        </div>
                                        <strong>Wall Sawing</strong>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            
            <?php else: ?>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($services) > 0): ?>
                    <div class="city-section-header" data-aos="fade-up">
                        <span class="city-section-badge">
                            <i class="fas fa-tools"></i> Our Services
                        </span>
                        <h2>Engineering Services in <?php echo e($city->name); ?></h2>
                        <p>Explore our comprehensive range of professional services available across <?php echo e($city->name); ?></p>
                    </div>

                    
                    <div class="city-tabs-wrapper" data-aos="fade-up">
                        <div class="city-tabs-scroll">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <button class="city-tab-btn <?php echo e($activeServiceTab == $service->id ? 'active' : ''); ?>"
                                        wire:click="switchServiceTab(<?php echo e($service->id); ?>)"
                                        <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'tab-'.e($service->id).''; ?>wire:key="tab-<?php echo e($service->id); ?>">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->os_icon): ?>
                                        <span class="tab-icon"><i class="<?php echo e($service->os_icon); ?>"></i></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <span><?php echo e($service->os_name); ?></span>
                                </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($serviceDetails) > 0): ?>
                        <div class="city-details-grid" data-aos="fade-up" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'details-'.e($activeServiceTab).''; ?>wire:key="details-<?php echo e($activeServiceTab); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $serviceDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="city-detail-card">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($detail->sd_image1): ?>
                                        <div class="city-detail-image">
                                            <img src="<?php echo e($detail->image1_url); ?>" alt="<?php echo e($detail->sd_title); ?>" loading="lazy">
                                            <div class="detail-image-overlay">
                                                <a href="<?php echo e(route('service.detail.slug', ['slug' => $services->find($activeServiceTab)->os_slug ?? ''])); ?>" class="detail-view-btn">
                                                    <i class="fas fa-eye"></i> View Details
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div class="city-detail-body">
                                        <h4><?php echo e($detail->sd_title); ?></h4>
                                        <p><?php echo e(Str::limit(strip_tags($detail->sd_description), 150)); ?></p>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($detail->sd_t1 || $detail->sd_t2 || $detail->sd_t3): ?>
                                            <ul class="city-detail-features">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [$detail->sd_t1, $detail->sd_t2, $detail->sd_t3]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($feature): ?>
                                                        <li><i class="fas fa-check-circle"></i> <?php echo e($feature); ?></li>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                            </ul>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <a href="<?php echo e(route('service.detail.slug', ['slug' => $services->find($activeServiceTab)->os_slug ?? ''])); ?>" class="city-detail-link">
                                            View Full Details <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <div class="city-services-grid" data-aos="fade-up">
                        <div class="row g-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="city-service-card">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->os_icon): ?>
                                            <div class="city-service-icon">
                                                <i class="<?php echo e($service->os_icon); ?>"></i>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <h3>
                                            <a href="<?php echo e(route('city.service', ['city' => $city->slug, 'service' => $service->os_slug])); ?>">
                                                <?php echo e($service->os_name); ?>

                                            </a>
                                        </h3>
                                        <p><?php echo e(Str::limit(strip_tags($service->os_short_description ?? $service->os_description), 100)); ?></p>
                                        <div class="city-service-footer">
                                            <a href="<?php echo e(route('city.service', ['city' => $city->slug, 'service' => $service->os_slug])); ?>" class="city-service-link">
                                                Learn More <i class="fas fa-arrow-right ms-1"></i>
                                            </a>
                                            <span class="service-availability">
                                                <i class="fas fa-check-circle text-success"></i> Available
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="city-empty-state" data-aos="fade-up">
                        <div class="city-empty-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h3>No Services Listed Yet</h3>
                        <p>We're updating our services for <?php echo e($city->name); ?>. Contact us for more information.</p>
                        <a href="tel:<?php echo e($settings->mobile_phone_1 ?? '+923048902805'); ?>" class="city-btn city-btn-accent mt-3">
                            <i class="fas fa-phone-alt me-2"></i> Call Now
                        </a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($projects) > 0): ?>
                    <div class="city-section-header mt-5" data-aos="fade-up">
                        <span class="city-section-badge">
                            <i class="fas fa-folder-open"></i> Our Work
                        </span>
                        <h2>Projects in <?php echo e($city->name); ?></h2>
                        <p>Showcasing our completed and ongoing projects across <?php echo e($city->name); ?></p>
                    </div>
                    <div class="row g-4" data-aos="fade-up">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $projects->take($showAllProjects ? count($projects) : 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="city-project-card">
                                    <div class="city-project-image">
                                        <img src="<?php echo e($project->image_url); ?>" alt="<?php echo e($project->p_title); ?>" loading="lazy">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_status): ?>
                                            <span class="city-project-status status-<?php echo e($project->p_status); ?>">
                                                <?php echo e(ucfirst($project->p_status)); ?>

                                            </span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <div class="project-image-overlay">
                                            <a href="<?php echo e(route('project.detail', ['slug' => $project->p_slug ?? $project->id])); ?>" class="project-view-btn">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="city-project-body">
                                        <h4>
                                            <a href="<?php echo e(route('project.detail', ['slug' => $project->p_slug ?? $project->id])); ?>">
                                                <?php echo e($project->p_title); ?>

                                            </a>
                                        </h4>
                                        <p><?php echo e(Str::limit(strip_tags($project->p_short_description ?? $project->p_description), 80)); ?></p>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_location): ?>
                                            <span class="city-project-location">
                                                <i class="fas fa-map-marker-alt"></i> <?php echo e($project->p_location); ?>

                                            </span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($projects) > 3): ?>
                        <div class="text-center mt-4" data-aos="fade-up">
                            <button @click="showAllProjects = !showAllProjects" class="city-btn city-btn-outline">
                                <span x-text="showAllProjects ? 'Show Less' : 'View All Projects'"></span>
                                <i class="fas fa-chevron-down ms-2" :class="{ 'rotate-180': showAllProjects }"></i>
                            </button>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($testimonials) > 0): ?>
                    <div class="city-section-header mt-5" data-aos="fade-up">
                        <span class="city-section-badge">
                            <i class="fas fa-star"></i> Testimonials
                        </span>
                        <h2>What Our <?php echo e($city->name); ?> Clients Say</h2>
                        <p>Real feedback from our valued customers</p>
                    </div>
                    <div class="row g-4" data-aos="fade-up">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $testimonials->take($showAllTestimonials ? count($testimonials) : 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="city-testimonial-card">
                                    <div class="city-testimonial-stars">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <i class="fas fa-star<?php echo e($i <= $testimonial->t_rating ? '' : ' empty'); ?>"></i>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>
                                    <div class="city-testimonial-quote">
                                        <i class="fas fa-quote-left"></i>
                                    </div>
                                    <p class="city-testimonial-content">"<?php echo e(Str::limit($testimonial->t_content, 150)); ?>"</p>
                                    <div class="city-testimonial-author">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonial->t_image): ?>
                                            <img src="<?php echo e($testimonial->image_url); ?>" alt="<?php echo e($testimonial->t_name); ?>" loading="lazy">
                                        <?php else: ?>
                                            <div class="testimonial-avatar-placeholder">
                                                <?php echo e(strtoupper(substr($testimonial->t_name, 0, 1))); ?>

                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <div>
                                            <strong><?php echo e($testimonial->t_name); ?></strong>
                                            <span><?php echo e($testimonial->t_designation); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonial->t_company): ?>, <?php echo e($testimonial->t_company); ?><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($testimonials) > 3): ?>
                        <div class="text-center mt-4" data-aos="fade-up">
                            <button @click="showAllTestimonials = !showAllTestimonials" class="city-btn city-btn-outline">
                                <span x-text="showAllTestimonials ? 'Show Less' : 'View All Reviews'"></span>
                                <i class="fas fa-chevron-down ms-2" :class="{ 'rotate-180': showAllTestimonials }"></i>
                            </button>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <div class="city-cta-card mt-5" data-aos="zoom-in">
                    <div class="city-cta-pattern"></div>
                    <div class="row align-items-center position-relative">
                        <div class="col-lg-8">
                            <h3>Need Engineering Services in <?php echo e($city->name); ?>?</h3>
                            <p>Contact us today for a free consultation and competitive estimate. Our team is ready to help!</p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <a href="<?php echo e(route('quote.index')); ?>" class="city-btn city-btn-accent city-btn-lg">
                                <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                                <span class="btn-shine"></span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    
    <section class="city-final-cta">
        <div class="container text-center">
            <div class="city-final-content" data-aos="fade-up">
                <span class="city-section-badge mb-3">
                    <i class="fas fa-rocket"></i> Let's Get Started
                </span>
                <h2>Ready to Start Your Project in <?php echo e($city->name ?? 'Your City'); ?>?</h2>
                <p class="mb-4">Let our expert team deliver exceptional engineering solutions tailored to your needs.</p>
                <div class="city-final-cta-buttons">
                    <a href="<?php echo e(route('quote.index')); ?>" class="city-btn city-btn-lg city-btn-accent">
                        <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                    </a>
                    <a href="tel:<?php echo e($settings->mobile_phone_1 ?? '+923048902805'); ?>" class="city-btn city-btn-lg city-btn-white-outline-dark">
                        <i class="fas fa-phone-alt me-2"></i> Call Now
                    </a>
                    <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? $settings->mobile_phone_1 ?? '+923048902805')); ?>" target="_blank" class="city-btn city-btn-lg city-btn-whatsapp">
                        <i class="fab fa-whatsapp me-2"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>

<?php $__env->startPush('styles'); ?>
<style>
/* ============================================
   CITY PAGE - PROFESSIONAL MODERN DESIGN
   ============================================ */

:root {
    --primary: #0056b3;
    --primary-dark: #003d80;
    --success: #28a745;
    --success-dark: #1e7e34;
    --warning: #f59e0b;
    --danger: #dc3545;
    --dark: #0a1628;
    --gray: #6c757d;
    --light: #f8f9fa;
    --white: #ffffff;
    --border: #eef0f2;
    --shadow-sm: 0 2px 8px rgba(0,0,0,0.06);
    --shadow-md: 0 5px 20px rgba(0,0,0,0.08);
    --shadow-lg: 0 10px 40px rgba(0,0,0,0.12);
    --radius-sm: 8px;
    --radius-md: 14px;
    --radius-lg: 20px;
    --radius-xl: 28px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

[x-cloak] { display: none !important; }

/* Animations */
@keyframes pulse { 0%,100%{transform:scale(1)}50%{transform:scale(1.1)} }
@keyframes float { 0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)} }
@keyframes shine { 0%{transform:translateX(-100%)}100%{transform:translateX(100%)} }
@keyframes particleFloat { 0%,100%{transform:translateY(0)translateX(0);opacity:0}10%{opacity:1}90%{opacity:1}100%{transform:translateY(-100vh)translateX(50px);opacity:0} }
.pulse { animation: pulse 2s infinite; }

/* Mobile CTA */
.city-mobile-cta { position:fixed;bottom:0;left:0;right:0;z-index:998;display:flex;background:var(--white);box-shadow:0 -4px 20px rgba(0,0,0,0.12);border-radius:20px 20px 0 0; }
.city-mobile-btn { flex:1;display:flex;align-items:center;justify-content:center;gap:6px;padding:14px 8px;font-size:0.8rem;font-weight:700;text-decoration:none;border:none;cursor:pointer;transition:var(--transition); }
.city-mobile-btn:active { transform:scale(0.95); }
.city-mobile-call { background:#f8f9fa;color:var(--dark);border-right:1px solid #eee; }
.city-mobile-whatsapp { background:#25D366;color:#fff;border-right:1px solid #1fb855; }
.city-mobile-quote { background:linear-gradient(135deg,var(--primary),var(--success));color:#fff; }

/* Floating Actions */
.city-floating-actions { position:fixed;right:20px;bottom:30px;z-index:999;display:flex;flex-direction:column;gap:12px; }
.city-float-btn { width:56px;height:56px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#fff;text-decoration:none;box-shadow:var(--shadow-lg);transition:var(--transition);position:relative;overflow:hidden; }
.city-float-btn:hover { transform:translateY(-3px)scale(1.05); }
.city-float-btn:active { transform:scale(0.95); }
.city-float-whatsapp { background:#25D366; }
.city-float-call { background:var(--primary); }
.city-float-quote { background:var(--success); }

/* Buttons */
.city-btn { display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:13px 28px;border-radius:12px;font-weight:700;font-size:0.92rem;text-decoration:none;transition:var(--transition);cursor:pointer;border:none;white-space:nowrap;position:relative;overflow:hidden; }
.city-btn:hover { transform:translateY(-2px); }
.city-btn:active { transform:translateY(0); }
.city-btn-lg { padding:15px 32px;font-size:1rem;border-radius:14px; }
.city-btn-accent { background:linear-gradient(135deg,var(--success),#22c55e);color:#fff;box-shadow:0 8px 25px rgba(40,167,69,0.35); }
.city-btn-accent:hover { box-shadow:0 12px 35px rgba(40,167,69,0.5);color:#fff; }
.city-btn-white-outline { background:transparent;color:#fff;border:2px solid rgba(255,255,255,0.5); }
.city-btn-white-outline:hover { background:#fff;color:var(--primary-dark); }
.city-btn-outline { background:#fff;color:var(--primary);border:2px solid var(--primary); }
.city-btn-outline:hover { background:var(--primary);color:#fff; }
.city-btn-white-outline-dark { background:transparent;color:var(--dark);border:2px solid var(--dark); }
.city-btn-white-outline-dark:hover { background:var(--dark);color:#fff; }
.city-btn-whatsapp { background:#25D366;color:#fff;box-shadow:0 8px 25px rgba(37,211,102,0.35); }
.city-btn-whatsapp:hover { box-shadow:0 12px 35px rgba(37,211,102,0.5);color:#fff; }
.btn-shine { position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.3),transparent);animation:shine 2s infinite; }

/* Hero */
.city-hero { position:relative;padding:100px 0 120px;overflow:hidden;min-height:500px;display:flex;align-items:center;background:linear-gradient(135deg,#001a35 0%,#003d80 30%,#1a5c2a 100%); }
.city-hero-bg { position:absolute;inset:0;background:url('<?php echo e(asset("images/city-hero-bg.jpg")); ?>')center/cover no-repeat;filter:brightness(0.25); }
.city-hero-overlay { position:absolute;inset:0;background:linear-gradient(135deg,rgba(0,61,128,0.92)0%,rgba(26,92,42,0.85)100%); }
.city-hero-shape { position:absolute;bottom:-1px;left:0;right:0;z-index:3; }
.city-hero-shape svg { width:100%;height:80px; }
.city-hero-particles { position:absolute;inset:0;z-index:1;overflow:hidden; }
.city-hero-particles .particle { position:absolute;width:6px;height:6px;background:rgba(255,255,255,0.15);border-radius:50%;bottom:-10px; }
.city-hero-particles .particle:nth-child(1){left:10%;animation:particleFloat 8s infinite}
.city-hero-particles .particle:nth-child(2){left:30%;animation:particleFloat 10s infinite 1s}
.city-hero-particles .particle:nth-child(3){left:50%;animation:particleFloat 7s infinite 2s}
.city-hero-particles .particle:nth-child(4){left:70%;animation:particleFloat 9s infinite .5s}
.city-hero-particles .particle:nth-child(5){left:90%;animation:particleFloat 11s infinite 1.5s}
.city-hero .container { position:relative;z-index:4; }

/* Breadcrumb */
.city-breadcrumb { display:flex;gap:6px;list-style:none;padding:0;margin:0;font-size:0.85rem;flex-wrap:wrap; }
.city-breadcrumb .breadcrumb-item { color:rgba(255,255,255,0.7); }
.city-breadcrumb .breadcrumb-item a { color:rgba(255,255,255,0.9);text-decoration:none;transition:var(--transition); }
.city-breadcrumb .breadcrumb-item a:hover { color:#fff;text-decoration:underline; }
.city-breadcrumb .breadcrumb-item+.breadcrumb-item::before { content:'›';color:rgba(255,255,255,0.4);padding:0 4px; }
.city-breadcrumb .breadcrumb-item.active { color:var(--success);font-weight:600; }

/* Hero Badge */
.city-hero-badge { display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.12);backdrop-filter:blur(10px);color:#fff;padding:8px 20px;border-radius:50px;font-size:0.85rem;font-weight:600;margin-bottom:20px;border:1px solid rgba(255,255,255,0.15); }
.city-hero-badge i { color:var(--success); }

/* Hero Title */
.city-hero-title { color:#fff;font-size:clamp(2rem,5vw,3rem);font-weight:800;margin:0 0 16px;line-height:1.15;letter-spacing:-0.5px; }
.city-hero-subtitle { color:rgba(255,255,255,0.85);font-size:1.08rem;max-width:600px;margin:0 0 30px;line-height:1.7; }

/* Hero Stats */
.city-hero-stats { display:flex;gap:30px;flex-wrap:wrap;margin-bottom:30px;align-items:center; }
.city-stat-item { text-align:center; }
.city-stat-number { display:block;font-size:2.2rem;font-weight:800;color:var(--success);line-height:1; }
.city-stat-label { font-size:0.78rem;color:rgba(255,255,255,0.7);text-transform:uppercase;letter-spacing:1.5px;margin-top:4px; }
.city-stat-divider { width:1px;height:40px;background:rgba(255,255,255,0.2); }

/* Hero CTA */
.city-hero-cta { display:flex;gap:14px;flex-wrap:wrap; }

/* Hero Illustration */
.city-hero-illustration { position:relative;width:100%;height:300px;display:flex;align-items:center;justify-content:center; }
.illustration-circle { width:140px;height:140px;border-radius:50%;background:linear-gradient(135deg,rgba(40,167,69,0.2),rgba(0,86,179,0.2));border:3px solid rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;font-size:3.5rem;color:rgba(255,255,255,0.8);animation:float 3s ease-in-out infinite; }
.floating-card { position:absolute;background:rgba(255,255,255,0.95);backdrop-filter:blur(10px);padding:8px 16px;border-radius:25px;display:flex;align-items:center;gap:8px;font-size:0.8rem;font-weight:600;color:var(--dark);box-shadow:var(--shadow-md);animation:float 4s ease-in-out infinite; }
.floating-card i { font-size:1rem; }
.card-1{top:30px;right:10px;animation-delay:0s}
.card-2{bottom:40px;left:0;animation-delay:1s}
.card-3{top:50%;right:0;animation-delay:2s}

/* Hero Loader */
.city-hero-loader { margin-top:20px; }
.loading-dots { display:flex;gap:8px; }
.loading-dots span { width:10px;height:10px;border-radius:50%;background:rgba(255,255,255,0.5);animation:pulse 1.5s infinite; }
.loading-dots span:nth-child(2){animation-delay:0.3s}
.loading-dots span:nth-child(3){animation-delay:0.6s}

/* Trust Bar */
.city-trust-bar { background:#fff;border-bottom:1px solid var(--border);position:relative;z-index:5;margin-top:-1px; }
.city-trust-grid { display:grid;grid-template-columns:repeat(4,1fr); }
.city-trust-card { display:flex;align-items:center;gap:14px;padding:24px 20px;border-right:1px solid var(--border);transition:var(--transition); }
.city-trust-card:last-child { border-right:none; }
.city-trust-card:hover { background:#f8f9fa; }
.city-trust-icon { width:50px;height:50px;min-width:50px;background:rgba(40,167,69,0.08);border-radius:14px;display:flex;align-items:center;justify-content:center;color:var(--success);font-size:1.2rem;transition:var(--transition); }
.city-trust-card:hover .city-trust-icon { background:var(--success);color:#fff; }
.city-trust-content strong { display:block;font-size:1.05rem;color:var(--dark);line-height:1.3; }
.city-trust-content span { font-size:0.78rem;color:var(--gray); }

/* Main Section */
.city-main-section { padding:60px 0 80px;background:var(--light); }
.city-section-header { text-align:center;margin-bottom:35px; }
.city-section-badge { display:inline-flex;align-items:center;gap:8px;background:rgba(40,167,69,0.1);color:var(--success);padding:7px 18px;border-radius:50px;font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;margin-bottom:12px; }
.city-section-header h2 { font-size:clamp(1.6rem,3vw,2rem);font-weight:800;color:var(--dark);margin-bottom:8px; }
.city-section-header p { color:var(--gray);font-size:0.95rem; }

/* Tabs */
.city-tabs-wrapper { margin-bottom:30px; }
.city-tabs-scroll { display:flex;gap:10px;overflow-x:auto;scrollbar-width:none;padding:8px 0;justify-content:center; }
.city-tabs-scroll::-webkit-scrollbar{display:none}
.city-tab-btn { display:flex;align-items:center;gap:8px;padding:11px 22px;background:#fff;border:2px solid var(--border);border-radius:30px;cursor:pointer;font-weight:600;font-size:0.85rem;color:var(--gray);white-space:nowrap;transition:var(--transition);flex-shrink:0; }
.city-tab-btn:hover { border-color:var(--success);color:var(--success); }
.city-tab-btn.active { background:linear-gradient(135deg,var(--primary),var(--success));color:#fff;border-color:transparent;box-shadow:0 6px 25px rgba(40,167,69,0.3);transform:translateY(-2px); }
.tab-icon { font-size:0.9rem; }

/* Service Details */
.city-details-grid { display:grid;grid-template-columns:repeat(2,1fr);gap:24px;margin-bottom:40px; }
.city-detail-card { background:#fff;border-radius:var(--radius-md);overflow:hidden;box-shadow:var(--shadow-sm);border:1px solid var(--border);transition:var(--transition); }
.city-detail-card:hover { transform:translateY(-5px);box-shadow:var(--shadow-lg); }
.city-detail-image { position:relative;height:200px;overflow:hidden; }
.city-detail-image img { width:100%;height:100%;object-fit:cover;transition:transform 0.5s; }
.city-detail-card:hover .city-detail-image img { transform:scale(1.08); }
.detail-image-overlay { position:absolute;inset:0;background:rgba(0,0,0,0.4);display:flex;align-items:center;justify-content:center;opacity:0;transition:var(--transition); }
.city-detail-card:hover .detail-image-overlay { opacity:1; }
.detail-view-btn { color:#fff;text-decoration:none;font-weight:600;padding:10px 20px;border:2px solid #fff;border-radius:25px;transition:var(--transition); }
.detail-view-btn:hover { background:#fff;color:var(--dark); }
.city-detail-body { padding:20px; }
.city-detail-body h4 { font-size:1.1rem;font-weight:700;margin-bottom:10px;color:var(--dark); }
.city-detail-body p { font-size:0.88rem;color:var(--gray);line-height:1.6; }
.city-detail-features { list-style:none;padding:0;margin:12px 0; }
.city-detail-features li { font-size:0.84rem;color:#555;padding:4px 0;display:flex;align-items:center;gap:10px; }
.city-detail-features i { color:var(--success); }
.city-detail-link { font-size:0.85rem;font-weight:600;color:var(--primary);text-decoration:none;display:inline-flex;align-items:center;transition:var(--transition); }
.city-detail-link:hover { color:var(--success);gap:10px; }

/* Service Cards */
.city-services-grid { margin-top:40px; }
.city-service-card { background:#fff;border-radius:var(--radius-md);padding:24px;height:100%;box-shadow:var(--shadow-sm);border:1px solid var(--border);transition:var(--transition);position:relative;overflow:hidden; }
.city-service-card::before { content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--primary),var(--success));transform:scaleX(0);transition:transform 0.3s; }
.city-service-card:hover::before { transform:scaleX(1); }
.city-service-card:hover { transform:translateY(-5px);box-shadow:var(--shadow-lg);border-color:var(--success); }
.city-service-icon { width:48px;height:48px;background:rgba(40,167,69,0.1);border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--success);font-size:1.2rem;margin-bottom:14px;transition:var(--transition); }
.city-service-card:hover .city-service-icon { background:var(--success);color:#fff; }
.city-service-card h3 { font-size:1.05rem;font-weight:700;margin-bottom:10px; }
.city-service-card h3 a { color:var(--dark);text-decoration:none;transition:var(--transition); }
.city-service-card h3 a:hover { color:var(--primary); }
.city-service-card p { font-size:0.86rem;color:var(--gray);line-height:1.6;margin-bottom:16px; }
.city-service-footer { display:flex;justify-content:space-between;align-items:center; }
.city-service-link { font-size:0.84rem;font-weight:600;color:var(--success);text-decoration:none;transition:var(--transition); }
.city-service-link:hover { color:var(--success-dark); }
.service-availability { font-size:0.78rem;color:var(--success);font-weight:600; }

/* Project Cards */
.city-project-card { background:#fff;border-radius:var(--radius-md);overflow:hidden;box-shadow:var(--shadow-sm);border:1px solid var(--border);transition:var(--transition);height:100%; }
.city-project-card:hover { transform:translateY(-5px);box-shadow:var(--shadow-lg); }
.city-project-image { position:relative;height:200px;overflow:hidden; }
.city-project-image img { width:100%;height:100%;object-fit:cover;transition:transform 0.5s; }
.city-project-card:hover .city-project-image img { transform:scale(1.08); }
.city-project-status { position:absolute;top:12px;right:12px;padding:5px 14px;border-radius:25px;font-size:0.72rem;font-weight:700;color:#fff;text-transform:uppercase;letter-spacing:0.5px; }
.status-completed { background:var(--success); }
.status-ongoing { background:var(--primary); }
.project-image-overlay { position:absolute;inset:0;background:rgba(0,0,0,0.4);display:flex;align-items:center;justify-content:center;opacity:0;transition:var(--transition); }
.city-project-card:hover .project-image-overlay { opacity:1; }
.project-view-btn { width:48px;height:48px;background:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--dark);font-size:1.1rem;text-decoration:none;transition:var(--transition); }
.project-view-btn:hover { background:var(--success);color:#fff; }
.city-project-body { padding:18px; }
.city-project-body h4 { font-size:1rem;font-weight:700;margin-bottom:8px; }
.city-project-body h4 a { color:var(--dark);text-decoration:none; }
.city-project-body h4 a:hover { color:var(--primary); }
.city-project-body p { font-size:0.84rem;color:var(--gray);margin-bottom:10px; }
.city-project-location { font-size:0.8rem;color:#666;display:flex;align-items:center;gap:6px; }

/* Testimonials */
.city-testimonial-card { background:#fff;border-radius:var(--radius-md);padding:24px;height:100%;box-shadow:var(--shadow-sm);border:1px solid var(--border);transition:var(--transition);position:relative; }
.city-testimonial-card:hover { transform:translateY(-3px);box-shadow:var(--shadow-md); }
.city-testimonial-stars { margin-bottom:12px; }
.city-testimonial-stars i { color:#f59e0b;font-size:0.9rem; }
.city-testimonial-stars i.empty { color:#ddd; }
.city-testimonial-quote { position:absolute;top:20px;right:20px;font-size:2rem;color:rgba(40,167,69,0.1); }
.city-testimonial-content { font-size:0.9rem;color:#666;line-height:1.7;margin-bottom:18px;position:relative;z-index:1; }
.city-testimonial-author { display:flex;align-items:center;gap:12px; }
.city-testimonial-author img { width:44px;height:44px;border-radius:50%;object-fit:cover;border:3px solid rgba(40,167,69,0.2); }
.testimonial-avatar-placeholder { width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--primary),var(--success));color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1rem; }
.city-testimonial-author strong { display:block;font-size:0.88rem;color:var(--dark); }
.city-testimonial-author span { font-size:0.76rem;color:var(--gray); }

/* CTA Card */
.city-cta-card { background:linear-gradient(135deg,var(--primary-dark),#002244);border-radius:var(--radius-lg);padding:40px 35px;color:#fff;position:relative;overflow:hidden; }
.city-cta-pattern { position:absolute;inset:0;opacity:0.05;background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:20px 20px; }
.city-cta-card h3 { font-size:1.4rem;font-weight:800;margin-bottom:6px; }
.city-cta-card p { opacity:0.9;margin:0;font-size:0.95rem; }

/* Final CTA */
.city-final-cta { padding:80px 0;background:#fff;border-top:1px solid var(--border); }
.city-final-content { max-width:700px;margin:0 auto; }
.city-final-cta h2 { font-size:clamp(1.6rem,3vw,2.2rem);font-weight:800;color:var(--dark);margin-bottom:12px; }
.city-final-cta p { font-size:1.05rem;color:var(--gray); }
.city-final-cta-buttons { display:flex;gap:14px;justify-content:center;flex-wrap:wrap; }

/* Error State */
.city-error-card { max-width:650px;margin:40px auto;padding:50px 35px;background:#fff;border-radius:var(--radius-lg);box-shadow:var(--shadow-lg);text-align:center; }
.error-icon-wrapper { width:90px;height:90px;margin:0 auto;background:rgba(0,86,179,0.08);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2.5rem;color:var(--primary); }
.city-action-buttons { display:flex;gap:12px;flex-wrap:wrap;justify-content:center; }

/* Popular Services */
.popular-service-link { text-decoration:none; }
.popular-service-card { padding:20px;background:#f8f9fa;border-radius:var(--radius-md);text-align:center;transition:var(--transition);border:2px solid transparent; }
.popular-service-card:hover { background:#fff;border-color:var(--success);transform:translateY(-3px);box-shadow:var(--shadow-md); }
.popular-service-icon { width:50px;height:50px;border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;font-size:1.2rem;color:#fff; }
.bg-success{background:var(--success)}.bg-primary{background:var(--primary)}.bg-warning{background:var(--warning)}
.popular-service-card strong { display:block;color:var(--dark);font-size:0.9rem; }

/* Loading & Empty States */
.city-state-box { text-align:center;padding:80px 20px; }
.city-loader { margin-bottom:20px; }
.loader-gear { font-size:3rem;color:var(--success); }
.city-empty-state { text-align:center;padding:60px 20px; }
.city-empty-icon { width:90px;height:90px;margin:0 auto 20px;background:rgba(40,167,69,0.08);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2.5rem;color:var(--success); }
.rotate-180 { transform:rotate(180deg); }

/* ============================================
   RESPONSIVE
   ============================================ */
@media(max-width:1199.98px){.city-trust-grid{grid-template-columns:repeat(2,1fr)}.city-trust-card:nth-child(2){border-right:none}.city-details-grid{grid-template-columns:1fr}}
@media(max-width:991.98px){.city-hero{padding:70px 0 100px;min-height:auto}.city-hero-title{font-size:1.8rem}.city-floating-actions{display:none!important}}
@media(max-width:767.98px){.city-hero{padding:60px 0 90px}.city-hero-title{font-size:1.5rem}.city-hero-subtitle{font-size:0.95rem}.city-hero-stats{gap:20px}.city-stat-number{font-size:1.6rem}.city-stat-divider{display:none}.city-trust-grid{grid-template-columns:1fr 1fr}.city-trust-card{padding:16px;gap:10px}.city-tabs-scroll{justify-content:flex-start}.city-hero-cta{flex-direction:column}.city-hero-cta .city-btn{width:100%;justify-content:center}.city-hero-shape svg{height:50px}}
@media(max-width:575.98px){.city-hero{padding:50px 0 80px}.city-hero-title{font-size:1.3rem}.city-trust-grid{grid-template-columns:1fr 1fr}.city-trust-card{padding:14px 10px;border-bottom:1px solid #f0f0f0}.city-trust-card:nth-child(even){border-right:none}.city-trust-icon{width:38px;height:38px;min-width:38px;font-size:1rem}.city-final-cta{padding:50px 0}.city-final-cta-buttons{flex-direction:column}.city-final-cta-buttons .city-btn{width:100%;justify-content:center}.city-action-buttons{flex-direction:column}.city-action-buttons .city-btn{width:100%}body{padding-bottom:60px}}

/* ============================================
   PROFESSIONAL CONTACT STRIP
   ============================================ */
.city-contact-strip {
    padding: 0 0 60px 0;
    background: var(--light);
    position: relative;
    z-index: 1;
}

.city-contact-strip-inner {
    background: linear-gradient(135deg, #001a35 0%, #003d80 50%, #1a5c2a 100%);
    border-radius: 20px;
    padding: 35px 40px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 15px 50px rgba(0, 61, 128, 0.3);
}

.city-contact-strip-inner::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}

.city-contact-strip-inner::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -5%;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(40,167,69,0.1) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}

.strip-content {
    display: flex;
    align-items: center;
    gap: 20px;
    position: relative;
    z-index: 1;
}

.strip-icon-wrapper {
    width: 65px;
    height: 65px;
    min-width: 65px;
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,255,255,0.2);
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: #fff;
    animation: float 3s ease-in-out infinite;
    backdrop-filter: blur(10px);
}

.strip-text h3 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 6px;
    line-height: 1.4;
}

.strip-phone {
    color: #25D366;
    text-decoration: none;
    font-weight: 800;
    font-size: 1.4rem;
    transition: all 0.3s ease;
    position: relative;
    display: inline-block;
}

.strip-phone::after {
    content: '';
    position: absolute;
    bottom: 2px;
    left: 0;
    width: 100%;
    height: 2px;
    background: #25D366;
    transform: scaleX(0);
    transition: transform 0.3s ease;
    transform-origin: left;
}

.strip-phone:hover {
    color: #2ecc71;
}

.strip-phone:hover::after {
    transform: scaleX(1);
}

.strip-text p {
    color: rgba(255,255,255,0.8);
    font-size: 0.95rem;
    margin: 0;
    line-height: 1.5;
}

.strip-text p strong {
    color: #fff;
    font-weight: 700;
}

.strip-buttons {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    justify-content: flex-end;
    position: relative;
    z-index: 1;
}

.strip-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    border-radius: 14px;
    font-weight: 700;
    font-size: 0.95rem;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    white-space: nowrap;
    position: relative;
    overflow: hidden;
}

.strip-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.strip-btn:hover::before {
    left: 100%;
}

.strip-btn-call {
    background: #fff;
    color: #003d80;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.strip-btn-call:hover {
    background: #f0f0f0;
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.3);
    color: #003d80;
}

.strip-btn-whatsapp {
    background: #25D366;
    color: #fff;
    box-shadow: 0 8px 25px rgba(37,211,102,0.3);
}

.strip-btn-whatsapp:hover {
    background: #1fb855;
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(37,211,102,0.5);
    color: #fff;
}

.strip-btn i {
    font-size: 1.1rem;
}

/* Pulsing Dot on Phone Number */
.strip-phone-wrapper {
    position: relative;
    display: inline-block;
}

.pulse-dot {
    width: 10px;
    height: 10px;
    background: #25D366;
    border-radius: 50%;
    display: inline-block;
    margin-right: 8px;
    position: relative;
}

.pulse-dot::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: #25D366;
    border-radius: 50%;
    animation: pulse-ring-contact 2s infinite;
}

@keyframes pulse-ring-contact {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    100% {
        transform: scale(3);
        opacity: 0;
    }
}

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 1199.98px) {
    .strip-text h3 {
        font-size: 1.15rem;
    }
    .strip-phone {
        font-size: 1.25rem;
    }
}

@media (max-width: 991.98px) {
    .city-contact-strip-inner {
        padding: 30px;
    }
    .strip-buttons {
        justify-content: flex-start;
    }
    .strip-content {
        gap: 16px;
    }
    .strip-icon-wrapper {
        width: 55px;
        height: 55px;
        min-width: 55px;
        font-size: 1.5rem;
        border-radius: 14px;
    }
}

@media (max-width: 767.98px) {
    .city-contact-strip {
        padding: 0 0 40px 0;
    }
    .city-contact-strip-inner {
        padding: 25px 20px;
        border-radius: 16px;
    }
    .strip-content {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    .strip-icon-wrapper {
        margin: 0 auto;
    }
    .strip-text h3 {
        font-size: 1.1rem;
    }
    .strip-phone {
        font-size: 1.2rem;
    }
    .strip-text p {
        font-size: 0.88rem;
    }
    .strip-buttons {
        justify-content: center;
        margin-top: 20px;
    }
    .strip-btn {
        padding: 12px 22px;
        font-size: 0.88rem;
    }
}

@media (max-width: 575.98px) {
    .city-contact-strip {
        padding: 0 0 30px 0;
    }
    .city-contact-strip-inner {
        padding: 20px 16px;
        border-radius: 14px;
    }
    .strip-icon-wrapper {
        width: 48px;
        height: 48px;
        min-width: 48px;
        font-size: 1.3rem;
        border-radius: 12px;
    }
    .strip-text h3 {
        font-size: 1rem;
    }
    .strip-phone {
        font-size: 1.1rem;
    }
    .strip-text p {
        font-size: 0.82rem;
    }
    .strip-buttons {
        flex-direction: column;
        width: 100%;
    }
    .strip-btn {
        width: 100%;
        justify-content: center;
        padding: 12px 20px;
        font-size: 0.85rem;
    }
}

@media (max-width: 400px) {
    .strip-text h3 {
        font-size: 0.9rem;
    }
    .strip-phone {
        font-size: 1rem;
    }
    .strip-text p {
        font-size: 0.78rem;
    }
    .strip-btn {
        padding: 10px 18px;
        font-size: 0.8rem;
        border-radius: 10px;
    }
}

</style>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('livewire:navigated', () => { 
    if (typeof AOS !== 'undefined') AOS.refresh(); 
});
</script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/city-page.blade.php ENDPATH**/ ?>