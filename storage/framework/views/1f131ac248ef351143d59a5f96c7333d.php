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
                        We are strategically positioned with main corporate offices and rapid mobilization teams across major urban hubs in Pakistan.
                    </p>
                    
                    
                    <div class="cities-grid" id="citiesGrid">
                        <?php
                            // Fetch all active cities from database
                            $allCities = \App\Models\City::where('is_active', true)->orderBy('is_featured', 'desc')->orderBy('sort_order', 'asc')->orderBy('name', 'asc')->get();
                            
                            // Define main office cities
                            $mainOfficesList = ['Islamabad', 'Rawalpindi', 'Lahore', 'Karachi'];
                            
                            // Separate main offices and remaining cities
                            $mainOfficeCities = $allCities->filter(function($city) use ($mainOfficesList) {
                                return in_array(ucwords(strtolower($city->name)), $mainOfficesList);
                            });
                            
                            $otherCities = $allCities->reject(function($city) use ($mainOfficesList) {
                                return in_array(ucwords(strtolower($city->name)), $mainOfficesList);
                            });
                            
                            // Combine to show main offices first, followed by others up to 15 featured limit, then remaining hidden
                            $featuredCities = $mainOfficeCities->merge($otherCities->take(15 - $mainOfficeCities->count()));
                            $remainingCities = $allCities->whereNotIn('id', $featuredCities->pluck('id'));
                        ?>
                        
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $featuredCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php
                                $isMainOffice = in_array(ucwords(strtolower($city->name)), $mainOfficesList);
                            ?>
                            <div class="city-card <?php echo e($isMainOffice ? 'city-highlight' : ''); ?>" 
                                 data-city="<?php echo e($city->name); ?>"
                                 data-lat="<?php echo e($city->lat); ?>"
                                 data-lng="<?php echo e($city->lng); ?>"
                                 data-main="<?php echo e($isMainOffice ? 'true' : 'false'); ?>"
                                 onclick="focusCity('<?php echo e($city->name); ?>', <?php echo e($city->lat); ?>, <?php echo e($city->lng); ?>)">
                                <div class="city-icon">
                                    <i class="fas <?php echo e($isMainOffice ? 'fa-building' : 'fa-city'); ?>"></i>
                                </div>
                                <div class="city-info">
                                    <span class="city-name"><?php echo e($city->name); ?></span>
                                    <span class="city-status" style="color: <?php echo e($isMainOffice ? '#28a745' : '#0056b3'); ?>;">
                                        <?php echo e($isMainOffice ? 'Main Office' : 'Service Available'); ?>

                                    </span>
                                </div>
                                <i class="fas fa-check-circle city-check"></i>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $remainingCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="city-card hidden-city" 
                                 data-city="<?php echo e($city->name); ?>"
                                 data-lat="<?php echo e($city->lat); ?>"
                                 data-lng="<?php echo e($city->lng); ?>"
                                 data-main="false"
                                 style="display: none;"
                                 onclick="focusCity('<?php echo e($city->name); ?>', <?php echo e($city->lat); ?>, <?php echo e($city->lng); ?>)">
                                <div class="city-icon">
                                    <i class="fas fa-city"></i>
                                </div>
                                <div class="city-info">
                                    <span class="city-name"><?php echo e($city->name); ?></span>
                                    <span class="city-status" style="color: #0056b3;">Service Available</span>
                                </div>
                                <i class="fas fa-check-circle city-check"></i>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                    
                    
                    <div class="view-all-wrapper">
                        <button type="button" class="btn-view-all" id="viewAllCitiesBtn">
                            <span class="btn-text">View All Cities</span>
                            <i class="fas fa-chevron-down btn-icon"></i>
                        </button>
                        <span class="city-count" id="cityCount">
                            Showing <?php echo e($featuredCities->count()); ?> of <?php echo e($allCities->count()); ?> Cities
                        </span>
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
                        
                        <div class="map-container" style="position: relative;">
                            <div id="leafletMap" style="width: 100%; height: 420px; border-radius: 16px;"></div>
                            
                            
                            <div class="map-badge">
                                <div class="badge-pulse"></div>
                                <span><?php echo e($allCities->count()); ?>+ Cities Covered</span>
                            </div>
                        </div>
                        
                        
                        <div class="map-stats">
                            <div class="map-stat-item">
                                <span class="stat-number">4</span>
                                <span class="stat-label">Main Offices</span>
                            </div>
                            <div class="map-stat-item">
                                <span class="stat-number"><?php echo e($allCities->count()); ?>+</span>
                                <span class="stat-label">Service Hubs</span>
                            </div>
                            <div class="map-stat-item">
                                <span class="stat-number">24/7</span>
                                <span class="stat-label">Support</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>


<?php $__env->startPush('styles'); ?>
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .locations-section-pro {
        padding: 80px 0;
        background: #ffffff;
        position: relative;
        overflow: hidden;
    }
    .section-tag {
        display: inline-block;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 3px;
        color: #28a745;
        text-transform: uppercase;
        margin-bottom: 8px;
        position: relative;
        padding-left: 20px;
    }
    .section-tag::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 12px;
        height: 2px;
        background: #28a745;
    }
    .section-heading {
        font-size: 2.2rem;
        font-weight: 800;
        color: #0a1628;
        margin-bottom: 12px;
        line-height: 1.2;
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
    .cities-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 15px;
        max-height: 400px;
        overflow-y: auto;
        padding-right: 5px;
    }
    .cities-grid::-webkit-scrollbar { width: 4px; }
    .cities-grid::-webkit-scrollbar-track { background: #f0f2f4; border-radius: 10px; }
    .cities-grid::-webkit-scrollbar-thumb { background: #28a745; border-radius: 10px; }
    
    .city-card {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .city-card:hover {
        background: #fff;
        border-color: #28a745;
        box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        transform: translateY(-2px);
    }
    .city-highlight {
        background: linear-gradient(135deg, rgba(40,167,69,0.06), rgba(0,86,179,0.06));
        border-color: #28a745;
    }
    .city-icon {
        width: 36px; height: 36px; min-width: 36px;
        background: linear-gradient(135deg, rgba(0,86,179,0.08), rgba(40,167,69,0.08));
        border-radius: 8px; display: flex; align-items: center; justify-content: center;
        font-size: 14px; color: #0056b3;
    }
    .city-highlight .city-icon {
        background: linear-gradient(135deg, #0056b3, #28a745); color: #fff;
    }
    .city-info { flex: 1; min-width: 0; }
    .city-name { display: block; font-size: 0.82rem; font-weight: 700; color: #0a1628; line-height: 1.2; }
    .city-status { display: block; font-size: 0.62rem; font-weight: 600; text-transform: uppercase; }
    .city-check { color: #28a745; font-size: 0.85rem; opacity: 0.4; transition: opacity 0.3s; }
    .city-card:hover .city-check, .city-highlight .city-check { opacity: 1; }
    
    .view-all-wrapper {
        display: flex; align-items: center; gap: 16px; margin-bottom: 20px;
        padding: 10px 0; border-top: 1px solid #e9ecef; border-bottom: 1px solid #e9ecef;
    }
    .btn-view-all {
        display: inline-flex; align-items: center; gap: 8px; padding: 8px 20px;
        background: transparent; color: #0056b3; border: 2px solid #0056b3;
        border-radius: 8px; font-weight: 600; font-size: 0.82rem; cursor: pointer; transition: all 0.3s ease;
    }
    .btn-view-all:hover { background: #0056b3; color: #fff; }
    .btn-view-all.expanded { background: #0056b3; color: #fff; }
    .btn-view-all .btn-icon { transition: transform 0.3s ease; font-size: 0.7rem; }
    .btn-view-all.expanded .btn-icon { transform: rotate(180deg); }
    .city-count { font-size: 0.78rem; color: #999; font-weight: 500; }
    
    .locations-cta { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 5px; }
    .btn-locations-quote {
        display: inline-flex; align-items: center; padding: 12px 26px;
        background: linear-gradient(135deg, #0056b3, #003d80); color: #fff;
        text-decoration: none; border-radius: 10px; font-weight: 700; font-size: 0.88rem;
    }
    .btn-locations-call {
        display: inline-flex; align-items: center; padding: 12px 26px;
        background: #fff; color: #28a745; text-decoration: none; border-radius: 10px;
        font-weight: 700; font-size: 0.88rem; border: 2px solid #28a745;
    }
    
    .map-card { background: #fff; border-radius: 20px; padding: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); border: 1px solid #eef0f2; }
    .map-badge {
        position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%);
        background: rgba(0,0,0,0.8); color: #fff; padding: 8px 20px; border-radius: 50px;
        font-weight: 600; font-size: 0.8rem; display: flex; align-items: center; gap: 10px; z-index: 1000; pointer-events: none;
    }
    .badge-pulse { width: 10px; height: 10px; background: #28a745; border-radius: 50%; animation: greenPulse 1.5s infinite; }
    @keyframes greenPulse { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.4; transform: scale(1.6); } }
    
    .map-stats { display: flex; gap: 10px; margin-top: 15px; }
    .map-stat-item { flex: 1; text-align: center; background: #f8f9fa; border-radius: 10px; padding: 12px 8px; }
    .stat-number { display: block; font-size: 1.3rem; font-weight: 800; color: #0056b3; line-height: 1; }
    .stat-label { display: block; font-size: 0.65rem; color: #888; text-transform: uppercase; margin-top: 4px; font-weight: 600; }

    @media (max-width: 991.98px) {
        .cities-grid { grid-template-columns: repeat(2, 1fr); max-height: 340px; }
        .map-wrapper { margin-top: 30px; }
    }
</style>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('scripts'); ?>
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // 1. View All Cities Toggle Logic
        const viewAllBtn = document.getElementById('viewAllCitiesBtn');
        const hiddenCities = document.querySelectorAll('.hidden-city');
        const cityCount = document.getElementById('cityCount');
        const totalCities = <?php echo e($allCities->count()); ?>;
        const featuredCount = <?php echo e($featuredCities->count()); ?>;
        let isExpanded = false;
        
        if (viewAllBtn) {
            viewAllBtn.addEventListener('click', function() {
                isExpanded = !isExpanded;
                hiddenCities.forEach((city, index) => {
                    city.style.display = isExpanded ? 'flex' : 'none';
                });
                this.classList.toggle('expanded');
                this.querySelector('.btn-text').textContent = isExpanded ? 'Show Less' : 'View All Cities';
                if (cityCount) {
                    cityCount.textContent = isExpanded 
                        ? `Showing ${totalCities} of ${totalCities} Cities` 
                        : `Showing ${featuredCount} of ${totalCities} Cities`;
                }
            });
        }

        // 2. Initialize Leaflet Map Centered on Pakistan
        const pakistanCenter = [30.3753, 69.3451];
        const map = L.map('leafletMap').setView(pakistanCenter, 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Collect all cities dynamically from cards
        const cityCards = document.querySelectorAll('.city-card');
        const markersMap = {};

        cityCards.forEach(card => {
            const name = card.dataset.city;
            const lat = parseFloat(card.dataset.lat);
            const lng = parseFloat(card.dataset.lng);
            const isMainOffice = card.dataset.main === 'true';

            if (!isNaN(lat) && !isNaN(lng)) {
                const circleMarker = L.circleMarker([lat, lng], {
                    radius: isMainOffice ? 9 : 6,
                    fillColor: isMainOffice ? '#28a745' : '#0056b3',
                    color: '#ffffff',
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.95
                }).addTo(map);

                const statusText = isMainOffice ? 'Main Office' : 'Service Available';
                const statusColor = isMainOffice ? '#28a745' : '#0056b3';
                const popupContent = `<b>${name}</b><br><span style="color: ${statusColor}; font-size: 11px; font-weight: bold;">${statusText}</span>`;

                // Hover (Tooltip)
                circleMarker.bindTooltip(`<b>${name}</b> (${statusText})`, {
                    direction: 'top',
                    offset: [0, -5],
                    opacity: 0.9
                });

                // Click (Popup)
                circleMarker.bindPopup(popupContent);
                
                markersMap[name] = { marker: circleMarker, lat: lat, lng: lng };
            }
        });

        // 3. Focus City function when clicking any city card in the list
        window.focusCity = function(cityName, lat, lng) {
            if (markersMap[cityName]) {
                const item = markersMap[cityName];
                map.setView([item.lat, item.lng], 9, {
                    animate: true,
                    pan: { duration: 1 }
                });
                item.marker.openPopup();

                // Highlight active card style
                document.querySelectorAll('.city-card').forEach(c => c.style.borderColor = '');
                const activeCard = document.querySelector(`.city-card[data-city="${cityName}"]`);
                if(activeCard) {
                    activeCard.style.borderColor = '#28a745';
                    activeCard.style.boxShadow = '0 0 10px rgba(40,167,69,0.3)';
                }
            }
        };
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/website/partials/home/service-across-pakistan-section.blade.php ENDPATH**/ ?>