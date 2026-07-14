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
        if (!Schema::hasTable('service_advantage')) {

            Schema::create('service_advantage', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('sa_st_id')->nullable();

                $table->string('sa_title')->nullable();
                $table->text('sa_description')->nullable();

                $table->string('sa_image')->nullable();

                $table->string('sa_t1')->nullable();
                $table->string('sa_t2')->nullable();
                $table->string('sa_t3')->nullable();
                $table->string('sa_t4')->nullable();

                $table->integer('sort_order')->default(0);

                $table->timestamps();

            });

        } else {

            Schema::table('service_advantage', function (Blueprint $table) {

                if (!Schema::hasColumn('service_advantage', 'sa_st_id')) {
                    $table->unsignedBigInteger('sa_st_id')->nullable();
                }

                if (!Schema::hasColumn('service_advantage', 'sa_title')) {
                    $table->string('sa_title')->nullable();
                }

                if (!Schema::hasColumn('service_advantage', 'sa_description')) {
                    $table->text('sa_description')->nullable();
                }

                if (!Schema::hasColumn('service_advantage', 'sa_image')) {
                    $table->string('sa_image')->nullable();
                }

                if (!Schema::hasColumn('service_advantage', 'sa_t1')) {
                    $table->string('sa_t1')->nullable();
                }

                if (!Schema::hasColumn('service_advantage', 'sa_t2')) {
                    $table->string('sa_t2')->nullable();
                }

                if (!Schema::hasColumn('service_advantage', 'sa_t3')) {
                    $table->string('sa_t3')->nullable();
                }

                if (!Schema::hasColumn('service_advantage', 'sa_t4')) {
                    $table->string('sa_t4')->nullable();
                }

                if (!Schema::hasColumn('service_advantage', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }

                if (!Schema::hasColumn('service_advantage', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('service_advantage', 'updated_at')) {
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
        Schema::dropIfExists('service_advantage');
    }
};
