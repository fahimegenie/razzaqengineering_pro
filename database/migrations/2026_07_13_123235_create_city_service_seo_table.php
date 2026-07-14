<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('city_service_seo')) {
            Schema::create('city_service_seo', function (Blueprint $table) {
                $table->id();
                $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
                $table->unsignedBigInteger('service_id');
                $table->foreign('service_id')->references('os_id')->on('our_service')->onDelete('cascade');
                
                // SEO Fields
                $table->string('title')->nullable();
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('canonical')->nullable();
                $table->text('schema')->nullable();
                $table->longText('content')->nullable();
                $table->json('faq')->nullable();
                
                // Additional Content
                $table->text('introduction')->nullable();
                $table->text('benefits')->nullable();
                $table->text('applications')->nullable();
                $table->text('machines')->nullable();
                $table->text('areas_covered')->nullable();
                
                // Status
                $table->boolean('is_active')->default(true);
                $table->integer('sort_order')->default(0);
                
                // SEO Meta
                $table->string('meta_keywords')->nullable();
                $table->string('og_image')->nullable();
                $table->string('meta_robots')->default('index, follow');
                
                // Featured Image
                $table->string('featured_image')->nullable();
                $table->string('banner_image')->nullable();
                
                $table->timestamps();
                
                // Unique constraint
                $table->unique(['city_id', 'service_id'], 'city_service_unique');
                
                // Indexes
                $table->index(['city_id', 'is_active']);
                $table->index(['service_id', 'is_active']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('city_service_seo');
    }
};