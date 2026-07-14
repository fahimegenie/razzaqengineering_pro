<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                
                // Basic Information
                $table->string('site_name')->nullable();
                $table->string('site_tagline')->nullable();
                $table->text('site_description')->nullable();
                $table->string('site_url')->nullable();
                
                // Logo & Media (file paths - keep as varchar)
                $table->string('logo')->nullable();
                $table->string('logo_dark')->nullable();
                $table->string('logo_light')->nullable();
                $table->string('favicon')->nullable();
                $table->string('og_image')->nullable();
                $table->string('loader_image')->nullable();
                $table->string('watermark_image')->nullable();
                
                // Contact (phone numbers - small varchar)
                $table->string('mobile_phone_1', 30)->nullable();
                $table->string('mobile_phone_2', 30)->nullable();
                $table->string('mobile_phone_3', 30)->nullable();
                $table->string('landline_1', 30)->nullable();
                $table->string('landline_2', 30)->nullable();
                $table->string('whatsapp_number', 30)->nullable();
                $table->string('whatsapp_number_2', 30)->nullable();
                $table->string('toll_free_number', 30)->nullable();
                $table->string('fax_number', 30)->nullable();
                $table->string('emergency_contact', 30)->nullable();
                
                // Emails (small varchar)
                $table->string('email_primary', 100)->nullable();
                $table->string('email_secondary', 100)->nullable();
                $table->string('email_sales', 100)->nullable();
                $table->string('email_support', 100)->nullable();
                $table->string('email_info', 100)->nullable();
                $table->string('email_hr', 100)->nullable();
                $table->string('email_billing', 100)->nullable();
                
                // Address (TEXT)
                $table->text('address_1')->nullable();
                $table->text('address_2')->nullable();
                $table->text('address_3')->nullable();
                $table->string('city', 100)->nullable();
                $table->string('state', 100)->nullable();
                $table->string('country', 100)->default('Pakistan');
                $table->string('postal_code', 20)->nullable();
                $table->string('latitude', 30)->nullable();
                $table->string('longitude', 30)->nullable();
                $table->text('google_map_embed')->nullable();
                $table->string('google_map_api_key')->nullable();
                
                // Business Hours (small varchar)
                $table->string('working_hours')->nullable();
                $table->string('working_days', 100)->nullable();
                $table->string('office_start_time', 10)->nullable();
                $table->string('office_end_time', 10)->nullable();
                $table->string('lunch_start_time', 10)->nullable();
                $table->string('lunch_end_time', 10)->nullable();
                $table->boolean('is_24_7')->default(false);
                $table->boolean('is_emergency_service')->default(false);
                $table->text('holidays')->nullable();
                
                // Social Media Links
                $table->string('facebook_url')->nullable();
                $table->string('facebook_app_id', 50)->nullable();
                $table->string('facebook_page_id', 50)->nullable();
                $table->string('twitter_url')->nullable();
                $table->string('twitter_handle', 100)->nullable();
                $table->string('instagram_url')->nullable();
                $table->string('instagram_handle', 100)->nullable();
                $table->string('linkedin_url')->nullable();
                $table->string('linkedin_company_id', 50)->nullable();
                $table->string('youtube_url')->nullable();
                $table->string('youtube_channel_id', 100)->nullable();
                $table->string('pinterest_url')->nullable();
                $table->string('tiktok_url')->nullable();
                $table->string('snapchat_url')->nullable();
                $table->string('telegram_url')->nullable();
                $table->string('discord_url')->nullable();
                $table->string('github_url')->nullable();
                
                // Business Information
                $table->string('company_name')->nullable();
                $table->string('company_registration_number', 100)->nullable();
                $table->string('tax_number', 100)->nullable();
                $table->string('vat_number', 100)->nullable();
                $table->string('business_type', 100)->nullable();
                $table->string('establishment_year', 10)->nullable();
                $table->string('number_of_employees', 20)->nullable();
                $table->text('service_areas')->nullable();
                $table->text('cities_served')->nullable();
                $table->text('services_list')->nullable();
                
                // Bank Details (small varchar)
                $table->string('bank_name')->nullable();
                $table->string('bank_account_number', 50)->nullable();
                $table->string('bank_iban', 50)->nullable();
                $table->string('bank_branch_code', 50)->nullable();
                $table->string('easypaisa_number', 30)->nullable();
                $table->string('jazzcash_number', 30)->nullable();
                
                // Payment (small)
                $table->boolean('accept_online_payment')->default(false);
                $table->boolean('accept_cash_on_delivery')->default(true);
                $table->boolean('accept_bank_transfer')->default(true);
                $table->text('payment_instructions')->nullable();
                $table->string('currency', 10)->default('PKR');
                $table->string('currency_symbol', 10)->default('₨');
                
                // SEO (ALL TEXT)
                $table->text('xml_script')->nullable();
                $table->text('google_analytics_id')->nullable();
                $table->text('google_tag_manager_id')->nullable();
                $table->text('google_site_verification')->nullable();
                $table->text('bing_site_verification')->nullable();
                $table->text('yandex_verification')->nullable();
                $table->text('baidu_verification')->nullable();
                $table->text('alexa_verification')->nullable();
                $table->text('pinterest_verification')->nullable();
                $table->text('facebook_pixel_id')->nullable();
                $table->text('custom_header_scripts')->nullable();
                $table->text('custom_footer_scripts')->nullable();
                $table->text('custom_css')->nullable();
                $table->text('custom_javascript')->nullable();
                
                // Meta Tags (TEXT for long ones)
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->text('meta_keywords')->nullable();
                $table->string('meta_author', 100)->nullable();
                $table->string('meta_robots', 50)->default('index, follow');
                $table->string('og_title')->nullable();
                $table->text('og_description')->nullable();
                $table->string('twitter_card', 50)->default('summary_large_image');
                
                // Content (ALL TEXT)
                $table->text('footer_aboutus')->nullable();
                $table->text('footer_description')->nullable();
                $table->string('footer_copyright_text')->nullable();
                $table->text('terms_and_conditions')->nullable();
                $table->text('privacy_policy')->nullable();
                $table->text('refund_policy')->nullable();
                $table->text('cookie_consent_text')->nullable();
                
                // Email Settings (small varchar)
                $table->string('smtp_host')->nullable();
                $table->string('smtp_port', 10)->nullable();
                $table->string('smtp_username')->nullable();
                $table->string('smtp_password')->nullable();
                $table->string('smtp_encryption', 10)->nullable();
                $table->string('mail_from_address', 100)->nullable();
                $table->string('mail_from_name', 100)->nullable();
                $table->string('mail_driver', 20)->default('smtp');
                $table->boolean('mail_enabled')->default(true);
                
                // SMS (small varchar)
                $table->string('sms_api_key')->nullable();
                $table->string('sms_api_secret')->nullable();
                $table->string('sms_sender_id', 20)->nullable();
                $table->string('sms_gateway_url')->nullable();
                $table->boolean('sms_enabled')->default(false);
                
                // WhatsApp (small varchar)
                $table->string('whatsapp_api_key')->nullable();
                $table->string('whatsapp_api_url')->nullable();
                $table->string('whatsapp_phone_id', 50)->nullable();
                $table->string('whatsapp_business_id', 50)->nullable();
                $table->boolean('whatsapp_enabled')->default(false);
                
                // Notifications (booleans + small varchar)
                $table->boolean('email_notifications')->default(true);
                $table->boolean('sms_notifications')->default(false);
                $table->boolean('whatsapp_notifications')->default(false);
                $table->boolean('push_notifications')->default(false);
                $table->boolean('admin_notifications')->default(true);
                $table->string('notification_email', 100)->nullable();
                
                // Maintenance
                $table->boolean('maintenance_mode')->default(false);
                $table->text('maintenance_message')->nullable();
                $table->string('maintenance_title')->nullable();
                $table->timestamp('maintenance_start')->nullable();
                $table->timestamp('maintenance_end')->nullable();
                $table->text('maintenance_allowed_ips')->nullable();
                
                // Features (booleans only - tiny)
                $table->boolean('enable_blog')->default(true);
                $table->boolean('enable_comments')->default(true);
                $table->boolean('enable_newsletter')->default(true);
                $table->boolean('enable_chat')->default(false);
                $table->boolean('enable_quote_form')->default(true);
                $table->boolean('enable_careers')->default(false);
                $table->boolean('enable_portfolio')->default(true);
                $table->boolean('enable_testimonials')->default(true);
                $table->boolean('enable_faq')->default(true);
                $table->boolean('enable_search')->default(true);
                $table->boolean('enable_sitemap')->default(true);
                
                // Chat IDs (short varchar)
                $table->string('tawk_to_id', 50)->nullable();
                $table->string('fb_messenger_id', 50)->nullable();
                $table->string('whatsapp_chat_number', 30)->nullable();
                $table->string('crisp_chat_id', 50)->nullable();
                $table->string('livechat_id', 50)->nullable();
                $table->string('zendesk_chat_id', 50)->nullable();
                $table->string('intercom_id', 50)->nullable();
                $table->string('drift_id', 50)->nullable();
                
                // Cookie Consent (short)
                $table->boolean('cookie_consent_enabled')->default(true);
                $table->string('cookie_consent_position', 20)->default('bottom');
                $table->string('cookie_consent_theme', 20)->default('light');
                $table->text('cookie_consent_message')->nullable();
                $table->string('cookie_consent_button_text', 50)->default('Accept');
                $table->string('cookie_consent_decline_text', 50)->default('Decline');
                
                // Social Login (small)
                $table->boolean('facebook_login')->default(false);
                $table->string('facebook_client_id', 100)->nullable();
                $table->string('facebook_client_secret', 100)->nullable();
                $table->boolean('google_login')->default(false);
                $table->string('google_client_id', 100)->nullable();
                $table->string('google_client_secret', 100)->nullable();
                $table->boolean('github_login')->default(false);
                $table->string('github_client_id', 100)->nullable();
                $table->string('github_client_secret', 100)->nullable();
                
                // Security
                $table->boolean('force_https')->default(false);
                $table->boolean('enable_captcha')->default(false);
                $table->string('captcha_site_key', 100)->nullable();
                $table->string('captcha_secret_key', 100)->nullable();
                $table->integer('max_login_attempts')->default(5);
                $table->integer('session_lifetime')->default(120);
                $table->boolean('enable_ip_blocking')->default(false);
                $table->text('blocked_ips')->nullable();
                $table->text('allowed_ips')->nullable();
                $table->boolean('enable_csrf')->default(true);
                $table->boolean('enable_xss')->default(true);
                
                // API
                $table->boolean('enable_api')->default(false);
                $table->integer('api_rate_limit')->default(60);
                $table->boolean('api_require_auth')->default(true);
                
                // Backup
                $table->boolean('auto_backup')->default(false);
                $table->string('backup_frequency', 20)->default('daily');
                $table->string('backup_time', 10)->nullable();
                $table->boolean('backup_database')->default(true);
                $table->boolean('backup_files')->default(true);
                $table->string('backup_retention_days', 10)->default('30');
                
                // Cache
                $table->boolean('enable_cache')->default(true);
                $table->integer('cache_lifetime')->default(60);
                $table->boolean('enable_cdn')->default(false);
                $table->string('cdn_url')->nullable();
                
                // Localization (short)
                $table->string('default_language', 10)->default('en');
                $table->string('default_timezone', 50)->default('Asia/Karachi');
                $table->string('default_date_format', 20)->default('Y-m-d');
                $table->string('default_time_format', 20)->default('H:i:s');
                $table->string('default_currency', 10)->default('PKR');
                $table->string('default_currency_symbol', 10)->default('₨');
                $table->string('number_format', 20)->default('1,000.00');
                
                // Status
                $table->boolean('status')->default(true);
                $table->boolean('is_verified')->default(false);
                $table->boolean('is_featured')->default(false);
                
                // Version
                $table->string('app_version', 20)->nullable();
                $table->timestamp('last_update_check')->nullable();
                $table->boolean('auto_update')->default(false);
                
                $table->timestamps();
            });
            
            DB::table('settings')->insert([
                'site_name' => 'Razzaq Engineering',
                'site_tagline' => 'Professional Concrete Cutting Services',
                'country' => 'Pakistan',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
        } else {
            // Table exists - FIRST convert existing long VARCHAR to TEXT
            $this->convertExistingToText();
            
            // THEN add any missing columns
            $this->addMissingColumns();
        }
    }

    /**
     * Convert existing VARCHAR columns to TEXT to free up row size
     */
    private function convertExistingToText(): void
    {
        // These columns should be TEXT, not VARCHAR
        $columnsToConvert = [
            'address_1', 'address_2', 'address_3',
            'google_map_embed',
            'xml_script',
            'google_analytics_id', 'google_tag_manager_id',
            'google_site_verification', 'bing_site_verification',
            'yandex_verification', 'baidu_verification',
            'alexa_verification', 'pinterest_verification',
            'facebook_pixel_id',
            'custom_header_scripts', 'custom_footer_scripts',
            'custom_css', 'custom_javascript',
            'meta_description', 'meta_keywords',
            'og_description',
            'footer_aboutus', 'footer_description',
            'terms_and_conditions', 'privacy_policy',
            'refund_policy', 'cookie_consent_text',
            'payment_instructions',
            'service_areas', 'cities_served', 'services_list',
            'holidays',
            'maintenance_message', 'maintenance_allowed_ips',
            'blocked_ips', 'allowed_ips',
            'site_description', 'og_description',
        ];

        foreach ($columnsToConvert as $column) {
            if (Schema::hasColumn('settings', $column)) {
                try {
                    // Use raw SQL to change column type
                    DB::statement("ALTER TABLE `settings` MODIFY `{$column}` TEXT NULL");
                    Log::info("Converted settings.{$column} to TEXT");
                } catch (\Exception $e) {
                    Log::warning("Failed to convert settings.{$column}: " . $e->getMessage());
                }
            }
        }

        // Also reduce VARCHAR lengths for existing columns
        $columnsToReduce = [
            'mobile_phone_1' => 30,
            'mobile_phone_2' => 30,
            'whatsapp_number' => 30,
            'currency' => 10,
            'currency_symbol' => 10,
            'default_language' => 10,
            'default_currency' => 10,
            'default_currency_symbol' => 10,
        ];

        foreach ($columnsToReduce as $column => $length) {
            if (Schema::hasColumn('settings', $column)) {
                try {
                    DB::statement("ALTER TABLE `settings` MODIFY `{$column}` VARCHAR({$length}) NULL");
                    Log::info("Reduced settings.{$column} to VARCHAR({$length})");
                } catch (\Exception $e) {
                    Log::warning("Failed to reduce settings.{$column}: " . $e->getMessage());
                }
            }
        }
    }

    /**
     * Add missing columns (only if they don't exist)
     */
    private function addMissingColumns(): void
    {
        // List of columns that are safe to add (TEXT types only)
        $safeColumns = [
            'site_description' => 'TEXT',
            'address_1' => 'TEXT',
            'address_2' => 'TEXT',
            'address_3' => 'TEXT',
            'google_map_embed' => 'TEXT',
            'xml_script' => 'TEXT',
            'google_analytics_id' => 'TEXT',
            'google_tag_manager_id' => 'TEXT',
            'google_site_verification' => 'TEXT',
            'bing_site_verification' => 'TEXT',
            'custom_header_scripts' => 'TEXT',
            'custom_footer_scripts' => 'TEXT',
            'custom_css' => 'TEXT',
            'custom_javascript' => 'TEXT',
            'meta_description' => 'TEXT',
            'meta_keywords' => 'TEXT',
            'og_description' => 'TEXT',
            'footer_aboutus' => 'TEXT',
            'footer_description' => 'TEXT',
            'terms_and_conditions' => 'TEXT',
            'privacy_policy' => 'TEXT',
            'refund_policy' => 'TEXT',
            'cookie_consent_text' => 'TEXT',
            'payment_instructions' => 'TEXT',
            'service_areas' => 'TEXT',
            'cities_served' => 'TEXT',
            'services_list' => 'TEXT',
            'holidays' => 'TEXT',
            'maintenance_message' => 'TEXT',
            'maintenance_allowed_ips' => 'TEXT',
            'blocked_ips' => 'TEXT',
            'allowed_ips' => 'TEXT',
        ];

        $existingColumns = Schema::getColumnListing('settings');

        foreach ($safeColumns as $column => $type) {
            if (!in_array($column, $existingColumns)) {
                try {
                    DB::statement("ALTER TABLE `settings` ADD `{$column}` {$type} NULL");
                    Log::info("Added settings.{$column} as {$type}");
                } catch (\Exception $e) {
                    Log::warning("Failed to add settings.{$column}: " . $e->getMessage());
                }
            }
        }

        // Add boolean columns safely
        $boolColumns = [
            'is_24_7', 'is_emergency_service',
            'accept_online_payment', 'accept_cash_on_delivery', 'accept_bank_transfer',
            'mail_enabled', 'sms_enabled', 'whatsapp_enabled',
            'email_notifications', 'sms_notifications', 'whatsapp_notifications',
            'push_notifications', 'admin_notifications',
            'maintenance_mode',
            'enable_blog', 'enable_comments', 'enable_newsletter', 'enable_chat',
            'enable_quote_form', 'enable_careers', 'enable_portfolio',
            'enable_testimonials', 'enable_faq', 'enable_search', 'enable_sitemap',
            'cookie_consent_enabled',
            'facebook_login', 'google_login', 'github_login',
            'force_https', 'enable_captcha', 'enable_ip_blocking',
            'enable_csrf', 'enable_xss',
            'enable_api', 'api_require_auth',
            'auto_backup', 'backup_database', 'backup_files',
            'enable_cache', 'enable_cdn',
            'is_verified', 'is_featured',
            'auto_update',
        ];

        foreach ($boolColumns as $column) {
            if (!in_array($column, $existingColumns)) {
                try {
                    DB::statement("ALTER TABLE `settings` ADD `{$column}` TINYINT(1) DEFAULT 0");
                    Log::info("Added settings.{$column} as boolean");
                } catch (\Exception $e) {
                    Log::warning("Failed to add settings.{$column}: " . $e->getMessage());
                }
            }
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Don't drop the table completely to preserve data
        // Instead, you can remove specific columns if needed
        if (Schema::hasTable('settings')) {
            $columnsToRemove = [
                // Add columns you want to remove here
                // Leave empty to preserve all data
            ];
            
            if (!empty($columnsToRemove)) {
                Schema::table('settings', function (Blueprint $table) use ($columnsToRemove) {
                    foreach ($columnsToRemove as $column) {
                        if (Schema::hasColumn('settings', $column)) {
                            $table->dropColumn($column);
                        }
                    }
                });
            }
        }
    }
};