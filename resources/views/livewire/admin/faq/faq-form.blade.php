{{-- resources/views/livewire/admin/faq/faq-form.blade.php --}}
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
            <p class="mb-0 fw-semibold">Saving FAQ...</p>
        </div>
    </div>

    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">{{ $isEditing ? 'Edit FAQ' : 'Create New FAQ' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.faq.index') }}">FAQ</a></li>
                        <li class="breadcrumb-item active">{{ $isEditing ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @if($saveSuccess)
        <div class="alert alert-success alert-dismissible fade show" role="alert" 
             x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <i class="bi bi-check-circle me-2"></i>FAQ saved successfully!
            <button type="button" class="btn-close" @click="show = false"></button>
        </div>
        @endif

        <form wire:submit="save">
            <div class="row g-3">
                <!-- Main Form -->
                <div class="col-12 col-lg-8">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-question-circle me-2"></i>FAQ Details
                            </h3>
                        </div>
                        <div class="card-body">
                            <!-- Question -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold required">Question</label>
                                <input type="text" 
                                       class="form-control form-control-lg @error('faq_question') is-invalid @enderror" 
                                       wire:model.live="faq_question" 
                                       placeholder="Enter the frequently asked question...">
                                @error('faq_question')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Keep it clear and concise. Max 500 characters.</small>
                            </div>
                            
                            <!-- Answer with Reusable CKEditor Component -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold required">Answer</label>
                                <livewire:components.ck-editor 
                                    label="Answer" 
                                    placeholder="Provide a detailed answer to the question..." 
                                    height="350px" 
                                    toolbar="full" 
                                    :value="$faq_answer"
                                    field="faq_answer"
                                    wire:model.live="faq_answer" 
                                />
                                @error('faq_answer')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <small class="text-muted">Provide comprehensive, helpful information. You can use formatting, lists, and links.</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Preview Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-eye me-2"></i>Frontend Preview
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="faqPreview">
                                <div class="accordion-item border rounded">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#previewCollapse">
                                            <i class="bi bi-question-circle text-primary me-2"></i>
                                            <strong>{{ $faq_question ?: 'Question preview...' }}</strong>
                                        </button>
                                    </h2>
                                    <div id="previewCollapse" class="accordion-collapse collapse show">
                                        <div class="accordion-body" style="line-height: 1.8;">
                                            @if($faq_answer)
                                                {!! $faq_answer !!}
                                            @else
                                                <span class="text-muted fst-italic">
                                                    <i class="bi bi-info-circle me-1"></i> 
                                                    Answer preview will appear here as you type...
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="col-12 col-lg-4">
                    <!-- Publish Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold fs-6">Publish</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="save">
                                        <i class="bi bi-check-lg me-1"></i> 
                                        {{ $isEditing ? 'Update FAQ' : 'Create FAQ' }}
                                    </span>
                                    <span wire:loading wire:target="save">
                                        <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                                    </span>
                                </button>
                                <a href="{{ route('admin.faq.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Back to FAQ List
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Settings Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold fs-6">
                                <i class="bi bi-gear me-2"></i>Settings
                            </h3>
                        </div>
                        <div class="card-body">
                            <!-- Category -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Category</label>
                                <input type="text" 
                                       class="form-control @error('faq_category') is-invalid @enderror" 
                                       wire:model="faq_category" 
                                       placeholder="e.g., General, Services, Pricing"
                                       list="categorySuggestions">
                                <datalist id="categorySuggestions">
                                    <option value="General">
                                    <option value="Services">
                                    <option value="Pricing">
                                    <option value="Technical">
                                    <option value="Support">
                                    <option value="Billing">
                                </datalist>
                                @error('faq_category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Sort Order -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Sort Order</label>
                                <input type="number" 
                                       class="form-control @error('sort_order') is-invalid @enderror" 
                                       wire:model="sort_order" 
                                       min="0" 
                                       placeholder="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Lower numbers appear first.</small>
                            </div>
                            
                            <!-- Status -->
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" wire:model="is_active" id="isActive">
                                    <label class="form-check-label fw-semibold" for="isActive">Active</label>
                                </div>
                                <small class="text-muted">Only active FAQs will be displayed on the website.</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- FAQ Info Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold fs-6">
                                <i class="bi bi-info-circle me-2"></i>FAQ Info
                            </h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 small">
                                <li class="mb-2">
                                    <strong>Status:</strong> 
                                    <span class="badge bg-{{ $is_active ? 'success' : 'secondary' }}">
                                        {{ $is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </li>
                                <li class="mb-2">
                                    <strong>Category:</strong> 
                                    {{ $faq_category ?: 'Not set' }}
                                </li>
                                <li class="mb-2">
                                    <strong>Sort Order:</strong> 
                                    {{ $sort_order }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Tips Card -->
                    <div class="card shadow-sm border-0 bg-light">
                        <div class="card-body">
                            <h6 class="fw-semibold">
                                <i class="bi bi-lightbulb text-warning me-2"></i>Tips for Good FAQs
                            </h6>
                            <ul class="small text-muted mb-0 ps-3">
                                <li class="mb-1">Write questions from customer's perspective</li>
                                <li class="mb-1">Keep answers clear and helpful</li>
                                <li class="mb-1">Use categories to organize FAQs</li>
                                <li class="mb-1">Update FAQs regularly</li>
                                <li class="mb-1">Include links to relevant pages</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    .required::after {
        content: ' *';
        color: #dc3545;
    }
    
    /* Preview accordion styling */
    .accordion-body {
        line-height: 1.8;
    }
    
    .accordion-body ul,
    .accordion-body ol {
        padding-left: 20px;
    }
    
    .accordion-body blockquote {
        border-left: 4px solid #0d6efd;
        padding-left: 15px;
        margin: 10px 0;
        color: #666;
        background: #f8f9fa;
        padding: 10px 15px;
        border-radius: 0 8px 8px 0;
    }
    
    .accordion-body table {
        width: 100%;
        border-collapse: collapse;
        margin: 10px 0;
    }
    
    .accordion-body table td,
    .accordion-body table th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    
    .accordion-body table th {
        background: #f8f9fa;
        font-weight: 600;
    }
    
    .accordion-body img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }
    
    .accordion-body a {
        color: #0056b3;
        text-decoration: underline;
    }
    
    @media (max-width: 768px) {
        .accordion-body {
            font-size: 0.9rem;
        }
    }
</style>
@endpush