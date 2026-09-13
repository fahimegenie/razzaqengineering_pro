<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Career;

#[Layout('components.layouts.app-layout')]
#[Title('Job Details - Razzaq Engineering Services')]
class CareerDetailPage extends Component
{
    public $slug;
    public $job;
    public $relatedJobs = [];

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->job = Career::where('slug', $slug)->first();
        
        if ($this->job) {
            $this->relatedJobs = Career::active()
                ->where('id', '!=', $this->job->id)
                ->where('department', $this->job->department)
                ->limit(3)
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.website.career-detail-page')->layoutData(['seo' => $this->job ? ['title' => $this->job->title . ' - Careers'] : []]);
    }
}