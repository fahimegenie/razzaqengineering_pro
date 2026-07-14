<div>
    <div class="app-content-header"><div class="container-fluid"><div class="row"><div class="col-sm-6"><h1 class="mb-0 fs-3"><?php echo e($isEditing ? 'Edit Service' : 'Create New Service'); ?></h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li><li class="breadcrumb-item"><a href="<?php echo e(route('admin.services.index')); ?>">Services</a></li><li class="breadcrumb-item active"><?php echo e($isEditing ? 'Edit' : 'Create'); ?></li></ol></div></div></div></div>

    <div class="container-fluid">
        <form wire:submit="save">
            <div class="row g-3">
                <div class="col-12 col-lg-8">
                    <div class="card shadow-sm border-0 mb-3"><div class="card-header bg-transparent"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-info-circle me-2"></i>Service Information</h3></div><div class="card-body"><div class="row g-3">
                        <div class="col-12"><label class="form-label required">Service Name</label><input type="text" class="form-control form-control-lg <?php $__errorArgs = ['os_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model.live="os_name" placeholder="Enter service name..."><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['os_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                        <div class="col-md-8"><label class="form-label">Slug</label><div class="input-group"><input type="text" class="form-control" wire:model="os_slug"><button type="button" class="btn btn-outline-secondary" wire:click="generateSlug"><i class="bi bi-arrow-repeat"></i> Generate</button></div></div>
                        <div class="col-md-4"><label class="form-label">Bootstrap Icon</label><select class="form-select" wire:model="os_icon"><option value="">-- Select Icon --</option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $iconOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><option value="<?php echo e($val); ?>"><?php echo e($label); ?> (<?php echo e($val); ?>)</option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></select></div>
                        <div class="col-12"><label class="form-label">Short Description</label><textarea class="form-control" rows="2" wire:model="os_short_description" placeholder="Brief summary..."></textarea></div>
                    </div></div></div>

                    <div class="card shadow-sm border-0 mb-3"><div class="card-header bg-transparent"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-text-paragraph me-2"></i>Full Description</h3></div><div class="card-body">
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.ck-editor', ['label' => 'Service Description','placeholder' => 'Describe your service in detail...','height' => '400px','toolbar' => 'full','value' => $os_description]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3388498297-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                    </div></div>

                    <div class="card shadow-sm border-0 mb-3"><div class="card-header bg-transparent"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-search me-2"></i>SEO Settings</h3></div><div class="card-body"><div class="row g-3">
                        <div class="col-12"><label class="form-label">Meta Title</label><input type="text" class="form-control" wire:model="meta_title"></div>
                        <div class="col-12"><label class="form-label">Meta Description</label><textarea class="form-control" rows="2" wire:model="meta_description"></textarea></div>
                        <div class="col-12"><label class="form-label">Meta Keywords</label><input type="text" class="form-control" wire:model="meta_keywords" placeholder="keyword1, keyword2"></div>
                    </div></div></div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card shadow-sm border-0 mb-3"><div class="card-header bg-transparent"><h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-image me-2"></i>Service Image</h3></div><div class="card-body text-center">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imagePreview): ?><img src="<?php echo e($imagePreview); ?>" class="rounded mb-2" style="width:100%;max-height:200px;object-fit:cover;"><?php else: ?><div class="bg-light rounded d-flex align-items-center justify-content-center mb-2" style="height:150px;border:3px dashed #ccc;"><i class="bi bi-image display-4 text-muted"></i></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <input type="file" class="form-control" wire:model="os_image" accept="image/*"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imagePreview): ?><button class="btn btn-danger btn-sm mt-2 w-100" wire:click="removeImage"><i class="bi bi-trash"></i> Remove</button><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div></div>

                    <div class="card shadow-sm border-0 mb-3"><div class="card-header bg-transparent"><h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-image-alt me-2"></i>Banner Image</h3></div><div class="card-body text-center">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bannerPreview): ?><img src="<?php echo e($bannerPreview); ?>" class="rounded mb-2" style="width:100%;max-height:150px;object-fit:cover;"><?php else: ?><div class="bg-light rounded d-flex align-items-center justify-content-center mb-2" style="height:120px;border:3px dashed #ccc;"><i class="bi bi-image display-4 text-muted"></i></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <input type="file" class="form-control" wire:model="os_banner" accept="image/*"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bannerPreview): ?><button class="btn btn-danger btn-sm mt-2 w-100" wire:click="removeBanner"><i class="bi bi-trash"></i> Remove</button><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div></div>

                    <div class="card shadow-sm border-0 mb-3"><div class="card-header bg-transparent"><h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-gear me-2"></i>Settings</h3></div><div class="card-body">
                        <div class="mb-3"><label class="form-label">Sort Order</label><input type="number" class="form-control" wire:model="sort_order" min="0"></div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($os_icon): ?><div class="mb-3 text-center"><i class="<?php echo e($os_icon); ?> display-4 text-primary"></i><p class="small mt-1"><?php echo e($os_icon); ?></p></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div class="form-check form-switch mb-2"><input class="form-check-input" type="checkbox" wire:model="is_active" id="is_active"><label class="form-check-label fw-semibold" for="is_active">Active</label></div>
                        <div class="form-check form-switch mb-2"><input class="form-check-input" type="checkbox" wire:model="is_featured" id="is_featured"><label class="form-check-label fw-semibold" for="is_featured">Featured</label></div>
                    </div></div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-2" wire:loading.attr="disabled"><span wire:loading.remove wire:target="save"><i class="bi bi-check-lg me-1"></i> <?php echo e($isEditing ? 'Update' : 'Create'); ?></span><span wire:loading wire:target="save"><span class="spinner-border spinner-border-sm me-1"></span> Saving...</span></button>
                    <a href="<?php echo e(route('admin.services.index')); ?>" class="btn btn-outline-secondary w-100"><i class="bi bi-x-lg me-1"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/services/service-form.blade.php ENDPATH**/ ?>