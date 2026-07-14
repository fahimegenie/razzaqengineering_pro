<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3">Project Categories</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li><li class="breadcrumb-item active">Project Categories</li></ol></div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row g-3 mb-3">
            <div class="col-6"><div class="card border-0 shadow-sm bg-primary text-white"><div class="card-body text-center py-3"><i class="bi bi-folder display-6"></i><h3 class="mb-0 mt-1"><?php echo e($totalCategories); ?></h3><small>Total Categories</small></div></div></div>
            <div class="col-6"><div class="card border-0 shadow-sm bg-success text-white"><div class="card-body text-center py-3"><i class="bi bi-check-circle display-6"></i><h3 class="mb-0 mt-1"><?php echo e($activeCategories); ?></h3><small>Active</small></div></div></div>
        </div>

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4"><div class="input-group"><span class="input-group-text"><i class="bi bi-search"></i></span><input type="text" class="form-control" wire:model.blur="search" placeholder="Search..."><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search): ?><button class="btn btn-outline-secondary" wire:click="clearSearch"><i class="bi bi-x-lg"></i></button><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div></div>
                    <div class="col-md-2"><select class="form-select" wire:model.blur="statusFilter"><option value="">All Status</option><option value="1">Active</option><option value="0">Inactive</option></select></div>
                    <div class="col-md-2"><select class="form-select" wire:model.blur="perPage"><option value="15">15</option><option value="30">30</option></select></div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-outline-secondary me-1" wire:click="clearFilters"><i class="bi bi-funnel"></i></button>
                        <a href="<?php echo e(route('admin.projects.categories.create')); ?>" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Add Category</a>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedCategories) > 0): ?>
                <div class="mt-3 p-2 bg-light rounded d-flex gap-2 flex-wrap"><span class="fw-semibold"><?php echo e(count($selectedCategories)); ?> selected</span><button class="btn btn-sm btn-success" wire:click="bulkActivate"><i class="bi bi-check-circle"></i> Activate</button><button class="btn btn-sm btn-warning" wire:click="bulkDeactivate"><i class="bi bi-pause-circle"></i> Deactivate</button><button class="btn btn-sm btn-danger" wire:click="bulkDelete"><i class="bi bi-trash"></i> Delete</button></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light"><tr><th width="40"><input type="checkbox" class="form-check-input" <?php if($selectAll): echo 'checked'; endif; ?> wire:click="toggleSelectAll"></th><th width="60">Img</th><th>Name</th><th>Slug</th><th>Projects</th><th width="90">Status</th><th width="80">Order</th><th width="140">Actions</th></tr></thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr>
                            <td><input type="checkbox" class="form-check-input" <?php if(in_array($cat->id, $selectedCategories)): echo 'checked'; endif; ?> wire:click="toggleCategorySelection(<?php echo e($cat->id); ?>)"></td>
                            <td><img src="<?php echo e($cat->image_url); ?>" style="width:40px;height:40px;object-fit:cover;border-radius:4px;"></td>
                            <td><strong><?php echo e($cat->pc_name); ?></strong></td>
                            <td><code><?php echo e($cat->pc_slug); ?></code></td>
                            <td><span class="badge bg-info"><?php echo e($cat->projects_count); ?></span></td>
                            <td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" <?php if($cat->is_active): echo 'checked'; endif; ?> wire:click="toggleStatus(<?php echo e($cat->id); ?>)"></div></td>
                            <td><?php echo e($cat->sort_order); ?></td>
                            <td><div class="btn-group btn-group-sm"><button class="btn btn-info" wire:click="viewCategoryDetails(<?php echo e($cat->id); ?>)"><i class="bi bi-eye"></i></button><a href="<?php echo e(route('admin.projects.categories.edit', $cat->id)); ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a><button class="btn btn-danger" wire:click="confirmDelete(<?php echo e($cat->id); ?>)"><i class="bi bi-trash"></i></button></div></td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr><td colspan="8" class="text-center py-5"><i class="bi bi-folder2-open display-4 text-muted d-block"></i>No categories found<br><a href="<?php echo e(route('admin.projects.categories.create')); ?>" class="btn btn-primary mt-2"><i class="bi bi-plus-lg"></i> Add Category</a></td></tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($categories->hasPages()): ?><div class="card-footer d-flex justify-content-between"><small>Showing <?php echo e($categories->firstItem()); ?>-<?php echo e($categories->lastItem()); ?> of <?php echo e($categories->total()); ?></small><?php echo e($categories->links()); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- View Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showViewModal && $viewCategory): ?>
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="bi bi-eye"></i> Category Details</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div><div class="modal-body text-center"><img src="<?php echo e($viewCategory->image_url); ?>" class="rounded mb-3" style="max-height:150px;"><h5><?php echo e($viewCategory->pc_name); ?></h5><p><?php echo e($viewCategory->pc_description); ?></p><span class="badge bg-info"><?php echo e($viewCategory->projects_count); ?> Projects</span></div><div class="modal-footer"><button class="btn btn-secondary" wire:click="closeModals">Close</button><a href="<?php echo e(route('admin.projects.categories.edit', $viewCategory->id)); ?>" class="btn btn-primary"><i class="bi bi-pencil"></i> Edit</a></div></div></div></div><div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Delete Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showDeleteModal): ?>
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirm Delete</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div><div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this category?</h5></div><div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deleteCategory"><i class="bi bi-trash"></i> Delete</button></div></div></div></div><div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/projects/category-list.blade.php ENDPATH**/ ?>