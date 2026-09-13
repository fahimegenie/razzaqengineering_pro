<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Dynamic SEO Generator</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.seo.index')); ?>">SEO Management</a></li>
                        <li class="breadcrumb-item active">Dynamic Generator</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-2">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body text-center py-2">
                        <i class="bi bi-tools"></i>
                        <h5 class="mb-0 mt-1"><?php echo e($totalServices); ?></h5>
                        <small>Services</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center py-2">
                        <i class="bi bi-briefcase"></i>
                        <h5 class="mb-0 mt-1"><?php echo e($totalProjects); ?></h5>
                        <small>Projects</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 shadow-sm bg-warning text-white">
                    <div class="card-body text-center py-2">
                        <i class="bi bi-box"></i>
                        <h5 class="mb-0 mt-1"><?php echo e($totalProducts); ?></h5>
                        <small>Products</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 shadow-sm bg-danger text-white">
                    <div class="card-body text-center py-2">
                        <i class="bi bi-journal-text"></i>
                        <h5 class="mb-0 mt-1"><?php echo e($totalBlogs); ?></h5>
                        <small>Blogs</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body text-center py-2">
                        <i class="bi bi-images"></i>
                        <h5 class="mb-0 mt-1"><?php echo e($totalGalleries); ?></h5>
                        <small>Gallery</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 shadow-sm bg-dark text-white">
                    <div class="card-body text-center py-2">
                        <i class="bi bi-geo-alt"></i>
                        <h5 class="mb-0 mt-1"><?php echo e($totalCities); ?></h5>
                        <small>Cities</small>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-transparent">
                <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-magic me-2"></i>SEO Generator Settings</h3>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label required">Page Type</label>
                        <select class="form-select" wire:model.live="selectedPageType">
                            <option value="">-- Select Page Type --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pageTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($val); ?>" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'items-page-types-'.e($val).''; ?>wire:key="items-page-types-<?php echo e($val); ?>"><?php echo e($label); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label required">Generate Mode</label>
                        <select class="form-select" wire:model="generateMode">
                            <option value="both">Pages + Cities</option>
                            <option value="pages">Pages Only</option>
                            <option value="cities">Cities Only</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100" wire:click="preview">
                            <i class="bi bi-eye me-1"></i> Preview
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
        <div id="selection-panels-wrapper">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedPageType): ?>
            <div class="row g-3">
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($generateMode !== 'cities'): ?>
                <div class="col-md-6" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'items-selection-panel'; ?>wire:key="items-selection-panel">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-list-check me-2"></i>Select <?php echo e($pageTypes[$selectedPageType] ?? 'Items'); ?>

                            </h5>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model.live="selectAll" id="selectAll">
                                <label class="form-check-label" for="selectAll">Select All</label>
                            </div>
                        </div>
                        <div class="card-body" style="max-height:400px;overflow-y:auto;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($availableItems) > 0): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $availableItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <?php
                                    $itemName = match($selectedPageType) {
                                        'service' => $item->os_name ?? 'N/A',
                                        'project' => $item->p_title ?? 'N/A',
                                        'product' => $item->p_name ?? 'N/A',
                                        'blog' => $item->bp_title ?? 'N/A',
                                        'gallery' => $item->wg_title ?? 'N/A',
                                        'testimonial' => $item->t_name ?? 'N/A',
                                        'team' => $item->ot_name ?? 'N/A',
                                        default => 'Item #'.$item->id,
                                    };
                                ?>
                                <div class="form-check" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'item-check-group-'.e($selectedPageType).'-'.e($item->id).''; ?>wire:key="item-check-group-<?php echo e($selectedPageType); ?>-<?php echo e($item->id); ?>">
                                    <input class="form-check-input" type="checkbox" value="<?php echo e($item->id); ?>" wire:model="selectedItems" id="item_<?php echo e($item->id); ?>">
                                    <label class="form-check-label" for="item_<?php echo e($item->id); ?>"><?php echo e($itemName); ?></label>
                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <?php else: ?>
                                <p class="text-muted text-center py-3">Select a page type to see items.</p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted"><?php echo e(count($selectedItems)); ?> of <?php echo e(count($availableItems)); ?> selected</small>
                        </div>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($generateMode !== 'pages'): ?>
                <div class="col-md-6" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'cities-selection-panel'; ?>wire:key="cities-selection-panel">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-geo-alt me-2"></i>Select Cities
                            </h5>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model.live="selectAllCities" id="selectAllCities">
                                <label class="form-check-label" for="selectAllCities">Select All (<?php echo e($totalCities); ?>)</label>
                            </div>
                        </div>
                        <div class="card-body" style="max-height:400px;overflow-y:auto;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $availableCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            
                            <div class="form-check" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'city-check-group-'.e($city->id).''; ?>wire:key="city-check-group-<?php echo e($city->id); ?>">
                                <input class="form-check-input" type="checkbox" value="<?php echo e($city->id); ?>" wire:model="selectedCities" id="city_<?php echo e($city->id); ?>">
                                <label class="form-check-label" for="city_<?php echo e($city->id); ?>"><?php echo e($city->name); ?>, <?php echo e($city->country); ?></label>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted"><?php echo e(count($selectedCities)); ?> of <?php echo e($totalCities); ?> selected</small>
                        </div>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="card shadow-sm border-0 mb-3 mt-3">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0 fw-semibold">
                    <i class="bi bi-braces me-2"></i>SEO Templates
                    <small class="text-muted">(use <code>{name}</code> and <code>{city}</code>)</small>
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Page Title Template</label>
                        <input type="text" class="form-control" wire:model="seoTitleTemplate">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City Page Title Template</label>
                        <input type="text" class="form-control" wire:model="cityTitleTemplate">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Page Description Template</label>
                        <textarea class="form-control" rows="2" wire:model="seoDescriptionTemplate"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City Page Description Template</label>
                        <textarea class="form-control" rows="2" wire:model="cityDescriptionTemplate"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Page Keywords Template</label>
                        <input type="text" class="form-control" wire:model="seoKeywordsTemplate">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City Page Keywords Template</label>
                        <input type="text" class="form-control" wire:model="cityKeywordsTemplate">
                    </div>
                </div>
            </div>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showPreview): ?>
        <div class="card shadow-sm border-0 mb-3" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'preview-table-card'; ?>wire:key="preview-table-card">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-semibold">
                    <i class="bi bi-eye me-2"></i>Preview (<?php echo e($totalCount); ?> records)
                </h5>
                <button type="button" class="btn btn-success" wire:click="generate" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="generate">
                        <i class="bi bi-rocket-takeoff me-1"></i> Generate All SEO Data
                    </span>
                    <span wire:loading wire:target="generate">
                        <span class="spinner-border spinner-border-sm me-1"></span> Generating...
                    </span>
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height:400px;overflow-y:auto;">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>URL</th>
                                <th>SEO Title</th>
                                <th>City</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $previewData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'preview-row-'.e($i).''; ?>wire:key="preview-row-<?php echo e($i); ?>">
                                <td><?php echo e($i + 1); ?></td>
                                <td><span class="badge bg-primary"><?php echo e($data['type']); ?></span></td>
                                <td><?php echo e($data['name']); ?></td>
                                <td><small><?php echo e($data['url']); ?></small></td>
                                <td><small><?php echo e($data['seo_title']); ?></small></td>
                                <td>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['has_city']): ?>
                                    <span class="badge bg-info"><?php echo e($data['city']); ?></span>
                                    <?php else: ?>
                                    <span class="text-muted">—</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isGenerating): ?>
        <div class="card shadow-sm border-0 mb-3" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'generation-progress-card'; ?>wire:key="generation-progress-card">
            <div class="card-body text-center py-4">
                <h5><i class="bi bi-hourglass-split spin me-2"></i>Generating SEO Data...</h5>
                <div class="progress mt-2" style="height:25px;">
                    <?php
                        $percentage = $totalCount > 0 ? ($progressCount / $totalCount) * 100 : 0;
                    ?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated" 
                         style="width:<?php echo e($percentage); ?>%">
                        <?php echo e($progressCount); ?> / <?php echo e($totalCount); ?>

                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($generationComplete): ?>
        <div class="alert alert-success" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'generation-success-alert'; ?>wire:key="generation-success-alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            Successfully generated <strong><?php echo e($progressCount); ?></strong> SEO records!
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .spin {
        animation: spin 2s linear infinite;
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .sticky-top {
        position: sticky;
        top: 0;
        z-index: 1;
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/seo/dynamic-seo-generator.blade.php ENDPATH**/ ?>