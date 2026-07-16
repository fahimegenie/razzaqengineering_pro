
<section class="fleet-section-pro" id="fleetSection" 
         x-data="fleetSlider()" 
         x-init="initOwlCarousel()">
    <div class="container">
        
        
        <div class="fleet-header-row" data-aos="fade-up">
            <div class="row align-items-end g-4">
                <div class="col-lg-8">
                    <span class="section-tag">OUR EQUIPMENT</span>
                    <h2 class="section-heading">Advanced <span class="text-gradient">Technology Fleet</span></h2>
                    <p class="section-desc">We own and operate the latest Hilti and Tyrolit systems, ensuring speed and technical superiority on every job site.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="#" class="btn-fleet-specs">
                        <i class="fas fa-download me-2"></i> Download Fleet Specs
                    </a>
                </div>
            </div>
        </div>
        
        
        <div class="fleet-slider-wrap mt-4" data-aos="fade-up">
            <div class="owl-carousel owl-theme fleet-owl" id="fleetOwl">
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $fleetItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="item">
                        <div class="fleet-card">
                            <div class="fleet-card-img">
                                <img src="<?php echo e($item->image_url); ?>" 
                                     alt="<?php echo e($item->title); ?>" 
                                     class="fleet-img" 
                                     loading="lazy">
                                <div class="fleet-img-overlay">
                                    <a href="#" 
                                       class="fleet-overlay-link"
                                       @click.prevent="$dispatch('open-fleet-detail', { id: <?php echo e($item->id); ?> })">
                                        <i class="fas fa-search-plus me-2"></i> View Details
                                    </a>
                                </div>
                                <span class="fleet-category">
                                    <?php echo e(strtoupper($item->category->name ?? 'EQUIPMENT')); ?>

                                </span>
                            </div>
                            <div class="fleet-card-body">
                                <h3 class="fleet-title"><?php echo e($item->title); ?></h3>
                                <p class="fleet-desc"><?php echo e(Str::limit($item->description, 120)); ?></p>
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->features && count($item->features) > 0): ?>
                                    <div class="fleet-features">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = array_slice($item->features, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <span class="fleet-feature">
                                                <i class="fas fa-circle"></i> <?php echo e($feature); ?>

                                            </span>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                
            </div>
        </div>
        
        
        <div class="fleet-trust-bar" data-aos="fade-up" data-aos-delay="200">
            <div class="row align-items-center g-3">
                <div class="col-md-4 text-center text-md-start">
                    <span class="trust-text">
                        <i class="fas fa-check-circle text-success me-2"></i> 
                        All equipment regularly maintained & calibrated
                    </span>
                </div>
                <div class="col-md-4 text-center">
                    <span class="trust-text">
                        <i class="fas fa-certificate text-success me-2"></i> 
                        OEM-certified genuine parts & consumables
                    </span>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <span class="trust-text">
                        <i class="fas fa-user-cog text-success me-2"></i> 
                        Operated by certified trained professionals
                    </span>
                </div>
            </div>
        </div>
        
    </div>

    
    <div x-data="{ 
        showModal: false, 
        selectedItem: null,
        init() {
            window.addEventListener('open-fleet-detail', (e) => {
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').call('getFleetItem', e.detail.id).then(item => {
                    this.selectedItem = item;
                    this.showModal = true;
                });
            });
        }
    }" 
    x-show="showModal" 
    x-cloak
    x-transition
    class="fleet-modal-overlay"
    @click.self="showModal = false">
        <div class="fleet-modal-dialog" x-show="showModal" x-transition>
            <div class="fleet-modal-content">
                <button class="fleet-modal-close" @click="showModal = false">
                    <i class="fas fa-times"></i>
                </button>
                
                <template x-if="selectedItem">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <img :src="selectedItem.image_url" 
                                 :alt="selectedItem.title" 
                                 class="fleet-modal-img">
                        </div>
                        <div class="col-lg-6">
                            <div class="fleet-modal-body">
                                <span class="section-tag" x-text="selectedItem.category?.name || 'EQUIPMENT'"></span>
                                <h2 class="fleet-modal-title" x-text="selectedItem.title"></h2>
                                <p class="fleet-modal-desc" x-text="selectedItem.description"></p>
                                
                                <div class="fleet-modal-specs" x-show="selectedItem.specifications && Object.keys(selectedItem.specifications).length > 0">
                                    <h4>Technical Specifications</h4>
                                    <table class="specs-table">
                                        <template x-for="(value, key) in selectedItem.specifications" :key="key">
                                            <tr>
                                                <td x-text="key"></td>
                                                <td x-text="value"></td>
                                            </tr>
                                        </template>
                                    </table>
                                </div>
                                
                                <div class="fleet-modal-features" x-show="selectedItem.features && selectedItem.features.length > 0">
                                    <h4>Key Features</h4>
                                    <ul class="features-list">
                                        <template x-for="feature in selectedItem.features" :key="feature">
                                            <li>
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                <span x-text="feature"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
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
        cursor: pointer;
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
    }
    
    .fleet-feature i {
        font-size: 0.35rem;
        color: #28a745;
    }
    
    /* ============================================
       FLEET MODAL
       ============================================ */
    .fleet-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.7);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        overflow-y: auto;
    }
    
    .fleet-modal-dialog {
        width: 100%;
        max-width: 900px;
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
    }
    
    .fleet-modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #fff;
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 2;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }
    
    .fleet-modal-close:hover {
        background: #dc3545;
        color: #fff;
        transform: rotate(90deg);
    }
    
    .fleet-modal-img {
        width: 100%;
        height: 100%;
        min-height: 350px;
        object-fit: cover;
    }
    
    .fleet-modal-body {
        padding: 30px;
    }
    
    .fleet-modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0a1628;
        margin: 10px 0;
    }
    
    .fleet-modal-desc {
        color: #666;
        line-height: 1.8;
        margin-bottom: 20px;
    }
    
    .specs-table {
        width: 100%;
        margin: 15px 0;
    }
    
    .specs-table td {
        padding: 8px 12px;
        border-bottom: 1px solid #eee;
    }
    
    .specs-table td:first-child {
        font-weight: 600;
        color: #0a1628;
        width: 40%;
    }
    
    .features-list {
        list-style: none;
        padding: 0;
    }
    
    .features-list li {
        padding: 6px 0;
        color: #555;
    }
    
    /* ============================================
       OWL NAV & DOTS
       ============================================ */
    .fleet-owl .owl-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 100%;
        left: 0;
        pointer-events: none;
        margin: 0;
    }
    
    .fleet-owl .owl-nav button {
        position: absolute;
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
    }
    
    .fleet-owl .owl-nav button:hover {
        background: #0056b3 !important;
        color: #fff !important;
    }
    
    .fleet-owl .owl-prev { left: -21px; }
    .fleet-owl .owl-next { right: -21px; }
    
    .fleet-owl .owl-dots {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: 20px !important;
    }
    
    .fleet-owl .owl-dot span {
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
    
    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 991.98px) {
        .fleet-section-pro { padding: 60px 0; }
        .section-heading { font-size: 1.8rem; }
        .fleet-card-img { height: 220px; }
        .fleet-owl .owl-prev { left: -10px; }
        .fleet-owl .owl-next { right: -10px; }
        .fleet-modal-img { min-height: 250px; }
        .fleet-modal-body { padding: 20px; }
    }
    
    @media (max-width: 767.98px) {
        .fleet-section-pro { padding: 45px 0; }
        .section-heading { font-size: 1.5rem; }
        .fleet-card-img { height: 200px; }
        .fleet-card-body { padding: 16px; }
        .fleet-title { font-size: 1rem; }
        .fleet-trust-bar { text-align: center; padding: 15px; }
        .trust-text { display: block; margin-bottom: 8px; }
        .btn-fleet-specs { width: 100%; justify-content: center; margin-top: 10px; }
        .fleet-owl .owl-nav button { width: 36px; height: 36px; font-size: 14px !important; }
        .fleet-modal-dialog { max-width: 95%; }
        .fleet-modal-img { min-height: 200px; }
    }
    
    @media (max-width: 575.98px) {
        .fleet-section-pro { padding: 35px 0; }
        .section-heading { font-size: 1.3rem; }
        .section-tag { font-size: 0.65rem; letter-spacing: 2px; }
        .fleet-card-img { height: 200px; }
        .fleet-title { font-size: 0.95rem; }
        .fleet-desc { font-size: 0.82rem; }
        .fleet-category { font-size: 0.62rem; padding: 4px 10px; }
        .fleet-feature { font-size: 0.7rem; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function fleetSlider() {
        return {
            initOwlCarousel() {
                // Wait for Livewire to render
                setTimeout(() => {
                    if (typeof $.fn.owlCarousel !== 'undefined') {
                        $('#fleetOwl').owlCarousel({
                            loop: true,
                            margin: 20,
                            nav: true,
                            dots: true,
                            autoplay: true,
                            autoplayTimeout: 4000,
                            autoplayHoverPause: true,
                            smartSpeed: 500,
                            navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
                            responsive: {
                                0: { items: 1 },
                                600: { items: 2 },
                                1000: { items: 3 }
                            }
                        });
                    }
                }, 100);
            },
            
            // Reinitialize on Livewire update
            reinit() {
                if ($('#fleetOwl').data('owl.carousel')) {
                    $('#fleetOwl').trigger('destroy.owl.carousel');
                }
                this.initOwlCarousel();
            }
        }
    }
    
    // Reinitialize carousel after Livewire updates
    document.addEventListener('livewire:navigated', () => {
        if (typeof fleetSlider !== 'undefined') {
            fleetSlider().reinit();
        }
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/fleet-section.blade.php ENDPATH**/ ?>