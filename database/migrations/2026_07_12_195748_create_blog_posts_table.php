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
        if (!Schema::hasTable('blog_posts')) {

            Schema::create('blog_posts', function (Blueprint $table) {

                $table->id();

                // Basic Information
                $table->string('bp_title')->nullable();
                $table->string('bp_slug')->unique()->nullable();
                $table->text('bp_excerpt')->nullable();
                $table->longText('bp_content')->nullable();

                // Media
                $table->string('featured_image')->nullable();
                $table->string('banner_image')->nullable();
                $table->string('video_url')->nullable();
                $table->string('audio_url')->nullable();

                $table->json('gallery_images')->nullable();
                $table->json('attachments')->nullable();

                // Relations
                $table->unsignedBigInteger('category_id')->nullable();
                $table->unsignedBigInteger('author_id')->nullable();

                // Status
                $table->enum('bp_status', [
                    'draft',
                    'published',
                    'scheduled',
                    'archived'
                ])->default('draft');

                $table->timestamp('published_at')->nullable();

                // Features
                $table->boolean('is_featured')->default(false);
                $table->boolean('is_trending')->default(false);
                $table->boolean('allow_comments')->default(true);

                // Statistics
                $table->integer('views_count')->default(0);
                $table->integer('reading_time')->nullable();

                // Format
                $table->string('bp_format')->default('standard');

                // SEO
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('meta_keywords')->nullable();
                $table->string('og_image')->nullable();
                $table->string('canonical_url')->nullable();
                $table->text('schema_markup')->nullable();
                $table->json('structured_data')->nullable();

                $table->timestamps();
                $table->softDeletes();

            });

        } else {

            Schema::table('blog_posts', function (Blueprint $table) {

                $columns = [

                    'bp_title' => 'string',
                    'bp_slug' => 'string',
                    'bp_excerpt' => 'text',
                    'bp_content' => 'longText',

                    'featured_image' => 'string',
                    'banner_image' => 'string',
                    'video_url' => 'string',
                    'audio_url' => 'string',

                    'category_id' => 'unsignedBigInteger',
                    'author_id' => 'unsignedBigInteger',

                    'published_at' => 'timestamp',

                    'gallery_images' => 'json',
                    'attachments' => 'json',

                    'meta_title' => 'string',
                    'meta_description' => 'text',
                    'meta_keywords' => 'string',
                    'og_image' => 'string',
                    'canonical_url' => 'string',
                    'schema_markup' => 'text',
                    'structured_data' => 'json',
                ];


                foreach ($columns as $column => $type) {

                    if (!Schema::hasColumn('blog_posts', $column)) {

                        switch ($type) {

                            case 'string':
                                $table->string($column)->nullable();
                                break;

                            case 'text':
                                $table->text($column)->nullable();
                                break;

                            case 'longText':
                                $table->longText($column)->nullable();
                                break;

                            case 'json':
                                $table->json($column)->nullable();
                                break;

                            case 'timestamp':
                                $table->timestamp($column)->nullable();
                                break;

                            case 'unsignedBigInteger':
                                $table->unsignedBigInteger($column)->nullable();
                                break;
                        }
                    }
                }


                if (!Schema::hasColumn('blog_posts', 'bp_status')) {
                    $table->enum('bp_status', [
                        'draft',
                        'published',
                        'scheduled',
                        'archived'
                    ])->default('draft');
                }

                if (!Schema::hasColumn('blog_posts', 'is_featured')) {
                    $table->boolean('is_featured')->default(false);
                }

                if (!Schema::hasColumn('blog_posts', 'is_trending')) {
                    $table->boolean('is_trending')->default(false);
                }

                if (!Schema::hasColumn('blog_posts', 'allow_comments')) {
                    $table->boolean('allow_comments')->default(true);
                }

                if (!Schema::hasColumn('blog_posts', 'views_count')) {
                    $table->integer('views_count')->default(0);
                }

                if (!Schema::hasColumn('blog_posts', 'reading_time')) {
                    $table->integer('reading_time')->nullable();
                }

                if (!Schema::hasColumn('blog_posts', 'bp_format')) {
                    $table->string('bp_format')->default('standard');
                }

                if (!Schema::hasColumn('blog_posts', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('blog_posts', 'updated_at')) {
                    $table->timestamp('updated_at')->nullable();
                }

                if (!Schema::hasColumn('blog_posts', 'deleted_at')) {
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
        Schema::dropIfExists('blog_posts');
    }
};
