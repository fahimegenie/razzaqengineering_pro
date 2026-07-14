<!-- ============================================
     PROFESSIONAL INDUSTRIES SECTION
     ============================================ -->
<section class="industries-section-pro" id="industriesSection">
    <div class="container">
        
        {{-- Section Header --}}
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <span class="section-tag">WHO WE WORK WITH</span>
            <h2 class="section-heading">Industries <span class="text-gradient">We Serve</span></h2>
            <p class="section-desc">Delivering specialized engineering solutions across multiple sectors nationwide</p>
            <div class="section-divider"></div>
        </div>
        
        {{-- Industries Grid --}}
        <div class="row g-4">
            
            {{-- Construction --}}
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="industry-card">
                    <div class="industry-icon-wrap">
                        <div class="industry-icon">
                            <i class="fas fa-hard-hat"></i>
                        </div>
                        <div class="industry-watermark">
                            <i class="fas fa-building"></i>
                        </div>
                    </div>
                    <div class="industry-content">
                        <h3 class="industry-title">Construction</h3>
                        <p class="industry-text">Residential & commercial building infrastructure with precision concrete cutting, drilling & demolition services.</p>
                    </div>
                    <div class="industry-hover-line"></div>
                    <div class="industry-number">01</div>
                </div>
            </div>
            
            {{-- Infrastructure --}}
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="industry-card">
                    <div class="industry-icon-wrap">
                        <div class="industry-icon">
                            <i class="fas fa-bridge"></i>
                        </div>
                        <div class="industry-watermark">
                            <i class="fas fa-road"></i>
                        </div>
                    </div>
                    <div class="industry-content">
                        <h3 class="industry-title">Infrastructure</h3>
                        <p class="industry-text">Bridges, dams & highway structural modifications with vibration-free cutting & controlled demolition.</p>
                    </div>
                    <div class="industry-hover-line"></div>
                    <div class="industry-number">02</div>
                </div>
            </div>
            
            {{-- Industrial --}}
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="industry-card">
                    <div class="industry-icon-wrap">
                        <div class="industry-icon">
                            <i class="fas fa-industry"></i>
                        </div>
                        <div class="industry-watermark">
                            <i class="fas fa-cogs"></i>
                        </div>
                    </div>
                    <div class="industry-content">
                        <h3 class="industry-title">Industrial</h3>
                        <p class="industry-text">Factory plants, warehouses & heavy manufacturing facilities with specialized concrete & anchoring solutions.</p>
                    </div>
                    <div class="industry-hover-line"></div>
                    <div class="industry-number">03</div>
                </div>
            </div>
            
            {{-- Commercial --}}
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="industry-card">
                    <div class="industry-icon-wrap">
                        <div class="industry-icon">
                            <i class="fas fa-city"></i>
                        </div>
                        <div class="industry-watermark">
                            <i class="fas fa-store-alt"></i>
                        </div>
                    </div>
                    <div class="industry-content">
                        <h3 class="industry-title">Commercial</h3>
                        <p class="industry-text">Shopping malls, hospitals & high-rise office towers with professional plumbing & fire fighting systems.</p>
                    </div>
                    <div class="industry-hover-line"></div>
                    <div class="industry-number">04</div>
                </div>
            </div>
            
        </div>
        
        {{-- Bottom CTA --}}
        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="500">
            <p class="industries-cta-text">Need services for your industry? We cover all major sectors across Pakistan.</p>
            <a href="{{ route('quote.index') }}" class="btn-industries-cta">
                <i class="fas fa-file-invoice me-2"></i> Get Custom Quote
            </a>
        </div>
        
    </div>
</section>

{{-- CSS --}}
@push('styles')
<style>
    /* ============================================
       INDUSTRIES SECTION
       ============================================ */
    .industries-section-pro {
        padding: 80px 0;
        background: #ffffff;
        position: relative;
    }
    
    /* Header */
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
        margin-bottom: 12px;
    }
    .section-divider {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #28a745, #0056b3);
        margin: 0 auto;
        border-radius: 2px;
    }
    
    /* ============================================
       INDUSTRY CARD
       ============================================ */
    .industry-card {
        background: #fff;
        border: 1px solid #eef0f2;
        border-radius: 16px;
        padding: 30px 25px 25px;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
    }
    
    .industry-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        border-color: #28a745;
    }
    
    /* Number Watermark */
    .industry-number {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 3.5rem;
        font-weight: 900;
        color: rgba(40,167,69,0.04);
        line-height: 1;
        transition: all 0.4s ease;
        pointer-events: none;
    }
    
    .industry-card:hover .industry-number {
        color: rgba(0,86,179,0.08);
        transform: scale(1.1);
    }
    
    /* Icon Section */
    .industry-icon-wrap {
        position: relative;
        margin-bottom: 20px;
        height: 70px;
    }
    
    .industry-icon {
        width: 62px;
        height: 62px;
        background: linear-gradient(135deg, rgba(40,167,69,0.08), rgba(0,86,179,0.08));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        color: #28a745;
        position: relative;
        z-index: 2;
        transition: all 0.4s ease;
    }
    
    .industry-card:hover .industry-icon {
        background: linear-gradient(135deg, #0056b3, #28a745);
        color: #fff;
        border-radius: 50%;
        box-shadow: 0 8px 25px rgba(40,167,69,0.3);
    }
    
    .industry-watermark {
        position: absolute;
        bottom: -10px;
        right: 10px;
        font-size: 50px;
        color: rgba(40,167,69,0.05);
        z-index: 1;
        transition: all 0.4s ease;
    }
    
    .industry-card:hover .industry-watermark {
        color: rgba(0,86,179,0.08);
    }
    
    /* Content */
    .industry-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #0a1628;
        margin-bottom: 8px;
        transition: color 0.3s ease;
    }
    
    .industry-card:hover .industry-title {
        color: #0056b3;
    }
    
    .industry-text {
        font-size: 0.88rem;
        color: #888;
        line-height: 1.65;
        margin: 0;
    }
    
    /* Hover Line */
    .industry-hover-line {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, #0056b3, #28a745);
        transition: width 0.4s ease;
        border-radius: 2px;
    }
    
    .industry-card:hover .industry-hover-line {
        width: 80%;
    }
    
    /* ============================================
       CTA
       ============================================ */
    .industries-cta-text {
        color: #888;
        font-size: 0.95rem;
        margin-bottom: 15px;
    }
    
    .btn-industries-cta {
        display: inline-flex;
        align-items: center;
        padding: 14px 32px;
        background: linear-gradient(135deg, #0056b3, #003d80);
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(0,86,179,0.25);
    }
    
    .btn-industries-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(0,86,179,0.4);
        color: #fff;
    }
    
    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 991.98px) {
        .industries-section-pro { padding: 60px 0; }
        .section-heading { font-size: 1.8rem; }
        .industry-card { padding: 25px 20px; }
    }
    
    @media (max-width: 767.98px) {
        .industries-section-pro { padding: 45px 0; }
        .section-heading { font-size: 1.5rem; }
        .industry-card { padding: 22px 18px; border-radius: 12px; }
        .industry-icon { width: 52px; height: 52px; font-size: 22px; border-radius: 12px; }
        .industry-number { font-size: 2.5rem; }
        .industry-title { font-size: 1.05rem; }
    }
    
    @media (max-width: 575.98px) {
        .industries-section-pro { padding: 35px 0; }
        .section-heading { font-size: 1.3rem; }
        .section-tag { font-size: 0.65rem; letter-spacing: 2px; }
        .industry-card { padding: 18px 15px; }
        .industry-icon { width: 44px; height: 44px; font-size: 18px; border-radius: 10px; }
        .industry-number { font-size: 2rem; }
        .industry-title { font-size: 0.95rem; }
        .industry-text { font-size: 0.82rem; }
        .btn-industries-cta { width: 100%; justify-content: center; }
    }
</style>
@endpush