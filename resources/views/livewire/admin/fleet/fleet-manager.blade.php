{{-- resources/views/livewire/admin/fleet/fleet-manager.blade.php --}}
<div x-data="fleetHandler()">
    <!-- Loading State -->
    <div wire:loading.delay.longest wire:target="save"
        class="position-fixed top-0 start-0 w-100 h-100 align-items-center justify-content-center" 
        style="background: rgba(0,0,0,0.3); z-index: 99999; display: none !important;"
        wire:loading.class="d-flex"
        wire:loading.style="display: flex !important;">
        <div class="bg-body p-4 rounded-3 shadow-lg text-center border border-secondary-subtle">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="visually-hidden">Saving...</span>
            </div>
            <p class="mb-0 fw-semibold">Saving fleet item...</p>
        </div>
    </div>

    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Fleet Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Fleet</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @if($saveSuccess)
        <div class="alert alert-success alert-dismissible fade show" role="alert" 
             x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <i class="bi bi-check-circle me-2"></i>Fleet item saved successfully!
            <button type="button" class="btn-close" @click="show = false"></button>
        </div>
        @endif

        <form wire:submit="save">
            <div class="row g-3">
                <!-- Tabs Navigation -->
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-2">
                            <ul class="nav nav-pills flex-nowrap overflow-auto" role="tablist">
                                @foreach($tabs as $key => $tab)
                                <li class="nav-item" role="presentation">
                                    <button type="button" 
                                            class="nav-link text-nowrap {{ $activeTab === $key ? 'active' : '' }}"
                                            wire:click="setTab('{{ $key }}')">
                                        <i class="bi {{ $tab['icon'] }} me-1"></i> {{ $tab['label'] }}
                                    </button>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="col-12">

                    {{-- ============================================ --}}
                    {{-- LIST TAB --}}
                    {{-- ============================================ --}}
                    <div class="{{ $activeTab === 'list' ? '' : 'd-none' }}">
                        <!-- Stats Cards -->
                        <div class="row g-3 mb-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="stat-card">
                                    <div class="stat-icon bg-primary">
                                        <i class="bi bi-tools"></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3>{{ $this->totalItems }}</h3>
                                        <p>Total Items</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="stat-card">
                                    <div class="stat-icon bg-success">
                                        <i class="bi bi-check-circle"></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3>{{ $this->activeItems }}</h3>
                                        <p>Active Items</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="stat-card">
                                    <div class="stat-icon bg-warning">
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3>{{ $this->featuredItems }}</h3>
                                        <p>Featured Items</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="stat-card">
                                    <div class="stat-icon bg-info">
                                        <i class="bi bi-folder"></i>
                                    </div>
                                    <div class="stat-info">
                                        <h3>{{ $this->totalCategories }}</h3>
                                        <p>Categories</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filters & Actions -->
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text bg-white">
                                                <i class="bi bi-search text-muted"></i>
                                            </span>
                                            <input type="text" 
                                                   wire:model.live.debounce.300ms="search" 
                                                   class="form-control" 
                                                   placeholder="Search fleet items...">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <select wire:model.live="filterCategory" class="form-select">
                                            <option value="">All Categories</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                    <div class="col-md-2">
                                        <select wire:model.live="perPage" class="form-select">
                                            <option value="12">12 per page</option>
                                            <option value="24">24 per page</option>
                                            <option value="48">48 per page</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 text-end">
                                        @if(count($selectedItems) > 0)
                                        <div class="btn-group me-2">
                                            <button type="button" wire:click="bulkActivate" class="btn btn-success btn-sm">
                                                <i class="bi bi-check-all"></i>
                                            </button>
                                            <button type="button" wire:click="bulkDeactivate" class="btn btn-warning btn-sm">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                            <button type="button" wire:click="bulkDelete" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                        <span class="text-muted small">{{ count($selectedItems) }} selected</span>
                                        @endif
                                        <button type="button" wire:click="create" class="btn btn-primary ms-2">
                                            <i class="bi bi-plus-circle me-1"></i> Add New Item
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fleet Items Grid -->
                        <div class="row g-4">
                            @forelse($items as $item)
                                <div class="col-xl-3 col-lg-4 col-md-6" 
                                     x-data="{ showActions: false }"
                                     @mouseenter="showActions = true"
                                     @mouseleave="showActions = false">
                                    <div class="card fleet-card h-100 border-0 shadow-sm">
                                        <div class="fleet-card-img-wrap">
                                            <img src="{{ $item->image_url }}" 
                                                 class="card-img-top" 
                                                 alt="{{ $item->title }}"
                                                 loading="lazy">
                                            
                                            <div class="fleet-select">
                                                <input type="checkbox" 
                                                       wire:model.live="selectedItems" 
                                                       value="{{ $item->id }}" 
                                                       class="form-check-input">
                                            </div>

                                            <span class="fleet-cat-badge">
                                                {{ $item->category->name ?? 'Uncategorized' }}
                                            </span>

                                            <span class="fleet-status-badge {{ $item->is_active ? 'active' : 'inactive' }}">
                                                {{ $item->is_active ? 'Active' : 'Inactive' }}
                                            </span>

                                            <div class="fleet-action-overlay" x-show="showActions" x-transition>
                                                <div class="d-flex gap-1">
                                                    <button type="button" wire:click="viewDetails({{ $item->id }})" 
                                                            class="btn btn-light btn-sm" title="View">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <button type="button" wire:click="edit({{ $item->id }})" 
                                                            class="btn btn-primary btn-sm" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button type="button" wire:click="toggleFeatured({{ $item->id }})" 
                                                            class="btn btn-{{ $item->is_featured ? 'warning' : 'outline-warning' }} btn-sm" title="Featured">
                                                        <i class="bi bi-star{{ $item->is_featured ? '-fill' : '' }}"></i>
                                                    </button>
                                                    <button type="button" wire:click="toggleStatus({{ $item->id }})" 
                                                            class="btn btn-{{ $item->is_active ? 'secondary' : 'success' }} btn-sm" title="Toggle Status">
                                                        <i class="bi bi-toggle-{{ $item->is_active ? 'off' : 'on' }}"></i>
                                                    </button>
                                                    <button type="button" wire:click="confirmDelete({{ $item->id }}, 'item')" 
                                                            class="btn btn-danger btn-sm" title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title mb-1">{{ $item->title }}</h5>
                                            <p class="card-text text-muted small mb-2">
                                                {{ Str::limit(strip_tags($item->description), 80) }}
                                            </p>
                                            
                                            @if($item->features && count($item->features) > 0)
                                                <div class="d-flex flex-wrap gap-1 mb-2">
                                                    @foreach(array_slice($item->features, 0, 2) as $feature)
                                                        <span class="badge bg-light text-dark">
                                                            <i class="bi bi-dot text-success"></i> {{ $feature }}
                                                        </span>
                                                    @endforeach
                                                    @if(count($item->features) > 2)
                                                        <span class="badge bg-light text-muted">+{{ count($item->features) - 2 }}</span>
                                                    @endif
                                                </div>
                                            @endif

                                            @if($item->manufacturer)
                                                <small class="text-muted">
                                                    <i class="bi bi-building me-1"></i>
                                                    {{ $item->manufacturer }}
                                                    @if($item->model_number) - {{ $item->model_number }} @endif
                                                </small>
                                            @endif
                                        </div>

                                        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                                            <small class="text-muted">Order: {{ $item->sort_order }}</small>
                                            @if($item->is_featured)
                                                <span class="badge bg-warning text-dark">
                                                    <i class="bi bi-star-fill me-1"></i>Featured
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <i class="bi bi-truck display-1 text-muted"></i>
                                        <h4 class="mt-3">No Fleet Items Found</h4>
                                        <p class="text-muted">Start by adding your first fleet item.</p>
                                        <button type="button" wire:click="create" class="btn btn-primary">
                                            <i class="bi bi-plus-circle me-1"></i> Add First Item
                                        </button>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        {{-- Pagination --}}
                        <div class="d-flex justify-content-center mt-4">
                            {{ $items->links() }}
                        </div>
                    </div>

                    {{-- ============================================ --}}
                    {{-- FORM TAB (Add/Edit Item) --}}
                    {{-- ============================================ --}}
                    <div class="{{ $activeTab === 'form' ? '' : 'd-none' }}">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-{{ $isEditing ? 'pencil-square' : 'plus-circle' }} me-2"></i>
                                    {{ $isEditing ? 'Edit Fleet Item' : 'Add New Fleet Item' }}
                                </h3>
                                <button type="button" class="btn btn-secondary btn-sm" wire:click="setTab('list')">
                                    <i class="bi bi-arrow-left me-1"></i> Back to List
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    {{-- Category & Title --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                        <select wire:model="fleet_category_id" class="form-select @error('fleet_category_id') is-invalid @enderror">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('fleet_category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                                        <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror" placeholder="e.g., Hilti DD 250 Core Drill">
                                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    {{-- Manufacturer & Model --}}
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Manufacturer</label>
                                        <input type="text" wire:model="manufacturer" class="form-control" placeholder="e.g., Hilti">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Model Number</label>
                                        <input type="text" wire:model="model_number" class="form-control" placeholder="e.g., DD-250">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Sort Order</label>
                                        <input type="number" wire:model="sort_order" class="form-control" min="0">
                                    </div>

                                    {{-- Description with Reusable CKEditor Component --}}
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Description</label>
                                        <livewire:components.ck-editor 
                                            label="Description" 
                                            placeholder="Enter detailed description..." 
                                            height="300px" 
                                            toolbar="full" 
                                            :value="$description"
                                            field="description"
                                            wire:model.live="description" 
                                        />
                                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    {{-- Image Upload --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Image</label>
                                        <div class="border rounded p-3 text-center">
                                            @if($imagePreview)
                                                <img src="{{ $imagePreview }}" class="img-fluid mb-2" style="max-height: 150px;">
                                            @else
                                                <div class="py-4 text-muted">
                                                    <i class="bi bi-image display-4"></i>
                                                    <p>No image selected</p>
                                                </div>
                                            @endif
                                            <input type="file" wire:model="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                            <small class="text-muted">Max: 5MB. JPG, PNG, WebP</small>
                                        </div>
                                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        <div wire:loading wire:target="image" class="mt-2">
                                            <span class="spinner-border spinner-border-sm text-primary"></span> Uploading...
                                        </div>
                                    </div>

                                    {{-- Status Toggles --}}
                                    <div class="col-md-6">
                                        <div class="card bg-light h-100">
                                            <div class="card-body">
                                                <h6 class="card-title mb-3">Settings</h6>
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox" wire:model="is_active" id="isActive">
                                                    <label class="form-check-label" for="isActive">Active</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" wire:model="is_featured" id="isFeatured">
                                                    <label class="form-check-label" for="isFeatured">Featured Item</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Features --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Key Features</label>
                                        <div class="input-group mb-2">
                                            <input type="text" wire:model="newFeature" class="form-control" placeholder="Add feature..." 
                                                   @keydown.enter.prevent="$wire.addFeature()">
                                            <button type="button" wire:click="addFeature" class="btn btn-outline-primary">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($features as $index => $feature)
                                                <span class="badge bg-primary d-flex align-items-center gap-1">
                                                    {{ $feature }}
                                                    <button type="button" wire:click="removeFeature({{ $index }})" 
                                                            class="btn-close btn-close-white" style="font-size: 0.5rem;"></button>
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- Specifications --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Technical Specifications</label>
                                        <div class="row g-2 mb-2">
                                            <div class="col-5">
                                                <input type="text" wire:model="newSpecKey" class="form-control" placeholder="Name...">
                                            </div>
                                            <div class="col-5">
                                                <input type="text" wire:model="newSpecValue" class="form-control" placeholder="Value...">
                                            </div>
                                            <div class="col-2">
                                                <button type="button" wire:click="addSpecification" class="btn btn-outline-primary w-100">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            @foreach($specifications as $key => $value)
                                                <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                                                    <span><strong>{{ $key }}:</strong> {{ $value }}</span>
                                                    <button type="button" wire:click="removeSpecification('{{ $key }}')" 
                                                            class="btn btn-sm text-danger">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- Form Actions --}}
                                    <div class="col-12 text-end mt-3 border-top pt-3">
                                        <button type="button" class="btn btn-secondary me-2" wire:click="setTab('list')">
                                            <i class="bi bi-x-lg me-1"></i> Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                            <span wire:loading.remove wire:target="save">
                                                <i class="bi bi-check-lg me-1"></i> {{ $isEditing ? 'Update' : 'Create' }}
                                            </span>
                                            <span wire:loading wire:target="save">
                                                <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ============================================ --}}
                    {{-- CATEGORIES TAB --}}
                    {{-- ============================================ --}}
                    <div class="{{ $activeTab === 'categories' ? '' : 'd-none' }}">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-folder me-2"></i>Manage Categories
                                </h3>
                            </div>
                            <div class="card-body">
                                {{-- Categories Table --}}
                                <div class="table-responsive mb-4">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="50">Icon</th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Items</th>
                                                <th>Order</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($categories as $category)
                                                <tr>
                                                    <td>
                                                        @if($category->icon)
                                                            <i class="bi bi-{{ $category->icon }} fs-5"></i>
                                                        @else
                                                            <i class="bi bi-folder text-muted fs-5"></i>
                                                        @endif
                                                    </td>
                                                    <td class="fw-semibold">{{ $category->name }}</td>
                                                    <td><code>{{ $category->slug }}</code></td>
                                                    <td>
                                                        <span class="badge bg-secondary">{{ $category->fleetItems()->count() }}</span>
                                                    </td>
                                                    <td>{{ $category->sort_order }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $category->is_active ? 'success' : 'secondary' }}">
                                                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <button type="button" wire:click="editCategory({{ $category->id }})" class="btn btn-outline-primary">
                                                                <i class="bi bi-pencil"></i>
                                                            </button>
                                                            <button type="button" wire:click="confirmDelete({{ $category->id }}, 'category')" 
                                                                    class="btn btn-outline-danger"
                                                                    @if($category->fleetItems()->count() > 0) disabled @endif>
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-4 text-muted">
                                                        No categories found. Create your first category below.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Category Form --}}
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="mb-3">{{ $isEditingCategory ? 'Edit' : 'Add New' }} Category</h6>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                                                <input type="text" wire:model="categoryName" class="form-control" placeholder="Category name">
                                                @error('categoryName') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Icon (Bootstrap Icon)</label>
                                                <input type="text" wire:model="categoryIcon" class="form-control" placeholder="e.g., gear, wrench, tools">
                                                <small class="text-muted">Use Bootstrap Icons name without "bi-" prefix</small>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label fw-semibold">Sort Order</label>
                                                <input type="number" wire:model="categorySortOrder" class="form-control" min="0">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label fw-semibold d-block">Active</label>
                                                <div class="form-check form-switch mt-1">
                                                    <input class="form-check-input" type="checkbox" wire:model="categoryIsActive">
                                                </div>
                                            </div>
                                            <div class="col-12 text-end">
                                                @if($isEditingCategory)
                                                    <button type="button" wire:click="resetCategoryForm" class="btn btn-secondary me-2">
                                                        <i class="bi bi-x-lg me-1"></i> Cancel Edit
                                                    </button>
                                                @endif
                                                <button type="button" wire:click="saveCategory" class="btn btn-info text-white">
                                                    <i class="bi bi-check-lg me-1"></i>
                                                    {{ $isEditingCategory ? 'Update' : 'Create' }} Category
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

    {{-- ============================================ --}}
    {{-- DELETE CONFIRMATION MODAL --}}
    {{-- ============================================ --}}
    @if($showDeleteModal)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle me-2"></i> Confirm Delete
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="$set('showDeleteModal', false)"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong>{{ $deleteItemTitle }}</strong>?</p>
                    <p class="text-danger mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('showDeleteModal', false)">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">
                        <i class="bi bi-trash me-1"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ============================================ --}}
    {{-- DETAIL MODAL --}}
    {{-- ============================================ --}}
    @if($showDetailModal && $detailItem)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-info-circle me-2"></i>
                        {{ $detailItem->title }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeDetailModal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ $detailItem->image_url }}" class="img-fluid rounded" alt="{{ $detailItem->title }}">
                        </div>
                        <div class="col-md-6">
                            <h4>{{ $detailItem->title }}</h4>
                            <div class="text-muted">{!! $detailItem->description !!}</div>
                            
                            @if($detailItem->manufacturer)
                                <p class="mt-3"><strong>Manufacturer:</strong> {{ $detailItem->manufacturer }}</p>
                            @endif
                            @if($detailItem->model_number)
                                <p><strong>Model:</strong> {{ $detailItem->model_number }}</p>
                            @endif
                            @if($detailItem->category)
                                <p><strong>Category:</strong> {{ $detailItem->category->name }}</p>
                            @endif
                            
                            @if($detailItem->features && count($detailItem->features) > 0)
                                <h6 class="mt-3">Key Features:</h6>
                                <ul class="list-unstyled">
                                    @foreach($detailItem->features as $feature)
                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            
                            @if($detailItem->specifications && count($detailItem->specifications) > 0)
                                <h6 class="mt-3">Specifications:</h6>
                                <table class="table table-sm table-bordered">
                                    @foreach($detailItem->specifications as $key => $value)
                                        <tr>
                                            <td class="fw-bold bg-light">{{ $key }}</td>
                                            <td>{{ $value }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeDetailModal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="edit({{ $detailItem->id }})">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('styles')
<style>
    .stat-card {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }
    .stat-info h3 { margin: 0; font-size: 1.5rem; font-weight: 700; }
    .stat-info p { margin: 0; color: #888; font-size: 0.85rem; }
    .fleet-card { transition: all 0.3s ease; border-radius: 12px; overflow: hidden; }
    .fleet-card:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important; }
    .fleet-card-img-wrap { position: relative; height: 200px; overflow: hidden; }
    .fleet-card-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; }
    .fleet-card:hover .fleet-card-img-wrap img { transform: scale(1.05); }
    .fleet-select { position: absolute; top: 10px; left: 10px; z-index: 3; }
    .fleet-cat-badge { position: absolute; top: 40px; left: 10px; background: #0056b3; color: white; padding: 3px 10px; border-radius: 4px; font-size: 0.65rem; font-weight: 700; letter-spacing: 1px; z-index: 2; }
    .fleet-status-badge { position: absolute; top: 10px; right: 10px; padding: 3px 10px; border-radius: 4px; font-size: 0.65rem; font-weight: 700; z-index: 2; }
    .fleet-status-badge.active { background: #28a745; color: white; }
    .fleet-status-badge.inactive { background: #6c757d; color: white; }
    .fleet-action-overlay { position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.8); padding: 10px; display: flex; justify-content: center; }
    [x-cloak] { display: none !important; }
</style>
@endpush