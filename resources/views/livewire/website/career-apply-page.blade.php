<div class="cra-page">
    @if($job)
        <section class="cra-hero">
            <div class="cra-hero-bg"></div><div class="cra-hero-overlay"></div>
            <div class="container position-relative">
                <div class="row" data-aos="fade-up">
                    <div class="col-lg-8">
                        <nav class="cra-breadcrumb"><ol><li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li><li><a href="{{ route('careers') }}">Careers</a></li><li><a href="{{ route('careers.detail', ['slug' => $job->slug]) }}">{{ $job->title }}</a></li><li class="active">Apply</li></ol></nav>
                        <h1 class="cra-hero-title">Apply for {{ $job->title }}</h1>
                        <div class="cra-hero-meta">
                            @if($job->department)<span><i class="fas fa-building"></i> {{ $job->department }}</span>@endif
                            @if($job->location)<span><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</span>@endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cra-main-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        @if($isSuccess)
                            <div class="cra-success-card" data-aos="fade-up">
                                <div class="cra-success-icon"><i class="fas fa-check-circle"></i></div>
                                <h2>Application Submitted!</h2>
                                <p>Thank you for applying. We'll review your application and get back to you soon.</p>
                                <a href="{{ route('careers') }}" class="cra-btn cra-btn-accent"><i class="fas fa-arrow-left me-2"></i> Back to Careers</a>
                            </div>
                        @else
                            <div class="cra-form-card" data-aos="fade-up">
                                <h2>Submit Your Application</h2>
                                <p class="cra-form-subtitle">Fill out the form below to apply for <strong>{{ $job->title }}</strong></p>
                                
                                <form wire:submit="submitApplication" class="cra-form">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="cra-form-label">Full Name <span>*</span></label>
                                            <input type="text" wire:model.blur="name" class="cra-form-input @error('name') error @enderror" placeholder="Your full name">
                                            @error('name') <small class="cra-error-text">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="cra-form-label">Email Address <span>*</span></label>
                                            <input type="email" wire:model.blur="email" class="cra-form-input @error('email') error @enderror" placeholder="email@example.com">
                                            @error('email') <small class="cra-error-text">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="cra-form-label">Phone Number <span>*</span></label>
                                            <input type="tel" wire:model.blur="phone" class="cra-form-input @error('phone') error @enderror" placeholder="+92 300 1234567">
                                            @error('phone') <small class="cra-error-text">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="cra-form-label">Resume (PDF/DOC) <small>(Max 5MB)</small></label>
                                            <input type="file" wire:model="resume" class="cra-form-input @error('resume') error @enderror" accept=".pdf,.doc,.docx">
                                            @error('resume') <small class="cra-error-text">{{ $message }}</small> @enderror
                                            <div wire:loading wire:target="resume" class="text-success small mt-1"><i class="fas fa-spinner fa-spin me-1"></i> Uploading...</div>
                                        </div>
                                        <div class="col-12">
                                            <label class="cra-form-label">Cover Letter <small>(Optional)</small></label>
                                            <textarea wire:model.blur="cover_letter" class="cra-form-input cra-form-textarea" rows="5" placeholder="Tell us why you're a great fit..."></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="cra-btn cra-btn-submit" wire:loading.attr="disabled">
                                                <span wire:loading.remove><i class="fas fa-paper-plane me-2"></i> Submit Application</span>
                                                <span wire:loading><span class="spinner-border spinner-border-sm me-2"></span> Submitting...</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="cra-main-section"><div class="container"><div class="cra-error-card"><i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;"></i><h4 class="fw-bold mt-3">Job Not Found</h4><p class="text-muted">This job posting may have expired.</p><a href="{{ route('careers') }}" class="btn btn-primary mt-3"><i class="fas fa-arrow-left me-2"></i> Back to Careers</a></div></div></section>
    @endif
</div>

<style>
.cra-hero { position: relative; padding: 70px 0 50px; overflow: hidden; min-height: 280px; display: flex; align-items: center; }
.cra-hero-bg { position: absolute; inset: 0; background: url('{{ asset("images/careers-hero-bg.jpg") }}') center/cover no-repeat; filter: brightness(0.3); }
.cra-hero-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(0,61,128,0.88) 0%, rgba(26,92,42,0.82) 100%); }
.cra-hero .container { position: relative; z-index: 2; }
.cra-breadcrumb ol { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px; font-size: 0.84rem; color: rgba(255,255,255,0.7); }
.cra-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.cra-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.cra-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.cra-hero-title { color: #fff; font-size: clamp(1.8rem, 4vw, 2.2rem); font-weight: 800; margin: 0 0 10px; }
.cra-hero-meta { display: flex; gap: 15px; flex-wrap: wrap; }
.cra-hero-meta span { display: flex; align-items: center; gap: 6px; color: rgba(255,255,255,0.85); font-size: 0.9rem; }
.cra-hero-meta i { color: #28a745; }
.cra-main-section { padding: 40px 0 60px; background: #f8f9fa; }
.cra-form-card { background: #fff; border-radius: 16px; padding: 30px; box-shadow: 0 8px 35px rgba(0,0,0,0.06); border: 1px solid #eef0f2; }
.cra-form-card h2 { font-size: 1.4rem; font-weight: 800; color: #0a1628; margin-bottom: 4px; }
.cra-form-subtitle { color: #888; font-size: 0.9rem; margin-bottom: 20px; }
.cra-form-label { font-size: 0.78rem; font-weight: 600; color: #555; margin-bottom: 4px; display: block; }
.cra-form-label span { color: #dc3545; }
.cra-form-input { width: 100%; padding: 12px 16px; border: 2px solid #e9ecef; border-radius: 10px; font-size: 0.9rem; color: #333; background: #fff; transition: all 0.3s ease; outline: none; }
.cra-form-input:focus { border-color: #28a745; box-shadow: 0 0 0 3px rgba(40,167,69,0.1); }
.cra-form-input.error { border-color: #dc3545; }
.cra-form-textarea { resize: vertical; min-height: 100px; }
.cra-error-text { color: #dc3545; font-size: 0.75rem; display: block; margin-top: 4px; }
.cra-btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 0.9rem; text-decoration: none; transition: all 0.3s ease; border: none; cursor: pointer; }
.cra-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.cra-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; }
.cra-btn-submit { width: 100%; padding: 14px; background: linear-gradient(135deg, #0056b3, #003d80); color: #fff; font-size: 0.95rem; border-radius: 10px; box-shadow: 0 6px 25px rgba(0,86,179,0.3); }
.cra-btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(0,86,179,0.45); color: #fff; }
.cra-btn-submit:disabled { opacity: 0.6; cursor: not-allowed; }
.cra-success-card { background: #fff; border-radius: 16px; padding: 40px 30px; text-align: center; box-shadow: 0 8px 35px rgba(0,0,0,0.06); }
.cra-success-icon { width: 80px; height: 80px; margin: 0 auto 15px; background: rgba(40,167,69,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: #28a745; }
.cra-success-card h2 { font-size: 1.4rem; font-weight: 800; color: #0a1628; }
.cra-success-card p { color: #888; max-width: 400px; margin: 0 auto 15px; }
.cra-error-card { max-width: 500px; margin: 40px auto; padding: 40px 30px; background: #fff; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); text-align: center; }
@media (max-width: 767.98px) { .cra-hero { padding: 45px 0 35px; min-height: auto; } .cra-hero-title { font-size: 1.4rem; } .cra-form-card { padding: 20px; } }
@media (max-width: 575.98px) { .cra-hero { padding: 35px 0 25px; } .cra-hero-title { font-size: 1.2rem; } .cra-form-card { padding: 16px; border-radius: 12px; } .cra-form-input { padding: 10px 14px; font-size: 0.84rem; } }
</style>