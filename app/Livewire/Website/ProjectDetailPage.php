<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\SeoData;
use App\Models\ProductCategory;
use App\Models\Service;
use App\Traits\HasDynamicSEO;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app-layout', ['seo' => []])]
class ProjectDetailPage extends Component
{
    use HasDynamicSEO;
    
    public $projectSlug = null;
    public $project = null;
    public $relatedProjects = [];
    public $projectCategories = [];
    public $services = [];
    public $seo = null;
    public $pc = [];
    public $isLoading = true;
    public $errorMessage = '';
    public $galleryImages = [];
    public $activeGalleryImage = null;

    public function mount($slug = null)
    {
        try {
            $this->isLoading = true;
            $this->initializeSEO('project_detail', $slug);
            $this->projectSlug = $slug;

            if ($slug) {
                $this->project = Project::with('category')
                    ->where('p_slug', $slug)
                    ->orWhere('id', $slug)
                    ->first();

                if (!$this->project) {
                    $this->project = Project::where('p_title', 'like', '%' . str_replace('-', ' ', $slug) . '%')
                        ->with('category')
                        ->first();
                }

                if (!$this->project) {
                    $this->errorMessage = 'Project not found. Please check the URL or browse our projects.';
                    $this->isLoading = false;
                    return;
                }

                if ($this->project->p_gallery) {
                    $this->galleryImages = is_array($this->project->p_gallery) 
                        ? $this->project->p_gallery 
                        : json_decode($this->project->p_gallery, true) ?? [];
                }

                $this->relatedProjects = Project::active()
                    ->where('id', '!=', $this->project->id)
                    ->where(function ($q) {
                        $q->where('pc_id', $this->project->pc_id)
                          ->orWhere('p_location', 'like', '%' . ($this->project->p_location ?? '') . '%');
                    })
                    ->ordered()
                    ->limit(4)
                    ->get();

                $this->projectCategories = ProjectCategory::active()->ordered()->get();
                $this->services = Service::active()->ordered()->get();
                $this->pc = ProductCategory::active()->select('pc_name')->get();

            } else {
                $this->errorMessage = 'No project specified.';
            }

            $this->isLoading = false;

        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load project details.';
            $this->isLoading = false;
            Log::error('ProjectDetail error: ' . $e->getMessage());
        }
    }

    public function openGallery($imageIndex)
    {
        $this->activeGalleryImage = $imageIndex;
        $this->dispatch('gallery-opened');
    }

    public function closeGallery()
    {
        $this->activeGalleryImage = null;
    }

    public function nextGalleryImage()
    {
        if ($this->activeGalleryImage !== null && count($this->galleryImages) > 0) {
            $this->activeGalleryImage = ($this->activeGalleryImage + 1) % count($this->galleryImages);
        }
    }

    public function prevGalleryImage()
    {
        if ($this->activeGalleryImage !== null && count($this->galleryImages) > 0) {
            $this->activeGalleryImage = ($this->activeGalleryImage - 1 + count($this->galleryImages)) % count($this->galleryImages);
        }
    }

    #[Title('Project Details - Razzaq Engineering Services')]
    public function render()
    {
        $seo = $this->getSeoData();
        return view('livewire.website.project-detail-page')->layoutData(['seo' => $seo]);
    }
}