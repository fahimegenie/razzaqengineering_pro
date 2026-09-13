<?php

use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Website\SitemapController;
use App\Livewire\Admin\Blog\BlogCategoryForm;
use App\Livewire\Admin\Blog\BlogCategoryList;
use App\Livewire\Admin\Blog\BlogCommentList;
use App\Livewire\Admin\Blog\BlogPostForm;
use App\Livewire\Admin\Blog\BlogPostList;
use App\Livewire\Admin\Blog\BlogTagForm;
use App\Livewire\Admin\Blog\BlogTagList;
use App\Livewire\Admin\ClearCache;
use App\Livewire\Admin\Contact\ContactMessageForm;
use App\Livewire\Admin\Contact\ContactMessageList;
use App\Livewire\Admin\Dashboard\Dashboard;
use App\Livewire\Admin\FAQ\FaqForm;
use App\Livewire\Admin\FAQ\FaqList;
use App\Livewire\Admin\Fleet\FleetManager;
use App\Livewire\Admin\Gallery\GalleryForm;
use App\Livewire\Admin\Gallery\GalleryList;
use App\Livewire\Admin\OurCompany\OurCompanyManager;
use App\Livewire\Admin\Products\ProductCategoryForm;
use App\Livewire\Admin\Products\ProductCategoryList;
use App\Livewire\Admin\Products\ProductForm;
use App\Livewire\Admin\Products\ProductList;
use App\Livewire\Admin\Projects\ProjectCategoryForm;
use App\Livewire\Admin\Projects\ProjectCategoryList;
use App\Livewire\Admin\Projects\ProjectForm;
use App\Livewire\Admin\Projects\ProjectList;
use App\Livewire\Admin\Quote\QuoteRequestForm;
use App\Livewire\Admin\Quote\QuoteRequestList;
use App\Livewire\Admin\SEO\DynamicSeoGenerator;
use App\Livewire\Admin\SEO\SeoDataForm;
use App\Livewire\Admin\SEO\SeoDataList;
use App\Livewire\Admin\Services\ServiceAdvantageForm;
use App\Livewire\Admin\Services\ServiceAdvantageList;
use App\Livewire\Admin\Services\ServiceDetailForm;
use App\Livewire\Admin\Services\ServiceDetailList;
use App\Livewire\Admin\Services\ServiceForm;
use App\Livewire\Admin\Services\ServiceList;
use App\Livewire\Admin\Settings\AboutUsSettings;
use App\Livewire\Admin\Settings\ContactUsSettings;
use App\Livewire\Admin\Settings\GeneralSettings;
use App\Livewire\Admin\Slider\SliderForm;
use App\Livewire\Admin\Slider\SliderList;
use App\Livewire\Admin\Team\TeamForm;
use App\Livewire\Admin\Team\TeamList;
use App\Livewire\Admin\Testimonial\TestimonialForm;
use App\Livewire\Admin\Testimonial\TestimonialList;
use App\Livewire\Website\AboutPage;
use App\Livewire\Website\BlogDetailPage;
use App\Livewire\Website\BlogPage;
use App\Livewire\Website\CareersPage;
use App\Livewire\Website\CareerDetailPage;
use App\Livewire\Website\CareerApplyPage;
use App\Livewire\Website\CityPage;
use App\Livewire\Website\CityServicePage;
use App\Livewire\Website\ContactPage;
use App\Livewire\Website\FaqPage;
use App\Livewire\Website\FleetPage;
use App\Livewire\Website\FleetDetailPage;
use App\Livewire\Website\GalleryPage;
use App\Livewire\Website\HomePage;
use App\Livewire\Website\PrivacyPolicyPage;
use App\Livewire\Website\ProductDetailPage;
use App\Livewire\Website\ProductsPage;
use App\Livewire\Website\ProjectDetailPage;
use App\Livewire\Website\ProjectsPage;
use App\Livewire\Website\QuotePage;
use App\Livewire\Website\QuoteThankYou;
use App\Livewire\Website\RefundPolicyPage;
use App\Livewire\Website\ServiceDetailPage;
use App\Livewire\Website\ServicesPage;
use App\Livewire\Website\TeamPage;
use App\Livewire\Website\TermsConditionsPage;
use App\Livewire\Website\TestimonialsPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================
// SECTION 1: UTILITY ROUTES
// ============================================
Route::prefix('utility')->group(function () {
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
});

// Backward compatibility
Route::get('/config-clear', fn() => redirect('/utility/config-clear'));
Route::get('/cache-clear', fn() => redirect('/utility/cache-clear'));
Route::get('/config-cache', fn() => redirect('/utility/config-cache'));

// ============================================
// SECTION 2: PUBLIC ROUTES (All Website Pages)
// ============================================

// --- Home ---
Route::get('/', HomePage::class)->name('home.index');

// --- About ---
Route::get('/about-us', AboutPage::class)->name('home.about');

// --- FAQ ---
Route::get('/faq', FaqPage::class)->name('home.faq');

// --- Contact ---
Route::get('/contact-us', ContactPage::class)->name('home.contact');

// --- Quote System ---
Route::get('/get-quote', QuotePage::class)->name('quote.index');
Route::get('/quote-thank-you/{id?}/{name?}', QuoteThankYou::class)->name('quote.thank-you');

// --- Services ---
Route::get('/services', ServicesPage::class)->name('home.services');
Route::get('/service-detail/{name}', ServiceDetailPage::class)->name('service.detail.name');
Route::get('/services/{slug}', ServiceDetailPage::class)->name('service.detail.slug');

// --- Projects ---
Route::get('/projects', ProjectsPage::class)->name('projects');
Route::get('/project/{slug}', ProjectDetailPage::class)->name('project.detail');

// --- Products ---
Route::get('/products', ProductsPage::class)->name('products');
Route::get('/products/{pc_slug}', ProductsPage::class)->name('products.category');
Route::get('/product/{slug}', ProductDetailPage::class)->name('product.detail');

// --- Gallery ---
Route::get('/gallery', GalleryPage::class)->name('gallery');

// --- Team ---
Route::get('/team', TeamPage::class)->name('team');

// --- Testimonials ---
Route::get('/testimonials', TestimonialsPage::class)->name('testimonials');

// --- Blog ---
Route::get('/blog', BlogPage::class)->name('blog.index');
Route::get('/blog/{slug}', BlogDetailPage::class)->name('blog.detail');
Route::get('/blog/category/{category}', BlogPage::class)->name('blog.category');
Route::get('/blog/tag/{tag}', BlogPage::class)->name('blog.tag');

// --- Fleet ---
Route::get('/our-fleet', FleetPage::class)->name('public.fleet');
Route::get('/our-fleet/{slug}', FleetDetailPage::class)->name('fleet.detail');

// --- Careers ---
Route::get('/careers', CareersPage::class)->name('careers');
Route::get('/careers/{slug}', CareerDetailPage::class)->name('careers.detail');
Route::get('/careers/apply/{slug}', CareerApplyPage::class)->name('careers.apply');

// --- Sitemap System (MUST be before dynamic routes) ---
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/sitemap-index.xml', [SitemapController::class, 'sitemapIndex'])->name('sitemap.index');
Route::get('/sitemap-cities.xml', [SitemapController::class, 'cities'])->name('sitemap.cities');
Route::get('/sitemap-services.xml', [SitemapController::class, 'services'])->name('sitemap.services');
Route::get('/sitemap-projects.xml', [SitemapController::class, 'projects'])->name('sitemap.projects');
Route::get('/sitemap-products.xml', [SitemapController::class, 'products'])->name('sitemap.products');
Route::get('/sitemap-blogs.xml', [SitemapController::class, 'blogs'])->name('sitemap.blogs');
Route::get('/sitemap-careers.xml', [SitemapController::class, 'careers'])->name('sitemap.careers');
Route::get('/sitemap-main.xml', [SitemapController::class, 'index'])->name('sitemap.main');

// --- Privacy & Legal Pages ---
Route::get('/privacy-policy', PrivacyPolicyPage::class)->name('privacy-policy');
Route::get('/terms-conditions', TermsConditionsPage::class)->name('terms-conditions');
Route::get('/refund-policy', RefundPolicyPage::class)->name('refund-policy');

// ============================================
// SECTION 3: AUTHENTICATION ROUTES
// ============================================
require __DIR__.'/auth.php';

// ============================================
// SECTION 4: ADMIN ROUTES (Protected with AllowedEmails)
// ============================================
Route::middleware(['auth', 'allowed.emails'])->prefix('admin')->name('admin.')->group(function () {
    
    // --- File Upload ---
    Route::post('/upload/image', [UploadController::class, 'uploadImage'])->name('upload.image');

    // --- Dashboard ---
    Route::get('/', Dashboard::class)->name('dashboard.index');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // --- Logout ---
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login')->with('status', 'You have been logged out.');
    })->name('logout');

    Route::get('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login')->with('status', 'You have been logged out.');
    })->name('logout.get');

    // --- FAQ Management ---
    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/', FaqList::class)->name('index');
        Route::get('/create', FaqForm::class)->name('create');
        Route::get('/{faq}/edit', FaqForm::class)->name('edit');
    });

    // --- Sliders Management ---
    Route::prefix('sliders')->name('sliders.')->group(function () {
        Route::get('/', SliderList::class)->name('index');
        Route::get('/create', SliderForm::class)->name('create');
        Route::get('/{sliderId}/edit', SliderForm::class)->name('edit');
    });

    // --- Testimonials Management ---
    Route::prefix('testimonials')->name('testimonials.')->group(function () {
        Route::get('/', TestimonialList::class)->name('index');
        Route::get('/create', TestimonialForm::class)->name('create');
        Route::get('/{testimonialId}/edit', TestimonialForm::class)->name('edit');
    });

    // --- Team Management ---
    Route::prefix('team')->name('team.')->group(function () {
        Route::get('/', TeamList::class)->name('index');
        Route::get('/create', TeamForm::class)->name('create');
        Route::get('/{teamId}/edit', TeamForm::class)->name('edit');
    });

    // --- Gallery Management ---
    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/', GalleryList::class)->name('index');
        Route::get('/create', GalleryForm::class)->name('create');
        Route::get('/{galleryId}/edit', GalleryForm::class)->name('edit');
    });

    // --- Blog Management ---
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/categories', BlogCategoryList::class)->name('categories.index');
        Route::get('/categories/create', BlogCategoryForm::class)->name('categories.create');
        Route::get('/categories/{categoryId}/edit', BlogCategoryForm::class)->name('categories.edit');
        
        Route::get('/tags', BlogTagList::class)->name('tags.index');
        Route::get('/tags/create', BlogTagForm::class)->name('tags.create');
        Route::get('/tags/{tagId}/edit', BlogTagForm::class)->name('tags.edit');
        
        Route::get('/posts', BlogPostList::class)->name('posts.index');
        Route::get('/posts/create', BlogPostForm::class)->name('posts.create');
        Route::get('/posts/{postId}/edit', BlogPostForm::class)->name('posts.edit');
        
        Route::get('/comments', BlogCommentList::class)->name('comments.index');
    });

    // --- Products Management ---
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/categories', ProductCategoryList::class)->name('categories.index');
        Route::get('/categories/create', ProductCategoryForm::class)->name('categories.create');
        Route::get('/categories/{categoryId}/edit', ProductCategoryForm::class)->name('categories.edit');
        
        Route::get('/', ProductList::class)->name('index');
        Route::get('/create', ProductForm::class)->name('create');
        Route::get('/{productId}/edit', ProductForm::class)->name('edit');
    });

    // --- Projects Management ---
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/categories', ProjectCategoryList::class)->name('categories.index');
        Route::get('/categories/create', ProjectCategoryForm::class)->name('categories.create');
        Route::get('/categories/{categoryId}/edit', ProjectCategoryForm::class)->name('categories.edit');
        
        Route::get('/', ProjectList::class)->name('index');
        Route::get('/create', ProjectForm::class)->name('create');
        Route::get('/{projectId}/edit', ProjectForm::class)->name('edit');
    });

    // --- Services Management ---
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', ServiceList::class)->name('index');
        Route::get('/create', ServiceForm::class)->name('create');
        Route::get('/{serviceId}/edit', ServiceForm::class)->name('edit');
        
        Route::get('/details', ServiceDetailList::class)->name('details.index');
        Route::get('/details/create', ServiceDetailForm::class)->name('details.create');
        Route::get('/details/{detailId}/edit', ServiceDetailForm::class)->name('details.edit');
        
        Route::get('/advantages', ServiceAdvantageList::class)->name('advantages.index');
        Route::get('/advantages/create', ServiceAdvantageForm::class)->name('advantages.create');
        Route::get('/advantages/{advantageId}/edit', ServiceAdvantageForm::class)->name('advantages.edit');
    });

    // --- SEO Management ---
    Route::prefix('seo')->name('seo.')->group(function () {
        Route::get('/', SeoDataList::class)->name('index');
        Route::get('/create', SeoDataForm::class)->name('create');
        Route::get('/{seoId}/edit', SeoDataForm::class)->name('edit');
        Route::get('/generator', DynamicSeoGenerator::class)->name('generator');
    });

    // --- Quote Management ---
    Route::prefix('quotes')->name('quotes.')->group(function () {
        Route::get('/', QuoteRequestList::class)->name('index');
        Route::get('/create', QuoteRequestForm::class)->name('create');
        Route::get('/{quoteId}/edit', QuoteRequestForm::class)->name('edit');
    });

    // --- Contact Messages Management ---
    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', ContactMessageList::class)->name('index');
        Route::get('/create', ContactMessageForm::class)->name('create');
        Route::get('/{messageId}/edit', ContactMessageForm::class)->name('edit');
    });

    // --- Fleet Management ---
    Route::get('/fleet', FleetManager::class)->name('fleet.index');

    // --- Settings ---
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', GeneralSettings::class)->name('index');
        Route::get('/contact-us', ContactUsSettings::class)->name('contact-us');
        Route::get('/about-us', AboutUsSettings::class)->name('about-us');
    });

    // --- Our Companies ---
    Route::get('/our-companies', OurCompanyManager::class)->name('our-companies.index');

    // --- Cache Management ---
    Route::get('/clear-cache', ClearCache::class)->name('clear-cache');

    // --- City SEO Management ---
    Route::get('/cities', Dashboard::class)->name('cities.index');
    
    // --- PDF Management ---
    Route::get('/pdfs', Dashboard::class)->name('pdfs.index');
});

// ============================================
// SECTION 5: DYNAMIC CATCH-ALL ROUTES (MUST BE LAST)
// ============================================

// City + Service: /lahore/rcc-core-cutting
Route::get('/{city}/{service}', CityServicePage::class)
    ->name('city.service')
    ->where('city', '[a-z0-9-]+')
    ->where('service', '[a-z0-9-]+');

// City Only: /lahore
Route::get('/{city}', CityPage::class)
    ->name('city')
    ->where('city', '^(?!about-us|faq|contact-us|services|get-quote|service-detail|service|projects|project|products|product|gallery|team|testimonials|blog|our-fleet|careers|quote-thank-you|privacy-policy|terms-conditions|refund-policy|sitemap\.xml|sitemap-index\.xml|sitemap-cities\.xml|sitemap-services\.xml|sitemap-projects\.xml|sitemap-products\.xml|sitemap-blogs\.xml|sitemap-careers\.xml|sitemap-main\.xml|login|register|admin|storage|api|utility)[a-z0-9-]+');