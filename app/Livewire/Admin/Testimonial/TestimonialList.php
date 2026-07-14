<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Testimonial Management - Admin Panel')]
class TestimonialList extends Component
{
    use WithPagination;

    public $search = '';
    public $ratingFilter = '';
    public $statusFilter = '';
    public $featuredFilter = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $selectedTestimonials = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $testimonialToDelete = null;
    public $showViewModal = false;
    public $viewTestimonial = null;

    // Statistics
    public $totalTestimonials = 0;
    public $activeTestimonials = 0;
    public $featuredTestimonials = 0;
    public $averageRating = 0;

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $this->totalTestimonials = Testimonial::count();
        $this->activeTestimonials = Testimonial::where('is_active', 1)->count();
        $this->featuredTestimonials = Testimonial::where('is_featured', 1)->count();
        // Fixed: Use getAverageRating() instead of averageRating()
        $this->averageRating = Testimonial::getAverageRating();
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedRatingFilter() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedFeaturedFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedTestimonials = $this->selectAll 
            ? $this->getTestimonialsProperty()->pluck('id')->toArray() 
            : [];
    }

    public function toggleTestimonialSelection($testimonialId)
    {
        if (in_array($testimonialId, $this->selectedTestimonials)) {
            $this->selectedTestimonials = array_values(
                array_diff($this->selectedTestimonials, [$testimonialId])
            );
            $this->selectAll = false;
        } else {
            $this->selectedTestimonials[] = $testimonialId;
        }
    }

    public function clearSearch() 
    { 
        $this->search = ''; 
        $this->resetPage(); 
    }
    
    public function clearFilters()
    {
        $this->search = '';
        $this->ratingFilter = '';
        $this->statusFilter = '';
        $this->featuredFilter = '';
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    #[On('testimonial-created'), On('testimonial-updated')]
    public function refreshList()
    {
        $this->resetPage();
        $this->loadStats();
    }

    public function toggleStatus($testimonialId)
    {
        $testimonial = Testimonial::find($testimonialId);
        if ($testimonial) {
            $testimonial->update(['is_active' => !$testimonial->is_active]);
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Testimonial status updated.');
        }
    }

    public function toggleFeatured($testimonialId)
    {
        $testimonial = Testimonial::find($testimonialId);
        if ($testimonial) {
            $testimonial->update(['is_featured' => !$testimonial->is_featured]);
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Testimonial featured status updated.');
        }
    }

    public function confirmDelete($testimonialId)
    {
        $this->testimonialToDelete = $testimonialId;
        $this->showDeleteModal = true;
    }

    public function deleteTestimonial()
    {
        if ($this->testimonialToDelete) {
            $testimonial = Testimonial::find($this->testimonialToDelete);
            if ($testimonial) {
                // Delete image
                if ($testimonial->t_image) {
                    $imagePath = public_path('testimonial_images/' . $testimonial->t_image);
                    if (file_exists($imagePath)) {
                        @unlink($imagePath);
                    }
                }
                $testimonial->delete();
            }
            $this->showDeleteModal = false;
            $this->testimonialToDelete = null;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Testimonial deleted permanently.');
        }
    }

    public function viewTestimonialDetails($testimonialId)
    {
        $this->viewTestimonial = Testimonial::find($testimonialId);
        $this->showViewModal = true;
    }

    public function closeModals()
    {
        $this->showDeleteModal = false;
        $this->showViewModal = false;
        $this->testimonialToDelete = null;
        $this->viewTestimonial = null;
    }

    public function bulkDelete()
    {
        if (count($this->selectedTestimonials) > 0) {
            $count = count($this->selectedTestimonials);
            $testimonials = Testimonial::whereIn('id', $this->selectedTestimonials)->get();
            foreach ($testimonials as $testimonial) {
                if ($testimonial->t_image) {
                    @unlink(public_path('testimonial_images/' . $testimonial->t_image));
                }
                $testimonial->delete();
            }
            $this->selectedTestimonials = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: $count . ' testimonials deleted.');
        }
    }

    public function bulkActivate()
    {
        if (count($this->selectedTestimonials) > 0) {
            Testimonial::whereIn('id', $this->selectedTestimonials)
                ->update(['is_active' => true]);
            $this->selectedTestimonials = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Testimonials activated.');
        }
    }

    public function bulkDeactivate()
    {
        if (count($this->selectedTestimonials) > 0) {
            Testimonial::whereIn('id', $this->selectedTestimonials)
                ->update(['is_active' => false]);
            $this->selectedTestimonials = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Testimonials deactivated.');
        }
    }

    public function bulkFeature()
    {
        if (count($this->selectedTestimonials) > 0) {
            Testimonial::whereIn('id', $this->selectedTestimonials)
                ->update(['is_featured' => true]);
            $this->selectedTestimonials = [];
            $this->selectAll = false;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Testimonials marked as featured.');
        }
    }

    public function getTestimonialsProperty()
    {
        return Testimonial::query()
            ->when($this->search, function($q) {
                $q->where(function($sq) {
                    $sq->where('t_name', 'like', "%{$this->search}%")
                       ->orWhere('t_company', 'like', "%{$this->search}%")
                       ->orWhere('t_designation', 'like', "%{$this->search}%")
                       ->orWhere('t_content', 'like', "%{$this->search}%")
                       ->orWhere('t_location', 'like', "%{$this->search}%");
                });
            })
            ->when($this->ratingFilter !== '', fn($q) => 
                $q->where('t_rating', (int) $this->ratingFilter)
            )
            ->when($this->statusFilter !== '', fn($q) => 
                $q->where('is_active', (int) $this->statusFilter)
            )
            ->when($this->featuredFilter !== '', fn($q) => 
                $q->where('is_featured', (int) $this->featuredFilter)
            )
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.testimonials.testimonial-list', [
            'testimonials' => $this->getTestimonialsProperty(),
        ]);
    }
}