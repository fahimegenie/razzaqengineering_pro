<?php

namespace App\Livewire\Admin\Services;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Service;

#[Layout('components.layouts.admin-layout')]
#[Title('Services - Admin Panel')]
class ServiceList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $featuredFilter = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 12;
    public $selectedServices = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $serviceToDelete = null;
    public $showViewModal = false;
    public $viewService = null;

    public $totalServices = 0;
    public $activeServices = 0;
    public $featuredServices = 0;

    public function mount() { $this->loadStats(); }
    
    public function loadStats()
    {
        $this->totalServices = Service::getTotalServices();
        $this->activeServices = Service::getActiveServices();
        $this->featuredServices = Service::getFeaturedServices();
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedFeaturedFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedServices = $this->selectAll ? $this->getServicesProperty()->pluck('id')->toArray() : [];
    }

    public function toggleServiceSelection($serviceId)
    {
        if (in_array($serviceId, $this->selectedServices)) {
            $this->selectedServices = array_values(array_diff($this->selectedServices, [$serviceId]));
            $this->selectAll = false;
        } else {
            $this->selectedServices[] = $serviceId;
        }
    }

    public function clearSearch() { $this->search = ''; $this->resetPage(); }
    public function clearFilters() { $this->search = ''; $this->statusFilter = ''; $this->featuredFilter = ''; $this->resetPage(); }

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortField === $field && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    #[On('service-created'), On('service-updated')]
    public function refreshList() { $this->resetPage(); $this->loadStats(); }

    public function toggleStatus($id)
    {
        $s = Service::find($id);
        if ($s) { $s->update(['is_active' => !$s->is_active]); $this->loadStats(); $this->dispatch('toast', type: 'success', message: 'Status updated.'); }
    }

    public function toggleFeatured($id)
    {
        $s = Service::find($id);
        if ($s) { $s->update(['is_featured' => !$s->is_featured]); $this->loadStats(); $this->dispatch('toast', type: 'success', message: 'Featured updated.'); }
    }

    public function viewServiceDetails($id) { $this->viewService = Service::with('serviceDetails','serviceAdvantages')->find($id); $this->showViewModal = true; }
    public function confirmDelete($id) { $this->serviceToDelete = $id; $this->showDeleteModal = true; }

    public function deleteService()
    {
        if ($this->serviceToDelete) {
            $s = Service::find($this->serviceToDelete);
            if ($s) {
                if ($s->os_image) @unlink(public_path('uploads/services/' . $s->os_image));
                if ($s->os_banner) @unlink(public_path('uploads/services/banners/' . $s->os_banner));
                $s->delete();
            }
            $this->showDeleteModal = false; $this->serviceToDelete = null; $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Service deleted.');
        }
    }

    public function closeModals() { $this->showDeleteModal = false; $this->showViewModal = false; $this->serviceToDelete = null; $this->viewService = null; }

    public function bulkDelete()
    {
        if (count($this->selectedServices) > 0) {
            $services = Service::whereIn('id', $this->selectedServices)->get();
            foreach ($services as $s) {
                if ($s->os_image) @unlink(public_path('uploads/services/' . $s->os_image));
                if ($s->os_banner) @unlink(public_path('uploads/services/banners/' . $s->os_banner));
                $s->delete();
            }
            $this->selectedServices = []; $this->selectAll = false; $this->loadStats();
            $this->dispatch('toast', type: 'success', message: count($services) . ' services deleted.');
        }
    }

    public function bulkActivate() { Service::whereIn('id', $this->selectedServices)->update(['is_active' => true]); $this->selectedServices = []; $this->loadStats(); $this->dispatch('toast', type: 'success', message: 'Services activated.'); }
    public function bulkDeactivate() { Service::whereIn('id', $this->selectedServices)->update(['is_active' => false]); $this->selectedServices = []; $this->loadStats(); $this->dispatch('toast', type: 'success', message: 'Services deactivated.'); }

    public function getServicesProperty()
    {
        return Service::query()
            ->when($this->search, fn($q) => $q->where(fn($sq) => $sq->where('os_name','like',"%{$this->search}%")->orWhere('os_description','like',"%{$this->search}%")))
            ->when($this->statusFilter !== '', fn($q) => $q->where('is_active', (int) $this->statusFilter))
            ->when($this->featuredFilter !== '', fn($q) => $q->where('is_featured', (int) $this->featuredFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.services.service-list', ['services' => $this->getServicesProperty()]);
    }
}