<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" 
      x-data="adminApp()" 
      x-init="initialize()"
      class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="color-scheme" content="light dark">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)">
    <meta name="robots" content="noindex, nofollow">
    
    <title><?php if (! empty(trim($__env->yieldContent('title')))): ?><?php echo $__env->yieldContent('title'); ?> | <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><?php echo e(config('app.name', 'Razzaq Engineering')); ?> Admin</title>

    <!-- Theme Init (prevents flash) -->
    <script>
        (() => {
            'use strict';
            const STORAGE_KEY = 'lte-theme';
            let stored = null;
            try { stored = localStorage.getItem(STORAGE_KEY); } catch {}
            const prefersDark = globalThis.matchMedia('(prefers-color-scheme: dark)').matches;
            let resolved = 'light';
            if (stored === 'dark' || stored === 'light') resolved = stored;
            else if (prefersDark) resolved = 'dark';
            document.documentElement.setAttribute('data-bs-theme', resolved);
            document.documentElement.style.colorScheme = resolved;
            
            const sidebarState = localStorage.getItem('sidebar-state');
            if (sidebarState === 'collapsed') {
                document.documentElement.classList.add('sidebar-collapse');
            }
        })();
    </script>
    <?php if (isset($component)) { $__componentOriginald81336f60b95f89954c7bed7bfe0a27a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald81336f60b95f89954c7bed7bfe0a27a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin.partials.styles','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin.partials.styles'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald81336f60b95f89954c7bed7bfe0a27a)): ?>
<?php $attributes = $__attributesOriginald81336f60b95f89954c7bed7bfe0a27a; ?>
<?php unset($__attributesOriginald81336f60b95f89954c7bed7bfe0a27a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald81336f60b95f89954c7bed7bfe0a27a)): ?>
<?php $component = $__componentOriginald81336f60b95f89954c7bed7bfe0a27a; ?>
<?php unset($__componentOriginald81336f60b95f89954c7bed7bfe0a27a); ?>
<?php endif; ?>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary" 
      :class="{
          'sidebar-collapse': sidebarCollapsed,
          'sidebar-mini': sidebarMini && !sidebarCollapsed,
          'layout-top-nav': topNav
      }">
    
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        
        <!--begin::Header-->
        <?php if (isset($component)) { $__componentOriginal37a21fcc73b7a9c58f88171845752059 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal37a21fcc73b7a9c58f88171845752059 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin.partials.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin.partials.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal37a21fcc73b7a9c58f88171845752059)): ?>
<?php $attributes = $__attributesOriginal37a21fcc73b7a9c58f88171845752059; ?>
<?php unset($__attributesOriginal37a21fcc73b7a9c58f88171845752059); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal37a21fcc73b7a9c58f88171845752059)): ?>
<?php $component = $__componentOriginal37a21fcc73b7a9c58f88171845752059; ?>
<?php unset($__componentOriginal37a21fcc73b7a9c58f88171845752059); ?>
<?php endif; ?>
        <!--end::Header-->

        <!--begin::Sidebar-->
        <?php if (isset($component)) { $__componentOriginal299056a978bc4d31b180535a424f51bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal299056a978bc4d31b180535a424f51bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin.partials.sidebar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin.partials.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal299056a978bc4d31b180535a424f51bc)): ?>
<?php $attributes = $__attributesOriginal299056a978bc4d31b180535a424f51bc; ?>
<?php unset($__attributesOriginal299056a978bc4d31b180535a424f51bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal299056a978bc4d31b180535a424f51bc)): ?>
<?php $component = $__componentOriginal299056a978bc4d31b180535a424f51bc; ?>
<?php unset($__componentOriginal299056a978bc4d31b180535a424f51bc); ?>
<?php endif; ?>
        <!--end::Sidebar-->

        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <?php if (! empty(trim($__env->yieldContent('content-header')))): ?>
                <?php echo $__env->yieldContent('content-header'); ?>
            <?php else: ?>
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h1 class="mb-0 fs-3 fw-semibold"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
                            </div>
                            <div class="col-sm-6">
                                <?php if (! empty(trim($__env->yieldContent('breadcrumb')))): ?>
                                    <?php echo $__env->yieldContent('breadcrumb'); ?>
                                <?php else: ?>
                                    <ol class="breadcrumb float-sm-end mb-0">
                                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="bi bi-house-door"></i> Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></li>
                                    </ol>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <!--end::App Content Header-->

            <!--begin::App Content-->
            <div class="app-content">
                <div class="container-fluid">
                    
                    <!-- Flash Messages -->
                    <div id="flash-messages" x-data="{ show: true }">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert" x-show="show">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                            <div><?php echo e(session('success')); ?></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="show = false"></button>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert" x-show="show">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                            <div><?php echo e(session('error')); ?></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="show = false"></button>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('warning')): ?>
                        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert" x-show="show">
                            <i class="bi bi-exclamation-circle-fill me-2 fs-5"></i>
                            <div><?php echo e(session('warning')); ?></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="show = false"></button>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('info')): ?>
                        <div class="alert alert-info alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert" x-show="show">
                            <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                            <div><?php echo e(session('info')); ?></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="show = false"></button>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" x-show="show">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                                <strong>Please fix the following errors:</strong>
                            </div>
                            <ul class="mb-0 ps-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <li><?php echo e($error); ?></li>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="show = false"></button>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <!-- Main Content -->
                    <?php echo $__env->yieldContent('content'); ?>
                    <?php echo e($slot ?? ''); ?>

                    
                </div>
            </div>
            <!--end::App Content-->
            
            <!--begin::Loading Overlay-->
            <div wire:loading.remove.class="d-none" 
                wire:loading.class="d-flex" 
                wire:target="save,update,delete,submit,upload" 
                class="position-fixed top-0 start-0 w-100 h-100 d-none justify-content-center align-items-center" 
                style="background: rgba(0,0,0,0.4); z-index: 99999;">
                <div class="bg-body p-4 rounded-3 shadow-lg text-center border border-secondary-subtle">
                    <div class="spinner-border text-primary mb-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mb-0 fw-semibold">Processing...</p>
                </div>
            </div>
            <!--end::Loading Overlay-->
            
        </main>
        <!--end::App Main-->

        <!--begin::Footer-->
        <?php if (isset($component)) { $__componentOriginale3117a087a59c55081e26625720b668d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3117a087a59c55081e26625720b668d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin.partials.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin.partials.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3117a087a59c55081e26625720b668d)): ?>
<?php $attributes = $__attributesOriginale3117a087a59c55081e26625720b668d; ?>
<?php unset($__attributesOriginale3117a087a59c55081e26625720b668d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3117a087a59c55081e26625720b668d)): ?>
<?php $component = $__componentOriginale3117a087a59c55081e26625720b668d; ?>
<?php unset($__componentOriginale3117a087a59c55081e26625720b668d); ?>
<?php endif; ?>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

    <!--begin::Scripts-->
    <?php if (isset($component)) { $__componentOriginalfe61f3faf237501d39a34fab4017132b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfe61f3faf237501d39a34fab4017132b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin.partials.scripts','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin.partials.scripts'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfe61f3faf237501d39a34fab4017132b)): ?>
<?php $attributes = $__attributesOriginalfe61f3faf237501d39a34fab4017132b; ?>
<?php unset($__attributesOriginalfe61f3faf237501d39a34fab4017132b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfe61f3faf237501d39a34fab4017132b)): ?>
<?php $component = $__componentOriginalfe61f3faf237501d39a34fab4017132b; ?>
<?php unset($__componentOriginalfe61f3faf237501d39a34fab4017132b); ?>
<?php endif; ?>
    <!--end::Scripts-->

    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    
    <!-- Initialize Admin App -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Toast notifications
            Livewire.on('toast', (data) => {
                toastr[data.type || 'success'](data.message, data.title || 'Success', {
                    closeButton: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                    timeOut: data.timeOut || 5000
                });
            });
            
            // SweetAlert confirmations
            Livewire.on('swal:confirm', (data) => {
                Swal.fire({
                    title: data.title || 'Are you sure?',
                    text: data.text || '',
                    icon: data.icon || 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: data.confirmText || 'Yes',
                    cancelButtonText: data.cancelText || 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch(data.event, data.params || {});
                    }
                });
            });
            
            // Success alerts
            Livewire.on('swal:success', (data) => {
                Swal.fire({
                    title: data.title || 'Success!',
                    text: data.text || '',
                    icon: 'success',
                    timer: 3000,
                    showConfirmButton: false,
                    toast: data.toast || false,
                    position: data.position || 'center'
                });
            });
            
            // Error alerts
            Livewire.on('swal:error', (data) => {
                Swal.fire({
                    title: data.title || 'Error!',
                    text: data.text || '',
                    icon: 'error'
                });
            });
            
            // Close modals
            Livewire.on('close-modal', (data) => {
                const modal = document.getElementById(data.modal || 'defaultModal');
                if (modal) {
                    const bsModal = bootstrap.Modal.getInstance(modal);
                    if (bsModal) bsModal.hide();
                }
            });
            
            // Refresh DataTable
            Livewire.on('refresh-datatable', () => {
                if ($.fn.DataTable) {
                    $('.data-table').DataTable().ajax.reload();
                }
            });
        });
        
        function adminApp() {
            return {
                theme: localStorage.getItem('lte-theme') || 'auto',
                sidebarCollapsed: localStorage.getItem('sidebar-state') === 'collapsed' || window.innerWidth < 992,
                sidebarMini: localStorage.getItem('sidebar-mini') === 'true',
                topNav: false,
                searchQuery: '',
                
                initialize() {
                    // Handle responsive sidebar
                    if (window.innerWidth < 992) {
                        this.sidebarCollapsed = true;
                        document.body.classList.add('sidebar-collapse');
                    }
                    
                    // Initialize OverlayScrollbars
                    this.initScrollbars();
                    
                    // Listen for resize
                    window.addEventListener('resize', () => {
                        if (window.innerWidth < 992 && !this.sidebarCollapsed) {
                            this.sidebarCollapsed = true;
                            document.body.classList.add('sidebar-collapse');
                        }
                    });
                    
                    // System theme change listener
                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                        if (this.theme === 'auto') {
                            const resolved = e.matches ? 'dark' : 'light';
                            document.documentElement.setAttribute('data-bs-theme', resolved);
                            document.documentElement.style.colorScheme = resolved;
                        }
                    });
                },
                
                initScrollbars() {
                    const setupScrollbars = () => {
                        const sidebarWrapper = document.querySelector('.sidebar-wrapper');
                        const isMobile = window.innerWidth <= 992;
                        
                        // Safe check: pehle check karein ke kya scrollbars library load ho chuki hai ya nahi
                        if (sidebarWrapper && typeof OverlayScrollbarsGlobal !== 'undefined' && !isMobile) {
                            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                                scrollbars: {
                                    theme: 'os-theme-light',
                                    autoHide: 'leave',
                                    clickScroll: true,
                                },
                            });
                        }
                    };

                    // Agar document load ho raha ho to window load event ka wait karein, 
                    // warna direct execute kar dein taake timing issue hal ho jaye.
                    if (document.readyState === 'loading') {
                        window.addEventListener('load', setupScrollbars);
                    } else {
                        setTimeout(setupScrollbars, 100);
                    }
                },
                
                toggleSidebar() {
                    this.sidebarCollapsed = !this.sidebarCollapsed;
                    document.body.classList.toggle('sidebar-collapse');
                    localStorage.setItem('sidebar-state', this.sidebarCollapsed ? 'collapsed' : 'expanded');
                },
                
                toggleSidebarMini() {
                    if (window.innerWidth >= 992) {
                        this.sidebarMini = !this.sidebarMini;
                        document.body.classList.toggle('sidebar-mini');
                        localStorage.setItem('sidebar-mini', this.sidebarMini);
                    }
                },
                
                setTheme(theme) {
                    this.theme = theme;
                    let resolved = theme;
                    if (theme === 'auto') {
                        resolved = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                    }
                    document.documentElement.setAttribute('data-bs-theme', resolved);
                    document.documentElement.style.colorScheme = resolved;
                    localStorage.setItem('lte-theme', theme);
                },
                
                getThemeIcon() {
                    if (this.theme === 'light') return 'sun-fill';
                    if (this.theme === 'dark') return 'moon-fill';
                    return 'circle-half';
                },
                
                fullscreen() {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen();
                    } else {
                        document.exitFullscreen();
                    }
                },
                
                confirmLogout() {
                    Swal.fire({
                        title: 'Logout?',
                        text: 'Are you sure you want to logout?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, logout!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logout-form').submit();
                        }
                    });
                }
            }
        }
        
        // Toastr defaults
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        
        // CSRF setup for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
</html><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/layouts/admin-layout.blade.php ENDPATH**/ ?>