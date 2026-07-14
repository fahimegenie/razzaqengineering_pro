<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3">Product Categories</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item active">Product Categories</li></ol></div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row g-3 mb-3">
            <div class="col-6"><div class="card border-0 shadow-sm bg-primary text-white"><div class="card-body text-center py-3"><i class="bi bi-grid display-6"></i><h3 class="mb-0 mt-1">{{ $totalCategories }}</h3><small>Total</small></div></div></div>
            <div class="col-6"><div class="card border-0 shadow-sm bg-success text-white"><div class="card-body text-center py-3"><i class="bi bi-check-circle display-6"></i><h3 class="mb-0 mt-1">{{ $activeCategories }}</h3><small>Active</small></div></div></div>
        </div>

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4"><div class="input-group"><span class="input-group-text"><i class="bi bi-search"></i></span><input type="text" class="form-control" wire:model.blur="search" placeholder="Search...">@if($search)<button class="btn btn-outline-secondary" wire:click="clearSearch"><i class="bi bi-x-lg"></i></button>@endif</div></div>
                    <div class="col-md-3"><select class="form-select" wire:model.blur="statusFilter"><option value="">All</option><option value="1">Active</option><option value="0">Inactive</option></select></div>
                    <div class="col-md-3"><select class="form-select" wire:model.blur="perPage"><option value="15">15</option><option value="30">30</option></select></div>
                    <div class="col-md-2 text-end"><a href="{{ route('admin.products.categories.create') }}" class="btn btn-primary w-100"><i class="bi bi-plus-lg"></i> Add</a></div>
                </div>
                @if(count($selectedCategories) > 0)
                <div class="mt-3 p-2 bg-light rounded d-flex gap-2"><span class="fw-semibold">{{ count($selectedCategories) }} selected</span><button class="btn btn-sm btn-success" wire:click="bulkActivate"><i class="bi bi-check-circle"></i> Activate</button><button class="btn btn-sm btn-warning" wire:click="bulkDeactivate"><i class="bi bi-pause-circle"></i> Deactivate</button><button class="btn btn-sm btn-danger" wire:click="bulkDelete"><i class="bi bi-trash"></i> Delete</button></div>
                @endif
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light"><tr><th width="40"><input type="checkbox" class="form-check-input" @checked($selectAll) wire:click="toggleSelectAll"></th><th width="60">Img</th><th>Name</th><th>Slug</th><th>Products</th><th>Status</th><th>Order</th><th width="120">Actions</th></tr></thead>
                    <tbody>
                        @forelse($categories as $cat)
                        <tr>
                            <td><input type="checkbox" class="form-check-input" @checked(in_array($cat->id, $selectedCategories)) wire:click="toggleCategorySelection({{ $cat->id }})"></td>
                            <td><img src="{{ $cat->image_url }}" style="width:40px;height:40px;object-fit:cover;border-radius:4px;"></td>
                            <td><strong>{{ $cat->pc_name }}</strong></td>
                            <td><code>{{ $cat->pc_slug }}</code></td>
                            <td><span class="badge bg-info">{{ $cat->products_count }}</span></td>
                            <td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" @checked($cat->is_active) wire:click="toggleStatus({{ $cat->id }})"></div></td>
                            <td>{{ $cat->sort_order }}</td>
                            <td><div class="btn-group btn-group-sm"><a href="{{ route('admin.products.categories.edit', $cat->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a><button class="btn btn-danger" wire:click="confirmDelete({{ $cat->id }})"><i class="bi bi-trash"></i></button></div></td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center py-5"><i class="bi bi-grid display-4 text-muted d-block"></i>No categories found<br><a href="{{ route('admin.products.categories.create') }}" class="btn btn-sm btn-primary mt-2"><i class="bi bi-plus-lg"></i> Add Category</a></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($categories->hasPages())<div class="card-footer d-flex justify-content-between"><small>Showing {{ $categories->firstItem() }}-{{ $categories->lastItem() }} of {{ $categories->total() }}</small>{{ $categories->links() }}</div>@endif
        </div>
    </div>

    @if($showDeleteModal)
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirm Delete</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div><div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this category?</h5></div><div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deleteCategory"><i class="bi bi-trash"></i> Delete</button></div></div></div></div><div class="modal-backdrop fade show"></div>
    @endif
</div>