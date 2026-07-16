<!-- ============================================
     PROFESSIONAL SERVICES SECTION
     Modern Tab Design - All Scenarios Handled
     ============================================ -->
<section class="services-section-pro" id="servicesSection">
    <div class="container">
        
        {{-- Section Header --}}
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <span class="section-label-pro">WHAT WE OFFER</span>
                <h2 class="section-title-pro">Our Professional <span class="text-highlight">Services</span></h2>
                <p class="section-subtitle-pro">Comprehensive engineering solutions tailored to your needs</p>
            </div>
        </div>
        
        {{-- Top Bar with Phone & CTA --}}
        <div class="services-top-bar" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="emergency-info">
                        <div class="emergency-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="emergency-text">
                            <span class="emergency-label">24/7 Emergency Service</span>
                            <a href="tel:+923048902805" class="emergency-phone">
                                <i class="fas fa-phone-alt"></i> +92 304 8902805
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('quote.index') }}" class="btn-services-quote">
                        <i class="fas fa-file-invoice me-2"></i> Get Free Quote
                    </a>
                    <a href="{{ route('home.services') }}" class="btn-services-all">
                        <i class="fas fa-th-list me-2"></i> View All Services
                    </a>
                </div>
            </div>
        </div>
        
        {{-- Tabs Navigation --}}
        <div class="services-tabs-wrapper" data-aos="fade-up">
            
            {{-- Tab Buttons - Horizontally Scrollable on Mobile --}}
            <div class="tab-nav-wrapper">
                <div class="tab-nav-scroll" id="serviceTabs">
                    @if(!empty($os) && count($os) > 0)
                        @foreach($os as $key => $service)
                            <button class="tab-btn {{ $key == 0 ? 'active' : '' }}" 
                                    onclick="openServiceTab(event, 'service-{{ $service->id }}')"
                                    data-tab="service-{{ $service->id }}"
                                    {{ $key == 0 ? 'id=defaultServiceTab' : '' }}>
                                <span class="tab-icon">
                                    @if($service->os_icon)
                                        <img src="{{ $service->icon_url }}" 
                                             alt="{{ $service->os_name }}" 
                                             width="28" height="28"
                                             loading="lazy">
                                    @else
                                        <i class="fas fa-tools"></i>
                                    @endif
                                </span>
                                <span class="tab-text">{{ $service->os_name }}</span>
                            </button>
                        @endforeach
                    @else
                        @php $dummyServices = ['RCC Core Cutting', 'Diamond Drilling', 'Wall Saw Cutting', 'Plumbing Services', 'Fire Fighting', 'Water Proofing']; @endphp
                        @foreach($dummyServices as $key => $ds)
                            <button class="tab-btn {{ $key == 0 ? 'active' : '' }}" 
                                    onclick="openServiceTab(event, 'service-{{ ($key + 1) }}')"
                                    data-tab="service-{{ $key }}"
                                    {{ $key == 0 ? 'id=defaultServiceTab' : '' }}>
                                <span class="tab-icon"><i class="fas fa-tools"></i></span>
                                <span class="tab-text">{{ $ds }}</span>
                            </button>
                        @endforeach
                    @endif
                </div>
                
                {{-- Scroll Arrows (shown on mobile) --}}
                <button class="tab-scroll-arrow tab-scroll-left" onclick="scrollTabs(-200)" aria-label="Scroll left">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="tab-scroll-arrow tab-scroll-right" onclick="scrollTabs(200)" aria-label="Scroll right">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            
        </div>
        
        {{-- Tab Content --}}
        <div class="tab-content-wrapper" data-aos="fade-up" data-aos-delay="100">
            
            @if(!empty($sd) && count($sd) > 0)
                @foreach($sd as $key => $detail)
                    <div id="service-{{ $detail->id }}" 
                         class="tab-panel {{ $key == 0 ? 'active' : '' }}" 
                         style="{{ $key == 0 ? 'display: block;' : 'display: none;' }}">
                        
                        <div class="service-panel-inner">
                            <div class="row g-4">
                                
                                {{-- Images --}}
                                <div class="col-lg-6">
                                    <div class="service-images-grid">
                                        <div class="service-img-main">
                                            <img src="{{ $detail->image1_url }}" 
                                                 alt="{{ $detail->sd_title }}"
                                                 class="service-img"
                                                 loading="lazy">
                                        </div>
                                        <div class="service-img-secondary">
                                            <img src="{{ $detail->image2_url }}" 
                                                 alt="{{ $detail->sd_title }} - Detail"
                                                 class="service-img"
                                                 loading="lazy">
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Content --}}
                                <div class="col-lg-6">
                                    <div class="service-content">
                                        <span class="service-badge">Service Details</span>
                                        <h3 class="service-title">{{ $detail->sd_title }}</h3>
                                        <p class="service-description">{{ Str::limit($detail->sd_description, 350) }}</p>
                                        
                                        {{-- Features --}}
                                        <div class="service-features">
                                            @if($detail->sd_t1)
                                                <div class="service-feature-item">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>{{ $detail->sd_t1 }}</span>
                                                </div>
                                            @endif
                                            @if($detail->sd_t2)
                                                <div class="service-feature-item">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>{{ $detail->sd_t2 }}</span>
                                                </div>
                                            @endif
                                            @if($detail->sd_t3)
                                                <div class="service-feature-item">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>{{ $detail->sd_t3 }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        {{-- CTA --}}
                                        <div class="service-cta">
                                            <a href="{{ url('service-detail/'.str_replace(' ', '-', $detail->sd_title)) }}" 
                                               class="btn-service-learn">
                                                Learn More <i class="fas fa-arrow-right ms-2"></i>
                                            </a>
                                            <a href="{{ route('quote.index') }}" class="btn-service-quote-sm">
                                                <i class="fas fa-paper-plane me-2"></i> Request Quote
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                @endforeach
            @else
                {{-- Empty State --}}
                <div class="tab-panel active" style="display: block;">
                    <div class="service-panel-inner text-center py-5">
                        <div class="empty-state-icon mb-3">
                            <i class="fas fa-tools fa-3x text-muted"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Service Details Coming Soon</h4>
                        <p class="text-muted mb-4">We're updating our services catalog. Please contact us directly for more information.</p>
                        <a href="{{ route('home.contact') }}" class="btn btn-gradient px-4 py-2 rounded-pill">
                            <i class="fas fa-envelope me-2"></i> Contact Us
                        </a>
                    </div>
                </div>
            @endif
            
        </div>
        
    </div>
</section>

{{-- Professional CSS --}}
@push('styles')
<style>
    /* ============================================
       SERVICES SECTION - PROFESSIONAL DESIGN
       ============================================ */
    .services-section-pro {
        padding: 80px 0;
        background: #f8f9fa;
        position: relative;
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
        margin: 0 auto;
    }
    
    /* ============================================
       TOP BAR
       ============================================ */
    .services-top-bar {
        background: #fff;
        border-radius: 12px;
        padding: 20px 25px;
        margin-bottom: 25px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.04);
        border: 1px solid #e9ecef;
    }
    
    .emergency-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .emergency-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        background: rgba(220,53,69,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #dc3545;
        font-size: 20px;
        animation: pulse-ring 2s infinite;
    }
    
    @keyframes pulse-ring {
        0% { box-shadow: 0 0 0 0 rgba(220,53,69,0.3); }
        70% { box-shadow: 0 0 0 10px rgba(220,53,69,0); }
        100% { box-shadow: 0 0 0 0 rgba(220,53,69,0); }
    }
    
    .emergency-text {
        display: flex;
        flex-direction: column;
    }
    
    .emergency-label {
        font-size: 0.8rem;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }
    
    .emergency-phone {
        font-size: 1.15rem;
        font-weight: 700;
        color: #0a1628;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .emergency-phone:hover {
        color: #28a745;
    }
    
    .emergency-phone i {
        color: #28a745;
        margin-right: 5px;
        font-size: 0.9rem;
    }
    
    .btn-services-quote {
        display: inline-flex;
        align-items: center;
        padding: 10px 22px;
        background: linear-gradient(135deg, #0056b3, #003d80);
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
        margin-right: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-services-quote:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,86,179,0.3);
        color: #fff;
    }
    
    .btn-services-all {
        display: inline-flex;
        align-items: center;
        padding: 10px 22px;
        background: #fff;
        color: #28a745;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
        border: 2px solid #28a745;
        transition: all 0.3s ease;
    }
    
    .btn-services-all:hover {
        background: #28a745;
        color: #fff;
        transform: translateY(-2px);
    }
    
    /* ============================================
       TABS NAVIGATION
       ============================================ */
    .services-tabs-wrapper {
        position: relative;
        margin-bottom: 0;
    }
    
    .tab-nav-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .tab-nav-scroll {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        -ms-overflow-style: none;
        padding: 5px 0;
        width: 100%;
    }
    
    .tab-nav-scroll::-webkit-scrollbar {
        display: none;
    }
    
    .tab-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 22px;
        background: #fff;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.9rem;
        color: #555;
        white-space: nowrap;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }
    
    .tab-btn:hover {
        border-color: #28a745;
        color: #28a745;
        background: #f0faf3;
    }
    
    .tab-btn.active {
        background: linear-gradient(135deg, #0056b3, #003d80);
        color: #fff;
        border-color: transparent;
        box-shadow: 0 5px 20px rgba(0,86,179,0.3);
    }
    
    .tab-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: rgba(40,167,69,0.08);
        border-radius: 8px;
        font-size: 16px;
        color: #28a745;
        flex-shrink: 0;
    }
    
    .tab-btn.active .tab-icon {
        background: rgba(255,255,255,0.2);
        color: #fff;
    }
    
    .tab-btn.active .tab-icon img {
        filter: brightness(0) invert(1);
    }
    
    .tab-text {
        font-size: 0.88rem;
    }
    
    /* Scroll Arrows */
    .tab-scroll-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 36px;
        height: 36px;
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 50%;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: #555;
        z-index: 2;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .tab-scroll-arrow:hover {
        background: #28a745;
        color: #fff;
        border-color: #28a745;
    }
    
    .tab-scroll-left { left: -18px; }
    .tab-scroll-right { right: -18px; }
    
    /* ============================================
       TAB CONTENT
       ============================================ */
    .tab-content-wrapper {
        background: #fff;
        border-radius: 0 0 16px 16px;
        box-shadow: 0 5px 30px rgba(0,0,0,0.05);
        border: 1px solid #e9ecef;
        border-top: none;
    }
    
    .tab-panel {
        display: none;
        animation: tabFadeIn 0.4s ease;
    }
    
    .tab-panel.active {
        display: block;
    }
    
    @keyframes tabFadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .service-panel-inner {
        padding: 35px;
    }
    
    /* Service Images */
    .service-images-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    
    .service-img-main {
        grid-column: 1 / -1;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }
    
    .service-img-main .service-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
    
    .service-img-secondary {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    }
    
    .service-img-secondary .service-img {
        width: 100%;
        height: 130px;
        object-fit: cover;
    }
    
    /* Service Content */
    .service-content {
        padding-left: 10px;
    }
    
    .service-badge {
        display: inline-block;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #28a745;
        background: rgba(40,167,69,0.08);
        padding: 5px 14px;
        border-radius: 4px;
        margin-bottom: 12px;
    }
    
    .service-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0a1628;
        margin-bottom: 12px;
        line-height: 1.3;
    }
    
    .service-description {
        font-size: 0.92rem;
        color: #666;
        line-height: 1.7;
        margin-bottom: 18px;
    }
    
    /* Service Features */
    .service-features {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 22px;
    }
    
    .service-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.9rem;
        color: #444;
        font-weight: 500;
    }
    
    .service-feature-item i {
        color: #28a745;
        font-size: 1.05rem;
        margin-top: 2px;
        flex-shrink: 0;
    }
    
    /* Service CTA */
    .service-cta {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .btn-service-learn {
        display: inline-flex;
        align-items: center;
        padding: 11px 24px;
        background: linear-gradient(135deg, #0056b3, #003d80);
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.88rem;
        transition: all 0.3s ease;
    }
    
    .btn-service-learn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,86,179,0.3);
        color: #fff;
    }
    
    .btn-service-quote-sm {
        display: inline-flex;
        align-items: center;
        padding: 11px 24px;
        background: #fff;
        color: #28a745;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.88rem;
        border: 2px solid #28a745;
        transition: all 0.3s ease;
    }
    
    .btn-service-quote-sm:hover {
        background: #28a745;
        color: #fff;
        transform: translateY(-2px);
    }
    
    /* Empty State */
    .empty-state-icon i {
        opacity: 0.3;
    }
    
    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 1199.98px) {
        .section-title-pro { font-size: 2rem; }
        .service-title { font-size: 1.35rem; }
        .service-img-main .service-img { height: 220px; }
    }
    
    @media (max-width: 991.98px) {
        .services-section-pro { padding: 60px 0; }
        .section-title-pro { font-size: 1.8rem; }
        
        .services-top-bar .row > div:last-child { text-align: left !important; }
        .btn-services-all { margin-top: 5px; }
        
        .tab-btn { padding: 12px 16px; font-size: 0.82rem; gap: 8px; }
        .tab-icon { width: 30px; height: 30px; font-size: 14px; }
        
        .service-panel-inner { padding: 25px; }
        .service-content { padding-left: 0; padding-top: 20px; }
        .service-img-main .service-img { height: 200px; }
        .service-img-secondary .service-img { height: 110px; }
        
        .tab-scroll-arrow { display: flex; }
    }
    
    @media (max-width: 767.98px) {
        .services-section-pro { padding: 45px 0; }
        .section-title-pro { font-size: 1.6rem; }
        .section-label-pro { font-size: 0.65rem; letter-spacing: 2px; padding-left: 28px; }
        .section-label-pro::before { width: 20px; }
        .section-subtitle-pro { font-size: 0.85rem; }
        
        .services-top-bar { padding: 15px; }
        .emergency-info { gap: 10px; }
        .emergency-icon { width: 38px; height: 38px; min-width: 38px; font-size: 16px; }
        .emergency-phone { font-size: 1rem; }
        
        .btn-services-quote, .btn-services-all { 
            padding: 8px 16px; 
            font-size: 0.8rem; 
            width: 100%; 
            justify-content: center;
            margin-bottom: 6px;
        }
        
        .tab-btn { padding: 10px 14px; font-size: 0.78rem; gap: 6px; border-radius: 8px; }
        .tab-icon { width: 28px; height: 28px; font-size: 12px; border-radius: 6px; }
        .tab-icon img { width: 20px !important; height: 20px !important; }
        
        .service-panel-inner { padding: 20px 15px; }
        .service-title { font-size: 1.2rem; }
        .service-description { font-size: 0.85rem; }
        .service-feature-item { font-size: 0.82rem; gap: 8px; }
        
        .service-img-main .service-img { height: 180px; }
        .service-images-grid { grid-template-columns: 1fr; gap: 10px; }
        .service-img-secondary { display: none; }
        
        .btn-service-learn, .btn-service-quote-sm { 
            width: 100%; 
            justify-content: center; 
            padding: 10px 20px;
            font-size: 0.82rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .services-section-pro { padding: 35px 0; }
        .section-title-pro { font-size: 1.35rem; }
        
        .tab-btn { padding: 8px 12px; font-size: 0.72rem; gap: 5px; border-radius: 6px; }
        .tab-icon { width: 24px; height: 24px; font-size: 11px; border-radius: 5px; }
        .tab-icon img { width: 16px !important; height: 16px !important; }
        .tab-text { font-size: 0.72rem; }
        
        .service-panel-inner { padding: 15px 12px; }
        .service-title { font-size: 1.1rem; }
        .service-badge { font-size: 0.62rem; padding: 4px 10px; letter-spacing: 1px; }
        .service-description { font-size: 0.8rem; line-height: 1.5; }
        .service-feature-item { font-size: 0.78rem; }
        .service-feature-item i { font-size: 0.9rem; }
        
        .service-img-main .service-img { height: 160px; }
        .service-img-main { border-radius: 8px; }
    }
    
    @media (max-width: 400px) {
        .tab-btn { padding: 7px 10px; font-size: 0.68rem; }
        .tab-icon { width: 22px; height: 22px; }
        .tab-text { font-size: 0.68rem; }
        .service-title { font-size: 1rem; }
        .service-img-main .service-img { height: 140px; }
    }
</style>
@endpush

{{-- Tab Script --}}
@push('scripts')
<script>
    // Service Tab Function
    function openServiceTab(evt, tabId) {
        // Hide all panels
        document.querySelectorAll('.tab-panel').forEach(panel => {
            panel.classList.remove('active');
            panel.style.display = 'none';
        });
        
        // Remove active from all buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Show selected panel
        const panel = document.getElementById(tabId);
        if (panel) {
            panel.classList.add('active');
            panel.style.display = 'block';
        }
        
        // Activate clicked button
        if (evt && evt.currentTarget) {
            evt.currentTarget.classList.add('active');
        }
    }
    
    // Initialize first tab
    document.addEventListener('DOMContentLoaded', function() {
        const defaultTab = document.getElementById('defaultServiceTab');
        if (defaultTab) {
            defaultTab.click();
        }
    });
    
    // Scroll Tabs Function
    function scrollTabs(amount) {
        const container = document.getElementById('serviceTabs');
        if (container) {
            container.scrollBy({ left: amount, behavior: 'smooth' });
        }
    }
    
    // Show/hide scroll arrows based on scroll position
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('serviceTabs');
        const leftArrow = document.querySelector('.tab-scroll-left');
        const rightArrow = document.querySelector('.tab-scroll-right');
        
        if (container && leftArrow && rightArrow) {
            function updateArrows() {
                const canScrollLeft = container.scrollLeft > 0;
                const canScrollRight = container.scrollLeft < (container.scrollWidth - container.clientWidth - 5);
                
                leftArrow.style.display = canScrollLeft ? 'flex' : 'none';
                rightArrow.style.display = canScrollRight ? 'flex' : 'none';
            }
            
            container.addEventListener('scroll', updateArrows);
            window.addEventListener('resize', updateArrows);
            updateArrows();
        }
    });
</script>
@endpush