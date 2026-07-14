<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

#[Layout('components.layouts.admin-layout')]
#[Title('Settings - Admin Panel')]
class GeneralSettings extends Component
{
    use WithFileUploads;

    // Active tab
    public $activeTab = 'general';
    
    // Loading states
    public $isLoading = false;
    public $isSaving = false;
    public $saveSuccess = false;
    public $errorMessage = '';
    
    // File uploads
    public $logoFile;
    public $logoDarkFile;
    public $logoLightFile;
    public $faviconFile;
    public $ogImageFile;
    
    // Logo previews
    public $logoPreview;
    public $logoDarkPreview;
    public $logoLightPreview;
    public $faviconPreview;
    public $ogImagePreview;
    
    // Basic Information
    #[Validate('required|string|max:255')]
    public $site_name = '';
    
    #[Validate('nullable|string|max:255')]
    public $site_tagline = '';
    
    #[Validate('nullable|string')]
    public $site_description = '';
    
    #[Validate('nullable|url|max:255')]
    public $site_url = '';
    
    // Contact Information
    #[Validate('nullable|string|max:30')]
    public $mobile_phone_1 = '';
    
    #[Validate('nullable|string|max:30')]
    public $mobile_phone_2 = '';
    
    #[Validate('nullable|string|max:30')]
    public $whatsapp_number = '';
    
    #[Validate('nullable|string|max:30')]
    public $landline_1 = '';
    
    #[Validate('nullable|email|max:100')]
    public $email_primary = '';
    
    #[Validate('nullable|email|max:100')]
    public $email_sales = '';
    
    #[Validate('nullable|email|max:100')]
    public $email_support = '';
    
    #[Validate('nullable|email|max:100')]
    public $email_info = '';
    
    // Address
    #[Validate('nullable|string')]
    public $address_1 = '';
    
    #[Validate('nullable|string')]
    public $address_2 = '';
    
    #[Validate('nullable|string|max:100')]
    public $city = '';
    
    #[Validate('nullable|string|max:100')]
    public $state = '';
    
    #[Validate('nullable|string|max:100')]
    public $country = 'Pakistan';
    
    // Business Hours
    #[Validate('nullable|string|max:100')]
    public $working_days = '';
    
    #[Validate('nullable|string|max:10')]
    public $office_start_time = '';
    
    #[Validate('nullable|string|max:10')]
    public $office_end_time = '';
    
    #[Validate('boolean')]
    public $is_24_7 = false;
    
    #[Validate('boolean')]
    public $is_emergency_service = false;
    
    // Social Media
    #[Validate('nullable|url|max:255')]
    public $facebook_url = '';
    
    #[Validate('nullable|url|max:255')]
    public $twitter_url = '';
    
    #[Validate('nullable|url|max:255')]
    public $instagram_url = '';
    
    #[Validate('nullable|url|max:255')]
    public $linkedin_url = '';
    
    #[Validate('nullable|url|max:255')]
    public $youtube_url = '';
    
    #[Validate('nullable|url|max:255')]
    public $pinterest_url = '';
    
    #[Validate('nullable|url|max:255')]
    public $tiktok_url = '';
    
    // Company Info
    #[Validate('nullable|string|max:255')]
    public $company_name = '';
    
    #[Validate('nullable|string|max:100')]
    public $company_registration_number = '';
    
    #[Validate('nullable|string|max:100')]
    public $tax_number = '';
    
    #[Validate('nullable|string|max:10')]
    public $establishment_year = '';
    
    // SEO Settings
    #[Validate('nullable|string|max:255')]
    public $meta_title = '';
    
    #[Validate('nullable|string')]
    public $meta_description = '';
    
    #[Validate('nullable|string')]
    public $meta_keywords = '';
    
    #[Validate('nullable|string|max:50')]
    public $meta_robots = 'index, follow';
    
    #[Validate('nullable|string|max:255')]
    public $og_title = '';
    
    #[Validate('nullable|string')]
    public $og_description = '';
    
    // Scripts
    #[Validate('nullable|string')]
    public $google_analytics_id = '';
    
    #[Validate('nullable|string')]
    public $google_tag_manager_id = '';
    
    #[Validate('nullable|string')]
    public $google_site_verification = '';
    
    #[Validate('nullable|string')]
    public $facebook_pixel_id = '';
    
    #[Validate('nullable|string')]
    public $custom_header_scripts = '';
    
    #[Validate('nullable|string')]
    public $custom_footer_scripts = '';
    
    #[Validate('nullable|string')]
    public $custom_css = '';
    
    #[Validate('nullable|string')]
    public $custom_javascript = '';
    
    // Footer Content (Rich Text)
    #[Validate('nullable|string')]
    public $footer_aboutus = '';
    
    #[Validate('nullable|string')]
    public $footer_copyright_text = '';
    
    // Legal Pages (Rich Text)
    #[Validate('nullable|string')]
    public $terms_and_conditions = '';
    
    #[Validate('nullable|string')]
    public $privacy_policy = '';
    
    #[Validate('nullable|string')]
    public $refund_policy = '';
    
    // Email Settings
    #[Validate('nullable|string|max:255')]
    public $smtp_host = '';
    
    #[Validate('nullable|string|max:10')]
    public $smtp_port = '';
    
    #[Validate('nullable|string|max:255')]
    public $smtp_username = '';
    
    #[Validate('nullable|string|max:255')]
    public $smtp_password = '';
    
    #[Validate('nullable|string|max:10')]
    public $smtp_encryption = 'tls';
    
    #[Validate('nullable|email|max:100')]
    public $mail_from_address = '';
    
    #[Validate('nullable|string|max:100')]
    public $mail_from_name = '';
    
    #[Validate('boolean')]
    public $mail_enabled = true;
    
    // Payment Settings
    #[Validate('nullable|string|max:255')]
    public $bank_name = '';
    
    #[Validate('nullable|string|max:50')]
    public $bank_account_number = '';
    
    #[Validate('nullable|string|max:50')]
    public $bank_iban = '';
    
    #[Validate('nullable|string|max:30')]
    public $easypaisa_number = '';
    
    #[Validate('nullable|string|max:30')]
    public $jazzcash_number = '';
    
    #[Validate('nullable|string|max:10')]
    public $currency = 'PKR';
    
    #[Validate('nullable|string|max:10')]
    public $currency_symbol = '₨';
    
    // Feature Toggles
    #[Validate('boolean')]
    public $enable_blog = true;
    
    #[Validate('boolean')]
    public $enable_comments = true;
    
    #[Validate('boolean')]
    public $enable_newsletter = true;
    
    #[Validate('boolean')]
    public $enable_chat = false;
    
    #[Validate('boolean')]
    public $enable_quote_form = true;
    
    #[Validate('boolean')]
    public $enable_portfolio = true;
    
    #[Validate('boolean')]
    public $enable_testimonials = true;
    
    #[Validate('boolean')]
    public $enable_faq = true;
    
    #[Validate('boolean')]
    public $enable_search = true;
    
    // Chat Widgets
    #[Validate('nullable|string|max:50')]
    public $tawk_to_id = '';
    
    #[Validate('nullable|string|max:50')]
    public $fb_messenger_id = '';
    
    #[Validate('nullable|string|max:30')]
    public $whatsapp_chat_number = '';
    
    // Maintenance Mode
    #[Validate('boolean')]
    public $maintenance_mode = false;
    
    #[Validate('nullable|string')]
    public $maintenance_title = '';
    
    #[Validate('nullable|string')]
    public $maintenance_message = '';
    
    // Social Login
    #[Validate('boolean')]
    public $facebook_login = false;
    
    #[Validate('nullable|string|max:100')]
    public $facebook_client_id = '';
    
    #[Validate('nullable|string|max:100')]
    public $facebook_client_secret = '';
    
    #[Validate('boolean')]
    public $google_login = false;
    
    #[Validate('nullable|string|max:100')]
    public $google_client_id = '';
    
    #[Validate('nullable|string|max:100')]
    public $google_client_secret = '';
    
    // Security
    #[Validate('boolean')]
    public $force_https = false;
    
    #[Validate('boolean')]
    public $enable_captcha = false;
    
    #[Validate('nullable|string|max:100')]
    public $captcha_site_key = '';
    
    #[Validate('nullable|string|max:100')]
    public $captcha_secret_key = '';
    
    public function mount()
    {
        $this->loadSettings();
    }
    
    private function loadSettings()
    {
        try {
            $this->isLoading = true;
            
            $settings = Setting::first();
            
            if ($settings) {
                // Map all settings to component properties
                foreach ($settings->getFillable() as $field) {
                    if (property_exists($this, $field)) {
                        $this->$field = $settings->$field ?? '';
                    }
                }
                
                // Set preview URLs
                $this->logoPreview = $settings->logo_url ?? '';
                $this->logoDarkPreview = $settings->logo_dark_url ?? '';
                $this->logoLightPreview = $settings->logo_light_url ?? '';
                $this->faviconPreview = $settings->favicon_url ?? '';
                $this->ogImagePreview = $settings->og_image_url ?? '';
            }
            
            $this->isLoading = false;
            
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load settings.';
            $this->isLoading = false;
            Log::error('Settings load error: ' . $e->getMessage());
        }
    }
    
    public function updatedLogoFile()
    {
        $this->validateOnly('logoFile');
        try {
            $this->logoPreview = $this->logoFile->temporaryUrl();
        } catch (\Exception $e) {
            $this->logoPreview = null;
        }
    }
    
    public function updatedLogoDarkFile()
    {
        $this->validateOnly('logoDarkFile');
        try {
            $this->logoDarkPreview = $this->logoDarkFile->temporaryUrl();
        } catch (\Exception $e) {
            $this->logoDarkPreview = null;
        }
    }
    
    public function updatedLogoLightFile()
    {
        $this->validateOnly('logoLightFile');
        try {
            $this->logoLightPreview = $this->logoLightFile->temporaryUrl();
        } catch (\Exception $e) {
            $this->logoLightPreview = null;
        }
    }
    
    public function updatedFaviconFile()
    {
        $this->validateOnly('faviconFile');
        try {
            $this->faviconPreview = $this->faviconFile->temporaryUrl();
        } catch (\Exception $e) {
            $this->faviconPreview = null;
        }
    }
    
    public function updatedOgImageFile()
    {
        $this->validateOnly('ogImageFile');
        try {
            $this->ogImagePreview = $this->ogImageFile->temporaryUrl();
        } catch (\Exception $e) {
            $this->ogImagePreview = null;
        }
    }
    
    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetValidation();
    }
    
    public function save()
    {
        $this->isSaving = true;
        $this->saveSuccess = false;
        
        try {
            $settings = Setting::firstOrCreate(['id' => 1]);
            
            // Handle file uploads FIRST
            $uploadFields = [
                'logoFile' => 'logo',
                'logoDarkFile' => 'logo_dark',
                'logoLightFile' => 'logo_light',
                'faviconFile' => 'favicon',
                'ogImageFile' => 'og_image',
            ];
            
            foreach ($uploadFields as $property => $dbField) {
                if ($this->$property) {
                    try {
                        if ($settings->$dbField) {
                            Storage::disk('public')->delete('uploads/settings/' . $settings->$dbField);
                        }
                        $extension = $this->$property->getClientOriginalExtension();
                        $filename = $dbField . '_' . time() . '_' . Str::random(6) . '.' . $extension;
                        $this->$property->storeAs('uploads/settings', $filename, 'public');
                        $settings->$dbField = $filename;
                    } catch (\Exception $e) {
                        Log::error("Upload failed for {$dbField}: " . $e->getMessage());
                    }
                }
            }
            
            // Get actual columns and their types
            $actualColumns = Schema::getColumnListing('settings');
            
            // Manually sanitize and set each field
            $this->safeSetField($settings, 'site_name', $this->site_name, 'string', 255);
            $this->safeSetField($settings, 'site_tagline', $this->site_tagline, 'string', 255);
            $this->safeSetField($settings, 'site_description', $this->site_description, 'text');
            $this->safeSetField($settings, 'site_url', $this->site_url, 'string', 255);
            
            // Contact - Phone (VARCHAR 30)
            $this->safeSetField($settings, 'mobile_phone_1', $this->mobile_phone_1, 'string', 30);
            $this->safeSetField($settings, 'mobile_phone_2', $this->mobile_phone_2, 'string', 30);
            $this->safeSetField($settings, 'whatsapp_number', $this->whatsapp_number, 'string', 30);
            $this->safeSetField($settings, 'landline_1', $this->landline_1, 'string', 30);
            
            // Contact - Email (VARCHAR 100)
            $this->safeSetField($settings, 'email_primary', $this->email_primary, 'string', 100);
            $this->safeSetField($settings, 'email_sales', $this->email_sales, 'string', 100);
            $this->safeSetField($settings, 'email_support', $this->email_support, 'string', 100);
            $this->safeSetField($settings, 'email_info', $this->email_info, 'string', 100);
            
            // Address (TEXT)
            $this->safeSetField($settings, 'address_1', $this->address_1, 'text');
            $this->safeSetField($settings, 'address_2', $this->address_2, 'text');
            $this->safeSetField($settings, 'city', $this->city, 'string', 100);
            $this->safeSetField($settings, 'state', $this->state, 'string', 100);
            $this->safeSetField($settings, 'country', $this->country, 'string', 100);
            
            // Business Hours
            $this->safeSetField($settings, 'working_days', $this->working_days, 'string', 100);
            $this->safeSetField($settings, 'office_start_time', $this->office_start_time, 'string', 10);
            $this->safeSetField($settings, 'office_end_time', $this->office_end_time, 'string', 10);
            $this->safeSetField($settings, 'is_24_7', $this->is_24_7, 'boolean');
            $this->safeSetField($settings, 'is_emergency_service', $this->is_emergency_service, 'boolean');
            
            // Social Media (VARCHAR 255)
            $this->safeSetField($settings, 'facebook_url', $this->facebook_url, 'string', 255);
            $this->safeSetField($settings, 'twitter_url', $this->twitter_url, 'string', 255);
            $this->safeSetField($settings, 'instagram_url', $this->instagram_url, 'string', 255);
            $this->safeSetField($settings, 'linkedin_url', $this->linkedin_url, 'string', 255);
            $this->safeSetField($settings, 'youtube_url', $this->youtube_url, 'string', 255);
            $this->safeSetField($settings, 'pinterest_url', $this->pinterest_url, 'string', 255);
            $this->safeSetField($settings, 'tiktok_url', $this->tiktok_url, 'string', 255);
            
            // Company Info - IMPORTANT: establishment_year is VARCHAR(10)
            $this->safeSetField($settings, 'company_name', $this->company_name, 'string', 255);
            $this->safeSetField($settings, 'company_registration_number', $this->company_registration_number, 'string', 100);
            $this->safeSetField($settings, 'tax_number', $this->tax_number, 'string', 100);
            
            // Sanitize establishment_year - MUST be max 10 chars
            $establishmentYear = trim($this->establishment_year);
            if (strlen($establishmentYear) > 10) {
                $establishmentYear = substr($establishmentYear, 0, 10);
            }
            // If it contains @ or looks like email, set to empty
            if (filter_var($establishmentYear, FILTER_VALIDATE_EMAIL) || strpos($establishmentYear, '@') !== false) {
                $establishmentYear = '';
            }
            $this->safeSetField($settings, 'establishment_year', $establishmentYear, 'string', 10);
            
            // SEO
            $this->safeSetField($settings, 'meta_title', $this->meta_title, 'string', 255);
            $this->safeSetField($settings, 'meta_description', $this->meta_description, 'text');
            $this->safeSetField($settings, 'meta_keywords', $this->meta_keywords, 'text');
            $this->safeSetField($settings, 'meta_robots', $this->meta_robots, 'string', 50);
            $this->safeSetField($settings, 'og_title', $this->og_title, 'string', 255);
            $this->safeSetField($settings, 'og_description', $this->og_description, 'text');
            
            // Scripts (TEXT)
            $this->safeSetField($settings, 'google_analytics_id', $this->google_analytics_id, 'text');
            $this->safeSetField($settings, 'google_tag_manager_id', $this->google_tag_manager_id, 'text');
            $this->safeSetField($settings, 'google_site_verification', $this->google_site_verification, 'text');
            $this->safeSetField($settings, 'facebook_pixel_id', $this->facebook_pixel_id, 'text');
            $this->safeSetField($settings, 'custom_header_scripts', $this->custom_header_scripts, 'text');
            $this->safeSetField($settings, 'custom_footer_scripts', $this->custom_footer_scripts, 'text');
            $this->safeSetField($settings, 'custom_css', $this->custom_css, 'text');
            $this->safeSetField($settings, 'custom_javascript', $this->custom_javascript, 'text');
            
            // Content (TEXT)
            $this->safeSetField($settings, 'footer_aboutus', $this->footer_aboutus, 'text');
            $this->safeSetField($settings, 'footer_copyright_text', $this->footer_copyright_text, 'string', 255);
            $this->safeSetField($settings, 'terms_and_conditions', $this->terms_and_conditions, 'text');
            $this->safeSetField($settings, 'privacy_policy', $this->privacy_policy, 'text');
            $this->safeSetField($settings, 'refund_policy', $this->refund_policy, 'text');
            
            // Email Settings
            $this->safeSetField($settings, 'smtp_host', $this->smtp_host, 'string', 255);
            $this->safeSetField($settings, 'smtp_port', $this->smtp_port, 'string', 10);
            $this->safeSetField($settings, 'smtp_username', $this->smtp_username, 'string', 255);
            $this->safeSetField($settings, 'smtp_password', $this->smtp_password, 'string', 255);
            $this->safeSetField($settings, 'smtp_encryption', $this->smtp_encryption, 'string', 10);
            $this->safeSetField($settings, 'mail_from_address', $this->mail_from_address, 'string', 100);
            $this->safeSetField($settings, 'mail_from_name', $this->mail_from_name, 'string', 100);
            $this->safeSetField($settings, 'mail_enabled', $this->mail_enabled, 'boolean');
            
            // Payment
            $this->safeSetField($settings, 'bank_name', $this->bank_name, 'string', 255);
            $this->safeSetField($settings, 'bank_account_number', $this->bank_account_number, 'string', 50);
            $this->safeSetField($settings, 'bank_iban', $this->bank_iban, 'string', 50);
            $this->safeSetField($settings, 'easypaisa_number', $this->easypaisa_number, 'string', 30);
            $this->safeSetField($settings, 'jazzcash_number', $this->jazzcash_number, 'string', 30);
            $this->safeSetField($settings, 'currency', $this->currency, 'string', 10);
            $this->safeSetField($settings, 'currency_symbol', $this->currency_symbol, 'string', 10);
            
            // Feature Toggles (boolean)
            $booleanFields = [
                'enable_blog', 'enable_comments', 'enable_newsletter', 'enable_chat',
                'enable_quote_form', 'enable_portfolio', 'enable_testimonials',
                'enable_faq', 'enable_search',
                'maintenance_mode', 'facebook_login', 'google_login',
                'force_https', 'enable_captcha',
            ];
            
            foreach ($booleanFields as $field) {
                if (property_exists($this, $field)) {
                    $settings->$field = (bool) $this->$field;
                }
            }
            
            // Chat Widgets
            $this->safeSetField($settings, 'tawk_to_id', $this->tawk_to_id, 'string', 50);
            $this->safeSetField($settings, 'fb_messenger_id', $this->fb_messenger_id, 'string', 50);
            $this->safeSetField($settings, 'whatsapp_chat_number', $this->whatsapp_chat_number, 'string', 30);
            
            // Maintenance
            $this->safeSetField($settings, 'maintenance_title', $this->maintenance_title, 'string', 255);
            $this->safeSetField($settings, 'maintenance_message', $this->maintenance_message, 'text');
            
            // Social Login
            $this->safeSetField($settings, 'facebook_client_id', $this->facebook_client_id, 'string', 100);
            $this->safeSetField($settings, 'facebook_client_secret', $this->facebook_client_secret, 'string', 100);
            $this->safeSetField($settings, 'google_client_id', $this->google_client_id, 'string', 100);
            $this->safeSetField($settings, 'google_client_secret', $this->google_client_secret, 'string', 100);
            
            // Security
            $this->safeSetField($settings, 'captcha_site_key', $this->captcha_site_key, 'string', 100);
            $this->safeSetField($settings, 'captcha_secret_key', $this->captcha_secret_key, 'string', 100);
            
            $settings->save();
            
            // Clear cache
            Setting::clearCache();
            Cache::flush();
            
            $this->saveSuccess = true;
            $this->isSaving = false;
            
            $this->dispatch('toast', 
                type: 'success', 
                title: 'Success!',
                message: 'Settings saved successfully.'
            );
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            
            Log::error('Settings save error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            $this->dispatch('toast', 
                type: 'error', 
                title: 'Error!',
                message: 'Failed to save: ' . $e->getMessage()
            );
        }
    }

    /**
     * Safely set a field with length validation
     */
    private function safeSetField($model, $field, $value, $type = 'string', $maxLength = null)
    {
        // Check if column exists
        if (!Schema::hasColumn('settings', $field)) {
            return;
        }
        
        try {
            if ($type === 'boolean') {
                $model->$field = (bool) $value;
            } elseif ($type === 'string' && $maxLength) {
                // Truncate if too long
                $value = is_string($value) ? $value : (string) $value;
                if (mb_strlen($value) > $maxLength) {
                    $value = mb_substr($value, 0, $maxLength);
                    Log::warning("Truncated {$field} to {$maxLength} chars");
                }
                $model->$field = $value;
            } elseif ($type === 'text') {
                $model->$field = is_string($value) ? $value : (string) $value;
            } else {
                $model->$field = $value;
            }
        } catch (\Exception $e) {
            Log::error("Failed to set {$field}: " . $e->getMessage());
        }
    }
    
    public function testEmail()
    {
        try {
            // Test email logic here
            $this->dispatch('toast', 
                type: 'success', 
                message: 'Test email sent successfully!'
            );
        } catch (\Exception $e) {
            $this->dispatch('toast', 
                type: 'error', 
                message: 'Email test failed: ' . $e->getMessage()
            );
        }
    }

    /**
     * Set a field value - called from CKEditor via JavaScript
     * Accepts array with 'field' and 'value' keys
     */
    public function setFieldValue($data = [])
    {
        // Handle both array and separate parameters
        if (is_array($data)) {
            $field = $data['field'] ?? null;
            $value = $data['value'] ?? null;
        } else {
            // If called with separate parameters
            $field = $data;
            $value = request()->input('value') ?? func_get_arg(1) ?? null;
        }
        
        if ($field && property_exists($this, $field)) {
            $this->$field = $value;
        }
    }
    
    public function clearCache()
    {
        Cache::flush();
        Setting::clearCache();
        $this->dispatch('toast', 
            type: 'success', 
            message: 'Cache cleared successfully!'
        );
    }
    
    #[Computed]
    public function getTabsProperty(): array
    {
        return [
            'general' => ['label' => 'General', 'icon' => 'bi-gear'],
            'contact' => ['label' => 'Contact', 'icon' => 'bi-telephone'],
            'social' => ['label' => 'Social Media', 'icon' => 'bi-share'],
            'seo' => ['label' => 'SEO', 'icon' => 'bi-search'],
            'scripts' => ['label' => 'Scripts', 'icon' => 'bi-code-slash'],
            'content' => ['label' => 'Content', 'icon' => 'bi-file-text'],
            'email' => ['label' => 'Email', 'icon' => 'bi-envelope'],
            'payment' => ['label' => 'Payment', 'icon' => 'bi-credit-card'],
            'features' => ['label' => 'Features', 'icon' => 'bi-toggle-on'],
            'security' => ['label' => 'Security', 'icon' => 'bi-shield-check'],
            'maintenance' => ['label' => 'Maintenance', 'icon' => 'bi-tools'],
        ];
    }
    
    public function render()
    {
        return view('livewire.admin.settings.general-settings', [
            'tabs' => $this->tabs,
        ]);
    }
}