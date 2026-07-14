<?php

namespace App\Livewire\Admin\Quote;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\QuoteRequest;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Quote Requests - Admin Panel')]
class QuoteRequestList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $serviceFilter = '';
    public $dateFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 15;
    public $selectedQuotes = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $quoteToDelete = null;
    public $showViewModal = false;
    public $viewQuote = null;
    public $showStatusModal = false;
    public $statusQuoteId = null;
    public $newStatus = '';
    public $adminNotes = '';

    public $totalQuotes = 0;
    public $pendingQuotes = 0;
    public $todayQuotes = 0;
    public $completedQuotes = 0;
    public $serviceTypes = [];
    public $locations = [];

    public function mount()
    {
        $this->loadStats();
        $this->serviceTypes = QuoteRequest::getServiceTypes();
        $this->locations = QuoteRequest::getLocations();
    }

    public function loadStats()
    {
        $this->totalQuotes = QuoteRequest::getTotalQuotes();
        $this->pendingQuotes = QuoteRequest::getPendingQuotes();
        $this->todayQuotes = QuoteRequest::getTodayQuotes();
        $this->completedQuotes = QuoteRequest::getCompletedQuotes();
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedServiceFilter() { $this->resetPage(); }
    public function updatedDateFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedQuotes = $this->selectAll ? $this->getQuotesProperty()->pluck('id')->toArray() : [];
    }

    public function toggleQuoteSelection($id)
    {
        if (in_array($id, $this->selectedQuotes)) {
            $this->selectedQuotes = array_values(array_diff($this->selectedQuotes, [$id]));
            $this->selectAll = false;
        } else {
            $this->selectedQuotes[] = $id;
        }
    }

    public function clearSearch() { $this->search = ''; $this->resetPage(); }
    public function clearFilters()
    {
        $this->search = ''; $this->statusFilter = ''; $this->serviceFilter = ''; $this->dateFilter = '';
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'desc';
        }
    }

    public function viewQuoteDetails($id)
    {
        $this->viewQuote = QuoteRequest::find($id);
        $this->showViewModal = true;
    }

    public function openStatusModal($id)
    {
        $quote = QuoteRequest::find($id);
        if ($quote) {
            $this->statusQuoteId = $id;
            $this->newStatus = $quote->qr_status;
            $this->adminNotes = $quote->qr_admin_notes ?? '';
            $this->showStatusModal = true;
        }
    }

    public function updateStatus()
    {
        if ($this->statusQuoteId && $this->newStatus) {
            $quote = QuoteRequest::find($this->statusQuoteId);
            if ($quote) {
                $quote->update([
                    'qr_status' => $this->newStatus,
                    'qr_admin_notes' => $this->adminNotes,
                ]);
                $this->loadStats();
                $this->dispatch('toast', type: 'success', message: 'Status updated successfully!');
            }
        }
        $this->showStatusModal = false;
        $this->statusQuoteId = null;
    }

    public function markAsContacted($id)
    {
        QuoteRequest::find($id)?->update(['qr_status' => 'contacted']);
        $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Marked as contacted.');
    }

    public function markAsCompleted($id)
    {
        QuoteRequest::find($id)?->update(['qr_status' => 'completed']);
        $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Marked as completed.');
    }

    public function confirmDelete($id) { $this->quoteToDelete = $id; $this->showDeleteModal = true; }

    public function deleteQuote()
    {
        if ($this->quoteToDelete) {
            $quote = QuoteRequest::find($this->quoteToDelete);
            if ($quote) {
                if ($quote->qr_attachment) {
                    @unlink(public_path('uploads/quote-attachments/' . $quote->qr_attachment));
                }
                $quote->delete();
            }
            $this->showDeleteModal = false; $this->quoteToDelete = null;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Quote deleted.');
        }
    }

    public function closeModals()
    {
        $this->showDeleteModal = false; $this->showViewModal = false; $this->showStatusModal = false;
        $this->quoteToDelete = null; $this->viewQuote = null; $this->statusQuoteId = null;
    }

    public function bulkDelete()
    {
        if (count($this->selectedQuotes) > 0) {
            $quotes = QuoteRequest::whereIn('id', $this->selectedQuotes)->get();
            foreach ($quotes as $q) {
                if ($q->qr_attachment) @unlink(public_path('uploads/quote-attachments/' . $q->qr_attachment));
                $q->delete();
            }
            $this->selectedQuotes = []; $this->selectAll = false; $this->loadStats();
            $this->dispatch('toast', type: 'success', message: count($quotes) . ' quotes deleted.');
        }
    }

    public function bulkMarkContacted()
    {
        QuoteRequest::whereIn('id', $this->selectedQuotes)->update(['qr_status' => 'contacted']);
        $this->selectedQuotes = []; $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Quotes marked as contacted.');
    }

    public function bulkMarkCompleted()
    {
        QuoteRequest::whereIn('id', $this->selectedQuotes)->update(['qr_status' => 'completed']);
        $this->selectedQuotes = []; $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Quotes marked as completed.');
    }

    public function getQuotesProperty()
    {
        return QuoteRequest::query()
            ->when($this->search, fn($q) => $q->where(fn($sq) => $sq
                ->where('qr_name', 'like', "%{$this->search}%")
                ->orWhere('qr_email', 'like', "%{$this->search}%")
                ->orWhere('qr_phone', 'like', "%{$this->search}%")
                ->orWhere('qr_company', 'like', "%{$this->search}%")
                ->orWhere('qr_service_type', 'like', "%{$this->search}%")
                ->orWhere('qr_location', 'like', "%{$this->search}%")
            ))
            ->when($this->statusFilter !== '', fn($q) => $q->where('qr_status', $this->statusFilter))
            ->when($this->serviceFilter !== '', fn($q) => $q->where('qr_service_type', $this->serviceFilter))
            ->when($this->dateFilter === 'today', fn($q) => $q->today())
            ->when($this->dateFilter === 'week', fn($q) => $q->thisWeek())
            ->when($this->dateFilter === 'month', fn($q) => $q->thisMonth())
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.quotes.quote-list', [
            'quotes' => $this->getQuotesProperty(),
        ]);
    }
}