<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\City;
use App\Models\Service;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\SeoData;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app-layout')]
class CityPage extends Component
{
    public $city;
    public $services = [];
    public $projects = [];
    public $testimonials = [];
    public $seo;
    public $pc = [];
    public $isLoading = true;
    public $errorMessage = '';

    public function mount($city)
    {
        try {
            $this->isLoading = true;
            
            // ✅ Find city by slug - with 404 handling
            $this->city = City::where('slug', $city)
                ->where('is_active', 1)
                ->first();
            
            if (!$this->city) {
                abort(404, 'City not found');
            }
            
            // Get services available in this city
            $this->services = Service::active()
                ->whereHas('cityServices', function ($q) {
                    $q->where('city_id', $this->city->id)->where('is_active', 1);
                })
                ->ordered()
                ->get();
            
            // Get projects in this city
            $this->projects = Project::active()
                ->where('p_location', 'like', '%' . $this->city->name . '%')
                ->latest()
                ->limit(6)
                ->get();
            
            // Get testimonials from this city
            $this->testimonials = Testimonial::active()
                ->where('t_location', 'like', '%' . $this->city->name . '%')
                ->ordered()
                ->limit(6)
                ->get();
            
            $this->pc = ProductCategory::active()->select('pc_name')->get();
            
            $this->isLoading = false;
            
        } catch (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
            abort(404);
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load page.';
            $this->isLoading = false;
            Log::error('City page error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.website.city-page');
    }
}