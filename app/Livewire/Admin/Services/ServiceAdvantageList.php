<?php

namespace App\Livewire\Admin\Services;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\ServiceAdvantage;
use App\Models\Service;

#[Layout('components.layouts.admin-layout')]
#[Title('Service Advantages - Admin Panel')]
class ServiceAdvantageList extends Component
{
    use WithPagination;

    public $serviceFilter = '';
    public $search = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 15;
    public $showDeleteModal = false;
    public $advantageToDelete = null;
    public $services = [];

    public function mount($serviceId = null)
    {
        $this->services = Service::active()->orderBy('os_name')->get();
        if ($serviceId) $this->serviceFilter = $serviceId;
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedServiceFilter() { $this->resetPage(); }

    public function confirmDelete($id) { $this->advantageToDelete = $id; $this->showDeleteModal = true; }

    public function deleteAdvantage()
    {
        if ($this->advantageToDelete) {
            $adv = ServiceAdvantage::find($this->advantageToDelete);
            if ($adv) {
                if ($adv->sa_image) @unlink(public_path('uploads/services/advantages/' . $adv->sa_image));
                $adv->delete();
            }
            $this->showDeleteModal = false; $this->advantageToDelete = null;
            $this->dispatch('toast', type: 'success', message: 'Advantage deleted.');
        }
    }

    public function closeModals() { $this->showDeleteModal = false; $this->advantageToDelete = null; }

    public function getAdvantagesProperty()
    {
        return ServiceAdvantage::query()
            ->with('service')
            ->when($this->serviceFilter, fn($q) => $q->where('sa_st_id', $this->serviceFilter))
            ->when($this->search, fn($q) => $q->where(fn($sq) => $sq->where('sa_title','like',"%{$this->search}%")->orWhere('sa_description','like',"%{$this->search}%")))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.services.advantage-list', ['advantages' => $this->getAdvantagesProperty()]);
    }
}