<?php

namespace App\Livewire\Admin\Services;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Service Form - Admin Panel')]
class ServiceForm extends Component
{
    use WithFileUploads;

    public $serviceId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    public $os_image;
    public $os_banner;
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
                
                $this->imagePreview = $service->image_url;
                $this->bannerPreview = $service->banner_url;
            }
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

    public function removeImage() { $this->os_image = null; $this->imagePreview = null; }
    public function removeBanner() { $this->os_banner = null; $this->bannerPreview = null; }

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
            
            // Main Image
            if ($this->os_image) {
                if ($service->os_image) @unlink(public_path('uploads/services/' . $service->os_image));
                $imageName = 'svc_' . time() . '_' . uniqid() . '.' . $this->os_image->getClientOriginalExtension();
                $path = public_path('uploads/services');
                if (!is_dir($path)) mkdir($path, 0777, true);
                copy($this->os_image->getRealPath(), $path . '/' . $imageName);
                @unlink($this->os_image->getRealPath());
                $service->os_image = $imageName;
            }
            
            // Banner Image
            if ($this->os_banner) {
                if ($service->os_banner) @unlink(public_path('uploads/services/banners/' . $service->os_banner));
                $bannerName = 'banner_' . time() . '_' . uniqid() . '.' . $this->os_banner->getClientOriginalExtension();
                $path = public_path('uploads/services/banners');
                if (!is_dir($path)) mkdir($path, 0777, true);
                copy($this->os_banner->getRealPath(), $path . '/' . $bannerName);
                @unlink($this->os_banner->getRealPath());
                $service->os_banner = $bannerName;
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