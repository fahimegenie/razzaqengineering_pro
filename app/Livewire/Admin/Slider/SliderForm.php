<?php

namespace App\Livewire\Admin\Slider;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\HandlesUploads; // Custom upload system trait
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Slider;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Slider Form - Admin Panel')]
class SliderForm extends Component
{
    use HandlesUploads;

    public $sliderId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    // Images
    public $s_image;
    public $s_mobile_image;
    public $imagePreview;
    public $mobileImagePreview;
    
    #[Validate('required|string|max:255')]
    public $s_title = '';
    
    #[Validate('nullable|string|max:255')]
    public $s_subtitle = '';
    
    #[Validate('nullable|string')]
    public $s_description = '';
    
    #[Validate('nullable|string|max:255')]
    public $s_alt_text = '';
    
    #[Validate('nullable|string|max:255')]
    public $s_badge_text = '';
    
    #[Validate('nullable|string|max:255')]
    public $s_t1 = '';
    
    #[Validate('nullable|string|max:255')]
    public $s_t2 = '';
    
    #[Validate('nullable|string|max:255')]
    public $s_t3 = '';
    
    #[Validate('nullable|string|max:255')]
    public $button_text = '';
    
    #[Validate('nullable|string|max:500')]
    public $button_link = '';
    
    #[Validate('nullable|string|max:50')]
    public $button_target = '_self';
    
    #[Validate('nullable|string|max:255')]
    public $button2_text = '';
    
    #[Validate('nullable|string|max:500')]
    public $button2_link = '';
    
    #[Validate('nullable|string|max:50')]
    public $button2_target = '_self';
    
    #[Validate('required|string')]
    public $slider_type = 'image';
    
    #[Validate('required|string')]
    public $text_position = 'center';
    
    #[Validate('nullable|string|max:20')]
    public $text_color = '#ffffff';
    
    #[Validate('nullable|string|max:20')]
    public $overlay_color = '#00366c';
    
    #[Validate('nullable|integer|min:0|max:100')]
    public $overlay_opacity = 50;
    
    #[Validate('nullable|string|max:20')]
    public $background_color = '#000000';
    
    #[Validate('nullable|string|max:50')]
    public $background_position = 'center';
    
    #[Validate('nullable|string|max:50')]
    public $background_size = 'cover';
    
    #[Validate('nullable|string|max:50')]
    public $animation_type = 'fade';
    
    #[Validate('nullable|integer|min:1000|max:30000')]
    public $slide_duration = 5000;
    
    #[Validate('nullable|integer|min:0')]
    public $sort_order = 0;
    
    #[Validate('boolean')]
    public $is_active = true;
    
    #[Validate('boolean')]
    public $is_featured = false;
    
    #[Validate('boolean')]
    public $show_on_mobile = true;
    
    #[Validate('boolean')]
    public $show_on_desktop = true;

    public function mount($sliderId = null)
    {
        if ($sliderId) {
            $slider = $sliderId instanceof Slider ? $sliderId : Slider::find($sliderId);
            
            if ($slider) {
                $this->sliderId = $slider->id;
                $this->isEditing = true;
                
                $fillable = [
                    's_title', 's_subtitle', 's_description', 's_alt_text', 's_badge_text',
                    's_t1', 's_t2', 's_t3',
                    'button_text', 'button_link', 'button_target',
                    'button2_text', 'button2_link', 'button2_target',
                    'slider_type', 'text_position', 'text_color',
                    'overlay_color', 'overlay_opacity', 'background_color',
                    'background_position', 'background_size', 'animation_type',
                    'slide_duration', 'sort_order',
                    'is_active', 'is_featured', 'show_on_mobile', 'show_on_desktop',
                ];
                
                foreach ($fillable as $field) {
                    if (isset($slider->$field)) {
                        $this->$field = $slider->$field;
                    }
                }
                
                $this->imagePreview = $slider->image_url;
                if ($slider->s_mobile_image) {
                    $this->mobileImagePreview = $slider->mobile_image_url;
                }
            }
        }
    }

    public function updatedSImage()
    {
        $this->validateOnly('s_image', ['s_image' => 'image|max:5120']);
        try {
            $this->imagePreview = $this->s_image->temporaryUrl();
        } catch (\Exception $e) {
            Log::error('Preview error: ' . $e->getMessage());
        }
    }

    public function updatedSMobileImage()
    {
        $this->validateOnly('s_mobile_image', ['s_mobile_image' => 'image|max:5120']);
        try {
            $this->mobileImagePreview = $this->s_mobile_image->temporaryUrl();
        } catch (\Exception $e) {
            Log::error('Mobile preview error: ' . $e->getMessage());
        }
    }

    public function removeImage()
    {
        if ($this->sliderId && $this->isEditing) {
            $slider = Slider::find($this->sliderId);
            if ($slider && $slider->s_image) {
                $this->deleteFile($slider->s_image);
                $slider->update(['s_image' => null]);
            }
        }

        $this->s_image = null;
        $this->imagePreview = null;
    }

    public function removeMobileImage()
    {
        if ($this->sliderId && $this->isEditing) {
            $slider = Slider::find($this->sliderId);
            if ($slider && $slider->s_mobile_image) {
                $this->deleteFile($slider->s_mobile_image);
                $slider->update(['s_mobile_image' => null]);
            }
        }

        $this->s_mobile_image = null;
        $this->mobileImagePreview = null;
    }

    public function save()
    {
        // Validation rules
        $rules = ['s_title' => 'required|string|max:255'];
        
        if (!$this->isEditing) {
            $rules['s_image'] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120';
        } else {
            $rules['s_image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120';
        }
        
        $this->validate($rules);
        $this->isSaving = true;
        
        try {
            $slider = $this->isEditing ? Slider::findOrFail($this->sliderId) : new Slider();
            
            // Text fields save
            $textFields = [
                's_title', 's_subtitle', 's_description', 's_alt_text', 's_badge_text',
                's_t1', 's_t2', 's_t3',
                'button_text', 'button_link', 'button_target',
                'button2_text', 'button2_link', 'button2_target',
                'slider_type', 'text_position', 'text_color',
                'overlay_color', 'background_color',
                'background_position', 'background_size', 'animation_type',
            ];
            
            foreach ($textFields as $field) {
                if (property_exists($this, $field)) {
                    $slider->$field = $this->$field;
                }
            }
            
            $slider->overlay_opacity = (int) $this->overlay_opacity;
            $slider->slide_duration = (int) $this->slide_duration;
            $slider->sort_order = (int) $this->sort_order;
            
            $slider->is_active = (bool) $this->is_active;
            $slider->is_featured = (bool) $this->is_featured;
            $slider->show_on_mobile = (bool) $this->show_on_mobile;
            $slider->show_on_desktop = (bool) $this->show_on_desktop;
            
            // Desktop Image via HandlesUploads trait
            if ($this->s_image) {
                $slider->s_image = $this->uploadFile(
                    file: $this->s_image,
                    directory: 'slider_image',
                    oldFilePath: $slider->s_image
                );
            }

            // Mobile Image via HandlesUploads trait
            if ($this->s_mobile_image) {
                $slider->s_mobile_image = $this->uploadFile(
                    file: $this->s_mobile_image,
                    directory: 'slider_image',
                    oldFilePath: $slider->s_mobile_image
                );
            }

            // Save to database
            $slider->save();
            $this->isSaving = false;
            
            $message = $this->isEditing ? 'Slider updated successfully!' : 'Slider created successfully!';
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            $this->dispatch($this->isEditing ? 'slider-updated' : 'slider-created');
            
            return redirect()->route('admin.sliders.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Slider save error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.sliders.slider-form');
    }
}