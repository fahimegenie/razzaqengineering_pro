<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Testimonial;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Testimonial Form - Admin Panel')]
class TestimonialForm extends Component
{
    use WithFileUploads;

    public $testimonialId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    // Image
    public $t_image;
    public $imagePreview;
    
    #[Validate('required|string|max:255')]
    public $t_name = '';
    
    #[Validate('nullable|string|max:255')]
    public $t_designation = '';
    
    #[Validate('nullable|string|max:255')]
    public $t_company = '';
    
    #[Validate('required|string|min:10')]
    public $t_content = '';
    
    #[Validate('required|integer|min:1|max:5')]
    public $t_rating = 5;
    
    #[Validate('nullable|string|max:255')]
    public $t_location = '';
    
    #[Validate('nullable|exists:projects,p_id')]
    public $project_id = null;
    
    #[Validate('nullable|exists:our_services,os_id')]
    public $service_id = null;
    
    #[Validate('nullable|integer|min:0')]
    public $sort_order = 0;
    
    #[Validate('boolean')]
    public $is_active = true;
    
    #[Validate('boolean')]
    public $is_featured = false;
    
    // For dropdowns
    public $projects = [];
    public $services = [];

    public function mount($testimonialId = null)
    {
        $this->projects = Project::select('id', 'p_title')->orderBy('p_title')->get();
        $this->services = Service::select('id', 'os_name')->orderBy('os_name')->get();
        
        if ($testimonialId) {
            $testimonial = $testimonialId instanceof Testimonial ? $testimonialId : Testimonial::find($testimonialId);
            
            if ($testimonial) {
                $this->testimonialId = $testimonial->id;
                $this->isEditing = true;
                
                $fillable = [
                    't_name', 't_designation', 't_company', 't_content',
                    't_rating', 't_location', 'project_id', 'service_id',
                    'sort_order', 'is_active', 'is_featured',
                ];
                
                foreach ($fillable as $field) {
                    if (isset($testimonial->$field)) {
                        $this->$field = $testimonial->$field;
                    }
                }
                
                $this->imagePreview = $testimonial->image_url;
            }
        }
    }

    public function updatedTImage()
    {
        $this->validateOnly('t_image', ['t_image' => 'image|max:2048']);
        try {
            $this->imagePreview = $this->t_image->temporaryUrl();
        } catch (\Exception $e) {
            Log::error('Preview error: ' . $e->getMessage());
        }
    }

    public function removeImage()
    {
        $this->t_image = null;
        $this->imagePreview = null;
    }

    public function save()
    {
        $rules = [
            't_name' => 'required|string|max:255',
            't_content' => 'required|string|min:10',
            't_rating' => 'required|integer|min:1|max:5',
        ];
        
        if (!$this->isEditing) {
            $rules['t_image'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';
        } else {
            $rules['t_image'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';
        }
        
        $this->validate($rules);
        $this->isSaving = true;
        
        try {
            $testimonial = $this->isEditing ? Testimonial::findOrFail($this->testimonialId) : new Testimonial();
            
            // Text fields
            $textFields = [
                't_name', 't_designation', 't_company', 't_content',
                't_location', 'project_id', 'service_id',
            ];
            
            foreach ($textFields as $field) {
                if (property_exists($this, $field)) {
                    $testimonial->$field = $this->$field ?: null;
                }
            }
            
            $testimonial->t_rating = (int) $this->t_rating;
            $testimonial->sort_order = (int) $this->sort_order;
            $testimonial->is_active = (bool) $this->is_active;
            $testimonial->is_featured = (bool) $this->is_featured;
            
            // Handle Image Upload
            if ($this->t_image) {
                // Delete old image
                if ($testimonial->t_image) {
                    $oldImagePath = public_path('testimonial_images/' . $testimonial->t_image);
                    if (file_exists($oldImagePath)) {
                        @unlink($oldImagePath);
                    }
                }
                
                $imageName = 'testimonial_' . time() . '_' . uniqid() . '.' . $this->t_image->getClientOriginalExtension();
                $destinationPath = public_path('testimonial_images');
                
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                
                $tempFile = $this->t_image->getRealPath();
                $targetFile = $destinationPath . '/' . $imageName;
                
                if (!copy($tempFile, $targetFile)) {
                    throw new \Exception('Failed to copy image to: ' . $targetFile);
                }
                
                @unlink($tempFile);
                $testimonial->t_image = $imageName;
            }
            
            $testimonial->save();
            $this->isSaving = false;
            
            $message = $this->isEditing ? 'Testimonial updated successfully!' : 'Testimonial created successfully!';
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            $this->dispatch($this->isEditing ? 'testimonial-updated' : 'testimonial-created');
            
            return redirect()->route('admin.testimonials.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Testimonial save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.testimonials.testimonial-form');
    }
}