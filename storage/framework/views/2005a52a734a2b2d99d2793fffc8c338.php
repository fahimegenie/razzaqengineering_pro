<div class="fleet-page" 
     x-data="{
        init() {
            Livewire.hook('morph.updated', ({ el, component }) => {
                if (typeof AOS !== 'undefined') {
                    setTimeout(() => AOS.refresh(), 100);
                }
            });
        }
     }">
    
    
    <div class="flt-mobile-cta d-lg-none">
        <a href="tel:+923048902805" class="flt-mobile-btn flt-mobile-call">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/923048902805" target="_blank" class="flt-mobile-btn flt-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="<?php echo e(route('quote.index')); ?>" class="flt-mobile-btn flt-mobile-quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    
    <section class="flt-hero">
        <div class="flt-hero-bg"></div>
        <div class="flt-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-30">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="flt-breadcrumb">
                            <li><a href="<?php echo e(route('home.index')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Our Fleet</li>
                        </ol>
                    </nav>
                    
                    <div class="flt-hero-badge">
                        <i class="fas fa-truck-monster"></i> Heavy Machinery & Fleet
                    </div>
                    
                    <h1 class="flt-hero-title">Engineering Excellence on Wheels</h1>
                    <p class="flt-hero-subtitle">Explore our state-of-the-art fleet and heavy equipment engineered for precision, reliability, and large-scale industrial projects.</p>
                    
                    <div class="flt-hero-stats">
                        <div class="flt-stat-item">
                            <span class="flt-stat-number"><?php echo e($fleetItems->total()); ?>+</span>
                            <span class="flt-stat-label">Machines</span>
                        </div>
                        <div class="flt-stat-item">
                            <span class="flt-stat-number"><?php echo e($categories->count()); ?>+</span>
                            <span class="flt-stat-label">Categories</span>
                        </div>
                        <div class="flt-stat-item">
                            <span class="flt-stat-number">24/7</span>
                            <span class="flt-stat-label">Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="flt-trust-bar">
        <div class="container">
            <div class="flt-trust-grid">
                <div class="flt-trust-card">
                    <div class="flt-trust-icon"><i class="fas fa-tools"></i></div>
                    <div>
                        <strong>500+</strong>
                        <span>Heavy Machines</span>
                    </div>
                </div>
                <div class="flt-trust-card">
                    <div class="flt-trust-icon"><i class="fas fa-calendar-check"></i></div>
                    <div>
                        <strong>24+ Years</strong>
                        <span>Experience</span>
                    </div>
                </div>
                <div class="flt-trust-card">
                    <div class="flt-trust-icon"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <strong>Insured</strong>
                        <span>& Maintained</span>
                    </div>
                </div>
                <div class="flt-trust-card">
                    <div class="flt-trust-icon"><i class="fas fa-certificate"></i></div>
                    <div>
                        <strong>Certified</strong>
                        <span>Operators</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="flt-main-section">
        <div class="container">
            


            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fleetItems->count() > 0): ?>
                <div class="row g-4" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'fleet-'.e($selectedCategory).'-'.e(md5($search)).''; ?>wire:key="fleet-<?php echo e($selectedCategory); ?>-<?php echo e(md5($search)); ?>">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $fleetItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="col-lg-4 col-md-6" 
                             data-aos="fade-up" 
                             data-aos-delay="<?php echo e(($loop->index % 3) * 80); ?>" 
                             <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'fleet-item-'.e($item->id).''; ?>wire:key="fleet-item-<?php echo e($item->id); ?>">
                            <div class="flt-card">
                                <div class="flt-card-image">
                                    <img src="<?php echo e($item->image_url); ?>" alt="<?php echo e($item->title); ?>" loading="lazy">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->category): ?>
                                        <div class="flt-card-badges">
                                            <span class="flt-badge-category"><?php echo e($item->category->name); ?></span>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div class="flt-card-overlay">
                                        <a href="#" class="flt-overlay-btn">
                                            <i class="fas fa-eye me-1"></i> View Details
                                        </a>
                                    </div>
                                </div>
                                <div class="flt-card-body">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->category && $item->category->icon): ?>
                                        <div class="flt-card-icon">
                                            <i class="<?php echo e($item->category->icon); ?>"></i>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <h3>
                                        <a href="#"><?php echo e($item->title); ?></a>
                                    </h3>
                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->manufacturer || $item->model_number): ?>
                                        <div class="flt-card-specs">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->manufacturer): ?>
                                                <span class="flt-spec"><i class="fas fa-industry"></i> <?php echo e($item->manufacturer); ?></span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->model_number): ?>
                                                <span class="flt-spec"><i class="fas fa-tag"></i> <?php echo e($item->model_number); ?></span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    
                                    <p><?php echo e(Str::limit($item->description, 90)); ?></p>
                                    
                                    <div class="flt-card-footer">
                                        <span class="flt-availability">
                                            <i class="fas fa-check-circle"></i> Available
                                        </span>
                                        <a href="<?php echo e(route('quote.index')); ?>" class="flt-card-quote">
                                            <i class="fas fa-paper-plane"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
                
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fleetItems->hasPages()): ?>
                    <div class="flt-pagination mt-5">
                        <?php echo e($fleetItems->links()); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php else: ?>
                <div class="flt-empty-state" data-aos="fade-up">
                    <div class="flt-empty-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3>No Fleet Items Found</h3>
                    <p>We couldn't find any machinery matching your criteria. Try adjusting your search or category filter.</p>
                    <button class="btn btn-outline-primary mt-3" wire:click="clearFilters">
                        <i class="fas fa-redo me-2"></i> Clear Filters
                    </button>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    
    <section class="flt-final-cta">
        <div class="container text-center">
            <h2>Need Heavy Equipment for Your Project?</h2>
            <p class="mb-4">Our fleet of modern machinery and experienced operators are ready to deploy for your next industrial project.</p>
            <div class="flt-final-cta-buttons">
                <a href="<?php echo e(route('quote.index')); ?>" class="flt-btn flt-btn-lg flt-btn-accent">
                    <i class="fas fa-paper-plane me-2"></i> Request Equipment
                </a>
                <a href="tel:+923048902805" class="flt-btn flt-btn-lg flt-btn-white-outline-dark">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>

</div>
<?php $__env->startPush('styles'); ?>
    <style>
        /* ============================================
   FLEET PAGE - ENTERPRISE GRADE DESIGN
   Laravel 13 + Livewire 4 Compatible
   ============================================ */

/* --- Mobile Sticky CTA --- */
.flt-mobile-cta {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 998;
    display: flex; background: #fff; box-shadow: 0 -4px 20px rgba(0,0,0,0.12);
}

.flt-mobile-btn {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
    padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none;
    border: none; cursor: pointer; transition: all 0.2s;
}

.flt-mobile-call { background: #f8f9fa; color: #0a1628; }
.flt-mobile-whatsapp { background: #25D366; color: #fff; }
.flt-mobile-quote { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; }

/* --- Hero Section --- */
.flt-hero {
    position: relative; padding: 90px 0 70px; overflow: hidden;
    min-height: 450px; display: flex; align-items: center;
}

.flt-hero-bg {
    position: absolute; inset: 0;
    background: url('<?php echo e(asset("images/fleet-hero-bg.jpg")); ?>') center/cover no-repeat;
    filter: brightness(0.3);
}

.flt-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,61,128,0.88) 0%, rgba(26,92,42,0.82) 100%);
}

.flt-hero .container { position: relative; z-index: 2; }

.flt-breadcrumb {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px;
    font-size: 0.84rem; color: rgba(255,255,255,0.7);
}

.flt-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.flt-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.flt-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.flt-breadcrumb a:hover { color: #fff; }
.flt-breadcrumb .active { color: rgba(255,255,255,0.6); }

.flt-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
    color: #fff; padding: 8px 18px; border-radius: 50px;
    font-size: 0.85rem; font-weight: 600; margin-bottom: 18px;
}

.flt-hero-title { color: #fff; font-size: clamp(2.2rem, 5vw, 3rem); font-weight: 800; margin: 0 0 12px; line-height: 1.15; }
.flt-hero-subtitle { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 550px; margin: 0 0 25px; line-height: 1.6; }

.flt-hero-stats { display: flex; gap: 30px; flex-wrap: wrap; }
.flt-stat-item { text-align: center; }
.flt-stat-number { display: block; font-size: 1.8rem; font-weight: 800; color: #28a745; }
.flt-stat-label { font-size: 0.78rem; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 1px; }

/* --- Trust Bar --- */
.flt-trust-bar { background: #fff; border-bottom: 1px solid #eef0f2; }
.flt-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); }

.flt-trust-card {
    display: flex; align-items: center; gap: 12px; padding: 20px;
    border-right: 1px solid #f0f0f0;
}
.flt-trust-card:last-child { border-right: none; }

.flt-trust-icon {
    width: 44px; height: 44px; min-width: 44px; background: rgba(40,167,69,0.1);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #28a745; font-size: 1.1rem;
}

.flt-trust-card strong { display: block; font-size: 1.1rem; color: #0a1628; }
.flt-trust-card span { font-size: 0.75rem; color: #888; }

/* --- Main Section --- */
.flt-main-section { padding: 40px 0 60px; background: #f8f9fa; }

/* --- Filters Card --- */
.flt-filters-card {
    background: #fff; border-radius: 16px; padding: 22px 25px; margin-bottom: 30px;
    box-shadow: 0 8px 35px rgba(0,0,0,0.06); border: 1px solid #eef0f2;
}

.flt-filter-label {
    font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 1.5px; color: #888; margin-bottom: 6px; display: block;
}

.flt-input-wrapper { position: relative; }

.flt-form-input {
    width: 100%; padding: 12px 16px 12px 42px; border: 2px solid #e9ecef;
    border-radius: 10px; font-size: 0.88rem; color: #333; background: #fff;
    transition: all 0.3s ease; outline: none;
}

.flt-form-input:focus { border-color: #28a745; box-shadow: 0 0 0 3px rgba(40,167,69,0.1); }

.flt-input-icon {
    position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
    color: #aaa; font-size: 0.9rem; z-index: 1; pointer-events: none;
}

.flt-filter-btn {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 8px 16px; border: 2px solid #e9ecef; border-radius: 8px;
    background: #fff; color: #555; font-size: 0.82rem; font-weight: 600;
    cursor: pointer; transition: all 0.2s ease; white-space: nowrap;
}

.flt-filter-btn:hover { border-color: #28a745; color: #28a745; background: #f0faf3; }

.flt-filter-active {
    background: #28a745; border-color: #28a745; color: #fff;
}
.flt-filter-active:hover { background: #1e7e34; border-color: #1e7e34; color: #fff; }

.flt-btn-clear {
    width: 40px; height: 40px; border-radius: 10px; border: 2px solid #e9ecef;
    background: #fff; color: #dc3545; cursor: pointer; display: flex;
    align-items: center; justify-content: center; transition: all 0.3s;
}

.flt-btn-clear:hover { background: #dc3545; color: #fff; border-color: #dc3545; }

.flt-count-badge {
    background: #f0faf3; color: #28a745; padding: 8px 14px; border-radius: 8px;
    font-size: 0.82rem; font-weight: 600; white-space: nowrap;
}

/* --- Fleet Card --- */
.flt-card {
    background: #fff; border-radius: 16px; overflow: hidden;
    box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); height: 100%;
    display: flex; flex-direction: column;
}

.flt-card:hover {
    transform: translateY(-6px); 
    box-shadow: 0 18px 45px rgba(0,0,0,0.1);
}

.flt-card-image {
    position: relative; height: 220px; overflow: hidden; background: #f0f4f8;
}

.flt-card-image img {
    width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;
}

.flt-card:hover .flt-card-image img { transform: scale(1.08); }

.flt-card-badges {
    position: absolute; top: 12px; left: 12px; right: 12px;
    display: flex; justify-content: flex-start;
}

.flt-badge-category {
    background: rgba(10,22,40,0.8); backdrop-filter: blur(8px);
    color: #fff; padding: 5px 14px; border-radius: 50px;
    font-size: 0.72rem; font-weight: 600; letter-spacing: 0.5px;
}

.flt-card-overlay {
    position: absolute; inset: 0; background: rgba(0,0,0,0.5);
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.3s ease;
}

.flt-card:hover .flt-card-overlay { opacity: 1; }

.flt-overlay-btn {
    background: #28a745; color: #fff; padding: 10px 22px; border-radius: 50px;
    font-weight: 600; font-size: 0.85rem; text-decoration: none;
    transform: translateY(10px); transition: transform 0.3s ease;
}

.flt-card:hover .flt-overlay-btn { transform: translateY(0); }
.flt-overlay-btn:hover { background: #1e7e34; color: #fff; }

.flt-card-body {
    padding: 20px; flex: 1; display: flex; flex-direction: column;
}

.flt-card-icon {
    width: 40px; height: 40px; background: rgba(40,167,69,0.1);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #28a745; font-size: 1.1rem; margin-bottom: 10px;
}

.flt-card-body h3 { font-size: 1.05rem; font-weight: 700; margin: 0 0 8px; }
.flt-card-body h3 a { color: #0a1628; text-decoration: none; }
.flt-card-body h3 a:hover { color: #0056b3; }

.flt-card-specs {
    display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 10px;
}

.flt-spec {
    font-size: 0.72rem; padding: 4px 10px; background: #f0f7ff;
    color: #0056b3; border-radius: 50px; font-weight: 500;
    display: inline-flex; align-items: center; gap: 4px;
}

.flt-card-body p { font-size: 0.85rem; color: #888; line-height: 1.6; margin-bottom: 12px; flex: 1; }

.flt-card-footer {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 12px; border-top: 1px solid #f0f0f0; margin-top: auto;
}

.flt-availability {
    font-size: 0.82rem; font-weight: 600; color: #28a745;
    display: flex; align-items: center; gap: 5px;
}

.flt-card-quote {
    width: 36px; height: 36px; background: #0056b3; color: #fff;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    text-decoration: none; font-size: 0.85rem; transition: all 0.3s;
}

.flt-card-quote:hover { background: #003d80; color: #fff; transform: scale(1.1); }

/* --- Pagination --- */
.flt-pagination {
    display: flex; justify-content: center;
}

.flt-pagination .pagination {
    gap: 5px;
}

.flt-pagination .page-link {
    border: 2px solid #e9ecef; border-radius: 8px; padding: 8px 14px;
    color: #555; font-weight: 600; font-size: 0.85rem; transition: all 0.2s;
    background: #fff;
}

.flt-pagination .page-link:hover {
    background: #f0faf3; border-color: #28a745; color: #28a745;
}

.flt-pagination .page-item.active .page-link {
    background: #28a745; border-color: #28a745; color: #fff;
}

/* --- Empty State --- */
.flt-empty-state { text-align: center; padding: 60px 20px; }
.flt-empty-icon { 
    width: 100px; height: 100px; margin: 0 auto 20px; 
    background: rgba(40,167,69,0.08); border-radius: 50%; 
    display: flex; align-items: center; justify-content: center; 
    font-size: 2.5rem; color: #28a745; 
}
.flt-empty-state h3 { font-size: 1.3rem; font-weight: 700; color: #0a1628; }
.flt-empty-state p { color: #888; max-width: 400px; margin: 0 auto; }

/* --- Final CTA --- */
.flt-final-cta { padding: 60px 0; background: #fff; }
.flt-final-cta h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 10px; }
.flt-final-cta p { font-size: 1rem; color: #666; max-width: 500px; margin: 0 auto 20px; }
.flt-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

.flt-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 0.9rem;
    text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none;
    white-space: nowrap;
}

.flt-btn-lg { padding: 14px 28px; font-size: 0.95rem; border-radius: 10px; }
.flt-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.flt-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; }

.flt-btn-white-outline-dark { background: transparent; color: #0a1628; border: 2px solid #0a1628; }
.flt-btn-white-outline-dark:hover { background: #0a1628; color: #fff; }

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 1199.98px) {
    .flt-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .flt-trust-card:nth-child(2) { border-right: none; }
    .flt-card-image { height: 200px; }
}

@media (max-width: 991.98px) {
    .flt-hero { padding: 60px 0 50px; min-height: auto; }
    .flt-hero-title { font-size: 1.8rem; }
    .flt-filters-card { padding: 18px 20px; }
}

@media (max-width: 767.98px) {
    .flt-hero { padding: 45px 0 40px; }
    .flt-hero-title { font-size: 1.5rem; }
    .flt-hero-subtitle { font-size: 0.9rem; }
    .flt-hero-stats { gap: 15px; }
    .flt-stat-number { font-size: 1.4rem; }
    .flt-trust-grid { grid-template-columns: 1fr 1fr; }
    .flt-trust-card { padding: 14px; gap: 8px; }
    .flt-card-image { height: 180px; }
    .flt-filters-card .d-flex.flex-wrap { flex-wrap: nowrap; overflow-x: auto; padding-bottom: 5px; }
}

@media (max-width: 575.98px) {
    .flt-hero { padding: 35px 0 30px; }
    .flt-hero-title { font-size: 1.3rem; }
    .flt-hero-badge { font-size: 0.75rem; padding: 6px 14px; }
    .flt-breadcrumb { font-size: 0.75rem; }
    .flt-filters-card { padding: 15px; border-radius: 12px; }
    .flt-trust-grid { grid-template-columns: 1fr 1fr; }
    .flt-trust-card { padding: 12px 10px; border-bottom: 1px solid #f0f0f0; }
    .flt-trust-card:nth-child(even) { border-right: none; }
    .flt-trust-icon { width: 34px; height: 34px; min-width: 34px; font-size: 0.9rem; }
    .flt-card-image { height: 200px; }
    .flt-final-cta { padding: 40px 0; }
    .flt-final-cta-buttons { flex-direction: column; }
    .flt-final-cta-buttons .flt-btn { width: 100%; justify-content: center; }
    body { padding-bottom: 55px; }
}
    </style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/fleet-page.blade.php ENDPATH**/ ?>