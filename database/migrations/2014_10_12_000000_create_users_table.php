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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('role_id');
            $table->boolean('status')->default(false);
            $table->timestamp('last_acess')->nullable();
            $table->timestamp('birth')->nullable();
            $table->longText('bio')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('academic_education')->nullable();
            $table->string('phone')->nullable();
            $table->string('branch_line')->nullable();
            $table->string('avatar')->default('/storage/default.jpg');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
