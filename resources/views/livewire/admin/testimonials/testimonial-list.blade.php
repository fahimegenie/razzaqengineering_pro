<div>
    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Testimonial Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Testimonials</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Statistics Cards -->
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-chat-quote display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $totalTestimonials }}</h3>
                        <small>Total Testimonials</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-check-circle display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $activeTestimonials }}</h3>
                        <small>Active</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-warning text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-star-fill display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $featuredTestimonials }}</h3>
                        <small>Featured</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-bar-chart display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $averageRating }}</h3>
                        <small>Avg Rating</small>
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
                            <input type="text" class="form-control" wire:model.blur="search" placeholder="Search testimonials...">
                            @if($search)
                                <button class="btn btn-outline-secondary" wire:click="clearSearch">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Rating</label>
                        <select class="form-select" wire:model.blur="ratingFilter">
                            <option value="">All Ratings</option>
                            <option value="5">★★★★★ (5)</option>
                            <option value="4">★★★★☆ (4)</option>
                            <option value="3">★★★☆☆ (3)</option>
                            <option value="2">★★☆☆☆ (2)</option>
                            <option value="1">★☆☆☆☆ (1)</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Status</label>
                        <select class="form-select" wire:model.blur="statusFilter">
                            <option value="">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Featured</label>
                        <select class="form-select" wire:model.blur="featuredFilter">
                            <option value="">All</option>
                            <option value="1">Featured</option>
                            <option value="0">Not Featured</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3 text-end">
                        <button class="btn btn-outline-secondary me-1" wire:click="clearFilters" title="Clear Filters">
                            <i class="bi bi-funnel"></i>
                        </button>
                        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Add Testimonial
                        </a>
                    </div>
                </div>
                
                @if(count($selectedTestimonials) > 0)
                <div class="mt-3 p-2 bg-light rounded d-flex align-items-center gap-2 flex-wrap">
                    <span class="fw-semibold me-2">{{ count($selectedTestimonials) }} selected</span>
                    <button class="btn btn-sm btn-success" wire:click="bulkActivate">
                        <i class="bi bi-check-circle"></i> Activate
                    </button>
                    <button class="btn btn-sm btn-warning" wire:click="bulkDeactivate">
                        <i class="bi bi-pause-circle"></i> Deactivate
                    </button>
                    <button class="btn btn-sm btn-info" wire:click="bulkFeature">
                        <i class="bi bi-star"></i> Feature
                    </button>
                    <button class="btn btn-sm btn-danger" wire:click="bulkDelete">
                        <i class="bi bi-trash"></i> Delete
                    </button>
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
                                <th width="40">
                                    <input type="checkbox" class="form-check-input" @checked($selectAll) wire:click="toggleSelectAll">
                                </th>
                                <th width="60">Photo</th>
                                <th wire:click="sortBy('t_name')" style="cursor:pointer;">
                                    Client 
                                    @if($sortField === 't_name')
                                        <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th>Company</th>
                                <th wire:click="sortBy('t_rating')" style="cursor:pointer;">
                                    Rating
                                    @if($sortField === 't_rating')
                                        <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th wire:click="sortBy('is_active')" style="cursor:pointer;" width="90">Status</th>
                                <th wire:click="sortBy('is_featured')" style="cursor:pointer;" width="90">Featured</th>
                                <th wire:click="sortBy('sort_order')" style="cursor:pointer;" width="80">Order</th>
                                <th wire:click="sortBy('created_at')" style="cursor:pointer;" width="100">
                                    Date
                                    @if($sortField === 'created_at')
                                        <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th width="160">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($testimonials as $testimonial)
                            <tr>
                                <td>
                                    <input type="checkbox" 
                                           class="form-check-input" 
                                           @checked(in_array($testimonial->id, $selectedTestimonials)) 
                                           wire:click="toggleTestimonialSelection({{ $testimonial->id }})">
                                </td>
                                <td>
                                    <img src="{{ $testimonial->image_url }}" 
                                         alt="{{ $testimonial->t_name }}" 
                                         class="rounded-circle" 
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                </td>
                                <td>
                                    <strong>{{ Str::limit($testimonial->t_name, 30) }}</strong>
                                    @if($testimonial->t_designation)
                                        <br><small class="text-muted">{{ Str::limit($testimonial->t_designation, 30) }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($testimonial->t_company)
                                        <span class="badge bg-secondary">{{ $testimonial->t_company }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= $testimonial->t_rating ? '-fill' : '' }}"></i>
                                        @endfor
                                    </span>
                                    <small class="ms-1">{{ $testimonial->t_rating }}/5</small>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               @checked($testimonial->is_active) 
                                               wire:click="toggleStatus({{ $testimonial->id }})">
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-{{ $testimonial->is_featured ? 'warning' : 'outline-warning' }}" 
                                            wire:click="toggleFeatured({{ $testimonial->id }})"
                                            title="Toggle Featured">
                                        <i class="bi bi-star{{ $testimonial->is_featured ? '-fill' : '' }}"></i>
                                    </button>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">{{ $testimonial->sort_order }}</span>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $testimonial->created_at->format('M d, Y') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-info" 
                                                wire:click="viewTestimonialDetails({{ $testimonial->id }})" 
                                                title="View">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.testimonials.edit', ['testimonialId' => $testimonial->id]) }}" 
                                           class="btn btn-primary" 
                                           title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn btn-danger" 
                                                wire:click="confirmDelete({{ $testimonial->id }})" 
                                                title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center py-5">
                                    <i class="bi bi-chat-square-quote display-4 text-muted d-block mb-2"></i>
                                    <h5 class="text-muted">No testimonials found</h5>
                                    <p class="text-muted small">Start collecting client testimonials</p>
                                    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary mt-2">
                                        <i class="bi bi-plus-lg"></i> Add First Testimonial
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            @if($testimonials->hasPages())
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Showing {{ $testimonials->firstItem() }} - {{ $testimonials->lastItem() }} of {{ $testimonials->total() }} testimonials
                </small>
                {{ $testimonials->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- View Modal -->
    @if($showViewModal && $viewTestimonial)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1055;" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-eye"></i> Testimonial Details
                    </h5>
                    <button class="btn-close btn-close-white" wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4 text-center">
                            <img src="{{ $viewTestimonial->image_url }}" 
                                 class="rounded-circle mb-2" 
                                 style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #007bff;">
                            <h5 class="mb-1">{{ $viewTestimonial->t_name }}</h5>
                            @if($viewTestimonial->t_designation)
                                <p class="text-muted mb-1">{{ $viewTestimonial->t_designation }}</p>
                            @endif
                            @if($viewTestimonial->t_company)
                                <span class="badge bg-secondary">{{ $viewTestimonial->t_company }}</span>
                            @endif
                            @if($viewTestimonial->t_location)
                                <p class="mt-2">📍 {{ $viewTestimonial->t_location }}</p>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <span class="text-warning fs-5">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $viewTestimonial->t_rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </span>
                                <span class="ms-2 fw-semibold">{{ $viewTestimonial->t_rating }}/5</span>
                            </div>
                            <blockquote class="blockquote">
                                <p class="mb-0 fst-italic">"{{ $viewTestimonial->t_content }}"</p>
                            </blockquote>
                            <hr>
                            <div class="row small text-muted">
                                <div class="col-6">
                                    <strong>Status:</strong> 
                                    <span class="badge bg-{{ $viewTestimonial->is_active ? 'success' : 'danger' }}">
                                        {{ $viewTestimonial->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <div class="col-6">
                                    <strong>Featured:</strong> 
                                    <span class="badge bg-{{ $viewTestimonial->is_featured ? 'warning' : 'secondary' }}">
                                        {{ $viewTestimonial->is_featured ? 'Yes' : 'No' }}
                                    </span>
                                </div>
                                <div class="col-6 mt-2">
                                    <strong>Sort Order:</strong> {{ $viewTestimonial->sort_order }}
                                </div>
                                <div class="col-6 mt-2">
                                    <strong>Created:</strong> {{ $viewTestimonial->created_at->format('M d, Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="closeModals">Close</button>
                    <a href="{{ route('admin.testimonials.edit', $viewTestimonial->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif

    <!-- Delete Modal -->
    @if($showDeleteModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1055;" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle"></i> Confirm Delete
                    </h5>
                    <button class="btn-close btn-close-white" wire:click="closeModals"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="bi bi-trash display-3 text-danger mb-3 d-block"></i>
                    <h5>Delete this testimonial?</h5>
                    <p class="text-muted">This action cannot be undone. All data will be permanently removed.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-secondary" wire:click="closeModals">Cancel</button>
                    <button class="btn btn-danger" wire:click="deleteTestimonial">
                        <i class="bi bi-trash"></i> Yes, Delete Permanently
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
</div>

@push('styles')
<style>
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        cursor: pointer;
    }
    
    .rounded-circle {
        transition: all 0.3s ease;
    }
    
    .table th {
        white-space: nowrap;
    }
    
    .btn-group-sm .btn {
        padding: 0.25rem 0.5rem;
    }
    
    .card.bg-primary, .card.bg-success, .card.bg-warning, .card.bg-info {
        transition: transform 0.3s ease;
    }
    
    .card.bg-primary:hover, 
    .card.bg-success:hover, 
    .card.bg-warning:hover, 
    .card.bg-info:hover {
        transform: translateY(-3px);
    }
</style>
@endpush