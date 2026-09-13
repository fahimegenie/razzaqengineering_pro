<div class="cnt-page" 
     x-data="{
        showMap: false,
        activeBranch: null,
        
        openMap(address) {
            this.activeBranch = address;
            this.showMap = true;
        },
        
        closeMap() {
            this.showMap = false;
            this.activeBranch = null;
        }
     }">
    
    
    <div class="cnt-mobile-cta d-lg-none" wire:ignore>
        <a href="tel:+923048902805" class="cnt-mobile-btn cnt-mobile-call">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/923048902805" target="_blank" class="cnt-mobile-btn cnt-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="<?php echo e(route('quote.index')); ?>" class="cnt-mobile-btn cnt-mobile-quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    
    <section class="cnt-hero">
        <div class="cnt-hero-bg"></div>
        <div class="cnt-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-30">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="cnt-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Contact Us</li>
                        </ol>
                    </nav>
                    
                    <div class="cnt-hero-badge">
                        <i class="fas fa-headset"></i> 24/7 Support
                    </div>
                    
                    <h1 class="cnt-hero-title">
                        <?php echo e(!empty($contact) ? $contact->cs_title : 'Get In Touch'); ?>

                    </h1>
                    <p class="cnt-hero-subtitle">
                        We'd love to hear from you. Reach out to our team today for any inquiries or project discussions.
                    </p>
                    
                    <div class="cnt-hero-stats">
                        <div class="cnt-stat-item">
                            <span class="cnt-stat-number">24/7</span>
                            <span class="cnt-stat-label">Support</span>
                        </div>
                        <div class="cnt-stat-item">
                            <span class="cnt-stat-number">&lt; 24h</span>
                            <span class="cnt-stat-label">Response</span>
                        </div>
                        <div class="cnt-stat-item">
                            <span class="cnt-stat-number">100%</span>
                            <span class="cnt-stat-label">Satisfaction</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="cnt-trust-bar" wire:ignore>
        <div class="container">
            <div class="cnt-trust-grid">
                <div class="cnt-trust-card">
                    <div class="cnt-trust-icon"><i class="fas fa-phone-alt"></i></div>
                    <div>
                        <strong>Call Us</strong>
                        <span>+92 304 8902805</span>
                    </div>
                </div>
                <div class="cnt-trust-card">
                    <div class="cnt-trust-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <strong>Email Us</strong>
                        <span>info@razzaqengineering.com</span>
                    </div>
                </div>
                <div class="cnt-trust-card">
                    <div class="cnt-trust-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <strong>Visit Us</strong>
                        <span>Multiple Locations</span>
                    </div>
                </div>
                <div class="cnt-trust-card">
                    <div class="cnt-trust-icon"><i class="fab fa-whatsapp"></i></div>
                    <div>
                        <strong>WhatsApp</strong>
                        <span>Instant Chat</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="cnt-main-section">
        <div class="container">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="cnt-state-box" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'state-loading'; ?>wire:key="state-loading">
                    <div class="spinner-grow text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-3 fw-semibold">Loading contact information...</p>
                </div>
            
            <?php elseif($errorMessage): ?>
                <div class="cnt-error-card" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'state-error'; ?>wire:key="state-error">
                    <i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;"></i>
                    <h4 class="fw-bold mt-3">Oops! Something went wrong</h4>
                    <p class="text-muted"><?php echo e($errorMessage); ?></p>
                    <button class="btn btn-primary mt-3" wire:click="retryLoad">
                        <i class="fas fa-redo me-2"></i> Retry
                    </button>
                </div>
            
            <?php else: ?>
                <div class="cnt-content-loaded" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'state-content-loaded'; ?>wire:key="state-content-loaded">
                    <div class="cnt-section-header text-center" data-aos="fade-up">
                        <span class="cnt-section-badge"><i class="fas fa-envelope-open-text"></i> Get In Touch</span>
                        <h2><?php echo e(!empty($contact) ? $contact->cs_title : 'Feel Free to Drop Us a Message'); ?></h2>
                        <p>
                            <?php echo e(!empty($contact) && !empty($contact->cs_description) 
                                ? Str::limit($contact->cs_description, 200) 
                                : 'Have a question or need a quote? Fill out the form below and our team will get back to you within 24 hours.'); ?>

                        </p>
                    </div>

                    <div class="row g-4">
                        
                        
                        <div class="col-lg-5" data-aos="fade-right">
                            <div class="cnt-info-card">
                                <div class="cnt-info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h4>Our Offices</h4>
                                <div class="cnt-info-content">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($contactAddresses) > 0): ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $contactAddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <div class="cnt-address-item" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'addr-list-'.e($addr->id).''; ?>wire:key="addr-list-<?php echo e($addr->id); ?>">
                                                <strong><?php echo e($addr->display_title ?? 'Branch Office'); ?></strong>
                                                <p><?php echo e($addr->ca_address); ?></p>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($addr->ca_phone): ?>
                                                    <a href="tel:<?php echo e($addr->ca_phone); ?>" class="cnt-contact-link">
                                                        <i class="fas fa-phone-alt"></i> <?php echo e($addr->ca_phone); ?>

                                                    </a>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    <?php else: ?>
                                        <p class="text-muted">Lahore | Islamabad | Karachi | Multan</p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="cnt-info-card">
                                <div class="cnt-info-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <h4>Call Us Directly</h4>
                                <div class="cnt-info-content">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($contactAddresses) > 0): ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $contactAddresses->unique('ca_phone')->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <a href="tel:<?php echo e($addr->ca_phone); ?>" class="cnt-contact-link cnt-phone-link" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'phone-list-'.e($addr->id).''; ?>wire:key="phone-list-<?php echo e($addr->id); ?>">
                                                <i class="fas fa-phone-alt"></i> <?php echo e($addr->ca_phone); ?>

                                            </a>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    <?php else: ?>
                                        <a href="tel:+923048902805" class="cnt-contact-link cnt-phone-link">
                                            <i class="fas fa-phone-alt"></i> +92 304 8902805
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <span class="cnt-badge-available">Available 24/7</span>
                                </div>
                            </div>
                            
                            <div class="cnt-info-card">
                                <div class="cnt-info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h4>Email Us</h4>
                                <div class="cnt-info-content">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($contactAddresses) > 0): ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $contactAddresses->unique('ca_email')->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <a href="mailto:<?php echo e($addr->ca_email); ?>" class="cnt-contact-link" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'email-list-'.e($addr->id).''; ?>wire:key="email-list-<?php echo e($addr->id); ?>">
                                                <i class="fas fa-envelope"></i> <?php echo e($addr->ca_email); ?>

                                            </a>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    <?php else: ?>
                                        <a href="mailto:info@razzaqengineering.com" class="cnt-contact-link">
                                            <i class="fas fa-envelope"></i> info@razzaqengineering.com
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>

                            <div class="cnt-info-card">
                                <div class="cnt-info-icon">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <h4>WhatsApp Chat</h4>
                                <div class="cnt-info-content">
                                    <a href="https://wa.me/923048902805" target="_blank" class="cnt-contact-link">
                                        <i class="fab fa-whatsapp"></i> +92 304 8902805
                                    </a>
                                    <span class="cnt-badge-available">Instant Reply</span>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-lg-7" data-aos="fade-left">
                            <div class="cnt-form-card">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSuccess): ?>
                                    <div class="cnt-success-state" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'state-form-success'; ?>wire:key="state-form-success">
                                        <div class="cnt-success-icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <h3>Message Sent Successfully!</h3>
                                        <p><?php echo e($successMessage); ?></p>
                                        <button type="button" wire:click="resetSuccess" class="cnt-btn cnt-btn-accent">
                                            <i class="fas fa-redo me-2"></i> Send Another Message
                                        </button>
                                    </div>
                                <?php else: ?>
                                    <div class="cnt-form-container" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'state-form-input'; ?>wire:key="state-form-input">
                                        <h3 class="cnt-form-title">
                                            <?php echo e(!empty($contact) && !empty($contact->form_title) ? $contact->form_title : 'Send Us a Message'); ?>

                                        </h3>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($contact) && !empty($contact->form_description)): ?>
                                            <p class="cnt-form-subtitle"><?php echo $contact->form_description; ?></p>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($formError): ?>
                                            <div class="cnt-alert-error" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'alert-error'; ?>wire:key="alert-error">
                                                <i class="fas fa-exclamation-circle"></i> <?php echo e($formError); ?>

                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        
                                        <form wire:submit="submitForm" class="cnt-form">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="cnt-form-label">Full Name <span>*</span></label>
                                                    <input type="text" wire:model.blur="name" 
                                                           class="cnt-form-input <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                           placeholder="Your full name">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="cnt-error-text"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <label class="cnt-form-label">Phone Number <span>*</span></label>
                                                    <input type="tel" wire:model.blur="phone" 
                                                           class="cnt-form-input <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                           placeholder="+92 300 1234567">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="cnt-error-text"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <label class="cnt-form-label">Email Address <span>*</span></label>
                                                    <input type="email" wire:model.blur="email" 
                                                           class="cnt-form-input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                           placeholder="email@example.com">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="cnt-error-text"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <label class="cnt-form-label">Subject</label>
                                                    <input type="text" wire:model.blur="subject" 
                                                           class="cnt-form-input"
                                                           placeholder="How can we help?">
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <label class="cnt-form-label">Company <small>(Optional)</small></label>
                                                    <input type="text" wire:model.blur="company" 
                                                           class="cnt-form-input"
                                                           placeholder="Your company name">
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <label class="cnt-form-label">City <small>(Optional)</small></label>
                                                    <input type="text" wire:model.blur="city" 
                                                           class="cnt-form-input"
                                                           placeholder="Your city">
                                                </div>
                                                
                                                <div class="col-12">
                                                    <label class="cnt-form-label">Message <span>*</span></label>
                                                    <textarea wire:model.blur="cm_message" 
                                                              class="cnt-form-input cnt-form-textarea <?php $__errorArgs = ['cm_message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                              rows="5"
                                                              placeholder="Describe your requirements..."></textarea>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cm_message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="cnt-error-text"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    <small class="cnt-char-count"><?php echo e(strlen($message ?? '')); ?>/5000</small>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <button type="submit" 
                                                            class="cnt-btn cnt-btn-submit"
                                                            wire:loading.attr="disabled">
                                                        <span wire:loading.remove wire:target="submitForm">
                                                            <i class="fas fa-paper-plane me-2"></i> Send Message
                                                        </span>
                                                        <span wire:loading wire:target="submitForm">
                                                            <span class="spinner-border spinner-border-sm me-2"></span> Sending...
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    
    <section class="cnt-map-section" wire:ignore>
        <div class="container-fluid px-0">
            <div class="cnt-map-wrapper">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($contact) && !empty($contact->map_address)): ?>
                    <?php echo $contact->map_address; ?>

                <?php else: ?>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3402.816!2d74.3436!3d31.5497!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391904f3d4b4b5e7%3A0x8b4b4b4b4b4b4b4b!2sLahore%2C%20Pakistan!5e0!3m2!1sen!2s!4v1630000000000" 
                            width="100%" 
                            height="400" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                    </iframe>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>

    
    <section class="cnt-final-cta" wire:ignore>
        <div class="container text-center">
            <h2>Need Immediate Assistance?</h2>
            <p class="mb-4">Call us directly for emergency services or urgent inquiries. We're available 24/7.</p>
            <div class="cnt-final-cta-buttons">
                <a href="<?php echo e(route('quote.index')); ?>" class="cnt-btn cnt-btn-lg cnt-btn-accent">
                    <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                </a>
                <a href="tel:+923048902805" class="cnt-btn cnt-btn-lg cnt-btn-white-outline-dark">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>
</div>

<?php $__env->startPush('styles'); ?>

<style>
/* ============================================
   CONTACT PAGE - ENTERPRISE GRADE DESIGN
   Laravel 13 + Livewire 4 + Alpine.js
   ============================================ */

/* --- Mobile Sticky CTA --- */
.cnt-mobile-cta {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 998;
    display: flex; background: #fff; box-shadow: 0 -4px 20px rgba(0,0,0,0.12);
}

.cnt-mobile-btn {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
    padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none;
    border: none; cursor: pointer; transition: all 0.2s;
}

.cnt-mobile-call { background: #f8f9fa; color: #0a1628; }
.cnt-mobile-whatsapp { background: #25D366; color: #fff; }
.cnt-mobile-quote { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; }

/* --- Hero Section --- */
.cnt-hero {
    position: relative; padding: 90px 0 70px; overflow: hidden;
    min-height: 420px; display: flex; align-items: center;
}

.cnt-hero-bg {
    position: absolute; inset: 0;
    background: url('<?php echo e(asset("images/contact-hero-bg.jpg")); ?>') center/cover no-repeat;
    filter: brightness(0.3);
}

.cnt-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,61,128,0.88) 0%, rgba(26,92,42,0.82) 100%);
}

.cnt-hero .container { position: relative; z-index: 2; }

.cnt-breadcrumb {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px;
    font-size: 0.84rem; color: rgba(255,255,255,0.7);
}

.cnt-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.cnt-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.cnt-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.cnt-breadcrumb a:hover { color: #fff; }
.cnt-breadcrumb .active { color: rgba(255,255,255,0.6); }

.cnt-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
    color: #fff; padding: 8px 18px; border-radius: 50px;
    font-size: 0.85rem; font-weight: 600; margin-bottom: 18px;
}

.cnt-hero-title { color: #fff; font-size: clamp(2.2rem, 5vw, 3rem); font-weight: 800; margin: 0 0 12px; line-height: 1.15; }
.cnt-hero-subtitle { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 550px; margin: 0 0 25px; line-height: 1.6; }

.cnt-hero-stats { display: flex; gap: 30px; flex-wrap: wrap; }
.cnt-stat-item { text-align: center; }
.cnt-stat-number { display: block; font-size: 1.8rem; font-weight: 800; color: #28a745; }
.cnt-stat-label { font-size: 0.78rem; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 1px; }

/* --- Trust Bar --- */
.cnt-trust-bar { background: #fff; border-bottom: 1px solid #eef0f2; }
.cnt-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); }

.cnt-trust-card {
    display: flex; align-items: center; gap: 12px; padding: 20px;
    border-right: 1px solid #f0f0f0;
}
.cnt-trust-card:last-child { border-right: none; }

.cnt-trust-icon {
    width: 44px; height: 44px; min-width: 44px; background: rgba(40,167,69,0.1);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #28a745; font-size: 1.1rem;
}

.cnt-trust-card strong { display: block; font-size: 1.1rem; color: #0a1628; }
.cnt-trust-card span { font-size: 0.75rem; color: #888; }

/* --- Main Section --- */
.cnt-main-section { padding: 40px 0 60px; background: #f8f9fa; }

/* --- Section Header --- */
.cnt-section-header { margin-bottom: 35px; }

.cnt-section-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(40,167,69,0.1); color: #28a745; padding: 6px 16px;
    border-radius: 50px; font-size: 0.78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px;
}

.cnt-section-header h2 { font-size: 1.8rem; font-weight: 800; color: #0a1628; margin-bottom: 8px; }
.cnt-section-header p { color: #888; max-width: 600px; margin: 0 auto; }

/* --- Info Cards --- */
.cnt-info-card {
    background: #fff; border-radius: 14px; padding: 22px; margin-bottom: 15px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.04); border: 1px solid #eef0f2;
    transition: all 0.3s ease;
}

.cnt-info-card:hover { box-shadow: 0 8px 30px rgba(0,0,0,0.06); }

.cnt-info-icon {
    width: 48px; height: 48px; background: linear-gradient(135deg, rgba(40,167,69,0.1), rgba(0,86,179,0.1));
    border-radius: 12px; display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem; color: #28a745; margin-bottom: 12px;
}

.cnt-info-card h4 { font-size: 1.05rem; font-weight: 700; margin-bottom: 10px; color: #0a1628; }

.cnt-address-item {
    padding: 10px 0; border-bottom: 1px solid #f0f0f0;
}
.cnt-address-item:last-child { border-bottom: none; }
.cnt-address-item strong { display: block; font-size: 0.88rem; margin-bottom: 2px; }
.cnt-address-item p { font-size: 0.82rem; color: #888; margin: 0 0 4px; }

.cnt-contact-link {
    display: flex; align-items: center; gap: 8px; padding: 6px 0;
    color: #0a1628; text-decoration: none; font-weight: 600; font-size: 0.9rem;
    transition: color 0.2s;
}

.cnt-contact-link:hover { color: #28a745; }
.cnt-contact-link i { color: #28a745; width: 18px; }

.cnt-phone-link { font-size: 1rem; }

.cnt-badge-available {
    display: inline-block; font-size: 0.7rem; padding: 3px 10px;
    background: rgba(40,167,69,0.1); color: #28a745; border-radius: 50px;
    font-weight: 600; margin-top: 6px;
}

/* --- Form Card --- */
.cnt-form-card {
    background: #fff; border-radius: 16px; padding: 30px;
    box-shadow: 0 8px 35px rgba(0,0,0,0.06); border: 1px solid #eef0f2;
}

.cnt-form-title { font-size: 1.4rem; font-weight: 700; margin-bottom: 4px; color: #0a1628; }
.cnt-form-subtitle { color: #888; font-size: 0.88rem; margin-bottom: 20px; }

.cnt-form-label {
    font-size: 0.78rem; font-weight: 600; color: #555; margin-bottom: 4px; display: block;
}
.cnt-form-label span { color: #dc3545; }

.cnt-form-input {
    width: 100%; padding: 12px 16px; border: 2px solid #e9ecef;
    border-radius: 10px; font-size: 0.9rem; color: #333; background: #fff;
    transition: all 0.3s ease; outline: none;
}

.cnt-form-input:focus { border-color: #28a745; box-shadow: 0 0 0 3px rgba(40,167,69,0.1); }
.cnt-form-input.error { border-color: #dc3545; }

.cnt-form-textarea { resize: vertical; min-height: 120px; }

.cnt-error-text { color: #dc3545; font-size: 0.75rem; display: block; margin-top: 4px; }
.cnt-char-count { font-size: 0.72rem; color: #aaa; float: right; margin-top: 4px; }

.cnt-alert-error {
    background: #fff5f5; color: #dc3545; padding: 12px 16px; border-radius: 10px;
    font-size: 0.85rem; margin-bottom: 15px; display: flex; align-items: center; gap: 8px;
}

/* --- Buttons --- */
.cnt-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 0.9rem;
    text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none;
    white-space: nowrap;
}

.cnt-btn-lg { padding: 14px 28px; font-size: 0.95rem; border-radius: 10px; }
.cnt-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.cnt-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; }

.cnt-btn-submit {
    width: 100%; padding: 14px; background: linear-gradient(135deg, #0056b3, #003d80);
    color: #fff; font-size: 0.95rem; border-radius: 10px; font-weight: 700;
    box-shadow: 0 6px 25px rgba(0,86,179,0.3);
}

.cnt-btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(0,86,179,0.45); color: #fff; }
.cnt-btn-submit:disabled { opacity: 0.6; cursor: not-allowed; }

.cnt-btn-white-outline-dark { background: transparent; color: #0a1628; border: 2px solid #0a1628; }
.cnt-btn-white-outline-dark:hover { background: #0a1628; color: #fff; }

/* --- Success State --- */
.cnt-success-state { text-align: center; padding: 30px 20px; }
.cnt-success-icon {
    width: 80px; height: 80px; margin: 0 auto 15px;
    background: rgba(40,167,69,0.1); border-radius: 50%; display: flex;
    align-items: center; justify-content: center; font-size: 2.5rem; color: #28a745;
}
.cnt-success-state h3 { font-size: 1.3rem; font-weight: 700; color: #0a1628; }
.cnt-success-state p { color: #888; max-width: 400px; margin: 0 auto 15px; }

/* --- Map --- */
.cnt-map-section { position: relative; }
.cnt-map-wrapper iframe { width: 100%; height: 400px; display: block; }

/* --- Final CTA --- */
.cnt-final-cta { padding: 60px 0; background: #fff; }
.cnt-final-cta h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 10px; }
.cnt-final-cta p { font-size: 1rem; color: #666; max-width: 500px; margin: 0 auto 20px; }
.cnt-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

/* --- States --- */
.cnt-state-box { text-align: center; padding: 60px 20px; }
.cnt-error-card { max-width: 500px; margin: 40px auto; padding: 40px 30px; background: #fff; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); text-align: center; }

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 1199.98px) {
    .cnt-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .cnt-trust-card:nth-child(2) { border-right: none; }
}

@media (max-width: 991.98px) {
    .cnt-hero { padding: 60px 0 50px; min-height: auto; }
    .cnt-hero-title { font-size: 1.8rem; }
    .cnt-form-card { padding: 20px; }
}

@media (max-width: 767.98px) {
    .cnt-hero { padding: 45px 0 40px; }
    .cnt-hero-title { font-size: 1.5rem; }
    .cnt-hero-stats { gap: 15px; }
    .cnt-stat-number { font-size: 1.4rem; }
    .cnt-trust-grid { grid-template-columns: 1fr 1fr; }
    .cnt-trust-card { padding: 14px; gap: 8px; }
    .cnt-map-wrapper iframe { height: 300px; }
}

@media (max-width: 575.98px) {
    .cnt-hero { padding: 35px 0 30px; }
    .cnt-hero-title { font-size: 1.3rem; }
    .cnt-hero-badge { font-size: 0.75rem; padding: 6px 14px; }
    .cnt-breadcrumb { font-size: 0.75rem; }
    .cnt-trust-grid { grid-template-columns: 1fr 1fr; }
    .cnt-trust-card { padding: 12px 10px; border-bottom: 1px solid #f0f0f0; }
    .cnt-trust-card:nth-child(even) { border-right: none; }
    .cnt-trust-icon { width: 34px; height: 34px; min-width: 34px; font-size: 0.9rem; }
    .cnt-form-card { padding: 16px; border-radius: 12px; }
    .cnt-form-input { padding: 10px 14px; font-size: 0.84rem; }
    .cnt-form-title { font-size: 1.2rem; }
    .cnt-final-cta { padding: 40px 0; }
    .cnt-final-cta-buttons { flex-direction: column; }
    .cnt-final-cta-buttons .cnt-btn { width: 100%; justify-content: center; }
    body { padding-bottom: 55px; }
}
</style>


<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/contact-page.blade.php ENDPATH**/ ?>