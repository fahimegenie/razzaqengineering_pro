<?php

namespace App\Livewire\Admin\Slider;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Slider Management - Admin Panel')]
class SliderList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $typeFilter = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $selectedSliders = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $sliderToDelete = null;
    public $showViewModal = false;
    public $viewSlider = null;

    public function updatedSearch() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedTypeFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedSliders = $this->selectAll ? $this->getSlidersProperty()->pluck('id')->toArray() : [];
    }

    public function toggleSliderSelection($sliderId)
    {
        if (in_array($sliderId, $this->selectedSliders)) {
            $this->selectedSliders = array_values(array_diff($this->selectedSliders, [$sliderId]));
            $this->selectAll = false;
        } else {
            $this->selectedSliders[] = $sliderId;
        }
    }

    public function clearSearch() { $this->search = ''; $this->resetPage(); }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    #[On('slider-created'), On('slider-updated')]
    public function refreshList() { $this->resetPage(); }

    public function toggleStatus($sliderId)
    {
        $slider = Slider::find($sliderId);
        if ($slider) {
            $slider->update(['is_active' => !$slider->is_active]);
            $this->dispatch('toast', type: 'success', message: 'Slider status updated.');
        }
    }

    public function toggleFeatured($sliderId)
    {
        $slider = Slider::find($sliderId);
        if ($slider) {
            $slider->update(['is_featured' => !$slider->is_featured]);
            $this->dispatch('toast', type: 'success', message: 'Slider featured status updated.');
        }
    }

    public function confirmDelete($sliderId) { $this->sliderToDelete = $sliderId; $this->showDeleteModal = true; }

    public function deleteSlider()
    {
        if ($this->sliderToDelete) {
            $slider = Slider::find($this->sliderToDelete);
            if ($slider) {
                // Delete images
                if ($slider->s_image) {
                    Storage::disk('public')->delete('slider_image/' . $slider->s_image);
                    @unlink(public_path('slider_image/' . $slider->s_image));
                }
                if ($slider->s_mobile_image) {
                    @unlink(public_path('slider_image/' . $slider->s_mobile_image));
                }
                $slider->delete();
            }
            $this->showDeleteModal = false; $this->sliderToDelete = null;
            $this->dispatch('toast', type: 'success', message: 'Slider deleted permanently.');
        }
    }

    public function viewSliderDetails($sliderId)
    {
        $this->viewSlider = Slider::find($sliderId);
        $this->showViewModal = true;
    }

    public function closeModals()
    {
        $this->showDeleteModal = false; $this->showViewModal = false;
        $this->sliderToDelete = null; $this->viewSlider = null;
    }

    public function bulkDelete()
    {
        if (count($this->selectedSliders) > 0) {
            $count = count($this->selectedSliders);
            $sliders = Slider::whereIn('id', $this->selectedSliders)->get();
            foreach ($sliders as $slider) {
                @unlink(public_path('slider_image/' . $slider->s_image));
                @unlink(public_path('slider_image/' . $slider->s_mobile_image));
                $slider->delete();
            }
            $this->selectedSliders = []; $this->selectAll = false;
            $this->dispatch('toast', type: 'success', message: $count . ' sliders deleted.');
        }
    }

    public function bulkActivate()
    {
        if (count($this->selectedSliders) > 0) {
            Slider::whereIn('id', $this->selectedSliders)->update(['is_active' => true]);
            $this->selectedSliders = []; $this->selectAll = false;
            $this->dispatch('toast', type: 'success', message: 'Sliders activated.');
        }
    }

    public function bulkDeactivate()
    {
        if (count($this->selectedSliders) > 0) {
            Slider::whereIn('id', $this->selectedSliders)->update(['is_active' => false]);
            $this->selectedSliders = []; $this->selectAll = false;
            $this->dispatch('toast', type: 'success', message: 'Sliders deactivated.');
        }
    }

    public function getSliderTypesProperty()
    {
        return Slider::distinct()->whereNotNull('slider_type')->pluck('slider_type');
    }

    public function getSlidersProperty()
    {
        return Slider::query()
            ->when($this->search, fn($q) => $q->where(fn($sq) => $sq->where('s_title', 'like', "%{$this->search}%")->orWhere('s_description', 'like', "%{$this->search}%")))
            ->when($this->statusFilter !== '', fn($q) => $q->where('is_active', (int) $this->statusFilter))
            ->when($this->typeFilter, fn($q) => $q->where('slider_type', $this->typeFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.sliders.slider-list', [
            'sliders' => $this->getSlidersProperty(),
            'sliderTypes' => $this->getSliderTypesProperty(),
        ]);
    }
}