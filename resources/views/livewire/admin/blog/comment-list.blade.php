<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3">Blog Comments</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Comments</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row g-3 mb-3">
            <div class="col-4">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body text-center py-3"><i class="bi bi-chat-dots display-6"></i><h3 class="mb-0 mt-1">{{ $totalComments }}</h3><small>Total</small></div>
                </div>
            </div>
            <div class="col-4">
                <div class="card border-0 shadow-sm bg-warning text-white">
                    <div class="card-body text-center py-3"><i class="bi bi-clock display-6"></i><h3 class="mb-0 mt-1">{{ $pendingComments }}</h3><small>Pending</small></div>
                </div>
            </div>
            <div class="col-4">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center py-3"><i class="bi bi-check-circle display-6"></i><h3 class="mb-0 mt-1">{{ $approvedComments }}</h3><small>Approved</small></div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" wire:model.blur="search" placeholder="Search comments...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" wire:model.blur="statusFilter">
                            <option value="">All Status</option><option value="pending">Pending</option><option value="approved">Approved</option><option value="rejected">Rejected</option><option value="spam">Spam</option>
                        </select>
                    </div>
                    @if(count($selectedComments) > 0)
                    <div class="col-md-5 text-end">
                        <button class="btn btn-sm btn-success" wire:click="bulkApprove"><i class="bi bi-check-circle"></i> Approve</button>
                        <button class="btn btn-sm btn-danger" wire:click="bulkDelete"><i class="bi bi-trash"></i> Delete</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="40"><input type="checkbox" class="form-check-input" @checked($selectAll) wire:click="$toggle('selectAll')"></th>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>Post</th>
                            <th width="80">Status</th>
                            <th width="100">Date</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($comments as $comment)
                        <tr>
                            <td><input type="checkbox" class="form-check-input" value="{{ $comment->id }}" wire:model="selectedComments"></td>
                            <td>
                                <strong>{{ $comment->commenter_name }}</strong><br>
                                <small class="text-muted">{{ $comment->commenter_email }}</small>
                            </td>
                            <td><small>{{ Str::limit($comment->comment_content, 100) }}</small></td>
                            <td><small>{{ $comment->post->bp_title ?? 'N/A' }}</small></td>
                            <td>
                                @if($comment->comment_status === 'approved')<span class="badge bg-success">Approved</span>
                                @elseif($comment->comment_status === 'pending')<span class="badge bg-warning">Pending</span>
                                @elseif($comment->comment_status === 'rejected')<span class="badge bg-danger">Rejected</span>
                                @else<span class="badge bg-dark">Spam</span>@endif
                            </td>
                            <td><small>{{ $comment->created_at->format('M d, Y') }}</small></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if($comment->comment_status !== 'approved')<button class="btn btn-success" wire:click="approve({{ $comment->id }})"><i class="bi bi-check-lg"></i></button>@endif
                                    @if($comment->comment_status !== 'rejected')<button class="btn btn-warning" wire:click="reject({{ $comment->id }})"><i class="bi bi-x-lg"></i></button>@endif
                                    <button class="btn btn-dark" wire:click="markAsSpam({{ $comment->id }})"><i class="bi bi-shield"></i></button>
                                    <button class="btn btn-danger" wire:click="confirmDelete({{ $comment->id }})"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center py-5"><i class="bi bi-chat display-4 text-muted d-block"></i>No comments found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($comments->hasPages())
            <div class="card-footer d-flex justify-content-between"><small>Showing {{ $comments->firstItem() }}-{{ $comments->lastItem() }} of {{ $comments->total() }}</small>{{ $comments->links() }}</div>
            @endif
        </div>
    </div>

    @if($showDeleteModal)
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;">
        <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Delete Comment</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div>
            <div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this comment?</h5></div>
            <div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deleteComment">Delete</button></div>
        </div></div></div><div class="modal-backdrop fade show"></div>
    @endif
</div>