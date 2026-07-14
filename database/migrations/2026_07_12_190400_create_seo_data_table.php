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
        if (!Schema::hasTable('seo_data')) {

            Schema::create('seo_data', function (Blueprint $table) {

                $table->id();

                // Basic SEO
                $table->string('seo_main_title')->nullable();
                $table->string('seo_title')->nullable();
                $table->text('seo_description')->nullable();
                $table->text('seo_keywords')->nullable();
                $table->string('seo_focus_keyword')->nullable();
                $table->string('seo_canonical')->nullable();

                // Page Information
                $table->string('seo_page_type')->default('website');
                $table->string('seo_page_url')->nullable();
                $table->string('seo_slug')->nullable();

                // Robots
                $table->string('seo_robots')->default('index,follow');
                $table->boolean('seo_no_index')->default(false);
                $table->boolean('seo_no_follow')->default(false);

                // Open Graph
                $table->string('seo_og_title')->nullable();
                $table->text('seo_og_description')->nullable();
                $table->string('seo_og_image')->nullable();
                $table->string('seo_og_type')->default('website');

                // Twitter Cards
                $table->string('seo_twitter_card')->default('summary_large_image');
                $table->string('seo_twitter_title')->nullable();
                $table->text('seo_twitter_description')->nullable();
                $table->string('seo_twitter_image')->nullable();

                // Schema JSON-LD
                $table->longText('seo_schema_markup')->nullable();
                $table->string('seo_schema_type')->nullable();
                $table->longText('seo_breadcrumb_schema')->nullable();

                // Advanced SEO
                $table->string('seo_author')->nullable();
                $table->string('seo_publisher')->nullable();
                $table->date('seo_published_date')->nullable();
                $table->date('seo_modified_date')->nullable();

                // Verification
                $table->text('google_site_verification')->nullable();
                $table->text('bing_site_verification')->nullable();
                $table->text('yandex_site_verification')->nullable();

                // Analytics
                $table->text('google_analytics_id')->nullable();
                $table->text('google_tag_manager_id')->nullable();
                $table->text('facebook_pixel_id')->nullable();

                // Sitemap
                $table->boolean('seo_sitemap_include')->default(true);
                $table->integer('seo_sitemap_priority')->default(50);
                $table->string('seo_sitemap_frequency')->default('weekly');

                // Multi language SEO
                $table->string('seo_hreflang')->nullable();

                // Extra Data
                $table->json('seo_extra_data')->nullable();

                $table->timestamps();

            });

        } else {

            Schema::table('seo_data', function (Blueprint $table) {

                $stringColumns = [
                    'seo_main_title',
                    'seo_title',
                    'seo_focus_keyword',
                    'seo_canonical',
                    'seo_page_type',
                    'seo_page_url',
                    'seo_slug',
                    'seo_robots',
                    'seo_og_title',
                    'seo_og_image',
                    'seo_og_type',
                    'seo_twitter_card',
                    'seo_twitter_title',
                    'seo_twitter_image',
                    'seo_author',
                    'seo_publisher',
                    'seo_schema_type',
                    'seo_hreflang'
                ];

                foreach ($stringColumns as $column) {
                    if (!Schema::hasColumn('seo_data', $column)) {
                        $table->string($column)->nullable();
                    }
                }


                $textColumns = [
                    'seo_description',
                    'seo_keywords',
                    'seo_og_description',
                    'seo_twitter_description',
                    'seo_schema_markup',
                    'seo_breadcrumb_schema',
                    'google_site_verification',
                    'bing_site_verification',
                    'yandex_site_verification',
                    'google_analytics_id',
                    'google_tag_manager_id',
                    'facebook_pixel_id'
                ];

                foreach ($textColumns as $column) {
                    if (!Schema::hasColumn('seo_data', $column)) {
                        $table->text($column)->nullable();
                    }
                }


                if (!Schema::hasColumn('seo_data', 'seo_no_index')) {
                    $table->boolean('seo_no_index')->default(false);
                }

                if (!Schema::hasColumn('seo_data', 'seo_no_follow')) {
                    $table->boolean('seo_no_follow')->default(false);
                }

                if (!Schema::hasColumn('seo_data', 'seo_sitemap_include')) {
                    $table->boolean('seo_sitemap_include')->default(true);
                }

                if (!Schema::hasColumn('seo_data', 'seo_sitemap_priority')) {
                    $table->integer('seo_sitemap_priority')->default(50);
                }

                if (!Schema::hasColumn('seo_data', 'seo_sitemap_frequency')) {
                    $table->string('seo_sitemap_frequency')->default('weekly');
                }

                if (!Schema::hasColumn('seo_data', 'seo_published_date')) {
                    $table->date('seo_published_date')->nullable();
                }

                if (!Schema::hasColumn('seo_data', 'seo_modified_date')) {
                    $table->date('seo_modified_date')->nullable();
                }

                if (!Schema::hasColumn('seo_data', 'seo_extra_data')) {
                    $table->json('seo_extra_data')->nullable();
                }
                if (Schema::hasColumn('seo_data', 'seo_created_at')) {
                    Schema::table('seo_data', function (Blueprint $table) {
                        $table->timestamp('seo_created_at')
                            ->nullable()
                            ->default(null)
                            ->change();
                    });
                }

                if (!Schema::hasColumn('seo_data', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('seo_data', 'updated_at')) {
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
        Schema::dropIfExists('seo_data');
    }
};
