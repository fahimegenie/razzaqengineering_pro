<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Slider;
use App\Models\Service;
use App\Models\Project;
use App\Models\SeoData;
use App\Models\Company;
use App\Models\ServiceDetail;
use App\Models\ProductCategory;

#[Layout('components.layouts.app-layout')]
#[Title('Home - Razzaq Engineering Services')]
class HomePage extends Component
{
    public function render()
    {
        $slider = Slider::active()->ordered()->get();
        $services = Service::active()->ordered()->get();
        $seo = SeoData::where('seo_page_type', 'Home')->first();
        $com = Company::active()->first();
        $os = Service::active()->get();
        $sd = ServiceDetail::with('service')->get();
        $pro = Project::active()->latest()->get();
        $pc = ProductCategory::active()->get();
        
        return view('livewire.website.home-page', compact(
            'slider', 'services', 'seo', 'com', 'os', 'sd', 'pro', 'pc'
        ));
    }
}