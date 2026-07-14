<div>
    <div class="app-content-header"><div class="container-fluid"><div class="row"><div class="col-sm-6"><h1 class="mb-0 fs-3">{{ $isEditing ? 'Edit Quote' : 'Add New Quote' }}</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('admin.quotes.index') }}">Quotes</a></li><li class="breadcrumb-item active">{{ $isEditing ? 'Edit' : 'Create' }}</li></ol></div></div></div></div>

    <div class="container-fluid">
        <form wire:submit="save">
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-person me-2"></i>Client Information</h3></div><div class="card-body"><div class="row g-3">
                        <div class="col-md-6"><label class="form-label required">Full Name</label><input type="text" class="form-control @error('qr_name') is-invalid @enderror" wire:model="qr_name">@error('qr_name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="col-md-6"><label class="form-label">Company</label><input type="text" class="form-control" wire:model="qr_company"></div>
                        <div class="col-md-6"><label class="form-label required">Email</label><input type="email" class="form-control @error('qr_email') is-invalid @enderror" wire:model="qr_email">@error('qr_email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="col-md-6"><label class="form-label required">Phone</label><input type="text" class="form-control @error('qr_phone') is-invalid @enderror" wire:model="qr_phone">@error('qr_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    </div></div></div>

                    <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-info-circle me-2"></i>Request Details</h3></div><div class="card-body"><div class="row g-3">
                        <div class="col-md-6"><label class="form-label required">Service Type</label><select class="form-select @error('qr_service_type') is-invalid @enderror" wire:model="qr_service_type"><option value="">-- Select --</option>@foreach($serviceTypeOptions as $val=>$label)<option value="{{ $val }}">{{ $label }}</option>@endforeach</select>@error('qr_service_type')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="col-md-6"><label class="form-label required">Location</label><input type="text" class="form-control @error('qr_location') is-invalid @enderror" wire:model="qr_location">@error('qr_location')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="col-md-6"><label class="form-label">Budget</label><select class="form-select" wire:model="qr_budget"><option value="">-- Select --</option>@foreach($budgetOptions as $val=>$label)<option value="{{ $val }}">{{ $label }}</option>@endforeach</select></div>
                        <div class="col-md-6"><label class="form-label">Timeline</label><select class="form-select" wire:model="qr_timeline"><option value="">-- Select --</option>@foreach($timelineOptions as $val=>$label)<option value="{{ $val }}">{{ $label }}</option>@endforeach</select></div>
                        <div class="col-12"><label class="form-label required">Details</label><textarea class="form-control @error('qr_details') is-invalid @enderror" rows="5" wire:model="qr_details" placeholder="Describe the project requirements..."></textarea>@error('qr_details')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    </div></div></div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-gear me-2"></i>Settings</h3></div><div class="card-body">
                        <div class="mb-3"><label class="form-label required">Status</label><select class="form-select @error('qr_status') is-invalid @enderror" wire:model="qr_status"><option value="pending">Pending</option><option value="contacted">Contacted</option><option value="completed">Completed</option><option value="cancelled">Cancelled</option></select>@error('qr_status')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="mb-3"><label class="form-label">Source</label><input type="text" class="form-control" wire:model="qr_source"></div>
                        <div class="mb-3"><label class="form-label">Admin Notes</label><textarea class="form-control" rows="3" wire:model="qr_admin_notes" placeholder="Internal notes..."></textarea></div>
                    </div></div>

                    <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-paperclip me-2"></i>Attachment</h3></div><div class="card-body">
                        @if($attachmentPreview)
                        <div class="mb-2"><a href="{{ $attachmentPreview }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i> View</a><button type="button" class="btn btn-sm btn-danger ms-1" wire:click="removeAttachment"><i class="bi bi-x"></i></button></div>
                        @endif
                        <input type="file" class="form-control" wire:model="qr_attachment_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.zip"><small class="text-muted">Max 10MB</small>
                    </div></div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-2" wire:loading.attr="disabled"><span wire:loading.remove wire:target="save"><i class="bi bi-check-lg me-1"></i> {{ $isEditing?'Update':'Create' }}</span><span wire:loading wire:target="save"><span class="spinner-border spinner-border-sm me-1"></span> Saving...</span></button>
                    <a href="{{ route('admin.quotes.index') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-x-lg me-1"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>