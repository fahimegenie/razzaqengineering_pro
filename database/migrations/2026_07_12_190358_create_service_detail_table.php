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
        if (!Schema::hasTable('service_detail')) {

            Schema::create('service_detail', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('os_id')->nullable();

                $table->string('sd_title')->nullable();
                $table->text('sd_description')->nullable();

                $table->string('sd_t1')->nullable();
                $table->string('sd_t2')->nullable();
                $table->string('sd_t3')->nullable();

                $table->string('sd_image1')->nullable();
                $table->string('sd_image2')->nullable();

                $table->text('sd_features')->nullable();

                $table->integer('sort_order')->default(0);

                $table->timestamps();

                // Agar foreign key chahiye to alag migration mein add karna better hai.
                // $table->foreign('os_id')->references('id')->on('our_service')->onDelete('cascade');
            });

        } else {

            Schema::table('service_detail', function (Blueprint $table) {

                if (!Schema::hasColumn('service_detail', 'os_id')) {
                    $table->unsignedBigInteger('os_id')->nullable();
                }

                if (!Schema::hasColumn('service_detail', 'sd_title')) {
                    $table->string('sd_title')->nullable();
                }

                if (!Schema::hasColumn('service_detail', 'sd_description')) {
                    $table->text('sd_description')->nullable();
                }

                if (!Schema::hasColumn('service_detail', 'sd_t1')) {
                    $table->string('sd_t1')->nullable();
                }

                if (!Schema::hasColumn('service_detail', 'sd_t2')) {
                    $table->string('sd_t2')->nullable();
                }

                if (!Schema::hasColumn('service_detail', 'sd_t3')) {
                    $table->string('sd_t3')->nullable();
                }

                if (!Schema::hasColumn('service_detail', 'sd_image1')) {
                    $table->string('sd_image1')->nullable();
                }

                if (!Schema::hasColumn('service_detail', 'sd_image2')) {
                    $table->string('sd_image2')->nullable();
                }

                if (!Schema::hasColumn('service_detail', 'sd_features')) {
                    $table->text('sd_features')->nullable();
                }

                if (!Schema::hasColumn('service_detail', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }

                if (!Schema::hasColumn('service_detail', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('service_detail', 'updated_at')) {
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
        Schema::dropIfExists('service_detail');
    }
};
