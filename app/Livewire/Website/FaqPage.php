<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Faq;
use App\Models\SeoData;
use App\Models\Service;
use App\Models\ProductCategory;

#[Layout('components.layouts.app-layout')]
#[Title('FAQ - Razzaq Engineering Services')]
class FaqPage extends Component
{
    public $isLoading = true;
    public $selectedCategory = 'all';
    public $faqs = [];
    public $categories = [];
    public $seo = null;
    public $services = [];
    public $pc = [];

    public function mount()
    {
        $this->seo = SeoData::where('seo_page_type', 'Faq')->first();
        $this->faqs = Faq::where('is_active', 1)->orderBy('sort_order', 'ASC')->get();
        $this->services = Service::where('is_active', 1)->orderBy('id', 'ASC')->get();
        $this->pc = ProductCategory::where('is_active', 1)->select('pc_name')->get();
        
        $this->categories = Faq::where('is_active', 1)
            ->whereNotNull('faq_category')
            ->where('faq_category', '!=', '')
            ->distinct()
            ->pluck('faq_category')
            ->toArray();
        
        $this->isLoading = false;
    }

    /**
     * Called from Alpine.js when category changes
     */
    public function filterByCategory($category)
    {
        $this->selectedCategory = $category;
        
        if ($category === 'all') {
            $this->faqs = Faq::where('is_active', 1)->orderBy('sort_order', 'ASC')->get();
        } else {
            $this->faqs = Faq::where('is_active', 1)
                ->where('faq_category', $category)
                ->orderBy('sort_order', 'ASC')
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.website.faq-page');
    }
}