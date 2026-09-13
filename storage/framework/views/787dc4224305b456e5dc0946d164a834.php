<!DOCTYPE html>
<html lang="<?php echo e($settings->default_language ?? 'en'); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <?php
        $settings = App\Models\Setting::getCached();
        $siteName = $settings->site_name ?? 'Razzaq Engineering Services';
        $siteTagline = $settings->site_tagline ?? 'Professional Engineering Services';
        $primaryPhone = $settings->mobile_phone_1 ?? '+923048902805';
        $primaryEmail = $settings->email_primary ?? 'info@razzaqengineering.com';
        
        $seoArray = null;
        if (isset($seo)) {
            if (is_array($seo)) {
                $seoArray = $seo;
            } elseif (is_object($seo) && method_exists($seo, 'toSEOArray')) {
                $seoArray = $seo->toSEOArray();
            }
        }
    ?>
    
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($seoArray): ?>
        <title><?php echo e($seoArray['meta_title'] ?? $siteName); ?></title>
        <meta name="description" content="<?php echo e($seoArray['meta_description'] ?? ''); ?>">
        <meta name="keywords" content="<?php echo e($seoArray['meta_keywords'] ?? ''); ?>">
        <meta name="author" content="<?php echo e($seoArray['author'] ?? $siteName); ?>">
        <meta name="robots" content="<?php echo e($seoArray['robots'] ?? 'index, follow'); ?>">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($seoArray['canonical'])): ?>
            <link rel="canonical" href="<?php echo e($seoArray['canonical']); ?>">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        <meta property="og:type" content="<?php echo e($seoArray['og_type'] ?? 'website'); ?>">
        <meta property="og:title" content="<?php echo e($seoArray['og_title'] ?? $seoArray['meta_title'] ?? ''); ?>">
        <meta property="og:description" content="<?php echo e($seoArray['og_description'] ?? $seoArray['meta_description'] ?? ''); ?>">
        <meta property="og:image" content="<?php echo e($seoArray['og_image'] ?? asset('images/og-default.jpg')); ?>">
        <meta property="og:url" content="<?php echo e(url()->current()); ?>">
        <meta property="og:site_name" content="<?php echo e($siteName); ?>">
        
        <meta name="twitter:card" content="<?php echo e($seoArray['twitter_card'] ?? 'summary_large_image'); ?>">
        <meta name="twitter:title" content="<?php echo e($seoArray['twitter_title'] ?? $seoArray['meta_title'] ?? ''); ?>">
        <meta name="twitter:description" content="<?php echo e($seoArray['twitter_description'] ?? $seoArray['meta_description'] ?? ''); ?>">
        <meta name="twitter:image" content="<?php echo e($seoArray['twitter_image'] ?? $seoArray['og_image'] ?? asset('images/og-default.jpg')); ?>">
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($seoArray['google_verification'])): ?>
            <meta name="google-site-verification" content="<?php echo e($seoArray['google_verification']); ?>">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($seoArray['bing_verification'])): ?>
            <meta name="msvalidate.01" content="<?php echo e($seoArray['bing_verification']); ?>">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php else: ?>
        <title><?php echo e($settings->meta_title ?: $siteName . ' | RCC Core Cutting | Plumbing Contractor Pakistan'); ?></title>
        <meta name="description" content="<?php echo e($settings->meta_description ?: $siteName . ' - Professional RCC Core Cutting, Diamond Drilling, Wall Saw Cutting, Plumbing & Fire Fighting Services in Pakistan'); ?>">
        <meta name="keywords" content="<?php echo e($settings->meta_keywords ?: 'RCC core cutting, diamond core drilling, wall saw cutting, plumbing contractor, fire fighting, Pakistan'); ?>">
        <meta name="robots" content="<?php echo e($settings->meta_robots ?? 'index, follow'); ?>">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->favicon && file_exists(public_path($settings->favicon))): ?>
        <link rel="icon" href="<?php echo e(asset($settings->favicon)); ?>" type="image/x-icon" />
    <?php else: ?>
        <link rel="icon" href="<?php echo e(asset('assets/images/fav-icon.png')); ?>" type="image/x-icon" />
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet" media="print" onload="this.media='all'">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet" media="print" onload="this.media='all'">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" media="print" onload="this.media='all'">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" media="print" onload="this.media='all'">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" media="print" onload="this.media='all'">

    
    <link href="<?php echo e(asset('assets/css/bootstrap5-responsive.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/custom.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/animations.css')); ?>" rel="stylesheet">
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->custom_css): ?>
        <style><?php echo $settings->custom_css; ?></style>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo $__env->yieldPushContent('styles'); ?>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->custom_header_scripts): ?>
        <?php echo $settings->custom_header_scripts; ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->google_analytics_id): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($settings->google_analytics_id); ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?php echo e($settings->google_analytics_id); ?>');
        </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <style>
        .footer-logo-img { filter: none !important; }
        /* Ultra fast preloader fade out */
        #preloader { transition: opacity 0.3s ease; }

        /* Strict Anti-Copy & Anti-Inspection UI Rules */
        .protected-page {
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
            user-select: none !important;
            -webkit-touch-callout: none !important;
        }
        .protected-page input, 
        .protected-page textarea, 
        .protected-page select, 
        .protected-page [contenteditable="true"] {
            -webkit-user-select: text !important;
            -moz-user-select: text !important;
            -ms-user-select: text !important;
            user-select: text !important;
        }
        .protected-page img {
            -webkit-user-drag: none !important;
            user-drag: none !important;
            pointer-events: none !important;
        }
    </style>
</head>
<body class="protected-page">
    
    
    <div id="preloader" class="position-fixed top-0 start-0 w-100 h-100 bg-white d-flex align-items-center justify-content-center" style="z-index:999999;">
        <div class="text-center">
            <div class="spinner-border text-warning" role="status" style="width:3rem;height:3rem;"><span class="visually-hidden">Loading...</span></div>
            <p class="mt-2 text-muted fw-semibold">Loading...</p>
        </div>
    </div>

    
    <?php
        $whatsappNumber = $settings->whatsapp_number_2 ?? $settings->whatsapp_number ?? $settings->mobile_phone_1 ?? '+923048902805';
        $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
    ?>
    <a href="https://api.whatsapp.com/send?phone=<?php echo e($whatsappClean); ?>&text=Hello,%20how%20can%20we%20help%20you?" class="position-fixed bottom-0 end-0 m-4 bg-success text-white rounded-circle d-flex align-items-center justify-content-center shadow-lg text-decoration-none z-3" style="width:60px;height:60px;font-size:30px;" target="_blank" title="Chat on WhatsApp"><i class="fab fa-whatsapp"></i></a>

    
    <a href="tel:<?php echo e($primaryPhone); ?>" class="position-fixed bottom-0 end-0 me-4 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-lg text-decoration-none z-3" style="width:60px;height:60px;font-size:24px;margin-bottom:80px;" title="Call Now"><i class="fas fa-phone-alt"></i></a>

    
    <?php if (isset($component)) { $__componentOriginal07a90ab6ff353cc67cef9e6d27d14a6b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07a90ab6ff353cc67cef9e6d27d14a6b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.partials.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.partials.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal07a90ab6ff353cc67cef9e6d27d14a6b)): ?>
<?php $attributes = $__attributesOriginal07a90ab6ff353cc67cef9e6d27d14a6b; ?>
<?php unset($__attributesOriginal07a90ab6ff353cc67cef9e6d27d14a6b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07a90ab6ff353cc67cef9e6d27d14a6b)): ?>
<?php $component = $__componentOriginal07a90ab6ff353cc67cef9e6d27d14a6b; ?>
<?php unset($__componentOriginal07a90ab6ff353cc67cef9e6d27d14a6b); ?>
<?php endif; ?>

    
    <main>
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo e($slot ?? ''); ?>

        
        
        <div class="cnt-mobile-cta d-lg-none" wire:ignore>
            <a href="tel:<?php echo e($primaryPhone); ?>" class="cnt-mobile-btn cnt-mobile-call">
                <i class="fas fa-phone-alt"></i> Call
            </a>
            <a href="https://wa.me/<?php echo e($whatsappClean); ?>" target="_blank" class="cnt-mobile-btn cnt-mobile-whatsapp">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
            <a href="<?php echo e(route('quote.index')); ?>" class="cnt-mobile-btn cnt-mobile-quote">
                <i class="fas fa-paper-plane"></i> Free Quote
            </a>
        </div>
    </main>

    
    <?php if (isset($component)) { $__componentOriginalff0febf07c7a9e05cdc70e369c825961 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff0febf07c7a9e05cdc70e369c825961 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.partials.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.partials.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff0febf07c7a9e05cdc70e369c825961)): ?>
<?php $attributes = $__attributesOriginalff0febf07c7a9e05cdc70e369c825961; ?>
<?php unset($__attributesOriginalff0febf07c7a9e05cdc70e369c825961); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff0febf07c7a9e05cdc70e369c825961)): ?>
<?php $component = $__componentOriginalff0febf07c7a9e05cdc70e369c825961; ?>
<?php unset($__componentOriginalff0febf07c7a9e05cdc70e369c825961); ?>
<?php endif; ?>

    
    <button id="back-to-top" class="btn btn-warning position-fixed bottom-0 end-0 m-4 rounded-circle shadow-lg d-none" style="width:45px;height:45px;z-index:999;margin-bottom:150px;" title="Back to Top"><i class="fas fa-arrow-up"></i></button>

    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    <script>
        // Instant Preloader Removal
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.style.opacity = '0';
                setTimeout(() => preloader.remove(), 300);
            }
        });

        $(function(){
            if (typeof AOS !== 'undefined') {
                AOS.init({duration:800, easing:'ease-in-out', once:true, offset:100});
            }

            $(window).scroll(function(){
                $(this).scrollTop()>300 ? $('#back-to-top').fadeIn() : $('#back-to-top').fadeOut();
                $(this).scrollTop()>50 ? $('.navbar').addClass('navbar-scrolled shadow-sm') : $('.navbar').removeClass('navbar-scrolled shadow-sm');
            });

            $('#back-to-top').click(function(){$('html, body').animate({scrollTop:0}, 600); return false;});
            
            // Tab switch helpers
            window.openCity = function(e,t){document.querySelectorAll(".tabcontent").forEach(e=>e.style.display="none");document.querySelectorAll(".tablinks").forEach(e=>e.classList.remove("active"));var n=document.getElementById(t);n&&(n.style.display="block");e&&e.currentTarget&&e.currentTarget.classList.add("active")};
            window.openCityy = function(e,t){document.querySelectorAll(".tabcontent_new").forEach(e=>e.style.display="none");document.querySelectorAll(".tablinks_new").forEach(e=>e.classList.remove("active"));var n=document.getElementById(t);n&&(n.style.display="block");e&&e.currentTarget&&e.currentTarget.classList.add("active")};
            
            document.getElementById("defaultOpen")?.click();
            document.getElementById("defaultOpen_new")?.click();
        });

        document.addEventListener('livewire:navigated', () => {
            if (typeof AOS !== 'undefined') AOS.refresh();
        });

        /* ========================================================
           ADVANCED SECURITY: BLOCK INSPECT, VIEW SOURCE & SHORTCUTS
           ======================================================== */

        // 1. Disable Right Click Menu
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        // 2. Disable Keyboard Shortcuts (F12, Ctrl+U, Ctrl+Shift+I/J/C, Ctrl+S, etc.)
        document.addEventListener('keydown', function(e) {
            // F12 key
            if (e.keyCode === 123 || e.key === 'F12') {
                e.preventDefault();
                return false;
            }
            // Ctrl + Shift + I / J / C (DevTools) or Ctrl + U (View Source) or Ctrl + S (Save Page)
            if (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'i' || e.key === 'J' || e.key === 'j' || e.key === 'C' || e.key === 'c')) {
                e.preventDefault();
                return false;
            }
            if (e.ctrlKey && (e.key === 'u' || e.key === 'U' || e.key === 's' || e.key === 'S' || e.key === 'a' || e.key === 'A')) {
                // Allow Ctrl+A only inside input/textarea fields, block globally otherwise
                if (e.key === 'a' || e.key === 'A') {
                    if (['INPUT', 'TEXTAREA'].includes(e.target.tagName)) return true;
                }
                e.preventDefault();
                return false;
            }
        });

        // // 3. Detect and Block Developer Tools (Debugger & Dimension Checks)
        // (function() {
        //     let devtoolsOpen = false;
        //     const threshold = 160;

        //     const checkDevTools = function() {
        //         const widthThreshold = window.outerWidth - window.innerWidth > threshold;
        //         const heightThreshold = window.outerHeight - window.innerHeight > threshold;
                
        //         if ((widthThreshold || heightThreshold) && !devtoolsOpen) {
        //             devtoolsOpen = true;
        //             document.body.innerHTML = '<div style="display:flex;justify-content:center;align-items:center;height:100vh;background:#000;color:#fff;font-family:sans-serif;text-align:center;"><h2>Access Denied: Developer Tools are disabled on this website.</h2></div>';
        //         }
        //     };

        //     // Periodic check
        //     setInterval(checkDevTools, 1000);

        //     // Debugger trap trigger
        //     const element = new Image();
        //     Object.defineProperty(element, 'id', {
        //         get: function() {
        //             document.body.innerHTML = '<div style="display:flex;justify-content:center;align-items:center;height:100vh;background:#000;color:#fff;font-family:sans-serif;text-align:center;"><h2>Security Violation: Inspection detected.</h2></div>';
        //             throw new Error('Debugger detected');
        //         }
        //     });
        //     setInterval(function() {
        //         console.log(element);
        //         console.clear();
        //     }, 2000);
        // })();
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->custom_footer_scripts): ?>
        <?php echo $settings->custom_footer_scripts; ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</body>
</html><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/layouts/app-layout.blade.php ENDPATH**/ ?>