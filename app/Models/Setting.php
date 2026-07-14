<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

#[Fillable([
    'site_name', 'site_tagline', 'site_description', 'site_url',
    'logo', 'logo_dark', 'logo_light', 'favicon', 'og_image', 'loader_image', 'watermark_image',
    'mobile_phone_1', 'mobile_phone_2', 'mobile_phone_3', 'landline_1', 'landline_2',
    'whatsapp_number', 'whatsapp_number_2', 'toll_free_number', 'fax_number', 'emergency_contact',
    'email_primary', 'email_secondary', 'email_sales', 'email_support', 'email_info', 'email_hr', 'email_billing',
    'address_1', 'address_2', 'address_3', 'city', 'state', 'country', 'postal_code',
    'latitude', 'longitude', 'google_map_embed', 'google_map_api_key',
    'working_hours', 'working_days', 'office_start_time', 'office_end_time',
    'lunch_start_time', 'lunch_end_time', 'is_24_7', 'is_emergency_service', 'holidays',
    'facebook_url', 'facebook_app_id', 'facebook_page_id', 'twitter_url', 'twitter_handle',
    'instagram_url', 'instagram_handle', 'linkedin_url', 'linkedin_company_id',
    'youtube_url', 'youtube_channel_id', 'pinterest_url', 'tiktok_url',
    'snapchat_url', 'telegram_url', 'discord_url', 'github_url',
    'company_name', 'company_registration_number', 'tax_number', 'vat_number',
    'business_type', 'establishment_year', 'number_of_employees', 'service_areas',
    'cities_served', 'services_list',
    'bank_name', 'bank_account_number', 'bank_iban', 'bank_branch_code',
    'easypaisa_number', 'jazzcash_number',
    'accept_online_payment', 'accept_cash_on_delivery', 'accept_bank_transfer',
    'payment_instructions', 'currency', 'currency_symbol',
    'xml_script', 'google_analytics_id', 'google_tag_manager_id',
    'google_site_verification', 'bing_site_verification', 'yandex_verification',
    'baidu_verification', 'alexa_verification', 'pinterest_verification',
    'facebook_pixel_id', 'custom_header_scripts', 'custom_footer_scripts',
    'custom_css', 'custom_javascript',
    'meta_title', 'meta_description', 'meta_keywords', 'meta_author',
    'meta_robots', 'og_title', 'og_description', 'twitter_card',
    'footer_aboutus', 'footer_description', 'footer_copyright_text',
    'terms_and_conditions', 'privacy_policy', 'refund_policy', 'cookie_consent_text',
    'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password', 'smtp_encryption',
    'mail_from_address', 'mail_from_name', 'mail_driver', 'mail_enabled',
    'sms_api_key', 'sms_api_secret', 'sms_sender_id', 'sms_gateway_url', 'sms_enabled',
    'whatsapp_api_key', 'whatsapp_api_url', 'whatsapp_phone_id', 'whatsapp_business_id', 'whatsapp_enabled',
    'email_notifications', 'sms_notifications', 'whatsapp_notifications',
    'push_notifications', 'admin_notifications', 'notification_email',
    'maintenance_mode', 'maintenance_message', 'maintenance_title',
    'maintenance_start', 'maintenance_end', 'maintenance_allowed_ips',
    'enable_blog', 'enable_comments', 'enable_newsletter', 'enable_chat',
    'enable_quote_form', 'enable_careers', 'enable_portfolio',
    'enable_testimonials', 'enable_faq', 'enable_search', 'enable_sitemap',
    'tawk_to_id', 'fb_messenger_id', 'whatsapp_chat_number', 'crisp_chat_id',
    'livechat_id', 'zendesk_chat_id', 'intercom_id', 'drift_id',
    'cookie_consent_enabled', 'cookie_consent_position', 'cookie_consent_theme',
    'cookie_consent_message', 'cookie_consent_button_text', 'cookie_consent_decline_text',
    'facebook_login', 'facebook_client_id', 'facebook_client_secret',
    'google_login', 'google_client_id', 'google_client_secret',
    'github_login', 'github_client_id', 'github_client_secret',
    'force_https', 'enable_captcha', 'captcha_site_key', 'captcha_secret_key',
    'max_login_attempts', 'session_lifetime', 'enable_ip_blocking',
    'blocked_ips', 'allowed_ips', 'enable_csrf', 'enable_xss',
    'enable_api', 'api_rate_limit', 'api_require_auth',
    'auto_backup', 'backup_frequency', 'backup_time',
    'backup_database', 'backup_files', 'backup_retention_days',
    'enable_cache', 'cache_lifetime', 'enable_cdn', 'cdn_url',
    'default_language', 'default_timezone', 'default_date_format',
    'default_time_format', 'default_currency', 'default_currency_symbol', 'number_format',
    'status', 'is_verified', 'is_featured',
    'app_version', 'last_update_check', 'auto_update'
])]
class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'is_24_7' => 'boolean',
            'is_emergency_service' => 'boolean',
            'accept_online_payment' => 'boolean',
            'accept_cash_on_delivery' => 'boolean',
            'accept_bank_transfer' => 'boolean',
            'mail_enabled' => 'boolean',
            'sms_enabled' => 'boolean',
            'whatsapp_enabled' => 'boolean',
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
            'whatsapp_notifications' => 'boolean',
            'push_notifications' => 'boolean',
            'admin_notifications' => 'boolean',
            'maintenance_mode' => 'boolean',
            'enable_blog' => 'boolean',
            'enable_comments' => 'boolean',
            'enable_newsletter' => 'boolean',
            'enable_chat' => 'boolean',
            'enable_quote_form' => 'boolean',
            'enable_careers' => 'boolean',
            'enable_portfolio' => 'boolean',
            'enable_testimonials' => 'boolean',
            'enable_faq' => 'boolean',
            'enable_search' => 'boolean',
            'enable_sitemap' => 'boolean',
            'cookie_consent_enabled' => 'boolean',
            'facebook_login' => 'boolean',
            'google_login' => 'boolean',
            'github_login' => 'boolean',
            'force_https' => 'boolean',
            'enable_captcha' => 'boolean',
            'enable_ip_blocking' => 'boolean',
            'enable_csrf' => 'boolean',
            'enable_xss' => 'boolean',
            'enable_api' => 'boolean',
            'api_require_auth' => 'boolean',
            'auto_backup' => 'boolean',
            'backup_database' => 'boolean',
            'backup_files' => 'boolean',
            'enable_cache' => 'boolean',
            'enable_cdn' => 'boolean',
            'auto_update' => 'boolean',
            'is_verified' => 'boolean',
            'is_featured' => 'boolean',
            'max_login_attempts' => 'integer',
            'session_lifetime' => 'integer',
            'api_rate_limit' => 'integer',
            'cache_lifetime' => 'integer',
            'cities_served' => 'array',
            'services_list' => 'array',
            'maintenance_allowed_ips' => 'array',
            'maintenance_start' => 'datetime',
            'maintenance_end' => 'datetime',
            'last_update_check' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get cached settings instance
     */
    public static function getCached(): self
    {
        return static::query()->first() ?? new static();
    }

    /**
     * Clear settings cache
     */
    public static function clearCache(): void
    {
        Cache::forget('site_settings');
    }

    /**
     * Boot the model
     */
    protected static function booted(): void
    {
        static::saved(function () {
            static::clearCache();
        });
        
        static::deleted(function () {
            static::clearCache();
        });
    }

    // ============================================
    // Logo & Media URLs
    // ============================================
    public function getLogoUrlAttribute(): string
    {
        if ($this->logo && file_exists(public_path('uploads/settings/' . $this->logo))) {
            return asset('uploads/settings/' . $this->logo);
        }
        return asset('images/default-logo.png');
    }

    public function getLogoDarkUrlAttribute(): string
    {
        if ($this->logo_dark && file_exists(public_path('uploads/settings/' . $this->logo_dark))) {
            return asset('uploads/settings/' . $this->logo_dark);
        }
        return $this->logo_url;
    }

    public function getLogoLightUrlAttribute(): string
    {
        if ($this->logo_light && file_exists(public_path('uploads/settings/' . $this->logo_light))) {
            return asset('uploads/settings/' . $this->logo_light);
        }
        return $this->logo_url;
    }

    public function getFaviconUrlAttribute(): string
    {
        if ($this->favicon && file_exists(public_path('uploads/settings/' . $this->favicon))) {
            return asset('uploads/settings/' . $this->favicon);
        }
        return asset('favicon.ico');
    }

    public function getOgImageUrlAttribute(): string
    {
        if ($this->og_image && file_exists(public_path('uploads/settings/' . $this->og_image))) {
            return asset('uploads/settings/' . $this->og_image);
        }
        return $this->logo_url;
    }

    // ============================================
    // Contact Helpers
    // ============================================
    public function getPrimaryPhoneAttribute(): string
    {
        return $this->mobile_phone_1 ?? $this->whatsapp_number ?? '+92 300 1234567';
    }

    public function getSecondaryPhoneAttribute(): string
    {
        return $this->mobile_phone_2 ?? '';
    }

    public function getWhatsappLinkAttribute(): string
    {
        $number = $this->whatsapp_number ?? $this->mobile_phone_1;
        if (!$number) return '#';
        
        $number = preg_replace('/[^0-9]/', '', $number);
        return 'https://wa.me/' . $number;
    }

    public function getPrimaryEmailAttribute(): string
    {
        return $this->email_primary ?? $this->email_info ?? 'info@razzaqengineering.com';
    }

    public function getFullAddressAttribute(): string
    {
        $addresses = array_filter([$this->address_1, $this->address_2, $this->address_3]);
        $fullAddress = implode(', ', $addresses);
        
        if ($this->city) {
            $fullAddress .= ($fullAddress ? ', ' : '') . $this->city;
        }
        if ($this->country) {
            $fullAddress .= ($fullAddress ? ', ' : '') . $this->country;
        }
        
        return $fullAddress ?: 'Address not set';
    }

    public function getMapEmbedUrlAttribute(): string
    {
        return $this->google_map_embed ?? '';
    }

    // ============================================
    // Social Media Helpers
    // ============================================
    public function getSocialLinksAttribute(): array
    {
        return array_filter([
            'facebook' => $this->facebook_url,
            'twitter' => $this->twitter_url,
            'instagram' => $this->instagram_url,
            'linkedin' => $this->linkedin_url,
            'youtube' => $this->youtube_url,
            'pinterest' => $this->pinterest_url,
            'tiktok' => $this->tiktok_url,
            'telegram' => $this->telegram_url,
            'discord' => $this->discord_url,
            'github' => $this->github_url,
            'snapchat' => $this->snapchat_url,
        ]);
    }

    public function getHasSocialLinksAttribute(): bool
    {
        return !empty(array_filter($this->social_links));
    }

    // ============================================
    // Business Hours Helpers
    // ============================================
    public function getIsOpenNowAttribute(): bool
    {
        if ($this->is_24_7) return true;
        if ($this->is_emergency_service) return true;
        
        $now = now();
        $dayOfWeek = $now->dayOfWeek;
        $currentTime = $now->format('H:i');
        
        if ($this->working_days && $this->office_start_time && $this->office_end_time) {
            $workingDays = explode(',', $this->working_days);
            if (in_array($dayOfWeek, $workingDays)) {
                return $currentTime >= $this->office_start_time && $currentTime <= $this->office_end_time;
            }
        }
        
        return false;
    }

    public function getWorkingHoursFormattedAttribute(): string
    {
        if ($this->is_24_7) return '24/7 Service Available';
        if ($this->working_hours) return $this->working_hours;
        
        $hours = '';
        if ($this->working_days) $hours .= 'Days: ' . $this->working_days . ' | ';
        if ($this->office_start_time && $this->office_end_time) {
            $hours .= $this->office_start_time . ' - ' . $this->office_end_time;
        }
        
        return $hours ?: 'Contact for hours';
    }

    // ============================================
    // Feature Checkers
    // ============================================
    public function isFeatureEnabled(string $feature): bool
    {
        $field = 'enable_' . $feature;
        return $this->$field ?? false;
    }

    public function isBlogEnabled(): bool
    {
        return $this->enable_blog ?? true;
    }

    public function isChatEnabled(): bool
    {
        return $this->enable_chat ?? false;
    }

    public function isQuoteEnabled(): bool
    {
        return $this->enable_quote_form ?? true;
    }

    // ============================================
    // SEO Helpers
    // ============================================
    public function getMetaTitleAttribute($value): string
    {
        return $value ?? $this->site_name . ' - ' . ($this->site_tagline ?? 'Professional Services');
    }

    public function getMetaDescriptionAttribute($value): string
    {
        return $value ?? $this->site_description ?? Str::limit($this->footer_aboutus ?? '', 160);
    }

    public function getGoogleAnalyticsScriptAttribute(): string
    {
        if (!$this->google_analytics_id) return '';
        
        return "<script async src='https://www.googletagmanager.com/gtag/js?id={$this->google_analytics_id}'></script>";
    }

    public function getCustomHeaderScriptsAttribute($value): string
    {
        return $value ?? '';
    }

    public function getCustomFooterScriptsAttribute($value): string
    {
        return $value ?? '';
    }

    // ============================================
    // Payment Helpers
    // ============================================
    public function getCurrencySymbolFormattedAttribute(): string
    {
        return $this->currency_symbol ?? '₨';
    }

    public function getFormattedPriceAttribute($amount): string
    {
        return $this->currency_symbol_formatted . ' ' . number_format($amount, 2);
    }

    // ============================================
    // Maintenance Mode
    // ============================================
    public function isInMaintenanceMode(): bool
    {
        if (!$this->maintenance_mode) return false;
        
        // Check if maintenance period is set and within range
        if ($this->maintenance_start && $this->maintenance_end) {
            return now()->between($this->maintenance_start, $this->maintenance_end);
        }
        
        return true;
    }

    public function isIpAllowedInMaintenance(string $ip): bool
    {
        if (!$this->maintenance_allowed_ips) return false;
        
        $allowedIps = is_array($this->maintenance_allowed_ips) 
            ? $this->maintenance_allowed_ips 
            : explode(',', $this->maintenance_allowed_ips);
            
        return in_array($ip, $allowedIps);
    }

    // ============================================
    // Company Info
    // ============================================
    public function getCompanyAgeAttribute(): int
    {
        if (!$this->establishment_year) return 0;
        return (int) date('Y') - (int) $this->establishment_year;
    }

    public function getCopyrightTextAttribute(): string
    {
        $text = $this->footer_copyright_text ?? '© :year :company. All Rights Reserved.';
        $text = str_replace(':year', date('Y'), $text);
        $text = str_replace(':company', $this->company_name ?? $this->site_name, $text);
        return $text;
    }

    // ============================================
    // Cache Management
    // ============================================
    public static function get(string $key, $default = null)
    {
        $settings = static::getCached();
        return $settings->$key ?? $default;
    }

    public static function set(string $key, $value): void
    {
        $settings = static::first();
        if ($settings) {
            $settings->update([$key => $value]);
        }
    }
}