<?php

namespace App\Livewire\Admin\Services;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\ServiceAdvantage;
use App\Models\Service;
use App\Traits\HandlesUploads; // Trait ko use karne ke liye
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

#[Layout('components.layouts.admin-layout')]
#[Title('Service Advantage Form - Admin Panel')]
class ServiceAdvantageForm extends Component
{
    // Uploads Handle karne wala hamara professional trait
    use HandlesUploads;

    public $advantageId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    public $sa_image;
    public $existing_sa_image = null; // Purani image ka path store karne ke liye
    public $imagePreview;
    
    #[Validate('required|exists:our_service,id')]
    public $sa_st_id = null;
    
    #[Validate('required|string|max:255')]
    public $sa_title = '';
    
    #[Validate('nullable|string')]
    public $sa_description = '';
    
    #[Validate('nullable|string|max:255')]
    public $sa_t1 = '';
    
    #[Validate('nullable|string|max:255')]
    public $sa_t2 = '';
    
    #[Validate('nullable|string|max:255')]
    public $sa_t3 = '';
    
    #[Validate('nullable|string|max:255')]
    public $sa_t4 = '';
    
    #[Validate('nullable|integer|min:0')]
    public $sort_order = 0;
    
    public $services = [];

    public function mount($advantageId = null, $serviceId = null)
    {
        $this->services = Service::active()->orderBy('os_name')->get();
        if ($serviceId) $this->sa_st_id = $serviceId;
        
        if ($advantageId) {
            $adv = ServiceAdvantage::find($advantageId);
            if ($adv) {
                $this->advantageId = $adv->id;
                $this->isEditing = true;
                
                foreach (['sa_st_id','sa_title','sa_description','sa_t1','sa_t2','sa_t3','sa_t4','sort_order'] as $f) {
                    if (isset($adv->$f)) $this->$f = $adv->$f;
                }
                
                // Existing path save kar rahe hain taake update par purani file auto-delete ho
                $this->existing_sa_image = $adv->sa_image;

                // Previews load karne ka safe tarika
                if ($this->existing_sa_image) {
                    $this->imagePreview = Storage::disk('public')->url($this->existing_sa_image);
                } else {
                    $this->imagePreview = $adv->image_url; // Fallback to model accessor
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
            'sa_description' => 'sa_description',
        ];

        if (isset($fieldMap[$field]) && property_exists($this, $fieldMap[$field])) {
            $this->{$fieldMap[$field]} = $value;
        }
    }

    public function updatedSaImage()
    {
        $this->validateOnly('sa_image', ['sa_image' => 'image|max:5120']); // Max size 5MB tak increase kar di hai safe-side ke liye
        try { $this->imagePreview = $this->sa_image->temporaryUrl(); } catch (\Exception $e) {}
    }

    public function removeImage() 
    { 
        $this->sa_image = null; 
        $this->imagePreview = null; 
    }

    public function save()
    {
        $rules = [
            'sa_st_id' => 'required|exists:our_service,id',
            'sa_title' => 'required|string|max:255',
        ];

        if ($this->sa_image) $rules['sa_image'] = 'image|mimes:jpeg,png,jpg,webp|max:5120';

        $this->validate($rules);
        $this->isSaving = true;
        
        try {
            $adv = $this->isEditing ? ServiceAdvantage::findOrFail($this->advantageId) : new ServiceAdvantage();
            
            foreach (['sa_st_id','sa_title','sa_description','sa_t1','sa_t2','sa_t3','sa_t4'] as $f) {
                if (property_exists($this, $f)) $adv->$f = $this->$f ?: null;
            }
            
            $adv->sort_order = (int) ($this->sort_order ?? 0);
            
            // Image - Upload/Replace using Trait
            if ($this->sa_image) {
                $adv->sa_image = $this->uploadFile($this->sa_image, 'services/advantages', $this->existing_sa_image);
            }
            
            $adv->save();
            $this->isSaving = false;
            
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $this->isEditing ? 'Advantage updated!' : 'Advantage created!');
            return redirect()->route('admin.services.advantages.index', ['serviceId' => $adv->sa_st_id]);
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Advantage save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.services.advantage-form');
    }
}