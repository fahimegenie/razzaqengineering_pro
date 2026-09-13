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
        if (!Schema::hasTable('careers')) {
            Schema::create('careers', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('department')->nullable();
                $table->string('location')->nullable();
                $table->string('job_type')->nullable()->comment('Full-time, Part-time, Contract, Remote, etc.');
                $table->string('salary_range')->nullable();
                $table->string('experience')->nullable()->comment('e.g., 2-5 Years, Entry Level, Senior');
                $table->string('qualification')->nullable();
                $table->text('description')->nullable();
                $table->text('requirements')->nullable();
                $table->text('benefits')->nullable();
                $table->boolean('is_active')->default(true);
                $table->integer('sort_order')->default(0);
                $table->date('closing_date')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};