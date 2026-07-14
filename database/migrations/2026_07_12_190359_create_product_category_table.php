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
        if (!Schema::hasTable('product_category')) {

            Schema::create('product_category', function (Blueprint $table) {
                $table->id();

                $table->string('pc_name')->nullable();
                $table->string('pc_slug')->unique()->nullable();
                $table->text('pc_description')->nullable();
                $table->string('pc_image')->nullable();

                $table->boolean('is_active')->default(true);
                $table->integer('sort_order')->default(0);

                $table->timestamps();
            });

        } else {

            Schema::table('product_category', function (Blueprint $table) {

                if (!Schema::hasColumn('product_category', 'pc_name')) {
                    $table->string('pc_name')->nullable();
                }

                if (!Schema::hasColumn('product_category', 'pc_slug')) {
                    $table->string('pc_slug')->unique()->nullable();
                }

                if (!Schema::hasColumn('product_category', 'pc_description')) {
                    $table->text('pc_description')->nullable();
                }

                if (!Schema::hasColumn('product_category', 'pc_image')) {
                    $table->string('pc_image')->nullable();
                }

                if (!Schema::hasColumn('product_category', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }

                if (!Schema::hasColumn('product_category', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }

                if (!Schema::hasColumn('product_category', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('product_category', 'updated_at')) {
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
        Schema::dropIfExists('product_category');
    }
};
