<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\BlogComment;

#[Layout('components.layouts.admin-layout')]
#[Title('Blog Comments - Admin Panel')]
class BlogCommentList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 20;
    public $selectedComments = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $commentToDelete = null;

    public $totalComments = 0;
    public $pendingComments = 0;
    public $approvedComments = 0;

    public function mount() { $this->loadStats(); }
    public function loadStats()
    {
        $this->totalComments = BlogComment::count();
        $this->pendingComments = BlogComment::pending()->count();
        $this->approvedComments = BlogComment::approved()->count();
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function approve($commentId)
    {
        BlogComment::find($commentId)?->update(['comment_status' => 'approved']);
        $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Comment approved.');
    }

    public function reject($commentId)
    {
        BlogComment::find($commentId)?->update(['comment_status' => 'rejected']);
        $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Comment rejected.');
    }

    public function markAsSpam($commentId)
    {
        BlogComment::find($commentId)?->update(['comment_status' => 'spam']);
        $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Comment marked as spam.');
    }

    public function confirmDelete($commentId) { $this->commentToDelete = $commentId; $this->showDeleteModal = true; }
    
    public function deleteComment()
    {
        if ($this->commentToDelete) {
            BlogComment::find($this->commentToDelete)?->delete();
            $this->showDeleteModal = false; $this->commentToDelete = null;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'Comment deleted.');
        }
    }

    public function closeModals() { $this->showDeleteModal = false; $this->commentToDelete = null; }

    public function bulkApprove()
    {
        BlogComment::whereIn('id', $this->selectedComments)->update(['comment_status' => 'approved']);
        $this->selectedComments = []; $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Comments approved.');
    }

    public function bulkDelete()
    {
        BlogComment::whereIn('id', $this->selectedComments)->delete();
        $this->selectedComments = []; $this->loadStats();
        $this->dispatch('toast', type: 'success', message: 'Comments deleted.');
    }

    public function getCommentsProperty()
    {
        return BlogComment::query()
            ->with('post:id,bp_title')
            ->when($this->search, fn($q) => $q->where(fn($sq) => $sq->where('commenter_name', 'like', "%{$this->search}%")->orWhere('comment_content', 'like', "%{$this->search}%")))
            ->when($this->statusFilter !== '', fn($q) => $q->where('comment_status', $this->statusFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.blog.comment-list', ['comments' => $this->getCommentsProperty()]);
    }
}