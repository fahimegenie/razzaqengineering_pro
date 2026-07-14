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
        if (!Schema::hasTable('projects')) {

            Schema::create('projects', function (Blueprint $table) {
                $table->id();

                $table->string('p_title')->nullable();
                $table->string('p_slug')->unique()->nullable();

                $table->string('p_image')->nullable();

                $table->text('p_description')->nullable();
                $table->text('p_short_description')->nullable();

                $table->string('p_category')->nullable();
                $table->unsignedBigInteger('pc_id')->nullable();

                $table->string('p_location')->nullable();
                $table->string('p_client')->nullable();

                $table->date('p_start_date')->nullable();
                $table->date('p_end_date')->nullable();

                $table->string('p_status')->default('completed');

                $table->json('p_gallery')->nullable();

                $table->boolean('is_active')->default(true);
                $table->boolean('is_featured')->default(false);

                $table->integer('sort_order')->default(0);

                $table->timestamps();

            });

        } else {

            Schema::table('projects', function (Blueprint $table) {

                if (!Schema::hasColumn('projects', 'p_title')) {
                    $table->string('p_title')->nullable();
                }

                if (!Schema::hasColumn('projects', 'p_slug')) {
                    $table->string('p_slug')->unique()->nullable();
                }

                if (!Schema::hasColumn('projects', 'p_image')) {
                    $table->string('p_image')->nullable();
                }

                if (!Schema::hasColumn('projects', 'p_description')) {
                    $table->text('p_description')->nullable();
                }

                if (!Schema::hasColumn('projects', 'p_short_description')) {
                    $table->text('p_short_description')->nullable();
                }

                if (!Schema::hasColumn('projects', 'p_category')) {
                    $table->string('p_category')->nullable();
                }

                if (!Schema::hasColumn('projects', 'pc_id')) {
                    $table->unsignedBigInteger('pc_id')->nullable();
                }

                if (!Schema::hasColumn('projects', 'p_location')) {
                    $table->string('p_location')->nullable();
                }

                if (!Schema::hasColumn('projects', 'p_client')) {
                    $table->string('p_client')->nullable();
                }

                if (!Schema::hasColumn('projects', 'p_start_date')) {
                    $table->date('p_start_date')->nullable();
                }

                if (!Schema::hasColumn('projects', 'p_end_date')) {
                    $table->date('p_end_date')->nullable();
                }

                if (!Schema::hasColumn('projects', 'p_status')) {
                    $table->string('p_status')->default('completed');
                }

                if (!Schema::hasColumn('projects', 'p_gallery')) {
                    $table->json('p_gallery')->nullable();
                }

                if (!Schema::hasColumn('projects', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }

                if (!Schema::hasColumn('projects', 'is_featured')) {
                    $table->boolean('is_featured')->default(false);
                }

                if (!Schema::hasColumn('projects', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }

                if (!Schema::hasColumn('projects', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('projects', 'updated_at')) {
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
        Schema::dropIfExists('projects');
    }
};
