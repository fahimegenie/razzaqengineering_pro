<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3"><?php echo e($isEditing ? 'Edit Product' : 'Create New Product'); ?></h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.products.index')); ?>">Products</a></li>
                        <li class="breadcrumb-item active"><?php echo e($isEditing ? 'Edit' : 'Create'); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form wire:submit="save">
            <div class="row g-3">
                <div class="col-12 col-lg-8">
                    <!-- Basic Info Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-box me-2"></i>Product Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label required">Product Name</label>
                                    <input type="text" class="form-control form-control-lg <?php $__errorArgs = ['p_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           wire:model.live="p_name" placeholder="Enter product name...">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['p_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Slug</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" wire:model="p_slug" placeholder="product-slug">
                                        <button type="button" class="btn btn-outline-secondary" wire:click="generateSlug">
                                            <i class="bi bi-arrow-repeat"></i> Generate
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Product Type</label>
                                    <input type="text" class="form-control" wire:model="pc_type" placeholder="e.g., Physical, Digital">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Short Description</label>
                                    <textarea class="form-control" rows="2" wire:model="p_short_description" 
                                              placeholder="Brief summary (displayed in product cards)..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CKEditor for Full Description -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-text-paragraph me-2"></i>Full Description
                            </h3>
                        </div>
                        <div class="card-body">
                            
                            <div 
                                x-data="{
                                    editor: null,
                                    value: <?php if ((object) ('p_description') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('p_description'->value()); ?>')<?php echo e('p_description'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('p_description'); ?>')<?php endif; ?>,
                                    
                                    init() {
                                        if (typeof ClassicEditor === 'undefined') {
                                            setTimeout(() => this.init(), 200);
                                            return;
                                        }
                                        
                                        ClassicEditor
                                            .create(document.querySelector('#productDescription'), {
                                                placeholder: 'Describe your product in detail...',
                                                toolbar: {
                                                    items: [
                                                        'heading', '|',
                                                        'bold', 'italic', 'underline', 'strikethrough', '|',
                                                        'link', 'blockQuote', 'codeBlock', '|',
                                                        'bulletedList', 'numberedList', '|',
                                                        'outdent', 'indent', '|',
                                                        'imageUpload', 'mediaEmbed', '|',
                                                        'insertTable', '|',
                                                        'alignment', '|',
                                                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                                                        'undo', 'redo'
                                                    ]
                                                },
                                                heading: {
                                                    options: [
                                                        { model: 'paragraph', title: 'Paragraph' },
                                                        { model: 'heading1', view: 'h1', title: 'Heading 1' },
                                                        { model: 'heading2', view: 'h2', title: 'Heading 2' },
                                                        { model: 'heading3', view: 'h3', title: 'Heading 3' },
                                                    ]
                                                }
                                            })
                                            .then(editor => {
                                                this.editor = editor;
                                                if (this.value) {
                                                    editor.setData(this.value);
                                                }
                                                editor.model.document.on('change:data', () => {
                                                    this.value = editor.getData();
                                                });
                                            })
                                            .catch(error => console.error('CKEditor Error:', error));
                                    }
                                }"
                                x-cloak
                                wire:ignore
                            >
                                <label class="form-label fw-semibold">Product Description</label>
                                <textarea id="productDescription"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Specifications Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-list-check me-2"></i>Specifications</h3>
                        </div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" wire:model="p_specifications_input" 
                                       wire:keydown.enter.prevent="addSpecification" 
                                       placeholder="Key: Value (e.g., Weight: 5kg, Color: Red)">
                                <button type="button" class="btn btn-primary" wire:click="addSpecification">
                                    <i class="bi bi-plus-lg"></i> Add
                                </button>
                            </div>
                            <small class="text-muted d-block mb-2">Format: Key: Value (separated by colon)</small>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($specifications) > 0): ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead class="table-light">
                                            <tr><th width="40%">Specification</th><th>Value</th><th width="50">Action</th></tr>
                                        </thead>
                                        <tbody>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $specifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <tr>
                                                <td class="fw-semibold"><?php echo e($key); ?></td>
                                                <td><?php echo e($value); ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-sm" 
                                                            wire:click="removeSpecification('<?php echo e($key); ?>')">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="text-center text-muted py-3">
                                    <i class="bi bi-clipboard-check display-6 d-block mb-2"></i>
                                    <p>No specifications added yet.</p>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-12 col-lg-4">
                    <!-- Settings Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-gear me-2"></i>Product Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select" wire:model="product_category_id">
                                    <option value="">-- Select Category --</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->pc_name); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">PKR</span>
                                    <input type="text" class="form-control" wire:model="p_price" placeholder="5000">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contact / WhatsApp</label>
                                <input type="text" class="form-control" wire:model="p_contact" placeholder="+92 300 1234567">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" class="form-control" wire:model="sort_order" min="0" placeholder="0">
                            </div>
                            
                            <hr>
                            
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" wire:model="in_stock" id="in_stock">
                                <label class="form-check-label fw-semibold" for="in_stock">In Stock</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" wire:model="is_active" id="is_active">
                                <label class="form-check-label fw-semibold" for="is_active">Active</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" wire:model="is_featured" id="is_featured">
                                <label class="form-check-label fw-semibold" for="is_featured">Featured</label>
                            </div>
                        </div>
                    </div>

                    <!-- Main Image Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-image me-2"></i>Main Image</h3>
                        </div>
                        <div class="card-body text-center">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imagePreview): ?>
                                <img src="<?php echo e($imagePreview); ?>" class="rounded mb-2" 
                                     style="width:100%;max-height:200px;object-fit:cover;">
                            <?php else: ?>
                                <div class="bg-light rounded d-flex align-items-center justify-content-center mb-2" 
                                     style="height:150px;border:3px dashed #ccc;">
                                    <i class="bi bi-image display-4 text-muted"></i>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <input type="file" class="form-control" wire:model="p_image" accept="image/*">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imagePreview): ?>
                                <button type="button" class="btn btn-danger btn-sm mt-2 w-100" wire:click="removeImage">
                                    <i class="bi bi-trash"></i> Remove Image
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <small class="text-muted d-block mt-1">Recommended: 800×800px, Max 5MB</small>
                        </div>
                    </div>

                    <!-- Gallery Images Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-images me-2"></i>Gallery Images</h3>
                        </div>
                        <div class="card-body">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($existingGallery) > 0): ?>
                                <div class="row g-2 mb-3">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $existingGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="col-4 position-relative">
                                            <img src="<?php echo e($img); ?>" class="img-thumbnail w-100" style="height:70px;object-fit:cover;">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle" 
                                                    wire:click="removeExistingGalleryImage(<?php echo e($i); ?>)" style="width:22px;height:22px;padding:0;font-size:10px;">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($galleryPreviews) > 0): ?>
                                <div class="row g-2 mb-3">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $galleryPreviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $prev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="col-4 position-relative">
                                            <img src="<?php echo e($prev); ?>" class="img-thumbnail w-100" style="height:70px;object-fit:cover;">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle" 
                                                    wire:click="removeGalleryImage(<?php echo e($i); ?>)" style="width:22px;height:22px;padding:0;font-size:10px;">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            <input type="file" class="form-control" wire:model="galleryImages" accept="image/*" multiple>
                            <small class="text-muted">You can select multiple images</small>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-2" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="save">
                            <i class="bi bi-check-lg me-1"></i> <?php echo e($isEditing ? 'Update Product' : 'Create Product'); ?>

                        </span>
                        <span wire:loading wire:target="save">
                            <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                        </span>
                    </button>
                    <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .form-switch .form-check-input { width: 3em; height: 1.5em; cursor: pointer; }
    .ck-editor__editable { min-height: 400px; }
    .ck.ck-editor__main > .ck-editor__editable { min-height: 400px; }
    [x-cloak] { display: none !important; }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/products/product-form.blade.php ENDPATH**/ ?>