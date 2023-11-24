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
        Schema::create('incentives', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->String('applicant_name')->nullable();
            $table->string('job')->nullable();
            $table->string('job_type')->nullable();
            $table->double('salary')->nullable();
            $table->date('date')->nullable();
            $table->string('status')->nullable();
            $table->string('heir')->nullable();
            $table->binary('docs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incentives');
    }
};
