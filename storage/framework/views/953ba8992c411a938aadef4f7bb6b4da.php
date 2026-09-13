<?php
    // Safe handling if $com is an array or an object
    $isComArr = is_array($com ?? null);
    $comImage1 = $isComArr ? ($com['image1_url'] ?? '') : ($com->image1_url ?? '');
    $comImage2 = $isComArr ? ($com['image2_url'] ?? '') : ($com->image2_url ?? '');
    $comOcImage1 = $isComArr ? ($com['oc_image1'] ?? null) : ($com->oc_image1 ?? null);
    $comOcImage2 = $isComArr ? ($com['oc_image2'] ?? null) : ($com->oc_image2 ?? null);
    $comEstablishedYear = $isComArr ? ($com['established_year'] ?? null) : ($com->established_year ?? null);
    $comOcTitle = $isComArr ? ($com['oc_title'] ?? '') : ($com->oc_title ?? '');
    $comOcDescription = $isComArr ? ($com['oc_description'] ?? '') : ($com->oc_description ?? '');
?>

<!-- ============================================
     PROFESSIONAL ABOUT US SECTION
     Balanced & Compact Design
     ============================================ -->
<section class="about-section-pro" id="aboutSection">
    <div class="container">
        
        <div class="row g-4 g-lg-5 align-items-center">
            
            
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                <div class="image-gallery-pro">
                    
                    
                    <div class="main-image-wrapper">
                        <div class="main-image-card">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($com) && $comOcImage1): ?>
                                <img src="<?php echo e($comImage1); ?>" 
                                     alt="Razzaq Engineering Services" 
                                     class="main-image" loading="lazy">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/images/about1.jpg')); ?>" 
                                     alt="Engineering Services Pakistan" 
                                     class="main-image" loading="lazy">
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        
                        
                        <div class="floating-image-card">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($com) && $comOcImage2): ?>
                                <img src="<?php echo e($comImage2); ?>" 
                                     alt="Our Work Quality" loading="lazy">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/images/about2.jpg')); ?>" 
                                     alt="Quality Workmanship" loading="lazy">
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        
                        
                        <div class="experience-box-pro">
                            <div class="exp-icon-wrap">
                                <i class="fas fa-award"></i>
                            </div>
                            <div class="exp-info">
                                <span class="exp-number"><span class="counter-num" data-target="15">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($com) && !empty($comEstablishedYear)): ?>
                                        <?php echo e(max(0, now()->year - $comEstablishedYear)); ?>+
                                    <?php else: ?>
                                        24+
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </span></span>
                                <span class="exp-subtitle">Years Experience</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                <div class="content-wrapper-pro">
                    
                    
                    <span class="section-label-pro">WHO WE ARE</span>
                    
                    
                    <h2 class="section-title-pro">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($com) && $comOcTitle): ?>
                            <?php echo e($comOcTitle); ?>

                        <?php else: ?>
                            Pakistan's Trusted <span class="text-highlight">Engineering Services</span> Company
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </h2>
                    
                    
                    <p class="section-desc-pro">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($com) && $comOcDescription): ?>
                            <?php echo Str::limit(strip_tags($comOcDescription), 250); ?>

                        <?php else: ?>
                            With over 15 years of industry leadership, we deliver professional RCC core cutting, diamond drilling, wall saw cutting, plumbing & fire fighting services across Pakistan.
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </p>
                    
                    
                    <div class="stats-row-pro">
                        <div class="stat-item-pro">
                            <span class="stat-number-pro counter" data-target="500">0</span>
                            <span class="stat-suffix">+</span>
                            <span class="stat-text-pro">Projects Done</span>
                        </div>
                        <div class="stat-divider"></div>
                        <div class="stat-item-pro">
                            <span class="stat-number-pro counter" data-target="300">0</span>
                            <span class="stat-suffix">+</span>
                            <span class="stat-text-pro">Happy Clients</span>
                        </div>
                        <div class="stat-divider"></div>
                        <div class="stat-item-pro">
                            <span class="stat-number-pro counter" data-target="10">0</span>
                            <span class="stat-suffix">+</span>
                            <span class="stat-text-pro">Cities Covered</span>
                        </div>
                    </div>
                    
                    
                    <div class="feature-points-pro">
                        <div class="feature-point">
                            <i class="fas fa-check-circle"></i>
                            <span>Licensed, Certified & Insured Company</span>
                        </div>
                        <div class="feature-point">
                            <i class="fas fa-check-circle"></i>
                            <span>24/7 Emergency Services Available</span>
                        </div>
                        <div class="feature-point">
                            <i class="fas fa-check-circle"></i>
                            <span>100% Quality Guaranteed Workmanship</span>
                        </div>
                    </div>
                    
                    
                    <div class="cta-row-pro">
                        <a href="<?php echo e(route('home.about')); ?>" class="btn-about-primary">
                            Discover More <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        <a href="tel:+923048902805" class="btn-about-call">
                            <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                        </a>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>


<?php $__env->startPush('styles'); ?>
<style>
    .about-section-pro {
        padding: 80px 0;
        background: #ffffff;
        position: relative;
    }
    .image-gallery-pro {
        position: relative;
        padding-bottom: 10px;
    }
    .main-image-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    .main-image-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(0,0,0,0.1);
    }
    .main-image {
        width: 100%;
        height: 420px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }
    .main-image-card:hover .main-image {
        transform: scale(1.03);
    }
    .floating-image-card {
        position: absolute;
        bottom: -25px;
        right: -25px;
        width: 180px;
        height: 135px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0,0,0,0.2);
        border: 4px solid #fff;
        z-index: 2;
    }
    .floating-image-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .experience-box-pro {
        position: absolute;
        bottom: 10px;
        left: -15px;
        background: linear-gradient(135deg, #0056b3, #003d80);
        border-radius: 10px;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 10px 30px rgba(0,86,179,0.35);
        z-index: 3;
    }
    .exp-icon-wrap {
        width: 42px;
        height: 42px;
        min-width: 42px;
        background: rgba(255,255,255,0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffc107;
        font-size: 18px;
    }
    .exp-info {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }
    .exp-number {
        font-size: 1.6rem;
        font-weight: 800;
        color: #fff;
    }
    .exp-number .counter-num {
        font-weight: 900;
    }
    .exp-subtitle {
        font-size: 0.72rem;
        color: rgba(255,255,255,0.8);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .content-wrapper-pro {
        padding-left: 10px;
    }
    .section-label-pro {
        display: inline-block;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 3px;
        color: #28a745;
        text-transform: uppercase;
        margin-bottom: 10px;
        position: relative;
        padding-left: 35px;
    }
    .section-label-pro::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 25px;
        height: 2px;
        background: #28a745;
    }
    .section-title-pro {
        font-size: 2.2rem;
        font-weight: 800;
        color: #0a1628;
        line-height: 1.3;
        margin-bottom: 15px;
    }
    .text-highlight {
        background: linear-gradient(135deg, #0056b3, #28a745);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .section-desc-pro {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.75;
        margin-bottom: 20px;
    }
    .stats-row-pro {
        display: flex;
        align-items: center;
        gap: 0;
        background: #f8f9fa;
        border-radius: 10px;
        padding: 18px 15px;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
    }
    .stat-item-pro {
        flex: 1;
        text-align: center;
    }
    .stat-number-pro {
        font-size: 1.8rem;
        font-weight: 800;
        color: #0a1628;
        line-height: 1;
    }
    .stat-suffix {
        font-size: 1rem;
        font-weight: 700;
        color: #28a745;
    }
    .stat-text-pro {
        display: block;
        font-size: 0.72rem;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        margin-top: 3px;
    }
    .stat-divider {
        width: 1px;
        height: 35px;
        background: #dee2e6;
    }
    .feature-points-pro {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 22px;
    }
    .feature-point {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
        color: #555;
        font-weight: 500;
    }
    .feature-point i {
        color: #28a745;
        font-size: 1.05rem;
        flex-shrink: 0;
    }
    .cta-row-pro {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .btn-about-primary {
        display: inline-flex;
        align-items: center;
        padding: 12px 28px;
        background: linear-gradient(135deg, #0056b3, #003d80);
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 18px rgba(0,86,179,0.25);
    }
    .btn-about-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,86,179,0.4);
        color: #fff;
    }
    .btn-about-call {
        display: inline-flex;
        align-items: center;
        padding: 12px 22px;
        background: #fff;
        color: #28a745;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.95rem;
        border: 2px solid #28a745;
        transition: all 0.3s ease;
    }
    .btn-about-call:hover {
        background: #28a745;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 18px rgba(40,167,69,0.25);
    }
    @media (max-width: 991.98px) {
        .about-section-pro { padding: 60px 0; }
        .content-wrapper-pro { padding-left: 0; padding-top: 20px; }
        .main-image { height: 380px; }
        .experience-box-pro { left: 0; }
    }
    @media (max-width: 767.98px) {
        .about-section-pro { padding: 45px 0; }
        .main-image { height: 320px; }
        .floating-image-card { width: 140px; height: 105px; right: -10px; bottom: -20px; }
        .cta-row-pro { flex-direction: column; }
        .btn-about-primary, .btn-about-call { width: 100%; justify-content: center; }
    }
</style>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('scripts'); ?>
<script>
    function animateCounters() {
        document.querySelectorAll('.counter').forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const speed = 120;
            const updateCount = () => {
                const count = +counter.innerText;
                const increment = target / speed;
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 15);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    }
    
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) { animateCounters(); obs.unobserve(entry.target); }
        });
    }, { threshold: 0.3 });
    
    document.querySelectorAll('.stats-row-pro').forEach(el => obs.observe(el));
</script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/website/partials/home/about-section.blade.php ENDPATH**/ ?>