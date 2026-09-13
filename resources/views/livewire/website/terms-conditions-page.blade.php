<div class="tc-page">
    
    {{-- Sticky Mobile CTA --}}
    <div class="tc-mobile-cta d-lg-none">
        <a href="tel:{{ $settings->mobile_phone_1 ?? '+923048902805' }}" class="tc-mobile-btn tc-mobile-call" aria-label="Call {{ $settings->site_name ?? 'Razzaq Engineering Services' }}">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? $settings->mobile_phone_1 ?? '+923048902805') }}" target="_blank" class="tc-mobile-btn tc-mobile-whatsapp" aria-label="Chat on WhatsApp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="{{ route('quote.index') }}" class="tc-mobile-btn tc-mobile-quote" aria-label="Get Free Quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    {{-- Hero Section --}}
    <section class="tc-hero">
        <div class="tc-hero-bg"></div>
        <div class="tc-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-10" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="tc-breadcrumb">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Terms & Conditions</li>
                        </ol>
                    </nav>
                    
                    <div class="tc-hero-badge">
                        <i class="fas fa-file-contract"></i> Legal Information
                    </div>
                    
                    <h1 class="tc-hero-title">Terms & Conditions</h1>
                    <p class="tc-hero-subtitle">
                        Please read these terms carefully before using our services at {{ $settings->site_name ?? 'Razzaq Engineering Services' }}
                    </p>
                    @if($lastUpdated)
                        <p class="tc-hero-date">
                            <i class="fas fa-calendar-check me-1"></i> Last Updated: {{ $lastUpdated }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Content Section --}}
    <section class="tc-content-section">
        <div class="container">
            <div class="tc-content-row">
                
                {{-- Main Content - 75% Width --}}
                <div class="tc-content-col" data-aos="fade-up">
                    <div class="tc-content-card">
                        
                        <div class="tc-section" id="introduction">
                            <h2><span class="tc-section-num">01</span> Introduction</h2>
                            <p>Welcome to <strong>{{ $settings->site_name ?? 'Razzaq Engineering Services' }}</strong> ("Company," "we," "our," "us"). These Terms & Conditions ("Terms") govern your use of our website <strong>{{ config('app.url') }}</strong> (the "Website") and our engineering services.</p>
                            <p>By accessing or using our Website and services, you agree to be bound by these Terms. If you do not agree with any part of these Terms, you must not use our Website or services.</p>
                        </div>

                        <div class="tc-section" id="definitions">
                            <h2><span class="tc-section-num">02</span> Definitions</h2>
                            <ul>
                                <li><strong>"Company"</strong> refers to {{ $settings->company_name ?? $settings->site_name ?? 'Razzaq Engineering Services' }}</li>
                                <li><strong>"Services"</strong> includes RCC core cutting, diamond drilling, wall sawing, Reroitting , Building strutucre strengtheng , and all related engineering services</li>
                                <li><strong>"Client" / "Customer"</strong> refers to any individual or entity using our services</li>
                                <li><strong>"Website"</strong> refers to {{ config('app.url') }} and all subdomains</li>
                                <li><strong>"Content"</strong> refers to all text, images, videos, and materials on our Website</li>
                            </ul>
                        </div>

                        <div class="tc-section" id="services">
                            <h2><span class="tc-section-num">03</span> Our Services</h2>
                            <p>{{ $settings->site_name ?? 'Razzaq Engineering Services' }} provides professional engineering and construction services including:</p>
                            <ul>
                                <li>RCC Core Cutting & Diamond Drilling</li>
                                <li>Wall Saw Cutting & Wire Sawing</li>
                                <li>Retrofitting (Residential & Commercial)</li>
                                <li>Building Strengthening System Installation & Maintenance</li>
                                <li>Sale of Power Tools, Core Cutting Machines & Accessories</li>
                                <li>General Construction & Engineering Consultation</li>
                            </ul>
                            <p>All services are subject to availability and may vary by location. We reserve the right to modify or discontinue any service without prior notice.</p>
                        </div>

                        <div class="tc-section" id="pricing">
                            <h2><span class="tc-section-num">04</span> Quotes, Pricing & Payments</h2>
                            <h3>4.1 Quotations</h3>
                            <ul>
                                <li>All quotes provided are valid for 15 days from the date of issue unless stated otherwise</li>
                                <li>Quotes are based on information provided by the client and may change if requirements change</li>
                                <li>Site inspection may be required for accurate pricing</li>
                            </ul>
                            <h3>4.2 Pricing</h3>
                            <ul>
                                <li>All prices are in Pakistani Rupees (PKR) unless otherwise specified</li>
                                <li>Prices are subject to change without notice</li>
                                <li>Additional charges may apply for emergency, after-hours, or holiday services</li>
                            </ul>
                            <h3>4.3 Payments</h3>
                            <ul>
                                <li>Payment terms will be specified in the service agreement or invoice</li>
                                <li>Advance payment may be required for certain projects</li>
                                <li>Late payments may incur additional charges</li>
                                <li>We accept bank transfers, cash, and other agreed payment methods</li>
                            </ul>
                        </div>

                        <div class="tc-section" id="responsibilities">
                            <h2><span class="tc-section-num">05</span> Client Responsibilities</h2>
                            <p>As a client, you agree to:</p>
                            <ul>
                                <li>Provide accurate and complete information about your project requirements</li>
                                <li>Ensure safe and accessible work sites for our team</li>
                                <li>Obtain necessary permits and approvals (unless arranged with us)</li>
                                <li>Make timely payments as per agreed terms</li>
                                <li>Not interfere with or obstruct our work processes</li>
                                <li>Notify us of any changes to project requirements promptly</li>
                            </ul>
                        </div>

                        <div class="tc-section" id="ip">
                            <h2><span class="tc-section-num">06</span> Intellectual Property</h2>
                            <p>All content on this Website, including text, graphics, logos, images, videos, software, and design, is the exclusive property of {{ $settings->site_name ?? 'Razzaq Engineering Services' }} and is protected by Pakistani and international copyright laws.</p>
                            <p>You may not:</p>
                            <ul>
                                <li>Reproduce, distribute, or transmit any content without our written permission</li>
                                <li>Use our trademarks, logos, or brand assets without authorization</li>
                                <li>Modify, create derivative works, or reverse engineer any part of our Website</li>
                            </ul>
                        </div>

                        <div class="tc-section" id="liability">
                            <h2><span class="tc-section-num">07</span> Limitation of Liability</h2>
                            <p>To the fullest extent permitted by law, {{ $settings->site_name ?? 'Razzaq Engineering Services' }} shall not be liable for:</p>
                            <ul>
                                <li>Any indirect, incidental, or consequential damages</li>
                                <li>Loss of profits, revenue, data, or business opportunities</li>
                                <li>Damages resulting from client's failure to provide accurate information</li>
                                <li>Delays caused by factors beyond our reasonable control (force majeure)</li>
                            </ul>
                            <p>Our total liability for any claim shall not exceed the amount paid by the client for the specific service.</p>
                        </div>

                        <div class="tc-section" id="warranty">
                            <h2><span class="tc-section-num">08</span> Warranty & Quality Assurance</h2>
                            <ul>
                                <li>We provide warranty on workmanship as specified in individual service agreements</li>
                                <li>Product warranties are provided by manufacturers and subject to their terms</li>
                                <li>Warranty does not cover damage from misuse, neglect, or unauthorized modifications</li>
                                <li>Quality assurance inspections are conducted for all completed projects</li>
                            </ul>
                        </div>

                        <div class="tc-section" id="cancellation">
                            <h2><span class="tc-section-num">09</span> Cancellation & Refund Policy</h2>
                            <h3>9.1 Service Cancellation</h3>
                            <ul>
                                <li>Service cancellation must be communicated in writing</li>
                                <li>Cancellation charges may apply based on work already completed</li>
                                <li>Advance payments may be non-refundable for customized orders</li>
                            </ul>
                            <h3>9.2 Product Returns</h3>
                            <ul>
                                <li>Products may be returned within 7 days of purchase if unopened and in original condition</li>
                                <li>Return shipping costs are borne by the customer unless the product is defective</li>
                                <li>Refunds are processed within 7-14 business days after receiving returned items</li>
                            </ul>
                            <p>For complete details, please refer to our <a href="{{ route('refund-policy') }}">Refund Policy</a>.</p>
                        </div>

                        <div class="tc-section" id="privacy">
                            <h2><span class="tc-section-num">10</span> Privacy Policy</h2>
                            <p>Your privacy is important to us. Our collection and use of personal information is governed by our <a href="{{ route('privacy-policy') }}">Privacy Policy</a>, which is incorporated into these Terms by reference.</p>
                        </div>

                        <div class="tc-section" id="third-party">
                            <h2><span class="tc-section-num">11</span> Third-Party Links</h2>
                            <p>Our Website may contain links to third-party websites or services. We do not endorse or assume responsibility for the content, privacy policies, or practices of any third-party sites. You access such links at your own risk.</p>
                        </div>

                        <div class="tc-section" id="termination">
                            <h2><span class="tc-section-num">12</span> Termination</h2>
                            <p>We reserve the right to:</p>
                            <ul>
                                <li>Terminate or suspend your access to our Website and services at our discretion</li>
                                <li>Refuse service to anyone for any reason at any time</li>
                                <li>Modify or discontinue any part of our services without notice</li>
                            </ul>
                        </div>

                        <div class="tc-section" id="law">
                            <h2><span class="tc-section-num">13</span> Governing Law</h2>
                            <p>These Terms shall be governed by and construed in accordance with the laws of the Islamic Republic of Pakistan. Any disputes arising from these Terms shall be subject to the exclusive jurisdiction of the courts in {{ $settings->city ?? 'Lahore' }}, Pakistan.</p>
                        </div>

                        <div class="tc-section" id="changes">
                            <h2><span class="tc-section-num">14</span> Changes to Terms</h2>
                            <p>We reserve the right to modify these Terms at any time. Changes will be effective immediately upon posting on this page. Your continued use of our Website and services after changes constitutes acceptance of the updated Terms.</p>
                        </div>

                        <div class="tc-section tc-contact-section" id="contact">
                            <h2><span class="tc-section-num">15</span> Contact Information</h2>
                            <p>For questions about these Terms & Conditions, please contact us:</p>
                            <div class="tc-contact-info">
                                <div class="tc-contact-item">
                                    <i class="fas fa-building"></i>
                                    <div>
                                        <strong>{{ $settings->site_name ?? 'Razzaq Engineering Services' }}</strong>
                                        @if($settings->address_1)<span>{{ $settings->address_1 }}</span>@endif
                                    </div>
                                </div>
                                <div class="tc-contact-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <div>
                                        <strong>Phone</strong>
                                        <a href="tel:{{ $settings->mobile_phone_1 ?? '+923048902805' }}" aria-label="Call {{ $settings->site_name ?? 'Razzaq Engineering Services' }}">{{ $settings->mobile_phone_1 ?? '+92 304 8902805' }}</a>
                                    </div>
                                </div>
                                <div class="tc-contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <strong>Email</strong>
                                        <a href="mailto:{{ $settings->email_primary ?? 'info@razzaqengineering.com' }}">{{ $settings->email_primary ?? 'info@razzaqengineering.com' }}</a>
                                    </div>
                                </div>
                                <div class="tc-contact-item">
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <strong>Business Hours</strong>
                                        <span>@if($settings->is_24_7) 24/7 - Available All Time @else Monday - Saturday: 9:00 AM - 6:00 PM @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
                {{-- Sidebar - 25% Width --}}
                <div class="tc-sidebar-col" data-aos="fade-left">
                    <div class="tc-sidebar-wrapper">
                        <div class="tc-sidebar">
                            
                            <div class="tc-sidebar-card" x-data="sidebarNav()" x-init="init()">
                                <h4>On This Page</h4>
                                <ul class="tc-nav-list">
                                    <li><a href="#introduction" @click.prevent="scrollTo('introduction')" :class="{ 'active': activeSection === 'introduction' }" aria-label="Jump to Introduction section">01. Introduction</a></li>
                                    <li><a href="#definitions" @click.prevent="scrollTo('definitions')" :class="{ 'active': activeSection === 'definitions' }" aria-label="Jump to Definitions section">02. Definitions</a></li>
                                    <li><a href="#services" @click.prevent="scrollTo('services')" :class="{ 'active': activeSection === 'services' }" aria-label="Jump to Our Services section">03. Our Services</a></li>
                                    <li><a href="#pricing" @click.prevent="scrollTo('pricing')" :class="{ 'active': activeSection === 'pricing' }" aria-label="Jump to Quotes & Pricing section">04. Quotes & Pricing</a></li>
                                    <li><a href="#responsibilities" @click.prevent="scrollTo('responsibilities')" :class="{ 'active': activeSection === 'responsibilities' }" aria-label="Jump to Client Responsibilities section">05. Responsibilities</a></li>
                                    <li><a href="#ip" @click.prevent="scrollTo('ip')" :class="{ 'active': activeSection === 'ip' }" aria-label="Jump to Intellectual Property section">06. Intellectual Property</a></li>
                                    <li><a href="#liability" @click.prevent="scrollTo('liability')" :class="{ 'active': activeSection === 'liability' }" aria-label="Jump to Limitation of Liability section">07. Liability</a></li>
                                    <li><a href="#warranty" @click.prevent="scrollTo('warranty')" :class="{ 'active': activeSection === 'warranty' }" aria-label="Jump to Warranty section">08. Warranty</a></li>
                                    <li><a href="#cancellation" @click.prevent="scrollTo('cancellation')" :class="{ 'active': activeSection === 'cancellation' }" aria-label="Jump to Cancellation section">09. Cancellation</a></li>
                                    <li><a href="#privacy" @click.prevent="scrollTo('privacy')" :class="{ 'active': activeSection === 'privacy' }" aria-label="Jump to Privacy Policy section">10. Privacy Policy</a></li>
                                    <li><a href="#third-party" @click.prevent="scrollTo('third-party')" :class="{ 'active': activeSection === 'third-party' }" aria-label="Jump to Third-Party Links section">11. Third-Party Links</a></li>
                                    <li><a href="#termination" @click.prevent="scrollTo('termination')" :class="{ 'active': activeSection === 'termination' }" aria-label="Jump to Termination section">12. Termination</a></li>
                                    <li><a href="#law" @click.prevent="scrollTo('law')" :class="{ 'active': activeSection === 'law' }" aria-label="Jump to Governing Law section">13. Governing Law</a></li>
                                    <li><a href="#changes" @click.prevent="scrollTo('changes')" :class="{ 'active': activeSection === 'changes' }" aria-label="Jump to Changes section">14. Changes</a></li>
                                    <li><a href="#contact" @click.prevent="scrollTo('contact')" :class="{ 'active': activeSection === 'contact' }" aria-label="Jump to Contact section">15. Contact Us</a></li>
                                </ul>
                            </div>

                            <div class="tc-sidebar-card">
                                <h4>Related Pages</h4>
                                <ul class="tc-related-links">
                                    <li><a href="{{ route('privacy-policy') }}"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
                                    <li><a href="{{ route('refund-policy') }}"><i class="fas fa-undo-alt"></i> Refund Policy</a></li>
                                    <li><a href="{{ route('home.contact') }}"><i class="fas fa-envelope"></i> Contact Us</a></li>
                                    <li><a href="{{ route('home.faq') }}"><i class="fas fa-question-circle"></i> FAQ</a></li>
                                    <li><a href="{{ route('home.about') }}"><i class="fas fa-info-circle"></i> About Us</a></li>
                                </ul>
                            </div>

                            <div class="tc-sidebar-card tc-sidebar-cta">
                                <i class="fas fa-headset tc-sidebar-icon"></i>
                                <h4>Need Clarification?</h4>
                                <p>Contact us for any questions about our terms.</p>
                                <a href="tel:{{ $settings->mobile_phone_1 ?? '+923048902805' }}" class="tc-btn tc-btn-accent w-100" aria-label="Call {{ $settings->site_name ?? 'Razzaq Engineering Services' }}">
                                    <i class="fas fa-phone-alt me-2"></i> {{ $settings->mobile_phone_1 ?? '+92 304 8902805' }}
                                </a>
                            </div>

                            <div class="tc-sidebar-trust">
                                <div class="tc-trust-mini"><i class="fas fa-certificate"></i> Licensed & Registered</div>
                                <div class="tc-trust-mini"><i class="fas fa-shield-alt"></i> Insured Services</div>
                                <div class="tc-trust-mini"><i class="fas fa-star"></i> 5 Star Rated</div>
                            </div>

                            {{-- Back to Top --}}
                            <div class="tc-sidebar-card tc-back-to-top-card d-none d-lg-block" x-data>
                                <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })" class="tc-back-to-top-btn">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>Back to Top</span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    {{-- Final CTA --}}
    <section class="tc-final-cta">
        <div class="container text-center">
            <h2>Ready to Work With Us?</h2>
            <p class="mb-3">Contact our team for professional engineering services across Pakistan.</p>
            <div class="tc-final-cta-buttons">
                <a href="{{ route('quote.index') }}" class="tc-btn tc-btn-accent">
                    <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                </a>
                <a href="tel:{{ $settings->mobile_phone_1 ?? '+923048902805' }}" class="tc-btn tc-btn-white-outline-dark" aria-label="Call {{ $settings->site_name ?? 'Razzaq Engineering Services' }}">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>

</div>


@push('styles')
<style>
/* ============================================
   TERMS & CONDITIONS - PREMIUM QUALITY
   STICKY SIDEBAR - 100% WORKING
   ============================================ */
:root {
    --tc-primary: #0056b3;
    --tc-primary-dark: #003d80;
    --tc-accent: #28a745;
    --tc-dark: #0a1628;
    --tc-gray: #4a5568;
    --tc-light: #f8f9fa;
    --tc-white: #ffffff;
    --tc-border: #e2e8f0;
}

.tc-mobile-cta { position: fixed; bottom: 0; left: 0; right: 0; z-index: 998; display: flex; background: var(--tc-white); box-shadow: 0 -4px 20px rgba(0,0,0,0.12); }
.tc-mobile-btn { flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none; border: none; cursor: pointer; }
.tc-mobile-call { background: var(--tc-light); color: var(--tc-dark); }
.tc-mobile-whatsapp { background: #25D366; color: #fff; }
.tc-mobile-quote { background: linear-gradient(135deg, var(--tc-primary), var(--tc-accent)); color: #fff; }

.tc-hero { position: relative; padding: 80px 0 70px; overflow: hidden; display: flex; align-items: center; background: linear-gradient(135deg, var(--tc-primary-dark) 0%, #1a5c2a 100%); }
.tc-hero-overlay { position: absolute; inset: 0; background: url('{{ asset("images/pattern-dots.svg") }}') repeat; opacity: 0.04; }
.tc-hero .container { position: relative; z-index: 2; }
.tc-breadcrumb { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px; font-size: 0.9rem; color: rgba(255,255,255,0.7); }
.tc-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.tc-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.tc-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.tc-breadcrumb a:hover { color: #fff; }
.tc-hero-badge { display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); color: #fff; padding: 8px 18px; border-radius: 50px; font-size: 0.85rem; font-weight: 600; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.15); }
.tc-hero-title { color: #fff; font-size: clamp(2.2rem, 5vw, 3.2rem); font-weight: 800; margin: 0 0 14px; line-height: 1.12; letter-spacing: -0.5px; }
.tc-hero-subtitle { color: rgba(255,255,255,0.9); font-size: 1.15rem; max-width: 650px; line-height: 1.7; font-weight: 400; }
.tc-hero-date { color: rgba(255,255,255,0.55); font-size: 0.88rem; margin-top: 12px; display: inline-flex; align-items: center; gap: 6px; }

.tc-content-section { padding: 50px 0 50px; background: var(--tc-light); }

/* 🔥 Content Row */
.tc-content-row { display: flex !important; flex-wrap: wrap; margin-right: -12px; margin-left: -12px; }
.tc-content-col { flex: 0 0 75%; max-width: 75%; padding-right: 12px; padding-left: 12px; }
.tc-sidebar-col { flex: 0 0 25%; max-width: 25%; padding-right: 12px; padding-left: 12px; }
.tc-sidebar-wrapper { height: 100%; }

/* 🔥 Sticky Sidebar */
.tc-sidebar { position: -webkit-sticky; position: sticky; top: 100px; z-index: 10; }

.tc-content-card { background: var(--tc-white); border-radius: 16px; padding: 45px; box-shadow: 0 2px 20px rgba(0,0,0,0.04); border: 1px solid var(--tc-border); }

.tc-section { margin-bottom: 38px; scroll-margin-top: 120px; }
.tc-section:last-child { margin-bottom: 0; }
.tc-section-num { display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: rgba(40,167,69,0.1); color: var(--tc-accent); border-radius: 8px; font-size: 0.85rem; font-weight: 700; margin-right: 12px; vertical-align: middle; flex-shrink: 0; }
.tc-section h2 { font-size: 1.45rem; font-weight: 700; color: var(--tc-dark); margin-bottom: 14px; padding-bottom: 12px; border-bottom: 2px solid var(--tc-border); display: flex; align-items: center; }
.tc-section h3 { font-size: 1.1rem; font-weight: 700; color: var(--tc-dark); margin: 22px 0 12px; }
.tc-section p { font-size: 1rem; color: var(--tc-gray); line-height: 1.9; margin-bottom: 14px; }
.tc-section ul { padding-left: 22px; margin-bottom: 14px; }
.tc-section ul li { font-size: 0.95rem; color: var(--tc-gray); line-height: 1.9; margin-bottom: 6px; }
.tc-section ul li::marker { color: var(--tc-accent); }
.tc-section a { color: var(--tc-primary); text-decoration: underline; font-weight: 500; }
.tc-section a:hover { color: var(--tc-accent); }

.tc-contact-section { background: #f8faf9; border-radius: 14px; padding: 28px; border: 1px solid var(--tc-border); }
.tc-contact-info { display: flex; flex-direction: column; gap: 14px; margin-top: 16px; }
.tc-contact-item { display: flex; align-items: flex-start; gap: 14px; }
.tc-contact-item i { color: var(--tc-accent); font-size: 1.1rem; margin-top: 3px; width: 22px; }
.tc-contact-item strong { display: block; font-size: 0.92rem; color: var(--tc-dark); }
.tc-contact-item span { font-size: 0.86rem; color: #718096; display: block; margin-top: 2px; }
.tc-contact-item a { color: var(--tc-primary); text-decoration: none; font-size: 0.88rem; font-weight: 500; }
.tc-contact-item a:hover { color: var(--tc-accent); }

.tc-sidebar-card { background: var(--tc-white); border-radius: 14px; padding: 22px; margin-bottom: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.03); border: 1px solid var(--tc-border); }
.tc-sidebar-card h4 { font-size: 0.9rem; font-weight: 700; color: var(--tc-dark); margin-bottom: 14px; text-transform: uppercase; letter-spacing: 0.5px; }
.tc-nav-list { list-style: none; padding: 0; margin: 0; }
.tc-nav-list li { margin-bottom: 1px; }
.tc-nav-list li a { font-size: 0.84rem; color: #718096; text-decoration: none; display: block; padding: 8px 12px; border-radius: 8px; transition: all 0.2s; border-left: 3px solid transparent; cursor: pointer; }
.tc-nav-list li a:hover { background: #f0faf3; color: var(--tc-accent); padding-left: 16px; }
.tc-nav-list li a.active { background: #f0faf3; color: var(--tc-accent); font-weight: 600; border-left-color: var(--tc-accent); }
.tc-related-links { list-style: none; padding: 0; margin: 0; }
.tc-related-links li { margin-bottom: 4px; }
.tc-related-links li a { font-size: 0.86rem; color: var(--tc-gray); text-decoration: none; display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px; transition: all 0.2s; }
.tc-related-links li a:hover { background: #f0faf3; color: var(--tc-accent); }
.tc-related-links li i { color: var(--tc-accent); width: 18px; font-size: 0.9rem; }
.tc-sidebar-cta { text-align: center; background: linear-gradient(135deg, var(--tc-primary), var(--tc-primary-dark)); color: #fff; border: none; }
.tc-sidebar-cta .tc-sidebar-icon { font-size: 2rem; margin-bottom: 10px; display: block; }
.tc-sidebar-cta h4 { color: #fff; font-size: 1rem; text-transform: none; }
.tc-sidebar-cta p { font-size: 0.82rem; opacity: 0.85; margin-bottom: 16px; color: rgba(255,255,255,0.85); }

.tc-sidebar-trust { display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px; }
.tc-trust-mini { display: flex; align-items: center; gap: 8px; padding: 10px 14px; background: var(--tc-white); border-radius: 8px; font-size: 0.78rem; font-weight: 600; color: var(--tc-dark); box-shadow: 0 2px 10px rgba(0,0,0,0.04); border: 1px solid var(--tc-border); }
.tc-trust-mini i { color: var(--tc-accent); }

.tc-back-to-top-card { text-align: center; padding: 14px !important; }
.tc-back-to-top-btn { display: inline-flex; align-items: center; gap: 8px; background: transparent; border: 1px solid #e2e8f0; padding: 10px 18px; border-radius: 25px; font-size: 0.82rem; font-weight: 600; color: var(--tc-gray); cursor: pointer; transition: all 0.3s; }
.tc-back-to-top-btn:hover { background: var(--tc-dark); color: #fff; border-color: var(--tc-dark); transform: translateY(-2px); box-shadow: 0 4px 15px rgba(0,0,0,0.15); }
.tc-back-to-top-btn i { transition: transform 0.3s; }
.tc-back-to-top-btn:hover i { transform: translateY(-3px); }

.tc-btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 24px; border-radius: 10px; font-weight: 700; font-size: 0.9rem; text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none; white-space: nowrap; }
.tc-btn-accent { background: var(--tc-accent); color: #fff; box-shadow: 0 4px 18px rgba(40,167,69,0.3); }
.tc-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(40,167,69,0.45); color: #fff; text-decoration: none; }
.tc-btn-white-outline-dark { background: transparent; color: var(--tc-dark); border: 2px solid var(--tc-dark); }
.tc-btn-white-outline-dark:hover { background: var(--tc-dark); color: #fff; text-decoration: none; }

.tc-final-cta { padding: 40px 0; background: var(--tc-white); border-top: 1px solid var(--tc-border); }
.tc-final-cta h2 { font-size: clamp(1.5rem, 3vw, 1.8rem); font-weight: 800; color: var(--tc-dark); margin-bottom: 8px; }
.tc-final-cta p { font-size: 0.95rem; color: var(--tc-gray); max-width: 480px; margin: 0 auto 18px; }
.tc-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 1199.98px) {
    .tc-content-card { padding: 35px; }
}
@media (max-width: 991.98px) {
    .tc-hero { padding: 50px 0 40px; }
    .tc-content-col, .tc-sidebar-col { flex: 0 0 100%; max-width: 100%; }
    .tc-sidebar { position: static !important; top: auto !important; }
    .tc-content-card { padding: 28px; }
    .tc-section { scroll-margin-top: 60px; }
    .tc-section h2 { font-size: 1.25rem; }
    .tc-section p { font-size: 0.95rem; }
    .tc-back-to-top-card { display: none !important; }
}
@media (max-width: 767.98px) {
    .tc-hero { padding: 40px 0 30px; }
    .tc-hero-title { font-size: 1.6rem; }
    .tc-content-card { padding: 20px; border-radius: 12px; }
    .tc-section-num { width: 30px; height: 30px; font-size: 0.75rem; }
    .tc-section p { font-size: 0.9rem; line-height: 1.8; }
    .tc-section ul li { font-size: 0.88rem; }
}
@media (max-width: 575.98px) {
    .tc-hero { padding: 30px 0 25px; }
    .tc-hero-title { font-size: 1.35rem; }
    .tc-hero-subtitle { font-size: 0.9rem; }
    .tc-content-card { padding: 16px; }
    .tc-section { margin-bottom: 28px; }
    .tc-section h2 { font-size: 1.1rem; }
    .tc-final-cta { padding: 30px 0; }
    .tc-final-cta-buttons { flex-direction: column; }
    .tc-final-cta-buttons .tc-btn { width: 100%; justify-content: center; }
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
            
            if (window.location.hash) {
                setTimeout(() => this.scrollTo(window.location.hash.substring(1)), 350);
            }
        },
        
        updateActiveSection() {
            const sections = document.querySelectorAll('.tc-section[id]');
            let current = 'introduction';
            const offset = window.innerWidth < 992 ? 80 : 130;
            
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
                const offset = window.innerWidth < 992 ? 80 : 130;
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