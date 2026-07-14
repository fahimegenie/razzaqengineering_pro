<!--begin::jQuery-->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!--end::jQuery-->

<!--begin::OverlayScrollbars-->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
<!--end::OverlayScrollbars-->

<!--begin::Popper & Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!--end::Popper & Bootstrap-->

<!--begin::AdminLTE JS-->
<script src="<?php echo e(asset('admin_assets/js/adminlte.js')); ?>"></script>
<!--end::AdminLTE JS-->



<!--begin::Chart.js-->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<!--end::Chart.js-->

<!--begin::ApexCharts-->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"></script>
<!--end::ApexCharts-->

<!--begin::DataTables-->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<!--end::DataTables-->

<!--begin::Select2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!--end::Select2-->

<!--begin::Toastr-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!--end::Toastr-->

<!--begin::SweetAlert2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--end::SweetAlert2-->

<!--begin::Quill Editor-->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<!--end::Quill Editor-->

<!--begin::Dropzone-->
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<!--end::Dropzone-->

<!--begin::Flatpickr Datepicker-->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!--end::Flatpickr-->

<!--begin::SortableJS-->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<!--end::SortableJS-->

<!--begin::Moment.js-->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<!--end::Moment.js-->

<!--begin::Custom Admin Scripts-->
<script>
    // Initialize Bootstrap tooltips and popovers
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    });
    
    // Initialize Select2 on Livewire updates
    document.addEventListener('livewire:initialized', () => {
        Livewire.hook('morph.updated', ({ el, component }) => {
            $(el).find('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });
            
            $(el).find('.flatpickr').flatpickr({
                dateFormat: 'Y-m-d',
                allowInput: true
            });
        });
    });
    
    // Auto-hide alerts
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            $('.alert-dismissible').fadeOut('slow');
        }, 5000);
    });
    
    // Confirm before leaving form
    let formChanged = false;
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            const inputs = form.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.addEventListener('change', () => {
                    formChanged = true;
                });
            });
        });
        
        window.addEventListener('beforeunload', function(e) {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = '';
            }
        });
    });
    
    // DataTable default configuration
    $.extend(true, $.fn.dataTable.defaults, {
        responsive: true,
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records...",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "Showing 0 to 0 of 0 entries",
            infoFiltered: "(filtered from _MAX_ total entries)",
            paginate: {
                first: '<i class="bi bi-chevron-double-left"></i>',
                last: '<i class="bi bi-chevron-double-right"></i>',
                previous: '<i class="bi bi-chevron-left"></i>',
                next: '<i class="bi bi-chevron-right"></i>'
            }
        }
    });
    
    // Sidebar backdrop for mobile
    document.addEventListener('DOMContentLoaded', function() {
        const backdrop = document.createElement('div');
        backdrop.className = 'sidebar-backdrop';
        document.body.appendChild(backdrop);
        
        backdrop.addEventListener('click', function() {
            document.body.classList.remove('sidebar-collapse');
        });
    });
</script>
<!--end::Custom Admin Scripts--><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/layouts/admin/partials/scripts.blade.php ENDPATH**/ ?>