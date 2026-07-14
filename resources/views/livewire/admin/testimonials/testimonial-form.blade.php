<div>
    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">{{ $isEditing ? 'Edit Testimonial' : 'Create New Testimonial' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
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
                    
                    <!-- Content Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-chat-quote me-2"></i>Testimonial Content
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label class="form-label required">Client Name</label>
                                    <input type="text" 
                                           class="form-control @error('t_name') is-invalid @enderror" 
                                           wire:model="t_name"
                                           placeholder="Enter client name...">
                                    @error('t_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Designation -->
                                <div class="col-md-6">
                                    <label class="form-label">Designation</label>
                                    <input type="text" 
                                           class="form-control" 
                                           wire:model="t_designation" 
                                           placeholder="e.g., CEO, Manager">
                                </div>
                                
                                <!-- Company -->
                                <div class="col-md-6">
                                    <label class="form-label">Company</label>
                                    <input type="text" 
                                           class="form-control" 
                                           wire:model="t_company" 
                                           placeholder="Company name...">
                                </div>
                                
                                <!-- Location -->
                                <div class="col-md-6">
                                    <label class="form-label">Location</label>
                                    <input type="text" 
                                           class="form-control" 
                                           wire:model="t_location" 
                                           placeholder="e.g., New York, USA">
                                </div>
                                
                                <!-- Rating -->
                                <div class="col-12">
                                    <label class="form-label required">Rating</label>
                                    <div class="rating-input" x-data="{ rating: @entangle('t_rating') }">
                                        <div class="d-flex align-items-center gap-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" 
                                                        class="btn btn-lg rating-star {{ $i <= $t_rating ? 'text-warning' : 'text-muted' }}"
                                                        wire:click="$set('t_rating', {{ $i }})"
                                                        x-on:click="rating = {{ $i }}"
                                                        style="font-size: 2rem; line-height: 1; border: none; background: none; cursor: pointer;">
                                                    ★
                                                </button>
                                            @endfor
                                            <span class="ms-2 fw-semibold fs-5">{{ $t_rating }}/5</span>
                                        </div>
                                        @error('t_rating')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Testimonial Content -->
                                <div class="col-12">
                                    <label class="form-label required">Testimonial Content</label>
                                    <textarea class="form-control @error('t_content') is-invalid @enderror" 
                                              rows="5" 
                                              wire:model="t_content" 
                                              placeholder="What did the client say about us?"></textarea>
                                    <small class="text-muted">
                                        <span x-data="{ length: 0 }" x-init="length = $wire.t_content.length">
                                            Characters: <span x-text="$wire.t_content.length"></span>
                                        </span>
                                    </small>
                                    @error('t_content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Relations Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-link-45deg me-2"></i>Related To
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Related Project</label>
                                    <select class="form-select" wire:model="project_id">
                                        <option value="">-- Select Project (Optional) --</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->p_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Related Service</label>
                                    <select class="form-select" wire:model="service_id">
                                        <option value="">-- Select Service (Optional) --</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->os_id }}">{{ $service->os_title }}</option>
                                        @endforeach
                                    </select>
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
                                <i class="bi bi-person-circle me-2"></i>Client Photo
                            </h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="mb-3">
                                @if($imagePreview)
                                    <img src="{{ $imagePreview }}" 
                                         class="rounded-circle mb-2" 
                                         style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #007bff;">
                                @else
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                                         style="width: 120px; height: 120px; border: 3px dashed #ccc;">
                                        <i class="bi bi-person text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <input type="file" 
                                   class="form-control @error('t_image') is-invalid @enderror" 
                                   wire:model="t_image" 
                                   accept="image/*">
                            @error('t_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            
                            @if($imagePreview)
                                <button type="button" class="btn btn-danger btn-sm mt-2" wire:click="removeImage">
                                    <i class="bi bi-trash"></i> Remove Photo
                                </button>
                            @endif
                            
                            <small class="text-muted d-block mt-1">Recommended: Square image, Max 2MB</small>
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
                                <br><small class="text-muted">Testimonial will be visible on website</small>
                            </div>
                            
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" wire:model="is_featured" id="is_featured">
                                <label class="form-check-label fw-semibold" for="is_featured">Featured</label>
                                <br><small class="text-muted">Show in featured testimonials section</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" class="form-control" wire:model="sort_order" min="0">
                                <small class="text-muted">Lower number = shown first</small>
                            </div>
                        </div>
                    </div>

                    <!-- Rating Preview Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6 fw-semibold">
                                <i class="bi bi-eye me-2"></i>Preview
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <div class="mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="fs-4 {{ $i <= $t_rating ? 'text-warning' : 'text-muted' }}">★</span>
                                    @endfor
                                </div>
                                <p class="fst-italic text-muted small">
                                    "{{ Str::limit($t_content ?: 'Testimonial content will appear here...', 150) }}"
                                </p>
                                <div class="fw-semibold">{{ $t_name ?: 'Client Name' }}</div>
                                @if($t_designation)
                                    <small class="text-muted">{{ $t_designation }}</small>
                                @endif
                                @if($t_company)
                                    <small class="text-muted d-block">{{ $t_company }}</small>
                                @endif
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
                            {{ $isEditing ? 'Update Testimonial' : 'Create Testimonial' }}
                        </span>
                        <span wire:loading wire:target="save">
                            <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                        </span>
                    </button>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    .rating-star {
        transition: all 0.2s ease;
    }
    
    .rating-star:hover {
        transform: scale(1.2);
    }
    
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        cursor: pointer;
    }
    
    .rounded-circle {
        transition: all 0.3s ease;
    }
</style>
@endpush