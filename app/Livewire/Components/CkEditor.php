<?php

namespace App\Livewire\Components;

use Livewire\Component;

class CkEditor extends Component
{
    public $editorId;
    public $label = 'Content';
    public $placeholder = 'Write your content here...';
    public $height = '400px';
    public $toolbar = 'full';
    public $value = '';
    public $field = '';
    public $readOnly = false;

    public function mount(
        $label = 'Content',
        $placeholder = 'Write your content here...',
        $height = '400px',
        $toolbar = 'full',
        $value = '',
        $field = '',
        $readOnly = false
    ) {
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->height = $height;
        $this->toolbar = $toolbar;
        $this->value = $value;
        $this->field = $field;
        $this->readOnly = $readOnly;
        $this->editorId = 'ckeditor_' . uniqid();
    }

    public function updatedValue($newValue)
    {
        // Still dispatch for backward compatibility
        if ($this->field) {
            $this->dispatch('ckeditor-value-updated', value: $newValue, field: $this->field);
        }
    }

    /**
     * Called from Alpine.js via $wire.call()
     * This directly updates the parent component's property
     */
    public function updateField($data)
    {
        $field = $data['field'] ?? null;
        $value = $data['value'] ?? null;
        
        if ($field) {
            // Dispatch up to parent
            $this->dispatch('ckeditor-value-updated', value: $value, field: $field);
        }
    }

    public function render()
    {
        return view('livewire.components.ck-editor');
    }
}