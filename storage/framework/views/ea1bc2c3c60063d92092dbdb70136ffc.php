<!-- ============================================
     PROFESSIONAL HERO CAROUSEL
     ============================================ -->
<div id="heroCarousel" class="carousel slide carousel-fade hero-carousel" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover">
    
    
    <div class="carousel-indicators">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <button type="button" 
                    data-bs-target="#heroCarousel" 
                    data-bs-slide-to="<?php echo e($key); ?>" 
                    class="<?php echo e($key == 0 ? 'active' : ''); ?>" 
                    aria-label="Slide <?php echo e($key + 1); ?>"
                    style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #fff; background: <?php echo e($key == 0 ? '#28a745' : 'transparent'); ?>;">
            </button>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
    
    
    <div class="carousel-inner">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>" 
                 style="background-image: url('<?php echo e(asset('slider_image/'.$value->s_image)); ?>');
                        background-size: cover;
                        background-position: center;
                        background-repeat: no-repeat;
                        min-height: 650px;">
                
                
                <div class="hero-overlay" style="
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(135deg, rgba(0,54,108,0.85) 0%, rgba(0,54,108,0.4) 50%, rgba(40,167,69,0.75) 100%);
                    z-index: 1;
                "></div>
                
                
                <div class="container position-relative h-100" style="z-index: 2;">
                    <div class="row align-items-center h-100">
                        <div class="col-lg-7 col-md-9">
                            <div class="hero-content py-5">
                                
                                
                                <span class="badge bg-gradient-success px-4 py-2 rounded-pill mb-3 fs-6 fw-semibold animate__animated animate__fadeInDown" 
                                      style="background: linear-gradient(135deg, #28a745, #0056b3); letter-spacing: 1px;">
                                    <i class="fas fa-check-circle me-2"></i> We are available for
                                </span>
                                
                                
                                <h1 class="text-white fw-bold display-3 mb-3 hero-title animate__animated animate__fadeInUp" 
                                    style="text-shadow: 2px 4px 12px rgba(0,0,0,0.3); line-height: 1.2;">
                                    <?php echo e($value->s_title); ?>

                                </h1>
                                
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($value->s_description): ?>
                                    <p class="text-white opacity-90 lead mb-4 animate__animated animate__fadeInUp animate__delay-1s"
                                       style="max-width: 600px; font-size: 1.1rem; line-height: 1.8;">
                                        <?php echo e(Str::limit($value->s_description, 250)); ?>

                                    </p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($value->s_t1 || $value->s_t2 || $value->s_t3): ?>
                                    <div class="hero-features mb-4 animate__animated animate__fadeInUp animate__delay-2s">
                                        <div class="d-flex flex-wrap gap-3">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($value->s_t1): ?>
                                                <div class="feature-item d-flex align-items-center bg-white bg-opacity-10 rounded-pill px-4 py-2 backdrop-blur">
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    <span class="text-white fw-medium"><?php echo e($value->s_t1); ?></span>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($value->s_t2): ?>
                                                <div class="feature-item d-flex align-items-center bg-white bg-opacity-10 rounded-pill px-4 py-2 backdrop-blur">
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    <span class="text-white fw-medium"><?php echo e($value->s_t2); ?></span>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($value->s_t3): ?>
                                                <div class="feature-item d-flex align-items-center bg-white bg-opacity-10 rounded-pill px-4 py-2 backdrop-blur">
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    <span class="text-white fw-medium"><?php echo e($value->s_t3); ?></span>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                
                                <div class="hero-buttons d-flex flex-wrap gap-3 animate__animated animate__fadeInUp animate__delay-3s">
                                    <a href="<?php echo e(route('quote.index')); ?>" 
                                       class="btn btn-gradient btn-lg fw-bold px-5 py-3 rounded-pill shadow-lg d-flex align-items-center gap-2"
                                       style="background: linear-gradient(135deg, #28a745, #0056b3); border: none; font-size: 1.05rem; transition: all 0.3s ease;"
                                       onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 30px rgba(40,167,69,0.4)';"
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(40,167,69,0.3)';">
                                        <i class="fas fa-paper-plane"></i> Get a Free Quote
                                        <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                    
                                    <a href="tel:+923048902805" 
                                       class="btn btn-outline-light btn-lg fw-semibold px-5 py-3 rounded-pill d-flex align-items-center gap-2"
                                       style="border: 2px solid rgba(255,255,255,0.5); transition: all 0.3s ease;"
                                       onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.borderColor='#fff';"
                                       onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(255,255,255,0.5)';">
                                        <i class="fas fa-phone-alt"></i> Call Now
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center">
                            <div class="hero-illustration animate__animated animate__fadeInRight animate__delay-1s">
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($value->s_video)): ?>
                                    <div class="hero-video-wrapper rounded-4 overflow-hidden shadow-lg" 
                                         style="border: 4px solid rgba(255,255,255,0.2);">
                                        <video autoplay muted loop playsinline class="w-100 rounded-3" style="max-height: 350px;">
                                            <source src="<?php echo e(asset('slider_image/'.$value->s_video)); ?>" type="video/mp4">
                                        </video>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
    
    
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"
            style="width: 60px; height: 60px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.3); border-radius: 50%; margin-left: 20px; backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s ease;"
            onmouseover="this.style.background='rgba(40,167,69,0.8)'; this.style.borderColor='#28a745';"
            onmouseout="this.style.background='rgba(0,0,0,0.3)'; this.style.borderColor='rgba(255,255,255,0.3)';">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"
            style="width: 60px; height: 60px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.3); border-radius: 50%; margin-right: 20px; backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s ease;"
            onmouseover="this.style.background='rgba(40,167,69,0.8)'; this.style.borderColor='#28a745';"
            onmouseout="this.style.background='rgba(0,0,0,0.3)'; this.style.borderColor='rgba(255,255,255,0.3)';">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    
    
    <div class="scroll-down-indicator position-absolute bottom-0 start-50 translate-middle-x mb-4 text-center animate__animated animate__bounce animate__infinite animate__delay-5s" 
         style="z-index: 3; cursor: pointer;"
         onclick="document.getElementById('aboutSection').scrollIntoView({behavior:'smooth'});">
        <span class="text-white opacity-75 small d-block mb-2">Scroll Down</span>
        <i class="fas fa-chevron-down text-white opacity-75 fs-5"></i>
    </div>
</div>


<?php $__env->startPush('styles'); ?>
<style>
    /* Hero Carousel Styles */
    .hero-carousel .carousel-item {
        height: 650px;
        position: relative;
        overflow: hidden;
    }
    
    .hero-carousel .carousel-item::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 200px;
        background: linear-gradient(to top, rgba(0,0,0,0.4) 0%, transparent 100%);
        z-index: 1;
        pointer-events: none;
    }
    
    /* Fade Transition */
    .carousel-fade .carousel-item {
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
    
    .carousel-fade .carousel-item.active {
        opacity: 1;
    }
    
    /* Hero Content */
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .hero-title {
        animation: heroTitleReveal 1s ease;
    }
    
    @keyframes heroTitleReveal {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Feature Items */
    .feature-item {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.15);
        transition: all 0.3s ease;
    }
    
    .feature-item:hover {
        background: rgba(255,255,255,0.2) !important;
        transform: translateY(-2px);
    }
    
    /* Backdrop Blur Utility */
    .backdrop-blur {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }
    
    /* Carousel Indicators */
    .hero-carousel .carousel-indicators {
        bottom: 30px;
        z-index: 3;
    }
    
    .hero-carousel .carousel-indicators button {
        width: 12px !important;
        height: 12px !important;
        border-radius: 50% !important;
        margin: 0 6px;
        transition: all 0.3s ease;
    }
    
    .hero-carousel .carousel-indicators button:hover {
        background: #28a745 !important;
        border-color: #28a745 !important;
    }
    
    /* Scroll Down Indicator */
    .scroll-down-indicator {
        animation: scrollBounce 2s infinite;
    }
    
    @keyframes scrollBounce {
        0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
        40% { transform: translateX(-50%) translateY(-10px); }
        60% { transform: translateX(-50%) translateY(-5px); }
    }
    
    /* Responsive */
    @media (max-width: 1199.98px) {
        .hero-carousel .carousel-item { height: 600px; }
        .hero-title { font-size: 2.8rem !important; }
    }
    
    @media (max-width: 991.98px) {
        .hero-carousel .carousel-item { height: 550px; }
        .hero-title { font-size: 2.4rem !important; }
        .hero-content { text-align: center; }
        .hero-features .d-flex { justify-content: center; }
        .hero-buttons { justify-content: center; }
        .carousel-control-prev, .carousel-control-next { 
            width: 45px !important; 
            height: 45px !important; 
            margin-left: 10px !important;
            margin-right: 10px !important;
        }
    }
    
    @media (max-width: 767.98px) {
        .hero-carousel .carousel-item { height: 500px; }
        .hero-title { font-size: 2rem !important; }
        .hero-content p { font-size: 1rem !important; }
        .feature-item { padding: 6px 15px !important; font-size: 0.85rem; }
        .btn-gradient, .btn-outline-light { padding: 12px 25px !important; font-size: 0.9rem !important; }
        .scroll-down-indicator { display: none; }
    }
    
    @media (max-width: 575.98px) {
        .hero-carousel .carousel-item { height: 450px; }
        .hero-title { font-size: 1.6rem !important; }
        .hero-buttons { flex-direction: column; gap: 10px !important; }
        .hero-buttons .btn { width: 100%; justify-content: center; }
        .carousel-indicators { bottom: 15px; }
        .carousel-indicators button { width: 8px !important; height: 8px !important; }
    }
    
    @media (max-width: 400px) {
        .hero-carousel .carousel-item { height: 400px; }
        .hero-title { font-size: 1.4rem !important; }
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/website/partials/home/hero-section.blade.php ENDPATH**/ ?>