<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3">Products</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li><li class="breadcrumb-item active">Products</li></ol></div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-primary text-white"><div class="card-body text-center py-3"><i class="bi bi-box-seam display-6"></i><h3 class="mb-0 mt-1"><?php echo e($totalProducts); ?></h3><small>Total</small></div></div></div>
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-success text-white"><div class="card-body text-center py-3"><i class="bi bi-check-circle display-6"></i><h3 class="mb-0 mt-1"><?php echo e($activeProducts); ?></h3><small>Active</small></div></div></div>
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-warning text-white"><div class="card-body text-center py-3"><i class="bi bi-star-fill display-6"></i><h3 class="mb-0 mt-1"><?php echo e($featuredProducts); ?></h3><small>Featured</small></div></div></div>
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-info text-white"><div class="card-body text-center py-3"><i class="bi bi-boxes display-6"></i><h3 class="mb-0 mt-1"><?php echo e($inStockProducts); ?></h3><small>In Stock</small></div></div></div>
        </div>

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row g-2 align-items-end">
                    <div class="col-md-3"><div class="input-group"><span class="input-group-text"><i class="bi bi-search"></i></span><input type="text" class="form-control" wire:model.blur="search" placeholder="Search..."><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search): ?><button class="btn btn-outline-secondary" wire:click="clearSearch"><i class="bi bi-x-lg"></i></button><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div></div>
                    <div class="col-6 col-md-2"><select class="form-select" wire:model.blur="statusFilter"><option value="">Status</option><option value="1">Active</option><option value="0">Inactive</option></select></div>
                    <div class="col-6 col-md-2"><select class="form-select" wire:model.blur="categoryFilter"><option value="">Category</option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><option value="<?php echo e($c->id); ?>"><?php echo e($c->pc_name); ?></option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></select></div>
                    <div class="col-6 col-md-2"><select class="form-select" wire:model.blur="stockFilter"><option value="">Stock</option><option value="1">In Stock</option><option value="0">Out of Stock</option></select></div>
                    <div class="col-6 col-md-3 text-end"><button class="btn btn-outline-secondary me-1" wire:click="clearFilters"><i class="bi bi-funnel"></i></button><a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Product</a></div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedProducts) > 0): ?>
                <div class="mt-3 p-2 bg-light rounded d-flex gap-2"><span class="fw-semibold"><?php echo e(count($selectedProducts)); ?> selected</span><button class="btn btn-sm btn-success" wire:click="bulkActivate"><i class="bi bi-check-circle"></i> Activate</button><button class="btn btn-sm btn-warning" wire:click="bulkDeactivate"><i class="bi bi-pause-circle"></i> Deactivate</button><button class="btn btn-sm btn-danger" wire:click="bulkDelete"><i class="bi bi-trash"></i> Delete</button></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <div class="row g-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card shadow-sm border-0 h-100 product-card">
                    <div class="position-relative">
                        <img src="<?php echo e($product->image_url); ?>" class="card-img-top" style="height:180px;object-fit:cover;">
                        <div class="position-absolute top-0 start-0 m-2"><input type="checkbox" class="form-check-input" <?php if(in_array($product->id, $selectedProducts)): echo 'checked'; endif; ?> wire:click="toggleProductSelection(<?php echo e($product->id); ?>)" style="width:20px;height:20px;background:white;"></div>
                        <div class="position-absolute top-0 end-0 m-2 d-flex gap-1">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->is_featured): ?><span class="badge bg-warning"><i class="bi bi-star-fill"></i></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <span class="badge bg-<?php echo e($product->in_stock ? 'success' : 'danger'); ?>"><?php echo e($product->in_stock ? 'Stock' : 'Out'); ?></span>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-bold"><?php echo e(Str::limit($product->p_name, 30)); ?></h6>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->category): ?><small class="text-muted"><?php echo e($product->category->pc_name); ?></small><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <p class="text-muted small flex-grow-1"><?php echo e(Str::limit(strip_tags($product->p_short_description), 60)); ?></p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->p_price): ?><h6 class="text-primary mb-2"><?php echo e($product->formatted_price); ?></h6><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div class="btn-group w-100 btn-group-sm">
                            <button class="btn btn-info" wire:click="viewProductDetails(<?php echo e($product->id); ?>)"><i class="bi bi-eye"></i></button>
                            <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-<?php echo e($product->is_active ? 'success' : 'secondary'); ?>" wire:click="toggleStatus(<?php echo e($product->id); ?>)"><i class="bi bi-<?php echo e($product->is_active ? 'toggle-on' : 'toggle-off'); ?>"></i></button>
                            <button class="btn btn-danger" wire:click="confirmDelete(<?php echo e($product->id); ?>)"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="col-12 text-center py-5"><i class="bi bi-box display-1 text-muted d-block mb-3"></i><h4>No products found</h4><a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary mt-2"><i class="bi bi-plus-lg"></i> Add First Product</a></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products->hasPages()): ?><div class="card shadow-sm border-0 mt-3"><div class="card-footer d-flex justify-content-between"><small>Showing <?php echo e($products->firstItem()); ?>-<?php echo e($products->lastItem()); ?> of <?php echo e($products->total()); ?></small><?php echo e($products->links()); ?></div></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showViewModal && $viewProduct): ?>
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="bi bi-eye"></i> Product Details</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div><div class="modal-body"><div class="row"><div class="col-md-5"><img src="<?php echo e($viewProduct->image_url); ?>" class="img-fluid rounded"></div><div class="col-md-7"><h4><?php echo e($viewProduct->p_name); ?></h4><p>Category: <?php echo e($viewProduct->category->pc_name ?? 'N/A'); ?></p><p>Price: <?php echo e($viewProduct->formatted_price); ?></p><p>Stock: <?php echo $viewProduct->stock_badge; ?></p><p>Status: <span class="badge bg-<?php echo e($viewProduct->is_active ? 'success' : 'danger'); ?>"><?php echo e($viewProduct->is_active ? 'Active' : 'Inactive'); ?></span></p></div></div></div><div class="modal-footer"><button class="btn btn-secondary" wire:click="closeModals">Close</button><a href="<?php echo e(route('admin.products.edit', $viewProduct->id)); ?>" class="btn btn-primary"><i class="bi bi-pencil"></i> Edit</a></div></div></div></div><div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showDeleteModal): ?>
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirm Delete</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div><div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this product?</h5></div><div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deleteProduct"><i class="bi bi-trash"></i> Delete</button></div></div></div></div><div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<?php $__env->startPush('styles'); ?>
<style>.product-card{transition:all .3s ease}.product-card:hover{transform:translateY(-5px);box-shadow:0 10px 30px rgba(0,0,0,.15)!important}.form-switch .form-check-input{width:3em;height:1.5em;cursor:pointer}</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/products/product-list.blade.php ENDPATH**/ ?>