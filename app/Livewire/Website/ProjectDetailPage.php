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
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app-layout')]
class ProjectDetailPage extends Component
{
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
        // try {
            $this->isLoading = true;
            $this->projectSlug = $slug;

            if ($slug) {
                // Convert slug back to possible title format
                $titleFromSlug = str_replace('-', ' ', $slug);
                
                // Find project by multiple conditions
                $this->project = Project::with('category')
                    ->whereRaw("
                                LOWER(
                                    REPLACE(
                                        REPLACE(
                                            REPLACE(
                                                REPLACE(p_title, '(', '_'),
                                            ')', '_'),
                                        '?', '_'),
                                    ' ', '-')
                                ) = ?
                            ", [
                                strtolower($slug)
                            ])
                    ->first();


                // Agar abhi bhi nahi mila to numeric ID check karo
                if (!$this->project && is_numeric($slug)) {
                    $this->project = Project::where('p_id', (int) $slug)
                        ->with('category')
                        ->first();
                }

                // Final fallback - fuzzy search
                if (!$this->project) {
                    $this->project = Project::where('p_title', 'like', '%' . str_replace('-', ' ', $slug) . '%')
                        ->orWhere('p_slug', 'like', '%' . $slug . '%')
                        ->with('category')
                        ->first();
                }

                if (!$this->project) {
                    $this->errorMessage = 'Project not found. Please check the URL or browse our projects.';
                    $this->isLoading = false;
                    return;
                }

                // Rest of the code...
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
                $this->seo = SeoData::where('seo_page_type', 'Project - ' . $this->project->p_title)->first();
                $this->pc = ProductCategory::active()->select('pc_name')->get();

            } else {
                $this->errorMessage = 'No project specified. Please select a project to view.';
            }

            $this->isLoading = false;

        // } catch (\Exception $e) {
        //     $this->errorMessage = 'Failed to load project details. Please try again.';
        //     $this->isLoading = false;
        //     Log::error('ProjectDetail error: ' . $e->getMessage());
        // }
    }

    /**
     * Open gallery modal
     */
    public function openGallery($imageIndex)
    {
        $this->activeGalleryImage = $imageIndex;
    }

    /**
     * Close gallery modal
     */
    public function closeGallery()
    {
        $this->activeGalleryImage = null;
    }

    /**
     * Next gallery image
     */
    public function nextGalleryImage()
    {
        if ($this->activeGalleryImage !== null && count($this->galleryImages) > 0) {
            $this->activeGalleryImage = ($this->activeGalleryImage + 1) % count($this->galleryImages);
        }
    }

    /**
     * Previous gallery image
     */
    public function prevGalleryImage()
    {
        if ($this->activeGalleryImage !== null && count($this->galleryImages) > 0) {
            $this->activeGalleryImage = ($this->activeGalleryImage - 1 + count($this->galleryImages)) % count($this->galleryImages);
        }
    }

    #[Title('Project Details - Razzaq Engineering Services')]
    public function render()
    {
        return view('livewire.website.project-detail-page');
    }
}