<div class="pdp-page" 
     x-data="{ 
        showFullDesc: false,
        showAllSpecs: false,
        galleryOpen: @entangle('activeGalleryImage'),
        
        openGallery(index) { $wire.openGallery(index); },
        closeGallery() { $wire.closeGallery(); },
        nextImage() { $wire.nextGalleryImage(); },
        prevImage() { $wire.prevGalleryImage(); },
        
        handleKeydown(e) {
            if (this.galleryOpen !== null) {
                if (e.key === 'Escape') this.closeGallery();
                if (e.key === 'ArrowRight') this.nextImage();
                if (e.key === 'ArrowLeft') this.prevImage();
            }
        }
     }"
     @keydown.window="handleKeydown">
    
    {{-- ============================================
         STICKY MOBILE CTA
         ============================================ --}}
    <div class="pdp-mobile-cta d-lg-none">
        <a href="tel:+923048902805" class="pdp-mobile-btn pdp-mobile-call">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/923048902805" target="_blank" class="pdp-mobile-btn pdp-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="{{ route('quote.index') }}" class="pdp-mobile-btn pdp-mobile-quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    {{-- ============================================
         HERO SECTION
         ============================================ --}}
    <section class="pdp-hero">
        <div class="pdp-hero-bg" style="background-image: url('{{ $product->image_url ?? asset('images/hero-products.jpg') }}');"></div>
        <div class="pdp-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-30">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="pdp-breadcrumb">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li><a href="{{ route('products') }}">Products</a></li>
                            @if($product && $product->pc_type)
                                <li><a href="{{ url('products?category='.Str::slug($product->pc_type)) }}">{{ $product->pc_type }}</a></li>
                            @endif
                            <li class="active">{{ $product->p_name ?? 'Product Details' }}</li>
                        </ol>
                    </nav>
                    
                    <div class="pdp-hero-badge">
                        <i class="fas fa-box"></i> 
                        {{ $product->pc_type ?? 'Product' }}
                        @if($product)
                            <span class="pdp-hero-stock status-{{ $product->in_stock ? 'in' : 'out' }}">
                                {{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        @endif
                    </div>
                    
                    <h1 class="pdp-hero-title">{{ $product->p_name ?? 'Product Details' }}</h1>
                    
                    <p class="pdp-hero-subtitle">{!! $product->p_short_description ?? 'High-quality engineering equipment from Razzaq Engineering Services.' !!}</p>
                    
                    <div class="pdp-hero-meta">
                        @if($product && $product->brand_name)
                            <span><i class="fas fa-tag"></i> Brand: {{ $product->brand_name }}</span>
                        @endif
                        @if($product && $product->pc_type)
                            <span><i class="fas fa-th-large"></i> {{ $product->pc_type }}</span>
                        @endif
                    </div>
                    
                    <div class="pdp-hero-cta">
                        <a href="{{ route('quote.index') }}" class="pdp-btn pdp-btn-lg pdp-btn-accent">
                            <i class="fas fa-paper-plane me-2"></i> Get Price Quote
                        </a>
                        @if($product && $product->p_contact)
                            <a href="tel:{{ $product->p_contact }}" class="pdp-btn pdp-btn-lg pdp-btn-white-outline">
                                <i class="fas fa-phone-alt me-2"></i> {{ $product->p_contact }}
                            </a>
                        @else
                            <a href="tel:+923048902805" class="pdp-btn pdp-btn-lg pdp-btn-white-outline">
                                <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-block text-center" data-aos="fade-left">
                    <div class="pdp-hero-image-wrapper">
                        <img src="{{ $product->image_url ?? asset('images/product-default.jpg') }}" 
                             alt="{{ $product->p_name ?? 'Product' }}" 
                             class="pdp-hero-image"
                             loading="eager">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         TRUST BAR
         ============================================ --}}
    <section class="pdp-trust-bar">
        <div class="container">
            <div class="pdp-trust-grid">
                <div class="pdp-trust-card">
                    <div class="pdp-trust-icon"><i class="fas fa-certificate"></i></div>
                    <div>
                        <strong>Genuine</strong>
                        <span>Products</span>
                    </div>
                </div>
                <div class="pdp-trust-card">
                    <div class="pdp-trust-icon"><i class="fas fa-truck"></i></div>
                    <div>
                        <strong>Nationwide</strong>
                        <span>Delivery</span>
                    </div>
                </div>
                <div class="pdp-trust-card">
                    <div class="pdp-trust-icon"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <strong>Warranty</strong>
                        <span>Assured</span>
                    </div>
                </div>
                <div class="pdp-trust-card">
                    <div class="pdp-trust-icon"><i class="fas fa-headset"></i></div>
                    <div>
                        <strong>24/7</strong>
                        <span>Support</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         MAIN CONTENT
         ============================================ --}}
    <section class="pdp-main-section">
        <div class="container">
            
            @if($isLoading)
                <div class="pdp-state-box">
                    <div class="spinner-grow text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-3 fw-semibold">Loading product details...</p>
                </div>
            
            @elseif($errorMessage)
                <div class="pdp-error-card">
                    <i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;"></i>
                    <h4 class="fw-bold mt-3">Oops! Something went wrong</h4>
                    <p class="text-muted">{!! $errorMessage !!}</p>
                    <a href="{{ route('products') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-left me-2"></i> Back to Products
                    </a>
                </div>
            
            @elseif($product)
                <div class="row g-4">
                    
                    {{-- LEFT: Main Content --}}
                    <div class="col-lg-8">
                        
                        {{-- Product Image Card --}}
                        <div class="pdp-content-card" data-aos="fade-up">
                            <div class="pdp-image-hero">
                                <img src="{{ $product->image_url }}" 
                                     alt="{{ $product->p_name }}" 
                                     class="pdp-img-full"
                                     loading="lazy">
                                @if(count($galleryImages) > 0)
                                    <button class="pdp-gallery-trigger" @click="openGallery(0)">
                                        <i class="fas fa-images me-2"></i> View Gallery ({{ count($galleryImages) }} photos)
                                    </button>
                                @endif
                                <div class="pdp-image-gradient"></div>
                            </div>
                            
                            <div class="pdp-content-body">
                                <h2 class="pdp-section-title">Product Description</h2>
                                
                                <div class="pdp-description">
                                    {!! Str::words(strip_tags($product->p_description ?? ''), 80, '...') !!}
                                </div>
                                
                                @if($product->p_description && Str::wordCount(strip_tags($product->p_description)) > 80)
                                    <div x-show="showFullDesc" x-transition class="pdp-description">
                                        {!! $product->p_description !!}
                                    </div>
                                    <button @click="showFullDesc = !showFullDesc" 
                                            class="pdp-read-more"
                                            x-text="showFullDesc ? 'Show Less' : 'Read Full Description'">
                                    </button>
                                @endif
                                
                                {{-- Price + Mid CTA --}}
                                <div class="pdp-price-cta">
                                    <div class="pdp-price-display">
                                        <span class="pdp-price-label">Price</span>
                                        <span class="pdp-price-value">
                                            @if($product->p_price)
                                                Rs. {{ number_format((float)$product->p_price) }}
                                                @if($product->price_to)
                                                    <span class="pdp-price-sep">-</span>
                                                    Rs. {{ number_format((float)$product->price_to) }}
                                                @endif
                                            @else
                                                On Request
                                            @endif
                                        </span>
                                    </div>
                                    <a href="tel:{{ $product->p_contact ?? '+923048902805' }}" class="pdp-btn pdp-btn-accent">
                                        <i class="fas fa-phone-alt me-2"></i> Call for Price
                                    </a>
                                </div>
                                
                                {{-- Product Info Grid --}}
                                <div class="pdp-info-grid">
                                    @if($product->brand_name)
                                        <div class="pdp-info-item-card">
                                            <i class="fas fa-tag"></i>
                                            <span>Brand</span>
                                            <strong>{{ $product->brand_name }}</strong>
                                        </div>
                                    @endif
                                    @if($product->pc_type)
                                        <div class="pdp-info-item-card">
                                            <i class="fas fa-th-large"></i>
                                            <span>Category</span>
                                            <strong>{{ $product->pc_type }}</strong>
                                        </div>
                                    @endif
                                    <div class="pdp-info-item-card">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Availability</span>
                                        <strong class="{{ $product->in_stock ? 'text-success' : 'text-danger' }}">
                                            {{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}
                                        </strong>
                                    </div>
                                    @if($product->p_contact)
                                        <div class="pdp-info-item-card">
                                            <i class="fas fa-phone-alt"></i>
                                            <span>Contact</span>
                                            <strong>{{ $product->p_contact }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        {{-- Specifications Card --}}
                        @if(count($specifications) > 0)
                            <div class="pdp-content-card" data-aos="fade-up">
                                <div class="pdp-content-body">
                                    <h3 class="pdp-section-title">Technical Specifications</h3>
                                    <div class="pdp-specs-table">
                                        @foreach(array_slice($specifications, 0, $showAllSpecs ? count($specifications) : 6) as $spec)
                                            <div class="pdp-spec-row">
                                                <span class="pdp-spec-key">{{ $spec['key'] ?? $spec['label'] ?? 'Specification' }}</span>
                                                <span class="pdp-spec-value">{{ $spec['value'] ?? $spec ?? '' }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if(count($specifications) > 6)
                                        <button @click="showAllSpecs = !showAllSpecs" 
                                                class="pdp-read-more mt-3"
                                                x-text="showAllSpecs ? 'Show Less Specifications' : 'View All Specifications'">
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endif
                        
                        {{-- Gallery Grid --}}
                        @if(count($galleryImages) > 0)
                            <div class="pdp-content-card" data-aos="fade-up">
                                <div class="pdp-content-body">
                                    <h3 class="pdp-section-title">Product Gallery</h3>
                                    <div class="pdp-gallery-grid">
                                        @foreach($galleryImages as $index => $img)
                                            <div class="pdp-gallery-item" @click="openGallery({{ $index }})">
                                                <img src="{{ asset($img) }}" 
                                                     alt="Gallery {{ $index + 1 }}" 
                                                     loading="lazy">
                                                <div class="pdp-gallery-item-overlay">
                                                    <i class="fas fa-search-plus"></i>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                    </div>
                    
                    {{-- RIGHT: Sticky Sidebar --}}
                    <div class="col-lg-4">
                        <div class="pdp-sidebar">
                            {{-- Quick Quote --}}
                            <div class="pdp-sidebar-card pdp-sidebar-cta">
                                <i class="fas fa-file-invoice pdp-sidebar-icon"></i>
                                <h4>Get Best Price</h4>
                                <p>Contact us for the best price and delivery options</p>
                                <a href="{{ route('quote.index') }}" class="pdp-btn pdp-btn-accent w-100">
                                    <i class="fas fa-paper-plane me-2"></i> Request Quote
                                </a>
                            </div>
                            
                            {{-- Quick Contact --}}
                            <div class="pdp-sidebar-card">
                                <h5 class="pdp-sidebar-title">Quick Contact</h5>
                                <div class="pdp-contact-list">
                                    <a href="tel:{{ $product->p_contact ?? '+923048902805' }}" class="pdp-contact-item">
                                        <i class="fas fa-phone-alt"></i>
                                        <span>{{ $product->p_contact ?? '+92 304 8902805' }}</span>
                                    </a>
                                    <a href="https://wa.me/923048902805" target="_blank" class="pdp-contact-item">
                                        <i class="fab fa-whatsapp"></i>
                                        <span>WhatsApp Chat</span>
                                    </a>
                                    <a href="mailto:info@razzaqengineering.com" class="pdp-contact-item">
                                        <i class="fas fa-envelope"></i>
                                        <span>info@razzaqengineering.com</span>
                                    </a>
                                </div>
                            </div>
                            
                            {{-- Product Highlights --}}
                            <div class="pdp-sidebar-card">
                                <h5 class="pdp-sidebar-title">Product Highlights</h5>
                                <div class="pdp-highlights">
                                    @if($product->brand_name)
                                        <div class="pdp-highlight-item">
                                            <i class="fas fa-tag"></i> Brand: <strong>{{ $product->brand_name }}</strong>
                                        </div>
                                    @endif
                                    <div class="pdp-highlight-item">
                                        <i class="fas fa-check-circle"></i> Status: 
                                        <strong class="{{ $product->in_stock ? 'text-success' : 'text-danger' }}">
                                            {{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}
                                        </strong>
                                    </div>
                                    @if($product->pc_type)
                                        <div class="pdp-highlight-item">
                                            <i class="fas fa-th-large"></i> Category: <strong>{{ $product->pc_type }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            {{-- Related Products --}}
                            @if($relatedProducts->count() > 0)
                                <div class="pdp-sidebar-card">
                                    <h5 class="pdp-sidebar-title">Related Products</h5>
                                    <div class="pdp-related-list">
                                        @foreach($relatedProducts as $rp)
                                            <a href="{{ route('product.detail', ['slug' => $rp->p_slug ?? $rp->id]) }}" class="pdp-related-item">
                                                <img src="{{ $rp->image_url }}" alt="{{ $rp->p_name }}" loading="lazy">
                                                <div>
                                                    <h6>{{ Str::limit($rp->p_name, 30) }}</h6>
                                                    <small>
                                                        @if($rp->p_price)
                                                            Rs. {{ number_format((float)$rp->p_price) }}
                                                        @else
                                                            Price on Request
                                                        @endif
                                                    </small>
                                                </div>
                                                <i class="fas fa-chevron-right pdp-related-arrow"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            {{-- Trust Badges --}}
                            <div class="pdp-sidebar-trust">
                                <div class="pdp-trust-mini">
                                    <i class="fas fa-certificate"></i> Genuine Products
                                </div>
                                <div class="pdp-trust-mini">
                                    <i class="fas fa-truck"></i> Fast Delivery
                                </div>
                                <div class="pdp-trust-mini">
                                    <i class="fas fa-shield-alt"></i> Warranty Assured
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            @endif
        </div>
    </section>
    
    {{-- ============================================
         FINAL CTA
         ============================================ --}}
    <section class="pdp-final-cta">
        <div class="container text-center">
            <h2>Interested in This Product?</h2>
            <p class="mb-4">Get in touch with us for the best price, delivery options, and technical support.</p>
            <div class="pdp-final-cta-buttons">
                <a href="{{ route('quote.index') }}" class="pdp-btn pdp-btn-lg pdp-btn-accent">
                    <i class="fas fa-paper-plane me-2"></i> Get Quote
                </a>
                <a href="tel:{{ $product->p_contact ?? '+923048902805' }}" class="pdp-btn pdp-btn-lg pdp-btn-white-outline-dark">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================
         GALLERY MODAL
         ============================================ --}}
    <div class="pdp-gallery-modal" 
         x-show="galleryOpen !== null" 
         x-transition.opacity
         @click.self="closeGallery"
         x-cloak>
        <button class="pdp-gallery-close" @click="closeGallery">&times;</button>
        <button class="pdp-gallery-nav pdp-gallery-prev" @click.stop="prevImage">
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="pdp-gallery-content">
            <img src="{{ (!empty($galleryImages) && isset($galleryImages[$activeGalleryImage])) ? asset($galleryImages[$activeGalleryImage]) : '' }}" 
                 alt="Gallery Image" 
                 class="pdp-gallery-img"
                 x-show="galleryOpen !== null">
        </div>
        <button class="pdp-gallery-nav pdp-gallery-next" @click.stop="nextImage">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="pdp-gallery-counter" x-show="galleryOpen !== null">
            {{ ($activeGalleryImage ?? 0) + 1 }} / {{ count($galleryImages) }}
        </div>
    </div>

</div>


<style>
/* ============================================
   PRODUCT DETAIL PAGE - ENTERPRISE GRADE
   Laravel 13 + Livewire 4 Compatible
   ============================================ */

[x-cloak] { display: none !important; }

/* --- Mobile Sticky CTA --- */
.pdp-mobile-cta {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 998;
    display: flex; background: #fff; box-shadow: 0 -4px 20px rgba(0,0,0,0.12);
}

.pdp-mobile-btn {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
    padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none;
    border: none; cursor: pointer; transition: all 0.2s;
}

.pdp-mobile-call { background: #f8f9fa; color: #0a1628; }
.pdp-mobile-whatsapp { background: #25D366; color: #fff; }
.pdp-mobile-quote { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; }

/* --- Hero Section --- */
.pdp-hero {
    position: relative; padding: 90px 0 70px; overflow: hidden;
    min-height: 500px; display: flex; align-items: center;
}

.pdp-hero-bg {
    position: absolute; inset: 0; background-size: cover; background-position: center;
    filter: brightness(0.3);
}

.pdp-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,61,128,0.88) 0%, rgba(26,92,42,0.82) 100%);
}

.pdp-hero .container { position: relative; z-index: 2; }

.pdp-breadcrumb {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px;
    font-size: 0.84rem; color: rgba(255,255,255,0.7); flex-wrap: wrap;
}

.pdp-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.pdp-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.pdp-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.pdp-breadcrumb a:hover { color: #fff; }
.pdp-breadcrumb .active { color: rgba(255,255,255,0.6); }

.pdp-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
    color: #fff; padding: 8px 18px; border-radius: 50px;
    font-size: 0.82rem; font-weight: 600; margin-bottom: 18px;
}

.pdp-hero-stock {
    padding: 3px 12px; border-radius: 50px; font-size: 0.72rem; font-weight: 600;
}

.status-in { background: #28a745; color: #fff; }
.status-out { background: #dc3545; color: #fff; }

.pdp-hero-title { color: #fff; font-size: clamp(2rem, 5vw, 3rem); font-weight: 800; margin: 0 0 12px; line-height: 1.15; }
.pdp-hero-subtitle { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 550px; margin: 0 0 18px; line-height: 1.6; }

.pdp-hero-meta {
    display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 22px;
}

.pdp-hero-meta span {
    display: flex; align-items: center; gap: 6px; color: rgba(255,255,255,0.8);
    font-size: 0.84rem; font-weight: 500;
}

.pdp-hero-meta i { color: #28a745; }

.pdp-hero-cta { display: flex; gap: 12px; flex-wrap: wrap; }

.pdp-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 0.9rem;
    text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none;
    white-space: nowrap;
}

.pdp-btn-lg { padding: 14px 28px; font-size: 0.95rem; border-radius: 10px; }

.pdp-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.pdp-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; }

.pdp-btn-white-outline { background: transparent; color: #fff; border: 2px solid rgba(255,255,255,0.5); }
.pdp-btn-white-outline:hover { background: #fff; color: #003d80; border-color: #fff; }

.pdp-btn-white-outline-dark { background: transparent; color: #0a1628; border: 2px solid #0a1628; }
.pdp-btn-white-outline-dark:hover { background: #0a1628; color: #fff; }

.pdp-hero-image-wrapper { perspective: 1000px; }
.pdp-hero-image {
    max-height: 300px; border-radius: 16px; box-shadow: 0 25px 60px rgba(0,0,0,0.4);
    border: 4px solid rgba(255,255,255,0.2); transform: rotateY(-5deg);
    transition: transform 0.5s ease;
}

.pdp-hero-image-wrapper:hover .pdp-hero-image { transform: rotateY(0deg); }

/* --- Trust Bar --- */
.pdp-trust-bar { background: #fff; border-bottom: 1px solid #eef0f2; }

.pdp-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); }

.pdp-trust-card {
    display: flex; align-items: center; gap: 12px; padding: 20px;
    border-right: 1px solid #f0f0f0;
}

.pdp-trust-card:last-child { border-right: none; }

.pdp-trust-icon {
    width: 44px; height: 44px; min-width: 44px; background: rgba(40,167,69,0.1);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #28a745; font-size: 1.1rem;
}

.pdp-trust-card strong { display: block; font-size: 1.1rem; color: #0a1628; }
.pdp-trust-card span { font-size: 0.75rem; color: #888; }

/* --- Main Section --- */
.pdp-main-section { padding: 40px 0 60px; background: #f8f9fa; }

/* --- Content Card --- */
.pdp-content-card {
    background: #fff; border-radius: 14px; overflow: hidden; margin-bottom: 20px;
    box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
}

.pdp-image-hero { position: relative; }

.pdp-img-full { width: 100%; height: 350px; object-fit: cover; display: block; }

.pdp-image-gradient {
    position: absolute; bottom: 0; left: 0; right: 0; height: 80px;
    background: linear-gradient(transparent, rgba(0,0,0,0.4));
}

.pdp-gallery-trigger {
    position: absolute; bottom: 18px; right: 18px; z-index: 2;
    background: rgba(0,0,0,0.7); backdrop-filter: blur(8px);
    color: #fff; border: none; padding: 9px 20px; border-radius: 50px;
    font-size: 0.82rem; font-weight: 600; cursor: pointer; transition: all 0.3s;
}

.pdp-gallery-trigger:hover { background: #28a745; }

.pdp-content-body { padding: 25px; }

.pdp-section-title { font-size: clamp(1.3rem, 2.5vw, 1.6rem); font-weight: 800; color: #0a1628; margin: 0 0 15px; line-height: 1.3; }

.pdp-description { font-size: 0.92rem; color: #666; line-height: 1.8; margin-bottom: 15px; }

.pdp-read-more {
    background: none; border: none; color: #0056b3; font-weight: 700; cursor: pointer;
    padding: 0; font-size: 0.85rem; margin-bottom: 15px;
}

.pdp-read-more:hover { color: #28a745; }

/* Price CTA */
.pdp-price-cta {
    display: flex; align-items: center; gap: 15px; background: #f0f7ff;
    border-radius: 12px; padding: 18px 20px; border: 2px dashed #0056b3;
    margin: 20px 0; flex-wrap: wrap;
}

.pdp-price-display { display: flex; flex-direction: column; gap: 2px; flex: 1; }
.pdp-price-label { font-size: 0.7rem; color: #888; text-transform: uppercase; letter-spacing: 1px; }
.pdp-price-value { font-size: 1.4rem; font-weight: 800; color: #28a745; }
.pdp-price-sep { color: #ccc; margin: 0 6px; font-weight: 400; }

/* Info Grid */
.pdp-info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-top: 20px; }

.pdp-info-item-card {
    display: flex; flex-direction: column; gap: 4px; background: #f8faf9;
    padding: 14px 16px; border-radius: 10px;
}

.pdp-info-item-card i { color: #28a745; font-size: 1rem; }
.pdp-info-item-card span { font-size: 0.7rem; color: #888; text-transform: uppercase; letter-spacing: 1px; }
.pdp-info-item-card strong { font-size: 0.9rem; color: #0a1628; }

/* Specifications Table */
.pdp-specs-table { border: 1px solid #eef0f2; border-radius: 10px; overflow: hidden; }

.pdp-spec-row {
    display: flex; padding: 12px 16px; border-bottom: 1px solid #f5f5f5;
}

.pdp-spec-row:last-child { border-bottom: none; }
.pdp-spec-row:nth-child(odd) { background: #fafafa; }

.pdp-spec-key { flex: 1; font-weight: 600; color: #0a1628; font-size: 0.85rem; }
.pdp-spec-value { flex: 1.5; color: #666; font-size: 0.85rem; }

/* Gallery Grid */
.pdp-gallery-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }

.pdp-gallery-item {
    position: relative; border-radius: 10px; overflow: hidden; cursor: pointer;
    aspect-ratio: 4/3;
}

.pdp-gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
.pdp-gallery-item:hover img { transform: scale(1.08); }

.pdp-gallery-item-overlay {
    position: absolute; inset: 0; background: rgba(0,0,0,0.4);
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.3s; color: #fff; font-size: 1.5rem;
}

.pdp-gallery-item:hover .pdp-gallery-item-overlay { opacity: 1; }

/* --- Sidebar --- */
.pdp-sidebar { position: sticky; top: 20px; }

.pdp-sidebar-card {
    background: #fff; border-radius: 12px; padding: 20px; margin-bottom: 15px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
}

.pdp-sidebar-cta {
    text-align: center; background: linear-gradient(135deg, #0056b3, #003d80); color: #fff;
    border: none;
}

.pdp-sidebar-cta .pdp-sidebar-icon { font-size: 2rem; margin-bottom: 10px; display: block; }
.pdp-sidebar-cta h4 { font-size: 1.1rem; font-weight: 800; margin: 0 0 5px; }
.pdp-sidebar-cta p { font-size: 0.8rem; opacity: 0.8; margin-bottom: 15px; }

.pdp-sidebar-title { font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #888; margin: 0 0 12px; }

.pdp-contact-item {
    display: flex; align-items: center; gap: 10px; padding: 10px 0; text-decoration: none;
    color: #555; font-size: 0.85rem; border-bottom: 1px solid #f5f5f5; transition: all 0.2s;
}

.pdp-contact-item:last-child { border-bottom: none; }
.pdp-contact-item:hover { color: #28a745; }
.pdp-contact-item i { width: 20px; color: #28a745; text-align: center; }

.pdp-highlight-item {
    display: flex; align-items: center; gap: 8px; padding: 8px 0;
    font-size: 0.84rem; color: #555; border-bottom: 1px solid #f5f5f5;
}

.pdp-highlight-item:last-child { border-bottom: none; }
.pdp-highlight-item i { color: #28a745; width: 18px; }

.pdp-related-item {
    display: flex; align-items: center; gap: 12px; padding: 12px 0;
    border-bottom: 1px solid #f0f0f0; text-decoration: none; transition: all 0.2s;
}

.pdp-related-item:last-child { border-bottom: none; }
.pdp-related-item:hover { padding-left: 5px; }

.pdp-related-item img { width: 50px; height: 50px; border-radius: 8px; object-fit: cover; flex-shrink: 0; }

.pdp-related-item h6 { font-size: 0.84rem; color: #0a1628; margin: 0 0 3px; }
.pdp-related-item small { font-size: 0.75rem; color: #28a745; font-weight: 600; }
.pdp-related-arrow { margin-left: auto; color: #ccc; font-size: 0.75rem; transition: color 0.2s; }
.pdp-related-item:hover .pdp-related-arrow { color: #28a745; }

.pdp-sidebar-trust { display: flex; flex-direction: column; gap: 8px; }

.pdp-trust-mini {
    display: flex; align-items: center; gap: 8px; padding: 10px 14px; background: #fff;
    border-radius: 8px; font-size: 0.78rem; font-weight: 600; color: #0a1628;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04); border: 1px solid #eef0f2;
}

.pdp-trust-mini i { color: #28a745; }

/* --- Gallery Modal --- */
.pdp-gallery-modal {
    position: fixed; inset: 0; z-index: 99999; background: rgba(0,0,0,0.92);
    display: flex; align-items: center; justify-content: center;
}

.pdp-gallery-close {
    position: absolute; top: 20px; right: 25px; background: none; border: none;
    color: #fff; font-size: 2.5rem; cursor: pointer; z-index: 10; transition: color 0.3s;
}

.pdp-gallery-close:hover { color: #dc3545; }

.pdp-gallery-nav {
    position: absolute; top: 50%; transform: translateY(-50%);
    background: rgba(255,255,255,0.12); color: #fff; border: none;
    width: 50px; height: 50px; border-radius: 50%; font-size: 1.3rem;
    cursor: pointer; transition: all 0.3s; display: flex; align-items: center;
    justify-content: center; z-index: 10;
}

.pdp-gallery-nav:hover { background: rgba(255,255,255,0.25); }
.pdp-gallery-prev { left: 25px; }
.pdp-gallery-next { right: 25px; }

.pdp-gallery-content { max-width: 85vw; max-height: 80vh; }

.pdp-gallery-img { max-width: 85vw; max-height: 80vh; border-radius: 10px; object-fit: contain; }

.pdp-gallery-counter {
    position: absolute; bottom: 25px; left: 50%; transform: translateX(-50%);
    color: rgba(255,255,255,0.7); font-size: 0.9rem; font-weight: 600;
    background: rgba(0,0,0,0.5); padding: 6px 18px; border-radius: 50px;
}

/* --- Final CTA --- */
.pdp-final-cta { padding: 60px 0; background: #fff; }

.pdp-final-cta h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 10px; }
.pdp-final-cta p { font-size: 1rem; color: #666; max-width: 500px; margin: 0 auto 20px; }

.pdp-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

/* --- States --- */
.pdp-state-box { text-align: center; padding: 50px 20px; }

.pdp-error-card {
    max-width: 450px; margin: 0 auto; padding: 35px 25px; background: #fff;
    border-radius: 14px; box-shadow: 0 5px 30px rgba(0,0,0,0.08); text-align: center;
}

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 1199.98px) {
    .pdp-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .pdp-trust-card:nth-child(2) { border-right: none; }
    .pdp-gallery-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 991.98px) {
    .pdp-hero { padding: 60px 0 50px; min-height: auto; }
    .pdp-hero-title { font-size: 1.7rem; }
    .pdp-price-cta { flex-direction: column; }
    .pdp-price-cta .pdp-btn { width: 100%; justify-content: center; }
    .pdp-sidebar { position: static; margin-top: 20px; }
    .pdp-info-grid { grid-template-columns: 1fr 1fr; }
}

@media (max-width: 767.98px) {
    .pdp-hero { padding: 45px 0 40px; }
    .pdp-hero-title { font-size: 1.4rem; }
    .pdp-hero-subtitle { font-size: 0.9rem; }
    .pdp-hero-cta { flex-direction: column; }
    .pdp-hero-cta .pdp-btn { width: 100%; justify-content: center; }
    .pdp-hero-meta { gap: 12px; }
    .pdp-trust-grid { grid-template-columns: 1fr 1fr; }
    .pdp-trust-card { padding: 14px; gap: 8px; }
    .pdp-img-full { height: 250px; }
    .pdp-content-body { padding: 18px; }
    .pdp-gallery-grid { grid-template-columns: repeat(2, 1fr); }
    .pdp-gallery-nav { width: 40px; height: 40px; }
    .pdp-gallery-prev { left: 10px; }
    .pdp-gallery-next { right: 10px; }
}

@media (max-width: 575.98px) {
    .pdp-hero { padding: 35px 0 30px; }
    .pdp-hero-title { font-size: 1.2rem; }
    .pdp-breadcrumb { font-size: 0.72rem; }
    .pdp-hero-badge { font-size: 0.72rem; padding: 6px 12px; }
    .pdp-hero-meta span { font-size: 0.75rem; }
    .pdp-trust-grid { grid-template-columns: 1fr 1fr; }
    .pdp-trust-card { padding: 12px 10px; border-bottom: 1px solid #f0f0f0; }
    .pdp-trust-card:nth-child(even) { border-right: none; }
    .pdp-trust-icon { width: 34px; height: 34px; min-width: 34px; font-size: 0.9rem; }
    .pdp-img-full { height: 200px; }
    .pdp-content-body { padding: 14px; }
    .pdp-section-title { font-size: 1.15rem; }
    .pdp-description { font-size: 0.84rem; }
    .pdp-info-grid { grid-template-columns: 1fr; }
    .pdp-gallery-grid { grid-template-columns: 1fr; }
    .pdp-gallery-trigger { bottom: 10px; right: 10px; padding: 7px 14px; font-size: 0.75rem; }
    .pdp-price-value { font-size: 1.2rem; }
    .pdp-spec-row { padding: 10px 12px; }
    .pdp-spec-key, .pdp-spec-value { font-size: 0.78rem; }
    .pdp-final-cta { padding: 40px 0; }
    .pdp-final-cta-buttons { flex-direction: column; }
    .pdp-final-cta-buttons .pdp-btn { width: 100%; justify-content: center; }
    .pdp-gallery-nav { width: 36px; height: 36px; font-size: 1rem; }
    .pdp-gallery-close { top: 12px; right: 15px; font-size: 2rem; }
    body { padding-bottom: 55px; }
}
</style>


<script>
document.addEventListener('livewire:navigated', () => {
    if (typeof AOS !== 'undefined') AOS.refresh();
});
</script>