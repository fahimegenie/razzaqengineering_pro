{{-- resources/views/livewire/admin/settings/general-settings.blade.php --}}
<div>
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
            <p class="mb-0 fw-semibold">Saving settings...</p>
        </div>
    </div>

    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @if($errorMessage)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ $errorMessage }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if($saveSuccess)
        <div class="alert alert-success alert-dismissible fade show" role="alert" 
             x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <i class="bi bi-check-circle me-2"></i>Settings saved successfully!
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
                <div class="col-12 col-lg-9">
                    
                    <!-- General Settings Tab -->
                    <div class="{{ $activeTab === 'general' ? '' : 'd-none' }}">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-building me-2"></i>Basic Information
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold required">Site Name</label>
                                        <input type="text" class="form-control" wire:model="site_name">
                                        @error('site_name') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Tagline</label>
                                        <input type="text" class="form-control" wire:model="site_tagline">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Site Description</label>
                                        <textarea class="form-control" rows="3" wire:model="site_description"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Site URL</label>
                                        <input type="url" class="form-control" wire:model="site_url">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Company Name</label>
                                        <input type="text" class="form-control" wire:model="company_name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Registration Number</label>
                                        <input type="text" class="form-control" wire:model="company_registration_number">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Tax Number</label>
                                        <input type="text" class="form-control" wire:model="tax_number">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Established Year</label>
                                        <input type="text" class="form-control" wire:model="establishment_year" maxlength="10">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Logo Uploads -->
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-images me-2"></i>Logo & Media
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Main Logo</label>
                                        <div class="border rounded p-3 text-center">
                                            @if($logoPreview)
                                            <img src="{{ $logoPreview }}" alt="Logo" class="img-fluid mb-2" style="max-height: 80px;">
                                            @endif
                                            <input type="file" class="form-control" wire:model="logoFile" accept="image/*">
                                            <small class="text-muted">Recommended: 200x60px, PNG/SVG</small>
                                        </div>
                                        @error('logoFile') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Dark Logo</label>
                                        <div class="border rounded p-3 text-center">
                                            @if($logoDarkPreview)
                                            <img src="{{ $logoDarkPreview }}" alt="Dark Logo" class="img-fluid mb-2" style="max-height: 80px;">
                                            @endif
                                            <input type="file" class="form-control" wire:model="logoDarkFile" accept="image/*">
                                            <small class="text-muted">For dark backgrounds</small>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Light Logo</label>
                                        <div class="border rounded p-3 text-center">
                                            @if($logoLightPreview)
                                            <img src="{{ $logoLightPreview }}" alt="Light Logo" class="img-fluid mb-2" style="max-height: 60px;">
                                            @endif
                                            <input type="file" class="form-control" wire:model="logoLightFile" accept="image/*">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Favicon</label>
                                        <div class="border rounded p-3 text-center">
                                            @if($faviconPreview)
                                            <img src="{{ $faviconPreview }}" alt="Favicon" class="mb-2" style="max-height: 40px;">
                                            @endif
                                            <input type="file" class="form-control" wire:model="faviconFile" accept="image/*">
                                            <small class="text-muted">16x16px, ICO/PNG</small>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">OG Image</label>
                                        <div class="border rounded p-3 text-center">
                                            @if($ogImagePreview)
                                            <img src="{{ $ogImagePreview }}" alt="OG Image" class="img-fluid mb-2" style="max-height: 60px;">
                                            @endif
                                            <input type="file" class="form-control" wire:model="ogImageFile" accept="image/*">
                                            <small class="text-muted">1200x630px</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Settings Tab -->
                    <div class="{{ $activeTab === 'contact' ? '' : 'd-none' }}">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-telephone me-2"></i>Phone Numbers
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Primary Phone</label>
                                        <input type="text" class="form-control" wire:model="mobile_phone_1" placeholder="+92 300 1234567">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Secondary Phone</label>
                                        <input type="text" class="form-control" wire:model="mobile_phone_2">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">WhatsApp Number</label>
                                        <input type="text" class="form-control" wire:model="whatsapp_number">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Landline</label>
                                        <input type="text" class="form-control" wire:model="landline_1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-envelope me-2"></i>Email Addresses
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold required">Primary Email</label>
                                        <input type="email" class="form-control" wire:model="email_primary">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Sales Email</label>
                                        <input type="email" class="form-control" wire:model="email_sales">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Support Email</label>
                                        <input type="email" class="form-control" wire:model="email_support">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Info Email</label>
                                        <input type="email" class="form-control" wire:model="email_info">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-geo-alt me-2"></i>Address
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Address Line 1</label>
                                        <textarea class="form-control" rows="2" wire:model="address_1"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Address Line 2</label>
                                        <textarea class="form-control" rows="2" wire:model="address_2"></textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">City</label>
                                        <input type="text" class="form-control" wire:model="city">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">State</label>
                                        <input type="text" class="form-control" wire:model="state">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Country</label>
                                        <input type="text" class="form-control" wire:model="country">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-clock me-2"></i>Business Hours
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Working Days</label>
                                        <input type="text" class="form-control" wire:model="working_days" placeholder="Monday - Saturday">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Start Time</label>
                                        <input type="time" class="form-control" wire:model="office_start_time">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">End Time</label>
                                        <input type="time" class="form-control" wire:model="office_end_time">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check form-switch mt-4">
                                            <input class="form-check-input" type="checkbox" wire:model="is_24_7" id="is_24_7">
                                            <label class="form-check-label" for="is_24_7">24/7 Service</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Tab -->
                    <div class="{{ $activeTab === 'social' ? '' : 'd-none' }}">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-share me-2"></i>Social Media Links
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    @php
                                    $socialFields = [
                                        'facebook_url' => ['icon' => 'bi-facebook', 'color' => 'text-primary', 'label' => 'Facebook URL'],
                                        'twitter_url' => ['icon' => 'bi-twitter', 'color' => 'text-info', 'label' => 'Twitter URL'],
                                        'instagram_url' => ['icon' => 'bi-instagram', 'color' => 'text-danger', 'label' => 'Instagram URL'],
                                        'linkedin_url' => ['icon' => 'bi-linkedin', 'color' => 'text-primary', 'label' => 'LinkedIn URL'],
                                        'youtube_url' => ['icon' => 'bi-youtube', 'color' => 'text-danger', 'label' => 'YouTube URL'],
                                        'pinterest_url' => ['icon' => 'bi-pinterest', 'color' => 'text-danger', 'label' => 'Pinterest URL'],
                                        'tiktok_url' => ['icon' => 'bi-tiktok', 'color' => '', 'label' => 'TikTok URL'],
                                    ];
                                    @endphp
                                    @foreach($socialFields as $field => $info)
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            <i class="bi {{ $info['icon'] }} {{ $info['color'] }} me-1"></i> {{ $info['label'] }}
                                        </label>
                                        <input type="url" class="form-control" wire:model="{{ $field }}" placeholder="https://...">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Tab -->
                    <div class="{{ $activeTab === 'seo' ? '' : 'd-none' }}">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-search me-2"></i>SEO Settings
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Meta Title</label>
                                        <input type="text" class="form-control" wire:model="meta_title">
                                        <small class="text-muted">Recommended: 50-60 characters</small>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Meta Description</label>
                                        <textarea class="form-control" rows="3" wire:model="meta_description"></textarea>
                                        <small class="text-muted">Recommended: 150-160 characters</small>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Meta Keywords</label>
                                        <input type="text" class="form-control" wire:model="meta_keywords">
                                        <small class="text-muted">Comma separated</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Meta Robots</label>
                                        <select class="form-select" wire:model="meta_robots">
                                            <option value="index, follow">Index, Follow</option>
                                            <option value="noindex, follow">No Index, Follow</option>
                                            <option value="index, nofollow">Index, No Follow</option>
                                            <option value="noindex, nofollow">No Index, No Follow</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">OG Title</label>
                                        <input type="text" class="form-control" wire:model="og_title">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">OG Description</label>
                                        <textarea class="form-control" rows="2" wire:model="og_description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-google me-2"></i>Verification & Tracking
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Google Analytics ID</label>
                                        <input type="text" class="form-control" wire:model="google_analytics_id" placeholder="G-XXXXXXXXXX">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Google Tag Manager ID</label>
                                        <input type="text" class="form-control" wire:model="google_tag_manager_id" placeholder="GTM-XXXXXXX">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Google Site Verification</label>
                                        <textarea class="form-control" rows="2" wire:model="google_site_verification"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Facebook Pixel ID</label>
                                        <input type="text" class="form-control" wire:model="facebook_pixel_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Scripts Tab -->
                    <div class="{{ $activeTab === 'scripts' ? '' : 'd-none' }}">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-code-slash me-2"></i>Custom Scripts
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Header Scripts</label>
                                    <textarea class="form-control font-monospace" rows="6" wire:model="custom_header_scripts" placeholder="<!-- Paste header scripts here -->"></textarea>
                                    <small class="text-muted">These scripts will be placed in the &lt;head&gt; tag</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Footer Scripts</label>
                                    <textarea class="form-control font-monospace" rows="6" wire:model="custom_footer_scripts" placeholder="<!-- Paste footer scripts here -->"></textarea>
                                    <small class="text-muted">These scripts will be placed before &lt;/body&gt;</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Custom CSS</label>
                                    <textarea class="form-control font-monospace" rows="8" wire:model="custom_css" placeholder="/* Custom CSS */"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Custom JavaScript</label>
                                    <textarea class="form-control font-monospace" rows="8" wire:model="custom_javascript" placeholder="// Custom JavaScript"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ============================================ --}}
                    {{-- CONTENT TAB - UPDATED WITH REUSABLE CKEDITOR --}}
                    {{-- ============================================ --}}
                    <div class="{{ $activeTab === 'content' ? '' : 'd-none' }}">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-file-text me-2"></i>Footer Content
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Footer About</label>
                                    <livewire:components.ck-editor 
                                        label="Footer About" 
                                        placeholder="Enter footer about content..." 
                                        height="300px" 
                                        toolbar="full" 
                                        :value="$footer_aboutus"
                                        field="footer_aboutus"
                                        wire:key="footer-about-editor"
                                    />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Copyright Text</label>
                                    <input type="text" class="form-control" wire:model="footer_copyright_text">
                                    <small class="text-muted">Use :year and :company as placeholders</small>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-file-earmark-text me-2"></i>Legal Pages
                                </h3>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-3" role="tablist">
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#terms-tab" type="button">Terms & Conditions</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#privacy-tab" type="button">Privacy Policy</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#refund-tab" type="button">Refund Policy</button>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="terms-tab">
                                        <livewire:components.ck-editor 
                                            label="Terms & Conditions" 
                                            placeholder="Enter terms and conditions..." 
                                            height="400px" 
                                            toolbar="full" 
                                            :value="$terms_and_conditions"
                                            field="terms_and_conditions"
                                            wire:key="terms-editor"
                                        />
                                    </div>
                                    <div class="tab-pane fade" id="privacy-tab">
                                        <livewire:components.ck-editor 
                                            label="Privacy Policy" 
                                            placeholder="Enter privacy policy..." 
                                            height="400px" 
                                            toolbar="full" 
                                            :value="$privacy_policy"
                                            field="privacy_policy"
                                            wire:key="privacy-editor"
                                        />
                                    </div>
                                    <div class="tab-pane fade" id="refund-tab">
                                        <livewire:components.ck-editor 
                                            label="Refund Policy" 
                                            placeholder="Enter refund policy..." 
                                            height="400px" 
                                            toolbar="full" 
                                            :value="$refund_policy"
                                            field="refund_policy"
                                            wire:key="refund-editor"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email Tab -->
                    <div class="{{ $activeTab === 'email' ? '' : 'd-none' }}">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-envelope me-2"></i>SMTP Configuration
                                </h3>
                                <button type="button" class="btn btn-sm btn-outline-primary" wire:click="testEmail">
                                    <i class="bi bi-send me-1"></i> Test Email
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="form-label fw-semibold">SMTP Host</label>
                                        <input type="text" class="form-control" wire:model="smtp_host">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">SMTP Port</label>
                                        <input type="text" class="form-control" wire:model="smtp_port">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Username</label>
                                        <input type="text" class="form-control" wire:model="smtp_username">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Password</label>
                                        <input type="password" class="form-control" wire:model="smtp_password">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Encryption</label>
                                        <select class="form-select" wire:model="smtp_encryption">
                                            <option value="tls">TLS</option>
                                            <option value="ssl">SSL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">From Address</label>
                                        <input type="email" class="form-control" wire:model="mail_from_address">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">From Name</label>
                                        <input type="text" class="form-control" wire:model="mail_from_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Features Tab -->
                    <div class="{{ $activeTab === 'features' ? '' : 'd-none' }}">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-toggle-on me-2"></i>Feature Toggles
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    @php
                                    $features = [
                                        'enable_blog' => ['Blog', 'Enable blog system'],
                                        'enable_comments' => ['Comments', 'Allow blog comments'],
                                        'enable_newsletter' => ['Newsletter', 'Enable newsletter subscription'],
                                        'enable_chat' => ['Live Chat', 'Enable live chat widget'],
                                        'enable_quote_form' => ['Quote Form', 'Enable quote request form'],
                                        'enable_portfolio' => ['Portfolio', 'Enable portfolio/projects'],
                                        'enable_testimonials' => ['Testimonials', 'Enable testimonials section'],
                                        'enable_faq' => ['FAQ', 'Enable FAQ section'],
                                        'enable_search' => ['Search', 'Enable search functionality'],
                                    ];
                                    @endphp
                                    
                                    @foreach($features as $key => $feature)
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-between align-items-center p-3 border rounded">
                                            <div>
                                                <strong>{{ $feature[0] }}</strong>
                                                <br><small class="text-muted">{{ $feature[1] }}</small>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" wire:model="{{ $key }}" id="{{ $key }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-chat-dots me-2"></i>Chat Widgets
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Tawk.to ID</label>
                                        <input type="text" class="form-control" wire:model="tawk_to_id">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">FB Messenger ID</label>
                                        <input type="text" class="form-control" wire:model="fb_messenger_id">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">WhatsApp Chat Number</label>
                                        <input type="text" class="form-control" wire:model="whatsapp_chat_number">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Tab -->
                    <div class="{{ $activeTab === 'security' ? '' : 'd-none' }}">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-shield-check me-2"></i>Security Settings
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-between align-items-center p-3 border rounded">
                                            <div><strong>Force HTTPS</strong><br><small class="text-muted">Redirect all HTTP to HTTPS</small></div>
                                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" wire:model="force_https"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-between align-items-center p-3 border rounded">
                                            <div><strong>Enable CAPTCHA</strong><br><small class="text-muted">Google reCAPTCHA</small></div>
                                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" wire:model="enable_captcha"></div>
                                        </div>
                                    </div>
                                    @if($enable_captcha)
                                    <div class="col-md-6"><label class="form-label fw-semibold">Site Key</label><input type="text" class="form-control" wire:model="captcha_site_key"></div>
                                    <div class="col-md-6"><label class="form-label fw-semibold">Secret Key</label><input type="password" class="form-control" wire:model="captcha_secret_key"></div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-facebook me-2"></i>Social Login</h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center p-3 border rounded mb-3">
                                            <div><i class="bi bi-facebook text-primary fs-5 me-2"></i><strong>Facebook Login</strong></div>
                                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" wire:model="facebook_login"></div>
                                        </div>
                                        @if($facebook_login)
                                        <div class="row g-3">
                                            <div class="col-md-6"><label class="form-label fw-semibold">App ID</label><input type="text" class="form-control" wire:model="facebook_client_id"></div>
                                            <div class="col-md-6"><label class="form-label fw-semibold">App Secret</label><input type="password" class="form-control" wire:model="facebook_client_secret"></div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center p-3 border rounded mb-3">
                                            <div><i class="bi bi-google text-danger fs-5 me-2"></i><strong>Google Login</strong></div>
                                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" wire:model="google_login"></div>
                                        </div>
                                        @if($google_login)
                                        <div class="row g-3">
                                            <div class="col-md-6"><label class="form-label fw-semibold">Client ID</label><input type="text" class="form-control" wire:model="google_client_id"></div>
                                            <div class="col-md-6"><label class="form-label fw-semibold">Client Secret</label><input type="password" class="form-control" wire:model="google_client_secret"></div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Maintenance Tab -->
                    <div class="{{ $activeTab === 'maintenance' ? '' : 'd-none' }}">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-tools me-2"></i>Maintenance Mode</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center p-3 border rounded mb-3">
                                    <div><strong>Enable Maintenance Mode</strong><br><small class="text-muted">Site will show maintenance page to visitors</small></div>
                                    <div class="form-check form-switch"><input class="form-check-input" type="checkbox" wire:model="maintenance_mode"></div>
                                </div>
                                @if($maintenance_mode)
                                <div class="row g-3">
                                    <div class="col-12"><label class="form-label fw-semibold">Maintenance Title</label><input type="text" class="form-control" wire:model="maintenance_title"></div>
                                    <div class="col-12"><label class="form-label fw-semibold">Maintenance Message</label><textarea class="form-control" rows="4" wire:model="maintenance_message"></textarea></div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="col-12 col-lg-3">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body text-center">
                            <button type="submit" class="btn btn-primary btn-lg w-100" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="save"><i class="bi bi-check-lg me-1"></i> Save All Settings</span>
                                <span wire:loading wire:target="save"><span class="spinner-border spinner-border-sm me-1"></span> Saving...</span>
                            </button>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent"><h3 class="card-title mb-0 fs-6">Quick Actions</h3></div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="clearCache">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Clear Cache
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-transparent"><h3 class="card-title mb-0 fs-6">Site Info</h3></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 small">
                                <li class="mb-2"><strong>Name:</strong> {{ $site_name ?: 'Not set' }}</li>
                                <li class="mb-2"><strong>URL:</strong> {{ $site_url ?: 'Not set' }}</li>
                                <li class="mb-2"><strong>Email:</strong> {{ $email_primary ?: 'Not set' }}</li>
                                <li class="mb-2"><strong>Phone:</strong> {{ $mobile_phone_1 ?: 'Not set' }}</li>
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
    .required::after { content: ' *'; color: #dc3545; }
    .seo-preview { background: #fff; max-width: 600px; }
    @media (max-width: 768px) { .seo-preview { max-width: 100%; } }
    [x-cloak] { display: none !important; }
</style>
@endpush