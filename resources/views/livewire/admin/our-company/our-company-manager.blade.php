{{-- resources/views/livewire/admin/our-company/our-company-manager.blade.php --}}
<div>
    <!-- Loading Overlay -->
    <div wire:loading.delay.longest wire:target="save"
        class="position-fixed top-0 start-0 w-100 h-100 align-items-center justify-content-center" 
        style="background: rgba(0,0,0,0.3); z-index: 99999; display: none !important;"
        wire:loading.class="d-flex"
        wire:loading.style="display: flex !important;">
        <div class="bg-body p-4 rounded-3 shadow-lg text-center border border-secondary-subtle">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="visually-hidden">Saving...</span>
            </div>
            <p class="mb-0 fw-semibold">Saving company data...</p>
        </div>
    </div>

    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Our Companies</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Our Companies</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @if($saveSuccess)
        <div class="alert alert-success alert-dismissible fade show" role="alert" 
             x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <i class="bi bi-check-circle me-2"></i>Company saved successfully!
            <button type="button" class="btn-close" @click="show = false"></button>
        </div>
        @endif

        <!-- Stats -->
        <div class="row g-3 mb-4">
            <div class="col-xl-6 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon bg-primary"><i class="bi bi-building"></i></div>
                    <div class="stat-info">
                        <h3>{{ $this->totalCompanies }}</h3>
                        <p>Total Companies</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon bg-success"><i class="bi bi-check-circle"></i></div>
                    <div class="stat-info">
                        <h3>{{ $this->activeCompanies }}</h3>
                        <p>Active Companies</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters & Actions -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" wire:model.live.debounce.300ms="search" class="form-control" placeholder="Search companies...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select wire:model.live="filterCategory" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select wire:model.live="filterStatus" class="form-select">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-3 text-end">
                        @if(count($selectedItems) > 0)
                            <button type="button" wire:click="bulkDelete" class="btn btn-danger btn-sm me-2">
                                <i class="bi bi-trash"></i> Delete ({{ count($selectedItems) }})
                            </button>
                        @endif
                        <button wire:click="create" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i> Add Company
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Companies Grid / Form Toggle -->
        @if(!$showForm)
            {{-- LIST VIEW --}}
            <div class="row g-4">
                @forelse($items as $item)
                    <div class="col-xl-4 col-lg-6 col-md-6" x-data="{ showActions: false }"
                         @mouseenter="showActions = true" @mouseleave="showActions = false">
                        <div class="card company-card h-100 border-0 shadow-sm">
                            <div class="company-card-img-wrap">
                                <img src="{{ $item->image1_url }}" alt="{{ $item->oc_title }}" loading="lazy">
                                <div class="company-select">
                                    <input type="checkbox" wire:model.live="selectedItems" value="{{ $item->id }}" class="form-check-input">
                                </div>
                                <span class="company-cat-badge">{{ $item->our_company_category ?? 'General' }}</span>
                                <span class="company-status-badge {{ $item->is_active ? 'active' : 'inactive' }}">
                                    {{ $item->is_active ? 'Active' : 'Inactive' }}
                                </span>
                                <div class="company-action-overlay" x-show="showActions" x-transition>
                                    <div class="d-flex gap-1">
                                        <button type="button" wire:click="edit({{ $item->id }})" class="btn btn-light btn-sm" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" wire:click="toggleStatus({{ $item->id }})" class="btn btn-warning btn-sm" title="Toggle Status">
                                            <i class="bi bi-toggle-{{ $item->is_active ? 'on' : 'off' }}"></i>
                                        </button>
                                        <button type="button" wire:click="confirmDelete({{ $item->id }})" class="btn btn-danger btn-sm" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title mb-1">{{ $item->oc_title }}</h5>
                                <p class="text-muted small mb-2">{!! $item->short_description !!}</p>
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    @if($item->established_year)
                                        <span class="badge bg-info"><i class="bi bi-calendar me-1"></i>Est. {{ $item->established_year }}</span>
                                    @endif
                                    @if($item->company_type)
                                        <span class="badge bg-secondary">{{ $item->company_type }}</span>
                                    @endif
                                    @if($item->company_age > 0)
                                        <span class="badge bg-success">{{ $item->company_age }}+ Years</span>
                                    @endif
                                </div>
                                @if($item->has_ceo)
                                    <div class="mt-2 d-flex align-items-center gap-2 border-top pt-2">
                                        <img src="{{ $item->ceo_image_url }}" class="rounded-circle" width="32" height="32" style="object-fit:cover;">
                                        <small class="text-muted fw-semibold">{{ $item->ceo_name }}</small>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                                <small class="text-muted"><i class="bi bi-sort-down me-1"></i>Order: {{ $item->sort_order }}</small>
                                <small class="text-muted"><i class="bi bi-images me-1"></i>{{ $item->image_count }} images</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-building display-1 text-muted"></i>
                        <h4 class="mt-3">No Companies Found</h4>
                        <p class="text-muted">Start by adding your first company.</p>
                        <button wire:click="create" class="btn btn-primary mt-2">
                            <i class="bi bi-plus-circle me-1"></i> Add First Company
                        </button>
                    </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-center mt-4">{{ $items->links() }}</div>
        @else
            {{-- FORM VIEW --}}
            <form wire:submit="save">
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0 fw-semibold">
                            <i class="bi bi-{{ $isEditing ? 'pencil-square' : 'plus-circle' }} me-2"></i>
                            {{ $isEditing ? 'Edit Company' : 'Add New Company' }}
                        </h3>
                        <button type="button" class="btn btn-secondary btn-sm" wire:click="$set('showForm', false)">
                            <i class="bi bi-arrow-left me-1"></i> Back to List
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            {{-- Basic Info --}}
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Company Title <span class="text-danger">*</span></label>
                                <input type="text" wire:model="oc_title" class="form-control @error('oc_title') is-invalid @enderror" placeholder="e.g., Razzaq Engineering Services">
                                @error('oc_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold d-block">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" wire:model="is_active" id="isActive">
                                    <label class="form-check-label" for="isActive">Active</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Category</label>
                                <input type="text" wire:model="our_company_category" class="form-control" list="categoryList" placeholder="e.g., Engineering, Construction">
                                <datalist id="categoryList">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}">
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Company Type</label>
                                <input type="text" wire:model="company_type" class="form-control" placeholder="e.g., Private Limited">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Established Year</label>
                                <input type="text" wire:model="established_year" class="form-control" placeholder="e.g., 2010" maxlength="4">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Sort Order</label>
                                <input type="number" wire:model="sort_order" class="form-control" min="0" placeholder="0">
                            </div>
                            
                            {{-- Description - USING SAME PATTERN AS FAQ --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">Description</label>
                                <div wire:ignore>
                                    <textarea 
                                        id="company-description-editor" 
                                        class="form-control @error('oc_description') is-invalid @enderror"
                                    >{{ $oc_description }}</textarea>
                                </div>
                                @error('oc_description') <small class="text-danger">{{ $message }}</small> @enderror
                                <small class="text-muted">Provide detailed information about the company.</small>
                            </div>
                        </div>

                        {{-- Images Section --}}
                        <h5 class="mt-4 mb-3 fw-semibold"><i class="bi bi-images me-2"></i>Company Images</h5>
                        <div class="row g-3">
                            @foreach([1 => 'image1Preview', 2 => 'image2Preview', 3 => 'image3Preview', 4 => 'image4Preview'] as $num => $previewVar)
                                <div class="col-md-3">
                                    <div class="border rounded p-2 text-center h-100">
                                        <label class="form-label small fw-semibold">Image {{ $num }}</label>
                                        @if($this->$previewVar)
                                            <img src="{{ $this->$previewVar }}" class="img-fluid mb-2 rounded" style="max-height:120px;width:100%;object-fit:cover;">
                                            @if($isEditing)
                                                <button type="button" wire:click="removeImage({{ $itemId }}, {{ $num }})" class="btn btn-danger btn-sm w-100 mb-1">
                                                    <i class="bi bi-trash"></i> Remove
                                                </button>
                                            @endif
                                        @else
                                            <div class="py-3 text-muted">
                                                <i class="bi bi-image fs-1"></i>
                                                <p class="small mb-0">No image</p>
                                            </div>
                                        @endif
                                        <input type="file" wire:model="oc_image{{ $num }}" class="form-control form-control-sm mt-1" accept="image/*">
                                        <div wire:loading wire:target="oc_image{{ $num }}" class="mt-1">
                                            <small class="text-primary"><span class="spinner-border spinner-border-sm"></span> Uploading...</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- CEO Section --}}
                        <h5 class="mt-4 mb-3 fw-semibold"><i class="bi bi-person-badge me-2"></i>CEO / Director Info</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">CEO Name</label>
                                <input type="text" wire:model="ceo_name" class="form-control" placeholder="e.g., Muhammad Razzaq">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">CEO Image</label>
                                <div class="border rounded p-2 text-center">
                                    @if($ceoImagePreview)
                                        <img src="{{ $ceoImagePreview }}" class="rounded-circle mb-2" style="width:80px;height:80px;object-fit:cover;">
                                        @if($isEditing)
                                            <button type="button" wire:click="removeCeoImage({{ $itemId }})" class="btn btn-danger btn-sm w-100 mb-1">
                                                <i class="bi bi-trash"></i> Remove
                                            </button>
                                        @endif
                                    @else
                                        <div class="py-3 text-muted">
                                            <i class="bi bi-person-circle fs-1"></i>
                                        </div>
                                    @endif
                                    <input type="file" wire:model="ceo_image" class="form-control form-control-sm" accept="image/*">
                                    <div wire:loading wire:target="ceo_image" class="mt-1">
                                        <small class="text-primary"><span class="spinner-border spinner-border-sm"></span> Uploading...</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">CEO Message</label>
                                <textarea wire:model="ceo_message" class="form-control" rows="4" placeholder="Enter CEO message..."></textarea>
                            </div>
                        </div>

                        {{-- Form Actions --}}
                        <div class="text-end mt-4 border-top pt-3">
                            <button type="button" class="btn btn-secondary me-2" wire:click="$set('showForm', false)">
                                <i class="bi bi-x-lg me-1"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary btn-lg" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="save">
                                    <i class="bi bi-check-lg me-1"></i> {{ $isEditing ? 'Update Company' : 'Create Company' }}
                                </span>
                                <span wire:loading wire:target="save">
                                    <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>

    {{-- DELETE MODAL --}}
    @if($showDeleteModal)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="$set('showDeleteModal', false)"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong>{{ $deleteItemTitle }}</strong>?</p>
                    <p class="text-danger mb-0">This action cannot be undone. All associated images will also be deleted.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('showDeleteModal', false)">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">
                        <i class="bi bi-trash me-1"></i> Delete Permanently
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('styles')
<style>
    .stat-card { display: flex; align-items: center; gap: 15px; padding: 20px; background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; }
    .stat-info h3 { margin: 0; font-size: 1.5rem; font-weight: 700; }
    .stat-info p { margin: 0; color: #888; font-size: 0.85rem; }
    .company-card { transition: all 0.3s ease; border-radius: 12px; overflow: hidden; }
    .company-card:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important; }
    .company-card-img-wrap { position: relative; height: 200px; overflow: hidden; }
    .company-card-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; }
    .company-card:hover .company-card-img-wrap img { transform: scale(1.05); }
    .company-select { position: absolute; top: 10px; left: 10px; z-index: 3; }
    .company-cat-badge { position: absolute; top: 40px; left: 10px; background: #0056b3; color: white; padding: 3px 10px; border-radius: 4px; font-size: 0.65rem; font-weight: 700; letter-spacing: 1px; z-index: 2; }
    .company-status-badge { position: absolute; top: 10px; right: 10px; padding: 3px 10px; border-radius: 4px; font-size: 0.65rem; font-weight: 700; z-index: 2; }
    .company-status-badge.active { background: #28a745; color: white; }
    .company-status-badge.inactive { background: #6c757d; color: white; }
    .company-action-overlay { position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.8); padding: 10px; display: flex; justify-content: center; }
    .ck-editor__editable { min-height: 250px; max-height: 400px; }
    @media (max-width: 768px) { .ck-editor__editable { min-height: 200px; } }
    [x-cloak] { display: none !important; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        let companyEditor = null;
        
        function initCompanyEditor() {
            const editorElement = document.getElementById('company-description-editor');
            if (!editorElement) return;
            
            // Destroy existing editor if any
            if (companyEditor) {
                companyEditor.destroy().then(() => {
                    companyEditor = null;
                    createEditor(editorElement);
                }).catch(() => {
                    companyEditor = null;
                    createEditor(editorElement);
                });
            } else {
                createEditor(editorElement);
            }
        }
        
        function createEditor(element) {
            ClassicEditor
                .create(element, {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', 'strikethrough', '|',
                            'link', 'blockQuote', '|',
                            'bulletedList', 'numberedList', '|',
                            'outdent', 'indent', '|',
                            'undo', 'redo', '|',
                            'fontSize', 'fontFamily', 'fontColor', 'highlight', '|',
                            'alignment', '|',
                            'removeFormat'
                        ]
                    },
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        ]
                    },
                    placeholder: 'Enter company description...'
                })
                .then(editor => {
                    companyEditor = editor;
                    element.ckeditorInstance = editor;
                    
                    // Sync content to Livewire
                    editor.model.document.on('change:data', () => {
                        const data = editor.getData();
                        @this.set('oc_description', data, false);
                    });
                })
                .catch(error => {
                    console.error('CKEditor Error:', error);
                });
        }
        
        // Initialize on page load
        setTimeout(initCompanyEditor, 300);
        
        // Re-initialize when form becomes visible
        Livewire.hook('morph.updated', ({ el, component }) => {
            if (component.name === 'admin.our-company.our-company-manager') {
                setTimeout(initCompanyEditor, 300);
            }
        });
        
        // Watch for showForm changes
        Livewire.on('form-opened', () => {
            setTimeout(initCompanyEditor, 300);
        });
    });
</script>
@endpush