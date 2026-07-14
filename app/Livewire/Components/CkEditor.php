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
    public $readOnly = false;

    public function mount(
        $label = 'Content',
        $placeholder = 'Write your content here...',
        $height = '400px',
        $toolbar = 'full',
        $value = '',
        $readOnly = false
    ) {
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->height = $height;
        $this->toolbar = $toolbar;
        $this->value = $value;
        $this->readOnly = $readOnly;
        $this->editorId = 'ckeditor_' . uniqid();
    }

    public function updatedValue($newValue)
    {
        $this->dispatch('ckeditor-value-updated', value: $newValue);
    }

    public function render()
    {
        return view('livewire.components.ck-editor');
    }
}