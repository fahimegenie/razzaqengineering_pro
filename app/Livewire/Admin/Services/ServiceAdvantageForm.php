<?php

namespace App\Livewire\Admin\Services;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\ServiceAdvantage;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Service Advantage Form - Admin Panel')]
class ServiceAdvantageForm extends Component
{
    use WithFileUploads;

    public $advantageId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    public $sa_image;
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
                $this->imagePreview = $adv->image_url;
            }
        }
    }

    public function updatedSaImage()
    {
        $this->validateOnly('sa_image', ['sa_image' => 'image|max:2048']);
        try { $this->imagePreview = $this->sa_image->temporaryUrl(); } catch (\Exception $e) {}
    }

    public function removeImage() { $this->sa_image = null; $this->imagePreview = null; }

    public function save()
    {
        $this->validate([
            'sa_st_id' => 'required|exists:our_service,id',
            'sa_title' => 'required|string|max:255',
        ]);
        
        $this->isSaving = true;
        
        try {
            $adv = $this->isEditing ? ServiceAdvantage::findOrFail($this->advantageId) : new ServiceAdvantage();
            
            foreach (['sa_st_id','sa_title','sa_description','sa_t1','sa_t2','sa_t3','sa_t4'] as $f) {
                if (property_exists($this, $f)) $adv->$f = $this->$f ?: null;
            }
            
            $adv->sort_order = (int) ($this->sort_order ?? 0);
            
            if ($this->sa_image) {
                if ($adv->sa_image) @unlink(public_path('uploads/services/advantages/' . $adv->sa_image));
                $name = 'adv_' . time() . '_' . uniqid() . '.' . $this->sa_image->getClientOriginalExtension();
                $path = public_path('uploads/services/advantages');
                if (!is_dir($path)) mkdir($path, 0777, true);
                copy($this->sa_image->getRealPath(), $path . '/' . $name);
                @unlink($this->sa_image->getRealPath());
                $adv->sa_image = $name;
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