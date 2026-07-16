<?php
// app/Livewire/Admin/FAQ/FaqForm.php

namespace App\Livewire\Admin\FAQ;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Rule;
use App\Models\Faq;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

#[Layout('components.layouts.admin-layout')]
#[Title('FAQ Form - Admin Panel')]
class FaqForm extends Component
{
    public $faqId = null;
    public $isEditing = false;
    public $isSaving = false;
    public $saveSuccess = false;
    
    #[Rule('required|string|max:500')]
    public $faq_question = '';
    
    #[Rule('required|string')]
    public $faq_answer = '';
    
    #[Rule('nullable|string|max:255')]
    public $faq_category = '';
    
    #[Rule('nullable|integer|min:0')]
    public $sort_order = 0;
    
    #[Rule('boolean')]
    public $is_active = true;
    
    // CKEditor value handler
    public $description = '';

    public function mount($faq = null)
    {
        if ($faq) {
            if (is_string($faq) || is_numeric($faq)) {
                $faq = Faq::find($faq);
            }
            
            if ($faq && $faq instanceof Faq) {
                $this->faqId = $faq->id;
                $this->isEditing = true;
                $this->faq_question = $faq->faq_question;
                $this->faq_answer = $faq->faq_answer;
                $this->description = $faq->faq_answer; // For CKEditor
                $this->faq_category = $faq->faq_category;
                $this->sort_order = $faq->sort_order ?? 0;
                $this->is_active = $faq->is_active ?? true;
            }
        }
    }

    // ============================================
    // CKEDITOR LISTENER - THIS IS THE KEY FIX
    // ============================================
    #[On('ckeditor-value-updated')]
    public function handleCkEditorUpdate($value, $field)
    {
        $fieldMap = [
            'faq_answer' => 'faq_answer',
        ];

        if (isset($fieldMap[$field]) && property_exists($this, $fieldMap[$field])) {
            $this->{$fieldMap[$field]} = $value;
        }
    }

    public function updatedDescription($value)
    {
        $this->faq_answer = $value;
    }

    public function save()
    {
        $this->validate();
        $this->isSaving = true;
        
        try {
            $data = [
                'faq_question' => $this->faq_question,
                'faq_answer' => $this->faq_answer,
                'faq_category' => $this->faq_category,
                'sort_order' => $this->sort_order,
                'is_active' => $this->is_active,
            ];
            
            if ($this->isEditing && $this->faqId) {
                $faq = Faq::findOrFail($this->faqId);
                $faq->update($data);
                $message = 'FAQ updated successfully.';
            } else {
                Faq::create($data);
                $message = 'FAQ created successfully.';
                $this->reset(['faq_question', 'faq_answer', 'description', 'faq_category', 'sort_order']);
            }
            
            $this->isSaving = false;
            $this->saveSuccess = true;
            
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            
            return redirect()->route('admin.faq.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            $this->dispatch('toast', type: 'error', title: 'Error!', message: 'Failed to save FAQ.');
            Log::error('FAQ save error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.faq.faq-form');
    }
}