<!--begin::Sidebar-->
<aside class="app-sidebar bg-dark" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand-link text-decoration-none">
            <img src="<?php echo e(asset('admin_assets/assets/img/AdminLTELogo.png')); ?>" alt="Logo" class="brand-image opacity-75 shadow">
            <span class="brand-text fw-bold text-white">Admin Panel</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-3">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="true">
                
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Services Management -->
                <li class="nav-item <?php echo e(request()->is('admin/services*') || request()->is('admin/service-detail*') ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e(request()->is('admin/services*') || request()->is('admin/service-detail*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-tools"></i>
                        <p>
                            Services
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.services.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.services.*') ? 'active' : ''); ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>All Services</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.services.details.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.service-details.*') ? 'active' : ''); ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Service Details</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.services.advantages.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.service-details.*') ? 'active' : ''); ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Service Advantage</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Fleet Management -->
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.fleet.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.fleet.*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-truck"></i>
                        <p>Fleet Management</p>
                    </a>
                </li>

                <!-- Our Companies -->
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.our-companies.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.our-companies.*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-building"></i>
                        <p>Our Companies</p>
                    </a>
                </li>

                <!-- Projects Management -->
                <li class="nav-item <?php echo e(request()->is('admin/projects*') || request()->is('admin/project-categories*') ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e(request()->is('admin/projects*') || request()->is('admin/project-categories*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-folder"></i>
                        <p>
                            Projects
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.projects.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.projects.*') ? 'active' : ''); ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>All Projects</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.projects.categories.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.project-categories.*') ? 'active' : ''); ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Products Management -->
                <li class="nav-item <?php echo e(request()->is('admin/products*') || request()->is('admin/product-categories*') ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e(request()->is('admin/products*') || request()->is('admin/product-categories*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-box"></i>
                        <p>
                            Products
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.products.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.products.*') ? 'active' : ''); ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>All Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.products.categories.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.product-categories.*') ? 'active' : ''); ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Blog Management -->
                <li class="nav-item <?php echo e(request()->is('admin/blog*') ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e(request()->is('admin/blog*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-journal-text"></i>
                        <p>
                            Blog
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.blog.posts.index')); ?>" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Posts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.blog.categories.index')); ?>" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.blog.tags.index')); ?>" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Tags</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.blog.comments.index')); ?>" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Comments</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Pages Management -->
                <li class="nav-item <?php echo e(request()->is('admin/pages*') || request()->is('admin/settings/contact-us*') || request()->is('admin/settings/about-us*') ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e(request()->is('admin/pages*') || request()->is('admin/settings/contact-us*') || request()->is('admin/settings/about-us*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-file-earmark-text"></i>
                        <p>
                            Pages
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.settings.contact-us')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.settings.contact-us') ? 'active' : ''); ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Contact Us Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.settings.about-us')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.settings.about-us') ? 'active' : ''); ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>About Us Page</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Gallery -->
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.gallery.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.gallery.*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-images"></i>
                        <p>Gallery</p>
                    </a>
                </li>

                <!-- Team -->
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.team.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.team.*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Team</p>
                    </a>
                </li>

                <!-- Testimonials -->
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.testimonials.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.testimonials.*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-star"></i>
                        <p>Testimonials</p>
                    </a>
                </li>

                <!-- FAQ -->
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.faq.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.faq.*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-question-circle"></i>
                        <p>FAQ</p>
                    </a>
                </li>

                <!-- SEO Management -->
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.seo.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.seo.*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-search"></i>
                        <p>SEO</p>
                    </a>
                </li>

                <!-- Slider -->
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.sliders.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.slider.*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-sliders"></i>
                        <p>Slider</p>
                    </a>
                </li>

                <!-- Contact Messages -->
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.contacts.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.contacts.*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-envelope"></i>
                        <p>
                            Messages
                            <?php $unreadCount = \App\Models\ContactMessage::where('cm_status', 'new')->count(); ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($unreadCount > 0): ?>
                                <span class="badge bg-danger ms-auto"><?php echo e($unreadCount); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </p>
                    </a>
                </li>

                <!-- Quote Requests -->
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.quotes.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.quotes.*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-file-text"></i>
                        <p>
                            Quotes
                            <?php $pendingQuotes = \App\Models\QuoteRequest::where('qr_status', 'pending')->count(); ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendingQuotes > 0): ?>
                                <span class="badge bg-warning ms-auto"><?php echo e($pendingQuotes); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </p>
                    </a>
                </li>

                <!-- Settings Dropdown -->
                <li class="nav-item <?php echo e(request()->is('admin/settings*') ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e(request()->is('admin/settings*') ? 'active' : ''); ?>">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            Settings
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.settings.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.settings.index') ? 'active' : ''); ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>General Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.settings.contact-us')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.settings.contact-us') ? 'active' : ''); ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Contact Us Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.settings.about-us')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.settings.about-us') ? 'active' : ''); ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>About Us Settings</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Users (if admin) -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user() && auth()->user()->is_admin): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.users.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                            <i class="nav-icon bi bi-person-badge"></i>
                            <p>Users</p>
                        </a>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Clear Cache -->
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.clear-cache')); ?>" class="nav-link">
                        <i class="nav-icon bi bi-arrow-repeat"></i>
                        <p>Clear Cache</p>
                    </a>
                </li>

            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar--><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/layouts/admin/partials/sidebar.blade.php ENDPATH**/ ?>