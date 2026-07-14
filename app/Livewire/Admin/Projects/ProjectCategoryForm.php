<?php

namespace App\Livewire\Admin\Projects;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\ProjectCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Project Category Form - Admin Panel')]
class ProjectCategoryForm extends Component
{
    use WithFileUploads;

    public $categoryId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    public $pc_image;
    public $imagePreview;
    
    #[Validate('required|string|max:255')]
    public $pc_name = '';
    
    #[Validate('nullable|string|max:255')]
    public $pc_slug = '';
    
    #[Validate('nullable|string')]
    public $pc_description = '';
    
    #[Validate('nullable|integer|min:0')]
    public $sort_order = 0;
    
    #[Validate('boolean')]
    public $is_active = true;

    public function mount($categoryId = null)
    {
        if ($categoryId) {
            $category = $categoryId instanceof ProjectCategory ? $categoryId : ProjectCategory::find($categoryId);
            
            if ($category) {
                $this->categoryId = $category->id;
                $this->isEditing = true;
                
                foreach (['pc_name', 'pc_slug', 'pc_description', 'sort_order', 'is_active'] as $field) {
                    if (isset($category->$field)) {
                        $this->$field = $category->$field;
                    }
                }
                
                $this->imagePreview = $category->image_url;
            }
        }
    }

    public function updatedPcName()
    {
        if (!$this->isEditing || empty($this->pc_slug)) {
            $this->pc_slug = Str::slug($this->pc_name);
        }
    }

    public function generateSlug()
    {
        $this->pc_slug = Str::slug($this->pc_name);
    }

    public function updatedPcImage()
    {
        $this->validateOnly('pc_image', ['pc_image' => 'image|max:2048']);
        try {
            $this->imagePreview = $this->pc_image->temporaryUrl();
        } catch (\Exception $e) {
            Log::error('Preview error: ' . $e->getMessage());
        }
    }

    public function removeImage()
    {
        $this->pc_image = null;
        $this->imagePreview = null;
    }

    public function save()
    {
        $rules = [
            'pc_name' => 'required|string|max:255',
            'pc_slug' => 'required|string|max:255|unique:project_category,pc_slug,' . $this->categoryId,
        ];
        
        if ($this->pc_image) {
            $rules['pc_image'] = 'image|mimes:jpeg,png,jpg,webp|max:2048';
        }
        
        $this->validate($rules);
        $this->isSaving = true;
        
        try {
            $category = $this->isEditing ? ProjectCategory::findOrFail($this->categoryId) : new ProjectCategory();
            
            $category->pc_name = $this->pc_name;
            $category->pc_slug = $this->pc_slug ?: Str::slug($this->pc_name);
            $category->pc_description = $this->pc_description;
            $category->sort_order = (int) ($this->sort_order ?? 0);
            $category->is_active = (bool) $this->is_active;
            
            if ($this->pc_image) {
                if ($category->pc_image) {
                    @unlink(public_path('uploads/project-categories/' . $category->pc_image));
                }
                
                $imageName = 'pcat_' . time() . '_' . uniqid() . '.' . $this->pc_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/project-categories');
                
                if (!is_dir($destinationPath)) mkdir($destinationPath, 0777, true);
                
                $tempFile = $this->pc_image->getRealPath();
                copy($tempFile, $destinationPath . '/' . $imageName);
                @unlink($tempFile);
                
                $category->pc_image = $imageName;
            }
            
            $category->save();
            $this->isSaving = false;
            
            $message = $this->isEditing ? 'Category updated successfully!' : 'Category created successfully!';
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            $this->dispatch($this->isEditing ? 'project-category-updated' : 'project-category-created');
            
            return redirect()->route('admin.projects.categories.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Project Category save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.projects.category-form');
    }
}