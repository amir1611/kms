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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kiosk_id')->constrained('kiosks');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('application_id')->constrained('applications');
            $table->string('payment_type');
            $table->double('payment_amount');
            $table->binary('payment_receipt');
            $table->string('payment_status');
            $table->dateTime('payment_date');
            $table->text('payment_comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
