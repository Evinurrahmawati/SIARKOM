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
            $table->id(); // Primary key
            $table->string('name'); // Nama user
            $table->string('email')->unique(); // Email harus unik
            $table->timestamp('email_verified_at')->nullable(); // Untuk verifikasi email (opsional)
            $table->string('password'); // Password yang di-hash
            $table->string('role')->default('operator'); // admin / operator
            $table->rememberToken(); // Untuk fitur "remember me"
            $table->timestamps(); // created_at & updated_at
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
