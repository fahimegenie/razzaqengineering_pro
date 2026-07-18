<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Faq;
use App\Models\SeoData;
use App\Models\Setting;
use App\Traits\HasDynamicSEO;

#[Layout('components.layouts.app-layout', ['seo' => []])]
#[Title('FAQ - Razzaq Engineering Services')]
class FaqPage extends Component
{
    use HasDynamicSEO;
    
    public $isLoading = true;
    public $selectedCategory = 'all';
    public $faqs = [];
    public $categories = [];
    public $seo = null;

    public function mount()
    {
        $settings = Setting::getCached();

        $this->initializeSEO('faq');
        
        // $this->seo = SeoData::where('seo_page_type', 'Faq')->first();
        
        // Load only active FAQs, ordered by sort_order
        $this->faqs = Faq::where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('id', 'ASC')
            ->get();
        
        // Get unique categories from active FAQs
        $this->categories = Faq::where('is_active', 1)
            ->whereNotNull('faq_category')
            ->where('faq_category', '!=', '')
            ->distinct()
            ->pluck('faq_category')
            ->toArray();
        
        $this->isLoading = false;
    }

    /**
     * Filter FAQs by category - called from Alpine.js
     */
    public function filterByCategory($category)
    {
        $this->selectedCategory = $category;
        
        if ($category === 'all') {
            $this->faqs = Faq::where('is_active', 1)
                ->orderBy('sort_order', 'ASC')
                ->orderBy('id', 'ASC')
                ->get();
        } else {
            $this->faqs = Faq::where('is_active', 1)
                ->where('faq_category', $category)
                ->orderBy('sort_order', 'ASC')
                ->orderBy('id', 'ASC')
                ->get();
        }
    }

    public function render()
    {
        $seo = $this->getSeoData();
        return view('livewire.website.faq-page')->layoutData(['seo' => $seo]);
    }
}