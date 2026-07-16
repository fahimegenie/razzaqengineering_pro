<?php

namespace App\Livewire;

use App\Models\FleetCategory;
use App\Models\FleetItem;
use Livewire\Component;

class FleetSection extends Component
{
    public $fleetItems = [];
    public $categories = [];

    public function mount()
    {
        $this->loadFleetData();
    }

    public function loadFleetData()
    {
        $this->fleetItems = FleetItem::with(['category', 'media'])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $this->categories = FleetCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function render()
    {
        return view('livewire.fleet-section');
    }
}