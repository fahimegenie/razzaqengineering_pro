<div class="crd-page">
    @if($job)
        <section class="crd-hero">
            <div class="crd-hero-bg"></div><div class="crd-hero-overlay"></div>
            <div class="container position-relative">
                <div class="row" data-aos="fade-up">
                    <div class="col-lg-8">
                        <nav class="crd-breadcrumb"><ol><li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li><li><a href="{{ route('careers') }}">Careers</a></li><li class="active">{{ $job->title }}</li></ol></nav>
                        <div class="crd-hero-badge"><i class="fas fa-briefcase"></i> {{ $job->department ?? 'Job Opening' }}</div>
                        <h1 class="crd-hero-title">{{ $job->title }}</h1>
                        <div class="crd-hero-meta">
                            @if($job->location)<span><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</span>@endif
                            @if($job->job_type)<span><i class="fas fa-clock"></i> {{ $job->job_type }}</span>@endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="crd-main-section">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-8" data-aos="fade-up">
                        <div class="crd-content-card">
                            <div class="crd-content-body">
                                <h2>Job Description</h2>
                                <div class="crd-description">{!! $job->description !!}</div>
                                @if($job->requirements)
                                    <h3 class="mt-4">Requirements</h3>
                                    <div class="crd-description">{!! $job->requirements !!}</div>
                                @endif
                                @if($job->benefits)
                                    <h3 class="mt-4">Benefits</h3>
                                    <div class="crd-description">{!! $job->benefits !!}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" data-aos="fade-left">
                        <div class="crd-sidebar">
                            <div class="crd-sidebar-card crd-sidebar-cta">
                                <i class="fas fa-paper-plane crd-sidebar-icon"></i>
                                <h4>Interested in this position?</h4>
                                <p>Apply now and join our team</p>
                                <a href="{{ route('careers.apply', ['slug' => $job->slug]) }}" class="crd-btn crd-btn-accent w-100"><i class="fas fa-paper-plane me-2"></i> Apply Now</a>
                            </div>
                            <div class="crd-sidebar-card">
                                <h5 class="crd-sidebar-title">Job Overview</h5>
                                <div class="crd-info-list">
                                    @if($job->department)<div class="crd-info-item"><i class="fas fa-building"></i><span>Department</span><strong>{{ $job->department }}</strong></div>@endif
                                    @if($job->location)<div class="crd-info-item"><i class="fas fa-map-marker-alt"></i><span>Location</span><strong>{{ $job->location }}</strong></div>@endif
                                    @if($job->job_type)<div class="crd-info-item"><i class="fas fa-clock"></i><span>Job Type</span><strong>{{ $job->job_type }}</strong></div>@endif
                                    @if($job->salary_range)<div class="crd-info-item"><i class="fas fa-money-bill-wave"></i><span>Salary</span><strong>{{ $job->salary_range }}</strong></div>@endif
                                    @if($job->experience)<div class="crd-info-item"><i class="fas fa-briefcase"></i><span>Experience</span><strong>{{ $job->experience }}</strong></div>@endif
                                    @if($job->qualification)<div class="crd-info-item"><i class="fas fa-graduation-cap"></i><span>Qualification</span><strong>{{ $job->qualification }}</strong></div>@endif
                                </div>
                            </div>
                            @if($relatedJobs->count() > 0)
                                <div class="crd-sidebar-card"><h5 class="crd-sidebar-title">Related Jobs</h5>
                                    @foreach($relatedJobs as $rj)
                                        <a href="{{ route('careers.detail', ['slug' => $rj->slug]) }}" class="crd-related-item"><div><h6>{{ $rj->title }}</h6><small>{{ $rj->location }} • {{ $rj->job_type }}</small></div><i class="fas fa-chevron-right"></i></a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="crd-main-section"><div class="container"><div class="crd-error-card"><i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;"></i><h4 class="fw-bold mt-3">Job Not Found</h4><p class="text-muted">This job posting may have expired or been removed.</p><a href="{{ route('careers') }}" class="btn btn-primary mt-3"><i class="fas fa-arrow-left me-2"></i> Back to Careers</a></div></div></section>
    @endif
</div>

<style>
.crd-hero { position: relative; padding: 80px 0 60px; overflow: hidden; min-height: 350px; display: flex; align-items: center; }
.crd-hero-bg { position: absolute; inset: 0; background: url('{{ asset("images/careers-hero-bg.jpg") }}') center/cover no-repeat; filter: brightness(0.3); }
.crd-hero-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(0,61,128,0.88) 0%, rgba(26,92,42,0.82) 100%); }
.crd-hero .container { position: relative; z-index: 2; }
.crd-breadcrumb ol { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px; font-size: 0.84rem; color: rgba(255,255,255,0.7); }
.crd-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.crd-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.crd-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.crd-hero-badge { display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); color: #fff; padding: 8px 18px; border-radius: 50px; font-size: 0.85rem; font-weight: 600; margin-bottom: 15px; }
.crd-hero-title { color: #fff; font-size: clamp(2rem, 4vw, 2.5rem); font-weight: 800; margin: 0 0 12px; }
.crd-hero-meta { display: flex; gap: 15px; flex-wrap: wrap; }
.crd-hero-meta span { display: flex; align-items: center; gap: 6px; color: rgba(255,255,255,0.85); font-size: 0.9rem; }
.crd-hero-meta i { color: #28a745; }
.crd-main-section { padding: 40px 0 60px; background: #f8f9fa; }
.crd-content-card { background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2; }
.crd-content-body { padding: 30px; }
.crd-content-body h2 { font-size: 1.4rem; font-weight: 800; color: #0a1628; margin-bottom: 15px; }
.crd-content-body h3 { font-size: 1.15rem; font-weight: 700; color: #0a1628; }
.crd-description { font-size: 0.92rem; color: #666; line-height: 1.8; }
.crd-description p { margin-bottom: 10px; }
.crd-description ul { padding-left: 20px; margin-bottom: 10px; }
.crd-description li { margin-bottom: 5px; }
.crd-sidebar { position: sticky; top: 20px; }
.crd-sidebar-card { background: #fff; border-radius: 14px; padding: 20px; margin-bottom: 15px; box-shadow: 0 3px 15px rgba(0,0,0,0.05); border: 1px solid #eef0f2; }
.crd-sidebar-cta { text-align: center; background: linear-gradient(135deg, #0056b3, #003d80); color: #fff; border: none; }
.crd-sidebar-icon { font-size: 2rem; margin-bottom: 10px; display: block; }
.crd-sidebar-cta h4 { font-size: 1.1rem; font-weight: 800; margin: 0 0 5px; }
.crd-sidebar-cta p { font-size: 0.8rem; opacity: 0.8; margin-bottom: 15px; }
.crd-sidebar-title { font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #888; margin-bottom: 12px; }
.crd-info-item { display: flex; align-items: center; gap: 10px; padding: 10px 0; border-bottom: 1px solid #f5f5f5; }
.crd-info-item:last-child { border-bottom: none; }
.crd-info-item i { color: #28a745; width: 18px; }
.crd-info-item span { display: block; font-size: 0.7rem; color: #aaa; text-transform: uppercase; }
.crd-info-item strong { display: block; font-size: 0.88rem; color: #0a1628; }
.crd-related-item { display: flex; align-items: center; gap: 10px; padding: 12px 0; border-bottom: 1px solid #f0f0f0; text-decoration: none; }
.crd-related-item:last-child { border-bottom: none; }
.crd-related-item h6 { font-size: 0.85rem; color: #0a1628; margin: 0 0 2px; }
.crd-related-item small { font-size: 0.75rem; color: #888; }
.crd-related-item i { margin-left: auto; color: #ccc; }
.crd-btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 0.9rem; text-decoration: none; transition: all 0.3s ease; border: none; cursor: pointer; }
.crd-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.crd-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; }
.crd-error-card { max-width: 500px; margin: 40px auto; padding: 40px 30px; background: #fff; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); text-align: center; }
@media (max-width: 991.98px) { .crd-hero { padding: 50px 0 40px; min-height: auto; } .crd-content-body { padding: 20px; } .crd-sidebar { position: static; } }
@media (max-width: 767.98px) { .crd-hero-title { font-size: 1.5rem; } .crd-content-body { padding: 16px; } }
@media (max-width: 575.98px) { .crd-hero { padding: 35px 0 30px; } .crd-hero-title { font-size: 1.3rem; } .crd-content-body { padding: 14px; } }
</style>