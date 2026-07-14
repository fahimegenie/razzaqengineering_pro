<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Dynamic SEO Generator</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.seo.index') }}">SEO Management</a></li>
                        <li class="breadcrumb-item active">Dynamic Generator</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        {{-- Stats --}}
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-2">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body text-center py-2">
                        <i class="bi bi-tools"></i>
                        <h5 class="mb-0 mt-1">{{ $totalServices }}</h5>
                        <small>Services</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center py-2">
                        <i class="bi bi-briefcase"></i>
                        <h5 class="mb-0 mt-1">{{ $totalProjects }}</h5>
                        <small>Projects</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 shadow-sm bg-warning text-white">
                    <div class="card-body text-center py-2">
                        <i class="bi bi-box"></i>
                        <h5 class="mb-0 mt-1">{{ $totalProducts }}</h5>
                        <small>Products</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 shadow-sm bg-danger text-white">
                    <div class="card-body text-center py-2">
                        <i class="bi bi-journal-text"></i>
                        <h5 class="mb-0 mt-1">{{ $totalBlogs }}</h5>
                        <small>Blogs</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body text-center py-2">
                        <i class="bi bi-images"></i>
                        <h5 class="mb-0 mt-1">{{ $totalGalleries }}</h5>
                        <small>Gallery</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 shadow-sm bg-dark text-white">
                    <div class="card-body text-center py-2">
                        <i class="bi bi-geo-alt"></i>
                        <h5 class="mb-0 mt-1">{{ $totalCities }}</h5>
                        <small>Cities</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Generator Settings --}}
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-transparent">
                <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-magic me-2"></i>SEO Generator Settings</h3>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label required">Page Type</label>
                        <select class="form-select" wire:model.live="selectedPageType">
                            <option value="">-- Select Page Type --</option>
                            @foreach($pageTypes as $val => $label)
                            <option value="{{ $val }}" wire:key="items-page-types-{{ $val }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label required">Generate Mode</label>
                        <select class="form-select" wire:model="generateMode">
                            <option value="both">Pages + Cities</option>
                            <option value="pages">Pages Only</option>
                            <option value="cities">Cities Only</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100" wire:click="preview">
                            <i class="bi bi-eye me-1"></i> Preview
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Wrapped in an isolated DOM block to prevent hydration issues --}}
        <div id="selection-panels-wrapper">
            @if($selectedPageType)
            <div class="row g-3">
                {{-- Items Selection --}}
                @if($generateMode !== 'cities')
                <div class="col-md-6" wire:key="items-selection-panel">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-list-check me-2"></i>Select {{ $pageTypes[$selectedPageType] ?? 'Items' }}
                            </h5>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model.live="selectAll" id="selectAll">
                                <label class="form-check-label" for="selectAll">Select All</label>
                            </div>
                        </div>
                        <div class="card-body" style="max-height:400px;overflow-y:auto;">
                            @if(count($availableItems) > 0)
                                @foreach($availableItems as $item)
                                @php
                                    $itemName = match($selectedPageType) {
                                        'service' => $item->os_name ?? 'N/A',
                                        'project' => $item->p_title ?? 'N/A',
                                        'product' => $item->p_name ?? 'N/A',
                                        'blog' => $item->bp_title ?? 'N/A',
                                        'gallery' => $item->wg_title ?? 'N/A',
                                        'testimonial' => $item->t_name ?? 'N/A',
                                        'team' => $item->ot_name ?? 'N/A',
                                        default => 'Item #'.$item->id,
                                    };
                                @endphp
                                <div class="form-check" wire:key="item-check-group-{{ $selectedPageType }}-{{ $item->id }}">
                                    <input class="form-check-input" type="checkbox" value="{{ $item->id }}" wire:model="selectedItems" id="item_{{ $item->id }}">
                                    <label class="form-check-label" for="item_{{ $item->id }}">{{ $itemName }}</label>
                                </div>
                                @endforeach
                            @else
                                <p class="text-muted text-center py-3">Select a page type to see items.</p>
                            @endif
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">{{ count($selectedItems) }} of {{ count($availableItems) }} selected</small>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Cities Selection --}}
                @if($generateMode !== 'pages')
                <div class="col-md-6" wire:key="cities-selection-panel">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-geo-alt me-2"></i>Select Cities
                            </h5>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model.live="selectAllCities" id="selectAllCities">
                                <label class="form-check-label" for="selectAllCities">Select All ({{ $totalCities }})</label>
                            </div>
                        </div>
                        <div class="card-body" style="max-height:400px;overflow-y:auto;">
                            @foreach($availableCities as $city)
                            {{-- Key attached properly to preserve state --}}
                            <div class="form-check" wire:key="city-check-group-{{ $city->id }}">
                                <input class="form-check-input" type="checkbox" value="{{ $city->id }}" wire:model="selectedCities" id="city_{{ $city->id }}">
                                <label class="form-check-label" for="city_{{ $city->id }}">{{ $city->name }}, {{ $city->country }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">{{ count($selectedCities) }} of {{ $totalCities }} selected</small>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endif
        </div>

        {{-- Template Settings --}}
        <div class="card shadow-sm border-0 mb-3 mt-3">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0 fw-semibold">
                    <i class="bi bi-braces me-2"></i>SEO Templates
                    <small class="text-muted">(use <code>{name}</code> and <code>{city}</code>)</small>
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Page Title Template</label>
                        <input type="text" class="form-control" wire:model="seoTitleTemplate">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City Page Title Template</label>
                        <input type="text" class="form-control" wire:model="cityTitleTemplate">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Page Description Template</label>
                        <textarea class="form-control" rows="2" wire:model="seoDescriptionTemplate"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City Page Description Template</label>
                        <textarea class="form-control" rows="2" wire:model="cityDescriptionTemplate"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Page Keywords Template</label>
                        <input type="text" class="form-control" wire:model="seoKeywordsTemplate">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City Page Keywords Template</label>
                        <input type="text" class="form-control" wire:model="cityKeywordsTemplate">
                    </div>
                </div>
            </div>
        </div>

        {{-- Preview --}}
        @if($showPreview)
        <div class="card shadow-sm border-0 mb-3" wire:key="preview-table-card">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-semibold">
                    <i class="bi bi-eye me-2"></i>Preview ({{ $totalCount }} records)
                </h5>
                <button type="button" class="btn btn-success" wire:click="generate" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="generate">
                        <i class="bi bi-rocket-takeoff me-1"></i> Generate All SEO Data
                    </span>
                    <span wire:loading wire:target="generate">
                        <span class="spinner-border spinner-border-sm me-1"></span> Generating...
                    </span>
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height:400px;overflow-y:auto;">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>URL</th>
                                <th>SEO Title</th>
                                <th>City</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($previewData as $i => $data)
                            <tr wire:key="preview-row-{{ $i }}">
                                <td>{{ $i + 1 }}</td>
                                <td><span class="badge bg-primary">{{ $data['type'] }}</span></td>
                                <td>{{ $data['name'] }}</td>
                                <td><small>{{ $data['url'] }}</small></td>
                                <td><small>{{ $data['seo_title'] }}</small></td>
                                <td>
                                    @if($data['has_city'])
                                    <span class="badge bg-info">{{ $data['city'] }}</span>
                                    @else
                                    <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        {{-- Progress --}}
        @if($isGenerating)
        <div class="card shadow-sm border-0 mb-3" wire:key="generation-progress-card">
            <div class="card-body text-center py-4">
                <h5><i class="bi bi-hourglass-split spin me-2"></i>Generating SEO Data...</h5>
                <div class="progress mt-2" style="height:25px;">
                    @php
                        $percentage = $totalCount > 0 ? ($progressCount / $totalCount) * 100 : 0;
                    @endphp
                    <div class="progress-bar progress-bar-striped progress-bar-animated" 
                         style="width:{{ $percentage }}%">
                        {{ $progressCount }} / {{ $totalCount }}
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($generationComplete)
        <div class="alert alert-success" wire:key="generation-success-alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            Successfully generated <strong>{{ $progressCount }}</strong> SEO records!
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .spin {
        animation: spin 2s linear infinite;
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .sticky-top {
        position: sticky;
        top: 0;
        z-index: 1;
    }
</style>
@endpush