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
        if (!Schema::hasTable('our_company')) {
            Schema::create('our_company', function (Blueprint $table) {
                $table->id();
                $table->string('oc_title')->nullable();
                $table->text('oc_description')->nullable();
                $table->string('oc_image1')->nullable();
                $table->string('oc_image2')->nullable();
                $table->string('oc_image3')->nullable();
                $table->string('oc_image4')->nullable();
                $table->string('ceo_name')->nullable();
                $table->string('ceo_image')->nullable();
                $table->text('ceo_message')->nullable();
                $table->string('established_year')->nullable();
                $table->string('company_type')->nullable();
                $table->string('our_company_category')->nullable();
                $table->integer('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }else{
            Schema::table('our_company', function (Blueprint $table) {

                if (!Schema::hasColumn('our_company', 'oc_title')) {
                    $table->string('oc_title')->nullable();
                }
                if (!Schema::hasColumn('our_company', 'oc_description')) {
                    $table->text('oc_description')->nullable();
                }
                if (!Schema::hasColumn('our_company', 'oc_image1')) {
                    $table->string('oc_image1')->nullable();
                }
                if (!Schema::hasColumn('our_company', 'oc_image2')) {
                    $table->string('oc_image2')->nullable();
                }
                if (!Schema::hasColumn('our_company', 'oc_image3')) {
                    $table->string('oc_image3')->nullable();
                }
                if (!Schema::hasColumn('our_company', 'oc_image4')) {
                    $table->string('oc_image4')->nullable();
                }
                if (!Schema::hasColumn('our_company', 'ceo_name')) {
                    $table->string('ceo_name')->nullable();
                }
                if (!Schema::hasColumn('our_company', 'ceo_image')) {
                    $table->string('ceo_image')->nullable();
                }
                if (!Schema::hasColumn('our_company', 'ceo_message')) {
                    $table->text('ceo_message')->nullable();
                }
                if (!Schema::hasColumn('our_company', 'established_year')) {
                    $table->string('established_year')->nullable();
                }
                if (!Schema::hasColumn('our_company', 'company_type')) {
                    $table->string('company_type')->nullable();
                }
                if (!Schema::hasColumn('our_company', 'our_company_category')) {
                    $table->string('our_company_category')->nullable();
                }
                if (!Schema::hasColumn('our_company', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }
                if (!Schema::hasColumn('our_company', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }
                if (!Schema::hasColumn('our_company', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }
                if (!Schema::hasColumn('our_company', 'updated_at')) {
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
        Schema::dropIfExists('our_company');
    }
};
