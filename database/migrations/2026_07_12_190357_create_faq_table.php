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
        if (!Schema::hasTable('faq')) {
            Schema::create('faq', function (Blueprint $table) {
                $table->id();
                $table->text('faq_question');
                $table->text('faq_answer');
                $table->string('faq_category')->nullable();
                $table->integer('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }else{
            Schema::table('faq', function (Blueprint $table) {
                // Check and add each column if it doesn't exist
                if (!Schema::hasColumn('faq', 'faq_question')) {
                    $table->text('faq_question');
                }
                if (!Schema::hasColumn('faq', 'faq_answer')) {
                    $table->text('faq_answer');
                }
                if (!Schema::hasColumn('faq', 'faq_category')) {
                    $table->text('faq_category');
                }
                if (!Schema::hasColumn('faq', 'sort_order')) {
                    $table->text('sort_order');
                }
                if (!Schema::hasColumn('faq', 'is_active')) {
                    $table->text('is_active');
                }
                if (!Schema::hasColumn('faq', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }
                if (!Schema::hasColumn('faq', 'updated_at')) {
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
        Schema::dropIfExists('faq');
    }
};
