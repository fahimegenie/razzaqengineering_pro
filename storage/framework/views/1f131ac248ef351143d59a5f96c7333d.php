<!-- ============================================
     PROFESSIONAL SERVICE LOCATIONS SECTION
     ============================================ -->
<section class="locations-section-pro" id="locationsSection">
    <div class="container">
        
        <div class="row g-5 align-items-center">
            
            
            <div class="col-lg-6" data-aos="fade-right">
                <div class="locations-content">
                    
                    <span class="section-tag">OUR COVERAGE</span>
                    <h2 class="section-heading">Service Across <span class="text-gradient">Pakistan</span></h2>
                    <p class="section-desc">
                        We are strategically positioned to provide rapid mobilization and consistent service quality across all major urban and industrial centers in Pakistan.
                    </p>
                    
                    
                    <div class="cities-grid">
                        <?php
                            $cities = [
                                ['name' => 'Lahore', 'icon' => 'fa-city', 'highlight' => true],
                                ['name' => 'Karachi', 'icon' => 'fa-city'],
                                ['name' => 'Islamabad', 'icon' => 'fa-landmark'],
                                ['name' => 'Rawalpindi', 'icon' => 'fa-building'],
                                ['name' => 'Peshawar', 'icon' => 'fa-mosque'],
                                ['name' => 'Faisalabad', 'icon' => 'fa-industry'],
                                ['name' => 'Multan', 'icon' => 'fa-monument'],
                                ['name' => 'Gujranwala', 'icon' => 'fa-warehouse'],
                                ['name' => 'Sialkot', 'icon' => 'fa-plane'],
                            ];
                        ?>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="city-card <?php echo e($city['highlight'] ?? false ? 'city-highlight' : ''); ?>">
                                <div class="city-icon">
                                    <i class="fas <?php echo e($city['icon']); ?>"></i>
                                </div>
                                <div class="city-info">
                                    <span class="city-name"><?php echo e($city['name']); ?></span>
                                    <span class="city-status">Service Available</span>
                                </div>
                                <i class="fas fa-check-circle city-check"></i>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                    
                    
                    <div class="locations-cta">
                        <a href="<?php echo e(route('quote.index')); ?>" class="btn-locations-quote">
                            <i class="fas fa-file-invoice me-2"></i> Get Quote in Your City
                        </a>
                        <a href="tel:+923048902805" class="btn-locations-call">
                            <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                        </a>
                    </div>
                    
                </div>
            </div>
            
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="map-wrapper">
                    
                    
                    <div class="map-card">
                        
                        
                        <div class="map-container">
                            <!-- Pakistan Simplified SVG Map -->
                            <svg viewBox="0 0 400 450" fill="none" xmlns="http://www.w3.org/2000/svg" class="pakistan-map">
                                <!-- Background -->
                                <rect width="400" height="450" fill="#f0f4f8" rx="20"/>
                                
                                <!-- Pakistan Shape (Simplified) -->
                                <path d="M120,60 L200,40 L280,50 L320,80 L340,130 L350,180 L330,220 L300,250 L280,280 L250,310 L220,340 L200,370 L180,400 L160,420 L140,410 L120,390 L100,360 L90,320 L85,280 L90,240 L100,200 L110,160 L115,120 L120,60Z" 
                                      fill="#e8f5e9" stroke="#28a745" stroke-width="2" stroke-linejoin="round"/>
                                
                                <!-- City Dots -->
                                <circle cx="200" cy="150" r="6" fill="#0056b3" class="city-dot">
                                    <title>Islamabad</title>
                                </circle>
                                <circle cx="210" cy="180" r="6" fill="#0056b3" class="city-dot">
                                    <title>Rawalpindi</title>
                                </circle>
                                <circle cx="230" cy="200" r="8" fill="#28a745" class="city-dot pulse-dot">
                                    <title>Lahore (Head Office)</title>
                                </circle>
                                <circle cx="160" cy="350" r="6" fill="#0056b3" class="city-dot">
                                    <title>Karachi</title>
                                </circle>
                                <circle cx="130" cy="220" r="5" fill="#0056b3" class="city-dot">
                                    <title>Peshawar</title>
                                </circle>
                                <circle cx="200" cy="280" r="5" fill="#0056b3" class="city-dot">
                                    <title>Multan</title>
                                </circle>
                                <circle cx="240" cy="240" r="4" fill="#0056b3" class="city-dot">
                                    <title>Faisalabad</title>
                                </circle>
                            </svg>
                            
                            
                            <div class="map-badge">
                                <div class="badge-pulse"></div>
                                <span>Nationwide Service</span>
                            </div>
                        </div>
                        
                        
                        <div class="map-stats">
                            <div class="map-stat-item">
                                <span class="stat-number">9+</span>
                                <span class="stat-label">Major Cities</span>
                            </div>
                            <div class="map-stat-item">
                                <span class="stat-number">24/7</span>
                                <span class="stat-label">Availability</span>
                            </div>
                            <div class="map-stat-item">
                                <span class="stat-number">500+</span>
                                <span class="stat-label">Projects Done</span>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>


<?php $__env->startPush('styles'); ?>
<style>
    /* ============================================
       SERVICE LOCATIONS SECTION
       ============================================ */
    .locations-section-pro {
        padding: 80px 0;
        background: #ffffff;
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
        margin-bottom: 12px;
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
        line-height: 1.7;
        margin-bottom: 25px;
        max-width: 500px;
    }
    
    /* ============================================
       CITIES GRID
       ============================================ */
    .cities-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 25px;
    }
    
    .city-card {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .city-card:hover {
        background: #fff;
        border-color: #28a745;
        box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        transform: translateY(-2px);
    }
    
    .city-highlight {
        background: linear-gradient(135deg, rgba(40,167,69,0.05), rgba(0,86,179,0.05));
        border-color: #28a745;
    }
    
    .city-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;
        background: linear-gradient(135deg, rgba(0,86,179,0.08), rgba(40,167,69,0.08));
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        color: #0056b3;
    }
    
    .city-highlight .city-icon {
        background: linear-gradient(135deg, #0056b3, #28a745);
        color: #fff;
    }
    
    .city-info {
        flex: 1;
    }
    
    .city-name {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        color: #0a1628;
        line-height: 1.2;
    }
    
    .city-status {
        display: block;
        font-size: 0.68rem;
        color: #28a745;
        font-weight: 500;
    }
    
    .city-check {
        color: #28a745;
        font-size: 0.9rem;
        opacity: 0.6;
    }
    
    .city-card:hover .city-check {
        opacity: 1;
    }
    
    /* ============================================
       CTA
       ============================================ */
    .locations-cta {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .btn-locations-quote {
        display: inline-flex;
        align-items: center;
        padding: 13px 28px;
        background: linear-gradient(135deg, #0056b3, #003d80);
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(0,86,179,0.25);
    }
    
    .btn-locations-quote:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0,86,179,0.4);
        color: #fff;
    }
    
    .btn-locations-call {
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
    }
    
    .btn-locations-call:hover {
        background: #28a745;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40,167,69,0.25);
    }
    
    /* ============================================
       MAP
       ============================================ */
    .map-wrapper {
        height: 100%;
    }
    
    .map-card {
        background: #fff;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.06);
        border: 1px solid #eef0f2;
    }
    
    .map-container {
        position: relative;
        background: #f0f4f8;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 15px;
    }
    
    .pakistan-map {
        width: 100%;
        height: auto;
        display: block;
        padding: 15px;
    }
    
    .city-dot {
        animation: dotPulse 2s infinite;
    }
    
    .pulse-dot {
        animation: headOfficePulse 2s infinite;
    }
    
    @keyframes dotPulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }
    
    @keyframes headOfficePulse {
        0% { r: 8; opacity: 1; }
        50% { r: 12; opacity: 0.6; }
        100% { r: 8; opacity: 1; }
    }
    
    .map-badge {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(0,0,0,0.75);
        color: #fff;
        padding: 10px 22px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 10px;
        backdrop-filter: blur(5px);
        pointer-events: none;
    }
    
    .badge-pulse {
        width: 10px;
        height: 10px;
        background: #28a745;
        border-radius: 50%;
        animation: greenPulse 1.5s infinite;
    }
    
    @keyframes greenPulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.4); }
    }
    
    /* Map Stats */
    .map-stats {
        display: flex;
        gap: 10px;
    }
    
    .map-stat-item {
        flex: 1;
        text-align: center;
        background: #f8f9fa;
        border-radius: 10px;
        padding: 12px 8px;
    }
    
    .stat-number {
        display: block;
        font-size: 1.3rem;
        font-weight: 800;
        color: #0056b3;
        line-height: 1;
    }
    
    .stat-label {
        display: block;
        font-size: 0.68rem;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        margin-top: 4px;
    }
    
    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 991.98px) {
        .locations-section-pro { padding: 60px 0; }
        .section-heading { font-size: 1.8rem; }
        .cities-grid { grid-template-columns: repeat(2, 1fr); }
        .map-wrapper { margin-top: 30px; }
    }
    
    @media (max-width: 767.98px) {
        .locations-section-pro { padding: 45px 0; }
        .section-heading { font-size: 1.5rem; }
        .cities-grid { grid-template-columns: repeat(2, 1fr); gap: 8px; }
        .city-card { padding: 10px 12px; gap: 8px; }
        .city-icon { width: 32px; height: 32px; min-width: 32px; font-size: 13px; }
        .city-name { font-size: 0.78rem; }
        .city-status { font-size: 0.62rem; }
        .locations-cta { flex-direction: column; }
        .btn-locations-quote, .btn-locations-call { width: 100%; justify-content: center; }
        .map-card { padding: 15px; }
        .map-badge { font-size: 0.78rem; padding: 8px 16px; }
    }
    
    @media (max-width: 575.98px) {
        .locations-section-pro { padding: 35px 0; }
        .section-heading { font-size: 1.3rem; }
        .section-tag { font-size: 0.65rem; letter-spacing: 2px; }
        .cities-grid { grid-template-columns: 1fr 1fr; gap: 6px; }
        .city-card { padding: 8px 10px; gap: 6px; border-radius: 8px; }
        .city-icon { width: 28px; height: 28px; min-width: 28px; font-size: 11px; border-radius: 6px; }
        .city-name { font-size: 0.72rem; }
        .city-status { font-size: 0.58rem; }
        .city-check { font-size: 0.7rem; }
        .map-stats { flex-direction: column; gap: 6px; }
        .stat-number { font-size: 1.1rem; }
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/website/partials/home/service-across-pakistan-section.blade.php ENDPATH**/ ?>