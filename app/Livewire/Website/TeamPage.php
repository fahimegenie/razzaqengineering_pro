<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\OurTeam;
use App\Models\SeoData;
use App\Models\Service;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app-layout')]
#[Title('Our Team - Razzaq Engineering Services')]
class TeamPage extends Component
{
    public $isLoading = true;
    public $errorMessage = '';
    public $search = '';

    public $teamMembers = [];
    public $seo = null;
    public $services = [];
    public $pc = [];
    public $selectedMember = null;
    public $showModal = false;

    public function mount()
    {
        try {
            $this->isLoading = true;

            $this->seo = SeoData::where('seo_page_type', 'Team')->first();
            $this->teamMembers = OurTeam::active()->ordered()->get();
            $this->services = Service::active()->ordered()->get();
            $this->pc = ProductCategory::active()->select('pc_name')->get();

            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load team data.';
            $this->isLoading = false;
            Log::error('TeamPage error: ' . $e->getMessage());
        }
    }

    /**
     * Computed property for filtered members
     */
    public function getFilteredMembersProperty()
    {
        if (empty($this->search)) {
            return $this->teamMembers;
        }
        return $this->teamMembers->filter(function ($member) {
            return stripos($member->ot_name, $this->search) !== false ||
                   stripos($member->ot_designation, $this->search) !== false ||
                   stripos($member->ot_description ?? '', $this->search) !== false;
        });
    }

    /**
     * Open member detail modal
     */
    public function openMemberModal($memberId)
    {
        $this->selectedMember = $this->teamMembers->firstWhere('ot_id', $memberId);
        $this->showModal = true;
    }

    /**
     * Close member modal
     */
    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedMember = null;
    }

    /**
     * Updated search
     */
    public function updatedSearch()
    {
        // Reset when searching
    }

    public function render()
    {
        return view('livewire.website.team-page', [
            'filteredMembers' => $this->filteredMembers,
        ]);
    }
}