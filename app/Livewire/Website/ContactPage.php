<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\ContactUs;
use App\Models\ContactAddress;
use App\Models\SeoData;
use App\Models\Service;
use App\Models\ProductCategory;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

#[Layout('components.layouts.app-layout')]
#[Title('Contact Us - Razzaq Engineering Services')]
class ContactPage extends Component
{
    // ============================================
    // PUBLIC PROPERTIES
    // ============================================
    public $contact;
    public $contactAddresses = [];
    public $seo;
    public $services = [];
    public $pc = [];
    public $isLoading = true;
    public $errorMessage = '';

    // ============================================
    // FORM PROPERTIES
    // ============================================
    #[Validate('required|string|min:3|max:255', message: 'Please enter your full name.')]
    public $name = '';

    #[Validate('required|email|max:255', message: 'Please enter a valid email address.')]
    public $email = '';

    #[Validate('required|string|min:10|max:20', message: 'Please enter a valid phone number.')]
    public $phone = '';

    #[Validate('nullable|string|max:255')]
    public $subject = '';

    #[Validate('required|string|min:10|max:5000', message: 'Please enter your message (min 10 characters).')]
    public $message = '';

    #[Validate('nullable|string|max:255')]
    public $company = '';

    #[Validate('nullable|string|max:255')]
    public $city = '';

    // ============================================
    // FORM STATE
    // ============================================
    public $isSubmitting = false;
    public $isSuccess = false;
    public $successMessage = '';
    public $formError = '';

    // ============================================
    // MOUNT
    // ============================================
    public function mount()
    {
        try {
            $this->isLoading = true;
            
            $this->seo = SeoData::where('seo_page_type', 'Contact')->first();
            $this->contact = ContactUs::first();
            $this->contactAddresses = ContactAddress::where('is_active', 1)
                ->where('show_on_website', 1)
                ->get();
            $this->services = Service::active()->ordered()->get();
            $this->pc = ProductCategory::active()->select('pc_name')->get();
            
            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load page data. Please try again.';
            $this->isLoading = false;
            Log::error('Contact page error: ' . $e->getMessage());
        }
    }

    // ============================================
    // FORM SUBMISSION
    // ============================================
    public function submitForm()
    {
        if ($this->isSubmitting) return;

        $this->validate();
        $this->isSubmitting = true;
        $this->formError = '';

        try {
            // Save to database
            ContactMessage::create([
                'cm_name' => $this->name,
                'cm_email' => $this->email,
                'cm_phone' => $this->phone,
                'cm_subject' => $this->subject,
                'cm_message' => $this->message,
                'cm_company' => $this->company,
                'cm_city' => $this->city,
                'cm_source' => 'website',
                'cm_priority' => 'medium',
                'cm_status' => 'new',
                'cm_ip' => request()->ip(),
                'cm_user_agent' => request()->userAgent(),
            ]);

            // Send email notification (optional)
            // try {
            //     Mail::to('info@razzaqengineering.com')->send(new \App\Mail\ContactFormMail($this->all()));
            // } catch (\Exception $e) {
            //     Log::error('Contact email failed: ' . $e->getMessage());
            // }

            // Reset form
            $this->reset(['name', 'email', 'phone', 'subject', 'message', 'company', 'city']);
            $this->isSuccess = true;
            $this->successMessage = 'Thank you! Your message has been sent successfully. We will contact you shortly.';

            Log::info('Contact form submitted by: ' . $this->email);

        } catch (\Exception $e) {
            $this->formError = 'Failed to send message. Please try again or call us directly.';
            Log::error('Contact form error: ' . $e->getMessage());
        } finally {
            $this->isSubmitting = false;
        }
    }

    /**
     * Reset success state
     */
    public function resetSuccess()
    {
        $this->isSuccess = false;
        $this->successMessage = '';
    }

    /**
     * Retry loading data
     */
    public function retryLoad()
    {
        $this->errorMessage = '';
        $this->mount();
    }

    // ============================================
    // RENDER
    // ============================================
    public function render()
    {
        return view('livewire.website.contact-page');
    }
}