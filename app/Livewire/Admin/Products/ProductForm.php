<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Product Form - Admin Panel')]
class ProductForm extends Component
{
    use WithFileUploads;

    public $productId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    public $p_image;
    public $imagePreview;
    public $galleryImages = [];
    public $galleryPreviews = [];
    
    #[Validate('required|string|max:255')]
    public $p_name = '';
    
    #[Validate('nullable|string|max:255')]
    public $p_slug = '';
    
    #[Validate('nullable|string')]
    public $p_description = '';
    
    #[Validate('nullable|string')]
    public $p_short_description = '';
    
    #[Validate('nullable|string|max:50')]
    public $p_price = '';
    
    #[Validate('nullable|string|max:100')]
    public $p_contact = '';
    
    #[Validate('nullable|string|max:50')]
    public $pc_type = '';
    
    #[Validate('nullable|exists:product_category,id')]
    public $product_category_id = null;
    
    #[Validate('nullable|string')]
    public $p_specifications_input = '';
    
    public $specifications = [];
    public $existingGallery = [];
    
    #[Validate('nullable|integer|min:0')]
    public $sort_order = 0;
    
    #[Validate('boolean')]
    public $in_stock = true;
    
    #[Validate('boolean')]
    public $is_active = true;
    
    #[Validate('boolean')]
    public $is_featured = false;
    
    public $categories = [];

    public function mount($productId = null)
    {
        $this->categories = ProductCategory::active()->orderBy('pc_name')->get();
        
        if ($productId) {
            $product = $productId instanceof Product ? $productId : Product::find($productId);
            
            if ($product) {
                $this->productId = $product->id;
                $this->isEditing = true;
                
                $fillable = [
                    'p_name', 'p_slug', 'p_description', 'p_short_description',
                    'p_price', 'p_contact', 'pc_type', 'product_category_id',
                    'sort_order', 'in_stock', 'is_active', 'is_featured',
                ];
                
                foreach ($fillable as $field) {
                    if (isset($product->$field)) {
                        $this->$field = $product->$field;
                    }
                }
                
                $this->specifications = $product->specifications_list;
                $this->p_specifications_input = '';
                $this->existingGallery = $product->gallery_urls;
                $this->imagePreview = $product->image_url;
            }
        }
    }

    public function updatedPName()
    {
        if (!$this->isEditing || empty($this->p_slug)) {
            $this->p_slug = Str::slug($this->p_name);
        }
    }

    public function generateSlug() { $this->p_slug = Str::slug($this->p_name); }

    public function updatedPImage()
    {
        $this->validateOnly('p_image', ['p_image' => 'image|max:5120']);
        try { $this->imagePreview = $this->p_image->temporaryUrl(); } 
        catch (\Exception $e) { Log::error('Preview error: ' . $e->getMessage()); }
    }

    public function updatedGalleryImages()
    {
        $this->validateOnly('galleryImages.*', ['galleryImages.*' => 'image|max:2048']);
        $this->galleryPreviews = [];
        foreach ($this->galleryImages as $image) {
            try { $this->galleryPreviews[] = $image->temporaryUrl(); } 
            catch (\Exception $e) {}
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
        unset($this->existingGallery[$index]);
        $this->existingGallery = array_values($this->existingGallery);
    }

    public function addSpecification()
    {
        if (!empty($this->p_specifications_input)) {
            $parts = explode(':', $this->p_specifications_input, 2);
            $key = trim($parts[0]);
            $value = trim($parts[1] ?? '');
            
            if (!empty($key)) {
                $this->specifications[$key] = $value;
            }
            $this->p_specifications_input = '';
        }
    }

    public function removeSpecification($key)
    {
        unset($this->specifications[$key]);
    }

    public function save()
    {
        $rules = [
            'p_name' => 'required|string|max:255',
            'product_category_id' => 'nullable|exists:product_category,id',
        ];
        
        if ($this->p_image) $rules['p_image'] = 'image|mimes:jpeg,png,jpg,webp|max:5120';
        
        $this->validate($rules);
        $this->isSaving = true;
        
        try {
            $product = $this->isEditing ? Product::findOrFail($this->productId) : new Product();
            
            $textFields = [
                'p_name', 'p_slug', 'p_description', 'p_short_description',
                'p_price', 'p_contact', 'pc_type', 'product_category_id',
            ];
            
            foreach ($textFields as $field) {
                if (property_exists($this, $field)) {
                    $product->$field = $this->$field ?: null;
                }
            }
            
            $product->sort_order = (int) ($this->sort_order ?? 0);
            $product->in_stock = (bool) $this->in_stock;
            $product->is_active = (bool) $this->is_active;
            $product->is_featured = (bool) $this->is_featured;
            $product->p_specifications = json_encode($this->specifications);
            
            // Main Image
            if ($this->p_image) {
                if ($product->p_image) @unlink(public_path('uploads/products/' . $product->p_image));
                
                $imageName = 'prod_' . time() . '_' . uniqid() . '.' . $this->p_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/products');
                if (!is_dir($destinationPath)) mkdir($destinationPath, 0777, true);
                
                $tempFile = $this->p_image->getRealPath();
                copy($tempFile, $destinationPath . '/' . $imageName);
                @unlink($tempFile);
                $product->p_image = $imageName;
            }
            
            // Gallery Images
            $galleryData = $this->existingGallery;
            if (count($this->galleryImages) > 0) {
                $galleryPath = public_path('uploads/products/gallery');
                if (!is_dir($galleryPath)) mkdir($galleryPath, 0777, true);
                
                foreach ($this->galleryImages as $image) {
                    $galleryName = 'gal_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $tempFile = $image->getRealPath();
                    copy($tempFile, $galleryPath . '/' . $galleryName);
                    @unlink($tempFile);
                    $galleryData[] = $galleryName;
                }
            }
            $product->p_gallery = json_encode(array_values($galleryData));
            
            $product->save();
            $this->isSaving = false;
            
            $message = $this->isEditing ? 'Product updated successfully!' : 'Product created successfully!';
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            $this->dispatch($this->isEditing ? 'product-updated' : 'product-created');
            
            return redirect()->route('admin.products.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Product save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.products.product-form');
    }
}