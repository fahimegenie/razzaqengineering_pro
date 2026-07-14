<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3">Products</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item active">Products</li></ol></div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-primary text-white"><div class="card-body text-center py-3"><i class="bi bi-box-seam display-6"></i><h3 class="mb-0 mt-1">{{ $totalProducts }}</h3><small>Total</small></div></div></div>
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-success text-white"><div class="card-body text-center py-3"><i class="bi bi-check-circle display-6"></i><h3 class="mb-0 mt-1">{{ $activeProducts }}</h3><small>Active</small></div></div></div>
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-warning text-white"><div class="card-body text-center py-3"><i class="bi bi-star-fill display-6"></i><h3 class="mb-0 mt-1">{{ $featuredProducts }}</h3><small>Featured</small></div></div></div>
            <div class="col-6 col-md-3"><div class="card border-0 shadow-sm bg-info text-white"><div class="card-body text-center py-3"><i class="bi bi-boxes display-6"></i><h3 class="mb-0 mt-1">{{ $inStockProducts }}</h3><small>In Stock</small></div></div></div>
        </div>

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row g-2 align-items-end">
                    <div class="col-md-3"><div class="input-group"><span class="input-group-text"><i class="bi bi-search"></i></span><input type="text" class="form-control" wire:model.blur="search" placeholder="Search...">@if($search)<button class="btn btn-outline-secondary" wire:click="clearSearch"><i class="bi bi-x-lg"></i></button>@endif</div></div>
                    <div class="col-6 col-md-2"><select class="form-select" wire:model.blur="statusFilter"><option value="">Status</option><option value="1">Active</option><option value="0">Inactive</option></select></div>
                    <div class="col-6 col-md-2"><select class="form-select" wire:model.blur="categoryFilter"><option value="">Category</option>@foreach($categories as $c)<option value="{{ $c->id }}">{{ $c->pc_name }}</option>@endforeach</select></div>
                    <div class="col-6 col-md-2"><select class="form-select" wire:model.blur="stockFilter"><option value="">Stock</option><option value="1">In Stock</option><option value="0">Out of Stock</option></select></div>
                    <div class="col-6 col-md-3 text-end"><button class="btn btn-outline-secondary me-1" wire:click="clearFilters"><i class="bi bi-funnel"></i></button><a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Product</a></div>
                </div>
                @if(count($selectedProducts) > 0)
                <div class="mt-3 p-2 bg-light rounded d-flex gap-2"><span class="fw-semibold">{{ count($selectedProducts) }} selected</span><button class="btn btn-sm btn-success" wire:click="bulkActivate"><i class="bi bi-check-circle"></i> Activate</button><button class="btn btn-sm btn-warning" wire:click="bulkDeactivate"><i class="bi bi-pause-circle"></i> Deactivate</button><button class="btn btn-sm btn-danger" wire:click="bulkDelete"><i class="bi bi-trash"></i> Delete</button></div>@endif
            </div>
        </div>

        <div class="row g-3">
            @forelse($products as $product)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card shadow-sm border-0 h-100 product-card">
                    <div class="position-relative">
                        <img src="{{ $product->image_url }}" class="card-img-top" style="height:180px;object-fit:cover;">
                        <div class="position-absolute top-0 start-0 m-2"><input type="checkbox" class="form-check-input" @checked(in_array($product->id, $selectedProducts)) wire:click="toggleProductSelection({{ $product->id }})" style="width:20px;height:20px;background:white;"></div>
                        <div class="position-absolute top-0 end-0 m-2 d-flex gap-1">
                            @if($product->is_featured)<span class="badge bg-warning"><i class="bi bi-star-fill"></i></span>@endif
                            <span class="badge bg-{{ $product->in_stock ? 'success' : 'danger' }}">{{ $product->in_stock ? 'Stock' : 'Out' }}</span>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-bold">{{ Str::limit($product->p_name, 30) }}</h6>
                        @if($product->category)<small class="text-muted">{{ $product->category->pc_name }}</small>@endif
                        <p class="text-muted small flex-grow-1">{{ Str::limit(strip_tags($product->p_short_description), 60) }}</p>
                        @if($product->p_price)<h6 class="text-primary mb-2">{{ $product->formatted_price }}</h6>@endif
                        <div class="btn-group w-100 btn-group-sm">
                            <button class="btn btn-info" wire:click="viewProductDetails({{ $product->id }})"><i class="bi bi-eye"></i></button>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-{{ $product->is_active ? 'success' : 'secondary' }}" wire:click="toggleStatus({{ $product->id }})"><i class="bi bi-{{ $product->is_active ? 'toggle-on' : 'toggle-off' }}"></i></button>
                            <button class="btn btn-danger" wire:click="confirmDelete({{ $product->id }})"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5"><i class="bi bi-box display-1 text-muted d-block mb-3"></i><h4>No products found</h4><a href="{{ route('admin.products.create') }}" class="btn btn-primary mt-2"><i class="bi bi-plus-lg"></i> Add First Product</a></div>
            @endforelse
        </div>
        @if($products->hasPages())<div class="card shadow-sm border-0 mt-3"><div class="card-footer d-flex justify-content-between"><small>Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }}</small>{{ $products->links() }}</div></div>@endif
    </div>

    @if($showViewModal && $viewProduct)
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="bi bi-eye"></i> Product Details</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div><div class="modal-body"><div class="row"><div class="col-md-5"><img src="{{ $viewProduct->image_url }}" class="img-fluid rounded"></div><div class="col-md-7"><h4>{{ $viewProduct->p_name }}</h4><p>Category: {{ $viewProduct->category->pc_name ?? 'N/A' }}</p><p>Price: {{ $viewProduct->formatted_price }}</p><p>Stock: {!! $viewProduct->stock_badge !!}</p><p>Status: <span class="badge bg-{{ $viewProduct->is_active ? 'success' : 'danger' }}">{{ $viewProduct->is_active ? 'Active' : 'Inactive' }}</span></p></div></div></div><div class="modal-footer"><button class="btn btn-secondary" wire:click="closeModals">Close</button><a href="{{ route('admin.products.edit', $viewProduct->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i> Edit</a></div></div></div></div><div class="modal-backdrop fade show"></div>
    @endif

    @if($showDeleteModal)
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirm Delete</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div><div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this product?</h5></div><div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deleteProduct"><i class="bi bi-trash"></i> Delete</button></div></div></div></div><div class="modal-backdrop fade show"></div>
    @endif
</div>

@push('styles')
<style>.product-card{transition:all .3s ease}.product-card:hover{transform:translateY(-5px);box-shadow:0 10px 30px rgba(0,0,0,.15)!important}.form-switch .form-check-input{width:3em;height:1.5em;cursor:pointer}</style>
@endpush