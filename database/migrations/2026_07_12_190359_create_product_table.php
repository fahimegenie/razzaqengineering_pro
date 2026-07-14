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
        if (!Schema::hasTable('product')) {

            Schema::create('product', function (Blueprint $table) {
                $table->id();

                $table->string('p_name')->nullable();
                $table->string('p_slug')->unique()->nullable();

                $table->text('p_description')->nullable();
                $table->text('p_short_description')->nullable();

                $table->string('p_image')->nullable();

                $table->string('p_price')->nullable();
                $table->string('p_contact')->nullable();
                $table->string('pc_type')->nullable();

                $table->unsignedBigInteger('product_category_id')->nullable();

                $table->json('p_gallery')->nullable();
                $table->text('p_specifications')->nullable();

                $table->boolean('in_stock')->default(true);
                $table->boolean('is_active')->default(true);
                $table->boolean('is_featured')->default(false);

                $table->integer('sort_order')->default(0);

                $table->timestamps();

            });

        } else {

            Schema::table('product', function (Blueprint $table) {

                if (!Schema::hasColumn('product', 'p_name')) {
                    $table->string('p_name')->nullable();
                }

                if (!Schema::hasColumn('product', 'p_slug')) {
                    $table->string('p_slug')->unique()->nullable();
                }

                if (!Schema::hasColumn('product', 'p_description')) {
                    $table->text('p_description')->nullable();
                }

                if (!Schema::hasColumn('product', 'p_short_description')) {
                    $table->text('p_short_description')->nullable();
                }

                if (!Schema::hasColumn('product', 'p_image')) {
                    $table->string('p_image')->nullable();
                }

                if (!Schema::hasColumn('product', 'p_price')) {
                    $table->string('p_price')->nullable();
                }

                if (!Schema::hasColumn('product', 'p_contact')) {
                    $table->string('p_contact')->nullable();
                }

                if (!Schema::hasColumn('product', 'pc_type')) {
                    $table->string('pc_type')->nullable();
                }

                if (!Schema::hasColumn('product', 'product_category_id')) {
                    $table->unsignedBigInteger('product_category_id')->nullable();
                }

                if (!Schema::hasColumn('product', 'p_gallery')) {
                    $table->json('p_gallery')->nullable();
                }

                if (!Schema::hasColumn('product', 'p_specifications')) {
                    $table->text('p_specifications')->nullable();
                }

                if (!Schema::hasColumn('product', 'in_stock')) {
                    $table->boolean('in_stock')->default(true);
                }

                if (!Schema::hasColumn('product', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }

                if (!Schema::hasColumn('product', 'is_featured')) {
                    $table->boolean('is_featured')->default(false);
                }

                if (!Schema::hasColumn('product', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }

                if (!Schema::hasColumn('product', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('product', 'updated_at')) {
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
        Schema::dropIfExists('product');
    }
};
