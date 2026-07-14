<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Blog Post Form - Admin Panel')]
class BlogPostForm extends Component
{
    use WithFileUploads;

    public $postId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    public $featured_image;
    public $banner_image;
    public $imagePreview;
    public $bannerPreview;
    
    #[Validate('required|string|max:255')]
    public $bp_title = '';
    
    #[Validate('nullable|string|max:255')]
    public $bp_slug = '';
    
    #[Validate('nullable|string')]
    public $bp_excerpt = '';
    
    #[Validate('required|string')]
    public $bp_content = '';
    
    #[Validate('required|exists:blog_categories,id')]
    public $category_id = null;
    
    #[Validate('required|exists:users,id')]
    public $author_id = null;
    
    #[Validate('required|string|in:draft,published,scheduled,archived')]
    public $bp_status = 'draft';
    
    #[Validate('nullable|date')]
    public $published_at = null;
    
    #[Validate('nullable|string|max:255')]
    public $video_url = '';
    
    #[Validate('nullable|string|max:50')]
    public $bp_format = 'standard';
    
    #[Validate('nullable|string|max:255')]
    public $meta_title = '';
    
    #[Validate('nullable|string|max:500')]
    public $meta_description = '';
    
    #[Validate('nullable|string|max:500')]
    public $meta_keywords = '';
    
    #[Validate('nullable|url')]
    public $canonical_url = '';
    
    #[Validate('boolean')]
    public $is_featured = false;
    
    #[Validate('boolean')]
    public $is_trending = false;
    
    #[Validate('boolean')]
    public $allow_comments = true;
    
    public $selectedTags = [];
    public $categories = [];
    public $authors = [];
    public $allTags = [];

    public function mount($postId = null)
    {
        $this->categories = BlogCategory::active()->orderBy('bc_name')->get();
        $this->authors = User::orderBy('name')->get();
        $this->allTags = BlogTag::active()->orderBy('bt_name')->get();
        
        if ($postId) {
            $post = $postId instanceof BlogPost ? $postId : BlogPost::find($postId);
            
            if ($post) {
                $this->postId = $post->id;
                $this->isEditing = true;
                
                $fillable = [
                    'bp_title', 'bp_slug', 'bp_excerpt', 'bp_content',
                    'category_id', 'author_id', 'bp_status', 'published_at',
                    'video_url', 'bp_format', 'meta_title', 'meta_description',
                    'meta_keywords', 'canonical_url', 'is_featured', 'is_trending',
                    'allow_comments',
                ];
                
                foreach ($fillable as $field) {
                    if (isset($post->$field)) {
                        $this->$field = $post->$field;
                    }
                }
                
                $this->selectedTags = $post->tags->pluck('id')->toArray();
                $this->imagePreview = $post->image_url;
                $this->bannerPreview = $post->banner_url;
            }
        }
    }

    public function updatedBpTitle()
    {
        if (!$this->isEditing || empty($this->bp_slug)) {
            $this->bp_slug = Str::slug($this->bp_title);
        }
    }

    public function generateSlug()
    {
        $this->bp_slug = Str::slug($this->bp_title);
    }

    public function updatedFeaturedImage()
    {
        $this->validateOnly('featured_image', ['featured_image' => 'image|max:5120']);
        try {
            $this->imagePreview = $this->featured_image->temporaryUrl();
        } catch (\Exception $e) {
            Log::error('Preview error: ' . $e->getMessage());
        }
    }

    public function updatedBannerImage()
    {
        $this->validateOnly('banner_image', ['banner_image' => 'image|max:5120']);
        try {
            $this->bannerPreview = $this->banner_image->temporaryUrl();
        } catch (\Exception $e) {
            Log::error('Banner preview error: ' . $e->getMessage());
        }
    }

    public function removeFeaturedImage()
    {
        $this->featured_image = null;
        $this->imagePreview = null;
    }

    public function removeBannerImage()
    {
        $this->banner_image = null;
        $this->bannerPreview = null;
    }

    public function saveDraft()
    {
        $this->bp_status = 'draft';
        $this->save();
    }

    public function publish()
    {
        $this->bp_status = 'published';
        if (!$this->published_at) {
            $this->published_at = now()->format('Y-m-d H:i:s');
        }
        $this->save();
    }

    public function save()
    {
        $rules = [
            'bp_title' => 'required|string|max:255',
            'bp_content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'author_id' => 'required|exists:users,id',
            'bp_status' => 'required|string|in:draft,published,scheduled,archived',
        ];
        
        if ($this->featured_image) {
            $rules['featured_image'] = 'image|mimes:jpeg,png,jpg,gif,webp|max:5120';
        }
        if ($this->banner_image) {
            $rules['banner_image'] = 'image|mimes:jpeg,png,jpg,gif,webp|max:5120';
        }
        
        $this->validate($rules);
        $this->isSaving = true;
        
        try {
            $post = $this->isEditing ? BlogPost::findOrFail($this->postId) : new BlogPost();
            
            $textFields = [
                'bp_title', 'bp_slug', 'bp_excerpt', 'bp_content',
                'category_id', 'author_id', 'bp_status', 'published_at',
                'video_url', 'bp_format', 'meta_title', 'meta_description',
                'meta_keywords', 'canonical_url',
            ];
            
            foreach ($textFields as $field) {
                if (property_exists($this, $field)) {
                    $post->$field = $this->$field ?: null;
                }
            }
            
            $post->is_featured = (bool) $this->is_featured;
            $post->is_trending = (bool) $this->is_trending;
            $post->allow_comments = (bool) $this->allow_comments;
            
            // Handle Featured Image
            if ($this->featured_image) {
                if ($post->featured_image) {
                    @unlink(public_path('uploads/blog/' . $post->featured_image));
                }
                
                $imageName = 'blog_' . time() . '_' . uniqid() . '.' . $this->featured_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/blog');
                
                if (!is_dir($destinationPath)) mkdir($destinationPath, 0777, true);
                
                $tempFile = $this->featured_image->getRealPath();
                copy($tempFile, $destinationPath . '/' . $imageName);
                @unlink($tempFile);
                
                $post->featured_image = $imageName;
            }
            
            // Handle Banner Image
            if ($this->banner_image) {
                if ($post->banner_image) {
                    @unlink(public_path('uploads/blog/banners/' . $post->banner_image));
                }
                
                $bannerName = 'banner_' . time() . '_' . uniqid() . '.' . $this->banner_image->getClientOriginalExtension();
                $bannerPath = public_path('uploads/blog/banners');
                
                if (!is_dir($bannerPath)) mkdir($bannerPath, 0777, true);
                
                $tempFile = $this->banner_image->getRealPath();
                copy($tempFile, $bannerPath . '/' . $bannerName);
                @unlink($tempFile);
                
                $post->banner_image = $bannerName;
            }
            
            $post->save();
            
            // Sync Tags
            $post->tags()->sync($this->selectedTags);
            
            $this->isSaving = false;
            
            $message = $this->isEditing ? 'Post updated successfully!' : 'Post created successfully!';
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            $this->dispatch($this->isEditing ? 'post-updated' : 'post-created');
            
            return redirect()->route('admin.blog.posts.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Post save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.blog.post-form');
    }
}