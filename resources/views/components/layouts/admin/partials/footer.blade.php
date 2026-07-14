<footer class="app-footer bg-body-secondary border-top">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <strong>Copyright &copy; {{ date('Y') }} 
                    <a href="{{ url('/') }}" class="text-decoration-none">{{ config('app.name', 'Razzaq Engineering') }}</a>.
                </strong> All rights reserved.
            </div>
            <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                <span class="text-muted">Version 4.1</span>
            </div>
        </div>
    </div>
</footer>