<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\Models\OurService;
use App\Models\ProjectCategory;
use App\Models\ProductCategory;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Share settings with all views
        View::composer('*', function ($view) {
            $settings = Setting::getCached();
            $view->with('settings', $settings);
        });
        
        // Share navigation data with layouts
        View::composer(['components.layouts.partials.header', 'components.layouts.partials.footer'], function ($view) {
            $view->with([
                'navServices' => OurService::active()->ordered()->get(),
                'navCategories' => ProjectCategory::active()->get(),
                'navProducts' => ProductCategory::active()->get(),
            ]);
        });
    }
}