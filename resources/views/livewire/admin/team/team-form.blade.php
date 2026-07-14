<div>
    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">{{ $isEditing ? 'Edit Team Member' : 'Add New Team Member' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.team.index') }}">Team</a></li>
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
                                <i class="bi bi-person-badge me-2"></i>Basic Information
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label class="form-label required">Full Name</label>
                                    <input type="text" 
                                           class="form-control @error('ot_name') is-invalid @enderror" 
                                           wire:model="ot_name"
                                           placeholder="Enter full name...">
                                    @error('ot_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Designation -->
                                <div class="col-md-6">
                                    <label class="form-label">Designation</label>
                                    <input type="text" 
                                           class="form-control" 
                                           wire:model="ot_designation" 
                                           placeholder="e.g., Senior Developer">
                                </div>
                                
                                <!-- Email -->
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" 
                                               class="form-control @error('ot_email') is-invalid @enderror" 
                                               wire:model="ot_email" 
                                               placeholder="email@example.com">
                                        @error('ot_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Phone -->
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="text" 
                                               class="form-control" 
                                               wire:model="ot_phone" 
                                               placeholder="+92 300 1234567">
                                    </div>
                                </div>
                                
                                <!-- Experience -->
                                <div class="col-md-6">
                                    <label class="form-label">Experience (Years)</label>
                                    <input type="number" 
                                           class="form-control" 
                                           wire:model="ot_experience" 
                                           min="0" 
                                           max="50"
                                           placeholder="Years of experience">
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

                    <!-- Description Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-text-paragraph me-2"></i>Bio & Description
                            </h3>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" 
                                      rows="5" 
                                      wire:model="ot_description" 
                                      placeholder="Write a brief bio or description about this team member..."></textarea>
                            <small class="text-muted mt-1">
                                Characters: <span x-data x-text="$wire.ot_description ? $wire.ot_description.length : 0"></span>
                            </small>
                        </div>
                    </div>

                    <!-- Skills Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-tools me-2"></i>Skills & Expertise
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input type="text" 
                                       class="form-control" 
                                       wire:model="ot_skills_input" 
                                       wire:keydown.enter.prevent="addSkill"
                                       placeholder="Type a skill and press Enter or click Add">
                                <button type="button" class="btn btn-primary" wire:click="addSkill">
                                    <i class="bi bi-plus-lg"></i> Add
                                </button>
                            </div>
                            
                            @if(count($ot_skills) > 0)
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($ot_skills as $index => $skill)
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 d-flex align-items-center gap-2">
                                            <i class="bi bi-check-circle-fill"></i>
                                            {{ $skill }}
                                            <button type="button" 
                                                    class="btn-close btn-close-sm" 
                                                    wire:click="removeSkill({{ $index }})"
                                                    style="font-size: 0.6rem;">
                                            </button>
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center text-muted py-3">
                                    <i class="bi bi-lightbulb display-6 d-block mb-2"></i>
                                    <p>No skills added yet. Add skills to showcase expertise.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Social Links Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-share me-2"></i>Social Links
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-facebook text-primary"></i> Facebook
                                    </label>
                                    <input type="url" class="form-control" wire:model="ot_fb" placeholder="https://facebook.com/username">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-instagram text-danger"></i> Instagram
                                    </label>
                                    <input type="url" class="form-control" wire:model="ot_inst" placeholder="https://instagram.com/username">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-twitter-x text-dark"></i> Twitter/X
                                    </label>
                                    <input type="url" class="form-control" wire:model="ot_twitter" placeholder="https://twitter.com/username">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-linkedin text-info"></i> LinkedIn
                                    </label>
                                    <input type="url" class="form-control" wire:model="ot_linkedin" placeholder="https://linkedin.com/in/username">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-google text-danger"></i> Gmail
                                    </label>
                                    <input type="email" class="form-control" wire:model="ot_gm" placeholder="email@gmail.com">
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
                                <i class="bi bi-camera me-2"></i>Profile Photo
                            </h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="mb-3">
                                @if($imagePreview)
                                    <img src="{{ $imagePreview }}" 
                                         class="rounded-circle mb-2 shadow" 
                                         style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #0056b3;">
                                @else
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-2 shadow"
                                         style="width: 150px; height: 150px; border: 4px dashed #ccc;">
                                        <i class="bi bi-person text-muted" style="font-size: 4rem;"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <input type="file" 
                                   class="form-control @error('ot_image') is-invalid @enderror" 
                                   wire:model="ot_image" 
                                   accept="image/*">
                            @error('ot_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            
                            @if($imagePreview)
                                <button type="button" class="btn btn-danger btn-sm mt-2" wire:click="removeImage">
                                    <i class="bi bi-trash"></i> Remove Photo
                                </button>
                            @endif
                            
                            <small class="text-muted d-block mt-2">Recommended: Square image, 500×500px, Max 2MB</small>
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
                                <br><small class="text-muted">Member will be visible on website</small>
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
                        <div class="card-body text-center">
                            <div class="mb-2">
                                @if($imagePreview)
                                    <img src="{{ $imagePreview }}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center" 
                                         style="width: 80px; height: 80px;">
                                        <i class="bi bi-person text-white" style="font-size: 2rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <h6 class="mb-0">{{ $ot_name ?: 'Member Name' }}</h6>
                            @if($ot_designation)
                                <small class="text-muted">{{ $ot_designation }}</small>
                            @endif
                            @if(count($ot_skills) > 0)
                                <div class="mt-2">
                                    @foreach(array_slice($ot_skills, 0, 3) as $skill)
                                        <span class="badge bg-light text-dark me-1">{{ $skill }}</span>
                                    @endforeach
                                    @if(count($ot_skills) > 3)
                                        <span class="badge bg-secondary">+{{ count($ot_skills) - 3 }}</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <button type="submit" 
                            class="btn btn-primary btn-lg w-100 mb-2" 
                            wire:loading.attr="disabled"
                            wire:target="save">
                        <span wire:loading.remove wire:target="save">
                            <i class="bi bi-check-lg me-1"></i> 
                            {{ $isEditing ? 'Update Member' : 'Add Member' }}
                        </span>
                        <span wire:loading wire:target="save">
                            <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                        </span>
                    </button>
                    <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary w-100">
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
    
    .rounded-circle {
        transition: all 0.3s ease;
    }
    
    .badge {
        font-size: 0.85rem;
    }
</style>
@endpush