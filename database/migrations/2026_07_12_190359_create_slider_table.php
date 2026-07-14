<!-- ============================================
     PROFESSIONAL DYNAMIC HERO CAROUSEL
     ============================================ -->
@php
    // Filter and prepare sliders
    $sliders = $slider->filter(function($slide) {
        // Check if slider is active
        if (!$slide->is_active) return false;
        
        // Check scheduling
        $now = now();
        if ($slide->start_date && $now->lt($slide->start_date)) return false;
        if ($slide->end_date && $now->gt($slide->end_date)) return false;
        
        return true;
    })->sortBy('sort_order')->values();
    
    // If no valid sliders, don't render the carousel
    if ($sliders->isEmpty()) return;
    
    // Get carousel settings from first slider or use defaults
    $carouselDuration = $sliders->first()->slide_duration ?? 5000;
    $animationType = $sliders->first()->animation_type ?? 'fade';
    $carouselClass = $animationType === 'fade' ? 'carousel-fade' : '';
@endphp

<div id="heroCarousel" 
     class="carousel slide {{ $carouselClass }} hero-carousel" 
     data-bs-ride="carousel" 
     data-bs-interval="{{ $carouselDuration }}" 
     data-bs-pause="hover">
    
    {{-- Carousel Indicators (Only show if more than 1 slide) --}}
    @if($sliders->count() > 1)
    <div class="carousel-indicators">
        @foreach($sliders as $key => $slide)
            <button type="button" 
                    data-bs-target="#heroCarousel" 
                    data-bs-slide-to="{{ $key }}" 
                    class="{{ $key == 0 ? 'active' : '' }}" 
                    aria-label="Slide {{ $key + 1 }}"
                    style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #fff; background: {{ $key == 0 ? '#28a745' : 'transparent' }};">
            </button>
        @endforeach
    </div>
    @endif
    
    {{-- Carousel Slides --}}
    <div class="carousel-inner">
        @foreach($sliders as $key => $slide)
            @php
                // Determine background settings
                $bgImage = $slide->s_image ? asset('slider_image/'.$slide->s_image) : '';
                $mobileImage = $slide->s_mobile_image ? asset('slider_image/'.$slide->s_mobile_image) : $bgImage;
                $bgColor = $slide->background_color ?? 'transparent';
                $bgPosition = $slide->background_position ?? 'center';
                $bgSize = $slide->background_size ?? 'cover';
                
                // Overlay settings
                $overlayColor = $slide->overlay_color ?? 'rgba(0,54,108,0.85)';
                $overlayOpacity = ($slide->overlay_opacity ?? 50) / 100;
                
                // Parse overlay color to apply opacity
                if (strpos($overlayColor, 'rgba') === false && strpos($overlayColor, 'rgb') === false) {
                    // Convert hex to rgba with opacity
                    $hex = ltrim($overlayColor, '#');
                    if (strlen($hex) == 6) {
                        $r = hexdec(substr($hex, 0, 2));
                        $g = hexdec(substr($hex, 2, 2));
                        $b = hexdec(substr($hex, 4, 2));
                        $overlayColor = "rgba($r, $g, $b, $overlayOpacity)";
                    }
                }
                
                // Text settings
                $textColor = $slide->text_color ?? '#ffffff';
                $textPositionClass = 'text-' . ($slide->text_position ?? 'left');
                
                // Determine if slider type is video
                $isVideo = $slide->slider_type === 'video' && $slide->s_video;
                
                // Build style array for carousel item
                $itemStyles = [];
                if ($bgImage) {
                    $itemStyles[] = "background-image: url('{$bgImage}')";
                }
                if ($bgColor && $bgColor !== 'transparent') {
                    $itemStyles[] = "background-color: {$bgColor}";
                }
                $itemStyles[] = "background-position: {$bgPosition}";
                $itemStyles[] = "background-size: {$bgSize}";
                $itemStyles[] = "background-repeat: no-repeat";
                $itemStyles[] = "min-height: 650px";
                
                // Button configurations
                $btn1Text = $slide->button_text ?? 'Get a Free Quote';
                $btn1Link = $slide->button_link ?? route('quote.index');
                $btn1Target = $slide->button_target ?? '_self';
                
                $btn2Text = $slide->button2_text ?? 'Call Now';
                $btn2Link = $slide->button2_link ?? 'tel:+923048902805';
                $btn2Target = $slide->button2_target ?? '_self';
                
                // Show on mobile/desktop classes
                $visibilityClasses = [];
                if (!$slide->show_on_mobile) $visibilityClasses[] = 'd-none d-md-block';
                if (!$slide->show_on_desktop) $visibilityClasses[] = 'd-md-none';
                $visibilityClass = implode(' ', $visibilityClasses);
            @endphp
            
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }} {{ $visibilityClass }}"
                 style="{{ implode('; ', $itemStyles) }};"
                 data-mobile-image="{{ $mobileImage }}"
                 data-desktop-image="{{ $bgImage }}">
                
                {{-- Video Background --}}
                @if($isVideo)
                    <video autoplay muted loop playsinline 
                           class="position-absolute top-0 start-0 w-100 h-100" 
                           style="object-fit: cover; z-index: 0;">
                        <source src="{{ asset('slider_image/'.$slide->s_video) }}" type="video/mp4">
                    </video>
                @endif
                
                {{-- Gradient Overlay --}}
                @php
                    // Create gradient overlay
                    $overlayStyle = "position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;";
                    
                    if ($overlayColor) {
                        // Extract base color for gradient
                        $baseColor = $overlayColor;
                        $lightColor = str_replace('0.85', '0.4', $overlayColor);
                        $accentColor = str_replace('0.85', '0.75', $overlayColor);
                        
                        // If it's the default blue, use green accent
                        if (strpos($overlayColor, '0,54,108') !== false) {
                            $overlayStyle .= "background: linear-gradient(135deg, {$overlayColor} 0%, rgba(0,54,108,0.4) 50%, rgba(40,167,69,0.75) 100%);";
                        } else {
                            $overlayStyle .= "background: linear-gradient(135deg, {$baseColor} 0%, {$lightColor} 50%, {$accentColor} 100%);";
                        }
                    } else {
                        $overlayStyle .= "background: linear-gradient(135deg, rgba(0,54,108,0.85) 0%, rgba(0,54,108,0.4) 50%, rgba(40,167,69,0.75) 100%);";
                    }
                @endphp
                
                <div class="hero-overlay" style="{{ $overlayStyle }}"></div>
                
                {{-- Caption Content --}}
                <div class="container position-relative h-100" style="z-index: 2;">
                    <div class="row align-items-center h-100 {{ $textPositionClass === 'text-center' ? 'justify-content-center' : '' }} {{ $textPositionClass === 'text-right' ? 'justify-content-end' : '' }}">
                        <div class="col-lg-7 col-md-9">
                            <div class="hero-content py-5">
                                
                                {{-- Badge --}}
                                @if($slide->s_badge_text)
                                    <span class="badge bg-gradient-success px-4 py-2 rounded-pill mb-3 fs-6 fw-semibold animate__animated animate__fadeInDown" 
                                          style="background: linear-gradient(135deg, #28a745, #0056b3); letter-spacing: 1px;">
                                        <i class="fas fa-check-circle me-2"></i> {{ $slide->s_badge_text }}
                                    </span>
                                @endif
                                
                                {{-- Subtitle (Above Title) --}}
                                @if($slide->s_subtitle)
                                    <h6 class="text-white opacity-75 mb-2 animate__animated animate__fadeInDown" 
                                        style="letter-spacing: 2px; text-transform: uppercase;">
                                        {{ $slide->s_subtitle }}
                                    </h6>
                                @endif
                                
                                {{-- Title --}}
                                @if($slide->s_title)
                                    <h1 class="text-white fw-bold display-3 mb-3 hero-title animate__animated animate__fadeInUp" 
                                        style="text-shadow: 2px 4px 12px rgba(0,0,0,0.3); line-height: 1.2; color: {{ $textColor }} !important;">
                                        {{ $slide->s_title }}
                                    </h1>
                                @endif
                                
                                {{-- Description --}}
                                @if($slide->s_description)
                                    <p class="text-white opacity-90 lead mb-4 animate__animated animate__fadeInUp animate__delay-1s"
                                       style="max-width: 600px; font-size: 1.1rem; line-height: 1.8; color: {{ $textColor }} !important;">
                                        {{ Str::limit($slide->s_description, 250) }}
                                    </p>
                                @endif
                                
                                {{-- Feature Points --}}
                                @if($slide->s_t1 || $slide->s_t2 || $slide->s_t3)
                                    <div class="hero-features mb-4 animate__animated animate__fadeInUp animate__delay-2s">
                                        <div class="d-flex flex-wrap gap-3">
                                            @foreach([$slide->s_t1, $slide->s_t2, $slide->s_t3] as $feature)
                                                @if($feature)
                                                    <div class="feature-item d-flex align-items-center bg-white bg-opacity-10 rounded-pill px-4 py-2 backdrop-blur">
                                                        <i class="fas fa-check-circle text-success me-2"></i>
                                                        <span class="text-white fw-medium">{{ $feature }}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                
                                {{-- CTA Buttons --}}
                                @if($btn1Text || $btn2Text)
                                    <div class="hero-buttons d-flex flex-wrap gap-3 animate__animated animate__fadeInUp animate__delay-3s">
                                        @if($btn1Text)
                                            @php
                                                // Determine button 1 style based on whether button 2 exists
                                                $btn1Style = $btn2Text 
                                                    ? "background: linear-gradient(135deg, #28a745, #0056b3); border: none;"
                                                    : "background: linear-gradient(135deg, #28a745, #0056b3); border: none;";
                                            @endphp
                                            <a href="{{ $btn1Link }}" 
                                               target="{{ $btn1Target }}"
                                               class="btn btn-gradient btn-lg fw-bold px-5 py-3 rounded-pill shadow-lg d-flex align-items-center gap-2"
                                               style="{{ $btn1Style }} font-size: 1.05rem; transition: all 0.3s ease;"
                                               onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 30px rgba(40,167,69,0.4)';"
                                               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(40,167,69,0.3)';">
                                                <i class="fas fa-paper-plane"></i> {{ $btn1Text }}
                                                @if($slide->external_link)
                                                    <i class="fas fa-external-link-alt ms-2"></i>
                                                @else
                                                    <i class="fas fa-arrow-right ms-2"></i>
                                                @endif
                                            </a>
                                        @endif
                                        
                                        @if($btn2Text)
                                            <a href="{{ $btn2Link }}" 
                                               target="{{ $btn2Target }}"
                                               class="btn btn-outline-light btn-lg fw-semibold px-5 py-3 rounded-pill d-flex align-items-center gap-2"
                                               style="border: 2px solid rgba(255,255,255,0.5); transition: all 0.3s ease;"
                                               onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.borderColor='#fff';"
                                               onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(255,255,255,0.5)';">
                                                <i class="fas fa-phone-alt"></i> {{ $btn2Text }}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Right Side - Optional Video --}}
                        <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center">
                            <div class="hero-illustration animate__animated animate__fadeInRight animate__delay-1s">
                                @if($isVideo && !$slide->s_video)
                                    {{-- Video is used as background, show nothing here --}}
                                @elseif($slide->s_video)
                                    <div class="hero-video-wrapper rounded-4 overflow-hidden shadow-lg" 
                                         style="border: 4px solid rgba(255,255,255,0.2);">
                                        <video autoplay muted loop playsinline class="w-100 rounded-3" style="max-height: 350px;">
                                            <source src="{{ asset('slider_image/'.$slide->s_video) }}" type="video/mp4">
                                        </video>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    {{-- Navigation Arrows (Only show if more than 1 slide) --}}
    @if($sliders->count() > 1)
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
    @endif
    
    {{-- Scroll Down Indicator --}}
    <div class="scroll-down-indicator position-absolute bottom-0 start-50 translate-middle-x mb-4 text-center animate__animated animate__bounce animate__infinite animate__delay-5s" 
         style="z-index: 3; cursor: pointer;"
         onclick="scrollToSection();">
        <span class="text-white opacity-75 small d-block mb-2">Scroll Down</span>
        <i class="fas fa-chevron-down text-white opacity-75 fs-5"></i>
    </div>
</div>

{{-- Custom CSS for Hero --}}
@push('styles')
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
    
    /* Video Background */
    .hero-carousel .carousel-item video {
        min-width: 100%;
        min-height: 100%;
        object-fit: cover;
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
@endpush

{{-- JavaScript for Dynamic Mobile Image Switching and Tracking --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const heroCarousel = document.getElementById('heroCarousel');
    if (!heroCarousel) return;
    
    // Function to handle responsive images
    function handleResponsiveImages() {
        const isMobile = window.innerWidth < 768;
        const activeItem = heroCarousel.querySelector('.carousel-item.active');
        if (!activeItem) return;
        
        const mobileImage = activeItem.dataset.mobileImage;
        const desktopImage = activeItem.dataset.desktopImage;
        
        if (isMobile && mobileImage) {
            activeItem.style.backgroundImage = `url('${mobileImage}')`;
        } else if (!isMobile && desktopImage) {
            activeItem.style.backgroundImage = `url('${desktopImage}')`;
        }
    }
    
    // Handle responsive images on load and resize
    handleResponsiveImages();
    window.addEventListener('resize', handleResponsiveImages);
    
    // Handle responsive images on slide change
    heroCarousel.addEventListener('slide.bs.carousel', function(e) {
        setTimeout(handleResponsiveImages, 100);
    });
    
    // Tracking code support
    @foreach($sliders as $slide)
        @if($slide->tracking_code)
            // Tracking for slide {{ $loop->index }}
            heroCarousel.addEventListener('slid.bs.carousel', function(e) {
                if (e.to === {{ $loop->index }}) {
                    {!! $slide->tracking_code !!}
                }
            });
        @endif
    @endforeach
});

// Scroll down function
function scrollToSection() {
    const aboutSection = document.getElementById('aboutSection');
    if (aboutSection) {
        aboutSection.scrollIntoView({behavior: 'smooth'});
    } else {
        window.scrollBy({
            top: window.innerHeight,
            behavior: 'smooth'
        });
    }
}
</script>
@endpush