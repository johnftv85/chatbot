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
        Schema::create('transactional_order', function (Blueprint $table) {
            $table->id();
            $table->string('status', 1);
            $table->text('message')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('cellphone', 15)->nullable();
            $table->string('transaction_code', 100);
            $table->string('attachment')->nullable();
            $table->timestamp('schedule')->nullable();
            $table->boolean('chatgpt')->default(0);
            $table->string('wam_message_id')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('location_name')->nullable();
            $table->string('location_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactional_order');
    }
};
