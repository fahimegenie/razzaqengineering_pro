<?php
// database/migrations/2026_07_14_000003_create_fleet_media_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fleet_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fleet_item_id')->constrained()->cascadeOnDelete();
            $table->string('file_path');
            $table->string('file_type')->default('image'); // image, video, pdf
            $table->string('title')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fleet_media');
    }
};