<div class="contact-page-wrapper"
     x-data="{
        showMap: false,
        activeBranch: null,
        
        init() {
            // Initialize AOS after load
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        },
        
        openMap(address) {
            this.activeBranch = address;
            this.showMap = true;
        },
        
        closeMap() {
            this.showMap = false;
            this.activeBranch = null;
        }
     }">
    
    <!-- ============================================
         HERO SECTION
         ============================================ -->
    <section class="contact-hero">
        <div class="container contact-hero-content">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="contact-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Contact Us</li>
                        </ol>
                    </nav>
                    <h1 class="contact-hero-title">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($contact)): ?> 
                            <?php echo e($contact->cs_title); ?> 
                        <?php else: ?> 
                            Get In Touch 
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </h1>
                    <p class="contact-hero-subtitle">We'd love to hear from you. Reach out to our team today.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         CONTACT CONTENT
         ============================================ -->
    <section class="contact-section">
        <div class="container">
            
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="text-center py-5">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-2">Loading...</p>
                </div>
            <?php elseif($errorMessage): ?>
                <div class="alert alert-danger text-center rounded-3 shadow-sm border-0" data-aos="fade-up">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e($errorMessage); ?>

                    <button wire:click="retryLoad" class="btn btn-sm btn-outline-danger ms-3 rounded-pill">
                        <i class="fas fa-redo me-1"></i> Retry
                    </button>
                </div>
            <?php else: ?>
                
                
                <div class="row mb-5">
                    <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                        <span class="sec-tag">CONTACT US</span>
                        <h2 class="sec-title">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($contact)): ?> 
                                <?php echo e($contact->cs_title); ?> 
                            <?php else: ?> 
                                Feel Free to <span class="text-grad">Drop Us a Message</span> 
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </h2>
                        <p class="sec-desc">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($contact) && !empty($contact->cs_description)): ?>
                                <?php echo e(Str::limit($contact->cs_description, 200)); ?>

                            <?php else: ?>
                                Have a question or need a quote? Fill out the form below and our team will get back to you within 24 hours.
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </p>
                    </div>
                </div>
                
                <div class="row g-5">
                    
                    
                    <div class="col-lg-5" data-aos="fade-right">
                        
                        
                        <div class="contact-info-card">
                            <div class="cic-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h4 class="cic-title">Our Offices</h4>
                            <div class="cic-content">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($contactAddresses->count() > 0): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $contactAddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="cic-address-item" @click="openMap('<?php echo e($addr->ca_address); ?>')">
                                            <p class="mb-1 fw-semibold"><?php echo e($addr->display_title ?? 'Branch Office'); ?></p>
                                            <p class="mb-0 text-muted small"><?php echo e($addr->ca_address); ?></p>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($addr->ca_phone): ?>
                                                <a href="tel:<?php echo e($addr->ca_phone); ?>" class="text-success small fw-semibold">
                                                    <i class="fas fa-phone me-1"></i> <?php echo e($addr->ca_phone); ?>

                                                </a>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <?php else: ?>
                                    <p class="text-muted">Lahore | Islamabad | Karachi</p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                        
                        
                        <div class="contact-info-card">
                            <div class="cic-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <h4 class="cic-title">Call Us</h4>
                            <div class="cic-content">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($contactAddresses->count() > 0): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $contactAddresses->unique('ca_phone')->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <a href="tel:<?php echo e($addr->ca_phone); ?>" class="cic-phone-link">
                                            <i class="fas fa-phone text-success me-2"></i> <?php echo e($addr->ca_phone); ?>

                                        </a>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <?php else: ?>
                                    <a href="tel:+923048902805" class="cic-phone-link">
                                        <i class="fas fa-phone text-success me-2"></i> +92 304 8902805
                                    </a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <p class="text-muted small mt-2 mb-0">Available 24/7 for emergencies</p>
                            </div>
                        </div>
                        
                        
                        <div class="contact-info-card">
                            <div class="cic-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h4 class="cic-title">Email Us</h4>
                            <div class="cic-content">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($contactAddresses->count() > 0): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $contactAddresses->unique('ca_email')->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <a href="mailto:<?php echo e($addr->ca_email); ?>" class="cic-email-link">
                                            <i class="fas fa-envelope text-success me-2"></i> <?php echo e($addr->ca_email); ?>

                                        </a>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <?php else: ?>
                                    <a href="mailto:info@razzaqengineering.com" class="cic-email-link">
                                        <i class="fas fa-envelope text-success me-2"></i> info@razzaqengineering.com
                                    </a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <div class="col-lg-7" data-aos="fade-left">
                        <div class="contact-form-card">
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSuccess): ?>
                                <div class="text-center py-4">
                                    <div class="mb-3">
                                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                                             style="width:80px;height:80px;">
                                            <i class="fas fa-check-circle text-success fa-2x"></i>
                                        </div>
                                    </div>
                                    <h4 class="fw-bold text-dark">Message Sent!</h4>
                                    <p class="text-muted"><?php echo e($successMessage); ?></p>
                                    <button wire:click="resetSuccess" class="btn btn-gradient rounded-pill px-4 mt-2">
                                        <i class="fas fa-redo me-2"></i> Send Another Message
                                    </button>
                                </div>
                            <?php else: ?>
                                
                                
                                <h3 class="form-title">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($contact) && !empty($contact->form_title)): ?>
                                        <?php echo e($contact->form_title); ?>

                                    <?php else: ?>
                                        Send Us a Message
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </h3>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($contact) && !empty($contact->form_description)): ?>
                                    <p class="form-subtitle"><?php echo e($contact->form_description); ?></p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($formError): ?>
                                    <div class="alert alert-danger border-0 rounded-3 small">
                                        <i class="fas fa-exclamation-circle me-2"></i> <?php echo e($formError); ?>

                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                
                                <form wire:submit="submitForm" class="contact-form">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small">Full Name <span class="text-danger">*</span></label>
                                            <input type="text" wire:model.blur="name" 
                                                   class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   placeholder="Your full name">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small">Phone Number <span class="text-danger">*</span></label>
                                            <input type="tel" wire:model.blur="phone" 
                                                   class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   placeholder="+92 300 1234567">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" wire:model.blur="email" 
                                                   class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   placeholder="email@example.com">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small">Subject</label>
                                            <input type="text" wire:model.blur="subject" 
                                                   class="form-control <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   placeholder="How can we help?">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small">Company <small class="text-muted">(Optional)</small></label>
                                            <input type="text" wire:model.blur="company" 
                                                   class="form-control"
                                                   placeholder="Your company name">
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small">City <small class="text-muted">(Optional)</small></label>
                                            <input type="text" wire:model.blur="city" 
                                                   class="form-control"
                                                   placeholder="Your city">
                                        </div>
                                        
                                        <div class="col-12">
                                            <label class="form-label fw-semibold small">Message <span class="text-danger">*</span></label>
                                            <textarea wire:model.blur="message" 
                                                      class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                      rows="5"
                                                      placeholder="Describe your requirements..."></textarea>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <small class="text-muted"><?php echo e(strlen($message)); ?>/5000</small>
                                        </div>
                                        
                                        <div class="col-12">
                                            <button type="submit" 
                                                    class="btn btn-gradient btn-lg w-100 py-3 fw-bold rounded-3"
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
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                        </div>
                    </div>
                    
                </div>
                
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    <!-- ============================================
         MAP SECTION
         ============================================ -->
    <section class="map-section">
        <div class="container-fluid px-0">
            <div class="map-wrapper">
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

    <!-- ============================================
         QUICK CTA
         ============================================ -->
    <section class="contact-cta-section">
        <div class="container">
            <div class="contact-cta-card" data-aos="fade-up">
                <div class="row align-items-center">
                    <div class="col-lg-8 mb-3 mb-lg-0">
                        <h4 class="text-white fw-bold mb-2">Need Immediate Assistance?</h4>
                        <p class="text-white opacity-75 mb-0">Call us directly for emergency services or urgent inquiries.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="tel:+923048902805" class="btn-cta-light">
                            <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php $__env->startPush('styles'); ?>
<style>
    /* ============================================
       CONTACT PAGE STYLES
       ============================================ */
    
    /* Hero */
    .contact-hero {
        background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%);
        min-height: 250px;
        display: flex;
        align-items: center;
    }
    .contact-hero-content { width: 100%; }
    .contact-breadcrumb {
        display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 10px;
    }
    .contact-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .contact-breadcrumb li a { color: #fff; text-decoration: none; }
    .contact-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .contact-hero-title { color: #fff; font-size: 2.5rem; font-weight: 800; }
    .contact-hero-subtitle { color: rgba(255,255,255,0.8); font-size: 1rem; }

    /* Section */
    .contact-section { padding: 70px 0; background: #f8f9fa; }
    .sec-tag {
        display: inline-block; font-size: 0.72rem; font-weight: 700; letter-spacing: 3px;
        color: #28a745; text-transform: uppercase; margin-bottom: 8px;
    }
    .sec-title { font-size: 2rem; font-weight: 800; color: #0a1628; margin-bottom: 10px; }
    .text-grad {
        background: linear-gradient(135deg, #0056b3, #28a745);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .sec-desc { color: #888; font-size: 0.95rem; }

    /* Contact Info Cards */
    .contact-info-card {
        background: #fff; border-radius: 16px; padding: 25px; margin-bottom: 20px;
        box-shadow: 0 3px 20px rgba(0,0,0,0.04); border: 1px solid #eef0f2;
        transition: all 0.3s ease;
    }
    .contact-info-card:hover { box-shadow: 0 10px 35px rgba(0,0,0,0.08); }
    .cic-icon {
        width: 50px; height: 50px; background: linear-gradient(135deg, rgba(40,167,69,0.1), rgba(0,86,179,0.1));
        border-radius: 12px; display: flex; align-items: center; justify-content: center;
        font-size: 20px; color: #28a745; margin-bottom: 15px;
    }
    .cic-title { font-size: 1.1rem; font-weight: 700; margin-bottom: 10px; }
    .cic-address-item {
        padding: 10px 0; border-bottom: 1px solid #f0f0f0; cursor: pointer; transition: all 0.2s;
    }
    .cic-address-item:last-child { border-bottom: none; }
    .cic-address-item:hover { padding-left: 5px; color: #0056b3; }
    .cic-phone-link, .cic-email-link {
        display: block; padding: 8px 0; color: #0a1628; text-decoration: none;
        font-weight: 600; font-size: 0.95rem; transition: color 0.3s;
    }
    .cic-phone-link:hover, .cic-email-link:hover { color: #28a745; }

    /* Form Card */
    .contact-form-card {
        background: #fff; border-radius: 20px; padding: 35px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.06); border: 1px solid #eef0f2;
    }
    .form-title { font-size: 1.5rem; font-weight: 700; margin-bottom: 5px; }
    .form-subtitle { color: #888; font-size: 0.9rem; margin-bottom: 20px; }
    .contact-form .form-control {
        border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 16px;
        font-size: 0.9rem; transition: all 0.3s;
    }
    .contact-form .form-control:focus {
        border-color: #28a745; box-shadow: 0 0 0 0.2rem rgba(40,167,69,0.1);
    }

    /* Map */
    .map-section { position: relative; }
    .map-wrapper { width: 100%; }
    .map-wrapper iframe { width: 100%; height: 400px; display: block; }

    /* CTA */
    .contact-cta-section { padding: 50px 0; background: #f8f9fa; }
    .contact-cta-card {
        background: linear-gradient(135deg, #0056b3, #003d80);
        border-radius: 20px; padding: 30px 35px; box-shadow: 0 15px 40px rgba(0,86,179,0.25);
    }
    .btn-cta-light {
        display: inline-flex; align-items: center; padding: 14px 30px;
        background: #fff; color: #0056b3; text-decoration: none;
        border-radius: 8px; font-weight: 700; font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    .btn-cta-light:hover { background: #28a745; color: #fff; transform: translateY(-2px); }

    /* Responsive */
    @media (max-width: 991.98px) {
        .contact-section { padding: 50px 0; }
        .contact-hero { min-height: 200px; }
        .contact-hero-title { font-size: 2rem; }
        .contact-form-card { padding: 25px; }
    }
    @media (max-width: 767.98px) {
        .contact-section { padding: 40px 0; }
        .contact-hero-title { font-size: 1.6rem; }
        .sec-title { font-size: 1.5rem; }
        .contact-form-card { padding: 20px; border-radius: 14px; }
        .map-wrapper iframe { height: 300px; }
        .contact-cta-card { padding: 20px; text-align: center; }
        .btn-cta-light { width: 100%; justify-content: center; margin-top: 10px; }
    }
    @media (max-width: 575.98px) {
        .contact-hero { min-height: 170px; }
        .contact-hero-title { font-size: 1.3rem; }
        .contact-info-card { padding: 18px; }
        .contact-form-card { padding: 15px; }
        .contact-form .form-control { padding: 10px 14px; font-size: 0.85rem; }
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/contact-page.blade.php ENDPATH**/ ?>