<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3">Blog Posts</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Blog Posts</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Stats -->
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body text-center py-3"><i class="bi bi-file-text display-6"></i><h3 class="mb-0 mt-1"><?php echo e($totalPosts); ?></h3><small>Total Posts</small></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center py-3"><i class="bi bi-check-circle display-6"></i><h3 class="mb-0 mt-1"><?php echo e($publishedPosts); ?></h3><small>Published</small></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-warning text-white">
                    <div class="card-body text-center py-3"><i class="bi bi-pencil-square display-6"></i><h3 class="mb-0 mt-1"><?php echo e($draftPosts); ?></h3><small>Drafts</small></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body text-center py-3"><i class="bi bi-eye display-6"></i><h3 class="mb-0 mt-1"><?php echo e(number_format($totalViews)); ?></h3><small>Total Views</small></div>
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
                            <input type="text" class="form-control" wire:model.blur="search" placeholder="Search posts...">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search): ?><button class="btn btn-outline-secondary" wire:click="clearSearch"><i class="bi bi-x-lg"></i></button><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Status</label>
                        <select class="form-select" wire:model.blur="statusFilter">
                            <option value="">All</option><option value="published">Published</option><option value="draft">Draft</option><option value="scheduled">Scheduled</option><option value="archived">Archived</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Category</label>
                        <select class="form-select" wire:model.blur="categoryFilter">
                            <option value="">All</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><option value="<?php echo e($cat->id); ?>"><?php echo e($cat->bc_name); ?></option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Featured</label>
                        <select class="form-select" wire:model.blur="featuredFilter">
                            <option value="">All</option><option value="1">Featured</option><option value="0">Not Featured</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3 text-end">
                        <button class="btn btn-outline-secondary me-1" wire:click="clearFilters"><i class="bi bi-funnel"></i></button>
                        <a href="<?php echo e(route('admin.blog.posts.create')); ?>" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> New Post</a>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedPosts) > 0): ?>
                <div class="mt-3 p-2 bg-light rounded d-flex align-items-center gap-2 flex-wrap">
                    <span class="fw-semibold me-2"><?php echo e(count($selectedPosts)); ?> selected</span>
                    <button class="btn btn-sm btn-success" wire:click="bulkPublish"><i class="bi bi-cloud-upload"></i> Publish</button>
                    <button class="btn btn-sm btn-danger" wire:click="bulkDelete"><i class="bi bi-trash"></i> Delete</button>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <!-- Posts Table -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="40"><input type="checkbox" class="form-check-input" <?php if($selectAll): echo 'checked'; endif; ?> wire:click="toggleSelectAll"></th>
                                <th width="70">Image</th>
                                <th wire:click="sortBy('bp_title')" style="cursor:pointer;">Title <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sortField==='bp_title'): ?><i class="bi bi-arrow-<?php echo e($sortDirection==='asc'?'up':'down'); ?>"></i><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></th>
                                <th>Category</th>
                                <th>Author</th>
                                <th width="80">Status</th>
                                <th width="70">Views</th>
                                <th width="70">Comments</th>
                                <th width="100">Date</th>
                                <th width="170">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr>
                                <td><input type="checkbox" class="form-check-input" <?php if(in_array($post->id, $selectedPosts)): echo 'checked'; endif; ?> wire:click="togglePostSelection(<?php echo e($post->id); ?>)"></td>
                                <td><img src="<?php echo e($post->image_url); ?>" class="rounded" style="width:50px;height:40px;object-fit:cover;"></td>
                                <td>
                                    <strong><?php echo e(Str::limit($post->bp_title, 50)); ?></strong>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->is_featured): ?><span class="badge bg-warning ms-1"><i class="bi bi-star-fill"></i></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->is_trending): ?><span class="badge bg-danger ms-1"><i class="bi bi-fire"></i></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <td><span class="badge" style="background-color: <?php echo e($post->category->bc_color ?? '#6c757d'); ?>20; color: <?php echo e($post->category->bc_color ?? '#6c757d'); ?>;"><?php echo e($post->category->bc_name ?? 'N/A'); ?></span></td>
                                <td><small><?php echo e($post->author->name ?? 'N/A'); ?></small></td>
                                <td>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->bp_status === 'published'): ?><span class="badge bg-success">Published</span>
                                    <?php elseif($post->bp_status === 'draft'): ?><span class="badge bg-secondary">Draft</span>
                                    <?php elseif($post->bp_status === 'scheduled'): ?><span class="badge bg-info">Scheduled</span>
                                    <?php else: ?><span class="badge bg-dark">Archived</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <td><small><?php echo e(number_format($post->views_count)); ?></small></td>
                                <td><span class="badge bg-info"><?php echo e($post->comments_count); ?></span></td>
                                <td><small><?php echo e($post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y')); ?></small></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-info" wire:click="viewPostDetails(<?php echo e($post->id); ?>)" title="View"><i class="bi bi-eye"></i></button>
                                        <a href="<?php echo e(route('admin.blog.posts.edit', ['postId' => $post->id])); ?>" class="btn btn-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-<?php echo e($post->is_featured ? 'warning' : 'outline-warning'); ?>" wire:click="toggleFeatured(<?php echo e($post->id); ?>)" title="Featured"><i class="bi bi-star"></i></button>
                                        <button class="btn btn-<?php echo e($post->is_trending ? 'danger' : 'outline-danger'); ?>" wire:click="toggleTrending(<?php echo e($post->id); ?>)" title="Trending"><i class="bi bi-fire"></i></button>
                                        <button class="btn btn-danger" wire:click="confirmDelete(<?php echo e($post->id); ?>)" title="Delete"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <tr><td colspan="10" class="text-center py-5">
                                <i class="bi bi-journal-text display-4 text-muted d-block mb-2"></i>
                                <h5>No posts found</h5>
                                <a href="<?php echo e(route('admin.blog.posts.create')); ?>" class="btn btn-primary mt-2"><i class="bi bi-plus-lg"></i> Create First Post</a>
                            </td></tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($posts->hasPages()): ?>
            <div class="card-footer d-flex justify-content-between">
                <small>Showing <?php echo e($posts->firstItem()); ?>-<?php echo e($posts->lastItem()); ?> of <?php echo e($posts->total()); ?></small>
                <?php echo e($posts->links()); ?>

            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- View Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showViewModal && $viewPost): ?>
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;">
        <div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content">
            <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="bi bi-eye"></i> Post Details</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-5">
                        <img src="<?php echo e($viewPost->image_url); ?>" class="img-fluid rounded mb-3">
                        <div class="d-flex gap-2 flex-wrap mb-2">
                            <span class="badge bg-primary"><?php echo e($viewPost->category->bc_name ?? 'N/A'); ?></span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $viewPost->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><span class="badge bg-secondary"><?php echo e($tag->bt_name); ?></span><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        <p><strong>Author:</strong> <?php echo e($viewPost->author->name ?? 'N/A'); ?></p>
                        <p><strong>Status:</strong> <?php echo e(ucfirst($viewPost->bp_status)); ?></p>
                        <p><strong>Views:</strong> <?php echo e(number_format($viewPost->views_count)); ?></p>
                        <p><strong>Reading Time:</strong> <?php echo e($viewPost->reading_time); ?> min</p>
                    </div>
                    <div class="col-md-7">
                        <h4><?php echo e($viewPost->bp_title); ?></h4>
                        <p class="text-muted"><?php echo e($viewPost->bp_excerpt); ?></p>
                        <hr>
                        <div style="max-height:300px;overflow-y:auto;"><?php echo Str::limit(strip_tags($viewPost->bp_content), 500); ?></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" wire:click="closeModals">Close</button><a href="<?php echo e(route('admin.blog.posts.edit', $viewPost->id)); ?>" class="btn btn-primary"><i class="bi bi-pencil"></i> Edit</a></div>
        </div></div></div><div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Delete Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showDeleteModal): ?>
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;">
        <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirm Delete</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div>
            <div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this post?</h5><p class="text-muted">This cannot be undone.</p></div>
            <div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deletePost"><i class="bi bi-trash"></i> Yes, Delete</button></div>
        </div></div></div><div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<?php $__env->startPush('styles'); ?>
<style>
.form-switch .form-check-input { width: 3em; height: 1.5em; cursor: pointer; }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/blog/post-list.blade.php ENDPATH**/ ?>