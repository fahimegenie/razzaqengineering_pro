<!--================ Header Area =================-->
<header class="main_header_area">
    <!-- Top Bar -->
    <div class="header_top d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex gap-4">
                        <a href="tel:+923048902805" class="topbar-link">
                            <i class="fa fa-phone me-1"></i> + (0304) 890 2805
                        </a>
                        <a href="mailto:info@razzaqengineering.com" class="topbar-link">
                            <i class="fa fa-envelope me-1"></i> info@razzaqengineering.com
                        </a>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="header_social">
                        <a href="https://web.facebook.com/razzaqengineering/" target="_blank" class="topbar-social-icon" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/razzaq_engineering" target="_blank" class="topbar-social-icon" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/razzaq-engineering-services-265b15401/" target="_blank" class="topbar-social-icon" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.tiktok.com/@razzaq_engineering" target="_blank" class="topbar-social-icon" title="TikTok"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container">
            @php 
                $settings = App\Models\Setting::where('status', 1)->first();
                $logo = isset($settings) && !empty($settings->logo) 
                    ? asset('uploads/settings/'.$settings->logo) 
                    : asset('assets/images/logo-black.png');
                
                // Fetch data once for both desktop & mobile menus
                $navServices = App\Models\Service::active()->ordered()->get();
                $navCategories = App\Models\ProjectCategory::active()->get();
                $navProducts = App\Models\ProductCategory::active()->get();
            @endphp
            
            <!-- Brand Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ $logo }}" alt="Razzaq Engineering" class="nav-logo">
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler border-0 shadow-none p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Desktop Menu -->
            <div class="collapse navbar-collapse d-none d-lg-flex" id="desktopNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="fas fa-home me-1 d-lg-none"></i> Home
                        </a>
                    </li>
                    
                    <!-- About Us Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold {{ request()->is('about-us','faq') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            About Us
                        </a>
                        <ul class="dropdown-menu shadow border-0 rounded-3">
                            <li><a class="dropdown-item {{ request()->is('about-us') ? 'active' : '' }}" href="{{ route('home.about') }}"><i class="fas fa-building me-2"></i> About Us</a></li>
                            <li><a class="dropdown-item {{ request()->is('faq') ? 'active' : '' }}" href="{{ route('home.faq') }}"><i class="fas fa-question-circle me-2"></i> FAQ</a></li>
                        </ul>
                    </li>
                    
                    <!-- Services Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold {{ request()->is('service*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu shadow border-0 rounded-3">
                            <li><a class="dropdown-item" href="{{ route('home.services') }}"><i class="fas fa-th-list me-2"></i> All Services</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @foreach($navServices as $svc)
                                <li>
                                    <a class="dropdown-item {{ request()->is('service-detail/'.Str::slug($svc->os_name)) ? 'active' : '' }}" 
                                       href="{{ url('service-detail/'.str_replace(' ','-',$svc->os_name)) }}">
                                        {{ $svc->os_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    
                    <!-- Projects Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            Projects
                        </a>
                        <ul class="dropdown-menu shadow border-0 rounded-3">
                            <li><a class="dropdown-item" href="{{ url('projects') }}"><i class="fas fa-th-list me-2"></i> All Projects</a></li>
                            @if(!empty($navCategories) && count($navCategories) > 0)
                                <li><hr class="dropdown-divider"></li>
                                @foreach($navCategories as $cat)
                                    @php $projs = App\Models\Project::active()->where('pc_id',$cat->id)->get(); @endphp
                                    @if(!empty($projs) && count($projs) > 0)
                                        <li class="dropdown-header fw-bold bg-light py-2 small text-uppercase text-dark">{{ $cat->pc_name }}</li>
                                        @foreach($projs as $proj)
                                            <li>
                                                <a class="dropdown-item ps-4" href="{{ route('project.detail', ['slug' => $proj->slug] ) }}">
                                                    <i class="fas fa-angle-right me-2 small"></i> {{ Str::limit($proj->p_title, 30) }}
                                                </a>
                                            </li>
                                        @endforeach
                                        @if(!$loop->last)<li><hr class="dropdown-divider"></li>@endif
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    
                    <!-- Products Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold {{ request()->is('products/*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu shadow border-0 rounded-3">
                            <li><a class="dropdown-item" href="{{ url('products') }}"><i class="fas fa-th-list me-2"></i> All Products</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @foreach($navProducts as $pcat)
                                <li>
                                    <a class="dropdown-item" href="{{ route('product.detail', ['slug' => str_replace(' ','-',$pcat->pc_name)]) }}">
                                        {{ $pcat->pc_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    
                    <!-- Portfolio -->
                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->is('gallery') ? 'active' : '' }}" href="{{ url('gallery') }}">
                            Portfolio
                        </a>
                    </li>
                    
                    <!-- Team -->
                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->is('team') ? 'active' : '' }}" href="{{ url('team') }}">
                            Team
                        </a>
                    </li>
                    
                    <!-- Contact -->
                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->is('contact-us') ? 'active' : '' }}" href="{{ route('home.contact') }}">
                            Contact
                        </a>
                    </li>
                    
                    <!-- Get Quote Button -->
                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('quote.index') }}" class="btn btn-gradient btn-sm fw-bold px-4 py-2 rounded-pill">
                            <i class="fas fa-paper-plane me-1"></i> Get a Quote
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- ============ MOBILE OFFCANVAS (Left Side Overlay) ============ -->
    <div class="offcanvas offcanvas-start mobile-offcanvas" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
        <!-- Offcanvas Header -->
        <div class="offcanvas-header mobile-menu-header">
            <h5 class="offcanvas-title text-white fw-bold" id="mobileMenuLabel">
                <img src="{{ $logo }}" alt="Logo" class="me-2" style="height:32px;">
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        
        <!-- Offcanvas Body -->
        <div class="offcanvas-body p-0">
            <ul class="mobile-nav list-unstyled mb-0">
                <!-- Home -->
                <li class="mobile-nav-item">
                    <a href="{{ url('/') }}" class="mobile-nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="fas fa-home me-3"></i> Home
                    </a>
                </li>
                
                <!-- About Us -->
                <li class="mobile-nav-item">
                    <a class="mobile-nav-link has-submenu {{ request()->is('about-us','faq') ? 'active' : '' }}" data-bs-toggle="collapse" href="#mobAbout" role="button" aria-expanded="{{ request()->is('about-us','faq') ? 'true' : 'false' }}">
                        <i class="fas fa-info-circle me-3"></i> About Us
                        <i class="fas fa-chevron-down ms-auto sub-arrow"></i>
                    </a>
                    <div class="collapse {{ request()->is('about-us','faq') ? 'show' : '' }}" id="mobAbout">
                        <ul class="mobile-submenu list-unstyled">
                            <li><a href="{{ route('home.about') }}" class="mobile-submenu-link {{ request()->is('about-us') ? 'active' : '' }}">About Us</a></li>
                            <li><a href="{{ route('home.faq') }}" class="mobile-submenu-link {{ request()->is('faq') ? 'active' : '' }}">FAQ</a></li>
                        </ul>
                    </div>
                </li>
                
                <!-- Services -->
                <li class="mobile-nav-item">
                    <a class="mobile-nav-link has-submenu {{ request()->is('service*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#mobServices" role="button" aria-expanded="{{ request()->is('service*') ? 'true' : 'false' }}">
                        <i class="fas fa-tools me-3"></i> Services
                        <i class="fas fa-chevron-down ms-auto sub-arrow"></i>
                    </a>
                    <div class="collapse {{ request()->is('service*') ? 'show' : '' }}" id="mobServices">
                        <ul class="mobile-submenu list-unstyled">
                            <li><a href="{{ route('home.services') }}" class="mobile-submenu-link">All Services</a></li>
                            @foreach($navServices as $svc)
                                <li><a href="{{ url('service-detail/'.str_replace(' ','-',$svc->os_name)) }}" class="mobile-submenu-link">{{ $svc->os_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                
                <!-- Projects -->
                <li class="mobile-nav-item">
                    <a class="mobile-nav-link has-submenu" data-bs-toggle="collapse" href="#mobProjects" role="button">
                        <i class="fas fa-project-diagram me-3"></i> Projects
                        <i class="fas fa-chevron-down ms-auto sub-arrow"></i>
                    </a>
                    <div class="collapse" id="mobProjects">
                        <ul class="mobile-submenu list-unstyled">
                            <li><a href="{{ url('projects') }}" class="mobile-submenu-link">All Projects</a></li>
                            @foreach($navCategories as $cat)
                                @php $projs = App\Models\Project::active()->where('pc_id',$cat->pc_id)->limit(5)->get(); @endphp
                                @if($projs->count())
                                    <li class="mobile-submenu-header">{{ $cat->pc_name }}</li>
                                    @foreach($projs as $proj)
                                        <li><a href="{{ url('project/'.$proj->p_id) }}" class="mobile-submenu-link ps-4">{{ $proj->p_title }}</a></li>
                                    @endforeach
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>
                
                <!-- Products -->
                <li class="mobile-nav-item">
                    <a class="mobile-nav-link has-submenu {{ request()->is('products/*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#mobProducts" role="button" aria-expanded="{{ request()->is('products/*') ? 'true' : 'false' }}">
                        <i class="fas fa-box me-3"></i> Products
                        <i class="fas fa-chevron-down ms-auto sub-arrow"></i>
                    </a>
                    <div class="collapse {{ request()->is('products/*') ? 'show' : '' }}" id="mobProducts">
                        <ul class="mobile-submenu list-unstyled">
                            <li><a href="{{ url('products/p') }}" class="mobile-submenu-link">All Products</a></li>
                            @foreach($navProducts as $pcat)
                                <li><a href="{{ url('products/'.str_replace(' ','-',$pcat->pc_name)) }}" class="mobile-submenu-link">{{ $pcat->pc_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                
                <!-- Portfolio -->
                <li class="mobile-nav-item">
                    <a href="{{ url('gallery') }}" class="mobile-nav-link {{ request()->is('gallery') ? 'active' : '' }}">
                        <i class="fas fa-images me-3"></i> Portfolio
                    </a>
                </li>
                
                <!-- Team -->
                <li class="mobile-nav-item">
                    <a href="{{ url('team') }}" class="mobile-nav-link {{ request()->is('team') ? 'active' : '' }}">
                        <i class="fas fa-users me-3"></i> Team
                    </a>
                </li>
                
                <!-- Contact -->
                <li class="mobile-nav-item">
                    <a href="{{ route('home.contact') }}" class="mobile-nav-link {{ request()->is('contact-us') ? 'active' : '' }}">
                        <i class="fas fa-envelope me-3"></i> Contact
                    </a>
                </li>
            </ul>
            
            <!-- Mobile Menu Footer -->
            <div class="mobile-menu-bottom p-4 mt-3">
                <a href="{{ route('home.contact') }}" class="btn btn-gradient w-100 fw-bold py-3 rounded-pill mb-3">
                    <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                </a>
                <div class="d-flex flex-column gap-2">
                    <a href="tel:+923048902805" class="mobile-contact-link">
                        <i class="fas fa-phone text-success"></i> + (0304) 890 2805
                    </a>
                    <a href="mailto:info@razzaqengineering.com" class="mobile-contact-link">
                        <i class="fas fa-envelope text-success"></i> info@razzaqengineering.com
                    </a>
                </div>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="https://web.facebook.com/razzaqengineering/" target="_blank" class="mobile-social-icon" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/razzaq_engineering" target="_blank" class="mobile-social-icon" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/razzaq-engineering-services-265b15401/" target="_blank" class="mobile-social-icon" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://www.tiktok.com/@razzaq_engineering" target="_blank" class="mobile-social-icon" title="TikTok"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
    </div>
</header>
<!--================ End Header =================-->