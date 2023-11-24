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
        Schema::create('consultants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('created_by')->nullable();
            $table->string('IcNum')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('ref_department_id')->nullable();
            $table->foreignId('ref_location_id')->nullable();
            $table->string('phoneNo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultants');
    }
};
