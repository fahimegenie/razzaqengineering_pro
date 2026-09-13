@push('styles')
<style>
    .hero-carousel .carousel-item {
        height: 650px;
        position: relative;
        overflow: hidden;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
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
    .carousel-fade .carousel-item {
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
    .carousel-fade .carousel-item.active {
        opacity: 1;
    }
    .hero-content {
        position: relative;
        z-index: 2;
    }
    .hero-title {
        animation: heroTitleReveal 1s ease;
    }
    @keyframes heroTitleReveal {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
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
    .backdrop-blur {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }
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
    .scroll-down-indicator {
        animation: scrollBounce 2s infinite;
    }
    @keyframes scrollBounce {
        0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
        40% { transform: translateX(-50%) translateY(-10px); }
        60% { transform: translateX(-50%) translateY(-5px); }
    }
    @media (max-width: 991.98px) {
        .hero-carousel .carousel-item { height: 550px; }
        .hero-content { text-align: center; }
        .hero-features .d-flex { justify-content: center; }
        .hero-buttons { justify-content: center; }
    }
    @media (max-width: 767.98px) {
        .hero-carousel .carousel-item { height: 500px; }
        .scroll-down-indicator { display: none; }
    }
</style>
@endpush

<div id="heroCarousel" class="carousel slide carousel-fade hero-carousel" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover">
    
    {{-- Carousel Indicators --}}
    <div class="carousel-indicators">
        @foreach($slider as $key => $value)
            <button type="button" 
                    data-bs-target="#heroCarousel" 
                    data-bs-slide-to="{{ $key }}" 
                    class="{{ $key == 0 ? 'active' : '' }}" 
                    aria-label="Slide {{ $key + 1 }}"
                    style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #fff; background: {{ $key == 0 ? '#28a745' : 'transparent' }};">
            </button>
        @endforeach
    </div>
    
    {{-- Carousel Slides --}}
    <div class="carousel-inner">
        @foreach($slider as $key => $value)
            @php 
                // Handle both array and object formats safely
                $isArr = is_array($value);
                $imageUrl = $isArr ? ($value['image_url'] ?? '') : $value->image_url;
                $sTitle = $isArr ? ($value['s_title'] ?? '') : $value->s_title;
                $sDescription = $isArr ? ($value['s_description'] ?? '') : $value->s_description;
                $sT1 = $isArr ? ($value['s_t1'] ?? '') : $value->s_t1;
                $sT2 = $isArr ? ($value['s_t2'] ?? '') : $value->s_t2;
                $sT3 = $isArr ? ($value['s_t3'] ?? '') : $value->s_t3;
                $sVideo = $isArr ? ($value['s_video'] ?? '') : $value->s_video;
                $videoUrl = $isArr ? ($value['video_url'] ?? '') : $value->video_url;
            @endphp

            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" 
                 style="background-image: url('{{ $imageUrl }}');">
                
                {{-- Gradient Overlay --}}
                <div class="hero-overlay" style="
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(135deg, rgba(0,54,108,0.85) 0%, rgba(0,54,108,0.4) 50%, rgba(40,167,69,0.75) 100%);
                    z-index: 1;
                "></div>
                
                {{-- Caption Content --}}
                <div class="container position-relative h-100" style="z-index: 2;">
                    <div class="row align-items-center h-100">
                        <div class="col-lg-7 col-md-9">
                            <div class="hero-content py-5">
                                
                                <span class="badge bg-gradient-success px-4 py-2 rounded-pill mb-3 fs-6 fw-semibold" 
                                      style="background: linear-gradient(135deg, #28a745, #0056b3); letter-spacing: 1px;">
                                    <i class="fas fa-check-circle me-2"></i> We are available for
                                </span>
                                
                                <h1 class="text-white fw-bold display-3 mb-3 hero-title" 
                                    style="text-shadow: 2px 4px 12px rgba(0,0,0,0.3); line-height: 1.2;">
                                    {{ $sTitle }}
                                </h1>
                                
                                @if($sDescription)
                                    <p class="text-white opacity-90 lead mb-4"
                                       style="max-width: 600px; font-size: 1.1rem; line-height: 1.8;">
                                        {{ Str::limit($sDescription, 250) }}
                                    </p>
                                @endif
                                
                                @if($sT1 || $sT2 || $sT3)
                                    <div class="hero-features mb-4">
                                        <div class="d-flex flex-wrap gap-3">
                                            @if($sT1)
                                                <div class="feature-item d-flex align-items-center bg-white bg-opacity-10 rounded-pill px-4 py-2 backdrop-blur">
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    <span class="text-white fw-medium">{{ $sT1 }}</span>
                                                </div>
                                            @endif
                                            @if($sT2)
                                                <div class="feature-item d-flex align-items-center bg-white bg-opacity-10 rounded-pill px-4 py-2 backdrop-blur">
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    <span class="text-white fw-medium">{{ $sT2 }}</span>
                                                </div>
                                            @endif
                                            @if($sT3)
                                                <div class="feature-item d-flex align-items-center bg-white bg-opacity-10 rounded-pill px-4 py-2 backdrop-blur">
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    <span class="text-white fw-medium">{{ $sT3 }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="hero-buttons d-flex flex-wrap gap-3">
                                    <a href="{{ route('quote.index') }}" 
                                       class="btn btn-gradient btn-lg fw-bold px-5 py-3 rounded-pill shadow-lg d-flex align-items-center gap-2"
                                       style="background: linear-gradient(135deg, #28a745, #0056b3); border: none; font-size: 1.05rem;">
                                        <i class="fas fa-paper-plane"></i> Get a Free Quote
                                        <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                    
                                    <a href="tel:+923048902805" 
                                       class="btn btn-outline-light btn-lg fw-semibold px-5 py-3 rounded-pill d-flex align-items-center gap-2"
                                       style="border: 2px solid rgba(255,255,255,0.5);">
                                        <i class="fas fa-phone-alt"></i> Call Now
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center">
                            <div class="hero-illustration">
                                @if(!empty($sVideo))
                                    <div class="hero-video-wrapper rounded-4 overflow-hidden shadow-lg" 
                                         style="border: 4px solid rgba(255,255,255,0.2);">
                                        <video autoplay muted loop playsinline class="w-100 rounded-3" style="max-height: 350px;">
                                            <source src="{{ $videoUrl }}" type="video/mp4">
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
    
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"
            style="width: 60px; height: 60px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.3); border-radius: 50%; margin-left: 20px; backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3);">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"
            style="width: 60px; height: 60px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.3); border-radius: 50%; margin-right: 20px; backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3);">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</div>