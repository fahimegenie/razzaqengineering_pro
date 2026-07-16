<?php

namespace App\Livewire\Admin\Services;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Service;
use App\Traits\HandlesUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

#[Layout('components.layouts.admin-layout')]
#[Title('Service Form - Admin Panel')]
class ServiceForm extends Component
{
    // Uploads Handle karne wala hamara professional trait
    use HandlesUploads;

    public $serviceId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    public $os_image;
    public $existing_os_image = null; // Purani image ka path store karne ke liye
    public $os_banner;
    public $existing_os_banner = null; // Purani banner image ka path store karne ke liye
    public $imagePreview;
    public $bannerPreview;
    
    #[Validate('required|string|max:255')]
    public $os_name = '';
    
    #[Validate('nullable|string|max:255')]
    public $os_slug = '';
    
    #[Validate('nullable|string|max:100')]
    public $os_icon = '';
    
    #[Validate('nullable|string')]
    public $os_description = '';
    
    #[Validate('nullable|string')]
    public $os_short_description = '';
    
    #[Validate('nullable|string|max:255')]
    public $meta_title = '';
    
    #[Validate('nullable|string|max:500')]
    public $meta_description = '';
    
    #[Validate('nullable|string|max:500')]
    public $meta_keywords = '';
    
    #[Validate('nullable|integer|min:0')]
    public $sort_order = 0;
    
    #[Validate('boolean')]
    public $is_active = true;
    
    #[Validate('boolean')]
    public $is_featured = false;

    // Icon options
    public $iconOptions = [
        'bi bi-tools' => 'Tools',
        'bi bi-gear' => 'Gear',
        'bi bi-wrench' => 'Wrench',
        'bi bi-hammer' => 'Hammer',
        'bi bi-building' => 'Building',
        'bi bi-truck' => 'Truck',
        'bi bi-shield' => 'Shield',
        'bi bi-lightbulb' => 'Lightbulb',
        'bi bi-cpu' => 'CPU',
        'bi bi-plug' => 'Plug',
        'bi bi-droplet' => 'Droplet',
        'bi bi-fire' => 'Fire',
        'bi bi-brush' => 'Brush',
        'bi bi-palette' => 'Palette',
        'bi bi-camera' => 'Camera',
        'bi bi-laptop' => 'Laptop',
        'bi bi-phone' => 'Phone',
        'bi bi-globe' => 'Globe',
        'bi bi-graph-up' => 'Graph',
        'bi bi-clipboard-check' => 'Clipboard',
    ];

    public function mount($serviceId = null)
    {
        if ($serviceId) {
            $service = $serviceId instanceof Service ? $serviceId : Service::find($serviceId);
            
            if ($service) {
                $this->serviceId = $service->id;
                $this->isEditing = true;
                
                foreach (['os_name','os_slug','os_icon','os_description','os_short_description','meta_title','meta_description','meta_keywords','sort_order','is_active','is_featured'] as $field) {
                    if (isset($service->$field)) $this->$field = $service->$field;
                }
                
                // Existing paths save kar rahe hain taake update par purani file automatic remove ho sake
                $this->existing_os_image = $service->os_image;
                $this->existing_os_banner = $service->os_banner;

                // Previews load karne ka safe tarika (bina static URLs ke)
                if ($this->existing_os_image) {
                    $this->imagePreview = Storage::disk('public')->url($this->existing_os_image);
                }
                if ($this->existing_os_banner) {
                    $this->bannerPreview = Storage::disk('public')->url($this->existing_os_banner);
                }
            }
        }
    }

    // ============================================
    // CKEDITOR LISTENER - THIS IS THE KEY FIX
    // ============================================
    #[On('ckeditor-value-updated')]
    public function handleCkEditorUpdate($value, $field)
    {
        $fieldMap = [
            'os_description' => 'os_description',
        ];

        if (isset($fieldMap[$field]) && property_exists($this, $fieldMap[$field])) {
            $this->{$fieldMap[$field]} = $value;
        }
    }

    public function updatedOsName()
    {
        if (!$this->isEditing || empty($this->os_slug)) {
            $this->os_slug = Str::slug($this->os_name);
        }
    }

    public function generateSlug() { $this->os_slug = Str::slug($this->os_name); }

    public function updatedOsImage()
    {
        $this->validateOnly('os_image', ['os_image' => 'image|max:5120']);
        try { $this->imagePreview = $this->os_image->temporaryUrl(); } catch (\Exception $e) {}
    }

    public function updatedOsBanner()
    {
        $this->validateOnly('os_banner', ['os_banner' => 'image|max:5120']);
        try { $this->bannerPreview = $this->os_banner->temporaryUrl(); } catch (\Exception $e) {}
    }

    public function removeImage() 
    { 
        $this->os_image = null; 
        $this->imagePreview = null; 
    }
    
    public function removeBanner() 
    { 
        $this->os_banner = null; 
        $this->bannerPreview = null; 
    }

    public function save()
    {
        $rules = ['os_name' => 'required|string|max:255'];
        if ($this->os_image) $rules['os_image'] = 'image|mimes:jpeg,png,jpg,webp|max:5120';
        if ($this->os_banner) $rules['os_banner'] = 'image|mimes:jpeg,png,jpg,webp|max:5120';
        
        $this->validate($rules);
        $this->isSaving = true;
        
        try {
            $service = $this->isEditing ? Service::findOrFail($this->serviceId) : new Service();
            
            foreach (['os_name','os_slug','os_icon','os_description','os_short_description','meta_title','meta_description','meta_keywords'] as $field) {
                if (property_exists($this, $field)) $service->$field = $this->$field ?: null;
            }
            
            $service->sort_order = (int) ($this->sort_order ?? 0);
            $service->is_active = (bool) $this->is_active;
            $service->is_featured = (bool) $this->is_featured;
            
            // 1. Main Image (Create aur Update dono is single line se handle honge)
            if ($this->os_image) {
                $service->os_image = $this->uploadFile($this->os_image, 'services', $this->existing_os_image);
            }
            
            // 2. Banner Image (Auto-delete aur path generation automated)
            if ($this->os_banner) {
                $service->os_banner = $this->uploadFile($this->os_banner, 'services/banners', $this->existing_os_banner);
            }
            
            $service->save();
            $this->isSaving = false;
            
            $message = $this->isEditing ? 'Service updated successfully!' : 'Service created successfully!';
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            $this->dispatch($this->isEditing ? 'service-updated' : 'service-created');
            
            return redirect()->route('admin.services.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Service save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.services.service-form');
    }
}