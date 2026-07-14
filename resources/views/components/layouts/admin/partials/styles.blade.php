<!--begin::Fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous">
<!--end::Fonts-->

<!--begin::Bootstrap Icons-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
<!--end::Bootstrap Icons-->

<!--begin::OverlayScrollbars-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous">
<!--end::OverlayScrollbars-->

<!--begin::AdminLTE CSS-->
<link rel="stylesheet" href="{{ asset('admin_assets/css/adminlte.css') }}">
<!--end::AdminLTE CSS-->

<!--begin::DataTables-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<!--end::DataTables-->

<!--begin::Select2-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
<!--end::Select2-->

<!--begin::Toastr-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!--end::Toastr-->

<!--begin::SweetAlert2-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!--end::SweetAlert2-->

<!--begin::Quill Editor-->
<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
<!--end::Quill Editor-->

<!--begin::Dropzone-->
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css">
<!--end::Dropzone-->

<!--begin::Flatpickr Datepicker-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/bootstrap5.css">
<!--end::Flatpickr-->

<!--begin::ApexCharts-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css">
<!--end::ApexCharts-->

<!--begin::Custom Admin Styles-->
<style>
    /* Responsive improvements */
    @media (max-width: 991.98px) {
        .app-sidebar {
            position: fixed;
            top: 0;
            left: -280px;
            width: 280px;
            height: 100vh;
            z-index: 1050;
            transition: left 0.3s ease;
        }
        
        .sidebar-collapse .app-sidebar {
            left: 0;
        }
        
        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
        }
        
        .sidebar-collapse .sidebar-backdrop {
            display: block;
        }
        
        .small-box .inner h3 {
            font-size: 1.5rem;
        }
        
        .table-responsive {
            -webkit-overflow-scrolling: touch;
        }
    }
    
    @media (max-width: 575.98px) {
        .app-content-header h1 {
            font-size: 1.25rem;
        }
        
        .breadcrumb {
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }
        
        .btn-group-sm > .btn {
            padding: 0.15rem 0.4rem;
            font-size: 0.75rem;
        }
        
        .small-box {
            margin-bottom: 0.75rem;
        }
        
        .card-body {
            padding: 0.75rem;
        }
        
        .container-fluid {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }
    }
    
    /* Card improvements */
    .card {
        border: none;
        transition: box-shadow 0.3s ease;
    }
    
    .card:hover {
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.1) !important;
    }
    
    /* Table improvements */
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    /* Button improvements */
    .btn {
        font-weight: 500;
        letter-spacing: 0.3px;
    }
    
    /* Form improvements */
    .form-label {
        font-weight: 500;
        margin-bottom: 0.35rem;
    }
    
    .required:after {
        content: " *";
        color: #dc3545;
        font-weight: bold;
    }
    
    /* Smooth transitions */
    .app-sidebar, .app-header, .app-footer {
        transition: all 0.3s ease;
    }
    
    /* Loading spinner overlay */
    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255,255,255,0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 100;
    }
    
    /* Stat cards animation */
    .small-box {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .small-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    }
    
    /* Responsive font sizes */
    html {
        font-size: 14px;
    }
    
    @media (min-width: 768px) {
        html {
            font-size: 15px;
        }
    }
    
    @media (min-width: 1200px) {
        html {
            font-size: 16px;
        }
    }
    
    /* Print styles */
    @media print {
        .app-header, .app-sidebar, .app-footer, .no-print {
            display: none !important;
        }
        
        .app-main {
            margin-left: 0 !important;
        }
    }
    
    /* Dark mode adjustments */
    [data-bs-theme="dark"] .card {
        background-color: #1e1e2d;
        border-color: #2b2b40;
    }
    
    [data-bs-theme="dark"] .table {
        --bs-table-bg: transparent;
        --bs-table-color: #cdcdde;
    }
    
    [data-bs-theme="dark"] .bg-light {
        background-color: #1a1a27 !important;
    }
</style>
<!--end::Custom Admin Styles-->