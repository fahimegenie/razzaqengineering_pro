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
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
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
            
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="text-center py-5" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'proj-loading-state'; ?>wire:key="proj-loading-state">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-2">Loading projects...</p>
                </div>
            <?php elseif($errorMessage): ?>
                <div class="alert alert-danger text-center rounded-3 shadow-sm border-0" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'proj-error-state'; ?>wire:key="proj-error-state">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e($errorMessage); ?>

                </div>
            <?php else: ?>
                <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'proj-main-content'; ?>wire:key="proj-main-content">
                    
                    
                    <div class="proj-filters" data-aos="fade-up" wire:ignore.self>
                        <div class="row g-3 align-items-end mb-5">
                            
                            
                            <div class="col-lg-4">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Search Projects</label>
                                <div class="position-relative">
                                    <i class="fas fa-search position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
                                    <input type="text" class="form-control ps-5 py-3 rounded-3 border-2"
                                           wire:model.live.debounce.300ms="search" placeholder="Search projects...">
                                </div>
                            </div>
                            
                            
                            <div class="col-lg-3">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Category</label>
                                <div class="position-relative city-search-dropdown" 
                                     x-data="{ open: false }" @click.outside="open = false">
                                    <button type="button" class="form-select py-3 rounded-3 border-2 text-start bg-white"
                                            @click="open = !open">
                                        <span><?php echo e($selectedCategoryName); ?></span>
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
                                            <button type="button" class="dropdown-item py-2 px-3 rounded-2 text-start w-100 <?php echo e($selectedCategory === 'all' ? 'bg-success text-white' : ''); ?>"
                                                    wire:click="selectCategory('all', 'All Projects')" @click="open = false">All Projects</button>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filteredCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                <button type="button" class="dropdown-item py-2 px-3 rounded-2 text-start w-100 <?php echo e($selectedCategory == $cat->pc_id ? 'bg-success text-white' : ''); ?>"
                                                        wire:click="selectCategory('<?php echo e($cat->pc_id); ?>', '<?php echo e($cat->pc_name); ?>')"
                                                        @click="open = false" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'cat-opt-'.e($cat->pc_id).''; ?>wire:key="cat-opt-<?php echo e($cat->pc_id); ?>"><?php echo e($cat->pc_name); ?></button>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filteredCategories->count() === 0): ?>
                                                <div class="text-muted text-center small py-2">No categories found</div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-lg-2">
                                <label class="form-label fw-semibold small text-uppercase text-muted">City</label>
                                <div class="position-relative city-search-dropdown" 
                                     x-data="{ open: false }" @click.outside="open = false">
                                    <button type="button" class="form-select py-3 rounded-3 border-2 text-start bg-white"
                                            @click="open = !open">
                                        <span><?php echo e($selectedCityName); ?></span>
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
                                            <button type="button" class="dropdown-item py-2 px-3 rounded-2 text-start w-100 <?php echo e($selectedCity === 'all' ? 'bg-success text-white' : ''); ?>"
                                                    wire:click="selectCity('all', 'All Cities')" @click="open = false">All Cities</button>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filteredCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                <button type="button" class="dropdown-item py-2 px-3 rounded-2 text-start w-100 <?php echo e($selectedCity == $city->id ? 'bg-success text-white' : ''); ?>"
                                                        wire:click="selectCity('<?php echo e($city->id); ?>', '<?php echo e($city->name); ?>')"
                                                        @click="open = false" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'city-opt-'.e($city->id).''; ?>wire:key="city-opt-<?php echo e($city->id); ?>"><?php echo e($city->name); ?></button>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filteredCities->count() === 0): ?>
                                                <div class="text-muted text-center small py-2">No cities found</div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                            <div class="col-lg-1 d-flex align-items-end">
                                <div class="w-100">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search || $selectedCategory !== 'all' || $selectedCity !== 'all' || $selectedStatus !== 'all'): ?>
                                        <button class="btn btn-outline-secondary btn-sm w-100 rounded-3 mb-1" wire:click="clearFilters">
                                            <i class="fas fa-redo"></i>
                                        </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <p class="text-muted small mb-0 text-center">
                                        <strong><?php echo e(count($projects)); ?></strong>/<?php echo e($totalCount); ?>

                                    </p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredProjects->count() > 0 && empty($search) && $selectedCategory === 'all' && $selectedCity === 'all' && $selectedStatus === 'all'): ?>
                        <div class="featured-projects mb-5" data-aos="fade-up" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'featured-projects-panel'; ?>wire:key="featured-projects-panel">
                            <h3 class="fw-bold mb-4"><i class="fas fa-star text-warning me-2"></i> Featured Projects</h3>
                            <div class="row g-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $featuredProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div class="col-lg-4 col-md-6" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'fp-card-'.e($fp->id).''; ?>wire:key="fp-card-<?php echo e($fp->id); ?>">
                                        <div class="project-card featured">
                                            <div class="project-card-img" wire:ignore>
                                                <img src="<?php echo e(asset('p_image/'.$fp->p_image)); ?>" alt="<?php echo e($fp->p_title); ?>" class="img-fluid" loading="lazy">
                                                <span class="featured-tag">Featured</span>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fp->p_status): ?>
                                                    <span class="status-tag status-<?php echo e($fp->p_status); ?>"><?php echo e(ucfirst($fp->p_status)); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                            <div class="project-card-body">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fp->category): ?>
                                                    <span class="project-category"><?php echo e($fp->category->pc_name); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <h4><a href="<?php echo e(route('project.detail', ['slug' => $fp->p_title] )); ?>"><?php echo e($fp->p_title); ?></a></h4>
                                                <p><?php echo e(Str::limit($fp->p_short_description ?? $fp->p_description, 100)); ?></p>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fp->p_location): ?>
                                                    <div class="project-location"><i class="fas fa-map-marker-alt text-danger me-1"></i> <?php echo e($fp->p_location); ?></div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                    
                    <div class="all-projects" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'all-projects-panel-'.e($selectedCategory).'-'.e($selectedCity).'-'.e($selectedStatus).'-'.e(md5($search)).''; ?>wire:key="all-projects-panel-<?php echo e($selectedCategory); ?>-<?php echo e($selectedCity); ?>-<?php echo e($selectedStatus); ?>-<?php echo e(md5($search)); ?>">
                        <h3 class="fw-bold mb-4" data-aos="fade-up">
                            <i class="fas fa-folder-open text-success me-2"></i> 
                            <?php echo e($selectedCategory !== 'all' ? $selectedCategoryName : 'All Projects'); ?>

                            <?php echo e($selectedCity !== 'all' ? 'in ' . $selectedCityName : ''); ?>

                            <?php echo e($selectedStatus !== 'all' ? '- ' . ucfirst($selectedStatus) : ''); ?>

                        </h3>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($projects) > 0): ?>
                            <div class="row g-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index % 3 * 100); ?>" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'proj-card-'.e($project->id).''; ?>wire:key="proj-card-<?php echo e($project->id); ?>">
                                        <div class="project-card">
                                            <div class="project-card-img" wire:ignore>
                                                <img src="<?php echo e(asset('p_image/'.$project->p_image)); ?>" alt="<?php echo e($project->p_title); ?>" class="img-fluid" loading="lazy">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_status): ?>
                                                    <span class="status-tag status-<?php echo e($project->p_status); ?>"><?php echo e(ucfirst($project->p_status)); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                            <div class="project-card-body">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->category): ?>
                                                    <span class="project-category"><?php echo e($project->category->pc_name); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <h4><a href="<?php echo e(route('project.detail', ['slug' => $project->p_title])); ?>"><?php echo e($project->p_title); ?></a></h4>
                                                <p><?php echo e(Str::limit($project->p_short_description ?? $project->p_description, 100)); ?></p>
                                                <div class="project-meta">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_location): ?>
                                                        <span><i class="fas fa-map-marker-alt text-danger me-1"></i> <?php echo e($project->p_location); ?></span>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_client): ?>
                                                        <span><i class="fas fa-user text-primary me-1"></i> <?php echo e($project->p_client); ?></span>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                                <div class="project-card-footer">
                                                    <a href="<?php echo e(route('project.detail', ['slug' => $project->p_title])); ?>" class="proj-link">View Details <i class="fas fa-arrow-right ms-1"></i></a>
                                                    <span class="proj-date"><i class="far fa-calendar-alt me-1"></i> <?php echo e($project->p_start_date ? $project->p_start_date->format('M Y') : 'N/A'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                            
                            
                            <div x-ref="loadMoreSentinel" class="text-center py-4" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'sentinel-wrapper'; ?>wire:key="sentinel-wrapper">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasMore): ?>
                                    <div wire:loading wire:target="loadMore" class="spinner-border text-success"></div>
                                    <button wire:click="loadMore" wire:loading.remove class="btn btn-outline-success rounded-pill px-5 py-2 fw-semibold mt-3">
                                        Load More Projects <i class="fas fa-chevron-down ms-2"></i>
                                    </button>
                                <?php else: ?>
                                    <p class="text-muted">All <?php echo e($totalCount); ?> projects loaded</p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            
                        <?php else: ?>
                            <div class="text-center py-5" data-aos="fade-up" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'no-projects-found'; ?>wire:key="no-projects-found">
                                <i class="fas fa-folder-open fa-3x text-muted opacity-25 mb-3"></i>
                                <h5 class="fw-bold">No Projects Found</h5>
                                <p class="text-muted">Try different search terms or adjust filters.</p>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

</div>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/projects-page.blade.php ENDPATH**/ ?>