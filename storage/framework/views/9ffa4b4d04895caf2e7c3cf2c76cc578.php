<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3"><?php echo e($isEditing ? 'Edit Project' : 'Create New Project'); ?></h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li><li class="breadcrumb-item"><a href="<?php echo e(route('admin.projects.index')); ?>">Projects</a></li><li class="breadcrumb-item active"><?php echo e($isEditing ? 'Edit' : 'Create'); ?></li></ol></div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form wire:submit="save">
            <div class="row g-3">
                <div class="col-12 col-lg-8">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-briefcase me-2"></i>Project Information</h3></div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12"><label class="form-label required">Project Title</label><input type="text" class="form-control form-control-lg <?php $__errorArgs = ['p_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model.live="p_title" placeholder="Enter project title..."><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['p_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                                <div class="col-md-8"><label class="form-label">Slug</label><div class="input-group"><input type="text" class="form-control" wire:model="p_slug" placeholder="project-slug"><button type="button" class="btn btn-outline-secondary" wire:click="generateSlug"><i class="bi bi-arrow-repeat"></i> Generate</button></div></div>
                                <div class="col-md-4"><label class="form-label">Category (Text)</label><input type="text" class="form-control" wire:model="p_category" placeholder="e.g., Construction"></div>
                                <div class="col-12"><label class="form-label">Short Description</label><textarea class="form-control" rows="2" wire:model="p_short_description" placeholder="Brief summary..."></textarea></div>
                            </div>
                        </div>
                    </div>

                    <!-- CKEditor Description -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-text-paragraph me-2"></i>Full Description</h3></div>
                        <div class="card-body">
                            <div x-data="{ editor: null, value: <?php if ((object) ('p_description') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('p_description'->value()); ?>')<?php echo e('p_description'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('p_description'); ?>')<?php endif; ?> }" x-init="if(typeof ClassicEditor!=='undefined'){ClassicEditor.create(document.querySelector('#projectDesc'),{placeholder:'Describe your project in detail...',toolbar:{items:['heading','|','bold','italic','underline','|','link','blockQuote','|','bulletedList','numberedList','|','undo','redo']}}).then(e=>{editor=e;if(value)e.setData(value);e.model.document.on('change:data',()=>{value=e.getData()})}).catch(console.error)}else{setTimeout(()=>$el.__x.$data.init(),200)}" wire:ignore>
                                <label class="form-label fw-semibold">Project Description</label>
                                <textarea id="projectDesc"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Project Details -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-info-circle me-2"></i>Project Details</h3></div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Client</label><input type="text" class="form-control" wire:model="p_client" placeholder="Client name..."></div>
                                <div class="col-md-6"><label class="form-label">Location</label><input type="text" class="form-control" wire:model="p_location" placeholder="Project location..."></div>
                                <div class="col-md-4"><label class="form-label">Start Date</label><input type="date" class="form-control" wire:model="p_start_date"></div>
                                <div class="col-md-4"><label class="form-label">End Date</label><input type="date" class="form-control" wire:model="p_end_date"></div>
                                <div class="col-md-4"><label class="form-label required">Status</label><select class="form-select <?php $__errorArgs = ['p_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="p_status"><option value="completed">Completed</option><option value="ongoing">Ongoing</option><option value="planning">Planning</option><option value="on-hold">On Hold</option><option value="cancelled">Cancelled</option></select><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['p_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent"><h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-gear me-2"></i>Settings</h3></div>
                        <div class="card-body">
                            <div class="mb-3"><label class="form-label">Category</label><select class="form-select" wire:model="pc_id"><option value="">-- Select --</option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><option value="<?php echo e($cat->id); ?>"><?php echo e($cat->pc_name); ?></option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></select></div>
                            <div class="mb-3"><label class="form-label">Sort Order</label><input type="number" class="form-control" wire:model="sort_order" min="0"></div>
                            <div class="form-check form-switch mb-2"><input class="form-check-input" type="checkbox" wire:model="is_active" id="is_active"><label class="form-check-label fw-semibold" for="is_active">Active</label></div>
                            <div class="form-check form-switch mb-2"><input class="form-check-input" type="checkbox" wire:model="is_featured" id="is_featured"><label class="form-check-label fw-semibold" for="is_featured">Featured</label></div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent"><h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-image me-2"></i>Main Image</h3></div>
                        <div class="card-body text-center">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imagePreview): ?><img src="<?php echo e($imagePreview); ?>" class="rounded mb-2" style="width:100%;max-height:200px;object-fit:cover;"><?php else: ?><div class="bg-light rounded d-flex align-items-center justify-content-center mb-2" style="height:150px;border:3px dashed #ccc;"><i class="bi bi-image display-4 text-muted"></i></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <input type="file" class="form-control" wire:model="p_image" accept="image/*">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imagePreview): ?><button class="btn btn-danger btn-sm mt-2 w-100" wire:click="removeImage"><i class="bi bi-trash"></i> Remove</button><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent"><h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-images me-2"></i>Gallery</h3></div>
                        <div class="card-body">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($existingGallery) > 0): ?><div class="row g-2 mb-2"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $existingGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><div class="col-4 position-relative"><img src="<?php echo e($img); ?>" class="img-thumbnail w-100" style="height:70px;object-fit:cover;"><button class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle" wire:click="removeExistingGalleryImage(<?php echo e($i); ?>)" style="width:22px;height:22px;padding:0;font-size:10px;"><i class="bi bi-x"></i></button></div><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($galleryPreviews) > 0): ?><div class="row g-2 mb-2"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $galleryPreviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $prev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><div class="col-4 position-relative"><img src="<?php echo e($prev); ?>" class="img-thumbnail w-100" style="height:70px;object-fit:cover;"><button class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle" wire:click="removeGalleryImage(<?php echo e($i); ?>)" style="width:22px;height:22px;padding:0;font-size:10px;"><i class="bi bi-x"></i></button></div><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <input type="file" class="form-control" wire:model="galleryImages" accept="image/*" multiple>
                            <small class="text-muted">Select multiple images</small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-2" wire:loading.attr="disabled"><span wire:loading.remove wire:target="save"><i class="bi bi-check-lg me-1"></i> <?php echo e($isEditing ? 'Update Project' : 'Create Project'); ?></span><span wire:loading wire:target="save"><span class="spinner-border spinner-border-sm me-1"></span> Saving...</span></button>
                    <a href="<?php echo e(route('admin.projects.index')); ?>" class="btn btn-outline-secondary w-100"><i class="bi bi-x-lg me-1"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>.form-switch .form-check-input{width:3em;height:1.5em;cursor:pointer}.ck-editor__editable{min-height:350px}.ck.ck-editor__main>.ck-editor__editable{min-height:350px}</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/projects/project-form.blade.php ENDPATH**/ ?>