<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if settings already exist
        if (DB::table('settings')->count() > 0) {
            $this->command->info('Settings already exist. Skipping seeder.');
            return;
        }

        DB::table('settings')->insert([
            // ============================================
            // Basic Information
            // ============================================
            'site_name' => 'Razzaq Engineering Services',
            'site_tagline' => 'Professional Concrete Cutting & Engineering Solutions',
            'site_description' => 'Razzaq Engineering Services is Pakistan\'s leading provider of professional RCC Core Cutting, Diamond Drilling, Wall Saw Cutting, Plumbing & Fire Fighting Services.',
            'site_url' => 'https://razzaqengineering.com',
            
            // ============================================
            // Logo & Media
            // ============================================
            'logo' => null,
            'logo_dark' => null,
            'logo_light' => null,
            'favicon' => null,
            'og_image' => null,
            'loader_image' => null,
            'watermark_image' => null,
            
            // ============================================
            // Contact - Phone Numbers
            // ============================================
            'mobile_phone_1' => '0304-8902805',
            'mobile_phone_2' => '0301-5595228',
            'mobile_phone_3' => null,
            'landline_1' => null,
            'landline_2' => null,
            'whatsapp_number' => '0304-8902805',
            'whatsapp_number_2' => '0304-8902805',
            'toll_free_number' => null,
            'fax_number' => null,
            'emergency_contact' => '0304-8902805',
            
            // ============================================
            // Contact - Emails
            // ============================================
            'email_primary' => 'info@razzaqengineering.com',
            'email_secondary' => null,
            'email_sales' => 'sales@razzaqengineering.com',
            'email_support' => 'support@razzaqengineering.com',
            'email_info' => 'info@razzaqengineering.com',
            'email_hr' => 'hr@razzaqengineering.com',
            'email_billing' => 'billing@razzaqengineering.com',
            
            // ============================================
            // Address
            // ============================================
            'address_1' => 'Islamabad Office #02 LG Hassan Arcade 2 B Block Near Masjid Al Basheer Multi Garden B17 Islamabad',
            'address_2' => 'Lahore Office # Plot 04 Ali Raza Abad Haji Electronics Plaza Raiwind Road Lahore',
            'address_3' => 'Karachi Office #519 Gulzar E Hijri Khatam e Nabuwat Chowk Scheme 33 Karachi',
            'city' => 'Islamabad',
            'state' => 'Islamabad Capital Territory',
            'country' => 'Pakistan',
            'postal_code' => '44000',
            'latitude' => '33.6844',
            'longitude' => '73.0479',
            'google_map_embed' => null,
            'google_map_api_key' => null,
            
            // ============================================
            // Business Hours
            // ============================================
            'working_hours' => 'Monday - Saturday: 9:00 AM - 6:00 PM',
            'working_days' => 'Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'office_start_time' => '09:00',
            'office_end_time' => '18:00',
            'lunch_start_time' => '13:00',
            'lunch_end_time' => '14:00',
            'is_24_7' => false,
            'is_emergency_service' => true,
            'holidays' => null,
            
            // ============================================
            // Social Media Links
            // ============================================
            'facebook_url' => 'https://web.facebook.com/razzaqengineering/',
            'facebook_app_id' => null,
            'facebook_page_id' => null,
            'twitter_url' => null,
            'twitter_handle' => null,
            'instagram_url' => 'https://www.instagram.com/razzaq_engineering',
            'instagram_handle' => 'razzaq_engineering',
            'linkedin_url' => 'https://www.linkedin.com/in/razzaq-engineering-services-265b15401/',
            'linkedin_company_id' => null,
            'youtube_url' => null,
            'youtube_channel_id' => null,
            'pinterest_url' => null,
            'tiktok_url' => 'https://www.tiktok.com/@razzaq_engineering',
            'snapchat_url' => null,
            'telegram_url' => null,
            'discord_url' => null,
            'github_url' => null,
            
            // ============================================
            // Business Information
            // ============================================
            'company_name' => 'Razzaq Engineering Services',
            'company_registration_number' => null,
            'tax_number' => null,
            'vat_number' => null,
            'business_type' => 'Engineering Services',
            'establishment_year' => '2010',
            'number_of_employees' => '50+',
            'service_areas' => 'Lahore, Karachi, Islamabad, Rawalpindi, Peshawar, Multan, Faisalabad, Gujranwala, Sialkot',
            'cities_served' => 'Lahore, Karachi, Islamabad, Rawalpindi, Peshawar, Multan, Faisalabad, Gujranwala, Sialkot',
            'services_list' => 'RCC Core Cutting, Diamond Drilling, Wall Saw Cutting, Plumbing, Fire Fighting, Concrete Scanning, Demolition',
            
            // ============================================
            // Bank Details
            // ============================================
            'bank_name' => null,
            'bank_account_number' => null,
            'bank_iban' => null,
            'bank_branch_code' => null,
            'easypaisa_number' => null,
            'jazzcash_number' => null,
            
            // ============================================
            // Payment Settings
            // ============================================
            'accept_online_payment' => false,
            'accept_cash_on_delivery' => true,
            'accept_bank_transfer' => true,
            'payment_instructions' => null,
            'currency' => 'PKR',
            'currency_symbol' => '₨',
            
            // ============================================
            // SEO & Scripts
            // ============================================
            'xml_script' => null,
            'google_analytics_id' => 'UA-137344360-1',
            'google_tag_manager_id' => null,
            'google_site_verification' => null,
            'bing_site_verification' => null,
            'yandex_verification' => null,
            'baidu_verification' => null,
            'alexa_verification' => null,
            'pinterest_verification' => null,
            'facebook_pixel_id' => null,
            'custom_header_scripts' => null,
            'custom_footer_scripts' => null,
            'custom_css' => null,
            'custom_javascript' => null,
            
            // ============================================
            // Meta Tags
            // ============================================
            'meta_title' => 'Razzaq Engineering Services - RCC Core Cutting & Diamond Drilling Pakistan',
            'meta_description' => 'Professional RCC Core Cutting, Diamond Drilling, Wall Saw Cutting, Plumbing & Fire Fighting Services in Lahore, Karachi, Islamabad, Rawalpindi, Peshawar. 24/7 Emergency Services Available.',
            'meta_keywords' => 'RCC core cutting, diamond drilling, wall saw cutting, plumbing contractor, fire fighting services, concrete cutting Pakistan, core cutting Lahore, diamond drilling Karachi, wall saw Islamabad',
            'meta_author' => 'Razzaq Engineering Services',
            'meta_robots' => 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1',
            'og_title' => 'Razzaq Engineering Services - Professional Engineering Solutions',
            'og_description' => 'Pakistan\'s leading provider of RCC Core Cutting, Diamond Drilling, Wall Saw Cutting & Plumbing Services.',
            'twitter_card' => 'summary_large_image',
            
            // ============================================
            // Content - Footer & Legal
            // ============================================
            'footer_aboutus' => '<p>Razzaq Engineering Services is Pakistan\'s leading provider of professional <strong>RCC Core Cutting, Diamond Drilling, Wall Saw Cutting, Plumbing & Fire Fighting Services</strong>. Serving Lahore, Karachi, Islamabad, Rawalpindi & Peshawar with quality workmanship since 2010.</p>',
            'footer_description' => 'Professional engineering services across Pakistan. 24/7 emergency services available.',
            'footer_copyright_text' => '&copy; :year <strong>:company</strong>. All Rights Reserved.',
            'terms_and_conditions' => '<h2>Terms and Conditions</h2><p>Welcome to Razzaq Engineering Services. By accessing our website and using our services, you agree to comply with the following terms and conditions.</p><h3>Service Agreement</h3><p>All services are provided subject to availability and confirmation of order. Prices are subject to change without notice.</p><h3>Payment Terms</h3><p>Payment is due upon completion of work unless otherwise agreed in writing. We accept cash, bank transfer, and mobile wallet payments.</p>',
            'privacy_policy' => '<h2>Privacy Policy</h2><p>Razzaq Engineering Services is committed to protecting your privacy. This policy explains how we collect, use, and safeguard your information.</p><h3>Information Collection</h3><p>We collect information you provide when contacting us, requesting quotes, or using our services.</p><h3>Use of Information</h3><p>Your information is used solely for providing our services and communicating with you about your projects.</p>',
            'refund_policy' => '<h2>Refund Policy</h2><p>Customer satisfaction is our top priority. If you are not satisfied with our services, please contact us within 48 hours of service completion.</p><h3>Service Guarantee</h3><p>We stand behind our workmanship. Any defects in workmanship will be corrected at no additional cost.</p>',
            'cookie_consent_text' => 'We use cookies to improve your experience on our website. By continuing to browse, you agree to our use of cookies.',
            
            // ============================================
            // Email/SMTP Settings
            // ============================================
            'smtp_host' => null,
            'smtp_port' => null,
            'smtp_username' => null,
            'smtp_password' => null,
            'smtp_encryption' => 'tls',
            'mail_from_address' => null,
            'mail_from_name' => null,
            'mail_driver' => 'smtp',
            'mail_enabled' => true,
            
            // ============================================
            // SMS Settings
            // ============================================
            'sms_api_key' => null,
            'sms_api_secret' => null,
            'sms_sender_id' => null,
            'sms_gateway_url' => null,
            'sms_enabled' => false,
            
            // ============================================
            // WhatsApp API Settings
            // ============================================
            'whatsapp_api_key' => null,
            'whatsapp_api_url' => null,
            'whatsapp_phone_id' => null,
            'whatsapp_business_id' => null,
            'whatsapp_enabled' => false,
            
            // ============================================
            // Notifications
            // ============================================
            'email_notifications' => true,
            'sms_notifications' => false,
            'whatsapp_notifications' => false,
            'push_notifications' => false,
            'admin_notifications' => true,
            'notification_email' => 'admin@razzaqengineering.com',
            
            // ============================================
            // Maintenance Mode
            // ============================================
            'maintenance_mode' => false,
            'maintenance_message' => 'We are currently performing scheduled maintenance. We will be back shortly. Thank you for your patience.',
            'maintenance_title' => 'Under Maintenance',
            'maintenance_start' => null,
            'maintenance_end' => null,
            'maintenance_allowed_ips' => null,
            
            // ============================================
            // Feature Toggles
            // ============================================
            'enable_blog' => true,
            'enable_comments' => true,
            'enable_newsletter' => true,
            'enable_chat' => false,
            'enable_quote_form' => true,
            'enable_careers' => false,
            'enable_portfolio' => true,
            'enable_testimonials' => true,
            'enable_faq' => true,
            'enable_search' => true,
            'enable_sitemap' => true,
            
            // ============================================
            // Chat Widgets
            // ============================================
            'tawk_to_id' => null,
            'fb_messenger_id' => null,
            'whatsapp_chat_number' => '923048902805',
            'crisp_chat_id' => null,
            'livechat_id' => null,
            'zendesk_chat_id' => null,
            'intercom_id' => null,
            'drift_id' => null,
            
            // ============================================
            // Cookie Consent
            // ============================================
            'cookie_consent_enabled' => true,
            'cookie_consent_position' => 'bottom',
            'cookie_consent_theme' => 'light',
            'cookie_consent_message' => 'This website uses cookies to ensure you get the best experience on our website.',
            'cookie_consent_button_text' => 'Accept',
            'cookie_consent_decline_text' => 'Decline',
            
            // ============================================
            // Social Login
            // ============================================
            'facebook_login' => false,
            'facebook_client_id' => null,
            'facebook_client_secret' => null,
            'google_login' => false,
            'google_client_id' => null,
            'google_client_secret' => null,
            'github_login' => false,
            'github_client_id' => null,
            'github_client_secret' => null,
            
            // ============================================
            // Security
            // ============================================
            'force_https' => false,
            'enable_captcha' => false,
            'captcha_site_key' => null,
            'captcha_secret_key' => null,
            'max_login_attempts' => 5,
            'session_lifetime' => 120,
            'enable_ip_blocking' => false,
            'blocked_ips' => null,
            'allowed_ips' => null,
            'enable_csrf' => true,
            'enable_xss' => true,
            
            // ============================================
            // API
            // ============================================
            'enable_api' => false,
            'api_rate_limit' => 60,
            'api_require_auth' => true,
            
            // ============================================
            // Backup
            // ============================================
            'auto_backup' => false,
            'backup_frequency' => 'daily',
            'backup_time' => '02:00',
            'backup_database' => true,
            'backup_files' => true,
            'backup_retention_days' => '30',
            
            // ============================================
            // Cache & CDN
            // ============================================
            'enable_cache' => true,
            'cache_lifetime' => 60,
            'enable_cdn' => false,
            'cdn_url' => null,
            
            // ============================================
            // Localization
            // ============================================
            'default_language' => 'en',
            'default_timezone' => 'Asia/Karachi',
            'default_date_format' => 'Y-m-d',
            'default_time_format' => 'H:i:s',
            'default_currency' => 'PKR',
            'default_currency_symbol' => '₨',
            'number_format' => '1,000.00',
            
            // ============================================
            // Status
            // ============================================
            'status' => true,
            'is_verified' => true,
            'is_featured' => false,
            
            // ============================================
            // Version
            // ============================================
            'app_version' => '1.0.0',
            'last_update_check' => null,
            'auto_update' => false,
            
            // ============================================
            // Timestamps
            // ============================================
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $this->command->info('Settings seeded successfully!');
    }
}