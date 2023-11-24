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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spouse_id')->nullable();
            $table->foreignId('applicant_id')->nullable();
            $table->foreignId('witness_id')->nullable();
            $table->foreignId('incentive_id')->nullable();
            $table->foreignId('staff_id')->nullable();
            $table->foreignId('wali_id')->nullable();
            $table->date('wed_date')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
