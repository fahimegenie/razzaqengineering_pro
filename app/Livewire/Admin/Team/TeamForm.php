<?php

namespace App\Livewire\Admin\Team;

use Livewire\Component;
use App\Traits\HandlesUploads; // Custom upload system trait
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\OurTeam;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Team Member Form - Admin Panel')]
class TeamForm extends Component
{
    // Sirf HandlesUploads use kiya hai kyunki iske andar WithFileUploads already mojood hai
    use HandlesUploads;

    public $teamId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    // Image
    public $ot_image;
    public $imagePreview;
    
    #[Validate('required|string|max:255')]
    public $ot_name = '';
    
    #[Validate('nullable|string|max:255')]
    public $ot_designation = '';
    
    #[Validate('nullable|string|max:20')]
    public $ot_phone = '';
    
    #[Validate('nullable|email|max:255')]
    public $ot_email = '';
    
    #[Validate('nullable|url|max:500')]
    public $ot_fb = '';
    
    #[Validate('nullable|email|max:255')]
    public $ot_gm = '';
    
    #[Validate('nullable|url|max:500')]
    public $ot_inst = '';
    
    #[Validate('nullable|url|max:500')]
    public $ot_twitter = '';
    
    #[Validate('nullable|url|max:500')]
    public $ot_linkedin = '';
    
    #[Validate('nullable|string')]
    public $ot_description = '';
    
    #[Validate('nullable|integer|min:0|max:50')]
    public $ot_experience = 0;
    
    #[Validate('nullable|string')]
    public $ot_skills_input = '';
    
    public $ot_skills = [];
    
    #[Validate('nullable|integer|min:0')]
    public $sort_order = 0;
    
    #[Validate('boolean')]
    public $is_active = true;

    public function mount($teamId = null)
    {
        if ($teamId) {
            $member = $teamId instanceof OurTeam ? $teamId : OurTeam::find($teamId);
            
            if ($member) {
                $this->teamId = $member->id;
                $this->isEditing = true;
                
                $fillable = [
                    'ot_name', 'ot_designation', 'ot_phone', 'ot_email',
                    'ot_fb', 'ot_gm', 'ot_inst', 'ot_twitter', 'ot_linkedin',
                    'ot_description', 'ot_experience', 'sort_order', 'is_active',
                ];
                
                foreach ($fillable as $field) {
                    if (isset($member->$field)) {
                        $this->$field = $member->$field;
                    }
                }
                
                // Load skills
                $this->ot_skills = $member->skills_list;
                $this->ot_skills_input = implode(', ', $this->ot_skills);
                
                // Load image preview
                $this->imagePreview = $member->image_url;
            }
        }
    }

    public function updatedOtImage()
    {
        $this->validateOnly('ot_image', ['ot_image' => 'image|max:2048']);
        try {
            $this->imagePreview = $this->ot_image->temporaryUrl();
        } catch (\Exception $e) {
            Log::error('Preview error: ' . $e->getMessage());
        }
    }

    public function updatedOtSkillsInput()
    {
        $this->ot_skills = array_filter(
            array_map('trim', explode(',', $this->ot_skills_input))
        );
    }

    public function addSkill()
    {
        if (!empty($this->ot_skills_input)) {
            $newSkill = trim($this->ot_skills_input);
            if (!in_array($newSkill, $this->ot_skills)) {
                $this->ot_skills[] = $newSkill;
            }
            $this->ot_skills_input = '';
        }
    }

    public function removeSkill($index)
    {
        unset($this->ot_skills[$index]);
        $this->ot_skills = array_values($this->ot_skills);
    }

    public function removeImage()
    {
        if ($this->teamId && $this->isEditing) {
            $member = OurTeam::find($this->teamId);
            if ($member && $member->ot_image) {
                // Securely delete file using trait
                $this->deleteFile($member->ot_image);
                $member->update(['ot_image' => null]);
            }
        }

        $this->ot_image = null;
        $this->imagePreview = null;
    }

    public function save()
    {
        $rules = [
            'ot_name' => 'required|string|max:255',
            'ot_email' => 'nullable|email|max:255',
            'ot_phone' => 'nullable|string|max:20',
        ];
        
        if (!$this->isEditing) {
            $rules['ot_image'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';
        } else {
            $rules['ot_image'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';
        }
        
        $this->validate($rules);
        $this->isSaving = true;
        
        try {
            $member = $this->isEditing ? OurTeam::findOrFail($this->teamId) : new OurTeam();
            
            // Text fields
            $textFields = [
                'ot_name', 'ot_designation', 'ot_phone', 'ot_email',
                'ot_fb', 'ot_gm', 'ot_inst', 'ot_twitter', 'ot_linkedin',
                'ot_description',
            ];
            
            foreach ($textFields as $field) {
                if (property_exists($this, $field)) {
                    $member->$field = $this->$field ?: null;
                }
            }
            
            $member->ot_experience = (int) ($this->ot_experience ?? 0);
            $member->sort_order = (int) ($this->sort_order ?? 0);
            $member->is_active = (bool) $this->is_active;
            $member->ot_skills = json_encode(array_values($this->ot_skills));
            
            // Handle Image Upload with Trait
            if ($this->ot_image) {
                $member->ot_image = $this->uploadFile(
                    file: $this->ot_image,
                    directory: 'team_images',
                    oldFilePath: $member->ot_image
                );
            }
            
            $member->save();
            $this->isSaving = false;
            
            $message = $this->isEditing ? 'Team member updated successfully!' : 'Team member created successfully!';
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            $this->dispatch($this->isEditing ? 'team-updated' : 'team-created');
            
            return redirect()->route('admin.team.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Team save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.team.team-form');
    }
}