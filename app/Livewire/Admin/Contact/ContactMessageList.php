<?php

namespace App\Livewire\Admin\Contact;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Contact Messages - Admin Panel')]
class ContactMessageList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $priorityFilter = '';
    public $sourceFilter = '';
    public $cityFilter = '';
    public $dateFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 15;
    public $selectedMessages = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $messageToDelete = null;
    public $showViewModal = false;
    public $viewMessage = null;
    public $showStatusModal = false;
    public $statusMessageId = null;
    public $newStatus = '';
    public $newPriority = '';
    public $adminNotes = '';
    public $assignTo = null;
    public $followUpDate = null;

    public $totalMessages = 0;
    public $newMessages = 0;
    public $todayMessages = 0;
    public $highPriorityMessages = 0;
    public $cities = [];
    public $services = [];
    public $users = [];

    public function mount()
    {
        $this->loadStats();
        $this->cities = ContactMessage::getCities();
        $this->services = Service::active()->orderBy('os_name')->get();
        $this->users = User::orderBy('name')->get();
    }

    public function loadStats()
    {
        $this->totalMessages = ContactMessage::getTotalMessages();
        $this->newMessages = ContactMessage::getNewMessages();
        $this->todayMessages = ContactMessage::getTodayMessages();
        $this->highPriorityMessages = ContactMessage::getHighPriorityMessages();
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedPriorityFilter() { $this->resetPage(); }
    public function updatedSourceFilter() { $this->resetPage(); }
    public function updatedCityFilter() { $this->resetPage(); }
    public function updatedDateFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedMessages = $this->selectAll ? $this->getMessagesProperty()->pluck('id')->toArray() : [];
    }

    public function toggleMessageSelection($id)
    {
        if (in_array($id, $this->selectedMessages)) {
            $this->selectedMessages = array_values(array_diff($this->selectedMessages, [$id]));
            $this->selectAll = false;
        } else {
            $this->selectedMessages[] = $id;
        }
    }

    public function clearSearch() { $this->search = ''; $this->resetPage(); }
    public function clearFilters()
    {
        $this->search = ''; $this->statusFilter = ''; $this->priorityFilter = '';
        $this->sourceFilter = ''; $this->cityFilter = ''; $this->dateFilter = '';
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

    public function viewMessageDetails($id)
    {
        $this->viewMessage = ContactMessage::with(['service', 'assignedTo'])->find($id);
        // Auto-mark as read when viewing
        if ($this->viewMessage && $this->viewMessage->cm_status === 'new') {
            $this->viewMessage->update(['cm_status' => 'read']);
            $this->loadStats();
        }
        $this->showViewModal = true;
    }

    public function openStatusModal($id)
    {
        $message = ContactMessage::find($id);
        if ($message) {
            $this->statusMessageId = $id;
            $this->newStatus = $message->cm_status;
            $this->newPriority = $message->cm_priority;
            $this->adminNotes = $message->cm_notes ?? '';
            $this->assignTo = $message->assigned_to;
            $this->followUpDate = $message->follow_up_date ? $message->follow_up_date->format('Y-m-d\TH:i') : null;
            $this->showStatusModal = true;
        }
    }

    public function updateStatus()
    {
        if ($this->statusMessageId) {
            $message = ContactMessage::find($this->statusMessageId);
            if ($message) {
                $message->update([
                    'cm_status' => $this->newStatus,
                    'cm_priority' => $this->newPriority,
                    'cm_notes' => $this->adminNotes,
                    'assigned_to' => $this->assignTo,
                    'follow_up_date' => $this->followUpDate,
                ]);
                $this->loadStats();
                $this->dispatch('toast', type: 'success', message: 'Status updated successfully!');
            }
        }
        $this->showStatusModal = false;
        $this->statusMessageId = null;
    }

    public function markAsRead($id)
    {
        ContactMessage::find($id)?->update(['cm_status' => 'read']);
        $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Marked as read.');
    }

    public function markAsContacted($id)
    {
        ContactMessage::find($id)?->update(['cm_status' => 'contacted']);
        $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Marked as contacted.');
    }

    public function markAsResolved($id)
    {
        ContactMessage::find($id)?->update(['cm_status' => 'resolved']);
        $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Marked as resolved.');
    }

    public function confirmDelete($id) { $this->messageToDelete = $id; $this->showDeleteModal = true; }

    public function deleteMessage()
    {
        if ($this->messageToDelete) {
            ContactMessage::find($this->messageToDelete)?->delete();
            $this->showDeleteModal = false; $this->messageToDelete = null;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Message deleted.');
        }
    }

    public function closeModals()
    {
        $this->showDeleteModal = false; $this->showViewModal = false; $this->showStatusModal = false;
        $this->messageToDelete = null; $this->viewMessage = null; $this->statusMessageId = null;
    }

    public function bulkDelete()
    {
        if (count($this->selectedMessages) > 0) {
            $count = count($this->selectedMessages);
            ContactMessage::whereIn('id', $this->selectedMessages)->delete();
            $this->selectedMessages = []; $this->selectAll = false; $this->loadStats();
            $this->dispatch('toast', type: 'success', message: $count . ' messages deleted.');
        }
    }

    public function bulkMarkRead()
    {
        ContactMessage::whereIn('id', $this->selectedMessages)->update(['cm_status' => 'read']);
        $this->selectedMessages = []; $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Messages marked as read.');
    }

    public function bulkMarkContacted()
    {
        ContactMessage::whereIn('id', $this->selectedMessages)->update(['cm_status' => 'contacted']);
        $this->selectedMessages = []; $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Messages marked as contacted.');
    }

    public function bulkMarkResolved()
    {
        ContactMessage::whereIn('id', $this->selectedMessages)->update(['cm_status' => 'resolved']);
        $this->selectedMessages = []; $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Messages marked as resolved.');
    }

    public function getMessagesProperty()
    {
        return ContactMessage::query()
            ->with(['service', 'assignedTo'])
            ->when($this->search, fn($q) => $q->where(fn($sq) => $sq
                ->where('cm_name', 'like', "%{$this->search}%")
                ->orWhere('cm_email', 'like', "%{$this->search}%")
                ->orWhere('cm_phone', 'like', "%{$this->search}%")
                ->orWhere('cm_subject', 'like', "%{$this->search}%")
                ->orWhere('cm_message', 'like', "%{$this->search}%")
                ->orWhere('cm_company', 'like', "%{$this->search}%")
                ->orWhere('cm_city', 'like', "%{$this->search}%")
            ))
            ->when($this->statusFilter !== '', fn($q) => $q->where('cm_status', $this->statusFilter))
            ->when($this->priorityFilter !== '', fn($q) => $q->where('cm_priority', $this->priorityFilter))
            ->when($this->sourceFilter !== '', fn($q) => $q->where('cm_source', $this->sourceFilter))
            ->when($this->cityFilter !== '', fn($q) => $q->where('cm_city', $this->cityFilter))
            ->when($this->dateFilter === 'today', fn($q) => $q->today())
            ->when($this->dateFilter === 'week', fn($q) => $q->thisWeek())
            ->orderByRaw("FIELD(cm_priority, 'urgent', 'high', 'medium', 'low')")
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.contacts.contact-list', [
            'messages' => $this->getMessagesProperty(),
        ]);
    }
}