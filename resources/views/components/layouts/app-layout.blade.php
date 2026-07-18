<!DOCTYPE html>
<html lang="{{ $settings->default_language ?? 'en' }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        $settings = App\Models\Setting::getCached();
        $siteName = $settings->site_name ?? 'Razzaq Engineering Services';
        $siteTagline = $settings->site_tagline ?? 'Professional Engineering Services';
        $primaryPhone = $settings->mobile_phone_1 ?? '+923048902805';
        $primaryEmail = $settings->email_primary ?? 'info@razzaqengineering.com';
        
        // Convert SEO object to array if needed
        $seoArray = null;
        if (isset($seo)) {
            if (is_array($seo)) {
                $seoArray = $seo;
            } elseif (is_object($seo) && method_exists($seo, 'toSEOArray')) {
                $seoArray = $seo->toSEOArray();
            }
        }
    @endphp
    
    {{-- ============================================ --}}
    {{-- DYNAMIC SEO META TAGS --}}
    {{-- ============================================ --}}
    @if($seoArray)
        <title>{{ $seoArray['meta_title'] ?? $siteName }}</title>
        <meta name="description" content="{{ $seoArray['meta_description'] ?? '' }}">
        <meta name="keywords" content="{{ $seoArray['meta_keywords'] ?? '' }}">
        <meta name="author" content="{{ $seoArray['author'] ?? $siteName }}">
        <meta name="robots" content="{{ $seoArray['robots'] ?? 'index, follow' }}">
        @if(!empty($seoArray['canonical']))
            <link rel="canonical" href="{{ $seoArray['canonical'] }}">
        @endif
        
        {{-- Open Graph --}}
        <meta property="og:type" content="{{ $seoArray['og_type'] ?? 'website' }}">
        <meta property="og:title" content="{{ $seoArray['og_title'] ?? $seoArray['meta_title'] ?? '' }}">
        <meta property="og:description" content="{{ $seoArray['og_description'] ?? $seoArray['meta_description'] ?? '' }}">
        <meta property="og:image" content="{{ $seoArray['og_image'] ?? asset('images/og-default.jpg') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ $siteName }}">
        
        {{-- Twitter --}}
        <meta name="twitter:card" content="{{ $seoArray['twitter_card'] ?? 'summary_large_image' }}">
        <meta name="twitter:title" content="{{ $seoArray['twitter_title'] ?? $seoArray['meta_title'] ?? '' }}">
        <meta name="twitter:description" content="{{ $seoArray['twitter_description'] ?? $seoArray['meta_description'] ?? '' }}">
        <meta name="twitter:image" content="{{ $seoArray['twitter_image'] ?? $seoArray['og_image'] ?? asset('images/og-default.jpg') }}">
        
        {{-- Verification --}}
        @if(!empty($seoArray['google_verification']))
            <meta name="google-site-verification" content="{{ $seoArray['google_verification'] }}">
        @endif
        @if(!empty($seoArray['bing_verification']))
            <meta name="msvalidate.01" content="{{ $seoArray['bing_verification'] }}">
        @endif
        
        {{-- Hreflang --}}
        @if(!empty($seoArray['hreflang']))
            <link rel="alternate" hreflang="en" href="{{ $seoArray['hreflang'] }}">
        @endif
    @else
        {{-- Fallback SEO --}}
        <title>{{ $settings->meta_title ?: $siteName . ' | RCC Core Cutting | Plumbing Contractor Pakistan' }}</title>
        <meta name="description" content="{{ $settings->meta_description ?: $siteName . ' - Professional RCC Core Cutting, Diamond Drilling, Wall Saw Cutting, Plumbing & Fire Fighting Services in Lahore, Karachi, Islamabad, Rawalpindi, Peshawar Pakistan' }}">
        <meta name="keywords" content="{{ $settings->meta_keywords ?: 'RCC core cutting, diamond core drilling, wall saw cutting, plumbing contractor, fire fighting, Pakistan' }}">
        <meta name="robots" content="{{ $settings->meta_robots ?? 'index, follow' }}">
    @endif
    
    {{-- Favicon --}}
    @if($settings->favicon && file_exists(public_path('uploads/settings/' . $settings->favicon)))
        <link rel="icon" href="{{ asset('uploads/settings/' . $settings->favicon) }}" type="image/x-icon" />
        <link rel="shortcut icon" href="{{ asset('uploads/settings/' . $settings->favicon) }}" type="image/x-icon" />
    @else
        <link rel="icon" href="{{ asset('assets/images/fav-icon.png') }}" type="image/x-icon" />
        <link rel="shortcut icon" href="{{ asset('assets/images/fav-icon.png') }}" type="image/x-icon" />
    @endif
    
    {{-- Stylesheets --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap5-style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap5-responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animations.css') }}" rel="stylesheet">
    
    @if($settings->custom_css)
        <style>{!! $settings->custom_css !!}</style>
    @endif
    
    @livewireStyles
    @stack('styles')
    
    @if($settings->custom_header_scripts)
        {!! $settings->custom_header_scripts !!}
    @endif
    
    {{-- ============================================ --}}
    {{-- ANALYTICS --}}
    {{-- ============================================ --}}
    @if(!empty($seoArray['google_analytics']))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seoArray['google_analytics'] }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $seoArray['google_analytics'] }}');
        </script>
    @elseif($settings->google_analytics_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings->google_analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $settings->google_analytics_id }}');
        </script>
    @else
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-137344360-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-137344360-1');
            gtag('config', 'G-P8RM9PE3P1');
        </script>
    @endif
    
    {{-- GTM --}}
    @if(!empty($seoArray['google_tag_manager']))
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $seoArray['google_tag_manager'] }}');</script>
    @endif
    
    {{-- Facebook Pixel --}}
    @if(!empty($seoArray['facebook_pixel']))
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init','{{ $seoArray['facebook_pixel'] }}');fbq('track','PageView');
        </script>
    @elseif($settings->facebook_pixel_id)
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init','{{ $settings->facebook_pixel_id }}');fbq('track','PageView');
        </script>
    @endif
    
    {{-- Google Verification --}}
    @if($settings->google_site_verification && empty($seoArray['google_verification']))
        <meta name="google-site-verification" content="{{ strip_tags($settings->google_site_verification) }}" />
    @endif
    
    {{-- ============================================ --}}
    {{-- SCHEMA MARKUP - Professional Verification & Clean Output --}}
    {{-- ============================================ --}}
    
    @if(!empty($seoArray['schema_markup']))
        @php
            $schemaInput = $seoArray['schema_markup'];
            
            // Step 1: Agar array hai to standard clean JSON encode karein
            if (is_array($schemaInput)) {
                $schemaFinal = json_encode($schemaInput, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            } else {
                // Step 2: Agar string hai, check karein ke valid JSON hai ya breakable raw input
                $decoded = json_decode($schemaInput, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    // Valid JSON string hai, clean formatting ke sath render karein
                    $schemaFinal = json_encode($decoded, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                } else {
                    // Invalid JSON string (aksar textarea raw quotes issue), falls back safely without breaks
                    $schemaFinal = trim($schemaInput);
                }
            }
        @endphp
        
        @if(!empty($schemaFinal))
            <script type="application/ld+json">{!! $schemaFinal !!}</script>
        @endif
    @else
    
        {{-- Default Fallback Schema --}}
        @php
            $socialUrls = array_values(array_filter([
                $settings->facebook_url ?? 'https://web.facebook.com/razzaqengineering/',
                $settings->instagram_url ?? 'https://www.instagram.com/razzaq_engineering',
                $settings->linkedin_url ?? 'https://www.linkedin.com/in/razzaq-engineering-services-265b15401/',
                $settings->tiktok_url ?? 'https://www.tiktok.com/@razzaq_engineering',
                $settings->youtube_url ?? null,
                $settings->twitter_url ?? null,
            ]));
        @endphp
        {{-- <script type="application/ld+json">
            @json([
                '@context' => 'https://schema.org',
                '@type' => 'LocalBusiness',
                'name' => $settings->company_name ?? $siteName,
                'image' => $settings->logo_url ?? asset('assets/images/logo-black.png'),
                'url' => $settings->site_url ?? url('/'),
                'telephone' => $primaryPhone,
                'email' => $primaryEmail,
                'description' => $settings->meta_description ?? ($siteName . ' - RCC Core Cutting, Diamond Drilling, Wall Saw Cutting, Plumbing and Fire Fighting Services in Pakistan.'),
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
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
            
        </script> --}}
    @endif
    

    {{-- Breadcrumb Schema --}}
    @if(!empty($seoArray['seo_breadcrumb_schema']))
        @php
            $breadcrumbOutput = $seoArray['seo_breadcrumb_schema'];
            if (is_array($breadcrumbOutput)) {
                $breadcrumbOutput = json_encode($breadcrumbOutput, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            } else {
                $decodedBreadcrumb = json_decode($breadcrumbOutput, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $breadcrumbOutput = json_encode($decodedBreadcrumb, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                }
            }
        @endphp
        <script type="application/ld+json">{!! $breadcrumbOutput !!}</script>
    @endif
    
    {{-- Security Scripts --}}
    <script>
        document.addEventListener('contextmenu',function(e){e.preventDefault();return false});
        document.addEventListener('keydown',function(e){var k={123:true,85:e.ctrlKey,83:e.ctrlKey,80:e.ctrlKey,73:e.ctrlKey&&e.shiftKey,74:e.ctrlKey&&e.shiftKey,67:e.ctrlKey&&e.shiftKey};if(k[e.keyCode]){e.preventDefault();return false}});
        document.addEventListener('selectstart',function(e){e.preventDefault();return false});
        document.addEventListener('copy',function(e){e.preventDefault();return false});
        document.addEventListener('cut',function(e){e.preventDefault();return false});
    </script>
</head>
<body class="protected-page">
    {{-- Preloader --}}
    <div id="preloader" class="position-fixed top-0 start-0 w-100 h-100 bg-white d-flex align-items-center justify-content-center" style="z-index:999999;">
        <div class="text-center">
            <div class="spinner-border text-warning" role="status" style="width:3rem;height:3rem;"><span class="visually-hidden">Loading...</span></div>
            <p class="mt-2 text-muted fw-semibold">Loading...</p>
        </div>
    </div>

    {{-- WhatsApp --}}
    @php
        $whatsappNumber = $settings->whatsapp_number_2 ?? $settings->whatsapp_number ?? $settings->mobile_phone_1 ?? '+923048902805';
        $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
    @endphp
    <a href="https://api.whatsapp.com/send?phone={{ $whatsappClean }}&text=Hello,%20how%20can%20we%20help%20you?" class="position-fixed bottom-0 end-0 m-4 bg-success text-white rounded-circle d-flex align-items-center justify-content-center shadow-lg text-decoration-none z-3" style="width:60px;height:60px;font-size:30px;animation:pulse 2s infinite;" target="_blank" title="Chat on WhatsApp"><i class="fab fa-whatsapp"></i></a>

    {{-- Call --}}
    <a href="tel:{{ $primaryPhone }}" class="position-fixed bottom-0 end-0 me-4 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-lg text-decoration-none z-3" style="width:60px;height:60px;font-size:24px;margin-bottom:80px;animation:pulse-call 2s infinite;" title="Call Now"><i class="fas fa-phone-alt"></i></a>

    {{-- Header --}}
    <x-layouts.partials.header />

    {{-- Main Content --}}
    <main>
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    {{-- Footer --}}
    <x-layouts.partials.footer />

    {{-- Back to Top --}}
    <button id="back-to-top" class="btn btn-warning position-fixed bottom-0 end-0 m-4 rounded-circle shadow-lg d-none" style="width:45px;height:45px;z-index:999;margin-bottom:150px;" title="Back to Top"><i class="fas fa-arrow-up"></i></button>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/19.1.3/lazyload.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/floating-wpp.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap5-theme.js') }}"></script>
    
    @if($settings->custom_javascript)
        <script>{!! $settings->custom_javascript !!}</script>
    @endif
    
    @livewireScripts

    <script>
        $(function(){
            $(window).on('load',function(){$('#preloader').fadeOut('slow',function(){$(this).remove()})});
            AOS.init({duration:800,easing:'ease-in-out',once:true,mirror:false,offset:100});
            new LazyLoad({elements_selector:".lazy",threshold:300});
            $(window).scroll(function(){
                $(this).scrollTop()>300?$('#back-to-top').fadeIn():$('#back-to-top').fadeOut();
                $(this).scrollTop()>50?$('.navbar').addClass('navbar-scrolled shadow-sm'):$('.navbar').removeClass('navbar-scrolled shadow-sm')
            });
            $('#back-to-top').click(function(){$('html, body').animate({scrollTop:0},800);return false});
            window.openCity=function(e,t){document.querySelectorAll(".tabcontent").forEach(function(e){e.style.display="none"});document.querySelectorAll(".tablinks").forEach(function(e){e.classList.remove("active")});var n=document.getElementById(t);n&&(n.style.display="block");e&&e.currentTarget&&e.currentTarget.classList.add("active")};
            window.openCityy=function(e,t){document.querySelectorAll(".tabcontent_new").forEach(function(e){e.style.display="none"});document.querySelectorAll(".tablinks_new").forEach(function(e){e.classList.remove("active")});var n=document.getElementById(t);n&&(n.style.display="block");e&&e.currentTarget&&e.currentTarget.classList.add("active")};
            document.getElementById("defaultOpen")&&document.getElementById("defaultOpen").click();
            document.getElementById("defaultOpen_new")&&document.getElementById("defaultOpen_new").click();
            $('.popup-youtube').magnificPopup({type:'iframe',iframe:{patterns:{youtube:{index:'youtube.com/',id:function(e){var t=e.match(/[\\?\\&]v=([^\\?\\&]+)/);return t&&t[1]?t[1]:null},src:'//www.youtube.com/embed/%id%?autoplay=1'}}}});
            $('.owl-carousel').owlCarousel({loop:true,margin:10,nav:true,responsive:{0:{items:1},600:{items:2},1000:{items:3}}});
            document.addEventListener('livewire:initialized',function(){AOS.refresh()});
            document.addEventListener('livewire:navigated',function(){AOS.refresh()})
        });
        var s=document.createElement('style');
        s.textContent="@keyframes pulse{0%{box-shadow:0 0 0 0 rgba(37,211,102,.7)}70%{box-shadow:0 0 0 15px rgba(37,211,102,0)}100%{box-shadow:0 0 0 0 rgba(37,211,102,0)}}@keyframes pulse-call{0%{box-shadow:0 0 0 0 rgba(0,123,255,.7)}70%{box-shadow:0 0 0 15px rgba(0,123,255,0)}100%{box-shadow:0 0 0 0 rgba(0,123,255,0)}}.hover-text-warning:hover{color:#ffc107!important}.navbar-scrolled{background:rgba(255,255,255,.98)!important}";
        document.head.appendChild(s);
    </script>
    
    @stack('scripts')
    
    @if($settings->custom_footer_scripts)
        {!! $settings->custom_footer_scripts !!}
    @endif
</body>
</html>