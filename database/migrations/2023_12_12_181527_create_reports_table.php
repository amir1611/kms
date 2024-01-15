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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kiosk_id');
            $table->dateTime('report_month');
            $table->double('report_monthly_revenue', 8, 2);
            $table->integer('report_operating_hour');
            $table->mediumText('report_remark');
            $table->binary('report_pdf');
            $table->string('report_status');
            $table->mediumText('report_suggestion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
