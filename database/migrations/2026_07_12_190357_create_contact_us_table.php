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
        if (!Schema::hasTable('contact_us')) {
            Schema::create('contact_us', function (Blueprint $table) {
                $table->id();
                $table->string('cs_title');
                $table->text('cs_description');
                $table->text('map_address');
                $table->string('form_title')->nullable();
                $table->text('form_description')->nullable();
                $table->string('banner_image')->nullable();
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('meta_keywords')->nullable();
                $table->timestamps();
            });
        }else{
            Schema::table('contact_us', function (Blueprint $table) {
                // Check and add each column if it doesn't exist
                if (!Schema::hasColumn('contact_us', 'cs_title')) {
                    $table->string('cs_title');
                }
                if (!Schema::hasColumn('contact_us', 'cs_description')) {
                    $table->text('cs_description');
                }
                if (!Schema::hasColumn('contact_us', 'map_address')) {
                    $table->text('map_address');
                }
                if (!Schema::hasColumn('contact_us', 'form_title')) {
                    $table->string('form_title')->nullable();
                }
                if (!Schema::hasColumn('contact_us', 'form_description')) {
                    $table->text('form_description')->nullable();
                }
                if (!Schema::hasColumn('contact_us', 'banner_image')) {
                    $table->string('banner_image')->nullable();
                }
                if (!Schema::hasColumn('contact_us', 'meta_title')) {
                    $table->string('meta_title')->nullable();
                }
                if (!Schema::hasColumn('contact_us', 'meta_description')) {
                    $table->text('meta_description')->nullable();
                }
                if (!Schema::hasColumn('contact_us', 'meta_keywords')) {
                    $table->string('meta_keywords')->nullable();
                }
                if (!Schema::hasColumn('contact_us', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }
                if (!Schema::hasColumn('contact_us', 'updated_at')) {
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
        Schema::dropIfExists('contact_us');
    }
};
