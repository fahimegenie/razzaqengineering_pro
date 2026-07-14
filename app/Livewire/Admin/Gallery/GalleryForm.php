<?php

namespace App\Livewire\Admin\Gallery;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\WorkGallery;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Gallery Item Form - Admin Panel')]
class GalleryForm extends Component
{
    use WithFileUploads;

    public $galleryId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    // Image
    public $wg_image;
    public $imagePreview;
    
    #[Validate('required|string|max:255')]
    public $wg_title = '';
    
    #[Validate('required|string|max:50')]
    public $wg_type = 'image';
    
    #[Validate('nullable|string|max:255')]
    public $wg_category = '';
    
    #[Validate('nullable|string')]
    public $wg_description = '';
    
    #[Validate('nullable|integer|min:0')]
    public $sort_order = 0;
    
    #[Validate('boolean')]
    public $is_active = true;
    
    // Type options
    public $typeOptions = [
        'image' => 'Image',
        'video' => 'Video',
        'before-after' => 'Before & After',
        'portfolio' => 'Portfolio',
        'project' => 'Project',
        'design' => 'Design',
        'illustration' => 'Illustration',
        'other' => 'Other',
    ];

    public function mount($galleryId = null)
    {
        if ($galleryId) {
            $item = $galleryId instanceof WorkGallery ? $galleryId : WorkGallery::find($galleryId);
            
            if ($item) {
                $this->galleryId = $item->id;
                $this->isEditing = true;
                
                $fillable = [
                    'wg_title', 'wg_type', 'wg_category', 'wg_description',
                    'sort_order', 'is_active',
                ];
                
                foreach ($fillable as $field) {
                    if (isset($item->$field)) {
                        $this->$field = $item->$field;
                    }
                }
                
                $this->imagePreview = $item->image_url;
            }
        }
    }

    public function updatedWgImage()
    {
        $this->validateOnly('wg_image', ['wg_image' => 'image|max:5120']);
        try {
            $this->imagePreview = $this->wg_image->temporaryUrl();
        } catch (\Exception $e) {
            Log::error('Preview error: ' . $e->getMessage());
        }
    }

    public function removeImage()
    {
        $this->wg_image = null;
        $this->imagePreview = null;
    }

    public function save()
    {
        $rules = [
            'wg_title' => 'required|string|max:255',
            'wg_type' => 'required|string|max:50',
        ];
        
        if (!$this->isEditing) {
            $rules['wg_image'] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120';
        } else {
            $rules['wg_image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120';
        }
        
        $this->validate($rules);
        $this->isSaving = true;
        
        try {
            $gallery = $this->isEditing ? WorkGallery::findOrFail($this->galleryId) : new WorkGallery();
            
            // Text fields
            $textFields = [
                'wg_title', 'wg_type', 'wg_category', 'wg_description',
            ];
            
            foreach ($textFields as $field) {
                if (property_exists($this, $field)) {
                    $gallery->$field = $this->$field ?: null;
                }
            }
            
            $gallery->sort_order = (int) ($this->sort_order ?? 0);
            $gallery->is_active = (bool) $this->is_active;
            
            // Handle Image Upload
            if ($this->wg_image) {
                // Delete old image
                if ($gallery->wg_image) {
                    $oldPaths = [
                        public_path('gallery_images/' . $gallery->wg_image),
                        public_path('uploads/gallery/' . $gallery->wg_image),
                    ];
                    foreach ($oldPaths as $oldPath) {
                        if (file_exists($oldPath)) {
                            @unlink($oldPath);
                        }
                    }
                }
                
                $imageName = 'gallery_' . time() . '_' . uniqid() . '.' . $this->wg_image->getClientOriginalExtension();
                $destinationPath = public_path('gallery_images');
                
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                
                $tempFile = $this->wg_image->getRealPath();
                $targetFile = $destinationPath . '/' . $imageName;
                
                if (!file_exists($tempFile)) {
                    throw new \Exception('Temporary file not found');
                }
                
                if (!copy($tempFile, $targetFile)) {
                    throw new \Exception('Failed to copy image to: ' . $targetFile);
                }
                
                @unlink($tempFile);
                $gallery->wg_image = $imageName;
            }
            
            $gallery->save();
            $this->isSaving = false;
            
            $message = $this->isEditing ? 'Gallery item updated successfully!' : 'Gallery item created successfully!';
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            $this->dispatch($this->isEditing ? 'gallery-updated' : 'gallery-created');
            
            return redirect()->route('admin.gallery.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Gallery save error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.gallery.gallery-form');
    }
}