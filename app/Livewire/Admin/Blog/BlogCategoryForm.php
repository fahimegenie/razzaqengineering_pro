<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\BlogCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Blog Category Form - Admin Panel')]
class BlogCategoryForm extends Component
{
    use WithFileUploads;

    public $categoryId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    public $bc_image;
    public $imagePreview;
    
    #[Validate('required|string|max:255')]
    public $bc_name = '';
    
    #[Validate('nullable|string|max:255')]
    public $bc_slug = '';
    
    #[Validate('nullable|string')]
    public $bc_description = '';
    
    #[Validate('nullable|string|max:20')]
    public $bc_color = '#0056b3';
    
    #[Validate('nullable|exists:blog_categories,id')]
    public $parent_id = null;
    
    #[Validate('nullable|string|max:255')]
    public $meta_title = '';
    
    #[Validate('nullable|string|max:500')]
    public $meta_description = '';
    
    #[Validate('nullable|string|max:500')]
    public $meta_keywords = '';
    
    #[Validate('nullable|integer|min:0')]
    public $sort_order = 0;
    
    #[Validate('boolean')]
    public $is_active = true;
    
    #[Validate('boolean')]
    public $is_featured = false;
    
    public $parentCategories = [];

    public function mount($categoryId = null)
    {
        $this->parentCategories = BlogCategory::where('id', '!=', $this->categoryId)
            ->orderBy('bc_name')
            ->get();
        
        if ($categoryId) {
            $category = $categoryId instanceof BlogCategory ? $categoryId : BlogCategory::find($categoryId);
            
            if ($category) {
                $this->categoryId = $category->id;
                $this->isEditing = true;
                
                $fillable = [
                    'bc_name', 'bc_slug', 'bc_description', 'bc_color',
                    'parent_id', 'meta_title', 'meta_description', 'meta_keywords',
                    'sort_order', 'is_active', 'is_featured',
                ];
                
                foreach ($fillable as $field) {
                    if (isset($category->$field)) {
                        $this->$field = $category->$field;
                    }
                }
                
                $this->imagePreview = $category->image_url;
            }
        }
    }

    public function updatedBcName()
    {
        if (!$this->isEditing || empty($this->bc_slug)) {
            $this->bc_slug = Str::slug($this->bc_name);
        }
    }

    public function generateSlug()
    {
        $this->bc_slug = Str::slug($this->bc_name);
    }

    public function updatedBcImage()
    {
        $this->validateOnly('bc_image', ['bc_image' => 'image|max:2048']);
        try {
            $this->imagePreview = $this->bc_image->temporaryUrl();
        } catch (\Exception $e) {
            Log::error('Preview error: ' . $e->getMessage());
        }
    }

    public function removeImage()
    {
        $this->bc_image = null;
        $this->imagePreview = null;
    }

    public function save()
    {
        $rules = [
            'bc_name' => 'required|string|max:255',
            'bc_slug' => 'required|string|max:255|unique:blog_categories,bc_slug,' . $this->categoryId,
        ];
        
        if ($this->bc_image) {
            $rules['bc_image'] = 'image|mimes:jpeg,png,jpg,webp|max:2048';
        }
        
        $this->validate($rules);
        $this->isSaving = true;
        
        try {
            $category = $this->isEditing ? BlogCategory::findOrFail($this->categoryId) : new BlogCategory();
            
            $textFields = [
                'bc_name', 'bc_slug', 'bc_description', 'bc_color',
                'parent_id', 'meta_title', 'meta_description', 'meta_keywords',
            ];
            
            foreach ($textFields as $field) {
                if (property_exists($this, $field)) {
                    $category->$field = $this->$field ?: null;
                }
            }
            
            $category->sort_order = (int) ($this->sort_order ?? 0);
            $category->is_active = (bool) $this->is_active;
            $category->is_featured = (bool) $this->is_featured;
            
            if ($this->bc_image) {
                if ($category->bc_image) {
                    $oldPath = public_path('uploads/blog/categories/' . $category->bc_image);
                    if (file_exists($oldPath)) @unlink($oldPath);
                }
                
                $imageName = 'category_' . time() . '_' . uniqid() . '.' . $this->bc_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/blog/categories');
                
                if (!is_dir($destinationPath)) mkdir($destinationPath, 0777, true);
                
                $this->bc_image->storeAs('uploads/blog/categories', $imageName, 'public');
                $category->bc_image = $imageName;
            }
            
            $category->save();
            $this->isSaving = false;
            
            $message = $this->isEditing ? 'Category updated successfully!' : 'Category created successfully!';
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            $this->dispatch($this->isEditing ? 'category-updated' : 'category-created');
            
            return redirect()->route('admin.blog.categories.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Category save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.blog.category-form');
    }
}