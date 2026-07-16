<div>
    <div class="app-content-header"><div class="container-fluid"><div class="row"><div class="col-sm-6"><h1 class="mb-0 fs-3">Service Details</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li><li class="breadcrumb-item active">Details</li></ol></div></div></div></div>

    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-3"><div class="card-body"><div class="row g-2 align-items-end">
            <div class="col-md-3"><select class="form-select" wire:model.blur="serviceFilter"><option value="">All Services</option>@foreach($services as $s)<option value="{{ $s->id }}">{{ $s->os_name }}</option>@endforeach</select></div>
            <div class="col-md-3"><div class="input-group"><span class="input-group-text"><i class="bi bi-search"></i></span><input type="text" class="form-control" wire:model.blur="search" placeholder="Search..."></div></div>
            <div class="col-md-6 text-end"><a href="{{ route('admin.services.details.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Detail</a></div>
        </div></div></div>

        <div class="card shadow-sm border-0"><div class="table-responsive"><table class="table table-hover mb-0"><thead class="table-light"><tr><th width="60">Img</th><th>Title</th><th>Service</th><th>Points</th><th>Order</th><th width="120">Actions</th></tr></thead><tbody>
            @forelse($details as $d)<tr>
                <td><img src="{{ $d->image1_url }}" style="width:50px;height:40px;object-fit:cover;border-radius:4px;"></td>
                <td><strong>{{ Str::limit($d->sd_title, 50) }}</strong></td>
                <td><span class="badge bg-info">{{ $d->service->os_name ?? 'N/A' }}</span></td>
                <td><small>{{ collect([$d->sd_t1,$d->sd_t2,$d->sd_t3])->filter()->implode(', ') ?: '—' }}</small></td>
                <td>{{ $d->sort_order }}</td>
                <td><div class="btn-group btn-group-sm"><a href="{{ route('admin.services.details.edit', $d->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a><button class="btn btn-danger" wire:click="confirmDelete({{ $d->id }})"><i class="bi bi-trash"></i></button></div></td>
            </tr>@empty<tr><td colspan="6" class="text-center py-5"><i class="bi bi-list-ul display-4 text-muted d-block"></i>No details found<br><a href="{{ route('admin.services.details.create') }}" class="btn btn-primary mt-2"><i class="bi bi-plus-lg"></i> Add Detail</a></td></tr>@endforelse
        </tbody></table></div>@if($details->hasPages())<div class="card-footer d-flex justify-content-between"><small>Showing {{ $details->firstItem() }}-{{ $details->lastItem() }} of {{ $details->total() }}</small>{{ $details->links() }}</div>@endif</div>
    </div>

    @if($showDeleteModal)<div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirm Delete</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div><div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this detail?</h5></div><div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deleteDetail">Delete</button></div></div></div></div><div class="modal-backdrop fade show"></div>@endif
</div>