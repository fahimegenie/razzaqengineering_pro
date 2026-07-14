<?php

namespace App\Livewire\Admin\Contact;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Contact Message Form - Admin Panel')]
class ContactMessageForm extends Component
{
    public $messageId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    #[Validate('required|string|max:255')]
    public $cm_name = '';
    
    #[Validate('required|email|max:255')]
    public $cm_email = '';
    
    #[Validate('nullable|string|max:20')]
    public $cm_phone = '';
    
    #[Validate('nullable|string|max:255')]
    public $cm_subject = '';
    
    #[Validate('required|string|min:10')]
    public $cm_message = '';
    
    #[Validate('nullable|string|max:255')]
    public $cm_company = '';
    
    #[Validate('nullable|string|max:255')]
    public $cm_city = '';
    
    #[Validate('nullable|exists:our_service,id')]
    public $service_id = null;
    
    #[Validate('required|string|in:website,phone,email,social,referral,other')]
    public $cm_source = 'website';
    
    #[Validate('required|string|in:low,medium,high,urgent')]
    public $cm_priority = 'medium';
    
    #[Validate('required|string|in:new,read,contacted,resolved,closed')]
    public $cm_status = 'new';
    
    #[Validate('nullable|string')]
    public $cm_notes = '';
    
    #[Validate('nullable|exists:users,id')]
    public $assigned_to = null;
    
    #[Validate('nullable|date')]
    public $follow_up_date = null;
    
    public $services = [];
    public $users = [];

    public function mount($messageId = null)
    {
        $this->services = Service::active()->orderBy('os_name')->get();
        $this->users = User::orderBy('name')->get();
        
        if ($messageId) {
            $message = ContactMessage::find($messageId);
            if ($message) {
                $this->messageId = $message->id;
                $this->isEditing = true;
                
                foreach (['cm_name','cm_email','cm_phone','cm_subject','cm_message','cm_company','cm_city','service_id','cm_source','cm_priority','cm_status','cm_notes','assigned_to'] as $f) {
                    if (isset($message->$f)) $this->$f = $message->$f;
                }
                
                if ($message->follow_up_date) {
                    $this->follow_up_date = $message->follow_up_date->format('Y-m-d\TH:i');
                }
            }
        }
    }

    public function save()
    {
        $this->validate();
        $this->isSaving = true;
        
        try {
            $message = $this->isEditing ? ContactMessage::findOrFail($this->messageId) : new ContactMessage();
            
            foreach (['cm_name','cm_email','cm_phone','cm_subject','cm_message','cm_company','cm_city','service_id','cm_source','cm_priority','cm_status','cm_notes','assigned_to','follow_up_date'] as $f) {
                if (property_exists($this, $f)) $message->$f = $this->$f ?: null;
            }
            
            if (!$this->isEditing) {
                $message->ip_address = request()->ip();
                $message->user_agent = request()->userAgent();
            }
            
            $message->save();
            $this->isSaving = false;
            
            $this->dispatch('toast', type: 'success', message: $this->isEditing ? 'Message updated!' : 'Message created!');
            return redirect()->route('admin.contacts.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Contact save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.contacts.contact-form');
    }
}