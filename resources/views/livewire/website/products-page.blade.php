<div class="products-page-wrapper"
     x-data="{
        observer: null,
        init() {
            this.$nextTick(() => { this.setupObserver(); });
            this.$watch('$wire.products', () => {
                if (typeof AOS !== 'undefined') setTimeout(() => AOS.refresh(), 200);
            });
        },
        setupObserver() {
            if (this.observer) this.observer.disconnect();
            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && $wire.hasMore) $wire.loadMore();
                });
            }, { threshold: 0.1 });
            const sentinel = this.$refs.loadMoreSentinel;
            if (sentinel) this.observer.observe(sentinel);
        }
     }">
    
    <!-- HERO -->
    <section class="prod-hero" wire:ignore>
        <div class="container prod-hero-content">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="prod-breadcrumb">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">Products</li>
                        </ol>
                    </nav>
                    <h1 class="prod-hero-title">Our Products</h1>
                    <p class="prod-hero-subtitle">Quality power tools, core cutting machines & accessories across Pakistan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="prod-section">
        <div class="container">
            
            {{-- Loading --}}
            @if($isLoading)
                <div class="text-center py-5" wire:key="prod-loading">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-2">Loading products...</p>
                </div>
            @elseif($errorMessage)
                <div class="alert alert-danger text-center rounded-3 border-0 shadow-sm" wire:key="prod-error">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ $errorMessage }}
                </div>
            @else
                <div wire:key="prod-main-content">
                    
                    {{-- Section Intro --}}
                    <div class="prod-intro text-center mb-5" data-aos="fade-up" wire:ignore.self>
                        <span class="sec-tag">WHAT WE OFFER</span>
                        <h2 class="sec-title">{{ $selectedCategory !== 'all' ? $selectedCategoryName : 'All Products' }}</h2>
                        <p class="sec-desc">Razzaq Engineering deals in power tools, core cutting machines, diamond drilling machines, wall saw cutters, core bits, anchor bolts & more across Pakistan. Contact 0304-8902805 for details.</p>
                    </div>
                    
                    {{-- Filters --}}
                    <div class="prod-filters" data-aos="fade-up" wire:ignore.self>
                        <div class="row g-3 align-items-end mb-5">
                            <div class="col-lg-5">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Search Products</label>
                                <div class="position-relative">
                                    <i class="fas fa-search position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
                                    <input type="text" class="form-control ps-5 py-3 rounded-3 border-2"
                                           wire:model.live.debounce.300ms="search" placeholder="Search products...">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Category</label>
                                <div class="position-relative prod-dropdown" 
                                     x-data="{ open: false }" @click.outside="open = false">
                                    <button type="button" class="form-select py-3 rounded-3 border-2 text-start bg-white"
                                            @click="open = !open">
                                        <span>{{ $selectedCategoryName }}</span>
                                    </button>
                                    <div class="position-absolute w-100 bg-white border border-2 rounded-3 mt-1 shadow-lg p-2" 
                                         x-show="open" x-transition style="z-index:9999;">
                                        <div class="position-relative mb-2">
                                            <i class="fas fa-search position-absolute top-50 translate-middle-y ms-2 text-muted small"></i>
                                            <input type="text" class="form-control form-control-sm ps-4 py-2 border-1" 
                                                   placeholder="Search category..."
                                                   wire:model.live.debounce.150ms="categorySearch"
                                                   @keydown.escape="open = false">
                                        </div>
                                        <div class="overflow-y-auto" style="max-height:200px;">
                                            <button type="button" class="dropdown-item py-2 px-3 rounded-2 text-start w-100 {{ $selectedCategory === 'all' ? 'bg-success text-white' : '' }}"
                                                    wire:click="selectCategory('all', 'All Products')" @click="open = false">All Products</button>
                                            @foreach($filteredCategories as $cat)
                                                <button type="button" class="dropdown-item py-2 px-3 rounded-2 text-start w-100 {{ $selectedCategory == $cat->pc_id ? 'bg-success text-white' : '' }}"
                                                        wire:click="selectCategory('{{ $cat->pc_id }}', '{{ $cat->pc_name }}')"
                                                        @click="open = false" wire:key="pcat-{{ $cat->pc_id }}">{{ $cat->pc_name }}</button>
                                            @endforeach
                                            @if($filteredCategories->count() === 0)
                                                <div class="text-muted text-center small py-2">No categories found</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 d-flex align-items-end">
                                <div class="w-100">
                                    @if($search || $selectedCategory !== 'all')
                                        <button class="btn btn-outline-secondary btn-sm w-100 rounded-3 mb-1" wire:click="clearFilters">
                                            <i class="fas fa-redo me-1"></i> Clear Filters
                                        </button>
                                    @endif
                                    <p class="text-muted small mb-0"><strong>{{ count($products) }}</strong>/{{ $totalCount }} products</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Products Grid --}}
                    <div class="all-products" wire:key="all-products-panel-{{ $selectedCategory }}-{{ md5($search) }}">
                        
                        @if(count($products) > 0)
                            <div class="row g-4">
                                @foreach($products as $product)
                                    <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index % 4 * 100 }}" wire:key="product-card-{{ $product->p_id }}">
                                        <div class="product-card">
                                            
                                            {{-- ✅ Image Clickable - Product Detail Link --}}
                                            <a href="{{ route('product.detail', ['slug' => $product->p_name ?? $product->p_id]) }}" class="product-card-img" wire:ignore>
                                                <img src="{{ asset('uploads/products/'.$product->p_image) }}" 
                                                     alt="{{ $product->p_name }}" class="img-fluid" loading="lazy">
                                                @if($product->is_featured)
                                                    <span class="product-featured-tag">Featured</span>
                                                @endif
                                                @if($product->in_stock === false)
                                                    <div class="product-out-stock">Out of Stock</div>
                                                @endif
                                            </a>
                                            
                                            <div class="product-card-body">
                                                @if($product->pc_type)
                                                    <a href="{{ route('products', ['pc_name' => str_replace(' ', '-', $product->pc_type)]) }}" class="product-category-tag">
                                                        {{ $product->pc_type }}
                                                    </a>
                                                @endif
                                                
                                                {{-- ✅ Product Name Clickable - Product Detail Link --}}
                                                <h4>
                                                    <a href="{{ route('product.detail', ['slug' => $product->p_name ?? $product->p_id]) }}" class="text-decoration-none text-dark">
                                                        {{ $product->p_name }}
                                                    </a>
                                                </h4>
                                                
                                                <p>{{ Str::limit($product->p_short_description ?? $product->p_description, 80) }}</p>
                                                
                                                <div class="product-meta">
                                                    @if($product->p_price)
                                                        <span class="product-price">Rs. {{ number_format((float)$product->p_price) }}</span>
                                                    @endif
                                                    @if($product->p_contact)
                                                        <a href="tel:{{ $product->p_contact }}" class="product-contact">
                                                            <i class="fas fa-phone-alt me-1"></i> {{ $product->p_contact }}
                                                        </a>
                                                    @endif
                                                </div>
                                                
                                                {{-- ✅ View Details Button --}}
                                                <a href="{{ route('product.detail', ['slug' => $product->p_name ?? $product->p_id]) }}" 
                                                   class="btn btn-outline-success btn-sm rounded-pill w-100 mt-2 fw-semibold">
                                                    <i class="fas fa-eye me-1"></i> View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            {{-- Load More --}}
                            <div x-ref="loadMoreSentinel" class="text-center py-4" wire:key="sentinel-wrapper">
                                @if($hasMore)
                                    <div wire:loading wire:target="loadMore" class="spinner-border text-success"></div>
                                    <button wire:click="loadMore" wire:loading.remove class="btn btn-outline-success rounded-pill px-5 py-2 fw-semibold mt-3">
                                        Load More Products <i class="fas fa-chevron-down ms-2"></i>
                                    </button>
                                @else
                                    <p class="text-muted">All {{ $totalCount }} products loaded</p>
                                @endif
                            </div>
                            
                        @else
                            <div class="text-center py-5" data-aos="fade-up" wire:key="no-products-found">
                                <i class="fas fa-box-open fa-3x text-muted opacity-25 mb-3"></i>
                                <h5 class="fw-bold">No Products Found</h5>
                                <p class="text-muted">Try different search terms or select another category.</p>
                            </div>
                        @endif
                        
                    </div>
                </div>
            @endif
        </div>
    </section>

</div>

@push('styles')
<style>
    .prod-hero { background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%); min-height: 250px; display: flex; align-items: center; }
    .prod-hero-content { width: 100%; }
    .prod-breadcrumb { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 10px; }
    .prod-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .prod-breadcrumb li a { color: #fff; text-decoration: none; }
    .prod-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .prod-hero-title { color: #fff; font-size: 2.5rem; font-weight: 800; }
    .prod-hero-subtitle { color: rgba(255,255,255,0.8); font-size: 1rem; }
    .prod-section { padding: 60px 0; background: #f8f9fa; }
    .prod-dropdown { position: relative; z-index: 9999; }

    .sec-tag { display: inline-block; font-size: 0.72rem; font-weight: 700; letter-spacing: 3px; color: #28a745; text-transform: uppercase; margin-bottom: 8px; }
    .sec-title { font-size: 2rem; font-weight: 800; color: #0a1628; margin-bottom: 8px; }
    .sec-desc { color: #888; font-size: 0.9rem; max-width: 700px; margin: 0 auto; line-height: 1.6; }

    /* Product Card */
    .product-card {
        background: #fff; border-radius: 14px; overflow: hidden;
        box-shadow: 0 3px 20px rgba(0,0,0,0.05); border: 1px solid #eef0f2;
        transition: all 0.3s; height: 100%; display: flex; flex-direction: column;
    }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
    .product-card-img {
        position: relative; height: 200px; overflow: hidden; background: #f0f4f8;
        display: block; text-decoration: none;
    }
    .product-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
    .product-card:hover .product-card-img img { transform: scale(1.05); }
    .product-featured-tag { position: absolute; top: 10px; left: 10px; background: linear-gradient(135deg, #ffc107, #ff9800); color: #000; padding: 4px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; }
    .product-out-stock { position: absolute; inset: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 1rem; pointer-events: none; }
    .product-card-body { padding: 18px; flex: 1; display: flex; flex-direction: column; }
    .product-category-tag { display: inline-block; font-size: 0.68rem; font-weight: 600; color: #0056b3; background: rgba(0,86,179,0.08); padding: 3px 10px; border-radius: 4px; margin-bottom: 8px; text-decoration: none; transition: all 0.2s; }
    .product-category-tag:hover { background: #0056b3; color: #fff; }
    .product-card-body h4 { font-size: 1rem; font-weight: 700; margin-bottom: 6px; color: #0a1628; }
    .product-card-body h4 a:hover { color: #0056b3; }
    .product-card-body p { font-size: 0.84rem; color: #888; line-height: 1.5; margin-bottom: 12px; flex: 1; }
    .product-meta { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; padding-top: 10px; border-top: 1px solid #f0f0f0; }
    .product-price { font-size: 1.05rem; font-weight: 700; color: #28a745; }
    .product-contact { font-size: 0.8rem; color: #0056b3; text-decoration: none; font-weight: 600; }
    .product-contact:hover { color: #28a745; }

    @media (max-width: 767px) {
        .prod-hero { min-height: 180px; }
        .prod-hero-title { font-size: 1.6rem; }
        .prod-section { padding: 40px 0; }
        .product-card-img { height: 180px; }
    }
</style>
@endpush