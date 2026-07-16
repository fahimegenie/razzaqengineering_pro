<div>
    <div class="app-content-header"><div class="container-fluid"><div class="row"><div class="col-sm-6"><h1 class="mb-0 fs-3"><?php echo e($isEditing ? 'Edit Detail' : 'Add Service Detail'); ?></h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li><li class="breadcrumb-item"><a href="<?php echo e(route('admin.services.index')); ?>">Services</a></li><li class="breadcrumb-item active"><?php echo e($isEditing ? 'Edit' : 'Add'); ?> Detail</li></ol></div></div></div></div>

    <div class="container-fluid"><form wire:submit="save"><div class="row g-3">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-list-ul me-2"></i>Detail Information</h3></div><div class="card-body"><div class="row g-3">
                <div class="col-md-6"><label class="form-label required">Service</label><select class="form-select <?php $__errorArgs = ['os_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="os_id"><option value="">-- Select Service --</option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><option value="<?php echo e($s->id); ?>"><?php echo e($s->os_name); ?></option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></select><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['os_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                <div class="col-md-6"><label class="form-label">Sort Order</label><input type="number" class="form-control" wire:model="sort_order" min="0"></div>
                <div class="col-12"><label class="form-label required">Title</label><input type="text" class="form-control <?php $__errorArgs = ['sd_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="sd_title"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['sd_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                <div class="col-md-4"><label class="form-label">Point 1</label><input type="text" class="form-control" wire:model="sd_t1"></div>
                <div class="col-md-4"><label class="form-label">Point 2</label><input type="text" class="form-control" wire:model="sd_t2"></div>
                <div class="col-md-4"><label class="form-label">Point 3</label><input type="text" class="form-control" wire:model="sd_t3"></div>
            </div></div></div>

            <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-text-paragraph me-2"></i>Description</h3></div><div class="card-body">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.ck-editor', ['label' => 'Description','placeholder' => 'Describe this service detail...','height' => '350px','toolbar' => 'full','value' => $sd_description,'field' => 'sd_description']);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3386365725-0', $__key);

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
            </div></div>

            <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-check2-square me-2"></i>Features</h3></div><div class="card-body">
                <div class="input-group mb-3"><input type="text" class="form-control" wire:model="sd_features_input" wire:keydown.enter.prevent="addFeature" placeholder="Add feature..."><button class="btn btn-primary" wire:click="addFeature"><i class="bi bi-plus-lg"></i> Add</button></div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($sd_features)>0): ?><div class="d-flex flex-wrap gap-2"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $sd_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2"><?php echo e($f); ?><button class="btn-close btn-close-sm ms-2" wire:click="removeFeature(<?php echo e($i); ?>)" style="font-size:.6rem;"></button></span><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></div><?php else: ?><p class="text-muted text-center py-3">No features added.</p><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div></div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-image me-2"></i>Image 1</h3></div><div class="card-body text-center"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($image1Preview): ?><img src="<?php echo e($image1Preview); ?>" class="rounded mb-2" style="width:100%;max-height:180px;object-fit:cover;"><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><input type="file" class="form-control" wire:model="sd_image1" accept="image/*"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($image1Preview): ?><button class="btn btn-danger btn-sm mt-2 w-100" wire:click="removeImage1"><i class="bi bi-trash"></i> Remove</button><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div></div>
            <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-image me-2"></i>Image 2</h3></div><div class="card-body text-center"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($image2Preview): ?><img src="<?php echo e($image2Preview); ?>" class="rounded mb-2" style="width:100%;max-height:180px;object-fit:cover;"><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><input type="file" class="form-control" wire:model="sd_image2" accept="image/*"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($image2Preview): ?><button class="btn btn-danger btn-sm mt-2 w-100" wire:click="removeImage2"><i class="bi bi-trash"></i> Remove</button><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div></div>
            <button type="submit" class="btn btn-primary btn-lg w-100 mb-2" wire:loading.attr="disabled"><span wire:loading.remove wire:target="save"><i class="bi bi-check-lg me-1"></i> <?php echo e($isEditing?'Update':'Create'); ?></span><span wire:loading wire:target="save"><span class="spinner-border spinner-border-sm me-1"></span> Saving...</span></button>
            <a href="<?php echo e(route('admin.services.details.index')); ?>" class="btn btn-outline-secondary w-100"><i class="bi bi-x-lg me-1"></i> Cancel</a>
        </div>
    </div></form></div>
</div><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/services/detail-form.blade.php ENDPATH**/ ?>