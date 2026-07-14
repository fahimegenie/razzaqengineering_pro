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
        if (!Schema::hasTable('our_service')) {

            Schema::create('our_service', function (Blueprint $table) {
                $table->id();
                $table->string('os_name')->nullable();
                $table->string('os_slug')->unique()->nullable();
                $table->string('os_icon')->nullable();
                $table->string('os_image')->nullable();
                $table->text('os_description')->nullable();
                $table->text('os_short_description')->nullable();
                $table->string('os_banner')->nullable();
                $table->boolean('is_active')->default(true);
                $table->boolean('is_featured')->default(false);
                $table->integer('sort_order')->default(0);
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('meta_keywords')->nullable();
                $table->timestamps();
            });

        } else {

            Schema::table('our_service', function (Blueprint $table) {

                if (!Schema::hasColumn('our_service', 'os_name')) {
                    $table->string('os_name')->nullable();
                }

                if (!Schema::hasColumn('our_service', 'os_slug')) {
                    $table->string('os_slug')->unique()->nullable();
                }

                if (!Schema::hasColumn('our_service', 'os_icon')) {
                    $table->string('os_icon')->nullable();
                }

                if (!Schema::hasColumn('our_service', 'os_image')) {
                    $table->string('os_image')->nullable();
                }

                if (!Schema::hasColumn('our_service', 'os_description')) {
                    $table->text('os_description')->nullable();
                }

                if (!Schema::hasColumn('our_service', 'os_short_description')) {
                    $table->text('os_short_description')->nullable();
                }

                if (!Schema::hasColumn('our_service', 'os_banner')) {
                    $table->string('os_banner')->nullable();
                }

                if (!Schema::hasColumn('our_service', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }

                if (!Schema::hasColumn('our_service', 'is_featured')) {
                    $table->boolean('is_featured')->default(false);
                }

                if (!Schema::hasColumn('our_service', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }

                if (!Schema::hasColumn('our_service', 'meta_title')) {
                    $table->string('meta_title')->nullable();
                }

                if (!Schema::hasColumn('our_service', 'meta_description')) {
                    $table->text('meta_description')->nullable();
                }

                if (!Schema::hasColumn('our_service', 'meta_keywords')) {
                    $table->string('meta_keywords')->nullable();
                }

                if (!Schema::hasColumn('our_service', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('our_service', 'updated_at')) {
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
        Schema::dropIfExists('our_service');
    }
};
