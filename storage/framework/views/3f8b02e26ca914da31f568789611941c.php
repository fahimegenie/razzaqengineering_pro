<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body shadow-sm">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav align-items-center">
            <li class="nav-item">
                <a class="nav-link btn-sidebar-toggle" 
                   href="#" 
                   role="button" 
                   aria-label="Toggle sidebar"
                   @click.prevent="toggleSidebar()">
                    <i class="bi bi-list fs-5"></i>
                </a>
            </li>
            
            <li class="nav-item d-none d-md-block">
                <a class="nav-link" href="<?php echo e(url('/')); ?>" target="_blank" title="View Website">
                    <i class="bi bi-box-arrow-up-right me-1"></i>
                    <span class="d-none d-lg-inline">View Site</span>
                </a>
            </li>
            
            <!-- Search (Desktop) -->
            <li class="nav-item d-none d-lg-block ms-3">
                <form class="d-flex" role="search" @submit.prevent>
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input class="form-control border-start-0" 
                               type="search" 
                               placeholder="Search..." 
                               aria-label="Search"
                               x-model="searchQuery">
                    </div>
                </form>
            </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto align-items-center">
            
            <?php
                // Get counts
                $newMessagesCount = \App\Models\ContactMessage::where('cm_status', 'new')->count();
                $newQuotesCount = \App\Models\QuoteRequest::where('qr_status', 'pending')->count();
                $recentMessages = \App\Models\ContactMessage::where('cm_status', 'new')
                    ->latest()->take(3)->get();
            ?>
            
            <!-- Messages Dropdown -->
            <li class="nav-item dropdown me-1">
                <a class="nav-link position-relative" 
                   data-bs-toggle="dropdown" 
                   href="#" 
                   aria-label="Messages">
                    <i class="bi bi-chat-text fs-5"></i>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($newMessagesCount > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">
                        <?php echo e($newMessagesCount > 99 ? '99+' : $newMessagesCount); ?>

                        <span class="visually-hidden">unread messages</span>
                    </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow">
                    <div class="dropdown-header d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Messages</span>
                        <span class="badge bg-primary rounded-pill"><?php echo e($newMessagesCount); ?> New</span>
                    </div>
                    <div class="dropdown-divider"></div>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <a href="<?php echo e(url('admin.contacts.messages')); ?>" class="dropdown-item">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="avatar avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 40px; height: 40px;">
                                    <span class="text-white fw-bold"><?php echo e(strtoupper(substr($msg->cm_name, 0, 1))); ?></span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3" style="min-width: 0;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 text-truncate" style="max-width: 150px;"><?php echo e($msg->cm_name); ?></h6>
                                    <small class="text-muted"><?php echo e($msg->created_at->diffForHumans()); ?></small>
                                </div>
                                <p class="mb-0 text-muted text-truncate" style="max-width: 200px; font-size: 0.8rem;">
                                    <?php echo e($msg->cm_subject ?? 'No subject'); ?>

                                </p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="text-center py-3 text-muted">
                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                        No new messages
                    </div>
                    <div class="dropdown-divider"></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                    <a href="<?php echo e(url('admin.contacts.messages')); ?>" class="dropdown-item text-center text-primary fw-bold">
                        View All Messages
                    </a>
                </div>
            </li>

            <!-- Notifications Dropdown -->
            <li class="nav-item dropdown me-1">
                <a class="nav-link position-relative" 
                   data-bs-toggle="dropdown" 
                   href="#" 
                   aria-label="Notifications">
                    <i class="bi bi-bell fs-5"></i>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($newQuotesCount > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning" style="font-size: 0.65rem;">
                        <?php echo e($newQuotesCount > 99 ? '99+' : $newQuotesCount); ?>

                        <span class="visually-hidden">notifications</span>
                    </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow">
                    <div class="dropdown-header d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Notifications</span>
                        <span class="badge bg-warning rounded-pill"><?php echo e($newQuotesCount); ?> New</span>
                    </div>
                    <div class="dropdown-divider"></div>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($newQuotesCount > 0): ?>
                    <a href="<?php echo e(route('admin.quotes.index')); ?>" class="dropdown-item">
                        <i class="bi bi-receipt text-warning me-2"></i>
                        <?php echo e($newQuotesCount); ?> new quote request(s)
                    </a>
                    <div class="dropdown-divider"></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                    <div class="text-center py-2">
                        <small class="text-muted">No more notifications</small>
                    </div>
                    <div class="dropdown-divider"></div>
                    
                    <a href="#" class="dropdown-item text-center text-primary fw-bold">
                        View All Notifications
                    </a>
                </div>
            </li>

            <!-- Fullscreen Toggle -->
            <li class="nav-item me-1">
                <a class="nav-link" 
                   href="#" 
                   @click.prevent="fullscreen()"
                   aria-label="Toggle fullscreen"
                   title="Fullscreen">
                    <i class="bi bi-arrows-fullscreen fs-5"></i>
                </a>
            </li>

            <!-- Color Mode Toggle -->
            <li class="nav-item dropdown me-1">
                <a class="nav-link" 
                   href="#" 
                   data-bs-toggle="dropdown" 
                   aria-expanded="false"
                   aria-label="Toggle theme"
                   title="Change theme">
                    <i class="bi bi-sun-fill fs-5" x-show="theme === 'light'"></i>
                    <i class="bi bi-moon-fill fs-5" x-show="theme === 'dark'"></i>
                    <i class="bi bi-circle-half fs-5" x-show="theme === 'auto'"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" style="--bs-dropdown-min-width: 9rem;">
                    <li>
                        <button type="button" 
                                class="dropdown-item d-flex align-items-center gap-2" 
                                @click="setTheme('light')"
                                :class="{ 'active fw-bold': theme === 'light' }">
                            <i class="bi bi-sun-fill text-warning"></i> Light
                            <i class="bi bi-check-lg ms-auto" x-show="theme === 'light'"></i>
                        </button>
                    </li>
                    <li>
                        <button type="button" 
                                class="dropdown-item d-flex align-items-center gap-2" 
                                @click="setTheme('dark')"
                                :class="{ 'active fw-bold': theme === 'dark' }">
                            <i class="bi bi-moon-fill text-info"></i> Dark
                            <i class="bi bi-check-lg ms-auto" x-show="theme === 'dark'"></i>
                        </button>
                    </li>
                    <li>
                        <button type="button" 
                                class="dropdown-item d-flex align-items-center gap-2" 
                                @click="setTheme('auto')"
                                :class="{ 'active fw-bold': theme === 'auto' }">
                            <i class="bi bi-circle-half text-success"></i> Auto
                            <i class="bi bi-check-lg ms-auto" x-show="theme === 'auto'"></i>
                        </button>
                    </li>
                </ul>
            </li>

            <!-- User Menu Dropdown -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                    <img src="<?php echo e(Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('admin_assets/assets/img/default-avatar.png')); ?>" 
                         class="user-image rounded-circle shadow-sm" 
                         alt="<?php echo e(Auth::user()->name); ?>"
                         style="width: 32px; height: 32px; object-fit: cover;">
                    <span class="d-none d-md-inline fw-medium"><?php echo e(Auth::user()->name); ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow">
                    <!-- User Header -->
                    <li class="user-header text-bg-primary rounded-top">
                        <img src="<?php echo e(Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('admin_assets/assets/img/default-avatar.png')); ?>" 
                             class="rounded-circle shadow mb-2" 
                             alt="<?php echo e(Auth::user()->name); ?>"
                             style="width: 80px; height: 80px; object-fit: cover;">
                        <p class="mb-0">
                            <strong><?php echo e(Auth::user()->name); ?></strong>
                            <small class="d-block opacity-75"><?php echo e(Auth::user()->email); ?></small>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->designation): ?>
                            <small class="d-block opacity-75"><?php echo e(Auth::user()->designation); ?></small>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <small class="d-block opacity-75">Member since <?php echo e(Auth::user()->created_at->format('M Y')); ?></small>
                        </p>
                    </li>
                    
                    <!-- User Body -->
                    <li class="user-body border-bottom">
                        <div class="row g-0 text-center">
                            <div class="col-4">
                                <a href="<?php echo e(url('admin.users.index')); ?>" class="d-block py-1 text-decoration-none">
                                    <small class="d-block fw-bold"><?php echo e(\App\Models\User::count()); ?></small>
                                    <small class="text-muted">Users</small>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="<?php echo e(route('admin.projects.index')); ?>" class="d-block py-1 text-decoration-none">
                                    <small class="d-block fw-bold"><?php echo e(\App\Models\Project::count()); ?></small>
                                    <small class="text-muted">Projects</small>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="<?php echo e(route('admin.services.index')); ?>" class="d-block py-1 text-decoration-none">
                                    <small class="d-block fw-bold"><?php echo e(\App\Models\OurService::count()); ?></small>
                                    <small class="text-muted">Services</small>
                                </a>
                            </div>
                        </div>
                    </li>
                    
                    <!-- User Footer -->
                    <li class="user-footer d-flex gap-2 p-3">
                        <a href="<?php echo e(route('admin.settings.index')); ?>" class="btn btn-outline-secondary btn-sm flex-grow-1">
                            <i class="bi bi-gear me-1"></i> Settings
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm flex-grow-1" @click.prevent="confirmLogout()">
                            <i class="bi bi-box-arrow-right me-1"></i> Sign out
                        </a>
                        <form id="logout-form" action="<?php echo e(url('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                </ul>
            </li>
            <?php else: ?>
            <li class="nav-item">
                <a href="<?php echo e(route('login')); ?>" class="nav-link">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                </a>
            </li>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
<!--end::Header--><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/layouts/admin/partials/header.blade.php ENDPATH**/ ?>