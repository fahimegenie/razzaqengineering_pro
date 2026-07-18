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
    public $perPage = 100;
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
    }

    public function loadStats()
    {
        $this->totalRecords = SeoData::count();
        $this->indexableRecords = SeoData::where('seo_no_index', false)->count();
        $this->inSitemapRecords = SeoData::where('seo_sitemap_include', true)->count();
        $this->pageTypes = SeoData::distinct()->pluck('seo_page_type')->filter()->values()->toArray();
    }

    public function updatedSearch() 
    { 
        $this->resetPage(); 
    }
    
    public function updatedPageTypeFilter() 
    { 
        $this->resetPage(); 
    }
    
    public function updatedIndexFilter() 
    { 
        $this->resetPage(); 
    }
    
    public function updatedSitemapFilter() 
    { 
        $this->resetPage(); 
    }
    
    public function updatedPerPage() 
    { 
        $this->resetPage(); 
    }

    public function toggleSelectAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = $this->getSeoRecordsProperty()->pluck('id')->toArray();
        } else {
            $this->selectedItems = [];
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = $this->getSeoRecordsProperty()->pluck('id')->toArray();
        } else {
            $this->selectedItems = [];
        }
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

    public function clearSearch() 
    { 
        $this->search = ''; 
        $this->resetPage(); 
    }
    
    public function clearFilters() 
    { 
        $this->search = ''; 
        $this->pageTypeFilter = ''; 
        $this->indexFilter = ''; 
        $this->sitemapFilter = ''; 
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

    #[On('seo-created'), On('seo-updated')]
    public function refreshList() 
    { 
        $this->resetPage(); 
        $this->loadStats(); 
    }

    public function viewItemDetails($id) 
    { 
        $this->viewItem = SeoData::find($id); 
        $this->showViewModal = true; 
    }
    
    public function confirmDelete($id) 
    { 
        $this->itemToDelete = $id; 
        $this->showDeleteModal = true; 
    }

    public function deleteItem()
    {
        if ($this->itemToDelete) {
            $item = SeoData::find($this->itemToDelete);
            if ($item) {
                // Delete associated images if they exist
                if ($item->seo_og_image && file_exists(public_path($item->seo_og_image))) {
                    @unlink(public_path($item->seo_og_image));
                }
                if ($item->seo_twitter_image && file_exists(public_path($item->seo_twitter_image))) {
                    @unlink(public_path($item->seo_twitter_image));
                }
                $item->delete();
                $this->dispatch('toast', type: 'success', message: 'SEO record deleted successfully.');
            }
            $this->showDeleteModal = false; 
            $this->itemToDelete = null;
            $this->loadStats();
        }
    }

    public function closeModals() 
    { 
        $this->showDeleteModal = false; 
        $this->showViewModal = false; 
        $this->itemToDelete = null; 
        $this->viewItem = null; 
    }

    public function bulkDelete()
    {
        if (count($this->selectedItems) > 0) {
            $items = SeoData::whereIn('id', $this->selectedItems)->get();
            foreach ($items as $item) {
                if ($item->seo_og_image && file_exists(public_path($item->seo_og_image))) {
                    @unlink(public_path($item->seo_og_image));
                }
                if ($item->seo_twitter_image && file_exists(public_path($item->seo_twitter_image))) {
                    @unlink(public_path($item->seo_twitter_image));
                }
                $item->delete();
            }
            $this->selectedItems = []; 
            $this->selectAll = false; 
            $this->loadStats();
            $this->dispatch('toast', type: 'success', message: count($items) . ' records deleted successfully.');
        }
    }

    public function getSeoRecordsProperty()
    {
        return SeoData::query()
            ->when($this->search, function ($q) {
                $q->where(function ($sq) {
                    $sq->where('seo_title', 'like', "%{$this->search}%")
                       ->orWhere('seo_description', 'like', "%{$this->search}%")
                       ->orWhere('seo_page_type', 'like', "%{$this->search}%")
                       ->orWhere('seo_page_url', 'like', "%{$this->search}%")
                       ->orWhere('seo_keywords', 'like', "%{$this->search}%");
                });
            })
            ->when($this->pageTypeFilter !== '', function ($q) {
                $q->where('seo_page_type', $this->pageTypeFilter);
            })
            ->when($this->indexFilter !== '', function ($q) {
                $q->where('seo_no_index', $this->indexFilter === 'noindex');
            })
            ->when($this->sitemapFilter !== '', function ($q) {
                $q->where('seo_sitemap_include', (bool) $this->sitemapFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    // Helper for view
    public function getPageTypeLabel($type)
    {
        return ucwords(str_replace(['-', '_'], ' ', $type ?? 'website'));
    }
    
    public function getSitemapPriorityFormatted($priority)
    {
        return number_format(($priority ?? 50) / 100, 1);
    }
    
    public function hasSchemaMarkup($record)
    {
        return !empty($record->seo_schema_markup);
    }
    
    public function hasAnalytics($record)
    {
        return !empty($record->google_analytics_id) || 
               !empty($record->google_tag_manager_id) || 
               !empty($record->facebook_pixel_id);
    }

    public function render()
    {
        return view('livewire.admin.seo.seo-list', [
            'seoRecords' => $this->getSeoRecordsProperty(),
        ]);
    }
}