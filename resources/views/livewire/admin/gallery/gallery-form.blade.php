<div>
    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">{{ $isEditing ? 'Edit Gallery Item' : 'Add New Gallery Item' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Work Gallery</a></li>
                        <li class="breadcrumb-item active">{{ $isEditing ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form wire:submit="save">
            <div class="row g-3">
                <!-- Main Content Column -->
                <div class="col-12 col-lg-8">
                    
                    <!-- Basic Info Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-info-circle me-2"></i>Gallery Item Information
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <!-- Title -->
                                <div class="col-12">
                                    <label class="form-label required">Title</label>
                                    <input type="text" 
                                           class="form-control form-control-lg @error('wg_title') is-invalid @enderror" 
                                           wire:model="wg_title"
                                           placeholder="Enter gallery item title...">
                                    @error('wg_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Type -->
                                <div class="col-md-6">
                                    <label class="form-label required">Type</label>
                                    <select class="form-select @error('wg_type') is-invalid @enderror" wire:model="wg_type">
                                        <option value="">-- Select Type --</option>
                                        @foreach($typeOptions as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('wg_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Category -->
                                <div class="col-md-6">
                                    <label class="form-label">Category</label>
                                    <input type="text" 
                                           class="form-control" 
                                           wire:model="wg_category" 
                                           placeholder="e.g., Web Design, Branding, Photography"
                                           list="categorySuggestions">
                                    <datalist id="categorySuggestions">
                                        <option value="Web Design">
                                        <option value="Branding">
                                        <option value="Photography">
                                        <option value="Mobile App">
                                        <option value="UI/UX">
                                        <option value="Logo Design">
                                        <option value="Print Media">
                                        <option value="Social Media">
                                    </datalist>
                                    <small class="text-muted">Group similar items with categories</small>
                                </div>
                                
                                <!-- Description -->
                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" 
                                              rows="5" 
                                              wire:model="wg_description" 
                                              placeholder="Describe this gallery item..."></textarea>
                                    <small class="text-muted mt-1">
                                        Characters: <span x-data x-text="$wire.wg_description ? $wire.wg_description.length : 0"></span>
                                    </small>
                                </div>
                                
                                <!-- Sort Order -->
                                <div class="col-md-6">
                                    <label class="form-label">Display Order</label>
                                    <input type="number" 
                                           class="form-control" 
                                           wire:model="sort_order" 
                                           min="0"
                                           placeholder="Display order">
                                    <small class="text-muted">Lower number = shown first</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Column -->
                <div class="col-12 col-lg-4">
                    
                    <!-- Image Upload Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6 fw-semibold">
                                <i class="bi bi-image me-2"></i>Gallery Image
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                @if($imagePreview)
                                    <img src="{{ $imagePreview }}" 
                                         class="img-fluid rounded shadow-sm mb-2" 
                                         style="max-height: 250px; width: 100%; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-2"
                                         style="height: 200px; border: 3px dashed #ccc;">
                                        <div class="text-center text-muted">
                                            <i class="bi bi-image display-3 d-block mb-2"></i>
                                            <span>No image selected</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <input type="file" 
                                   class="form-control @error('wg_image') is-invalid @enderror" 
                                   wire:model="wg_image" 
                                   accept="image/*">
                            @error('wg_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            
                            @if($imagePreview)
                                <button type="button" class="btn btn-danger btn-sm mt-2 w-100" wire:click="removeImage">
                                    <i class="bi bi-trash"></i> Remove Image
                                </button>
                            @endif
                            
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle"></i> 
                                Recommended: 1200×800px, Max 5MB<br>
                                Supported: JPG, PNG, GIF, WebP
                            </small>
                        </div>
                    </div>

                    <!-- Publishing Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6 fw-semibold">
                                <i class="bi bi-toggle-on me-2"></i>Publishing
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" wire:model="is_active" id="is_active">
                                <label class="form-check-label fw-semibold" for="is_active">Active</label>
                                <br><small class="text-muted">Gallery item will be visible on website</small>
                            </div>
                        </div>
                    </div>

                    <!-- Preview Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6 fw-semibold">
                                <i class="bi bi-eye me-2"></i>Quick Preview
                            </h3>
                        </div>
                        <div class="card-body p-2">
                            <div class="card border-0">
                                @if($imagePreview)
                                    <img src="{{ $imagePreview }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary" style="height: 150px;"></div>
                                @endif
                                <div class="card-body p-2">
                                    <h6 class="card-title mb-1 small">{{ $wg_title ?: 'Item Title' }}</h6>
                                    <div class="d-flex gap-2">
                                        @if($wg_type)
                                            <span class="badge bg-primary">{{ $typeOptions[$wg_type] ?? $wg_type }}</span>
                                        @endif
                                        @if($wg_category)
                                            <span class="badge bg-info">{{ $wg_category }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <button type="submit" 
                            class="btn btn-primary btn-lg w-100 mb-2" 
                            wire:loading.attr="disabled"
                            wire:target="save">
                        <span wire:loading.remove wire:target="save">
                            <i class="bi bi-check-lg me-1"></i> 
                            {{ $isEditing ? 'Update Item' : 'Create Item' }}
                        </span>
                        <span wire:loading wire:target="save">
                            <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                        </span>
                    </button>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        cursor: pointer;
    }
    
    .card-img-top {
        transition: all 0.3s ease;
    }
</style>
@endpush