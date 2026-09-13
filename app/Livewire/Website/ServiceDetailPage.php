<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\OurService;
use App\Models\ServiceDetail;
use App\Models\ServiceAdvantage;
use App\Models\SeoData;
use App\Models\ProductCategory;
use App\Models\PdfFile;
use App\Traits\HasDynamicSEO;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app-layout', ['seo' => []])]
class ServiceDetailPage extends Component
{
    use HasDynamicSEO;
    
    public $serviceName = null;
    public $activeServiceId = null;
    public $activeDetailId = null;
    
    public $isLoading = false;
    public $errorMessage = '';

    public function mount($slug = null)
    {
        try {
            $this->serviceName = $slug;
            $this->initializeSEO('service_detail', $slug);

            $service = OurService::where('os_slug', $slug)->first();

            if (!empty($service)) {
                $this->activeServiceId = $service->id;
            }
            $services = OurService::active()->ordered()->get();
            
            if ($services->isEmpty()) {
                $this->errorMessage = 'No services available at the moment.';
                return;
            }
            
          
            
            if (!$this->activeServiceId) {
                $this->activeServiceId = $services->first()->id;
            }
            
            $this->loadServiceDetail();
            
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load service details. Please try again.';
            Log::error('ServiceDetailPage Mount Error: ' . $e->getMessage(), [
                'service_name' => $slug,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function switchTab($serviceId)
    {
        try {
            $this->activeServiceId = $serviceId;
            $this->loadServiceDetail();
            $this->dispatch('tab-switched');
        } catch (\Exception $e) {
            Log::error('Tab Switch Error: ' . $e->getMessage());
        }
    }

    protected function loadServiceDetail()
    {
        if (!$this->activeServiceId) return;
        
        $detail = ServiceDetail::where('os_id', $this->activeServiceId)
            ->ordered()
            ->first();
        
        $this->activeDetailId = $detail ? $detail->id : null;
    }

    #[Title('Service Details - Razzaq Engineering Services')]
    public function render()
    {
        $services = OurService::active()->ordered()->get();
        $currentService = OurService::find($this->activeServiceId);
        $currentDetail = ServiceDetail::find($this->activeDetailId);
        
        $currentAdvantages = collect();
        if ($currentDetail) {
            $currentAdvantages = ServiceAdvantage::where('sa_st_id', $currentDetail->id)
                ->ordered()
                ->get();
        }
        
        $seo = $this->getSeoData();
        $pageSeo = SeoData::where('seo_page_type', 'service_detail')->first();
        $pdfFile = PdfFile::active()->first();
        $productCategories = ProductCategory::active()->select('pc_name')->get();
        
        return view('livewire.website.service-detail-page', [
            'services'           => $services,
            'currentService'     => $currentService,
            'currentDetail'      => $currentDetail,
            'currentAdvantages'  => $currentAdvantages,
            'pdfFile'            => $pdfFile,
            'pageSeo'            => $pageSeo,
            'productCategories'  => $productCategories,
        ])->layoutData(['seo' => $seo]);
    }
}