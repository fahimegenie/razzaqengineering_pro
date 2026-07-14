<div class="quote-page-wrapper">
    
    <!-- ============================================
         PAGE HERO BANNER
         ============================================ -->
    <section class="page-hero position-relative d-flex align-items-center" 
             style="background: linear-gradient(135deg, rgba(0,86,179,0.92) 0%, rgba(40,167,69,0.88) 100%), url('<?php echo e(asset('assets/images/quote-banner.jpg')); ?>') center/cover no-repeat; min-height: 350px;">
        <div class="container position-relative z-2 text-center">
            <span class="badge bg-white text-dark mb-3 px-4 py-2 rounded-pill fw-semibold" data-aos="fade-down">
                <i class="fas fa-calculator me-2"></i> Free Estimate
            </span>
            <h1 class="text-white fw-bold display-4 mb-3" data-aos="fade-up">Get a Free Quote</h1>
            <p class="text-white opacity-90 lead mb-0" data-aos="fade-up" data-aos-delay="100">
                Tell us about your project and we'll provide a detailed, no-obligation quote within 24 hours
            </p>
        </div>
        <div class="position-absolute bottom-0 start-0 w-100">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" preserveAspectRatio="none">
                <path fill="#f8f9fa" d="M0,64L80,58.7C160,53,320,43,480,48C640,53,800,75,960,74.7C1120,75,1280,53,1360,42.7L1440,32L1440,80L1360,80C1280,80,1120,80,960,80C800,80,640,80,480,80C320,80,160,80,80,80L0,80Z"/>
            </svg>
        </div>
    </section>

    <!-- ============================================
         QUOTE FORM SECTION
         ============================================ -->
    <section class="quote-form-section py-5 bg-light" id="quoteFormSection">
        <div class="container">
            
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($is_success): ?>
                <div class="row justify-content-center" data-aos="zoom-in">
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-lg rounded-4 p-5 text-center">
                            <div class="mb-4">
                                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                                     style="width:100px;height:100px;">
                                    <i class="fas fa-check-circle text-success fa-3x"></i>
                                </div>
                            </div>
                            
                            <h2 class="fw-bold mb-3">Thank You, <?php echo e($submitted_quote_name); ?>!</h2>
                            <p class="text-muted mb-2">Your quote request has been received successfully.</p>
                            <p class="text-muted mb-4">
                                <strong>Reference #:</strong> 
                                <span class="badge bg-gradient text-white px-3 py-2">
                                    <?php echo e(str_pad($submitted_quote_id, 5, '0', STR_PAD_LEFT)); ?>

                                </span>
                            </p>
                            
                            <div class="bg-light rounded-4 p-4 mb-4 text-start">
                                <h6 class="fw-bold mb-3"><i class="fas fa-clock text-primary me-2"></i> What Happens Next?</h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2 d-flex align-items-start">
                                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                        <span class="small">Our team will review your requirements within 2-4 hours</span>
                                    </li>
                                    <li class="mb-2 d-flex align-items-start">
                                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                        <span class="small">You'll receive a detailed quote within 24 hours</span>
                                    </li>
                                    <li class="d-flex align-items-start">
                                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                        <span class="small">Free site inspection available for larger projects</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="d-flex flex-wrap gap-2 justify-content-center">
                                <a href="<?php echo e(url('/')); ?>" class="btn btn-gradient px-4 py-2 rounded-pill fw-semibold">
                                    <i class="fas fa-home me-2"></i> Back to Home
                                </a>
                                <button wire:click="resetForm" class="btn btn-outline-primary px-4 py-2 rounded-pill fw-semibold">
                                    <i class="fas fa-redo me-2"></i> Submit Another Quote
                                </button>
                                <a href="tel:+923048902805" class="btn btn-success px-4 py-2 rounded-pill fw-semibold">
                                    <i class="fas fa-phone-alt me-2"></i> Call Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
            <?php else: ?>
                
                <div class="row g-4">
                    <!-- Left Column - Form -->
                    <div class="col-lg-8" data-aos="fade-right">
                        <div class="card border-0 shadow-lg rounded-4 p-4 p-lg-5">
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($error_message): ?>
                                <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e($error_message); ?>

                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="fw-semibold small text-muted">Step <?php echo e($current_step); ?> of <?php echo e($total_steps); ?></span>
                                        <span class="fw-semibold small text-gradient"><?php echo e($this->stepLabel); ?></span>
                                    </div>
                                    <div class="progress" style="height: 6px; border-radius: 10px;">
                                        <div class="progress-bar bg-gradient" 
                                            role="progressbar" 
                                            style="width: <?php echo e($this->progressPercentage); ?>%; transition: width 0.5s ease;"
                                            aria-valuenow="<?php echo e($this->progressPercentage); ?>" 
                                            aria-valuemin="0" 
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between mt-2">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 1; $i <= $total_steps; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <button wire:click="goToStep(<?php echo e($i); ?>)" 
                                                    class="btn btn-sm <?php echo e($current_step == $i ? 'btn-gradient' : ($current_step > $i ? 'btn-success' : 'btn-light')); ?> rounded-circle"
                                                    style="width:30px;height:30px;padding:0;line-height:30px;font-size:12px;"
                                                    <?php echo e($i > $current_step ? 'disabled' : ''); ?>>
                                                <?php echo e($current_step > $i ? '✓' : $i); ?>

                                            </button>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>
                                </div>
                            
                            <h2 class="fw-bold mb-2 text-dark">Request Your Free Quote</h2>
                            <p class="text-muted mb-4">Fill in the details and our team will get back to you with a customized quote.</p>
                            
                            <form wire:submit="submitQuote" id="quoteForm">
                                <?php echo csrf_field(); ?>
                                
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($current_step == 1): ?>
                                    <div class="form-section mb-4 animate__animated animate__fadeIn">
                                        <h5 class="fw-bold mb-3 text-gradient d-flex align-items-center">
                                            <span class="badge bg-gradient text-white me-2 rounded-circle" style="width:30px;height:30px;line-height:30px;">1</span>
                                            Personal Information
                                        </h5>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-user text-muted"></i></span>
                                                    <input type="text" wire:model.blur="full_name" class="form-control border-start-0 ps-0 <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter your full name">
                                                </div>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-phone text-muted"></i></span>
                                                    <input type="tel" wire:model.blur="phone" class="form-control border-start-0 ps-0 <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="+92 300 1234567">
                                                </div>
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
                                                <label class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                                    <input type="email" wire:model.blur="email" class="form-control border-start-0 ps-0 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="email@example.com">
                                                </div>
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
                                                <label class="form-label fw-semibold">Company Name <small class="text-muted">(Optional)</small></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-building text-muted"></i></span>
                                                    <input type="text" wire:model.blur="company" class="form-control border-start-0 ps-0" placeholder="Your company name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($current_step == 2): ?>
                                    <div class="form-section mb-4 animate__animated animate__fadeIn">
                                        <h5 class="fw-bold mb-3 text-gradient d-flex align-items-center">
                                            <span class="badge bg-gradient text-white me-2 rounded-circle" style="width:30px;height:30px;line-height:30px;">2</span>
                                            Project Details
                                        </h5>
                                        <div class="row g-3">
                                            
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Service Required <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-tools text-muted"></i></span>
                                                    <input type="text" 
                                                        wire:model.blur="service_type" 
                                                        class="form-control border-start-0 ps-0 <?php $__errorArgs = ['service_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                        placeholder="e.g., RCC Core Cutting, Plumbing, Wall Saw Cutting...">
                                                </div>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['service_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <small class="text-muted">Enter the type of service you need</small>
                                            </div>
                                            
                                            
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Project Location <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-map-marker-alt text-muted"></i></span>
                                                    <input type="text" 
                                                        wire:model.blur="project_location" 
                                                        class="form-control border-start-0 ps-0 <?php $__errorArgs = ['project_location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                        placeholder="e.g., Lahore, DHA Phase 5, Plot #123...">
                                                </div>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['project_location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <small class="text-muted">Enter city and complete address</small>
                                            </div>
                                            
                                            
                                            <div class="col-12">
                                                <label class="form-label fw-semibold">Project Details <span class="text-danger">*</span></label>
                                                <textarea wire:model.blur="project_details" 
                                                        class="form-control <?php $__errorArgs = ['project_details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                        rows="6" 
                                                        placeholder="Please describe your project in detail:
                                - What type of work is required?
                                - Dimensions/area of the project
                                - Any specific materials or requirements
                                - Timeline expectations
                                - Any other relevant details..."></textarea>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['project_details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <div class="d-flex justify-content-between">
                                                    <small class="text-muted">Min 10 characters required</small>
                                                    <small class="text-muted"><?php echo e(strlen($project_details)); ?>/5000</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($current_step == 3): ?>
                                    <div class="form-section mb-4 animate__animated animate__fadeIn">
                                        <h5 class="fw-bold mb-3 text-gradient d-flex align-items-center">
                                            <span class="badge bg-gradient text-white me-2 rounded-circle" style="width:30px;height:30px;line-height:30px;">3</span>
                                            Additional Information
                                        </h5>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">How did you hear about us?</label>
                                                <select wire:model.blur="referral_source" class="form-select">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $referralSources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Attach File <small class="text-muted">(Max 10MB)</small></label>
                                                <input type="file" wire:model="attachment" class="form-control <?php $__errorArgs = ['attachment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['attachment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <div wire:loading wire:target="attachment" class="mt-2">
                                                    <div class="progress" style="height: 4px;">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 100%"></div>
                                                    </div>
                                                    <small class="text-muted">Uploading file...</small>
                                                </div>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($attachment): ?>
                                                    <small class="text-success mt-1 d-block">
                                                        <i class="fas fa-check-circle me-1"></i> File ready: <?php echo e($attachment->getClientOriginalName()); ?>

                                                    </small>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <small class="text-muted">Accepted: jpg, png, pdf, doc (max 10MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                
                                <div class="d-flex gap-3 align-items-center mt-4 flex-wrap">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($current_step > 1): ?>
                                        <button type="button" wire:click="prevStep" class="btn btn-outline-secondary btn-lg px-4 py-3 fw-semibold rounded-pill">
                                            <i class="fas fa-arrow-left me-2"></i> Previous
                                        </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($current_step < $total_steps): ?>
                                        <button type="button" wire:click="nextStep" class="btn btn-gradient btn-lg px-5 py-3 fw-bold rounded-pill ms-auto">
                                            Next Step <i class="fas fa-arrow-right ms-2"></i>
                                        </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($current_step == $total_steps): ?>
                                        <button type="submit" class="btn btn-gradient btn-lg px-5 py-3 fw-bold rounded-pill ms-auto" wire:loading.attr="disabled">
                                            <span wire:loading.remove wire:target="submitQuote">
                                                <i class="fas fa-paper-plane me-2"></i> Submit Quote Request
                                            </span>
                                            <span wire:loading wire:target="submitQuote">
                                                <span class="spinner-border spinner-border-sm me-2"></span> Submitting...
                                            </span>
                                        </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                
                                <p class="text-muted small mt-3 mb-0">
                                    <i class="fas fa-lock me-1"></i> Your information is secure and will never be shared.
                                </p>
                            </form>
                        </div>
                    </div>
                    
                    
                    <div class="col-lg-4" data-aos="fade-left">
                        <!-- Quick Contact Card -->
                        <div class="card border-0 shadow-lg rounded-4 bg-gradient text-white p-4 mb-4">
                            <h5 class="fw-bold mb-3"><i class="fas fa-headset me-2"></i> Need Immediate Help?</h5>
                            <p class="opacity-90 small mb-3">Call us directly for emergency services or urgent inquiries.</p>
                            <a href="tel:+923048902805" class="btn btn-light btn-lg w-100 fw-bold mb-2 rounded-pill">
                                <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                            </a>
                            <a href="mailto:info@razzaqengineering.com" class="btn btn-outline-light btn-lg w-100 fw-semibold rounded-pill">
                                <i class="fas fa-envelope me-2"></i> Email Us
                            </a>
                        </div>
                        
                        <!-- Why Choose Us -->
                        <div class="card border-0 shadow-lg rounded-4 p-4 mb-4">
                            <h5 class="fw-bold mb-3 text-dark"><i class="fas fa-check-circle text-success me-2"></i> Why Choose Us?</h5>
                            <ul class="list-unstyled mb-0">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                                    ['icon' => 'bolt', 'title' => 'Quick Response', 'desc' => 'Quotes within 24 hours'],
                                    ['icon' => 'tag', 'title' => 'Competitive Pricing', 'desc' => 'Best rates guaranteed'],
                                    ['icon' => 'shield-alt', 'title' => 'Licensed & Insured', 'desc' => 'Fully certified'],
                                    ['icon' => 'clock', 'title' => '24/7 Service', 'desc' => 'Emergency available'],
                                    ['icon' => 'map-marker-alt', 'title' => 'Nationwide', 'desc' => 'All Pakistan covered'],
                                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <li class="mb-3 d-flex align-items-start">
                                        <div class="bg-green-light rounded-circle p-2 me-3 mt-1">
                                            <i class="fas fa-<?php echo e($item['icon']); ?> text-success small"></i>
                                        </div>
                                        <div>
                                            <strong class="d-block small"><?php echo e($item['title']); ?></strong>
                                            <span class="text-muted small"><?php echo e($item['desc']); ?></span>
                                        </div>
                                    </li>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </ul>
                        </div>
                        
                        <!-- Recent Projects -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recentProjects->count()): ?>
                            <div class="card border-0 shadow-lg rounded-4 p-4">
                                <h5 class="fw-bold mb-3 text-dark"><i class="fas fa-folder-open text-primary me-2"></i> Recent Work</h5>
                                <div class="row g-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $recentProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="col-6">
                                            <a href="<?php echo e(url('project/'.$rp->id)); ?>" class="text-decoration-none">
                                                <div class="position-relative rounded-3 overflow-hidden" style="height:80px;">
                                                    <img src="<?php echo e(asset('public/p_image/'.$rp->p_image)); ?>" alt="<?php echo e($rp->p_title); ?>" class="w-100 h-100" style="object-fit:cover;">
                                                    <div class="position-absolute bottom-0 start-0 w-100 p-1" style="background:rgba(0,0,0,0.6);">
                                                        <small class="text-white d-block text-truncate" style="font-size:0.65rem;"><?php echo e($rp->p_title); ?></small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                                <a href="<?php echo e(url('projects')); ?>" class="btn btn-sm btn-outline-primary w-100 mt-3 rounded-pill">View All Projects</a>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$is_success): ?>
        <section class="trust-section py-5 bg-white">
            <div class="container">
                <div class="text-center mb-4" data-aos="fade-up">
                    <h3 class="fw-bold">Trusted by Clients Across Pakistan</h3>
                </div>
                <div class="row g-4 text-center">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                        ['icon' => 'check-circle', 'count' => '500+', 'label' => 'Projects Completed', 'delay' => 100],
                        ['icon' => 'smile', 'count' => '300+', 'label' => 'Happy Clients', 'delay' => 200],
                        ['icon' => 'city', 'count' => '10+', 'label' => 'Cities Served', 'delay' => 300],
                        ['icon' => 'clock', 'count' => '24/7', 'label' => 'Emergency Service', 'delay' => 400],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="<?php echo e($stat['delay']); ?>">
                            <div class="p-4 rounded-4 bg-light">
                                <i class="fas fa-<?php echo e($stat['icon']); ?> text-success fa-2x mb-2"></i>
                                <h4 class="fw-bold text-dark mb-1"><?php echo e($stat['count']); ?></h4>
                                <p class="text-muted small mb-0"><?php echo e($stat['label']); ?></p>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('livewire:initialized', () => {
        // Scroll to top on step change
        Livewire.on('scrollToTop', () => {
            document.getElementById('quoteFormSection').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
        
        // Handle toast notifications
        Livewire.on('showToast', (data) => {
            if (typeof toastr !== 'undefined') {
                toastr[data.type](data.message, data.title);
            } else if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: data.type,
                    title: data.title,
                    text: data.message,
                    confirmButtonColor: '#28a745',
                });
            }
        });
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/quote-page.blade.php ENDPATH**/ ?>