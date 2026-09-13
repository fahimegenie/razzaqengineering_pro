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
        if (!Schema::hasTable('job_applications')) {
            Schema::create('job_applications', function (Blueprint $table) {
                $table->id();
                $table->foreignId('career_id')->nullable()->constrained('careers')->nullOnDelete();
                $table->string('name');
                $table->string('email');
                $table->string('phone');
                $table->text('cover_letter')->nullable();
                $table->string('resume_path')->nullable();
                $table->string('status')->default('new')->comment('new, reviewed, shortlisted, interviewed, hired, rejected');
                $table->text('admin_notes')->nullable();
                $table->string('ip_address')->nullable();
                $table->string('user_agent')->nullable();
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
        Schema::dropIfExists('job_applications');
    }
};