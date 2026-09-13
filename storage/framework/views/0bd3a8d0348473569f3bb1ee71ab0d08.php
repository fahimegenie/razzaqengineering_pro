<div class="projects-page-wrapper"
     x-data="{
        init() {
            this.$watch('$wire.projects', () => {
                if (typeof AOS !== 'undefined') setTimeout(() => AOS.refresh(), 200);
            });
        }
     }">
    
    
    <section class="pp-hero">
        <div class="pp-hero-bg"></div>
        <div class="pp-hero-overlay"></div>
        <div class="container pp-hero-container">
            <div class="row align-items-center min-vh-30">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="pp-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Projects</li>
                        </ol>
                    </nav>
                    <div class="pp-hero-badge">
                        <i class="fas fa-hard-hat"></i> Our Portfolio
                    </div>
                    <h1 class="pp-hero-title">Engineering Excellence<br>In Every Project</h1>
                    <p class="pp-hero-subtitle">Explore our completed and ongoing projects across Pakistan — from precision concrete cutting to large-scale firefighting installations.</p>
                    <div class="pp-hero-stats">
                        <div class="pp-stat-item">
                            <span class="pp-stat-number"><?php echo e($totalCount); ?>+</span>
                            <span class="pp-stat-label">Projects</span>
                        </div>
                        <div class="pp-stat-item">
                            <span class="pp-stat-number">20+</span>
                            <span class="pp-stat-label">Cities</span>
                        </div>
                        <div class="pp-stat-item">
                            <span class="pp-stat-number">100%</span>
                            <span class="pp-stat-label">Client Satisfaction</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-block text-center" data-aos="fade-left">
                    <div class="pp-hero-image-wrapper">
                        <div class="pp-hero-image-frame">
                            <img src="<?php echo e($featuredProjects->first() ? asset($featuredProjects->first()->p_image) : asset('images/project-hero.jpg')); ?>" 
                                 alt="Featured Project" 
                                 class="pp-hero-img"
                                 loading="eager">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="pp-filters-section">
        <div class="container">
            <div class="pp-filters-card" data-aos="fade-up">
                <div class="row g-3 align-items-end">
                    
                    <div class="col-lg-4">
                        <label class="pp-filter-label"><i class="fas fa-search me-1"></i> Search</label>
                        <div class="pp-input-wrapper">
                            <i class="fas fa-search pp-input-icon"></i>
                            <input type="text" 
                                   class="pp-form-input" 
                                   placeholder="Search by project name, location, client..."
                                   wire:model.live.debounce.300ms="search">
                        </div>
                    </div>
                    
                    
                    <div class="col-lg-3" x-data="{ open: false }" @click.outside="open = false">
                        <label class="pp-filter-label"><i class="fas fa-th-large me-1"></i> Category</label>
                        <div class="pp-input-wrapper pp-dropdown-wrapper">
                            <button type="button" class="pp-form-input pp-dropdown-toggle" @click="open = !open">
                                <span><?php echo e($selectedCategoryName); ?></span>
                                <i class="fas fa-chevron-down pp-chevron" :class="{ 'rotate': open }"></i>
                            </button>
                            <div class="pp-dropdown-menu" x-show="open" x-transition>
                                <div class="pp-dropdown-search">
                                    <i class="fas fa-search"></i>
                                    <input type="text" placeholder="Search category..." wire:model.live.debounce.150ms="categorySearch">
                                </div>
                                <div class="pp-dropdown-items">
                                    <button type="button" 
                                            class="pp-dropdown-item <?php echo e($selectedCategory === 'all' ? 'active' : ''); ?>"
                                            wire:click="selectCategory('all', 'All Categories')" 
                                            @click="open = false">
                                        <i class="fas fa-layer-group"></i> All Categories
                                    </button>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filteredCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <button type="button" 
                                                class="pp-dropdown-item <?php echo e($selectedCategory == $cat->pc_id ? 'active' : ''); ?>"
                                                wire:click="selectCategory('<?php echo e($cat->pc_id); ?>', '<?php echo e($cat->pc_name); ?>')"
                                                @click="open = false">
                                            <?php echo e($cat->pc_name); ?>

                                        </button>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-lg-3" x-data="{ open: false }" @click.outside="open = false">
                        <label class="pp-filter-label"><i class="fas fa-map-marker-alt me-1"></i> City</label>
                        <div class="pp-input-wrapper pp-dropdown-wrapper">
                            <button type="button" class="pp-form-input pp-dropdown-toggle" @click="open = !open">
                                <span><?php echo e($selectedCityName); ?></span>
                                <i class="fas fa-chevron-down pp-chevron" :class="{ 'rotate': open }"></i>
                            </button>
                            <div class="pp-dropdown-menu" x-show="open" x-transition>
                                <div class="pp-dropdown-search">
                                    <i class="fas fa-search"></i>
                                    <input type="text" placeholder="Search city..." wire:model.live.debounce.150ms="citySearch">
                                </div>
                                <div class="pp-dropdown-items">
                                    <button type="button" 
                                            class="pp-dropdown-item <?php echo e($selectedCity === 'all' ? 'active' : ''); ?>"
                                            wire:click="selectCity('all', 'All Cities')" 
                                            @click="open = false">
                                        <i class="fas fa-globe-asia"></i> All Cities
                                    </button>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filteredCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <button type="button" 
                                                class="pp-dropdown-item <?php echo e($selectedCity == $city->id ? 'active' : ''); ?>"
                                                wire:click="selectCity('<?php echo e($city->id); ?>', '<?php echo e($city->name); ?>')"
                                                @click="open = false">
                                            <?php echo e($city->name); ?>

                                        </button>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-lg-2 d-flex align-items-end">
                        <div class="d-flex align-items-center gap-2 w-100">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search || $selectedCategory !== 'all' || $selectedCity !== 'all' || $selectedStatus !== 'all'): ?>
                                <button class="pp-btn-clear" wire:click="clearFilters" title="Clear all filters">
                                    <i class="fas fa-times"></i>
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <span class="pp-count-badge">
                                <strong><?php echo e($totalCount); ?></strong> projects
                            </span>
                        </div>
                    </div>
                </div>
                
                
                <div class="pp-status-pills">
                    <button class="pp-status-pill <?php echo e($selectedStatus === 'all' ? 'active' : ''); ?>" 
                            wire:click="filterByStatus('all')">All</button>
                    <button class="pp-status-pill <?php echo e($selectedStatus === 'completed' ? 'active' : ''); ?>" 
                            wire:click="filterByStatus('completed')">Completed</button>
                    <button class="pp-status-pill <?php echo e($selectedStatus === 'ongoing' ? 'active' : ''); ?>" 
                            wire:click="filterByStatus('ongoing')">Ongoing</button>
                    <button class="pp-status-pill <?php echo e($selectedStatus === 'planning' ? 'active' : ''); ?>" 
                            wire:click="filterByStatus('planning')">Planning</button>
                </div>
            </div>
        </div>
    </section>

    
    <section class="pp-content-section">
        <div class="container">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="pp-state-box">
                    <div class="spinner-grow text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-3 fw-semibold">Loading projects...</p>
                </div>
            
            <?php elseif($errorMessage): ?>
                <div class="pp-error-card">
                    <i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;"></i>
                    <h4 class="fw-bold mt-3">Oops! Something went wrong</h4>
                    <p class="text-muted"><?php echo e($errorMessage); ?></p>
                    <button class="btn btn-primary mt-3" wire:click="clearFilters">
                        <i class="fas fa-redo me-2"></i> Reset & Try Again
                    </button>
                </div>
            
            <?php else: ?>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredProjects->count() > 0 && empty($search) && $selectedCategory === 'all' && $selectedCity === 'all' && $selectedStatus === 'all'): ?>
                    <div class="pp-featured-section" data-aos="fade-up">
                        <div class="pp-section-header">
                            <span class="pp-section-badge"><i class="fas fa-star"></i> Featured</span>
                            <h2>Highlighted Projects</h2>
                            <p>Our most prestigious and technically challenging projects</p>
                        </div>
                        <div class="row g-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $featuredProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="col-lg-4 col-md-6" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'fp-'.e($fp->id).''; ?>wire:key="fp-<?php echo e($fp->id); ?>">
                                    <div class="pp-project-card featured" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 100); ?>">
                                        <div class="pp-card-image">
                                            <img src="<?php echo e(asset($fp->p_image)); ?>" 
                                                 alt="<?php echo e($fp->p_title); ?>" 
                                                 loading="lazy">
                                            <div class="pp-card-badges">
                                                <span class="pp-badge-featured"><i class="fas fa-star"></i> Featured</span>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fp->p_status): ?>
                                                    <span class="pp-badge-status status-<?php echo e($fp->p_status); ?>"><?php echo e(ucfirst($fp->p_status)); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                            <div class="pp-card-overlay">
                                                <a href="<?php echo e(route('project.detail', ['slug' => $fp->p_slug])); ?>" class="pp-overlay-btn">
                                                    <i class="fas fa-eye me-1"></i> View Details
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pp-card-body">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fp->category): ?>
                                                <span class="pp-card-category"><?php echo e($fp->category->pc_name); ?></span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <h3>
                                                <a href="<?php echo e(route('project.detail', ['slug' => $fp->p_slug])); ?>"><?php echo e($fp->p_title); ?></a>
                                            </h3>
                                            <p><?php echo e(Str::limit($fp->p_short_description ?? $fp->p_description, 90)); ?></p>
                                            <div class="pp-card-meta">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fp->p_location): ?>
                                                    <span><i class="fas fa-map-marker-alt"></i> <?php echo e($fp->p_location); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <span><i class="far fa-calendar-alt"></i> <?php echo e($fp->p_start_date ? $fp->p_start_date->format('M Y') : 'N/A'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalCount > 0): ?>
                        <div class="pp-divider">
                            <span>All Projects</span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalCount > 0): ?>
                    <div class="pp-all-projects" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'projects-'.e($selectedCategory).'-'.e($selectedCity).'-'.e($selectedStatus).'-'.e(md5($search)).''; ?>wire:key="projects-<?php echo e($selectedCategory); ?>-<?php echo e($selectedCity); ?>-<?php echo e($selectedStatus); ?>-<?php echo e(md5($search)); ?>">
                        <div class="row g-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="col-lg-4 col-md-6" 
                                     data-aos="fade-up" 
                                     data-aos-delay="<?php echo e(($loop->index % 3) * 80); ?>" 
                                     <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'proj-'.e($project->id).''; ?>wire:key="proj-<?php echo e($project->id); ?>">
                                    <div class="pp-project-card">
                                        <div class="pp-card-image">
                                            <img src="<?php echo e($project->image_url); ?>" 
                                                 alt="<?php echo e($project->p_title); ?>" 
                                                 loading="lazy">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_status): ?>
                                                <div class="pp-card-badges">
                                                    <span class="pp-badge-status status-<?php echo e($project->p_status); ?>"><?php echo e(ucfirst($project->p_status)); ?></span>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <div class="pp-card-overlay">
                                                <a <?php if(!empty($project->p_slug)): ?> href="<?php echo e(route('project.detail', ['slug' => $project->p_slug])); ?>" <?php else: ?> href="#" <?php endif; ?>  class="pp-overlay-btn">
                                                    <i class="fas fa-eye me-1"></i> View Details
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pp-card-body">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->category): ?>
                                                <span class="pp-card-category"><?php echo e($project->category->pc_name); ?></span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <h3>
                                                <a <?php if(!empty($project->p_slug)): ?> href="<?php echo e(route('project.detail', ['slug' => $project->p_slug])); ?>" <?php else: ?> href="#" <?php endif; ?> ><?php echo e($project->p_title); ?></a>
                                            </h3>
                                            <p><?php echo e(Str::limit($project->p_short_description ?? $project->p_description, 90)); ?></p>
                                            <div class="pp-card-meta">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_location): ?>
                                                    <span><i class="fas fa-map-marker-alt"></i> <?php echo e($project->p_location); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->p_client): ?>
                                                    <span><i class="fas fa-building"></i> <?php echo e($project->p_client); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        
                        
                        <div class="pp-load-more" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'load-more-'.e($loadedCount).''; ?>wire:key="load-more-<?php echo e($loadedCount); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasMore): ?>
                                <button wire:click="loadMore" 
                                        wire:loading.attr="disabled"
                                        class="pp-load-btn">
                                    <span wire:loading.remove>Load More Projects</span>
                                    <span wire:loading>
                                        <span class="spinner-border spinner-border-sm me-2"></span> Loading...
                                    </span>
                                    <i class="fas fa-chevron-down ms-2" wire:loading.remove></i>
                                </button>
                                <p class="pp-load-info">Showing <?php echo e(count($projects)); ?> of <?php echo e($totalCount); ?> projects</p>
                            <?php else: ?>
                                <div class="pp-all-loaded">
                                    <i class="fas fa-check-circle"></i>
                                    <span>All <?php echo e($totalCount); ?> projects loaded</span>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="pp-empty-state" data-aos="fade-up">
                        <div class="pp-empty-icon">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <h3>No Projects Found</h3>
                        <p>Try adjusting your search terms or filters to find what you're looking for.</p>
                        <button class="btn btn-outline-primary mt-3" wire:click="clearFilters">
                            <i class="fas fa-redo me-2"></i> Clear All Filters
                        </button>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>
    
    
    <section class="pp-cta-section">
        <div class="container">
            <div class="pp-cta-card" data-aos="zoom-in">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h3>Have a Similar Project in Mind?</h3>
                        <p>Let's discuss your requirements and bring your vision to life with our engineering expertise.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                        <a href="<?php echo e(route('quote.index')); ?>" class="pp-cta-btn">
                            <i class="fas fa-paper-plane me-2"></i> Get Free Consultation
                        </a>
                        <a href="tel:+923048902805" class="pp-cta-btn-outline mt-2 mt-lg-0 ms-lg-2">
                            <i class="fas fa-phone-alt me-2"></i> Call Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


<style>
/* ============================================
   PROJECTS PAGE - PREMIUM ENTERPRISE DESIGN
   Laravel 13 + Livewire 4 Compatible
   ============================================ */

/* --- Hero Section --- */
.pp-hero {
    position: relative; padding: 100px 0 80px; overflow: hidden;
    min-height: 550px; display: flex; align-items: center;
}

.pp-hero-bg {
    position: absolute; inset: 0;
    background: url('<?php echo e(asset("images/construction-hero.jpg")); ?>') center/cover no-repeat;
    filter: brightness(0.3);
}

.pp-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,61,128,0.9) 0%, rgba(26,92,42,0.85) 100%);
}

.pp-hero-container { position: relative; z-index: 2; }

.pp-breadcrumb {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px;
    font-size: 0.85rem; color: rgba(255,255,255,0.7);
}

.pp-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.pp-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.pp-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.pp-breadcrumb a:hover { color: #fff; }

.pp-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
    color: #fff; padding: 8px 18px; border-radius: 50px;
    font-size: 0.85rem; font-weight: 600; margin-bottom: 20px;
}

.pp-hero-title {
    color: #fff; font-size: clamp(2.2rem, 5vw, 3.5rem); font-weight: 800;
    line-height: 1.15; margin: 0 0 15px;
}

.pp-hero-subtitle {
    color: rgba(255,255,255,0.85); font-size: 1.1rem; max-width: 550px;
    line-height: 1.7; margin: 0 0 30px;
}

.pp-hero-stats { display: flex; gap: 30px; flex-wrap: wrap; }
.pp-stat-item { text-align: center; }
.pp-stat-number { display: block; font-size: 2rem; font-weight: 800; color: #28a745; }
.pp-stat-label { font-size: 0.8rem; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 1px; }

.pp-hero-image-wrapper { perspective: 1000px; }
.pp-hero-image-frame {
    border-radius: 16px; overflow: hidden; box-shadow: 0 25px 60px rgba(0,0,0,0.4);
    border: 4px solid rgba(255,255,255,0.2); transform: rotateY(-5deg);
    transition: transform 0.5s ease;
}

.pp-hero-image-frame:hover { transform: rotateY(0deg); }
.pp-hero-img { width: 100%; height: 300px; object-fit: cover; display: block; }

/* --- Filters Section --- */
.pp-filters-section { margin-top: -40px; position: relative; z-index: 10; }

.pp-filters-card {
    background: #fff; border-radius: 16px; padding: 25px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08); border: 1px solid #eef0f2;
}

.pp-filter-label {
    font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 1.5px; color: #888; margin-bottom: 6px; display: block;
}

.pp-input-wrapper { position: relative; }

.pp-form-input {
    width: 100%; padding: 12px 16px 12px 40px; border: 2px solid #e9ecef;
    border-radius: 10px; font-size: 0.88rem; color: #333; background: #fff;
    transition: all 0.3s ease; outline: none;
}

.pp-form-input:focus { border-color: #28a745; box-shadow: 0 0 0 3px rgba(40,167,69,0.1); }

.pp-input-icon {
    position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
    color: #aaa; font-size: 0.9rem; z-index: 1; pointer-events: none;
}

.pp-dropdown-wrapper { position: relative; }

.pp-dropdown-toggle {
    display: flex; align-items: center; justify-content: space-between;
    cursor: pointer; text-align: left; padding-left: 16px !important;
}

.pp-chevron { transition: transform 0.3s; font-size: 0.75rem; color: #888; }
.pp-chevron.rotate { transform: rotate(180deg); }

.pp-dropdown-menu {
    position: absolute; top: calc(100% + 5px); left: 0; right: 0;
    background: #fff; border: 2px solid #e9ecef; border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1); z-index: 1000; overflow: hidden;
}

.pp-dropdown-search {
    position: relative; padding: 10px; border-bottom: 1px solid #f0f0f0;
}

.pp-dropdown-search i {
    position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #aaa;
}

.pp-dropdown-search input {
    width: 100%; padding: 8px 12px 8px 35px; border: 1px solid #e9ecef;
    border-radius: 8px; font-size: 0.82rem; outline: none;
}

.pp-dropdown-items { max-height: 200px; overflow-y: auto; padding: 5px; }

.pp-dropdown-item {
    display: flex; align-items: center; gap: 8px; width: 100%;
    padding: 10px 12px; border: none; background: none; cursor: pointer;
    font-size: 0.85rem; color: #555; border-radius: 8px; transition: all 0.15s;
}

.pp-dropdown-item:hover { background: #f0faf3; color: #28a745; }
.pp-dropdown-item.active { background: #28a745; color: #fff; font-weight: 600; }

.pp-btn-clear {
    width: 40px; height: 40px; border-radius: 10px; border: 2px solid #e9ecef;
    background: #fff; color: #dc3545; cursor: pointer; display: flex;
    align-items: center; justify-content: center; transition: all 0.3s;
}

.pp-btn-clear:hover { background: #dc3545; color: #fff; border-color: #dc3545; }

.pp-count-badge {
    background: #f0faf3; color: #28a745; padding: 8px 14px; border-radius: 8px;
    font-size: 0.82rem; font-weight: 600;
}

.pp-status-pills {
    display: flex; gap: 8px; margin-top: 15px; padding-top: 15px;
    border-top: 1px solid #f0f0f0; flex-wrap: wrap;
}

.pp-status-pill {
    padding: 6px 16px; border-radius: 50px; font-size: 0.78rem; font-weight: 600;
    border: 2px solid #e9ecef; background: #fff; color: #666; cursor: pointer;
    transition: all 0.3s;
}

.pp-status-pill:hover { border-color: #28a745; color: #28a745; }
.pp-status-pill.active { background: #28a745; color: #fff; border-color: #28a745; }

/* --- Content Section --- */
.pp-content-section { padding: 50px 0 60px; background: #f8f9fa; }

.pp-section-header { text-align: center; margin-bottom: 35px; }

.pp-section-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,193,7,0.15); color: #f59e0b; padding: 6px 16px;
    border-radius: 50px; font-size: 0.78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px;
}

.pp-section-header h2 { font-size: 1.8rem; font-weight: 800; color: #0a1628; margin-bottom: 5px; }
.pp-section-header p { color: #888; }

.pp-divider {
    display: flex; align-items: center; gap: 15px; margin: 40px 0 30px;
}

.pp-divider::before, .pp-divider::after {
    content: ''; flex: 1; height: 1px; background: #ddd;
}

.pp-divider span {
    font-size: 0.85rem; font-weight: 700; color: #888; text-transform: uppercase;
    letter-spacing: 2px;
}

/* --- Project Card --- */
.pp-project-card {
    background: #fff; border-radius: 16px; overflow: hidden;
    box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); height: 100%;
    display: flex; flex-direction: column;
}

.pp-project-card:hover {
    transform: translateY(-8px); 
    box-shadow: 0 20px 50px rgba(0,0,0,0.12);
}

.pp-project-card.featured { border: 2px solid rgba(245,158,11,0.3); }

.pp-card-image {
    position: relative; height: 240px; overflow: hidden; background: #f0f4f8;
}

.pp-card-image img {
    width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;
}

.pp-project-card:hover .pp-card-image img { transform: scale(1.08); }

.pp-card-badges {
    position: absolute; top: 12px; left: 12px; right: 12px;
    display: flex; justify-content: space-between;
}

.pp-badge-featured {
    background: linear-gradient(135deg, #f59e0b, #d97706); color: #000;
    padding: 5px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700;
    display: flex; align-items: center; gap: 4px;
}

.pp-badge-status {
    padding: 5px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 600; color: #fff;
}

.status-completed { background: #28a745; }
.status-ongoing { background: #0056b3; }
.status-planning { background: #f59e0b; color: #000; }
.status-on-hold { background: #6c757d; }

.pp-card-overlay {
    position: absolute; inset: 0; background: rgba(0,0,0,0.5);
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.3s ease;
}

.pp-project-card:hover .pp-card-overlay { opacity: 1; }

.pp-overlay-btn {
    background: #28a745; color: #fff; padding: 10px 22px; border-radius: 50px;
    font-weight: 600; font-size: 0.85rem; text-decoration: none;
    transform: translateY(10px); transition: transform 0.3s ease;
}

.pp-project-card:hover .pp-overlay-btn { transform: translateY(0); }
.pp-overlay-btn:hover { background: #1e7e34; color: #fff; }

.pp-card-body {
    padding: 20px; flex: 1; display: flex; flex-direction: column;
}

.pp-card-category {
    display: inline-block; font-size: 0.7rem; font-weight: 600; color: #0056b3;
    background: rgba(0,86,179,0.08); padding: 4px 10px; border-radius: 4px;
    margin-bottom: 10px; width: fit-content;
}

.pp-card-body h3 { font-size: 1.05rem; font-weight: 700; margin: 0 0 8px; }
.pp-card-body h3 a { color: #0a1628; text-decoration: none; }
.pp-card-body h3 a:hover { color: #0056b3; }

.pp-card-body p { font-size: 0.85rem; color: #888; line-height: 1.6; margin-bottom: 12px; flex: 1; }

.pp-card-meta {
    display: flex; flex-wrap: wrap; gap: 12px; font-size: 0.78rem; color: #999;
    padding-top: 12px; border-top: 1px solid #f5f5f5;
}

.pp-card-meta span { display: flex; align-items: center; gap: 5px; }
.pp-card-meta i { color: #28a745; font-size: 0.85rem; }

/* --- Load More --- */
.pp-load-more { text-align: center; padding: 40px 0 20px; }

.pp-load-btn {
    background: #fff; color: #28a745; border: 2px solid #28a745;
    padding: 12px 30px; border-radius: 50px; font-weight: 700; font-size: 0.9rem;
    cursor: pointer; transition: all 0.3s ease;
}

.pp-load-btn:hover:not(:disabled) { background: #28a745; color: #fff; }
.pp-load-btn:disabled { opacity: 0.6; cursor: not-allowed; }

.pp-load-info { font-size: 0.82rem; color: #aaa; margin-top: 10px; }

.pp-all-loaded {
    display: inline-flex; align-items: center; gap: 8px; color: #28a745;
    font-weight: 600; font-size: 0.9rem;
}

.pp-all-loaded i { font-size: 1.2rem; }

/* --- CTA Section --- */
.pp-cta-section { padding: 0 0 60px; background: #f8f9fa; }

.pp-cta-card {
    background: linear-gradient(135deg, #003d80, #1a5c2a); border-radius: 20px;
    padding: 40px 35px; color: #fff; position: relative; overflow: hidden;
}

.pp-cta-card::before {
    content: ''; position: absolute; top: -30%; right: -10%;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.06) 0%, transparent 70%);
}

.pp-cta-card h3 { font-size: clamp(1.3rem, 2.5vw, 1.6rem); font-weight: 800; margin-bottom: 8px; position: relative; }
.pp-cta-card p { opacity: 0.9; margin: 0; position: relative; }

.pp-cta-btn {
    display: inline-flex; align-items: center; padding: 14px 28px;
    background: #28a745; color: #fff; border-radius: 10px; font-weight: 700;
    text-decoration: none; transition: all 0.3s ease; box-shadow: 0 6px 25px rgba(40,167,69,0.4);
}

.pp-cta-btn:hover { transform: translateY(-3px); box-shadow: 0 10px 35px rgba(40,167,69,0.6); color: #fff; }

.pp-cta-btn-outline {
    display: inline-flex; align-items: center; padding: 14px 28px;
    background: transparent; color: #fff; border: 2px solid rgba(255,255,255,0.5);
    border-radius: 10px; font-weight: 700; text-decoration: none; transition: all 0.3s ease;
}

.pp-cta-btn-outline:hover { background: #fff; color: #003d80; }

/* --- States --- */
.pp-state-box { text-align: center; padding: 60px 20px; }

.pp-error-card {
    max-width: 500px; margin: 40px auto; padding: 40px 30px; background: #fff;
    border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); text-align: center;
}

.pp-empty-state { text-align: center; padding: 60px 20px; }
.pp-empty-icon {
    width: 100px; height: 100px; margin: 0 auto 20px; background: rgba(40,167,69,0.08);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: 2.5rem; color: #28a745;
}

.pp-empty-state h3 { font-size: 1.3rem; font-weight: 700; color: #0a1628; }
.pp-empty-state p { color: #888; max-width: 400px; margin: 0 auto; }

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 1199.98px) {
    .pp-hero { padding: 80px 0 60px; min-height: auto; }
    .pp-card-image { height: 200px; }
}

@media (max-width: 991.98px) {
    .pp-hero { padding: 60px 0 50px; }
    .pp-hero-title { font-size: 1.8rem; }
    .pp-filters-section { margin-top: -20px; }
    .pp-filters-card { padding: 20px; border-radius: 14px; }
}

@media (max-width: 767.98px) {
    .pp-hero { padding: 45px 0 40px; }
    .pp-hero-title { font-size: 1.5rem; }
    .pp-hero-subtitle { font-size: 0.9rem; }
    .pp-hero-stats { gap: 15px; }
    .pp-stat-number { font-size: 1.5rem; }
    .pp-card-image { height: 180px; }
    .pp-cta-card { text-align: center; padding: 30px 20px; }
    .pp-cta-btn, .pp-cta-btn-outline { display: block; text-align: center; margin: 8px 0; }
}

@media (max-width: 575.98px) {
    .pp-hero { padding: 35px 0; }
    .pp-hero-title { font-size: 1.3rem; }
    .pp-hero-badge { font-size: 0.75rem; padding: 6px 14px; }
    .pp-breadcrumb { font-size: 0.75rem; }
    .pp-filters-section { margin-top: -15px; }
    .pp-filters-card { padding: 15px; border-radius: 12px; }
    .pp-card-image { height: 200px; }
    .pp-section-header h2 { font-size: 1.3rem; }
}
</style>


<script>
document.addEventListener('livewire:navigated', () => {
    if (typeof AOS !== 'undefined') AOS.refresh();
});
</script><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/projects-page.blade.php ENDPATH**/ ?>