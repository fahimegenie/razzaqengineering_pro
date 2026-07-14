<div>
    <div class="app-content-header"><div class="container-fluid"><div class="row"><div class="col-sm-6"><h1 class="mb-0 fs-3">Services</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item active">Services</li></ol></div></div></div></div>

    <div class="container-fluid">
        <div class="row g-3 mb-3">
            <div class="col-4"><div class="card border-0 shadow-sm bg-primary text-white"><div class="card-body text-center py-3"><i class="bi bi-tools display-6"></i><h3 class="mb-0 mt-1">{{ $totalServices }}</h3><small>Total</small></div></div></div>
            <div class="col-4"><div class="card border-0 shadow-sm bg-success text-white"><div class="card-body text-center py-3"><i class="bi bi-check-circle display-6"></i><h3 class="mb-0 mt-1">{{ $activeServices }}</h3><small>Active</small></div></div></div>
            <div class="col-4"><div class="card border-0 shadow-sm bg-warning text-white"><div class="card-body text-center py-3"><i class="bi bi-star-fill display-6"></i><h3 class="mb-0 mt-1">{{ $featuredServices }}</h3><small>Featured</small></div></div></div>
        </div>

        <div class="card shadow-sm border-0 mb-3"><div class="card-body"><div class="row g-2 align-items-end">
            <div class="col-md-4"><div class="input-group"><span class="input-group-text"><i class="bi bi-search"></i></span><input type="text" class="form-control" wire:model.blur="search" placeholder="Search...">@if($search)<button class="btn btn-outline-secondary" wire:click="clearSearch"><i class="bi bi-x-lg"></i></button>@endif</div></div>
            <div class="col-md-2"><select class="form-select" wire:model.blur="statusFilter"><option value="">Status</option><option value="1">Active</option><option value="0">Inactive</option></select></div>
            <div class="col-md-2"><select class="form-select" wire:model.blur="featuredFilter"><option value="">Featured</option><option value="1">Yes</option><option value="0">No</option></select></div>
            <div class="col-md-4 text-end"><button class="btn btn-outline-secondary me-1" wire:click="clearFilters"><i class="bi bi-funnel"></i></button><a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Service</a></div>
        </div>@if(count($selectedServices)>0)<div class="mt-3 p-2 bg-light rounded d-flex gap-2"><span class="fw-semibold">{{ count($selectedServices) }} selected</span><button class="btn btn-sm btn-success" wire:click="bulkActivate"><i class="bi bi-check-circle"></i> Activate</button><button class="btn btn-sm btn-warning" wire:click="bulkDeactivate"><i class="bi bi-pause-circle"></i> Deactivate</button><button class="btn btn-sm btn-danger" wire:click="bulkDelete"><i class="bi bi-trash"></i> Delete</button></div>@endif</div></div>

        <div class="row g-3">
            @forelse($services as $service)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3"><div class="card shadow-sm border-0 h-100 service-card"><div class="position-relative">
                <img src="{{ $service->image_url }}" class="card-img-top" style="height:160px;object-fit:cover;">
                <div class="position-absolute top-0 start-0 m-2"><input type="checkbox" class="form-check-input" @checked(in_array($service->id, $selectedServices)) wire:click="toggleServiceSelection({{ $service->id }})" style="width:18px;height:18px;background:white;"></div>
                @if($service->is_featured)<div class="position-absolute top-0 end-0 m-2"><span class="badge bg-warning"><i class="bi bi-star-fill"></i></span></div>@endif
            </div><div class="card-body d-flex flex-column text-center">
                @if($service->os_icon)<i class="{{ $service->os_icon }} display-6 text-primary mb-2"></i>@endif
                <h6 class="fw-bold">{{ Str::limit($service->os_name, 30) }}</h6>
                <p class="text-muted small flex-grow-1">{{ Str::limit(strip_tags($service->os_short_description ?: $service->os_description), 80) }}</p>
                <div class="btn-group w-100 btn-group-sm">
                    <button class="btn btn-info" wire:click="viewServiceDetails({{ $service->id }})"><i class="bi bi-eye"></i></button>
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                    <button class="btn btn-{{ $service->is_featured?'warning':'outline-warning' }}" wire:click="toggleFeatured({{ $service->id }})"><i class="bi bi-star"></i></button>
                    <a href="{{ route('admin.services.details.index', ['serviceId' => $service->id]) }}" class="btn btn-info" title="Details"><i class="bi bi-list-ul"></i></a>
                    <button class="btn btn-danger" wire:click="confirmDelete({{ $service->id }})"><i class="bi bi-trash"></i></button>
                </div>
            </div></div></div>
            @empty
            <div class="col-12 text-center py-5"><i class="bi bi-tools display-1 text-muted d-block mb-3"></i><h4>No services found</h4><a href="{{ route('admin.services.create') }}" class="btn btn-primary mt-2"><i class="bi bi-plus-lg"></i> Add First Service</a></div>
            @endforelse
        </div>
        @if($services->hasPages())<div class="card shadow-sm border-0 mt-3"><div class="card-footer d-flex justify-content-between"><small>Showing {{ $services->firstItem() }}-{{ $services->lastItem() }} of {{ $services->total() }}</small>{{ $services->links() }}</div></div>@endif
    </div>

    @if($showViewModal){{-- View Modal --}}@endif
    @if($showDeleteModal)<div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirm Delete</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div><div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this service?</h5></div><div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deleteService">Delete</button></div></div></div></div><div class="modal-backdrop fade show"></div>@endif
</div>

@push('styles')<style>.service-card{transition:all .3s}.service-card:hover{transform:translateY(-5px);box-shadow:0 10px 30px rgba(0,0,0,.15)!important}</style>@endpush