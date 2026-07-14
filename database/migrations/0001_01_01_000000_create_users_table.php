<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }else{
            Schema::table('users', function (Blueprint $table) {

                if (!Schema::hasColumn('users', 'username')) {
                    $table->string('username')->unique()->nullable();
                }

                if (!Schema::hasColumn('users', 'first_name')) {
                    $table->string('first_name')->nullable();
                }

                if (!Schema::hasColumn('users', 'last_name')) {
                    $table->string('last_name')->nullable();
                }

                if (!Schema::hasColumn('users', 'phone')) {
                    $table->string('phone')->nullable();
                }

                if (!Schema::hasColumn('users', 'mobile')) {
                    $table->string('mobile')->nullable();
                }

                if (!Schema::hasColumn('users', 'whatsapp')) {
                    $table->string('whatsapp')->nullable();
                }

                if (!Schema::hasColumn('users', 'date_of_birth')) {
                    $table->date('date_of_birth')->nullable();
                }

                if (!Schema::hasColumn('users', 'gender')) {
                    $table->enum('gender', ['male', 'female', 'other'])->nullable();
                }

                if (!Schema::hasColumn('users', 'avatar')) {
                    $table->string('avatar')->nullable();
                }

                if (!Schema::hasColumn('users', 'cover_photo')) {
                    $table->string('cover_photo')->nullable();
                }

                if (!Schema::hasColumn('users', 'address')) {
                    $table->text('address')->nullable();
                }

                if (!Schema::hasColumn('users', 'city')) {
                    $table->string('city')->nullable();
                }

                if (!Schema::hasColumn('users', 'state')) {
                    $table->string('state')->nullable();
                }

                if (!Schema::hasColumn('users', 'country')) {
                    $table->string('country')->nullable()->default('Pakistan');
                }

                if (!Schema::hasColumn('users', 'postal_code')) {
                    $table->string('postal_code')->nullable();
                }

                if (!Schema::hasColumn('users', 'designation')) {
                    $table->string('designation')->nullable();
                }

                if (!Schema::hasColumn('users', 'department')) {
                    $table->string('department')->nullable();
                }

                if (!Schema::hasColumn('users', 'company_name')) {
                    $table->string('company_name')->nullable();
                }

                if (!Schema::hasColumn('users', 'bio')) {
                    $table->text('bio')->nullable();
                }

                if (!Schema::hasColumn('users', 'skills')) {
                    $table->text('skills')->nullable();
                }

                if (!Schema::hasColumn('users', 'facebook_url')) {
                    $table->string('facebook_url')->nullable();
                }

                if (!Schema::hasColumn('users', 'twitter_url')) {
                    $table->string('twitter_url')->nullable();
                }

                if (!Schema::hasColumn('users', 'instagram_url')) {
                    $table->string('instagram_url')->nullable();
                }

                if (!Schema::hasColumn('users', 'linkedin_url')) {
                    $table->string('linkedin_url')->nullable();
                }

                if (!Schema::hasColumn('users', 'youtube_url')) {
                    $table->string('youtube_url')->nullable();
                }

                if (!Schema::hasColumn('users', 'website_url')) {
                    $table->string('website_url')->nullable();
                }

                if (!Schema::hasColumn('users', 'github_url')) {
                    $table->string('github_url')->nullable();
                }

                if (!Schema::hasColumn('users', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }

                if (!Schema::hasColumn('users', 'is_admin')) {
                    $table->boolean('is_admin')->default(false);
                }

                if (!Schema::hasColumn('users', 'is_super_admin')) {
                    $table->boolean('is_super_admin')->default(false);
                }

                if (!Schema::hasColumn('users', 'is_verified')) {
                    $table->boolean('is_verified')->default(false);
                }

                if (!Schema::hasColumn('users', 'is_suspended')) {
                    $table->boolean('is_suspended')->default(false);
                }

                if (!Schema::hasColumn('users', 'suspended_at')) {
                    $table->timestamp('suspended_at')->nullable();
                }

                if (!Schema::hasColumn('users', 'suspension_reason')) {
                    $table->text('suspension_reason')->nullable();
                }

                if (!Schema::hasColumn('users', 'last_login_at')) {
                    $table->timestamp('last_login_at')->nullable();
                }

                if (!Schema::hasColumn('users', 'last_login_ip')) {
                    $table->string('last_login_ip')->nullable();
                }

                if (!Schema::hasColumn('users', 'last_login_device')) {
                    $table->string('last_login_device')->nullable();
                }

                if (!Schema::hasColumn('users', 'last_login_browser')) {
                    $table->string('last_login_browser')->nullable();
                }

                if (!Schema::hasColumn('users', 'last_login_platform')) {
                    $table->string('last_login_platform')->nullable();
                }

                if (!Schema::hasColumn('users', 'last_login_location')) {
                    $table->string('last_login_location')->nullable();
                }

                if (!Schema::hasColumn('users', 'login_attempts')) {
                    $table->integer('login_attempts')->default(0);
                }

                if (!Schema::hasColumn('users', 'locked_until')) {
                    $table->timestamp('locked_until')->nullable();
                }

                if (!Schema::hasColumn('users', 'two_factor_enabled')) {
                    $table->boolean('two_factor_enabled')->default(false);
                }

                if (!Schema::hasColumn('users', 'two_factor_secret')) {
                    $table->string('two_factor_secret')->nullable();
                }

                if (!Schema::hasColumn('users', 'two_factor_recovery_codes')) {
                    $table->text('two_factor_recovery_codes')->nullable();
                }

                if (!Schema::hasColumn('users', 'two_factor_confirmed_at')) {
                    $table->timestamp('two_factor_confirmed_at')->nullable();
                }

                if (!Schema::hasColumn('users', 'email_notifications')) {
                    $table->boolean('email_notifications')->default(true);
                }

                if (!Schema::hasColumn('users', 'marketing_emails')) {
                    $table->boolean('marketing_emails')->default(false);
                }

                if (!Schema::hasColumn('users', 'security_alerts')) {
                    $table->boolean('security_alerts')->default(true);
                }

                if (!Schema::hasColumn('users', 'last_email_sent_at')) {
                    $table->timestamp('last_email_sent_at')->nullable();
                }

                if (!Schema::hasColumn('users', 'api_token')) {
                    $table->string('api_token', 80)->unique()->nullable();
                }

                if (!Schema::hasColumn('users', 'api_token_expires_at')) {
                    $table->timestamp('api_token_expires_at')->nullable();
                }

                if (!Schema::hasColumn('users', 'language')) {
                    $table->string('language')->default('en');
                }

                if (!Schema::hasColumn('users', 'timezone')) {
                    $table->string('timezone')->default('Asia/Karachi');
                }

                if (!Schema::hasColumn('users', 'currency')) {
                    $table->string('currency')->default('PKR');
                }

                if (!Schema::hasColumn('users', 'date_format')) {
                    $table->string('date_format')->default('Y-m-d');
                }

                if (!Schema::hasColumn('users', 'theme')) {
                    $table->string('theme')->default('light');
                }

                if (!Schema::hasColumn('users', 'meta_data')) {
                    $table->json('meta_data')->nullable();
                }

                if (!Schema::hasColumn('users', 'preferences')) {
                    $table->json('preferences')->nullable();
                }

                if (!Schema::hasColumn('users', 'notes')) {
                    $table->text('notes')->nullable();
                }

                if (!Schema::hasColumn('users', 'referral_code')) {
                    $table->string('referral_code')->unique()->nullable();
                }

                if (!Schema::hasColumn('users', 'referred_by')) {
                    $table->unsignedBigInteger('referred_by')->nullable();
                }

                if (!Schema::hasColumn('users', 'deleted_at')) {
                    $table->softDeletes();
                }

            });
        }

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
