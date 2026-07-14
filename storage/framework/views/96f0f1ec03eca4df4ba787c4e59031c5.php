<!-- ============================================
     PROFESSIONAL CALL TO ACTION SECTION
     ============================================ -->
<section class="cta-section-pro" id="callUsSection">
    
    <div class="cta-bg-shape cta-shape-1"></div>
    <div class="cta-bg-shape cta-shape-2"></div>
    <div class="cta-bg-shape cta-shape-3"></div>
    
    <div class="container position-relative z-2">
        <div class="cta-wrapper">
            <div class="row align-items-center g-4">
                
                
                <div class="col-lg-4 d-none d-lg-block" data-aos="fade-right">
                    <div class="cta-image-wrapper">
                        <?php
                            $ctaImg = asset('assets/images/plumber-man.png');
                            if (!empty($com)) {
                                if (!empty($com->ceo_image) && file_exists(public_path('slider_image/'.$com->ceo_image))) {
                                    $ctaImg = asset('slider_image/'.$com->ceo_image);
                                } elseif (!empty($com->oc_image3) && file_exists(public_path('slider_image/'.$com->oc_image3))) {
                                    $ctaImg = asset('slider_image/'.$com->oc_image3);
                                }
                            }
                        ?>
                        <img src="<?php echo e($ctaImg); ?>" 
                             alt="Contact Razzaq Engineering" 
                             class="cta-person-img"
                             loading="lazy">
                        
                        
                        <div class="cta-availability-badge">
                            <span class="pulse-dot"></span>
                            Available 24/7
                        </div>
                    </div>
                </div>
                
                
                <div class="col-lg-5" data-aos="fade-up">
                    <div class="cta-content">
                        <span class="cta-label">EMERGENCY SERVICE</span>
                        <h2 class="cta-heading">
                            Need Immediate <span class="text-highlight">Assistance?</span>
                        </h2>
                        <p class="cta-subtitle">
                            Our expert team is ready to help you 24 hours a day, 7 days a week. Call us now for:
                        </p>
                        
                        
                        <div class="cta-service-list">
                            <span class="cta-service-tag">
                                <i class="fas fa-circle"></i> RCC Core Cutting
                            </span>
                            <span class="cta-service-tag">
                                <i class="fas fa-circle"></i> Diamond Drilling
                            </span>
                            <span class="cta-service-tag">
                                <i class="fas fa-circle"></i> Wall Saw Cutting
                            </span>
                            <span class="cta-service-tag">
                                <i class="fas fa-circle"></i> Emergency Plumbing
                            </span>
                        </div>
                        
                        
                        <div class="cta-phone-wrapper">
                            <div class="cta-phone-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="cta-phone-info">
                                <span class="cta-phone-label">Call Us Now</span>
                                <a href="tel:+923048902805" class="cta-phone-number">+92 304 8902805</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-lg-3" data-aos="fade-left">
                    <div class="cta-action-buttons">
                        <a href="tel:+923048902805" class="btn-cta-call-pro">
                            <i class="fas fa-phone-alt"></i>
                            <span>Call Now</span>
                            <small>Free Consultation</small>
                        </a>
                        
                        <div class="cta-divider">
                            <span>OR</span>
                        </div>
                        
                        <a href="<?php echo e(route('quote.index')); ?>" class="btn-cta-quote-pro">
                            <i class="fas fa-file-invoice"></i>
                            <span>Get Quote</span>
                            <small>Response in 24hrs</small>
                        </a>
                        
                        <a href="https://wa.me/923048902805" target="_blank" class="btn-cta-whatsapp-pro">
                            <i class="fab fa-whatsapp"></i>
                            <span>WhatsApp</span>
                            <small>Quick Chat</small>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>


<?php $__env->startPush('styles'); ?>
<style>
    /* ============================================
       PROFESSIONAL CTA / CALL US SECTION
       ============================================ */
    .cta-section-pro {
        padding: 0 0 80px 0;
        position: relative;
        overflow: hidden;
    }
    
    /* Background Shapes */
    .cta-bg-shape {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }
    
    .cta-shape-1 {
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(40,167,69,0.04) 0%, transparent 70%);
        top: -100px;
        right: -100px;
    }
    
    .cta-shape-2 {
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(0,86,179,0.04) 0%, transparent 70%);
        bottom: -50px;
        left: -80px;
    }
    
    .cta-shape-3 {
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(40,167,69,0.03) 0%, transparent 70%);
        top: 50%;
        left: 40%;
    }
    
    /* Main Wrapper */
    .cta-wrapper {
        background: linear-gradient(135deg, #0056b3 0%, #003d80 100%);
        border-radius: 24px;
        padding: 50px 40px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,86,179,0.3);
    }
    
    .cta-wrapper::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
        pointer-events: none;
    }
    
    .cta-wrapper::after {
        content: '';
        position: absolute;
        bottom: -20%;
        left: -5%;
        width: 250px;
        height: 250px;
        background: rgba(255,255,255,0.02);
        border-radius: 50%;
        pointer-events: none;
    }
    
    /* ============================================
       IMAGE SECTION
       ============================================ */
    .cta-image-wrapper {
        position: relative;
        text-align: center;
    }
    
    .cta-person-img {
        max-width: 280px;
        height: auto;
        position: relative;
        z-index: 1;
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));
    }
    
    /* Availability Badge */
    .cta-availability-badge {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0,0,0,0.6);
        color: #fff;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        z-index: 2;
        white-space: nowrap;
    }
    
    .pulse-dot {
        width: 10px;
        height: 10px;
        background: #28a745;
        border-radius: 50%;
        display: inline-block;
        animation: pulseGreen 1.5s infinite;
    }
    
    @keyframes pulseGreen {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.3); }
    }
    
    /* ============================================
       CONTENT SECTION
       ============================================ */
    .cta-content {
        color: #fff;
    }
    
    .cta-label {
        display: inline-block;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 3px;
        background: rgba(255,255,255,0.12);
        padding: 5px 14px;
        border-radius: 50px;
        margin-bottom: 12px;
        text-transform: uppercase;
    }
    
    .cta-heading {
        font-size: 2rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 12px;
        line-height: 1.25;
    }
    
    .text-highlight {
        background: linear-gradient(135deg, #48c964, #28a745);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .cta-subtitle {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.75);
        margin-bottom: 15px;
        line-height: 1.6;
    }
    
    /* Service Tags */
    .cta-service-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
    }
    
    .cta-service-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        color: rgba(255,255,255,0.85);
        background: rgba(255,255,255,0.08);
        padding: 5px 12px;
        border-radius: 50px;
        font-weight: 500;
    }
    
    .cta-service-tag i {
        font-size: 0.35rem;
        color: #48c964;
    }
    
    /* Phone Display */
    .cta-phone-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
        background: rgba(255,255,255,0.1);
        border-radius: 16px;
        padding: 18px 22px;
        border: 1px solid rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
    }
    
    .cta-phone-icon {
        width: 55px;
        height: 55px;
        min-width: 55px;
        background: #28a745;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #fff;
        box-shadow: 0 8px 25px rgba(40,167,69,0.4);
        animation: phonePulse 2s infinite;
    }
    
    @keyframes phonePulse {
        0% { box-shadow: 0 0 0 0 rgba(40,167,69,0.6); }
        70% { box-shadow: 0 0 0 15px rgba(40,167,69,0); }
        100% { box-shadow: 0 0 0 0 rgba(40,167,69,0); }
    }
    
    .cta-phone-info {
        display: flex;
        flex-direction: column;
    }
    
    .cta-phone-label {
        font-size: 0.72rem;
        color: rgba(255,255,255,0.65);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 600;
    }
    
    .cta-phone-number {
        font-size: 1.5rem;
        font-weight: 800;
        color: #fff;
        text-decoration: none;
        letter-spacing: 1px;
        transition: color 0.3s ease;
    }
    
    .cta-phone-number:hover {
        color: #48c964;
    }
    
    /* ============================================
       ACTION BUTTONS
       ============================================ */
    .cta-action-buttons {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .btn-cta-call-pro,
    .btn-cta-quote-pro,
    .btn-cta-whatsapp-pro {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 16px 20px;
        border-radius: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        text-align: center;
    }
    
    .btn-cta-call-pro {
        background: #28a745;
        color: #fff;
        box-shadow: 0 8px 25px rgba(40,167,69,0.35);
    }
    
    .btn-cta-call-pro:hover {
        background: #1e7e34;
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(40,167,69,0.5);
        color: #fff;
    }
    
    .btn-cta-quote-pro {
        background: rgba(255,255,255,0.12);
        color: #fff;
        border: 2px solid rgba(255,255,255,0.25);
    }
    
    .btn-cta-quote-pro:hover {
        background: rgba(255,255,255,0.2);
        border-color: rgba(255,255,255,0.5);
        transform: translateY(-3px);
        color: #fff;
    }
    
    .btn-cta-whatsapp-pro {
        background: #25D366;
        color: #fff;
        box-shadow: 0 8px 25px rgba(37,211,102,0.35);
    }
    
    .btn-cta-whatsapp-pro:hover {
        background: #1ea952;
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(37,211,102,0.5);
        color: #fff;
    }
    
    .btn-cta-call-pro i,
    .btn-cta-quote-pro i,
    .btn-cta-whatsapp-pro i {
        font-size: 22px;
        margin-bottom: 4px;
    }
    
    .btn-cta-call-pro span,
    .btn-cta-quote-pro span,
    .btn-cta-whatsapp-pro span {
        font-weight: 700;
        font-size: 0.9rem;
    }
    
    .btn-cta-call-pro small,
    .btn-cta-quote-pro small,
    .btn-cta-whatsapp-pro small {
        font-size: 0.7rem;
        opacity: 0.8;
        margin-top: 2px;
    }
    
    /* Divider */
    .cta-divider {
        display: flex;
        align-items: center;
        gap: 10px;
        color: rgba(255,255,255,0.5);
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    
    .cta-divider::before,
    .cta-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: rgba(255,255,255,0.2);
    }
    
    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 1199.98px) {
        .cta-wrapper { padding: 40px 30px; }
        .cta-heading { font-size: 1.8rem; }
        .cta-person-img { max-width: 240px; }
    }
    
    @media (max-width: 991.98px) {
        .cta-section-pro { padding: 0 0 60px 0; }
        .cta-wrapper { padding: 35px 25px; text-align: center; }
        .cta-phone-wrapper { justify-content: center; }
        .cta-service-list { justify-content: center; }
        .cta-action-buttons { flex-direction: row; flex-wrap: wrap; }
        .btn-cta-call-pro,
        .btn-cta-quote-pro,
        .btn-cta-whatsapp-pro { flex: 1; min-width: 120px; }
        .cta-divider { display: none; }
    }
    
    @media (max-width: 767.98px) {
        .cta-section-pro { padding: 0 0 45px 0; }
        .cta-wrapper { padding: 30px 20px; border-radius: 20px; }
        .cta-heading { font-size: 1.5rem; }
        .cta-subtitle { font-size: 0.85rem; }
        .cta-phone-number { font-size: 1.3rem; }
        .cta-phone-icon { width: 45px; height: 45px; min-width: 45px; font-size: 18px; }
        .cta-phone-wrapper { padding: 14px 18px; }
        .btn-cta-call-pro,
        .btn-cta-quote-pro,
        .btn-cta-whatsapp-pro { padding: 14px 12px; border-radius: 10px; }
        .btn-cta-call-pro i,
        .btn-cta-quote-pro i,
        .btn-cta-whatsapp-pro i { font-size: 18px; }
        .btn-cta-call-pro span,
        .btn-cta-quote-pro span,
        .btn-cta-whatsapp-pro span { font-size: 0.8rem; }
    }
    
    @media (max-width: 575.98px) {
        .cta-section-pro { padding: 0 0 35px 0; }
        .cta-wrapper { padding: 25px 15px; border-radius: 16px; }
        .cta-heading { font-size: 1.3rem; }
        .cta-label { font-size: 0.6rem; letter-spacing: 2px; padding: 4px 10px; }
        .cta-subtitle { font-size: 0.8rem; }
        .cta-service-tag { font-size: 0.68rem; padding: 4px 10px; }
        .cta-phone-number { font-size: 1.15rem; }
        .cta-phone-icon { width: 40px; height: 40px; min-width: 40px; font-size: 16px; }
        .cta-phone-wrapper { padding: 12px 15px; border-radius: 12px; gap: 10px; }
        .btn-cta-call-pro,
        .btn-cta-quote-pro,
        .btn-cta-whatsapp-pro { padding: 12px 8px; border-radius: 8px; min-width: 90px; }
        .btn-cta-call-pro i,
        .btn-cta-quote-pro i,
        .btn-cta-whatsapp-pro i { font-size: 16px; }
        .btn-cta-call-pro span,
        .btn-cta-quote-pro span,
        .btn-cta-whatsapp-pro span { font-size: 0.72rem; }
        .btn-cta-call-pro small,
        .btn-cta-quote-pro small,
        .btn-cta-whatsapp-pro small { font-size: 0.62rem; }
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/website/partials/home/call-us-section.blade.php ENDPATH**/ ?>