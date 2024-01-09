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
            $table->id('payment_id'); 
            $table->foreignId('kiosk_id')->constrained('kiosks');
            $table->foreignId('user_id')->constrained('users');
            $table->string('payment_type');
            $table->double('payment_amount');
            $table->binary('payment_receipt');
            $table->string('payment_status');
            $table->date('payment_date');
            $table->string('payment_comment')->nullable();
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

