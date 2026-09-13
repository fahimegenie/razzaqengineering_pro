<div class="rfp-page">
    
    
    <div class="rfp-mobile-cta d-lg-none">
        <a href="tel:<?php echo e($settings->mobile_phone_1 ?? '+923048902805'); ?>" class="rfp-mobile-btn rfp-mobile-call" aria-label="Call <?php echo e($settings->site_name ?? 'Razzaq Engineering Services'); ?>">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? $settings->mobile_phone_1 ?? '+923048902805')); ?>" target="_blank" class="rfp-mobile-btn rfp-mobile-whatsapp" aria-label="Chat on WhatsApp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="<?php echo e(route('quote.index')); ?>" class="rfp-mobile-btn rfp-mobile-quote" aria-label="Get Free Quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    
    <section class="rfp-hero">
        <div class="rfp-hero-bg"></div>
        <div class="rfp-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-10" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="rfp-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Refund Policy</li>
                        </ol>
                    </nav>
                    
                    <div class="rfp-hero-badge">
                        <i class="fas fa-undo-alt"></i> Customer Protection
                    </div>
                    
                    <h1 class="rfp-hero-title">Refund & Cancellation Policy</h1>
                    <p class="rfp-hero-subtitle">
                        Our commitment to fair and transparent refund practices at <?php echo e($settings->site_name ?? 'Razzaq Engineering Services'); ?>

                    </p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lastUpdated): ?>
                        <p class="rfp-hero-date">
                            <i class="fas fa-calendar-check me-1"></i> Last Updated: <?php echo e($lastUpdated); ?>

                        </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    
    <section class="rfp-content-section">
        <div class="container">
            <div class="rfp-content-row">
                
                
                <div class="rfp-content-col" data-aos="fade-up">
                    <div class="rfp-content-card">
                        
                        <div class="rfp-section" id="introduction">
                            <h2><span class="rfp-section-num">01</span> Introduction</h2>
                            <p>At <strong><?php echo e($settings->site_name ?? 'Razzaq Engineering Services'); ?></strong>, we are committed to providing high-quality engineering services and products. This Refund & Cancellation Policy outlines our procedures for refunds, returns, and cancellations.</p>
                            <p>By engaging our services or purchasing our products, you agree to the terms outlined in this policy. If you have any questions, please contact our customer support team.</p>
                        </div>

                        <div class="rfp-section" id="service-refunds">
                            <h2><span class="rfp-section-num">02</span> Service Refund Policy</h2>
                            <h3>2.1 Service Quality Guarantee</h3>
                            <p>We take pride in our workmanship and offer a satisfaction guarantee on all our engineering services. If you are not satisfied with the quality of our work, please notify us within <strong>5 hours</strong> of service completion.</p>
                            <h3>2.2 Eligibility for Service Refunds</h3>
                            <p>Service refunds may be considered under the following circumstances:</p>
                            <ul>
                                <li>Work was not completed as per the agreed specifications or contract</li>
                                <li>Service quality does not meet industry standards</li>
                                <li>Work was not performed within the agreed timeline (excluding force majeure events)</li>
                                <li>Duplicate charges or billing errors</li>
                            </ul>
                            <h3>2.3 Non-Refundable Services</h3>
                            <p>The following service scenarios are generally non-refundable:</p>
                            <ul>
                                <li>Services already completed and accepted by the client</li>
                                <li>Emergency or after-hours services that were successfully performed</li>
                                <li>Custom or specialized work that cannot be reversed</li>
                                <li>Services where the client provided incorrect information leading to the work performed</li>
                                <li>Consultation or inspection fees</li>
                            </ul>
                            <h3>2.4 Partial Refunds</h3>
                            <p>In some cases, we may offer partial refunds for services where only a portion of the work was completed or where minor issues were identified. The refund amount will be proportional to the uncompleted or unsatisfactory portion of the work.</p>
                        </div>

                        <div class="rfp-section" id="product-refunds">
                            <h2><span class="rfp-section-num">03</span> Product Return & Refund Policy</h2>
                            <h3>3.1 Return Eligibility</h3>
                            <p>Products may be returned within <strong>2 days</strong> of purchase under the following conditions:</p>
                            <ul>
                                <li>Product is unused, unopened, and in original packaging</li>
                                <li>All accessories, manuals, and warranty cards are included</li>
                                <li>Original purchase receipt or invoice is provided</li>
                                <li>Product is not a special order or custom item</li>
                            </ul>
                            <h3>3.2 Non-Returnable Products</h3>
                            <ul>
                                <li>Used or installed products</li>
                                <li>Custom-ordered or specially fabricated items</li>
                                <li>Consumable items (core bits, blades, cutting tools)</li>
                                <li>Products damaged due to misuse, neglect, or improper storage</li>
                                <li>Products without original packaging</li>
                                <li>Clearance or sale items marked as "Final Sale"</li>
                            </ul>
                            <h3>3.3 Defective Products</h3>
                            <p>If you receive a defective product, please notify us within <strong>48 hours</strong> of receipt. We will either:</p>
                            <ul>
                                <li>Replace the product with a new one at no additional cost</li>
                                <li>Issue a full refund including any shipping charges</li>
                                <li>Provide repair services if covered under manufacturer warranty</li>
                            </ul>
                        </div>

                        <div class="rfp-section" id="refund-process">
                            <h2><span class="rfp-section-num">04</span> Refund Process & Timeline</h2>
                            <h3>4.1 How to Request a Refund</h3>
                            <ol>
                                <li>Contact our customer support team via phone, email, or in-person</li>
                                <li>Provide your invoice/receipt number and reason for refund</li>
                                <li>Submit any supporting evidence (photos, documentation)</li>
                                <li>Our team will review your request within 2-3 business days</li>
                                <li>You will receive a notification of approval or rejection</li>
                            </ol>
                            <h3>4.2 Refund Processing Time</h3>
                            <div class="rfp-info-table">
                                <div class="rfp-info-row rfp-info-header"><span class="rfp-info-label">Payment Method</span><span class="rfp-info-value">Processing Time</span></div>
                                <div class="rfp-info-row"><span class="rfp-info-label">Bank Transfer</span><span class="rfp-info-value">5-7 Business Days</span></div>
                                <div class="rfp-info-row"><span class="rfp-info-label">Cash</span><span class="rfp-info-value">1-3 Business Days</span></div>
                                <div class="rfp-info-row"><span class="rfp-info-label">JazzCash / EasyPaisa</span><span class="rfp-info-value">2-4 Business Days</span></div>
                                <div class="rfp-info-row"><span class="rfp-info-label">Credit/Debit Card</span><span class="rfp-info-value">7-14 Business Days</span></div>
                            </div>
                            <p><small class="text-muted">* Processing times are estimates and may vary depending on your bank or payment provider.</small></p>
                            <h3>4.3 Refund Method</h3>
                            <ul>
                                <li>Refunds will be processed using the original payment method</li>
                                <li>For cash payments, refunds will be made via bank transfer or in cash</li>
                                <li>For bank transfers, refunds will be credited to the original account</li>
                            </ul>
                        </div>

                        <div class="rfp-section" id="cancellation">
                            <h2><span class="rfp-section-num">05</span> Cancellation Policy</h2>
                            <h3>5.1 Service Cancellation by Client</h3>
                            <ul>
                                <li>Cancellation requests must be submitted in writing (email or written notice)</li>
                                <li><strong>48+ hours notice:</strong> Full refund of any advance payment</li>
                                <li><strong>24-48 hours notice:</strong> 50% refund of advance payment</li>
                                <li><strong>Less than 24 hours notice:</strong> Advance payment may be non-refundable</li>
                                <li><strong>After work has begun:</strong> Refund based on work completed</li>
                            </ul>
                            <h3>5.2 Cancellation by Company</h3>
                            <ul>
                                <li>Full refund of any advance payments</li>
                                <li>Reasonable notice and alternative arrangements provided</li>
                                <li>No cancellation charges apply</li>
                            </ul>
                            <h3>5.3 Product Order Cancellation</h3>
                            <ul>
                                <li>Orders cancelled before shipment: Full refund</li>
                                <li>Custom orders after production: Non-cancellable</li>
                                <li>After shipment: Standard return policy applies</li>
                            </ul>
                        </div>

                        <div class="rfp-section" id="warranty">
                            <h2><span class="rfp-section-num">06</span> Warranty Claims</h2>
                            <p>Products are covered by manufacturer warranties. Claims subject to:</p>
                            <ul>
                                <li>Manufacturer's warranty terms and conditions</li>
                                <li>Proper use and maintenance of the product</li>
                                <li>Valid proof of purchase</li>
                            </ul>
                            <p>We assist with warranty claims but are not directly responsible for manufacturer decisions.</p>
                        </div>

                        <div class="rfp-section" id="disputes">
                            <h2><span class="rfp-section-num">07</span> Dispute Resolution</h2>
                            <ol>
                                <li>Escalate to our management team</li>
                                <li>Request an in-person meeting</li>
                                <li>Seek mediation through consumer protection authorities</li>
                                <li>Pursue legal remedies as per applicable laws of Pakistan</li>
                            </ol>
                            <p>We are committed to resolving all disputes fairly and amicably.</p>
                        </div>

                        <div class="rfp-section" id="exceptions">
                            <h2><span class="rfp-section-num">08</span> Exceptions & Special Circumstances</h2>
                            <p>Reviewed on a case-by-case basis:</p>
                            <ul>
                                <li>Medical emergencies preventing service access</li>
                                <li>Natural disasters or force majeure events</li>
                                <li>Errors in project specifications by the company</li>
                                <li>Long-term client relationships with good standing</li>
                            </ul>
                        </div>

                        <div class="rfp-section rfp-contact-section" id="contact">
                            <h2><span class="rfp-section-num">09</span> Contact Us for Refund Requests</h2>
                            <p>To initiate a refund, cancellation, or for any questions about this policy:</p>
                            <div class="rfp-contact-info">
                                <div class="rfp-contact-item">
                                    <i class="fas fa-building"></i>
                                    <div><strong><?php echo e($settings->site_name ?? 'Razzaq Engineering Services'); ?></strong><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->address_1): ?><span><?php echo e($settings->address_1); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                                </div>
                                <div class="rfp-contact-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <div><strong>Phone</strong><a href="tel:<?php echo e($settings->mobile_phone_1 ?? '+923048902805'); ?>"><?php echo e($settings->mobile_phone_1 ?? '+92 304 8902805'); ?></a></div>
                                </div>
                                <div class="rfp-contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <div><strong>Email</strong><a href="mailto:<?php echo e($settings->email_primary ?? 'info@razzaqengineering.com'); ?>"><?php echo e($settings->email_primary ?? 'info@razzaqengineering.com'); ?></a></div>
                                </div>
                                <div class="rfp-contact-item">
                                    <i class="fas fa-clock"></i>
                                    <div><strong>Response Time</strong><span>We respond within 24-48 hours</span></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
                
                <div class="rfp-sidebar-col" data-aos="fade-left">
                    <div class="rfp-sidebar-wrapper">
                        <div class="rfp-sidebar">
                            
                            <div class="rfp-sidebar-card" x-data="sidebarNav()" x-init="init()">
                                <h4>On This Page</h4>
                                <ul class="rfp-nav-list">
                                    <li><a href="#introduction" @click.prevent="scrollTo('introduction')" :class="{ 'active': activeSection === 'introduction' }">01. Introduction</a></li>
                                    <li><a href="#service-refunds" @click.prevent="scrollTo('service-refunds')" :class="{ 'active': activeSection === 'service-refunds' }">02. Service Refunds</a></li>
                                    <li><a href="#product-refunds" @click.prevent="scrollTo('product-refunds')" :class="{ 'active': activeSection === 'product-refunds' }">03. Product Returns</a></li>
                                    <li><a href="#refund-process" @click.prevent="scrollTo('refund-process')" :class="{ 'active': activeSection === 'refund-process' }">04. Refund Process</a></li>
                                    <li><a href="#cancellation" @click.prevent="scrollTo('cancellation')" :class="{ 'active': activeSection === 'cancellation' }">05. Cancellation</a></li>
                                    <li><a href="#warranty" @click.prevent="scrollTo('warranty')" :class="{ 'active': activeSection === 'warranty' }">06. Warranty</a></li>
                                    <li><a href="#disputes" @click.prevent="scrollTo('disputes')" :class="{ 'active': activeSection === 'disputes' }">07. Disputes</a></li>
                                    <li><a href="#exceptions" @click.prevent="scrollTo('exceptions')" :class="{ 'active': activeSection === 'exceptions' }">08. Exceptions</a></li>
                                    <li><a href="#contact" @click.prevent="scrollTo('contact')" :class="{ 'active': activeSection === 'contact' }">09. Contact Us</a></li>
                                </ul>
                            </div>

                            <div class="rfp-sidebar-card rfp-sidebar-info">
                                <h4><i class="fas fa-info-circle me-2"></i> Quick Refund Info</h4>
                                <div class="rfp-quick-info">
                                    <div class="rfp-quick-item"><i class="fas fa-clock"></i><span>Response: 24-48 Hours</span></div>
                                    <div class="rfp-quick-item"><i class="fas fa-sync-alt"></i><span>Processing: 1-14 Days</span></div>
                                    <div class="rfp-quick-item"><i class="fas fa-calendar-check"></i><span>Return Window: 2 Days</span></div>
                                </div>
                            </div>

                            <div class="rfp-sidebar-card">
                                <h4>Related Pages</h4>
                                <ul class="rfp-related-links">
                                    <li><a href="<?php echo e(route('terms-conditions')); ?>"><i class="fas fa-file-contract"></i> Terms & Conditions</a></li>
                                    <li><a href="<?php echo e(route('privacy-policy')); ?>"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
                                    <li><a href="<?php echo e(route('home.contact')); ?>"><i class="fas fa-envelope"></i> Contact Us</a></li>
                                    <li><a href="<?php echo e(route('home.faq')); ?>"><i class="fas fa-question-circle"></i> FAQ</a></li>
                                </ul>
                            </div>

                            <div class="rfp-sidebar-card rfp-sidebar-cta">
                                <i class="fas fa-headset rfp-sidebar-icon"></i>
                                <h4>Need a Refund?</h4>
                                <p>Contact our support team for immediate assistance.</p>
                                <a href="tel:<?php echo e($settings->mobile_phone_1 ?? '+923048902805'); ?>" class="rfp-btn rfp-btn-accent w-100"><i class="fas fa-phone-alt me-2"></i> <?php echo e($settings->mobile_phone_1 ?? '+92 304 8902805'); ?></a>
                                <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? $settings->mobile_phone_1 ?? '+923048902805')); ?>" target="_blank" class="rfp-btn rfp-btn-whatsapp w-100 mt-2"><i class="fab fa-whatsapp me-2"></i> WhatsApp Chat</a>
                            </div>

                            <div class="rfp-sidebar-trust">
                                <div class="rfp-trust-mini"><i class="fas fa-check-circle"></i> Fair & Transparent</div>
                                <div class="rfp-trust-mini"><i class="fas fa-shield-alt"></i> Customer Protection</div>
                                <div class="rfp-trust-mini"><i class="fas fa-star"></i> Trusted Service</div>
                            </div>

                            <div class="rfp-sidebar-card rfp-back-to-top-card d-none d-lg-block" x-data>
                                <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })" class="rfp-back-to-top-btn"><i class="fas fa-arrow-up"></i><span>Back to Top</span></button>
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    
    <section class="rfp-final-cta">
        <div class="container text-center">
            <h2>Have Questions About Our Refund Policy?</h2>
            <p class="mb-3">Our customer support team is ready to assist you with any refund or cancellation inquiries.</p>
            <div class="rfp-final-cta-buttons">
                <a href="<?php echo e(route('home.contact')); ?>" class="rfp-btn rfp-btn-accent"><i class="fas fa-envelope me-2"></i> Contact Support</a>
                <a href="tel:<?php echo e($settings->mobile_phone_1 ?? '+923048902805'); ?>" class="rfp-btn rfp-btn-white-outline-dark"><i class="fas fa-phone-alt me-2"></i> Call Now</a>
            </div>
        </div>
    </section>

</div>


<?php $__env->startPush('styles'); ?>
<style>
:root{--rfp-primary:#0056b3;--rfp-primary-dark:#003d80;--rfp-accent:#28a745;--rfp-dark:#0a1628;--rfp-gray:#4a5568;--rfp-light:#f8f9fa;--rfp-white:#ffffff;--rfp-border:#e2e8f0}
.rfp-mobile-cta{position:fixed;bottom:0;left:0;right:0;z-index:998;display:flex;background:var(--rfp-white);box-shadow:0 -4px 20px rgba(0,0,0,0.12)}
.rfp-mobile-btn{flex:1;display:flex;align-items:center;justify-content:center;gap:6px;padding:12px 8px;font-size:.78rem;font-weight:700;text-decoration:none;border:none;cursor:pointer}
.rfp-mobile-call{background:var(--rfp-light);color:var(--rfp-dark)}
.rfp-mobile-whatsapp{background:#25D366;color:#fff}
.rfp-mobile-quote{background:linear-gradient(135deg,var(--rfp-primary),var(--rfp-accent));color:#fff}
.rfp-hero{position:relative;padding:80px 0 70px;overflow:hidden;display:flex;align-items:center;background:linear-gradient(135deg,var(--rfp-primary-dark) 0%,#1a5c2a 100%)}
.rfp-hero-overlay{position:absolute;inset:0;background:url('<?php echo e(asset("images/pattern-dots.svg")); ?>') repeat;opacity:.04}
.rfp-hero .container{position:relative;z-index:2}
.rfp-breadcrumb{display:flex;gap:8px;list-style:none;padding:0;margin:0 0 15px;font-size:.9rem;color:rgba(255,255,255,0.7)}
.rfp-breadcrumb li{display:flex;align-items:center;gap:8px}
.rfp-breadcrumb li:not(:last-child)::after{content:'/';color:rgba(255,255,255,0.4)}
.rfp-breadcrumb a{color:rgba(255,255,255,0.9);text-decoration:none}
.rfp-breadcrumb a:hover{color:#fff}
.rfp-hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.12);backdrop-filter:blur(10px);color:#fff;padding:8px 18px;border-radius:50px;font-size:.85rem;font-weight:600;margin-bottom:20px;border:1px solid rgba(255,255,255,0.15)}
.rfp-hero-title{color:#fff;font-size:clamp(2.2rem,5vw,3.2rem);font-weight:800;margin:0 0 14px;line-height:1.12;letter-spacing:-0.5px}
.rfp-hero-subtitle{color:rgba(255,255,255,0.9);font-size:1.15rem;max-width:650px;line-height:1.7;font-weight:400}
.rfp-hero-date{color:rgba(255,255,255,0.55);font-size:.88rem;margin-top:12px;display:inline-flex;align-items:center;gap:6px}
.rfp-content-section{padding:50px 0 50px;background:var(--rfp-light)}
.rfp-content-row{display:flex!important;flex-wrap:wrap;margin-right:-12px;margin-left:-12px}
.rfp-content-col{flex:0 0 75%;max-width:75%;padding-right:12px;padding-left:12px}
.rfp-sidebar-col{flex:0 0 25%;max-width:25%;padding-right:12px;padding-left:12px}
.rfp-sidebar-wrapper{height:100%}
.rfp-sidebar{position:-webkit-sticky;position:sticky;top:100px;z-index:10}
.rfp-content-card{background:var(--rfp-white);border-radius:16px;padding:45px;box-shadow:0 2px 20px rgba(0,0,0,0.04);border:1px solid var(--rfp-border)}
.rfp-section{margin-bottom:38px;scroll-margin-top:120px}
.rfp-section:last-child{margin-bottom:0}
.rfp-section-num{display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;background:rgba(40,167,69,0.1);color:var(--rfp-accent);border-radius:8px;font-size:.85rem;font-weight:700;margin-right:12px;vertical-align:middle;flex-shrink:0}
.rfp-section h2{font-size:1.45rem;font-weight:700;color:var(--rfp-dark);margin-bottom:14px;padding-bottom:12px;border-bottom:2px solid var(--rfp-border);display:flex;align-items:center}
.rfp-section h3{font-size:1.1rem;font-weight:700;color:var(--rfp-dark);margin:22px 0 12px}
.rfp-section p{font-size:1rem;color:var(--rfp-gray);line-height:1.9;margin-bottom:14px}
.rfp-section ul,.rfp-section ol{padding-left:22px;margin-bottom:14px}
.rfp-section ul li,.rfp-section ol li{font-size:.95rem;color:var(--rfp-gray);line-height:1.9;margin-bottom:6px}
.rfp-section ul li::marker{color:var(--rfp-accent)}
.rfp-section a{color:var(--rfp-primary);text-decoration:underline;font-weight:500}
.rfp-section a:hover{color:var(--rfp-accent)}
.rfp-info-table{border:1px solid var(--rfp-border);border-radius:10px;overflow:hidden;margin:15px 0}
.rfp-info-row{display:flex;padding:10px 16px;border-bottom:1px solid #f5f5f5}
.rfp-info-header{background:#f8faf9;font-weight:700}
.rfp-info-row:last-child{border-bottom:none}
.rfp-info-label{flex:1;font-size:.88rem;color:var(--rfp-dark)}
.rfp-info-value{flex:1;font-size:.88rem;color:var(--rfp-gray);text-align:right;font-weight:500}
.rfp-contact-section{background:#f8faf9;border-radius:14px;padding:28px;border:1px solid var(--rfp-border)}
.rfp-contact-info{display:flex;flex-direction:column;gap:14px;margin-top:16px}
.rfp-contact-item{display:flex;align-items:flex-start;gap:14px}
.rfp-contact-item i{color:var(--rfp-accent);font-size:1.1rem;margin-top:3px;width:22px}
.rfp-contact-item strong{display:block;font-size:.92rem;color:var(--rfp-dark)}
.rfp-contact-item span{font-size:.86rem;color:#718096;display:block;margin-top:2px}
.rfp-contact-item a{color:var(--rfp-primary);text-decoration:none;font-size:.88rem;font-weight:500}
.rfp-contact-item a:hover{color:var(--rfp-accent)}
.rfp-sidebar-card{background:var(--rfp-white);border-radius:14px;padding:22px;margin-bottom:16px;box-shadow:0 2px 12px rgba(0,0,0,0.03);border:1px solid var(--rfp-border)}
.rfp-sidebar-card h4{font-size:.9rem;font-weight:700;color:var(--rfp-dark);margin-bottom:14px;text-transform:uppercase;letter-spacing:.5px}
.rfp-nav-list{list-style:none;padding:0;margin:0}
.rfp-nav-list li{margin-bottom:1px}
.rfp-nav-list li a{font-size:.84rem;color:#718096;text-decoration:none;display:block;padding:8px 12px;border-radius:8px;transition:all .2s;border-left:3px solid transparent;cursor:pointer}
.rfp-nav-list li a:hover{background:#f0faf3;color:var(--rfp-accent);padding-left:16px}
.rfp-nav-list li a.active{background:#f0faf3;color:var(--rfp-accent);font-weight:600;border-left-color:var(--rfp-accent)}
.rfp-sidebar-info{background:#f0faf3;border-color:rgba(40,167,69,0.3)}
.rfp-quick-info{display:flex;flex-direction:column;gap:8px}
.rfp-quick-item{display:flex;align-items:center;gap:10px;font-size:.84rem;color:var(--rfp-gray)}
.rfp-quick-item i{color:var(--rfp-accent);width:18px;text-align:center}
.rfp-related-links{list-style:none;padding:0;margin:0}
.rfp-related-links li{margin-bottom:4px}
.rfp-related-links li a{font-size:.86rem;color:var(--rfp-gray);text-decoration:none;display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:8px;transition:all .2s}
.rfp-related-links li a:hover{background:#f0faf3;color:var(--rfp-accent)}
.rfp-related-links li i{color:var(--rfp-accent);width:18px;font-size:.9rem}
.rfp-sidebar-cta{text-align:center;background:linear-gradient(135deg,var(--rfp-primary),var(--rfp-primary-dark));color:#fff;border:none}
.rfp-sidebar-cta .rfp-sidebar-icon{font-size:2rem;margin-bottom:10px;display:block}
.rfp-sidebar-cta h4{color:#fff;font-size:1rem;text-transform:none}
.rfp-sidebar-cta p{font-size:.82rem;opacity:.85;margin-bottom:16px;color:rgba(255,255,255,0.85)}
.rfp-sidebar-trust{display:flex;flex-direction:column;gap:8px;margin-bottom:16px}
.rfp-trust-mini{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--rfp-white);border-radius:8px;font-size:.78rem;font-weight:600;color:var(--rfp-dark);box-shadow:0 2px 10px rgba(0,0,0,0.04);border:1px solid var(--rfp-border)}
.rfp-trust-mini i{color:var(--rfp-accent)}
.rfp-back-to-top-card{text-align:center;padding:14px!important}
.rfp-back-to-top-btn{display:inline-flex;align-items:center;gap:8px;background:transparent;border:1px solid #e2e8f0;padding:10px 18px;border-radius:25px;font-size:.82rem;font-weight:600;color:var(--rfp-gray);cursor:pointer;transition:all .3s}
.rfp-back-to-top-btn:hover{background:var(--rfp-dark);color:#fff;border-color:var(--rfp-dark);transform:translateY(-2px);box-shadow:0 4px 15px rgba(0,0,0,0.15)}
.rfp-back-to-top-btn i{transition:transform .3s}
.rfp-back-to-top-btn:hover i{transform:translateY(-3px)}
.rfp-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:12px 24px;border-radius:10px;font-weight:700;font-size:.9rem;text-decoration:none;transition:all .3s ease;cursor:pointer;border:none;white-space:nowrap}
.rfp-btn-accent{background:var(--rfp-accent);color:#fff;box-shadow:0 4px 18px rgba(40,167,69,0.3)}
.rfp-btn-accent:hover{transform:translateY(-2px);box-shadow:0 8px 30px rgba(40,167,69,0.45);color:#fff;text-decoration:none}
.rfp-btn-whatsapp{background:#25D366;color:#fff}
.rfp-btn-whatsapp:hover{background:#128C7E;color:#fff;transform:translateY(-2px);text-decoration:none}
.rfp-btn-white-outline-dark{background:transparent;color:var(--rfp-dark);border:2px solid var(--rfp-dark)}
.rfp-btn-white-outline-dark:hover{background:var(--rfp-dark);color:#fff;text-decoration:none}
.rfp-final-cta{padding:40px 0;background:var(--rfp-white);border-top:1px solid var(--rfp-border)}
.rfp-final-cta h2{font-size:clamp(1.5rem,3vw,1.8rem);font-weight:800;color:var(--rfp-dark);margin-bottom:8px}
.rfp-final-cta p{font-size:.95rem;color:var(--rfp-gray);max-width:480px;margin:0 auto 18px}
.rfp-final-cta-buttons{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}
@media(max-width:1199.98px){.rfp-content-card{padding:35px}}
@media(max-width:991.98px){.rfp-hero{padding:50px 0 40px}.rfp-content-col,.rfp-sidebar-col{flex:0 0 100%;max-width:100%}.rfp-sidebar{position:static!important;top:auto!important}.rfp-content-card{padding:28px}.rfp-section{scroll-margin-top:60px}.rfp-section h2{font-size:1.25rem}.rfp-section p{font-size:.95rem}.rfp-back-to-top-card{display:none!important}}
@media(max-width:767.98px){.rfp-hero{padding:40px 0 30px}.rfp-hero-title{font-size:1.6rem}.rfp-content-card{padding:20px;border-radius:12px}.rfp-section-num{width:30px;height:30px;font-size:.75rem}.rfp-section p{font-size:.9rem;line-height:1.8}.rfp-section ul li,.rfp-section ol li{font-size:.88rem}}
@media(max-width:575.98px){.rfp-hero{padding:30px 0 25px}.rfp-hero-title{font-size:1.35rem}.rfp-hero-subtitle{font-size:.9rem}.rfp-content-card{padding:16px}.rfp-section{margin-bottom:28px}.rfp-section h2{font-size:1.1rem}.rfp-final-cta{padding:30px 0}.rfp-final-cta-buttons{flex-direction:column}.rfp-final-cta-buttons .rfp-btn{width:100%;justify-content:center}body{padding-bottom:55px}}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('alpine:init',()=>{Alpine.data('sidebarNav',()=>({activeSection:'introduction',init(){this.updateActiveSection();window.addEventListener('scroll',()=>this.updateActiveSection(),{passive:true});if(window.location.hash){setTimeout(()=>this.scrollTo(window.location.hash.substring(1)),350)}},updateActiveSection(){const sections=document.querySelectorAll('.rfp-section[id]');let current='introduction';const offset=window.innerWidth<992?80:130;sections.forEach(section=>{if(section.getBoundingClientRect().top<=offset){current=section.getAttribute('id')}});this.activeSection=current},scrollTo(id){const el=document.getElementById(id);if(el){const offset=window.innerWidth<992?80:130;window.scrollTo({top:el.getBoundingClientRect().top+window.pageYOffset-offset,behavior:'smooth'})}}}))});document.addEventListener('livewire:navigated',()=>{if(typeof AOS!=='undefined')AOS.refresh()});
</script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/refund-policy-page.blade.php ENDPATH**/ ?>