<?php

use App\Livewire\Admin\Dashboard\Dashboard;
use App\Livewire\Website\AboutPage;
use App\Livewire\Website\BlogDetailPage;
use App\Livewire\Website\BlogPage;
use App\Livewire\Website\CityPage;
use App\Livewire\Website\CityServicePage;
use App\Livewire\Website\ContactPage;
use App\Livewire\Website\FaqPage;
use App\Livewire\Website\GalleryPage;
use App\Livewire\Website\HomePage;
use App\Livewire\Website\ProductDetailPage;
use App\Livewire\Website\ProductsPage;
use App\Livewire\Website\ProjectDetailPage;
use App\Livewire\Website\ProjectsPage;
use App\Livewire\Website\QuotePage;
use App\Livewire\Website\QuoteThankYou;
use App\Livewire\Website\ServiceDetailPage;
use App\Livewire\Website\ServicesPage;
use App\Livewire\Website\TeamPage;
use App\Livewire\Website\TestimonialsPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;


/*
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================
// UTILITY ROUTES
// ============================================
Route::get('/config-clear', function () {
    Artisan::call('config:clear');
    Artisan::call('storage:link');
    Artisan::call('schedule:run');
    return '<h1>Configurations cleared</h1>';
});

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    return '<h1>Cache cleared</h1>';
});

Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return '<h1>Configurations cache cleared</h1>';
});

// ============================================
// STATIC PAGES (Fixed slugs - MUST be before dynamic routes)
// ============================================
Route::get('/', HomePage::class)->name('home.index');
Route::get('/about-us', AboutPage::class)->name('home.about');
Route::get('/faq', FaqPage::class)->name('home.faq');
Route::get('/contact-us', ContactPage::class)->name('home.contact');
Route::get('/get-quote', QuotePage::class)->name('quote.index');
Route::get('/quote-thank-you/{id?}/{name?}', QuoteThankYou::class)->name('quote.thank-you');

Route::get('/services', ServicesPage::class)->name('home.services');
Route::get('/service-detail', ServiceDetailPage::class)->name('service.detail');
Route::get('/service-detail/{name}', ServiceDetailPage::class)->name('service.detail.name');

Route::get('/projects', ProjectsPage::class)->name('projects');
Route::get('/project/{slug}', ProjectDetailPage::class)->name('project.detail');
Route::get('/products', ProductsPage::class)->name('products');
Route::get('/product/{slug}', ProductDetailPage::class)->name('product.detail');
Route::get('/gallery', GalleryPage::class)->name('gallery');
Route::get('/team', TeamPage::class)->name('team');
Route::get('/testimonials', TestimonialsPage::class)->name('testimonials');

Route::get('/blog', BlogPage::class)->name('blog.index');
Route::get('/blog/{slug}', BlogDetailPage::class)->name('blog.detail');
Route::get('/blog/category/{category}', BlogPage::class)->name('blog.category');
Route::get('/blog/tag/{tag}', BlogPage::class)->name('blog.tag');









// ============================================
// DYNAMIC ROUTES (Catch-all - MUST be at the END)
// ============================================

// City + Service: /lahore/rcc-core-cutting
Route::get('/{city}/{service}', CityServicePage::class)
    ->name('city.service')
    ->where('city', '[a-z0-9-]+')
    ->where('service', '[a-z0-9-]+');

// City Only: /lahore
Route::get('/{city}', CityPage::class)
    ->name('city')
    ->where('city', '^(?!about-us|faq|contact-us|services|get-quote|login|register|admin|storage|api|products|gallery|team|projects|sitemap\.xml$)[a-z0-9-]+');




require __DIR__.'/auth.php';

    Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/', Dashboard::class)->name('dashboard.index');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    
    // // Sliders CRUD
    // Route::prefix('sliders')->name('sliders.')->group(function () {
    //     Route::get('/', SliderList::class)->name('index');
    //     Route::get('/create', SliderCreate::class)->name('create');
    //     Route::get('/{slider}/edit', SliderEdit::class)->name('edit');
    //     Route::get('/{slider}', SliderEdit::class)->name('show');
    // });
    
    // // Services CRUD
    // Route::prefix('services')->name('services.')->group(function () {
    //     Route::get('/', ServiceList::class)->name('index');
    //     Route::get('/create', ServiceCreate::class)->name('create');
    //     Route::get('/{service}/edit', ServiceEdit::class)->name('edit');
    //     Route::get('/details', ServiceList::class)->name('details');
    //     Route::get('/advantages', ServiceList::class)->name('advantages');
    // });
    
    // // Projects CRUD
    // Route::prefix('projects')->name('projects.')->group(function () {
    //     Route::get('/', ProjectList::class)->name('index');
    //     Route::get('/create', ProjectCreate::class)->name('create');
    //     Route::get('/{project}/edit', ProjectEdit::class)->name('edit');
    //     Route::get('/categories', ProjectList::class)->name('categories');
    // });
    
    // // Products CRUD
    // Route::prefix('products')->name('products.')->group(function () {
    //     Route::get('/', ProductList::class)->name('index');
    //     Route::get('/create', ProductCreate::class)->name('create');
    //     Route::get('/{product}/edit', ProductEdit::class)->name('edit');
    //     Route::get('/categories', ProductList::class)->name('categories');
    // });
    
    // // Blog CRUD
    // Route::prefix('blog')->name('blog.')->group(function () {
    //     // Posts
    //     Route::get('/posts', PostList::class)->name('posts.index');
    //     Route::get('/posts/create', PostCreate::class)->name('posts.create');
    //     Route::get('/posts/{post}/edit', PostEdit::class)->name('posts.edit');
        
    //     // Categories
    //     Route::get('/categories', CategoryList::class)->name('categories.index');
        
    //     // Tags
    //     Route::get('/tags', TagList::class)->name('tags.index');
        
    //     // Comments
    //     Route::get('/comments', PostList::class)->name('comments.index');
    // });
    
    // // Contacts
    // Route::prefix('contacts')->name('contacts.')->group(function () {
    //     Route::get('/messages', MessageList::class)->name('messages');
    // });
    
    // // Quote Requests
    // Route::get('/quotes', MessageList::class)->name('quotes.index');
    
    // // Newsletter
    // Route::get('/newsletter', MessageList::class)->name('newsletter.index');
    
    // // Team CRUD
    // Route::prefix('team')->name('team.')->group(function () {
    //     Route::get('/', TeamList::class)->name('index');
    //     Route::get('/create', TeamCreate::class)->name('create');
    //     Route::get('/{member}/edit', TeamCreate::class)->name('edit');
    // });
    
    // // Testimonials CRUD
    // Route::prefix('testimonials')->name('testimonials.')->group(function () {
    //     Route::get('/', TestimonialList::class)->name('index');
    //     Route::get('/create', TestimonialCreate::class)->name('create');
    //     Route::get('/{testimonial}/edit', TestimonialCreate::class)->name('edit');
    // });
    
    // // FAQ CRUD
    // Route::prefix('faq')->name('faq.')->group(function () {
    //     Route::get('/', FaqList::class)->name('index');
    //     Route::get('/create', FaqCreate::class)->name('create');
    //     Route::get('/{faq}/edit', FaqCreate::class)->name('edit');
    // });
    
    // // Pages CRUD
    // Route::prefix('pages')->name('pages.')->group(function () {
    //     Route::get('/', PageList::class)->name('index');
    //     Route::get('/create', PageCreate::class)->name('create');
    //     Route::get('/{page}/edit', PageCreate::class)->name('edit');
    //     Route::get('/about', AboutPage::class)->name('about');
    // });
    
    // Work Gallery
    Route::get('/gallery', Dashboard::class)->name('gallery.index');
    
    // Cities SEO
    Route::get('/cities', Dashboard::class)->name('cities.index');
    
    // PDF Uploads
    Route::get('/pdfs', Dashboard::class)->name('pdfs.index');
    
    // // Users Management
    // Route::prefix('users')->name('users.')->group(function () {
    //     Route::get('/', UserList::class)->name('index');
    //     Route::get('/create', UserCreate::class)->name('create');
    //     Route::get('/{user}/edit', UserEdit::class)->name('edit');
    // });
    
    // // SEO Management
    // Route::get('/seo', SeoManager::class)->name('seo.index');
    
    // // Settings
    // Route::get('/settings', GeneralSettings::class)->name('settings.index');
    // Route::get('/profile', GeneralSettings::class)->name('profile');
    
});




// // ============================================
// // WEBSITE ROUTES
// // ============================================

// // Home & Basic Pages
// Route::get('/', [WebsiteHomeController::class, 'index'])->name('home');
// Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

// // FAQ
// Route::get('/faq', [WebsiteHomeController::class, 'faq'])->name('faq');

// // About Us
// Route::get('/about-us', [WebsiteHomeController::class, 'aboutus'])->name('about');

// // Services
// Route::get('/service', [WebsiteHomeController::class, 'service'])->name('service');
// Route::get('/services', [WebsiteHomeController::class, 'service'])->name('services');
// Route::get('/service-detail', [WebsiteHomeController::class, 'service_detail'])->name('service.detail');
// Route::get('/service-detail/{name}', [WebsiteHomeController::class, 'service_detail_name'])->name('service.detail.name');

// // Contact
// Route::get('/contact-us', [WebsiteHomeController::class, 'contact_us'])->name('contact');
// Route::post('/contact-us/submit', [WebsiteHomeController::class, 'contact_submit'])->name('contact.submit');

// // Team
// Route::get('/team', [WebsiteHomeController::class, 'team'])->name('team');

// // Gallery
// Route::get('/gallery', [WebsiteHomeController::class, 'gallery'])->name('gallery');

// // Products
// Route::get('/products/{pc_name?}', [WebsiteHomeController::class, 'products'])->name('products');

// // Sitemap
// Route::get('/sitemap.xml', [WebsiteHomeController::class, 'sitemap'])->name('sitemap');

// // ============================================
// // LOCATION-BASED SERVICE PAGES
// // ============================================
// Route::prefix('locations')->name('location.')->group(function () {
//     Route::get('/', [LocationController::class, 'index'])->name('index');
//     Route::get('/{city}', [LocationController::class, 'city'])->name('city');
//     Route::get('/{city}/{service}', [LocationController::class, 'cityService'])->name('city.service');
// });

// // Direct City Service Pages (SEO Friendly)
// Route::get('/concrete-cutting-{city}', [LocationController::class, 'concreteCutting'])
//     ->where('city', 'lahore|islamabad|karachi|rawalpindi|peshawar')
//     ->name('location.concrete');

// Route::get('/core-cutting-{city}', [LocationController::class, 'coreCutting'])
//     ->where('city', 'lahore|islamabad|karachi|rawalpindi|peshawar')
//     ->name('location.core');

// Route::get('/wall-sawing-{city}', [LocationController::class, 'wallSawing'])
//     ->where('city', 'lahore|islamabad|karachi|rawalpindi|peshawar')
//     ->name('location.wall');

// Route::get('/wire-sawing-{city}', [LocationController::class, 'wireSawing'])
//     ->where('city', 'lahore|islamabad|karachi|rawalpindi|peshawar')
//     ->name('location.wire');

// Route::get('/floor-sawing-{city}', [LocationController::class, 'floorSawing'])
//     ->where('city', 'lahore|islamabad|karachi|rawalpindi|peshawar')
//     ->name('location.floor');

// // ============================================
// // LEGAL & POLICY PAGES
// // ============================================
// Route::prefix('legal')->name('legal.')->group(function () {
//     Route::get('/privacy-policy', [LegalController::class, 'privacy'])->name('privacy');
//     Route::get('/terms-conditions', [LegalController::class, 'terms'])->name('terms');
//     Route::get('/return-policy', [LegalController::class, 'returnPolicy'])->name('return');
//     Route::get('/refund-policy', [LegalController::class, 'refund'])->name('refund');
//     Route::get('/shipping-policy', [LegalController::class, 'shipping'])->name('shipping');
//     Route::get('/payment-policy', [LegalController::class, 'payment'])->name('payment');
//     Route::get('/disclaimer', [LegalController::class, 'disclaimer'])->name('disclaimer');
//     Route::get('/cookie-policy', [LegalController::class, 'cookies'])->name('cookies');
//     Route::get('/cancellation-policy', [LegalController::class, 'cancellation'])->name('cancellation');
//     Route::get('/warranty-policy', [LegalController::class, 'warranty'])->name('warranty');
// });

// // ============================================
// // BLOG ROUTES
// // ============================================
// Route::prefix('blog')->name('blog.')->group(function () {
//     Route::get('/', [BlogController::class, 'index'])->name('index');
//     Route::get('/category/{slug}', [BlogController::class, 'category'])->name('category');
//     Route::get('/tag/{slug}', [BlogController::class, 'tag'])->name('tag');
//     Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
//     Route::get('/search', [BlogController::class, 'search'])->name('search');
// });

// // ============================================
// // SERVICE AREA PAGES
// // ============================================
// Route::prefix('service-areas')->name('area.')->group(function () {
//     Route::get('/', [AreaController::class, 'index'])->name('index');
//     Route::get('/{city}', [AreaController::class, 'city'])->name('city');
//     Route::get('/{city}/{area}', [AreaController::class, 'area'])->name('area');
// });

// // ============================================
// // PROJECT PORTFOLIO ROUTES
// // ============================================
// Route::prefix('portfolio')->name('portfolio.')->group(function () {
//     Route::get('/', [PortfolioController::class, 'index'])->name('index');
//     Route::get('/category/{slug}', [PortfolioController::class, 'category'])->name('category');
//     Route::get('/{slug}', [PortfolioController::class, 'show'])->name('show');
//     Route::get('/city/{city}', [PortfolioController::class, 'cityProjects'])->name('city');
// });

// // ============================================
// // RESOURCES PAGES
// // ============================================
// Route::prefix('resources')->name('resources.')->group(function () {
//     Route::get('/', [ResourceController::class, 'index'])->name('index');
//     Route::get('/case-studies', [ResourceController::class, 'caseStudies'])->name('case-studies');
//     Route::get('/case-studies/{slug}', [ResourceController::class, 'caseStudyDetail'])->name('case-study.detail');
//     Route::get('/downloads', [ResourceController::class, 'downloads'])->name('downloads');
//     Route::get('/videos', [ResourceController::class, 'videos'])->name('videos');
//     Route::get('/testimonials', [ResourceController::class, 'testimonials'])->name('testimonials');
// });

// // ============================================
// // CAREERS ROUTES
// // ============================================
// Route::prefix('careers')->name('careers.')->group(function () {
//     Route::get('/', [CareerController::class, 'index'])->name('index');
//     Route::get('/{slug}', [CareerController::class, 'show'])->name('show');
//     Route::post('/apply', [CareerController::class, 'apply'])->name('apply');
// });

// // ============================================
// // QUOTE & ESTIMATION ROUTES
// // ============================================
// Route::prefix('quote')->name('quote.')->group(function () {
//     Route::get('/', [QuoteController::class, 'index'])->name('index');
//     Route::post('/calculate', [QuoteController::class, 'calculate'])->name('calculate');
//     Route::post('/request', [QuoteController::class, 'request'])->name('request');
// });

// // ============================================
// // EMERGENCY SERVICES
// // ============================================
// Route::get('/emergency-services', [EmergencyController::class, 'index'])->name('emergency');
// Route::get('/emergency-services/{city}', [EmergencyController::class, 'cityEmergency'])->name('emergency.city');

// // ============================================
// // COMPARISON & GUIDE PAGES
// // ============================================
// Route::prefix('guide')->name('guide.')->group(function () {
//     Route::get('/concrete-cutting-types', [GuideController::class, 'cuttingTypes'])->name('cutting-types');
//     Route::get('/diamond-vs-traditional', [GuideController::class, 'diamondVsTraditional'])->name('diamond-vs-traditional');
//     Route::get('/choosing-contractor', [GuideController::class, 'choosingContractor'])->name('choosing-contractor');
//     Route::get('/safety-standards', [GuideController::class, 'safetyStandards'])->name('safety');
//     Route::get('/cost-guide', [GuideController::class, 'costGuide'])->name('cost');
// });

// // ============================================
// // NEWSLETTER
// // ============================================
// Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
// Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// // ============================================
// // SEARCH
// // ============================================
// Route::get('/search', [SearchController::class, 'index'])->name('search');

// // ============================================
// // DYNAMIC PAGES
// // ============================================
// Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');

// // ============================================
// // AUTHENTICATION ROUTES
// // ============================================
// Route::get('/superAdmin', [LoginController::class, 'showLoginForms'])->name('login.form');
// Auth::routes();

// // ============================================
// // ADMIN ROUTES
// // ============================================
// Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    
//     // Dashboard
//     Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
//     // FAQ Management
//     Route::prefix('faq')->name('faq.')->group(function () {
//         Route::get('/', [AdminController::class, 'faq'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_faq'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_faq'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_faq'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_faq'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_faq'])->name('delete');
//     });
    
//     // Contact Us Management
//     Route::prefix('contactus')->name('contactus.')->group(function () {
//         Route::get('/', [AdminController::class, 'contactus'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_contact'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_contact'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_contact'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_contact'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_contact'])->name('delete');
//     });
    
//     // Contact Address
//     Route::prefix('contact-addr')->name('contact_addr.')->group(function () {
//         Route::get('/', [AdminController::class, 'contact_addr'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_contact_addr'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_contact_addr'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_contact_addr'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_contact_addr'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_contact_addr'])->name('delete');
//     });
    
//     // About Us
//     Route::prefix('aboutus')->name('aboutus.')->group(function () {
//         Route::get('/', [AdminController::class, 'aboutus'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_about'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_about'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_about'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_about'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_about'])->name('delete');
//     });
    
//     // Slider
//     Route::prefix('slider')->name('slider.')->group(function () {
//         Route::get('/', [AdminController::class, 'slider'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_s'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_s'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_s'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_s'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_s'])->name('delete');
//     });
    
//     // Company
//     Route::prefix('company')->name('company.')->group(function () {
//         Route::get('/', [AdminController::class, 'company'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_company'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_company'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_company'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_company'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_company'])->name('delete');
//     });
    
//     // Service
//     Route::prefix('service')->name('service.')->group(function () {
//         Route::get('/', [AdminController::class, 'service'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_service'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_service'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_service'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_service'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_service'])->name('delete');
//     });
    
//     // Service Detail
//     Route::prefix('service-detail')->name('service_d.')->group(function () {
//         Route::get('/', [AdminController::class, 'service_d'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_service_d'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_service_d'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_service_d'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_service_d'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_service_d'])->name('delete');
//     });
    
//     // Project
//     Route::prefix('project')->name('project.')->group(function () {
//         Route::get('/', [AdminController::class, 'project'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_project'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_project'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_project'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_project'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_project'])->name('delete');
//     });
    
//     // Project Category
//     Route::prefix('project-category')->name('project_category.')->group(function () {
//         Route::get('/', [AdminController::class, 'project_category'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_project_category'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_project_category'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_project_category'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_project_category'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_project_category'])->name('delete');
//     });
    
//     // Gallery
//     Route::prefix('gallery')->name('gallery.')->group(function () {
//         Route::get('/', [AdminController::class, 'gallery'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_gallery'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_gallery'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_gallery'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_gallery'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_gallery'])->name('delete');
//     });
    
//     // Team
//     Route::prefix('team')->name('team.')->group(function () {
//         Route::get('/', [AdminController::class, 'team'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_team'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_team'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_team'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_team'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_team'])->name('delete');
//     });
    
//     // SEO
//     Route::prefix('seo')->name('seo.')->group(function () {
//         Route::get('/', [AdminController::class, 'seo'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_seo'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_seo'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_seo'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_seo'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_seo'])->name('delete');
//     });
    
//     // Service Advantage
//     Route::prefix('as')->name('as.')->group(function () {
//         Route::get('/', [AdminController::class, 'as'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_as'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_as'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_as'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_as'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_as'])->name('delete');
//     });
    
//     // PDF Files
//     Route::prefix('pdffile')->name('pdf.')->group(function () {
//         Route::get('/', [AdminController::class, 'pdfile'])->name('index');
//         Route::get('/add', [AdminController::class, 'add_pdf'])->name('add');
//         Route::post('/store', [AdminController::class, 'store_pdf'])->name('store');
//         Route::get('/edit/{id}', [AdminController::class, 'edit_pdf'])->name('edit');
//         Route::post('/update/{id}', [AdminController::class, 'update_pdf'])->name('update');
//         Route::get('/delete/{id}', [AdminController::class, 'delete_pdf'])->name('delete');
//     });
    
//     // Product Management
//     Route::prefix('product')->name('product.')->group(function () {
//         Route::get('/', [ProductController::class, 'product'])->name('index');
//         Route::get('/add', [ProductController::class, 'add_product'])->name('add');
//         Route::post('/store', [ProductController::class, 'store_product'])->name('store');
//         Route::get('/edit/{id}', [ProductController::class, 'edit_product'])->name('edit');
//         Route::post('/update/{id}', [ProductController::class, 'update_product'])->name('update');
//         Route::get('/delete/{id}', [ProductController::class, 'delete_product'])->name('delete');
//     });
    
//     // Product Category
//     Route::prefix('product-category')->name('product_category.')->group(function () {
//         Route::get('/', [ProductController::class, 'product_category'])->name('index');
//         Route::get('/add', [ProductController::class, 'add_product_category'])->name('add');
//         Route::post('/store', [ProductController::class, 'store_product_category'])->name('store');
//         Route::get('/edit/{id}', [ProductController::class, 'edit_product_category'])->name('edit');
//         Route::post('/update/{id}', [ProductController::class, 'update_product_category'])->name('update');
//         Route::get('/delete/{id}', [ProductController::class, 'delete_product_category'])->name('delete');
//     });
    
//     // Settings
//     Route::resource('settings', SettingController::class);
    
//     // Blog Management
//     Route::prefix('blog')->name('blog.')->group(function () {
//         Route::get('/', [AdminBlogController::class, 'index'])->name('index');
//         Route::get('/add', [AdminBlogController::class, 'create'])->name('create');
//         Route::post('/store', [AdminBlogController::class, 'store'])->name('store');
//         Route::get('/edit/{id}', [AdminBlogController::class, 'edit'])->name('edit');
//         Route::post('/update/{id}', [AdminBlogController::class, 'update'])->name('update');
//         Route::get('/delete/{id}', [AdminBlogController::class, 'delete'])->name('delete');
//         Route::get('/categories', [AdminBlogController::class, 'categories'])->name('categories');
//         Route::post('/categories/store', [AdminBlogController::class, 'storeCategory'])->name('category.store');
//     });
    
//     // Location Pages Management
//     Route::prefix('locations')->name('locations.')->group(function () {
//         Route::get('/', [AdminLocationController::class, 'index'])->name('index');
//         Route::get('/add', [AdminLocationController::class, 'create'])->name('create');
//         Route::post('/store', [AdminLocationController::class, 'store'])->name('store');
//         Route::get('/edit/{id}', [AdminLocationController::class, 'edit'])->name('edit');
//         Route::post('/update/{id}', [AdminLocationController::class, 'update'])->name('update');
//         Route::get('/delete/{id}', [AdminLocationController::class, 'delete'])->name('delete');
//     });
    
//     // Legal Pages Management
//     Route::prefix('legal')->name('legal.')->group(function () {
//         Route::get('/', [AdminLegalController::class, 'index'])->name('index');
//         Route::get('/edit/{slug}', [AdminLegalController::class, 'edit'])->name('edit');
//         Route::post('/update/{slug}', [AdminLegalController::class, 'update'])->name('update');
//     });
    
//     // Clear Cache
//     Route::get('/clear-cache', function () {
//         Artisan::call('cache:clear');
//         Artisan::call('config:clear');
//         return '<h1>Configurations cleared</h1>';
//     })->name('clear-cache');
// });