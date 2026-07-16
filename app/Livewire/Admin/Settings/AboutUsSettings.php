<?php
// app/Livewire/Admin/Settings/AboutUsSettings.php

namespace App\Livewire\Admin\Settings;

use App\Models\AboutUs;
use App\Traits\HandlesUploads; // Custom upload system trait
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('About Us Settings - Admin Panel')]
class AboutUsSettings extends Component
{
    use HandlesUploads;

    // ============================================
    // ACTIVE TAB & LOADING STATES
    // ============================================
    public $activeTab = 'basic-info';
    public $isLoading = false;
    public $isSaving = false;
    public $saveSuccess = false;
    public $errorMessage = '';
    
    // ============================================
    // BASIC INFO
    // ============================================
    #[Rule('required|string|max:255')]
    public $about_title = '';
    
    #[Rule('nullable|string|max:255')]
    public $about_subtitle = '';
    
    #[Rule('nullable|string')]
    public $about_short_description = '';
    
    #[Rule('nullable|string')]
    public $about_description_1 = '';
    
    #[Rule('nullable|string')]
    public $about_description_2 = '';
    
    #[Rule('nullable|string')]
    public $our_story = '';
    
    #[Rule('nullable|string')]
    public $about_video_url = '';
    
    #[Rule('boolean')]
    public $is_active = true;
    
    // ============================================
    // MISSION, VISION, VALUES
    // ============================================
    #[Rule('nullable|string|max:255')]
    public $mission_title = '';
    
    #[Rule('nullable|string')]
    public $mission_description = '';
    
    #[Rule('nullable|string|max:255')]
    public $vision_title = '';
    
    #[Rule('nullable|string')]
    public $vision_description = '';
    
    #[Rule('nullable|string|max:255')]
    public $values_title = '';
    
    #[Rule('nullable|string')]
    public $values_description = '';
    
    // ============================================
    // WHY CHOOSE US
    // ============================================
    #[Rule('nullable|string')]
    public $why_choose_us = '';
    
    #[Rule('nullable|array')]
    public $key_points = [];
    
    public $newKeyPointIcon = 'fa-check-circle';
    public $newKeyPointTitle = '';
    public $newKeyPointDesc = '';
    
    // ============================================
    // STATISTICS
    // ============================================
    #[Rule('nullable|integer|min:0')]
    public $years_experience = 0;
    
    #[Rule('nullable|integer|min:0')]
    public $projects_completed = 0;
    
    #[Rule('nullable|integer|min:0')]
    public $happy_clients = 0;
    
    #[Rule('nullable|array')]
    public $statistics = [];
    
    public $newStatLabel = '';
    public $newStatValue = '';
    public $newStatIcon = 'fa-star';
    
    // ============================================
    // IMAGES & PREVIEWS
    // ============================================
    #[Rule('nullable|image|max:5120')]
    public $a_image;
    public $aImagePreview = null;
    
    #[Rule('nullable|image|max:5120')]
    public $about_banner;
    public $aboutBannerPreview = null;
    
    #[Rule('nullable|image|max:5120')]
    public $og_image;
    public $ogImagePreview = null;
    
    #[Rule('nullable|array')]
    public $about_gallery = [];
    
    #[Rule('nullable|array')]
    public $galleryImages = [];
    public $galleryPreviews = [];
    
    // ============================================
    // CERTIFICATIONS & AWARDS
    // ============================================
    #[Rule('nullable|array')]
    public $certifications = [];
    
    #[Rule('nullable|array')]
    public $awards = [];
    
    public $newCertification = '';
    public $newAward = '';
    
    // ============================================
    // CEO INFO
    // ============================================
    #[Rule('nullable|string|max:255')]
    public $ceo_name = '';
    
    #[Rule('nullable|string|max:255')]
    public $ceo_designation = '';
    
    #[Rule('nullable|string')]
    public $ceo_message = '';
    
    #[Rule('nullable|image|max:5120')]
    public $ceo_image;
    public $ceoImagePreview = null;
    
    // ============================================
    // SEO
    // ============================================
    #[Rule('nullable|string|max:255')]
    public $meta_title = '';
    
    #[Rule('nullable|string')]
    public $meta_description = '';
    
    #[Rule('nullable|string')]
    public $meta_keywords = '';
    
    #[Rule('nullable|string|max:50')]
    public $meta_robots = 'index, follow';
    
    #[Rule('nullable|string|max:255')]
    public $canonical_url = '';
    
    #[Rule('nullable|string')]
    public $schema_markup = '';
    
    // ============================================
    // LIFECYCLE HOOKS
    // ============================================
    public function mount()
    {
        $this->loadAboutData();
    }

    // ============================================
    // CKEDITOR LISTENER
    // ============================================
    #[On('ckeditor-value-updated')]
    public function handleCkEditorUpdate($value, $field)
    {
        $allowedFields = [
            'about_description_1', 'about_description_2', 'our_story',
            'mission_description', 'vision_description', 'values_description',
            'why_choose_us', 'ceo_message'
        ];

        if (in_array($field, $allowedFields) && property_exists($this, $field)) {
            $this->{$field} = $value;
        }
    }
    
    private function loadAboutData()
    {
        try {
            $this->isLoading = true;
            $aboutUs = AboutUs::first();
            
            if ($aboutUs) {
                // Basic Info
                $this->about_title = $aboutUs->about_title;
                $this->about_subtitle = $aboutUs->about_subtitle;
                $this->about_short_description = $aboutUs->about_short_description;
                $this->about_description_1 = $aboutUs->about_description_1;
                $this->about_description_2 = $aboutUs->about_description_2;
                $this->our_story = $aboutUs->our_story;
                $this->about_video_url = $aboutUs->about_video_url;
                $this->is_active = (bool) $aboutUs->is_active;
                
                // Mission, Vision, Values
                $this->mission_title = $aboutUs->mission_title;
                $this->mission_description = $aboutUs->mission_description;
                $this->vision_title = $aboutUs->vision_title;
                $this->vision_description = $aboutUs->vision_description;
                $this->values_title = $aboutUs->values_title;
                $this->values_description = $aboutUs->values_description;
                
                // Why Choose Us
                $this->why_choose_us = $aboutUs->why_choose_us;
                $this->key_points = $aboutUs->key_points ?? [];
                
                // Statistics
                $this->years_experience = $aboutUs->years_experience ?? 0;
                $this->projects_completed = $aboutUs->projects_completed ?? 0;
                $this->happy_clients = $aboutUs->happy_clients ?? 0;
                $this->statistics = $aboutUs->statistics ?? [];
                
                // Certifications & Awards
                $this->certifications = $aboutUs->certifications ?? [];
                $this->awards = $aboutUs->awards ?? [];
                
                // CEO Info
                $this->ceo_name = $aboutUs->ceo_name;
                $this->ceo_designation = $aboutUs->ceo_designation;
                $this->ceo_message = $aboutUs->ceo_message;
                
                // Images & Previews
                $this->aImagePreview = $aboutUs->image_url;
                $this->aboutBannerPreview = $aboutUs->banner_url;
                $this->ogImagePreview = $aboutUs->og_image_url;
                $this->ceoImagePreview = $aboutUs->ceo_image_url;
                $this->about_gallery = $aboutUs->about_gallery ?? [];
                
                // SEO
                $this->meta_title = $aboutUs->meta_title;
                $this->meta_description = $aboutUs->meta_description;
                $this->meta_keywords = $aboutUs->meta_keywords;
                $this->meta_robots = $aboutUs->meta_robots;
                $this->canonical_url = $aboutUs->canonical_url;
                $this->schema_markup = $aboutUs->schema_markup;
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load about us data.';
            Log::error('About Us load error: ' . $e->getMessage());
        } finally {
            $this->isLoading = false;
        }
    }
    
    // ============================================
    // TRAIT-BASED TEMPORARY PREVIEW GENERATION
    // ============================================
    public function updatedAImage()
    {
        $this->validateOnly('a_image');
        $this->aImagePreview = $this->getTemporaryUrl($this->a_image);
    }
    
    public function updatedAboutBanner()
    {
        $this->validateOnly('about_banner');
        $this->aboutBannerPreview = $this->getTemporaryUrl($this->about_banner);
    }
    
    public function updatedCeoImage()
    {
        $this->validateOnly('ceo_image');
        $this->ceoImagePreview = $this->getTemporaryUrl($this->ceo_image);
    }
    
    public function updatedOgImage()
    {
        $this->validateOnly('og_image');
        $this->ogImagePreview = $this->getTemporaryUrl($this->og_image);
    }
    
    public function updatedGalleryImages()
    {
        $this->validateOnly('galleryImages');
        $this->galleryPreviews = [];
        
        foreach ($this->galleryImages as $image) {
            if ($tempUrl = $this->getTemporaryUrl($image)) {
                $this->galleryPreviews[] = $tempUrl;
            }
        }
    }

    private function getTemporaryUrl($file)
    {
        try {
            return $file ? $file->temporaryUrl() : null;
        } catch (\Exception $e) {
            return null;
        }
    }
    
    // ============================================
    // TAB SWITCHING
    // ============================================
    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetValidation();
    }
    
    // ============================================
    // KEY POINTS MANAGEMENT
    // ============================================
    public function addKeyPoint()
    {
        $title = trim($this->newKeyPointTitle);
        $desc = trim($this->newKeyPointDesc);
        
        if (!empty($title)) {
            $this->key_points[] = [
                'icon' => $this->newKeyPointIcon ?: 'fa-check-circle',
                'title' => $title,
                'desc' => $desc,
            ];
            $this->newKeyPointIcon = 'fa-check-circle';
            $this->newKeyPointTitle = '';
            $this->newKeyPointDesc = '';
        }
    }
    
    public function removeKeyPoint($index)
    {
        unset($this->key_points[$index]);
        $this->key_points = array_values($this->key_points);
    }
    
    // ============================================
    // STATISTICS MANAGEMENT
    // ============================================
    public function addStatistic()
    {
        $label = trim($this->newStatLabel);
        $value = trim($this->newStatValue);
        
        if (!empty($label) && !empty($value)) {
            $this->statistics[] = [
                'label' => $label,
                'value' => $value,
                'icon' => $this->newStatIcon ?: 'fa-star',
            ];
            $this->newStatLabel = '';
            $this->newStatValue = '';
            $this->newStatIcon = 'fa-star';
        }
    }
    
    public function removeStatistic($index)
    {
        unset($this->statistics[$index]);
        $this->statistics = array_values($this->statistics);
    }
    
    // ============================================
    // CERTIFICATIONS & AWARDS
    // ============================================
    public function addCertification()
    {
        $cert = trim($this->newCertification);
        if (!empty($cert)) {
            $this->certifications[] = $cert;
            $this->newCertification = '';
        }
    }
    
    public function removeCertification($index)
    {
        unset($this->certifications[$index]);
        $this->certifications = array_values($this->certifications);
    }
    
    public function addAward()
    {
        $award = trim($this->newAward);
        if (!empty($award)) {
            $this->awards[] = $award;
            $this->newAward = '';
        }
    }
    
    public function removeAward($index)
    {
        unset($this->awards[$index]);
        $this->awards = array_values($this->awards);
    }
    
    // ============================================
    // TRAIT-BASED IMAGE REMOVAL
    // ============================================
    public function removeImage($type)
    {
        $aboutUs = AboutUs::first();
        if (!$aboutUs) return;
        
        $fields = [
            'main' => ['db' => 'a_image', 'preview' => 'aImagePreview'],
            'banner' => ['db' => 'about_banner', 'preview' => 'aboutBannerPreview'],
            'ceo' => ['db' => 'ceo_image', 'preview' => 'ceoImagePreview'],
            'og' => ['db' => 'og_image', 'preview' => 'ogImagePreview']
        ];

        if (isset($fields[$type])) {
            $dbField = $fields[$type]['db'];
            $previewField = $fields[$type]['preview'];

            if ($aboutUs->$dbField) {
                // Handled via HandlesUploads trait: uses $this->deleteFile instead of deleteUploadedFile
                $this->deleteFile($aboutUs->$dbField);
                
                $aboutUs->update([$dbField => null]);
                $this->$previewField = null;
            }
        }
        
        $this->dispatch('toast', type: 'success', title: 'Removed!', message: 'Image removed successfully.');
    }
    
    public function removeGalleryImage($index)
    {
        $aboutUs = AboutUs::first();
        if (!$aboutUs) return;

        if (isset($this->about_gallery[$index])) {
            // Handled via HandlesUploads trait: uses $this->deleteFile instead of deleteUploadedFile
            $this->deleteFile($this->about_gallery[$index]);
            
            unset($this->about_gallery[$index]);
            $this->about_gallery = array_values($this->about_gallery);

            // Database aur model ko direct update karein gallery sync ke liye
            $aboutUs->update(['about_gallery' => $this->about_gallery]);
        }
    }
    
    // ============================================
    // SAVE ALL SETTINGS & UPLOADS
    // ============================================
    public function save()
    {
        $this->validate([
            'about_title' => 'required|string|max:255',
        ]);
        
        $this->isSaving = true;
        
        try {
            $aboutUs = AboutUs::firstOrCreate(['id' => 1]);
            
            $data = [
                'about_title' => $this->about_title,
                'about_subtitle' => $this->about_subtitle,
                'about_short_description' => $this->about_short_description,
                'about_description_1' => $this->about_description_1,
                'about_description_2' => $this->about_description_2,
                'our_story' => $this->our_story,
                'about_video_url' => $this->about_video_url,
                'is_active' => (bool) $this->is_active,
                'mission_title' => $this->mission_title,
                'mission_description' => $this->mission_description,
                'vision_title' => $this->vision_title,
                'vision_description' => $this->vision_description,
                'values_title' => $this->values_title,
                'values_description' => $this->values_description,
                'why_choose_us' => $this->why_choose_us,
                'key_points' => array_values($this->key_points),
                'years_experience' => $this->years_experience,
                'projects_completed' => $this->projects_completed,
                'happy_clients' => $this->happy_clients,
                'statistics' => array_values($this->statistics),
                'certifications' => array_values($this->certifications),
                'awards' => array_values($this->awards),
                'ceo_name' => $this->ceo_name,
                'ceo_designation' => $this->ceo_designation,
                'ceo_message' => $this->ceo_message,
                'meta_title' => $this->meta_title,
                'meta_description' => $this->meta_description,
                'meta_keywords' => $this->meta_keywords,
                'meta_robots' => $this->meta_robots,
                'canonical_url' => $this->canonical_url,
                'schema_markup' => $this->schema_markup,
            ];
            
            // Trait-integrated file upload handles
            $imageFields = [
                'a_image' => 'a_image',
                'about_banner' => 'about_banner',
                'ceo_image' => 'ceo_image',
                'og_image' => 'og_image',
            ];
            
            foreach ($imageFields as $property => $dbField) {
                if ($this->$property) {
                    // Upload via Trait standard directory path handler
                    $data[$dbField] = $this->uploadFile(
                        file: $this->$property, 
                        directory: 'about', 
                        oldFilePath: $aboutUs->$dbField
                    );
                }
            }
            
            // Multiple Gallery uploads via HandlesUploads
            if ($this->galleryImages && count($this->galleryImages) > 0) {
                $gallery = $aboutUs->about_gallery ?? [];
                
                foreach ($this->galleryImages as $image) {
                    $galleryPath = $this->uploadFile(
                        file: $image, 
                        directory: 'about/gallery'
                    );

                    if ($galleryPath) {
                        $gallery[] = $galleryPath;
                    }
                }
                
                $data['about_gallery'] = array_values($gallery);
                $this->galleryImages = [];
                $this->galleryPreviews = [];
                
                // State update taake page refresh ke bina real-time changes nazar aayen
                $this->about_gallery = $data['about_gallery'];
            }
            
            $aboutUs->update($data);
            
            // Clear settings layer cache
            AboutUs::refreshCache();
            
            $this->saveSuccess = true;
            $this->dispatch('toast', 
                type: 'success', 
                title: 'Success!',
                message: 'About Us settings saved successfully.'
            );
            
        } catch (\Exception $e) {
            Log::error('About Us save error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            $this->dispatch('toast', 
                type: 'error', 
                title: 'Error!',
                message: 'Failed to save: ' . $e->getMessage()
            );
        } finally {
            $this->isSaving = false;
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
    // COMPUTED PROPERTIES
    // ============================================
    #[Computed]
    public function getTabsProperty(): array
    {
        return [
            'basic-info' => ['label' => 'Basic Info', 'icon' => 'bi-info-circle'],
            'mission-vision' => ['label' => 'Mission & Vision', 'icon' => 'bi-bullseye'],
            'why-choose-us' => ['label' => 'Why Choose Us', 'icon' => 'bi-hand-thumbs-up'],
            'statistics' => ['label' => 'Statistics', 'icon' => 'bi-graph-up'],
            'images' => ['label' => 'Images', 'icon' => 'bi-images'],
            'certifications' => ['label' => 'Certs & Awards', 'icon' => 'bi-award'],
            'ceo' => ['label' => 'CEO Message', 'icon' => 'bi-person-badge'],
            'seo' => ['label' => 'SEO', 'icon' => 'bi-search'],
        ];
    }
    
    // ============================================
    // RENDER
    // ============================================
    public function render()
    {
        return view('livewire.admin.settings.about-us-settings', [
            'tabs' => $this->tabs,
            'aboutUs' => AboutUs::first(),
        ]);
    }
}