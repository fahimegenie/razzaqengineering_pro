<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\AboutUs;
use App\Models\OurTeam;
use App\Models\SeoData;
use App\Models\Service;
use App\Models\ProductCategory;
use App\Models\Team;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app-layout')]
#[Title('About Us - Razzaq Engineering Services')]
class AboutPage extends Component
{
    public $about;
    public $seo;
    public $services;
    public $pc;
    public $team;
    public $testimonials;
    public $activeTab = 'mission';
    public $stats = [];
    
    // Loading states
    public $isLoading = false;
    public $errorMessage = '';
    
    // Alpine state tracking
    public $selectedFeature = null;
    public $showTeamModal = false;
    public $selectedMember = null;

    public function mount()
    {
        $this->loadData();
    }

    private function loadData()
    {
        try {
            $this->isLoading = true;
            
            // Load from Models with error handling
            $this->about = AboutUs::active()->first();
            $this->seo = SeoData::where('seo_page_type', 'About')->first();
            $this->services = Service::active()->ordered()->get();
            $this->pc = ProductCategory::active()->select('pc_name')->get();
            $this->team = OurTeam::active()->ordered()->get();
            $this->testimonials = Testimonial::active()->featured()->ordered()->limit(6)->get();
            
            // Calculate stats
            $this->stats = [
                'experience' => $this->about->years_experience ?? 15,
                'projects' => $this->about->projects_completed ?? 500,
                'clients' => $this->about->happy_clients ?? 300,
                'team' => $this->team->count() ?? 50,
                'cities' => 9,
                'certifications' => 5,
            ];
            
            $this->isLoading = false;
            
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load page data. Please try again.';
            $this->isLoading = false;
            Log::error('AboutPage error: ' . $e->getMessage());
        }
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function showMemberDetail($memberId)
    {
        $this->selectedMember = $this->team->where('id', $memberId)->first();
        $this->showTeamModal = true;
    }

    public function closeTeamModal()
    {
        $this->showTeamModal = false;
        $this->selectedMember = null;
    }

    public function getWhyChooseUsProperty()
    {
        return [
            [
                'icon' => 'fa-hand-holding-usd',
                'title' => 'No Extra Charges',
                'desc' => 'Transparent pricing with no hidden fees. You only pay for what you need.',
            ],
            [
                'icon' => 'fa-clock',
                'title' => '24/7 Emergency Service',
                'desc' => 'Available anytime, anywhere in Pakistan for urgent requirements.',
            ],
            [
                'icon' => 'fa-certificate',
                'title' => 'Licensed & Certified',
                'desc' => 'Fully registered company with professional certifications & insurance.',
            ],
            [
                'icon' => 'fa-tags',
                'title' => 'Special Offers',
                'desc' => 'Exclusive deals and competitive packages for our valued clients.',
            ],
            [
                'icon' => 'fa-smile',
                'title' => 'Customer Satisfaction',
                'desc' => '100% client satisfaction is our top priority on every project.',
            ],
            [
                'icon' => 'fa-truck-fast',
                'title' => 'On-Time Delivery',
                'desc' => 'We deliver projects on schedule without compromise on quality.',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.website.about-page', [
            'about' => $this->about,
            'seo' => $this->seo,
            'services' => $this->services,
            'pc' => $this->pc,
            'team' => $this->team,
            'testimonials' => $this->testimonials,
            'stats' => $this->stats,
            'whyChooseUs' => $this->whyChooseUs,
        ]);
    }
}