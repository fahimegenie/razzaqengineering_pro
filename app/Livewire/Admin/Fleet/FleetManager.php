<?php
// app/Livewire/Admin/Fleet/FleetManager.php

namespace App\Livewire\Admin\Fleet;

use App\Models\FleetCategory;
use App\Models\FleetItem;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\HandlesUploads; // Trait ko add kiya
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

#[Layout('components.layouts.admin-layout')]
#[Title('Fleet Management - Admin Panel')]
class FleetManager extends Component
{
    use WithPagination, HandlesUploads; // Trait apply kiya (WithFileUploads isme auto-included hai)

    // ============================================
    // ACTIVE TAB
    // ============================================
    public $activeTab = 'list';
    
    // ============================================
    // LIST PROPERTIES
    // ============================================
    public $search = '';
    public $filterCategory = '';
    public $filterStatus = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $perPage = 12;
    public $selectedItems = [];
    public $selectAll = false;
    
    // Loading states
    public $isLoading = false;
    public $isSaving = false;
    public $saveSuccess = false;
    
    // ============================================
    // FORM PROPERTIES (Item)
    // ============================================
    public $showForm = false;
    public $isEditing = false;
    public $itemId = null;

    #[Rule('required|string|max:255')]
    public $title = '';

    #[Rule('required|exists:fleet_categories,id')]
    public $fleet_category_id = '';

    #[Rule('nullable|string')]
    public $description = '';

    #[Rule('nullable|image|max:5120')]
    public $image;
    
    public $existing_image = null; // Purani image ka path store karne ke liye

    #[Rule('nullable|string|max:255')]
    public $manufacturer = '';

    #[Rule('nullable|string|max:100')]
    public $model_number = '';

    #[Rule('nullable|array')]
    public $features = [];

    #[Rule('nullable|array')]
    public $specifications = [];

    #[Rule('boolean')]
    public $is_active = true;

    #[Rule('boolean')]
    public $is_featured = false;

    #[Rule('integer|min:0')]
    public $sort_order = 0;

    public $newFeature = '';
    public $newSpecKey = '';
    public $newSpecValue = '';
    
    // Image preview
    public $imagePreview = null;

    // ============================================
    // CATEGORY FORM PROPERTIES
    // ============================================
    public $isEditingCategory = false;
    public $categoryId = null;

    #[Rule('required|string|max:255')]
    public $categoryName = '';

    #[Rule('nullable|string|max:100')]
    public $categoryIcon = '';

    #[Rule('integer|min:0')]
    public $categorySortOrder = 0;

    #[Rule('boolean')]
    public $categoryIsActive = true;

    // ============================================
    // DELETE MODAL
    // ============================================
    public $showDeleteModal = false;
    public $deleteItemId = null;
    public $deleteItemTitle = '';
    public $deleteType = 'item'; // 'item' or 'category'

    // ============================================
    // DETAIL MODAL
    // ============================================
    public $showDetailModal = false;
    public $detailItem = null;

    // ============================================
    // LIFECYCLE HOOKS
    // ============================================
    public function mount()
    {
        $this->resetForm();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedImage()
    {
        $this->validateOnly('image');
        try {
            $this->imagePreview = $this->image->temporaryUrl();
        } catch (\Exception $e) {
            $this->imagePreview = null;
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = FleetItem::pluck('id')->toArray();
        } else {
            $this->selectedItems = [];
        }
    }

    // ============================================
    // CKEDITOR LISTENER - THIS IS THE KEY FIX
    // ============================================
    #[On('ckeditor-value-updated')]
    public function handleCkEditorUpdate($value, $field)
    {
        $fieldMap = [
            'description' => 'description',
        ];

        if (isset($fieldMap[$field]) && property_exists($this, $fieldMap[$field])) {
            $this->{$fieldMap[$field]} = $value;
        }
    }

    // ============================================
    // TAB SWITCHING
    // ============================================
    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetValidation();
        
        if ($tab === 'list') {
            $this->showForm = false;
        }
    }

    // ============================================
    // SORTING
    // ============================================
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    // ============================================
    // CRUD OPERATIONS - ITEMS
    // ============================================
    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->isEditing = false;
        $this->activeTab = 'form';
    }

    public function edit($id)
    {
        $item = FleetItem::findOrFail($id);
        $this->itemId = $item->id;
        $this->title = $item->title;
        $this->fleet_category_id = $item->fleet_category_id;
        $this->description = $item->description;
        $this->manufacturer = $item->manufacturer;
        $this->model_number = $item->model_number;
        $this->features = $item->features ?? [];
        $this->specifications = $item->specifications ?? [];
        $this->is_active = $item->is_active;
        $this->is_featured = $item->is_featured;
        $this->sort_order = $item->sort_order;
        
        // Purani image path tracker mein safe karli
        $this->existing_image = $item->image;

        // Preview system ko robust banaya
        if ($this->existing_image) {
            $this->imagePreview = Storage::disk('public')->url($this->existing_image);
        } else {
            $this->imagePreview = $item->image_url; // Backwards compatible check
        }

        $this->showForm = true;
        $this->isEditing = true;
        $this->activeTab = 'form';
    }

    public function save()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'fleet_category_id' => 'required|exists:fleet_categories,id',
        ];

        if ($this->image) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,webp|max:5120';
        }

        $this->validate($rules);
        $this->isSaving = true;

        try {
            $data = [
                'fleet_category_id' => $this->fleet_category_id,
                'title' => $this->title,
                'slug' => Str::slug($this->title),
                'description' => $this->description,
                'manufacturer' => $this->manufacturer,
                'model_number' => $this->model_number,
                'features' => array_values(array_filter($this->features)),
                'specifications' => $this->specifications ? array_filter($this->specifications, fn($v) => !is_null($v) && $v !== '') : null,
                'is_active' => $this->is_active,
                'is_featured' => $this->is_featured,
                'sort_order' => $this->sort_order,
            ];

            // Trait ke zariye upload handoff (Purani image auto delete hogi aur nayi path register hogi)
            if ($this->image) {
                $data['image'] = $this->uploadFile($this->image, 'fleet-images', $this->existing_image);
            }

            if ($this->isEditing) {
                FleetItem::find($this->itemId)->update($data);
                $this->dispatch('toast', type: 'success', title: 'Success!', message: 'Fleet item updated successfully.');
            } else {
                FleetItem::create($data);
                $this->dispatch('toast', type: 'success', title: 'Success!', message: 'Fleet item created successfully.');
            }

            $this->resetForm();
            $this->showForm = false;
            $this->saveSuccess = true;
            $this->activeTab = 'list';

        } catch (\Exception $e) {
            Log::error('Fleet save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: 'Failed to save: ' . $e->getMessage());
        }

        $this->isSaving = false;
    }

    public function confirmDelete($id, $type = 'item')
    {
        if ($type === 'item') {
            $item = FleetItem::find($id);
            if ($item) {
                $this->deleteItemId = $id;
                $this->deleteItemTitle = $item->title;
                $this->deleteType = 'item';
                $this->showDeleteModal = true;
            }
        } else {
            $category = FleetCategory::find($id);
            if ($category) {
                $this->deleteItemId = $id;
                $this->deleteItemTitle = $category->name;
                $this->deleteType = 'category';
                $this->showDeleteModal = true;
            }
        }
    }

    public function delete()
    {
        try {
            if ($this->deleteType === 'item') {
                $item = FleetItem::find($this->deleteItemId);
                if ($item) {
                    // Image delete karne ke liye trait ka utility function use kiya
                    if ($item->image) {
                        $this->deleteFile($item->image);
                    }
                    $item->delete();
                    $this->dispatch('toast', type: 'success', title: 'Deleted!', message: 'Fleet item deleted successfully.');
                }
            } else {
                $category = FleetCategory::find($this->deleteItemId);
                if ($category) {
                    if ($category->fleetItems()->count() > 0) {
                        $this->dispatch('toast', type: 'error', title: 'Error!', message: 'Cannot delete category with associated items.');
                        $this->showDeleteModal = false;
                        return;
                    }
                    $category->delete();
                    $this->dispatch('toast', type: 'success', title: 'Deleted!', message: 'Category deleted successfully.');
                }
            }

            $this->showDeleteModal = false;
            $this->deleteItemId = null;
            $this->deleteItemTitle = '';

        } catch (\Exception $e) {
            Log::error('Delete error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: 'Failed to delete.');
        }
    }

    public function toggleStatus($id)
    {
        $item = FleetItem::find($id);
        if ($item) {
            $item->update(['is_active' => !$item->is_active]);
            $this->dispatch('toast', type: 'success', title: 'Updated!', message: 'Status updated successfully.');
        }
    }

    public function toggleFeatured($id)
    {
        $item = FleetItem::find($id);
        if ($item) {
            $item->update(['is_featured' => !$item->is_featured]);
            $this->dispatch('toast', type: 'success', title: 'Updated!', message: 'Featured status updated successfully.');
        }
    }

    public function viewDetails($id)
    {
        $this->detailItem = FleetItem::with('category')->find($id);
        $this->showDetailModal = true;
    }

    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->detailItem = null;
    }

    public function bulkDelete()
    {
        if (empty($this->selectedItems)) {
            $this->dispatch('toast', type: 'warning', title: 'Warning!', message: 'No items selected.');
            return;
        }

        try {
            $items = FleetItem::whereIn('id', $this->selectedItems)->get();
            foreach ($items as $item) {
                if ($item->image) {
                    $this->deleteFile($item->image);
                }
                $item->delete();
            }
            
            $count = count($this->selectedItems);
            $this->selectedItems = [];
            $this->selectAll = false;
            $this->dispatch('toast', type: 'success', title: 'Deleted!', message: "{$count} items deleted successfully.");
        } catch (\Exception $e) {
            Log::error('Bulk delete error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: 'Failed to delete items.');
        }
    }

    public function bulkActivate()
    {
        if (empty($this->selectedItems)) {
            $this->dispatch('toast', type: 'warning', title: 'Warning!', message: 'No items selected.');
            return;
        }

        FleetItem::whereIn('id', $this->selectedItems)->update(['is_active' => true]);
        $this->selectedItems = [];
        $this->selectAll = false;
        $this->dispatch('toast', type: 'success', title: 'Updated!', message: 'Selected items activated.');
    }

    public function bulkDeactivate()
    {
        if (empty($this->selectedItems)) {
            $this->dispatch('toast', type: 'warning', title: 'Warning!', message: 'No items selected.');
            return;
        }

        FleetItem::whereIn('id', $this->selectedItems)->update(['is_active' => false]);
        $this->selectedItems = [];
        $this->selectAll = false;
        $this->dispatch('toast', type: 'success', title: 'Updated!', message: 'Selected items deactivated.');
    }

    // ============================================
    // FEATURES & SPECIFICATIONS
    // ============================================
    public function addFeature()
    {
        $feature = trim($this->newFeature);
        if (!empty($feature)) {
            $this->features[] = $feature;
            $this->newFeature = '';
        }
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function addSpecification()
    {
        $key = trim($this->newSpecKey);
        $value = trim($this->newSpecValue);
        if (!empty($key) && !empty($value)) {
            $this->specifications[$key] = $value;
            $this->newSpecKey = '';
            $this->newSpecValue = '';
        }
    }

    public function removeSpecification($key)
    {
        unset($this->specifications[$key]);
    }

    // ============================================
    // CATEGORY OPERATIONS
    // ============================================
    public function createCategory()
    {
        $this->resetCategoryForm();
        $this->isEditingCategory = false;
        $this->activeTab = 'categories';
    }

    public function editCategory($id)
    {
        $category = FleetCategory::findOrFail($id);
        $this->categoryId = $category->id;
        $this->categoryName = $category->name;
        $this->categoryIcon = $category->icon;
        $this->categorySortOrder = $category->sort_order;
        $this->categoryIsActive = $category->is_active;
        $this->isEditingCategory = true;
        $this->activeTab = 'categories';
    }

    public function saveCategory()
    {
        $this->validate([
            'categoryName' => 'required|string|max:255',
            'categorySortOrder' => 'integer|min:0',
            'categoryIsActive' => 'boolean',
        ]);

        try {
            $data = [
                'name' => $this->categoryName,
                'slug' => Str::slug($this->categoryName),
                'icon' => $this->categoryIcon,
                'sort_order' => $this->categorySortOrder,
                'is_active' => $this->categoryIsActive,
            ];

            if ($this->isEditingCategory) {
                FleetCategory::find($this->categoryId)->update($data);
                $this->dispatch('toast', type: 'success', title: 'Updated!', message: 'Category updated successfully.');
            } else {
                FleetCategory::create($data);
                $this->dispatch('toast', type: 'success', title: 'Created!', message: 'Category created successfully.');
            }

            $this->resetCategoryForm();

        } catch (\Exception $e) {
            Log::error('Category save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: 'Failed to save category.');
        }
    }

    // ============================================
    // CKEDITOR VALUE HANDLER
    // ============================================
    public function setFieldValue($data = [])
    {
        if (is_array($data)) {
            $field = $data['field'] ?? null;
            $value = $data['value'] ?? null;
        } else {
            $field = $data;
            $value = request()->input('value') ?? func_get_arg(1) ?? null;
        }
        
        if ($field && property_exists($this, $field)) {
            $this->$field = $value;
        }
    }

    // ============================================
    // RESET METHODS
    // ============================================
    public function resetForm()
    {
        $this->itemId = null;
        $this->title = '';
        $this->fleet_category_id = '';
        $this->description = '';
        $this->image = null;
        $this->existing_image = null; // Reset also tracker
        $this->imagePreview = null;
        $this->manufacturer = '';
        $this->model_number = '';
        $this->features = [];
        $this->specifications = [];
        $this->is_active = true;
        $this->is_featured = false;
        $this->sort_order = 0;
        $this->newFeature = '';
        $this->newSpecKey = '';
        $this->newSpecValue = '';
        $this->resetValidation();
    }

    public function resetCategoryForm()
    {
        $this->categoryId = null;
        $this->categoryName = '';
        $this->categoryIcon = '';
        $this->categorySortOrder = 0;
        $this->categoryIsActive = true;
        $this->isEditingCategory = false;
        $this->resetValidation(['categoryName', 'categorySortOrder']);
    }

    // ============================================
    // COMPUTED PROPERTIES
    // ============================================
    #[Computed]
    public function totalItems(): int
    {
        return FleetItem::count();
    }

    #[Computed]
    public function activeItems(): int
    {
        return FleetItem::where('is_active', true)->count();
    }

    #[Computed]
    public function featuredItems(): int
    {
        return FleetItem::where('is_featured', true)->count();
    }

    #[Computed]
    public function totalCategories(): int
    {
        return FleetCategory::count();
    }

    #[Computed]
    public function getTabsProperty(): array
    {
        return [
            'list' => ['label' => 'All Items', 'icon' => 'bi-list-ul'],
            'form' => ['label' => $this->isEditing ? 'Edit Item' : 'Add Item', 'icon' => 'bi-pencil-square'],
            'categories' => ['label' => 'Categories', 'icon' => 'bi-folder'],
        ];
    }

    // ============================================
    // RENDER
    // ============================================
    public function render()
    {
        $query = FleetItem::query()->with('category');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('manufacturer', 'like', '%' . $this->search . '%')
                  ->orWhere('model_number', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterCategory) {
            $query->where('fleet_category_id', $this->filterCategory);
        }

        if ($this->filterStatus !== '') {
            $query->where('is_active', $this->filterStatus === 'active');
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        $items = $query->paginate($this->perPage);
        $categories = FleetCategory::ordered()->get();

        return view('livewire.admin.fleet.fleet-manager', [
            'items' => $items,
            'categories' => $categories,
            'tabs' => $this->tabs,
        ]);
    }
}