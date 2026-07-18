<?php

namespace App\Livewire\Admin\Projects;

use Livewire\Component;
use App\Traits\HandlesUploads; // Trait ko apply kiya
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.admin-layout')]
#[Title('Project Form - Admin Panel')]
class ProjectForm extends Component
{
    use HandlesUploads; // Trait integrate ho gaya (WithFileUploads included hai)

    public $projectId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    public $p_image;
    public $existing_image = null; // Main project image tracker
    public $imagePreview;
    public $galleryImages = [];
    public $galleryPreviews = [];
    
    #[Validate('required|string|max:255')]
    public $p_title = '';
    
    #[Validate('nullable|string|max:255')]
    public $p_slug = '';
    
    #[Validate('nullable|string')]
    public $p_description = '';
    
    #[Validate('nullable|string')]
    public $p_short_description = '';
    
    #[Validate('nullable|string|max:255')]
    public $p_category = '';
    
    #[Validate('nullable|exists:project_category,id')]
    public $pc_id = null;
    
    #[Validate('nullable|string|max:255')]
    public $p_location = '';
    
    #[Validate('nullable|string|max:255')]
    public $p_client = '';
    
    #[Validate('nullable|date')]
    public $p_start_date = null;
    
    #[Validate('nullable|date')]
    public $p_end_date = null;
    
    #[Validate('required|string|in:completed,ongoing,planning,on-hold,cancelled')]
    public $p_status = 'completed';
    
    public $existingGallery = [];
    
    #[Validate('nullable|integer|min:0')]
    public $sort_order = 0;
    
    #[Validate('boolean')]
    public $is_active = true;
    
    #[Validate('boolean')]
    public $is_featured = false;
    
    public $categories = [];

    public function mount($projectId = null)
    {
        $this->categories = ProjectCategory::active()->orderBy('pc_name')->get();
        
        if ($projectId) {
            $project = $projectId instanceof Project ? $projectId : Project::find($projectId);
            
            if ($project) {
                $this->projectId = $project->id;
                $this->isEditing = true;
                
                $fillable = [
                    'p_title', 'p_slug', 'p_description', 'p_short_description',
                    'p_category', 'pc_id', 'p_location', 'p_client',
                    'p_start_date', 'p_end_date', 'p_status',
                    'sort_order', 'is_active', 'is_featured',
                ];
                
                foreach ($fillable as $field) {
                    if (isset($project->$field)) {
                        $this->$field = $project->$field;
                    }
                }
                
                // Format dates for input
                if ($this->p_start_date) {
                    $this->p_start_date = $project->p_start_date->format('Y-m-d');
                }
                if ($this->p_end_date) {
                    $this->p_end_date = $project->p_end_date->format('Y-m-d');
                }
                
                // Main image aur existing gallery track karna
                $this->existing_image = $project->p_image;

                if ($this->existing_image) {
                    $this->imagePreview = $project->image_url;
                } else {
                    $this->imagePreview = $project->image_url;
                }

                // Gallery files decoded array format me handle karna
                if ($project->p_gallery) {
                    $decoded = is_array($project->p_gallery) ? $project->p_gallery : json_decode($project->p_gallery, true);
                    $this->existingGallery = $decoded ?? [];
                }
            }
        }
    }

    public function updatedPTitle()
    {
        if (!$this->isEditing || empty($this->p_slug)) {
            $this->p_slug = Str::slug($this->p_title);
        }
    }

    public function generateSlug() { $this->p_slug = Str::slug($this->p_title); }

    public function updatedPImage()
    {
        $this->validateOnly('p_image', ['p_image' => 'image|max:5120']);
        try { 
            $this->imagePreview = $this->p_image->temporaryUrl(); 
        } catch (\Exception $e) {}
    }

    public function updatedGalleryImages()
    {
        $this->validateOnly('galleryImages.*', ['galleryImages.*' => 'image|max:2048']);
        $this->galleryPreviews = [];
        foreach ($this->galleryImages as $image) {
            try { 
                $this->galleryPreviews[] = $image->temporaryUrl(); 
            } catch (\Exception $e) {}
        }
    }

    public function removeImage() { $this->p_image = null; $this->imagePreview = null; }
    
    public function removeGalleryImage($index)
    {
        unset($this->galleryImages[$index]);
        unset($this->galleryPreviews[$index]);
        $this->galleryImages = array_values($this->galleryImages);
        $this->galleryPreviews = array_values($this->galleryPreviews);
    }

    public function removeExistingGalleryImage($index)
    {
        $imageToDelete = $this->existingGallery[$index] ?? null;
        if ($imageToDelete) {
            // Storage se purani gallery image physically clean karna
            $this->deleteFile($imageToDelete);
        }
        unset($this->existingGallery[$index]);
        $this->existingGallery = array_values($this->existingGallery);
    }

    public function save()
    {
        $rules = [
            'p_title' => 'required|string|max:255',
            'p_status' => 'required|string|in:completed,ongoing,planning,on-hold,cancelled',
        ];
        
        if ($this->p_image) $rules['p_image'] = 'image|mimes:jpeg,png,jpg,webp|max:5120';
        
        $this->validate($rules);
        $this->isSaving = true;
        
        try {
            $project = $this->isEditing ? Project::findOrFail($this->projectId) : new Project();
            
            $textFields = [
                'p_title', 'p_slug', 'p_description', 'p_short_description',
                'p_category', 'pc_id', 'p_location', 'p_client',
                'p_start_date', 'p_end_date', 'p_status',
            ];
            
            foreach ($textFields as $field) {
                if (property_exists($this, $field)) {
                    $project->$field = $this->$field ?: null;
                }
            }
            
            $project->sort_order = (int) ($this->sort_order ?? 0);
            $project->is_active = (bool) $this->is_active;
            $project->is_featured = (bool) $this->is_featured;
            
            // Main Image Upload (Standard handlesUploads integration)
            if ($this->p_image) {
                $project->p_image = $this->uploadFile($this->p_image, 'projects', $this->existing_image);
            }
            
            // Gallery Images Upload
            $galleryData = array_values($this->existingGallery);
            if (count($this->galleryImages) > 0) {
                foreach ($this->galleryImages as $image) {
                    // Ek ek gallery image upload aur path collection
                    $galleryData[] = $this->uploadFile($image, 'projects/gallery');
                }
            }
            $project->p_gallery = json_encode($galleryData);
            
            $project->save();
            $this->isSaving = false;
            
            $message = $this->isEditing ? 'Project updated successfully!' : 'Project created successfully!';
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            $this->dispatch($this->isEditing ? 'project-updated' : 'project-created');
            
            return redirect()->route('admin.projects.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Project save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.projects.project-form');
    }
}