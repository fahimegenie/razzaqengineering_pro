<?php

namespace App\Livewire\Admin\Team;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\OurTeam;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Team Management - Admin Panel')]
class TeamList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $experienceFilter = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 12;
    public $selectedMembers = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $memberToDelete = null;
    public $showViewModal = false;
    public $viewMember = null;

    // Statistics
    public $totalMembers = 0;
    public $activeMembers = 0;
    public $averageExperience = 0;
    public $seniorMembers = 0;

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $this->totalMembers = OurTeam::count();
        $this->activeMembers = OurTeam::where('is_active', 1)->count();
        $this->averageExperience = OurTeam::getAverageExperience();
        $this->seniorMembers = OurTeam::where('ot_experience', '>=', 10)->count();
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedExperienceFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedMembers = $this->selectAll 
            ? $this->getTeamMembersProperty()->pluck('id')->toArray() 
            : [];
    }

    public function toggleMemberSelection($memberId)
    {
        if (in_array($memberId, $this->selectedMembers)) {
            $this->selectedMembers = array_values(
                array_diff($this->selectedMembers, [$memberId])
            );
            $this->selectAll = false;
        } else {
            $this->selectedMembers[] = $memberId;
        }
    }

    public function clearSearch() 
    { 
        $this->search = ''; 
        $this->resetPage(); 
    }
    
    public function clearFilters()
    {
        $this->search = '';
        $this->statusFilter = '';
        $this->experienceFilter = '';
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    #[On('team-created'), On('team-updated')]
    public function refreshList()
    {
        $this->resetPage();
        $this->loadStats();
    }

    public function toggleStatus($memberId)
    {
        $member = OurTeam::find($memberId);
        if ($member) {
            $member->update(['is_active' => !$member->is_active]);
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Member status updated.');
        }
    }

    public function confirmDelete($memberId)
    {
        $this->memberToDelete = $memberId;
        $this->showDeleteModal = true;
    }

    public function deleteMember()
    {
        if ($this->memberToDelete) {
            $member = OurTeam::find($this->memberToDelete);
            if ($member) {
                // Delete image
                if ($member->ot_image) {
                    $imagePaths = [
                        public_path('team_images/' . $member->ot_image),
                        public_path('uploads/team/' . $member->ot_image),
                    ];
                    foreach ($imagePaths as $path) {
                        if (file_exists($path)) {
                            @unlink($path);
                        }
                    }
                }
                $member->delete();
            }
            $this->showDeleteModal = false;
            $this->memberToDelete = null;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Team member deleted permanently.');
        }
    }

    public function viewMemberDetails($memberId)
    {
        $this->viewMember = OurTeam::find($memberId);
        $this->showViewModal = true;
    }

    public function closeModals()
    {
        $this->showDeleteModal = false;
        $this->showViewModal = false;
        $this->memberToDelete = null;
        $this->viewMember = null;
    }

    public function bulkDelete()
    {
        if (count($this->selectedMembers) > 0) {
            $count = count($this->selectedMembers);
            $members = OurTeam::whereIn('id', $this->selectedMembers)->get();
            foreach ($members as $member) {
                if ($member->ot_image) {
                    @unlink(public_path('team_images/' . $member->ot_image));
                    @unlink(public_path('uploads/team/' . $member->ot_image));
                }
                $member->delete();
            }
            $this->selectedMembers = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: $count . ' members deleted.');
        }
    }

    public function bulkActivate()
    {
        if (count($this->selectedMembers) > 0) {
            OurTeam::whereIn('id', $this->selectedMembers)
                ->update(['is_active' => true]);
            $this->selectedMembers = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Members activated.');
        }
    }

    public function bulkDeactivate()
    {
        if (count($this->selectedMembers) > 0) {
            OurTeam::whereIn('id', $this->selectedMembers)
                ->update(['is_active' => false]);
            $this->selectedMembers = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Members deactivated.');
        }
    }

    public function getTeamMembersProperty()
    {
        return OurTeam::query()
            ->when($this->search, function($q) {
                $q->where(function($sq) {
                    $sq->where('ot_name', 'like', "%{$this->search}%")
                       ->orWhere('ot_designation', 'like', "%{$this->search}%")
                       ->orWhere('ot_email', 'like', "%{$this->search}%")
                       ->orWhere('ot_phone', 'like', "%{$this->search}%")
                       ->orWhere('ot_description', 'like', "%{$this->search}%");
                });
            })
            ->when($this->statusFilter !== '', fn($q) => 
                $q->where('is_active', (int) $this->statusFilter)
            )
            ->when($this->experienceFilter !== '', function($q) {
                if ($this->experienceFilter === 'senior') {
                    $q->where('ot_experience', '>=', 10);
                } elseif ($this->experienceFilter === 'mid') {
                    $q->whereBetween('ot_experience', [5, 9]);
                } elseif ($this->experienceFilter === 'junior') {
                    $q->where('ot_experience', '<', 5);
                } elseif ($this->experienceFilter === 'fresher') {
                    $q->where('ot_experience', 0)->orWhereNull('ot_experience');
                }
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.team.team-list', [
            'teamMembers' => $this->getTeamMembersProperty(),
        ]);
    }
}