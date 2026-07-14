<div class="city-page-wrapper">
    
    <!-- ============================================
         HERO
         ============================================ -->
    <section class="city-hero">
        <div class="container">
            <div class="row align-items-center" style="min-height: 280px;">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="city-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li><a href="<?php echo e(route('home.services')); ?>">Services</a></li>
                            <li class="active"><?php echo e($city->name); ?></li>
                        </ol>
                    </nav>
                    <h1 class="city-hero-title">
                        <?php echo e($city->meta_title ?? 'Engineering Services in ' . $city->name); ?>

                    </h1>
                    <p class="city-hero-subtitle">
                        Professional RCC core cutting, diamond drilling, wall saw cutting & plumbing services in <?php echo e($city->name); ?>

                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         CONTENT
         ============================================ -->
    <section class="city-section">
        <div class="container">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="text-center py-5">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-2">Loading...</p>
                </div>
            <?php elseif($errorMessage): ?>
                <div class="alert alert-danger text-center rounded-3">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e($errorMessage); ?>

                </div>
            <?php else: ?>
                
                
                <div class="row mb-5">
                    <div class="col-lg-10 mx-auto text-center" data-aos="fade-up">
                        <span class="sec-tag">OUR SERVICES IN</span>
                        <h2 class="sec-title"><?php echo e($city->name); ?></h2>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($city->content): ?>
                            <div class="city-description mt-3">
                                <?php echo $city->content; ?>

                            </div>
                        <?php else: ?>
                            <p class="text-muted">
                                Razzaq Engineering Services provides professional <strong>RCC core cutting, diamond drilling, wall saw cutting, concrete demolition & plumbing services</strong> in <?php echo e($city->name); ?>. Our team is available 24/7 for emergency services across all areas of <?php echo e($city->name); ?>.
                            </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                
                
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold mb-4">
                        <i class="fas fa-tools text-success me-2"></i> Our Services in <?php echo e($city->name); ?>

                    </h3>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($services->count() > 0): ?>
                        <div class="row g-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="city-service-card">
                                        <div class="cs-img">
                                            <img data-src="<?php echo e(asset('public/slider_image/'.$service->os_image)); ?>" 
                                                 alt="<?php echo e($service->os_name); ?> in <?php echo e($city->name); ?>"
                                                 class="lazy-img"
                                                 loading="lazy"
                                                 style="height:180px;width:100%;object-fit:cover;">
                                        </div>
                                        <div class="cs-body">
                                            <h4>
                                                <a href="<?php echo e(url($city->slug . '/' . Str::slug($service->os_name))); ?>">
                                                    <?php echo e($service->os_name); ?>

                                                </a>
                                            </h4>
                                            <p><?php echo e(Str::limit($service->os_short_description ?? $service->os_description, 80)); ?></p>
                                            <div class="cs-footer">
                                                <a href="<?php echo e(url($city->slug . '/' . Str::slug($service->os_name))); ?>" class="cs-link">
                                                    View Details <i class="fas fa-arrow-right ms-1"></i>
                                                </a>
                                                <a href="<?php echo e(route('quote.index')); ?>" class="cs-quote">
                                                    <i class="fas fa-file-invoice me-1"></i> Quote
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <p class="text-muted">No services listed for this city yet.</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($projects->count() > 0): ?>
                    <div class="mb-5" data-aos="fade-up">
                        <h3 class="fw-bold mb-4">
                            <i class="fas fa-folder-open text-success me-2"></i> Projects in <?php echo e($city->name); ?>

                        </h3>
                        <div class="row g-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $projects->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="project-mini-card">
                                        <img src="<?php echo e(asset('public/p_image/'.$project->p_image)); ?>" 
                                             alt="<?php echo e($project->p_title); ?>"
                                             style="height:200px;width:100%;object-fit:cover;border-radius:10px;">
                                        <h5 class="mt-2 fw-bold"><?php echo e($project->p_title); ?></h5>
                                        <p class="text-muted small"><?php echo e(Str::limit($project->p_description, 80)); ?></p>
                                    </div>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonials->count() > 0): ?>
                    <div class="mb-4" data-aos="fade-up">
                        <h3 class="fw-bold mb-4">
                            <i class="fas fa-star text-success me-2"></i> Client Reviews from <?php echo e($city->name); ?>

                        </h3>
                        <div class="row g-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $testimonials->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="col-lg-4">
                                    <div class="testimonial-mini">
                                        <p class="fst-italic text-muted">"<?php echo e(Str::limit($t->t_content, 150)); ?>"</p>
                                        <div class="d-flex align-items-center gap-2 mt-2">
                                            <strong><?php echo e($t->t_name); ?></strong>
                                            <span class="text-warning">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i=1; $i<=5; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                    <i class="fas fa-star<?php echo e($i <= $t->t_rating ? '' : '-empty'); ?> small"></i>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                
                <div class="city-cta text-center" data-aos="fade-up">
                    <div class="cta-card">
                        <h3 class="text-white fw-bold mb-2">Need Services in <?php echo e($city->name); ?>?</h3>
                        <p class="text-white opacity-75 mb-3">Contact us today for a free quote!</p>
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <a href="<?php echo e(route('quote.index')); ?>" class="btn btn-light btn-lg rounded-pill px-4 fw-bold">
                                <i class="fas fa-file-invoice me-2"></i> Get Free Quote
                            </a>
                            <a href="tel:+923048902805" class="btn btn-outline-light btn-lg rounded-pill px-4 fw-bold">
                                <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                            </a>
                        </div>
                    </div>
                </div>
                
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    <!-- ============================================
         OTHER CITIES
         ============================================ -->
    <section class="other-cities py-5 bg-light">
        <div class="container">
            <div class="text-center mb-4" data-aos="fade-up">
                <h3 class="fw-bold">Also Serving</h3>
            </div>
            <div class="row g-3 justify-content-center">
                <?php $otherCities = \App\Models\City::where('id', '!=', $city->id)->active()->limit(5)->get(); ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $otherCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="col-auto">
                        <a href="<?php echo e(url($oc->slug)); ?>" class="other-city-btn">
                            <i class="fas fa-map-marker-alt me-1"></i> <?php echo e($oc->name); ?>

                        </a>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </section>

</div>

<?php $__env->startPush('styles'); ?>
<style>
    .city-hero {
        background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%);
        min-height: 250px; display: flex; align-items: center;
    }
    .city-breadcrumb {
        display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 10px;
    }
    .city-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .city-breadcrumb li a { color: #fff; text-decoration: none; }
    .city-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .city-hero-title { color: #fff; font-size: 2.5rem; font-weight: 800; }
    .city-hero-subtitle { color: rgba(255,255,255,0.8); }

    .city-section { padding: 60px 0; }
    .sec-tag {
        display: inline-block; font-size: 0.72rem; font-weight: 700; letter-spacing: 3px;
        color: #28a745; text-transform: uppercase; margin-bottom: 8px;
    }
    .sec-title { font-size: 2rem; font-weight: 800; color: #0a1628; }
    .city-description { font-size: 0.95rem; color: #666; line-height: 1.8; }

    .city-service-card {
        background: #fff; border-radius: 14px; overflow: hidden;
        box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
        transition: all 0.3s; height: 100%;
    }
    .city-service-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
    .cs-body { padding: 18px; }
    .cs-body h4 { font-size: 1rem; font-weight: 700; margin-bottom: 6px; }
    .cs-body h4 a { color: #0a1628; text-decoration: none; }
    .cs-body h4 a:hover { color: #0056b3; }
    .cs-body p { font-size: 0.82rem; color: #888; margin-bottom: 10px; }
    .cs-footer { display: flex; justify-content: space-between; align-items: center; padding-top: 10px; border-top: 1px solid #f0f0f0; }
    .cs-link { font-size: 0.82rem; font-weight: 600; color: #0056b3; text-decoration: none; }
    .cs-quote { font-size: 0.75rem; padding: 4px 12px; background: #28a745; color: #fff; border-radius: 50px; text-decoration: none; font-weight: 600; }

    .cta-card {
        background: linear-gradient(135deg, #0056b3, #003d80);
        border-radius: 20px; padding: 40px; box-shadow: 0 15px 40px rgba(0,86,179,0.25);
    }

    .other-city-btn {
        display: inline-block; padding: 8px 20px; background: #fff; border: 2px solid #e9ecef;
        border-radius: 50px; color: #555; text-decoration: none; font-weight: 600; font-size: 0.85rem;
        transition: all 0.3s;
    }
    .other-city-btn:hover { border-color: #28a745; color: #28a745; background: #f0faf3; }

    @media (max-width: 767.98px) {
        .city-hero { min-height: 180px; }
        .city-hero-title { font-size: 1.6rem; }
        .city-section { padding: 40px 0; }
        .cta-card { padding: 25px; }
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/city-page.blade.php ENDPATH**/ ?>