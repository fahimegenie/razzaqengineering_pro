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
        Schema::create('contact_address', function (Blueprint $table) {
            $table->id();
            $table->string('ca_address');
            $table->string('ca_email');
            $table->string('ca_phone');
            $table->string('footer_phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('office_hours')->nullable();
            $table->string('google_map')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_address');
    }
};
