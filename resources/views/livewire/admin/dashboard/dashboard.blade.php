<div x-data="dashboardHandler()" x-init="initCharts()">
    <!-- Loading State -->
    <div wire:loading 
        wire:target="refreshData, updatedPeriod" 
        class="position-fixed top-0 start-0 w-100 h-100 d-none align-items-center justify-content-center" 
        style="background: rgba(0,0,0,0.3); z-index: 99999; pointer-events: auto;"
        :class="{ 'd-flex': true }">
        <div class="bg-body p-4 rounded-3 shadow-lg text-center border border-secondary-subtle">
            <div class="spinner-border text-primary mb-2" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mb-0 fw-semibold">Refreshing dashboard...</p>
        </div>
    </div>

    <!-- Error State -->
    @if($errorMessage)
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
            <div>
                <strong>Error!</strong> {{ $errorMessage }}
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <div class="mt-2">
            <button wire:click="refreshData" class="btn btn-danger btn-sm">
                <i class="bi bi-arrow-clockwise me-1"></i> Retry
            </button>
        </div>
    </div>
    @endif

    <!-- Welcome Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white shadow-sm border-0 overflow-hidden">
                <div class="position-absolute end-0 top-0 opacity-10" style="font-size: 150px;">
                    <i class="bi bi-speedometer2"></i>
                </div>
                <div class="card-body p-4 position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="mb-2 fw-bold">{{ $welcomeMessage }}</h2>
                            <p class="mb-0 opacity-90">
                                Here's what's happening with your website today. 
                                @if(!empty($newMessages) && $newMessages > 0)
                                You have <strong class="text-warning">{{ $newMessages }}</strong> new messages
                                @endif
                                @if(!empty($newQuotes) && $newQuotes > 0)
                                and <strong class="text-warning">{{ $newQuotes }}</strong> pending quotes.
                                @endif
                            </p>
                            <div class="mt-3 d-flex gap-3">
                                <small class="opacity-75">
                                    <i class="bi bi-clock"></i> Last refreshed: {{ $lastRefreshed?->diffForHumans() ?? 'Never' }}
                                </small>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <button wire:click="refreshData" 
                                    wire:loading.attr="disabled"
                                    class="btn btn-light btn-lg rounded-pill px-4 shadow-sm">
                                <span wire:loading.remove wire:target="refreshData">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Refresh
                                </span>
                                <span wire:loading wire:target="refreshData">
                                    <span class="spinner-border spinner-border-sm me-1"></span> Loading...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Stats Bar -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-envelope text-primary fs-4"></i>
                    <h4 class="mb-0 mt-1 fw-bold">{{ $todayStats['messages'] }}</h4>
                    <small class="text-muted">Today Messages</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-briefcase text-warning fs-4"></i>
                    <h4 class="mb-0 mt-1 fw-bold">{{ $todayStats['projects'] }}</h4>
                    <small class="text-muted">Today Projects</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-person-plus text-success fs-4"></i>
                    <h4 class="mb-0 mt-1 fw-bold">{{ $todayStats['users'] }}</h4>
                    <small class="text-muted">New Users</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-receipt text-danger fs-4"></i>
                    <h4 class="mb-0 mt-1 fw-bold">{{ $todayStats['quotes'] }}</h4>
                    <small class="text-muted">New Quotes</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-pills mb-4" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'overview' ? 'active' : '' }}" 
                    wire:click="setTab('overview')" 
                    type="button">
                <i class="bi bi-grid me-1"></i> Overview
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'analytics' ? 'active' : '' }}" 
                    wire:click="setTab('analytics')" 
                    type="button">
                <i class="bi bi-graph-up me-1"></i> Analytics
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'recent' ? 'active' : '' }}" 
                    wire:click="setTab('recent')" 
                    type="button">
                <i class="bi bi-clock-history me-1"></i> Recent Activity
            </button>
        </li>
    </ul>

    @if($activeTab === 'overview')
    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        @foreach($stats as $index => $stat)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="small-box text-bg-{{ $stat['color'] }} shadow-sm h-100 cursor-pointer"
                 @click="$wire.showStatDetail({{ $index }})"
                 style="cursor: pointer;">
                <div class="inner">
                    <h3 class="fw-bold">{{ $stat['value'] }}</h3>
                    <p class="mb-1">{{ $stat['title'] }}</p>
                    @if(isset($stat['trend']))
                    <small class="text-{{ $stat['trend_color'] }}">
                        <i class="bi {{ $stat['trend_icon'] }}"></i> {{ $stat['trend'] }}
                    </small>
                    @endif
                </div>
                <i class="bi {{ $stat['icon'] }} small-box-icon opacity-25"></i>
                <a href="{{ $stat['url'] }}" 
                   class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Manage <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-lightning-charge text-warning me-2"></i>Quick Actions
                    </h3>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($quickActions as $action)
                        <a href="{{ $action['url'] }}" 
                           class="btn btn-{{ $action['color'] }} rounded-pill">
                            <i class="bi {{ $action['icon'] }} me-1"></i> {{ $action['label'] }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($activeTab === 'analytics')
    <!-- Charts Row -->
    <div class="row g-3 mb-4">
        <!-- Project Status -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-pie-chart me-2 text-primary"></i>Project Status
                    </h3>
                </div>
                <div class="card-body">
                    <div id="project-status-chart" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>
        
        <!-- Monthly Messages -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-graph-up me-2 text-success"></i>Monthly Messages
                    </h3>
                    <div class="btn-group btn-group-sm">
                        <button wire:click="$set('chartType', 'area')" 
                                class="btn btn-outline-secondary {{ $chartType === 'area' ? 'active' : '' }}">
                            Area
                        </button>
                        <button wire:click="$set('chartType', 'bar')" 
                                class="btn btn-outline-secondary {{ $chartType === 'bar' ? 'active' : '' }}">
                            Bar
                        </button>
                        <button wire:click="$set('chartType', 'line')" 
                                class="btn btn-outline-secondary {{ $chartType === 'line' ? 'active' : '' }}">
                            Line
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <select wire:model.live="period" class="form-select form-select-sm w-auto">
                            <option value="6months">Last 6 Months</option>
                            <option value="12months">Last 12 Months</option>
                        </select>
                    </div>
                    <div id="monthly-messages-chart" style="min-height: 300px;"></div>
                </div>
            </div>
        </div>
        
        <!-- Services Chart -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-bar-chart me-2 text-info"></i>Service Details
                    </h3>
                </div>
                <div class="card-body">
                    <div id="services-chart" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>
        
        <!-- Blog Categories -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-diagram-3 me-2 text-warning"></i>Blog Categories
                    </h3>
                </div>
                <div class="card-body">
                    <div id="blog-categories-chart" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($activeTab === 'recent')
    <!-- Recent Activity Tables -->
    <div class="row g-3">
        <!-- Recent Messages -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-envelope me-2 text-primary"></i>Recent Messages
                    </h3>
                    <a href="{{ route('admin.contacts.messages') }}" class="btn btn-sm btn-outline-primary rounded-pill">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentMessages as $message)
                                <tr>
                                    <td class="fw-medium">{{ $message->cm_name }}</td>
                                    <td>{{ Str::limit($message->cm_subject, 35) }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-{{ 
                                            $message->cm_status === 'new' ? 'danger' : 
                                            ($message->cm_status === 'read' ? 'warning' : 'success') 
                                        }}">
                                            {{ ucfirst($message->cm_status) }}
                                        </span>
                                    </td>
                                    <td><small class="text-muted">{{ $message->created_at->diffForHumans() }}</small></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                                        No messages yet
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Projects -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-briefcase me-2 text-warning"></i>Recent Projects
                    </h3>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-warning rounded-pill">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Project</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentProjects as $project)
                                <tr>
                                    <td class="fw-medium">{{ $project->p_title }}</td>
                                    <td>{{ $project->category->pc_name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-{{ 
                                            $project->p_status === 'completed' ? 'success' : 
                                            ($project->p_status === 'in-progress' ? 'warning' : 'info') 
                                        }}">
                                            {{ ucfirst($project->p_status) }}
                                        </span>
                                    </td>
                                    <td><small class="text-muted">{{ $project->created_at->diffForHumans() }}</small></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                                        No projects yet
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Blog Posts -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-journal-text me-2 text-info"></i>Recent Blog Posts
                    </h3>
                    <a href="{{ route('admin.blog.posts.index') }}" class="btn btn-sm btn-outline-info rounded-pill">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBlogPosts as $post)
                                <tr>
                                    <td class="fw-medium">{{ Str::limit($post->bp_title, 40) }}</td>
                                    <td>{{ $post->category->bc_name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-{{ 
                                            $post->bp_status === 'published' ? 'success' : 
                                            ($post->bp_status === 'draft' ? 'warning' : 'secondary') 
                                        }}">
                                            {{ ucfirst($post->bp_status) }}
                                        </span>
                                    </td>
                                    <td><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                                        No posts yet
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Quotes -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-receipt me-2 text-danger"></i>Recent Quotes
                    </h3>
                    <a href="{{ route('admin.quotes.index') }}" class="btn btn-sm btn-outline-danger rounded-pill">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Service</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentQuotes as $quote)
                                <tr>
                                    <td class="fw-medium">{{ $quote->qr_name }}</td>
                                    <td>{{ $quote->qr_service_type }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-{{ 
                                            $quote->qr_status === 'pending' ? 'warning' : 
                                            ($quote->qr_status === 'completed' ? 'success' : 'secondary') 
                                        }}">
                                            {{ ucfirst($quote->qr_status) }}
                                        </span>
                                    </td>
                                    <td><small class="text-muted">{{ $quote->created_at->diffForHumans() }}</small></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                                        No quotes yet
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Stat Detail Modal -->
    <div class="modal fade" 
         id="statDetailModal" 
         tabindex="-1" 
         x-show="$wire.showDetailModal"
         x-ref="statModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-{{ $selectedStat['color'] ?? 'primary' }} text-white">
                    <h5 class="modal-title">
                        <i class="bi {{ $selectedStat['icon'] ?? 'bi-info-circle' }} me-2"></i>
                        {{ $selectedStat['title'] ?? 'Detail' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeDetailModal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <h1 class="display-1 fw-bold text-{{ $selectedStat['color'] ?? 'primary' }}">
                        {{ $selectedStat['value'] ?? 0 }}
                    </h1>
                    <p class="lead">{{ $selectedStat['title'] ?? '' }}</p>
                    @if(isset($selectedStat['trend']))
                    <p class="text-{{ $selectedStat['trend_color'] ?? 'success' }}">
                        <i class="bi {{ $selectedStat['trend_icon'] ?? 'bi-arrow-up' }}"></i>
                        {{ $selectedStat['trend'] }}
                    </p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeDetailModal">Close</button>
                    @if(isset($selectedStat['url']))
                    <a href="{{ $selectedStat['url'] }}" class="btn btn-primary">Manage</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function dashboardHandler() {
        return {
            charts: {},
            
            initCharts() {
                this.$nextTick(() => {
                    this.renderProjectChart();
                    this.renderMessagesChart();
                    this.renderServicesChart();
                    this.renderBlogChart();
                });
                
                // Listen for Livewire events
                Livewire.on('chart-updated', (data) => {
                    if (data.chart === 'monthlyMessages') {
                        this.renderMessagesChart();
                    }
                });
                
                Livewire.on('chart-type-changed', (data) => {
                    this.renderMessagesChart(data.type);
                });
                
                // Re-render on tab change
                this.$watch('$wire.activeTab', (value) => {
                    if (value === 'analytics') {
                        this.$nextTick(() => {
                            this.renderAllCharts();
                        });
                    }
                });
            },
            
            renderAllCharts() {
                this.renderProjectChart();
                this.renderMessagesChart();
                this.renderServicesChart();
                this.renderBlogChart();
            },
            
            renderProjectChart() {
                const el = document.querySelector('#project-status-chart');
                if (!el) return;
                
                if (this.charts.project) {
                    this.charts.project.destroy();
                }
                
                const data = @json($projectStatusChart);
                
                this.charts.project = new ApexCharts(el, {
                    series: data.series,
                    chart: { type: 'donut', height: 350 },
                    labels: data.labels,
                    colors: data.colors,
                    legend: { position: 'bottom' },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '60%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'Total',
                                        formatter: (w) => w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                    }
                                }
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: { height: 300 },
                            legend: { position: 'bottom' }
                        }
                    }]
                });
                
                this.charts.project.render();
            },
            
            renderMessagesChart(type = null) {
                const el = document.querySelector('#monthly-messages-chart');
                if (!el) return;
                
                if (this.charts.messages) {
                    this.charts.messages.destroy();
                }
                
                const chartType = type || @json($chartType);
                const data = @json($monthlyMessagesChart);
                
                const options = {
                    series: data.series,
                    chart: { 
                        type: chartType, 
                        height: 300, 
                        toolbar: { show: false } 
                    },
                    dataLabels: { enabled: false },
                    stroke: { curve: 'smooth', width: 3 },
                    xaxis: { categories: data.categories },
                    colors: ['#0d6efd'],
                };
                
                if (chartType === 'area') {
                    options.fill = {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.1,
                        }
                    };
                }
                
                this.charts.messages = new ApexCharts(el, options);
                this.charts.messages.render();
            },
            
            renderServicesChart() {
                const el = document.querySelector('#services-chart');
                if (!el) return;
                
                if (this.charts.services) {
                    this.charts.services.destroy();
                }
                
                const data = @json($servicesChart);
                
                this.charts.services = new ApexCharts(el, {
                    series: data.series,
                    chart: { type: 'bar', height: 350, toolbar: { show: false } },
                    plotOptions: { bar: { borderRadius: 4, horizontal: false } },
                    dataLabels: { enabled: false },
                    xaxis: { categories: data.categories },
                    colors: ['#20c997'],
                    fill: { opacity: 0.8 }
                });
                
                this.charts.services.render();
            },
            
            renderBlogChart() {
                const el = document.querySelector('#blog-categories-chart');
                if (!el) return;
                
                if (this.charts.blog) {
                    this.charts.blog.destroy();
                }
                
                const data = @json($blogCategoriesChart);
                
                this.charts.blog = new ApexCharts(el, {
                    series: data.series,
                    chart: { type: 'polarArea', height: 350 },
                    labels: data.labels,
                    stroke: { colors: ['#fff'] },
                    fill: { opacity: 0.8 },
                    legend: { position: 'bottom' },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: { height: 300 },
                            legend: { position: 'bottom' }
                        }
                    }]
                });
                
                this.charts.blog.render();
            }
        }
    }
</script>
@endpush