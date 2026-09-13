<div class="tm-page" 
     x-data="{
        showModal: @entangle('showModal'),
        searchQuery: @entangle('search'),
        
        openModal(memberId) {
            $wire.openMemberModal(memberId);
        },
        
        closeModal() {
            $wire.closeModal();
        },
        
        handleKeydown(e) {
            if (this.showModal && e.key === 'Escape') this.closeModal();
        }
     }"
     @keydown.window="handleKeydown">
    
    {{-- ============================================
         STICKY MOBILE CTA
         ============================================ --}}
    <div class="tm-mobile-cta d-lg-none">
        <a href="tel:+923048902805" class="tm-mobile-btn tm-mobile-call">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/923048902805" target="_blank" class="tm-mobile-btn tm-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="{{ route('quote.index') }}" class="tm-mobile-btn tm-mobile-quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    {{-- ============================================
         HERO SECTION
         ============================================ --}}
    <section class="tm-hero">
        <div class="tm-hero-bg"></div>
        <div class="tm-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-30">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="tm-breadcrumb">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Team</li>
                        </ol>
                    </nav>
                    
                    <div class="tm-hero-badge">
                        <i class="fas fa-users"></i> Our People
                    </div>
                    
                    <h1 class="tm-hero-title">Meet Our Team</h1>
                    <p class="tm-hero-subtitle">Dedicated professionals delivering engineering excellence with 24+ years of combined experience</p>
                    
                    <div class="tm-hero-stats">
                        <div class="tm-stat-item">
                            <span class="tm-stat-number">{{ $teamMembers->count() }}+</span>
                            <span class="tm-stat-label">Team Members</span>
                        </div>
                        <div class="tm-stat-item">
                            <span class="tm-stat-number">24+</span>
                            <span class="tm-stat-label">Years Experience</span>
                        </div>
                        <div class="tm-stat-item">
                            <span class="tm-stat-number">100%</span>
                            <span class="tm-stat-label">Dedicated</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         TRUST BAR
         ============================================ --}}
    <section class="tm-trust-bar">
        <div class="container">
            <div class="tm-trust-grid">
                <div class="tm-trust-card">
                    <div class="tm-trust-icon"><i class="fas fa-user-graduate"></i></div>
                    <div>
                        <strong>Skilled</strong>
                        <span>Engineers</span>
                    </div>
                </div>
                <div class="tm-trust-card">
                    <div class="tm-trust-icon"><i class="fas fa-certificate"></i></div>
                    <div>
                        <strong>Certified</strong>
                        <span>Professionals</span>
                    </div>
                </div>
                <div class="tm-trust-card">
                    <div class="tm-trust-icon"><i class="fas fa-hard-hat"></i></div>
                    <div>
                        <strong>Experienced</strong>
                        <span>Workforce</span>
                    </div>
                </div>
                <div class="tm-trust-card">
                    <div class="tm-trust-icon"><i class="fas fa-hands-helping"></i></div>
                    <div>
                        <strong>Dedicated</strong>
                        <span>Support</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         MAIN CONTENT
         ============================================ --}}
    <section class="tm-main-section">
        <div class="container">
            
            @if($isLoading)
                <div class="tm-state-box">
                    <div class="spinner-grow text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-3 fw-semibold">Loading team members...</p>
                </div>
            
            @elseif($errorMessage)
                <div class="tm-error-card">
                    <i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;"></i>
                    <h4 class="fw-bold mt-3">Oops! Something went wrong</h4>
                    <p class="text-muted">{{ $errorMessage }}</p>
                    <button class="btn btn-primary mt-3" wire:click="$set('search', '')">
                        <i class="fas fa-redo me-2"></i> Refresh
                    </button>
                </div>
            
            @else
                {{-- Section Header --}}
                <div class="tm-section-header" data-aos="fade-up">
                    <span class="tm-section-badge"><i class="fas fa-users"></i> Our Professionals</span>
                    <h2>Meet the Experts Behind Our Success</h2>
                    <p>Our skilled team brings together years of experience in RCC core cutting, diamond drilling, plumbing & fire fighting services.</p>
                </div>

                {{-- Search Bar --}}
                <div class="tm-search-wrapper" data-aos="fade-up">
                    <div class="tm-search-inner">
                        <div class="tm-input-wrapper">
                            <i class="fas fa-search tm-input-icon"></i>
                            <input type="text" 
                                   class="tm-form-input" 
                                   placeholder="Search by name, designation, or expertise..."
                                   wire:model.live.debounce.300ms="search">
                            @if($search)
                                <button class="tm-search-clear" wire:click="$set('search', '')" title="Clear search">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                        </div>
                        <span class="tm-search-count">
                            <strong>{{ $filteredMembers->count() }}</strong> members
                        </span>
                    </div>
                </div>

                {{-- Team Grid --}}
                @if($filteredMembers->count() > 0)
                    <div class="tm-grid" wire:key="grid-{{ md5($search) }}">
                        <div class="row g-4">
                            @foreach($filteredMembers as $member)
                                <div class="col-lg-3 col-md-4 col-sm-6" 
                                     data-aos="fade-up" 
                                     data-aos-delay="{{ ($loop->index % 4) * 60 }}"
                                     wire:key="member-{{ $member->ot_id }}">
                                    <div class="tm-card" @click="openModal({{ $member->ot_id }})">
                                        <div class="tm-card-image">
                                            <img src="{{ asset($member->ot_image) }}" 
                                                 alt="{{ $member->ot_name }}" 
                                                 loading="lazy">
                                            <div class="tm-card-overlay">
                                                <span class="tm-overlay-btn">View Profile</span>
                                            </div>
                                        </div>
                                        <div class="tm-card-body">
                                            <h3>{{ $member->ot_name }}</h3>
                                            <span class="tm-card-role">{{ $member->ot_designation }}</span>
                                            
                                            @if($member->ot_experience)
                                                <div class="tm-card-exp">
                                                    <i class="fas fa-briefcase"></i> {{ $member->ot_experience }}+ Years
                                                </div>
                                            @endif
                                            
                                            <div class="tm-card-social">
                                                @if($member->ot_fb)
                                                    <a href="{{ $member->ot_fb }}" target="_blank" @click.stop class="tm-social-link">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                @endif
                                                @if($member->ot_inst)
                                                    <a href="{{ $member->ot_inst }}" target="_blank" @click.stop class="tm-social-link">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                @endif
                                                @if($member->ot_linkedin)
                                                    <a href="{{ $member->ot_linkedin }}" target="_blank" @click.stop class="tm-social-link">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                @endif
                                                @if($member->ot_email)
                                                    <a href="mailto:{{ $member->ot_email }}" @click.stop class="tm-social-link">
                                                        <i class="fas fa-envelope"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        {{-- Count Bar --}}
                        <div class="tm-count-bar">
                            <i class="fas fa-users me-2"></i>
                            Showing <strong>{{ $filteredMembers->count() }}</strong> of <strong>{{ $teamMembers->count() }}</strong> team members
                            @if($search)
                                for "<strong>{{ $search }}</strong>"
                            @endif
                        </div>
                    </div>
                @else
                    <div class="tm-empty-state" data-aos="fade-up">
                        <div class="tm-empty-icon">
                            <i class="fas fa-user-slash"></i>
                        </div>
                        <h3>No Team Members Found</h3>
                        <p>Try different search terms or browse all team members.</p>
                        <button class="btn btn-outline-primary mt-3" wire:click="$set('search', '')">
                            <i class="fas fa-redo me-2"></i> Show All Members
                        </button>
                    </div>
                @endif
            @endif
        </div>
    </section>

    {{-- ============================================
         FINAL CTA
         ============================================ --}}
    <section class="tm-final-cta">
        <div class="container text-center">
            <h2>Want to Work With Our Expert Team?</h2>
            <p class="mb-4">Let our skilled professionals handle your engineering needs with precision and care.</p>
            <div class="tm-final-cta-buttons">
                <a href="{{ route('quote.index') }}" class="tm-btn tm-btn-lg tm-btn-accent">
                    <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                </a>
                <a href="tel:+923048902805" class="tm-btn tm-btn-lg tm-btn-white-outline-dark">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================
         TEAM MEMBER MODAL
         ============================================ --}}
    <div class="tm-modal-overlay" 
         x-show="showModal" 
         x-transition.opacity
         @click.self="closeModal"
         x-cloak>
        <div class="tm-modal-content" @click.stop>
            <button class="tm-modal-close" @click="closeModal">&times;</button>
            
            @if($selectedMember)
                <div class="row g-4">
                    <div class="col-md-5">
                        <div class="tm-modal-image">
                            <img src="{{ asset($selectedMember->ot_image) }}" 
                                 alt="{{ $selectedMember->ot_name }}" 
                                 loading="lazy">
                        </div>
                        
                        @if($selectedMember->ot_experience)
                            <div class="tm-modal-exp-badge">
                                <i class="fas fa-briefcase"></i>
                                {{ $selectedMember->ot_experience }}+ Years Experience
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-7">
                        <h2 class="tm-modal-name">{{ $selectedMember->ot_name }}</h2>
                        <span class="tm-modal-role">{{ $selectedMember->ot_designation }}</span>
                        
                        @if($selectedMember->ot_description)
                            <div class="tm-modal-desc">
                                <p>{!! $selectedMember->ot_description !!}</p>
                            </div>
                        @endif
                        
                        {{-- Contact Info --}}
                        <div class="tm-modal-contact">
                            @if($selectedMember->ot_phone)
                                <a href="tel:{{ $selectedMember->ot_phone }}" class="tm-contact-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <span>{{ $selectedMember->ot_phone }}</span>
                                </a>
                            @endif
                            @if($selectedMember->ot_email)
                                <a href="mailto:{{ $selectedMember->ot_email }}" class="tm-contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>{{ $selectedMember->ot_email }}</span>
                                </a>
                            @endif
                        </div>
                        
                        {{-- Skills --}}
                        @php $skills = $selectedMember->skills_list; @endphp
                        @if(count($skills) > 0)
                            <div class="tm-modal-skills">
                                <h6>Expertise & Skills</h6>
                                <div class="tm-skills-list">
                                    @foreach($skills as $skill)
                                        <span class="tm-skill-tag">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        {{-- Social Links --}}
                        <div class="tm-modal-social">
                            @if($selectedMember->ot_fb)
                                <a href="{{ $selectedMember->ot_fb }}" target="_blank" class="tm-social-btn">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif
                            @if($selectedMember->ot_inst)
                                <a href="{{ $selectedMember->ot_inst }}" target="_blank" class="tm-social-btn">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif
                            @if($selectedMember->ot_twitter)
                                <a href="{{ $selectedMember->ot_twitter }}" target="_blank" class="tm-social-btn">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @endif
                            @if($selectedMember->ot_linkedin)
                                <a href="{{ $selectedMember->ot_linkedin }}" target="_blank" class="tm-social-btn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>


<style>
/* ============================================
   TEAM PAGE - ENTERPRISE GRADE DESIGN
   Laravel 13 + Livewire 4 Compatible
   ============================================ */

[x-cloak] { display: none !important; }

/* --- Mobile Sticky CTA --- */
.tm-mobile-cta {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 998;
    display: flex; background: #fff; box-shadow: 0 -4px 20px rgba(0,0,0,0.12);
}

.tm-mobile-btn {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
    padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none;
    border: none; cursor: pointer; transition: all 0.2s;
}

.tm-mobile-call { background: #f8f9fa; color: #0a1628; }
.tm-mobile-whatsapp { background: #25D366; color: #fff; }
.tm-mobile-quote { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; }

/* --- Hero Section --- */
.tm-hero {
    position: relative; padding: 90px 0 70px; overflow: hidden;
    min-height: 420px; display: flex; align-items: center;
}

.tm-hero-bg {
    position: absolute; inset: 0;
    background: url('{{ asset("images/team-hero-bg.jpg") }}') center/cover no-repeat;
    filter: brightness(0.3);
}

.tm-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,61,128,0.88) 0%, rgba(26,92,42,0.82) 100%);
}

.tm-hero .container { position: relative; z-index: 2; }

.tm-breadcrumb {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px;
    font-size: 0.84rem; color: rgba(255,255,255,0.7);
}

.tm-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.tm-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.tm-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.tm-breadcrumb a:hover { color: #fff; }
.tm-breadcrumb .active { color: rgba(255,255,255,0.6); }

.tm-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
    color: #fff; padding: 8px 18px; border-radius: 50px;
    font-size: 0.85rem; font-weight: 600; margin-bottom: 18px;
}

.tm-hero-title { color: #fff; font-size: clamp(2.2rem, 5vw, 3rem); font-weight: 800; margin: 0 0 12px; line-height: 1.15; }
.tm-hero-subtitle { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 550px; margin: 0 0 25px; line-height: 1.6; }

.tm-hero-stats { display: flex; gap: 30px; flex-wrap: wrap; }
.tm-stat-item { text-align: center; }
.tm-stat-number { display: block; font-size: 1.8rem; font-weight: 800; color: #28a745; }
.tm-stat-label { font-size: 0.78rem; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 1px; }

/* --- Trust Bar --- */
.tm-trust-bar { background: #fff; border-bottom: 1px solid #eef0f2; }
.tm-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); }

.tm-trust-card {
    display: flex; align-items: center; gap: 12px; padding: 20px;
    border-right: 1px solid #f0f0f0;
}
.tm-trust-card:last-child { border-right: none; }

.tm-trust-icon {
    width: 44px; height: 44px; min-width: 44px; background: rgba(40,167,69,0.1);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #28a745; font-size: 1.1rem;
}

.tm-trust-card strong { display: block; font-size: 1.1rem; color: #0a1628; }
.tm-trust-card span { font-size: 0.75rem; color: #888; }

/* --- Main Section --- */
.tm-main-section { padding: 40px 0 60px; background: #f8f9fa; }

/* --- Section Header --- */
.tm-section-header { text-align: center; margin-bottom: 30px; }

.tm-section-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(40,167,69,0.1); color: #28a745; padding: 6px 16px;
    border-radius: 50px; font-size: 0.78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px;
}

.tm-section-header h2 { font-size: 1.8rem; font-weight: 800; color: #0a1628; margin-bottom: 5px; }
.tm-section-header p { color: #888; max-width: 600px; margin: 0 auto; }

/* --- Search --- */
.tm-search-wrapper { margin-bottom: 30px; display: flex; justify-content: center; }
.tm-search-inner { display: flex; align-items: center; gap: 12px; max-width: 550px; width: 100%; }

.tm-input-wrapper { position: relative; flex: 1; }

.tm-form-input {
    width: 100%; padding: 13px 40px 13px 44px; border: 2px solid #e9ecef;
    border-radius: 12px; font-size: 0.9rem; color: #333; background: #fff;
    transition: all 0.3s ease; outline: none;
}

.tm-form-input:focus { border-color: #28a745; box-shadow: 0 0 0 3px rgba(40,167,69,0.1); }

.tm-input-icon {
    position: absolute; left: 15px; top: 50%; transform: translateY(-50%);
    color: #aaa; font-size: 0.95rem;
}

.tm-search-clear {
    position: absolute; right: 8px; top: 50%; transform: translateY(-50%);
    background: #f0f0f0; border: none; width: 28px; height: 28px;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: #888; transition: all 0.2s;
}

.tm-search-clear:hover { background: #dc3545; color: #fff; }

.tm-search-count {
    background: #f0faf3; color: #28a745; padding: 10px 16px; border-radius: 10px;
    font-size: 0.85rem; font-weight: 600; white-space: nowrap;
}

/* --- Team Card --- */
.tm-card {
    background: #fff; border-radius: 16px; overflow: hidden;
    box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
    transition: all 0.4s ease; cursor: pointer; height: 100%;
    display: flex; flex-direction: column;
}

.tm-card:hover { transform: translateY(-6px); box-shadow: 0 18px 45px rgba(0,0,0,0.1); }

.tm-card-image {
    position: relative; aspect-ratio: 3/4; overflow: hidden; background: #f0f4f8;
}

.tm-card-image img {
    width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;
}

.tm-card:hover .tm-card-image img { transform: scale(1.06); }

.tm-card-overlay {
    position: absolute; inset: 0; background: rgba(0,54,108,0.75);
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.3s ease;
}

.tm-card:hover .tm-card-overlay { opacity: 1; }

.tm-overlay-btn {
    color: #fff; font-weight: 600; padding: 10px 22px; border: 2px solid #fff;
    border-radius: 8px; font-size: 0.85rem;
}

.tm-card-body { padding: 18px; text-align: center; flex: 1; display: flex; flex-direction: column; }

.tm-card-body h3 { font-size: 1rem; font-weight: 700; color: #0a1628; margin: 0 0 4px; }
.tm-card-role { font-size: 0.8rem; color: #28a745; font-weight: 600; display: block; margin-bottom: 8px; }

.tm-card-exp {
    font-size: 0.75rem; color: #888; margin-bottom: 10px;
    display: flex; align-items: center; justify-content: center; gap: 5px;
}

.tm-card-social { display: flex; justify-content: center; gap: 8px; margin-top: auto; padding-top: 10px; }

.tm-social-link {
    width: 32px; height: 32px; background: #f0f4f8; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #555; text-decoration: none; font-size: 0.8rem; transition: all 0.2s;
}

.tm-social-link:hover { background: #28a745; color: #fff; }

.tm-count-bar {
    text-align: center; margin-top: 25px; padding: 12px 20px;
    background: #fff; border-radius: 10px; font-size: 0.85rem; color: #888;
    box-shadow: 0 2px 10px rgba(0,0,0,0.03); border: 1px solid #eef0f2;
}

/* --- Modal --- */
.tm-modal-overlay {
    position: fixed; inset: 0; z-index: 99999; background: rgba(0,0,0,0.6);
    display: flex; align-items: center; justify-content: center; padding: 20px;
    backdrop-filter: blur(4px);
}

.tm-modal-content {
    background: #fff; border-radius: 20px; padding: 35px; max-width: 750px;
    width: 100%; max-height: 85vh; overflow-y: auto; position: relative;
    box-shadow: 0 25px 70px rgba(0,0,0,0.25); animation: modalIn 0.3s ease;
}

@keyframes modalIn { from { opacity: 0; transform: translateY(-20px) scale(0.95); } to { opacity: 1; transform: translateY(0) scale(1); } }

.tm-modal-close {
    position: absolute; top: 15px; right: 15px; background: #f0f0f0; border: none;
    width: 36px; height: 36px; border-radius: 50%; font-size: 1.3rem; cursor: pointer;
    color: #555; display: flex; align-items: center; justify-content: center;
    transition: all 0.2s; z-index: 2;
}

.tm-modal-close:hover { background: #dc3545; color: #fff; }

.tm-modal-image { border-radius: 14px; overflow: hidden; margin-bottom: 15px; }

.tm-modal-image img { width: 100%; aspect-ratio: 3/4; object-fit: cover; display: block; }

.tm-modal-exp-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(40,167,69,0.1); color: #28a745; padding: 8px 16px;
    border-radius: 10px; font-size: 0.85rem; font-weight: 600;
}

.tm-modal-name { font-size: 1.4rem; font-weight: 800; color: #0a1628; margin: 0 0 4px; }
.tm-modal-role { font-size: 0.9rem; color: #28a745; font-weight: 600; display: block; margin-bottom: 15px; }

.tm-modal-desc p { font-size: 0.9rem; color: #666; line-height: 1.75; margin-bottom: 15px; }

.tm-modal-contact { display: flex; flex-direction: column; gap: 8px; margin-bottom: 15px; }

.tm-contact-item {
    display: flex; align-items: center; gap: 10px; padding: 10px 14px;
    background: #f8f9fa; border-radius: 10px; text-decoration: none;
    color: #555; font-size: 0.88rem; transition: all 0.2s;
}

.tm-contact-item:hover { background: #f0faf3; color: #28a745; }
.tm-contact-item i { color: #28a745; width: 18px; }

.tm-modal-skills h6 { font-size: 0.85rem; font-weight: 700; color: #0a1628; margin-bottom: 8px; }

.tm-skills-list { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 15px; }

.tm-skill-tag {
    font-size: 0.73rem; padding: 5px 12px; background: #f0faf3;
    color: #28a745; border-radius: 50px; font-weight: 500;
}

.tm-modal-social { display: flex; gap: 8px; }

.tm-social-btn {
    width: 38px; height: 38px; background: #f0f4f8; border-radius: 50%;
    display: inline-flex; align-items: center; justify-content: center;
    color: #555; text-decoration: none; font-size: 0.9rem; transition: all 0.2s;
}

.tm-social-btn:hover { background: #0056b3; color: #fff; }

/* --- Final CTA --- */
.tm-final-cta { padding: 60px 0; background: #fff; }
.tm-final-cta h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 10px; }
.tm-final-cta p { font-size: 1rem; color: #666; max-width: 500px; margin: 0 auto 20px; }
.tm-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

.tm-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 0.9rem;
    text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none;
    white-space: nowrap;
}

.tm-btn-lg { padding: 14px 28px; font-size: 0.95rem; border-radius: 10px; }
.tm-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.tm-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; }

.tm-btn-white-outline-dark { background: transparent; color: #0a1628; border: 2px solid #0a1628; }
.tm-btn-white-outline-dark:hover { background: #0a1628; color: #fff; }

/* --- States --- */
.tm-state-box { text-align: center; padding: 60px 20px; }
.tm-error-card { max-width: 500px; margin: 40px auto; padding: 40px 30px; background: #fff; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); text-align: center; }
.tm-empty-state { text-align: center; padding: 60px 20px; }
.tm-empty-icon { width: 100px; height: 100px; margin: 0 auto 20px; background: rgba(40,167,69,0.08); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: #28a745; }
.tm-empty-state h3 { font-size: 1.3rem; font-weight: 700; color: #0a1628; }
.tm-empty-state p { color: #888; max-width: 400px; margin: 0 auto; }

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 1199.98px) {
    .tm-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .tm-trust-card:nth-child(2) { border-right: none; }
}

@media (max-width: 991.98px) {
    .tm-hero { padding: 60px 0 50px; min-height: auto; }
    .tm-hero-title { font-size: 1.8rem; }
    .tm-modal-content { padding: 25px; }
}

@media (max-width: 767.98px) {
    .tm-hero { padding: 45px 0 40px; }
    .tm-hero-title { font-size: 1.5rem; }
    .tm-hero-subtitle { font-size: 0.9rem; }
    .tm-hero-stats { gap: 15px; }
    .tm-stat-number { font-size: 1.4rem; }
    .tm-trust-grid { grid-template-columns: 1fr 1fr; }
    .tm-trust-card { padding: 14px; gap: 8px; }
    .tm-search-inner { flex-direction: column; }
    .tm-modal-content { padding: 20px; }
}

@media (max-width: 575.98px) {
    .tm-hero { padding: 35px 0 30px; }
    .tm-hero-title { font-size: 1.3rem; }
    .tm-hero-badge { font-size: 0.75rem; padding: 6px 14px; }
    .tm-breadcrumb { font-size: 0.75rem; }
    .tm-trust-grid { grid-template-columns: 1fr 1fr; }
    .tm-trust-card { padding: 12px 10px; border-bottom: 1px solid #f0f0f0; }
    .tm-trust-card:nth-child(even) { border-right: none; }
    .tm-trust-icon { width: 34px; height: 34px; min-width: 34px; font-size: 0.9rem; }
    .tm-modal-name { font-size: 1.2rem; }
    .tm-final-cta { padding: 40px 0; }
    .tm-final-cta-buttons { flex-direction: column; }
    .tm-final-cta-buttons .tm-btn { width: 100%; justify-content: center; }
    body { padding-bottom: 55px; }
}
</style>


<script>
document.addEventListener('livewire:navigated', () => {
    if (typeof AOS !== 'undefined') AOS.refresh();
});
</script>