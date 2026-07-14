<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1 class="mb-0 fs-3">Blog Posts</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Blog Posts</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Stats -->
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body text-center py-3"><i class="bi bi-file-text display-6"></i><h3 class="mb-0 mt-1">{{ $totalPosts }}</h3><small>Total Posts</small></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center py-3"><i class="bi bi-check-circle display-6"></i><h3 class="mb-0 mt-1">{{ $publishedPosts }}</h3><small>Published</small></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-warning text-white">
                    <div class="card-body text-center py-3"><i class="bi bi-pencil-square display-6"></i><h3 class="mb-0 mt-1">{{ $draftPosts }}</h3><small>Drafts</small></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body text-center py-3"><i class="bi bi-eye display-6"></i><h3 class="mb-0 mt-1">{{ number_format($totalViews) }}</h3><small>Total Views</small></div>
                </div>
            </div>
        </div>

        <!-- Toolbar -->
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-md-3">
                        <label class="form-label small fw-semibold">Search</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" wire:model.blur="search" placeholder="Search posts...">
                            @if($search)<button class="btn btn-outline-secondary" wire:click="clearSearch"><i class="bi bi-x-lg"></i></button>@endif
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Status</label>
                        <select class="form-select" wire:model.blur="statusFilter">
                            <option value="">All</option><option value="published">Published</option><option value="draft">Draft</option><option value="scheduled">Scheduled</option><option value="archived">Archived</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Category</label>
                        <select class="form-select" wire:model.blur="categoryFilter">
                            <option value="">All</option>
                            @foreach($categories as $cat)<option value="{{ $cat->id }}">{{ $cat->bc_name }}</option>@endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Featured</label>
                        <select class="form-select" wire:model.blur="featuredFilter">
                            <option value="">All</option><option value="1">Featured</option><option value="0">Not Featured</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3 text-end">
                        <button class="btn btn-outline-secondary me-1" wire:click="clearFilters"><i class="bi bi-funnel"></i></button>
                        <a href="{{ route('admin.blog.posts.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> New Post</a>
                    </div>
                </div>
                @if(count($selectedPosts) > 0)
                <div class="mt-3 p-2 bg-light rounded d-flex align-items-center gap-2 flex-wrap">
                    <span class="fw-semibold me-2">{{ count($selectedPosts) }} selected</span>
                    <button class="btn btn-sm btn-success" wire:click="bulkPublish"><i class="bi bi-cloud-upload"></i> Publish</button>
                    <button class="btn btn-sm btn-danger" wire:click="bulkDelete"><i class="bi bi-trash"></i> Delete</button>
                </div>
                @endif
            </div>
        </div>

        <!-- Posts Table -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="40"><input type="checkbox" class="form-check-input" @checked($selectAll) wire:click="toggleSelectAll"></th>
                                <th width="70">Image</th>
                                <th wire:click="sortBy('bp_title')" style="cursor:pointer;">Title @if($sortField==='bp_title')<i class="bi bi-arrow-{{ $sortDirection==='asc'?'up':'down' }}"></i>@endif</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th width="80">Status</th>
                                <th width="70">Views</th>
                                <th width="70">Comments</th>
                                <th width="100">Date</th>
                                <th width="170">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                            <tr>
                                <td><input type="checkbox" class="form-check-input" @checked(in_array($post->id, $selectedPosts)) wire:click="togglePostSelection({{ $post->id }})"></td>
                                <td><img src="{{ $post->image_url }}" class="rounded" style="width:50px;height:40px;object-fit:cover;"></td>
                                <td>
                                    <strong>{{ Str::limit($post->bp_title, 50) }}</strong>
                                    @if($post->is_featured)<span class="badge bg-warning ms-1"><i class="bi bi-star-fill"></i></span>@endif
                                    @if($post->is_trending)<span class="badge bg-danger ms-1"><i class="bi bi-fire"></i></span>@endif
                                </td>
                                <td><span class="badge" style="background-color: {{ $post->category->bc_color ?? '#6c757d' }}20; color: {{ $post->category->bc_color ?? '#6c757d' }};">{{ $post->category->bc_name ?? 'N/A' }}</span></td>
                                <td><small>{{ $post->author->name ?? 'N/A' }}</small></td>
                                <td>
                                    @if($post->bp_status === 'published')<span class="badge bg-success">Published</span>
                                    @elseif($post->bp_status === 'draft')<span class="badge bg-secondary">Draft</span>
                                    @elseif($post->bp_status === 'scheduled')<span class="badge bg-info">Scheduled</span>
                                    @else<span class="badge bg-dark">Archived</span>@endif
                                </td>
                                <td><small>{{ number_format($post->views_count) }}</small></td>
                                <td><span class="badge bg-info">{{ $post->comments_count }}</span></td>
                                <td><small>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</small></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-info" wire:click="viewPostDetails({{ $post->id }})" title="View"><i class="bi bi-eye"></i></button>
                                        <a href="{{ route('admin.blog.posts.edit', ['postId' => $post->id]) }}" class="btn btn-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-{{ $post->is_featured ? 'warning' : 'outline-warning' }}" wire:click="toggleFeatured({{ $post->id }})" title="Featured"><i class="bi bi-star"></i></button>
                                        <button class="btn btn-{{ $post->is_trending ? 'danger' : 'outline-danger' }}" wire:click="toggleTrending({{ $post->id }})" title="Trending"><i class="bi bi-fire"></i></button>
                                        <button class="btn btn-danger" wire:click="confirmDelete({{ $post->id }})" title="Delete"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="10" class="text-center py-5">
                                <i class="bi bi-journal-text display-4 text-muted d-block mb-2"></i>
                                <h5>No posts found</h5>
                                <a href="{{ route('admin.blog.posts.create') }}" class="btn btn-primary mt-2"><i class="bi bi-plus-lg"></i> Create First Post</a>
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($posts->hasPages())
            <div class="card-footer d-flex justify-content-between">
                <small>Showing {{ $posts->firstItem() }}-{{ $posts->lastItem() }} of {{ $posts->total() }}</small>
                {{ $posts->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- View Modal -->
    @if($showViewModal && $viewPost)
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;">
        <div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content">
            <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="bi bi-eye"></i> Post Details</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-5">
                        <img src="{{ $viewPost->image_url }}" class="img-fluid rounded mb-3">
                        <div class="d-flex gap-2 flex-wrap mb-2">
                            <span class="badge bg-primary">{{ $viewPost->category->bc_name ?? 'N/A' }}</span>
                            @foreach($viewPost->tags as $tag)<span class="badge bg-secondary">{{ $tag->bt_name }}</span>@endforeach
                        </div>
                        <p><strong>Author:</strong> {{ $viewPost->author->name ?? 'N/A' }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($viewPost->bp_status) }}</p>
                        <p><strong>Views:</strong> {{ number_format($viewPost->views_count) }}</p>
                        <p><strong>Reading Time:</strong> {{ $viewPost->reading_time }} min</p>
                    </div>
                    <div class="col-md-7">
                        <h4>{{ $viewPost->bp_title }}</h4>
                        <p class="text-muted">{{ $viewPost->bp_excerpt }}</p>
                        <hr>
                        <div style="max-height:300px;overflow-y:auto;">{!! Str::limit(strip_tags($viewPost->bp_content), 500) !!}</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" wire:click="closeModals">Close</button><a href="{{ route('admin.blog.posts.edit', $viewPost->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i> Edit</a></div>
        </div></div></div><div class="modal-backdrop fade show"></div>
    @endif

    <!-- Delete Modal -->
    @if($showDeleteModal)
    <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);z-index:1055;">
        <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirm Delete</h5><button class="btn-close btn-close-white" wire:click="closeModals"></button></div>
            <div class="modal-body text-center py-4"><i class="bi bi-trash display-3 text-danger mb-3 d-block"></i><h5>Delete this post?</h5><p class="text-muted">This cannot be undone.</p></div>
            <div class="modal-footer justify-content-center"><button class="btn btn-secondary" wire:click="closeModals">Cancel</button><button class="btn btn-danger" wire:click="deletePost"><i class="bi bi-trash"></i> Yes, Delete</button></div>
        </div></div></div><div class="modal-backdrop fade show"></div>
    @endif
</div>

@push('styles')
<style>
.form-switch .form-check-input { width: 3em; height: 1.5em; cursor: pointer; }
</style>
@endpush