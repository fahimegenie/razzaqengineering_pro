<!--================ Footer =================-->
<footer class="footer-section">
    <!-- Main Footer -->
    <div class="footer-main">
        <div class="container">
            <div class="row g-4">
                <!-- Company Info Column -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="footer-widget">
                        <div class="footer-logo mb-3">
                            @php 
                                $settings = App\Models\Setting::where('status', 1)->first();
                                $footerLogo = isset($settings) && !empty($settings->logo) 
                                    ? asset('uploads/settings/'.$settings->logo) 
                                    : asset('assets/images/logo-black.png');
                            @endphp
                            <img src="{{ $footerLogo }}" alt="Razzaq Engineering" class="footer-logo-img">
                        </div>
                        <p class="footer-about-text">
                            Razzaq Engineering Services is Pakistan's leading provider of professional 
                            <strong>RCC Core Cutting, Diamond Drilling, Wall Saw Cutting, Plumbing & Fire Fighting Services</strong>. 
                            Serving Lahore, Karachi, Islamabad, Rawalpindi & Peshawar with quality workmanship since years.
                        </p>
                        
                        <!-- Quick Contact -->
                        <div class="footer-contact-list">
                            <div class="footer-contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-label">Call Us 24/7</span>
                                    <a href="tel:+923048902805" class="contact-value">+92 304 8902805</a>
                                </div>
                            </div>
                            
                            <div class="footer-contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-label">Email Address</span>
                                    <a href="mailto:info@razzaqengineering.com" class="contact-value">info@razzaqengineering.com</a>
                                </div>
                            </div>
                            
                            <div class="footer-contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-label">Working Hours</span>
                                    <span class="contact-value">24/7 - Emergency Services Available</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Services Links Column -->
                <div class="col-lg-2 col-md-6 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Our Services</h4>
                        <ul class="footer-links-list">
                            @php
                                $footerServices = App\Models\Service::active()->ordered()->take(8)->get();
                            @endphp
                            @foreach($footerServices as $fs)
                                <li>
                                    <a href="{{ url('service-detail/'.str_replace(' ', '-', $fs->os_name)) }}">
                                        <i class="fas fa-chevron-right"></i> {{ $fs->os_name }}
                                    </a>
                                </li>
                            @endforeach
                            <li>
                                <a href="{{ route('home.services') }}">
                                    <i class="fas fa-chevron-right"></i> View All Services →
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Products Links Column -->
                <div class="col-lg-2 col-md-6 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Our Products</h4>
                        <ul class="footer-links-list">
                            @php
                                $footerProducts = App\Models\ProductCategory::active()->take(8)->get();
                            @endphp
                            @foreach($footerProducts as $fp)
                                <li>
                                    <a href="{{ url('products/'.str_replace(' ', '-', $fp->pc_name)) }}">
                                        <i class="fas fa-chevron-right"></i> {{ $fp->pc_name }}
                                    </a>
                                </li>
                            @endforeach
                            <li>
                                <a href="{{ url('products/p') }}">
                                    <i class="fas fa-chevron-right"></i> View All Products →
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Quick Links Column -->
                <div class="col-lg-2 col-md-6 col-sm-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Quick Links</h4>
                        <ul class="footer-links-list">
                            <li><a href="{{ url('/') }}"><i class="fas fa-chevron-right"></i> Home</a></li>
                            <li><a href="{{ route('home.about') }}"><i class="fas fa-chevron-right"></i> About Us</a></li>
                            <li><a href="{{ url('team') }}"><i class="fas fa-chevron-right"></i> Our Team</a></li>
                            <li><a href="{{ url('gallery') }}"><i class="fas fa-chevron-right"></i> Portfolio</a></li>
                            <li><a href="{{ url('projects') }}"><i class="fas fa-chevron-right"></i> Projects</a></li>
                            <li><a href="{{ route('home.faq') }}"><i class="fas fa-chevron-right"></i> FAQ</a></li>
                            <li><a href="{{ route('home.contact') }}"><i class="fas fa-chevron-right"></i> Contact Us</a></li>
                            <li><a href="{{ url('sitemap.xml') }}" target="_blank"><i class="fas fa-chevron-right"></i> Sitemap</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Our Branches Column -->
                <div class="col-lg-2 col-md-6 col-sm-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Our Branches</h4>
                        <div class="branch-list">
                            <div class="branch-item">
                                <h6 class="branch-city">
                                    <i class="fas fa-map-marker-alt"></i> Lahore (Head Office)
                                </h6>
                                <p class="branch-address">
                                    Plot 04, Ali Raza Abad, Haji Electronics Plaza, Raiwind Road, Lahore
                                </p>
                            </div>
                            
                            <div class="branch-item">
                                <h6 class="branch-city">
                                    <i class="fas fa-map-marker-alt"></i> Islamabad
                                </h6>
                                <p class="branch-address">
                                    #02 LG Hassan Arcade, 2 B Block, Near Masjid Al Basheer, Multi Garden B17, Islamabad
                                </p>
                            </div>
                            
                            <div class="branch-item">
                                <h6 class="branch-city">
                                    <i class="fas fa-map-marker-alt"></i> Karachi
                                </h6>
                                <p class="branch-address">
                                    #519 Gulzar E Hijri, Khatam e Nabuwat Chowk, Scheme 33, Karachi
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer Middle - CTA -->
    <div class="footer-cta">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-7 mb-3 mb-md-0">
                    <h3 class="footer-cta-title">Need Emergency Service? We're Available 24/7!</h3>
                    <p class="footer-cta-text">Call us now for immediate assistance or get a free quote for your project.</p>
                </div>
                <div class="col-lg-4 col-md-5 text-md-end">
                    <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                        <a href="tel:+923048902805" class="btn btn-cta-call">
                            <i class="fas fa-phone-alt me-2"></i> Call Now
                        </a>
                        <a href="{{ route('home.contact') }}" class="btn btn-cta-quote">
                            <i class="fas fa-paper-plane me-2"></i> Get Quote
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <!-- Copyright -->
                <div class="col-lg-6 col-md-6 mb-3 mb-md-0">
                    <p class="copyright-text">
                        &copy; {{ date('Y') }} <strong>Razzaq Engineering Services</strong>. All Rights Reserved.
                    </p>
                </div>
                
                <!-- Footer Bottom Links -->
                <div class="col-lg-3 col-md-6 mb-3 mb-md-0 text-md-center">
                    <div class="footer-bottom-links">
                        <a href="#">Privacy Policy</a>
                        <span class="divider">|</span>
                        <a href="#">Terms & Conditions</a>
                    </div>
                </div>
                
                <!-- Social Icons -->
                <div class="col-lg-3 col-md-12 text-md-end">
                    <div class="footer-social-icons">
                        <a href="https://web.facebook.com/razzaqengineering/" target="_blank" class="social-icon" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/razzaq_engineering" target="_blank" class="social-icon" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.tiktok.com/@razzaq_engineering" target="_blank" class="social-icon" title="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/razzaq-engineering-services-265b15401/" target="_blank" class="social-icon" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://myaccount.google.com/" target="_blank" class="social-icon" title="Google">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="mailto:info@razzaqengineering.com" class="social-icon" title="Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--================ End Footer =================-->