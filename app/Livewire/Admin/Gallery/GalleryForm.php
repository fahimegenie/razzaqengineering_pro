<?php

namespace App\Livewire\Admin\Gallery;

use Livewire\Component;
use App\Traits\HandlesUploads; // Cleanup aur dynamic storage trait register kiya
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\WorkGallery;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.admin-layout')]
#[Title('Gallery Item Form - Admin Panel')]
class GalleryForm extends Component
{
    use HandlesUploads; // Trait apply kiya (Contains WithFileUploads internally)

    public $galleryId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    // Image
    public $wg_image;
    public $existing_image = null; // Purani image database path track karne ke liye
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
                
                // Existing image track karna aur safe public URL resolve karna
                $this->existing_image = $item->wg_image;
                if ($this->existing_image) {
                    $this->imagePreview = Storage::disk('public')->url($this->existing_image);
                } else {
                    $this->imagePreview = $item->image_url;
                }
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
            
            // Trait handles automatic storage integration and old file deletion safely
            if ($this->wg_image) {
                $gallery->wg_image = $this->uploadFile(
                    $this->wg_image, 
                    'gallery', 
                    $this->existing_image
                );
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