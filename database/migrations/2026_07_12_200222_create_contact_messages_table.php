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
        if (!Schema::hasTable('contact_messages')) {

            Schema::create('contact_messages', function (Blueprint $table) {

                $table->id();

                // Contact Information
                $table->string('cm_name')->nullable();
                $table->string('cm_email')->nullable();
                $table->string('cm_phone')->nullable();

                $table->string('cm_subject')->nullable();
                $table->text('cm_message')->nullable();

                $table->string('cm_company')->nullable();
                $table->string('cm_city')->nullable();

                // Related Service
                $table->unsignedBigInteger('service_id')->nullable();

                // Source
                $table->enum('cm_source', [
                    'website',
                    'phone',
                    'email',
                    'social',
                    'referral',
                    'other'
                ])->default('website');

                // Priority
                $table->enum('cm_priority', [
                    'low',
                    'medium',
                    'high',
                    'urgent'
                ])->default('medium');

                // Status
                $table->enum('cm_status', [
                    'new',
                    'read',
                    'contacted',
                    'resolved',
                    'closed'
                ])->default('new');


                // Admin Notes
                $table->text('cm_notes')->nullable();

                $table->unsignedBigInteger('assigned_to')->nullable();

                // Follow Up
                $table->datetime('follow_up_date')->nullable();

                // Tracking
                $table->string('ip_address')->nullable();
                $table->text('user_agent')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->index([
                    'cm_status',
                    'cm_priority',
                    'created_at'
                ]);

            });


        } else {

            Schema::table('contact_messages', function (Blueprint $table) {

                $columns = [

                    'cm_name' => 'string',
                    'cm_email' => 'string',
                    'cm_phone' => 'string',

                    'cm_subject' => 'string',
                    'cm_message' => 'text',

                    'cm_company' => 'string',
                    'cm_city' => 'string',

                    'service_id' => 'unsignedBigInteger',

                    'cm_notes' => 'text',

                    'assigned_to' => 'unsignedBigInteger',

                    'follow_up_date' => 'datetime',

                    'ip_address' => 'string',
                    'user_agent' => 'text',
                ];


                foreach ($columns as $column => $type) {

                    if (!Schema::hasColumn('contact_messages', $column)) {

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

                            case 'datetime':
                                $table->datetime($column)->nullable();
                                break;

                        }
                    }
                }


                if (!Schema::hasColumn('contact_messages', 'cm_source')) {

                    $table->enum('cm_source', [
                        'website',
                        'phone',
                        'email',
                        'social',
                        'referral',
                        'other'
                    ])->default('website');

                }


                if (!Schema::hasColumn('contact_messages', 'cm_priority')) {

                    $table->enum('cm_priority', [
                        'low',
                        'medium',
                        'high',
                        'urgent'
                    ])->default('medium');

                }


                if (!Schema::hasColumn('contact_messages', 'cm_status')) {

                    $table->enum('cm_status', [
                        'new',
                        'read',
                        'contacted',
                        'resolved',
                        'closed'
                    ])->default('new');

                }


                if (!Schema::hasColumn('contact_messages', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('contact_messages', 'updated_at')) {
                    $table->timestamp('updated_at')->nullable();
                }

                if (!Schema::hasColumn('contact_messages', 'deleted_at')) {
                    $table->softDeletes();
                }

            });

        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
