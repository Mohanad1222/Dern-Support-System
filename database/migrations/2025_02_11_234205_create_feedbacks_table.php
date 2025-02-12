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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->foreignId('request_id')->constrained('user_requests', 'request_id')->cascadeOnDelete()->primary();
            $table->integer('feedback_rate');
            $table->string('feedback_text');
            $table->enum('feedback_status', ['not given', 'given']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
