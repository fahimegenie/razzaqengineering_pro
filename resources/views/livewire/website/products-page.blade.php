<div class="prd-page" 
     x-data="{
        init() {
            this.$watch('$wire.products', () => {
                if (typeof AOS !== 'undefined') setTimeout(() => AOS.refresh(), 200);
            });
        }
     }">
    
    {{-- ============================================
         STICKY MOBILE CTA
         ============================================ --}}
    <div class="prd-mobile-cta d-lg-none">
        <a href="tel:+923048902805" class="prd-mobile-btn prd-mobile-call">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/923048902805" target="_blank" class="prd-mobile-btn prd-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="{{ route('quote.index') }}" class="prd-mobile-btn prd-mobile-quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
    </div>

    {{-- ============================================
         HERO SECTION
         ============================================ --}}
    <section class="prd-hero">
        <div class="prd-hero-bg"></div>
        <div class="prd-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-30">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="prd-breadcrumb">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Products</li>
                        </ol>
                    </nav>
                    
                    <div class="prd-hero-badge">
                        <i class="fas fa-box"></i> Quality Equipment
                    </div>
                    
                    <h1 class="prd-hero-title">Our Products</h1>
                    <p class="prd-hero-subtitle">Premium power tools, core cutting machines, diamond drilling equipment & accessories across Pakistan</p>
                    
                    <div class="prd-hero-stats">
                        <div class="prd-stat-item">
                            <span class="prd-stat-number">{{ $totalCount }}+</span>
                            <span class="prd-stat-label">Products</span>
                        </div>
                        <div class="prd-stat-item">
                            <span class="prd-stat-number">{{ $categories->count() }}+</span>
                            <span class="prd-stat-label">Categories</span>
                        </div>
                        <div class="prd-stat-item">
                            <span class="prd-stat-number">Genuine</span>
                            <span class="prd-stat-label">Quality</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         TRUST BAR
         ============================================ --}}
    <section class="prd-trust-bar">
        <div class="container">
            <div class="prd-trust-grid">
                <div class="prd-trust-card">
                    <div class="prd-trust-icon"><i class="fas fa-boxes"></i></div>
                    <div>
                        <strong>{{ $totalCount }}+</strong>
                        <span>Products Available</span>
                    </div>
                </div>
                <div class="prd-trust-card">
                    <div class="prd-trust-icon"><i class="fas fa-truck"></i></div>
                    <div>
                        <strong>Nationwide</strong>
                        <span>Delivery</span>
                    </div>
                </div>
                <div class="prd-trust-card">
                    <div class="prd-trust-icon"><i class="fas fa-certificate"></i></div>
                    <div>
                        <strong>Genuine</strong>
                        <span>Products</span>
                    </div>
                </div>
                <div class="prd-trust-card">
                    <div class="prd-trust-icon"><i class="fas fa-headset"></i></div>
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
    <section class="prd-main-section">
        <div class="container">
            
            @if($isLoading)
                <div class="prd-state-box">
                    <div class="spinner-grow text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-3 fw-semibold">Loading products...</p>
                </div>
            
            @elseif($errorMessage)
                <div class="prd-error-card">
                    <i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;"></i>
                    <h4 class="fw-bold mt-3">Oops! Something went wrong</h4>
                    <p class="text-muted">{{ $errorMessage }}</p>
                    <button class="btn btn-primary mt-3" wire:click="clearFilters">
                        <i class="fas fa-redo me-2"></i> Refresh
                    </button>
                </div>
            
            @else
                {{-- Section Header --}}
                <div class="prd-section-header" data-aos="fade-up">
                    <span class="prd-section-badge"><i class="fas fa-th-large"></i> Browse Products</span>
                    <h2>{{ $selectedCategory !== 'all' ? $selectedCategoryName : 'All Products' }}</h2>
                    <p>Razzaq Engineering deals in power tools, core cutting machines, diamond drilling machines, wall saw cutters, core bits, anchor bolts & more. Contact <strong>0304-8902805</strong> for details.</p>
                </div>

                {{-- Filters Card --}}
                <div class="prd-filters-card" data-aos="fade-up">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-5">
                            <label class="prd-filter-label"><i class="fas fa-search me-1"></i> Search Products</label>
                            <div class="prd-input-wrapper">
                                <i class="fas fa-search prd-input-icon"></i>
                                <input type="text" 
                                       class="prd-form-input" 
                                       placeholder="Search by product name, brand, type..."
                                       wire:model.live.debounce.300ms="search">
                            </div>
                        </div>
                        
                        <div class="col-lg-5" x-data="{ open: false }" @click.outside="open = false">
                            <label class="prd-filter-label"><i class="fas fa-th-large me-1"></i> Category</label>
                            <div class="prd-input-wrapper prd-dropdown-wrapper">
                                <button type="button" class="prd-form-input prd-dropdown-toggle" @click="open = !open">
                                    <span>{{ $selectedCategoryName }}</span>
                                    <i class="fas fa-chevron-down prd-chevron" :class="{ 'rotate': open }"></i>
                                </button>
                                <div class="prd-dropdown-menu" x-show="open" x-transition>
                                    <div class="prd-dropdown-search">
                                        <i class="fas fa-search"></i>
                                        <input type="text" placeholder="Search category..." wire:model.live.debounce.150ms="categorySearch">
                                    </div>
                                    <div class="prd-dropdown-items">
                                        <button type="button" 
                                                class="prd-dropdown-item {{ $selectedCategory === 'all' ? 'active' : '' }}"
                                                wire:click="selectCategory('all', 'All Products')" 
                                                @click="open = false">
                                            <i class="fas fa-layer-group"></i> All Products
                                        </button>
                                        @foreach($filteredCategories as $cat)
                                            <button type="button" 
                                                    class="prd-dropdown-item {{ $selectedCategory == $cat->pc_id ? 'active' : '' }}"
                                                    wire:click="selectCategory('{{ $cat->pc_id }}', '{{ $cat->pc_name }}')"
                                                    @click="open = false">
                                                {{ $cat->pc_name }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-2 d-flex align-items-end">
                            <div class="d-flex align-items-center gap-2 w-100">
                                @if($search || $selectedCategory !== 'all')
                                    <button class="prd-btn-clear" wire:click="clearFilters" title="Clear filters">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                                <span class="prd-count-badge">
                                    <strong>{{ $totalCount }}</strong> products
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Products Grid --}}
                @if($totalCount > 0)
                    <div class="prd-products-grid" wire:key="products-{{ $selectedCategory }}-{{ md5($search) }}">
                        <div class="row g-4">
                            @foreach($products as $product)
                                <div class="col-lg-3 col-md-4 col-sm-6" 
                                     data-aos="fade-up" 
                                     data-aos-delay="{{ ($loop->index % 4) * 60 }}" 
                                     wire:key="prd-{{ $product->id }}">
                                    <div class="prd-card {{ $product->is_featured ? 'featured' : '' }}">
                                        <div class="prd-card-image">
                                            <img src="{{ $product->image_url }}" alt="{{ $product->p_name }}" loading="lazy">
                                            <div class="prd-card-badges">
                                                @if($product->is_featured)
                                                    <span class="prd-badge-featured"><i class="fas fa-star"></i> Featured</span>
                                                @endif
                                                @if(!$product->in_stock)
                                                    <span class="prd-badge-stock out">Out of Stock</span>
                                                @else
                                                    <span class="prd-badge-stock in">In Stock</span>
                                                @endif
                                            </div>
                                            <div class="prd-card-overlay">
                                                <a href="{{ route('product.detail', ['slug' => $product->p_slug ?? $product->id]) }}" class="prd-overlay-btn">
                                                    <i class="fas fa-eye me-1"></i> View Details
                                                </a>
                                            </div>
                                        </div>
                                        <div class="prd-card-body">
                                            @if($product->pc_type)
                                                <span class="prd-card-category">{{ $product->pc_type }}</span>
                                            @endif
                                            <h3>
                                                <a href="{{ route('product.detail', ['slug' => $product->p_slug ?? $product->id]) }}">{{ $product->p_name }}</a>
                                            </h3>
                                            
                                            @if($product->brand_name)
                                                <div class="prd-card-brand">
                                                    <i class="fas fa-tag"></i> {{ $product->brand_name }}
                                                </div>
                                            @endif
                                            
                                            <p>{{ Str::limit($product->p_short_description ?? $product->p_description, 70) }}</p>
                                            
                                            <div class="prd-card-price-row">
                                                @if($product->p_price)
                                                    <div class="prd-price">
                                                        <span class="prd-price-label">Price</span>
                                                        <span class="prd-price-value">
                                                            Rs. {{ number_format((float)$product->p_price) }}
                                                            @if($product->price_to)
                                                                <span class="prd-price-sep">-</span>
                                                                Rs. {{ number_format((float)$product->price_to) }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="prd-price">
                                                        <span class="prd-price-label">Price</span>
                                                        <span class="prd-price-value na">On Request</span>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            <div class="prd-card-footer">
                                                <a href="{{ route('product.detail', ['slug' => $product->p_slug ?? $product->id]) }}" class="prd-card-link">
                                                    View Details <i class="fas fa-arrow-right ms-1"></i>
                                                </a>
                                                @if($product->p_contact)
                                                    <a href="tel:{{ $product->p_contact }}" class="prd-card-call">
                                                        <i class="fas fa-phone-alt"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        {{-- Load More --}}
                        <div class="prd-load-more" wire:key="load-more-{{ $loadedCount }}">
                            @if($hasMore)
                                <button wire:click="loadMore" 
                                        wire:loading.attr="disabled"
                                        class="prd-load-btn">
                                    <span wire:loading.remove>Load More Products</span>
                                    <span wire:loading>
                                        <span class="spinner-border spinner-border-sm me-2"></span> Loading...
                                    </span>
                                    <i class="fas fa-chevron-down ms-2" wire:loading.remove></i>
                                </button>
                                <p class="prd-load-info">Showing {{ count($products) }} of {{ $totalCount }} products</p>
                            @else
                                <div class="prd-all-loaded">
                                    <i class="fas fa-check-circle"></i>
                                    <span>All {{ $totalCount }} products loaded</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="prd-empty-state" data-aos="fade-up">
                        <div class="prd-empty-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h3>No Products Found</h3>
                        <p>Try adjusting your search or select a different category.</p>
                        <button class="btn btn-outline-primary mt-3" wire:click="clearFilters">
                            <i class="fas fa-redo me-2"></i> Clear Filters
                        </button>
                    </div>
                @endif
            @endif
        </div>
    </section>

    {{-- ============================================
         FINAL CTA
         ============================================ --}}
    <section class="prd-final-cta">
        <div class="container text-center">
            <h2>Need Help Finding the Right Product?</h2>
            <p class="mb-4">Our experts can help you choose the best equipment for your project requirements.</p>
            <div class="prd-final-cta-buttons">
                <a href="{{ route('quote.index') }}" class="prd-btn prd-btn-lg prd-btn-accent">
                    <i class="fas fa-paper-plane me-2"></i> Request Quote
                </a>
                <a href="tel:+923048902805" class="prd-btn prd-btn-lg prd-btn-white-outline-dark">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>

</div>


<style>
/* ============================================
   PRODUCTS PAGE - ENTERPRISE GRADE DESIGN
   Laravel 13 + Livewire 4 Compatible
   ============================================ */

/* --- Mobile Sticky CTA --- */
.prd-mobile-cta {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 998;
    display: flex; background: #fff; box-shadow: 0 -4px 20px rgba(0,0,0,0.12);
}

.prd-mobile-btn {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
    padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none;
    border: none; cursor: pointer; transition: all 0.2s;
}

.prd-mobile-call { background: #f8f9fa; color: #0a1628; }
.prd-mobile-whatsapp { background: #25D366; color: #fff; }
.prd-mobile-quote { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; }

/* --- Hero Section --- */
.prd-hero {
    position: relative; padding: 90px 0 70px; overflow: hidden;
    min-height: 420px; display: flex; align-items: center;
}

.prd-hero-bg {
    position: absolute; inset: 0;
    background: url('{{ asset("images/products-hero-bg.jpg") }}') center/cover no-repeat;
    filter: brightness(0.3);
}

.prd-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,61,128,0.88) 0%, rgba(26,92,42,0.82) 100%);
}

.prd-hero .container { position: relative; z-index: 2; }

.prd-breadcrumb {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px;
    font-size: 0.84rem; color: rgba(255,255,255,0.7);
}

.prd-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.prd-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.prd-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.prd-breadcrumb a:hover { color: #fff; }
.prd-breadcrumb .active { color: rgba(255,255,255,0.6); }

.prd-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
    color: #fff; padding: 8px 18px; border-radius: 50px;
    font-size: 0.85rem; font-weight: 600; margin-bottom: 18px;
}

.prd-hero-title { color: #fff; font-size: clamp(2.2rem, 5vw, 3rem); font-weight: 800; margin: 0 0 12px; line-height: 1.15; }
.prd-hero-subtitle { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 550px; margin: 0 0 25px; line-height: 1.6; }

.prd-hero-stats { display: flex; gap: 30px; flex-wrap: wrap; }
.prd-stat-item { text-align: center; }
.prd-stat-number { display: block; font-size: 1.8rem; font-weight: 800; color: #28a745; }
.prd-stat-label { font-size: 0.78rem; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 1px; }

/* --- Trust Bar --- */
.prd-trust-bar { background: #fff; border-bottom: 1px solid #eef0f2; }
.prd-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); }

.prd-trust-card {
    display: flex; align-items: center; gap: 12px; padding: 20px;
    border-right: 1px solid #f0f0f0;
}
.prd-trust-card:last-child { border-right: none; }

.prd-trust-icon {
    width: 44px; height: 44px; min-width: 44px; background: rgba(40,167,69,0.1);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #28a745; font-size: 1.1rem;
}

.prd-trust-card strong { display: block; font-size: 1.1rem; color: #0a1628; }
.prd-trust-card span { font-size: 0.75rem; color: #888; }

/* --- Main Section --- */
.prd-main-section { padding: 40px 0 60px; background: #f8f9fa; }

/* --- Section Header --- */
.prd-section-header { text-align: center; margin-bottom: 30px; }

.prd-section-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(40,167,69,0.1); color: #28a745; padding: 6px 16px;
    border-radius: 50px; font-size: 0.78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px;
}

.prd-section-header h2 { font-size: 1.8rem; font-weight: 800; color: #0a1628; margin-bottom: 8px; }
.prd-section-header p { color: #888; max-width: 700px; margin: 0 auto; font-size: 0.9rem; }

/* --- Filters Card --- */
.prd-filters-card {
    background: #fff; border-radius: 16px; padding: 22px 25px; margin-bottom: 30px;
    box-shadow: 0 8px 35px rgba(0,0,0,0.06); border: 1px solid #eef0f2;
}

.prd-filter-label {
    font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 1.5px; color: #888; margin-bottom: 6px; display: block;
}

.prd-input-wrapper { position: relative; }

.prd-form-input {
    width: 100%; padding: 12px 16px 12px 42px; border: 2px solid #e9ecef;
    border-radius: 10px; font-size: 0.88rem; color: #333; background: #fff;
    transition: all 0.3s ease; outline: none;
}

.prd-form-input:focus { border-color: #28a745; box-shadow: 0 0 0 3px rgba(40,167,69,0.1); }

.prd-input-icon {
    position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
    color: #aaa; font-size: 0.9rem; z-index: 1; pointer-events: none;
}

.prd-dropdown-wrapper { position: relative; }
.prd-dropdown-toggle {
    display: flex; align-items: center; justify-content: space-between;
    cursor: pointer; text-align: left; padding-left: 16px !important;
}
.prd-chevron { transition: transform 0.3s; font-size: 0.75rem; color: #888; }
.prd-chevron.rotate { transform: rotate(180deg); }

.prd-dropdown-menu {
    position: absolute; top: calc(100% + 5px); left: 0; right: 0;
    background: #fff; border: 2px solid #e9ecef; border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1); z-index: 1000; overflow: hidden;
}

.prd-dropdown-search {
    position: relative; padding: 10px; border-bottom: 1px solid #f0f0f0;
}

.prd-dropdown-search i {
    position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #aaa;
}

.prd-dropdown-search input {
    width: 100%; padding: 8px 12px 8px 35px; border: 1px solid #e9ecef;
    border-radius: 8px; font-size: 0.82rem; outline: none;
}

.prd-dropdown-items { max-height: 200px; overflow-y: auto; padding: 5px; }

.prd-dropdown-item {
    display: flex; align-items: center; gap: 8px; width: 100%;
    padding: 10px 12px; border: none; background: none; cursor: pointer;
    font-size: 0.85rem; color: #555; border-radius: 8px; transition: all 0.15s;
}

.prd-dropdown-item:hover { background: #f0faf3; color: #28a745; }
.prd-dropdown-item.active { background: #28a745; color: #fff; font-weight: 600; }

.prd-btn-clear {
    width: 40px; height: 40px; border-radius: 10px; border: 2px solid #e9ecef;
    background: #fff; color: #dc3545; cursor: pointer; display: flex;
    align-items: center; justify-content: center; transition: all 0.3s;
}

.prd-btn-clear:hover { background: #dc3545; color: #fff; border-color: #dc3545; }

.prd-count-badge {
    background: #f0faf3; color: #28a745; padding: 8px 14px; border-radius: 8px;
    font-size: 0.82rem; font-weight: 600;
}

/* --- Product Card --- */
.prd-card {
    background: #fff; border-radius: 16px; overflow: hidden;
    box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); height: 100%;
    display: flex; flex-direction: column;
}

.prd-card:hover {
    transform: translateY(-6px); 
    box-shadow: 0 18px 45px rgba(0,0,0,0.1);
}

.prd-card.featured { border: 2px solid rgba(245,158,11,0.3); }

.prd-card-image {
    position: relative; height: 220px; overflow: hidden; background: #f0f4f8;
}

.prd-card-image img {
    width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;
}

.prd-card:hover .prd-card-image img { transform: scale(1.08); }

.prd-card-badges {
    position: absolute; top: 12px; left: 12px; right: 12px;
    display: flex; justify-content: space-between;
}

.prd-badge-featured {
    background: linear-gradient(135deg, #f59e0b, #d97706); color: #000;
    padding: 5px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700;
    display: flex; align-items: center; gap: 4px;
}

.prd-badge-stock {
    padding: 5px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 600; color: #fff;
}
.prd-badge-stock.in { background: #28a745; }
.prd-badge-stock.out { background: #dc3545; }

.prd-card-overlay {
    position: absolute; inset: 0; background: rgba(0,0,0,0.5);
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.3s ease;
}

.prd-card:hover .prd-card-overlay { opacity: 1; }

.prd-overlay-btn {
    background: #28a745; color: #fff; padding: 10px 22px; border-radius: 50px;
    font-weight: 600; font-size: 0.85rem; text-decoration: none;
    transform: translateY(10px); transition: transform 0.3s ease;
}

.prd-card:hover .prd-overlay-btn { transform: translateY(0); }
.prd-overlay-btn:hover { background: #1e7e34; color: #fff; }

.prd-card-body {
    padding: 18px; flex: 1; display: flex; flex-direction: column;
}

.prd-card-category {
    display: inline-block; font-size: 0.68rem; font-weight: 600; color: #0056b3;
    background: rgba(0,86,179,0.08); padding: 3px 10px; border-radius: 4px;
    margin-bottom: 8px; width: fit-content;
}

.prd-card-body h3 { font-size: 0.95rem; font-weight: 700; margin: 0 0 6px; }
.prd-card-body h3 a { color: #0a1628; text-decoration: none; }
.prd-card-body h3 a:hover { color: #0056b3; }

.prd-card-brand {
    display: flex; align-items: center; gap: 5px; font-size: 0.75rem;
    color: #1a5c2a; font-weight: 600; margin-bottom: 8px;
    background: rgba(40,167,69,0.06); padding: 3px 10px; border-radius: 4px;
    width: fit-content;
}

.prd-card-body p { font-size: 0.82rem; color: #888; line-height: 1.5; margin-bottom: 12px; flex: 1; }

.prd-card-price-row { margin-bottom: 12px; }
.prd-price { display: flex; flex-direction: column; gap: 2px; }
.prd-price-label { font-size: 0.65rem; color: #aaa; text-transform: uppercase; letter-spacing: 1px; }
.prd-price-value { font-size: 1rem; font-weight: 700; color: #28a745; }
.prd-price-value.na { color: #888; font-size: 0.85rem; }
.prd-price-sep { color: #ccc; margin: 0 4px; }

.prd-card-footer {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 12px; border-top: 1px solid #f0f0f0; margin-top: auto;
}

.prd-card-link { font-size: 0.82rem; font-weight: 600; color: #0056b3; text-decoration: none; }
.prd-card-link:hover { color: #28a745; }

.prd-card-call {
    width: 34px; height: 34px; background: #28a745; color: #fff;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    text-decoration: none; font-size: 0.8rem; transition: all 0.3s;
}

.prd-card-call:hover { background: #1e7e34; color: #fff; transform: scale(1.1); }

/* --- Load More --- */
.prd-load-more { text-align: center; padding: 40px 0 20px; }

.prd-load-btn {
    background: #fff; color: #28a745; border: 2px solid #28a745;
    padding: 12px 30px; border-radius: 50px; font-weight: 700; font-size: 0.9rem;
    cursor: pointer; transition: all 0.3s ease;
}

.prd-load-btn:hover:not(:disabled) { background: #28a745; color: #fff; }
.prd-load-btn:disabled { opacity: 0.6; cursor: not-allowed; }

.prd-load-info { font-size: 0.82rem; color: #aaa; margin-top: 10px; }

.prd-all-loaded {
    display: inline-flex; align-items: center; gap: 8px; color: #28a745;
    font-weight: 600; font-size: 0.9rem;
}

/* --- Final CTA --- */
.prd-final-cta { padding: 60px 0; background: #fff; }
.prd-final-cta h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 10px; }
.prd-final-cta p { font-size: 1rem; color: #666; max-width: 500px; margin: 0 auto 20px; }
.prd-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

.prd-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 0.9rem;
    text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none;
    white-space: nowrap;
}

.prd-btn-lg { padding: 14px 28px; font-size: 0.95rem; border-radius: 10px; }
.prd-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.prd-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; }

.prd-btn-white-outline-dark { background: transparent; color: #0a1628; border: 2px solid #0a1628; }
.prd-btn-white-outline-dark:hover { background: #0a1628; color: #fff; }

/* --- States --- */
.prd-state-box { text-align: center; padding: 60px 20px; }
.prd-error-card { max-width: 500px; margin: 40px auto; padding: 40px 30px; background: #fff; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); text-align: center; }
.prd-empty-state { text-align: center; padding: 60px 20px; }
.prd-empty-icon { width: 100px; height: 100px; margin: 0 auto 20px; background: rgba(40,167,69,0.08); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: #28a745; }
.prd-empty-state h3 { font-size: 1.3rem; font-weight: 700; color: #0a1628; }
.prd-empty-state p { color: #888; max-width: 400px; margin: 0 auto; }

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 1199.98px) {
    .prd-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .prd-trust-card:nth-child(2) { border-right: none; }
    .prd-card-image { height: 200px; }
}

@media (max-width: 991.98px) {
    .prd-hero { padding: 60px 0 50px; min-height: auto; }
    .prd-hero-title { font-size: 1.8rem; }
    .prd-filters-card { padding: 18px 20px; }
}

@media (max-width: 767.98px) {
    .prd-hero { padding: 45px 0 40px; }
    .prd-hero-title { font-size: 1.5rem; }
    .prd-hero-subtitle { font-size: 0.9rem; }
    .prd-hero-stats { gap: 15px; }
    .prd-stat-number { font-size: 1.4rem; }
    .prd-trust-grid { grid-template-columns: 1fr 1fr; }
    .prd-trust-card { padding: 14px; gap: 8px; }
    .prd-card-image { height: 180px; }
}

@media (max-width: 575.98px) {
    .prd-hero { padding: 35px 0 30px; }
    .prd-hero-title { font-size: 1.3rem; }
    .prd-hero-badge { font-size: 0.75rem; padding: 6px 14px; }
    .prd-breadcrumb { font-size: 0.75rem; }
    .prd-filters-card { padding: 15px; border-radius: 12px; }
    .prd-trust-grid { grid-template-columns: 1fr 1fr; }
    .prd-trust-card { padding: 12px 10px; border-bottom: 1px solid #f0f0f0; }
    .prd-trust-card:nth-child(even) { border-right: none; }
    .prd-trust-icon { width: 34px; height: 34px; min-width: 34px; font-size: 0.9rem; }
    .prd-card-image { height: 200px; }
    .prd-section-header h2 { font-size: 1.3rem; }
    .prd-final-cta { padding: 40px 0; }
    .prd-final-cta-buttons { flex-direction: column; }
    .prd-final-cta-buttons .prd-btn { width: 100%; justify-content: center; }
    body { padding-bottom: 55px; }
}
</style>


<script>
document.addEventListener('livewire:navigated', () => {
    if (typeof AOS !== 'undefined') AOS.refresh();
});
</script>