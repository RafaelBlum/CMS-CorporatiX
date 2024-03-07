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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()
                ->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('bairro')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('cep')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
