<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\SeoData;

#[Layout('components.layouts.app-layout')]
#[Title('Quote Received - Razzaq Engineering')]
class QuoteThankYou extends Component
{
    public $quoteId = null;
    public $quoteName = 'Valued Customer';
    public $services = [];
    public $seo = null;

    public function mount($id = null, $name = null)
    {
        // Accept data from session or URL parameters
        $this->quoteId = $id ?? session('quote_id');
        $this->quoteName = $name ?? session('quote_name', 'Valued Customer');
        
        // If no quote data and no session, redirect to quote page
        if (!$this->quoteId && !session('quote_id')) {
            // Optional: redirect to quote page
            // return redirect()->route('quote.index');
        }
        
        $this->seo = SeoData::where('seo_page_type', 'Quote Thank You')->first();
    }

    public function getFormattedQuoteIdProperty()
    {
        return str_pad($this->quoteId ?? 0, 5, '0', STR_PAD_LEFT);
    }

    public function render()
    {
        return view('livewire.website.quote-thank-you');
    }
}