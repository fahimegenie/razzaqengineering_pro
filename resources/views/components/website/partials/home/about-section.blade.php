<!-- ============================================
     PROFESSIONAL ABOUT US SECTION
     Balanced & Compact Design
     ============================================ -->
<section class="about-section-pro" id="aboutSection">
    <div class="container">
        
        <div class="row g-4 g-lg-5 align-items-center">
            
            {{-- Left: Image Gallery --}}
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                <div class="image-gallery-pro">
                    
                    {{-- Main Large Image --}}
                    <div class="main-image-wrapper">
                        <div class="main-image-card">
                            @if(!empty($com) && $com->oc_image1)
                                <img src="{{ $com->oc_image1 }}" 
                                     alt="Razzaq Engineering Services" 
                                     class="main-image" loading="lazy">
                            @else
                                <img src="{{ asset('assets/images/about1.jpg') }}" 
                                     alt="Engineering Services Pakistan" 
                                     class="main-image" loading="lazy">
                            @endif
                        </div>
                        
                        {{-- Floating Small Image --}}
                        <div class="floating-image-card">
                            @if(!empty($com) && $com->oc_image2)
                                <img src="{{ $com->oc_image2 }}" 
                                     alt="Our Work Quality" loading="lazy">
                            @else
                                <img src="{{ asset('assets/images/about2.jpg') }}" 
                                     alt="Quality Workmanship" loading="lazy">
                            @endif
                        </div>
                        
                        {{-- Experience Badge --}}
                        <div class="experience-box-pro">
                            <div class="exp-icon-wrap">
                                <i class="fas fa-award"></i>
                            </div>
                            <div class="exp-info">
                                <span class="exp-number"><span class="counter-num" data-target="15">0</span>+</span>
                                <span class="exp-subtitle">Years Experience</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            {{-- Right: Content --}}
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                <div class="content-wrapper-pro">
                    
                    {{-- Small Label --}}
                    <span class="section-label-pro">WHO WE ARE</span>
                    
                    {{-- Title --}}
                    <h2 class="section-title-pro">
                        @if(!empty($com))
                            {{ $com->oc_title }}
                        @else
                            Pakistan's Trusted <span class="text-highlight">Engineering Services</span> Company
                        @endif
                    </h2>
                    
                    {{-- Short Description --}}
                    <p class="section-desc-pro">
                        @if(!empty($com))
                            {{ Str::limit(strip_tags($com->oc_description), 250) }}
                        @else
                            With over 15 years of industry leadership, we deliver professional RCC core cutting, diamond drilling, wall saw cutting, plumbing & fire fighting services across Pakistan.
                        @endif
                    </p>
                    
                    {{-- Stats Row --}}
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
                    
                    {{-- Feature Points --}}
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
                    
                    {{-- CTA Buttons --}}
                    <div class="cta-row-pro">
                        <a href="{{ route('home.about') }}" class="btn-about-primary">
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

{{-- Professional CSS --}}
@push('styles')
<style>
    /* ============================================
       ABOUT SECTION - BALANCED DESIGN
       ============================================ */
    .about-section-pro {
        padding: 80px 0;
        background: #ffffff;
        position: relative;
    }
    
    /* ============================================
       IMAGE GALLERY
       ============================================ */
    .image-gallery-pro {
        position: relative;
        padding-bottom: 10px;
    }
    
    .main-image-wrapper {
        position: relative;
        display: inline-block;
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
    
    /* Floating Small Image */
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
    
    /* Experience Badge */
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
    
    /* ============================================
       CONTENT WRAPPER
       ============================================ */
    .content-wrapper-pro {
        padding-left: 10px;
    }
    
    /* Section Label */
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
    
    /* Title */
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
    
    /* Description */
    .section-desc-pro {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.75;
        margin-bottom: 20px;
    }
    
    /* ============================================
       STATS ROW
       ============================================ */
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
    
    /* ============================================
       FEATURE POINTS
       ============================================ */
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
    
    /* ============================================
       CTA BUTTONS
       ============================================ */
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
    
    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 1199.98px) {
        .section-title-pro { font-size: 2rem; }
        .main-image { height: 380px; }
        .floating-image-card { width: 160px; height: 120px; right: -20px; }
    }
    
    @media (max-width: 991.98px) {
        .about-section-pro { padding: 60px 0; }
        .content-wrapper-pro { padding-left: 0; padding-top: 20px; }
        .main-image { height: 380px; }
        .section-title-pro { font-size: 1.9rem; }
        .experience-box-pro { left: 0; }
    }
    
    @media (max-width: 767.98px) {
        .about-section-pro { padding: 45px 0; }
        .main-image { height: 320px; }
        .floating-image-card { width: 140px; height: 105px; right: -10px; bottom: -20px; }
        .experience-box-pro { padding: 10px 15px; left: 5px; bottom: 5px; }
        .exp-number { font-size: 1.3rem; }
        .section-title-pro { font-size: 1.6rem; }
        .section-desc-pro { font-size: 0.9rem; }
        .stats-row-pro { padding: 14px 10px; }
        .stat-number-pro { font-size: 1.4rem; }
        .stat-text-pro { font-size: 0.65rem; }
        .cta-row-pro { flex-direction: column; }
        .btn-about-primary, .btn-about-call { width: 100%; justify-content: center; }
    }
    
    @media (max-width: 575.98px) {
        .about-section-pro { padding: 35px 0; }
        .main-image { height: 260px; }
        .floating-image-card { width: 110px; height: 80px; right: -5px; bottom: -15px; border-width: 3px; }
        .experience-box-pro { padding: 8px 12px; gap: 8px; border-radius: 8px; }
        .exp-icon-wrap { width: 32px; height: 32px; min-width: 32px; font-size: 14px; }
        .exp-number { font-size: 1.1rem; }
        .exp-subtitle { font-size: 0.62rem; }
        .section-title-pro { font-size: 1.35rem; }
        .section-label-pro { font-size: 0.65rem; letter-spacing: 2px; padding-left: 28px; }
        .section-label-pro::before { width: 20px; }
        .section-desc-pro { font-size: 0.85rem; line-height: 1.6; }
        .stats-row-pro { flex-wrap: wrap; gap: 10px; padding: 12px 8px; }
        .stat-divider { display: none; }
        .stat-item-pro { flex: unset; width: 30%; }
        .stat-number-pro { font-size: 1.2rem; }
        .feature-point { font-size: 0.8rem; gap: 8px; }
        .feature-point i { font-size: 0.9rem; }
    }
    
    @media (max-width: 400px) {
        .main-image { height: 220px; }
        .floating-image-card { width: 90px; height: 65px; }
        .experience-box-pro { padding: 6px 10px; }
        .exp-number { font-size: 1rem; }
        .section-title-pro { font-size: 1.2rem; }
        .stat-number-pro { font-size: 1.1rem; }
    }
</style>
@endpush

{{-- Counter Script --}}
@push('scripts')
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
@endpush