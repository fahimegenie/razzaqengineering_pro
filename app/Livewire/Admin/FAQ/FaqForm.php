<?php

namespace App\Livewire\Admin\FAQ;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Faq;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('FAQ Form - Admin Panel')]
class FaqForm extends Component
{
    public $faqId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    #[Validate('required|string|max:500')]
    public $faq_question = '';
    
    #[Validate('required|string')]
    public $faq_answer = '';
    
    #[Validate('nullable|string|max:255')]
    public $faq_category = '';
    
    #[Validate('nullable|integer|min:0')]
    public $sort_order = 0;
    
    #[Validate('boolean')]
    public $is_active = true;

    public function mount($faq = null)
    {
        // FIX: Handle both cases - when $faq is a Model instance OR a string ID
        if ($faq) {
            // If $faq is string (route parameter), fetch from database
            if (is_string($faq) || is_numeric($faq)) {
                $faq = Faq::find($faq);
            }
            
            // Now $faq should be a Model instance
            if ($faq && $faq instanceof Faq) {
                $this->faqId = $faq->id; // Use correct primary key
                $this->isEditing = true;
                $this->faq_question = $faq->faq_question;
                $this->faq_answer = $faq->faq_answer;
                $this->faq_category = $faq->faq_category;
                $this->sort_order = $faq->sort_order ?? 0;
                $this->is_active = $faq->is_active ?? true;
            }
        }
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
                $event = 'faq-updated';
            } else {
                Faq::create($data);
                $message = 'FAQ created successfully.';
                $event = 'faq-created';
                // Reset form after create
                $this->reset(['faq_question', 'faq_answer', 'faq_category', 'sort_order']);
            }
            
            $this->isSaving = false;
            
            $this->dispatch('toast', type: 'success', message: $message);
            $this->dispatch($event);
            
            return redirect()->route('admin.faq.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            $this->dispatch('toast', type: 'error', message: 'Failed to save FAQ: ' . $e->getMessage());
            Log::error('FAQ save error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.faq.faq-form');
    }
}