<div class="service-detail-wrapper"
     x-data="{
        init() {
            // Tab change hone par AOS animations re-trigger karne ke liye watcher
            this.$watch('$wire.activeTab', () => {
                if (typeof AOS !== 'undefined') {
                    setTimeout(() => AOS.refresh(), 150);
                }
            });
        }
     }">
    
    <!-- ============================================
         HERO
         ============================================ -->
    <section class="sd-hero" wire:ignore>
        <div class="container">
            <div class="row align-items-center" style="min-height: 240px;">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="sd-breadcrumb">
                            <li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li><a href="<?php echo e(url('services')); ?>">Services</a></li>
                            <li class="active">Service Details</li>
                        </ol>
                    </nav>
                    <h1 class="sd-hero-title">
                        <?php echo e($currentDetail->sd_title ?? 'Service Details'); ?>

                    </h1>
                    <p class="sd-hero-subtitle">Professional engineering solutions with quality workmanship</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         CONTENT
         ============================================ -->
    <section class="sd-section">
        <div class="container">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLoading): ?>
                <div class="text-center py-5" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'sd-loading'; ?>wire:key="sd-loading">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-2">Loading service details...</p>
                </div>
            <?php elseif($errorMessage): ?>
                <div class="alert alert-danger text-center rounded-3 border-0 shadow-sm" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'sd-error'; ?>wire:key="sd-error">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e($errorMessage); ?>

                </div>
            <?php else: ?>
                
                
                <div class="sd-top-bar" data-aos="fade-up" wire:ignore.self>
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="emergency-info">
                                <div class="emergency-icon"><i class="fas fa-clock"></i></div>
                                <div class="emergency-text">
                                    <span class="emergency-label">24/7 Emergency Service</span>
                                    <a href="tel:+923048902805" class="emergency-phone">
                                        <i class="fas fa-phone-alt"></i> +92 304 8902805
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pdffile && !empty($pdffile->pdf_name)): ?>
                                <a href="<?php echo e(asset('pdf_files/'.$pdffile->pdf_name)); ?>" 
                                   target="_blank" 
                                   class="btn-download-brochure">
                                    <i class="fas fa-download me-2"></i> Download Brochure
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <a href="<?php echo e(route('quote.index')); ?>" class="btn-get-quote ms-2">
                                <i class="fas fa-file-invoice me-2"></i> Get Quote
                            </a>
                        </div>
                    </div>
                </div>
                
                
                <div class="sd-tabs-wrapper" data-aos="fade-up" wire:ignore.self>
                    <div class="sd-tabs-nav" id="sdTabsScroll">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <button type="button"
                                    class="sd-tab-btn <?php echo e($activeTab == $service->id ? 'active' : ''); ?>"
                                    wire:click="switchTab(<?php echo e($service->id); ?>)"
                                    <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'tab-btn-'.e($service->id).''; ?>wire:key="tab-btn-<?php echo e($service->id); ?>">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->os_icon): ?>
                                    <span class="sd-tab-icon">
                                        <img src="<?php echo e($service->icon_url); ?>" 
                                             alt="<?php echo e($service->os_name); ?>" width="24" height="24" loading="lazy">
                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <span class="sd-tab-text"><?php echo e($service->os_name); ?></span>
                            </button>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                    
                    
                    <button type="button" class="sd-scroll-arrow sd-scroll-left" onclick="scrollSdTabs(-200)" aria-label="Scroll left">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button type="button" class="sd-scroll-arrow sd-scroll-right" onclick="scrollSdTabs(200)" aria-label="Scroll right">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                
                
                <div class="sd-content-wrapper" data-aos="fade-up" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'sd-panel-container-'.e($activeTab).''; ?>wire:key="sd-panel-container-<?php echo e($activeTab); ?>">
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($currentDetail): ?>
                        <div class="sd-panel">
                            
                            
                            <div class="row g-4 mb-5">
                                <div class="col-lg-6">
                                    <div class="sd-images-grid">
                                        <div class="sd-img-main">
                                            <img src="<?php echo e($currentDetail->image1_url); ?>" 
                                                 alt="<?php echo e($currentDetail->sd_title); ?>" class="img-fluid rounded-3">
                                        </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($currentDetail->sd_image2): ?>
                                            <div class="sd-img-secondary">
                                                <img src="<?php echo e($currentDetail->image2_url); ?>" 
                                                     alt="<?php echo e($currentDetail->sd_title); ?>" class="img-fluid rounded-3">
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <span class="sd-badge">Service Details</span>
                                    <h2 class="sd-title"><?php echo e($currentDetail->sd_title); ?></h2>
                                    <p class="sd-description"><?php echo $currentDetail->sd_description; ?></p>
                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($currentDetail->sd_t1 || $currentDetail->sd_t2 || $currentDetail->sd_t3): ?>
                                        <div class="sd-features">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($currentDetail->sd_t1): ?>
                                                <div class="sd-feature-item">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span><?php echo e($currentDetail->sd_t1); ?></span>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($currentDetail->sd_t2): ?>
                                                <div class="sd-feature-item">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span><?php echo e($currentDetail->sd_t2); ?></span>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($currentDetail->sd_t3): ?>
                                                <div class="sd-feature-item">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span><?php echo e($currentDetail->sd_t3); ?></span>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    
                                    <div class="sd-cta mt-3">
                                        <a href="<?php echo e(route('quote.index')); ?>" class="btn-sd-quote">
                                            <i class="fas fa-paper-plane me-2"></i> Request Quote
                                        </a>
                                        <a href="tel:+923048902805" class="btn-sd-call">
                                            <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($currentAdvantages) > 0): ?>
                                <div class="sd-advantages" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'advantages-panel-'.e($currentDetail->id).''; ?>wire:key="advantages-panel-<?php echo e($currentDetail->id); ?>">
                                    <div class="row align-items-center">
                                        <div class="col-lg-7">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $currentAdvantages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                <div class="sd-adv-block" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'adv-block-'.e($adv->id).''; ?>wire:key="adv-block-<?php echo e($adv->id); ?>">
                                                    <h3><?php echo e($adv->sa_title); ?></h3>
                                                    <p><?php echo $adv->sa_description; ?></p>
                                                    <ul class="sd-adv-list">
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($adv->sa_t1): ?>
                                                            <li><i class="fas fa-check"></i> <?php echo e($adv->sa_t1); ?></li>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($adv->sa_t2): ?>
                                                            <li><i class="fas fa-check"></i> <?php echo e($adv->sa_t2); ?></li>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($adv->sa_t3): ?>
                                                            <li><i class="fas fa-check"></i> <?php echo e($adv->sa_t3); ?></li>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($adv->sa_t4): ?>
                                                            <li><i class="fas fa-check"></i> <?php echo e($adv->sa_t4); ?></li>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    </ul>
                                                </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </div>
                                        <div class="col-lg-5">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($currentAdvantages->first() && $currentAdvantages->first()->sa_image): ?>
                                                <img src="<?php echo e(asset($currentAdvantages->first()->sa_image)); ?>" 
                                                     alt="Service Advantage" 
                                                     class="sd-adv-img rounded-4 shadow-lg" loading="lazy">
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                        </div>
                    <?php else: ?>
                        
                        <div class="text-center py-5" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'sd-empty'; ?>wire:key="sd-empty">
                            <i class="fas fa-tools fa-3x text-muted opacity-25 mb-3"></i>
                            <h4 class="fw-bold">Service Details Coming Soon</h4>
                            <p class="text-muted">Please contact us for more information.</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                </div>
                
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

</div>

<?php $__env->startPush('styles'); ?>
<style>
    /* Purana CSS perfectly safe rahega */
    .sd-hero { background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%); min-height: 240px; display: flex; align-items: center; }
    .sd-breadcrumb { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 10px; }
    .sd-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .sd-breadcrumb li a { color: #fff; text-decoration: none; }
    .sd-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .sd-hero-title { color: #fff; font-size: 2.2rem; font-weight: 800; }
    .sd-hero-subtitle { color: rgba(255,255,255,0.8); font-size: 1rem; }
    .sd-section { padding: 50px 0; background: #f8f9fa; }
    .sd-top-bar { background: #fff; border-radius: 14px; padding: 20px 25px; margin-bottom: 25px; box-shadow: 0 3px 20px rgba(0,0,0,0.04); border: 1px solid #eef0f2; }
    .emergency-info { display: flex; align-items: center; gap: 15px; }
    .emergency-icon { width: 48px; height: 48px; min-width: 48px; background: rgba(220,53,69,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #dc3545; font-size: 20px; animation: pulse-ring 2s infinite; }
    @keyframes pulse-ring { 0% { box-shadow: 0 0 0 0 rgba(220,53,69,0.3); } 70% { box-shadow: 0 0 0 10px rgba(220,53,69,0); } 100% { box-shadow: 0 0 0 0 rgba(220,53,69,0); } }
    .emergency-label { font-size: 0.8rem; color: #888; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
    .emergency-phone { font-size: 1.15rem; font-weight: 700; color: #0a1628; text-decoration: none; }
    .emergency-phone:hover { color: #28a745; }
    .emergency-phone i { color: #28a745; margin-right: 5px; }
    .btn-download-brochure { display: inline-flex; align-items: center; padding: 10px 20px; background: #fff; color: #0056b3; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 0.85rem; border: 2px solid #0056b3; transition: all 0.3s; }
    .btn-download-brochure:hover { background: #0056b3; color: #fff; }
    .btn-get-quote { display: inline-flex; align-items: center; padding: 10px 20px; background: #28a745; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 0.85rem; transition: all 0.3s; }
    .btn-get-quote:hover { background: #1e7e34; color: #fff; transform: translateY(-2px); }
    .sd-tabs-wrapper { position: relative; margin-bottom: 20px; }
    .sd-tabs-nav { display: flex; gap: 6px; overflow-x: auto; scroll-behavior: smooth; scrollbar-width: none; padding: 5px 0; }
    .sd-tabs-nav::-webkit-scrollbar { display: none; }
    .sd-tab-btn { display: flex; align-items: center; gap: 8px; padding: 12px 18px; background: #fff; border: 2px solid #e9ecef; border-radius: 10px; cursor: pointer; font-weight: 600; font-size: 0.85rem; color: #555; white-space: nowrap; transition: all 0.3s; flex-shrink: 0; }
    .sd-tab-btn:hover { border-color: #28a745; color: #28a745; background: #f0faf3; }
    .sd-tab-btn.active { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; border-color: transparent; box-shadow: 0 5px 20px rgba(40,167,69,0.3); }
    .sd-tab-btn.active .sd-tab-icon img { filter: brightness(0) invert(1); }
    .sd-tab-icon { width: 28px; height: 28px; background: rgba(40,167,69,0.08); border-radius: 6px; display: flex; align-items: center; justify-content: center; }
    .sd-scroll-arrow { position: absolute; top: 50%; transform: translateY(-50%); width: 36px; height: 36px; background: #fff; border: 1px solid #dee2e6; border-radius: 50%; cursor: pointer; display: none; align-items: center; justify-content: center; font-size: 14px; color: #555; z-index: 2; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    .sd-scroll-arrow:hover { background: #28a745; color: #fff; border-color: #28a745; }
    .sd-scroll-left { left: -18px; }
    .sd-scroll-right { right: -18px; }
    .sd-content-wrapper { background: #fff; border-radius: 16px; box-shadow: 0 5px 30px rgba(0,0,0,0.05); border: 1px solid #eef0f2; }
    .sd-panel { padding: 30px; animation: fadeIn 0.4s ease; }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    .sd-images-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .sd-img-main { grid-column: 1 / -1; border-radius: 12px; overflow: hidden; }
    .sd-img-main img { width: 100%; height: 250px; object-fit: cover; }
    .sd-img-secondary { border-radius: 10px; overflow: hidden; }
    .sd-img-secondary img { width: 100%; height: 130px; object-fit: cover; }
    .sd-badge { display: inline-block; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: #28a745; background: rgba(40,167,69,0.08); padding: 5px 14px; border-radius: 4px; margin-bottom: 10px; }
    .sd-title { font-size: 1.5rem; font-weight: 700; color: #0a1628; margin-bottom: 12px; }
    .sd-description { font-size: 0.9rem; color: #666; line-height: 1.7; margin-bottom: 18px; }
    .sd-features { display: flex; flex-direction: column; gap: 8px; margin-bottom: 15px; }
    .sd-feature-item { display: flex; align-items: flex-start; gap: 10px; font-size: 0.88rem; color: #555; }
    .sd-feature-item i { color: #28a745; margin-top: 3px; flex-shrink: 0; }
    .sd-cta { display: flex; gap: 10px; flex-wrap: wrap; }
    .btn-sd-quote { display: inline-flex; align-items: center; padding: 12px 24px; background: linear-gradient(135deg, #0056b3, #003d80); color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 0.88rem; }
    .btn-sd-quote:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,86,179,0.3); color: #fff; }
    .btn-sd-call { display: inline-flex; align-items: center; padding: 12px 24px; background: #fff; color: #28a745; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 0.88rem; border: 2px solid #28a745; }
    .btn-sd-call:hover { background: #28a745; color: #fff; }
    .sd-advantages { border-top: 1px solid #eef0f2; padding-top: 30px; margin-top: 20px; }
    .sd-adv-block h3 { font-size: 1.3rem; font-weight: 700; color: #0a1628; margin-bottom: 10px; }
    .sd-adv-block p { font-size: 0.9rem; color: #666; line-height: 1.7; margin-bottom: 12px; }
    .sd-adv-list { list-style: none; padding: 0; }
    .sd-adv-list li { padding: 6px 0; font-size: 0.88rem; color: #555; display: flex; align-items: center; gap: 10px; }
    .sd-adv-list li i { color: #28a745; font-size: 0.9rem; }
    .sd-adv-img { width: 100%; max-height: 350px; object-fit: cover; }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/website/service-detail-page.blade.php ENDPATH**/ ?>