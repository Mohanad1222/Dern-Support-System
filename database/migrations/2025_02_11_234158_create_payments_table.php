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
            $table->foreignId('request_id')->constrained('user_requests', 'request_id')->cascadeOnDelete()->primary();
            $table->decimal('payment_amount', 10, 2);
            $table->enum('payment_method', ['cash', 'visa', 'mastercard', 'paypal', 'bank transfer']);
            $table->enum('payment_status', ['awaiting payment', 'payment received']);
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
