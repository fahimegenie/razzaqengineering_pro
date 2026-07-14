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
        if (!Schema::hasTable('newsletter_subscribers')) {

            Schema::create('newsletter_subscribers', function (Blueprint $table) {

                $table->id();

                $table->string('ns_email')->unique()->nullable();
                $table->string('ns_name')->nullable();
                $table->string('ns_phone')->nullable();

                $table->string('ns_source')->default('website');

                $table->string('subscription_token')->unique()->nullable();

                $table->boolean('is_subscribed')->default(true);

                $table->timestamp('subscribed_at')->nullable();
                $table->timestamp('unsubscribed_at')->nullable();

                $table->string('ip_address')->nullable();

                $table->timestamps();

            });

        } else {

            Schema::table('newsletter_subscribers', function (Blueprint $table) {

                if (!Schema::hasColumn('newsletter_subscribers', 'ns_email')) {
                    $table->string('ns_email')->unique()->nullable();
                }

                if (!Schema::hasColumn('newsletter_subscribers', 'ns_name')) {
                    $table->string('ns_name')->nullable();
                }

                if (!Schema::hasColumn('newsletter_subscribers', 'ns_phone')) {
                    $table->string('ns_phone')->nullable();
                }

                if (!Schema::hasColumn('newsletter_subscribers', 'ns_source')) {
                    $table->string('ns_source')->default('website');
                }

                if (!Schema::hasColumn('newsletter_subscribers', 'subscription_token')) {
                    $table->string('subscription_token')->unique()->nullable();
                }

                if (!Schema::hasColumn('newsletter_subscribers', 'is_subscribed')) {
                    $table->boolean('is_subscribed')->default(true);
                }

                if (!Schema::hasColumn('newsletter_subscribers', 'subscribed_at')) {
                    $table->timestamp('subscribed_at')->nullable();
                }

                if (!Schema::hasColumn('newsletter_subscribers', 'unsubscribed_at')) {
                    $table->timestamp('unsubscribed_at')->nullable();
                }

                if (!Schema::hasColumn('newsletter_subscribers', 'ip_address')) {
                    $table->string('ip_address')->nullable();
                }

                if (!Schema::hasColumn('newsletter_subscribers', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('newsletter_subscribers', 'updated_at')) {
                    $table->timestamp('updated_at')->nullable();
                }

            });

        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletter_subscribers');
    }
};
