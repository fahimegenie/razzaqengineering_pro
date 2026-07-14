<!-- ============================================
     PROFESSIONAL WHY CHOOSE US SECTION
     ============================================ -->
<section class="why-choose-pro" id="whyChooseSection">
    <div class="container">
        
        
        <div class="row mb-5">
            <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
                <span class="section-label-pro">WHY WE'RE THE BEST</span>
                <h2 class="section-title-pro">Why Clients <span class="text-highlight">Choose Us</span></h2>
                <p class="section-subtitle-pro">We deliver quality engineering solutions with professional excellence across Pakistan</p>
                <div class="section-divider"></div>
            </div>
        </div>
        
        
        <div class="row g-4">
            
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card-pro">
                    <div class="feature-icon-wrapper">
                        <div class="feature-icon-circle">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="feature-number">01</div>
                    </div>
                    <div class="feature-content">
                        <h4 class="feature-title">No Extra Charges</h4>
                        <p class="feature-text">Transparent pricing with no hidden fees. You only pay for what you need.</p>
                    </div>
                    <div class="feature-hover-line"></div>
                </div>
            </div>
            
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card-pro">
                    <div class="feature-icon-wrapper">
                        <div class="feature-icon-circle">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="feature-number">02</div>
                    </div>
                    <div class="feature-content">
                        <h4 class="feature-title">24/7 Emergency Service</h4>
                        <p class="feature-text">Available anytime, anywhere. Our team responds within minutes for urgent needs.</p>
                    </div>
                    <div class="feature-hover-line"></div>
                </div>
            </div>
            
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card-pro">
                    <div class="feature-icon-wrapper">
                        <div class="feature-icon-circle">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="feature-number">03</div>
                    </div>
                    <div class="feature-content">
                        <h4 class="feature-title">Licensed & Certified</h4>
                        <p class="feature-text">Fully registered company with all legal documents and professional certifications.</p>
                    </div>
                    <div class="feature-hover-line"></div>
                </div>
            </div>
            
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-card-pro">
                    <div class="feature-icon-wrapper">
                        <div class="feature-icon-circle">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="feature-number">04</div>
                    </div>
                    <div class="feature-content">
                        <h4 class="feature-title">Special Offers</h4>
                        <p class="feature-text">Exclusive deals and competitive packages tailored for our valued clients.</p>
                    </div>
                    <div class="feature-hover-line"></div>
                </div>
            </div>
            
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-card-pro">
                    <div class="feature-icon-wrapper">
                        <div class="feature-icon-circle">
                            <i class="fas fa-smile"></i>
                        </div>
                        <div class="feature-number">05</div>
                    </div>
                    <div class="feature-content">
                        <h4 class="feature-title">100% Satisfaction</h4>
                        <p class="feature-text">Customer satisfaction is our top priority. We ensure quality on every project.</p>
                    </div>
                    <div class="feature-hover-line"></div>
                </div>
            </div>
            
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="feature-card-pro">
                    <div class="feature-icon-wrapper">
                        <div class="feature-icon-circle">
                            <i class="fas fa-truck-fast"></i>
                        </div>
                        <div class="feature-number">06</div>
                    </div>
                    <div class="feature-content">
                        <h4 class="feature-title">On-Time Delivery</h4>
                        <p class="feature-text">We deliver projects on schedule, anywhere across Pakistan, without compromise.</p>
                    </div>
                    <div class="feature-hover-line"></div>
                </div>
            </div>
            
        </div>
        
        
        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="700">
            <div class="cta-box-pro">
                <div class="row align-items-center">
                    <div class="col-lg-7 text-lg-start mb-3 mb-lg-0">
                        <h4 class="cta-title">Ready to experience our professional services?</h4>
                        <p class="cta-text">Join 300+ satisfied clients across Pakistan. Get your free quote today!</p>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <div class="d-flex flex-wrap gap-3 justify-content-lg-end justify-content-center">
                            <a href="tel:+923048902805" class="btn-cta-call">
                                <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                            </a>
                            <a href="<?php echo e(route('quote.index')); ?>" class="btn-cta-pro">
                                Get Free Quote <i class="fas fa-arrow-right ms-2"></i>
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
       WHY CHOOSE US - PROFESSIONAL DESIGN
       ============================================ */
    .why-choose-pro {
        padding: 80px 0;
        background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
        position: relative;
        overflow: hidden;
    }
    
    /* Subtle background pattern */
    .why-choose-pro::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(40,167,69,0.03) 0%, transparent 70%);
        pointer-events: none;
    }
    
    /* Section Header */
    .section-label-pro {
        display: inline-block;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 3px;
        color: #28a745;
        text-transform: uppercase;
        margin-bottom: 8px;
        padding-left: 35px;
        position: relative;
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
        margin-bottom: 10px;
    }
    .text-highlight {
        background: linear-gradient(135deg, #0056b3, #28a745);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .section-subtitle-pro {
        color: #888;
        font-size: 0.95rem;
        max-width: 500px;
        margin: 0 auto 15px;
    }
    .section-divider {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #28a745, #0056b3);
        margin: 0 auto;
        border-radius: 2px;
    }
    
    /* ============================================
       FEATURE CARDS
       ============================================ */
    .feature-card-pro {
        background: #fff;
        border-radius: 16px;
        padding: 30px 25px;
        position: relative;
        overflow: hidden;
        border: 1px solid #eef0f2;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        z-index: 1;
    }
    
    .feature-card-pro::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(40,167,69,0.03), rgba(0,86,179,0.03));
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: -1;
    }
    
    .feature-card-pro:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        border-color: #28a745;
    }
    
    .feature-card-pro:hover::before {
        opacity: 1;
    }
    
    /* Icon Wrapper */
    .feature-icon-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    
    .feature-icon-circle {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, rgba(40,167,69,0.08), rgba(0,86,179,0.08));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #28a745;
        transition: all 0.4s ease;
    }
    
    .feature-card-pro:hover .feature-icon-circle {
        background: linear-gradient(135deg, #0056b3, #28a745);
        color: #fff;
        border-radius: 50%;
        transform: rotate(360deg);
        box-shadow: 0 8px 25px rgba(40,167,69,0.3);
    }
    
    .feature-number {
        font-size: 3rem;
        font-weight: 900;
        color: rgba(40,167,69,0.06);
        line-height: 1;
        transition: all 0.4s ease;
    }
    
    .feature-card-pro:hover .feature-number {
        color: rgba(40,167,69,0.12);
        transform: scale(1.1);
    }
    
    /* Content */
    .feature-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #0a1628;
        margin-bottom: 8px;
        transition: color 0.3s ease;
    }
    
    .feature-card-pro:hover .feature-title {
        color: #0056b3;
    }
    
    .feature-text {
        font-size: 0.9rem;
        color: #777;
        line-height: 1.6;
        margin: 0;
    }
    
    /* Hover Line */
    .feature-hover-line {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, #0056b3, #28a745);
        transition: width 0.4s ease;
        border-radius: 2px;
    }
    
    .feature-card-pro:hover .feature-hover-line {
        width: 80%;
    }
    
    /* ============================================
       BOTTOM CTA BOX
       ============================================ */
    .cta-box-pro {
        background: linear-gradient(135deg, #0056b3, #003d80);
        border-radius: 20px;
        padding: 35px 40px;
        box-shadow: 0 15px 40px rgba(0,86,179,0.25);
    }
    
    .cta-title {
        color: #fff;
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 5px;
    }
    
    .cta-text {
        color: rgba(255,255,255,0.75);
        margin: 0;
        font-size: 0.95rem;
    }
    
    .btn-cta-pro {
        display: inline-flex;
        align-items: center;
        padding: 14px 32px;
        background: #fff;
        color: #0056b3;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    
    .btn-cta-pro:hover {
        background: #28a745;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(40,167,69,0.4);
    }
    
    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 1199.98px) {
        .section-title-pro { font-size: 2rem; }
        .feature-card-pro { padding: 25px 20px; }
    }
    
    @media (max-width: 991.98px) {
        .why-choose-pro { padding: 60px 0; }
        .section-title-pro { font-size: 1.8rem; }
        .cta-box-pro { padding: 25px 30px; text-align: center; }
        .cta-title { font-size: 1.15rem; }
    }
    
    @media (max-width: 767.98px) {
        .why-choose-pro { padding: 45px 0; }
        .section-title-pro { font-size: 1.6rem; }
        .section-label-pro { font-size: 0.65rem; letter-spacing: 2px; padding-left: 28px; }
        .section-label-pro::before { width: 20px; }
        .feature-card-pro { padding: 22px 18px; border-radius: 12px; }
        .feature-icon-circle { width: 50px; height: 50px; font-size: 20px; border-radius: 12px; }
        .feature-number { font-size: 2.5rem; }
        .feature-title { font-size: 1.05rem; }
        .cta-box-pro { padding: 20px; }
        .cta-title { font-size: 1.05rem; }
        .btn-cta-pro { width: 100%; justify-content: center; }
    }
    
    @media (max-width: 575.98px) {
        .why-choose-pro { padding: 35px 0; }
        .section-title-pro { font-size: 1.35rem; }
        .feature-card-pro { padding: 18px 15px; }
        .feature-icon-circle { width: 42px; height: 42px; font-size: 18px; border-radius: 10px; }
        .feature-number { font-size: 2rem; }
        .feature-title { font-size: 0.95rem; }
        .feature-text { font-size: 0.82rem; }
        .feature-icon-wrapper { margin-bottom: 12px; }
        .cta-title { font-size: 0.95rem; }
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/website/partials/home/why-choose-us.blade.php ENDPATH**/ ?>