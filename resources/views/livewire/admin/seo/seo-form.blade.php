<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">{{ $isEditing ? 'Edit SEO Data' : 'Add New SEO Data' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.seo.index') }}">SEO Management</a></li>
                        <li class="breadcrumb-item active">{{ $isEditing ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form wire:submit="save">
            <div class="row g-3">
                <div class="col-12">

                    {{-- Page Type & Dynamic Selection Card --}}
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-gear me-2"></i>Page Configuration
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label required">Page Type</label>
                                    <select class="form-select" wire:model.live="seo_page_type" >
                                        @foreach($pageTypeGroups as $group => $types)
                                            <optgroup label="{{ $group }}">
                                                @foreach($types as $val => $label)
                                                    <option value="{{ $val }}">{{ $label }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">
                                        💡 Select page type to auto-generate SEO templates
                                    </small>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Slug</label>
                                    <input type="text" class="form-control" wire:model="seo_slug" placeholder="Auto-generated">
                                    <small class="text-muted">Auto-generated from selections</small>
                                </div>

                                {{-- Dynamic Fields - Show only for relevant page types --}}
                                @if($showDynamicFields)
                                <div class="col-12">
                                    <div class="alert alert-info mb-0">
                                        <i class="bi bi-info-circle me-2"></i>
                                        <strong>Dynamic Page:</strong> Select the specific entity and location below.
                                    </div>
                                </div>

                                {{-- Service Selection --}}
                                @if(in_array($seo_page_type, ['service_detail', 'city_service']))
                                <div class="col-md-6">
                                    <label class="form-label">Select Service</label>
                                    <select class="form-select" wire:model.live="selected_service_id">
                                        <option value="">-- Select Service --</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->sd_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                {{-- Product Category Selection --}}
                                @if(in_array($seo_page_type, ['product_detail', 'city_product']))
                                <div class="col-md-6">
                                    <label class="form-label">Select Product Category</label>
                                    <select class="form-select" wire:model.live="selected_product_category_id">
                                        <option value="">-- Select Category --</option>
                                        @foreach($productCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->pc_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                {{-- City Selection --}}
                                @if(in_array($seo_page_type, ['city', 'city_service', 'city_product']))
                                <div class="col-md-6">
                                    <label class="form-label">Select City</label>
                                    <select class="form-select" wire:model.live="selected_city_id">
                                        <option value="">-- Select City --</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                @endif

                                {{-- Dynamic Preview --}}
                                @if($dynamicPreview)
                                <div class="col-12">
                                    <div class="card bg-light border">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0"><i class="bi bi-magic me-2"></i>Dynamic SEO Preview</h6>
                                            <button type="button" class="btn btn-sm btn-primary" wire:click="applyDynamicPreview">
                                                <i class="bi bi-arrow-down"></i> Apply to Fields
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Title:</strong> <span class="text-primary">{{ $dynamicPreview['title'] }}</span></p>
                                            <p><strong>Description:</strong> {{ $dynamicPreview['description'] }}</p>
                                            <p><strong>Keywords:</strong> <small class="text-muted">{{ $dynamicPreview['keywords'] }}</small></p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Basic SEO Card --}}
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-search me-2"></i>Basic SEO</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" class="form-control" wire:model="seo_title" placeholder="SEO title - max 60 chars">
                                    <small class="text-muted">{{ strlen($seo_title) }}/60 characters</small>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" rows="2" wire:model="seo_description" placeholder="SEO description - max 160 chars"></textarea>
                                    <small class="text-muted">{{ strlen($seo_description) }}/160 characters</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Meta Keywords</label>
                                    <input type="text" class="form-control" wire:model="seo_keywords" placeholder="keyword1, keyword2, keyword3">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Focus Keyword</label>
                                    <input type="text" class="form-control" wire:model="seo_focus_keyword" placeholder="Primary target keyword">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Canonical URL</label>
                                    <input type="url" class="form-control" wire:model="seo_canonical" placeholder="https://example.com/page">
                                    <small class="text-muted">Auto-generated if left empty</small>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Page URL</label>
                                    <input type="text" class="form-control" wire:model="seo_page_url" placeholder="/page-url">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Robots & Indexing --}}
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-robot me-2"></i>Robots & Indexing</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Robots Meta Tag</label>
                                    <input type="text" class="form-control" wire:model="seo_robots" placeholder="index,follow">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch mt-4">
                                        <input class="form-check-input" type="checkbox" wire:model="seo_no_index" id="no_index">
                                        <label class="form-check-label fw-semibold" for="no_index">No Index</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch mt-4">
                                        <input class="form-check-input" type="checkbox" wire:model="seo_no_follow" id="no_follow">
                                        <label class="form-check-label fw-semibold" for="no_follow">No Follow</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Open Graph --}}
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-facebook me-2"></i>Open Graph</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">OG Title</label>
                                    <input type="text" class="form-control" wire:model="seo_og_title">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">OG Type</label>
                                    <select class="form-select" wire:model="seo_og_type">
                                        @foreach($ogTypes as $val => $label)
                                        <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">OG Description</label>
                                    <textarea class="form-control" rows="2" wire:model="seo_og_description"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">OG Image</label>
                                    <input type="file" class="form-control" wire:model="seo_og_image" accept="image/*">
                                    <small class="text-muted">Recommended: 1200x630px, max 2MB</small>
                                    @if($ogImagePreview)
                                    <div class="mt-2 position-relative d-inline-block">
                                        <img src="{{ $ogImagePreview }}" class="img-thumbnail" style="max-height:120px;">
                                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" wire:click="removeOgImage">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                    @endif
                                    <div wire:loading wire:target="seo_og_image" class="mt-2">
                                        <span class="spinner-border spinner-border-sm"></span> Uploading...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Twitter Cards --}}
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-twitter-x me-2"></i>Twitter Cards</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Card Type</label>
                                    <select class="form-select" wire:model="seo_twitter_card">
                                        @foreach($twitterCards as $val => $label)
                                        <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Twitter Title</label>
                                    <input type="text" class="form-control" wire:model="seo_twitter_title">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Twitter Image</label>
                                    <input type="file" class="form-control" wire:model="seo_twitter_image" accept="image/*">
                                    @if($twitterImagePreview)
                                    <div class="mt-2 position-relative d-inline-block">
                                        <img src="{{ $twitterImagePreview }}" class="img-thumbnail" style="max-height:80px;">
                                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" wire:click="removeTwitterImage">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Twitter Description</label>
                                    <textarea class="form-control" rows="2" wire:model="seo_twitter_description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Schema Markup --}}
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-code-slash me-2"></i>Schema Markup</h3>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary" wire:click="generateDefaultSchema">
                                    <i class="bi bi-stars"></i> Generate Default
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-primary" wire:click="validateSchema">
                                    <i class="bi bi-check-circle"></i> Validate JSON
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Schema Type</label>
                                    <select class="form-select" wire:model="seo_schema_type">
                                        @foreach($schemaTypes as $val => $label)
                                        <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Schema Markup (JSON-LD)</label>
                                    <textarea class="form-control font-monospace" rows="8" wire:model="seo_schema_markup" placeholder=""></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Breadcrumb Schema</label>
                                    <textarea class="form-control font-monospace" rows="4" wire:model="seo_breadcrumb_schema"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Advanced SEO --}}
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-gear me-2"></i>Advanced SEO</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Author</label>
                                    <input type="text" class="form-control" wire:model="seo_author">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Publisher</label>
                                    <input type="text" class="form-control" wire:model="seo_publisher">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Published Date</label>
                                    <input type="date" class="form-control" wire:model="seo_published_date">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Modified Date</label>
                                    <input type="date" class="form-control" wire:model="seo_modified_date">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Hreflang</label>
                                    <input type="text" class="form-control" wire:model="seo_hreflang" placeholder="en-US">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Site Verification --}}
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-shield-check me-2"></i>Site Verification</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Google Verification</label>
                                    <textarea class="form-control" rows="2" wire:model="google_site_verification" placeholder="Paste meta tag or verification code"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Bing Verification</label>
                                    <textarea class="form-control" rows="2" wire:model="bing_site_verification"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Yandex Verification</label>
                                    <textarea class="form-control" rows="2" wire:model="yandex_site_verification"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Analytics --}}
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-graph-up me-2"></i>Analytics & Tracking</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Google Analytics ID</label>
                                    <input type="text" class="form-control" wire:model="google_analytics_id" placeholder="G-XXXXXXXXXX / UA-XXXXXXXXX-X">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Google Tag Manager ID</label>
                                    <input type="text" class="form-control" wire:model="google_tag_manager_id" placeholder="GTM-XXXXXXX">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Facebook Pixel ID</label>
                                    <input type="text" class="form-control" wire:model="facebook_pixel_id" placeholder="1234567890">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sitemap Settings --}}
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-diagram-3 me-2"></i>Sitemap Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" wire:model="seo_sitemap_include" id="sitemap">
                                        <label class="form-check-label fw-semibold" for="sitemap">Include in Sitemap</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Priority ({{ $seo_sitemap_priority }}%)</label>
                                    <input type="range" class="form-range" wire:model.live="seo_sitemap_priority" min="0" max="100">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Frequency</label>
                                    <select class="form-select" wire:model="seo_sitemap_frequency">
                                        @foreach($sitemapFrequencies as $val => $label)
                                        <option value="{{ $val }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-2 mb-4">
                        <button type="submit" class="btn btn-primary btn-lg flex-fill" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="save">
                                <i class="bi bi-check-lg me-1"></i> {{ $isEditing ? 'Update SEO Data' : 'Create SEO Data' }}
                            </span>
                            <span wire:loading wire:target="save">
                                <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                            </span>
                        </button>
                        <a href="{{ route('admin.seo.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-x-lg me-1"></i> Cancel
                        </a>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>