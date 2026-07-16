<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use App\Models\ContactUs;
use App\Models\ContactAddress;
use App\Traits\HandlesUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

#[Layout('components.layouts.admin-layout')]
#[Title('Contact Us Settings - Admin Panel')]
class ContactUsSettings extends Component
{
    use HandlesUploads;

    // ============================================
    // ACTIVE TAB
    // ============================================
    public $activeTab = 'page-content';
    
    // Loading states
    public $isLoading = false;
    public $isSaving = false;
    public $saveSuccess = false;
    public $errorMessage = '';
    
    // ============================================
    // CONTACT US PAGE PROPERTIES
    // ============================================
    #[Rule('required|string|max:255')]
    public $cs_title = '';
    
    #[Rule('nullable|string')]
    public $cs_description = '';
    
    #[Rule('nullable|string')]
    public $map_address = '';
    
    #[Rule('nullable|string|max:255')]
    public $form_title = '';
    
    #[Rule('nullable|string')]
    public $form_description = '';
    
    #[Rule('nullable|image|max:5120')]
    public $banner_image;
    
    public $bannerPreview = null;
    
    // SEO Fields
    #[Rule('nullable|string|max:255')]
    public $meta_title = '';
    
    #[Rule('nullable|string')]
    public $meta_description = '';
    
    #[Rule('nullable|string')]
    public $meta_keywords = '';
    
    // ============================================
    // CONTACT ADDRESS PROPERTIES
    // ============================================
    #[Rule('required|string')]
    public $ca_address = '';
    
    #[Rule('required|email|max:100')]
    public $ca_email = '';
    
    #[Rule('required|string|max:30')]
    public $ca_phone = '';
    
    #[Rule('nullable|string|max:30')]
    public $footer_phone = '';
    
    #[Rule('nullable|string|max:30')]
    public $whatsapp = '';
    
    #[Rule('nullable|string|max:255')]
    public $office_hours = '';
    
    #[Rule('nullable|string')]
    public $google_map = '';
    
    #[Rule('nullable|url|max:255')]
    public $facebook = '';
    
    #[Rule('nullable|url|max:255')]
    public $instagram = '';
    
    #[Rule('nullable|url|max:255')]
    public $linkedin = '';
    
    #[Rule('nullable|url|max:255')]
    public $youtube = '';
    
    // ============================================
    // FORM SUBMISSIONS
    // ============================================
    public $showSubmissions = false;
    public $selectedSubmission = null;
    
    // ============================================
    // LIFECYCLE HOOKS
    // ============================================
    public function mount()
    {
        $this->loadContactUsData();
        $this->loadContactAddressData();
    }
    
    private function loadContactUsData()
    {
        try {
            $this->isLoading = true;
            
            $contactUs = ContactUs::first();
            
            if ($contactUs) {
                $this->cs_title = $contactUs->cs_title;
                $this->cs_description = $contactUs->cs_description;
                $this->map_address = $contactUs->map_address;
                $this->form_title = $contactUs->form_title;
                $this->form_description = $contactUs->form_description;
                $this->meta_title = $contactUs->meta_title;
                $this->meta_description = $contactUs->meta_description;
                $this->meta_keywords = $contactUs->meta_keywords;
                $this->bannerPreview = $contactUs->banner_url;
            }
            
            $this->isLoading = false;
            
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load contact page data.';
            $this->isLoading = false;
            Log::error('Contact Us load error: ' . $e->getMessage());
        }
    }

    // ============================================
    // CKEDITOR LISTENER - THIS IS THE KEY FIX
    // ============================================
    #[On('ckeditor-value-updated')]
    public function handleCkEditorUpdate($value, $field)
    {
        $fieldMap = [
            'cs_description' => 'cs_description',
            'form_description' => 'form_description'
        ];

        if (isset($fieldMap[$field]) && property_exists($this, $fieldMap[$field])) {
            $this->{$fieldMap[$field]} = $value;
        }
    }
    
    private function loadContactAddressData()
    {
        try {
            $address = ContactAddress::first();
            
            if ($address) {
                $this->ca_address = $address->ca_address;
                $this->ca_email = $address->ca_email;
                $this->ca_phone = $address->ca_phone;
                $this->footer_phone = $address->footer_phone;
                $this->whatsapp = $address->whatsapp;
                $this->office_hours = $address->office_hours;
                $this->google_map = $address->google_map;
                $this->facebook = $address->facebook;
                $this->instagram = $address->instagram;
                $this->linkedin = $address->linkedin;
                $this->youtube = $address->youtube;
            }
            
        } catch (\Exception $e) {
            Log::error('Contact Address load error: ' . $e->getMessage());
        }
    }
    
    // ============================================
    // FILE UPLOAD HANDLERS
    // ============================================
    public function updatedBannerImage()
    {
        $this->validateOnly('banner_image');
        try {
            $this->bannerPreview = $this->banner_image->temporaryUrl();
        } catch (\Exception $e) {
            $this->bannerPreview = null;
        }
    }
    
    // ============================================
    // TAB SWITCHING
    // ============================================
    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetValidation();
    }
    
    // ============================================
    // SAVE PAGE CONTENT
    // ============================================
    public function savePageContent()
    {
        $this->validate([
            'cs_title' => 'required|string|max:255',
        ]);
        
        $this->isSaving = true;
        
        try {
            $contactUs = ContactUs::firstOrCreate(['id' => 1]);
            
            $data = [
                'cs_title' => $this->cs_title,
                'cs_description' => $this->cs_description,
                'map_address' => $this->map_address,
                'form_title' => $this->form_title,
                'form_description' => $this->form_description,
                'meta_title' => $this->meta_title,
                'meta_description' => $this->meta_description,
                'meta_keywords' => $this->meta_keywords,
            ];
            
            // Handle Banner Upload using HandlesUploads Trait
            if ($this->banner_image) {

                $uploadedPath = $this->uploadFile(
                    $this->banner_image,
                    'uploads/contact',
                    $contactUs->banner_image
                );

                if ($uploadedPath) {
                    $data['banner_image'] = $uploadedPath;
                }
            }
            
            $contactUs->update($data);
            
            $this->saveSuccess = true;
            $this->isSaving = false;
            
            $this->dispatch('toast', 
                type: 'success', 
                title: 'Success!',
                message: 'Contact page content saved successfully.'
            );
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Contact Us save error: ' . $e->getMessage());
            
            $this->dispatch('toast', 
                type: 'error', 
                title: 'Error!',
                message: 'Failed to save: ' . $e->getMessage()
            );
        }
    }
    
    // ============================================
    // SAVE CONTACT ADDRESS
    // ============================================
    public function saveContactAddress()
    {
        $this->validate([
            'ca_address' => 'required|string',
            'ca_email' => 'required|email|max:100',
            'ca_phone' => 'required|string|max:30',
        ]);
        
        $this->isSaving = true;
        
        try {
            $address = ContactAddress::firstOrCreate(['id' => 1]);
            
            $address->update([
                'ca_address' => $this->ca_address,
                'ca_email' => $this->ca_email,
                'ca_phone' => $this->ca_phone,
                'footer_phone' => $this->footer_phone,
                'whatsapp' => $this->whatsapp,
                'office_hours' => $this->office_hours,
                'google_map' => $this->google_map,
                'facebook' => $this->facebook,
                'instagram' => $this->instagram,
                'linkedin' => $this->linkedin,
                'youtube' => $this->youtube,
            ]);
            
            $this->saveSuccess = true;
            $this->isSaving = false;
            
            $this->dispatch('toast', 
                type: 'success', 
                title: 'Success!',
                message: 'Contact address saved successfully.'
            );
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Contact Address save error: ' . $e->getMessage());
            
            $this->dispatch('toast', 
                type: 'error', 
                title: 'Error!',
                message: 'Failed to save address.'
            );
        }
    }
    
    // ============================================
    // REMOVE BANNER IMAGE
    // ============================================
    public function removeBanner()
    {
        $contactUs = ContactUs::first();
        
        if ($contactUs && $contactUs->banner_image) {

            $this->deleteFile($contactUs->banner_image);

            $contactUs->update([
                'banner_image' => null
            ]);

            $this->banner_image = null;
            $this->bannerPreview = null;

            $this->dispatch(
                'toast',
                type: 'success',
                title: 'Removed!',
                message: 'Banner image removed successfully.'
            );
        }
    }
    
    // ============================================
    // CKEDITOR VALUE HANDLER
    // ============================================
    public function setFieldValue($data = [])
    {
        if (is_array($data)) {
            $field = $data['field'] ?? null;
            $value = $data['value'] ?? null;
        } else {
            $field = $data;
            $value = request()->input('value') ?? func_get_arg(1) ?? null;
        }
        
        if ($field && property_exists($this, $field)) {
            $this->$field = $value;
        }
    }
    
    // ============================================
    // VIEW SUBMISSIONS
    // ============================================
    public function viewSubmissions()
    {
        $this->showSubmissions = true;
    }
    
    public function closeSubmissions()
    {
        $this->showSubmissions = false;
        $this->selectedSubmission = null;
    }
    
    public function viewSubmission($id)
    {
        // If you have a contact submissions table, load it here
        $this->selectedSubmission = null; // Replace with actual submission query
    }
    
    // ============================================
    // COMPUTED PROPERTIES
    // ============================================
    public function getTabsProperty(): array
    {
        return [
            'page-content' => ['label' => 'Page Content', 'icon' => 'bi-file-text'],
            'contact-details' => ['label' => 'Contact Details', 'icon' => 'bi-telephone'],
            'social-links' => ['label' => 'Social Links', 'icon' => 'bi-share'],
            'seo' => ['label' => 'SEO', 'icon' => 'bi-search'],
            'submissions' => ['label' => 'Submissions', 'icon' => 'bi-envelope'],
        ];
    }
    
    // ============================================
    // RENDER
    // ============================================
    public function render()
    {
        return view('livewire.admin.settings.contact-us-settings', [
            'tabs' => $this->tabs,
            'contactUs' => ContactUs::first(),
            'contactAddress' => ContactAddress::first(),
        ]);
    }
}