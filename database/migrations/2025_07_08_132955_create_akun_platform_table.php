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
        Schema::create('akun_platform', function (Blueprint $table) {
            $table->id('id_akun'); // Primary Key
            $table->unsignedBigInteger('id_platform'); // Foreign Key
            $table->string('nama_akun', 100);
            $table->timestamps();

            // Relasi FK ke tabel platform
            $table->foreign('id_platform')->references('id_platform')->on('platform')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_platform');
    }
};
