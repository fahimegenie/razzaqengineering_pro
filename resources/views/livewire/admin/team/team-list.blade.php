<div>
    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Team Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Team</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Statistics Cards -->
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-people-fill display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $totalMembers }}</h3>
                        <small>Total Members</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-person-check display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $activeMembers }}</h3>
                        <small>Active</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-warning text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-star-fill display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $seniorMembers }}</h3>
                        <small>Senior Members</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body text-center py-3">
                        <i class="bi bi-graph-up display-6"></i>
                        <h3 class="mb-0 mt-1">{{ $averageExperience }}</h3>
                        <small>Avg Experience (Yrs)</small>
                    </div>
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
                            <input type="text" class="form-control" wire:model.blur="search" placeholder="Search members...">
                            @if($search)
                                <button class="btn btn-outline-secondary" wire:click="clearSearch">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Status</label>
                        <select class="form-select" wire:model.blur="statusFilter">
                            <option value="">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Experience</label>
                        <select class="form-select" wire:model.blur="experienceFilter">
                            <option value="">All Levels</option>
                            <option value="senior">Senior (10+ yrs)</option>
                            <option value="mid">Mid (5-9 yrs)</option>
                            <option value="junior">Junior (< 5 yrs)</option>
                            <option value="fresher">Fresher</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold">Show</label>
                        <select class="form-select" wire:model.blur="perPage">
                            <option value="12">12</option>
                            <option value="24">24</option>
                            <option value="48">48</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3 text-end">
                        <button class="btn btn-outline-secondary me-1" wire:click="clearFilters" title="Clear Filters">
                            <i class="bi bi-funnel"></i>
                        </button>
                        <a href="{{ route('admin.team.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Add Member
                        </a>
                    </div>
                </div>
                
                @if(count($selectedMembers) > 0)
                <div class="mt-3 p-2 bg-light rounded d-flex align-items-center gap-2 flex-wrap">
                    <span class="fw-semibold me-2">{{ count($selectedMembers) }} selected</span>
                    <button class="btn btn-sm btn-success" wire:click="bulkActivate">
                        <i class="bi bi-check-circle"></i> Activate
                    </button>
                    <button class="btn btn-sm btn-warning" wire:click="bulkDeactivate">
                        <i class="bi bi-pause-circle"></i> Deactivate
                    </button>
                    <button class="btn btn-sm btn-danger" wire:click="bulkDelete">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
                @endif
            </div>
        </div>

        <!-- Team Grid -->
        <div class="row g-3">
            @forelse($teamMembers as $member)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card shadow-sm border-0 h-100 team-card">
                    <div class="card-body text-center p-3">
                        <!-- Checkbox -->
                        <div class="position-absolute top-0 start-0 m-2">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   @checked(in_array($member->id, $selectedMembers)) 
                                   wire:click="toggleMemberSelection({{ $member->id }})">
                        </div>
                        
                        <!-- Actions -->
                        <div class="position-absolute top-0 end-0 m-2">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-info btn-sm" 
                                        wire:click="viewMemberDetails({{ $member->id }})" 
                                        title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <a href="{{ route('admin.team.edit', ['teamId' => $member->id]) }}" 
                                   class="btn btn-primary btn-sm" 
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" 
                                        wire:click="confirmDelete({{ $member->id }})" 
                                        title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Avatar -->
                        <img src="{{ $member->image_url }}" 
                             class="rounded-circle mb-2 mt-3" 
                             style="width: 90px; height: 90px; object-fit: cover; border: 3px solid #0056b3;"
                             alt="{{ $member->ot_name }}">
                        
                        <!-- Info -->
                        <h6 class="mb-1 fw-bold">{{ Str::limit($member->ot_name, 25) }}</h6>
                        @if($member->ot_designation)
                            <p class="text-muted small mb-2">{{ Str::limit($member->ot_designation, 30) }}</p>
                        @endif
                        
                        <!-- Experience Badge -->
                        <span class="badge bg-info bg-opacity-10 text-info mb-2">
                            <i class="bi bi-briefcase"></i> {{ $member->experience_years }}
                        </span>
                        
                        <!-- Status Badge -->
                        <span class="badge bg-{{ $member->is_active ? 'success' : 'danger' }} bg-opacity-10 text-{{ $member->is_active ? 'success' : 'danger' }}">
                            {{ $member->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        
                        <!-- Skills -->
                        @if(count($member->skills_list) > 0)
                            <div class="mt-2">
                                @foreach(array_slice($member->skills_list, 0, 3) as $skill)
                                    <span class="badge bg-light text-dark me-1 mb-1">{{ Str::limit($skill, 15) }}</span>
                                @endforeach
                                @if(count($member->skills_list) > 3)
                                    <span class="badge bg-secondary">+{{ count($member->skills_list) - 3 }}</span>
                                @endif
                            </div>
                        @endif
                        
                        <!-- Social Links -->
                        @if($member->hasSocialLinks())
                            <div class="mt-2 d-flex justify-content-center gap-2">
                                @if($member->ot_fb)
                                    <a href="{{ $member->ot_fb }}" target="_blank" class="text-primary" title="Facebook">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                @endif
                                @if($member->ot_inst)
                                    <a href="{{ $member->ot_inst }}" target="_blank" class="text-danger" title="Instagram">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                @endif
                                @if($member->ot_twitter)
                                    <a href="{{ $member->ot_twitter }}" target="_blank" class="text-dark" title="Twitter">
                                        <i class="bi bi-twitter-x"></i>
                                    </a>
                                @endif
                                @if($member->ot_linkedin)
                                    <a href="{{ $member->ot_linkedin }}" target="_blank" class="text-info" title="LinkedIn">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                @endif
                                @if($member->ot_email)
                                    <a href="mailto:{{ $member->ot_email }}" class="text-secondary" title="Email">
                                        <i class="bi bi-envelope"></i>
                                    </a>
                                @endif
                            </div>
                        @endif
                        
                        <!-- Toggle Status -->
                        <div class="mt-2">
                            <button class="btn btn-sm btn-{{ $member->is_active ? 'success' : 'secondary' }} w-100" 
                                    wire:click="toggleStatus({{ $member->id }})">
                                <i class="bi bi-{{ $member->is_active ? 'toggle-on' : 'toggle-off' }}"></i>
                                {{ $member->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-people display-1 text-muted d-block mb-3"></i>
                    <h4 class="text-muted">No team members found</h4>
                    <p class="text-muted">Start building your team by adding members</p>
                    <a href="{{ route('admin.team.create') }}" class="btn btn-primary btn-lg mt-2">
                        <i class="bi bi-plus-lg"></i> Add First Member
                    </a>
                </div>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($teamMembers->hasPages())
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Showing {{ $teamMembers->firstItem() }} - {{ $teamMembers->lastItem() }} of {{ $teamMembers->total() }} members
                </small>
                {{ $teamMembers->links() }}
            </div>
        </div>
        @endif
    </div>

    <!-- View Modal -->
    @if($showViewModal && $viewMember)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1055;" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-person-badge"></i> Member Details
                    </h5>
                    <button class="btn-close btn-close-white" wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-4 text-center">
                            <img src="{{ $viewMember->image_url }}" 
                                 class="rounded-circle mb-3 shadow" 
                                 style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #0056b3;">
                            <h5 class="mb-1">{{ $viewMember->ot_name }}</h5>
                            @if($viewMember->ot_designation)
                                <p class="text-muted">{{ $viewMember->ot_designation }}</p>
                            @endif
                            <span class="badge bg-info">{{ $viewMember->experience_years }} Experience</span>
                            
                            @if($viewMember->hasSocialLinks())
                                <div class="mt-3 d-flex justify-content-center gap-3">
                                    @if($viewMember->ot_fb)
                                        <a href="{{ $viewMember->ot_fb }}" target="_blank" class="fs-5 text-primary"><i class="bi bi-facebook"></i></a>
                                    @endif
                                    @if($viewMember->ot_inst)
                                        <a href="{{ $viewMember->ot_inst }}" target="_blank" class="fs-5 text-danger"><i class="bi bi-instagram"></i></a>
                                    @endif
                                    @if($viewMember->ot_twitter)
                                        <a href="{{ $viewMember->ot_twitter }}" target="_blank" class="fs-5 text-dark"><i class="bi bi-twitter-x"></i></a>
                                    @endif
                                    @if($viewMember->ot_linkedin)
                                        <a href="{{ $viewMember->ot_linkedin }}" target="_blank" class="fs-5 text-info"><i class="bi bi-linkedin"></i></a>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h6 class="fw-bold">Bio</h6>
                            <p>{{ $viewMember->ot_description ?: 'No bio available.' }}</p>
                            
                            <hr>
                            
                            <div class="row">
                                @if($viewMember->ot_email)
                                <div class="col-6 mb-2">
                                    <strong><i class="bi bi-envelope"></i> Email:</strong><br>
                                    <a href="mailto:{{ $viewMember->ot_email }}">{{ $viewMember->ot_email }}</a>
                                </div>
                                @endif
                                @if($viewMember->ot_phone)
                                <div class="col-6 mb-2">
                                    <strong><i class="bi bi-telephone"></i> Phone:</strong><br>
                                    <a href="tel:{{ $viewMember->ot_phone }}">{{ $viewMember->ot_phone }}</a>
                                </div>
                                @endif
                            </div>
                            
                            @if(count($viewMember->skills_list) > 0)
                                <hr>
                                <h6 class="fw-bold">Skills</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($viewMember->skills_list as $skill)
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="closeModals">Close</button>
                    <a href="{{ route('admin.team.edit', $viewMember->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif

    <!-- Delete Modal -->
    @if($showDeleteModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1055;" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle"></i> Confirm Delete
                    </h5>
                    <button class="btn-close btn-close-white" wire:click="closeModals"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="bi bi-trash display-3 text-danger mb-3 d-block"></i>
                    <h5>Delete this team member?</h5>
                    <p class="text-muted">This action cannot be undone. All data will be permanently removed.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-secondary" wire:click="closeModals">Cancel</button>
                    <button class="btn btn-danger" wire:click="deleteMember">
                        <i class="bi bi-trash"></i> Yes, Delete Permanently
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
</div>

@push('styles')
<style>
    .team-card {
        transition: all 0.3s ease;
    }
    
    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        cursor: pointer;
    }
    
    .rounded-circle {
        transition: all 0.3s ease;
    }
</style>
@endpush