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
            $table->id('application_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('business_name'); 
            $table->string('business_role');
            $table->string('business_category');
            $table->string('business_information');
            $table->string('business_operating_hour');
            $table->date('business_start_date');
            $table->binary('ssm_pdf');
            $table->binary('business_proposal_pdf');
            $table->string('application_status');
            $table->string('application_comment')->nullable(); 
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
