<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">SEO Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">SEO Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        {{-- Stats Cards --}}
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-search display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $totalRecords }}</h3>
                        <small>Total Records</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-check-circle display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $indexableRecords }}</h3>
                        <small>Indexable</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-diagram-3 display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $inSitemapRecords }}</h3>
                        <small>In Sitemap</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-warning text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-files display-6"></i>
                        <h3 class="mb-0 mt-1">{{ count($pageTypes) }}</h3>
                        <small>Page Types</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" wire:model.live.debounce.300ms="search" placeholder="Search...">
                            @if($search)
                                <button class="btn btn-outline-secondary" wire:click="clearSearch">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" wire:model.live="pageTypeFilter">
                            <option value="">All Types</option>
                            @foreach($pageTypes as $type)
                                <option value="{{ $type }}">{{ $this->getPageTypeLabel($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" wire:model.live="indexFilter">
                            <option value="">Index Status</option>
                            <option value="index">Indexable</option>
                            <option value="noindex">No Index</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" wire:model.live="sitemapFilter">
                            <option value="">Sitemap</option>
                            <option value="1">In Sitemap</option>
                            <option value="0">Not in Sitemap</option>
                        </select>
                    </div>
                    <div class="col-md-3 text-end">
                        <button class="btn btn-outline-secondary me-1" wire:click="clearFilters">
                            <i class="bi bi-funnel"></i> Clear
                        </button>
                        <a href="{{ route('admin.seo.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg"></i> Add SEO Data
                        </a>
                    </div>
                </div>
                
                @if(count($selectedItems) > 0)
                <div class="mt-3 p-2 bg-light rounded d-flex gap-2 align-items-center">
                    <span class="fw-semibold">{{ count($selectedItems) }} selected</span>
                    <button class="btn btn-sm btn-danger" wire:click="bulkDelete" 
                            onclick="return confirm('Delete {{ count($selectedItems) }} selected records?')">
                        <i class="bi bi-trash"></i> Delete Selected
                    </button>
                </div>
                @endif
            </div>
        </div>

        {{-- Table --}}
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="40">
                                <input type="checkbox" class="form-check-input" 
                                       wire:model.live="selectAll">
                            </th>
                            <th style="cursor:pointer" wire:click="sortBy('seo_page_type')">
                                Page Type 
                                @if($sortField === 'seo_page_type')
                                    <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Robots</th>
                            <th>Sitemap</th>
                            <th>Schema</th>
                            <th>Analytics</th>
                            <th width="140">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($seoRecords as $record)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input" 
                                       wire:key="item-{{ $record->id }}"
                                       @checked(in_array($record->id, $selectedItems)) 
                                       wire:click="toggleItemSelection({{ $record->id }})">
                            </td>
                            <td>
                                <span class="badge bg-primary">
                                    {{ $this->getPageTypeLabel($record->seo_page_type) }}
                                </span>
                            </td>
                            <td>
                                <strong>{{ \Illuminate\Support\Str::limit($record->meta_title, 40) ?: '—' }}</strong>
                            </td>
                            <td>
                                <small class="text-muted">{{ $record->seo_page_url ?: $record->seo_canonical ?: '—' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-{{ $record->seo_no_index ? 'danger' : 'success' }}">
                                    {{ $record->robots_content }}
                                </span>
                            </td>
                            <td>
                                @if($record->seo_sitemap_include)
                                    <span class="badge bg-info">
                                        Yes ({{ $this->getSitemapPriorityFormatted($record->seo_sitemap_priority) }})
                                    </span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                @if($this->hasSchemaMarkup($record))
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                @else
                                    <i class="bi bi-x-circle text-muted"></i>
                                @endif
                            </td>
                            <td>
                                @if($this->hasAnalytics($record))
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                @else
                                    <i class="bi bi-x-circle text-muted"></i>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-info" wire:click="viewItemDetails({{ $record->id }})" 
                                            title="View">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <a href="{{ route('admin.seo.edit', $record->id) }}" 
                                       class="btn btn-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-danger" wire:click="confirmDelete({{ $record->id }})" 
                                            title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="bi bi-search display-4 text-muted d-block"></i>
                                <h5>No SEO records found</h5>
                                <p class="text-muted">Start by adding your first SEO data</p>
                                <a href="{{ route('admin.seo.create') }}" class="btn btn-primary mt-2">
                                    <i class="bi bi-plus-lg"></i> Add SEO Data
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Fixed Pagination --}}
            @if($seoRecords->hasPages())
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="text-muted small">
                        Showing <span class="fw-semibold">{{ $seoRecords->firstItem() }}</span> 
                        to <span class="fw-semibold">{{ $seoRecords->lastItem() }}</span> 
                        of <span class="fw-semibold">{{ $seoRecords->total() }}</span> records
                    </div>
                    <div>
                        {{ $seoRecords->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
            @else
            <div class="card-footer bg-light">
                <div class="text-muted small text-center">
                    Showing all <span class="fw-semibold">{{ $seoRecords->total() }}</span> records
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- View Modal --}}
    @if($showViewModal && $viewItem)
    <div class="modal fade show d-block" style="background:rgba(0,0,0,.5);z-index:1055;" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-eye"></i> SEO Details - {{ $this->getPageTypeLabel($viewItem->seo_page_type) }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h6 class="border-bottom pb-2">Basic Information</h6>
                            <p><strong>Main Title:</strong> {{ $viewItem->seo_main_title ?: '—' }}</p>
                            <p><strong>SEO Title:</strong> {{ $viewItem->seo_title ?: '—' }}</p>
                            <p><strong>Description:</strong> {{ $viewItem->seo_description ?: '—' }}</p>
                            <p><strong>Keywords:</strong> {{ $viewItem->seo_keywords ?: '—' }}</p>
                            <p><strong>Focus Keyword:</strong> {{ $viewItem->seo_focus_keyword ?: '—' }}</p>
                            <p><strong>Canonical URL:</strong> {{ $viewItem->seo_canonical ?: 'Auto-generated' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="border-bottom pb-2">Technical SEO</h6>
                            <p><strong>Robots:</strong> 
                                <span class="badge bg-{{ $viewItem->seo_no_index ? 'danger' : 'success' }}">
                                    {{ $viewItem->robots_content }}
                                </span>
                            </p>
                            <p><strong>Sitemap:</strong> 
                                {{ $viewItem->seo_sitemap_include ? 'Yes' : 'No' }}
                                @if($viewItem->seo_sitemap_include)
                                    (Priority: {{ $this->getSitemapPriorityFormatted($viewItem->seo_sitemap_priority) }})
                                @endif
                            </p>
                            <p><strong>OG Type:</strong> {{ $viewItem->seo_og_type ?: 'website' }}</p>
                            <p><strong>Twitter Card:</strong> {{ $viewItem->seo_twitter_card ?: 'summary_large_image' }}</p>
                            <p><strong>Schema Type:</strong> {{ $viewItem->seo_schema_type ?: 'None' }}</p>
                            <p><strong>Page Type:</strong> {{ $viewItem->seo_page_type }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModals">Close</button>
                    <a href="{{ route('admin.seo.edit', $viewItem->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif

    {{-- Delete Modal --}}
    @if($showDeleteModal)
    <div class="modal fade show d-block" style="background:rgba(0,0,0,.5);z-index:1055;" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle"></i> Confirm Delete
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeModals"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="bi bi-trash display-3 text-danger mb-3 d-block"></i>
                    <h5>Are you sure?</h5>
                    <p class="text-muted">This will permanently delete this SEO record.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" wire:click="closeModals">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteItem">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
</div>