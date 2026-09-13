<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Slider;
use App\Models\Service;
use App\Models\Project;
use App\Models\Company;
use App\Models\ServiceDetail;
use App\Models\ProductCategory;
use App\Models\FleetCategory;
use App\Models\FleetItem;
use App\Traits\HasDynamicSEO;

#[Layout('components.layouts.app-layout', ['seo' => []])] 
class HomePage extends Component
{
    use HasDynamicSEO;

    public function mount()
    {
        $this->initializeSEO('home');
    }

    public function render()
    {
        $slider = Slider::active()->ordered()->get();
        $services = Service::active()->ordered()->get();
        $com = Company::active()->first();
        $os = Service::active()->get();
        $sd = ServiceDetail::with('service')->get();
        $pro = Project::active()->latest()->get();
        $pc = ProductCategory::active()->get();
        
        // Fleet Data - Dynamic
        $fleetCategories = FleetCategory::active()->ordered()->with(['activeFleetItems' => function($query) {
            $query->ordered();
        }])->get();
        
        // Get all featured fleet items for the slider
        $fleetItems = FleetItem::active()
            ->with(['category'])
            ->ordered()
            ->get();
        
        $seo = $this->getSeoData();
        
        return view('livewire.website.home-page', compact(
            'slider', 'services', 'seo', 'com', 'os', 'sd', 'pro', 'pc',
            'fleetCategories', 'fleetItems'
        ))->layoutData(['seo' => $seo]);
    }
}