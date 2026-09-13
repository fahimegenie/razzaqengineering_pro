<div class="car-page" x-data="{ search: <?php if ((object) ('search') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('search'->value()); ?>')<?php echo e('search'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('search'); ?>')<?php endif; ?>, activeDept: <?php if ((object) ('selectedDepartment') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('selectedDepartment'->value()); ?>')<?php echo e('selectedDepartment'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('selectedDepartment'); ?>')<?php endif; ?>, activeLoc: <?php if ((object) ('selectedLocation') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('selectedLocation'->value()); ?>')<?php echo e('selectedLocation'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('selectedLocation'); ?>')<?php endif; ?>, activeType: <?php if ((object) ('selectedType') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('selectedType'->value()); ?>')<?php echo e('selectedType'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('selectedType'); ?>')<?php endif; ?> }">
    
    
    <div class="car-mobile-cta d-lg-none">
        <a href="tel:+923048902805" class="car-mobile-btn car-mobile-call">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/923048902805" target="_blank" class="car-mobile-btn car-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="<?php echo e(route('quote.index')); ?>" class="car-mobile-btn car-mobile-quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    
    <section class="car-hero">
        <div class="car-hero-bg"></div>
        <div class="car-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-30">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="car-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Careers</li>
                        </ol>
                    </nav>
                    <div class="car-hero-badge"><i class="fas fa-briefcase"></i> Join Our Team</div>
                    <h1 class="car-hero-title">Build Your Career With Us</h1>
                    <p class="car-hero-subtitle">Explore exciting job opportunities and become part of Pakistan's leading engineering services company</p>
                    <div class="car-hero-stats">
                        <div class="car-stat-item"><span class="car-stat-number"><?php echo e($totalCount); ?>+</span><span class="car-stat-label">Open Positions</span></div>
                        <div class="car-stat-item"><span class="car-stat-number"><?php echo e(count($departments)); ?></span><span class="car-stat-label">Departments</span></div>
                        <div class="car-stat-item"><span class="car-stat-number"><?php echo e(count($locations)); ?></span><span class="car-stat-label">Locations</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="car-trust-bar">
        <div class="container">
            <div class="car-trust-grid">
                <div class="car-trust-card"><div class="car-trust-icon"><i class="fas fa-users"></i></div><div><strong>Great Team</strong><span>Collaborative Environment</span></div></div>
                <div class="car-trust-card"><div class="car-trust-icon"><i class="fas fa-chart-line"></i></div><div><strong>Career Growth</strong><span>Learning & Development</span></div></div>
                <div class="car-trust-card"><div class="car-trust-icon"><i class="fas fa-money-bill-wave"></i></div><div><strong>Competitive Pay</strong><span>Market Leading Salaries</span></div></div>
                <div class="car-trust-card"><div class="car-trust-icon"><i class="fas fa-clock"></i></div><div><strong>Work-Life Balance</strong><span>Flexible Schedule</span></div></div>
            </div>
        </div>
    </section>

    
    <section class="car-main-section">
        <div class="container">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="car-state-box"><div class="spinner-grow text-success" style="width:3rem;height:3rem;"></div><p class="text-muted mt-3 fw-semibold">Loading jobs...</p></div>
            <?php elseif($errorMessage): ?>
                <div class="car-error-card"><i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;"></i><h4 class="fw-bold mt-3">Oops!</h4><p class="text-muted"><?php echo e($errorMessage); ?></p></div>
            <?php else: ?>
                
                <div class="car-section-header text-center" data-aos="fade-up">
                    <span class="car-section-badge"><i class="fas fa-briefcase"></i> Open Positions</span>
                    <h2>Current Job Openings</h2>
                    <p>Find your perfect role and apply today</p>
                </div>

                
                <div class="car-filters-card" data-aos="fade-up">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-4">
                            <label class="car-filter-label"><i class="fas fa-search me-1"></i> Search Jobs</label>
                            <div class="car-input-wrapper">
                                <i class="fas fa-search car-input-icon"></i>
                                <input type="text" class="car-form-input" x-model="search" placeholder="Search by title, department...">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="car-filter-label"><i class="fas fa-building me-1"></i> Department</label>
                            <select class="car-form-input car-form-select" x-model="activeDept" @change="$wire.filterByDepartment(activeDept)">
                                <option value="all">All Departments</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <option value="<?php echo e($dept); ?>"><?php echo e($dept); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label class="car-filter-label"><i class="fas fa-map-marker-alt me-1"></i> Location</label>
                            <select class="car-form-input car-form-select" x-model="activeLoc" @change="$wire.filterByLocation(activeLoc)">
                                <option value="all">All Locations</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <option value="<?php echo e($loc); ?>"><?php echo e($loc); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                        <div class="col-lg-2 d-flex align-items-end gap-2">
                            <button class="car-btn-clear" @click="$wire.clearFilters(); search=''; activeDept='all'; activeLoc='all'; activeType='all'" title="Clear filters"><i class="fas fa-times"></i></button>
                            <span class="car-count-badge"><strong x-text="$wire.filteredJobs.length"></strong> jobs</span>
                        </div>
                    </div>
                </div>

                
                <div class="car-jobs-list" data-aos="fade-up">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filteredJobs->count() > 0): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filteredJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="car-job-card" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'job-'.e($job->id).''; ?>wire:key="job-<?php echo e($job->id); ?>">
                                <div class="car-job-body">
                                    <div class="car-job-main">
                                        <h3>
                                            <a href="<?php echo e(route('careers.detail', ['slug' => $job->slug])); ?>"><?php echo e($job->title); ?></a>
                                        </h3>
                                        <div class="car-job-meta">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($job->department): ?><span class="car-job-tag"><i class="fas fa-building"></i> <?php echo e($job->department); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($job->location): ?><span class="car-job-tag"><i class="fas fa-map-marker-alt"></i> <?php echo e($job->location); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($job->job_type): ?><span class="car-job-tag"><i class="fas fa-clock"></i> <?php echo e($job->job_type); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        <p><?php echo e(Str::limit(strip_tags($job->description), 150)); ?></p>
                                    </div>
                                    <div class="car-job-actions">
                                        <a href="<?php echo e(route('careers.detail', ['slug' => $job->slug])); ?>" class="car-btn car-btn-outline">View Details</a>
                                        <a href="<?php echo e(route('careers.apply', ['slug' => $job->slug])); ?>" class="car-btn car-btn-accent"><i class="fas fa-paper-plane me-1"></i> Apply Now</a>
                                    </div>
                                </div>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <?php else: ?>
                        <div class="car-empty-state">
                            <div class="car-empty-icon"><i class="fas fa-briefcase"></i></div>
                            <h3>No Jobs Found</h3>
                            <p>Try adjusting your search or filters.</p>
                            <button class="btn btn-outline-primary mt-2" @click="$wire.clearFilters(); search=''; activeDept='all'; activeLoc='all'; activeType='all'"><i class="fas fa-redo me-2"></i> Clear Filters</button>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    
    <section class="car-why-section">
        <div class="container">
            <div class="car-section-header text-center" data-aos="fade-up">
                <span class="car-section-badge"><i class="fas fa-star"></i> Why Join Us</span>
                <h2>Benefits & Perks</h2>
                <p>We take care of our team members</p>
            </div>
            <div class="row g-4">
                <?php $benefits = [
                    ['icon' => 'fa-money-bill-wave', 'title' => 'Competitive Salary', 'desc' => 'Market-leading compensation packages'],
                    ['icon' => 'fa-heartbeat', 'title' => 'Health Insurance', 'desc' => 'Comprehensive medical coverage'],
                    ['icon' => 'fa-graduation-cap', 'title' => 'Training & Development', 'desc' => 'Continuous learning opportunities'],
                    ['icon' => 'fa-calendar-check', 'title' => 'Paid Time Off', 'desc' => 'Generous vacation and leave policy'],
                    ['icon' => 'fa-laptop-house', 'title' => 'Remote Work Options', 'desc' => 'Flexible working arrangements'],
                    ['icon' => 'fa-trophy', 'title' => 'Performance Bonuses', 'desc' => 'Recognition for outstanding work'],
                ]; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $benefits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo e($index * 80); ?>">
                        <div class="car-benefit-card">
                            <div class="car-benefit-icon"><i class="fas <?php echo e($benefit['icon']); ?>"></i></div>
                            <h4><?php echo e($benefit['title']); ?></h4>
                            <p><?php echo e($benefit['desc']); ?></p>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </section>

    
    <section class="car-final-cta">
        <div class="container text-center">
            <h2>Don't See Your Perfect Role?</h2>
            <p class="mb-4">Send us your resume and we'll keep you in mind for future opportunities.</p>
            <div class="car-final-cta-buttons">
                <a href="<?php echo e(route('home.contact')); ?>" class="car-btn car-btn-lg car-btn-accent"><i class="fas fa-envelope me-2"></i> Contact Us</a>
                <a href="tel:+923048902805" class="car-btn car-btn-lg car-btn-white-outline-dark"><i class="fas fa-phone-alt me-2"></i> Call Now</a>
            </div>
        </div>
    </section>

</div>

<style>
[x-cloak] { display: none !important; }
.car-mobile-cta { position: fixed; bottom: 0; left: 0; right: 0; z-index: 998; display: flex; background: #fff; box-shadow: 0 -4px 20px rgba(0,0,0,0.12); }
.car-mobile-btn { flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none; border: none; cursor: pointer; }
.car-mobile-call { background: #f8f9fa; color: #0a1628; }
.car-mobile-whatsapp { background: #25D366; color: #fff; }
.car-mobile-quote { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; }
.car-hero { position: relative; padding: 90px 0 70px; overflow: hidden; min-height: 450px; display: flex; align-items: center; }
.car-hero-bg { position: absolute; inset: 0; background: url('<?php echo e(asset("images/careers-hero-bg.jpg")); ?>') center/cover no-repeat; filter: brightness(0.3); }
.car-hero-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(0,61,128,0.88) 0%, rgba(26,92,42,0.82) 100%); }
.car-hero .container { position: relative; z-index: 2; }
.car-breadcrumb { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px; font-size: 0.84rem; color: rgba(255,255,255,0.7); }
.car-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.car-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.car-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.car-breadcrumb a:hover { color: #fff; }
.car-hero-badge { display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); color: #fff; padding: 8px 18px; border-radius: 50px; font-size: 0.85rem; font-weight: 600; margin-bottom: 18px; }
.car-hero-title { color: #fff; font-size: clamp(2.2rem, 5vw, 3rem); font-weight: 800; margin: 0 0 12px; line-height: 1.15; }
.car-hero-subtitle { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 550px; margin: 0 0 25px; line-height: 1.6; }
.car-hero-stats { display: flex; gap: 30px; flex-wrap: wrap; }
.car-stat-item { text-align: center; }
.car-stat-number { display: block; font-size: 1.8rem; font-weight: 800; color: #28a745; }
.car-stat-label { font-size: 0.78rem; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 1px; }
.car-trust-bar { background: #fff; border-bottom: 1px solid #eef0f2; }
.car-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); }
.car-trust-card { display: flex; align-items: center; gap: 12px; padding: 20px; border-right: 1px solid #f0f0f0; }
.car-trust-card:last-child { border-right: none; }
.car-trust-icon { width: 44px; height: 44px; min-width: 44px; background: rgba(40,167,69,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #28a745; font-size: 1.1rem; }
.car-trust-card strong { display: block; font-size: 1.1rem; color: #0a1628; }
.car-trust-card span { font-size: 0.75rem; color: #888; }
.car-main-section { padding: 40px 0 60px; background: #f8f9fa; }
.car-section-header { margin-bottom: 30px; }
.car-section-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(40,167,69,0.1); color: #28a745; padding: 6px 16px; border-radius: 50px; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px; }
.car-section-header h2 { font-size: 1.8rem; font-weight: 800; color: #0a1628; margin-bottom: 5px; }
.car-section-header p { color: #888; }
.car-filters-card { background: #fff; border-radius: 16px; padding: 22px 25px; margin-bottom: 25px; box-shadow: 0 8px 35px rgba(0,0,0,0.06); border: 1px solid #eef0f2; }
.car-filter-label { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #888; margin-bottom: 6px; display: block; }
.car-input-wrapper { position: relative; }
.car-form-input { width: 100%; padding: 12px 16px 12px 42px; border: 2px solid #e9ecef; border-radius: 10px; font-size: 0.88rem; color: #333; background: #fff; transition: all 0.3s ease; outline: none; }
.car-form-select { padding-left: 16px; }
.car-form-input:focus { border-color: #28a745; box-shadow: 0 0 0 3px rgba(40,167,69,0.1); }
.car-input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #aaa; font-size: 0.9rem; }
.car-btn-clear { width: 40px; height: 40px; border-radius: 10px; border: 2px solid #e9ecef; background: #fff; color: #dc3545; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s; }
.car-btn-clear:hover { background: #dc3545; color: #fff; border-color: #dc3545; }
.car-count-badge { background: #f0faf3; color: #28a745; padding: 8px 14px; border-radius: 8px; font-size: 0.82rem; font-weight: 600; white-space: nowrap; }
.car-job-card { background: #fff; border-radius: 14px; padding: 22px; margin-bottom: 12px; box-shadow: 0 3px 15px rgba(0,0,0,0.04); border: 1px solid #eef0f2; transition: all 0.3s ease; }
.car-job-card:hover { box-shadow: 0 8px 30px rgba(0,0,0,0.08); transform: translateY(-2px); }
.car-job-body { display: flex; justify-content: space-between; align-items: center; gap: 20px; flex-wrap: wrap; }
.car-job-main { flex: 1; }
.car-job-main h3 { font-size: 1.1rem; font-weight: 700; margin: 0 0 8px; }
.car-job-main h3 a { color: #0a1628; text-decoration: none; }
.car-job-main h3 a:hover { color: #0056b3; }
.car-job-meta { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 8px; }
.car-job-tag { font-size: 0.75rem; padding: 4px 10px; background: #f0f7ff; color: #0056b3; border-radius: 50px; font-weight: 500; display: flex; align-items: center; gap: 5px; }
.car-job-main p { font-size: 0.85rem; color: #888; margin: 0; line-height: 1.5; }
.car-job-actions { display: flex; gap: 8px; flex-shrink: 0; }
.car-btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 20px; border-radius: 8px; font-weight: 700; font-size: 0.85rem; text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none; white-space: nowrap; }
.car-btn-lg { padding: 14px 28px; font-size: 0.95rem; border-radius: 10px; }
.car-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.car-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; }
.car-btn-outline { background: #fff; color: #0056b3; border: 2px solid #0056b3; }
.car-btn-outline:hover { background: #0056b3; color: #fff; }
.car-btn-white-outline-dark { background: transparent; color: #0a1628; border: 2px solid #0a1628; }
.car-btn-white-outline-dark:hover { background: #0a1628; color: #fff; }
.car-why-section { padding: 60px 0; background: #fff; }
.car-benefit-card { background: #fff; border-radius: 14px; padding: 25px; text-align: center; border: 1px solid #eef0f2; transition: all 0.3s ease; height: 100%; box-shadow: 0 3px 15px rgba(0,0,0,0.04); }
.car-benefit-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.08); border-color: #28a745; }
.car-benefit-icon { width: 55px; height: 55px; background: linear-gradient(135deg, rgba(40,167,69,0.1), rgba(0,86,179,0.1)); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; color: #28a745; margin: 0 auto 12px; transition: all 0.3s ease; }
.car-benefit-card:hover .car-benefit-icon { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; border-radius: 50%; }
.car-benefit-card h4 { font-size: 1rem; font-weight: 700; margin-bottom: 6px; }
.car-benefit-card p { font-size: 0.82rem; color: #888; margin: 0; }
.car-final-cta { padding: 60px 0; background: #f8f9fa; }
.car-final-cta h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 10px; }
.car-final-cta p { font-size: 1rem; color: #666; max-width: 500px; margin: 0 auto 20px; }
.car-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
.car-state-box { text-align: center; padding: 60px 20px; }
.car-error-card { max-width: 500px; margin: 40px auto; padding: 40px 30px; background: #fff; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); text-align: center; }
.car-empty-state { text-align: center; padding: 50px 20px; }
.car-empty-icon { width: 90px; height: 90px; margin: 0 auto 20px; background: rgba(40,167,69,0.08); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.2rem; color: #28a745; }
.car-empty-state h3 { font-size: 1.2rem; font-weight: 700; color: #0a1628; }

@media (max-width: 1199.98px) { .car-trust-grid { grid-template-columns: repeat(2, 1fr); } .car-trust-card:nth-child(2) { border-right: none; } }
@media (max-width: 991.98px) { .car-hero { padding: 60px 0 50px; min-height: auto; } .car-hero-title { font-size: 1.8rem; } .car-job-body { flex-direction: column; align-items: flex-start; } .car-job-actions { width: 100%; } .car-job-actions .car-btn { flex: 1; justify-content: center; } }
@media (max-width: 767.98px) { .car-hero { padding: 45px 0 40px; } .car-hero-title { font-size: 1.5rem; } .car-trust-grid { grid-template-columns: 1fr 1fr; } .car-trust-card { padding: 14px; gap: 8px; } }
@media (max-width: 575.98px) { .car-hero { padding: 35px 0 30px; } .car-hero-title { font-size: 1.3rem; } .car-trust-grid { grid-template-columns: 1fr 1fr; } .car-trust-card { padding: 12px 10px; border-bottom: 1px solid #f0f0f0; } .car-trust-card:nth-child(even) { border-right: none; } .car-trust-icon { width: 34px; height: 34px; min-width: 34px; font-size: 0.9rem; } .car-final-cta { padding: 40px 0; } .car-final-cta-buttons { flex-direction: column; } .car-final-cta-buttons .car-btn { width: 100%; justify-content: center; } body { padding-bottom: 55px; } }
</style>
<script>document.addEventListener('livewire:navigated', () => { if (typeof AOS !== 'undefined') AOS.refresh(); });</script><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/careers-page.blade.php ENDPATH**/ ?>