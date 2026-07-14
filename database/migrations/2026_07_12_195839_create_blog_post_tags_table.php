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
        if (!Schema::hasTable('blog_post_tags')) {

            Schema::create('blog_post_tags', function (Blueprint $table) {

                $table->id();

                $table->unsignedBigInteger('post_id')->nullable();
                $table->unsignedBigInteger('tag_id')->nullable();

                $table->timestamps();

                // Foreign keys only if parent tables exist
                if (Schema::hasTable('blog_posts')) {
                    $table->foreign('post_id')
                        ->references('id')
                        ->on('blog_posts')
                        ->onDelete('cascade');
                }

                if (Schema::hasTable('blog_tags')) {
                    $table->foreign('tag_id')
                        ->references('id')
                        ->on('blog_tags')
                        ->onDelete('cascade');
                }

                $table->unique(['post_id', 'tag_id']);

            });

        } else {

            Schema::table('blog_post_tags', function (Blueprint $table) {

                if (!Schema::hasColumn('blog_post_tags', 'post_id')) {
                    $table->unsignedBigInteger('post_id')->nullable();
                }

                if (!Schema::hasColumn('blog_post_tags', 'tag_id')) {
                    $table->unsignedBigInteger('tag_id')->nullable();
                }

                if (!Schema::hasColumn('blog_post_tags', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('blog_post_tags', 'updated_at')) {
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
        Schema::dropIfExists('blog_post_tags');
    }
};
