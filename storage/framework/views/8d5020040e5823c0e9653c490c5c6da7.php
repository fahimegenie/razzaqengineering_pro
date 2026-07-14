<!-- ============================================
     PROFESSIONAL VIDEO SECTION
     ============================================ -->
<section class="video-section-pro" id="videoSection">
    <div class="container">
        <div class="video-wrapper">
            <div class="row g-0 align-items-center">
                
                
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                    <div class="video-content-wrapper">
                        
                        
                        <span class="video-label">OUR WORK IN ACTION</span>
                        
                        
                        <h2 class="video-title">
                            See Our <span class="text-highlight">Expertise</span> in Motion
                        </h2>
                        
                        
                        <p class="video-description">
                            Razzaq Engineering Services proudly maintains a nationwide presence with branches strategically located in <strong>Lahore, Karachi, Islamabad, Rawalpindi & Peshawar</strong>. Watch our team deliver precision engineering solutions across Pakistan.
                        </p>
                        
                        
                        <div class="video-features-grid">
                            <div class="video-feature-item">
                                <div class="vf-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="vf-content">
                                    <h5>Dependable Guarantee</h5>
                                    <p>100% satisfaction on every project</p>
                                </div>
                            </div>
                            
                            <div class="video-feature-item">
                                <div class="vf-icon">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <div class="vf-content">
                                    <h5>National Coverage</h5>
                                    <p>Official branches in 5 major cities</p>
                                </div>
                            </div>
                            
                            <div class="video-feature-item">
                                <div class="vf-icon">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div class="vf-content">
                                    <h5>Expert Support</h5>
                                    <p>Professional help when you need it</p>
                                </div>
                            </div>
                            
                            <div class="video-feature-item">
                                <div class="vf-icon">
                                    <i class="fas fa-hard-hat"></i>
                                </div>
                                <div class="vf-content">
                                    <h5>Controlled Demolition</h5>
                                    <p>Safe & precise concrete breaking</p>
                                </div>
                            </div>
                            
                            <div class="video-feature-item">
                                <div class="vf-icon">
                                    <i class="fas fa-globe-asia"></i>
                                </div>
                                <div class="vf-content">
                                    <h5>All Pakistan Service</h5>
                                    <p>Coverage in every major city</p>
                                </div>
                            </div>
                            
                            <div class="video-feature-item">
                                <div class="vf-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div class="vf-content">
                                    <h5>Critical Projects</h5>
                                    <p>15+ years of complex project experience</p>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="video-cta">
                            <a href="<?php echo e(route('quote.index')); ?>" class="btn-video-quote">
                                <i class="fas fa-file-invoice me-2"></i> Get Free Quote
                            </a>
                            <a href="tel:+923048902805" class="btn-video-call">
                                <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                            </a>
                        </div>
                        
                    </div>
                </div>
                
                
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                    <div class="video-thumbnail-wrapper">
                        
                        
                        <div class="video-card-pro">
                            <div class="video-thumbnail-image">
                                <?php
                                    $videoThumb = asset('assets/images/video-business.jpg');
                                    if (!empty($com) && !empty($com->oc_image1) && file_exists(public_path('slider_image/'.$com->oc_image1))) {
                                        $videoThumb = asset('slider_image/'.$com->oc_image1);
                                    }
                                ?>
                                <img src="<?php echo e($videoThumb); ?>" 
                                     alt="Razzaq Engineering - Watch Our Work" 
                                     class="video-thumb-img"
                                     loading="lazy">
                                
                                
                                <div class="video-overlay"></div>
                                
                                
                                <a class="video-play-btn-pro popup-youtube" 
                                   href="https://www.youtube.com/watch?v=CFv0Z9bOEMM"
                                   title="Watch Our Video">
                                    <div class="play-icon-circle">
                                        <i class="fas fa-play"></i>
                                    </div>
                                    <span class="play-text">Watch Video</span>
                                </a>
                                
                                
                                <div class="video-duration-badge">
                                    <i class="fas fa-clock me-1"></i> 2:30
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="video-stats-row">
                            <div class="video-stat-card">
                                <span class="vs-number">500+</span>
                                <span class="vs-label">Projects Done</span>
                            </div>
                            <div class="video-stat-card">
                                <span class="vs-number">15+</span>
                                <span class="vs-label">Years Exp.</span>
                            </div>
                            <div class="video-stat-card">
                                <span class="vs-number">5</span>
                                <span class="vs-label">Major Cities</span>
                            </div>
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
       PROFESSIONAL VIDEO SECTION
       ============================================ */
    .video-section-pro {
        padding: 80px 0;
        background: #ffffff;
        position: relative;
    }
    
    .video-wrapper {
        background: linear-gradient(135deg, #f8f9fa 0%, #eef0f2 100%);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.05);
    }
    
    /* ============================================
       LEFT CONTENT
       ============================================ */
    .video-content-wrapper {
        padding: 50px 40px;
    }
    
    .video-label {
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
    
    .video-label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 2px;
        background: #28a745;
    }
    
    .video-title {
        font-size: 2rem;
        font-weight: 800;
        color: #0a1628;
        margin-bottom: 15px;
        line-height: 1.25;
    }
    
    .text-highlight {
        background: linear-gradient(135deg, #0056b3, #28a745);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .video-description {
        font-size: 0.93rem;
        color: #666;
        line-height: 1.7;
        margin-bottom: 25px;
    }
    
    .video-description strong {
        color: #0056b3;
    }
    
    /* Features Grid */
    .video-features-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid #dee2e6;
    }
    
    .video-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px;
        background: #fff;
        border-radius: 10px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .video-feature-item:hover {
        box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        border-color: #28a745;
        transform: translateY(-2px);
    }
    
    .vf-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;
        background: linear-gradient(135deg, rgba(40,167,69,0.1), rgba(0,86,179,0.1));
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        color: #28a745;
    }
    
    .vf-content h5 {
        font-size: 0.85rem;
        font-weight: 700;
        color: #0a1628;
        margin: 0 0 2px 0;
    }
    
    .vf-content p {
        font-size: 0.75rem;
        color: #888;
        margin: 0;
    }
    
    /* CTA */
    .video-cta {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .btn-video-quote {
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
        box-shadow: 0 4px 15px rgba(0,86,179,0.2);
    }
    
    .btn-video-quote:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,86,179,0.35);
        color: #fff;
    }
    
    .btn-video-call {
        display: inline-flex;
        align-items: center;
        padding: 12px 26px;
        background: #fff;
        color: #28a745;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
        border: 2px solid #28a745;
        transition: all 0.3s ease;
    }
    
    .btn-video-call:hover {
        background: #28a745;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40,167,69,0.3);
    }
    
    /* ============================================
       RIGHT VIDEO THUMBNAIL
       ============================================ */
    .video-thumbnail-wrapper {
        padding: 40px;
        position: relative;
    }
    
    .video-card-pro {
        position: relative;
    }
    
    .video-thumbnail-image {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }
    
    .video-thumb-img {
        width: 100%;
        height: 380px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }
    
    .video-thumbnail-image:hover .video-thumb-img {
        transform: scale(1.03);
    }
    
    .video-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0,86,179,0.6) 0%, rgba(0,0,0,0.3) 100%);
        pointer-events: none;
    }
    
    /* Play Button */
    .video-play-btn-pro {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        z-index: 2;
    }
    
    .play-icon-circle {
        width: 80px;
        height: 80px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: #0056b3;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        transition: all 0.3s ease;
        animation: playPulse 2s infinite;
    }
    
    @keyframes playPulse {
        0% { box-shadow: 0 0 0 0 rgba(255,255,255,0.5); }
        70% { box-shadow: 0 0 0 25px rgba(255,255,255,0); }
        100% { box-shadow: 0 0 0 0 rgba(255,255,255,0); }
    }
    
    .video-play-btn-pro:hover .play-icon-circle {
        background: #28a745;
        color: #fff;
        transform: scale(1.1);
        box-shadow: 0 15px 40px rgba(40,167,69,0.5);
    }
    
    .play-text {
        color: #fff;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }
    
    /* Duration Badge */
    .video-duration-badge {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: rgba(0,0,0,0.75);
        color: #fff;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 2;
        backdrop-filter: blur(5px);
    }
    
    /* Stats Row */
    .video-stats-row {
        display: flex;
        gap: 12px;
        margin-top: -25px;
        position: relative;
        z-index: 3;
        padding: 0 20px;
    }
    
    .video-stat-card {
        flex: 1;
        background: #fff;
        border-radius: 12px;
        padding: 15px;
        text-align: center;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .video-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    }
    
    .vs-number {
        display: block;
        font-size: 1.5rem;
        font-weight: 900;
        color: #0056b3;
        line-height: 1;
    }
    
    .vs-label {
        display: block;
        font-size: 0.7rem;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        margin-top: 3px;
    }
    
    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 1199.98px) {
        .video-content-wrapper { padding: 40px 30px; }
        .video-thumbnail-wrapper { padding: 40px 30px; }
        .video-title { font-size: 1.8rem; }
        .video-thumb-img { height: 340px; }
    }
    
    @media (max-width: 991.98px) {
        .video-section-pro { padding: 60px 0; }
        .video-content-wrapper { padding: 35px 25px; }
        .video-thumbnail-wrapper { padding: 0 25px 35px; }
        .video-thumb-img { height: 320px; }
        .video-stats-row { margin-top: -20px; padding: 0 10px; }
        .play-icon-circle { width: 65px; height: 65px; font-size: 22px; }
    }
    
    @media (max-width: 767.98px) {
        .video-section-pro { padding: 45px 0; }
        .video-wrapper { border-radius: 20px; }
        .video-content-wrapper { padding: 25px 20px; }
        .video-title { font-size: 1.5rem; }
        .video-features-grid { grid-template-columns: 1fr; gap: 8px; }
        .video-thumb-img { height: 280px; border-radius: 12px; }
        .video-stats-row { margin-top: -15px; gap: 8px; }
        .video-stat-card { padding: 12px 8px; }
        .vs-number { font-size: 1.2rem; }
        .vs-label { font-size: 0.62rem; }
        .play-icon-circle { width: 55px; height: 55px; font-size: 18px; }
        .play-text { font-size: 0.75rem; letter-spacing: 1px; }
        .btn-video-quote, .btn-video-call { width: 100%; justify-content: center; }
    }
    
    @media (max-width: 575.98px) {
        .video-section-pro { padding: 35px 0; }
        .video-content-wrapper { padding: 20px 15px; }
        .video-title { font-size: 1.3rem; }
        .video-label { font-size: 0.62rem; letter-spacing: 2px; padding-left: 25px; }
        .video-label::before { width: 15px; }
        .video-description { font-size: 0.85rem; }
        .video-thumbnail-wrapper { padding: 0 15px 25px; }
        .video-thumb-img { height: 240px; }
        .video-stats-row { flex-wrap: wrap; margin-top: -10px; gap: 6px; padding: 0; }
        .video-stat-card { flex: unset; width: 30%; padding: 10px 5px; border-radius: 8px; }
        .vs-number { font-size: 1rem; }
        .vs-label { font-size: 0.58rem; }
        .play-icon-circle { width: 45px; height: 45px; font-size: 16px; }
        .video-duration-badge { font-size: 0.68rem; padding: 4px 10px; }
        .vf-icon { width: 32px; height: 32px; min-width: 32px; font-size: 13px; border-radius: 8px; }
        .vf-content h5 { font-size: 0.78rem; }
        .vf-content p { font-size: 0.7rem; }
    }
</style>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        $('.popup-youtube').magnificPopup({
            type: 'iframe',
            iframe: {
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: function(url) {
                            var m = url.match(/[\\?\\&]v=([^\\?\\&]+)/);
                            return m && m[1] ? m[1] : null;
                        },
                        src: '//www.youtube.com/embed/%id%?autoplay=1&rel=0&showinfo=0'
                    }
                }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/website/partials/home/video-section.blade.php ENDPATH**/ ?>