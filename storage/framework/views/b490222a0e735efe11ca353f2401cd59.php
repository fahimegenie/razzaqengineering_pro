<div>
    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3"><?php echo e($isEditing ? 'Edit Testimonial' : 'Create New Testimonial'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.testimonials.index')); ?>">Testimonials</a></li>
                        <li class="breadcrumb-item active"><?php echo e($isEditing ? 'Edit' : 'Create'); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form wire:submit="save">
            <div class="row g-3">
                <!-- Main Content Column -->
                <div class="col-12 col-lg-8">
                    
                    <!-- Content Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-chat-quote me-2"></i>Testimonial Content
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label class="form-label required">Client Name</label>
                                    <input type="text" 
                                           class="form-control <?php $__errorArgs = ['t_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           wire:model="t_name"
                                           placeholder="Enter client name...">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['t_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                
                                <!-- Designation -->
                                <div class="col-md-6">
                                    <label class="form-label">Designation</label>
                                    <input type="text" 
                                           class="form-control" 
                                           wire:model="t_designation" 
                                           placeholder="e.g., CEO, Manager">
                                </div>
                                
                                <!-- Company -->
                                <div class="col-md-6">
                                    <label class="form-label">Company</label>
                                    <input type="text" 
                                           class="form-control" 
                                           wire:model="t_company" 
                                           placeholder="Company name...">
                                </div>
                                
                                <!-- Location -->
                                <div class="col-md-6">
                                    <label class="form-label">Location</label>
                                    <input type="text" 
                                           class="form-control" 
                                           wire:model="t_location" 
                                           placeholder="e.g., New York, USA">
                                </div>
                                
                                <!-- Rating -->
                                <div class="col-12">
                                    <label class="form-label required">Rating</label>
                                    <div class="rating-input" x-data="{ rating: <?php if ((object) ('t_rating') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('t_rating'->value()); ?>')<?php echo e('t_rating'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('t_rating'); ?>')<?php endif; ?> }">
                                        <div class="d-flex align-items-center gap-1">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                <button type="button" 
                                                        class="btn btn-lg rating-star <?php echo e($i <= $t_rating ? 'text-warning' : 'text-muted'); ?>"
                                                        wire:click="$set('t_rating', <?php echo e($i); ?>)"
                                                        x-on:click="rating = <?php echo e($i); ?>"
                                                        style="font-size: 2rem; line-height: 1; border: none; background: none; cursor: pointer;">
                                                    ★
                                                </button>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                            <span class="ms-2 fw-semibold fs-5"><?php echo e($t_rating); ?>/5</span>
                                        </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['t_rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <small class="text-danger"><?php echo e($message); ?></small>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                                
                                <!-- Testimonial Content -->
                                <div class="col-12">
                                    <label class="form-label required">Testimonial Content</label>
                                    <textarea class="form-control <?php $__errorArgs = ['t_content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                              rows="5" 
                                              wire:model="t_content" 
                                              placeholder="What did the client say about us?"></textarea>
                                    <small class="text-muted">
                                        <span x-data="{ length: 0 }" x-init="length = $wire.t_content.length">
                                            Characters: <span x-text="$wire.t_content.length"></span>
                                        </span>
                                    </small>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['t_content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Relations Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-link-45deg me-2"></i>Related To
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Related Project</label>
                                    <select class="form-select" wire:model="project_id">
                                        <option value="">-- Select Project (Optional) --</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <option value="<?php echo e($project->id); ?>"><?php echo e($project->p_title); ?></option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Related Service</label>
                                    <select class="form-select" wire:model="service_id">
                                        <option value="">-- Select Service (Optional) --</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <option value="<?php echo e($service->os_id); ?>"><?php echo e($service->os_title); ?></option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Column -->
                <div class="col-12 col-lg-4">
                    
                    <!-- Image Upload Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6 fw-semibold">
                                <i class="bi bi-person-circle me-2"></i>Client Photo
                            </h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imagePreview): ?>
                                    <img src="<?php echo e($imagePreview); ?>" 
                                         class="rounded-circle mb-2" 
                                         style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #007bff;">
                                <?php else: ?>
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                                         style="width: 120px; height: 120px; border: 3px dashed #ccc;">
                                        <i class="bi bi-person text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            
                            <input type="file" 
                                   class="form-control <?php $__errorArgs = ['t_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   wire:model="t_image" 
                                   accept="image/*">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['t_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imagePreview): ?>
                                <button type="button" class="btn btn-danger btn-sm mt-2" wire:click="removeImage">
                                    <i class="bi bi-trash"></i> Remove Photo
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            <small class="text-muted d-block mt-1">Recommended: Square image, Max 2MB</small>
                        </div>
                    </div>

                    <!-- Publishing Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6 fw-semibold">
                                <i class="bi bi-toggle-on me-2"></i>Publishing
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" wire:model="is_active" id="is_active">
                                <label class="form-check-label fw-semibold" for="is_active">Active</label>
                                <br><small class="text-muted">Testimonial will be visible on website</small>
                            </div>
                            
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" wire:model="is_featured" id="is_featured">
                                <label class="form-check-label fw-semibold" for="is_featured">Featured</label>
                                <br><small class="text-muted">Show in featured testimonials section</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" class="form-control" wire:model="sort_order" min="0">
                                <small class="text-muted">Lower number = shown first</small>
                            </div>
                        </div>
                    </div>

                    <!-- Rating Preview Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6 fw-semibold">
                                <i class="bi bi-eye me-2"></i>Preview
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <div class="mb-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <span class="fs-4 <?php echo e($i <= $t_rating ? 'text-warning' : 'text-muted'); ?>">★</span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                                <p class="fst-italic text-muted small">
                                    "<?php echo e(Str::limit($t_content ?: 'Testimonial content will appear here...', 150)); ?>"
                                </p>
                                <div class="fw-semibold"><?php echo e($t_name ?: 'Client Name'); ?></div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($t_designation): ?>
                                    <small class="text-muted"><?php echo e($t_designation); ?></small>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($t_company): ?>
                                    <small class="text-muted d-block"><?php echo e($t_company); ?></small>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <button type="submit" 
                            class="btn btn-primary btn-lg w-100 mb-2" 
                            wire:loading.attr="disabled"
                            wire:target="save">
                        <span wire:loading.remove wire:target="save">
                            <i class="bi bi-check-lg me-1"></i> 
                            <?php echo e($isEditing ? 'Update Testimonial' : 'Create Testimonial'); ?>

                        </span>
                        <span wire:loading wire:target="save">
                            <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                        </span>
                    </button>
                    <a href="<?php echo e(route('admin.testimonials.index')); ?>" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .rating-star {
        transition: all 0.2s ease;
    }
    
    .rating-star:hover {
        transform: scale(1.2);
    }
    
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        cursor: pointer;
    }
    
    .rounded-circle {
        transition: all 0.3s ease;
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/testimonials/testimonial-form.blade.php ENDPATH**/ ?>