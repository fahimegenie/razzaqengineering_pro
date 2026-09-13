
<section class="fleet-section-pro" id="fleetSection">
    <div class="container">
        
        
        <div class="fleet-header-row" data-aos="fade-up">
            <div class="row align-items-end g-4">
                <div class="col-lg-8">
                    <span class="section-tag">OUR EQUIPMENT</span>
                    <h2 class="section-heading">Advanced <span class="text-gradient">Technology Fleet</span></h2>
                    <p class="section-desc">We own and operate the latest Hilti and Tyrolit systems, ensuring speed and technical superiority on every job site.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="<?php echo e(route('public.fleet')); ?>" class="btn-fleet-specs">
                        <i class="fas fa-download me-2"></i> View All Fleet
                    </a>
                </div>
            </div>
        </div>
        
        
        <?php
            $fleetData = !empty($fleetItems) ? $fleetItems : collect();
            $isFleetArray = is_array($fleetData);
            $fleetCount = $isFleetArray ? count($fleetData) : $fleetData->count();
        ?>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fleetCount > 0): ?>
        <div class="fleet-slider-wrap mt-4" data-aos="fade-up">
            <div class="owl-carousel owl-theme fleet-owl" id="fleetOwl">
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $fleetData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                        // Extract data based on type
                        $itemId = $isFleetArray ? ($item['id'] ?? '') : $item->id;
                        $itemTitle = $isFleetArray ? ($item['title'] ?? 'Fleet Item') : $item->title;
                        $itemSlug = $isFleetArray ? ($item['slug'] ?? '') : ($item->slug ?? '');
                        $itemDesc = $isFleetArray ? ($item['description'] ?? '') : ($item->description ?? '');
                        $itemImage = $isFleetArray ? ($item['image_url'] ?? ($item['image'] ?? asset('images/placeholder-fleet.jpg'))) : ($item->image_url ?? $item->image ?? asset('images/placeholder-fleet.jpg'));
                        $itemCategory = $isFleetArray ? ($item['category']['name'] ?? ($item['category_name'] ?? '')) : ($item->category->name ?? '');
                        $itemFeatures = $isFleetArray ? ($item['features'] ?? []) : ($item->features ?? []);
                        
                        // Ensure features is array
                        if (!is_array($itemFeatures)) {
                            $itemFeatures = json_decode($itemFeatures, true) ?? [];
                        }
                    ?>
                    
                    <div class="item">
                        <div class="fleet-card">
                            <div class="fleet-card-img">
                                <img src="<?php echo e($itemImage); ?>" 
                                     alt="<?php echo e($itemTitle); ?>" 
                                     class="fleet-img" 
                                     loading="lazy"
                                     onerror="this.src='<?php echo e(asset('images/placeholder-fleet.jpg')); ?>'">
                                <div class="fleet-img-overlay">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($itemSlug): ?>
                                        <a href="<?php echo e(route('fleet.detail', ['slug' => $itemSlug])); ?>" class="fleet-overlay-link">
                                            <i class="fas fa-search-plus me-2"></i> View Details
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('public.fleet')); ?>" class="fleet-overlay-link">
                                            <i class="fas fa-search-plus me-2"></i> View Details
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($itemCategory): ?>
                                    <span class="fleet-category"><?php echo e($itemCategory); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="fleet-card-body">
                                <h3 class="fleet-title"><?php echo e($itemTitle); ?></h3>
                                <p class="fleet-desc"><?php echo Str::limit(strip_tags($itemDesc), 90, '...'); ?></p>
                                <div class="fleet-features">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($itemFeatures)): ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = array_slice($itemFeatures, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <span class="fleet-feature"><i class="fas fa-circle"></i> <?php echo e($feature); ?></span>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    <?php else: ?>
                                        <span class="fleet-feature"><i class="fas fa-circle"></i> Premium quality</span>
                                        <span class="fleet-feature"><i class="fas fa-circle"></i> Professional grade</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                
            </div>
        </div>
        <?php else: ?>
        
        <div class="text-center py-5" data-aos="fade-up">
            <div class="empty-state-icon mb-3">
                <i class="fas fa-tools fa-3x text-muted opacity-25"></i>
            </div>
            <h5 class="fw-bold text-dark">Fleet Information Coming Soon</h5>
            <p class="text-muted">Our equipment fleet details will be available shortly.</p>
            <a href="<?php echo e(route('home.contact')); ?>" class="btn btn-outline-success mt-2 rounded-pill px-4">
                <i class="fas fa-envelope me-2"></i> Contact Us
            </a>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        
        <div class="fleet-trust-bar" data-aos="fade-up" data-aos-delay="200">
            <div class="row align-items-center g-3">
                <div class="col-md-4 text-center text-md-start">
                    <span class="trust-text"><i class="fas fa-check-circle text-success me-2"></i> All equipment regularly maintained & calibrated</span>
                </div>
                <div class="col-md-4 text-center">
                    <span class="trust-text"><i class="fas fa-certificate text-success me-2"></i> OEM-certified genuine parts & consumables</span>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <span class="trust-text"><i class="fas fa-user-cog text-success me-2"></i> Operated by certified trained professionals</span>
                </div>
            </div>
        </div>
        
    </div>
</section>


<?php $__env->startPush('styles'); ?>
<style>
    /* ============================================
       TECHNOLOGY FLEET SECTION
       ============================================ */
    .fleet-section-pro {
        padding: 80px 0;
        background: #f8f9fa;
        position: relative;
    }
    
    .section-tag {
        display: inline-block;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 3px;
        color: #28a745;
        text-transform: uppercase;
        margin-bottom: 8px;
    }
    .section-heading {
        font-size: 2.2rem;
        font-weight: 800;
        color: #0a1628;
        margin-bottom: 6px;
    }
    .text-gradient {
        background: linear-gradient(135deg, #0056b3, #28a745);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .section-desc {
        color: #888;
        font-size: 0.95rem;
        max-width: 600px;
    }
    
    .btn-fleet-specs {
        display: inline-flex;
        align-items: center;
        padding: 13px 28px;
        background: #fff;
        color: #28a745;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
        border: 2px solid #28a745;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    .btn-fleet-specs:hover {
        background: #28a745;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40,167,69,0.25);
    }
    
    /* ============================================
       SLIDER
       ============================================ */
    .fleet-slider-wrap {
        margin: 0 -8px;
    }
    
    .fleet-owl .owl-stage-outer {
        padding: 10px 0 25px;
    }
    
    .fleet-owl .owl-item {
        padding: 0 8px;
    }
    
    .fleet-owl .owl-nav.disabled {
        display: none !important;
    }
    
    /* ============================================
       FLEET CARD
       ============================================ */
    .fleet-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 3px 20px rgba(0,0,0,0.05);
        border: 1px solid #eef0f2;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .fleet-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        border-color: #28a745;
    }
    
    .fleet-card-img {
        position: relative;
        height: 240px;
        overflow: hidden;
        background: #e9ecef;
    }
    
    .fleet-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .fleet-card:hover .fleet-img { transform: scale(1.06); }
    
    .fleet-img-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,54,108,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .fleet-card:hover .fleet-img-overlay { opacity: 1; }
    
    .fleet-overlay-link {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 10px 22px;
        border: 2px solid #fff;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
    
    .fleet-overlay-link:hover {
        background: #28a745;
        border-color: #28a745;
        color: #fff;
    }
    
    .fleet-category {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #0056b3;
        color: #fff;
        padding: 5px 12px;
        border-radius: 4px;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        z-index: 2;
        text-transform: uppercase;
        max-width: 80%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .fleet-card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .fleet-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0a1628;
        margin-bottom: 8px;
        transition: color 0.3s ease;
        line-height: 1.3;
    }
    
    .fleet-card:hover .fleet-title { color: #0056b3; }
    
    .fleet-desc {
        font-size: 0.88rem;
        color: #888;
        line-height: 1.6;
        margin-bottom: 12px;
        flex: 1;
    }
    
    .fleet-features {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding-top: 12px;
        border-top: 1px solid #eef0f2;
    }
    
    .fleet-feature {
        font-size: 0.75rem;
        color: #888;
        display: flex;
        align-items: center;
        gap: 6px;
        background: #f8f9fa;
        padding: 4px 10px;
        border-radius: 20px;
    }
    
    .fleet-feature i {
        font-size: 0.35rem;
        color: #28a745;
    }
    
    /* ============================================
       OWL NAV & DOTS
       ============================================ */
    .fleet-owl {
        position: relative;
    }
    
    .fleet-owl .owl-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 100%;
        left: 0;
        pointer-events: none;
        margin: 0;
        display: flex;
        justify-content: space-between;
        padding: 0 10px;
        z-index: 10;
    }
    
    .fleet-owl .owl-nav button {
        width: 42px;
        height: 42px;
        background: #fff !important;
        border-radius: 50% !important;
        box-shadow: 0 3px 15px rgba(0,0,0,0.1) !important;
        font-size: 18px !important;
        color: #0056b3 !important;
        transition: all 0.3s ease;
        pointer-events: auto;
        margin: 0;
        border: none !important;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .fleet-owl .owl-nav button:hover {
        background: #0056b3 !important;
        color: #fff !important;
        box-shadow: 0 5px 20px rgba(0,86,179,0.3) !important;
    }
    
    .fleet-owl .owl-nav button.owl-prev {
        margin-right: auto;
    }
    
    .fleet-owl .owl-nav button.owl-next {
        margin-left: auto;
    }
    
    .fleet-owl .owl-dots {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 20px !important;
        padding: 5px 0;
    }
    
    .fleet-owl .owl-dot {
        outline: none;
        border: none;
        background: transparent;
        padding: 0;
        cursor: pointer;
    }
    
    .fleet-owl .owl-dot span {
        display: block;
        width: 8px;
        height: 8px;
        background: #d4d8dd !important;
        border-radius: 50%;
        transition: all 0.3s ease;
        margin: 0;
    }
    
    .fleet-owl .owl-dot.active span {
        background: #0056b3 !important;
        width: 24px;
        border-radius: 10px;
    }
    
    .fleet-owl .owl-dot:hover span {
        background: #0056b3 !important;
    }
    
    /* ============================================
       TRUST BAR
       ============================================ */
    .fleet-trust-bar {
        background: #fff;
        border-radius: 12px;
        padding: 20px 25px;
        margin-top: 30px;
        border: 1px solid #e9ecef;
        box-shadow: 0 2px 15px rgba(0,0,0,0.03);
    }
    
    .trust-text {
        font-size: 0.85rem;
        color: #555;
        font-weight: 500;
    }
    
    .trust-text i {
        font-size: 1rem;
    }
    
    /* Empty State */
    .empty-state-icon i {
        opacity: 0.25;
    }
    
    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 1199.98px) {
        .fleet-owl .owl-nav {
            padding: 0 5px;
        }
        .fleet-owl .owl-nav button {
            width: 38px;
            height: 38px;
            font-size: 16px !important;
        }
    }
    
    @media (max-width: 991.98px) {
        .fleet-section-pro { padding: 60px 0; }
        .section-heading { font-size: 1.8rem; }
        .fleet-card-img { height: 220px; }
        .fleet-owl .owl-nav button {
            width: 36px;
            height: 36px;
            font-size: 14px !important;
        }
    }
    
    @media (max-width: 767.98px) {
        .fleet-section-pro { padding: 45px 0; }
        .section-heading { font-size: 1.5rem; }
        .fleet-card-img { height: 200px; }
        .fleet-card-body { padding: 16px; }
        .fleet-title { font-size: 1rem; }
        .fleet-trust-bar { 
            text-align: center; 
            padding: 15px 20px; 
        }
        .trust-text { 
            display: block; 
            margin-bottom: 6px; 
        }
        .trust-text:last-child { margin-bottom: 0; }
        .btn-fleet-specs { 
            width: 100%; 
            justify-content: center; 
            margin-top: 10px; 
        }
        .fleet-owl .owl-nav {
            padding: 0 2px;
        }
        .fleet-owl .owl-nav button {
            width: 32px;
            height: 32px;
            font-size: 12px !important;
        }
        .fleet-category {
            font-size: 0.6rem;
            padding: 4px 10px;
        }
    }
    
    @media (max-width: 575.98px) {
        .fleet-section-pro { padding: 35px 0; }
        .section-heading { font-size: 1.3rem; }
        .section-tag { font-size: 0.65rem; letter-spacing: 2px; }
        .section-desc { font-size: 0.85rem; }
        .fleet-card-img { height: 180px; }
        .fleet-title { font-size: 0.95rem; }
        .fleet-desc { font-size: 0.82rem; }
        .fleet-category { font-size: 0.55rem; padding: 3px 8px; }
        .fleet-feature { font-size: 0.7rem; padding: 3px 8px; }
        .fleet-features { gap: 6px; }
        .fleet-owl .owl-nav button {
            width: 28px;
            height: 28px;
            font-size: 10px !important;
        }
        .fleet-trust-bar { padding: 12px 15px; }
        .trust-text { font-size: 0.78rem; }
        .btn-fleet-specs { 
            padding: 10px 20px; 
            font-size: 0.8rem; 
        }
        .fleet-owl .owl-dots { gap: 6px; }
        .fleet-owl .owl-dot span { 
            width: 6px; 
            height: 6px; 
        }
        .fleet-owl .owl-dot.active span { 
            width: 18px; 
        }
    }
    
    @media (max-width: 400px) {
        .fleet-card-img { height: 160px; }
        .fleet-card-body { padding: 12px; }
        .fleet-title { font-size: 0.85rem; }
        .fleet-desc { font-size: 0.75rem; }
        .fleet-feature { font-size: 0.65rem; }
    }
</style>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('scripts'); ?>
<script>
    // Initialize Owl Carousel
    function initFleetOwl() {
        if (typeof $.fn.owlCarousel === 'undefined') return;
        
        var owl = $('#fleetOwl');
        var hasItems = owl.find('.item').length > 0;
        
        if (!hasItems) return;
        
        // Destroy if already initialized
        if (owl.data('owl.carousel')) {
            owl.trigger('destroy.owl.carousel');
        }
        
        owl.owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4500,
            autoplayHoverPause: true,
            smartSpeed: 600,
            navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
            responsive: {
                0: { 
                    items: 1,
                    margin: 15,
                    nav: false
                },
                480: { 
                    items: 1,
                    margin: 15,
                    nav: false
                },
                600: { 
                    items: 2,
                    margin: 18,
                    nav: true
                },
                992: { 
                    items: 2,
                    margin: 20,
                    nav: true
                },
                1200: { 
                    items: 3,
                    margin: 22,
                    nav: true
                }
            }
        });
    }
    
    // Initialize on page load
    $(document).ready(function() {
        setTimeout(initFleetOwl, 300);
    });
    
    // Re-initialize on Livewire updates
    if (typeof Livewire !== 'undefined') {
        Livewire.hook('message.processed', function() {
            setTimeout(initFleetOwl, 300);
        });
    }
    
    // Re-initialize on tab/content change
    document.addEventListener('DOMContentLoaded', function() {
        // For any tab switches
        document.querySelectorAll('.tab-btn, .nav-link').forEach(function(el) {
            el.addEventListener('click', function() {
                setTimeout(initFleetOwl, 400);
            });
        });
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/website/partials/home/advanced-technology-fleet-section.blade.php ENDPATH**/ ?>