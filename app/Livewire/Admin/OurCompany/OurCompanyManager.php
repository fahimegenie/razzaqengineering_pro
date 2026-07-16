<?php
// app/Livewire/Admin/OurCompany/OurCompanyManager.php

namespace App\Livewire\Admin\OurCompany;

use App\Models\OurCompany;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\HandlesUploads; // Custom Trait Import
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Our Companies - Admin Panel')]
class OurCompanyManager extends Component
{
    use HandlesUploads;

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
    // FORM PROPERTIES
    // ============================================
    public $showForm = false;
    public $isEditing = false;
    public $itemId = null;

    #[Rule('required|string|max:255')]
    public $oc_title = '';

    #[Rule('nullable|string')]
    public $oc_description = '';

    #[Rule('nullable|string|max:255')]
    public $our_company_category = '';

    #[Rule('nullable|string|max:10')]
    public $established_year = '';

    #[Rule('nullable|string|max:100')]
    public $company_type = '';

    #[Rule('boolean')]
    public $is_active = true;

    #[Rule('integer|min:0')]
    public $sort_order = 0;

    // Images
    #[Rule('nullable|image|max:5120')]
    public $oc_image1;
    #[Rule('nullable|image|max:5120')]
    public $oc_image2;
    #[Rule('nullable|image|max:5120')]
    public $oc_image3;
    #[Rule('nullable|image|max:5120')]
    public $oc_image4;

    public $image1Preview = null;
    public $image2Preview = null;
    public $image3Preview = null;
    public $image4Preview = null;

    // CEO
    #[Rule('nullable|string|max:255')]
    public $ceo_name = '';

    #[Rule('nullable|image|max:5120')]
    public $ceo_image;

    #[Rule('nullable|string')]
    public $ceo_message = '';

    public $ceoImagePreview = null;

    // Categories list
    public $categories = [];

    // ============================================
    // DELETE MODAL
    // ============================================
    public $showDeleteModal = false;
    public $deleteItemId = null;
    public $deleteItemTitle = '';

    // ============================================
    // LIFECYCLE
    // ============================================
    public function mount()
    {
        $this->loadCategories();
        $this->resetForm();
    }

    private function loadCategories()
    {
        $this->categories = OurCompany::whereNotNull('our_company_category')
            ->where('our_company_category', '!=', '')
            ->distinct()
            ->pluck('our_company_category')
            ->toArray();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = OurCompany::pluck('id')->toArray();
        } else {
            $this->selectedItems = [];
        }
    }

    // ============================================
    // IMAGE UPLOAD HANDLERS
    // ============================================
    public function updatedOcImage1()
    {
        $this->validateOnly('oc_image1');
        try { $this->image1Preview = $this->oc_image1->temporaryUrl(); } 
        catch (\Exception $e) { $this->image1Preview = null; }
    }

    public function updatedOcImage2()
    {
        $this->validateOnly('oc_image2');
        try { $this->image2Preview = $this->oc_image2->temporaryUrl(); } 
        catch (\Exception $e) { $this->image2Preview = null; }
    }

    public function updatedOcImage3()
    {
        $this->validateOnly('oc_image3');
        try { $this->image3Preview = $this->oc_image3->temporaryUrl(); } 
        catch (\Exception $e) { $this->image3Preview = null; }
    }

    public function updatedOcImage4()
    {
        $this->validateOnly('oc_image4');
        try { $this->image4Preview = $this->oc_image4->temporaryUrl(); } 
        catch (\Exception $e) { $this->image4Preview = null; }
    }

    public function updatedCeoImage()
    {
        $this->validateOnly('ceo_image');
        try { $this->ceoImagePreview = $this->ceo_image->temporaryUrl(); } 
        catch (\Exception $e) { $this->ceoImagePreview = null; }
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
    // CRUD OPERATIONS
    // ============================================
    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->isEditing = false;
    }

    public function edit($id)
    {
        $item = OurCompany::findOrFail($id);
        $this->itemId = $item->id;
        $this->oc_title = $item->oc_title;
        $this->oc_description = $item->oc_description;
        $this->our_company_category = $item->our_company_category;
        $this->established_year = $item->established_year;
        $this->company_type = $item->company_type;
        $this->is_active = $item->is_active;
        $this->sort_order = $item->sort_order;
        $this->ceo_name = $item->ceo_name;
        $this->ceo_message = $item->ceo_message;
        
        $this->image1Preview = $item->image1_url;
        $this->image2Preview = $item->image2_url;
        $this->image3Preview = $item->image3_url;
        $this->image4Preview = $item->image4_url;
        $this->ceoImagePreview = $item->ceo_image_url;
        
        $this->showForm = true;
        $this->isEditing = true;
    }

    public function save()
    {
        $this->validate([
            'oc_title' => 'required|string|max:255',
        ]);
        
        $this->isSaving = true;

        try {
            $data = [
                'oc_title' => $this->oc_title,
                'oc_description' => $this->oc_description,
                'our_company_category' => $this->our_company_category,
                'established_year' => $this->established_year,
                'company_type' => $this->company_type,
                'is_active' => $this->is_active,
                'sort_order' => $this->sort_order,
                'ceo_name' => $this->ceo_name,
                'ceo_message' => $this->ceo_message,
            ];

            if ($this->isEditing) {
                $item = OurCompany::find($this->itemId);
            } else {
                $item = new OurCompany();
            }

            // --- TRAIT BASED UPLOAD (No custom path or manual delete logic) ---
            
            // 1. Company images dynamic upload handle
            $imageFields = [
                'oc_image1' => 'oc_image1',
                'oc_image2' => 'oc_image2',
                'oc_image3' => 'oc_image3',
                'oc_image4' => 'oc_image4',
            ];

            foreach ($imageFields as $property => $dbField) {
                if ($this->$property) {
                    $oldPath = $this->isEditing ? $item->$dbField : null;
                    
                    // Direct Trait call -> It manages old image deletion, generation & Linux permissions
                    $uploadedPath = $this->uploadFile($this->$property, 'company', $oldPath);
                    if ($uploadedPath) {
                        $data[$dbField] = $uploadedPath;
                    }
                }
            }

            // 2. CEO image upload handle
            if ($this->ceo_image) {
                $oldCeoPath = $this->isEditing ? $item->ceo_image : null;
                $uploadedCeoPath = $this->uploadFile($this->ceo_image, 'company/ceo', $oldCeoPath);
                if ($uploadedCeoPath) {
                    $data['ceo_image'] = $uploadedCeoPath;
                }
            }
            // ------------------------------------------------------------------

            if ($this->isEditing) {
                $item->update($data);
                $message = 'Company updated successfully.';
            } else {
                $item->fill($data)->save();
                $message = 'Company created successfully.';
            }

            $this->loadCategories();
            $this->resetForm();
            $this->showForm = false;
            $this->saveSuccess = true;

            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);

        } catch (\Exception $e) {
            Log::error('OurCompany save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: 'Failed to save: ' . $e->getMessage());
        }

        $this->isSaving = false;
    }

    public function confirmDelete($id)
    {
        $item = OurCompany::find($id);
        if ($item) {
            $this->deleteItemId = $id;
            $this->deleteItemTitle = $item->oc_title;
            $this->showDeleteModal = true;
        }
    }

    public function delete()
    {
        try {
            $item = OurCompany::find($this->deleteItemId);
            if ($item) {
                // Trait functions used for clean files removal
                for ($i = 1; $i <= 4; $i++) {
                    $field = "oc_image{$i}";
                    if ($item->$field) {
                        $this->deleteFile($item->$field);
                    }
                }
                
                if ($item->ceo_image) {
                    $this->deleteFile($item->ceo_image);
                }
                
                $item->delete();
                $this->dispatch('toast', type: 'success', title: 'Deleted!', message: 'Company deleted successfully.');
            }

            $this->showDeleteModal = false;
            $this->deleteItemId = null;
            $this->deleteItemTitle = '';

        } catch (\Exception $e) {
            Log::error('OurCompany delete error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: 'Failed to delete.');
        }
    }

    public function toggleStatus($id)
    {
        $item = OurCompany::find($id);
        if ($item) {
            $item->update(['is_active' => !$item->is_active]);
            $this->dispatch('toast', type: 'success', title: 'Updated!', message: 'Status updated.');
        }
    }

    public function removeImage($itemId, $imageNumber)
    {
        $item = OurCompany::find($itemId);
        if ($item) {
            $field = "oc_image{$imageNumber}";
            if ($item->$field) {
                $this->deleteFile($item->$field);
                $item->update([$field => null]);
            }
            $previewField = "image{$imageNumber}Preview";
            $this->$previewField = null;
            
            // Temp input state clear
            $tempProp = "oc_image{$imageNumber}";
            $this->$tempProp = null;

            $this->dispatch('toast', type: 'success', title: 'Removed!', message: "Image {$imageNumber} removed.");
        }
    }

    public function removeCeoImage($itemId)
    {
        $item = OurCompany::find($itemId);
        if ($item && $item->ceo_image) {
            $this->deleteFile($item->ceo_image);
            $item->update(['ceo_image' => null]);
            $this->ceoImagePreview = null;
            $this->ceo_image = null;
            $this->dispatch('toast', type: 'success', title: 'Removed!', message: 'CEO image removed.');
        }
    }

    // ============================================
    // BULK OPERATIONS
    // ============================================
    public function bulkDelete()
    {
        if (empty($this->selectedItems)) {
            $this->dispatch('toast', type: 'warning', title: 'Warning!', message: 'No items selected.');
            return;
        }

        $items = OurCompany::whereIn('id', $this->selectedItems)->get();
        foreach ($items as $item) {
            for ($i = 1; $i <= 4; $i++) {
                $field = "oc_image{$i}";
                if ($item->$field) {
                    $this->deleteFile($item->$field);
                }
            }
            if ($item->ceo_image) {
                $this->deleteFile($item->ceo_image);
            }
            $item->delete();
        }
        
        $this->selectedItems = [];
        $this->selectAll = false;
        $this->dispatch('toast', type: 'success', title: 'Deleted!', message: count($items) . ' companies deleted.');
    }

    // ============================================
    // RESET
    // ============================================
    public function resetForm()
    {
        $this->itemId = null;
        $this->oc_title = '';
        $this->oc_description = '';
        $this->our_company_category = '';
        $this->established_year = '';
        $this->company_type = '';
        $this->is_active = true;
        $this->sort_order = 0;
        $this->ceo_name = '';
        $this->ceo_message = '';
        $this->oc_image1 = null;
        $this->oc_image2 = null;
        $this->oc_image3 = null;
        $this->oc_image4 = null;
        $this->ceo_image = null;
        $this->image1Preview = null;
        $this->image2Preview = null;
        $this->image3Preview = null;
        $this->image4Preview = null;
        $this->ceoImagePreview = null;
        $this->resetValidation();
    }

    // ============================================
    // CKEDITOR HANDLER
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
    // COMPUTED
    // ============================================
    #[Computed]
    public function totalCompanies(): int
    {
        return OurCompany::count();
    }

    #[Computed]
    public function activeCompanies(): int
    {
        return OurCompany::where('is_active', true)->count();
    }

    // ============================================
    // RENDER
    // ============================================
    public function render()
    {
        $query = OurCompany::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('oc_title', 'like', '%' . $this->search . '%')
                  ->orWhere('oc_description', 'like', '%' . $this->search . '%')
                  ->orWhere('ceo_name', 'like', '%' . $this->search . '%')
                  ->orWhere('our_company_category', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterCategory) {
            $query->where('our_company_category', $this->filterCategory);
        }

        if ($this->filterStatus !== '') {
            $query->where('is_active', $this->filterStatus === 'active');
        }

        $query->orderBy($this->sortField, $this->sortDirection);
        $items = $query->paginate($this->perPage);

        return view('livewire.admin.our-company.our-company-manager', [
            'items' => $items,
        ]);
    }
}