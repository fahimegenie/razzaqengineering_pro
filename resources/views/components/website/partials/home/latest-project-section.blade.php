<!-- ============================================
     PROFESSIONAL PROJECTS SLIDER - FIXED
     ============================================ -->
<section class="projects-section-pro" id="projectsSection">
    <div class="container">
        
        {{-- Section Header --}}
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="section-tag">OUR PORTFOLIO</span>
            <h2 class="section-heading">Latest <span class="text-gradient">Projects</span></h2>
            <p class="section-desc">Showcasing our recent work and engineering excellence across Pakistan</p>
        </div>
        
        {{-- Projects Slider --}}
        @if($pro->count() > 0)
            <div class="projects-slider-wrap" data-aos="fade-up">
                <div class="owl-carousel owl-theme projects-owl" id="projectsOwl">
                    
                    @foreach($pro as $project)
                        <div class="item">
                            <div class="project-card">
                                
                                {{-- Image --}}
                                <div class="project-card-img">
                                    <img src="{{ asset('p_image/'.$project->p_image) }}" 
                                         alt="{{ $project->p_title }}" 
                                         class="project-img"
                                         loading="lazy">
                                    
                                    {{-- Hover Overlay --}}
                                    <div class="project-card-overlay">
                                        <a href="{{ url('project/'.$project->p_id) }}" class="overlay-link">
                                            View Project <i class="fas fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                    
                                    {{-- Category --}}
                                    @if(!empty($project->p_category))
                                        <span class="project-tag">{{ $project->p_category }}</span>
                                    @endif
                                </div>
                                
                                {{-- Content --}}
                                <div class="project-card-body">
                                    <div class="project-date">
                                        <i class="far fa-calendar-alt me-1"></i> 
                                        {{ date("M Y", strtotime($project->p_created_at)) }}
                                    </div>
                                    <h4 class="project-name">
                                        <a href="{{ url('project/'.$project->p_id) }}">{{ Str::limit($project->p_title, 40) }}</a>
                                    </h4>
                                    <p class="project-desc">{{ Str::limit($project->p_description, 90) }}</p>
                                    
                                    @if(!empty($project->p_location))
                                        <div class="project-location">
                                            <i class="fas fa-map-marker-alt"></i> {{ $project->p_location }}
                                        </div>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
            
            {{-- View All --}}
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ url('projects') }}" class="btn-view-all">
                    View All Projects <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
            
        @else
            <div class="text-center py-5" data-aos="fade-up">
                <i class="fas fa-folder-open fa-3x text-muted opacity-25 mb-3"></i>
                <h4 class="fw-bold">No Projects Yet</h4>
                <p class="text-muted">Our portfolio is being updated.</p>
            </div>
        @endif
        
    </div>
</section>

{{-- CSS --}}
@push('styles')
<style>
    /* ============================================
       PROJECTS SECTION
       ============================================ */
    .projects-section-pro {
        padding: 80px 0;
        background: #f8f9fa;
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
    }
    
    /* ============================================
       SLIDER
       ============================================ */
    .projects-slider-wrap {
        margin: 0 -5px;
    }
    
    .projects-owl .owl-stage-outer {
        padding: 10px 0 20px;
    }
    
    .projects-owl .owl-item {
        padding: 0 8px;
    }
    
    /* ============================================
       PROJECT CARD
       ============================================ */
    .project-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 20px rgba(0,0,0,0.05);
        border: 1px solid #eef0f2;
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }
    
    .project-card-img {
        position: relative;
        height: 230px;
        overflow: hidden;
    }
    
    .project-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .project-card:hover .project-img {
        transform: scale(1.05);
    }
    
    .project-card-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,54,108,0.75);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .project-card:hover .project-card-overlay {
        opacity: 1;
    }
    
    .overlay-link {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.88rem;
        padding: 10px 24px;
        border: 2px solid #fff;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
    
    .overlay-link:hover {
        background: #28a745;
        border-color: #28a745;
        color: #fff;
    }
    
    .project-tag {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #0056b3;
        color: #fff;
        padding: 4px 12px;
        border-radius: 4px;
        font-size: 0.7rem;
        font-weight: 600;
        z-index: 2;
    }
    
    .project-card-body {
        padding: 18px;
    }
    
    .project-date {
        font-size: 0.75rem;
        color: #aaa;
        margin-bottom: 8px;
    }
    
    .project-name {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 6px;
        line-height: 1.4;
    }
    
    .project-name a {
        color: #0a1628;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .project-name a:hover {
        color: #0056b3;
    }
    
    .project-desc {
        font-size: 0.85rem;
        color: #888;
        line-height: 1.5;
        margin-bottom: 10px;
    }
    
    .project-location {
        font-size: 0.78rem;
        color: #888;
    }
    
    .project-location i {
        color: #dc3545;
        margin-right: 4px;
    }
    
    /* ============================================
       OWL NAVIGATION
       ============================================ */
    .projects-owl .owl-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 100%;
        left: 0;
        pointer-events: none;
        margin: 0;
    }
    
    .projects-owl .owl-nav button {
        position: absolute;
        width: 42px;
        height: 42px;
        background: #fff !important;
        border-radius: 50% !important;
        box-shadow: 0 3px 15px rgba(0,0,0,0.12) !important;
        font-size: 16px !important;
        color: #0056b3 !important;
        transition: all 0.3s ease;
        pointer-events: auto;
        margin: 0;
        display: flex !important;
        align-items: center;
        justify-content: center;
    }
    
    .projects-owl .owl-nav button:hover {
        background: #0056b3 !important;
        color: #fff !important;
    }
    
    .projects-owl .owl-prev { left: -21px; }
    .projects-owl .owl-next { right: -21px; }
    
    .projects-owl .owl-dots {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: 20px !important;
    }
    
    .projects-owl .owl-dot span {
        width: 8px;
        height: 8px;
        background: #d4d8dd !important;
        border-radius: 50%;
        transition: all 0.3s ease;
        margin: 0;
    }
    
    .projects-owl .owl-dot.active span {
        background: #0056b3 !important;
        width: 24px;
        border-radius: 10px;
    }
    
    /* ============================================
       VIEW ALL BUTTON
       ============================================ */
    .btn-view-all {
        display: inline-flex;
        align-items: center;
        padding: 13px 30px;
        background: #fff;
        color: #28a745;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
        border: 2px solid #28a745;
        transition: all 0.3s ease;
    }
    
    .btn-view-all:hover {
        background: #28a745;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40,167,69,0.25);
    }
    
    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 991.98px) {
        .projects-section-pro { padding: 60px 0; }
        .section-heading { font-size: 1.8rem; }
        .project-card-img { height: 210px; }
        .projects-owl .owl-prev { left: -10px; }
        .projects-owl .owl-next { right: -10px; }
    }
    
    @media (max-width: 767.98px) {
        .projects-section-pro { padding: 45px 0; }
        .section-heading { font-size: 1.5rem; }
        .project-card-img { height: 200px; }
        .project-card-body { padding: 14px; }
        .project-name { font-size: 0.9rem; }
        .projects-owl .owl-nav button { width: 36px; height: 36px; font-size: 14px !important; }
    }
    
    @media (max-width: 575.98px) {
        .projects-section-pro { padding: 35px 0; }
        .section-heading { font-size: 1.3rem; }
        .section-tag { font-size: 0.65rem; letter-spacing: 2px; }
        .project-card-img { height: 220px; }
        .btn-view-all { width: 100%; justify-content: center; }
    }
</style>
@endpush

{{-- Owl Script --}}
@push('scripts')
<script>
    $(document).ready(function() {
        $('#projectsOwl').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            smartSpeed: 500,
            navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 3 }
            }
        });
    });
</script>
@endpush