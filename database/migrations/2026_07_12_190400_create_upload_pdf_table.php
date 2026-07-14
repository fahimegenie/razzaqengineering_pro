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
        if (!Schema::hasTable('upload_pdf')) {

            Schema::create('upload_pdf', function (Blueprint $table) {
                $table->id();

                $table->text('pdf_name')->nullable();
                $table->string('pdf_title')->nullable();
                $table->text('pdf_description')->nullable();
                $table->string('pdf_category')->nullable();
                $table->string('pdf_file_size')->nullable();

                $table->boolean('is_active')->default(true);
                $table->integer('sort_order')->default(0);

                $table->timestamps();
            });

        } else {

            Schema::table('upload_pdf', function (Blueprint $table) {

                if (!Schema::hasColumn('upload_pdf', 'pdf_name')) {
                    $table->text('pdf_name')->nullable();
                }

                if (!Schema::hasColumn('upload_pdf', 'pdf_title')) {
                    $table->string('pdf_title')->nullable();
                }

                if (!Schema::hasColumn('upload_pdf', 'pdf_description')) {
                    $table->text('pdf_description')->nullable();
                }

                if (!Schema::hasColumn('upload_pdf', 'pdf_category')) {
                    $table->string('pdf_category')->nullable();
                }

                if (!Schema::hasColumn('upload_pdf', 'pdf_file_size')) {
                    $table->string('pdf_file_size')->nullable();
                }

                if (!Schema::hasColumn('upload_pdf', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }

                if (!Schema::hasColumn('upload_pdf', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }

                if (!Schema::hasColumn('upload_pdf', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('upload_pdf', 'updated_at')) {
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
        Schema::dropIfExists('upload_pdf');
    }
};
