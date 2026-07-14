<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\BlogTag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Blog Tag Form - Admin Panel')]
class BlogTagForm extends Component
{
    public $tagId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    #[Validate('required|string|max:255')]
    public $bt_name = '';
    
    #[Validate('nullable|string|max:255')]
    public $bt_slug = '';
    
    #[Validate('nullable|string')]
    public $bt_description = '';
    
    #[Validate('nullable|integer|min:0')]
    public $sort_order = 0;
    
    #[Validate('boolean')]
    public $is_active = true;

    public function mount($tagId = null)
    {
        if ($tagId) {
            $tag = $tagId instanceof BlogTag ? $tagId : BlogTag::find($tagId);
            
            if ($tag) {
                $this->tagId = $tag->id;
                $this->isEditing = true;
                
                $fillable = ['bt_name', 'bt_slug', 'bt_description', 'sort_order', 'is_active'];
                
                foreach ($fillable as $field) {
                    if (isset($tag->$field)) {
                        $this->$field = $tag->$field;
                    }
                }
            }
        }
    }

    public function updatedBtName()
    {
        if (!$this->isEditing || empty($this->bt_slug)) {
            $this->bt_slug = Str::slug($this->bt_name);
        }
    }

    public function generateSlug()
    {
        $this->bt_slug = Str::slug($this->bt_name);
    }

    public function save()
    {
        $rules = [
            'bt_name' => 'required|string|max:255',
            'bt_slug' => 'required|string|max:255|unique:blog_tags,bt_slug,' . $this->tagId,
        ];
        
        $this->validate($rules);
        $this->isSaving = true;
        
        try {
            $tag = $this->isEditing ? BlogTag::findOrFail($this->tagId) : new BlogTag();
            
            $tag->bt_name = $this->bt_name;
            $tag->bt_slug = $this->bt_slug ?: Str::slug($this->bt_name);
            $tag->bt_description = $this->bt_description;
            $tag->sort_order = (int) ($this->sort_order ?? 0);
            $tag->is_active = (bool) $this->is_active;
            
            $tag->save();
            $this->isSaving = false;
            
            $message = $this->isEditing ? 'Tag updated successfully!' : 'Tag created successfully!';
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            $this->dispatch($this->isEditing ? 'tag-updated' : 'tag-created');
            
            return redirect()->route('admin.blog.tags.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Tag save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.blog.tag-form');
    }
}