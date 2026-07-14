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
        if (!Schema::hasTable('testimonials')) {

            Schema::create('testimonials', function (Blueprint $table) {

                $table->id();

                // Customer Information
                $table->string('t_name')->nullable();
                $table->string('t_designation')->nullable();
                $table->string('t_company')->nullable();
                $table->string('t_image')->nullable();
                $table->text('t_content')->nullable();

                // Review Information
                $table->integer('t_rating')->default(5);
                $table->string('t_location')->nullable();

                // Relations
                $table->unsignedBigInteger('project_id')->nullable();
                $table->unsignedBigInteger('service_id')->nullable();

                // Status
                $table->boolean('is_active')->default(true);
                $table->boolean('is_featured')->default(false);

                $table->integer('sort_order')->default(0);

                $table->timestamps();

            });

        } else {

            Schema::table('testimonials', function (Blueprint $table) {

                $columns = [

                    't_name' => 'string',
                    't_designation' => 'string',
                    't_company' => 'string',
                    't_image' => 'string',
                    't_content' => 'text',
                    't_location' => 'string',

                    'project_id' => 'unsignedBigInteger',
                    'service_id' => 'unsignedBigInteger',

                ];


                foreach ($columns as $column => $type) {

                    if (!Schema::hasColumn('testimonials', $column)) {

                        switch ($type) {

                            case 'string':
                                $table->string($column)->nullable();
                                break;

                            case 'text':
                                $table->text($column)->nullable();
                                break;

                            case 'unsignedBigInteger':
                                $table->unsignedBigInteger($column)->nullable();
                                break;

                        }
                    }
                }


                if (!Schema::hasColumn('testimonials', 't_rating')) {
                    $table->integer('t_rating')->default(5);
                }

                if (!Schema::hasColumn('testimonials', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }

                if (!Schema::hasColumn('testimonials', 'is_featured')) {
                    $table->boolean('is_featured')->default(false);
                }

                if (!Schema::hasColumn('testimonials', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }


                if (!Schema::hasColumn('testimonials', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('testimonials', 'updated_at')) {
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
        Schema::dropIfExists('testimonials');
    }
};
