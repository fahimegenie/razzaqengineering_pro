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
        if (!Schema::hasTable('blog_tags')) {

            Schema::create('blog_tags', function (Blueprint $table) {

                $table->id();

                $table->string('bt_name')->nullable();
                $table->string('bt_slug')->unique()->nullable();
                $table->text('bt_description')->nullable();

                $table->boolean('is_active')->default(true);
                $table->integer('sort_order')->default(0);

                $table->timestamps();
            });

        } else {

            Schema::table('blog_tags', function (Blueprint $table) {

                if (!Schema::hasColumn('blog_tags', 'bt_name')) {
                    $table->string('bt_name')->nullable();
                }

                if (!Schema::hasColumn('blog_tags', 'bt_slug')) {
                    $table->string('bt_slug')->unique()->nullable();
                }

                if (!Schema::hasColumn('blog_tags', 'bt_description')) {
                    $table->text('bt_description')->nullable();
                }

                if (!Schema::hasColumn('blog_tags', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }

                if (!Schema::hasColumn('blog_tags', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }

                if (!Schema::hasColumn('blog_tags', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('blog_tags', 'updated_at')) {
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
        Schema::dropIfExists('blog_tags');
    }
};
