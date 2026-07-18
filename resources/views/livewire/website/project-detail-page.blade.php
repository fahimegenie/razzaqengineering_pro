<div class="pdp-wrapper"
     x-data="{
        galleryOpen: @entangle('activeGalleryImage'),
        
        openGallery(index) { $wire.openGallery(index); },
        closeGallery() { $wire.closeGallery(); },
        nextImage() { $wire.nextGalleryImage(); },
        prevImage() { $wire.prevGalleryImage(); }
     }">
    
    <!-- ============================================
         HERO
         ============================================ -->
    <section class="pdp-hero" wire:ignore>
        <div class="container pdp-hero-content">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="pdp-breadcrumb">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li><a href="{{ url('projects') }}">Projects</a></li>
                            @if($project && $project->category)
                                <li><a href="{{ url('projects?category='.$project->pc_id) }}">{{ $project->category->pc_name }}</a></li>
                            @endif
                            <li class="active">{{ $project->p_title ?? 'Project Details' }}</li>
                        </ol>
                    </nav>
                    <h1 class="pdp-hero-title">{{ $project->p_title ?? 'Project Details' }}</h1>
                    <p class="pdp-hero-subtitle">{{ $project->p_short_description ?? '' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         CONTENT
         ============================================ -->
    <section class="pdp-section">
        <div class="container">
            
            {{-- Loading --}}
            @if($isLoading)
                <div class="text-center py-5" wire:key="pdp-loading">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-2">Loading project details...</p>
                </div>
                
            {{-- Error --}}
            @elseif($errorMessage)
                <div class="alert alert-danger text-center rounded-3 border-0 shadow-sm" wire:key="pdp-error">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ $errorMessage }}
                    <a href="{{ url('projects') }}" class="btn btn-outline-danger btn-sm ms-3 rounded-pill">
                        <i class="fas fa-arrow-left me-1"></i> Back to Projects
                    </a>
                </div>
                
            {{-- Content --}}
            @elseif($project)
                <div wire:key="pdp-content-{{ $project->id }}">
                    
                    {{-- Project Info Bar --}}
                    <div class="pdp-info-bar" data-aos="fade-up" wire:ignore.self>
                        <div class="row g-3">
                            @if($project->category)
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="pdp-info-item">
                                        <span class="pdp-info-label">Category</span>
                                        <span class="pdp-info-value">{{ $project->category->pc_name }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($project->p_status)
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="pdp-info-item">
                                        <span class="pdp-info-label">Status</span>
                                        <span class="pdp-info-value">
                                            <span class="status-badge status-{{ $project->p_status }}">{{ ucfirst($project->p_status) }}</span>
                                        </span>
                                    </div>
                                </div>
                            @endif
                            @if($project->p_location)
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="pdp-info-item">
                                        <span class="pdp-info-label">Location</span>
                                        <span class="pdp-info-value">{{ $project->p_location }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($project->p_client)
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="pdp-info-item">
                                        <span class="pdp-info-label">Client</span>
                                        <span class="pdp-info-value">{{ $project->p_client }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($project->p_start_date)
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="pdp-info-item">
                                        <span class="pdp-info-label">Start Date</span>
                                        <span class="pdp-info-value">{{ $project->p_start_date->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($project->p_end_date)
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="pdp-info-item">
                                        <span class="pdp-info-label">End Date</span>
                                        <span class="pdp-info-value">{{ $project->p_end_date->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($project->duration)
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="pdp-info-item">
                                        <span class="pdp-info-label">Duration</span>
                                        <span class="pdp-info-value">{{ $project->duration }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Main Content + Sidebar --}}
                    <div class="row g-5 mt-3">
                        
                        {{-- Left: Main Content --}}
                        <div class="col-lg-8" data-aos="fade-up">
                            
                            {{-- Main Image --}}
                            <div class="pdp-main-image" wire:ignore>
                                <img src="{{ $project->image_url }}" 
                                     alt="{{ $project->p_title }}" 
                                     class="img-fluid rounded-3 shadow-sm" 
                                     loading="lazy">
                                @if(count($galleryImages) > 0)
                                    <button class="pdp-gallery-btn" @click="openGallery(0)">
                                        <i class="fas fa-images me-2"></i> View Gallery ({{ count($galleryImages) }})
                                    </button>
                                @endif
                            </div>
                            
                            {{-- Description --}}
                            <div class="pdp-description mt-4">
                                <h3 class="pdp-section-title">Project Description</h3>
                                <div class="pdp-text">
                                    {!! nl2br(e($project->p_description)) !!}
                                </div>
                            </div>
                            
                            {{-- Gallery Grid --}}
                            @if(count($galleryImages) > 0)
                                <div class="pdp-gallery-grid mt-4" wire:ignore>
                                    <h3 class="pdp-section-title">Project Gallery</h3>
                                    <div class="row g-3">
                                        @foreach($galleryImages as $index => $img)
                                            <div class="col-lg-4 col-md-6">
                                                <div class="pdp-gallery-item" @click="openGallery({{ $index }})" style="cursor:pointer;">
                                                    <img src="{{ asset('p_image/'.$img) }}" 
                                                         alt="Gallery Image {{ $index + 1 }}" 
                                                         class="img-fluid rounded-3" loading="lazy">
                                                    <div class="pdp-gallery-overlay">
                                                        <i class="fas fa-search-plus"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                        </div>
                        
                        {{-- Right: Sidebar --}}
                        <div class="col-lg-4" data-aos="fade-left">
                            
                            {{-- Quick Quote --}}
                            <div class="pdp-sidebar-card mb-4">
                                <h5 class="fw-bold mb-3">
                                    <i class="fas fa-file-invoice text-success me-2"></i> Get Free Quote
                                </h5>
                                <p class="text-muted small">Interested in a similar project? Get in touch with us today.</p>
                                <a href="{{ route('quote.index') }}" class="btn btn-gradient w-100 rounded-pill py-2 fw-bold">
                                    <i class="fas fa-paper-plane me-2"></i> Request Quote
                                </a>
                                <a href="tel:+923048902805" class="btn btn-outline-success w-100 rounded-pill py-2 fw-bold mt-2">
                                    <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                                </a>
                            </div>
                            
                            {{-- Project Category Info --}}
                            @if($project->category)
                                <div class="pdp-sidebar-card mb-4">
                                    <h5 class="fw-bold mb-3">
                                        <i class="fas fa-folder text-success me-2"></i> Project Category
                                    </h5>
                                    <p class="text-muted small mb-2">{{ $project->category->pc_description ?? 'Projects in this category showcase our expertise and quality workmanship.' }}</p>
                                    <a href="{{ url('projects?category='.$project->pc_id) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                        <i class="fas fa-arrow-right me-1"></i> View All {{ $project->category->pc_name }} Projects
                                    </a>
                                </div>
                            @endif
                            
                            {{-- Related Projects --}}
                            @if($relatedProjects->count() > 0)
                                <div class="pdp-sidebar-card">
                                    <h5 class="fw-bold mb-3">
                                        <i class="fas fa-project-diagram text-success me-2"></i> Related Projects
                                    </h5>
                                    <div class="pdp-related-list">
                                        @foreach($relatedProjects as $rp)
                                            <a href="{{ url('project/'.($rp->p_slug ?? $rp->id)) }}" class="pdp-related-item">
                                                <img src="{{ asset('p_image/'.$rp->p_image) }}" alt="{{ $rp->p_title }}" loading="lazy">
                                                <div>
                                                    <h6 class="mb-1">{{ Str::limit($rp->p_title, 40) }}</h6>
                                                    <small class="text-muted">{{ $rp->p_location ?? '' }}</small>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                        </div>
                        
                    </div>
                    
                </div>
            @endif
        </div>
    </section>

    <!-- ============================================
         GALLERY MODAL
         ============================================ -->
    @if($activeGalleryImage !== null && count($galleryImages) > 0)
        <div class="pdp-gallery-modal" wire:key="gallery-modal" @keydown.escape.window="closeGallery">
            <div class="pdp-gallery-backdrop" @click="closeGallery"></div>
            <div class="pdp-gallery-content">
                <button class="pdp-gallery-close" @click="closeGallery">&times;</button>
                <button class="pdp-gallery-nav pdp-gallery-prev" @click="prevImage"><i class="fas fa-chevron-left"></i></button>
                <img src="{{ asset('p_image/'.$galleryImages[$activeGalleryImage]) }}" 
                     alt="Gallery Image {{ $activeGalleryImage + 1 }}" 
                     class="pdp-gallery-img">
                <button class="pdp-gallery-nav pdp-gallery-next" @click="nextImage"><i class="fas fa-chevron-right"></i></button>
                <div class="pdp-gallery-counter">{{ $activeGalleryImage + 1 }} / {{ count($galleryImages) }}</div>
            </div>
        </div>
    @endif

</div>

@push('styles')
<style>
    /* Hero */
    .pdp-hero { background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%); min-height: 280px; display: flex; align-items: center; }
    .pdp-hero-content { width: 100%; }
    .pdp-breadcrumb { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 12px; }
    .pdp-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .pdp-breadcrumb li a { color: #fff; text-decoration: none; }
    .pdp-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .pdp-hero-title { color: #fff; font-size: 2.5rem; font-weight: 800; margin-bottom: 8px; }
    .pdp-hero-subtitle { color: rgba(255,255,255,0.8); font-size: 1rem; }
    .pdp-section { padding: 50px 0; background: #f8f9fa; }

    /* Info Bar */
    .pdp-info-bar {
        background: #fff; border-radius: 16px; padding: 22px 25px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
    }
    .pdp-info-item { padding: 5px 0; }
    .pdp-info-label { display: block; font-size: 0.7rem; color: #888; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 2px; }
    .pdp-info-value { font-size: 0.9rem; font-weight: 600; color: #0a1628; }
    .status-badge { padding: 2px 10px; border-radius: 50px; font-size: 0.72rem; color: #fff; }
    .status-completed { background: #28a745; }
    .status-ongoing { background: #0056b3; }
    .status-planning { background: #ffc107; color: #000; }
    .status-on-hold { background: #6c757d; }

    /* Main Image */
    .pdp-main-image { position: relative; border-radius: 14px; overflow: hidden; }
    .pdp-main-image img { width: 100%; max-height: 450px; object-fit: cover; }
    .pdp-gallery-btn {
        position: absolute; bottom: 15px; right: 15px;
        background: rgba(0,0,0,0.7); color: #fff; border: none;
        padding: 8px 18px; border-radius: 50px; font-size: 0.85rem; font-weight: 600;
        cursor: pointer; transition: all 0.3s; backdrop-filter: blur(5px);
    }
    .pdp-gallery-btn:hover { background: #28a745; }

    /* Description */
    .pdp-section-title { font-size: 1.3rem; font-weight: 700; color: #0a1628; margin-bottom: 15px; }
    .pdp-text { font-size: 0.92rem; color: #666; line-height: 1.8; }

    /* Gallery Grid */
    .pdp-gallery-item { position: relative; border-radius: 10px; overflow: hidden; }
    .pdp-gallery-item img { width: 100%; height: 180px; object-fit: cover; transition: transform 0.4s; }
    .pdp-gallery-item:hover img { transform: scale(1.05); }
    .pdp-gallery-overlay {
        position: absolute; inset: 0; background: rgba(0,0,0,0.4);
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.3s; color: #fff; font-size: 1.5rem;
    }
    .pdp-gallery-item:hover .pdp-gallery-overlay { opacity: 1; }

    /* Sidebar */
    .pdp-sidebar-card {
        background: #fff; border-radius: 14px; padding: 22px;
        box-shadow: 0 3px 20px rgba(0,0,0,0.04); border: 1px solid #eef0f2;
    }
    .pdp-related-item {
        display: flex; align-items: center; gap: 12px; padding: 10px 0;
        border-bottom: 1px solid #f0f0f0; text-decoration: none; transition: all 0.2s;
    }
    .pdp-related-item:last-child { border-bottom: none; }
    .pdp-related-item:hover { padding-left: 5px; }
    .pdp-related-item img { width: 55px; height: 55px; border-radius: 8px; object-fit: cover; }
    .pdp-related-item h6 { font-size: 0.85rem; color: #0a1628; }

    /* Gallery Modal */
    .pdp-gallery-modal { position: fixed; inset: 0; z-index: 99999; display: flex; align-items: center; justify-content: center; }
    .pdp-gallery-backdrop { position: absolute; inset: 0; background: rgba(0,0,0,0.9); }
    .pdp-gallery-content { position: relative; max-width: 90vw; max-height: 85vh; display: flex; align-items: center; }
    .pdp-gallery-img { max-width: 90vw; max-height: 85vh; border-radius: 10px; object-fit: contain; }
    .pdp-gallery-close {
        position: absolute; top: -40px; right: 0; background: none; border: none;
        color: #fff; font-size: 2rem; cursor: pointer; transition: color 0.3s;
    }
    .pdp-gallery-close:hover { color: #dc3545; }
    .pdp-gallery-nav {
        position: absolute; top: 50%; transform: translateY(-50%);
        background: rgba(255,255,255,0.15); color: #fff; border: none;
        width: 45px; height: 45px; border-radius: 50%; font-size: 1.2rem;
        cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center;
    }
    .pdp-gallery-nav:hover { background: rgba(255,255,255,0.3); }
    .pdp-gallery-prev { left: -60px; }
    .pdp-gallery-next { right: -60px; }
    .pdp-gallery-counter {
        position: absolute; bottom: -35px; left: 50%; transform: translateX(-50%);
        color: rgba(255,255,255,0.7); font-size: 0.85rem;
    }

    @media (max-width: 991px) {
        .pdp-hero { min-height: 220px; }
        .pdp-hero-title { font-size: 2rem; }
        .pdp-gallery-nav { width: 38px; height: 38px; }
        .pdp-gallery-prev { left: -10px; }
        .pdp-gallery-next { right: -10px; }
    }
    @media (max-width: 767px) {
        .pdp-hero { min-height: 180px; }
        .pdp-hero-title { font-size: 1.6rem; }
        .pdp-section { padding: 35px 0; }
        .pdp-main-image img { max-height: 300px; }
        .pdp-gallery-item img { height: 140px; }
    }
</style>
@endpush