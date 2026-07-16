
<div>
    <!-- Loading State -->
    <div wire:loading.delay.longest wire:target="savePageContent, saveContactAddress"
        class="position-fixed top-0 start-0 w-100 h-100 align-items-center justify-content-center" 
        style="background: rgba(0,0,0,0.3); z-index: 99999; display: none !important;"
        wire:loading.class="d-flex"
        wire:loading.style="display: flex !important;">
        <div class="bg-body p-4 rounded-3 shadow-lg text-center border border-secondary-subtle">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="visually-hidden">Saving...</span>
            </div>
            <p class="mb-0 fw-semibold">Saving settings...</p>
        </div>
    </div>

    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Contact Us Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Contact Us</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errorMessage): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i><?php echo e($errorMessage); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($saveSuccess): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" 
             x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <i class="bi bi-check-circle me-2"></i>Settings saved successfully!
            <button type="button" class="btn-close" @click="show = false"></button>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="row g-3">
            <!-- Tabs Navigation -->
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-2">
                        <ul class="nav nav-pills flex-nowrap overflow-auto" role="tablist">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <li class="nav-item" role="presentation">
                                <button type="button" 
                                        class="nav-link text-nowrap <?php echo e($activeTab === $key ? 'active' : ''); ?>"
                                        wire:click="setTab('<?php echo e($key); ?>')">
                                    <i class="bi <?php echo e($tab['icon']); ?> me-1"></i> <?php echo e($tab['label']); ?>

                                </button>
                            </li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="col-12 col-lg-9">
                
                
                
                
                <div class="<?php echo e($activeTab === 'page-content' ? '' : 'd-none'); ?>">
                    <form wire:submit="savePageContent">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-file-text me-2"></i>Page Content
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold required">Page Title</label>
                                        <input type="text" wire:model="cs_title" class="form-control <?php $__errorArgs = ['cs_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="e.g., Contact Us">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cs_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    
                                    
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Page Description</label>
                                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.ck-editor', ['label' => 'Page Description','placeholder' => 'Describe your contact page...','height' => '300px','toolbar' => 'full','value' => $cs_description]);

$__keyOuter = $__key ?? null;

$__key = 'cs-description-editor';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2117657-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cs_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Form Section Title</label>
                                        <input type="text" wire:model="form_title" class="form-control" placeholder="e.g., Send Us a Message">
                                    </div>

                                    
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Form Section Description</label>
                                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.ck-editor', ['label' => 'Form Description','placeholder' => 'Describe the contact form section...','height' => '250px','toolbar' => 'standard','value' => $form_description]);

$__keyOuter = $__key ?? null;

$__key = 'form-description-editor';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2117657-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['form_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-geo-alt me-2"></i>Map
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Google Map Embed Code / Address</label>
                                    <textarea wire:model="map_address" class="form-control" rows="4" placeholder="Paste Google Maps iframe code or enter address..."></textarea>
                                    <small class="text-muted">Paste the full iframe embed code from Google Maps</small>
                                </div>
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($map_address && Str::contains($map_address, 'iframe')): ?>
                                    <div class="border rounded p-2">
                                        <div class="ratio ratio-16x9">
                                            <?php echo $map_address; ?>

                                        </div>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-image me-2"></i>Banner Image
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 text-center">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bannerPreview): ?>
                                                <img src="<?php echo e($bannerPreview); ?>" class="img-fluid mb-2 rounded" style="max-height: 200px;">
                                            <?php else: ?>
                                                <div class="py-4 text-muted">
                                                    <i class="bi bi-image display-4"></i>
                                                    <p>No banner image uploaded</p>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <input type="file" wire:model="banner_image" class="form-control <?php $__errorArgs = ['banner_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*">
                                            <small class="text-muted">Recommended: 1920x400px. Max: 5MB</small>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['banner_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        <div wire:loading wire:target="banner_image" class="mt-2">
                                            <span class="spinner-border spinner-border-sm text-primary"></span> Uploading...
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bannerPreview): ?>
                                            <button type="button" wire:click="removeBanner" class="btn btn-outline-danger">
                                                <i class="bi bi-trash me-1"></i> Remove Banner
                                            </button>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-primary btn-lg" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="savePageContent">
                                    <i class="bi bi-check-lg me-1"></i> Save Page Content
                                </span>
                                <span wire:loading wire:target="savePageContent">
                                    <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                
                
                
                <div class="<?php echo e($activeTab === 'contact-details' ? '' : 'd-none'); ?>">
                    <form wire:submit="saveContactAddress">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-building me-2"></i>Address
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold required">Office Address</label>
                                    <textarea wire:model="ca_address" class="form-control <?php $__errorArgs = ['ca_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" placeholder="Enter full office address..."></textarea>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['ca_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-telephone me-2"></i>Contact Numbers
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold required">Main Phone</label>
                                        <input type="text" wire:model="ca_phone" class="form-control <?php $__errorArgs = ['ca_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="e.g., +92 300 1234567">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['ca_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Footer Phone</label>
                                        <input type="text" wire:model="footer_phone" class="form-control" placeholder="Phone for footer display">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">WhatsApp Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-success text-white">
                                                <i class="bi bi-whatsapp"></i>
                                            </span>
                                            <input type="text" wire:model="whatsapp" class="form-control" placeholder="e.g., +92 300 1234567">
                                        </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($whatsapp): ?>
                                            <small class="text-success">
                                                <i class="bi bi-check-circle"></i> 
                                                WhatsApp Link: <?php echo e('https://wa.me/' . preg_replace('/[^0-9]/', '', $whatsapp)); ?>

                                            </small>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Office Hours</label>
                                        <input type="text" wire:model="office_hours" class="form-control" placeholder="e.g., Mon - Sat: 9:00 AM - 6:00 PM">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-envelope me-2"></i>Email
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold required">Email Address</label>
                                    <input type="email" wire:model="ca_email" class="form-control <?php $__errorArgs = ['ca_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="e.g., info@example.com">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['ca_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-map me-2"></i>Google Map Link
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Google Maps Embed URL</label>
                                    <textarea wire:model="google_map" class="form-control" rows="3" placeholder="Paste Google Maps embed URL or coordinates..."></textarea>
                                    <small class="text-muted">For footer map link or directions button</small>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-primary btn-lg" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="saveContactAddress">
                                    <i class="bi bi-check-lg me-1"></i> Save Contact Details
                                </span>
                                <span wire:loading wire:target="saveContactAddress">
                                    <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                
                
                
                <div class="<?php echo e($activeTab === 'social-links' ? '' : 'd-none'); ?>">
                    <form wire:submit="saveContactAddress">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-share me-2"></i>Social Media Links
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-facebook text-primary me-1"></i> Facebook URL
                                        </label>
                                        <input type="url" wire:model="facebook" class="form-control" placeholder="https://facebook.com/yourpage">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-instagram text-danger me-1"></i> Instagram URL
                                        </label>
                                        <input type="url" wire:model="instagram" class="form-control" placeholder="https://instagram.com/yourpage">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-linkedin text-primary me-1"></i> LinkedIn URL
                                        </label>
                                        <input type="url" wire:model="linkedin" class="form-control" placeholder="https://linkedin.com/company/yourcompany">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-youtube text-danger me-1"></i> YouTube URL
                                        </label>
                                        <input type="url" wire:model="youtube" class="form-control" placeholder="https://youtube.com/@yourchannel">
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-eye me-2"></i>Preview
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex gap-3 flex-wrap">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($facebook): ?>
                                        <a href="<?php echo e($facebook); ?>" target="_blank" class="btn btn-outline-primary">
                                            <i class="bi bi-facebook me-1"></i> Facebook
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($instagram): ?>
                                        <a href="<?php echo e($instagram); ?>" target="_blank" class="btn btn-outline-danger">
                                            <i class="bi bi-instagram me-1"></i> Instagram
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($linkedin): ?>
                                        <a href="<?php echo e($linkedin); ?>" target="_blank" class="btn btn-outline-primary">
                                            <i class="bi bi-linkedin me-1"></i> LinkedIn
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($youtube): ?>
                                        <a href="<?php echo e($youtube); ?>" target="_blank" class="btn btn-outline-danger">
                                            <i class="bi bi-youtube me-1"></i> YouTube
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$facebook && !$instagram && !$linkedin && !$youtube): ?>
                                        <p class="text-muted mb-0">No social links added yet.</p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-primary btn-lg" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="saveContactAddress">
                                    <i class="bi bi-check-lg me-1"></i> Save Social Links
                                </span>
                                <span wire:loading wire:target="saveContactAddress">
                                    <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                
                
                
                <div class="<?php echo e($activeTab === 'seo' ? '' : 'd-none'); ?>">
                    <form wire:submit="savePageContent">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-search me-2"></i>SEO Settings for Contact Page
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Meta Title</label>
                                        <input type="text" wire:model="meta_title" class="form-control" placeholder="Contact Us - Your Company Name">
                                        <small class="text-muted">Recommended: 50-60 characters</small>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Meta Description</label>
                                        <textarea wire:model="meta_description" class="form-control" rows="3" placeholder="Get in touch with us..."></textarea>
                                        <small class="text-muted">Recommended: 150-160 characters</small>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Meta Keywords</label>
                                        <input type="text" wire:model="meta_keywords" class="form-control" placeholder="contact, support, help, query">
                                        <small class="text-muted">Comma separated keywords</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-google me-2"></i>Search Engine Preview
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="seo-preview p-3 border rounded">
                                    <p class="seo-title mb-1" style="color: #1a0dab; font-size: 18px; cursor: pointer;">
                                        <?php echo e($meta_title ?: $cs_title ?: 'Contact Us - Your Site'); ?>

                                    </p>
                                    <p class="seo-url mb-1" style="color: #006621; font-size: 13px;">
                                        <?php echo e(url('/contact-us')); ?>

                                    </p>
                                    <p class="seo-desc mb-0" style="color: #545454; font-size: 13px;">
                                        <?php echo e(Str::limit($meta_description ?: strip_tags($cs_description), 160)); ?>

                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-primary btn-lg" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="savePageContent">
                                    <i class="bi bi-check-lg me-1"></i> Save SEO Settings
                                </span>
                                <span wire:loading wire:target="savePageContent">
                                    <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                
                
                
                <div class="<?php echo e($activeTab === 'submissions' ? '' : 'd-none'); ?>">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-envelope me-2"></i>Contact Form Submissions
                            </h3>
                            <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="$refresh">
                                <i class="bi bi-arrow-clockwise me-1"></i> Refresh
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="text-center py-5">
                                <i class="bi bi-inbox display-1 text-muted"></i>
                                <h4 class="mt-3">No Submissions Yet</h4>
                                <p class="text-muted">Contact form submissions will appear here when visitors submit the form.</p>
                                <a href="<?php echo e(url('/contact-us')); ?>" target="_blank" class="btn btn-outline-primary">
                                    <i class="bi bi-eye me-1"></i> View Contact Page
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="col-12 col-lg-3">
                <!-- Quick Actions -->
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-header bg-transparent">
                        <h3 class="card-title mb-0 fs-6">Quick Actions</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="<?php echo e(url('/contact-us')); ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye me-1"></i> View Contact Page
                            </a>
                            <button type="button" wire:click="$refresh" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-arrow-clockwise me-1"></i> Refresh Data
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Current Info -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-transparent">
                        <h3 class="card-title mb-0 fs-6">Current Info</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0 small">
                            <li class="mb-2">
                                <strong><i class="bi bi-building me-1"></i> Address:</strong><br>
                                <span class="text-muted"><?php echo e(Str::limit($ca_address, 80) ?: 'Not set'); ?></span>
                            </li>
                            <li class="mb-2">
                                <strong><i class="bi bi-telephone me-1"></i> Phone:</strong><br>
                                <span class="text-muted"><?php echo e($ca_phone ?: 'Not set'); ?></span>
                            </li>
                            <li class="mb-2">
                                <strong><i class="bi bi-envelope me-1"></i> Email:</strong><br>
                                <span class="text-muted"><?php echo e($ca_email ?: 'Not set'); ?></span>
                            </li>
                            <li class="mb-2">
                                <strong><i class="bi bi-whatsapp me-1"></i> WhatsApp:</strong><br>
                                <span class="text-muted"><?php echo e($whatsapp ?: 'Not set'); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .required::after {
        content: ' *';
        color: #dc3545;
    }
    
    .seo-preview {
        background: #fff;
        max-width: 600px;
    }
    
    .seo-preview p {
        font-family: Arial, sans-serif;
    }
    
    @media (max-width: 768px) {
        .seo-preview {
            max-width: 100%;
        }
    }
    
    [x-cloak] { display: none !important; }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/settings/contact-us-settings.blade.php ENDPATH**/ ?>