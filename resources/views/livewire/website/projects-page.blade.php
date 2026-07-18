<div class="projects-page-wrapper"
     x-data="{
        observer: null,
        init() {
            this.$nextTick(() => { this.setupObserver(); });
            this.$watch('$wire.projects', () => {
                if (typeof AOS !== 'undefined') setTimeout(() => AOS.refresh(), 200);
            });
        },
        setupObserver() {
            if (this.observer) this.observer.disconnect();
            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && $wire.hasMore) $wire.loadMore();
                });
            }, { threshold: 0.1 });
            const sentinel = this.$refs.loadMoreSentinel;
            if (sentinel) this.observer.observe(sentinel);
        }
     }">
    
    <!-- HERO -->
    <section class="proj-hero" wire:ignore>
        <div class="container proj-hero-content">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="proj-breadcrumb">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Projects</li>
                        </ol>
                    </nav>
                    <h1 class="proj-hero-title">Our Projects</h1>
                    <p class="proj-hero-subtitle">Showcasing our engineering excellence across Pakistan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="proj-section">
        <div class="container">
            
            {{-- Loading --}}
            @if($isLoading)
                <div class="text-center py-5" wire:key="proj-loading-state">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-2">Loading projects...</p>
                </div>
            @elseif($errorMessage)
                <div class="alert alert-danger text-center rounded-3 shadow-sm border-0" wire:key="proj-error-state">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ $errorMessage }}
                </div>
            @else
                <div wire:key="proj-main-content">
                    
                    {{-- Filters --}}
                    <div class="proj-filters" data-aos="fade-up" wire:ignore.self>
                        <div class="row g-3 align-items-end mb-5">
                            
                            {{-- Search --}}
                            <div class="col-lg-4">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Search Projects</label>
                                <div class="position-relative">
                                    <i class="fas fa-search position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
                                    <input type="text" class="form-control ps-5 py-3 rounded-3 border-2"
                                           wire:model.live.debounce.300ms="search" placeholder="Search projects...">
                                </div>
                            </div>
                            
                            {{-- Category Dropdown --}}
                            <div class="col-lg-3">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Category</label>
                                <div class="position-relative city-search-dropdown" 
                                     x-data="{ open: false }" @click.outside="open = false">
                                    <button type="button" class="form-select py-3 rounded-3 border-2 text-start bg-white"
                                            @click="open = !open">
                                        <span>{{ $selectedCategoryName }}</span>
                                    </button>
                                    <div class="position-absolute w-100 bg-white border border-2 rounded-3 mt-1 shadow-lg p-2" 
                                         x-show="open" x-transition>
                                        <div class="position-relative mb-2">
                                            <i class="fas fa-search position-absolute top-50 translate-middle-y ms-2 text-muted small"></i>
                                            <input type="text" class="form-control form-control-sm ps-4 py-2 border-1" 
                                                   placeholder="Search category..."
                                                   wire:model.live.debounce.150ms="categorySearch"
                                                   @keydown.escape="open = false">
                                        </div>
                                        <div class="overflow-y-auto" style="max-height:200px;">
                                            <button type="button" class="dropdown-item py-2 px-3 rounded-2 text-start w-100 {{ $selectedCategory === 'all' ? 'bg-success text-white' : '' }}"
                                                    wire:click="selectCategory('all', 'All Projects')" @click="open = false">All Projects</button>
                                            @foreach($filteredCategories as $cat)
                                                <button type="button" class="dropdown-item py-2 px-3 rounded-2 text-start w-100 {{ $selectedCategory == $cat->pc_id ? 'bg-success text-white' : '' }}"
                                                        wire:click="selectCategory('{{ $cat->pc_id }}', '{{ $cat->pc_name }}')"
                                                        @click="open = false" wire:key="cat-opt-{{ $cat->pc_id }}">{{ $cat->pc_name }}</button>
                                            @endforeach
                                            @if($filteredCategories->count() === 0)
                                                <div class="text-muted text-center small py-2">No categories found</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- City Dropdown --}}
                            <div class="col-lg-2">
                                <label class="form-label fw-semibold small text-uppercase text-muted">City</label>
                                <div class="position-relative city-search-dropdown" 
                                     x-data="{ open: false }" @click.outside="open = false">
                                    <button type="button" class="form-select py-3 rounded-3 border-2 text-start bg-white"
                                            @click="open = !open">
                                        <span>{{ $selectedCityName }}</span>
                                    </button>
                                    <div class="position-absolute w-100 bg-white border border-2 rounded-3 mt-1 shadow-lg p-2" 
                                         x-show="open" x-transition>
                                        <div class="position-relative mb-2">
                                            <i class="fas fa-search position-absolute top-50 translate-middle-y ms-2 text-muted small"></i>
                                            <input type="text" class="form-control form-control-sm ps-4 py-2 border-1" 
                                                   placeholder="Search city..."
                                                   wire:model.live.debounce.150ms="citySearch"
                                                   @keydown.escape="open = false">
                                        </div>
                                        <div class="overflow-y-auto" style="max-height:200px;">
                                            <button type="button" class="dropdown-item py-2 px-3 rounded-2 text-start w-100 {{ $selectedCity === 'all' ? 'bg-success text-white' : '' }}"
                                                    wire:click="selectCity('all', 'All Cities')" @click="open = false">All Cities</button>
                                            @foreach($filteredCities as $city)
                                                <button type="button" class="dropdown-item py-2 px-3 rounded-2 text-start w-100 {{ $selectedCity == $city->id ? 'bg-success text-white' : '' }}"
                                                        wire:click="selectCity('{{ $city->id }}', '{{ $city->name }}')"
                                                        @click="open = false" wire:key="city-opt-{{ $city->id }}">{{ $city->name }}</button>
                                            @endforeach
                                            @if($filteredCities->count() === 0)
                                                <div class="text-muted text-center small py-2">No cities found</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Status Filter --}}
                            {{-- <div class="col-lg-2">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Status</label>
                                <select class="form-select py-3 rounded-3 border-2" wire:model.live="selectedStatus">
                                    @foreach($statusOptions as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            
                            {{-- Count + Clear --}}
                            <div class="col-lg-1 d-flex align-items-end">
                                <div class="w-100">
                                    @if($search || $selectedCategory !== 'all' || $selectedCity !== 'all' || $selectedStatus !== 'all')
                                        <button class="btn btn-outline-secondary btn-sm w-100 rounded-3 mb-1" wire:click="clearFilters">
                                            <i class="fas fa-redo"></i>
                                        </button>
                                    @endif
                                    <p class="text-muted small mb-0 text-center">
                                        <strong>{{ count($projects) }}</strong>/{{ $totalCount }}
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    {{-- Featured Projects --}}
                    @if($featuredProjects->count() > 0 && empty($search) && $selectedCategory === 'all' && $selectedCity === 'all' && $selectedStatus === 'all')
                        <div class="featured-projects mb-5" data-aos="fade-up" wire:key="featured-projects-panel">
                            <h3 class="fw-bold mb-4"><i class="fas fa-star text-warning me-2"></i> Featured Projects</h3>
                            <div class="row g-4">
                                @foreach($featuredProjects as $fp)
                                    <div class="col-lg-4 col-md-6" wire:key="fp-card-{{ $fp->id }}">
                                        <div class="project-card featured">
                                            <div class="project-card-img" wire:ignore>
                                                <img src="{{ asset('p_image/'.$fp->p_image) }}" alt="{{ $fp->p_title }}" class="img-fluid" loading="lazy">
                                                <span class="featured-tag">Featured</span>
                                                @if($fp->p_status)
                                                    <span class="status-tag status-{{ $fp->p_status }}">{{ ucfirst($fp->p_status) }}</span>
                                                @endif
                                            </div>
                                            <div class="project-card-body">
                                                @if($fp->category)
                                                    <span class="project-category">{{ $fp->category->pc_name }}</span>
                                                @endif
                                                <h4><a href="{{ route('project.detail', ['slug' => $fp->p_title] ) }}">{{ $fp->p_title }}</a></h4>
                                                <p>{{ Str::limit($fp->p_short_description ?? $fp->p_description, 100) }}</p>
                                                @if($fp->p_location)
                                                    <div class="project-location"><i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $fp->p_location }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    {{-- All Projects Grid --}}
                    <div class="all-projects" wire:key="all-projects-panel-{{ $selectedCategory }}-{{ $selectedCity }}-{{ $selectedStatus }}-{{ md5($search) }}">
                        <h3 class="fw-bold mb-4" data-aos="fade-up">
                            <i class="fas fa-folder-open text-success me-2"></i> 
                            {{ $selectedCategory !== 'all' ? $selectedCategoryName : 'All Projects' }}
                            {{ $selectedCity !== 'all' ? 'in ' . $selectedCityName : '' }}
                            {{ $selectedStatus !== 'all' ? '- ' . ucfirst($selectedStatus) : '' }}
                        </h3>
                        
                        @if(count($projects) > 0)
                            <div class="row g-4">
                                @foreach($projects as $project)
                                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index % 3 * 100 }}" wire:key="proj-card-{{ $project->id }}">
                                        <div class="project-card">
                                            <div class="project-card-img" wire:ignore>
                                                <img src="{{ $project->image_url }}" alt="{{ $project->p_title }}" class="img-fluid" loading="lazy">
                                                @if($project->p_status)
                                                    <span class="status-tag status-{{ $project->p_status }}">{{ ucfirst($project->p_status) }}</span>
                                                @endif
                                            </div>
                                            <div class="project-card-body">
                                                @if($project->category)
                                                    <span class="project-category">{{ $project->category->pc_name }}</span>
                                                @endif
                                                <h4><a href="{{ route('project.detail', ['slug' => $project->p_title]) }}">{{ $project->p_title }}</a></h4>
                                                <p>{{ Str::limit($project->p_short_description ?? $project->p_description, 100) }}</p>
                                                <div class="project-meta">
                                                    @if($project->p_location)
                                                        <span><i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $project->p_location }}</span>
                                                    @endif
                                                    @if($project->p_client)
                                                        <span><i class="fas fa-user text-primary me-1"></i> {{ $project->p_client }}</span>
                                                    @endif
                                                </div>
                                                <div class="project-card-footer">
                                                    <a href="{{ route('project.detail', ['slug' => $project->p_title]) }}" class="proj-link">View Details <i class="fas fa-arrow-right ms-1"></i></a>
                                                    <span class="proj-date"><i class="far fa-calendar-alt me-1"></i> {{ $project->p_start_date ? $project->p_start_date->format('M Y') : 'N/A' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            {{-- Load More --}}
                            <div x-ref="loadMoreSentinel" class="text-center py-4" wire:key="sentinel-wrapper">
                                @if($hasMore)
                                    <div wire:loading wire:target="loadMore" class="spinner-border text-success"></div>
                                    <button wire:click="loadMore" wire:loading.remove class="btn btn-outline-success rounded-pill px-5 py-2 fw-semibold mt-3">
                                        Load More Projects <i class="fas fa-chevron-down ms-2"></i>
                                    </button>
                                @else
                                    <p class="text-muted">All {{ $totalCount }} projects loaded</p>
                                @endif
                            </div>
                            
                        @else
                            <div class="text-center py-5" data-aos="fade-up" wire:key="no-projects-found">
                                <i class="fas fa-folder-open fa-3x text-muted opacity-25 mb-3"></i>
                                <h5 class="fw-bold">No Projects Found</h5>
                                <p class="text-muted">Try different search terms or adjust filters.</p>
                            </div>
                        @endif
                        
                    </div>
                </div>
            @endif
        </div>
    </section>

</div>

@push('styles')
<style>
    .proj-hero { background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%); min-height: 250px; display: flex; align-items: center; }
    .proj-hero-content { width: 100%; }
    .proj-breadcrumb { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 10px; }
    .proj-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .proj-breadcrumb li a { color: #fff; text-decoration: none; }
    .proj-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .proj-hero-title { color: #fff; font-size: 2.5rem; font-weight: 800; }
    .proj-hero-subtitle { color: rgba(255,255,255,0.8); font-size: 1rem; }
    .proj-section { padding: 60px 0; background: #fff; }
    .proj-dropdown { position: relative; z-index: 9999; }

    /* Project Card */
    .project-card {
        background: #fff; border-radius: 14px; overflow: hidden;
        box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
        transition: all 0.3s; height: 100%; display: flex; flex-direction: column;
    }
    .project-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
    .project-card-img { position: relative; height: 220px; overflow: hidden; background: #f0f4f8; }
    .project-card-img img { width: 100%; height: 100%; object-fit: cover; }
    .featured-tag { position: absolute; top: 10px; left: 10px; background: linear-gradient(135deg, #ffc107, #ff9800); color: #000; padding: 4px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; }
    .status-tag { position: absolute; top: 10px; right: 10px; padding: 4px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 600; color: #fff; }
    .status-completed { background: #28a745; }
    .status-ongoing { background: #0056b3; }
    .status-planning { background: #ffc107; color: #000; }
    .status-on-hold { background: #6c757d; }
    .project-card-body { padding: 18px; flex: 1; display: flex; flex-direction: column; }
    .project-category { display: inline-block; font-size: 0.68rem; font-weight: 600; color: #0056b3; background: rgba(0,86,179,0.08); padding: 3px 10px; border-radius: 4px; margin-bottom: 8px; }
    .project-card-body h4 { font-size: 1rem; font-weight: 700; margin-bottom: 6px; }
    .project-card-body h4 a { color: #0a1628; text-decoration: none; }
    .project-card-body h4 a:hover { color: #0056b3; }
    .project-card-body p { font-size: 0.84rem; color: #888; line-height: 1.5; margin-bottom: 10px; flex: 1; }
    .project-meta { display: flex; flex-wrap: wrap; gap: 10px; font-size: 0.78rem; color: #888; margin-bottom: 10px; }
    .project-card-footer { display: flex; justify-content: space-between; align-items: center; padding-top: 10px; border-top: 1px solid #f0f0f0; }
    .proj-link { font-size: 0.82rem; font-weight: 600; color: #0056b3; text-decoration: none; }
    .proj-link:hover { color: #28a745; }
    .proj-date { font-size: 0.78rem; color: #aaa; }

    @media (max-width: 767px) {
        .proj-hero { min-height: 180px; }
        .proj-hero-title { font-size: 1.6rem; }
        .proj-section { padding: 40px 0; }
        .project-card-img { height: 180px; }
    }
</style>
@endpush