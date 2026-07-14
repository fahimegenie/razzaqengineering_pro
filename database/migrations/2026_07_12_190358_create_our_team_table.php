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
        if (!Schema::hasTable('our_team')) {

            Schema::create('our_team', function (Blueprint $table) {
                $table->id();

                $table->string('ot_name')->nullable();
                $table->string('ot_image')->nullable();
                $table->string('ot_designation')->nullable();

                $table->string('ot_phone')->nullable();
                $table->string('ot_email')->nullable();

                $table->string('ot_fb')->nullable();
                $table->string('ot_gm')->nullable();
                $table->string('ot_inst')->nullable();
                $table->string('ot_twitter')->nullable();
                $table->string('ot_linkedin')->nullable();

                $table->text('ot_description')->nullable();
                $table->integer('ot_experience')->nullable();
                $table->text('ot_skills')->nullable();

                $table->boolean('is_active')->default(true);
                $table->integer('sort_order')->default(0);

                $table->timestamps();
            });

        } else {

            Schema::table('our_team', function (Blueprint $table) {

                if (!Schema::hasColumn('our_team', 'ot_name')) {
                    $table->string('ot_name')->nullable();
                }

                if (!Schema::hasColumn('our_team', 'ot_image')) {
                    $table->string('ot_image')->nullable();
                }

                if (!Schema::hasColumn('our_team', 'ot_designation')) {
                    $table->string('ot_designation')->nullable();
                }

                if (!Schema::hasColumn('our_team', 'ot_phone')) {
                    $table->string('ot_phone')->nullable();
                }

                if (!Schema::hasColumn('our_team', 'ot_email')) {
                    $table->string('ot_email')->nullable();
                }

                if (!Schema::hasColumn('our_team', 'ot_fb')) {
                    $table->string('ot_fb')->nullable();
                }

                if (!Schema::hasColumn('our_team', 'ot_gm')) {
                    $table->string('ot_gm')->nullable();
                }

                if (!Schema::hasColumn('our_team', 'ot_inst')) {
                    $table->string('ot_inst')->nullable();
                }

                if (!Schema::hasColumn('our_team', 'ot_twitter')) {
                    $table->string('ot_twitter')->nullable();
                }

                if (!Schema::hasColumn('our_team', 'ot_linkedin')) {
                    $table->string('ot_linkedin')->nullable();
                }

                if (!Schema::hasColumn('our_team', 'ot_description')) {
                    $table->text('ot_description')->nullable();
                }

                if (!Schema::hasColumn('our_team', 'ot_experience')) {
                    $table->integer('ot_experience')->nullable();
                }

                if (!Schema::hasColumn('our_team', 'ot_skills')) {
                    $table->text('ot_skills')->nullable();
                }

                if (!Schema::hasColumn('our_team', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }

                if (!Schema::hasColumn('our_team', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }

                if (!Schema::hasColumn('our_team', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('our_team', 'updated_at')) {
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
        Schema::dropIfExists('our_team');
    }
};
