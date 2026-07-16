<?php

namespace App\Livewire\Admin\Quote;

use Livewire\Component;
use App\Traits\HandlesUploads; // Cleanup aur file uploading trait register kiya
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\QuoteRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.admin-layout')]
#[Title('Create Quote Request - Admin Panel')]
class QuoteRequestForm extends Component
{
    use HandlesUploads; // Trait apply kiya (Contains WithFileUploads internally)

    public $quoteId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    public $qr_attachment_file;
    public $existing_attachment = null; // Purani attachment track karne ke liye
    public $attachmentPreview;
    
    #[Validate('required|string|max:255')]
    public $qr_name = '';
    
    #[Validate('required|email|max:255')]
    public $qr_email = '';
    
    #[Validate('required|string|max:20')]
    public $qr_phone = '';
    
    #[Validate('nullable|string|max:255')]
    public $qr_company = '';
    
    #[Validate('required|string|max:255')]
    public $qr_service_type = '';
    
    #[Validate('required|string|max:255')]
    public $qr_location = '';
    
    #[Validate('required|string|min:10')]
    public $qr_details = '';
    
    #[Validate('nullable|string|max:50')]
    public $qr_budget = '';
    
    #[Validate('nullable|string|max:50')]
    public $qr_timeline = '';
    
    #[Validate('nullable|string|max:50')]
    public $qr_source = 'admin';
    
    #[Validate('required|string|in:pending,contacted,completed,cancelled')]
    public $qr_status = 'pending';
    
    #[Validate('nullable|string')]
    public $qr_admin_notes = '';

    public $serviceTypeOptions = [
        'Concrete Cutting' => 'Concrete Cutting',
        'Core Drilling' => 'Core Drilling',
        'Wall Sawing' => 'Wall Sawing',
        'Diamond Cutting' => 'Diamond Cutting',
        'Demolition' => 'Demolition',
        'Grinding' => 'Grinding',
        'Anchoring' => 'Anchoring',
        'Other' => 'Other',
    ];

    public $budgetOptions = [
        'Under 50,000 PKR' => 'Under 50,000 PKR',
        '50,000 - 100,000 PKR' => '50,000 - 100,000 PKR',
        '100,000 - 500,000 PKR' => '100,000 - 500,000 PKR',
        '500,000 - 1,000,000 PKR' => '500,000 - 1,000,000 PKR',
        'Above 1,000,000 PKR' => 'Above 1,000,000 PKR',
        'Not Sure' => 'Not Sure',
    ];

    public $timelineOptions = [
        'Immediate' => 'Immediate',
        'Within 1 Week' => 'Within 1 Week',
        'Within 2 Weeks' => 'Within 2 Weeks',
        'Within 1 Month' => 'Within 1 Month',
        'Flexible' => 'Flexible',
    ];

    public function mount($quoteId = null)
    {
        if ($quoteId) {
            $quote = QuoteRequest::find($quoteId);
            if ($quote) {
                $this->quoteId = $quote->id;
                $this->isEditing = true;
                
                foreach (['qr_name','qr_email','qr_phone','qr_company','qr_service_type','qr_location','qr_details','qr_budget','qr_timeline','qr_source','qr_status','qr_admin_notes'] as $f) {
                    if (isset($quote->$f)) $this->$f = $quote->$f;
                }
                
                // Track and resolve attachment url safely
                $this->existing_attachment = $quote->qr_attachment;
                if ($this->existing_attachment) {
                    $this->attachmentPreview = Storage::disk('public')->url($this->existing_attachment);
                } else {
                    $this->attachmentPreview = $quote->attachment_url;
                }
            }
        }
    }

    public function updatedQrAttachmentFile()
    {
        $this->validateOnly('qr_attachment_file', [
            'qr_attachment_file' => 'file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png,zip'
        ]);
        
        try { 
            // temporaryUrl() sirf images ke liye stable chalta hai, non-image files crash na karein isliye safety check
            $mimeType = $this->qr_attachment_file->getMimeType();
            if (str_starts_with($mimeType, 'image/')) {
                $this->attachmentPreview = $this->qr_attachment_file->temporaryUrl(); 
            } else {
                $this->attachmentPreview = $this->qr_attachment_file->getClientOriginalName();
            }
        } catch (\Exception $e) {
            Log::error('Preview generation failed: ' . $e->getMessage());
        }
    }

    public function removeAttachment()
    {
        $this->qr_attachment_file = null;
        $this->attachmentPreview = null;
    }

    public function save()
    {
        $this->validate();
        $this->isSaving = true;
        
        try {
            $quote = $this->isEditing ? QuoteRequest::findOrFail($this->quoteId) : new QuoteRequest();
            
            foreach (['qr_name','qr_email','qr_phone','qr_company','qr_service_type','qr_location','qr_details','qr_budget','qr_timeline','qr_source','qr_status','qr_admin_notes'] as $f) {
                if (property_exists($this, $f)) $quote->$f = $this->$f ?: null;
            }
            
            if (!$this->isEditing) {
                $quote->qr_ip = request()->ip();
                $quote->qr_user_agent = request()->userAgent();
            }
            
            // Storage standard integration via uploadFile trait
            if ($this->qr_attachment_file) {
                $quote->qr_attachment = $this->uploadFile(
                    $this->qr_attachment_file, 
                    'quote-attachments', 
                    $this->existing_attachment
                );
            }
            
            $quote->save();
            $this->isSaving = false;
            
            $this->dispatch('toast', type: 'success', message: $this->isEditing ? 'Quote updated!' : 'Quote created!');
            return redirect()->route('admin.quotes.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Quote save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.quotes.quote-form');
    }
}