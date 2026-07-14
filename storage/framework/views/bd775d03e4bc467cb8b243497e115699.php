<div>
    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Team Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Team</li>
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
                        <i class="bi bi-people-fill display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($totalMembers); ?></h3>
                        <small>Total Members</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-person-check display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($activeMembers); ?></h3>
                        <small>Active</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-warning text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-star-fill display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($seniorMembers); ?></h3>
                        <small>Senior Members</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-graph-up display-6"></i>
                        <h3 class="mb-0 mt-1"><?php echo e($averageExperience); ?></h3>
                        <small>Avg Experience (Yrs)</small>
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
                            <input type="text" class="form-control" wire:model.blur="search" placeholder="Search members...">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search): ?>
                                <button class="btn btn-outline-secondary" wire:click="clearSearch">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
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
                        <label class="form-label small fw-semibold">Experience</label>
                        <select class="form-select" wire:model.blur="experienceFilter">
                            <option value="">All Levels</option>
                            <option value="senior">Senior (10+ yrs)</option>
                            <option value="mid">Mid (5-9 yrs)</option>
                            <option value="junior">Junior (< 5 yrs)</option>
                            <option value="fresher">Fresher</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Show</label>
                        <select class="form-select" wire:model.blur="perPage">
                            <option value="12">12</option>
                            <option value="24">24</option>
                            <option value="48">48</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3 text-end">
                        <button class="btn btn-outline-secondary me-1" wire:click="clearFilters" title="Clear Filters">
                            <i class="bi bi-funnel"></i>
                        </button>
                        <a href="<?php echo e(route('admin.team.create')); ?>" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Add Member
                        </a>
                    </div>
                </div>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedMembers) > 0): ?>
                <div class="mt-3 p-2 bg-light rounded d-flex align-items-center gap-2 flex-wrap">
                    <span class="fw-semibold me-2"><?php echo e(count($selectedMembers)); ?> selected</span>
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

        <!-- Team Grid -->
        <div class="row g-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card shadow-sm border-0 h-100 team-card">
                    <div class="card-body text-center p-3">
                        <!-- Checkbox -->
                        <div class="position-absolute top-0 start-0 m-2">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   <?php if(in_array($member->id, $selectedMembers)): echo 'checked'; endif; ?> 
                                   wire:click="toggleMemberSelection(<?php echo e($member->id); ?>)">
                        </div>
                        
                        <!-- Actions -->
                        <div class="position-absolute top-0 end-0 m-2">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-info btn-sm" 
                                        wire:click="viewMemberDetails(<?php echo e($member->id); ?>)" 
                                        title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <a href="<?php echo e(route('admin.team.edit', ['teamId' => $member->id])); ?>" 
                                   class="btn btn-primary btn-sm" 
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" 
                                        wire:click="confirmDelete(<?php echo e($member->id); ?>)" 
                                        title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Avatar -->
                        <img src="<?php echo e($member->image_url); ?>" 
                             class="rounded-circle mb-2 mt-3" 
                             style="width: 90px; height: 90px; object-fit: cover; border: 3px solid #0056b3;"
                             alt="<?php echo e($member->ot_name); ?>">
                        
                        <!-- Info -->
                        <h6 class="mb-1 fw-bold"><?php echo e(Str::limit($member->ot_name, 25)); ?></h6>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->ot_designation): ?>
                            <p class="text-muted small mb-2"><?php echo e(Str::limit($member->ot_designation, 30)); ?></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <!-- Experience Badge -->
                        <span class="badge bg-info bg-opacity-10 text-info mb-2">
                            <i class="bi bi-briefcase"></i> <?php echo e($member->experience_years); ?>

                        </span>
                        
                        <!-- Status Badge -->
                        <span class="badge bg-<?php echo e($member->is_active ? 'success' : 'danger'); ?> bg-opacity-10 text-<?php echo e($member->is_active ? 'success' : 'danger'); ?>">
                            <?php echo e($member->is_active ? 'Active' : 'Inactive'); ?>

                        </span>
                        
                        <!-- Skills -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($member->skills_list) > 0): ?>
                            <div class="mt-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = array_slice($member->skills_list, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <span class="badge bg-light text-dark me-1 mb-1"><?php echo e(Str::limit($skill, 15)); ?></span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($member->skills_list) > 3): ?>
                                    <span class="badge bg-secondary">+<?php echo e(count($member->skills_list) - 3); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <!-- Social Links -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->hasSocialLinks()): ?>
                            <div class="mt-2 d-flex justify-content-center gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->ot_fb): ?>
                                    <a href="<?php echo e($member->ot_fb); ?>" target="_blank" class="text-primary" title="Facebook">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->ot_inst): ?>
                                    <a href="<?php echo e($member->ot_inst); ?>" target="_blank" class="text-danger" title="Instagram">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->ot_twitter): ?>
                                    <a href="<?php echo e($member->ot_twitter); ?>" target="_blank" class="text-dark" title="Twitter">
                                        <i class="bi bi-twitter-x"></i>
                                    </a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->ot_linkedin): ?>
                                    <a href="<?php echo e($member->ot_linkedin); ?>" target="_blank" class="text-info" title="LinkedIn">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->ot_email): ?>
                                    <a href="mailto:<?php echo e($member->ot_email); ?>" class="text-secondary" title="Email">
                                        <i class="bi bi-envelope"></i>
                                    </a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <!-- Toggle Status -->
                        <div class="mt-2">
                            <button class="btn btn-sm btn-<?php echo e($member->is_active ? 'success' : 'secondary'); ?> w-100" 
                                    wire:click="toggleStatus(<?php echo e($member->id); ?>)">
                                <i class="bi bi-<?php echo e($member->is_active ? 'toggle-on' : 'toggle-off'); ?>"></i>
                                <?php echo e($member->is_active ? 'Active' : 'Inactive'); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-people display-1 text-muted d-block mb-3"></i>
                    <h4 class="text-muted">No team members found</h4>
                    <p class="text-muted">Start building your team by adding members</p>
                    <a href="<?php echo e(route('admin.team.create')); ?>" class="btn btn-primary btn-lg mt-2">
                        <i class="bi bi-plus-lg"></i> Add First Member
                    </a>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        
        <!-- Pagination -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($teamMembers->hasPages()): ?>
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Showing <?php echo e($teamMembers->firstItem()); ?> - <?php echo e($teamMembers->lastItem()); ?> of <?php echo e($teamMembers->total()); ?> members
                </small>
                <?php echo e($teamMembers->links()); ?>

            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- View Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showViewModal && $viewMember): ?>
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1055;" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-person-badge"></i> Member Details
                    </h5>
                    <button class="btn-close btn-close-white" wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-4 text-center">
                            <img src="<?php echo e($viewMember->image_url); ?>" 
                                 class="rounded-circle mb-3 shadow" 
                                 style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #0056b3;">
                            <h5 class="mb-1"><?php echo e($viewMember->ot_name); ?></h5>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewMember->ot_designation): ?>
                                <p class="text-muted"><?php echo e($viewMember->ot_designation); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <span class="badge bg-info"><?php echo e($viewMember->experience_years); ?> Experience</span>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewMember->hasSocialLinks()): ?>
                                <div class="mt-3 d-flex justify-content-center gap-3">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewMember->ot_fb): ?>
                                        <a href="<?php echo e($viewMember->ot_fb); ?>" target="_blank" class="fs-5 text-primary"><i class="bi bi-facebook"></i></a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewMember->ot_inst): ?>
                                        <a href="<?php echo e($viewMember->ot_inst); ?>" target="_blank" class="fs-5 text-danger"><i class="bi bi-instagram"></i></a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewMember->ot_twitter): ?>
                                        <a href="<?php echo e($viewMember->ot_twitter); ?>" target="_blank" class="fs-5 text-dark"><i class="bi bi-twitter-x"></i></a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewMember->ot_linkedin): ?>
                                        <a href="<?php echo e($viewMember->ot_linkedin); ?>" target="_blank" class="fs-5 text-info"><i class="bi bi-linkedin"></i></a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <h6 class="fw-bold">Bio</h6>
                            <p><?php echo e($viewMember->ot_description ?: 'No bio available.'); ?></p>
                            
                            <hr>
                            
                            <div class="row">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewMember->ot_email): ?>
                                <div class="col-6 mb-2">
                                    <strong><i class="bi bi-envelope"></i> Email:</strong><br>
                                    <a href="mailto:<?php echo e($viewMember->ot_email); ?>"><?php echo e($viewMember->ot_email); ?></a>
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewMember->ot_phone): ?>
                                <div class="col-6 mb-2">
                                    <strong><i class="bi bi-telephone"></i> Phone:</strong><br>
                                    <a href="tel:<?php echo e($viewMember->ot_phone); ?>"><?php echo e($viewMember->ot_phone); ?></a>
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($viewMember->skills_list) > 0): ?>
                                <hr>
                                <h6 class="fw-bold">Skills</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $viewMember->skills_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2"><?php echo e($skill); ?></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="closeModals">Close</button>
                    <a href="<?php echo e(route('admin.team.edit', $viewMember->id)); ?>" class="btn btn-primary">
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
                    <h5>Delete this team member?</h5>
                    <p class="text-muted">This action cannot be undone. All data will be permanently removed.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-secondary" wire:click="closeModals">Cancel</button>
                    <button class="btn btn-danger" wire:click="deleteMember">
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
    .team-card {
        transition: all 0.3s ease;
    }
    
    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        cursor: pointer;
    }
    
    .rounded-circle {
        transition: all 0.3s ease;
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/team/team-list.blade.php ENDPATH**/ ?>