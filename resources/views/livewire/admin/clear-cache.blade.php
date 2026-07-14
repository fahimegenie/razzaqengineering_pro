<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Cache Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Cache Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        
        {{-- Last Cleared Info --}}
        @if($lastCleared)
        <div class="alert alert-info d-flex justify-content-between align-items-center">
            <span><i class="bi bi-clock-history me-2"></i> Last cache cleared: <strong>{{ $lastCleared }}</strong></span>
        </div>
        @endif

        {{-- Results --}}
        @if(count($results) > 0)
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0"><i class="bi bi-list-check me-2"></i>Clear Results</h5>
            </div>
            <div class="card-body">
                @foreach($results as $result)
                <div class="alert alert-{{ $result['type'] }} py-2 mb-1">
                    <i class="bi bi-{{ $result['type'] === 'success' ? 'check-circle' : ($result['type'] === 'error' ? 'exclamation-circle' : 'info-circle') }} me-2"></i>
                    {{ $result['message'] }}
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Cache Statistics --}}
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm bg-primary bg-opacity-10 h-100">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-file-code display-6 text-primary"></i>
                        <h5 class="mb-0 mt-1">{{ $viewCacheCount }}</h5>
                        <small class="text-muted">View Files</small>
                        <div class="small text-primary">{{ $viewCacheSize }}</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm bg-success bg-opacity-10 h-100">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-database display-6 text-success"></i>
                        <h5 class="mb-0 mt-1">{{ $appCacheSize }}</h5>
                        <small class="text-muted">App Cache</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm bg-info bg-opacity-10 h-100">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-gear display-6 text-info"></i>
                        <span class="d-block mt-1">
                            @if($configCacheExists)
                            <span class="badge bg-success">Cached</span>
                            @else
                            <span class="badge bg-secondary">Not Cached</span>
                            @endif
                        </span>
                        <small class="text-muted">Config</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm bg-warning bg-opacity-10 h-100">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-signpost display-6 text-warning"></i>
                        <span class="d-block mt-1">
                            @if($routeCacheExists)
                            <span class="badge bg-success">Cached</span>
                            @else
                            <span class="badge bg-secondary">Not Cached</span>
                            @endif
                        </span>
                        <small class="text-muted">Routes</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm bg-danger bg-opacity-10 h-100">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-lightning display-6 text-danger"></i>
                        <span class="d-block mt-1">
                            @if($eventCacheExists)
                            <span class="badge bg-success">Cached</span>
                            @else
                            <span class="badge bg-secondary">Not Cached</span>
                            @endif
                        </span>
                        <small class="text-muted">Events</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm bg-dark bg-opacity-10 h-100">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-boxes display-6 text-dark"></i>
                        <h5 class="mb-0 mt-1">{{ $compiledCount }}</h5>
                        <small class="text-muted">Compiled</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cache Actions Grid --}}
        <div class="row g-3">
            {{-- Clear All --}}
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-stars display-3 text-primary mb-3"></i>
                        <h5>Clear All Cache</h5>
                        <p class="text-muted small">Clear all types of cache at once including views, application, config, routes, events, logs, and temp files.</p>
                        <button class="btn btn-primary btn-lg w-100" wire:click="confirmClear('all')" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="confirmClear('all')"><i class="bi bi-trash me-1"></i> Clear All</span>
                            <span wire:loading wire:target="confirmClear('all')"><span class="spinner-border spinner-border-sm me-1"></span> Clearing...</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- View Cache --}}
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-file-code display-3 text-info mb-3"></i>
                        <h5>View Cache</h5>
                        <p class="text-muted small">Clear compiled Blade templates. Use when views are not updating after changes.</p>
                        <div class="small text-muted mb-2">{{ $viewCacheCount }} files ({{ $viewCacheSize }})</div>
                        <button class="btn btn-info w-100" wire:click="confirmClear('views')" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="confirmClear('views')"><i class="bi bi-trash me-1"></i> Clear Views</span>
                            <span wire:loading wire:target="confirmClear('views')"><span class="spinner-border spinner-border-sm me-1"></span> Clearing...</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Application Cache --}}
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-database display-3 text-success mb-3"></i>
                        <h5>Application Cache</h5>
                        <p class="text-muted small">Clear cached data stored via Cache facade. Includes Redis, Memcached, or file cache.</p>
                        <div class="small text-muted mb-2">Size: {{ $appCacheSize }}</div>
                        <button class="btn btn-success w-100" wire:click="confirmClear('app')" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="confirmClear('app')"><i class="bi bi-trash me-1"></i> Clear App Cache</span>
                            <span wire:loading wire:target="confirmClear('app')"><span class="spinner-border spinner-border-sm me-1"></span> Clearing...</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Config Cache --}}
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-gear display-3 text-warning mb-3"></i>
                        <h5>Config Cache</h5>
                        <p class="text-muted small">Clear cached configuration files. Use after changing .env or config files.</p>
                        <div class="small text-muted mb-2">Status: {!! $configCacheExists ? '<span class="text-success">Cached</span>' : '<span class="text-secondary">Not Cached</span>' !!}</div>
                        <button class="btn btn-warning w-100" wire:click="confirmClear('config')" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="confirmClear('config')"><i class="bi bi-trash me-1"></i> Clear Config</span>
                            <span wire:loading wire:target="confirmClear('config')"><span class="spinner-border spinner-border-sm me-1"></span> Clearing...</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Route Cache --}}
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-signpost display-3 text-danger mb-3"></i>
                        <h5>Route Cache</h5>
                        <p class="text-muted small">Clear cached routes. Use after modifying route files.</p>
                        <div class="small text-muted mb-2">Status: {!! $routeCacheExists ? '<span class="text-success">Cached</span>' : '<span class="text-secondary">Not Cached</span>' !!}</div>
                        <button class="btn btn-danger w-100" wire:click="confirmClear('route')" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="confirmClear('route')"><i class="bi bi-trash me-1"></i> Clear Routes</span>
                            <span wire:loading wire:target="confirmClear('route')"><span class="spinner-border spinner-border-sm me-1"></span> Clearing...</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Event Cache --}}
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-lightning display-3 text-dark mb-3"></i>
                        <h5>Event Cache</h5>
                        <p class="text-muted small">Clear cached events and listeners. Use after modifying EventServiceProvider.</p>
                        <div class="small text-muted mb-2">Status: {!! $eventCacheExists ? '<span class="text-success">Cached</span>' : '<span class="text-secondary">Not Cached</span>' !!}</div>
                        <button class="btn btn-dark w-100" wire:click="confirmClear('event')" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="confirmClear('event')"><i class="bi bi-trash me-1"></i> Clear Events</span>
                            <span wire:loading wire:target="confirmClear('event')"><span class="spinner-border spinner-border-sm me-1"></span> Clearing...</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Compiled Classes --}}
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-boxes display-3 text-secondary mb-3"></i>
                        <h5>Compiled Classes</h5>
                        <p class="text-muted small">Clear compiled PHP classes and services. Part of optimize:clear.</p>
                        <button class="btn btn-secondary w-100" wire:click="confirmClear('compiled')" wire:loading.attr="disabled">
                            <i class="bi bi-trash me-1"></i> Clear Compiled
                        </button>
                    </div>
                </div>
            </div>

            {{-- Livewire Cache --}}
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-bolt display-3 text-purple mb-3" style="color:#fb70a9;"></i>
                        <h5>Livewire Cache</h5>
                        <p class="text-muted small">Clear Livewire component cache and rediscover components.</p>
                        <button class="btn w-100" style="background:#fb70a9;color:white;" wire:click="confirmClear('livewire')" wire:loading.attr="disabled">
                            <i class="bi bi-trash me-1"></i> Clear Livewire
                        </button>
                    </div>
                </div>
            </div>

            {{-- Optimize --}}
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-rocket-takeoff display-3 text-primary mb-3"></i>
                        <h5>Optimize Application</h5>
                        <p class="text-muted small">Re-cache config, routes, and events for production performance.</p>
                        <button class="btn btn-outline-primary w-100" wire:click="confirmClear('optimize')" wire:loading.attr="disabled">
                            <i class="bi bi-rocket me-1"></i> Optimize
                        </button>
                    </div>
                </div>
            </div>

            {{-- Debugbar --}}
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-bug display-3 text-danger mb-3"></i>
                        <h5>Debugbar Storage</h5>
                        <p class="text-muted small">Clear Laravel Debugbar stored data files.</p>
                        <button class="btn btn-outline-danger w-100" wire:click="confirmClear('debugbar')" wire:loading.attr="disabled">
                            <i class="bi bi-trash me-1"></i> Clear Debugbar
                        </button>
                    </div>
                </div>
            </div>

            {{-- Logs --}}
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-file-text display-3 text-warning mb-3"></i>
                        <h5>Log Files</h5>
                        <p class="text-muted small">Clear all Laravel log files to free up disk space.</p>
                        <button class="btn btn-outline-warning w-100" wire:click="confirmClear('log')" wire:loading.attr="disabled">
                            <i class="bi bi-trash me-1"></i> Clear Logs
                        </button>
                    </div>
                </div>
            </div>

            {{-- Temp Files --}}
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-clock-history display-3 text-info mb-3"></i>
                        <h5>Temporary Files</h5>
                        <p class="text-muted small">Clear temporary files from storage/temp and storage/app/temp.</p>
                        <button class="btn btn-outline-info w-100" wire:click="confirmClear('temp')" wire:loading.attr="disabled">
                            <i class="bi bi-trash me-1"></i> Clear Temp Files
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Loading Overlay --}}
        @if($isClearing)
        <div class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" 
             style="background:rgba(0,0,0,0.5);z-index:9999;">
            <div class="bg-white rounded-3 p-4 text-center shadow-lg">
                <div class="spinner-border text-primary mb-3" style="width:3rem;height:3rem;"></div>
                <h5>Clearing Cache...</h5>
                <p class="text-muted mb-0">Please wait while the cache is being cleared.</p>
            </div>
        </div>
        @endif
    </div>

    {{-- Confirm Modal --}}
    @if($showConfirmModal)
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ $confirmTitle }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeConfirmModal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="bi bi-trash display-3 text-warning mb-3 d-block"></i>
                    <h5>Are you sure?</h5>
                    <p class="text-muted">This action will clear the selected cache. It may temporarily slow down your application until the cache is rebuilt.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" wire:click="closeConfirmModal">Cancel</button>
                    <button type="button" class="btn btn-warning" wire:click="executeClear">
                        <i class="bi bi-check-lg me-1"></i> Yes, Clear Cache
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
    .card { transition: all 0.3s ease; }
    .card:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
</style>
@endpush