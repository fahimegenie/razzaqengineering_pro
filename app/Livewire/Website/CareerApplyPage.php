<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Career;
use App\Models\JobApplication;

#[Layout('components.layouts.app-layout')]
#[Title('Apply for Job - Razzaq Engineering Services')]
class CareerApplyPage extends Component
{
    use WithFileUploads;

    public $slug;
    public $job;
    public $isSubmitting = false;
    public $isSuccess = false;

    #[Validate('required|string|min:3|max:255')]
    public $name = '';

    #[Validate('required|email|max:255')]
    public $email = '';

    #[Validate('required|string|min:10|max:20')]
    public $phone = '';

    #[Validate('nullable|string|max:5000')]
    public $cover_letter = '';

    #[Validate('nullable|file|mimes:pdf,doc,docx|max:5120')]
    public $resume;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->job = Career::where('slug', $slug)->first();
    }

    public function submitApplication()
    {
        $this->validate();
        $this->isSubmitting = true;

        try {
            $resumePath = null;
            if ($this->resume) {
                $resumePath = $this->resume->store('resumes', 'public');
            }

            JobApplication::create([
                'career_id' => $this->job->id ?? null,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'cover_letter' => $this->cover_letter,
                'resume_path' => $resumePath,
                'status' => 'new',
            ]);

            $this->reset(['name', 'email', 'phone', 'cover_letter', 'resume']);
            $this->isSuccess = true;
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to submit application. Please try again.');
        } finally {
            $this->isSubmitting = false;
        }
    }

    public function render()
    {
        return view('livewire.website.career-apply-page');
    }
}