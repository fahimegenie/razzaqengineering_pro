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
        if (!Schema::hasTable('pages')) {

            Schema::create('pages', function (Blueprint $table) {

                $table->id();

                $table->string('page_title')->nullable();
                $table->string('page_slug')->unique()->nullable();

                $table->string('page_subtitle')->nullable();
                $table->longText('page_content')->nullable();
                $table->text('page_excerpt')->nullable();

                // Layout
                $table->string('page_template')->default('default');
                $table->string('page_layout')->default('full-width');

                // Media
                $table->string('featured_image')->nullable();
                $table->string('banner_image')->nullable();
                $table->string('page_icon')->nullable();

                // Parent / Ordering
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->integer('sort_order')->default(0);

                // Status
                $table->boolean('is_active')->default(true);
                $table->boolean('show_in_menu')->default(false);
                $table->boolean('show_in_footer')->default(false);
                $table->boolean('is_homepage')->default(false);

                // Menu
                $table->string('menu_title')->nullable();
                $table->string('menu_icon')->nullable();

                // SEO
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('meta_keywords')->nullable();
                $table->string('og_image')->nullable();
                $table->string('canonical_url')->nullable();
                $table->text('schema_markup')->nullable();

                // Extra Data
                $table->json('custom_fields')->nullable();

                $table->timestamps();
                $table->softDeletes();

            });

        } else {

            Schema::table('pages', function (Blueprint $table) {

                $stringColumns = [
                    'page_title',
                    'page_slug',
                    'page_subtitle',
                    'page_template',
                    'page_layout',
                    'featured_image',
                    'banner_image',
                    'page_icon',
                    'menu_title',
                    'menu_icon',
                    'meta_title',
                    'meta_keywords',
                    'og_image',
                    'canonical_url'
                ];

                foreach ($stringColumns as $column) {
                    if (!Schema::hasColumn('pages', $column)) {
                        $table->string($column)->nullable();
                    }
                }


                $textColumns = [
                    'page_excerpt',
                    'meta_description',
                    'schema_markup'
                ];

                foreach ($textColumns as $column) {
                    if (!Schema::hasColumn('pages', $column)) {
                        $table->text($column)->nullable();
                    }
                }


                if (!Schema::hasColumn('pages', 'page_content')) {
                    $table->longText('page_content')->nullable();
                }

                if (!Schema::hasColumn('pages', 'parent_id')) {
                    $table->unsignedBigInteger('parent_id')->nullable();
                }

                if (!Schema::hasColumn('pages', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }

                if (!Schema::hasColumn('pages', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }

                if (!Schema::hasColumn('pages', 'show_in_menu')) {
                    $table->boolean('show_in_menu')->default(false);
                }

                if (!Schema::hasColumn('pages', 'show_in_footer')) {
                    $table->boolean('show_in_footer')->default(false);
                }

                if (!Schema::hasColumn('pages', 'is_homepage')) {
                    $table->boolean('is_homepage')->default(false);
                }

                if (!Schema::hasColumn('pages', 'custom_fields')) {
                    $table->json('custom_fields')->nullable();
                }

                if (!Schema::hasColumn('pages', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('pages', 'updated_at')) {
                    $table->timestamp('updated_at')->nullable();
                }

                if (!Schema::hasColumn('pages', 'deleted_at')) {
                    $table->softDeletes();
                }

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
