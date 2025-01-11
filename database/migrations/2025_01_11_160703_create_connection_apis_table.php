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
        Schema::create('connections_api', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('endpoint');
            $table->json('body')->nullable();
            $table->string('params')->nullable();
            $table->json('headers')->nullable();
            $table->enum('method', ['GET', 'POST']);
            $table->boolean('state')->default(1);
            $table->string('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connection_apis');
    }
};
