<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\ServiceAdvantage;
use App\Models\SeoData;
use App\Models\ProductCategory;
use App\Models\PdfFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

#[Layout('components.layouts.app-layout')]
class ServiceDetailPage extends Component
{
    public $serviceName = null;
    public $activeTab = null; // Yeh Hamesha Service Model ki ID hold karega
    
    // Properties ko template mein direct pass karenge taake state hydration maintain rahe
    public $isLoading = false;
    public $errorMessage = '';

    public function mount($name = null)
    {
        try {
            $this->serviceName = $name;
            
            // 1. Load active services
            $services = Service::active()->ordered()->get();
            
            if ($name) {
                $matchedService = $services->first(function ($s) use ($name) {
                    return Str::slug($s->os_name) === Str::slug($name);
                });
                
                if ($matchedService) {
                    $this->activeTab = $matchedService->id;
                }
            }
            
            if (!$this->activeTab && $services->isNotEmpty()) {
                $this->activeTab = $services->first()->id;
            }
            
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to initialize service details.';
            Log::error('ServiceDetail Mount error: ' . $e->getMessage());
        }
    }

    public function switchTab($serviceId)
    {
        $this->activeTab = $serviceId;
        // URL ko query string ya path se clean rakhne ke liye sirf state update kafi hai
    }

    /**
     * Computed properties ke zariye dynamic data fetch karna hydration ko perfect banata hai
     */
    #[Title('Service Details - Razzaq Engineering Services')]
    public function render()
    {
        $services = Service::active()->ordered()->get();
        
        // Dhyaan dein: service_id ya os_id foreign key check karein (Aapki DB field ke mutabiq name adjust kar sakte hain)
        $currentDetail = ServiceDetail::where('id', $this->activeTab)
            ->orWhere('os_id', $this->activeTab) 
            ->first();

        // Agar directly match na ho to fallback check lagayein
        if (!$currentDetail && $this->activeTab) {
            $currentDetail = ServiceDetail::where('id', $this->activeTab)->first();
        }

        $currentAdvantages = [];
        if ($currentDetail) {
            $currentAdvantages = ServiceAdvantage::where('sa_st_id', $currentDetail->id)
                ->orderBy('sort_order')
                ->get();
        }

        return view('livewire.website.service-detail-page', [
            'services' => $services,
            'currentDetail' => $currentDetail,
            'currentAdvantages' => $currentAdvantages,
            'pdffile' => PdfFile::active()->first(),
            'seo' => SeoData::where('seo_page_type', $this->serviceName ?? 'Service_detail')->first(),
            'pc' => ProductCategory::active()->select('pc_name')->get(),
        ]);
    }
}