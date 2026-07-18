<div class="team-page-wrapper"
     x-data="{
        showModal: @entangle('showModal'),
        
        openModal(memberId) {
            $wire.openMemberModal(memberId);
        },
        
        closeModal() {
            $wire.closeModal();
        }
     }">
    
    <!-- HERO -->
    <section class="team-hero" wire:ignore>
        <div class="container team-hero-content">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="team-breadcrumb">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Team</li>
                        </ol>
                    </nav>
                    <h1 class="team-hero-title">Meet Our Team</h1>
                    <p class="team-hero-subtitle">Dedicated professionals delivering engineering excellence across Pakistan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="team-section">
        <div class="container">
            
            {{-- Loading --}}
            @if($isLoading)
                <div class="text-center py-5" wire:key="team-loading">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-2">Loading team...</p>
                </div>
                
            {{-- Error --}}
            @elseif($errorMessage)
                <div class="alert alert-danger text-center rounded-3 border-0 shadow-sm" wire:key="team-error">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ $errorMessage }}
                </div>
                
            {{-- Content --}}
            @else
                <div wire:key="team-main-content">
                    
                    {{-- Section Intro --}}
                    <div class="team-intro text-center mb-5" data-aos="fade-up" wire:ignore.self>
                        <span class="sec-tag">OUR PEOPLE</span>
                        <h2 class="sec-title">Meet Our <span class="text-grad">Professionals</span></h2>
                        <p class="sec-desc">Our skilled team brings together years of experience in RCC core cutting, diamond drilling, plumbing & fire fighting services.</p>
                    </div>
                    
                    {{-- Search --}}
                    <div class="row justify-content-center mb-5" data-aos="fade-up">
                        <div class="col-lg-5">
                            <div class="position-relative">
                                <i class="fas fa-search position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
                                <input type="text" 
                                       class="form-control ps-5 py-3 rounded-3 border-2"
                                       wire:model.live.debounce.300ms="search"
                                       placeholder="Search team members...">
                                @if($search)
                                    <button class="btn btn-sm btn-light position-absolute top-50 translate-middle-y end-0 me-2 rounded-circle"
                                            wire:click="$set('search', '')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    {{-- Team Grid --}}
                    @if($filteredMembers->count() > 0)
                        <div class="team-grid" wire:key="team-grid-{{ md5($search) }}">
                            <div class="row g-4">
                                @foreach($filteredMembers as $member)
                                    <div class="col-lg-3 col-md-4 col-sm-6" 
                                         data-aos="fade-up" 
                                         data-aos-delay="{{ $loop->index % 4 * 100 }}"
                                         wire:key="team-member-{{ $member->ot_id }}">
                                        <div class="team-card" @click="openModal({{ $member->ot_id }})">
                                            
                                            {{-- Image --}}
                                            <div class="team-card-img" wire:ignore>
                                                <img src="{{ asset('ot_image/'.$member->ot_image) }}" 
                                                     alt="{{ $member->ot_name }}" 
                                                     class="team-img" loading="lazy">
                                                <div class="team-img-overlay">
                                                    <span class="team-view-profile">View Profile</span>
                                                </div>
                                            </div>
                                            
                                            {{-- Info --}}
                                            <div class="team-card-body text-center">
                                                <h4 class="team-name">{{ $member->ot_name }}</h4>
                                                <span class="team-role">{{ $member->ot_designation }}</span>
                                                
                                                {{-- Social Links --}}
                                                <div class="team-social mt-2">
                                                    @if($member->ot_fb)
                                                        <a href="{{ $member->ot_fb }}" target="_blank" @click.stop class="team-social-link">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </a>
                                                    @endif
                                                    @if($member->ot_inst)
                                                        <a href="{{ $member->ot_inst }}" target="_blank" @click.stop class="team-social-link">
                                                            <i class="fab fa-instagram"></i>
                                                        </a>
                                                    @endif
                                                    @if($member->ot_linkedin)
                                                        <a href="{{ $member->ot_linkedin }}" target="_blank" @click.stop class="team-social-link">
                                                            <i class="fab fa-linkedin-in"></i>
                                                        </a>
                                                    @endif
                                                    @if($member->ot_email)
                                                        <a href="mailto:{{ $member->ot_email }}" @click.stop class="team-social-link">
                                                            <i class="fas fa-envelope"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        {{-- Count --}}
                        <div class="text-center mt-4">
                            <p class="text-muted small">
                                Showing <strong>{{ $filteredMembers->count() }}</strong> team members
                                @if($search)
                                    for "<strong>{{ $search }}</strong>"
                                @endif
                            </p>
                        </div>
                        
                    @else
                        <div class="text-center py-5" data-aos="fade-up" wire:key="team-empty">
                            <i class="fas fa-users fa-3x text-muted opacity-25 mb-3"></i>
                            <h5 class="fw-bold">No Team Members Found</h5>
                            <p class="text-muted">Try different search terms.</p>
                            <button class="btn btn-outline-success rounded-pill px-4" wire:click="$set('search', '')">
                                <i class="fas fa-redo me-2"></i> Show All
                            </button>
                        </div>
                    @endif
                    
                </div>
            @endif
        </div>
    </section>

    <!-- ============================================
         TEAM MEMBER MODAL
         ============================================ -->
    @if($showModal && $selectedMember)
        <div class="team-modal-overlay" wire:key="modal-{{ $selectedMember->ot_id }}" @click.self="closeModal" @keydown.escape.window="closeModal">
            <div class="team-modal-content">
                {{-- Close Button --}}
                <button class="team-modal-close" @click="closeModal">&times;</button>
                
                <div class="row g-4">
                    {{-- Image --}}
                    <div class="col-md-5 text-center" wire:ignore>
                        <img src="{{ asset('ot_image/'.$selectedMember->ot_image) }}" 
                             alt="{{ $selectedMember->ot_name }}" 
                             class="team-modal-img rounded-3 shadow" loading="lazy">
                    </div>
                    
                    {{-- Details --}}
                    <div class="col-md-7">
                        <h3 class="fw-bold mb-1">{{ $selectedMember->ot_name }}</h3>
                        <p class="text-success fw-semibold mb-3">{{ $selectedMember->ot_designation }}</p>
                        
                        @if($selectedMember->ot_description)
                            <div class="team-modal-desc mb-3">
                                <p class="text-muted">{!! $selectedMember->ot_description !!}</p>
                            </div>
                        @endif
                        
                        {{-- Contact Info --}}
                        <div class="team-modal-info mb-3">
                            @if($selectedMember->ot_phone)
                                <p class="mb-2">
                                    <i class="fas fa-phone text-success me-2"></i>
                                    <a href="tel:{{ $selectedMember->ot_phone }}">{{ $selectedMember->ot_phone }}</a>
                                </p>
                            @endif
                            @if($selectedMember->ot_email)
                                <p class="mb-2">
                                    <i class="fas fa-envelope text-success me-2"></i>
                                    <a href="mailto:{{ $selectedMember->ot_email }}">{{ $selectedMember->ot_email }}</a>
                                </p>
                            @endif
                            @if($selectedMember->ot_experience)
                                <p class="mb-2">
                                    <i class="fas fa-briefcase text-success me-2"></i>
                                    {{ $selectedMember->ot_experience }}+ Years Experience
                                </p>
                            @endif
                        </div>
                        
                        {{-- Skills --}}
                        @php $skills = $selectedMember->skills_list; @endphp
                        @if(count($skills) > 0)
                            <div class="team-modal-skills mb-3">
                                <h6 class="fw-bold mb-2">Skills</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($skills as $skill)
                                        <span class="skill-tag">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        {{-- Social Links --}}
                        <div class="team-modal-social">
                            @if($selectedMember->ot_fb)
                                <a href="{{ $selectedMember->ot_fb }}" target="_blank" class="social-btn">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif
                            @if($selectedMember->ot_inst)
                                <a href="{{ $selectedMember->ot_inst }}" target="_blank" class="social-btn">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif
                            @if($selectedMember->ot_twitter)
                                <a href="{{ $selectedMember->ot_twitter }}" target="_blank" class="social-btn">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @endif
                            @if($selectedMember->ot_linkedin)
                                <a href="{{ $selectedMember->ot_linkedin }}" target="_blank" class="social-btn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>

@push('styles')
<style>
    /* Hero */
    .team-hero { background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%); min-height: 250px; display: flex; align-items: center; }
    .team-hero-content { width: 100%; }
    .team-breadcrumb { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 10px; }
    .team-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .team-breadcrumb li a { color: #fff; text-decoration: none; }
    .team-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .team-hero-title { color: #fff; font-size: 2.5rem; font-weight: 800; }
    .team-hero-subtitle { color: rgba(255,255,255,0.8); font-size: 1rem; }
    .team-section { padding: 60px 0; background: #fff; }

    .sec-tag { display: inline-block; font-size: 0.72rem; font-weight: 700; letter-spacing: 3px; color: #28a745; text-transform: uppercase; margin-bottom: 8px; }
    .sec-title { font-size: 2rem; font-weight: 800; color: #0a1628; margin-bottom: 8px; }
    .text-grad { background: linear-gradient(135deg, #0056b3, #28a745); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .sec-desc { color: #888; font-size: 0.9rem; max-width: 600px; margin: 0 auto; line-height: 1.6; }

    /* Team Card */
    .team-card {
        background: #fff; border-radius: 16px; overflow: hidden;
        box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
        transition: all 0.3s; cursor: pointer; height: 100%;
    }
    .team-card:hover { transform: translateY(-6px); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
    .team-card-img { position: relative; height: 280px; overflow: hidden; background: #f0f4f8; }
    .team-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
    .team-card:hover .team-img { transform: scale(1.05); }
    .team-img-overlay {
        position: absolute; inset: 0; background: rgba(0,54,108,0.7);
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.3s;
    }
    .team-card:hover .team-img-overlay { opacity: 1; }
    .team-view-profile { color: #fff; font-weight: 600; padding: 8px 20px; border: 2px solid #fff; border-radius: 6px; font-size: 0.85rem; }
    .team-card-body { padding: 18px; }
    .team-name { font-size: 1.05rem; font-weight: 700; margin-bottom: 2px; color: #0a1628; }
    .team-role { font-size: 0.82rem; color: #28a745; font-weight: 600; }
    .team-social { display: flex; justify-content: center; gap: 8px; }
    .team-social-link {
        width: 32px; height: 32px; background: #f0f4f8; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #555; text-decoration: none; font-size: 13px; transition: all 0.2s;
    }
    .team-social-link:hover { background: #28a745; color: #fff; }

    /* Modal */
    .team-modal-overlay { position: fixed; inset: 0; z-index: 99999; background: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center; padding: 20px; backdrop-filter: blur(3px); }
    .team-modal-content { background: #fff; border-radius: 20px; padding: 30px; max-width: 750px; width: 100%; max-height: 85vh; overflow-y: auto; position: relative; box-shadow: 0 20px 60px rgba(0,0,0,0.2); animation: modalIn 0.3s ease; }
    @keyframes modalIn { from { opacity: 0; transform: translateY(-20px) scale(0.95); } to { opacity: 1; transform: translateY(0) scale(1); } }
    .team-modal-close { position: absolute; top: 12px; right: 15px; background: #f0f0f0; border: none; width: 36px; height: 36px; border-radius: 50%; font-size: 22px; cursor: pointer; color: #555; display: flex; align-items: center; justify-content: center; transition: all 0.2s; }
    .team-modal-close:hover { background: #dc3545; color: #fff; }
    .team-modal-img { width: 100%; max-height: 320px; object-fit: cover; border-radius: 14px; }
    .team-modal-desc p { font-size: 0.9rem; line-height: 1.7; }
    .team-modal-info p { font-size: 0.88rem; color: #555; }
    .team-modal-info a { color: #0056b3; text-decoration: none; }
    .skill-tag { font-size: 0.72rem; padding: 4px 12px; background: #f0faf3; color: #28a745; border-radius: 50px; font-weight: 500; }
    .social-btn {
        width: 38px; height: 38px; background: #f0f4f8; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        color: #555; text-decoration: none; margin-right: 6px; transition: all 0.2s;
    }
    .social-btn:hover { background: #0056b3; color: #fff; }

    @media (max-width: 991px) {
        .team-hero { min-height: 200px; }
        .team-hero-title { font-size: 2rem; }
        .team-card-img { height: 250px; }
    }
    @media (max-width: 767px) {
        .team-hero { min-height: 170px; }
        .team-hero-title { font-size: 1.6rem; }
        .team-section { padding: 40px 0; }
        .team-card-img { height: 260px; }
        .team-modal-content { padding: 20px; }
    }
</style>
@endpush