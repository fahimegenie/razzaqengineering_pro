<!--================ Footer =================-->
<footer class="footer-section">
    <?php
        $settings = App\Models\Setting::getCached();
        $footerServices = App\Models\OurService::active()->ordered()->take(8)->get();
        $footerProducts = App\Models\ProductCategory::active()->take(8)->get();
        $footerLogo = $settings->logo_url ?? asset('assets/images/logo-black.png');
        $primaryPhone = $settings->mobile_phone_1 ?? '+923048902805';
        $primaryEmail = $settings->email_primary ?? 'info@razzaqengineering.com';
        $whatsappNumber = $settings->whatsapp_number ?? $settings->mobile_phone_1 ?? '+923048902805';
        $whatsappNumberClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
        $showQuoteForm = $settings->enable_quote_form ?? true;
        $showPortfolio = $settings->enable_portfolio ?? true;
        $showFaq = $settings->enable_faq ?? true;
        $is24x7 = $settings->is_24_7 ?? false;
        $isEmergency = $settings->is_emergency_service ?? false;
    ?>
    
    <!-- Main Footer -->
    <div class="footer-main">
        <div class="container">
            <div class="row g-4">
                <!-- Company Info Column -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="footer-widget">
                        <div class="footer-logo mb-3">
                            <img src="<?php echo e($footerLogo); ?>" alt="<?php echo e($settings->site_name ?? 'Razzaq Engineering'); ?>" class="footer-logo-img">
                        </div>
                        <p class="footer-about-text">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->footer_aboutus): ?>
                                <?php echo Str::limit(strip_tags($settings->footer_aboutus), 250); ?>

                            <?php elseif($settings->site_description): ?>
                                <?php echo e(Str::limit($settings->site_description, 250)); ?>

                            <?php else: ?>
                                <?php echo e($settings->site_name ?? 'Razzaq Engineering Services'); ?> is Pakistan's leading provider of professional 
                                <strong>RCC Core Cutting, Diamond Drilling, Wall Saw Cutting, Plumbing & Fire Fighting Services</strong>. 
                                Serving Lahore, Karachi, Islamabad, Rawalpindi & Peshawar with quality workmanship since years.
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </p>
                        
                        <!-- Quick Contact -->
                        <div class="footer-contact-list">
                            <div class="footer-contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-label">
                                        <?php echo e($is24x7 || $isEmergency ? 'Call Us 24/7' : 'Call Us'); ?>

                                    </span>
                                    <a href="tel:<?php echo e($primaryPhone); ?>" class="contact-value"><?php echo e($primaryPhone); ?></a>
                                </div>
                            </div>
                            
                            <div class="footer-contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-label">Email Address</span>
                                    <a href="mailto:<?php echo e($primaryEmail); ?>" class="contact-value"><?php echo e($primaryEmail); ?></a>
                                </div>
                            </div>
                            
                            <div class="footer-contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-label">Working Hours</span>
                                    <span class="contact-value">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($is24x7): ?>
                                            24/7 - Available All Time
                                        <?php elseif($isEmergency): ?>
                                            24/7 - Emergency Services Available
                                        <?php elseif($settings->working_days && $settings->office_start_time && $settings->office_end_time): ?>
                                            <?php echo e($settings->working_days); ?>: <?php echo e($settings->office_start_time); ?> - <?php echo e($settings->office_end_time); ?>

                                        <?php else: ?>
                                            Monday - Saturday: 9:00 AM - 6:00 PM
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </span>
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
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $footerServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <li>
                                    <a href="<?php echo e(url('service-detail/'.str_replace(' ', '-', $fs->os_name))); ?>">
                                        <i class="fas fa-chevron-right"></i> <?php echo e($fs->os_name); ?>

                                    </a>
                                </li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <li>
                                <a href="<?php echo e(route('home.services')); ?>">
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
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $footerProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <li>
                                    <a href="<?php echo e(url('products/'.str_replace(' ', '-', $fp->pc_name))); ?>">
                                        <i class="fas fa-chevron-right"></i> <?php echo e($fp->pc_name); ?>

                                    </a>
                                </li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <li>
                                <a href="<?php echo e(url('products')); ?>">
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
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-chevron-right"></i> Home</a></li>
                            <li><a href="<?php echo e(route('home.about')); ?>"><i class="fas fa-chevron-right"></i> About Us</a></li>
                            <li><a href="<?php echo e(url('team')); ?>"><i class="fas fa-chevron-right"></i> Our Team</a></li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showPortfolio): ?>
                            <li><a href="<?php echo e(url('gallery')); ?>"><i class="fas fa-chevron-right"></i> Portfolio</a></li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <li><a href="<?php echo e(url('projects')); ?>"><i class="fas fa-chevron-right"></i> Projects</a></li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showFaq): ?>
                            <li><a href="<?php echo e(route('home.faq')); ?>"><i class="fas fa-chevron-right"></i> FAQ</a></li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <li><a href="<?php echo e(route('home.contact')); ?>"><i class="fas fa-chevron-right"></i> Contact Us</a></li>
                            <li><a href="<?php echo e(url('sitemap.xml')); ?>" target="_blank"><i class="fas fa-chevron-right"></i> Sitemap</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Our Branches Column -->
                <div class="col-lg-2 col-md-6 col-sm-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Our Branches</h4>
                        <div class="branch-list">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->address_1): ?>
                            <div class="branch-item">
                                <h6 class="branch-city">
                                    <i class="fas fa-map-marker-alt"></i> 
                                    <?php echo e($settings->city ? $settings->city : 'Head Office'); ?>

                                </h6>
                                <p class="branch-address"><?php echo e($settings->address_1); ?></p>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->address_2): ?>
                            <div class="branch-item">
                                <h6 class="branch-city">
                                    <i class="fas fa-map-marker-alt"></i> 
                                    <?php echo e($settings->state ? $settings->state . ' Office' : 'Branch Office'); ?>

                                </h6>
                                <p class="branch-address"><?php echo e($settings->address_2); ?></p>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->address_3): ?>
                            <div class="branch-item">
                                <h6 class="branch-city">
                                    <i class="fas fa-map-marker-alt"></i> Additional Branch
                                </h6>
                                <p class="branch-address"><?php echo e($settings->address_3); ?></p>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                    <h3 class="footer-cta-title">
                        <?php echo e($isEmergency ? 'Need Emergency Service? We\'re Available 24/7!' : 'Need Our Professional Services?'); ?>

                    </h3>
                    <p class="footer-cta-text">
                        <?php echo e($is24x7 ? 'We are available around the clock for all your needs.' : 'Call us now for immediate assistance or get a free quote for your project.'); ?>

                    </p>
                </div>
                <div class="col-lg-4 col-md-5 text-md-end">
                    <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                        <a href="tel:<?php echo e($primaryPhone); ?>" class="btn btn-cta-call">
                            <i class="fas fa-phone-alt me-2"></i> Call Now
                        </a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showQuoteForm): ?>
                        <a href="<?php echo e(route('quote.index')); ?>" class="btn btn-cta-quote">
                            <i class="fas fa-paper-plane me-2"></i> Get Quote
                        </a>
                        <?php else: ?>
                        <a href="<?php echo e(route('home.contact')); ?>" class="btn btn-cta-quote">
                            <i class="fas fa-envelope me-2"></i> Contact Us
                        </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($whatsappNumber): ?>
                        <a href="https://wa.me/<?php echo e($whatsappNumberClean); ?>" target="_blank" class="btn btn-cta-call" style="background:#25D366;">
                            <i class="fab fa-whatsapp me-2"></i> WhatsApp
                        </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->footer_copyright_text): ?>
                            <?php echo str_replace(
                                [':year', ':company'], 
                                [date('Y'), $settings->company_name ?? $settings->site_name ?? 'Razzaq Engineering Services'],
                                $settings->footer_copyright_text
                            ); ?>

                        <?php else: ?>
                            &copy; <?php echo e(date('Y')); ?> <strong><?php echo e($settings->company_name ?? $settings->site_name ?? 'Razzaq Engineering Services'); ?></strong>. All Rights Reserved.
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </p>
                </div>
                
                <!-- Footer Bottom Links -->
                <div class="col-lg-3 col-md-6 mb-3 mb-md-0 text-md-center">
                    <div class="footer-bottom-links">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->privacy_policy): ?>
                        <a href="<?php echo e(url('privacy-policy')); ?>">Privacy Policy</a>
                        <span class="divider">|</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->terms_and_conditions): ?>
                        <a href="<?php echo e(url('terms-conditions')); ?>">Terms & Conditions</a>
                        <span class="divider">|</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->refund_policy): ?>
                        <a href="<?php echo e(url('refund-policy')); ?>">Refund Policy</a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                
                <!-- Social Icons -->
                <div class="col-lg-3 col-md-12 text-md-end">
                    <div class="footer-social-icons">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->facebook_url): ?>
                        <a href="<?php echo e($settings->facebook_url); ?>" target="_blank" class="social-icon" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->instagram_url): ?>
                        <a href="<?php echo e($settings->instagram_url); ?>" target="_blank" class="social-icon" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->tiktok_url): ?>
                        <a href="<?php echo e($settings->tiktok_url); ?>" target="_blank" class="social-icon" title="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->linkedin_url): ?>
                        <a href="<?php echo e($settings->linkedin_url); ?>" target="_blank" class="social-icon" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->youtube_url): ?>
                        <a href="<?php echo e($settings->youtube_url); ?>" target="_blank" class="social-icon" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->twitter_url): ?>
                        <a href="<?php echo e($settings->twitter_url); ?>" target="_blank" class="social-icon" title="Twitter">
                            <i class="fab fa-x-twitter"></i>
                        </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <a href="mailto:<?php echo e($primaryEmail); ?>" class="social-icon" title="Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--================ End Footer =================--><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/layouts/partials/footer.blade.php ENDPATH**/ ?>