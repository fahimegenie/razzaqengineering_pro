<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SeoData;
use App\Models\Service;
use App\Traits\HasDynamicSEO;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

#[Layout('components.layouts.app-layout', ['seo' => []])]
class ProductDetailPage extends Component
{
    use HasDynamicSEO;
    
    public $productSlug = null;
    public $product = null;
    public $relatedProducts = [];
    public $productCategories = [];
    public $services = [];
    public $seo = null;
    public $pc = [];
    public $isLoading = true;
    public $errorMessage = '';
    public $galleryImages = [];
    public $activeGalleryImage = null;
    public $specifications = [];

    public function mount($slug = null)
    {
        try {
            $this->isLoading = true;
            $this->productSlug = $slug;
            $this->initializeSEO('product_detail');

            if ($slug) {
                $this->product = $this->findProduct($slug);

                if (!$this->product) {
                    $this->errorMessage = 'Product not found. Please check the URL or browse our <a href="' . route('products') . '">products</a>.';
                    $this->isLoading = false;
                    return;
                }

                // Get gallery images
                if ($this->product->p_gallery) {
                    $this->galleryImages = is_array($this->product->p_gallery) 
                        ? $this->product->p_gallery 
                        : json_decode($this->product->p_gallery, true) ?? [];
                }

                // Get specifications
                if ($this->product->p_specifications) {
                    $this->specifications = is_array($this->product->p_specifications) 
                        ? $this->product->p_specifications 
                        : json_decode($this->product->p_specifications, true) ?? [];
                }

                // Get related products
                $this->relatedProducts = Product::active()
                    ->where('id', '!=', $this->product->id)
                    ->where(function ($q) {
                        if ($this->product->pc_type) {
                            $q->where('pc_type', $this->product->pc_type);
                        }
                        if ($this->product->product_category_id) {
                            $q->orWhere('product_category_id', $this->product->product_category_id);
                        }
                    })
                    ->orderBy('created_at', 'DESC')
                    ->limit(4)
                    ->get();

                $this->productCategories = ProductCategory::active()->get();
                $this->services = Service::active()->ordered()->get();
                $this->seo = SeoData::where('seo_page_type', 'Product - ' . $this->product->p_name)->first();
                $this->pc = ProductCategory::active()->select('pc_name')->get();

            } else {
                $this->errorMessage = 'No product specified. Please <a href="' . route('products') . '">browse our products</a>.';
            }

            $this->isLoading = false;

        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load product details.';
            $this->isLoading = false;
            Log::error('ProductDetail error: ' . $e->getMessage());
        }
    }

    /**
     * Find product by multiple possible matches
     * Priority: ProductCategory slug → Product slug → Name → ID → Fuzzy
     */
    private function findProduct($slug)
    {
        Log::info('Finding product with slug: ' . $slug);
        
        // ============================================
        // STEP 1: CHECK PRODUCT CATEGORY SLUG FIRST
        // ============================================
        $category = ProductCategory::where('pc_slug', $slug)->first();

        if ($category) {
            
            $product = Product::active()
                ->where(function ($q) use ($category) {
                    $q->where('product_category_id', $category->id)
                      ->orWhere('pc_type', 'like', '%' . $category->pc_name . '%');
                })
                ->orderBy('sort_order', 'ASC')
                ->orderBy('id', 'ASC')
                ->first();
            
            if ($product) {
                Log::info('Product found via category: ' . $product->p_name);
                return $product;
            }
        }

        // ============================================
        // STEP 2: CHECK PRODUCT SLUG/ID/NAME
        // ============================================
        
        // Direct slug match
        $product = Product::where('p_slug', $slug)->first();
        if ($product) return $product;

        // Numeric ID match
        if (is_numeric($slug)) {
            $product = Product::where('id', (int)$slug)->first();
            if ($product) return $product;
        }

        // Convert slug to name format
        $nameFormat = str_replace('-', ' ', $slug);
        
        // Exact name match
        $product = Product::where('p_name', $nameFormat)->first();
        if ($product) return $product;

        // Case-insensitive name match
        $product = Product::whereRaw('LOWER(p_name) = ?', [strtolower($nameFormat)])->first();
        if ($product) return $product;

        // Name LIKE match
        $product = Product::where('p_name', 'like', '%' . $nameFormat . '%')->first();
        if ($product) return $product;

        // Slug LIKE match
        $product = Product::where('p_slug', 'like', '%' . $slug . '%')->first();
        if ($product) return $product;

        // Generated slug comparison
        $product = Product::whereRaw("LOWER(REPLACE(p_name, ' ', '-')) = ?", [strtolower($slug)])->first();
        if ($product) return $product;

        // pc_type match
        $nameCapitalized = ucwords($nameFormat);
        $product = Product::where('pc_type', 'like', '%' . $nameCapitalized . '%')
            ->orWhere('pc_type', 'like', '%' . $nameFormat . '%')
            ->orderBy('sort_order', 'ASC')
            ->first();
        if ($product) return $product;

        // Fuzzy search
        $product = Product::where('p_name', 'like', '%' . $slug . '%')
            ->orWhere('p_slug', 'like', '%' . $slug . '%')
            ->orWhere('pc_type', 'like', '%' . $slug . '%')
            ->first();
        
        return $product;
    }

     /**
     * Open gallery modal
     */
    public function openGallery($imageIndex)
    {
        if (isset($this->galleryImages[$imageIndex])) {
            $this->activeGalleryImage = $imageIndex;
        }
    }

    /**
     * Close gallery modal
     */
    public function closeGallery()
    {
        $this->activeGalleryImage = null;
    }

    /**
     * Next gallery image
     */
    public function nextGalleryImage()
    {
        if ($this->activeGalleryImage !== null && count($this->galleryImages) > 0) {
            $this->activeGalleryImage = ($this->activeGalleryImage + 1) % count($this->galleryImages);
        }
    }

    /**
     * Previous gallery image
     */
    public function prevGalleryImage()
    {
        if ($this->activeGalleryImage !== null && count($this->galleryImages) > 0) {
            $this->activeGalleryImage = ($this->activeGalleryImage - 1 + count($this->galleryImages)) % count($this->galleryImages);
        }
    }

    #[Title('Product Details - Razzaq Engineering Services')]
    public function render()
    {
        $seo = $this->getSeoData();
        return view('livewire.website.product-detail-page')->layoutData(['seo' => $seo]);
    }
}