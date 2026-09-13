<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Career;
use App\Models\SeoData;
use App\Models\Service;
use App\Models\ProductCategory;
use App\Traits\HasDynamicSEO;

#[Layout('components.layouts.app-layout', ['seo' => []])]
#[Title('Careers - Razzaq Engineering Services')]
class CareersPage extends Component
{
    use HasDynamicSEO;
    
    public $search = '';
    public $selectedDepartment = 'all';
    public $selectedLocation = 'all';
    public $selectedType = 'all';
    public $isLoading = true;
    public $errorMessage = '';
    public $jobs = [];
    public $departments = [];
    public $locations = [];
    public $types = [];
    public $totalCount = 0;
    public $seo = null;
    public $services = [];
    public $pc = [];

    public function mount()
    {
        try {
            $this->isLoading = true;
            $this->initializeSEO('careers');
            $this->seo = SeoData::where('seo_page_type', 'Careers')->first();
            $this->services = Service::active()->ordered()->get();
            $this->pc = ProductCategory::active()->select('pc_name')->get();
            
            // Load jobs
            $this->jobs = Career::active()->ordered()->get();
            $this->totalCount = $this->jobs->count();
            
            // Get unique departments, locations, types
            $this->departments = $this->jobs->pluck('department')->filter()->unique()->values()->toArray();
            $this->locations = $this->jobs->pluck('location')->filter()->unique()->values()->toArray();
            $this->types = $this->jobs->pluck('job_type')->filter()->unique()->values()->toArray();
            
            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load job listings.';
            $this->isLoading = false;
            \Log::error('CareersPage error: ' . $e->getMessage());
        }
    }

    public function getFilteredJobsProperty()
    {
        return $this->jobs->filter(function ($job) {
            $matchesSearch = empty($this->search) || 
                stripos($job->title, $this->search) !== false ||
                stripos($job->department, $this->search) !== false ||
                stripos($job->description, $this->search) !== false;
            
            $matchesDepartment = $this->selectedDepartment === 'all' || $job->department === $this->selectedDepartment;
            $matchesLocation = $this->selectedLocation === 'all' || $job->location === $this->selectedLocation;
            $matchesType = $this->selectedType === 'all' || $job->job_type === $this->selectedType;
            
            return $matchesSearch && $matchesDepartment && $matchesLocation && $matchesType;
        })->values();
    }

    public function filterByDepartment($dept)
    {
        $this->selectedDepartment = $dept;
    }

    public function filterByLocation($loc)
    {
        $this->selectedLocation = $loc;
    }

    public function filterByType($type)
    {
        $this->selectedType = $type;
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->selectedDepartment = 'all';
        $this->selectedLocation = 'all';
        $this->selectedType = 'all';
    }

    public function render()
    {
        $seo = $this->getSeoData();
        return view('livewire.website.careers-page', [
            'filteredJobs' => $this->filteredJobs,
        ])->layoutData(['seo' => $seo]);
    }
}