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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date')->nullable();
            $table->foreignId('ref_slot_id')->nullable();
            $table->text('description')->nullable();
            $table->string('document')->nullable();
            $table->foreignId('ref_location_id')->nullable();
            $table->foreignId('managed_by')->nullable();
            $table->foreignId('sp_id')->nullable();
            $table->foreignId('app_id')->nullable();
            $table->foreignId('cons_id')->nullable();
            $table->foreignId('ref_status_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
