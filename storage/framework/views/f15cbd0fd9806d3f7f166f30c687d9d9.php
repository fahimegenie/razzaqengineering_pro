<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3">Quote Requests</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li><li class="breadcrumb-item active">Quote Requests</li></ol></div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-primary text-white"><div class="card-body text-center py-3"><i class="bi bi-envelope display-6"></i><h3 class="mb-0 mt-1"><?php echo e($totalQuotes); ?></h3><small>Total</small></div></div></div>
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-warning text-white"><div class="card-body text-center py-3"><i class="bi bi-clock display-6"></i><h3 class="mb-0 mt-1"><?php echo e($pendingQuotes); ?></h3><small>Pending</small></div></div></div>
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-info text-white"><div class="card-body text-center py-3"><i class="bi bi-calendar-check display-6"></i><h3 class="mb-0 mt-1"><?php echo e($todayQuotes); ?></h3><small>Today</small></div></div></div>
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-success text-white"><div class="card-body text-center py-3"><i class="bi bi-check-circle display-6"></i><h3 class="mb-0 mt-1"><?php echo e($completedQuotes); ?></h3><small>Completed</small></div></div></div>
        </div>

        
        <div class="card shadow-sm border-0 mb-3"><div class="card-body"><div class="row g-2 align-items-end">
            <div class="col-md-3"><div class="input-group"><span class="input-group-text"><i class="bi bi-search"></i></span><input type="text" class="form-control" wire:model.blur="search" placeholder="Search..."><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search): ?><button class="btn btn-outline-secondary" wire:click="clearSearch"><i class="bi bi-x-lg"></i></button><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div></div>
            <div class="col-6 col-md-2"><select class="form-select" wire:model.blur="statusFilter"><option value="">All Status</option><option value="pending">Pending</option><option value="contacted">Contacted</option><option value="completed">Completed</option><option value="cancelled">Cancelled</option></select></div>
            <div class="col-6 col-md-2"><select class="form-select" wire:model.blur="serviceFilter"><option value="">All Services</option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $serviceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><option value="<?php echo e($t); ?>"><?php echo e($t); ?></option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></select></div>
            <div class="col-6 col-md-2"><select class="form-select" wire:model.blur="dateFilter"><option value="">All Time</option><option value="today">Today</option><option value="week">This Week</option><option value="month">This Month</option></select></div>
            <div class="col-6 col-md-3 text-end"><button class="btn btn-outline-secondary me-1" wire:click="clearFilters"><i class="bi bi-funnel"></i></button><a href="<?php echo e(route('admin.quotes.create')); ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Quote</a></div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedQuotes)>0): ?><div class="mt-3 p-2 bg-light rounded d-flex gap-2 flex-wrap"><span class="fw-semibold"><?php echo e(count($selectedQuotes)); ?> selected</span><button class="btn btn-sm btn-info" wire:click="bulkMarkContacted"><i class="bi bi-telephone"></i> Contacted</button><button class="btn btn-sm btn-success" wire:click="bulkMarkCompleted"><i class="bi bi-check-circle"></i> Completed</button><button class="btn btn-sm btn-danger" wire:click="bulkDelete"><i class="bi bi-trash"></i> Delete</button></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div></div>

        
        <div class="card shadow-sm border-0"><div class="table-responsive"><table class="table table-hover mb-0"><thead class="table-light"><tr>
            <th width="40"><input type="checkbox" class="form-check-input" <?php if($selectAll): echo 'checked'; endif; ?> wire:click="toggleSelectAll"></th>
            <th>Client</th><th>Service</th><th>Location</th><th>Budget</th>
            <th wire:click="sortBy('qr_status')" style="cursor:pointer;">Status <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sortField==='qr_status'): ?><i class="bi bi-arrow-<?php echo e($sortDirection==='asc'?'up':'down'); ?>"></i><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></th>
            <th wire:click="sortBy('created_at')" style="cursor:pointer;">Date <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sortField==='created_at'): ?><i class="bi bi-arrow-<?php echo e($sortDirection==='asc'?'up':'down'); ?>"></i><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></th>
            <th width="180">Actions</th>
        </tr></thead><tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <tr>
                <td><input type="checkbox" class="form-check-input" <?php if(in_array($q->id, $selectedQuotes)): echo 'checked'; endif; ?> wire:click="toggleQuoteSelection(<?php echo e($q->id); ?>)"></td>
                <td>
                    <strong><?php echo e($q->qr_name); ?></strong><br>
                    <small class="text-muted"><?php echo e($q->qr_email); ?></small><br>
                    <small><?php echo e($q->qr_phone); ?></small>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($q->qr_company): ?><br><small class="text-muted"><?php echo e($q->qr_company); ?></small><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </td>
                <td><span class="badge bg-primary"><?php echo e($q->qr_service_type); ?></span></td>
                <td><?php echo e($q->qr_location ?: '—'); ?></td>
                <td><?php echo e($q->formatted_budget); ?></td>
                <td><?php echo $q->status_badge; ?></td>
                <td><small><?php echo e($q->created_at->format('M d, Y')); ?><br><?php echo e($q->created_at->format('h:i A')); ?></small></td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-info" wire:click="viewQuoteDetails(<?php echo e($q->id); ?>)" title="View"><i class="bi bi-eye"></i></button>
                        <a href="<?php echo e(route('admin.quotes.edit', $q->id)); ?>" class="btn btn-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                        <button class="btn btn-warning" wire:click="openStatusModal(<?php echo e($q->id); ?>)" title="Change Status"><i class="bi bi-arrow-repeat"></i></button>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($q->qr_status === 'pending'): ?><button class="btn btn-info" wire:click="markAsContacted(<?php echo e($q->id); ?>)" title="Mark Contacted"><i class="bi bi-telephone"></i></button><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <button class="btn btn-danger" wire:click="confirmDelete(<?php echo e($q->id); ?>)" title="Delete"><i class="bi bi-trash"></i></button>
                    </div>
                </td>
            </tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <tr><td colspan="8" class="text-center py-5"><i class="bi bi-envelope-open display-4 text-muted d-block"></i><h5>No quote requests found</h5><a href="<?php echo e(route('admin.quotes.create')); ?>" class="btn btn-primary mt-2"><i class="bi bi-plus-lg"></i> Add Quote</a></td></tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody></table></div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($quotes->hasPages()): ?><div class="card-footer d-flex justify-content-between"><small>Showing <?php echo e($quotes->firstItem()); ?>-<?php echo e($quotes->lastItem()); ?> of <?php echo e($quotes->total()); ?></small><?php echo e($quotes->links()); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showViewModal && $viewQuote): ?>
    <div class="modal fade show d-block" style="background:rgba(0,0,0,.5);z-index:1055;"><div class="modal-dialog modal-lg"><div class="modal-content">
        <div class="modal-header bg-primary text-white"><h5><i class="bi bi-eye"></i> Quote Details</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div>
        <div class="modal-body"><div class="row g-3">
            <div class="col-md-6">
                <h6>Client Information</h6>
                <p><strong>Name:</strong> <?php echo e($viewQuote->qr_name); ?></p>
                <p><strong>Email:</strong> <a href="mailto:<?php echo e($viewQuote->qr_email); ?>"><?php echo e($viewQuote->qr_email); ?></a></p>
                <p><strong>Phone:</strong> <a href="tel:<?php echo e($viewQuote->qr_phone); ?>"><?php echo e($viewQuote->qr_phone); ?></a></p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewQuote->qr_company): ?><p><strong>Company:</strong> <?php echo e($viewQuote->qr_company); ?></p><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <p><strong>Source:</strong> <?php echo e(ucfirst($viewQuote->qr_source)); ?></p>
            </div>
            <div class="col-md-6">
                <h6>Request Details</h6>
                <p><strong>Service:</strong> <?php echo e($viewQuote->qr_service_type); ?></p>
                <p><strong>Location:</strong> <?php echo e($viewQuote->qr_location); ?></p>
                <p><strong>Budget:</strong> <?php echo e($viewQuote->formatted_budget); ?></p>
                <p><strong>Timeline:</strong> <?php echo e($viewQuote->qr_timeline ?: 'N/A'); ?></p>
                <p><strong>Status:</strong> <?php echo $viewQuote->status_badge; ?></p>
            </div>
            <div class="col-12"><h6>Details</h6><p><?php echo e($viewQuote->qr_details); ?></p></div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewQuote->qr_admin_notes): ?><div class="col-12"><h6>Admin Notes</h6><p class="text-muted"><?php echo e($viewQuote->qr_admin_notes); ?></p></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewQuote->attachment_url): ?><div class="col-12"><a href="<?php echo e($viewQuote->attachment_url); ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-paperclip"></i> View Attachment</a></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div></div>
        <div class="modal-footer"><button class="btn btn-secondary" wire:click="closeModals">Close</button><a href="<?php echo e(route('admin.quotes.edit', $viewQuote->id)); ?>" class="btn btn-primary"><i class="bi bi-pencil"></i> Edit</a></div>
    </div></div></div><div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showStatusModal): ?>
    <div class="modal fade show d-block" style="background:rgba(0,0,0,.5);z-index:1055;"><div class="modal-dialog"><div class="modal-content">
        <div class="modal-header bg-warning text-white"><h5><i class="bi bi-arrow-repeat"></i> Update Status</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Status</label><select class="form-select" wire:model="newStatus"><option value="pending">Pending</option><option value="contacted">Contacted</option><option value="completed">Completed</option><option value="cancelled">Cancelled</option></select></div>
            <div class="mb-3"><label class="form-label">Admin Notes</label><textarea class="form-control" rows="3" wire:model="adminNotes" placeholder="Add notes..."></textarea></div>
        </div>
        <div class="modal-footer"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-primary" wire:click="updateStatus">Update</button></div>
    </div></div></div><div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showDeleteModal): ?>
    <div class="modal fade show d-block" style="background:rgba(0,0,0,.5);z-index:1055;"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5><i class="bi bi-exclamation-triangle"></i> Confirm Delete</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div><div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this quote?</h5></div><div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deleteQuote">Delete</button></div></div></div></div><div class="modal-backdrop fade show"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<?php $__env->startPush('styles'); ?>
<style>.form-switch .form-check-input{width:3em;height:1.5em;cursor:pointer}</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/quotes/quote-list.blade.php ENDPATH**/ ?>