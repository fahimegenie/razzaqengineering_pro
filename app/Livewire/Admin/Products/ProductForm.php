<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use App\Traits\HandlesUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Product Form - Admin Panel')]
class ProductForm extends Component
{
    use HandlesUploads;

    public $productId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    public $p_image;
    public $existing_image = null;
    public $imagePreview;
    public $galleryImages = [];
    public $galleryPreviews = [];
    
    public $p_name = '';
    public $p_slug = '';
    public $p_description = '';
    public $p_short_description = '';
    public $p_price = '';
    public $price_to = '';
    public $brand_name = '';
    public $p_contact = '';
    public $pc_type = '';
    public $product_category_id = null;
    public $p_specifications_input = '';
    public $specifications = [];
    public $existingGallery = [];
    public $sort_order = 0;
    public $in_stock = true;
    public $is_active = true;
    public $is_featured = false;
    public $categories = [];
    
    // Price validation message
    public $priceValidationMessage = '';

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
                    'p_price', 'price_to', 'brand_name', 'p_contact', 'pc_type', 'product_category_id',
                    'sort_order', 'in_stock', 'is_active', 'is_featured',
                ];
                
                foreach ($fillable as $field) {
                    if (isset($product->$field)) {
                        $this->$field = $product->$field;
                    }
                }
                
                $this->specifications = $product->specifications_list;
                $this->p_specifications_input = '';
                
                $this->existing_image = $product->p_image;
                if ($this->existing_image) {
                    $this->imagePreview = $product->image_url;
                } else {
                    $this->imagePreview = $product->image_url;
                }

                if ($product->p_gallery) {
                    $decoded = is_array($product->p_gallery) ? $product->p_gallery : json_decode($product->p_gallery, true);
                    $this->existingGallery = $decoded ?? [];
                }
                
                // Validate price on mount
                $this->validatePriceRange();
            }
        }
    }

    /**
     * Validate price range - Price To must be >= Price From
     */
    public function validatePriceRange()
    {
        $this->priceValidationMessage = '';
        
        // If both are empty or only p_price is set
        if (empty($this->p_price) && empty($this->price_to)) {
            return;
        }
        
        // If price_to is set but p_price is empty
        if (empty($this->p_price) && !empty($this->price_to)) {
            $this->priceValidationMessage = 'Price From must be set when Price To is specified.';
            $this->addError('p_price', 'Price From is required when Price To is set.');
            return;
        }
        
        // If both are set, validate that price_to >= p_price
        if (!empty($this->p_price) && !empty($this->price_to)) {
            $from = (float) $this->p_price;
            $to = (float) $this->price_to;
            
            if ($to < $from) {
                $this->priceValidationMessage = "Price To ({$this->price_to}) must be greater than or equal to Price From ({$this->p_price}).";
                $this->addError('price_to', 'Price To must be greater than or equal to Price From.');
                return;
            }
        }
        
        $this->priceValidationMessage = '';
    }

    /**
     * Listen to p_price updates
     */
    public function updatedPPrice()
    {
        $this->validatePriceRange();
    }

    /**
     * Listen to price_to updates
     */
    public function updatedPriceTo()
    {
        $this->validatePriceRange();
    }

    public function updatedPName()
    {
        if (!$this->isEditing || empty($this->p_slug)) {
            $this->p_slug = Str::slug($this->p_name);
        }
    }

    public function generateSlug() 
    { 
        $this->p_slug = Str::slug($this->p_name); 
    }

    public function updatedPImage()
    {
        $this->validateOnly('p_image', ['p_image' => 'image|max:5120']);
        try { 
            $this->imagePreview = $this->p_image->temporaryUrl(); 
        } catch (\Exception $e) { 
            Log::error('Preview error: ' . $e->getMessage()); 
        }
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

    public function removeImage() 
    { 
        $this->p_image = null; 
        $this->imagePreview = null; 
    }
    
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
            $this->deleteFile($imageToDelete);
        }
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
        // First validate all fields
        $rules = [
            'p_name' => 'required|string|max:255',
            'brand_name' => 'required|string|max:255',
            'product_category_id' => 'nullable|exists:product_category,id',
            'p_price' => 'nullable|numeric|min:0',
            'price_to' => 'nullable|numeric|min:0',
        ];
        
        if ($this->p_image) {
            $rules['p_image'] = 'image|mimes:jpeg,png,jpg,webp|max:5120';
        }
        
        $this->validate($rules);
        
        // Run price validation
        $this->validatePriceRange();
        
        // If there's a price validation error, prevent saving
        if ($this->priceValidationMessage) {
            $this->addError('price_to', $this->priceValidationMessage);
            return;
        }
        
        $this->isSaving = true;
        
        try {
            $product = $this->isEditing ? Product::findOrFail($this->productId) : new Product();
            
            $textFields = [
                'p_name', 'p_slug', 'p_description', 'p_short_description',
                'p_price', 'price_to', 'brand_name', 'p_contact', 'pc_type', 'product_category_id',
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
                $product->p_image = $this->uploadFile($this->p_image, 'products', $this->existing_image);
            }
            
            // Gallery Images
            $galleryData = array_values($this->existingGallery);
            if (count($this->galleryImages) > 0) {
                foreach ($this->galleryImages as $image) {
                    $galleryData[] = $this->uploadFile($image, 'products/gallery');
                }
            }
            $product->p_gallery = json_encode(array_values($galleryData));
            
            $product->save();
            $this->isSaving = false;
            
            $message = $this->isEditing ? 'Product updated successfully!' : 'Product created successfully!';
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            
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