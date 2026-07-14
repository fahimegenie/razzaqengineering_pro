<div>
    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Testimonial Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Testimonials</li>
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
                        <i class="bi bi-chat-quote display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($totalTestimonials); ?></h3>
                        <small>Total Testimonials</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-check-circle display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($activeTestimonials); ?></h3>
                        <small>Active</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-warning text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-star-fill display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($featuredTestimonials); ?></h3>
                        <small>Featured</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-bar-chart display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($averageRating); ?></h3>
                        <small>Avg Rating</small>
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
                            <input type="text" class="form-control" wire:model.blur="search" placeholder="Search testimonials...">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search): ?>
                                <button class="btn btn-outline-secondary" wire:click="clearSearch">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Rating</label>
                        <select class="form-select" wire:model.blur="ratingFilter">
                            <option value="">All Ratings</option>
                            <option value="5">★★★★★ (5)</option>
                            <option value="4">★★★★☆ (4)</option>
                            <option value="3">★★★☆☆ (3)</option>
                            <option value="2">★★☆☆☆ (2)</option>
                            <option value="1">★☆☆☆☆ (1)</option>
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
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Featured</label>
                        <select class="form-select" wire:model.blur="featuredFilter">
                            <option value="">All</option>
                            <option value="1">Featured</option>
                            <option value="0">Not Featured</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3 text-end">
                        <button class="btn btn-outline-secondary me-1" wire:click="clearFilters" title="Clear Filters">
                            <i class="bi bi-funnel"></i>
                        </button>
                        <a href="<?php echo e(route('admin.testimonials.create')); ?>" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Add Testimonial
                        </a>
                    </div>
                </div>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedTestimonials) > 0): ?>
                <div class="mt-3 p-2 bg-light rounded d-flex align-items-center gap-2 flex-wrap">
                    <span class="fw-semibold me-2"><?php echo e(count($selectedTestimonials)); ?> selected</span>
                    <button class="btn btn-sm btn-success" wire:click="bulkActivate">
                        <i class="bi bi-check-circle"></i> Activate
                    </button>
                    <button class="btn btn-sm btn-warning" wire:click="bulkDeactivate">
                        <i class="bi bi-pause-circle"></i> Deactivate
                    </button>
                    <button class="btn btn-sm btn-info" wire:click="bulkFeature">
                        <i class="bi bi-star"></i> Feature
                    </button>
                    <button class="btn btn-sm btn-danger" wire:click="bulkDelete">
                        <i class="bi bi-trash"></i> Delete
                    </button>
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
                                <th width="40">
                                    <input type="checkbox" class="form-check-input" <?php if($selectAll): echo 'checked'; endif; ?> wire:click="toggleSelectAll">
                                </th>
                                <th width="60">Photo</th>
                                <th wire:click="sortBy('t_name')" style="cursor:pointer;">
                                    Client 
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sortField === 't_name'): ?>
                                        <i class="bi bi-arrow-<?php echo e($sortDirection === 'asc' ? 'up' : 'down'); ?>"></i>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </th>
                                <th>Company</th>
                                <th wire:click="sortBy('t_rating')" style="cursor:pointer;">
                                    Rating
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sortField === 't_rating'): ?>
                                        <i class="bi bi-arrow-<?php echo e($sortDirection === 'asc' ? 'up' : 'down'); ?>"></i>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </th>
                                <th wire:click="sortBy('is_active')" style="cursor:pointer;" width="90">Status</th>
                                <th wire:click="sortBy('is_featured')" style="cursor:pointer;" width="90">Featured</th>
                                <th wire:click="sortBy('sort_order')" style="cursor:pointer;" width="80">Order</th>
                                <th wire:click="sortBy('created_at')" style="cursor:pointer;" width="100">
                                    Date
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sortField === 'created_at'): ?>
                                        <i class="bi bi-arrow-<?php echo e($sortDirection === 'asc' ? 'up' : 'down'); ?>"></i>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </th>
                                <th width="160">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr>
                                <td>
                                    <input type="checkbox" 
                                           class="form-check-input" 
                                           <?php if(in_array($testimonial->id, $selectedTestimonials)): echo 'checked'; endif; ?> 
                                           wire:click="toggleTestimonialSelection(<?php echo e($testimonial->id); ?>)">
                                </td>
                                <td>
                                    <img src="<?php echo e($testimonial->image_url); ?>" 
                                         alt="<?php echo e($testimonial->t_name); ?>" 
                                         class="rounded-circle" 
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                </td>
                                <td>
                                    <strong><?php echo e(Str::limit($testimonial->t_name, 30)); ?></strong>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonial->t_designation): ?>
                                        <br><small class="text-muted"><?php echo e(Str::limit($testimonial->t_designation, 30)); ?></small>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <td>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonial->t_company): ?>
                                        <span class="badge bg-secondary"><?php echo e($testimonial->t_company); ?></span>
                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <td>
                                    <span class="text-warning">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <i class="bi bi-star<?php echo e($i <= $testimonial->t_rating ? '-fill' : ''); ?>"></i>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </span>
                                    <small class="ms-1"><?php echo e($testimonial->t_rating); ?>/5</small>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               <?php if($testimonial->is_active): echo 'checked'; endif; ?> 
                                               wire:click="toggleStatus(<?php echo e($testimonial->id); ?>)">
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-<?php echo e($testimonial->is_featured ? 'warning' : 'outline-warning'); ?>" 
                                            wire:click="toggleFeatured(<?php echo e($testimonial->id); ?>)"
                                            title="Toggle Featured">
                                        <i class="bi bi-star<?php echo e($testimonial->is_featured ? '-fill' : ''); ?>"></i>
                                    </button>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark"><?php echo e($testimonial->sort_order); ?></span>
                                </td>
                                <td>
                                    <small class="text-muted"><?php echo e($testimonial->created_at->format('M d, Y')); ?></small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-info" 
                                                wire:click="viewTestimonialDetails(<?php echo e($testimonial->id); ?>)" 
                                                title="View">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <a href="<?php echo e(route('admin.testimonials.edit', ['testimonialId' => $testimonial->id])); ?>" 
                                           class="btn btn-primary" 
                                           title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn btn-danger" 
                                                wire:click="confirmDelete(<?php echo e($testimonial->id); ?>)" 
                                                title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <tr>
                                <td colspan="10" class="text-center py-5">
                                    <i class="bi bi-chat-square-quote display-4 text-muted d-block mb-2"></i>
                                    <h5 class="text-muted">No testimonials found</h5>
                                    <p class="text-muted small">Start collecting client testimonials</p>
                                    <a href="<?php echo e(route('admin.testimonials.create')); ?>" class="btn btn-primary mt-2">
                                        <i class="bi bi-plus-lg"></i> Add First Testimonial
                                    </a>
                                </td>
                            </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonials->hasPages()): ?>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Showing <?php echo e($testimonials->firstItem()); ?> - <?php echo e($testimonials->lastItem()); ?> of <?php echo e($testimonials->total()); ?> testimonials
                </small>
                <?php echo e($testimonials->links()); ?>

            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- View Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showViewModal && $viewTestimonial): ?>
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1055;" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-eye"></i> Testimonial Details
                    </h5>
                    <button class="btn-close btn-close-white" wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4 text-center">
                            <img src="<?php echo e($viewTestimonial->image_url); ?>" 
                                 class="rounded-circle mb-2" 
                                 style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #007bff;">
                            <h5 class="mb-1"><?php echo e($viewTestimonial->t_name); ?></h5>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewTestimonial->t_designation): ?>
                                <p class="text-muted mb-1"><?php echo e($viewTestimonial->t_designation); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewTestimonial->t_company): ?>
                                <span class="badge bg-secondary"><?php echo e($viewTestimonial->t_company); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewTestimonial->t_location): ?>
                                <p class="mt-2">📍 <?php echo e($viewTestimonial->t_location); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <span class="text-warning fs-5">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <i class="bi bi-star<?php echo e($i <= $viewTestimonial->t_rating ? '-fill' : ''); ?>"></i>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </span>
                                <span class="ms-2 fw-semibold"><?php echo e($viewTestimonial->t_rating); ?>/5</span>
                            </div>
                            <blockquote class="blockquote">
                                <p class="mb-0 fst-italic">"<?php echo e($viewTestimonial->t_content); ?>"</p>
                            </blockquote>
                            <hr>
                            <div class="row small text-muted">
                                <div class="col-6">
                                    <strong>Status:</strong> 
                                    <span class="badge bg-<?php echo e($viewTestimonial->is_active ? 'success' : 'danger'); ?>">
                                        <?php echo e($viewTestimonial->is_active ? 'Active' : 'Inactive'); ?>

                                    </span>
                                </div>
                                <div class="col-6">
                                    <strong>Featured:</strong> 
                                    <span class="badge bg-<?php echo e($viewTestimonial->is_featured ? 'warning' : 'secondary'); ?>">
                                        <?php echo e($viewTestimonial->is_featured ? 'Yes' : 'No'); ?>

                                    </span>
                                </div>
                                <div class="col-6 mt-2">
                                    <strong>Sort Order:</strong> <?php echo e($viewTestimonial->sort_order); ?>

                                </div>
                                <div class="col-6 mt-2">
                                    <strong>Created:</strong> <?php echo e($viewTestimonial->created_at->format('M d, Y H:i')); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="closeModals">Close</button>
                    <a href="<?php echo e(route('admin.testimonials.edit', $viewTestimonial->id)); ?>" class="btn btn-primary">
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
                    <h5>Delete this testimonial?</h5>
                    <p class="text-muted">This action cannot be undone. All data will be permanently removed.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-secondary" wire:click="closeModals">Cancel</button>
                    <button class="btn btn-danger" wire:click="deleteTestimonial">
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
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        cursor: pointer;
    }
    
    .rounded-circle {
        transition: all 0.3s ease;
    }
    
    .table th {
        white-space: nowrap;
    }
    
    .btn-group-sm .btn {
        padding: 0.25rem 0.5rem;
    }
    
    .card.bg-primary, .card.bg-success, .card.bg-warning, .card.bg-info {
        transition: transform 0.3s ease;
    }
    
    .card.bg-primary:hover, 
    .card.bg-success:hover, 
    .card.bg-warning:hover, 
    .card.bg-info:hover {
        transform: translateY(-3px);
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/testimonials/testimonial-list.blade.php ENDPATH**/ ?>