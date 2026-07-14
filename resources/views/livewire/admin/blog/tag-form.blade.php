<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3">{{ $isEditing ? 'Edit Tag' : 'Create New Tag' }}</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.blog.tags.index') }}">Blog Tags</a></li>
                        <li class="breadcrumb-item active">{{ $isEditing ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form wire:submit="save">
            <div class="row g-3">
                <div class="col-12 col-lg-8">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-tag me-2"></i>Tag Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label required">Tag Name</label>
                                    <input type="text" class="form-control form-control-lg @error('bt_name') is-invalid @enderror" 
                                           wire:model.live="bt_name" placeholder="Enter tag name...">
                                    @error('bt_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label required">Slug</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('bt_slug') is-invalid @enderror" 
                                               wire:model="bt_slug" placeholder="tag-slug">
                                        <button type="button" class="btn btn-outline-secondary" wire:click="generateSlug">
                                            <i class="bi bi-arrow-repeat"></i> Generate
                                        </button>
                                        @error('bt_slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Display Order</label>
                                    <input type="number" class="form-control" wire:model="sort_order" min="0" placeholder="0">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" rows="3" wire:model="bt_description" placeholder="Brief description..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-toggle-on me-2"></i>Publishing</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" wire:model="is_active" id="is_active">
                                <label class="form-check-label fw-semibold" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-eye me-2"></i>Preview</h3>
                        </div>
                        <div class="card-body text-center">
                            <span class="badge bg-primary bg-opacity-10 text-primary fs-6 px-4 py-2">
                                {{ $bt_name ?: 'Tag Name' }}
                            </span>
                            @if($bt_description)
                                <p class="text-muted small mt-2">{{ $bt_description }}</p>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-2" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="save">
                            <i class="bi bi-check-lg me-1"></i> {{ $isEditing ? 'Update Tag' : 'Create Tag' }}
                        </span>
                        <span wire:loading wire:target="save">
                            <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                        </span>
                    </button>
                    <a href="{{ route('admin.blog.tags.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
.form-switch .form-check-input { width: 3em; height: 1.5em; cursor: pointer; }
</style>
@endpush