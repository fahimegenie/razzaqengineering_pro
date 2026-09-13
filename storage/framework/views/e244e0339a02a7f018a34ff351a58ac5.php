<div x-data="dashboardHandler()" x-init="initCharts()">
    <!-- Loading State -->
    <div wire:loading 
        wire:target="refreshData, updatedPeriod" 
        class="position-fixed top-0 start-0 w-100 h-100 d-none align-items-center justify-content-center" 
        style="background: rgba(0,0,0,0.3); z-index: 99999; pointer-events: auto;"
        :class="{ 'd-flex': true }">
        <div class="bg-body p-4 rounded-3 shadow-lg text-center border border-secondary-subtle">
            <div class="spinner-border text-primary mb-2" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mb-0 fw-semibold">Refreshing dashboard...</p>
        </div>
    </div>

    <!-- Error State -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errorMessage): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
            <div>
                <strong>Error!</strong> <?php echo e($errorMessage); ?>

            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <div class="mt-2">
            <button wire:click="refreshData" class="btn btn-danger btn-sm">
                <i class="bi bi-arrow-clockwise me-1"></i> Retry
            </button>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Welcome Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white shadow-sm border-0 overflow-hidden">
                <div class="position-absolute end-0 top-0 opacity-10" style="font-size: 150px;">
                    <i class="bi bi-speedometer2"></i>
                </div>
                <div class="card-body p-4 position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="mb-2 fw-bold"><?php echo e($welcomeMessage); ?></h2>
                            <p class="mb-0 opacity-90">
                                Here's what's happening with your website today. 
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($newMessages) && $newMessages > 0): ?>
                                You have <strong class="text-warning"><?php echo e($newMessages); ?></strong> new messages
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($newQuotes) && $newQuotes > 0): ?>
                                and <strong class="text-warning"><?php echo e($newQuotes); ?></strong> pending quotes.
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </p>
                            <div class="mt-3 d-flex gap-3">
                                <small class="opacity-75">
                                    <i class="bi bi-clock"></i> Last refreshed: <?php echo e($lastRefreshed?->diffForHumans() ?? 'Never'); ?>

                                </small>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <button wire:click="refreshData" 
                                    wire:loading.attr="disabled"
                                    class="btn btn-light btn-lg rounded-pill px-4 shadow-sm">
                                <span wire:loading.remove wire:target="refreshData">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Refresh
                                </span>
                                <span wire:loading wire:target="refreshData">
                                    <span class="spinner-border spinner-border-sm me-1"></span> Loading...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Stats Bar -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-envelope text-primary fs-4"></i>
                    <h4 class="mb-0 mt-1 fw-bold"><?php echo e($todayStats['messages']); ?></h4>
                    <small class="text-muted">Today Messages</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-briefcase text-warning fs-4"></i>
                    <h4 class="mb-0 mt-1 fw-bold"><?php echo e($todayStats['projects']); ?></h4>
                    <small class="text-muted">Today Projects</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-person-plus text-success fs-4"></i>
                    <h4 class="mb-0 mt-1 fw-bold"><?php echo e($todayStats['users']); ?></h4>
                    <small class="text-muted">New Users</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-receipt text-danger fs-4"></i>
                    <h4 class="mb-0 mt-1 fw-bold"><?php echo e($todayStats['quotes']); ?></h4>
                    <small class="text-muted">New Quotes</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-pills mb-4" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link <?php echo e($activeTab === 'overview' ? 'active' : ''); ?>" 
                    wire:click="setTab('overview')" 
                    type="button">
                <i class="bi bi-grid me-1"></i> Overview
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link <?php echo e($activeTab === 'analytics' ? 'active' : ''); ?>" 
                    wire:click="setTab('analytics')" 
                    type="button">
                <i class="bi bi-graph-up me-1"></i> Analytics
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link <?php echo e($activeTab === 'recent' ? 'active' : ''); ?>" 
                    wire:click="setTab('recent')" 
                    type="button">
                <i class="bi bi-clock-history me-1"></i> Recent Activity
            </button>
        </li>
    </ul>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'overview'): ?>
    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="small-box text-bg-<?php echo e($stat['color']); ?> shadow-sm h-100 cursor-pointer"
                 @click="$wire.showStatDetail(<?php echo e($index); ?>)"
                 style="cursor: pointer;">
                <div class="inner">
                    <h3 class="fw-bold"><?php echo e($stat['value']); ?></h3>
                    <p class="mb-1"><?php echo e($stat['title']); ?></p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($stat['trend'])): ?>
                    <small class="text-<?php echo e($stat['trend_color']); ?>">
                        <i class="bi <?php echo e($stat['trend_icon']); ?>"></i> <?php echo e($stat['trend']); ?>

                    </small>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <i class="bi <?php echo e($stat['icon']); ?> small-box-icon opacity-25"></i>
                <a href="<?php echo e($stat['url']); ?>" 
                   class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Manage <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-lightning-charge text-warning me-2"></i>Quick Actions
                    </h3>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $quickActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <a href="<?php echo e($action['url']); ?>" 
                           class="btn btn-<?php echo e($action['color']); ?> rounded-pill">
                            <i class="bi <?php echo e($action['icon']); ?> me-1"></i> <?php echo e($action['label']); ?>

                        </a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'analytics'): ?>
    <!-- Charts Row -->
    <div class="row g-3 mb-4">
        <!-- Project Status -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-pie-chart me-2 text-primary"></i>Project Status
                    </h3>
                </div>
                <div class="card-body">
                    <div id="project-status-chart" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>
        
        <!-- Monthly Messages -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-graph-up me-2 text-success"></i>Monthly Messages
                    </h3>
                    <div class="btn-group btn-group-sm">
                        <button wire:click="$set('chartType', 'area')" 
                                class="btn btn-outline-secondary <?php echo e($chartType === 'area' ? 'active' : ''); ?>">
                            Area
                        </button>
                        <button wire:click="$set('chartType', 'bar')" 
                                class="btn btn-outline-secondary <?php echo e($chartType === 'bar' ? 'active' : ''); ?>">
                            Bar
                        </button>
                        <button wire:click="$set('chartType', 'line')" 
                                class="btn btn-outline-secondary <?php echo e($chartType === 'line' ? 'active' : ''); ?>">
                            Line
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <select wire:model.live="period" class="form-select form-select-sm w-auto">
                            <option value="6months">Last 6 Months</option>
                            <option value="12months">Last 12 Months</option>
                        </select>
                    </div>
                    <div id="monthly-messages-chart" style="min-height: 300px;"></div>
                </div>
            </div>
        </div>
        
        <!-- Services Chart -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-bar-chart me-2 text-info"></i>Service Details
                    </h3>
                </div>
                <div class="card-body">
                    <div id="services-chart" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>
        
        <!-- Blog Categories -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-diagram-3 me-2 text-warning"></i>Blog Categories
                    </h3>
                </div>
                <div class="card-body">
                    <div id="blog-categories-chart" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'recent'): ?>
    <!-- Recent Activity Tables -->
    <div class="row g-3">
        <!-- Recent Messages -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-envelope me-2 text-primary"></i>Recent Messages
                    </h3>
                    <a href="<?php echo e(route('admin.contacts.messages')); ?>" class="btn btn-sm btn-outline-primary rounded-pill">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <tr>
                                    <td class="fw-medium"><?php echo e($message->cm_name); ?></td>
                                    <td><?php echo e(Str::limit($message->cm_subject, 35)); ?></td>
                                    <td>
                                        <span class="badge rounded-pill bg-<?php echo e($message->cm_status === 'new' ? 'danger' : 
                                            ($message->cm_status === 'read' ? 'warning' : 'success')); ?>">
                                            <?php echo e(ucfirst($message->cm_status)); ?>

                                        </span>
                                    </td>
                                    <td><small class="text-muted"><?php echo e($message->created_at->diffForHumans()); ?></small></td>
                                </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                                        No messages yet
                                    </td>
                                </tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Projects -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-briefcase me-2 text-warning"></i>Recent Projects
                    </h3>
                    <a href="<?php echo e(route('admin.projects.index')); ?>" class="btn btn-sm btn-outline-warning rounded-pill">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Project</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <tr>
                                    <td class="fw-medium"><?php echo e($project->p_title); ?></td>
                                    <td><?php echo e($project->category->pc_name ?? 'N/A'); ?></td>
                                    <td>
                                        <span class="badge rounded-pill bg-<?php echo e($project->p_status === 'completed' ? 'success' : 
                                            ($project->p_status === 'in-progress' ? 'warning' : 'info')); ?>">
                                            <?php echo e(ucfirst($project->p_status)); ?>

                                        </span>
                                    </td>
                                    <td><small class="text-muted"><?php echo e($project->created_at->diffForHumans()); ?></small></td>
                                </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                                        No projects yet
                                    </td>
                                </tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Blog Posts -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-journal-text me-2 text-info"></i>Recent Blog Posts
                    </h3>
                    <a href="<?php echo e(route('admin.blog.posts.index')); ?>" class="btn btn-sm btn-outline-info rounded-pill">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentBlogPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <tr>
                                    <td class="fw-medium"><?php echo e(Str::limit($post->bp_title, 40)); ?></td>
                                    <td><?php echo e($post->category->bc_name ?? 'N/A'); ?></td>
                                    <td>
                                        <span class="badge rounded-pill bg-<?php echo e($post->bp_status === 'published' ? 'success' : 
                                            ($post->bp_status === 'draft' ? 'warning' : 'secondary')); ?>">
                                            <?php echo e(ucfirst($post->bp_status)); ?>

                                        </span>
                                    </td>
                                    <td><small class="text-muted"><?php echo e($post->created_at->diffForHumans()); ?></small></td>
                                </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                                        No posts yet
                                    </td>
                                </tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Quotes -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-receipt me-2 text-danger"></i>Recent Quotes
                    </h3>
                    <a href="<?php echo e(route('admin.quotes.index')); ?>" class="btn btn-sm btn-outline-danger rounded-pill">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Service</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentQuotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <tr>
                                    <td class="fw-medium"><?php echo e($quote->qr_name); ?></td>
                                    <td><?php echo e($quote->qr_service_type); ?></td>
                                    <td>
                                        <span class="badge rounded-pill bg-<?php echo e($quote->qr_status === 'pending' ? 'warning' : 
                                            ($quote->qr_status === 'completed' ? 'success' : 'secondary')); ?>">
                                            <?php echo e(ucfirst($quote->qr_status)); ?>

                                        </span>
                                    </td>
                                    <td><small class="text-muted"><?php echo e($quote->created_at->diffForHumans()); ?></small></td>
                                </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                                        No quotes yet
                                    </td>
                                </tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Stat Detail Modal -->
    <div class="modal fade" 
         id="statDetailModal" 
         tabindex="-1" 
         x-show="$wire.showDetailModal"
         x-ref="statModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-<?php echo e($selectedStat['color'] ?? 'primary'); ?> text-white">
                    <h5 class="modal-title">
                        <i class="bi <?php echo e($selectedStat['icon'] ?? 'bi-info-circle'); ?> me-2"></i>
                        <?php echo e($selectedStat['title'] ?? 'Detail'); ?>

                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeDetailModal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <h1 class="display-1 fw-bold text-<?php echo e($selectedStat['color'] ?? 'primary'); ?>">
                        <?php echo e($selectedStat['value'] ?? 0); ?>

                    </h1>
                    <p class="lead"><?php echo e($selectedStat['title'] ?? ''); ?></p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($selectedStat['trend'])): ?>
                    <p class="text-<?php echo e($selectedStat['trend_color'] ?? 'success'); ?>">
                        <i class="bi <?php echo e($selectedStat['trend_icon'] ?? 'bi-arrow-up'); ?>"></i>
                        <?php echo e($selectedStat['trend']); ?>

                    </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeDetailModal">Close</button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($selectedStat['url'])): ?>
                    <a href="<?php echo e($selectedStat['url']); ?>" class="btn btn-primary">Manage</a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function dashboardHandler() {
        return {
            charts: {},
            
            initCharts() {
                this.$nextTick(() => {
                    this.renderProjectChart();
                    this.renderMessagesChart();
                    this.renderServicesChart();
                    this.renderBlogChart();
                });
                
                // Listen for Livewire events
                Livewire.on('chart-updated', (data) => {
                    if (data.chart === 'monthlyMessages') {
                        this.renderMessagesChart();
                    }
                });
                
                Livewire.on('chart-type-changed', (data) => {
                    this.renderMessagesChart(data.type);
                });
                
                // Re-render on tab change
                this.$watch('$wire.activeTab', (value) => {
                    if (value === 'analytics') {
                        this.$nextTick(() => {
                            this.renderAllCharts();
                        });
                    }
                });
            },
            
            renderAllCharts() {
                this.renderProjectChart();
                this.renderMessagesChart();
                this.renderServicesChart();
                this.renderBlogChart();
            },
            
            renderProjectChart() {
                const el = document.querySelector('#project-status-chart');
                if (!el) return;
                
                if (this.charts.project) {
                    this.charts.project.destroy();
                }
                
                const data = <?php echo json_encode($projectStatusChart, 15, 512) ?>;
                
                this.charts.project = new ApexCharts(el, {
                    series: data.series,
                    chart: { type: 'donut', height: 350 },
                    labels: data.labels,
                    colors: data.colors,
                    legend: { position: 'bottom' },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '60%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'Total',
                                        formatter: (w) => w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                    }
                                }
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: { height: 300 },
                            legend: { position: 'bottom' }
                        }
                    }]
                });
                
                this.charts.project.render();
            },
            
            renderMessagesChart(type = null) {
                const el = document.querySelector('#monthly-messages-chart');
                if (!el) return;
                
                if (this.charts.messages) {
                    this.charts.messages.destroy();
                }
                
                const chartType = type || <?php echo json_encode($chartType, 15, 512) ?>;
                const data = <?php echo json_encode($monthlyMessagesChart, 15, 512) ?>;
                
                const options = {
                    series: data.series,
                    chart: { 
                        type: chartType, 
                        height: 300, 
                        toolbar: { show: false } 
                    },
                    dataLabels: { enabled: false },
                    stroke: { curve: 'smooth', width: 3 },
                    xaxis: { categories: data.categories },
                    colors: ['#0d6efd'],
                };
                
                if (chartType === 'area') {
                    options.fill = {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.1,
                        }
                    };
                }
                
                this.charts.messages = new ApexCharts(el, options);
                this.charts.messages.render();
            },
            
            renderServicesChart() {
                const el = document.querySelector('#services-chart');
                if (!el) return;
                
                if (this.charts.services) {
                    this.charts.services.destroy();
                }
                
                const data = <?php echo json_encode($servicesChart, 15, 512) ?>;
                
                this.charts.services = new ApexCharts(el, {
                    series: data.series,
                    chart: { type: 'bar', height: 350, toolbar: { show: false } },
                    plotOptions: { bar: { borderRadius: 4, horizontal: false } },
                    dataLabels: { enabled: false },
                    xaxis: { categories: data.categories },
                    colors: ['#20c997'],
                    fill: { opacity: 0.8 }
                });
                
                this.charts.services.render();
            },
            
            renderBlogChart() {
                const el = document.querySelector('#blog-categories-chart');
                if (!el) return;
                
                if (this.charts.blog) {
                    this.charts.blog.destroy();
                }
                
                const data = <?php echo json_encode($blogCategoriesChart, 15, 512) ?>;
                
                this.charts.blog = new ApexCharts(el, {
                    series: data.series,
                    chart: { type: 'polarArea', height: 350 },
                    labels: data.labels,
                    stroke: { colors: ['#fff'] },
                    fill: { opacity: 0.8 },
                    legend: { position: 'bottom' },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: { height: 300 },
                            legend: { position: 'bottom' }
                        }
                    }]
                });
                
                this.charts.blog.render();
            }
        }
    }
</script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/dashboard/dashboard.blade.php ENDPATH**/ ?>