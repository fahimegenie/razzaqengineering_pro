<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      x-data="adminApp()" 
      x-init="initialize()"
      class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="color-scheme" content="light dark">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)">
    <meta name="robots" content="noindex, nofollow">
    
    <title>@hasSection('title')@yield('title') | @endif{{ config('app.name', 'Razzaq Engineering') }} Admin</title>

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

    @include('layouts.admin.partials.styles')
    
    @stack('styles')
    @livewireStyles
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
        @include('layouts.admin.partials.header')
        <!--end::Header-->

        <!--begin::Sidebar-->
        @include('layouts.admin.partials.sidebar')
        <!--end::Sidebar-->

        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            @hasSection('content-header')
                @yield('content-header')
            @else
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h1 class="mb-0 fs-3 fw-semibold">@yield('page-title', 'Dashboard')</h1>
                            </div>
                            <div class="col-sm-6">
                                @hasSection('breadcrumb')
                                    @yield('breadcrumb')
                                @else
                                    <ol class="breadcrumb float-sm-end mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i> Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Dashboard')</li>
                                    </ol>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!--end::App Content Header-->

            <!--begin::App Content-->
            <div class="app-content">
                <div class="container-fluid">
                    
                    <!-- Flash Messages -->
                    <div id="flash-messages" x-data="{ show: true }">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert" x-show="show">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="show = false"></button>
                        </div>
                        @endif
                        
                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert" x-show="show">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                            <div>{{ session('error') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="show = false"></button>
                        </div>
                        @endif
                        
                        @if(session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert" x-show="show">
                            <i class="bi bi-exclamation-circle-fill me-2 fs-5"></i>
                            <div>{{ session('warning') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="show = false"></button>
                        </div>
                        @endif
                        
                        @if(session('info'))
                        <div class="alert alert-info alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert" x-show="show">
                            <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                            <div>{{ session('info') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="show = false"></button>
                        </div>
                        @endif
                        
                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" x-show="show">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                                <strong>Please fix the following errors:</strong>
                            </div>
                            <ul class="mb-0 ps-4">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="show = false"></button>
                        </div>
                        @endif
                    </div>

                    <!-- Main Content -->
                    @yield('content')
                    {{ $slot ?? '' }}
                    
                </div>
            </div>
            <!--end::App Content-->
            
            <!--begin::Loading Overlay-->
            <div wire:loading wire:target="save,update,delete,submit,upload" 
                 class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center" 
                 style="background: rgba(0,0,0,0.3); z-index: 9999;">
                <div class="bg-white p-4 rounded-3 shadow-lg text-center">
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
        @include('layouts.admin.partials.footer')
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

    <!--begin::Scripts-->
    @include('layouts.admin.partials.scripts')
    <!--end::Scripts-->

    @stack('scripts')
    @livewireScripts
    
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
                    setTimeout(() => {
                        const sidebarWrapper = document.querySelector('.sidebar-wrapper');
                        const isMobile = window.innerWidth <= 992;
                        
                        if (sidebarWrapper && typeof OverlayScrollbarsGlobal !== 'undefined' && !isMobile) {
                            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                                scrollbars: {
                                    theme: 'os-theme-light',
                                    autoHide: 'leave',
                                    clickScroll: true,
                                },
                            });
                        }
                    }, 300);
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
</html>