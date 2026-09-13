<div class="abt-page" 
     x-data="{ 
        activeTab: 'mission',
        showTeamModal: <?php if ((object) ('showTeamModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showTeamModal'->value()); ?>')<?php echo e('showTeamModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showTeamModal'); ?>')<?php endif; ?>,
        selectedMember: <?php if ((object) ('selectedMember') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('selectedMember'->value()); ?>')<?php echo e('selectedMember'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('selectedMember'); ?>')<?php endif; ?>,
        
        setTab(tab) { this.activeTab = tab; },
        closeModal() { $wire.closeTeamModal(); },
        
        handleKeydown(e) {
            if (this.showTeamModal && e.key === 'Escape') this.closeModal();
        }
     }"
     @keydown.window="handleKeydown">
    
    
    <div class="abt-mobile-cta d-lg-none">
        <a href="tel:+923048902805" class="abt-mobile-btn abt-mobile-call">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/923048902805" target="_blank" class="abt-mobile-btn abt-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="<?php echo e(route('quote.index')); ?>" class="abt-mobile-btn abt-mobile-quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    
    <section class="abt-hero">
        <?php
            $heroBg = asset('assets/images/about-banner.jpg');
            if (!empty($about) && !empty($about->a_image)) {
                $heroBg = asset($about->a_image);
            }
        ?>
        <div class="abt-hero-bg" style="background-image: url('<?php echo e($heroBg); ?>');"></div>
        <div class="abt-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-30">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="abt-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">About Us</li>
                        </ol>
                    </nav>
                    
                    <div class="abt-hero-badge">
                        <i class="fas fa-building"></i> 
                        <?php echo e(max(0, now()->year - 2002)); ?>+ Years of Excellence
                    </div>
                    
                    <h1 class="abt-hero-title">
                        <?php echo e(!empty($about) ? $about->about_title : 'About Razzaq Engineering'); ?>

                    </h1>
                    <p class="abt-hero-subtitle">
                        Pakistan's trusted provider of specialized engineering services with a legacy of quality and innovation
                    </p>
                    
                    <div class="abt-hero-stats">
                        <div class="abt-stat-item">
                            <span class="abt-stat-number"><?php echo e($stats['projects'] ?? 500); ?>+</span>
                            <span class="abt-stat-label">Projects</span>
                        </div>
                        <div class="abt-stat-item">
                            <span class="abt-stat-number"><?php echo e($stats['clients'] ?? 300); ?>+</span>
                            <span class="abt-stat-label">Clients</span>
                        </div>
                        <div class="abt-stat-item">
                            <span class="abt-stat-number"><?php echo e($stats['cities'] ?? 9); ?>+</span>
                            <span class="abt-stat-label">Cities</span>
                        </div>
                        <div class="abt-stat-item">
                            <span class="abt-stat-number"><?php echo e($stats['team'] ?? 50); ?>+</span>
                            <span class="abt-stat-label">Team</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="abt-trust-bar">
        <div class="container">
            <div class="abt-trust-grid">
                <div class="abt-trust-card">
                    <div class="abt-trust-icon"><i class="fas fa-certificate"></i></div>
                    <div>
                        <strong>Licensed</strong>
                        <span>& Registered</span>
                    </div>
                </div>
                <div class="abt-trust-card">
                    <div class="abt-trust-icon"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <strong>Insured</strong>
                        <span>Professionals</span>
                    </div>
                </div>
                <div class="abt-trust-card">
                    <div class="abt-trust-icon"><i class="fas fa-star"></i></div>
                    <div>
                        <strong>5 Star</strong>
                        <span>Rated Service</span>
                    </div>
                </div>
                <div class="abt-trust-card">
                    <div class="abt-trust-icon"><i class="fas fa-headset"></i></div>
                    <div>
                        <strong>24/7</strong>
                        <span>Emergency</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
        <section class="abt-main-section">
            <div class="container">
                <div class="abt-state-box">
                    <div class="spinner-grow text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-3 fw-semibold">Loading about us...</p>
                </div>
            </div>
        </section>
    
    <?php elseif($errorMessage): ?>
        <section class="abt-main-section">
            <div class="container">
                <div class="abt-error-card">
                    <i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;"></i>
                    <h4 class="fw-bold mt-3">Oops! Something went wrong</h4>
                    <p class="text-muted"><?php echo e($errorMessage); ?></p>
                    <button class="btn btn-primary mt-3" wire:click="loadData">
                        <i class="fas fa-redo me-2"></i> Retry
                    </button>
                </div>
            </div>
        </section>
    
    <?php else: ?>
        
        <section class="abt-content-section">
            <div class="container">
                <div class="row g-5 align-items-center">
                    
                    
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="abt-image-wrapper">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($about) && !empty($about->a_image)): ?>
                                <img src="<?php echo e(asset($about->a_image)); ?>" 
                                     alt="<?php echo e($about->about_title ?? 'About Razzaq Engineering'); ?>"
                                     class="abt-main-image"
                                     loading="lazy">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/images/about-right-1.jpg')); ?>" 
                                     alt="About Our Company"
                                     class="abt-main-image"
                                     loading="lazy">
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            <div class="abt-exp-badge">
                                <span class="abt-exp-num"><?php echo e(max(0, now()->year - 2002)); ?>+</span>
                                <span class="abt-exp-lbl">Years of<br>Excellence</span>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-lg-6" data-aos="fade-left">
                        <span class="abt-section-badge">Who We Are</span>
                        <h2 class="abt-section-title">
                            <?php echo e(!empty($about) ? $about->about_title : "Pakistan's Leading Engineering Services"); ?>

                        </h2>
                        
                        <div class="abt-description">
                            <p>
                                <?php echo e(!empty($about) && !empty($about->about_description_1) 
                                    ? $about->about_description_1 
                                    : 'With over ' . (now()->year - 2002) . ' years of industry leadership, Razzaq Engineering Services stands as Pakistan\'s premier provider of specialized engineering solutions. We deliver professional RCC core cutting, diamond drilling, wall saw cutting, plumbing & fire fighting services across all major cities.'); ?>

                            </p>
                            <p>
                                <?php echo e(!empty($about) && !empty($about->about_description_2) 
                                    ? $about->about_description_2 
                                    : 'Our commitment to quality, safety, and client satisfaction has earned us the trust of hundreds of happy clients and completed projects nationwide.'); ?>

                            </p>
                        </div>
                        
                        <div class="abt-quick-stats">
                            <div class="abt-quick-stat">
                                <span class="abt-qs-number"><?php echo e($stats['projects'] ?? 500); ?>+</span>
                                <span class="abt-qs-label">Projects Done</span>
                            </div>
                            <div class="abt-quick-stat">
                                <span class="abt-qs-number"><?php echo e($stats['clients'] ?? 300); ?>+</span>
                                <span class="abt-qs-label">Happy Clients</span>
                            </div>
                            <div class="abt-quick-stat">
                                <span class="abt-qs-number"><?php echo e($stats['cities'] ?? 9); ?>+</span>
                                <span class="abt-qs-label">Cities Covered</span>
                            </div>
                        </div>
                        
                        <div class="abt-cta-row">
                            <a href="<?php echo e(route('quote.index')); ?>" class="abt-btn abt-btn-accent">
                                <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                            </a>
                            <a href="tel:+923048902805" class="abt-btn abt-btn-outline">
                                <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

        
        <section class="abt-tabs-section">
            <div class="container">
                <div class="abt-tabs-wrapper">
                    <div class="abt-tabs-nav" data-aos="fade-up">
                        <button @click="setTab('mission')" :class="{ 'active': activeTab === 'mission' }">
                            <i class="fas fa-bullseye"></i> Our Mission
                        </button>
                        <button @click="setTab('vision')" :class="{ 'active': activeTab === 'vision' }">
                            <i class="fas fa-eye"></i> Our Vision
                        </button>
                        <button @click="setTab('values')" :class="{ 'active': activeTab === 'values' }">
                            <i class="fas fa-gem"></i> Our Values
                        </button>
                    </div>
                    
                    <div class="abt-tabs-content" data-aos="fade-up">
                        
                        <div x-show="activeTab === 'mission'" x-transition>
                            <div class="abt-tab-card">
                                <div class="row g-4 align-items-center">
                                    <div class="col-md-5">
                                        <div class="abt-tab-icon">
                                            <i class="fas fa-bullseye"></i>
                                        </div>
                                        <h3 class="abt-tab-title">
                                            <?php echo e(!empty($about) && !empty($about->mission_title) ? $about->mission_title : 'Our Mission'); ?>

                                        </h3>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="abt-tab-text">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($about) && !empty($about->mission_description)): ?>
                                                <p><?php echo $about->mission_description; ?></p>
                                            <?php else: ?>
                                                <p>To provide exceptional engineering services through innovation, quality workmanship, and unwavering commitment to client satisfaction across Pakistan.</p>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div x-show="activeTab === 'vision'" x-transition>
                            <div class="abt-tab-card">
                                <div class="row g-4 align-items-center">
                                    <div class="col-md-5">
                                        <div class="abt-tab-icon">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                        <h3 class="abt-tab-title">
                                            <?php echo e(!empty($about) && !empty($about->vision_title) ? $about->vision_title : 'Our Vision'); ?>

                                        </h3>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="abt-tab-text">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($about) && !empty($about->vision_description)): ?>
                                                <p><?php echo $about->vision_description; ?></p>
                                            <?php else: ?>
                                                <p>To become the leading engineering services provider across South Asia, recognized for technical expertise and sustainable construction practices.</p>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div x-show="activeTab === 'values'" x-transition>
                            <div class="abt-tab-card">
                                <div class="row g-4 align-items-center">
                                    <div class="col-md-5">
                                        <div class="abt-tab-icon">
                                            <i class="fas fa-gem"></i>
                                        </div>
                                        <h3 class="abt-tab-title">
                                            <?php echo e(!empty($about) && !empty($about->values_title) ? $about->values_title : 'Our Core Values'); ?>

                                        </h3>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="abt-tab-text">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($about) && !empty($about->values_description)): ?>
                                                <p><?php echo $about->values_description; ?></p>
                                            <?php else: ?>
                                                <div class="abt-values-list">
                                                    <span><i class="fas fa-check-circle"></i> Safety First</span>
                                                    <span><i class="fas fa-check-circle"></i> Quality Excellence</span>
                                                    <span><i class="fas fa-check-circle"></i> Integrity & Transparency</span>
                                                    <span><i class="fas fa-check-circle"></i> Innovation & Technology</span>
                                                    <span><i class="fas fa-check-circle"></i> Teamwork & Collaboration</span>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <section class="abt-choose-section">
            <div class="container">
                <div class="abt-section-header text-center" data-aos="fade-up">
                    <span class="abt-section-badge"><i class="fas fa-star"></i> Why We're the Best</span>
                    <h2>Why Choose Us</h2>
                    <p>Discover what sets Razzaq Engineering apart from the competition</p>
                </div>
                
                <div class="row g-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $whyChooseUs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo e($index * 80); ?>">
                            <div class="abt-choose-card">
                                <div class="abt-choose-icon">
                                    <i class="fas <?php echo e($feature['icon']); ?>"></i>
                                </div>
                                <h4><?php echo e($feature['title']); ?></h4>
                                <p><?php echo e($feature['desc']); ?></p>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        </section>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($team->count() > 0): ?>
            <section class="abt-team-section">
                <div class="container">
                    <div class="abt-section-header text-center" data-aos="fade-up">
                        <span class="abt-section-badge"><i class="fas fa-users"></i> Our People</span>
                        <h2>Meet Our Team</h2>
                        <p>The skilled professionals behind our success</p>
                    </div>
                    
                    <div class="row g-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $team->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 100); ?>">
                                <div class="abt-team-card" wire:click="showMemberDetail(<?php echo e($member->id); ?>)">
                                    <div class="abt-team-image">
                                        <img src="<?php echo e(asset('ot_image/'.$member->ot_image)); ?>" 
                                             alt="<?php echo e($member->ot_name); ?>" 
                                             loading="lazy">
                                        <div class="abt-team-overlay">
                                            <span>View Profile</span>
                                        </div>
                                    </div>
                                    <div class="abt-team-info">
                                        <h5><?php echo e($member->ot_name); ?></h5>
                                        <span><?php echo e($member->ot_designation); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($team->count() > 4): ?>
                        <div class="text-center mt-4">
                            <a href="<?php echo e(url('team')); ?>" class="abt-btn abt-btn-outline">
                                View All Team <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <section class="abt-final-cta">
        <div class="container text-center">
            <h2>Ready to Work With Pakistan's Best?</h2>
            <p class="mb-4">Let our experienced team deliver exceptional engineering solutions for your next project.</p>
            <div class="abt-final-cta-buttons">
                <a href="<?php echo e(route('quote.index')); ?>" class="abt-btn abt-btn-lg abt-btn-accent">
                    <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                </a>
                <a href="tel:+923048902805" class="abt-btn abt-btn-lg abt-btn-white-outline-dark">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>

    
    <div class="abt-modal-overlay" 
         x-show="showTeamModal" 
         x-transition.opacity
         @click.self="closeModal"
         x-cloak>
        <div class="abt-modal-content" @click.stop>
            <button class="abt-modal-close" @click="closeModal">&times;</button>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedMember): ?>
                <div class="row g-4">
                    <div class="col-md-5">
                        <img src="<?php echo e(asset('ot_image/'.$selectedMember->ot_image)); ?>" 
                             alt="<?php echo e($selectedMember->ot_name); ?>"
                             class="abt-modal-image"
                             loading="lazy">
                    </div>
                    <div class="col-md-7">
                        <h2 class="abt-modal-name"><?php echo e($selectedMember->ot_name); ?></h2>
                        <span class="abt-modal-role"><?php echo e($selectedMember->ot_designation); ?></span>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedMember->ot_description): ?>
                            <div class="abt-modal-desc">
                                <p><?php echo $selectedMember->ot_description; ?></p>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <div class="abt-modal-contact">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedMember->ot_email): ?>
                                <a href="mailto:<?php echo e($selectedMember->ot_email); ?>" class="abt-contact-link">
                                    <i class="fas fa-envelope"></i> <?php echo e($selectedMember->ot_email); ?>

                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedMember->ot_phone): ?>
                                <a href="tel:<?php echo e($selectedMember->ot_phone); ?>" class="abt-contact-link">
                                    <i class="fas fa-phone-alt"></i> <?php echo e($selectedMember->ot_phone); ?>

                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        
                        <div class="abt-modal-social">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedMember->ot_fb): ?>
                                <a href="<?php echo e($selectedMember->ot_fb); ?>" target="_blank" class="abt-social-btn">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedMember->ot_linkedin): ?>
                                <a href="<?php echo e($selectedMember->ot_linkedin); ?>" target="_blank" class="abt-social-btn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

</div>


<style>
/* ============================================
   ABOUT PAGE - ENTERPRISE GRADE DESIGN
   Laravel 13 + Livewire 4 + Alpine.js
   ============================================ */

[x-cloak] { display: none !important; }

/* --- Mobile Sticky CTA --- */
.abt-mobile-cta {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 998;
    display: flex; background: #fff; box-shadow: 0 -4px 20px rgba(0,0,0,0.12);
}

.abt-mobile-btn {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
    padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none;
    border: none; cursor: pointer; transition: all 0.2s;
}

.abt-mobile-call { background: #f8f9fa; color: #0a1628; }
.abt-mobile-whatsapp { background: #25D366; color: #fff; }
.abt-mobile-quote { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; }

/* --- Hero Section --- */
.abt-hero {
    position: relative; padding: 90px 0 70px; overflow: hidden;
    min-height: 480px; display: flex; align-items: center;
}

.abt-hero-bg {
    position: absolute; inset: 0; background-size: cover; background-position: center;
    filter: brightness(0.3);
}

.abt-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,61,128,0.88) 0%, rgba(26,92,42,0.82) 100%);
}

.abt-hero .container { position: relative; z-index: 2; }

.abt-breadcrumb {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px;
    font-size: 0.84rem; color: rgba(255,255,255,0.7);
}

.abt-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.abt-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.abt-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.abt-breadcrumb a:hover { color: #fff; }
.abt-breadcrumb .active { color: rgba(255,255,255,0.6); }

.abt-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
    color: #fff; padding: 8px 18px; border-radius: 50px;
    font-size: 0.85rem; font-weight: 600; margin-bottom: 18px;
}

.abt-hero-title { color: #fff; font-size: clamp(2.2rem, 5vw, 3rem); font-weight: 800; margin: 0 0 12px; line-height: 1.15; }
.abt-hero-subtitle { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 550px; margin: 0 0 25px; line-height: 1.6; }

.abt-hero-stats { display: flex; gap: 30px; flex-wrap: wrap; }
.abt-stat-item { text-align: center; }
.abt-stat-number { display: block; font-size: 1.8rem; font-weight: 800; color: #28a745; }
.abt-stat-label { font-size: 0.78rem; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 1px; }

/* --- Trust Bar --- */
.abt-trust-bar { background: #fff; border-bottom: 1px solid #eef0f2; }
.abt-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); }

.abt-trust-card {
    display: flex; align-items: center; gap: 12px; padding: 20px;
    border-right: 1px solid #f0f0f0;
}
.abt-trust-card:last-child { border-right: none; }

.abt-trust-icon {
    width: 44px; height: 44px; min-width: 44px; background: rgba(40,167,69,0.1);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #28a745; font-size: 1.1rem;
}

.abt-trust-card strong { display: block; font-size: 1.1rem; color: #0a1628; }
.abt-trust-card span { font-size: 0.75rem; color: #888; }

/* --- Content Section --- */
.abt-content-section { padding: 60px 0; background: #fff; }

.abt-image-wrapper { position: relative; }
.abt-main-image { width: 100%; border-radius: 16px; box-shadow: 0 15px 45px rgba(0,0,0,0.1); }

.abt-exp-badge {
    position: absolute; bottom: -25px; right: -25px;
    background: linear-gradient(135deg, #0056b3, #003d80); color: #fff;
    border-radius: 16px; padding: 18px 24px; text-align: center;
    box-shadow: 0 12px 35px rgba(0,86,179,0.35);
}

.abt-exp-num { display: block; font-size: 2rem; font-weight: 900; line-height: 1; }
.abt-exp-lbl { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1.5px; opacity: 0.85; line-height: 1.3; }

.abt-section-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(40,167,69,0.1); color: #28a745; padding: 6px 16px;
    border-radius: 50px; font-size: 0.78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px;
}

.abt-section-title { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 15px; }

.abt-description { font-size: 0.93rem; color: #666; line-height: 1.8; margin-bottom: 20px; }
.abt-description p { margin-bottom: 12px; }
.abt-description p:last-child { margin-bottom: 0; }

.abt-quick-stats { display: flex; gap: 25px; margin-bottom: 25px; }
.abt-quick-stat { text-align: center; }
.abt-qs-number { display: block; font-size: 1.5rem; font-weight: 800; color: #0056b3; }
.abt-qs-label { font-size: 0.72rem; color: #888; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }

.abt-cta-row { display: flex; gap: 12px; flex-wrap: wrap; }

.abt-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 0.9rem;
    text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none;
    white-space: nowrap;
}

.abt-btn-lg { padding: 14px 28px; font-size: 0.95rem; border-radius: 10px; }
.abt-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.abt-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; }

.abt-btn-outline { background: #fff; color: #0056b3; border: 2px solid #0056b3; }
.abt-btn-outline:hover { background: #0056b3; color: #fff; transform: translateY(-2px); }

.abt-btn-white-outline-dark { background: transparent; color: #0a1628; border: 2px solid #0a1628; }
.abt-btn-white-outline-dark:hover { background: #0a1628; color: #fff; }

/* --- Tabs Section --- */
.abt-tabs-section { padding: 60px 0; background: #f8f9fa; }

.abt-tabs-wrapper { max-width: 900px; margin: 0 auto; }

.abt-tabs-nav {
    display: flex; gap: 8px; justify-content: center; margin-bottom: 25px;
    background: #fff; border-radius: 14px; padding: 8px; 
    box-shadow: 0 3px 20px rgba(0,0,0,0.05);
}

.abt-tabs-nav button {
    padding: 14px 28px; border: none; background: transparent; border-radius: 10px;
    font-weight: 600; font-size: 0.9rem; color: #555; cursor: pointer;
    transition: all 0.3s ease; display: flex; align-items: center; gap: 8px;
}

.abt-tabs-nav button:hover { color: #28a745; background: #f0faf3; }
.abt-tabs-nav button.active {
    background: linear-gradient(135deg, #0056b3, #28a745); color: #fff;
    box-shadow: 0 5px 20px rgba(40,167,69,0.3);
}

.abt-tab-card { 
    background: #fff; border-radius: 16px; padding: 35px; 
    box-shadow: 0 5px 25px rgba(0,0,0,0.04); 
}

.abt-tab-icon {
    width: 70px; height: 70px; 
    background: linear-gradient(135deg, rgba(40,167,69,0.1), rgba(0,86,179,0.1));
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: 28px; color: #28a745; margin-bottom: 15px;
}

.abt-tab-title { font-size: 1.4rem; font-weight: 700; color: #0a1628; }
.abt-tab-text { font-size: 0.93rem; color: #666; line-height: 1.8; }

.abt-values-list { display: flex; flex-direction: column; gap: 10px; }
.abt-values-list span { display: flex; align-items: center; gap: 10px; font-size: 0.9rem; color: #555; }
.abt-values-list i { color: #28a745; }

/* --- Choose Section --- */
.abt-choose-section { padding: 60px 0; background: #fff; }

.abt-section-header { margin-bottom: 40px; }
.abt-section-header h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 8px; }
.abt-section-header p { color: #888; }

.abt-choose-card {
    background: #fff; border-radius: 16px; padding: 30px 25px; text-align: center;
    border: 1px solid #eef0f2; transition: all 0.3s ease; height: 100%;
    box-shadow: 0 3px 15px rgba(0,0,0,0.04);
}

.abt-choose-card:hover { 
    transform: translateY(-5px); 
    box-shadow: 0 15px 40px rgba(0,0,0,0.08); 
    border-color: #28a745; 
}

.abt-choose-icon {
    width: 60px; height: 60px; 
    background: linear-gradient(135deg, rgba(40,167,69,0.08), rgba(0,86,179,0.08));
    border-radius: 14px; display: flex; align-items: center; justify-content: center;
    font-size: 24px; color: #28a745; margin: 0 auto 15px; transition: all 0.3s ease;
}

.abt-choose-card:hover .abt-choose-icon {
    background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; border-radius: 50%;
}

.abt-choose-card h4 { font-size: 1.05rem; font-weight: 700; margin-bottom: 8px; }
.abt-choose-card p { font-size: 0.85rem; color: #888; margin: 0; line-height: 1.6; }

/* --- Team Section --- */
.abt-team-section { padding: 60px 0; background: #f8f9fa; }

.abt-team-card {
    background: #fff; border-radius: 14px; overflow: hidden;
    box-shadow: 0 3px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; cursor: pointer;
}

.abt-team-card:hover { transform: translateY(-5px); box-shadow: 0 12px 35px rgba(0,0,0,0.1); }

.abt-team-image { position: relative; aspect-ratio: 3/4; overflow: hidden; }
.abt-team-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
.abt-team-card:hover .abt-team-image img { transform: scale(1.05); }

.abt-team-overlay {
    position: absolute; inset: 0; background: rgba(0,54,108,0.7);
    display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s;
}

.abt-team-card:hover .abt-team-overlay { opacity: 1; }
.abt-team-overlay span { 
    color: #fff; font-weight: 600; padding: 8px 20px; 
    border: 2px solid #fff; border-radius: 6px; font-size: 0.85rem;
}

.abt-team-info { padding: 16px; text-align: center; }
.abt-team-info h5 { font-size: 1rem; font-weight: 700; margin-bottom: 4px; color: #0a1628; }
.abt-team-info span { font-size: 0.8rem; color: #28a745; font-weight: 600; }

/* --- Modal --- */
.abt-modal-overlay {
    position: fixed; inset: 0; z-index: 99999; background: rgba(0,0,0,0.6);
    display: flex; align-items: center; justify-content: center; padding: 20px;
    backdrop-filter: blur(4px);
}

.abt-modal-content {
    background: #fff; border-radius: 20px; padding: 30px; max-width: 700px;
    width: 100%; max-height: 85vh; overflow-y: auto; position: relative;
    box-shadow: 0 25px 70px rgba(0,0,0,0.25); animation: modalIn 0.3s ease;
}

@keyframes modalIn { 
    from { opacity: 0; transform: translateY(-20px) scale(0.95); } 
    to { opacity: 1; transform: translateY(0) scale(1); } 
}

.abt-modal-close {
    position: absolute; top: 12px; right: 15px; background: #f0f0f0; border: none;
    width: 36px; height: 36px; border-radius: 50%; font-size: 1.3rem; cursor: pointer;
    color: #555; display: flex; align-items: center; justify-content: center; transition: all 0.2s;
    z-index: 2;
}

.abt-modal-close:hover { background: #dc3545; color: #fff; }

.abt-modal-image { width: 100%; border-radius: 12px; aspect-ratio: 3/4; object-fit: cover; }

.abt-modal-name { font-size: 1.3rem; font-weight: 800; color: #0a1628; margin-bottom: 4px; }
.abt-modal-role { font-size: 0.88rem; color: #28a745; font-weight: 600; display: block; margin-bottom: 12px; }

.abt-modal-desc p { font-size: 0.9rem; color: #666; line-height: 1.7; margin-bottom: 12px; }

.abt-modal-contact { display: flex; flex-direction: column; gap: 8px; margin-bottom: 15px; }

.abt-contact-link {
    display: flex; align-items: center; gap: 10px; padding: 10px 14px;
    background: #f8f9fa; border-radius: 10px; text-decoration: none; color: #555;
    font-size: 0.88rem; transition: all 0.2s;
}

.abt-contact-link:hover { background: #f0faf3; color: #28a745; }
.abt-contact-link i { color: #28a745; }

.abt-modal-social { display: flex; gap: 8px; }

.abt-social-btn {
    width: 38px; height: 38px; background: #f0f4f8; border-radius: 50%;
    display: inline-flex; align-items: center; justify-content: center;
    color: #555; text-decoration: none; font-size: 0.9rem; transition: all 0.2s;
}

.abt-social-btn:hover { background: #0056b3; color: #fff; }

/* --- Final CTA --- */
.abt-final-cta { padding: 60px 0; background: #fff; }
.abt-final-cta h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 10px; }
.abt-final-cta p { font-size: 1rem; color: #666; max-width: 500px; margin: 0 auto 20px; }
.abt-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

/* --- States --- */
.abt-state-box { text-align: center; padding: 60px 20px; }
.abt-error-card { 
    max-width: 500px; margin: 40px auto; padding: 40px 30px; background: #fff; 
    border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); text-align: center; 
}

/* ============================================
   RESPONSIVE DESIGN
   ============================================ */

@media (max-width: 1199.98px) {
    .abt-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .abt-trust-card:nth-child(2) { border-right: none; }
}

@media (max-width: 991.98px) {
    .abt-hero { padding: 60px 0 50px; min-height: auto; }
    .abt-hero-title { font-size: 1.8rem; }
    .abt-hero-stats { gap: 20px; }
    .abt-tabs-nav button { padding: 10px 20px; font-size: 0.82rem; }
    .abt-exp-badge { right: -10px; bottom: -15px; padding: 14px 18px; }
    .abt-exp-num { font-size: 1.6rem; }
}

@media (max-width: 767.98px) {
    .abt-hero { padding: 45px 0 40px; }
    .abt-hero-title { font-size: 1.5rem; }
    .abt-hero-subtitle { font-size: 0.9rem; }
    .abt-hero-stats { gap: 15px; }
    .abt-stat-number { font-size: 1.4rem; }
    .abt-trust-grid { grid-template-columns: 1fr 1fr; }
    .abt-trust-card { padding: 14px; gap: 8px; }
    .abt-content-section { padding: 40px 0; }
    .abt-tabs-nav { flex-wrap: wrap; }
    .abt-tab-card { padding: 20px; }
    .abt-exp-badge { right: 10px; bottom: -15px; padding: 12px 16px; }
    .abt-exp-num { font-size: 1.5rem; }
    .abt-cta-row { flex-direction: column; }
    .abt-cta-row .abt-btn { width: 100%; justify-content: center; }
}

@media (max-width: 575.98px) {
    .abt-hero { padding: 35px 0 30px; }
    .abt-hero-title { font-size: 1.3rem; }
    .abt-hero-badge { font-size: 0.75rem; padding: 6px 14px; }
    .abt-breadcrumb { font-size: 0.75rem; }
    .abt-hero-stats { gap: 10px; }
    .abt-stat-number { font-size: 1.2rem; }
    .abt-stat-label { font-size: 0.68rem; }
    .abt-trust-grid { grid-template-columns: 1fr 1fr; }
    .abt-trust-card { padding: 12px 10px; border-bottom: 1px solid #f0f0f0; }
    .abt-trust-card:nth-child(even) { border-right: none; }
    .abt-trust-icon { width: 34px; height: 34px; min-width: 34px; font-size: 0.9rem; }
    .abt-trust-card strong { font-size: 0.9rem; }
    .abt-quick-stats { flex-wrap: wrap; gap: 15px; }
    .abt-tabs-nav { padding: 5px; gap: 4px; }
    .abt-tabs-nav button { padding: 10px 14px; font-size: 0.76rem; gap: 5px; }
    .abt-tab-card { padding: 16px; }
    .abt-tab-icon { width: 50px; height: 50px; font-size: 22px; }
    .abt-tab-title { font-size: 1.15rem; }
    .abt-modal-content { padding: 20px; }
    .abt-modal-name { font-size: 1.15rem; }
    .abt-final-cta { padding: 40px 0; }
    .abt-final-cta-buttons { flex-direction: column; }
    .abt-final-cta-buttons .abt-btn { width: 100%; justify-content: center; }
    .abt-exp-badge { right: 5px; bottom: -12px; padding: 10px 14px; border-radius: 12px; }
    .abt-exp-num { font-size: 1.3rem; }
    body { padding-bottom: 55px; }
}
</style>


<script>
document.addEventListener('livewire:navigated', () => {
    if (typeof AOS !== 'undefined') AOS.refresh();
});
</script><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/about-page.blade.php ENDPATH**/ ?>