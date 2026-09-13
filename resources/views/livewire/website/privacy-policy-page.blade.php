<div class="ppp-page">
    
    {{-- Sticky Mobile CTA --}}
    <div class="ppp-mobile-cta d-lg-none">
        <a href="tel:{{ $settings->mobile_phone_1 ?? '+923048902805' }}" class="ppp-mobile-btn ppp-mobile-call" aria-label="Call {{ $settings->site_name ?? 'Razzaq Engineering Services' }}">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? $settings->mobile_phone_1 ?? '+923048902805') }}" target="_blank" class="ppp-mobile-btn ppp-mobile-whatsapp" aria-label="Chat on WhatsApp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="{{ route('quote.index') }}" class="ppp-mobile-btn ppp-mobile-quote" aria-label="Get Free Quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    {{-- Hero Section - Improved --}}
    <section class="ppp-hero">
        <div class="ppp-hero-bg"></div>
        <div class="ppp-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-10" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="ppp-breadcrumb">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Privacy Policy</li>
                        </ol>
                    </nav>
                    
                    <div class="ppp-hero-badge">
                        <i class="fas fa-shield-alt"></i> Legal Information
                    </div>
                    
                    <h1 class="ppp-hero-title">Privacy Policy</h1>
                    <p class="ppp-hero-subtitle">
                        Your privacy matters. Learn how {{ $settings->site_name ?? 'Razzaq Engineering Services' }} collects, uses and protects your information.
                    </p>
                    @if($lastUpdated)
                        <p class="ppp-hero-date">
                            <i class="fas fa-calendar-check me-1"></i> Last Updated: {{ $lastUpdated }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Content Section - Width Adjusted --}}
    <section class="ppp-content-section">
        <div class="container">
            <div class="row g-4">
                
                {{-- Main Content - 72% Width --}}
                <div class="col-lg-9" data-aos="fade-up">
                    <div class="ppp-content-card">
                        
                        <div class="ppp-section" id="introduction">
                            <h2><span class="ppp-section-num">01</span> Introduction</h2>
                            <p>{{ $settings->site_name ?? 'Razzaq Engineering Services' }} ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website <strong>{{ config('app.url') }}</strong> or use our services.</p>
                            <p>Please read this privacy policy carefully. If you do not agree with the terms of this privacy policy, please do not access the site or use our services.</p>
                        </div>

                        <div class="ppp-section" id="information-collection">
                            <h2><span class="ppp-section-num">02</span> Information We Collect</h2>
                            <h3>2.1 Personal Information</h3>
                            <p>We may collect personal information that you voluntarily provide to us when you:</p>
                            <ul>
                                <li>Fill out our contact form or quote request form</li>
                                <li>Subscribe to our newsletter</li>
                                <li>Apply for a job/career position</li>
                                <li>Contact us via phone, email, or WhatsApp</li>
                                <li>Create an account (if applicable)</li>
                            </ul>
                            <p>The personal information we collect may include:</p>
                            <ul>
                                <li>Full name</li><li>Email address</li><li>Phone number</li>
                                <li>Company name</li><li>City/Location</li>
                                <li>Project requirements and messages</li><li>Resume/CV (for job applications)</li>
                            </ul>
                            <h3>2.2 Automatically Collected Information</h3>
                            <p>When you visit our website, we may automatically collect certain information including:</p>
                            <ul>
                                <li>IP address</li><li>Browser type and version</li><li>Operating system</li>
                                <li>Pages visited and time spent</li><li>Referring website/source</li><li>Device type</li>
                            </ul>
                        </div>

                        <div class="ppp-section" id="how-we-use">
                            <h2><span class="ppp-section-num">03</span> How We Use Your Information</h2>
                            <p>We use the collected information for the following purposes:</p>
                            <ul>
                                <li>To respond to your inquiries and provide customer support</li>
                                <li>To process and manage quote requests</li>
                                <li>To send administrative information, updates, and service-related communications</li>
                                <li>To improve our website, services, and user experience</li>
                                <li>To analyze website usage and trends</li>
                                <li>To prevent fraudulent activities and ensure security</li>
                                <li>To comply with legal obligations</li>
                            </ul>
                        </div>

                        <div class="ppp-section" id="sharing">
                            <h2><span class="ppp-section-num">04</span> Information Sharing & Disclosure</h2>
                            <p>We do <strong>not</strong> sell, trade, or rent your personal information to third parties. We may share your information only in the following circumstances:</p>
                            <ul>
                                <li><strong>Service Providers:</strong> With trusted third-party vendors who assist us in operating our website and business</li>
                                <li><strong>Legal Requirements:</strong> When required by law, court order, or governmental regulation</li>
                                <li><strong>Business Transfers:</strong> In connection with a merger, acquisition, or sale of company assets</li>
                                <li><strong>With Your Consent:</strong> When you explicitly authorize us to share your information</li>
                            </ul>
                        </div>

                        <div class="ppp-section" id="security">
                            <h2><span class="ppp-section-num">05</span> Data Security</h2>
                            <p>We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. These measures include:</p>
                            <ul>
                                <li>SSL/TLS encryption for data transmission</li><li>Secure server infrastructure</li>
                                <li>Regular security assessments</li><li>Access controls and authentication</li><li>Staff training on data protection</li>
                            </ul>
                            <p>However, no method of transmission over the Internet or electronic storage is 100% secure. While we strive to protect your personal information, we cannot guarantee its absolute security.</p>
                        </div>

                        <div class="ppp-section" id="cookies">
                            <h2><span class="ppp-section-num">06</span> Cookies & Tracking Technologies</h2>
                            <p>We may use cookies and similar tracking technologies to:</p>
                            <ul>
                                <li>Remember your preferences and settings</li><li>Understand how you use our website</li>
                                <li>Improve site performance and user experience</li><li>Analyze traffic patterns</li>
                            </ul>
                            <p>You can control cookies through your browser settings. Disabling cookies may affect the functionality of certain features on our website.</p>
                        </div>

                        <div class="ppp-section" id="third-party">
                            <h2><span class="ppp-section-num">07</span> Third-Party Links</h2>
                            <p>Our website may contain links to third-party websites (e.g., social media platforms, partner websites). We are not responsible for the privacy practices or content of these external sites. We encourage you to review the privacy policies of any third-party sites you visit.</p>
                        </div>

                        <div class="ppp-section" id="retention">
                            <h2><span class="ppp-section-num">08</span> Data Retention</h2>
                            <p>We retain your personal information only for as long as necessary to fulfill the purposes outlined in this Privacy Policy, unless a longer retention period is required by law. When your information is no longer needed, we will securely delete or anonymize it.</p>
                        </div>

                        <div class="ppp-section" id="rights">
                            <h2><span class="ppp-section-num">09</span> Your Rights</h2>
                            <p>Depending on your location and applicable laws, you may have the following rights:</p>
                            <ul>
                                <li><strong>Access:</strong> Request access to your personal data we hold</li>
                                <li><strong>Correction:</strong> Request correction of inaccurate or incomplete data</li>
                                <li><strong>Deletion:</strong> Request deletion of your personal data</li>
                                <li><strong>Objection:</strong> Object to processing of your personal data</li>
                                <li><strong>Portability:</strong> Request transfer of your data to another service</li>
                                <li><strong>Withdraw Consent:</strong> Withdraw consent at any time</li>
                            </ul>
                            <p>To exercise any of these rights, please contact us using the information below.</p>
                        </div>

                        <div class="ppp-section" id="children">
                            <h2><span class="ppp-section-num">10</span> Children's Privacy</h2>
                            <p>Our services are not directed to individuals under the age of 18. We do not knowingly collect personal information from children. If you believe a child has provided us with personal data, please contact us immediately.</p>
                        </div>

                        <div class="ppp-section" id="changes">
                            <h2><span class="ppp-section-num">11</span> Changes to This Privacy Policy</h2>
                            <p>We reserve the right to update or modify this Privacy Policy at any time. Changes will be effective immediately upon posting on this page with an updated "Last Updated" date. We encourage you to review this policy periodically for any changes.</p>
                        </div>

                        <div class="ppp-section ppp-contact-section" id="contact">
                            <h2><span class="ppp-section-num">12</span> Contact Us</h2>
                            <p>If you have any questions, concerns, or requests regarding this Privacy Policy, please contact us:</p>
                            <div class="ppp-contact-info">
                                <div class="ppp-contact-item">
                                    <i class="fas fa-building"></i>
                                    <div>
                                        <strong>{{ $settings->site_name ?? 'Razzaq Engineering Services' }}</strong>
                                        @if($settings->address_1)<span>{{ $settings->address_1 }}</span>@endif
                                    </div>
                                </div>
                                <div class="ppp-contact-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <div>
                                        <strong>Phone</strong>
                                        <a href="tel:{{ $settings->mobile_phone_1 ?? '+923048902805' }}" aria-label="Call {{ $settings->site_name ?? 'Razzaq Engineering Services' }}">{{ $settings->mobile_phone_1 ?? '+92 304 8902805' }}</a>
                                    </div>
                                </div>
                                <div class="ppp-contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <strong>Email</strong>
                                        <a href="mailto:{{ $settings->email_primary ?? 'info@razzaqengineering.com' }}">{{ $settings->email_primary ?? 'info@razzaqengineering.com' }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
                {{-- Sidebar - 28% Width --}}
                <div class="col-lg-3" data-aos="fade-left">
                    <div class="ppp-sidebar">
                        
                        <div class="ppp-sidebar-card" x-data="sidebarNav()" x-init="init()">
                            <h4>On This Page</h4>
                            <ul class="ppp-nav-list">
                                <li><a href="#introduction" @click.prevent="scrollTo('introduction')" :class="{ 'active': activeSection === 'introduction' }" aria-label="Jump to Introduction section">01. Introduction</a></li>
                                <li><a href="#information-collection" @click.prevent="scrollTo('information-collection')" :class="{ 'active': activeSection === 'information-collection' }" aria-label="Jump to Information Collection section">02. Information Collection</a></li>
                                <li><a href="#how-we-use" @click.prevent="scrollTo('how-we-use')" :class="{ 'active': activeSection === 'how-we-use' }" aria-label="Jump to How We Use section">03. How We Use</a></li>
                                <li><a href="#sharing" @click.prevent="scrollTo('sharing')" :class="{ 'active': activeSection === 'sharing' }" aria-label="Jump to Information Sharing section">04. Sharing</a></li>
                                <li><a href="#security" @click.prevent="scrollTo('security')" :class="{ 'active': activeSection === 'security' }" aria-label="Jump to Data Security section">05. Data Security</a></li>
                                <li><a href="#cookies" @click.prevent="scrollTo('cookies')" :class="{ 'active': activeSection === 'cookies' }" aria-label="Jump to Cookies section">06. Cookies</a></li>
                                <li><a href="#third-party" @click.prevent="scrollTo('third-party')" :class="{ 'active': activeSection === 'third-party' }" aria-label="Jump to Third-Party Links section">07. Third-Party Links</a></li>
                                <li><a href="#retention" @click.prevent="scrollTo('retention')" :class="{ 'active': activeSection === 'retention' }" aria-label="Jump to Data Retention section">08. Data Retention</a></li>
                                <li><a href="#rights" @click.prevent="scrollTo('rights')" :class="{ 'active': activeSection === 'rights' }" aria-label="Jump to Your Rights section">09. Your Rights</a></li>
                                <li><a href="#children" @click.prevent="scrollTo('children')" :class="{ 'active': activeSection === 'children' }" aria-label="Jump to Children's Privacy section">10. Children's Privacy</a></li>
                                <li><a href="#changes" @click.prevent="scrollTo('changes')" :class="{ 'active': activeSection === 'changes' }" aria-label="Jump to Changes section">11. Changes</a></li>
                                <li><a href="#contact" @click.prevent="scrollTo('contact')" :class="{ 'active': activeSection === 'contact' }" aria-label="Jump to Contact Us section">12. Contact Us</a></li>
                            </ul>
                        </div>

                        <div class="ppp-sidebar-card">
                            <h4>Related Pages</h4>
                            <ul class="ppp-related-links">
                                <li><a href="{{ route('terms-conditions') }}"><i class="fas fa-file-contract"></i> Terms & Conditions</a></li>
                                <li><a href="{{ route('refund-policy') }}"><i class="fas fa-undo-alt"></i> Refund Policy</a></li>
                                <li><a href="{{ route('home.contact') }}"><i class="fas fa-envelope"></i> Contact Us</a></li>
                                <li><a href="{{ route('home.faq') }}"><i class="fas fa-question-circle"></i> FAQ</a></li>
                            </ul>
                        </div>

                        <div class="ppp-sidebar-card ppp-sidebar-cta">
                            <i class="fas fa-headset ppp-sidebar-icon"></i>
                            <h4>Have Questions?</h4>
                            <p>Our team is here to help with any privacy concerns.</p>
                            <a href="tel:{{ $settings->mobile_phone_1 ?? '+923048902805' }}" class="ppp-btn ppp-btn-accent w-100" aria-label="Call {{ $settings->site_name ?? 'Razzaq Engineering Services' }}">
                                <i class="fas fa-phone-alt me-2"></i> {{ $settings->mobile_phone_1 ?? '+92 304 8902805' }}
                            </a>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </section>

    {{-- Final CTA - Reduced Height --}}
    <section class="ppp-final-cta">
        <div class="container text-center">
            <h2>Still Have Questions?</h2>
            <p class="mb-3">Contact us for any inquiries about our privacy practices or your personal data.</p>
            <div class="ppp-final-cta-buttons">
                <a href="{{ route('home.contact') }}" class="ppp-btn ppp-btn-accent">
                    <i class="fas fa-envelope me-2"></i> Contact Us
                </a>
                <a href="tel:{{ $settings->mobile_phone_1 ?? '+923048902805' }}" class="ppp-btn ppp-btn-white-outline-dark" aria-label="Call {{ $settings->site_name ?? 'Razzaq Engineering Services' }}">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>

</div>



@push('styles')
<style>
/* ============================================
   PRIVACY POLICY PAGE - PREMIUM QUALITY
   ============================================ */
:root {
    --ppp-primary: #0056b3;
    --ppp-primary-dark: #003d80;
    --ppp-accent: #28a745;
    --ppp-dark: #0a1628;
    --ppp-gray: #4a5568;
    --ppp-light: #f8f9fa;
    --ppp-white: #ffffff;
    --ppp-border: #e2e8f0;
}

.ppp-mobile-cta { position: fixed; bottom: 0; left: 0; right: 0; z-index: 998; display: flex; background: var(--ppp-white); box-shadow: 0 -4px 20px rgba(0,0,0,0.12); }
.ppp-mobile-btn { flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none; border: none; cursor: pointer; }
.ppp-mobile-call { background: var(--ppp-light); color: var(--ppp-dark); }
.ppp-mobile-whatsapp { background: #25D366; color: #fff; }
.ppp-mobile-quote { background: linear-gradient(135deg, var(--ppp-primary), var(--ppp-accent)); color: #fff; }

/* 🔥 Improved Hero */
.ppp-hero { position: relative; padding: 80px 0 70px; overflow: hidden; display: flex; align-items: center; background: linear-gradient(135deg, var(--ppp-primary-dark) 0%, #1a5c2a 100%); }
.ppp-hero-overlay { position: absolute; inset: 0; background: url('{{ asset("images/pattern-dots.svg") }}') repeat; opacity: 0.04; }
.ppp-hero .container { position: relative; z-index: 2; }
.ppp-breadcrumb { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px; font-size: 0.9rem; color: rgba(255,255,255,0.7); }
.ppp-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.ppp-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.ppp-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.ppp-breadcrumb a:hover { color: #fff; }
.ppp-hero-badge { display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); color: #fff; padding: 8px 18px; border-radius: 50px; font-size: 0.85rem; font-weight: 600; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.15); }

/* 🔥 Larger Hero Typography */
.ppp-hero-title { color: #fff; font-size: clamp(2.2rem, 5vw, 3.2rem); font-weight: 800; margin: 0 0 14px; line-height: 1.12; letter-spacing: -0.5px; }
.ppp-hero-subtitle { color: rgba(255,255,255,0.9); font-size: 1.15rem; max-width: 650px; line-height: 1.7; font-weight: 400; }
.ppp-hero-date { color: rgba(255,255,255,0.55); font-size: 0.88rem; margin-top: 12px; display: inline-flex; align-items: center; gap: 6px; }

.ppp-content-section { padding: 50px 0 50px; background: var(--ppp-light); }

/* 🔥 Improved Content Card */
.ppp-content-card { background: var(--ppp-white); border-radius: 16px; padding: 45px; box-shadow: 0 2px 20px rgba(0,0,0,0.04); border: 1px solid var(--ppp-border); }

.ppp-section { margin-bottom: 38px; scroll-margin-top: 100px; }
.ppp-section:last-child { margin-bottom: 0; }

/* 🔥 Section Numbers */
.ppp-section-num { display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: rgba(40,167,69,0.1); color: var(--ppp-accent); border-radius: 8px; font-size: 0.85rem; font-weight: 700; margin-right: 12px; vertical-align: middle; }

.ppp-section h2 { font-size: 1.45rem; font-weight: 700; color: var(--ppp-dark); margin-bottom: 14px; padding-bottom: 12px; border-bottom: 2px solid var(--ppp-border); display: flex; align-items: center; }
.ppp-section h3 { font-size: 1.1rem; font-weight: 700; color: var(--ppp-dark); margin: 22px 0 12px; }

/* 🔥 Larger Body Text */
.ppp-section p { font-size: 1rem; color: var(--ppp-gray); line-height: 1.9; margin-bottom: 14px; }
.ppp-section ul { padding-left: 22px; margin-bottom: 14px; }
.ppp-section ul li { font-size: 0.95rem; color: var(--ppp-gray); line-height: 1.9; margin-bottom: 6px; }
.ppp-section ul li::marker { color: var(--ppp-accent); }

.ppp-contact-section { background: #f8faf9; border-radius: 14px; padding: 28px; border: 1px solid var(--ppp-border); }
.ppp-contact-info { display: flex; flex-direction: column; gap: 14px; margin-top: 16px; }
.ppp-contact-item { display: flex; align-items: flex-start; gap: 14px; }
.ppp-contact-item i { color: var(--ppp-accent); font-size: 1.1rem; margin-top: 3px; width: 22px; }
.ppp-contact-item strong { display: block; font-size: 0.92rem; color: var(--ppp-dark); }
.ppp-contact-item span { font-size: 0.86rem; color: #718096; display: block; margin-top: 2px; }
.ppp-contact-item a { color: var(--ppp-primary); text-decoration: none; font-size: 0.88rem; font-weight: 500; }
.ppp-contact-item a:hover { color: var(--ppp-accent); }

/* 🔥 Improved Sidebar */
.ppp-sidebar { position: sticky; top: 100px; }
.ppp-sidebar-card { background: var(--ppp-white); border-radius: 14px; padding: 22px; margin-bottom: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.03); border: 1px solid var(--ppp-border); }
.ppp-sidebar-card h4 { font-size: 0.9rem; font-weight: 700; color: var(--ppp-dark); margin-bottom: 14px; text-transform: uppercase; letter-spacing: 0.5px; }

.ppp-nav-list { list-style: none; padding: 0; margin: 0; }
.ppp-nav-list li { margin-bottom: 1px; }
.ppp-nav-list li a { font-size: 0.84rem; color: #718096; text-decoration: none; display: block; padding: 8px 12px; border-radius: 8px; transition: all 0.2s; border-left: 3px solid transparent; cursor: pointer; }
.ppp-nav-list li a:hover { background: #f0faf3; color: var(--ppp-accent); padding-left: 16px; }
.ppp-nav-list li a.active { background: #f0faf3; color: var(--ppp-accent); font-weight: 600; border-left-color: var(--ppp-accent); }

.ppp-related-links { list-style: none; padding: 0; margin: 0; }
.ppp-related-links li { margin-bottom: 4px; }
.ppp-related-links li a { font-size: 0.86rem; color: var(--ppp-gray); text-decoration: none; display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px; transition: all 0.2s; }
.ppp-related-links li a:hover { background: #f0faf3; color: var(--ppp-accent); }
.ppp-related-links li i { color: var(--ppp-accent); width: 18px; font-size: 0.9rem; }

.ppp-sidebar-cta { text-align: center; background: linear-gradient(135deg, var(--ppp-primary), var(--ppp-primary-dark)); color: #fff; border: none; }
.ppp-sidebar-cta .ppp-sidebar-icon { font-size: 2rem; margin-bottom: 10px; display: block; }
.ppp-sidebar-cta h4 { color: #fff; font-size: 1rem; text-transform: none; }
.ppp-sidebar-cta p { font-size: 0.82rem; opacity: 0.85; margin-bottom: 16px; color: rgba(255,255,255,0.85); }

.ppp-btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 24px; border-radius: 10px; font-weight: 700; font-size: 0.9rem; text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none; white-space: nowrap; }
.ppp-btn-accent { background: var(--ppp-accent); color: #fff; box-shadow: 0 4px 18px rgba(40,167,69,0.3); }
.ppp-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(40,167,69,0.45); color: #fff; text-decoration: none; }
.ppp-btn-white-outline-dark { background: transparent; color: var(--ppp-dark); border: 2px solid var(--ppp-dark); }
.ppp-btn-white-outline-dark:hover { background: var(--ppp-dark); color: #fff; text-decoration: none; }

/* 🔥 Reduced Final CTA */
.ppp-final-cta { padding: 40px 0; background: var(--ppp-white); border-top: 1px solid var(--ppp-border); }
.ppp-final-cta h2 { font-size: clamp(1.5rem, 3vw, 1.8rem); font-weight: 800; color: var(--ppp-dark); margin-bottom: 8px; }
.ppp-final-cta p { font-size: 0.95rem; color: var(--ppp-gray); max-width: 480px; margin: 0 auto 18px; }
.ppp-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 1199.98px) {
    .ppp-content-card { padding: 35px; }
}
@media (max-width: 991.98px) {
    .ppp-hero { padding: 50px 0 40px; }
    .ppp-content-card { padding: 28px; }
    .ppp-sidebar { position: static; top: auto; }
    .ppp-section { scroll-margin-top: 60px; }
    .ppp-section h2 { font-size: 1.25rem; }
    .ppp-section p { font-size: 0.95rem; }
}
@media (max-width: 767.98px) {
    .ppp-hero { padding: 40px 0 30px; }
    .ppp-hero-title { font-size: 1.6rem; }
    .ppp-content-card { padding: 20px; border-radius: 12px; }
    .ppp-section-num { width: 30px; height: 30px; font-size: 0.75rem; }
    .ppp-section p { font-size: 0.9rem; line-height: 1.8; }
    .ppp-section ul li { font-size: 0.88rem; }
}
@media (max-width: 575.98px) {
    .ppp-hero { padding: 30px 0 25px; }
    .ppp-hero-title { font-size: 1.35rem; }
    .ppp-hero-subtitle { font-size: 0.9rem; }
    .ppp-content-card { padding: 16px; }
    .ppp-section { margin-bottom: 28px; }
    .ppp-section h2 { font-size: 1.1rem; }
    .ppp-final-cta { padding: 30px 0; }
    .ppp-final-cta-buttons { flex-direction: column; }
    .ppp-final-cta-buttons .ppp-btn { width: 100%; justify-content: center; }
    body { padding-bottom: 55px; }
}
</style>
@endpush


@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('sidebarNav', () => ({
        activeSection: 'introduction',
        
        init() {
            this.updateActiveSection();
            window.addEventListener('scroll', () => this.updateActiveSection(), { passive: true });
            window.addEventListener('resize', () => this.updateActiveSection());
            
            if (window.location.hash) {
                setTimeout(() => this.scrollTo(window.location.hash.substring(1)), 350);
            }
        },
        
        updateActiveSection() {
            const sections = document.querySelectorAll('.ppp-section[id]');
            let current = 'introduction';
            const offset = window.innerWidth < 992 ? 80 : 120;
            
            sections.forEach(section => {
                if (section.getBoundingClientRect().top <= offset) {
                    current = section.getAttribute('id');
                }
            });
            this.activeSection = current;
        },
        
        scrollTo(id) {
            const el = document.getElementById(id);
            if (el) {
                const offset = window.innerWidth < 992 ? 80 : 120;
                window.scrollTo({
                    top: el.getBoundingClientRect().top + window.pageYOffset - offset,
                    behavior: 'smooth'
                });
            }
        }
    }));
});

document.addEventListener('livewire:navigated', () => { 
    if (typeof AOS !== 'undefined') AOS.refresh(); 
});
</script>
@endpush