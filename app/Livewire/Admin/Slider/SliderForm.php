<?php

namespace App\Livewire\Admin\Slider;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Slider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.admin-layout')]
#[Title('Slider Form - Admin Panel')]
class SliderForm extends Component
{
    use WithFileUploads;

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
        $this->s_image = null;
        $this->imagePreview = null;
    }

    public function removeMobileImage()
    {
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
            
            // Use direct public folder instead of storage
            // Desktop Image
            if ($this->s_image) {
                // Delete old image
                if ($slider->s_image) {
                    $oldImagePath = public_path('slider_image/' . $slider->s_image);
                    if (file_exists($oldImagePath)) {
                        @unlink($oldImagePath);
                    }
                }
                
                $imageName = time() . '_desktop_' . uniqid() . '.' . $this->s_image->getClientOriginalExtension();
                $destinationPath = public_path('slider_image');
                
                // Ensure directory exists with proper permissions
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                
                // Make sure directory is writable
                if (!is_writable($destinationPath)) {
                    mkdir($destinationPath, 0777);
                }
                
                // Get the temporary file path
                $tempFile = $this->s_image->getRealPath();
                
                // Check if temp file exists
                if (!file_exists($tempFile)) {
                    throw new \Exception('Temporary file not found: ' . $tempFile);
                }
                
                // Move file using copy + unlink (more reliable than move)
                $targetFile = $destinationPath . '/' . $imageName;
                
                if (!copy($tempFile, $targetFile)) {
                    throw new \Exception('Failed to copy desktop image to: ' . $targetFile);
                }
                
                // Delete temp file
                @unlink($tempFile);
                
                $slider->s_image = $imageName;
            }

            // Mobile Image
            if ($this->s_mobile_image) {
                // Delete old mobile image
                if ($slider->s_mobile_image) {
                    $oldMobilePath = public_path('slider_image/' . $slider->s_mobile_image);
                    if (file_exists($oldMobilePath)) {
                        @unlink($oldMobilePath);
                    }
                }
                
                $mobileImageName = time() . '_mobile_' . uniqid() . '.' . $this->s_mobile_image->getClientOriginalExtension();
                $destinationPath = public_path('slider_image');
                
                // Ensure directory exists
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                
                // Make sure directory is writable
                if (!is_writable($destinationPath)) {
                    mkdir($destinationPath, 0777);
                }
                
                $tempFile = $this->s_mobile_image->getRealPath();
                
                if (!file_exists($tempFile)) {
                    throw new \Exception('Temporary mobile file not found: ' . $tempFile);
                }
                
                $targetFile = $destinationPath . '/' . $mobileImageName;
                
                if (!copy($tempFile, $targetFile)) {
                    throw new \Exception('Failed to copy mobile image to: ' . $targetFile);
                }
                
                @unlink($tempFile);
                
                $slider->s_mobile_image = $mobileImageName;
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