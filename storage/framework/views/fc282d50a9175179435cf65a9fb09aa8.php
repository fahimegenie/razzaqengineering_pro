<div class="city-service-page-wrapper">
    
    <!-- ============================================
         HERO
         ============================================ -->
    <section class="cs-hero">
        <div class="container">
            <div class="row align-items-center" style="min-height: 280px;">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="cs-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li><a href="<?php echo e(url($city->slug)); ?>"><?php echo e($city->name); ?></a></li>
                            <li class="active"><?php echo e($service->os_name); ?></li>
                        </ol>
                    </nav>
                    <h1 class="cs-hero-title">
                        <?php echo e(optional($cityService)->title ?? $service->os_name . ' in ' . $city->name); ?>

                    </h1>
                    <p class="cs-hero-subtitle">
                        Professional <?php echo e(strtolower($service->os_name)); ?> services in <?php echo e($city->name); ?>. Available 24/7.
                    </p>
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
                </div>
            <?php elseif($errorMessage): ?>
                <div class="alert alert-danger"><?php echo e($errorMessage); ?></div>
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
                                    With over <strong>15 years of experience</strong> and <strong>500+ completed projects</strong> across Pakistan, we guarantee 100% client satisfaction. We offer <strong>24/7 emergency services</strong> with rapid response times across all areas of <?php echo e($city->name); ?>.
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
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="col-md-6">
                                            <div class="cs-project-card">
                                                <img src="<?php echo e(asset('p_image/'.$p->p_image)); ?>" 
                                                     alt="<?php echo e($p->p_title); ?>"
                                                     style="height:180px;width:100%;object-fit:cover;border-radius:10px;">
                                                <h5 class="mt-2 fw-bold"><?php echo e($p->p_title); ?></h5>
                                            </div>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($faqs) > 0): ?>
                            <div class="mb-5">
                                <h3 class="fw-bold mb-3">
                                    <i class="fas fa-question-circle text-success me-2"></i> FAQ
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
                            <a href="tel:+923048902805" class="btn btn-outline-success w-100 rounded-pill py-2 fw-bold mt-2">
                                <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                            </a>
                        </div>
                        
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($otherCities->count() > 0): ?>
                            <div class="cs-sidebar-card mb-4">
                                <h5 class="fw-bold mb-3">
                                    <i class="fas fa-map-marker-alt text-success me-2"></i> 
                                    <?php echo e($service->os_name); ?> in Other Cities
                                </h5>
                                <ul class="list-unstyled mb-0">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $otherCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <li class="mb-2">
                                            <a href="<?php echo e(url($oc->slug . '/' . Str::slug($service->os_name))); ?>" class="cs-sidebar-link">
                                                <i class="fas fa-chevron-right small me-2"></i>
                                                <?php echo e($service->os_name); ?> in <?php echo e($oc->name); ?>

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
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $relatedServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <li class="mb-2">
                                            <a href="<?php echo e(url($city->slug . '/' . Str::slug($rs->os_name))); ?>" class="cs-sidebar-link">
                                                <i class="fas fa-chevron-right small me-2"></i>
                                                <?php echo e($rs->os_name); ?>

                                            </a>
                                        </li>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                    </div>
                    
                </div>
                
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

</div>

<?php $__env->startPush('styles'); ?>
<style>
    .cs-hero {
        background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%);
        min-height: 250px; display: flex; align-items: center;
    }
    .cs-breadcrumb {
        display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 10px;
    }
    .cs-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .cs-breadcrumb li a { color: #fff; text-decoration: none; }
    .cs-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .cs-hero-title { color: #fff; font-size: 2.5rem; font-weight: 800; }
    .cs-hero-subtitle { color: rgba(255,255,255,0.8); }

    .cs-section { padding: 60px 0; background: #f8f9fa; }
    .cs-content { font-size: 0.95rem; color: #666; line-height: 1.8; }

    .cs-sidebar-card {
        background: #fff; border-radius: 14px; padding: 22px;
        box-shadow: 0 3px 20px rgba(0,0,0,0.04); border: 1px solid #eef0f2;
    }
    .cs-sidebar-link {
        color: #555; text-decoration: none; font-size: 0.88rem; transition: color 0.3s;
    }
    .cs-sidebar-link:hover { color: #28a745; }

    @media (max-width: 767.98px) {
        .cs-hero { min-height: 180px; }
        .cs-hero-title { font-size: 1.6rem; }
        .cs-section { padding: 40px 0; }
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/city-service-page.blade.php ENDPATH**/ ?>