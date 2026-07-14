<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('cities')) {
            Schema::create('cities', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('country', 2)->default('PK');
                $table->decimal('lat', 10, 8)->nullable();
                $table->decimal('lng', 11, 8)->nullable();
                
                // SEO Fields
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('meta_keywords')->nullable();
                
                // Content Fields
                $table->longText('content')->nullable();
                $table->text('schema')->nullable();
                $table->text('why_choose_us')->nullable();
                $table->text('areas_covered')->nullable();
                
                // Media Fields
                $table->string('banner_image')->nullable();
                $table->string('featured_image')->nullable();
                $table->string('og_image')->nullable();
                
                // Contact Fields
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->string('address')->nullable();
                $table->string('google_map_embed')->nullable();
                
                // Meta & Status
                $table->boolean('is_active')->default(true);
                $table->boolean('is_featured')->default(false);
                $table->integer('sort_order')->default(0);
                $table->string('canonical_url')->nullable();
                $table->string('meta_robots')->default('index, follow');
                
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};