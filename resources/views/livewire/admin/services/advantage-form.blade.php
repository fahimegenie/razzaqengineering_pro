<div>
    <div class="app-content-header"><div class="container-fluid"><div class="row"><div class="col-sm-6"><h1 class="mb-0 fs-3">{{ $isEditing ? 'Edit Advantage' : 'Add Service Advantage' }}</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li><li class="breadcrumb-item active">{{ $isEditing ? 'Edit' : 'Add' }} Advantage</li></ol></div></div></div></div>

    <div class="container-fluid"><form wire:submit="save"><div class="row g-3">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-trophy me-2"></i>Advantage Information</h3></div><div class="card-body"><div class="row g-3">
                <div class="col-md-8"><label class="form-label required">Service</label><select class="form-select @error('sa_st_id') is-invalid @enderror" wire:model="sa_st_id"><option value="">-- Select --</option>@foreach($services as $s)<option value="{{ $s->id }}">{{ $s->os_name }}</option>@endforeach</select>@error('sa_st_id')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                <div class="col-md-4"><label class="form-label">Sort Order</label><input type="number" class="form-control" wire:model="sort_order" min="0"></div>
                <div class="col-12"><label class="form-label required">Title</label><input type="text" class="form-control @error('sa_title') is-invalid @enderror" wire:model="sa_title">@error('sa_title')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                <div class="col-md-3"><label>Point 1</label><input class="form-control" wire:model="sa_t1"></div>
                <div class="col-md-3"><label>Point 2</label><input class="form-control" wire:model="sa_t2"></div>
                <div class="col-md-3"><label>Point 3</label><input class="form-control" wire:model="sa_t3"></div>
                <div class="col-md-3"><label>Point 4</label><input class="form-control" wire:model="sa_t4"></div>
            </div></div></div>
            <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-text-paragraph me-2"></i>Description</h3></div><div class="card-body">
                <livewire:components.ck-editor label="Description" placeholder="Describe this advantage..." height="300px" toolbar="basic" :value="$sa_description" />
            </div></div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-image me-2"></i>Image</h3></div><div class="card-body text-center">@if($imagePreview)<img src="{{ $imagePreview }}" class="rounded mb-2" style="width:100%;max-height:180px;object-fit:cover;">@endif<input type="file" class="form-control" wire:model="sa_image" accept="image/*">@if($imagePreview)<button class="btn btn-danger btn-sm mt-2 w-100" wire:click="removeImage"><i class="bi bi-trash"></i> Remove</button>@endif</div></div>
            <button type="submit" class="btn btn-primary btn-lg w-100 mb-2" wire:loading.attr="disabled"><span wire:loading.remove wire:target="save"><i class="bi bi-check-lg me-1"></i> {{ $isEditing?'Update':'Create' }}</span><span wire:loading wire:target="save"><span class="spinner-border spinner-border-sm me-1"></span> Saving...</span></button>
            <a href="{{ route('admin.services.advantages.index') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-x-lg me-1"></i> Cancel</a>
        </div>
    </div></form></div>
</div>