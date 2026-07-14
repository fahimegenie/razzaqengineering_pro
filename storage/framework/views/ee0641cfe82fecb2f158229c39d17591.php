<div>
    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Work Gallery Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Work Gallery</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Statistics Cards -->
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-images display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($totalItems); ?></h3>
                        <small>Total Items</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-check-circle display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($activeItems); ?></h3>
                        <small>Active</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-warning text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-collection display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($totalTypes); ?></h3>
                        <small>Types</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-tags display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($totalCategories); ?></h3>
                        <small>Categories</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toolbar -->
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-md-3">
                        <label class="form-label small fw-semibold">Search</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" wire:model.blur="search" placeholder="Search gallery...">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search): ?>
                                <button class="btn btn-outline-secondary" wire:click="clearSearch">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Type</label>
                        <select class="form-select" wire:model.blur="typeFilter">
                            <option value="">All Types</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($type); ?>"><?php echo e(ucfirst(str_replace(['-','_'], ' ', $type))); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Category</label>
                        <select class="form-select" wire:model.blur="categoryFilter">
                            <option value="">All Categories</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($category); ?>"><?php echo e($category); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Status</label>
                        <select class="form-select" wire:model.blur="statusFilter">
                            <option value="">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3 text-end">
                        <button class="btn btn-outline-secondary me-1" wire:click="clearFilters" title="Clear Filters">
                            <i class="bi bi-funnel"></i>
                        </button>
                        <a href="<?php echo e(route('admin.gallery.create')); ?>" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Add Item
                        </a>
                    </div>
                </div>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedItems) > 0): ?>
                <div class="mt-3 p-2 bg-light rounded d-flex align-items-center gap-2 flex-wrap">
                    <span class="fw-semibold me-2"><?php echo e(count($selectedItems)); ?> selected</span>
                    <button class="btn btn-sm btn-success" wire:click="bulkActivate">
                        <i class="bi bi-check-circle"></i> Activate
                    </button>
                    <button class="btn btn-sm btn-warning" wire:click="bulkDeactivate">
                        <i class="bi bi-pause-circle"></i> Deactivate
                    </button>
                    <button class="btn btn-sm btn-danger" wire:click="bulkDelete">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="row g-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $galleryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                <div class="card shadow-sm border-0 h-100 gallery-card">
                    <!-- Image -->
                    <div class="position-relative">
                        <img src="<?php echo e($item->image_url); ?>" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover;"
                             alt="<?php echo e($item->wg_title); ?>">
                        
                        <!-- Checkbox Overlay -->
                        <div class="position-absolute top-0 start-0 m-2">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   <?php if(in_array($item->id, $selectedItems)): echo 'checked'; endif; ?> 
                                   wire:click="toggleItemSelection(<?php echo e($item->id); ?>)"
                                   style="width: 20px; height: 20px; background: white;">
                        </div>
                        
                        <!-- Status Badge -->
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-<?php echo e($item->is_active ? 'success' : 'danger'); ?>">
                                <?php echo e($item->is_active ? 'Active' : 'Inactive'); ?>

                            </span>
                        </div>
                        
                        <!-- Type Badge -->
                        <div class="position-absolute bottom-0 start-0 m-2">
                            <span class="badge bg-primary"><?php echo e($item->type_label); ?></span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->wg_category): ?>
                                <span class="badge bg-info ms-1"><?php echo e($item->category_label); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title fw-bold mb-1"><?php echo e(Str::limit($item->wg_title, 30)); ?></h6>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->wg_description): ?>
                            <p class="card-text text-muted small flex-grow-1">
                                <?php echo e($item->short_description); ?>

                            </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <div class="mt-auto">
                            <small class="text-muted d-block mb-2">Order: <?php echo e($item->sort_order); ?></small>
                            
                            <div class="btn-group w-100" role="group">
                                <button class="btn btn-sm btn-info" 
                                        wire:click="viewItemDetails(<?php echo e($item->id); ?>)" 
                                        title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <a href="<?php echo e(route('admin.gallery.edit', ['galleryId' => $item->id])); ?>" 
                                   class="btn btn-sm btn-primary" 
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button class="btn btn-sm btn-<?php echo e($item->is_active ? 'success' : 'secondary'); ?>"
                                        wire:click="toggleStatus(<?php echo e($item->id); ?>)"
                                        title="Toggle Status">
                                    <i class="bi bi-<?php echo e($item->is_active ? 'toggle-on' : 'toggle-off'); ?>"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" 
                                        wire:click="confirmDelete(<?php echo e($item->id); ?>)" 
                                        title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-image display-1 text-muted d-block mb-3"></i>
                    <h4 class="text-muted">No gallery items found</h4>
                    <p class="text-muted">Start building your portfolio gallery</p>
                    <a href="<?php echo e(route('admin.gallery.create')); ?>" class="btn btn-primary btn-lg mt-2">
                        <i class="bi bi-plus-lg"></i> Add First Item
                    </a>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        
        <!-- Pagination -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($galleryItems->hasPages()): ?>
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Showing <?php echo e($galleryItems->firstItem()); ?> - <?php echo e($galleryItems->lastItem()); ?> of <?php echo e($galleryItems->total()); ?> items
                </small>
                <?php echo e($galleryItems->links()); ?>

            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- View Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showViewModal && $viewItem): ?>
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1055;" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-eye"></i> Gallery Item Details
                    </h5>
                    <button class="btn-close btn-close-white" wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <img src="<?php echo e($viewItem->image_url); ?>" 
                                 class="img-fluid rounded shadow-sm" 
                                 style="width: 100%; max-height: 400px; object-fit: cover;"
                                 alt="<?php echo e($viewItem->wg_title); ?>">
                        </div>
                        <div class="col-md-6">
                            <h4 class="fw-bold"><?php echo e($viewItem->wg_title); ?></h4>
                            
                            <div class="mb-3">
                                <span class="badge bg-primary me-1"><?php echo e($viewItem->type_label); ?></span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewItem->wg_category): ?>
                                    <span class="badge bg-info"><?php echo e($viewItem->category_label); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <span class="badge bg-<?php echo e($viewItem->is_active ? 'success' : 'danger'); ?> ms-1">
                                    <?php echo e($viewItem->is_active ? 'Active' : 'Inactive'); ?>

                                </span>
                            </div>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewItem->wg_description): ?>
                                <h6 class="fw-bold">Description:</h6>
                                <p class="text-muted"><?php echo e($viewItem->wg_description); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            <hr>
                            
                            <div class="row small text-muted">
                                <div class="col-6">
                                    <strong>Sort Order:</strong> <?php echo e($viewItem->sort_order); ?>

                                </div>
                                <div class="col-6">
                                    <strong>Created:</strong> <?php echo e($viewItem->created_at->format('M d, Y')); ?>

                                </div>
                                <div class="col-6 mt-2">
                                    <strong>Updated:</strong> <?php echo e($viewItem->updated_at->format('M d, Y')); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="closeModals">Close</button>
                    <a href="<?php echo e(route('admin.gallery.edit', $viewItem->id)); ?>" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Delete Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showDeleteModal): ?>
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1055;" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle"></i> Confirm Delete
                    </h5>
                    <button class="btn-close btn-close-white" wire:click="closeModals"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="bi bi-trash display-3 text-danger mb-3 d-block"></i>
                    <h5>Delete this gallery item?</h5>
                    <p class="text-muted">This action cannot be undone. Image and data will be permanently removed.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-secondary" wire:click="closeModals">Cancel</button>
                    <button class="btn btn-danger" wire:click="deleteItem">
                        <i class="bi bi-trash"></i> Yes, Delete Permanently
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .gallery-card {
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    }
    
    .gallery-card .card-img-top {
        transition: transform 0.5s ease;
    }
    
    .gallery-card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        cursor: pointer;
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/gallery/gallery-list.blade.php ENDPATH**/ ?>