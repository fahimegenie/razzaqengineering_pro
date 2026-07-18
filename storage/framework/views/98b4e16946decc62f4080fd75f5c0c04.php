<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">SEO Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">SEO Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-search display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($totalRecords); ?></h3>
                        <small>Total Records</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-check-circle display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($indexableRecords); ?></h3>
                        <small>Indexable</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-diagram-3 display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($inSitemapRecords); ?></h3>
                        <small>In Sitemap</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-warning text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-files display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e(count($pageTypes)); ?></h3>
                        <small>Page Types</small>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" wire:model.live.debounce.300ms="search" placeholder="Search...">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search): ?>
                                <button class="btn btn-outline-secondary" wire:click="clearSearch">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" wire:model.live="pageTypeFilter">
                            <option value="">All Types</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pageTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($type); ?>"><?php echo e($this->getPageTypeLabel($type)); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" wire:model.live="indexFilter">
                            <option value="">Index Status</option>
                            <option value="index">Indexable</option>
                            <option value="noindex">No Index</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" wire:model.live="sitemapFilter">
                            <option value="">Sitemap</option>
                            <option value="1">In Sitemap</option>
                            <option value="0">Not in Sitemap</option>
                        </select>
                    </div>
                    <div class="col-md-3 text-end">
                        <button class="btn btn-outline-secondary me-1" wire:click="clearFilters">
                            <i class="bi bi-funnel"></i> Clear
                        </button>
                        <a href="<?php echo e(route('admin.seo.create')); ?>" class="btn btn-primary">
                            <i class="bi bi-plus-lg"></i> Add SEO Data
                        </a>
                    </div>
                </div>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedItems) > 0): ?>
                <div class="mt-3 p-2 bg-light rounded d-flex gap-2 align-items-center">
                    <span class="fw-semibold"><?php echo e(count($selectedItems)); ?> selected</span>
                    <button class="btn btn-sm btn-danger" wire:click="bulkDelete" 
                            onclick="return confirm('Delete <?php echo e(count($selectedItems)); ?> selected records?')">
                        <i class="bi bi-trash"></i> Delete Selected
                    </button>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="40">
                                <input type="checkbox" class="form-check-input" 
                                       wire:model.live="selectAll">
                            </th>
                            <th style="cursor:pointer" wire:click="sortBy('seo_page_type')">
                                Page Type 
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sortField === 'seo_page_type'): ?>
                                    <i class="bi bi-arrow-<?php echo e($sortDirection === 'asc' ? 'up' : 'down'); ?>"></i>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Robots</th>
                            <th>Sitemap</th>
                            <th>Schema</th>
                            <th>Analytics</th>
                            <th width="140">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $seoRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input" 
                                       <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'item-'.e($record->id).''; ?>wire:key="item-<?php echo e($record->id); ?>"
                                       <?php if(in_array($record->id, $selectedItems)): echo 'checked'; endif; ?> 
                                       wire:click="toggleItemSelection(<?php echo e($record->id); ?>)">
                            </td>
                            <td>
                                <span class="badge bg-primary">
                                    <?php echo e($this->getPageTypeLabel($record->seo_page_type)); ?>

                                </span>
                            </td>
                            <td>
                                <strong><?php echo e(\Illuminate\Support\Str::limit($record->meta_title, 40) ?: '—'); ?></strong>
                            </td>
                            <td>
                                <small class="text-muted"><?php echo e($record->seo_page_url ?: $record->seo_canonical ?: '—'); ?></small>
                            </td>
                            <td>
                                <span class="badge bg-<?php echo e($record->seo_no_index ? 'danger' : 'success'); ?>">
                                    <?php echo e($record->robots_content); ?>

                                </span>
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($record->seo_sitemap_include): ?>
                                    <span class="badge bg-info">
                                        Yes (<?php echo e($this->getSitemapPriorityFormatted($record->seo_sitemap_priority)); ?>)
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">No</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->hasSchemaMarkup($record)): ?>
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                <?php else: ?>
                                    <i class="bi bi-x-circle text-muted"></i>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->hasAnalytics($record)): ?>
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                <?php else: ?>
                                    <i class="bi bi-x-circle text-muted"></i>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-info" wire:click="viewItemDetails(<?php echo e($record->id); ?>)" 
                                            title="View">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <a href="<?php echo e(route('admin.seo.edit', $record->id)); ?>" 
                                       class="btn btn-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-danger" wire:click="confirmDelete(<?php echo e($record->id); ?>)" 
                                            title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="bi bi-search display-4 text-muted d-block"></i>
                                <h5>No SEO records found</h5>
                                <p class="text-muted">Start by adding your first SEO data</p>
                                <a href="<?php echo e(route('admin.seo.create')); ?>" class="btn btn-primary mt-2">
                                    <i class="bi bi-plus-lg"></i> Add SEO Data
                                </a>
                            </td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($seoRecords->hasPages()): ?>
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="text-muted small">
                        Showing <span class="fw-semibold"><?php echo e($seoRecords->firstItem()); ?></span> 
                        to <span class="fw-semibold"><?php echo e($seoRecords->lastItem()); ?></span> 
                        of <span class="fw-semibold"><?php echo e($seoRecords->total()); ?></span> records
                    </div>
                    <div>
                        <?php echo e($seoRecords->links('vendor.pagination.bootstrap-5')); ?>

                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="card-footer bg-light">
                <div class="text-muted small text-center">
                    Showing all <span class="fw-semibold"><?php echo e($seoRecords->total()); ?></span> records
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showViewModal && $viewItem): ?>
    <div class="modal fade show d-block" style="background:rgba(0,0,0,.5);z-index:1055;" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-eye"></i> SEO Details - <?php echo e($this->getPageTypeLabel($viewItem->seo_page_type)); ?>

                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h6 class="border-bottom pb-2">Basic Information</h6>
                            <p><strong>Main Title:</strong> <?php echo e($viewItem->seo_main_title ?: '—'); ?></p>
                            <p><strong>SEO Title:</strong> <?php echo e($viewItem->seo_title ?: '—'); ?></p>
                            <p><strong>Description:</strong> <?php echo e($viewItem->seo_description ?: '—'); ?></p>
                            <p><strong>Keywords:</strong> <?php echo e($viewItem->seo_keywords ?: '—'); ?></p>
                            <p><strong>Focus Keyword:</strong> <?php echo e($viewItem->seo_focus_keyword ?: '—'); ?></p>
                            <p><strong>Canonical URL:</strong> <?php echo e($viewItem->seo_canonical ?: 'Auto-generated'); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="border-bottom pb-2">Technical SEO</h6>
                            <p><strong>Robots:</strong> 
                                <span class="badge bg-<?php echo e($viewItem->seo_no_index ? 'danger' : 'success'); ?>">
                                    <?php echo e($viewItem->robots_content); ?>

                                </span>
                            </p>
                            <p><strong>Sitemap:</strong> 
                                <?php echo e($viewItem->seo_sitemap_include ? 'Yes' : 'No'); ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewItem->seo_sitemap_include): ?>
                                    (Priority: <?php echo e($this->getSitemapPriorityFormatted($viewItem->seo_sitemap_priority)); ?>)
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </p>
                            <p><strong>OG Type:</strong> <?php echo e($viewItem->seo_og_type ?: 'website'); ?></p>
                            <p><strong>Twitter Card:</strong> <?php echo e($viewItem->seo_twitter_card ?: 'summary_large_image'); ?></p>
                            <p><strong>Schema Type:</strong> <?php echo e($viewItem->seo_schema_type ?: 'None'); ?></p>
                            <p><strong>Page Type:</strong> <?php echo e($viewItem->seo_page_type); ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModals">Close</button>
                    <a href="<?php echo e(route('admin.seo.edit', $viewItem->id)); ?>" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showDeleteModal): ?>
    <div class="modal fade show d-block" style="background:rgba(0,0,0,.5);z-index:1055;" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle"></i> Confirm Delete
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeModals"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="bi bi-trash display-3 text-danger mb-3 d-block"></i>
                    <h5>Are you sure?</h5>
                    <p class="text-muted">This will permanently delete this SEO record.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" wire:click="closeModals">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteItem">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/seo/seo-list.blade.php ENDPATH**/ ?>