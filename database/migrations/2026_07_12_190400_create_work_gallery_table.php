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
        if (!Schema::hasTable('work_gallery')) {

            Schema::create('work_gallery', function (Blueprint $table) {
                $table->id();

                $table->string('wg_type')->nullable();
                $table->string('wg_title')->nullable();
                $table->string('wg_image')->nullable();
                $table->text('wg_description')->nullable();
                $table->string('wg_category')->nullable();

                $table->boolean('is_active')->default(true);
                $table->integer('sort_order')->default(0);

                $table->timestamps();
            });

        } else {

            Schema::table('work_gallery', function (Blueprint $table) {

                if (!Schema::hasColumn('work_gallery', 'wg_type')) {
                    $table->string('wg_type')->nullable();
                }

                if (!Schema::hasColumn('work_gallery', 'wg_title')) {
                    $table->string('wg_title')->nullable();
                }

                if (!Schema::hasColumn('work_gallery', 'wg_image')) {
                    $table->string('wg_image')->nullable();
                }

                if (!Schema::hasColumn('work_gallery', 'wg_description')) {
                    $table->text('wg_description')->nullable();
                }

                if (!Schema::hasColumn('work_gallery', 'wg_category')) {
                    $table->string('wg_category')->nullable();
                }

                if (!Schema::hasColumn('work_gallery', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }

                if (!Schema::hasColumn('work_gallery', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }

                if (!Schema::hasColumn('work_gallery', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('work_gallery', 'updated_at')) {
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
        Schema::dropIfExists('work_gallery');
    }
};
