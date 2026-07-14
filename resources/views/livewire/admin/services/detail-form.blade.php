<div>
    <div class="app-content-header"><div class="container-fluid"><div class="row"><div class="col-sm-6"><h1 class="mb-0 fs-3">{{ $isEditing ? 'Edit Detail' : 'Add Service Detail' }}</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li><li class="breadcrumb-item active">{{ $isEditing ? 'Edit' : 'Add' }} Detail</li></ol></div></div></div></div>

    <div class="container-fluid"><form wire:submit="save"><div class="row g-3">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-list-ul me-2"></i>Detail Information</h3></div><div class="card-body"><div class="row g-3">
                <div class="col-md-6"><label class="form-label required">Service</label><select class="form-select @error('os_id') is-invalid @enderror" wire:model="os_id"><option value="">-- Select Service --</option>@foreach($services as $s)<option value="{{ $s->id }}">{{ $s->os_name }}</option>@endforeach</select>@error('os_id')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                <div class="col-md-6"><label class="form-label">Sort Order</label><input type="number" class="form-control" wire:model="sort_order" min="0"></div>
                <div class="col-12"><label class="form-label required">Title</label><input type="text" class="form-control @error('sd_title') is-invalid @enderror" wire:model="sd_title">@error('sd_title')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                <div class="col-md-4"><label class="form-label">Point 1</label><input type="text" class="form-control" wire:model="sd_t1"></div>
                <div class="col-md-4"><label class="form-label">Point 2</label><input type="text" class="form-control" wire:model="sd_t2"></div>
                <div class="col-md-4"><label class="form-label">Point 3</label><input type="text" class="form-control" wire:model="sd_t3"></div>
            </div></div></div>

            <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-text-paragraph me-2"></i>Description</h3></div><div class="card-body">
                <livewire:components.ck-editor label="Description" placeholder="Describe this service detail..." height="350px" toolbar="full" :value="$sd_description" />
            </div></div>

            <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-check2-square me-2"></i>Features</h3></div><div class="card-body">
                <div class="input-group mb-3"><input type="text" class="form-control" wire:model="sd_features_input" wire:keydown.enter.prevent="addFeature" placeholder="Add feature..."><button class="btn btn-primary" wire:click="addFeature"><i class="bi bi-plus-lg"></i> Add</button></div>
                @if(count($sd_features)>0)<div class="d-flex flex-wrap gap-2">@foreach($sd_features as $i=>$f)<span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">{{ $f }}<button class="btn-close btn-close-sm ms-2" wire:click="removeFeature({{ $i }})" style="font-size:.6rem;"></button></span>@endforeach</div>@else<p class="text-muted text-center py-3">No features added.</p>@endif
            </div></div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-image me-2"></i>Image 1</h3></div><div class="card-body text-center">@if($image1Preview)<img src="{{ $image1Preview }}" class="rounded mb-2" style="width:100%;max-height:180px;object-fit:cover;">@endif<input type="file" class="form-control" wire:model="sd_image1" accept="image/*">@if($image1Preview)<button class="btn btn-danger btn-sm mt-2 w-100" wire:click="removeImage1"><i class="bi bi-trash"></i> Remove</button>@endif</div></div>
            <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-image me-2"></i>Image 2</h3></div><div class="card-body text-center">@if($image2Preview)<img src="{{ $image2Preview }}" class="rounded mb-2" style="width:100%;max-height:180px;object-fit:cover;">@endif<input type="file" class="form-control" wire:model="sd_image2" accept="image/*">@if($image2Preview)<button class="btn btn-danger btn-sm mt-2 w-100" wire:click="removeImage2"><i class="bi bi-trash"></i> Remove</button>@endif</div></div>
            <button type="submit" class="btn btn-primary btn-lg w-100 mb-2" wire:loading.attr="disabled"><span wire:loading.remove wire:target="save"><i class="bi bi-check-lg me-1"></i> {{ $isEditing?'Update':'Create' }}</span><span wire:loading wire:target="save"><span class="spinner-border spinner-border-sm me-1"></span> Saving...</span></button>
            <a href="{{ route('admin.services.details.index') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-x-lg me-1"></i> Cancel</a>
        </div>
    </div></form></div>
</div>