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
        if (!Schema::hasTable('blog_comments')) {

            Schema::create('blog_comments', function (Blueprint $table) {

                $table->id();

                $table->unsignedBigInteger('post_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();

                // Commenter Information
                $table->string('commenter_name')->nullable();
                $table->string('commenter_email')->nullable();
                $table->string('commenter_website')->nullable();

                // Comment Content
                $table->text('comment_content')->nullable();

                // Status
                $table->enum('comment_status', [
                    'pending',
                    'approved',
                    'spam',
                    'trash'
                ])->default('pending');

                // Security / Tracking
                $table->string('ip_address')->nullable();
                $table->text('user_agent')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->index(['comment_status', 'post_id']);

            });

        } else {

            Schema::table('blog_comments', function (Blueprint $table) {

                $columns = [

                    'post_id' => 'unsignedBigInteger',
                    'user_id' => 'unsignedBigInteger',
                    'parent_id' => 'unsignedBigInteger',

                    'commenter_name' => 'string',
                    'commenter_email' => 'string',
                    'commenter_website' => 'string',

                    'comment_content' => 'text',

                    'ip_address' => 'string',
                    'user_agent' => 'text',
                ];


                foreach ($columns as $column => $type) {

                    if (!Schema::hasColumn('blog_comments', $column)) {

                        switch ($type) {

                            case 'string':
                                $table->string($column)->nullable();
                                break;

                            case 'text':
                                $table->text($column)->nullable();
                                break;

                            case 'unsignedBigInteger':
                                $table->unsignedBigInteger($column)->nullable();
                                break;

                        }
                    }
                }


                if (!Schema::hasColumn('blog_comments', 'comment_status')) {

                    $table->enum('comment_status', [
                        'pending',
                        'approved',
                        'spam',
                        'trash'
                    ])->default('pending');

                }


                if (!Schema::hasColumn('blog_comments', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('blog_comments', 'updated_at')) {
                    $table->timestamp('updated_at')->nullable();
                }

                if (!Schema::hasColumn('blog_comments', 'deleted_at')) {
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
        Schema::dropIfExists('blog_comments');
    }
};
