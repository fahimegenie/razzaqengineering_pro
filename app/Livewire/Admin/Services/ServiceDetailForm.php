<?php

namespace App\Livewire\Admin\Services;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\ServiceDetail;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Service Detail Form - Admin Panel')]
class ServiceDetailForm extends Component
{
    use WithFileUploads;

    public $detailId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    public $sd_image1;
    public $sd_image2;
    public $image1Preview;
    public $image2Preview;
    
    #[Validate('required|exists:our_service,id')]
    public $os_id = null;
    
    #[Validate('required|string|max:255')]
    public $sd_title = '';
    
    #[Validate('nullable|string')]
    public $sd_description = '';
    
    #[Validate('nullable|string|max:255')]
    public $sd_t1 = '';
    
    #[Validate('nullable|string|max:255')]
    public $sd_t2 = '';
    
    #[Validate('nullable|string|max:255')]
    public $sd_t3 = '';
    
    #[Validate('nullable|string')]
    public $sd_features_input = '';
    
    public $sd_features = [];
    
    #[Validate('nullable|integer|min:0')]
    public $sort_order = 0;
    
    public $services = [];

    public function mount($detailId = null, $serviceId = null)
    {
        $this->services = Service::active()->orderBy('os_name')->get();
        
        if ($serviceId) $this->os_id = $serviceId;
        
        if ($detailId) {
            $detail = ServiceDetail::find($detailId);
            if ($detail) {
                $this->detailId = $detail->id;
                $this->isEditing = true;
                
                foreach (['os_id','sd_title','sd_description','sd_t1','sd_t2','sd_t3','sort_order'] as $f) {
                    if (isset($detail->$f)) $this->$f = $detail->$f;
                }
                
                $this->sd_features = $detail->features_list;
                $this->image1Preview = $detail->image_one_url;
                $this->image2Preview = $detail->image_two_url;
            }
        }
    }

    public function updatedSdImage1()
    {
        $this->validateOnly('sd_image1', ['sd_image1' => 'image|max:5120']);
        try { $this->image1Preview = $this->sd_image1->temporaryUrl(); } catch (\Exception $e) {}
    }

    public function updatedSdImage2()
    {
        $this->validateOnly('sd_image2', ['sd_image2' => 'image|max:5120']);
        try { $this->image2Preview = $this->sd_image2->temporaryUrl(); } catch (\Exception $e) {}
    }

    public function addFeature()
    {
        if (!empty($this->sd_features_input)) {
            $this->sd_features[] = trim($this->sd_features_input);
            $this->sd_features_input = '';
        }
    }

    public function removeFeature($index)
    {
        unset($this->sd_features[$index]);
        $this->sd_features = array_values($this->sd_features);
    }

    public function removeImage1() { $this->sd_image1 = null; $this->image1Preview = null; }
    public function removeImage2() { $this->sd_image2 = null; $this->image2Preview = null; }

    public function save()
    {
        $this->validate([
            'os_id' => 'required|exists:our_service,id',
            'sd_title' => 'required|string|max:255',
        ]);
        
        $this->isSaving = true;
        
        try {
            $detail = $this->isEditing ? ServiceDetail::findOrFail($this->detailId) : new ServiceDetail();
            
            foreach (['os_id','sd_title','sd_description','sd_t1','sd_t2','sd_t3'] as $f) {
                if (property_exists($this, $f)) $detail->$f = $this->$f ?: null;
            }
            
            $detail->sort_order = (int) ($this->sort_order ?? 0);
            $detail->sd_features = json_encode(array_values($this->sd_features));
            
            // Image 1
            if ($this->sd_image1) {
                if ($detail->sd_image1) @unlink(public_path('uploads/services/details/' . $detail->sd_image1));
                $name = 'sdd1_' . time() . '_' . uniqid() . '.' . $this->sd_image1->getClientOriginalExtension();
                $path = public_path('uploads/services/details');
                if (!is_dir($path)) mkdir($path, 0777, true);
                copy($this->sd_image1->getRealPath(), $path . '/' . $name);
                @unlink($this->sd_image1->getRealPath());
                $detail->sd_image1 = $name;
            }
            
            // Image 2
            if ($this->sd_image2) {
                if ($detail->sd_image2) @unlink(public_path('uploads/services/details/' . $detail->sd_image2));
                $name = 'sdd2_' . time() . '_' . uniqid() . '.' . $this->sd_image2->getClientOriginalExtension();
                $path = public_path('uploads/services/details');
                if (!is_dir($path)) mkdir($path, 0777, true);
                copy($this->sd_image2->getRealPath(), $path . '/' . $name);
                @unlink($this->sd_image2->getRealPath());
                $detail->sd_image2 = $name;
            }
            
            $detail->save();
            $this->isSaving = false;
            
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $this->isEditing ? 'Detail updated!' : 'Detail created!');
            return redirect()->route('admin.services.details.index', ['serviceId' => $detail->os_id]);
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Detail save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.services.detail-form');
    }
}