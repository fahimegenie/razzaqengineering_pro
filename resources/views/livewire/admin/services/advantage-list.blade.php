<div>
    <div class="app-content-header"><div class="container-fluid"><div class="row"><div class="col-sm-6"><h1 class="mb-0 fs-3">Service Advantages</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li><li class="breadcrumb-item active">Advantages</li></ol></div></div></div></div>

    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-3"><div class="card-body"><div class="row g-2 align-items-end">
            <div class="col-md-4"><select class="form-select" wire:model.blur="serviceFilter"><option value="">All Services</option>@foreach($services as $s)<option value="{{ $s->id }}">{{ $s->os_name }}</option>@endforeach</select></div>
            <div class="col-md-4"><div class="input-group"><span class="input-group-text"><i class="bi bi-search"></i></span><input type="text" class="form-control" wire:model.blur="search" placeholder="Search..."></div></div>
            <div class="col-md-4 text-end"><a href="{{ route('admin.services.advantages.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Advantage</a></div>
        </div></div></div>

        <div class="row g-3">
            @forelse($advantages as $adv)
            <div class="col-12 col-sm-6 col-lg-4"><div class="card shadow-sm border-0 h-100"><div class="card-body">
                <div class="d-flex gap-3"><img src="{{ $adv->image_url }}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;"><div>
                    <h6 class="fw-bold mb-1">{{ $adv->sa_title }}</h6>
                    <small class="text-muted">{{ $adv->service->os_name ?? 'N/A' }}</small>
                    @if($adv->bullet_points)<div class="mt-1">@foreach($adv->bullet_points as $p)<span class="badge bg-light text-dark me-1">{{ $p }}</span>@endforeach</div>@endif
                </div></div>
                <div class="btn-group btn-group-sm w-100 mt-2"><a href="{{ route('admin.services.advantages.edit', $adv->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a><button class="btn btn-danger" wire:click="confirmDelete({{ $adv->id }})"><i class="bi bi-trash"></i></button></div>
            </div></div></div>
            @empty
            <div class="col-12 text-center py-5"><i class="bi bi-trophy display-4 text-muted d-block"></i><h5>No advantages found</h5><a href="{{ route('admin.services.advantages.create') }}" class="btn btn-primary mt-2"><i class="bi bi-plus-lg"></i> Add Advantage</a></div>
            @endforelse
        </div>
        @if($advantages->hasPages())<div class="card shadow-sm border-0 mt-3"><div class="card-footer">{{ $advantages->links() }}</div></div>@endif
    </div>

    @if($showDeleteModal)<div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirm Delete</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div><div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this advantage?</h5></div><div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deleteAdvantage">Delete</button></div></div></div></div><div class="modal-backdrop fade show"></div>@endif
</div>