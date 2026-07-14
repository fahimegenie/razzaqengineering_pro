<!DOCTYPE html>
<html lang="{{ $settings->default_language ?? 'en' }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        $settings = App\Models\Setting::getCached();
        $siteName = $settings->site_name ?? 'Razzaq Engineering Services';
        $siteTagline = $settings->site_tagline ?? 'Professional Engineering Services';
        $primaryPhone = $settings->mobile_phone_1 ?? '+923048902805';
        $primaryEmail = $settings->email_primary ?? 'info@razzaqengineering.com';
    @endphp
    
    <!-- SEO Meta Tags -->
    @if(isset($seo))
        <meta name="title" content="{{ $seo->seo_main_title ?? $seo->seo_title }}">
        <meta name="description" content="{{ $seo->seo_description }}">
        <meta name="keywords" content="{{ $seo->seo_keywords }}">
        <meta name="author" content="{{ $seo->seo_author ?? $siteName }}">
        <link rel="canonical" href="{{ $seo->seo_canonical ?? url()->current() }}">
        <title>{{ $seo->seo_main_title ?? $seo->seo_title ?? $siteName }}</title>
        
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="{{ $seo->seo_og_type ?? 'website' }}">
        <meta property="og:title" content="{{ $seo->seo_og_title ?? $seo->seo_title }}">
        <meta property="og:description" content="{{ $seo->seo_og_description ?? $seo->seo_description }}">
        <meta property="og:image" content="{{ $seo->seo_og_image ? asset('storage/'.$seo->seo_og_image) : $settings->og_image_url }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ $siteName }}">
        
        <!-- Twitter -->
        <meta name="twitter:card" content="{{ $seo->seo_twitter_card ?? 'summary_large_image' }}">
        <meta name="twitter:title" content="{{ $seo->seo_twitter_title ?? $seo->seo_title }}">
        <meta name="twitter:description" content="{{ $seo->seo_twitter_description ?? $seo->seo_description }}">
        <meta name="twitter:image" content="{{ $seo->seo_twitter_image ? asset('storage/'.$seo->seo_twitter_image) : $settings->og_image_url }}">
        
        <!-- Robots -->
        @if(isset($seo->seo_no_index) && $seo->seo_no_index)
            <meta name="robots" content="noindex, nofollow">
        @else
            <meta name="robots" content="{{ $seo->seo_robots ?? 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1' }}">
        @endif
        
        <!-- Schema Markup -->
        @if($seo->seo_schema_markup)
            <script type="application/ld+json">{!! $seo->seo_schema_markup !!}</script>
        @endif
    @else
        <title>{{ $settings->meta_title ?: $siteName . ' | RCC Core Cutting | Plumbing Contractor Pakistan' }}</title>
        <meta name="description" content="{{ $settings->meta_description ?: $siteName . ' - Professional RCC Core Cutting, Diamond Drilling, Wall Saw Cutting, Plumbing & Fire Fighting Services in Lahore, Karachi, Islamabad, Rawalpindi, Peshawar Pakistan' }}">
        <meta name="keywords" content="{{ $settings->meta_keywords ?: 'RCC core cutting, diamond core drilling, wall saw cutting, plumbing contractor, fire fighting, Pakistan' }}">
        <meta name="robots" content="{{ $settings->meta_robots ?? 'index, follow' }}">
    @endif
    
    <!-- Favicon - Dynamic from Settings -->
    @if($settings->favicon && file_exists(public_path('uploads/settings/' . $settings->favicon)))
        <link rel="icon" href="{{ asset('uploads/settings/' . $settings->favicon) }}" type="image/x-icon" />
        <link rel="shortcut icon" href="{{ asset('uploads/settings/' . $settings->favicon) }}" type="image/x-icon" />
    @else
        <link rel="icon" href="{{ asset('assets/images/fav-icon.png') }}" type="image/x-icon" />
        <link rel="shortcut icon" href="{{ asset('assets/images/fav-icon.png') }}" type="image/x-icon" />
    @endif
    
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons 1.11.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Font Awesome 6.5.2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    <!-- Owl Carousel 2.3.4 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet">
    
    <!-- Magnific Popup -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">
    
    <!-- Animate.css 4.1.1 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    
    <!-- AOS Animation 2.3.4 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/bootstrap5-style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap5-responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animations.css') }}" rel="stylesheet">
    
    <!-- Custom CSS from Settings -->
    @if($settings->custom_css)
    <style>{!! $settings->custom_css !!}</style>
    @endif
    
    <!-- Livewire Styles -->
    @livewireStyles
    
    @stack('styles')
    
    <!-- Custom Header Scripts from Settings -->
    @if($settings->custom_header_scripts)
    {!! $settings->custom_header_scripts !!}
    @endif
    
    <!-- Google Analytics - Dynamic -->
    @if($settings->google_analytics_id)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings->google_analytics_id }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $settings->google_analytics_id }}');
    </script>
    @else
    <!-- Default Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-137344360-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-137344360-1');
        gtag('config', 'G-P8RM9PE3P1');
    </script>
    @endif
    
    <!-- Google Site Verification -->
    @if($settings->google_site_verification)
    <meta name="google-site-verification" content="{{ strip_tags($settings->google_site_verification) }}" />
    @endif
    
    <!-- Facebook Pixel -->
    @if($settings->facebook_pixel_id)
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{ $settings->facebook_pixel_id }}');
        fbq('track', 'PageView');
    </script>
    @endif
    
    <!-- ============================================ -->
    <!-- SECURITY PROTECTION (Full Original Code) -->
    <!-- ============================================ -->
    <script>
        // Disable Right Click
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            return false;
        });
        
        // Disable Keyboard Shortcuts
        document.addEventListener('keydown', function(e) {
            const forbiddenKeys = {
                123: true, // F12
                85: e.ctrlKey, // Ctrl+U (View Source)
                83: e.ctrlKey, // Ctrl+S (Save)
                80: e.ctrlKey, // Ctrl+P (Print)
                73: e.ctrlKey && e.shiftKey, // Ctrl+Shift+I (Inspect)
                74: e.ctrlKey && e.shiftKey, // Ctrl+Shift+J (Console)
                67: e.ctrlKey && e.shiftKey, // Ctrl+Shift+C (Element)
            };
            
            if (forbiddenKeys[e.keyCode]) {
                e.preventDefault();
                return false;
            }
        });
        
        // Disable Text Selection
        document.addEventListener('selectstart', function(e) {
            e.preventDefault();
            return false;
        });
        
        // Disable Copy/Cut
        document.addEventListener('copy', function(e) { e.preventDefault(); return false; });
        document.addEventListener('cut', function(e) { e.preventDefault(); return false; });
        
        // DevTools Detection
        (function() {
            let devtoolsOpen = false;
            const threshold = 160;
            
            setInterval(function() {
                const isOpen = window.outerWidth - window.innerWidth > threshold || 
                              window.outerHeight - window.innerHeight > threshold;
                
                if (isOpen && !devtoolsOpen) {
                    devtoolsOpen = true;
                    console.clear();
                    document.body.style.opacity = '0.5';
                    setTimeout(() => { 
                        document.body.style.opacity = '1'; 
                    }, 500);
                } else if (!isOpen) {
                    devtoolsOpen = false;
                    console.clear();
                }
            }, 1000);
            
            // Clear console periodically
            setInterval(() => console.clear(), 2000);
            console.clear();
        })();
    </script>
    
    <!-- Schema Markup - Dynamic from Settings -->
    @php
        $socialUrls = array_values(array_filter([
            $settings->facebook_url ?? 'https://web.facebook.com/razzaqengineering/',
            $settings->instagram_url ?? 'https://www.instagram.com/razzaq_engineering',
            $settings->linkedin_url ?? 'https://www.linkedin.com/in/razzaq-engineering-services-265b15401/',
            $settings->tiktok_url ?? 'https://www.tiktok.com/@razzaq_engineering',
            $settings->youtube_url ?? null,
            $settings->twitter_url ?? null,
        ]));
        
        $schemaData = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => $settings->company_name ?? $siteName,
            'image' => $settings->logo_url ?? asset('assets/images/logo-black.png'),
            'url' => $settings->site_url ?? url('/'),
            'telephone' => $primaryPhone,
            'email' => $primaryEmail,
            'description' => $settings->meta_description ?? $settings->site_description ?? $siteName . ' - RCC Core Cutting, Diamond Drilling, Wall Saw Cutting, Plumbing and Fire Fighting Services in Pakistan.',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $settings->address_1 ?? 'Plot 04 Ali Raza Abad Haji Electronics Plaza Raiwind Road',
                'addressLocality' => $settings->city ?? 'Lahore',
                'addressRegion' => $settings->state ?? 'Punjab',
                'addressCountry' => $settings->country ?? 'PK',
            ],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'],
                'opens' => $settings->is_24_7 ? '00:00' : ($settings->office_start_time ?? '00:00'),
                'closes' => $settings->is_24_7 ? '23:59' : ($settings->office_end_time ?? '23:59'),
            ],
            'sameAs' => $socialUrls,
        ];
    @endphp
    <script type="application/ld+json">
    {!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
</head>
<body class="protected-page">

    <!-- Preloader -->
    <div id="preloader" class="position-fixed top-0 start-0 w-100 h-100 bg-white d-flex align-items-center justify-content-center" style="z-index: 999999;">
        <div class="text-center">
            <div class="spinner-border text-warning" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-muted fw-semibold">Loading...</p>
        </div>
    </div>

    <!-- WhatsApp Floating Button - Dynamic -->
    @php
        $whatsappNumber = $settings->whatsapp_number_2 ?? $settings->whatsapp_number ?? $settings->mobile_phone_1 ?? '+923048902805';
        $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
    @endphp
    <a href="https://api.whatsapp.com/send?phone={{ $whatsappClean }}&text=Hello,%20how%20can%20we%20help%20you?" 
       class="position-fixed bottom-0 end-0 m-4 bg-success text-white rounded-circle d-flex align-items-center justify-content-center shadow-lg text-decoration-none z-3"
       style="width: 60px; height: 60px; font-size: 30px; animation: pulse 2s infinite;"
       target="_blank"
       title="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Call Floating Button - Dynamic -->
    <a href="tel:{{ $primaryPhone }}" 
       class="position-fixed bottom-0 end-0 me-4 mb-20 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-lg text-decoration-none z-3"
       style="width: 60px; height: 60px; font-size: 24px; margin-bottom: 80px; animation: pulse-call 2s infinite;"
       title="Call Now">
        <i class="fas fa-phone-alt"></i>
    </a>

    <!--================ Header Area =================-->
    <x-layouts.partials.header />
    <!--================ End Header =================-->

    <!-- Main Content -->
    <main>
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!--================ Footer =================-->
    <x-layouts.partials.footer />
    <!--================ End Footer =================-->

    <!-- Back to Top -->
    <button id="back-to-top" class="btn btn-warning position-fixed bottom-0 end-0 m-4 rounded-circle shadow-lg d-none" 
            style="width: 45px; height: 45px; z-index: 999; margin-bottom: 150px;" title="Back to Top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- jQuery 3.7.1 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Bootstrap 5.3.3 Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    
    <!-- Magnific Popup -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    
    <!-- Isotope -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
    
    <!-- AOS Animation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    
    <!-- LazyLoad -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/19.1.3/lazyload.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Floating WhatsApp (Optional) -->
    <script src="{{ asset('js/floating-wpp.min.js') }}"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/bootstrap5-theme.js') }}"></script>
    
    <!-- Custom JavaScript from Settings -->
    @if($settings->custom_javascript)
    <script>{!! $settings->custom_javascript !!}</script>
    @endif
    
    <!-- Livewire Scripts -->
    @livewireScripts
    
    <!-- ============================================ -->
    <!-- ALL ORIGINAL SCRIPTS (Fully Preserved) -->
    <!-- ============================================ -->
    <script>
        $(document).ready(function() {
            // PRELOADER
            $(window).on('load', function() {
                $('#preloader').fadeOut('slow', function() {
                    $(this).remove();
                });
            });
            
            // AOS INITIALIZATION
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false,
                offset: 100
            });
            
            // LAZY LOADING
            var lazyLoadInstance = new LazyLoad({
                elements_selector: ".lazy",
                threshold: 300
            });
            
            // BACK TO TOP
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });
            
            $('#back-to-top').click(function() {
                $('html, body').animate({ scrollTop: 0 }, 800);
                return false;
            });
            
            // NAVBAR SCROLL
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('.navbar').addClass('navbar-scrolled shadow-sm');
                } else {
                    $('.navbar').removeClass('navbar-scrolled shadow-sm');
                }
            });
            
            // TAB FUNCTIONALITY (For Home Page)
            window.openCity = function(evt, cityName) {
                var tabcontent = document.getElementsByClassName("tabcontent");
                for (var i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                var tablinks = document.getElementsByClassName("tablinks");
                for (var i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                if (evt && evt.currentTarget) {
                    evt.currentTarget.className += " active";
                }
            };
            
            window.openCityy = function(evt, cityName) {
                var tabcontent_new = document.getElementsByClassName("tabcontent_new");
                for (var i = 0; i < tabcontent_new.length; i++) {
                    tabcontent_new[i].style.display = "none";
                }
                var tablinks_new = document.getElementsByClassName("tablinks_new");
                for (var i = 0; i < tablinks_new.length; i++) {
                    tablinks_new[i].className = tablinks_new[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                if (evt && evt.currentTarget) {
                    evt.currentTarget.className += " active";
                }
            };
            
            // Initialize default tabs
            var defaultTab = document.getElementById("defaultOpen");
            if (defaultTab) defaultTab.click();
            
            var defaultTabNew = document.getElementById("defaultOpen_new");
            if (defaultTabNew) defaultTabNew.click();
            
            // POPUP YOUTUBE VIDEO
            $('.popup-youtube').magnificPopup({
                type: 'iframe',
                iframe: {
                    patterns: {
                        youtube: {
                            index: 'youtube.com/',
                            id: function(url) {
                                var m = url.match(/[\\?\\&]v=([^\\?\\&]+)/);
                                return m && m[1] ? m[1] : null;
                            },
                            src: '//www.youtube.com/embed/%id%?autoplay=1'
                        }
                    }
                }
            });
            
            // WHATSAPP FLOATING BUTTON - Dynamic
            if (typeof $('#WAButton').floatingWhatsApp === 'function') {
                $('#WAButton').floatingWhatsApp({
                    phone: '{{ $whatsappClean }}',
                    headerTitle: 'Chat with us on WhatsApp!',
                    popupMessage: 'Hello, how can we help you?',
                    showPopup: true,
                    buttonImage: '<img src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" />',
                    position: "right"
                });
            }
            
            // OWL CAROUSEL INITIALIZATION
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: { items: 1 },
                    600: { items: 2 },
                    1000: { items: 3 }
                }
            });
            
            // LIVEVIEW EVENTS
            document.addEventListener('livewire:initialized', () => {
                AOS.refresh();
            });
            
            document.addEventListener('livewire:navigated', () => {
                AOS.refresh();
            });
        });
        
        // PULSE ANIMATIONS (Original)
        const style = document.createElement('style');
        style.textContent = `
            @keyframes pulse {
                0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
                70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
                100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
            }
            @keyframes pulse-call {
                0% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.7); }
                70% { box-shadow: 0 0 0 15px rgba(0, 123, 255, 0); }
                100% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0); }
            }
            .hover-text-warning:hover { color: #ffc107 !important; }
            .navbar-scrolled { background: rgba(255,255,255,0.98) !important; }
        `;
        document.head.appendChild(style);
    </script>
    
    @stack('scripts')
    
    <!-- Custom Footer Scripts from Settings -->
    @if($settings->custom_footer_scripts)
    {!! $settings->custom_footer_scripts !!}
    @endif
    
    <!-- Console Protection (Original) -->
    <script>
        console.clear();
        setInterval(() => console.clear(), 3000);
    </script>
</body>
</html>