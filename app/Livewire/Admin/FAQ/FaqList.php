<?php

namespace App\Livewire\Admin\FAQ;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Faq;

#[Layout('components.layouts.admin-layout')]
#[Title('FAQ Management - Admin Panel')]
class FaqList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $categoryFilter = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $selectedFaqs = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $faqToDelete = null;
    public $showViewModal = false;
    public $viewFaq = null;

    public function updatedSearch() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedCategoryFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedFaqs = $this->selectAll ? $this->getFaqsProperty()->pluck('id')->toArray() : [];
    }

    public function toggleFaqSelection($faqId)
    {
        if (in_array($faqId, $this->selectedFaqs)) {
            $this->selectedFaqs = array_values(array_diff($this->selectedFaqs, [$faqId]));
            $this->selectAll = false;
        } else {
            $this->selectedFaqs[] = $faqId;
        }
    }

    public function clearSearch() { $this->search = ''; $this->resetPage(); }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field && $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    #[On('faq-created'), On('faq-updated')]
    public function refreshList() { $this->resetPage(); }

    public function toggleStatus($faqId)
    {
        $faq = Faq::find($faqId);
        if ($faq) { $faq->update(['is_active' => !$faq->is_active]); $this->dispatch('toast', type: 'success', message: 'Status updated.'); }
    }

    public function confirmDelete($faqId) { $this->faqToDelete = $faqId; $this->showDeleteModal = true; }

    public function deleteFaq()
    {
        if ($this->faqToDelete) {
            Faq::where('id', $this->faqToDelete)->delete();
            $this->showDeleteModal = false; $this->faqToDelete = null;
            $this->dispatch('toast', type: 'success', message: 'FAQ deleted.');
        }
    }

    public function viewFaqDetails($faqId) { $this->viewFaq = Faq::find($faqId); $this->showViewModal = true; }

    public function closeModals() { $this->showDeleteModal = false; $this->showViewModal = false; $this->faqToDelete = null; $this->viewFaq = null; }

    public function bulkDelete()
    {
        if (count($this->selectedFaqs) > 0) {
            $count = count($this->selectedFaqs);
            Faq::whereIn('id', $this->selectedFaqs)->delete();
            $this->selectedFaqs = []; $this->selectAll = false;
            $this->dispatch('toast', type: 'success', message: $count . ' FAQs deleted.');
        }
    }

    public function bulkActivate()
    {
        if (count($this->selectedFaqs) > 0) {
            Faq::whereIn('id', $this->selectedFaqs)->update(['is_active' => true]);
            $this->selectedFaqs = []; $this->selectAll = false;
            $this->dispatch('toast', type: 'success', message: 'FAQs activated.');
        }
    }

    public function bulkDeactivate()
    {
        if (count($this->selectedFaqs) > 0) {
            Faq::whereIn('id', $this->selectedFaqs)->update(['is_active' => false]);
            $this->selectedFaqs = []; $this->selectAll = false;
            $this->dispatch('toast', type: 'success', message: 'FAQs deactivated.');
        }
    }

    public function getCategoriesProperty()
    {
        return Faq::select('faq_category')->distinct()->whereNotNull('faq_category')->where('faq_category', '!=', '')->pluck('faq_category');
    }

    public function getFaqsProperty()
    {
        return Faq::query()
            ->when($this->search, fn($q) => $q->where(fn($sq) => $sq->where('faq_question', 'like', "%{$this->search}%")->orWhere('faq_answer', 'like', "%{$this->search}%")->orWhere('faq_category', 'like', "%{$this->search}%")))
            ->when($this->statusFilter !== '', fn($q) => $q->where('is_active', (int) $this->statusFilter))
            ->when($this->categoryFilter, fn($q) => $q->where('faq_category', $this->categoryFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.faq.faq-list', [
            'faqs' => $this->getFaqsProperty(),
            'categories' => $this->getCategoriesProperty(),
        ]);
    }
}