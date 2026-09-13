<!--================ Footer =================-->
<footer class="footer-section">
    @php
        $settings = App\Models\Setting::getCached();
        $footerServices = App\Models\OurService::active()->ordered()->take(6)->get();
        $footerProducts = App\Models\ProductCategory::active()->take(6)->get();
        $footerLogo = $settings->footer_logo_url ?? $settings->logo_url ?? asset('assets/images/logo-white.png');
        $primaryPhone = $settings->mobile_phone_1 ?? '+923048902805';
        $primaryPhoneClean = preg_replace('/[^0-9+]/', '', $primaryPhone);
        $primaryEmail = $settings->email_primary ?? 'info@razzaqengineering.com';
        $whatsappNumber = $settings->whatsapp_number ?? $settings->mobile_phone_1 ?? '+923048902805';
        $whatsappNumberClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
        $showQuoteForm = $settings->enable_quote_form ?? true;
        $showPortfolio = $settings->enable_portfolio ?? true;
        $showFaq = $settings->enable_faq ?? true;
        $is24x7 = $settings->is_24_7 ?? false;
        $isEmergency = $settings->is_emergency_service ?? false;
        $siteName = $settings->site_name ?? 'Razzaq Engineering Services';
        $companyName = $settings->company_name ?? $siteName;
    @endphp
    
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row g-4">
                
                <!-- Column 1: Company Info -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="footer-widget">
                        <div class="footer-logo mb-3">
                            <a href="{{ route('home.index') }}">
                                <img src="{{ $footerLogo }}" alt="{{ $siteName }}" class="footer-logo-img" loading="lazy">
                            </a>
                        </div>
                        <p class="footer-about">
                            {!! $settings->footer_aboutus !!}
                        </p>
                        
                        <div class="footer-contact">
                            <a href="tel:{{ $primaryPhoneClean }}" class="footer-contact-link">
                                <span class="footer-contact-icon"><i class="fas fa-phone-alt"></i></span>
                                <div>
                                    <small>{{ $is24x7 || $isEmergency ? '24/7 Emergency' : 'Call Us' }}</small>
                                    <strong>{{ $primaryPhone }}</strong>
                                </div>
                            </a>
                            <a href="mailto:{{ $primaryEmail }}" class="footer-contact-link">
                                <span class="footer-contact-icon"><i class="fas fa-envelope"></i></span>
                                <div>
                                    <small>Email Us</small>
                                    <strong>{{ $primaryEmail }}</strong>
                                </div>
                            </a>
                            <div class="footer-contact-link">
                                <span class="footer-contact-icon"><i class="fas fa-clock"></i></span>
                                <div>
                                    <small>Working Hours</small>
                                    <strong>
                                        @if($is24x7) 24/7 Available
                                        @elseif($isEmergency) 24/7 Emergency
                                        @elseif($settings->working_days && $settings->office_start_time)
                                            {{ $settings->working_days }}: {{ $settings->office_start_time }} - {{ $settings->office_end_time ?? '6:00 PM' }}
                                        @else Mon-Sat: 9AM - 6PM
                                        @endif
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Column 2: Services -->
                <div class="col-lg-2 col-md-6 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="footer-widget">
                        <h4 class="footer-title">Services</h4>
                        <ul class="footer-links">
                            @foreach($footerServices as $fs)
                                <li><a href="{{ route('service.detail.slug', ['slug' => $fs->os_slug]) }}">{{ $fs->os_name }}</a></li>
                            @endforeach
                            <li><a href="{{ route('home.services') }}" class="footer-link-highlight">View All →</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Column 3: Products -->
                <div class="col-lg-2 col-md-6 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="footer-widget">
                        <h4 class="footer-title">Products</h4>
                        <ul class="footer-links">
                            @foreach($footerProducts as $fp)
                                <li><a href="{{ route('product.detail', ['slug' => $fp->pc_slug]) }}">{{ $fp->pc_name }}</a></li>
                            @endforeach
                            <li><a href="{{ route('products') }}" class="footer-link-highlight">View All →</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Column 4: Quick Links -->
                <div class="col-lg-2 col-md-6 col-sm-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="footer-widget">
                        <h4 class="footer-title">Quick Links</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('home.about') }}">About Us</a></li>
                            <li><a href="{{ route('team') }}">Our Team</a></li>
                            <li><a href="{{ route('projects') }}">Projects</a></li>
                            @if($showPortfolio)<li><a href="{{ route('gallery') }}">Gallery</a></li>@endif
                            <li><a href="{{ route('testimonials') }}">Testimonials</a></li>
                            <li><a href="{{ route('blog.index') }}">Blog</a></li>
                            @if($showFaq)<li><a href="{{ route('home.faq') }}">FAQ</a></li>@endif
                            <li><a href="{{ route('careers') }}">Careers</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Column 5: Contact & Legal -->
                <div class="col-lg-2 col-md-6 col-sm-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="footer-widget">
                        <h4 class="footer-title">Get In Touch</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('home.contact') }}">Contact Us</a></li>
                            @if($showQuoteForm)<li><a href="{{ route('quote.index') }}">Get Free Quote</a></li>@endif
                            <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms-conditions') }}">Terms & Conditions</a></li>
                            <li><a href="{{ route('refund-policy') }}">Refund Policy</a></li>
                            <li><a href="{{ url('sitemap.xml') }}" target="_blank">Sitemap</a></li>
                        </ul>
                        
                        <h4 class="footer-title mt-3">Follow Us</h4>
                        <div class="footer-social">
                            @if($settings->facebook_url)
                            <a href="{{ $settings->facebook_url }}" target="_blank" class="footer-social-icon" title="Facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if($settings->instagram_url)
                            <a href="{{ $settings->instagram_url }}" target="_blank" class="footer-social-icon" title="Instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if($settings->tiktok_url)
                            <a href="{{ $settings->tiktok_url }}" target="_blank" class="footer-social-icon" title="TikTok" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                            @endif
                            @if($settings->linkedin_url)
                            <a href="{{ $settings->linkedin_url }}" target="_blank" class="footer-social-icon" title="LinkedIn" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            @endif
                            @if($settings->youtube_url)
                            <a href="{{ $settings->youtube_url }}" target="_blank" class="footer-social-icon" title="YouTube" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                            @endif
                            @if($settings->twitter_url)
                            <a href="{{ $settings->twitter_url }}" target="_blank" class="footer-social-icon" title="X/Twitter" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- Footer CTA Bar -->
    <div class="footer-cta-bar">
        <div class="container">
            <div class="footer-cta-inner">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h3>{{ $isEmergency ? '🚨 Emergency Service 24/7' : 'Need Professional Service?' }}</h3>
                        <p>{{ $is24x7 ? 'We\'re available around the clock.' : 'Get in touch for a free consultation.' }}</p>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <div class="footer-cta-buttons">
                            <a href="tel:{{ $primaryPhoneClean }}" class="footer-cta-btn footer-cta-call">
                                <i class="fas fa-phone-alt"></i> {{ $primaryPhone }}
                            </a>
                            @if($whatsappNumber)
                            <a href="https://wa.me/{{ $whatsappNumberClean }}" target="_blank" class="footer-cta-btn footer-cta-whatsapp">
                                <i class="fab fa-whatsapp"></i> Chat
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">
                <p class="footer-copyright">
                    &copy; {{ date('Y') }} <strong>{{ $companyName }}</strong>. All Rights Reserved.
                </p>
                <div class="footer-bottom-links">
                    <a href="{{ route('privacy-policy') }}">Privacy</a>
                    <a href="{{ route('terms-conditions') }}">Terms</a>
                    <a href="{{ url('sitemap.xml') }}" target="_blank">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
    
</footer>
<!--================ End Footer =================-->


<style>
/* ============================================
   FOOTER - PROFESSIONAL DESIGN
   ============================================ */

.footer-section {
    background: #0a1628;
    color: rgba(255,255,255,0.7);
    position: relative;
}

/* --- Footer Top --- */
.footer-top {
    padding: 70px 0 40px;
    position: relative;
}

.footer-top::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(40,167,69,0.08) 0%, transparent 70%);
    pointer-events: none;
}

/* --- Footer Widget --- */
.footer-widget {
    position: relative;
    z-index: 1;
}

.footer-logo-img {
    max-height: 45px;
    width: auto;
    filter: brightness(0) invert(1);
}

.footer-about {
    font-size: 0.85rem;
    line-height: 1.7;
    color: rgba(255,255,255,0.6);
    margin-bottom: 20px;
}

/* --- Footer Contact --- */
.footer-contact {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.footer-contact-link {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    color: rgba(255,255,255,0.7);
    transition: all 0.3s ease;
    padding: 8px 0;
}

.footer-contact-link:hover {
    color: #fff;
    transform: translateX(5px);
}

.footer-contact-icon {
    width: 40px;
    height: 40px;
    min-width: 40px;
    background: rgba(40,167,69,0.15);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #28a745;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.footer-contact-link:hover .footer-contact-icon {
    background: #28a745;
    color: #fff;
}

.footer-contact-link small {
    display: block;
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: rgba(255,255,255,0.4);
    margin-bottom: 2px;
}

.footer-contact-link strong {
    display: block;
    font-size: 0.9rem;
    color: #fff;
    font-weight: 600;
}

/* --- Footer Title --- */
.footer-title {
    color: #fff;
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 18px;
    position: relative;
    padding-bottom: 12px;
}

.footer-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 30px;
    height: 2px;
    background: #28a745;
    border-radius: 2px;
}

/* --- Footer Links --- */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 8px;
}

.footer-links li a {
    color: rgba(255,255,255,0.6);
    text-decoration: none;
    font-size: 0.84rem;
    transition: all 0.3s ease;
    display: inline-block;
    position: relative;
}

.footer-links li a::before {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 0;
    height: 1px;
    background: #28a745;
    transition: width 0.3s ease;
}

.footer-links li a:hover {
    color: #fff;
    transform: translateX(5px);
}

.footer-links li a:hover::before {
    width: 100%;
}

.footer-link-highlight {
    color: #28a745 !important;
    font-weight: 600;
}

.footer-link-highlight:hover {
    color: #fff !important;
}

/* --- Footer Social --- */
.footer-social {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.footer-social-icon {
    width: 36px;
    height: 36px;
    background: rgba(255,255,255,0.08);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.6);
    text-decoration: none;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.footer-social-icon:hover {
    background: #28a745;
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(40,167,69,0.3);
}

/* --- Footer CTA Bar --- */
.footer-cta-bar {
    border-top: 1px solid rgba(255,255,255,0.06);
    border-bottom: 1px solid rgba(255,255,255,0.06);
}

.footer-cta-inner {
    padding: 25px 0;
}

.footer-cta-inner h3 {
    color: #fff;
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 4px;
}

.footer-cta-inner p {
    color: rgba(255,255,255,0.6);
    margin: 0;
    font-size: 0.88rem;
}

.footer-cta-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: flex-end;
}

.footer-cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 22px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.88rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-cta-call {
    background: #28a745;
    color: #fff;
}

.footer-cta-call:hover {
    background: #1e7e34;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(40,167,69,0.3);
}

.footer-cta-whatsapp {
    background: #25D366;
    color: #fff;
}

.footer-cta-whatsapp:hover {
    background: #128C7E;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(37,211,102,0.3);
}

/* --- Footer Bottom --- */
.footer-bottom {
    padding: 18px 0;
}

.footer-bottom-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.footer-copyright {
    margin: 0;
    font-size: 0.82rem;
    color: rgba(255,255,255,0.5);
}

.footer-copyright strong {
    color: rgba(255,255,255,0.8);
}

.footer-bottom-links {
    display: flex;
    gap: 15px;
}

.footer-bottom-links a {
    color: rgba(255,255,255,0.5);
    text-decoration: none;
    font-size: 0.8rem;
    transition: color 0.3s ease;
}

.footer-bottom-links a:hover {
    color: #28a745;
}

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 991.98px) {
    .footer-top {
        padding: 50px 0 30px;
    }
    .footer-cta-buttons {
        justify-content: flex-start;
        margin-top: 12px;
    }
}

@media (max-width: 767.98px) {
    .footer-top {
        padding: 40px 0 25px;
    }
    .footer-bottom-inner {
        flex-direction: column;
        text-align: center;
    }
    .footer-cta-inner {
        text-align: center;
    }
    .footer-cta-buttons {
        justify-content: center;
    }
}

@media (max-width: 575.98px) {
    .footer-top {
        padding: 35px 0 20px;
    }
    .footer-title {
        font-size: 0.9rem;
    }
    .footer-links li a {
        font-size: 0.8rem;
    }
    .footer-cta-btn {
        width: 100%;
        justify-content: center;
    }
    .footer-cta-buttons {
        flex-direction: column;
    }
    body {
        padding-bottom: 55px;
    }
}
</style>