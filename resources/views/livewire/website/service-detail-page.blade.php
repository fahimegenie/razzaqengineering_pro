<div class="service-detail-page" 
     x-data="{ showAllAdvantages: false, activeFaq: null }">
    
    {{-- ============================================
         STICKY MOBILE CTA
         ============================================ --}}
    <div class="sd-mobile-cta d-lg-none">
        <a href="tel:+923048902805" class="sd-mobile-btn sd-mobile-call">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/923048902805" target="_blank" class="sd-mobile-btn sd-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="{{ route('quote.index') }}" class="sd-mobile-btn sd-mobile-quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    {{-- ============================================
         HERO SECTION - Strong Visual + CTA
         ============================================ --}}
    <section class="sd-hero">
        <div class="sd-hero-bg" style="background-image: url('{{ $currentService->os_image ? $currentService->image_url : asset('images/hero-construction.jpg') }}');"></div>
        <div class="sd-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-40">
                <div class="col-lg-7" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="sd-breadcrumb">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li><a href="{{ route('home.services') }}">Services</a></li>
                            <li class="active">{{ $currentService->os_name ?? 'Service Details' }}</li>
                        </ol>
                    </nav>
                    
                    <div class="sd-hero-badge">
                        <i class="fas fa-check-circle"></i> Licensed & Insured Professionals
                    </div>
                    
                    <h1 class="sd-hero-title">
                        {{ $currentService->os_name ?? $currentDetail->sd_title ?? 'Service Details' }}
                    </h1>
                    
                    <p class="sd-hero-subtitle">
                        {{ $currentService->os_short_description ?? 'Professional engineering solutions with 24+ years of excellence' }}
                    </p>
                    
                    <div class="sd-hero-cta">
                        <a href="{{ route('quote.index') }}" class="sd-btn sd-btn-lg sd-btn-accent">
                            <i class="fas fa-paper-plane me-2"></i> Get Free Estimate
                        </a>
                        <a href="tel:+923048902805" class="sd-btn sd-btn-lg sd-btn-white-outline">
                            <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                        </a>
                    </div>
                    
                    {{-- Trust Badges --}}
                    <div class="sd-hero-trust">
                        <div class="sd-trust-item">
                            <i class="fas fa-star"></i>
                            <span>5 Star Rated</span>
                        </div>
                        <div class="sd-trust-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Licensed & Insured</span>
                        </div>
                        <div class="sd-trust-item">
                            <i class="fas fa-clock"></i>
                            <span>24/7 Emergency</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center" data-aos="fade-left">
                    <div class="sd-hero-image-wrapper">
                        <img src="{{ $currentDetail->image1_url ?? asset('images/service-default.jpg') }}" 
                             alt="{{ $currentService->os_name ?? 'Service' }}" 
                             class="sd-hero-image"
                             loading="eager">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         TRUST BAR
         ============================================ --}}
    <section class="sd-trust-bar">
        <div class="container">
            <div class="sd-trust-grid">
                <div class="sd-trust-card">
                    <div class="sd-trust-icon"><i class="fas fa-users"></i></div>
                    <div>
                        <strong>1000+</strong>
                        <span>Projects Completed</span>
                    </div>
                </div>
                <div class="sd-trust-card">
                    <div class="sd-trust-icon"><i class="fas fa-calendar-check"></i></div>
                    <div>
                        <strong>24+ Years</strong>
                        <span>Experience</span>
                    </div>
                </div>
                <div class="sd-trust-card">
                    <div class="sd-trust-icon"><i class="fas fa-headset"></i></div>
                    <div>
                        <strong>24/7</strong>
                        <span>Emergency Service</span>
                    </div>
                </div>
                <div class="sd-trust-card">
                    <div class="sd-trust-icon"><i class="fas fa-certificate"></i></div>
                    <div>
                        <strong>Certified</strong>
                        <span>Professionals</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         MAIN CONTENT - 2 Col Layout with Sticky Sidebar
         ============================================ --}}
    <section class="sd-main-section">
        <div class="container">
            <div class="row g-4">
                
                {{-- LEFT: Main Content --}}
                <div class="col-lg-8">
                    
                    @if($isLoading)
                        <div class="sd-state-box" wire:key="sd-loading">
                            <div class="spinner-grow text-primary" style="width:3rem;height:3rem;"></div>
                            <p class="text-muted mt-3">Loading service details...</p>
                        </div>
                    
                    @elseif($errorMessage)
                        <div class="sd-error-card">
                            <i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;"></i>
                            <h4 class="fw-bold mt-3">Oops! Something went wrong</h4>
                            <p class="text-muted">{{ $errorMessage }}</p>
                            <a href="{{ route('home.services') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-arrow-left me-2"></i> Back to Services
                            </a>
                        </div>
                    
                    @else
                        {{-- Tabs Navigation with Arrows --}}
                        @if($services->count() > 1)
                            <div class="sd-tabs-wrapper" data-aos="fade-up" x-data="tabsSlider()">
                                <div class="sd-tabs-container">
                                    <!-- Left Arrow -->
                                    <button class="sd-tabs-arrow sd-tabs-arrow-left" 
                                            @click="scrollTabs('left')" 
                                            :class="{ 'hidden': !canScrollLeft }"
                                            aria-label="Scroll tabs left">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    
                                    <!-- Tabs Scroll Area -->
                                    <div class="sd-tabs-scroll" id="sdTabsScroll" x-ref="tabsScroll">
                                        @foreach($services as $service)
                                            <button type="button"
                                                    class="sd-tab-btn {{ $activeServiceId == $service->id ? 'active' : '' }}"
                                                    wire:click="switchTab({{ $service->id }})"
                                                    wire:key="tab-{{ $service->id }}"
                                                    id="tab-btn-{{ $service->id }}">
                                                @if($service->os_icon)
                                                    <i class="{{ $service->os_icon }}"></i>
                                                @endif
                                                {{ $service->os_name }}
                                            </button>
                                        @endforeach
                                    </div>
                                    
                                    <!-- Right Arrow -->
                                    <button class="sd-tabs-arrow sd-tabs-arrow-right" 
                                            @click="scrollTabs('right')" 
                                            :class="{ 'hidden': !canScrollRight }"
                                            aria-label="Scroll tabs right">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        @endif

                        @if($currentDetail && $currentService)
                            {{-- Image with CTA Overlay --}}
                            <div class="sd-content-card" data-aos="fade-up" wire:key="content-{{ $activeDetailId }}">
                                <div class="sd-image-hero">
                                    <img src="{{ $currentDetail->image1_url }}" 
                                         alt="{{ $currentDetail->sd_title }}" 
                                         class="sd-img-full"
                                         loading="lazy">
                                    <div class="sd-image-cta-overlay">
                                        <span class="sd-badge-large">{{ $currentService->os_name }}</span>
                                    </div>
                                </div>
                                
                                <div class="sd-content-body">
                                    <h2 class="sd-section-title">{{ $currentDetail->sd_title }}</h2>
                                    
                                    <div class="sd-description">
                                        {!! Str::words(strip_tags($currentDetail->sd_description), 80, '...') !!}
                                    </div>
                                    
                                    @if(Str::wordCount(strip_tags($currentDetail->sd_description)) > 80)
                                        <div x-show="showAllAdvantages" x-transition class="sd-description">
                                            {!! $currentDetail->sd_description !!}
                                        </div>
                                        <button @click="showAllAdvantages = !showAllAdvantages" 
                                                class="sd-read-more"
                                                x-text="showAllAdvantages ? 'Show Less' : 'Read More'">
                                        </button>
                                    @endif
                                    
                                    {{-- Mid CTA --}}
                                    <div class="sd-mid-cta">
                                        <div class="sd-mid-cta-inner">
                                            <i class="fas fa-phone-alt sd-mid-cta-icon"></i>
                                            <div>
                                                <strong>Get Free Consultation</strong>
                                                <span>Call us today for a no-obligation quote</span>
                                            </div>
                                            <a href="tel:+923048902805" class="sd-btn sd-btn-accent">+92 304 8902805</a>
                                        </div>
                                    </div>
                                    
                                    {{-- Key Features --}}
                                    @if($currentDetail->sd_t1 || $currentDetail->sd_t2 || $currentDetail->sd_t3)
                                        <div class="sd-features-grid">
                                            @foreach([$currentDetail->sd_t1, $currentDetail->sd_t2, $currentDetail->sd_t3] as $feature)
                                                @if($feature)
                                                    <div class="sd-feature-item-card">
                                                        <i class="fas fa-check-circle"></i>
                                                        <span>{{ $feature }}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            {{-- Advantages Accordion --}}
                            @if($currentAdvantages->count() > 0)
                                <div class="sd-content-card" data-aos="fade-up" wire:key="advantages-{{ $activeDetailId }}">
                                    <div class="sd-content-body">
                                        <h3 class="sd-section-title">Service Advantages</h3>
                                        
                                        @foreach($currentAdvantages as $index => $advantage)
                                            <div class="sd-accordion-item" 
                                                 :class="{ 'active': activeFaq === {{ $index }} }">
                                                <button class="sd-accordion-header" 
                                                        @click="activeFaq = activeFaq === {{ $index }} ? null : {{ $index }}">
                                                    <span>{{ $advantage->sa_title }}</span>
                                                    <i class="fas fa-chevron-down sd-accordion-arrow"></i>
                                                </button>
                                                <div class="sd-accordion-body" 
                                                     x-show="activeFaq === {{ $index }}" 
                                                     x-transition>
                                                    <p>{!! $advantage->sa_description !!}</p>
                                                    
                                                    @php $points = array_filter([$advantage->sa_t1, $advantage->sa_t2, $advantage->sa_t3, $advantage->sa_t4]); @endphp
                                                    @if(count($points))
                                                        <ul class="sd-accordion-list">
                                                            @foreach($points as $point)
                                                                <li><i class="fas fa-angle-right"></i> {{ $point }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                        @else
                            <div class="sd-state-box">
                                <div class="sd-empty-icon"><i class="fas fa-clipboard-list"></i></div>
                                <h4 class="fw-bold mt-3">Information Coming Soon</h4>
                                <p class="text-muted">Contact us for immediate assistance.</p>
                                <a href="tel:+923048902805" class="sd-btn sd-btn-accent mt-3">
                                    <i class="fas fa-phone-alt me-2"></i> Call Now
                                </a>
                            </div>
                        @endif
                    @endif
                </div>
                
                {{-- RIGHT: Sticky Sidebar --}}
                <div class="col-lg-4">
                    <div class="sd-sidebar">
                        {{-- Quick Quote --}}
                        <div class="sd-sidebar-card sd-sidebar-cta">
                            <i class="fas fa-file-invoice sd-sidebar-icon"></i>
                            <h4>Get Free Estimate</h4>
                            <p>We'll respond within 30 minutes</p>
                            <a href="{{ route('quote.index') }}" class="sd-btn sd-btn-accent w-100">
                                <i class="fas fa-paper-plane me-2"></i> Request Quote
                            </a>
                        </div>
                        
                        {{-- Contact Info --}}
                        <div class="sd-sidebar-card">
                            <h5 class="sd-sidebar-title">Quick Contact</h5>
                            <div class="sd-contact-info">
                                <a href="tel:+923048902805" class="sd-contact-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <span>+92 304 8902805</span>
                                </a>
                                <a href="https://wa.me/923048902805" target="_blank" class="sd-contact-item">
                                    <i class="fab fa-whatsapp"></i>
                                    <span>WhatsApp Chat</span>
                                </a>
                                <a href="mailto:info@razzaqengineering.com" class="sd-contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>info@razzaqengineering.com</span>
                                </a>
                            </div>
                        </div>
                        
                        {{-- Service Areas --}}
                        <div class="sd-sidebar-card">
                            <h5 class="sd-sidebar-title">Service Areas</h5>
                            <div class="sd-service-areas">
                                <span class="sd-area-tag">Lahore</span>
                                <span class="sd-area-tag">Karachi</span>
                                <span class="sd-area-tag">Islamabad</span>
                                <span class="sd-area-tag">Rawalpindi</span>
                                <span class="sd-area-tag">Faisalabad</span>
                                <span class="sd-area-tag">Multan</span>
                            </div>
                        </div>
                        
                        {{-- Download --}}
                        @if($pdfFile && $pdfFile->pdf_name)
                            <div class="sd-sidebar-card">
                                <a href="{{ asset('pdf_files/'.$pdfFile->pdf_name) }}" 
                                   target="_blank" 
                                   class="sd-download-link">
                                    <i class="fas fa-file-pdf"></i>
                                    <span>Download Company Brochure</span>
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                        @endif
                        
                        {{-- Trust Badges --}}
                        <div class="sd-sidebar-trust">
                            <div class="sd-trust-mini">
                                <i class="fas fa-shield-alt"></i> Licensed & Insured
                            </div>
                            <div class="sd-trust-mini">
                                <i class="fas fa-star"></i> 5 Star Service
                            </div>
                            <div class="sd-trust-mini">
                                <i class="fas fa-clock"></i> Available 24/7
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    
    {{-- Final CTA --}}
    <section class="sd-final-cta">
        <div class="container text-center">
            <h2>Ready to Start Your Project?</h2>
            <p class="mb-4">Get in touch with our experts today for a free consultation and estimate</p>
            <div class="sd-final-cta-buttons">
                <a href="{{ route('quote.index') }}" class="sd-btn sd-btn-lg sd-btn-accent">
                    <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                </a>
                <a href="tel:+923048902805" class="sd-btn sd-btn-lg sd-btn-white-outline-dark">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>

</div>


@push('styles')
<style>
/* ============================================
   SERVICE DETAIL PAGE - ENTERPRISE GRADE
   ============================================ */

/* --- CSS Variables --- */
.sd-hero { --sd-primary: #0056b3; --sd-primary-dark: #003d80; --sd-secondary: #28a745; --sd-dark: #0a1628; --sd-gray: #666; --sd-light: #f8f9fa; --sd-white: #fff; --sd-border: #eef0f2; }

/* --- Mobile Sticky CTA --- */
.sd-mobile-cta {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 999;
    display: flex; gap: 0; background: #fff; box-shadow: 0 -4px 20px rgba(0,0,0,0.12);
    padding: 0;
}

.sd-mobile-btn {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
    padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none;
    border: none; cursor: pointer; transition: all 0.2s;
}

.sd-mobile-call { background: #f8f9fa; color: #0a1628; }
.sd-mobile-whatsapp { background: #25D366; color: #fff; }
.sd-mobile-quote { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; }

/* --- Hero Section --- */
.sd-hero {
    position: relative; padding: 80px 0 60px; overflow: hidden;
    min-height: 500px; display: flex; align-items: center;
}

.sd-hero-bg {
    position: absolute; inset: 0; background-size: cover; background-position: center;
    filter: brightness(0.35);
}

.sd-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,61,128,0.85) 0%, rgba(26,92,42,0.8) 100%);
}

.sd-hero .container { position: relative; z-index: 2; }

.sd-breadcrumb {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px;
    font-size: 0.82rem; color: rgba(255,255,255,0.7);
}

.sd-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.sd-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.sd-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.sd-breadcrumb a:hover { color: #fff; }
.sd-breadcrumb .active { color: rgba(255,255,255,0.6); }

.sd-hero-badge {
    display: inline-flex; align-items: center; gap: 6px; background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px); color: #fff; padding: 6px 14px; border-radius: 25px;
    font-size: 0.78rem; font-weight: 600; margin-bottom: 15px;
}

.sd-hero-title { color: #fff; font-size: clamp(2rem, 5vw, 3rem); font-weight: 800; margin: 0 0 12px; line-height: 1.15; }
.sd-hero-subtitle { color: rgba(255,255,255,0.85); font-size: 1.1rem; max-width: 500px; margin: 0 0 25px; line-height: 1.6; }

.sd-hero-cta { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 25px; }

.sd-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 0.9rem;
    text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none;
    white-space: nowrap;
}

.sd-btn-lg { padding: 14px 28px; font-size: 0.95rem; border-radius: 10px; }
.sd-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.sd-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; text-decoration: none; }

.sd-btn-white-outline {
    background: transparent; color: #fff; border: 2px solid rgba(255,255,255,0.5);
}
.sd-btn-white-outline:hover { background: #fff; color: #003d80; border-color: #fff; text-decoration: none; }

.sd-btn-white-outline-dark { background: transparent; color: #0a1628; border: 2px solid #0a1628; }
.sd-btn-white-outline-dark:hover { background: #0a1628; color: #fff; text-decoration: none; }

/* Hero Trust Badges */
.sd-hero-trust { display: flex; gap: 20px; flex-wrap: wrap; }
.sd-trust-item {
    display: flex; align-items: center; gap: 6px; color: rgba(255,255,255,0.8);
    font-size: 0.78rem; font-weight: 600;
}
.sd-trust-item i { color: #28a745; }

.sd-hero-image-wrapper { position: relative; }
.sd-hero-image {
    max-height: 350px; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    border: 4px solid rgba(255,255,255,0.2); object-fit: cover;
}

/* --- Trust Bar --- */
.sd-trust-bar { background: #fff; padding: 0; border-bottom: 1px solid #eef0f2; }
.sd-trust-grid {
    display: grid; grid-template-columns: repeat(4, 1fr); gap: 0;
}

.sd-trust-card {
    display: flex; align-items: center; gap: 12px; padding: 20px; text-align: left;
    border-right: 1px solid #f0f0f0;
}
.sd-trust-card:last-child { border-right: none; }

.sd-trust-icon {
    width: 44px; height: 44px; min-width: 44px; background: rgba(40,167,69,0.1);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #28a745; font-size: 1.1rem;
}

.sd-trust-card strong { display: block; font-size: 1.1rem; color: #0a1628; }
.sd-trust-card span { font-size: 0.75rem; color: #888; }

/* --- Main Section --- */
.sd-main-section { padding: 40px 0 60px; background: #f8f9fa; }

/* --- Enhanced Tabs with Navigation Arrows --- */
.sd-tabs-wrapper { 
    margin-bottom: 20px; 
    position: relative;
}

.sd-tabs-container {
    position: relative;
    display: flex;
    align-items: center;
    gap: 0;
}

/* Navigation Arrows */
.sd-tabs-arrow {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #e9ecef;
    background: #fff;
    color: #0056b3;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 2;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.sd-tabs-arrow:hover {
    background: #0056b3;
    color: #fff;
    border-color: #0056b3;
    box-shadow: 0 4px 15px rgba(0,86,179,0.3);
}

.sd-tabs-arrow.hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

.sd-tabs-arrow-left {
    margin-right: 8px;
}

.sd-tabs-arrow-right {
    margin-left: 8px;
}

/* Scroll Container */
.sd-tabs-scroll {
    flex: 1;
    display: flex;
    gap: 8px;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
    -ms-overflow-style: none;
    padding: 4px 2px;
    scroll-snap-type: x mandatory;
}

.sd-tabs-scroll::-webkit-scrollbar { 
    display: none; 
}

/* Tab Buttons */
.sd-tab-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: #fff;
    border: 2px solid #e9ecef;
    border-radius: 30px;
    cursor: pointer;
    font-weight: 600;
    font-size: 0.85rem;
    color: #555;
    white-space: nowrap;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    flex-shrink: 0;
    scroll-snap-align: start;
    position: relative;
    overflow: hidden;
}

.sd-tab-btn:hover {
    border-color: #28a745;
    color: #28a745;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(40,167,69,0.15);
}

.sd-tab-btn.active {
    background: linear-gradient(135deg, #0056b3, #28a745);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 6px 25px rgba(0,86,179,0.35);
    transform: translateY(-1px);
}

/* Pulse animation for active tab */
@keyframes tabPulse {
    0%, 100% { box-shadow: 0 6px 25px rgba(0,86,179,0.35); }
    50% { box-shadow: 0 6px 35px rgba(40,167,69,0.5); }
}

.sd-tab-btn.active {
    animation: tabPulse 2s infinite;
}

/* --- Content Card --- */
.sd-content-card { background: #fff; border-radius: 14px; overflow: hidden; margin-bottom: 20px; box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2; }

.sd-image-hero { position: relative; }
.sd-img-full { width: 100%; height: 300px; object-fit: cover; display: block; }
.sd-image-cta-overlay { position: absolute; bottom: 0; left: 0; right: 0; padding: 40px 25px 20px; background: linear-gradient(transparent, rgba(0,0,0,0.7)); }
.sd-badge-large { background: #28a745; color: #fff; padding: 5px 14px; border-radius: 4px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }

.sd-content-body { padding: 25px; }

.sd-section-title { font-size: clamp(1.3rem, 2.5vw, 1.6rem); font-weight: 800; color: #0a1628; margin: 0 0 15px; line-height: 1.3; }

.sd-description { font-size: 0.92rem; color: #666; line-height: 1.8; margin-bottom: 15px; }

.sd-read-more {
    background: none; border: none; color: #0056b3; font-weight: 700; cursor: pointer;
    padding: 0; font-size: 0.85rem; margin-bottom: 15px;
}
.sd-read-more:hover { color: #28a745; }

/* Mid CTA */
.sd-mid-cta { margin: 20px 0; }
.sd-mid-cta-inner {
    display: flex; align-items: center; gap: 15px; background: #f0f7ff;
    border-radius: 12px; padding: 18px 20px; border: 2px dashed #0056b3;
}
.sd-mid-cta-icon { font-size: 1.8rem; color: #0056b3; }
.sd-mid-cta-inner strong { display: block; font-size: 0.9rem; color: #0a1628; }
.sd-mid-cta-inner span { font-size: 0.78rem; color: #888; }
.sd-mid-cta-inner .sd-btn { margin-left: auto; flex-shrink: 0; }

/* Features Grid */
.sd-features-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 20px; }

.sd-feature-item-card {
    display: flex; align-items: flex-start; gap: 10px; background: #f8faf9;
    padding: 14px; border-radius: 10px; font-size: 0.85rem; color: #555;
}
.sd-feature-item-card i { color: #28a745; font-size: 1.1rem; margin-top: 1px; flex-shrink: 0; }

/* --- Accordion --- */
.sd-accordion-item { border: 1px solid #eef0f2; border-radius: 10px; margin-bottom: 10px; overflow: hidden; }
.sd-accordion-item.active { border-color: #28a745; }

.sd-accordion-header {
    width: 100%; display: flex; align-items: center; justify-content: space-between;
    padding: 15px 18px; background: #fff; border: none; cursor: pointer;
    font-weight: 700; font-size: 0.92rem; color: #0a1628; text-align: left;
    transition: all 0.3s;
}
.sd-accordion-item.active .sd-accordion-header { background: #f0faf3; color: #28a745; }

.sd-accordion-arrow { transition: transform 0.3s; }
.sd-accordion-item.active .sd-accordion-arrow { transform: rotate(180deg); color: #28a745; }

.sd-accordion-body { padding: 0 18px 18px; }
.sd-accordion-body p { font-size: 0.87rem; color: #666; line-height: 1.7; margin-bottom: 10px; }

.sd-accordion-list { list-style: none; padding: 0; margin: 0; }
.sd-accordion-list li { display: flex; align-items: flex-start; gap: 8px; padding: 5px 0; font-size: 0.84rem; color: #555; }
.sd-accordion-list li i { color: #28a745; margin-top: 3px; flex-shrink: 0; }

/* --- Sidebar --- */
.sd-sidebar { position: sticky; top: 20px; }

.sd-sidebar-card {
    background: #fff; border-radius: 12px; padding: 20px; margin-bottom: 15px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
}

.sd-sidebar-cta {
    text-align: center; background: linear-gradient(135deg, #0056b3, #003d80); color: #fff;
    border: none;
}
.sd-sidebar-cta .sd-sidebar-icon { font-size: 2rem; margin-bottom: 10px; display: block; }
.sd-sidebar-cta h4 { font-size: 1.1rem; font-weight: 800; margin: 0 0 5px; }
.sd-sidebar-cta p { font-size: 0.8rem; opacity: 0.8; margin-bottom: 15px; }

.sd-sidebar-title { font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #888; margin: 0 0 12px; }

.sd-contact-item {
    display: flex; align-items: center; gap: 10px; padding: 10px 0; text-decoration: none;
    color: #555; font-size: 0.85rem; border-bottom: 1px solid #f5f5f5; transition: all 0.2s;
}
.sd-contact-item:last-child { border-bottom: none; }
.sd-contact-item:hover { color: #28a745; }
.sd-contact-item i { width: 20px; color: #28a745; text-align: center; }

.sd-service-areas { display: flex; flex-wrap: wrap; gap: 6px; }
.sd-area-tag { background: #f0f7ff; color: #0056b3; padding: 4px 10px; border-radius: 4px; font-size: 0.75rem; font-weight: 600; }

.sd-download-link {
    display: flex; align-items: center; gap: 10px; text-decoration: none; color: #dc3545;
    font-weight: 600; font-size: 0.85rem; transition: all 0.2s;
}
.sd-download-link:hover { color: #a71d2a; }
.sd-download-link i:last-child { margin-left: auto; }

.sd-sidebar-trust { display: flex; flex-direction: column; gap: 8px; }
.sd-trust-mini {
    display: flex; align-items: center; gap: 8px; padding: 10px 14px; background: #fff;
    border-radius: 8px; font-size: 0.78rem; font-weight: 600; color: #0a1628;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04); border: 1px solid #eef0f2;
}
.sd-trust-mini i { color: #28a745; }

/* --- Final CTA --- */
.sd-final-cta { padding: 60px 0; background: #fff; }
.sd-final-cta h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 10px; }
.sd-final-cta p { font-size: 1rem; color: #666; max-width: 500px; margin: 0 auto 20px; }
.sd-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

/* --- States --- */
.sd-state-box { text-align: center; padding: 50px 20px; }
.sd-error-card { max-width: 450px; margin: 0 auto; padding: 35px 25px; background: #fff; border-radius: 14px; box-shadow: 0 5px 30px rgba(0,0,0,0.08); text-align: center; }
.sd-empty-icon { width: 80px; height: 80px; margin: 0 auto; background: rgba(40,167,69,0.08); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.2rem; color: #28a745; }

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 1199.98px) {
    .sd-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .sd-trust-card:nth-child(2) { border-right: none; }
}

@media (max-width: 991.98px) {
    .sd-hero { padding: 50px 0 40px; min-height: auto; }
    .sd-hero-title { font-size: 1.7rem; }
    .sd-mid-cta-inner { flex-wrap: wrap; }
    .sd-mid-cta-inner .sd-btn { margin-left: 0; width: 100%; }
    .sd-sidebar { position: static; margin-top: 20px; }
}

@media (max-width: 767.98px) {
    .sd-hero { padding: 40px 0; }
    .sd-hero-title { font-size: 1.4rem; }
    .sd-hero-subtitle { font-size: 0.9rem; }
    .sd-hero-cta { flex-direction: column; }
    .sd-hero-cta .sd-btn { width: 100%; justify-content: center; }
    .sd-hero-trust { gap: 12px; }
    .sd-trust-item { font-size: 0.7rem; }
    .sd-trust-grid { grid-template-columns: 1fr 1fr; }
    .sd-trust-card { padding: 14px; gap: 8px; }
    .sd-features-grid { grid-template-columns: 1fr; }
    .sd-img-full { height: 220px; }
    .sd-content-body { padding: 18px; }
    
    /* Mobile Tabs */
    .sd-tabs-arrow {
        width: 34px;
        height: 34px;
    }
    .sd-tabs-arrow i {
        font-size: 0.8rem;
    }
    .sd-tab-btn {
        padding: 8px 14px;
        font-size: 0.78rem;
        gap: 6px;
    }
    .sd-tab-btn i {
        font-size: 0.9rem;
    }
}

@media (max-width: 575.98px) {
    .sd-hero { padding: 30px 0; }
    .sd-hero-title { font-size: 1.2rem; }
    .sd-breadcrumb { font-size: 0.7rem; }
    .sd-hero-badge { font-size: 0.7rem; padding: 5px 10px; }
    .sd-trust-grid { grid-template-columns: 1fr 1fr; gap: 0; }
    .sd-trust-card { padding: 12px 10px; border-right: 1px solid #f0f0f0; border-bottom: 1px solid #f0f0f0; }
    .sd-trust-card:nth-child(even) { border-right: none; }
    .sd-trust-icon { width: 34px; height: 34px; min-width: 34px; font-size: 0.9rem; }
    .sd-trust-card strong { font-size: 0.9rem; }
    .sd-trust-card span { font-size: 0.68rem; }
    .sd-img-full { height: 180px; }
    .sd-content-body { padding: 14px; }
    .sd-section-title { font-size: 1.15rem; }
    .sd-description { font-size: 0.84rem; }
    
    /* Mobile Tabs */
    .sd-tabs-container {
        gap: 4px;
    }
    .sd-tabs-arrow {
        width: 30px;
        height: 30px;
    }
    .sd-tabs-arrow-left {
        margin-right: 4px;
    }
    .sd-tabs-arrow-right {
        margin-left: 4px;
    }
    .sd-tab-btn {
        padding: 7px 12px;
        font-size: 0.74rem;
        border-radius: 25px;
    }
    
    .sd-accordion-header { padding: 12px 14px; font-size: 0.85rem; }
    .sd-final-cta { padding: 40px 0; }
    .sd-final-cta-buttons { flex-direction: column; }
    .sd-final-cta-buttons .sd-btn { width: 100%; justify-content: center; }
    body { padding-bottom: 55px; } /* Space for mobile sticky CTA */
}
</style>
@endpush


@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('tabsSlider', () => ({
        canScrollLeft: false,
        canScrollRight: true,
        
        init() {
            this.$nextTick(() => {
                this.checkArrows();
                this.scrollToActiveTab();
            });
            
            // Watch for tab changes
            this.$watch('$wire.activeServiceId', () => {
                this.$nextTick(() => {
                    this.scrollToActiveTab();
                });
            });
            
            // Listen for scroll events
            const container = this.$refs.tabsScroll;
            if (container) {
                container.addEventListener('scroll', () => {
                    this.checkArrows();
                });
            }
        },
        
        scrollTabs(direction) {
            const container = this.$refs.tabsScroll;
            if (!container) return;
            
            const scrollAmount = 250;
            const targetScroll = direction === 'left' 
                ? container.scrollLeft - scrollAmount 
                : container.scrollLeft + scrollAmount;
            
            container.scrollTo({
                left: Math.max(0, targetScroll),
                behavior: 'smooth'
            });
            
            setTimeout(() => this.checkArrows(), 350);
        },
        
        scrollToActiveTab() {
            const container = this.$refs.tabsScroll;
            if (!container) return;
            
            const activeTab = container.querySelector('.sd-tab-btn.active');
            if (activeTab) {
                const containerWidth = container.offsetWidth;
                const tabLeft = activeTab.offsetLeft;
                const tabWidth = activeTab.offsetWidth;
                
                // Center the active tab
                const scrollPosition = tabLeft - (containerWidth / 2) + (tabWidth / 2);
                
                container.scrollTo({
                    left: Math.max(0, scrollPosition),
                    behavior: 'smooth'
                });
                
                setTimeout(() => this.checkArrows(), 350);
            }
        },
        
        checkArrows() {
            const container = this.$refs.tabsScroll;
            if (!container) return;
            
            const tolerance = 5; // pixels of tolerance
            this.canScrollLeft = container.scrollLeft > tolerance;
            this.canScrollRight = container.scrollLeft < (container.scrollWidth - container.offsetWidth - tolerance);
        }
    }));
});

// Livewire navigated event
document.addEventListener('livewire:navigated', function() {
    const scrollContainer = document.getElementById('sdTabsScroll');
    if (!scrollContainer) return;
    
    const activeTab = scrollContainer.querySelector('.sd-tab-btn.active');
    if (activeTab) {
        setTimeout(() => {
            activeTab.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'nearest', 
                inline: 'center' 
            });
        }, 100);
    }
});

// Touch swipe support for tabs
document.addEventListener('DOMContentLoaded', function() {
    const tabsScroll = document.getElementById('sdTabsScroll');
    if (!tabsScroll) return;
    
    let isDown = false;
    let startX;
    let scrollLeft;
    
    tabsScroll.addEventListener('mousedown', (e) => {
        isDown = true;
        startX = e.pageX - tabsScroll.offsetLeft;
        scrollLeft = tabsScroll.scrollLeft;
    });
    
    tabsScroll.addEventListener('mouseleave', () => {
        isDown = false;
    });
    
    tabsScroll.addEventListener('mouseup', () => {
        isDown = false;
    });
    
    tabsScroll.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - tabsScroll.offsetLeft;
        const walk = (x - startX) * 2;
        tabsScroll.scrollLeft = scrollLeft - walk;
    });
});
</script>
@endpush