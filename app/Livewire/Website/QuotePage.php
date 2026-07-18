<?php

namespace App\Livewire\Website;

use Livewire\Component;
use App\Traits\HandlesUploads; // Custom upload system trait
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Service;
use App\Models\SeoData;
use App\Models\ProductCategory;
use App\Models\Project;
use App\Models\QuoteRequest;
use App\Traits\HasDynamicSEO;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app-layout', ['seo' => []])]
#[Title('Get a Free Quote - Razzaq Engineering Services')]
class QuotePage extends Component
{
    // HandlesUploads use kiya hai kyunki iske andar WithFileUploads already mojood hai
    use HandlesUploads, HasDynamicSEO;

    // ============================================
    // FORM PROPERTIES - Step 1: Personal Info
    // ============================================
    #[Validate('required|string|min:3|max:255', message: 'Please enter your full name.')]
    public $full_name = '';

    #[Validate('required|email|max:255', message: 'Please enter a valid email address.')]
    public $email = '';

    #[Validate('required|string|min:10|max:20', message: 'Please enter a valid phone number (min 10 digits).')]
    public $phone = '';

    #[Validate('nullable|string|max:255')]
    public $company = '';

    // ============================================
    // FORM PROPERTIES - Step 2: Project Details
    // ============================================
    #[Validate('required|string', message: 'Please select a service type.')]
    public $service_type = '';

    #[Validate('required|string|max:255', message: 'Please select your project location.')]
    public $project_location = '';

    #[Validate('required|string|min:10|max:5000', message: 'Please provide project details (min 10 characters).')]
    public $project_details = '';

    #[Validate('nullable|string')]
    public $budget_range = '';

    #[Validate('nullable|string')]
    public $timeline = '';

    // ============================================
    // FORM PROPERTIES - Step 3: Additional Info
    // ============================================
    #[Validate('nullable|string')]
    public $referral_source = '';

    #[Validate('nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240', message: 'File must be jpg, png, pdf, or doc (max 10MB).')]
    public $attachment = null;

    // ============================================
    // COMPONENT STATE
    // ============================================
    public $current_step = 1;
    public $total_steps = 3;
    public $is_submitting = false;
    public $is_success = false;
    public $submitted_quote_id = null;
    public $submitted_quote_name = '';
    public $error_message = '';
    public $success_message = '';

    // ============================================
    // MOUNT / INITIALIZATION
    // ============================================
    public function mount()
    {

        $this->initializeSEO('quote');

        // Pre-fill if user is logged in (optional)
        if (auth()->check()) {
            $this->full_name = auth()->user()->name ?? '';
            $this->email = auth()->user()->email ?? '';
            $this->phone = auth()->user()->phone ?? '';
        }
    }

    // ============================================
    // COMPUTED PROPERTIES
    // ============================================
    public function getServicesListProperty()
    {
        return Service::active()->ordered()->get();
    }

    public function getRecentProjectsProperty()
    {
        return Project::active()->latest()->limit(4)->get();
    }

    public function getSeoDataProperty()
    {
        return SeoData::where('seo_page_type', 'Quote')->first();
    }

    public function getProductCategoriesProperty()
    {
        return ProductCategory::active()->get();
    }

    public function getCitiesProperty()
    {
        return [
            'Lahore', 'Karachi', 'Islamabad', 'Rawalpindi', 
            'Peshawar', 'Faisalabad', 'Multan', 'Gujranwala',
            'Sialkot', 'Quetta', 'Hyderabad', 'Other'
        ];
    }

    public function getBudgetRangesProperty()
    {
        return [
            '' => '-- Select Budget Range --',
            'Under PKR 50,000' => 'Under PKR 50,000',
            'PKR 50,000 - 100,000' => 'PKR 50,000 - 100,000',
            'PKR 100,000 - 500,000' => 'PKR 100,000 - 500,000',
            'PKR 500,000 - 1,000,000' => 'PKR 500,000 - 1,000,000',
            'Above PKR 1,000,000' => 'Above PKR 1,000,000',
            'Not Sure' => 'Not Sure / To Be Discussed',
        ];
    }

    public function getTimelineOptionsProperty()
    {
        return [
            '' => '-- Select Timeline --',
            'Immediate / Emergency' => 'Immediate / Emergency',
            'Within 1 Week' => 'Within 1 Week',
            'Within 2 Weeks' => 'Within 2 Weeks',
            'Within 1 Month' => 'Within 1 Month',
            'Within 3 Months' => 'Within 3 Months',
            'Flexible' => 'Flexible / Not Sure',
        ];
    }

    public function getReferralSourcesProperty()
    {
        return [
            '' => '-- Select Option --',
            'Google Search' => 'Google Search',
            'Facebook' => 'Facebook',
            'Instagram' => 'Instagram',
            'TikTok' => 'TikTok',
            'LinkedIn' => 'LinkedIn',
            'Friend Referral' => 'Friend / Colleague Referral',
            'Existing Client' => 'Existing Client',
            'Other' => 'Other',
        ];
    }

    public function getProgressPercentageProperty()
    {
        return ($this->current_step / $this->total_steps) * 100;
    }

    public function getStepLabelProperty()
    {
        $labels = [
            1 => 'Personal Information',
            2 => 'Project Details', 
            3 => 'Additional Information',
        ];
        return $labels[$this->current_step] ?? '';
    }

    // ============================================
    // STEP NAVIGATION
    // ============================================
    public function nextStep()
    {
        // Validate current step
        if ($this->current_step === 1) {
            $this->validate([
                'full_name' => 'required|string|min:3|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|min:10|max:20',
            ], [
                'full_name.required' => 'Please enter your full name.',
                'email.required' => 'Please enter your email address.',
                'email.email' => 'Please enter a valid email address.',
                'phone.required' => 'Please enter your phone number.',
                'phone.min' => 'Phone number must be at least 10 digits.',
            ]);
        }

        if ($this->current_step === 2) {
            $this->validate([
                'service_type' => 'required|string',
                'project_location' => 'required|string|max:255',
                'project_details' => 'required|string|min:10|max:5000',
            ], [
                'service_type.required' => 'Please select a service type.',
                'project_location.required' => 'Please select your project location.',
                'project_details.required' => 'Please provide project details.',
                'project_details.min' => 'Project details must be at least 10 characters.',
            ]);
        }

        if ($this->current_step < $this->total_steps) {
            $this->current_step++;
            $this->dispatch('scrollToTop');
            $this->dispatch('stepChanged', step: $this->current_step);
        }
    }

    public function prevStep()
    {
        if ($this->current_step > 1) {
            $this->current_step--;
            $this->dispatch('scrollToTop');
        }
    }

    public function goToStep($step)
    {
        if ($step >= 1 && $step < $this->current_step) {
            $this->current_step = $step;
            $this->dispatch('scrollToTop');
        }
    }

    // ============================================
    // REAL-TIME VALIDATION
    // ============================================
    public function updated($propertyName)
    {
        // Validate only on step 3 or when moving forward
        if ($this->current_step === 3) {
            $this->validateOnly($propertyName);
        }
    }

    // ============================================
    // FORM SUBMISSION
    // ============================================
    public function submitQuote()
    {
        // Prevent double submission
        if ($this->is_submitting) {
            return;
        }

        // Full validation
        $validated = $this->validate([
            'full_name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:10|max:20',
            'service_type' => 'required|string',
            'project_location' => 'required|string|max:255',
            'project_details' => 'required|string|min:10|max:5000',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240',
        ], [
            'full_name.required' => 'Full name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email.',
            'phone.required' => 'Phone number is required.',
            'phone.min' => 'Phone must be at least 10 digits.',
            'service_type.required' => 'Please select a service.',
            'project_location.required' => 'Please select a location.',
            'project_details.required' => 'Project details are required.',
            'project_details.min' => 'Please provide at least 10 characters.',
        ]);

        $this->is_submitting = true;
        $this->error_message = '';
        $this->success_message = '';

        try {
            // Handle file upload with Trait helper
            $attachmentPath = null;
            if ($this->attachment) {
                $attachmentPath = $this->uploadFile(
                    file: $this->attachment,
                    directory: 'quote-attachments'
                );
            }

            // Save to database
            $quote = QuoteRequest::create([
                'qr_name' => $this->full_name,
                'qr_email' => $this->email,
                'qr_phone' => $this->phone,
                'qr_company' => $this->company,
                'qr_service_type' => $this->service_type,
                'qr_location' => $this->project_location,
                'qr_details' => $this->project_details,
                'qr_budget' => $this->budget_range,
                'qr_timeline' => $this->timeline,
                'qr_source' => $this->referral_source ?? 'website',
                'qr_attachment' => $attachmentPath,
                'qr_status' => 'pending',
                'qr_ip' => request()->ip(),
                'qr_user_agent' => request()->userAgent(),
            ]);

            // Send email notification (uncomment if mail configured)
            // try {
            //     Mail::to('info@razzaqengineering.com')->send(new \App\Mail\NewQuoteRequest($quote));
            // } catch (\Exception $e) {
            //     Log::error('Quote email failed: ' . $e->getMessage());
            // }

            // Log success
            Log::info('New quote request received', [
                'quote_id' => $quote->id,
                'name' => $this->full_name,
                'service' => $this->service_type,
                'location' => $this->project_location,
            ]);

            // Success
            $this->is_success = true;
            $this->submitted_quote_id = $quote->id;
            $this->submitted_quote_name = $this->full_name;
            $this->success_message = 'Your quote request has been submitted successfully!';

            // Dispatch events
            $this->dispatch('quoteSubmitted', [
                'id' => $quote->id,
                'name' => $this->full_name,
            ]);

            $this->dispatch('showToast', [
                'type' => 'success',
                'title' => 'Quote Request Sent!',
                'message' => 'We will contact you within 24 hours with a detailed quote.',
            ]);

        } catch (\Illuminate\Database\QueryException $e) {
            $this->error_message = 'Database error occurred. Please try again.';
            Log::error('Quote database error: ' . $e->getMessage());
            
            $this->dispatch('showToast', [
                'type' => 'error',
                'title' => 'Database Error',
                'message' => 'Please try again later.',
            ]);
        } catch (\Exception $e) {
            $this->error_message = 'An unexpected error occurred. Please try again or call us directly.';
            Log::error('Quote submission error: ' . $e->getMessage());
            
            $this->dispatch('showToast', [
                'type' => 'error',
                'title' => 'Submission Failed',
                'message' => 'Please try again or call us at +92 304 8902805.',
            ]);
        } finally {
            $this->is_submitting = false;
        }
    }

    // ============================================
    // RESET FORM
    // ============================================
    public function resetForm()
    {
        $this->reset([
            'full_name', 'email', 'phone', 'company',
            'service_type', 'project_location', 'project_details',
            'budget_range', 'timeline', 'referral_source',
            'attachment', 'is_success', 'error_message',
            'submitted_quote_id', 'submitted_quote_name',
        ]);
        $this->current_step = 1;
        $this->dispatch('scrollToTop');
    }

    // ============================================
    // RENDER
    // ============================================
    public function render()
    {
        $seo = $this->getSeoData();
        
        return view('livewire.website.quote-page', [
            'services' => $this->servicesList,
            'seo' => $this->seoData,
            'pc' => $this->productCategories,
            'recentProjects' => $this->recentProjects,
            'cities' => $this->cities,
            'budgetRanges' => $this->budgetRanges,
            'timelineOptions' => $this->timelineOptions,
            'referralSources' => $this->referralSources,
        ])->layoutData(['seo' => $seo]);
    }
}