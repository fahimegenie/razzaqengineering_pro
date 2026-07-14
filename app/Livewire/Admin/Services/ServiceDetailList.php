<?php

namespace App\Livewire\Admin\Services;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\ServiceDetail;
use App\Models\Service;

#[Layout('components.layouts.admin-layout')]
#[Title('Service Details - Admin Panel')]
class ServiceDetailList extends Component
{
    use WithPagination;

    public $serviceFilter = '';
    public $search = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 15;
    public $selectedDetails = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $detailToDelete = null;
    public $services = [];

    public function mount($serviceId = null)
    {
        $this->services = Service::active()->orderBy('os_name')->get();
        if ($serviceId) $this->serviceFilter = $serviceId;
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedServiceFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function confirmDelete($id) { $this->detailToDelete = $id; $this->showDeleteModal = true; }

    public function deleteDetail()
    {
        if ($this->detailToDelete) {
            $d = ServiceDetail::find($this->detailToDelete);
            if ($d) {
                if ($d->sd_image1) @unlink(public_path('uploads/services/details/' . $d->sd_image1));
                if ($d->sd_image2) @unlink(public_path('uploads/services/details/' . $d->sd_image2));
                $d->delete();
            }
            $this->showDeleteModal = false; $this->detailToDelete = null;
            $this->dispatch('toast', type: 'success', message: 'Detail deleted.');
        }
    }

    public function closeModals() { $this->showDeleteModal = false; $this->detailToDelete = null; }

    public function getDetailsProperty()
    {
        return ServiceDetail::query()
            ->with('service')
            ->when($this->serviceFilter, fn($q) => $q->where('os_id', $this->serviceFilter))
            ->when($this->search, fn($q) => $q->where(fn($sq) => $sq->where('sd_title','like',"%{$this->search}%")->orWhere('sd_description','like',"%{$this->search}%")))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.services.detail-list', ['details' => $this->getDetailsProperty()]);
    }
}