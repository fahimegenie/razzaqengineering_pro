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
        if (!Schema::hasTable('slider')) {

            Schema::create('slider', function (Blueprint $table) {

                $table->id();

                // Images / Media
                $table->string('s_image')->nullable();
                $table->string('s_mobile_image')->nullable();
                $table->string('s_video')->nullable();
                $table->string('s_alt_text')->nullable();

                // Content
                $table->string('s_title')->nullable();
                $table->string('s_subtitle')->nullable();
                $table->text('s_description')->nullable();
                $table->string('s_badge_text')->nullable();

                // Small Text Blocks
                $table->string('s_t1')->nullable();
                $table->string('s_t2')->nullable();
                $table->string('s_t3')->nullable();

                // Button 1
                $table->string('button_text')->nullable();
                $table->string('button_link')->nullable();
                $table->string('button_target')->default('_self');

                // Button 2
                $table->string('button2_text')->nullable();
                $table->string('button2_link')->nullable();
                $table->string('button2_target')->default('_self');

                // Design Settings
                $table->string('slider_type')->default('image');
                $table->string('text_position')->default('center');
                $table->string('text_color')->default('#ffffff');
                $table->string('overlay_color')->nullable();
                $table->integer('overlay_opacity')->default(50);

                // Background Settings
                $table->string('background_color')->nullable();
                $table->string('background_position')->default('center');
                $table->string('background_size')->default('cover');

                // Animation
                $table->string('animation_type')->default('fade');
                $table->integer('slide_duration')->default(5000);

                // Link / Tracking
                $table->string('external_link')->nullable();
                $table->string('tracking_code')->nullable();

                // Scheduling
                $table->timestamp('start_date')->nullable();
                $table->timestamp('end_date')->nullable();

                // Status
                $table->boolean('is_active')->default(true);
                $table->boolean('is_featured')->default(false);
                $table->boolean('show_on_mobile')->default(true);
                $table->boolean('show_on_desktop')->default(true);

                // Ordering
                $table->integer('sort_order')->default(0);

                // Metadata
                $table->json('meta_data')->nullable();

                $table->timestamps();

            });

        } else {

            Schema::table('slider', function (Blueprint $table) {

                $columns = [

                    's_mobile_image',
                    's_video',
                    's_alt_text',
                    's_subtitle',
                    's_badge_text',
                    'button2_text',
                    'button2_link',
                    'button2_target',
                    'slider_type',
                    'text_position',
                    'text_color',
                    'overlay_color',
                    'background_color',
                    'background_position',
                    'background_size',
                    'animation_type',
                    'external_link',
                    'tracking_code'
                ];

                foreach ($columns as $column) {
                    if (!Schema::hasColumn('slider', $column)) {
                        $table->string($column)->nullable();
                    }
                }


                if (!Schema::hasColumn('slider', 's_description')) {
                    $table->text('s_description')->nullable();
                }

                if (!Schema::hasColumn('slider', 'overlay_opacity')) {
                    $table->integer('overlay_opacity')->default(50);
                }

                if (!Schema::hasColumn('slider', 'slide_duration')) {
                    $table->integer('slide_duration')->default(5000);
                }

                if (!Schema::hasColumn('slider', 'start_date')) {
                    $table->timestamp('start_date')->nullable();
                }

                if (!Schema::hasColumn('slider', 'end_date')) {
                    $table->timestamp('end_date')->nullable();
                }

                if (!Schema::hasColumn('slider', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }

                if (!Schema::hasColumn('slider', 'is_featured')) {
                    $table->boolean('is_featured')->default(false);
                }

                if (!Schema::hasColumn('slider', 'show_on_mobile')) {
                    $table->boolean('show_on_mobile')->default(true);
                }

                if (!Schema::hasColumn('slider', 'show_on_desktop')) {
                    $table->boolean('show_on_desktop')->default(true);
                }

                if (!Schema::hasColumn('slider', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }

                if (!Schema::hasColumn('slider', 'meta_data')) {
                    $table->json('meta_data')->nullable();
                }

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slider');
    }
};
