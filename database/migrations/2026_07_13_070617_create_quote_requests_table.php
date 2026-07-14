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
        if (!Schema::hasTable('quote_requests')) {
            Schema::create('quote_requests', function (Blueprint $table) {
                $table->id();
                $table->string('qr_name');
                $table->string('qr_email');
                $table->string('qr_phone');
                $table->string('qr_company')->nullable();
                $table->string('qr_service_type');
                $table->string('qr_location');
                $table->text('qr_details');
                $table->string('qr_budget')->nullable();
                $table->string('qr_timeline')->nullable();
                $table->string('qr_source')->default('website');
                $table->string('qr_attachment')->nullable();
                $table->enum('qr_status', ['pending', 'contacted', 'completed', 'cancelled'])->default('pending');
                $table->text('qr_admin_notes')->nullable();
                $table->string('qr_ip')->nullable();
                $table->text('qr_user_agent')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};
