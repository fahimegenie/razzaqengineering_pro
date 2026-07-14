<div>
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
                                <label class="form-label required">Question</label>
                                <input type="text" 
                                       class="form-control form-control-lg @error('faq_question') is-invalid @enderror" 
                                       wire:model="faq_question" 
                                       placeholder="Enter the frequently asked question...">
                                @error('faq_question')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Keep it clear and concise. Max 500 characters.</small>
                            </div>
                            
                            <!-- Answer with CKEditor -->
                            <div class="mb-3">
                                <label class="form-label required">Answer</label>
                                <div wire:ignore>
                                    <textarea id="faq-answer-editor" class="form-control @error('faq_answer') is-invalid @enderror">{{ $faq_answer }}</textarea>
                                </div>
                                @error('faq_answer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Provide comprehensive, helpful information. You can use formatting, lists, and links.</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Preview Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-eye me-2"></i>Preview
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="faqPreview">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button">
                                            {{ $faq_question ?: 'Question preview...' }}
                                        </button>
                                    </h2>
                                    <div class="accordion-collapse collapse show">
                                        <div class="accordion-body" id="faq-preview-content">
                                            @if($faq_answer)
                                                {!! $faq_answer !!}
                                            @else
                                                <span class="text-muted fst-italic">Answer preview will appear here...</span>
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
                                    <i class="bi bi-x-lg me-1"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Settings Card -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold fs-6">Settings</h3>
                        </div>
                        <div class="card-body">
                            <!-- Category -->
                            <div class="mb-3">
                                <label class="form-label">Category</label>
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
                                <label class="form-label">Sort Order</label>
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
                                <small class="text-muted">Only active FAQs will be displayed on website.</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Info Card -->
                    <div class="card shadow-sm border-0 bg-light">
                        <div class="card-body">
                            <h6 class="fw-semibold"><i class="bi bi-info-circle me-2"></i>Tips</h6>
                            <ul class="small text-muted mb-0 ps-3">
                                <li>Write questions from customer's perspective</li>
                                <li>Keep answers clear and helpful</li>
                                <li>Use categories to organize FAQs</li>
                                <li>Update FAQs regularly</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<script>
    document.addEventListener('livewire:initialized', () => {
        let faqEditor = null;
        
        function initFaqEditor() {
            const editorElement = document.getElementById('faq-answer-editor');
            if (!editorElement) return;
            
            // Destroy existing editor if any
            if (faqEditor) {
                faqEditor.destroy().catch(() => {});
                faqEditor = null;
            }
            
            ClassicEditor
                .create(editorElement, {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', 'strikethrough', '|',
                            'link', 'blockQuote', '|',
                            'bulletedList', 'numberedList', '|',
                            'outdent', 'indent', '|',
                            'imageUpload', 'insertTable', '|',
                            'undo', 'redo', '|',
                            'fontSize', 'fontColor', 'highlight', '|',
                            'alignment', '|',
                            'removeFormat'
                        ]
                    },
                    image: {
                        toolbar: [
                            'imageTextAlternative',
                            'imageStyle:full',
                            'imageStyle:side'
                        ]
                    },
                    table: {
                        contentToolbar: [
                            'tableColumn',
                            'tableRow',
                            'mergeTableCells'
                        ]
                    },
                    simpleUpload: {
                        uploadUrl: '{{ route("admin.upload.image") }}',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        }
                    },
                    placeholder: 'Provide a detailed answer to the question...'
                })
                .then(editor => {
                    faqEditor = editor;
                    
                    // Sync content to Livewire via hidden input approach
                    editor.model.document.on('change:data', () => {
                        const data = editor.getData();
                        
                        // Update Livewire property directly
                        @this.set('faq_answer', data, false);
                        
                        // Update preview
                        const previewContent = document.getElementById('faq-preview-content');
                        if (previewContent) {
                            previewContent.innerHTML = data || '<span class="text-muted fst-italic">Answer preview will appear here...</span>';
                        }
                    });
                })
                .catch(error => {
                    console.error('CKEditor Error:', error);
                });
        }
        
        // Initialize on page load
        initFaqEditor();
        
        // Re-initialize on Livewire update
        Livewire.hook('morph.updated', ({ el, component }) => {
            if (component.name === 'admin.faq.faq-form') {
                setTimeout(initFaqEditor, 100);
            }
        });
    });
</script>

<style>
    .ck-editor__editable {
        min-height: 250px;
        max-height: 400px;
    }
    
    @media (max-width: 768px) {
        .ck-editor__editable {
            min-height: 200px;
            max-height: 300px;
        }
    }
    
    /* Preview accordion styling */
    #faq-preview-content {
        line-height: 1.8;
    }
    
    #faq-preview-content ul,
    #faq-preview-content ol {
        padding-left: 20px;
    }
    
    #faq-preview-content blockquote {
        border-left: 4px solid #0d6efd;
        padding-left: 15px;
        margin: 10px 0;
        color: #666;
    }
    
    #faq-preview-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 10px 0;
    }
    
    #faq-preview-content table td,
    #faq-preview-content table th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    
    #faq-preview-content img {
        max-width: 100%;
        height: auto;
    }
</style>
@endpush