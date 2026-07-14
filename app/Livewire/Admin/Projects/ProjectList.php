<?php

namespace App\Livewire\Admin\Projects;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Project;
use App\Models\ProjectCategory;

#[Layout('components.layouts.admin-layout')]
#[Title('Projects - Admin Panel')]
class ProjectList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $categoryFilter = '';
    public $featuredFilter = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 12;
    public $selectedProjects = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $projectToDelete = null;
    public $showViewModal = false;
    public $viewProject = null;

    public $totalProjects = 0;
    public $activeProjects = 0;
    public $featuredProjects = 0;
    public $completedProjects = 0;
    public $categories = [];

    public function mount()
    {
        $this->loadStats();
        $this->categories = ProjectCategory::active()->orderBy('pc_name')->get();
    }

    public function loadStats()
    {
        $this->totalProjects = Project::getTotalProjects();
        $this->activeProjects = Project::getActiveProjects();
        $this->featuredProjects = Project::getFeaturedProjects();
        $this->completedProjects = Project::getCompletedProjects();
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedCategoryFilter() { $this->resetPage(); }
    public function updatedFeaturedFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedProjects = $this->selectAll ? $this->getProjectsProperty()->pluck('id')->toArray() : [];
    }

    public function toggleProjectSelection($projectId)
    {
        if (in_array($projectId, $this->selectedProjects)) {
            $this->selectedProjects = array_values(array_diff($this->selectedProjects, [$projectId]));
            $this->selectAll = false;
        } else {
            $this->selectedProjects[] = $projectId;
        }
    }

    public function clearSearch() { $this->search = ''; $this->resetPage(); }
    public function clearFilters()
    {
        $this->search = ''; $this->statusFilter = ''; $this->categoryFilter = ''; 
        $this->featuredFilter = ''; $this->resetPage();
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

    #[On('project-created'), On('project-updated')]
    public function refreshList() { $this->resetPage(); $this->loadStats(); }

    public function toggleStatus($projectId)
    {
        $project = Project::find($projectId);
        if ($project) { $project->update(['is_active' => !$project->is_active]); $this->loadStats(); $this->dispatch('toast', type: 'success', message: 'Status updated.'); }
    }

    public function toggleFeatured($projectId)
    {
        $project = Project::find($projectId);
        if ($project) { $project->update(['is_featured' => !$project->is_featured]); $this->loadStats(); $this->dispatch('toast', type: 'success', message: 'Featured status updated.'); }
    }

    public function viewProjectDetails($projectId)
    {
        $this->viewProject = Project::with('category')->find($projectId);
        $this->showViewModal = true;
    }

    public function confirmDelete($projectId) { $this->projectToDelete = $projectId; $this->showDeleteModal = true; }

    public function deleteProject()
    {
        if ($this->projectToDelete) {
            $project = Project::find($this->projectToDelete);
            if ($project) {
                if ($project->p_image) @unlink(public_path('uploads/projects/' . $project->p_image));
                foreach ($project->gallery_urls as $img) {
                    $path = public_path('uploads/projects/gallery/' . basename($img));
                    if (file_exists($path)) @unlink($path);
                }
                $project->delete();
            }
            $this->showDeleteModal = false; $this->projectToDelete = null;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Project deleted.');
        }
    }

    public function closeModals() { $this->showDeleteModal = false; $this->showViewModal = false; $this->projectToDelete = null; $this->viewProject = null; }

    public function bulkDelete()
    {
        if (count($this->selectedProjects) > 0) {
            $count = count($this->selectedProjects);
            $projects = Project::whereIn('id', $this->selectedProjects)->get();
            foreach ($projects as $p) {
                if ($p->p_image) @unlink(public_path('uploads/projects/' . $p->p_image));
                $p->delete();
            }
            $this->selectedProjects = []; $this->selectAll = false; $this->loadStats();
            $this->dispatch('toast', type: 'success', message: $count . ' projects deleted.');
        }
    }

    public function bulkActivate() { Project::whereIn('id', $this->selectedProjects)->update(['is_active' => true]); $this->selectedProjects = []; $this->loadStats(); $this->dispatch('toast', type: 'success', message: 'Projects activated.'); }
    public function bulkDeactivate() { Project::whereIn('id', $this->selectedProjects)->update(['is_active' => false]); $this->selectedProjects = []; $this->loadStats(); $this->dispatch('toast', type: 'success', message: 'Projects deactivated.'); }

    public function getProjectsProperty()
    {
        return Project::query()
            ->with('category')
            ->when($this->search, fn($q) => $q->where(fn($sq) => $sq->where('p_title', 'like', "%{$this->search}%")->orWhere('p_description', 'like', "%{$this->search}%")->orWhere('p_client', 'like', "%{$this->search}%")->orWhere('p_location', 'like', "%{$this->search}%")))
            ->when($this->statusFilter !== '', fn($q) => $q->where('p_status', $this->statusFilter))
            ->when($this->categoryFilter !== '', fn($q) => $q->where('pc_id', $this->categoryFilter))
            ->when($this->featuredFilter !== '', fn($q) => $q->where('is_featured', (int) $this->featuredFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.projects.project-list', [
            'projects' => $this->getProjectsProperty(),
        ]);
    }
}