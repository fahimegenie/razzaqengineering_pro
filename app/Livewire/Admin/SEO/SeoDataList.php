<?php

namespace App\Livewire\Admin\SEO;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\SeoData;

#[Layout('components.layouts.admin-layout')]
#[Title('SEO Management - Admin Panel')]
class SeoDataList extends Component
{
    use WithPagination;

    public $search = '';
    public $pageTypeFilter = '';
    public $indexFilter = '';
    public $sitemapFilter = '';
    public $sortField = 'seo_page_type';
    public $sortDirection = 'asc';
    public $perPage = 15;
    public $selectedItems = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $itemToDelete = null;
    public $showViewModal = false;
    public $viewItem = null;

    public $totalRecords = 0;
    public $indexableRecords = 0;
    public $inSitemapRecords = 0;
    public $pageTypes = [];

    public function mount()
    {
        $this->loadStats();
        $this->pageTypes = SeoData::getPageTypes();
    }

    public function loadStats()
    {
        $this->totalRecords = SeoData::getTotalSeoRecords();
        $this->indexableRecords = SeoData::getIndexableRecords();
        $this->inSitemapRecords = SeoData::getInSitemapRecords();
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedPageTypeFilter() { $this->resetPage(); }
    public function updatedIndexFilter() { $this->resetPage(); }
    public function updatedSitemapFilter() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        $this->selectedItems = $this->selectAll ? $this->getSeoRecordsProperty()->pluck('id')->toArray() : [];
    }

    public function toggleItemSelection($id)
    {
        if (in_array($id, $this->selectedItems)) {
            $this->selectedItems = array_values(array_diff($this->selectedItems, [$id]));
            $this->selectAll = false;
        } else {
            $this->selectedItems[] = $id;
        }
    }

    public function clearSearch() { $this->search = ''; $this->resetPage(); }
    public function clearFilters() { $this->search = ''; $this->pageTypeFilter = ''; $this->indexFilter = ''; $this->sitemapFilter = ''; $this->resetPage(); }

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortField === $field && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    #[On('seo-created'), On('seo-updated')]
    public function refreshList() { $this->resetPage(); $this->loadStats(); $this->pageTypes = SeoData::getPageTypes(); }

    public function viewItemDetails($id) { $this->viewItem = SeoData::find($id); $this->showViewModal = true; }
    public function confirmDelete($id) { $this->itemToDelete = $id; $this->showDeleteModal = true; }

    public function deleteItem()
    {
        if ($this->itemToDelete) {
            $item = SeoData::find($this->itemToDelete);
            if ($item) {
                if ($item->seo_og_image) @unlink(public_path('uploads/seo/' . $item->seo_og_image));
                if ($item->seo_twitter_image) @unlink(public_path('uploads/seo/' . $item->seo_twitter_image));
                $item->delete();
            }
            $this->showDeleteModal = false; $this->itemToDelete = null;
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: 'SEO record deleted.');
        }
    }

    public function closeModals() { $this->showDeleteModal = false; $this->showViewModal = false; $this->itemToDelete = null; $this->viewItem = null; }

    public function bulkDelete()
    {
        if (count($this->selectedItems) > 0) {
            $items = SeoData::whereIn('id', $this->selectedItems)->get();
            foreach ($items as $item) {
                if ($item->seo_og_image) @unlink(public_path('uploads/seo/' . $item->seo_og_image));
                if ($item->seo_twitter_image) @unlink(public_path('uploads/seo/' . $item->seo_twitter_image));
                $item->delete();
            }
            $this->selectedItems = []; $this->selectAll = false; $this->loadStats();
            $this->dispatch('toast', type: 'success', message: count($items) . ' records deleted.');
        }
    }

    public function getSeoRecordsProperty()
    {
        return SeoData::query()
            ->when($this->search, fn($q) => $q->where(fn($sq) => $sq->where('seo_title','like',"%{$this->search}%")->orWhere('seo_description','like',"%{$this->search}%")->orWhere('seo_page_type','like',"%{$this->search}%")->orWhere('seo_page_url','like',"%{$this->search}%")))
            ->when($this->pageTypeFilter !== '', fn($q) => $q->where('seo_page_type', $this->pageTypeFilter))
            ->when($this->indexFilter !== '', fn($q) => $q->where('seo_no_index', $this->indexFilter === 'noindex'))
            ->when($this->sitemapFilter !== '', fn($q) => $q->where('seo_sitemap_include', (int) $this->sitemapFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.seo.seo-list', ['seoRecords' => $this->getSeoRecordsProperty()]);
    }
}