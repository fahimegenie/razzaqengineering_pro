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
        if (!Schema::hasTable('blog_categories')) {

            Schema::create('blog_categories', function (Blueprint $table) {

                $table->id();

                $table->string('bc_name')->nullable();
                $table->string('bc_slug')->unique()->nullable();
                $table->text('bc_description')->nullable();

                $table->string('bc_image')->nullable();
                $table->string('bc_color')->nullable();

                $table->unsignedBigInteger('parent_id')->nullable();

                $table->boolean('is_active')->default(true);
                $table->boolean('is_featured')->default(false);

                $table->integer('sort_order')->default(0);

                // SEO
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('meta_keywords')->nullable();

                $table->timestamps();
            });

        } else {

            Schema::table('blog_categories', function (Blueprint $table) {

                if (!Schema::hasColumn('blog_categories', 'bc_name')) {
                    $table->string('bc_name')->nullable();
                }

                if (!Schema::hasColumn('blog_categories', 'bc_slug')) {
                    $table->string('bc_slug')->unique()->nullable();
                }

                if (!Schema::hasColumn('blog_categories', 'bc_description')) {
                    $table->text('bc_description')->nullable();
                }

                if (!Schema::hasColumn('blog_categories', 'bc_image')) {
                    $table->string('bc_image')->nullable();
                }

                if (!Schema::hasColumn('blog_categories', 'bc_color')) {
                    $table->string('bc_color')->nullable();
                }

                if (!Schema::hasColumn('blog_categories', 'parent_id')) {
                    $table->unsignedBigInteger('parent_id')->nullable();
                }

                if (!Schema::hasColumn('blog_categories', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }

                if (!Schema::hasColumn('blog_categories', 'is_featured')) {
                    $table->boolean('is_featured')->default(false);
                }

                if (!Schema::hasColumn('blog_categories', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }

                if (!Schema::hasColumn('blog_categories', 'meta_title')) {
                    $table->string('meta_title')->nullable();
                }

                if (!Schema::hasColumn('blog_categories', 'meta_description')) {
                    $table->text('meta_description')->nullable();
                }

                if (!Schema::hasColumn('blog_categories', 'meta_keywords')) {
                    $table->string('meta_keywords')->nullable();
                }

                if (!Schema::hasColumn('blog_categories', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('blog_categories', 'updated_at')) {
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
        Schema::dropIfExists('blog_categories');
    }
};
