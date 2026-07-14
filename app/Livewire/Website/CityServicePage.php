<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\City;
use App\Models\Service;
use App\Models\CityService;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\SeoData;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app-layout')]
class CityServicePage extends Component
{
    public $city;
    public $service;
    public $cityService;
    public $projects = [];
    public $testimonials = [];
    public $faqs = [];
    public $relatedServices = [];
    public $otherCities = [];
    public $seo;
    public $pc = [];
    public $isLoading = true;
    public $errorMessage = '';

    public function mount($city, $service)
    {
        try {
            $this->isLoading = true;
            
            // ✅ Find city by slug
            $this->city = City::where('slug', $city)
                ->where('is_active', 1)
                ->first();
            
            if (!$this->city) {
                abort(404, 'City not found');
            }
            
            // ✅ Find service by slug OR by name converted to slug
            $this->service = Service::where('is_active', 1)
                ->where(function ($query) use ($service) {
                    $query->where('os_slug', $service)
                          ->orWhere('os_name', 'like', '%' . str_replace('-', ' ', $service) . '%')
                          ->orWhereRaw("REPLACE(LOWER(os_name), ' ', '-') = ?", [$service]);
                })
                ->first();
            
            if (!$this->service) {
                abort(404, 'Service not found');
            }
            
            // ✅ Find city-service SEO data
            $this->cityService = CityService::where('city_id', $this->city->id)
                ->where('service_id', $this->service->id)
                ->where('is_active', 1)
                ->first();
            
            // Get related projects
            $this->projects = Project::active()
                ->where(function ($q) {
                    $q->where('p_location', 'like', '%' . $this->city->name . '%')
                      ->orWhere('p_title', 'like', '%' . $this->service->os_name . '%');
                })
                ->latest()
                ->limit(4)
                ->get();
            
            // Get testimonials
            $this->testimonials = Testimonial::active()
                ->where(function ($q) {
                    $q->where('t_location', 'like', '%' . $this->city->name . '%')
                      ->orWhere('service_id', $this->service->id);
                })
                ->ordered()
                ->limit(4)
                ->get();
            
            // Get FAQs
            if ($this->cityService && $this->cityService->faq) {
                $faqData = $this->cityService->faq;
                $this->faqs = is_array($faqData) ? $faqData : (json_decode($faqData, true) ?? []);
            }
            
            // Get other services in this city
            $this->relatedServices = Service::active()
                ->where('id', '!=', $this->service->id)
                ->whereHas('cityServices', function ($q) {
                    $q->where('city_id', $this->city->id)->where('is_active', 1);
                })
                ->ordered()
                ->limit(6)
                ->get();
            
            // Get other cities for this service
            $this->otherCities = City::active()
                ->where('id', '!=', $this->city->id)
                ->whereHas('services', function ($q) {
                    $q->where('service_id', $this->service->id);
                })
                ->limit(6)
                ->get();
            
            $this->pc = ProductCategory::active()->select('pc_name')->get();
            
            // Set dynamic title
            $this->setTitle();
            
            $this->isLoading = false;
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        } catch (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
            abort(404);
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load page. Please try again.';
            $this->isLoading = false;
            Log::error('CityService page error: ' . $e->getMessage());
        }
    }

    private function setTitle()
    {
        $title = optional($this->cityService)->meta_title 
            ?? $this->service->os_name . ' Services in ' . $this->city->name . ' | Razzaq Engineering';
        
        // Dynamic title for the page
        if (method_exists($this, 'title')) {
            // Livewire 3 way
        }
    }

    public function render()
    {
        return view('livewire.website.city-service-page');
    }
}