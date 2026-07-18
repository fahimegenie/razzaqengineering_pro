<div class="about-page-wrapper">
    
    <!-- ============================================
         PAGE HERO WITH BREADCRUMBS
         ============================================ -->
    <section class="about-hero">
        <div class="about-hero-bg"></div>
        <div class="container">
            <div class="row align-items-center" style="min-height: 280px;">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="custom-breadcrumb">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">About Us</li>
                        </ol>
                    </nav>
                    <h1 class="about-hero-title">
                        @if(!empty($about))
                            {{ $about->about_title }}
                        @else
                            About <span>Us</span>
                        @endif
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         LOADING STATE
         ============================================ -->
    <div wire:loading class="text-center py-5">
        <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
        <p class="text-muted mt-2">Loading...</p>
    </div>

    <!-- ============================================
         ERROR STATE
         ============================================ -->
    @if($errorMessage)
        <div class="container py-4">
            <div class="alert alert-danger border-0 rounded-3 shadow-sm text-center">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ $errorMessage }}
                <button wire:click="loadData" class="btn btn-sm btn-outline-danger ms-3 rounded-pill">
                    <i class="fas fa-redo me-1"></i> Retry
                </button>
            </div>
        </div>
    @endif

    @if(!$isLoading && !$errorMessage)
    
    <!-- ============================================
         ABOUT CONTENT
         ============================================ -->
    <section class="about-content-sec">
        <div class="container">
            <div class="row g-5 align-items-center">
                
                {{-- Left: Image --}}
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="about-img-wrapper">
                        @if(!empty($about) && !empty($about->a_image))
                            <img src="{{ asset('images/'.$about->a_image) }}" 
                                 alt="{{ $about->about_title ?? 'About Razzaq Engineering' }}"
                                 class="about-main-img"
                                 loading="lazy">
                        @else
                            <img src="{{ asset('assets/images/about-right-1.jpg') }}" 
                                 alt="About Our Company"
                                 class="about-main-img"
                                 loading="lazy">
                        @endif
                        
                        {{-- Experience Badge --}}
                        <div class="about-exp-badge">
                            <span class="exp-num">{{ $stats['experience'] }}+</span>
                            <span class="exp-lbl">Years Experience</span>
                        </div>
                    </div>
                </div>
                
                {{-- Right: Content --}}
                <div class="col-lg-6" data-aos="fade-left">
                    <span class="sec-tag">WHO WE ARE</span>
                    <h2 class="sec-title">
                        @if(!empty($about))
                            {{ $about->about_title }}
                        @else
                            Pakistan's Leading <span class="text-grad">Engineering Services</span>
                        @endif
                    </h2>
                    
                    <div class="about-text">
                        <p>
                            @if(!empty($about) && !empty($about->about_description_1))
                                {{ $about->about_description_1 }}
                            @else
                                With over <strong>15 years of industry leadership</strong>, Razzaq Engineering Services stands as Pakistan's premier provider of specialized engineering solutions. We deliver professional RCC core cutting, diamond drilling, wall saw cutting, plumbing & fire fighting services across all major cities.
                            @endif
                        </p>
                        <p>
                            @if(!empty($about) && !empty($about->about_description_2))
                                {{ $about->about_description_2 }}
                            @else
                                Our commitment to quality, safety, and client satisfaction has earned us the trust of <strong>300+ happy clients</strong> and <strong>500+ completed projects</strong> nationwide.
                            @endif
                        </p>
                    </div>
                    
                    {{-- Quick Stats --}}
                    <div class="about-quick-stats">
                        <div class="quick-stat">
                            <span class="qs-number">{{ $stats['projects'] }}+</span>
                            <span class="qs-label">Projects Done</span>
                        </div>
                        <div class="quick-stat">
                            <span class="qs-number">{{ $stats['clients'] }}+</span>
                            <span class="qs-label">Happy Clients</span>
                        </div>
                        <div class="quick-stat">
                            <span class="qs-number">{{ $stats['cities'] }}+</span>
                            <span class="qs-label">Cities Covered</span>
                        </div>
                    </div>
                    
                    {{-- CTA --}}
                    <a href="{{ route('quote.index') }}" class="btn-about-cta">
                        <i class="fas fa-file-invoice me-2"></i> Get Free Quote
                    </a>
                </div>
                
            </div>
        </div>
    </section>

    <!-- ============================================
         MISSION / VISION / VALUES TABS
         ============================================ -->
    <section class="mission-tabs-sec">
        <div class="container">
            <div class="mission-tabs-wrapper" 
                 x-data="{ activeTab: 'mission' }">
                
                {{-- Tab Navigation --}}
                <div class="m-tabs-nav" data-aos="fade-up">
                    <button @click="activeTab = 'mission'" :class="{ 'active': activeTab === 'mission' }">
                        <i class="fas fa-bullseye"></i> Our Mission
                    </button>
                    <button @click="activeTab = 'vision'" :class="{ 'active': activeTab === 'vision' }">
                        <i class="fas fa-eye"></i> Our Vision
                    </button>
                    <button @click="activeTab = 'values'" :class="{ 'active': activeTab === 'values' }">
                        <i class="fas fa-gem"></i> Our Values
                    </button>
                </div>
                
                {{-- Tab Content --}}
                <div class="m-tabs-content" data-aos="fade-up">
                    
                    {{-- Mission --}}
                    <div x-show="activeTab === 'mission'" x-transition>
                        <div class="m-tab-card">
                            <div class="row g-4 align-items-center">
                                <div class="col-md-5">
                                    <div class="m-tab-icon">
                                        <i class="fas fa-bullseye"></i>
                                    </div>
                                    <h3 class="m-tab-title">
                                        @if(!empty($about) && !empty($about->mission_title))
                                            {{ $about->mission_title }}
                                        @else
                                            Our Mission
                                        @endif
                                    </h3>
                                </div>
                                <div class="col-md-7">
                                    <div class="m-tab-text">
                                        @if(!empty($about) && !empty($about->mission_description))
                                            <p>{!! $about->mission_description !!}</p>
                                        @else
                                            <p>To provide exceptional engineering services through innovation, quality workmanship, and unwavering commitment to client satisfaction across Pakistan.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Vision --}}
                    <div x-show="activeTab === 'vision'" x-transition>
                        <div class="m-tab-card">
                            <div class="row g-4 align-items-center">
                                <div class="col-md-5">
                                    <div class="m-tab-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <h3 class="m-tab-title">
                                        @if(!empty($about) && !empty($about->vision_title))
                                            {{ $about->vision_title }}
                                        @else
                                            Our Vision
                                        @endif
                                    </h3>
                                </div>
                                <div class="col-md-7">
                                    <div class="m-tab-text">
                                        @if(!empty($about) && !empty($about->vision_description))
                                            <p>{!! $about->vision_description !!}</p>
                                        @else
                                            <p>To become the leading engineering services provider across South Asia, recognized for technical expertise and sustainable construction practices.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Values --}}
                    <div x-show="activeTab === 'values'" x-transition>
                        <div class="m-tab-card">
                            <div class="row g-4 align-items-center">
                                <div class="col-md-5">
                                    <div class="m-tab-icon">
                                        <i class="fas fa-gem"></i>
                                    </div>
                                    <h3 class="m-tab-title">
                                        @if(!empty($about) && !empty($about->values_title))
                                            {{ $about->values_title }}
                                        @else
                                            Our Core Values
                                        @endif
                                    </h3>
                                </div>
                                <div class="col-md-7">
                                    <div class="m-tab-text">
                                        @if(!empty($about) && !empty($about->values_description))
                                            <p>{!! $about->values_description !!}</p>
                                        @else
                                            <div class="values-list-inline">
                                                <span><i class="fas fa-check-circle"></i> Safety First</span>
                                                <span><i class="fas fa-check-circle"></i> Quality Excellence</span>
                                                <span><i class="fas fa-check-circle"></i> Integrity & Transparency</span>
                                                <span><i class="fas fa-check-circle"></i> Innovation & Technology</span>
                                                <span><i class="fas fa-check-circle"></i> Teamwork & Collaboration</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </section>

    <!-- ============================================
         WHY CHOOSE US
         ============================================ -->
    <section class="choose-us-sec">
        <div class="container">
            <div class="sec-header text-center mb-5" data-aos="fade-up">
                <span class="sec-tag">WHY WE'RE THE BEST</span>
                <h2 class="sec-title">Why Choose <span class="text-grad">Us</span></h2>
            </div>
            
            <div class="row g-4">
                @foreach($whyChooseUs as $index => $feature)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="choose-card">
                            <div class="choose-icon-wrap">
                                <i class="fas {{ $feature['icon'] }}"></i>
                            </div>
                            <h4>{{ $feature['title'] }}</h4>
                            <p>{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ============================================
         TEAM SECTION
         ============================================ -->
    @if($team->count() > 0)
    <section class="team-sec">
        <div class="container">
            <div class="sec-header text-center mb-5" data-aos="fade-up">
                <span class="sec-tag">OUR PEOPLE</span>
                <h2 class="sec-title">Meet Our <span class="text-grad">Team</span></h2>
            </div>
            
            <div class="row g-4">
                @foreach($team as $member)
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="team-card" wire:click="showMemberDetail({{ $member->id }})" style="cursor:pointer;">
                            <div class="team-img-wrap">
                                <img src="{{ asset('ot_image/'.$member->ot_image) }}" 
                                     alt="{{ $member->ot_name }}" loading="lazy">
                                <div class="team-overlay">
                                    <span>View Profile</span>
                                </div>
                            </div>
                            <div class="team-info">
                                <h5>{{ $member->ot_name }}</h5>
                                <span>{{ $member->ot_designation }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($team->count() > 4)
                <div class="text-center mt-4">
                    <a href="{{ url('team') }}" class="btn-team-all">
                        View All Team <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>
    @endif

    <!-- ============================================
         TEAM MODAL
         ============================================ -->
    @if($showTeamModal && $selectedMember)
        <div class="modal-backdrop-custom" wire:click="closeTeamModal"></div>
        <div class="modal-custom">
            <button class="modal-close-btn" wire:click="closeTeamModal">&times;</button>
            <div class="row g-4">
                <div class="col-md-5">
                    <img src="{{ asset('ot_image/'.$selectedMember->ot_image) }}" 
                         alt="{{ $selectedMember->ot_name }}"
                         class="w-100 rounded-3" style="max-height:350px;object-fit:cover;">
                </div>
                <div class="col-md-7">
                    <h3 class="fw-bold">{{ $selectedMember->ot_name }}</h3>
                    <p class="text-success fw-semibold">{{ $selectedMember->ot_designation }}</p>
                    <p class="text-muted">{!! $selectedMember->ot_description !!}</p>
                    @if($selectedMember->ot_email)
                        <p><i class="fas fa-envelope text-success me-2"></i> {{ $selectedMember->ot_email }}</p>
                    @endif
                    @if($selectedMember->ot_phone)
                        <p><i class="fas fa-phone text-success me-2"></i> {{ $selectedMember->ot_phone }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endif

    @endif
    
</div>

@push('styles')
    <style>
        /* ============================================
   ABOUT PAGE STYLES
   ============================================ */

/* Hero */
.about-hero {
    position: relative;
    background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%);
    overflow: hidden;
}
.about-hero-bg {
    position: absolute;
    inset: 0;
    background: url('/assets/images/about-banner.jpg') center/cover no-repeat;
    opacity: 0.15;
}
.custom-breadcrumb {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0;
}
.custom-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
.custom-breadcrumb li a { color: #fff; text-decoration: none; }
.custom-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
.about-hero-title { color: #fff; font-size: 2.5rem; font-weight: 800; }
.about-hero-title span { color: #48c964; }

/* Content Section */
.about-content-sec { padding: 80px 0; }
.about-img-wrapper { position: relative; }
.about-main-img { width: 100%; border-radius: 16px; box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
.about-exp-badge {
    position: absolute; bottom: -20px; right: -20px;
    background: linear-gradient(135deg, #0056b3, #003d80); color: #fff;
    border-radius: 16px; padding: 18px 24px; text-align: center;
    box-shadow: 0 10px 30px rgba(0,86,179,0.35);
}
.exp-num { display: block; font-size: 2rem; font-weight: 900; line-height: 1; }
.exp-lbl { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1.5px; opacity: 0.85; }

.sec-tag {
    display: inline-block; font-size: 0.72rem; font-weight: 700; letter-spacing: 3px;
    color: #28a745; text-transform: uppercase; margin-bottom: 8px;
}
.sec-title { font-size: 2rem; font-weight: 800; color: #0a1628; margin-bottom: 15px; }
.text-grad {
    background: linear-gradient(135deg, #0056b3, #28a745);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.about-text { color: #666; font-size: 0.93rem; line-height: 1.8; margin-bottom: 20px; }
.about-text strong { color: #0056b3; }

.about-quick-stats { display: flex; gap: 20px; margin-bottom: 22px; }
.quick-stat { text-align: center; }
.qs-number { display: block; font-size: 1.5rem; font-weight: 800; color: #0056b3; }
.qs-label { font-size: 0.72rem; color: #888; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }

.btn-about-cta {
    display: inline-flex; align-items: center; padding: 12px 28px;
    background: linear-gradient(135deg, #0056b3, #003d80); color: #fff;
    text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 0.9rem;
    transition: all 0.3s ease; box-shadow: 0 5px 20px rgba(0,86,179,0.25);
}
.btn-about-cta:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(0,86,179,0.4); color: #fff; }

/* Mission Tabs */
.mission-tabs-sec { padding: 60px 0; background: #f8f9fa; }
.m-tabs-nav { display: flex; gap: 5px; justify-content: center; margin-bottom: 25px; background: #fff; border-radius: 12px; padding: 6px; box-shadow: 0 2px 15px rgba(0,0,0,0.04); display: inline-flex; }
.m-tabs-nav button {
    padding: 12px 24px; border: none; background: transparent; border-radius: 8px;
    font-weight: 600; font-size: 0.9rem; color: #555; cursor: pointer; transition: all 0.3s ease;
    display: flex; align-items: center; gap: 8px;
}
.m-tabs-nav button.active { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; box-shadow: 0 4px 15px rgba(40,167,69,0.25); }
.m-tab-card { background: #fff; border-radius: 16px; padding: 35px; box-shadow: 0 5px 25px rgba(0,0,0,0.04); }
.m-tab-icon { width: 70px; height: 70px; background: linear-gradient(135deg, rgba(40,167,69,0.08), rgba(0,86,179,0.08)); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 28px; color: #28a745; margin-bottom: 15px; }
.m-tab-title { font-size: 1.4rem; font-weight: 700; color: #0a1628; }
.m-tab-text { font-size: 0.93rem; color: #666; line-height: 1.8; }
.values-list-inline { display: flex; flex-direction: column; gap: 10px; }
.values-list-inline span { display: flex; align-items: center; gap: 10px; font-size: 0.9rem; color: #555; }
.values-list-inline i { color: #28a745; }

/* Choose Us */
.choose-us-sec { padding: 80px 0; }
.choose-card {
    background: #fff; border-radius: 16px; padding: 30px 25px; text-align: center;
    border: 1px solid #eef0f2; transition: all 0.3s ease; height: 100%;
}
.choose-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.08); border-color: #28a745; }
.choose-icon-wrap {
    width: 60px; height: 60px; background: linear-gradient(135deg, rgba(40,167,69,0.08), rgba(0,86,179,0.08));
    border-radius: 14px; display: flex; align-items: center; justify-content: center;
    font-size: 24px; color: #28a745; margin: 0 auto 15px; transition: all 0.3s ease;
}
.choose-card:hover .choose-icon-wrap { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; border-radius: 50%; }
.choose-card h4 { font-size: 1.05rem; font-weight: 700; margin-bottom: 8px; }
.choose-card p { font-size: 0.85rem; color: #888; margin: 0; }

/* Team */
.team-sec { padding: 80px 0; background: #f8f9fa; }
.team-card { background: #fff; border-radius: 14px; overflow: hidden; box-shadow: 0 3px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; }
.team-card:hover { transform: translateY(-5px); box-shadow: 0 12px 35px rgba(0,0,0,0.1); }
.team-img-wrap { position: relative; height: 260px; overflow: hidden; }
.team-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
.team-card:hover .team-img-wrap img { transform: scale(1.05); }
.team-overlay {
    position: absolute; inset: 0; background: rgba(0,54,108,0.7);
    display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;
}
.team-card:hover .team-overlay { opacity: 1; }
.team-overlay span { color: #fff; font-weight: 600; font-size: 0.88rem; padding: 8px 20px; border: 2px solid #fff; border-radius: 6px; }
.team-info { padding: 16px; text-align: center; }
.team-info h5 { font-size: 1rem; font-weight: 700; margin-bottom: 4px; }
.team-info span { font-size: 0.8rem; color: #28a745; font-weight: 600; }
.btn-team-all {
    display: inline-flex; align-items: center; padding: 12px 28px;
    background: #fff; color: #28a745; text-decoration: none; border-radius: 8px;
    font-weight: 700; font-size: 0.9rem; border: 2px solid #28a745; transition: all 0.3s ease;
}
.btn-team-all:hover { background: #28a745; color: #fff; transform: translateY(-2px); }

/* Modal */
.modal-backdrop-custom { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9998; }
.modal-custom {
    position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
    background: #fff; border-radius: 16px; padding: 30px; z-index: 9999;
    width: 90%; max-width: 700px; max-height: 85vh; overflow-y: auto;
}
.modal-close-btn {
    position: absolute; top: 10px; right: 15px; background: none; border: none;
    font-size: 28px; cursor: pointer; color: #888; transition: color 0.3s;
}
.modal-close-btn:hover { color: #dc3545; }

/* Responsive */
@media (max-width: 991.98px) {
    .about-content-sec { padding: 60px 0; }
    .sec-title { font-size: 1.7rem; }
    .about-hero-title { font-size: 2rem; }
    .m-tabs-nav { flex-wrap: wrap; }
    .m-tabs-nav button { padding: 10px 16px; font-size: 0.8rem; }
    .m-tab-card { padding: 25px; }
}
@media (max-width: 767.98px) {
    .about-content-sec { padding: 45px 0; }
    .sec-title { font-size: 1.4rem; }
    .about-hero-title { font-size: 1.6rem; }
    .about-exp-badge { right: 10px; bottom: -15px; padding: 12px 16px; }
    .exp-num { font-size: 1.5rem; }
    .choose-us-sec, .team-sec { padding: 45px 0; }
    .mission-tabs-sec { padding: 40px 0; }
}
@media (max-width: 575.98px) {
    .sec-title { font-size: 1.25rem; }
    .about-hero-title { font-size: 1.3rem; }
    .about-quick-stats { flex-wrap: wrap; gap: 10px; }
    .m-tab-card { padding: 18px; }
    .m-tab-icon { width: 50px; height: 50px; font-size: 22px; }
    .m-tab-title { font-size: 1.15rem; }
    .btn-about-cta { width: 100%; justify-content: center; }
}
    </style>
@endpush