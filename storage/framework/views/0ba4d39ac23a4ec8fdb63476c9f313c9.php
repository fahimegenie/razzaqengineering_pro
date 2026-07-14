<!-- ============================================
     PROFESSIONAL CORE VALUES SECTION
     ============================================ -->
<section class="values-section-pro" id="valuesSection">
    <div class="container">
        
        
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="section-tag">WHY CHOOSE US</span>
            <h2 class="section-heading">Our Core <span class="text-gradient">Values</span></h2>
            <p class="section-desc">The principles that drive our engineering excellence across Pakistan</p>
            <div class="section-divider"></div>
        </div>
        
        
        <div class="values-grid">
            
            
            <div class="value-card value-card-large value-safety" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card-bg"></div>
                <div class="value-card-content">
                    <div class="value-icon-wrap">
                        <div class="value-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                    </div>
                    <div class="value-text">
                        <h3 class="value-title">Safety First</h3>
                        <p class="value-desc">Our rigorous safety protocols ensure zero-accident sites and complete structural protection for your assets.</p>
                    </div>
                </div>
                <div class="value-card-number">01</div>
            </div>
            
            
            <div class="value-card value-card-medium value-quality" data-aos="fade-up" data-aos-delay="200">
                <div class="value-card-bg"></div>
                <div class="value-card-content">
                    <div class="value-icon-wrap">
                        <div class="value-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                    </div>
                    <div class="value-text">
                        <h3 class="value-title">Quality</h3>
                        <p class="value-desc">Uncompromising standards in every cut, core drilled, and project delivered.</p>
                    </div>
                </div>
                <div class="value-card-number">02</div>
            </div>
            
            
            <div class="value-card value-card-medium value-integrity" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card-bg"></div>
                <div class="value-card-content">
                    <div class="value-icon-wrap">
                        <div class="value-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                    </div>
                    <div class="value-text">
                        <h3 class="value-title">Integrity</h3>
                        <p class="value-desc">Transparent pricing, honest engineering advice, and ethical business practices.</p>
                    </div>
                </div>
                <div class="value-card-number">03</div>
            </div>
            
            
            <div class="value-card value-card-full value-innovation" data-aos="fade-up" data-aos-delay="400">
                <div class="innovation-content">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center gap-4 mb-3 mb-lg-0">
                                <div class="innovation-icon-wrap">
                                    <i class="fas fa-rocket"></i>
                                </div>
                                <div>
                                    <h3 class="value-title text-white mb-2">Innovation</h3>
                                    <p class="value-desc text-white opacity-90 mb-0">
                                        Continually investing in robotic demolition and advanced wire sawing technologies to solve the unsolvable.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="<?php echo e(route('quote.index')); ?>" class="btn-innovation">
                                <i class="fas fa-arrow-right me-2"></i> Work With Us
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
       CORE VALUES SECTION
       ============================================ */
    .values-section-pro {
        padding: 80px 0;
        background: #f8f9fa;
        position: relative;
    }
    
    .section-tag {
        display: inline-block;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 3px;
        color: #28a745;
        text-transform: uppercase;
        margin-bottom: 8px;
    }
    .section-heading {
        font-size: 2.2rem;
        font-weight: 800;
        color: #0a1628;
        margin-bottom: 6px;
    }
    .text-gradient {
        background: linear-gradient(135deg, #0056b3, #28a745);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .section-desc {
        color: #888;
        font-size: 0.95rem;
        margin-bottom: 12px;
    }
    .section-divider {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #28a745, #0056b3);
        margin: 0 auto;
        border-radius: 2px;
    }
    
    /* ============================================
       VALUES GRID
       ============================================ */
    .values-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
    }
    
    /* ============================================
       VALUE CARD BASE
       ============================================ */
    .value-card {
        position: relative;
        border-radius: 20px;
        padding: 35px 30px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .value-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
    }
    
    .value-card-bg {
        position: absolute;
        inset: 0;
        pointer-events: none;
    }
    
    .value-card-number {
        position: absolute;
        bottom: 10px;
        right: 20px;
        font-size: 4rem;
        font-weight: 900;
        opacity: 0.06;
        line-height: 1;
        pointer-events: none;
    }
    
    .value-card-content {
        position: relative;
        z-index: 1;
    }
    
    .value-icon-wrap {
        margin-bottom: 20px;
    }
    
    .value-icon {
        width: 65px;
        height: 65px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        transition: all 0.4s ease;
    }
    
    .value-card:hover .value-icon {
        border-radius: 50%;
        transform: scale(1.05);
    }
    
    .value-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 10px;
        line-height: 1.2;
    }
    
    .value-desc {
        font-size: 0.9rem;
        line-height: 1.7;
        margin: 0;
    }
    
    /* ============================================
       SAFETY - LARGE CARD (Spans 2 columns)
       ============================================ */
    .value-card-large {
        grid-column: span 2;
    }
    
    .value-safety {
        background: linear-gradient(135deg, #e8f5e9 0%, #e3f2fd 100%);
        border: 1px solid rgba(40,167,69,0.15);
    }
    
    .value-safety .value-icon {
        background: linear-gradient(135deg, #28a745, #0056b3);
        color: #fff;
        box-shadow: 0 8px 25px rgba(40,167,69,0.3);
    }
    
    .value-safety .value-title {
        color: #0056b3;
    }
    
    .value-safety .value-desc {
        color: #555;
    }
    
    /* ============================================
       QUALITY - MEDIUM CARD
       ============================================ */
    .value-quality {
        background: #fff;
        border: 1px solid #eef0f2;
    }
    
    .value-quality .value-icon {
        background: linear-gradient(135deg, rgba(40,167,69,0.1), rgba(0,86,179,0.1));
        color: #28a745;
    }
    
    .value-quality:hover .value-icon {
        background: linear-gradient(135deg, #28a745, #0056b3);
        color: #fff;
        box-shadow: 0 8px 25px rgba(40,167,69,0.3);
    }
    
    .value-quality .value-title {
        color: #0a1628;
    }
    
    .value-quality .value-desc {
        color: #888;
    }
    
    /* ============================================
       INTEGRITY - MEDIUM CARD
       ============================================ */
    .value-integrity {
        background: linear-gradient(135deg, #003d80, #0056b3);
        border: 1px solid rgba(255,255,255,0.1);
    }
    
    .value-integrity .value-icon {
        background: rgba(255,255,255,0.15);
        color: #fff;
    }
    
    .value-integrity:hover .value-icon {
        background: #28a745;
        color: #fff;
    }
    
    .value-integrity .value-title {
        color: #fff;
    }
    
    .value-integrity .value-desc {
        color: rgba(255,255,255,0.8);
    }
    
    .value-integrity .value-card-number {
        color: rgba(255,255,255,0.1);
    }
    
    /* ============================================
       INNOVATION - FULL WIDTH BANNER
       ============================================ */
    .value-card-full {
        grid-column: 1 / -1;
    }
    
    .value-innovation {
        background: linear-gradient(135deg, #0056b3 0%, #003d80 100%);
        padding: 35px 40px;
        border: none;
    }
    
    .innovation-icon-wrap {
        width: 70px;
        height: 70px;
        min-width: 70px;
        background: rgba(255,255,255,0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        color: #ffc107;
        animation: rocketFloat 3s ease-in-out infinite;
    }
    
    @keyframes rocketFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    
    .btn-innovation {
        display: inline-flex;
        align-items: center;
        padding: 14px 30px;
        background: #fff;
        color: #0056b3;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    .btn-innovation:hover {
        background: #28a745;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40,167,69,0.4);
    }
    
    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 1199.98px) {
        .values-grid {
            gap: 15px;
        }
        .value-card {
            padding: 28px 22px;
        }
    }
    
    @media (max-width: 991.98px) {
        .values-section-pro { padding: 60px 0; }
        .section-heading { font-size: 1.8rem; }
        .values-grid {
            grid-template-columns: 1fr 1fr;
        }
        .value-card-large {
            grid-column: span 2;
        }
        .value-card-full {
            grid-column: span 2;
        }
        .value-innovation {
            padding: 25px 30px;
        }
        .innovation-icon-wrap {
            width: 55px;
            height: 55px;
            min-width: 55px;
            font-size: 24px;
        }
    }
    
    @media (max-width: 767.98px) {
        .values-section-pro { padding: 45px 0; }
        .section-heading { font-size: 1.5rem; }
        .values-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        .value-card-large {
            grid-column: span 1;
        }
        .value-card-full {
            grid-column: span 1;
        }
        .value-card {
            padding: 22px 18px;
            border-radius: 16px;
        }
        .value-icon {
            width: 50px;
            height: 50px;
            font-size: 22px;
            border-radius: 12px;
        }
        .value-title {
            font-size: 1.15rem;
        }
        .value-desc {
            font-size: 0.85rem;
        }
        .value-innovation {
            padding: 20px;
        }
        .innovation-icon-wrap {
            width: 45px;
            height: 45px;
            min-width: 45px;
            font-size: 20px;
        }
        .btn-innovation {
            width: 100%;
            justify-content: center;
            margin-top: 12px;
        }
    }
    
    @media (max-width: 575.98px) {
        .values-section-pro { padding: 35px 0; }
        .section-heading { font-size: 1.3rem; }
        .section-tag { font-size: 0.65rem; letter-spacing: 2px; }
        .value-card {
            padding: 18px 15px;
            border-radius: 12px;
        }
        .value-icon {
            width: 42px;
            height: 42px;
            font-size: 18px;
            border-radius: 10px;
            margin-bottom: 12px;
        }
        .value-title {
            font-size: 1.05rem;
        }
        .value-desc {
            font-size: 0.8rem;
        }
        .value-card-number {
            font-size: 3rem;
        }
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/website/partials/home/our-core-values-section.blade.php ENDPATH**/ ?>