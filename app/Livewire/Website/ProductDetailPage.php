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
                // Find product by multiple conditions
                $this->product = $this->findProduct($slug);

                if (!$this->product) {
                    $this->errorMessage = 'Product not found. Please check the URL or browse our <a href="' . url('products/p') . '">products</a>.';
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

                // Get related products (same category)
                $this->relatedProducts = Product::active()
                    ->where('p_id', '!=', $this->product->id)
                    ->where(function ($q) {
                        $q->where('pc_type', $this->product->pc_type)
                          ->orWhere('product_category_id', $this->product->product_category_id);
                    })
                    ->orderBy('created_at', 'DESC')
                    ->limit(4)
                    ->get();

                // Load other data
                $this->productCategories = ProductCategory::active()->get();
                $this->services = Service::active()->ordered()->get();
                $this->seo = SeoData::where('seo_page_type', 'Product - ' . $this->product->p_name)->first();
                $this->pc = ProductCategory::active()->select('pc_name')->get();

            } else {
                $this->errorMessage = 'No product specified. Please <a href="' . url('products/p') . '">browse our products</a>.';
            }

            $this->isLoading = false;

        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load product details. Please try again.';
            $this->isLoading = false;
            Log::error('ProductDetail error: ' . $e->getMessage());
        }
    }

    /**
     * Find product by multiple possible matches
     */
    private function findProduct($slug)
    {
        // 1. Direct slug match
        $product = Product::where('p_slug', $slug)->first();
        if ($product) return $product;

        // 2. Numeric ID match
        if (is_numeric($slug)) {
            $product = Product::where('p_id', (int) $slug)->first();
            if ($product) return $product;
        }

        // 3. Convert slug to name format and match
        $nameFormat = str_replace('-', ' ', $slug);
        
        $product = Product::where('p_name', $nameFormat)->first();
        if ($product) return $product;

        // 4. Case-insensitive name match
        $product = Product::whereRaw('LOWER(p_name) = ?', [strtolower($nameFormat)])->first();
        if ($product) return $product;

        // 5. Name LIKE match
        $product = Product::where('p_name', 'like', '%' . $nameFormat . '%')->first();
        if ($product) return $product;

        // 6. Slug comparison
        $product = Product::whereRaw("REPLACE(LOWER(p_name), ' ', '-') = ?", [strtolower($slug)])->first();
        if ($product) return $product;

        // 7. Fuzzy search
        $product = Product::where('p_name', 'like', '%' . $slug . '%')
            ->orWhere('p_slug', 'like', '%' . $slug . '%')
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