<div class="city-service-page-wrapper">
    
    
    <div class="city-mobile-cta d-lg-none">
        <a href="tel:<?php echo e($settings->mobile_phone_1 ?? '+923048902805'); ?>" class="city-mobile-btn city-mobile-call">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? $settings->mobile_phone_1 ?? '+923048902805')); ?>" target="_blank" class="city-mobile-btn city-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="<?php echo e(route('quote.index')); ?>" class="city-mobile-btn city-mobile-quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>
    

    <!-- ============================================
         HERO - Always Visible
         ============================================ -->
    <section class="cs-hero">
        <div class="container">
            <div class="row align-items-center" style="min-height: 280px;">
                <div class="col-lg-8" data-aos="fade-up">
                    
                    <nav aria-label="breadcrumb">
                        <ol class="cs-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li><a href="<?php echo e(route('home.services')); ?>">Services</a></li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($city): ?>
                                <li><a href="<?php echo e(url($city->slug)); ?>"><?php echo e($city->name); ?></a></li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service && $city): ?>
                                <li class="active"><?php echo e($service->os_name); ?></li>
                            <?php else: ?>
                                <li class="active">Service Details</li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ol>
                    </nav>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                        
                        <h1 class="cs-hero-title">Loading Service...</h1>
                        <p class="cs-hero-subtitle">Please wait while we load the service details.</p>
                    
                    <?php elseif($errorMessage || !$city || !$service): ?>
                        
                        <h1 class="cs-hero-title"><?php echo e($errorMessage ?? 'Service Not Available'); ?></h1>
                        <p class="cs-hero-subtitle">
                            We couldn't find the service you're looking for. Please explore our available services.
                        </p>
                        <div class="d-flex gap-3 flex-wrap mt-3">
                            <a href="<?php echo e(route('home.services')); ?>" class="btn btn-light rounded-pill px-4 fw-bold">
                                <i class="fas fa-tools me-2"></i> Browse Services
                            </a>
                            <a href="<?php echo e(url('/')); ?>" class="btn btn-outline-light rounded-pill px-4 fw-bold">
                                <i class="fas fa-home me-2"></i> Back to Home
                            </a>
                        </div>
                    
                    <?php else: ?>
                        
                        <h1 class="cs-hero-title">
                            <?php echo e(optional($cityService)->title ?? $service->os_name . ' Services in ' . $city->name); ?>

                        </h1>
                        <p class="cs-hero-subtitle">
                            Professional <?php echo e(strtolower($service->os_name)); ?> services in <?php echo e($city->name); ?>. 
                            Available 24/7 with free consultation and estimates.
                        </p>
                        
                        
                        <div class="d-flex gap-4 mt-3">
                            <div class="text-white">
                                <i class="fas fa-check-circle text-success me-1"></i> 
                                <small>Licensed & Insured</small>
                            </div>
                            <div class="text-white">
                                <i class="fas fa-clock me-1"></i> 
                                <small>24/7 Emergency</small>
                            </div>
                            <div class="text-white">
                                <i class="fas fa-star text-warning me-1"></i> 
                                <small>5 Star Rated</small>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
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

    <!-- ============================================
         CONTENT
         ============================================ -->
    <section class="cs-section">
        <div class="container">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                
                <div class="text-center py-5">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-3 fw-semibold">Loading service details...</p>
                </div>
            
            <?php elseif($errorMessage || !$city || !$service): ?>
                
                <div class="cs-error-card" data-aos="fade-up">
                    <i class="fas fa-tools" style="font-size:4rem;color:#0056b3;"></i>
                    <h4 class="fw-bold mt-3"><?php echo e($errorMessage ?? 'Service Not Found'); ?></h4>
                    <p class="text-muted">Don't worry! We provide engineering services across Pakistan.</p>
                    
                    <div class="mt-4 d-flex flex-wrap gap-3 justify-content-center">
                        <a href="<?php echo e(route('home.services')); ?>" class="btn btn-gradient rounded-pill px-4 fw-bold">
                            <i class="fas fa-tools me-2"></i> Browse All Services
                        </a>
                        <a href="<?php echo e(url('/')); ?>" class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                            <i class="fas fa-home me-2"></i> Back to Home
                        </a>
                        <a href="<?php echo e(route('home.contact')); ?>" class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                            <i class="fas fa-envelope me-2"></i> Contact Us
                        </a>
                    </div>
                    
                    
                    <div class="mt-5">
                        <h5 class="fw-bold mb-3">Our Popular Services</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="<?php echo e(route('service.detail.slug', ['slug' => 'rcc-core-cutting'])); ?>" class="text-decoration-none">
                                    <div class="p-3 bg-light rounded-3 text-center">
                                        <i class="fas fa-cut text-success mb-2 fs-4"></i>
                                        <strong class="d-block">RCC Core Cutting</strong>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="<?php echo e(route('service.detail.slug', ['slug' => 'diamond-drilling'])); ?>" class="text-decoration-none">
                                    <div class="p-3 bg-light rounded-3 text-center">
                                        <i class="fas fa-dot-circle text-success mb-2 fs-4"></i>
                                        <strong class="d-block">Diamond Drilling</strong>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="<?php echo e(route('service.detail.slug', ['slug' => 'wall-sawing'])); ?>" class="text-decoration-none">
                                    <div class="p-3 bg-light rounded-3 text-center">
                                        <i class="fas fa-grip-lines text-success mb-2 fs-4"></i>
                                        <strong class="d-block">Wall Sawing</strong>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            
            <?php else: ?>
                
                <div class="row g-5">
                    
                    
                    <div class="col-lg-8" data-aos="fade-up">
                        
                        
                        <div class="cs-intro mb-5">
                            <h2 class="fw-bold mb-3">
                                <?php echo e(optional($cityService)->title ?? $service->os_name . ' Services in ' . $city->name); ?>

                            </h2>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cityService && $cityService->content): ?>
                                <div class="cs-content">
                                    <?php echo $cityService->content; ?>

                                </div>
                            <?php else: ?>
                                <p class="text-muted">
                                    Razzaq Engineering Services provides <strong>professional <?php echo e(strtolower($service->os_name)); ?> services in <?php echo e($city->name); ?></strong>. Our experienced team uses the latest equipment and techniques to deliver quality results on every project. Whether you need <?php echo e(strtolower($service->os_name)); ?> for residential, commercial, or industrial projects, we are your trusted partner in <?php echo e($city->name); ?>.
                                </p>
                                <p class="text-muted">
                                    With over <strong>24+ years of experience</strong> and <strong>500+ completed projects</strong> across Pakistan, we guarantee 100% client satisfaction. We offer <strong>24/7 emergency services</strong> with rapid response times across all areas of <?php echo e($city->name); ?>.
                                </p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($projects->count() > 0): ?>
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-folder-open text-success me-2"></i> 
                                    <?php echo e($service->os_name); ?> Projects in <?php echo e($city->name); ?>

                                </h3>
                                <div class="row g-3">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="col-md-6">
                                            <div class="cs-project-card">
                                                <img src="<?php echo e($project->image_url); ?>" 
                                                     alt="<?php echo e($project->p_title); ?>"
                                                     class="cs-project-img"
                                                     loading="lazy">
                                                <div class="p-3">
                                                    <h5 class="fw-bold mb-1">
                                                        <a href="<?php echo e(route('project.detail', ['slug' => $project->p_slug ?? $project->id])); ?>" class="text-dark text-decoration-none">
                                                            <?php echo e($project->p_title); ?>

                                                        </a>
                                                    </h5>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_location): ?>
                                                        <small class="text-muted">
                                                            <i class="fas fa-map-marker-alt me-1"></i> <?php echo e($project->p_location); ?>

                                                        </small>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonials->count() > 0): ?>
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-star text-warning me-2"></i> 
                                    Client Reviews
                                </h3>
                                <div class="row g-3">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="col-md-6">
                                            <div class="cs-testimonial-card">
                                                <div class="mb-2">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                        <i class="fas fa-star<?php echo e($i <= ($testimonial->t_rating ?? 5) ? ' text-warning' : ' text-muted'); ?> small"></i>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                                </div>
                                                <p class="text-muted small mb-2">
                                                    "<?php echo e(Str::limit($testimonial->t_content, 120)); ?>"
                                                </p>
                                                <div class="d-flex align-items-center gap-2">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonial->t_image): ?>
                                                        <img src="<?php echo e($testimonial->image_url); ?>" 
                                                             alt="<?php echo e($testimonial->t_name); ?>"
                                                             class="rounded-circle"
                                                             style="width:35px;height:35px;object-fit:cover;">
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    <div>
                                                        <strong class="small"><?php echo e($testimonial->t_name); ?></strong>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonial->t_location): ?>
                                                            <br><small class="text-muted"><?php echo e($testimonial->t_location); ?></small>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($faqs) > 0): ?>
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-question-circle text-success me-2"></i> 
                                    Frequently Asked Questions
                                </h3>
                                <div class="accordion" id="csFaq">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="accordion-item border-0 mb-2 rounded-3 shadow-sm">
                                            <button class="accordion-button <?php echo e($key > 0 ? 'collapsed' : ''); ?> rounded-3 fw-semibold" 
                                                    data-bs-toggle="collapse" 
                                                    data-bs-target="#faq<?php echo e($key); ?>">
                                                <?php echo e($faq['question'] ?? $faq['q'] ?? ''); ?>

                                            </button>
                                            <div id="faq<?php echo e($key); ?>" class="accordion-collapse collapse <?php echo e($key == 0 ? 'show' : ''); ?>">
                                                <div class="accordion-body text-muted">
                                                    <?php echo e($faq['answer'] ?? $faq['a'] ?? ''); ?>

                                                </div>
                                            </div>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                    </div>
                    
                    
                    <div class="col-lg-4" data-aos="fade-left">
                        
                        
                        <div class="cs-sidebar-card mb-4">
                            <h5 class="fw-bold mb-3">
                                <i class="fas fa-file-invoice text-success me-2"></i> Get Free Quote
                            </h5>
                            <p class="text-muted small">Need <?php echo e(strtolower($service->os_name)); ?> in <?php echo e($city->name); ?>?</p>
                            <a href="<?php echo e(route('quote.index')); ?>" class="btn btn-gradient w-100 rounded-pill py-2 fw-bold">
                                <i class="fas fa-paper-plane me-2"></i> Request Quote
                            </a>
                            <a href="tel:<?php echo e($settings->mobile_phone_1 ?? '+923048902805'); ?>" class="btn btn-outline-success w-100 rounded-pill py-2 fw-bold mt-2">
                                <i class="fas fa-phone-alt me-2"></i> <?php echo e($settings->mobile_phone_1 ?? '+92 304 8902805'); ?>

                            </a>
                            <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? $settings->mobile_phone_1 ?? '+923048902805')); ?>" 
                               target="_blank" 
                               class="btn btn-success w-100 rounded-pill py-2 fw-bold mt-2">
                                <i class="fab fa-whatsapp me-2"></i> Chat on WhatsApp
                            </a>
                        </div>
                        
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($otherCities->count() > 0): ?>
                            <div class="cs-sidebar-card mb-4">
                                <h5 class="fw-bold mb-3">
                                    <i class="fas fa-map-marker-alt text-success me-2"></i> 
                                    <?php echo e($service->os_name); ?> in Other Cities
                                </h5>
                                <ul class="list-unstyled mb-0">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $otherCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otherCity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <li class="mb-2">
                                            <a href="<?php echo e(url($otherCity->slug . '/' . $service->os_slug)); ?>" class="cs-sidebar-link">
                                                <i class="fas fa-chevron-right small me-2"></i>
                                                <?php echo e($service->os_name); ?> in <?php echo e($otherCity->name); ?>

                                            </a>
                                        </li>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedServices->count() > 0): ?>
                            <div class="cs-sidebar-card">
                                <h5 class="fw-bold mb-3">
                                    <i class="fas fa-tools text-success me-2"></i> 
                                    Other Services in <?php echo e($city->name); ?>

                                </h5>
                                <ul class="list-unstyled mb-0">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $relatedServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <li class="mb-2">
                                            <a href="<?php echo e(url($city->slug . '/' . $relatedService->os_slug)); ?>" class="cs-sidebar-link">
                                                <i class="fas fa-chevron-right small me-2"></i>
                                                <?php echo e($relatedService->os_name); ?>

                                            </a>
                                        </li>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        
                        <div class="cs-sidebar-card mt-4">
                            <h5 class="fw-bold mb-3">Why Choose Us?</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> 24+ Years Experience</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Licensed & Insured</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Latest Equipment</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> 24/7 Emergency Service</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> 100% Satisfaction</li>
                            </ul>
                        </div>
                        
                    </div>
                    
                </div>
                
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>
    
    
    <section class="cs-final-cta">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($city && $service): ?>
                    Need <?php echo e($service->os_name); ?> in <?php echo e($city->name); ?>?
                <?php else: ?>
                    Need Engineering Services?
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </h2>
            <p class="mb-4 text-muted">Contact us today for a free consultation and estimate.</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="<?php echo e(route('quote.index')); ?>" class="btn btn-gradient rounded-pill px-5 py-3 fw-bold">
                    <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                </a>
                <a href="tel:<?php echo e($settings->mobile_phone_1 ?? '+923048902805'); ?>" class="btn btn-outline-primary rounded-pill px-5 py-3 fw-bold">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>

</div>

<?php $__env->startPush('styles'); ?>
<style>
/* ============================================
   CITY SERVICE PAGE - PROFESSIONAL DESIGN
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
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

[x-cloak] { display: none !important; }

/* Animations */
@keyframes float { 0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)} }
@keyframes shine { 0%{transform:translateX(-100%)}100%{transform:translateX(100%)} }
@keyframes pulse-ring-contact { 0%{transform:scale(1);opacity:1}100%{transform:scale(3);opacity:0} }

/* ============================================
   MOBILE CTA
   ============================================ */
.city-mobile-cta { 
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 998; 
    display: flex; background: var(--white); 
    box-shadow: 0 -4px 20px rgba(0,0,0,0.12);
    border-radius: 20px 20px 0 0;
}
.city-mobile-btn { 
    flex: 1; display: flex; align-items: center; justify-content: center; 
    gap: 6px; padding: 14px 8px; font-size: 0.8rem; font-weight: 700; 
    text-decoration: none; border: none; cursor: pointer; 
    transition: var(--transition);
}
.city-mobile-btn:active { transform: scale(0.95); }
.city-mobile-call { background: #f8f9fa; color: var(--dark); border-right: 1px solid #eee; }
.city-mobile-whatsapp { background: #25D366; color: #fff; border-right: 1px solid #1fb855; }
.city-mobile-quote { background: linear-gradient(135deg, var(--primary), var(--success)); color: #fff; }

/* ============================================
   HERO
   ============================================ */
.cs-hero {
    position: relative;
    background: linear-gradient(135deg, #001a35 0%, #003d80 30%, #1a5c2a 100%);
    min-height: 380px; 
    display: flex; 
    align-items: center;
    padding: 100px 0 60px;
    overflow: hidden;
}
.cs-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url('<?php echo e(asset("images/city-hero-bg.jpg")); ?>') center/cover no-repeat;
    filter: brightness(0.25);
    z-index: 0;
}
.cs-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(0,61,128,0.92) 0%, rgba(26,92,42,0.85) 100%);
    z-index: 1;
}
.cs-hero .container { position: relative; z-index: 2; }

/* Breadcrumb */
.cs-breadcrumb {
    display: flex; gap: 6px; list-style: none; padding: 0; margin: 0 0 20px;
    font-size: 0.85rem; flex-wrap: wrap;
}
.cs-breadcrumb li { color: rgba(255,255,255,0.7); }
.cs-breadcrumb li a { color: rgba(255,255,255,0.9); text-decoration: none; transition: var(--transition); }
.cs-breadcrumb li a:hover { color: #fff; text-decoration: underline; }
.cs-breadcrumb li:not(:last-child)::after { content: '›'; margin-left: 6px; color: rgba(255,255,255,0.4); }
.cs-breadcrumb li.active { color: var(--success); font-weight: 600; }

.cs-hero-title { 
    color: #fff; font-size: clamp(1.8rem, 4vw, 2.8rem); 
    font-weight: 800; line-height: 1.15; margin-bottom: 12px;
    letter-spacing: -0.5px;
}
.cs-hero-subtitle { 
    color: rgba(255,255,255,0.85); font-size: 1.05rem; 
    max-width: 600px; line-height: 1.6;
}

/* Hero Stats Badges */
.cs-hero-badges {
    display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px;
}
.cs-hero-badge-item {
    display: flex; align-items: center; gap: 6px;
    color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 500;
}
.cs-hero-badge-item i { font-size: 0.9rem; }

/* ============================================
   SECTION
   ============================================ */
.cs-section { 
    padding: 60px 0; 
    background: var(--light); 
}

/* Content Typography */
.cs-content { 
    font-size: 0.95rem; color: #555; line-height: 1.8; 
}
.cs-content p { margin-bottom: 15px; }
.cs-content strong { color: var(--dark); }

/* Section Headings */
.cs-section-title {
    font-size: 1.5rem; font-weight: 800; color: var(--dark);
    margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
}
.cs-section-title i { color: var(--success); font-size: 1.3rem; }

/* ============================================
   PROJECT CARDS
   ============================================ */
.cs-project-card {
    background: #fff; border-radius: var(--radius-md); overflow: hidden;
    box-shadow: var(--shadow-sm); border: 1px solid var(--border);
    transition: var(--transition); height: 100%;
}
.cs-project-card:hover { 
    transform: translateY(-5px); 
    box-shadow: var(--shadow-lg); 
    border-color: var(--success);
}
.cs-project-img {
    height: 200px; width: 100%; object-fit: cover;
    transition: transform 0.5s;
}
.cs-project-card:hover .cs-project-img { transform: scale(1.05); }

/* ============================================
   TESTIMONIAL CARDS
   ============================================ */
.cs-testimonial-card {
    background: #fff; border-radius: var(--radius-md); padding: 22px;
    box-shadow: var(--shadow-sm); border: 1px solid var(--border);
    height: 100%; transition: var(--transition); position: relative;
}
.cs-testimonial-card:hover { 
    transform: translateY(-3px); 
    box-shadow: var(--shadow-md); 
}
.cs-testimonial-card::before {
    content: '\201C';
    position: absolute;
    top: 10px; right: 20px;
    font-size: 3rem; color: rgba(40,167,69,0.1);
    font-family: serif; line-height: 1;
}

/* ============================================
   FAQ ACCORDION
   ============================================ */
.accordion-button {
    font-weight: 600; font-size: 0.95rem;
    color: var(--dark); background: #fff;
    border-radius: var(--radius-sm) !important;
    padding: 16px 20px;
}
.accordion-button:not(.collapsed) {
    color: var(--success); background: #f0faf3;
    box-shadow: none;
}
.accordion-button:focus {
    box-shadow: 0 0 0 3px rgba(40,167,69,0.15);
    border-color: var(--success);
}
.accordion-body {
    font-size: 0.9rem; color: #666; line-height: 1.7;
    padding: 16px 20px;
}

/* ============================================
   SIDEBAR
   ============================================ */
.cs-sidebar-card {
    background: #fff; border-radius: var(--radius-md); padding: 24px;
    box-shadow: var(--shadow-sm); border: 1px solid var(--border);
    transition: var(--transition);
}
.cs-sidebar-card:hover {
    box-shadow: var(--shadow-md);
}

.cs-sidebar-card h5 {
    font-size: 1rem; font-weight: 700; color: var(--dark);
    margin-bottom: 16px; display: flex; align-items: center; gap: 8px;
}
.cs-sidebar-card h5 i { color: var(--success); }

/* Sidebar Links */
.cs-sidebar-link {
    color: #555; text-decoration: none; font-size: 0.88rem; 
    transition: var(--transition); display: flex; align-items: center;
    padding: 8px 0; border-bottom: 1px solid #f5f5f5;
}
.cs-sidebar-link:last-child { border-bottom: none; }
.cs-sidebar-link:hover { 
    color: var(--success); 
    padding-left: 8px; 
    background: #f0faf3;
    margin: 0 -12px;
    padding-left: 20px;
    border-radius: 6px;
}
.cs-sidebar-link i { 
    color: var(--success); font-size: 0.7rem; 
    transition: var(--transition);
}

/* Trust Badges List */
.cs-trust-list {
    list-style: none; padding: 0; margin: 0;
}
.cs-trust-list li {
    padding: 10px 0; font-size: 0.88rem; color: #555;
    display: flex; align-items: center; gap: 10px;
    border-bottom: 1px solid #f5f5f5;
}
.cs-trust-list li:last-child { border-bottom: none; }
.cs-trust-list li i { color: var(--success); font-size: 0.9rem; }

/* ============================================
   BUTTONS
   ============================================ */
.btn-gradient {
    background: linear-gradient(135deg, var(--primary), var(--success));
    color: #fff; border: none; position: relative; overflow: hidden;
    transition: var(--transition); font-weight: 600;
}
.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(40,167,69,0.35);
    color: #fff;
}

/* ============================================
   ERROR STATE
   ============================================ */
.cs-error-card {
    max-width: 700px; margin: 40px auto; padding: 50px 30px;
    background: #fff; border-radius: var(--radius-lg); 
    box-shadow: var(--shadow-lg); text-align: center;
}
.cs-error-card .error-icon {
    width: 90px; height: 90px; margin: 0 auto 20px;
    background: rgba(40,167,69,0.08); border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 2.5rem; color: var(--success);
}

/* ============================================
   FINAL CTA
   ============================================ */
.cs-final-cta {
    padding: 70px 0; background: #fff;
    border-top: 1px solid var(--border);
}
.cs-final-cta h2 { 
    font-size: clamp(1.5rem, 3vw, 2rem); 
    font-weight: 800; color: var(--dark); 
}

/* ============================================
   CONTACT STRIP
   ============================================ */
.city-contact-strip {
    padding: 40px 0;
    background: var(--light);
    position: relative;
    z-index: 1;
}
.city-contact-strip-inner {
    background: linear-gradient(135deg, #001a35 0%, #003d80 50%, #1a5c2a 100%);
    border-radius: var(--radius-lg);
    padding: 35px 40px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 15px 50px rgba(0, 61, 128, 0.3);
}
.city-contact-strip-inner::before {
    content: '';
    position: absolute;
    top: -50%; right: -10%;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.city-contact-strip-inner::after {
    content: '';
    position: absolute;
    bottom: -30%; left: -5%;
    width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(40,167,69,0.1) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.strip-content {
    display: flex; align-items: center; gap: 20px;
    position: relative; z-index: 1;
}
.strip-icon-wrapper {
    width: 60px; height: 60px; min-width: 60px;
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,255,255,0.2);
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.6rem; color: #fff;
    animation: float 3s ease-in-out infinite;
}
.strip-text h3 {
    font-size: 1.2rem; font-weight: 700; color: #fff;
    margin-bottom: 4px; line-height: 1.4;
}
.strip-phone {
    color: #25D366; text-decoration: none;
    font-weight: 800; font-size: 1.3rem;
    transition: var(--transition); position: relative;
}
.strip-phone:hover { color: #2ecc71; }
.strip-text p {
    color: rgba(255,255,255,0.8); font-size: 0.9rem; margin: 0;
}
.strip-text p strong { color: #fff; }
.strip-buttons {
    display: flex; gap: 12px; flex-wrap: wrap;
    justify-content: flex-end; position: relative; z-index: 1;
}
.strip-btn {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 13px 26px; border-radius: 12px;
    font-weight: 700; font-size: 0.9rem; text-decoration: none;
    transition: var(--transition); white-space: nowrap;
    position: relative; overflow: hidden;
}
.strip-btn:hover { transform: translateY(-2px); }
.strip-btn-call { background: #fff; color: #003d80; box-shadow: 0 8px 25px rgba(0,0,0,0.2); }
.strip-btn-call:hover { background: #f0f0f0; color: #003d80; }
.strip-btn-whatsapp { background: #25D366; color: #fff; box-shadow: 0 8px 25px rgba(37,211,102,0.3); }
.strip-btn-whatsapp:hover { background: #1fb855; color: #fff; }

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 991.98px) {
    .cs-hero { min-height: 300px; padding: 80px 0 50px; }
    .cs-hero-title { font-size: 1.6rem; }
    .city-contact-strip-inner { padding: 30px; }
    .strip-buttons { justify-content: flex-start; }
}

@media (max-width: 767.98px) {
    .cs-hero { min-height: 250px; padding: 70px 0 40px; }
    .cs-hero-title { font-size: 1.4rem; }
    .cs-hero-subtitle { font-size: 0.9rem; }
    .cs-section { padding: 40px 0; }
    .cs-final-cta { padding: 50px 0; }
    .city-contact-strip { padding: 30px 0; }
    .city-contact-strip-inner { padding: 25px 20px; border-radius: 16px; }
    .strip-content { flex-direction: column; text-align: center; gap: 15px; }
    .strip-icon-wrapper { margin: 0 auto; }
    .strip-buttons { justify-content: center; margin-top: 20px; }
    .cs-sidebar-card { padding: 18px; }
    body { padding-bottom: 60px; }
}

@media (max-width: 575.98px) {
    .cs-hero { min-height: 200px; padding: 60px 0 35px; }
    .cs-hero-title { font-size: 1.2rem; }
    .cs-breadcrumb { font-size: 0.75rem; margin-bottom: 12px; }
    .cs-section-title { font-size: 1.2rem; }
    .cs-project-img { height: 160px; }
    .city-contact-strip-inner { padding: 20px 16px; border-radius: 14px; }
    .strip-text h3 { font-size: 1rem; }
    .strip-phone { font-size: 1.1rem; }
    .strip-buttons { flex-direction: column; width: 100%; }
    .strip-btn { width: 100%; justify-content: center; }
    .cs-final-cta { padding: 40px 0; }
    .accordion-button { font-size: 0.85rem; padding: 14px 16px; }
}

@media (max-width: 400px) {
    .cs-hero-title { font-size: 1.1rem; }
    .strip-text h3 { font-size: 0.9rem; }
    .strip-phone { font-size: 1rem; }
    .strip-btn { padding: 10px 18px; font-size: 0.82rem; }
}
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/city-service-page.blade.php ENDPATH**/ ?>