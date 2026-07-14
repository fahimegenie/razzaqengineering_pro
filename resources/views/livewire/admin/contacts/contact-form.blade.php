<div>
    <div class="app-content-header"><div class="container-fluid"><div class="row"><div class="col-sm-6"><h1 class="mb-0 fs-3">{{ $isEditing ? 'Edit Message' : 'Add New Message' }}</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Contact Messages</a></li><li class="breadcrumb-item active">{{ $isEditing ? 'Edit' : 'Create' }}</li></ol></div></div></div></div>

    <div class="container-fluid">
        <form wire:submit="save">
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fw-semibold"><i class="bi bi-person me-2"></i>Contact Information</h3></div><div class="card-body"><div class="row g-3">
                        <div class="col-md-6"><label class="form-label required">Name</label><input type="text" class="form-control @error('cm_name') is-invalid @enderror" wire:model="cm_name">@error('cm_name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="col-md-6"><label class="form-label">Company</label><input type="text" class="form-control" wire:model="cm_company"></div>
                        <div class="col-md-6"><label class="form-label required">Email</label><input type="email" class="form-control @error('cm_email') is-invalid @enderror" wire:model="cm_email">@error('cm_email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="col-md-6"><label class="form-label">Phone</label><input type="text" class="form-control" wire:model="cm_phone"></div>
                        <div class="col-md-6"><label class="form-label">City</label><input type="text" class="form-control" wire:model="cm_city"></div>
                        <div class="col-md-6"><label class="form-label">Related Service</label><select class="form-select" wire:model="service_id"><option value="">-- None --</option>@foreach($services as $s)<option value="{{ $s->id }}">{{ $s->os_name }}</option>@endforeach</select></div>
                        <div class="col-12"><label class="form-label">Subject</label><input type="text" class="form-control" wire:model="cm_subject"></div>
                        <div class="col-12"><label class="form-label required">Message</label><textarea class="form-control @error('cm_message') is-invalid @enderror" rows="5" wire:model="cm_message"></textarea>@error('cm_message')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    </div></div></div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 mb-3"><div class="card-header"><h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-gear me-2"></i>Settings</h3></div><div class="card-body">
                        <div class="mb-3"><label class="form-label required">Status</label><select class="form-select @error('cm_status') is-invalid @enderror" wire:model="cm_status"><option value="new">New</option><option value="read">Read</option><option value="contacted">Contacted</option><option value="resolved">Resolved</option><option value="closed">Closed</option></select>@error('cm_status')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="mb-3"><label class="form-label required">Priority</label><select class="form-select @error('cm_priority') is-invalid @enderror" wire:model="cm_priority"><option value="low">Low</option><option value="medium">Medium</option><option value="high">High</option><option value="urgent">Urgent</option></select>@error('cm_priority')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="mb-3"><label class="form-label required">Source</label><select class="form-select @error('cm_source') is-invalid @enderror" wire:model="cm_source"><option value="website">Website</option><option value="phone">Phone</option><option value="email">Email</option><option value="social">Social</option><option value="referral">Referral</option><option value="other">Other</option></select>@error('cm_source')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="mb-3"><label class="form-label">Assign To</label><select class="form-select" wire:model="assigned_to"><option value="">-- None --</option>@foreach($users as $u)<option value="{{ $u->id }}">{{ $u->name }}</option>@endforeach</select></div>
                        <div class="mb-3"><label class="form-label">Follow Up Date</label><input type="datetime-local" class="form-control" wire:model="follow_up_date"></div>
                        <div class="mb-3"><label class="form-label">Admin Notes</label><textarea class="form-control" rows="3" wire:model="cm_notes"></textarea></div>
                    </div></div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-2" wire:loading.attr="disabled"><span wire:loading.remove wire:target="save"><i class="bi bi-check-lg me-1"></i> {{ $isEditing?'Update':'Create' }}</span><span wire:loading wire:target="save"><span class="spinner-border spinner-border-sm me-1"></span> Saving...</span></button>
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-x-lg me-1"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>