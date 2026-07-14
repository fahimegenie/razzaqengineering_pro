<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3">Blog Tags</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Blog Tags</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body text-center py-3"><i class="bi bi-tags display-6"></i><h3 class="mb-0 mt-1">{{ $totalTags }}</h3><small>Total Tags</small></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center py-3"><i class="bi bi-check-circle display-6"></i><h3 class="mb-0 mt-1">{{ $activeTags }}</h3><small>Active</small></div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-semibold">Search</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" wire:model.blur="search" placeholder="Search tags...">
                            @if($search)<button class="btn btn-outline-secondary" wire:click="clearSearch"><i class="bi bi-x-lg"></i></button>@endif
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Status</label>
                        <select class="form-select" wire:model.blur="statusFilter">
                            <option value="">All</option><option value="1">Active</option><option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label small fw-semibold">Show</label>
                        <select class="form-select" wire:model.blur="perPage">
                            <option value="20">20</option><option value="50">50</option><option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 text-end">
                        <button class="btn btn-outline-secondary me-1" wire:click="clearFilters"><i class="bi bi-funnel"></i></button>
                        <a href="{{ route('admin.blog.tags.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Add Tag</a>
                    </div>
                </div>
                @if(count($selectedTags) > 0)
                <div class="mt-3 p-2 bg-light rounded d-flex align-items-center gap-2 flex-wrap">
                    <span class="fw-semibold me-2">{{ count($selectedTags) }} selected</span>
                    <button class="btn btn-sm btn-success" wire:click="bulkActivate"><i class="bi bi-check-circle"></i> Activate</button>
                    <button class="btn btn-sm btn-warning" wire:click="bulkDeactivate"><i class="bi bi-pause-circle"></i> Deactivate</button>
                    <button class="btn btn-sm btn-danger" wire:click="bulkDelete"><i class="bi bi-trash"></i> Delete</button>
                </div>
                @endif
            </div>
        </div>

        <div class="row g-3">
            @forelse($tags as $tag)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <div class="position-absolute top-0 start-0 m-2">
                            <input type="checkbox" class="form-check-input" @checked(in_array($tag->id, $selectedTags)) wire:click="toggleTagSelection({{ $tag->id }})">
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary fs-6 px-4 py-2 mb-2 mt-2">
                            {{ $tag->bt_name }}
                        </span>
                        <p class="text-muted small mb-2">{{ Str::limit($tag->bt_description, 80) }}</p>
                        <div class="d-flex justify-content-center gap-2 mb-2">
                            <span class="badge bg-info">{{ $tag->posts_count }} posts</span>
                            <span class="badge bg-{{ $tag->is_active ? 'success' : 'danger' }}">{{ $tag->is_active ? 'Active' : 'Inactive' }}</span>
                        </div>
                        <div class="btn-group btn-group-sm w-100">
                            <a href="{{ route('admin.blog.tags.edit', ['tagId' => $tag->id]) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-{{ $tag->is_active ? 'success' : 'secondary' }}" wire:click="toggleStatus({{ $tag->id }})"><i class="bi bi-{{ $tag->is_active ? 'toggle-on' : 'toggle-off' }}"></i></button>
                            <button class="btn btn-danger" wire:click="confirmDelete({{ $tag->id }})"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-tag display-4 text-muted d-block mb-2"></i>
                <h5>No tags found</h5>
                <a href="{{ route('admin.blog.tags.create') }}" class="btn btn-primary mt-2"><i class="bi bi-plus-lg"></i> Add First Tag</a>
            </div>
            @endforelse
        </div>

        @if($tags->hasPages())
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-footer d-flex justify-content-between">
                <small>Showing {{ $tags->firstItem() }}-{{ $tags->lastItem() }} of {{ $tags->total() }}</small>
                {{ $tags->links() }}
            </div>
        </div>
        @endif
    </div>

    @if($showDeleteModal)
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;">
        <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirm Delete</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div>
            <div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this tag?</h5><p class="text-muted">This cannot be undone.</p></div>
            <div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deleteTag"><i class="bi bi-trash"></i> Yes, Delete</button></div>
        </div></div></div><div class="modal-backdrop fade show"></div>
    @endif
</div>