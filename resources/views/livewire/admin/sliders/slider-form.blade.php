<div>
    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">{{ $isEditing ? 'Edit Slider' : 'Create New Slider' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">Sliders</a></li>
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
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-info-circle me-2"></i>Slider Content
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <!-- Title -->
                                <div class="col-12">
                                    <label class="form-label required">Title</label>
                                    <input type="text" 
                                           class="form-control form-control-lg @error('s_title') is-invalid @enderror" 
                                           wire:model="s_title"
                                           placeholder="Enter slider title...">
                                    @error('s_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Subtitle -->
                                <div class="col-12">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" wire:model="s_subtitle" placeholder="Optional subtitle...">
                                </div>
                                
                                <!-- Description -->
                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" rows="3" wire:model="s_description" placeholder="Slider description..."></textarea>
                                </div>
                                
                                <!-- Badge & Alt Text -->
                                <div class="col-md-6">
                                    <label class="form-label">Badge Text</label>
                                    <input type="text" class="form-control" wire:model="s_badge_text" placeholder="e.g., NEW, SALE, 50% OFF">
                                    <small class="text-muted">Displayed as a small badge on the slider</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Alt Text (SEO)</label>
                                    <input type="text" class="form-control" wire:model="s_alt_text" placeholder="Image alt text for SEO">
                                    <small class="text-muted">Important for accessibility and SEO</small>
                                </div>
                                
                                <!-- Feature Points -->
                                <div class="col-12">
                                    <label class="form-label">Feature Points</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" wire:model="s_t1" placeholder="Feature 1">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" wire:model="s_t2" placeholder="Feature 2">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" wire:model="s_t3" placeholder="Feature 3">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-hand-index me-2"></i>CTA Buttons
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <!-- Button 1 -->
                                <div class="col-12">
                                    <h6 class="fw-bold text-primary mb-2">Button 1 (Primary)</h6>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Button Text</label>
                                    <input type="text" class="form-control" wire:model="button_text" placeholder="e.g., Learn More">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label">Button Link</label>
                                    <input type="text" class="form-control" wire:model="button_link" placeholder="e.g., /about-us or https://...">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Target</label>
                                    <select class="form-select" wire:model="button_target">
                                        <option value="_self">Same Tab</option>
                                        <option value="_blank">New Tab</option>
                                    </select>
                                </div>
                                
                                <!-- Button 2 -->
                                <div class="col-12 mt-2">
                                    <h6 class="fw-bold text-secondary mb-2">Button 2 (Secondary)</h6>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Button Text</label>
                                    <input type="text" class="form-control" wire:model="button2_text" placeholder="e.g., Contact Us">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label">Button Link</label>
                                    <input type="text" class="form-control" wire:model="button2_link" placeholder="e.g., /contact or tel:+92...">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Target</label>
                                    <select class="form-select" wire:model="button2_target">
                                        <option value="_self">Same Tab</option>
                                        <option value="_blank">New Tab</option>
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
                                <i class="bi bi-images me-2"></i>Images
                            </h3>
                        </div>
                        <div class="card-body">
                            <!-- Desktop Image -->
                            <div class="mb-3">
                                <label class="form-label">
                                    Desktop Image 
                                    @if(!$isEditing)<span class="text-danger">*</span>@endif
                                </label>
                                <input type="file" 
                                       class="form-control @error('s_image') is-invalid @enderror" 
                                       wire:model="s_image" 
                                       accept="image/*">
                                @error('s_image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                
                                @if($imagePreview)
                                <div class="position-relative mt-2">
                                    <img src="{{ $imagePreview }}" class="img-thumbnail w-100" style="max-height: 150px; object-fit: cover;">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" wire:click="removeImage">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                                @endif
                                <small class="text-muted">Recommended: 1920×800px, Max 5MB</small>
                            </div>
                            
                            <!-- Mobile Image -->
                            <div class="mb-3">
                                <label class="form-label">Mobile Image <small class="text-muted">(Optional)</small></label>
                                <input type="file" class="form-control" wire:model="s_mobile_image" accept="image/*">
                                
                                @if($mobileImagePreview)
                                <div class="position-relative mt-2">
                                    <img src="{{ $mobileImagePreview }}" class="img-thumbnail w-100" style="max-height: 120px; object-fit: cover;">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" wire:click="removeMobileImage">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                                @endif
                                <small class="text-muted">For mobile devices, Max 5MB</small>
                            </div>
                        </div>
                    </div>

                    <!-- Design Settings Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6 fw-semibold">
                                <i class="bi bi-palette me-2"></i>Design Settings
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Slider Type</label>
                                <select class="form-select" wire:model="slider_type">
                                    <option value="image">Image</option>
                                    <option value="video">Video</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Text Position</label>
                                <select class="form-select" wire:model="text_position">
                                    <option value="left">Left</option>
                                    <option value="center">Center</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label">Text Color</label>
                                    <input type="color" class="form-control form-control-color w-100" wire:model="text_color" style="height: 40px;">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Overlay Color</label>
                                    <input type="color" class="form-control form-control-color w-100" wire:model="overlay_color" style="height: 40px;">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Overlay Opacity: <strong>{{ $overlay_opacity }}%</strong></label>
                                <input type="range" class="form-range" wire:model.live="overlay_opacity" min="0" max="100">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Animation</label>
                                <select class="form-select" wire:model="animation_type">
                                    <option value="fade">Fade</option>
                                    <option value="slide">Slide</option>
                                    <option value="zoom">Zoom</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Duration (ms)</label>
                                <input type="number" class="form-control" wire:model="slide_duration" min="1000" max="30000" step="500">
                                <small class="text-muted">1000ms = 1 second</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" class="form-control" wire:model="sort_order" min="0">
                                <small class="text-muted">Lower number = shown first</small>
                            </div>
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
                                <br><small class="text-muted">Slider will be visible on website</small>
                            </div>
                            
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" wire:model="is_featured" id="is_featured">
                                <label class="form-check-label fw-semibold" for="is_featured">Featured</label>
                                <br><small class="text-muted">Highlight as featured slider</small>
                            </div>
                            
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" wire:model="show_on_desktop" id="show_on_desktop">
                                <label class="form-check-label fw-semibold" for="show_on_desktop">Show on Desktop</label>
                            </div>
                            
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" wire:model="show_on_mobile" id="show_on_mobile">
                                <label class="form-check-label fw-semibold" for="show_on_mobile">Show on Mobile</label>
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
                            {{ $isEditing ? 'Update Slider' : 'Create Slider' }}
                        </span>
                        <span wire:loading wire:target="save">
                            <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                        </span>
                    </button>
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    .form-control-color {
        padding: 4px;
        cursor: pointer;
    }
    
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        cursor: pointer;
    }
    
    .img-thumbnail {
        border-radius: 8px;
    }
    
    @media (max-width: 767.98px) {
        .form-control-lg {
            font-size: 1rem;
        }
    }
</style>
@endpush