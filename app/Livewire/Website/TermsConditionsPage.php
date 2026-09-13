<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Setting;
use App\Models\SeoData;
use App\Models\Service;
use App\Models\ProductCategory;
use App\Traits\HasDynamicSEO;

#[Layout('components.layouts.app-layout', ['seo' => []])]
#[Title('Terms & Conditions - Razzaq Engineering Services')]
class TermsConditionsPage extends Component
{
    use HasDynamicSEO;
    
    public $settings;
    public $services = [];
    public $pc = [];
    public $isLoading = true;
    public $lastUpdated;

    public function mount()
    {
        $this->initializeSEO('terms_conditions');
        $this->settings = Setting::getCached();
        $this->services = Service::active()->ordered()->get();
        $this->pc = ProductCategory::active()->select('pc_name')->get();
        $this->lastUpdated = $this->settings->terms_updated_at ?? now()->subYear()->format('M d, Y');
        $this->isLoading = false;
    }

    public function render()
    {
        $seo = $this->getSeoData();
        return view('livewire.website.terms-conditions-page', [
            'lastUpdated' => $this->lastUpdated,
        ])->layoutData(['seo' => $seo]);
    }
}