<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3">Contact Messages</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item active">Contact Messages</li></ol></div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        {{-- Stats --}}
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-primary text-white"><div class="card-body text-center py-3"><i class="bi bi-envelope display-6"></i><h3 class="mb-0 mt-1">{{ $totalMessages }}</h3><small>Total</small></div></div></div>
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-danger text-white"><div class="card-body text-center py-3"><i class="bi bi-exclamation-circle display-6"></i><h3 class="mb-0 mt-1">{{ $newMessages }}</h3><small>New</small></div></div></div>
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-warning text-white"><div class="card-body text-center py-3"><i class="bi bi-arrow-up-circle display-6"></i><h3 class="mb-0 mt-1">{{ $highPriorityMessages }}</h3><small>High Priority</small></div></div></div>
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-info text-white"><div class="card-body text-center py-3"><i class="bi bi-calendar-check display-6"></i><h3 class="mb-0 mt-1">{{ $todayMessages }}</h3><small>Today</small></div></div></div>
        </div>

        {{-- Toolbar --}}
        <div class="card shadow-sm border-0 mb-3"><div class="card-body"><div class="row g-2 align-items-end">
            <div class="col-md-3"><div class="input-group"><span class="input-group-text"><i class="bi bi-search"></i></span><input type="text" class="form-control" wire:model.blur="search" placeholder="Search...">@if($search)<button class="btn btn-outline-secondary" wire:click="clearSearch"><i class="bi bi-x-lg"></i></button>@endif</div></div>
            <div class="col-6 col-md-2"><select class="form-select" wire:model.blur="statusFilter"><option value="">All Status</option><option value="new">New</option><option value="read">Read</option><option value="contacted">Contacted</option><option value="resolved">Resolved</option><option value="closed">Closed</option></select></div>
            <div class="col-6 col-md-2"><select class="form-select" wire:model.blur="priorityFilter"><option value="">All Priority</option><option value="urgent">Urgent</option><option value="high">High</option><option value="medium">Medium</option><option value="low">Low</option></select></div>
            <div class="col-6 col-md-2"><select class="form-select" wire:model.blur="sourceFilter"><option value="">All Sources</option><option value="website">Website</option><option value="phone">Phone</option><option value="email">Email</option><option value="social">Social</option><option value="referral">Referral</option></select></div>
            <div class="col-6 col-md-3 text-end"><button class="btn btn-outline-secondary me-1" wire:click="clearFilters"><i class="bi bi-funnel"></i></button><a href="{{ route('admin.contacts.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Message</a></div>
        </div>
        @if(count($selectedMessages)>0)<div class="mt-3 p-2 bg-light rounded d-flex gap-2 flex-wrap"><span class="fw-semibold">{{ count($selectedMessages) }} selected</span><button class="btn btn-sm btn-info" wire:click="bulkMarkRead"><i class="bi bi-eye"></i> Read</button><button class="btn btn-sm btn-primary" wire:click="bulkMarkContacted"><i class="bi bi-telephone"></i> Contacted</button><button class="btn btn-sm btn-success" wire:click="bulkMarkResolved"><i class="bi bi-check-circle"></i> Resolved</button><button class="btn btn-sm btn-danger" wire:click="bulkDelete"><i class="bi bi-trash"></i> Delete</button></div>@endif</div></div>

        {{-- Table --}}
        <div class="card shadow-sm border-0"><div class="table-responsive"><table class="table table-hover mb-0"><thead class="table-light"><tr>
            <th width="40"><input type="checkbox" class="form-check-input" @checked($selectAll) wire:click="toggleSelectAll"></th>
            <th>Contact</th><th>Subject</th><th>Priority</th><th>Status</th><th>Source</th>
            <th wire:click="sortBy('created_at')" style="cursor:pointer;">Date @if($sortField==='created_at')<i class="bi bi-arrow-{{ $sortDirection==='asc'?'up':'down' }}"></i>@endif</th>
            <th width="200">Actions</th>
        </tr></thead><tbody>
            @forelse($messages as $msg)
            <tr class="{{ $msg->cm_status === 'new' ? 'table-danger' : '' }} {{ $msg->is_overdue ? 'table-warning' : '' }}">
                <td><input type="checkbox" class="form-check-input" @checked(in_array($msg->id, $selectedMessages)) wire:click="toggleMessageSelection({{ $msg->id }})"></td>
                <td>
                    <strong>{{ $msg->cm_name }}</strong><br>
                    <small>{{ $msg->cm_email }}</small>
                    @if($msg->cm_phone)<br><small>{{ $msg->cm_phone }}</small>@endif
                    @if($msg->cm_company)<br><small class="text-muted">{{ $msg->cm_company }}</small>@endif
                    @if($msg->cm_city)<br><small class="text-muted"><i class="bi bi-geo-alt"></i> {{ $msg->cm_city }}</small>@endif
                    @if($msg->assignedTo)<br><small class="text-primary"><i class="bi bi-person"></i> {{ $msg->assignedTo->name }}</small>@endif
                </td>
                <td>
                    <strong>{{ $msg->cm_subject ?: 'No Subject' }}</strong>
                    @if($msg->service)<br><span class="badge bg-info">{{ $msg->service->os_name }}</span>@endif
                </td>
                <td>{!! $msg->priority_badge !!}</td>
                <td>{!! $msg->status_badge !!}@if($msg->has_follow_up)<br><small class="text-info"><i class="bi bi-clock"></i> {{ $msg->follow_up_date->format('M d, h:i A') }}</small>@endif</td>
                <td>{!! $msg->source_badge !!}</td>
                <td><small>{{ $msg->created_at->format('M d, Y') }}<br>{{ $msg->created_at->format('h:i A') }}</small></td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-info" wire:click="viewMessageDetails({{ $msg->id }})" title="View"><i class="bi bi-eye"></i></button>
                        <a href="{{ route('admin.contacts.edit', $msg->id) }}" class="btn btn-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                        <button class="btn btn-warning" wire:click="openStatusModal({{ $msg->id }})" title="Change Status"><i class="bi bi-arrow-repeat"></i></button>
                        @if($msg->cm_status === 'new')<button class="btn btn-info" wire:click="markAsRead({{ $msg->id }})" title="Mark Read"><i class="bi bi-eye"></i></button>@endif
                        @if(in_array($msg->cm_status, ['new','read']))<button class="btn btn-primary" wire:click="markAsContacted({{ $msg->id }})" title="Mark Contacted"><i class="bi bi-telephone"></i></button>@endif
                        @if($msg->cm_status !== 'resolved')<button class="btn btn-success" wire:click="markAsResolved({{ $msg->id }})" title="Mark Resolved"><i class="bi bi-check-lg"></i></button>@endif
                        <button class="btn btn-danger" wire:click="confirmDelete({{ $msg->id }})" title="Delete"><i class="bi bi-trash"></i></button>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center py-5"><i class="bi bi-envelope-open display-4 text-muted d-block"></i><h5>No messages found</h5><a href="{{ route('admin.contacts.create') }}" class="btn btn-primary mt-2"><i class="bi bi-plus-lg"></i> Add Message</a></td></tr>
            @endforelse
        </tbody></table></div>
        @if($messages->hasPages())<div class="card-footer d-flex justify-content-between"><small>Showing {{ $messages->firstItem() }}-{{ $messages->lastItem() }} of {{ $messages->total() }}</small>{{ $messages->links() }}</div>@endif</div>
    </div>

    {{-- View Modal --}}
    @if($showViewModal && $viewMessage)
    <div class="modal fade show d-block" style="background:rgba(0,0,0,.5);z-index:1055;"><div class="modal-dialog modal-lg"><div class="modal-content">
        <div class="modal-header bg-primary text-white"><h5><i class="bi bi-eye"></i> Message Details</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div>
        <div class="modal-body"><div class="row g-3">
            <div class="col-md-6">
                <h6>Contact Information</h6>
                <p><strong>Name:</strong> {{ $viewMessage->cm_name }}</p>
                <p><strong>Email:</strong> <a href="mailto:{{ $viewMessage->cm_email }}">{{ $viewMessage->cm_email }}</a></p>
                @if($viewMessage->cm_phone)<p><strong>Phone:</strong> <a href="tel:{{ $viewMessage->cm_phone }}">{{ $viewMessage->cm_phone }}</a></p>@endif
                @if($viewMessage->cm_company)<p><strong>Company:</strong> {{ $viewMessage->cm_company }}</p>@endif
                @if($viewMessage->cm_city)<p><strong>City:</strong> {{ $viewMessage->cm_city }}</p>@endif
                @if($viewMessage->service)<p><strong>Service:</strong> {{ $viewMessage->service->os_name }}</p>@endif
            </div>
            <div class="col-md-6">
                <h6>Message Info</h6>
                <p><strong>Subject:</strong> {{ $viewMessage->cm_subject ?: 'N/A' }}</p>
                <p><strong>Priority:</strong> {!! $viewMessage->priority_badge !!}</p>
                <p><strong>Status:</strong> {!! $viewMessage->status_badge !!}</p>
                <p><strong>Source:</strong> {!! $viewMessage->source_badge !!}</p>
                @if($viewMessage->assignedTo)<p><strong>Assigned To:</strong> {{ $viewMessage->assignedTo->name }}</p>@endif
                @if($viewMessage->follow_up_date)<p><strong>Follow Up:</strong> {{ $viewMessage->follow_up_date->format('M d, Y h:i A') }}</p>@endif
            </div>
            <div class="col-12"><h6>Message</h6><div class="p-3 bg-light rounded">{{ nl2br(e($viewMessage->cm_message)) }}</div></div>
            @if($viewMessage->cm_notes)<div class="col-12"><h6>Admin Notes</h6><p class="text-muted">{{ $viewMessage->cm_notes }}</p></div>@endif
        </div></div>
        <div class="modal-footer"><button class="btn btn-secondary" wire:click="closeModals">Close</button><a href="{{ route('admin.contacts.edit', $viewMessage->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i> Edit</a></div>
    </div></div></div><div class="modal-backdrop fade show"></div>
    @endif

    {{-- Status Modal --}}
    @if($showStatusModal)
    <div class="modal fade show d-block" style="background:rgba(0,0,0,.5);z-index:1055;"><div class="modal-dialog"><div class="modal-content">
        <div class="modal-header bg-warning text-white"><h5><i class="bi bi-arrow-repeat"></i> Update Message</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div>
        <div class="modal-body">
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Status</label><select class="form-select" wire:model="newStatus"><option value="new">New</option><option value="read">Read</option><option value="contacted">Contacted</option><option value="resolved">Resolved</option><option value="closed">Closed</option></select></div>
                <div class="col-md-6"><label class="form-label">Priority</label><select class="form-select" wire:model="newPriority"><option value="low">Low</option><option value="medium">Medium</option><option value="high">High</option><option value="urgent">Urgent</option></select></div>
                <div class="col-md-6"><label class="form-label">Assign To</label><select class="form-select" wire:model="assignTo"><option value="">-- None --</option>@foreach($users as $u)<option value="{{ $u->id }}">{{ $u->name }}</option>@endforeach</select></div>
                <div class="col-md-6"><label class="form-label">Follow Up Date</label><input type="datetime-local" class="form-control" wire:model="followUpDate"></div>
                <div class="col-12"><label class="form-label">Admin Notes</label><textarea class="form-control" rows="3" wire:model="adminNotes"></textarea></div>
            </div>
        </div>
        <div class="modal-footer"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-primary" wire:click="updateStatus">Update</button></div>
    </div></div></div><div class="modal-backdrop fade show"></div>
    @endif

    {{-- Delete Modal --}}
    @if($showDeleteModal)
    <div class="modal fade show d-block" style="background:rgba(0,0,0,.5);z-index:1055;"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5><i class="bi bi-exclamation-triangle"></i> Confirm Delete</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div><div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this message?</h5></div><div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deleteMessage">Delete</button></div></div></div></div><div class="modal-backdrop fade show"></div>
    @endif
</div>

@push('styles')
<style>.table-danger{background-color:#fff5f5!important}.table-warning{background-color:#fffdf5!important}</style>
@endpush