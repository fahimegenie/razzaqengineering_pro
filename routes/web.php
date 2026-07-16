<?php

use App\Http\Controllers\Admin\UploadController;
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

// Public fleet section can be included in any page
Route::get('/our-fleet', function () {return view('pages.fleet');})->name('public.fleet');


require __DIR__.'/auth.php';

    Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
        Route::post('/upload/image', [UploadController::class, 'uploadImage'])->name('upload.image');
    
    // Dashboard
    Route::get('/', Dashboard::class)->name('dashboard.index');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // FAQ Management
    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/', FaqList::class)->name('index');
        Route::get('/create', FaqForm::class)->name('create');
        Route::get('/{faq}/edit', FaqForm::class)->name('edit');
    });

    Route::prefix('sliders')->name('sliders.')->group(function () {
        Route::get('/', SliderList::class)->name('index');
        Route::get('/create', SliderForm::class)->name('create');
        Route::get('/{sliderId}/edit', SliderForm::class)->name('edit');
    });

    Route::prefix('testimonials')->name('testimonials.')->group(function () {
        Route::get('/', TestimonialList::class)->name('index');
        Route::get('/create', TestimonialForm::class)->name('create');
        Route::get('/{testimonialId}/edit', TestimonialForm::class)->name('edit');
    });
    // Team Management Routes
    Route::prefix('team')->name('team.')->group(function () {
        Route::get('/', TeamList::class)->name('index');
        Route::get('/create', TeamForm::class)->name('create');
        Route::get('/{teamId}/edit', TeamForm::class)->name('edit');
    });

    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/', GalleryList::class)->name('index');
        Route::get('/create', GalleryForm::class)->name('create');
        Route::get('/{galleryId}/edit', GalleryForm::class)->name('edit');
    });

    // Blog Management Routes
    Route::prefix('blog')->name('blog.')->group(function () {
        
        // Categories
        Route::get('/categories', BlogCategoryList::class)->name('categories.index');
        Route::get('/categories/create', BlogCategoryForm::class)->name('categories.create');
        Route::get('/categories/{categoryId}/edit', BlogCategoryForm::class)->name('categories.edit');
        
        // Tags
        Route::get('/tags', BlogTagList::class)->name('tags.index');
        Route::get('/tags/create', BlogTagForm::class)->name('tags.create');
        Route::get('/tags/{tagId}/edit', BlogTagForm::class)->name('tags.edit');
        
        // Posts
        Route::get('/posts', BlogPostList::class)->name('posts.index');
        Route::get('/posts/create', BlogPostForm::class)->name('posts.create');
        Route::get('/posts/{postId}/edit', BlogPostForm::class)->name('posts.edit');
        Route::get('/comments', BlogCommentList::class)->name('comments.index');
    });

    Route::prefix('products')->name('products.')->group(function () {
        // Categories
        Route::get('/categories', ProductCategoryList::class)->name('categories.index');
        Route::get('/categories/create', ProductCategoryForm::class)->name('categories.create');
        Route::get('/categories/{categoryId}/edit', ProductCategoryForm::class)->name('categories.edit');
        
        // Products
        Route::get('/', ProductList::class)->name('index');
        Route::get('/create', ProductForm::class)->name('create');
        Route::get('/{productId}/edit', ProductForm::class)->name('edit');
    });

    Route::prefix('projects')->name('projects.')->group(function () {
        // Categories
        Route::get('/categories', ProjectCategoryList::class)->name('categories.index');
        Route::get('/categories/create', ProjectCategoryForm::class)->name('categories.create');
        Route::get('/categories/{categoryId}/edit', ProjectCategoryForm::class)->name('categories.edit');
        
        // Projects
        Route::get('/', ProjectList::class)->name('index');
        Route::get('/create', ProjectForm::class)->name('create');
        Route::get('/{projectId}/edit', ProjectForm::class)->name('edit');
    });

    Route::prefix('services')->name('services.')->group(function () {
        // Main Services
        Route::get('/', ServiceList::class)->name('index');
        Route::get('/create', ServiceForm::class)->name('create');
        Route::get('/{serviceId}/edit', ServiceForm::class)->name('edit');
        
        // Service Details
        Route::get('/details', ServiceDetailList::class)->name('details.index');
        Route::get('/details/create', ServiceDetailForm::class)->name('details.create');
        Route::get('/details/{detailId}/edit', ServiceDetailForm::class)->name('details.edit');
        
        // Service Advantages
        Route::get('/advantages', ServiceAdvantageList::class)->name('advantages.index');
        Route::get('/advantages/create', ServiceAdvantageForm::class)->name('advantages.create');
        Route::get('/advantages/{advantageId}/edit', ServiceAdvantageForm::class)->name('advantages.edit');
    });


    Route::prefix('seo')->name('seo.')->group(function () {
        Route::get('/', SeoDataList::class)->name('index');
        Route::get('/create', SeoDataForm::class)->name('create');
        Route::get('/{seoId}/edit', SeoDataForm::class)->name('edit');
        Route::get('/generator', DynamicSeoGenerator::class)->name('generator');
    });

    Route::prefix('quotes')->name('quotes.')->group(function () {
        Route::get('/', QuoteRequestList::class)->name('index');
        Route::get('/create', QuoteRequestForm::class)->name('create');
        Route::get('/{quoteId}/edit', QuoteRequestForm::class)->name('edit');
    });

    Route::get('clear-cache', ClearCache::class)->name('clear-cache');

    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', ContactMessageList::class)->name('index');
        Route::get('/create', ContactMessageForm::class)->name('create');
        Route::get('/{messageId}/edit', ContactMessageForm::class)->name('edit');
    });

    Route::get('/fleet', FleetManager::class)->name('fleet.index');

    
    // Cities SEO
    Route::get('/cities', Dashboard::class)->name('cities.index');
    
    // PDF Uploads
    Route::get('/pdfs', Dashboard::class)->name('pdfs.index');
    // // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', GeneralSettings::class)->name('index');
        Route::get('/contact-us', ContactUsSettings::class)->name('contact-us');
        Route::get('/about-us', AboutUsSettings::class)->name('about-us');
    });

     Route::get('/our-companies', OurCompanyManager::class)->name('our-companies.index');
    
});






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

