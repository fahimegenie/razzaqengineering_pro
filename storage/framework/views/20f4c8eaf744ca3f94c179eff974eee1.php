<div>
    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3">Slider Management</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Sliders</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Toolbar -->
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-md-3">
                        <label class="form-label small fw-semibold">Search</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" wire:model.blur="search" placeholder="Search sliders...">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search): ?><button class="btn btn-outline-secondary" wire:click="clearSearch"><i class="bi bi-x-lg"></i></button><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Status</label>
                        <select class="form-select" wire:model.blur="statusFilter">
                            <option value="">All</option><option value="1">Active</option><option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Type</label>
                        <select class="form-select" wire:model.blur="typeFilter">
                            <option value="">All Types</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $sliderTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><option value="<?php echo e($type); ?>"><?php echo e(ucfirst($type)); ?></option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Show</label>
                        <select class="form-select" wire:model.blur="perPage">
                            <option value="10">10</option><option value="25">25</option><option value="50">50</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3 text-end">
                        <a href="<?php echo e(route('admin.sliders.create')); ?>" class="btn btn-primary w-100"><i class="bi bi-plus-lg me-1"></i> Add Slider</a>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedSliders) > 0): ?>
                <div class="mt-3 p-2 bg-light rounded d-flex align-items-center gap-2 flex-wrap">
                    <span class="fw-semibold me-2"><?php echo e(count($selectedSliders)); ?> selected</span>
                    <button class="btn btn-sm btn-success" wire:click="bulkActivate"><i class="bi bi-check-circle"></i> Activate</button>
                    <button class="btn btn-sm btn-warning" wire:click="bulkDeactivate"><i class="bi bi-pause-circle"></i> Deactivate</button>
                    <button class="btn btn-sm btn-danger" wire:click="bulkDelete"><i class="bi bi-trash"></i> Delete</button>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <!-- Table -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="40"><input type="checkbox" class="form-check-input" <?php if($selectAll): echo 'checked'; endif; ?> wire:click="toggleSelectAll"></th>
                                <th width="80">Image</th>
                                <th wire:click="sortBy('s_title')" style="cursor:pointer;">Title <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sortField==='s_title'): ?><i class="bi bi-arrow-<?php echo e($sortDirection==='asc'?'up':'down'); ?>"></i><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></th>
                                <th>Type</th>
                                <th wire:click="sortBy('is_active')" style="cursor:pointer;" width="90">Status</th>
                                <th wire:click="sortBy('is_featured')" style="cursor:pointer;" width="90">Featured</th>
                                <th wire:click="sortBy('sort_order')" style="cursor:pointer;" width="80">Order</th>
                                <th width="160">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr>
                                <td><input type="checkbox" class="form-check-input" <?php if(in_array($slider->id, $selectedSliders)): echo 'checked'; endif; ?> wire:click="toggleSliderSelection(<?php echo e($slider->id); ?>)"></td>
                                <td><img src="<?php echo e($slider->image_url); ?>" alt="<?php echo e($slider->s_title); ?>" class="img-thumbnail" style="width:60px;height:40px;object-fit:cover;"></td>
                                <td><strong><?php echo e(Str::limit($slider->s_title, 50)); ?></strong><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($slider->s_subtitle): ?><br><small class="text-muted"><?php echo e(Str::limit($slider->s_subtitle, 40)); ?></small><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></td>
                                <td><span class="badge bg-info"><?php echo e(ucfirst($slider->slider_type ?? 'image')); ?></span></td>
                                <td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" <?php if($slider->is_active): echo 'checked'; endif; ?> wire:click="toggleStatus(<?php echo e($slider->id); ?>)"></div></td>
                                <td><button class="btn btn-sm btn-<?php echo e($slider->is_featured ? 'warning' : 'outline-warning'); ?>" wire:click="toggleFeatured(<?php echo e($slider->id); ?>)"><i class="bi bi-star<?php echo e($slider->is_featured ? '-fill' : ''); ?>"></i></button></td>
                                <td><?php echo e($slider->sort_order); ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-info" wire:click="viewSliderDetails(<?php echo e($slider->id); ?>)" title="View"><i class="bi bi-eye"></i></button>
                                        <a href="<?php echo e(route('admin.sliders.edit', ['sliderId' => $slider->id])); ?>" class="btn btn-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-danger" wire:click="confirmDelete(<?php echo e($slider->id); ?>)" title="Delete"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <tr><td colspan="8" class="text-center py-5"><i class="bi bi-images display-4 text-muted d-block mb-2"></i>No sliders found<a href="<?php echo e(route('admin.sliders.create')); ?>" class="btn btn-sm btn-primary mt-2"><i class="bi bi-plus-lg"></i> Add First Slider</a></td></tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sliders->hasPages()): ?>
            <div class="card-footer d-flex justify-content-between"><small>Showing <?php echo e($sliders->firstItem()); ?>-<?php echo e($sliders->lastItem()); ?> of <?php echo e($sliders->total()); ?></small><?php echo e($sliders->links()); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- View Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showViewModal && $viewSlider): ?>
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;"><div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content">
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="bi bi-eye"></i> Slider Details</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div>
        <div class="modal-body">
            <div class="row g-3">
                <div class="col-md-6"><img src="<?php echo e($viewSlider->image_url); ?>" class="img-fluid rounded"></div>
                <div class="col-md-6">
                    <h5><?php echo e($viewSlider->s_title); ?></h5>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewSlider->s_subtitle): ?><p class="text-muted"><?php echo e($viewSlider->s_subtitle); ?></p><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <p><strong>Type:</strong> <?php echo e(ucfirst($viewSlider->slider_type)); ?></p>
                    <p><strong>Position:</strong> <?php echo e(ucfirst($viewSlider->text_position)); ?></p>
                    <p><strong>Order:</strong> <?php echo e($viewSlider->sort_order); ?></p>
                    <p><strong>Status:</strong> <span class="badge bg-<?php echo e($viewSlider->is_active?'success':'danger'); ?>"><?php echo e($viewSlider->is_active?'Active':'Inactive'); ?></span></p>
                </div>
            </div>
        </div>
        <div class="modal-footer"><button class="btn btn-secondary" wire:click="closeModals">Close</button><a href="<?php echo e(route('admin.sliders.edit', $viewSlider->id)); ?>" class="btn btn-primary"><i class="bi bi-pencil"></i> Edit</a></div>
    </div></div></div><div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Delete Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showDeleteModal): ?>
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;"><div class="modal-dialog modal-dialog-centered"><div class="modal-content">
        <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirm Delete</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div>
        <div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this slider?</h5><p class="text-muted">This action cannot be undone.</p></div>
        <div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deleteSlider"><i class="bi bi-trash"></i> Yes, Delete</button></div>
    </div></div></div><div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/sliders/slider-list.blade.php ENDPATH**/ ?>