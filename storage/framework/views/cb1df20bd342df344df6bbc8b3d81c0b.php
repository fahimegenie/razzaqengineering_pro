<!-- ============================================
     PROFESSIONAL DIRECTOR MESSAGE SECTION
     Design Preserved - Content from Database
     ============================================ -->
<section class="director-message-pro" id="directorMessage">
    <div class="container">
        <div class="director-wrapper">
            
            
            <div class="director-bg-pattern"></div>
            <div class="director-dots"></div>
            
            <div class="row g-0 align-items-center">
                
                
                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-right" data-aos-duration="1200">
                    <div class="director-image-wrapper">
                        <div class="director-image-frame">
                            <?php
                                // Dynamic image with fallback
                                $directorImg = asset('assets/images/plumber-man.png');
                                if (!empty($com)) {
                                    if (!empty($com->ceo_image) && file_exists(public_path('slider_image/'.$com->ceo_image))) {
                                        $directorImg = asset('slider_image/'.$com->ceo_image);
                                    } elseif (!empty($com->oc_image3) && file_exists(public_path('slider_image/'.$com->oc_image3))) {
                                        $directorImg = asset('slider_image/'.$com->oc_image3);
                                    }
                                }
                            ?>
                            <img src="<?php echo e(asset('assets/images/pexels-rezwan-1216589.jpg')); ?>" 
                                 alt="Director - Razzaq Engineering Services" 
                                 class="director-image"
                                 loading="lazy">
                        </div>
                        
                        
                        <div class="director-exp-badge">
                            <span class="exp-years">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($com) && !empty($com->established_year)): ?>
                                    <?php echo e(max(0, now()->year - $com->established_year)); ?>+
                                <?php else: ?>
                                    24+
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span>
                            <span class="exp-text">Years of<br>Excellence</span>
                        </div>
                        
                        
                        <div class="director-name-plate">
                            <h5 class="director-name">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($com) && !empty($com->ceo_name)): ?>
                                    <?php echo e($com->ceo_name); ?>

                                <?php else: ?>
                                    Mr. Muhammad Razzaq
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </h5>
                            <span class="director-role">Founder & CEO</span>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-lg-7" data-aos="fade-left" data-aos-duration="1200">
                    <div class="director-content-wrapper">
                        
                        
                        <span class="director-label">A MESSAGE FROM</span>
                        
                        
                        <h2 class="director-title">
                            Our <span class="text-highlight">Director's</span> Vision
                        </h2>
                        
                        
                        <div class="director-quote-icon">
                            <svg width="60" height="45" viewBox="0 0 60 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 45V25L15 0H27L15 25H27V45H0ZM33 45V25L48 0H60L48 25H60V45H33Z" fill="currentColor" opacity="0.15"/>
                            </svg>
                        </div>
                        
                        
                        <blockquote class="director-message">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($com) && !empty($com->ceo_message)): ?>
                                <p><?php echo e($com->ceo_message); ?></p>
                            <?php else: ?>
                                <p>
                                    As the Director of <strong>Razzaq Engineering Services</strong>, my commitment is to ensure the ultimate level of customer satisfaction by providing unrivaled leadership in the Pakistan engineering and construction industry. We offer our clients total peace of mind through specialized services—from precision <strong>RCC core cutting</strong> and vibration-free <strong>wall sawing</strong> to professional <strong>plumbing</strong> and <strong>firefighting</strong> solutions.
                                </p>
                                <p>
                                    Our mission is built on quality customer service and a dedication to empowering a motivated team. By recognizing the value of every employee's contribution, we ensure that Razzaq Engineering delivers the highest standard of workmanship and technical expertise on every project, nationwide.
                                </p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </blockquote>
                        
                        
                        <div class="director-footer">
                            <div class="director-signature">
                                <?php
                                    $signImg = asset('assets/images/sign.png');
                                    if (!empty($com) && !empty($com->oc_image4) && file_exists(public_path('slider_image/'.$com->oc_image4))) {
                                        $signImg = asset('slider_image/'.$com->oc_image4);
                                    }
                                ?>
                                <!-- <img src="<?php echo e($signImg); ?>" 
                                     alt="Director Signature" 
                                     class="signature-img"
                                     loading="lazy"> -->
                            </div>
                            <div class="director-info-mobile d-lg-none">
                                <h5 class="director-name-mobile">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($com) && !empty($com->ceo_name)): ?>
                                        <?php echo e($com->ceo_name); ?>

                                    <?php else: ?>
                                        Mr. Muhammad Razzaq
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </h5>
                                <span class="director-role-mobile">Founder & CEO</span>
                            </div>
                        </div>
                        
                        
                        <div class="director-cta">
                            <a href="<?php echo e(route('home.about')); ?>" class="btn-director-about">
                                <i class="fas fa-building me-2"></i> About Our Company
                            </a>
                            <a href="<?php echo e(route('quote.index')); ?>" class="btn-director-quote">
                                <i class="fas fa-handshake me-2"></i> Work With Us
                            </a>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>


<?php $__env->startPush('styles'); ?>
<style>
    /* ============================================
       DIRECTOR MESSAGE - PROFESSIONAL DESIGN
       (Same CSS - No Changes)
       ============================================ */
    .director-message-pro {
        padding: 80px 0;
        background: #f8f9fa;
        position: relative;
        overflow: hidden;
    }
    
    .director-wrapper {
        background: #ffffff;
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 20px 60px rgba(0,0,0,0.08);
        border: 1px solid #eef0f2;
    }
    
    .director-bg-pattern {
        position: absolute;
        top: -100px;
        right: -100px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(40,167,69,0.04) 0%, transparent 70%);
        pointer-events: none;
    }
    
    .director-dots {
        position: absolute;
        bottom: 30px;
        left: 30px;
        width: 120px;
        height: 120px;
        background-image: radial-gradient(circle, rgba(40,167,69,0.15) 2px, transparent 2px);
        background-size: 20px 20px;
        pointer-events: none;
    }
    
    .director-image-wrapper {
        position: relative;
        padding: 40px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(180deg, rgba(0,86,179,0.03) 0%, rgba(40,167,69,0.05) 100%);
        min-height: 500px;
    }
    
    .director-image-frame {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        border: 5px solid #fff;
    }
    
    .director-image {
        width: 100%;
        max-width: 350px;
        height: auto;
        display: block;
        object-fit: cover;
    }
    
    .director-exp-badge {
        position: absolute;
        top: 50px;
        right: 20px;
        background: linear-gradient(135deg, #0056b3, #003d80);
        color: #fff;
        border-radius: 16px;
        padding: 15px 20px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,86,179,0.35);
        z-index: 2;
    }
    
    .exp-years {
        display: block;
        font-size: 2rem;
        font-weight: 900;
        line-height: 1;
    }
    
    .exp-text {
        display: block;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        opacity: 0.85;
        margin-top: 3px;
        line-height: 1.3;
    }
    
    .director-name-plate {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        background: #fff;
        border-radius: 12px;
        padding: 12px 25px;
        text-align: center;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        z-index: 2;
        white-space: nowrap;
    }
    
    .director-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0a1628;
        margin: 0;
    }
    
    .director-role {
        font-size: 0.78rem;
        color: #28a745;
        font-weight: 600;
    }
    
    .director-content-wrapper {
        padding: 50px 50px 50px 20px;
        position: relative;
    }
    
    .director-label {
        display: inline-block;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 3px;
        color: #28a745;
        text-transform: uppercase;
        margin-bottom: 8px;
        padding-left: 30px;
        position: relative;
    }
    
    .director-label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 2px;
        background: #28a745;
    }
    
    .director-title {
        font-size: 2rem;
        font-weight: 800;
        color: #0a1628;
        margin-bottom: 25px;
        line-height: 1.25;
    }
    
    .text-highlight {
        background: linear-gradient(135deg, #0056b3, #28a745);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .director-quote-icon {
        color: #28a745;
        margin-bottom: 20px;
    }
    
    .director-message {
        border-left: none;
        padding: 0;
        margin: 0 0 25px 0;
    }
    
    .director-message p {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.85;
        margin-bottom: 15px;
    }
    
    .director-message p:last-child {
        margin-bottom: 0;
    }
    
    .director-footer {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid #eef0f2;
    }
    
    .signature-img {
        height: 50px;
        opacity: 0.8;
    }
    
    .director-name-mobile {
        font-size: 1rem;
        font-weight: 700;
        color: #0a1628;
        margin: 0;
    }
    
    .director-role-mobile {
        font-size: 0.78rem;
        color: #28a745;
        font-weight: 600;
    }
    
    .director-cta {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .btn-director-about {
        display: inline-flex;
        align-items: center;
        padding: 12px 26px;
        background: linear-gradient(135deg, #0056b3, #003d80);
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .btn-director-about:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,86,179,0.3);
        color: #fff;
    }
    
    .btn-director-quote {
        display: inline-flex;
        align-items: center;
        padding: 12px 26px;
        background: #fff;
        color: #28a745;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        border: 2px solid #28a745;
        transition: all 0.3s ease;
    }
    
    .btn-director-quote:hover {
        background: #28a745;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40,167,69,0.25);
    }
    
    /* Responsive - Same as original */
    @media (max-width: 1199.98px) {
        .director-content-wrapper { padding: 40px 40px 40px 15px; }
        .director-title { font-size: 1.8rem; }
        .director-exp-badge { top: 30px; right: 10px; padding: 12px 16px; }
        .exp-years { font-size: 1.6rem; }
    }
    
    @media (max-width: 991.98px) {
        .director-message-pro { padding: 60px 0; }
        .director-wrapper { border-radius: 20px; }
        .director-image-wrapper { min-height: auto; padding: 40px 30px 0; background: transparent; }
        .director-image { max-width: 250px; }
        .director-exp-badge { top: 20px; right: 20px; }
        .director-name-plate { position: relative; bottom: auto; left: auto; transform: none; margin-top: -20px; }
        .director-content-wrapper { padding: 30px; text-align: center; }
        .director-label { padding-left: 30px; }
        .director-label::before { left: 0; }
        .director-footer { justify-content: center; }
        .director-cta { justify-content: center; }
        .director-message p { text-align: left; }
    }
    
    @media (max-width: 767.98px) {
        .director-message-pro { padding: 45px 0; }
        .director-title { font-size: 1.5rem; }
        .director-image-wrapper { padding: 30px 20px 0; }
        .director-image { max-width: 200px; }
        .director-exp-badge { padding: 10px 14px; border-radius: 12px; top: 15px; right: 10px; }
        .exp-years { font-size: 1.3rem; }
        .exp-text { font-size: 0.62rem; }
        .director-content-wrapper { padding: 20px; }
        .director-message p { font-size: 0.88rem; }
        .btn-director-about, .btn-director-quote { width: 100%; justify-content: center; }
        .director-quote-icon svg { width: 40px; height: 30px; }
    }
    
    @media (max-width: 575.98px) {
        .director-message-pro { padding: 35px 0; }
        .director-title { font-size: 1.3rem; }
        .director-image-wrapper { padding: 20px 15px 0; }
        .director-image { max-width: 170px; border-radius: 12px; }
        .director-image-frame { border-radius: 14px; border-width: 3px; }
        .director-exp-badge { padding: 8px 10px; border-radius: 10px; top: 10px; right: 5px; }
        .exp-years { font-size: 1.1rem; }
        .exp-text { font-size: 0.58rem; letter-spacing: 1px; }
        .director-name-plate { padding: 8px 15px; border-radius: 8px; margin-top: -15px; }
        .director-name { font-size: 0.9rem; }
        .director-role { font-size: 0.7rem; }
        .director-label { font-size: 0.62rem; letter-spacing: 2px; padding-left: 25px; }
        .director-label::before { width: 15px; }
        .director-message p { font-size: 0.82rem; line-height: 1.6; }
        .signature-img { height: 35px; }
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/website/partials/home/director-message-section.blade.php ENDPATH**/ ?>