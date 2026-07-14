<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3">Blog Categories</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Blog Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Stats -->
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-folder display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $totalCategories }}</h3>
                        <small>Total Categories</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-check-circle display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $activeCategories }}</h3>
                        <small>Active</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-warning text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-star-fill display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $featuredCategories }}</h3>
                        <small>Featured</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-diagram-3 display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $parentCategories }}</h3>
                        <small>Parent Categories</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toolbar -->
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-md-3">
                        <label class="form-label small fw-semibold">Search</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" wire:model.blur="search" placeholder="Search categories...">
                            @if($search)<button class="btn btn-outline-secondary" wire:click="clearSearch"><i class="bi bi-x-lg"></i></button>@endif
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Status</label>
                        <select class="form-select" wire:model.blur="statusFilter">
                            <option value="">All</option><option value="1">Active</option><option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Featured</label>
                        <select class="form-select" wire:model.blur="featuredFilter">
                            <option value="">All</option><option value="1">Featured</option><option value="0">Not Featured</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Level</label>
                        <select class="form-select" wire:model.blur="parentFilter">
                            <option value="">All</option><option value="parent">Parent Only</option><option value="child">Child Only</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3 text-end">
                        <button class="btn btn-outline-secondary me-1" wire:click="clearFilters"><i class="bi bi-funnel"></i></button>
                        <a href="{{ route('admin.blog.categories.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Add Category</a>
                    </div>
                </div>
                @if(count($selectedCategories) > 0)
                <div class="mt-3 p-2 bg-light rounded d-flex align-items-center gap-2 flex-wrap">
                    <span class="fw-semibold me-2">{{ count($selectedCategories) }} selected</span>
                    <button class="btn btn-sm btn-success" wire:click="bulkActivate"><i class="bi bi-check-circle"></i> Activate</button>
                    <button class="btn btn-sm btn-warning" wire:click="bulkDeactivate"><i class="bi bi-pause-circle"></i> Deactivate</button>
                    <button class="btn btn-sm btn-danger" wire:click="bulkDelete"><i class="bi bi-trash"></i> Delete</button>
                </div>
                @endif
            </div>
        </div>

        <!-- Table -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="40"><input type="checkbox" class="form-check-input" @checked($selectAll) wire:click="toggleSelectAll"></th>
                                <th width="60">Image</th>
                                <th wire:click="sortBy('bc_name')" style="cursor:pointer;">Name @if($sortField==='bc_name')<i class="bi bi-arrow-{{ $sortDirection==='asc'?'up':'down' }}"></i>@endif</th>
                                <th>Slug</th>
                                <th>Posts</th>
                                <th wire:click="sortBy('is_active')" style="cursor:pointer;" width="90">Status</th>
                                <th wire:click="sortBy('is_featured')" style="cursor:pointer;" width="90">Featured</th>
                                <th wire:click="sortBy('sort_order')" style="cursor:pointer;" width="80">Order</th>
                                <th width="140">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <td><input type="checkbox" class="form-check-input" @checked(in_array($category->id, $selectedCategories)) wire:click="toggleCategorySelection({{ $category->id }})"></td>
                                <td>
                                    <img src="{{ $category->image_url }}" class="rounded" style="width:40px;height:40px;object-fit:cover;">
                                </td>
                                <td>
                                    <strong>{{ Str::limit($category->bc_name, 40) }}</strong>
                                    @if($category->parent)<br><small class="text-muted">↳ {{ $category->parent->bc_name }}</small>@endif
                                </td>
                                <td><code>{{ $category->bc_slug }}</code></td>
                                <td><span class="badge bg-info">{{ $category->posts_count }}</span></td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" @checked($category->is_active) wire:click="toggleStatus({{ $category->id }})">
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-{{ $category->is_featured ? 'warning' : 'outline-warning' }}" wire:click="toggleFeatured({{ $category->id }})">
                                        <i class="bi bi-star{{ $category->is_featured ? '-fill' : '' }}"></i>
                                    </button>
                                </td>
                                <td>{{ $category->sort_order }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.blog.categories.edit', ['categoryId' => $category->id]) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-danger" wire:click="confirmDelete({{ $category->id }})"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="9" class="text-center py-5">
                                <i class="bi bi-folder2-open display-4 text-muted d-block mb-2"></i>
                                No categories found. <a href="{{ route('admin.blog.categories.create') }}" class="btn btn-sm btn-primary mt-2"><i class="bi bi-plus-lg"></i> Add Category</a>
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($categories->hasPages())
            <div class="card-footer d-flex justify-content-between">
                <small>Showing {{ $categories->firstItem() }}-{{ $categories->lastItem() }} of {{ $categories->total() }}</small>
                {{ $categories->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Delete Modal -->
    @if($showDeleteModal)
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;">
        <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirm Delete</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div>
            <div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this category?</h5><p class="text-muted">This cannot be undone.</p></div>
            <div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deleteCategory"><i class="bi bi-trash"></i> Yes, Delete</button></div>
        </div></div></div><div class="modal-backdrop fade show"></div>
    @endif
</div>

@push('styles')
<style>
.form-switch .form-check-input { width: 3em; height: 1.5em; cursor: pointer; }
</style>
@endpush