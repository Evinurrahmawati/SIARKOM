<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('arsip_konten', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->unsignedBigInteger('id_platform');
            $table->unsignedBigInteger('id_akun');

            // Data Konten
            $table->string('judul');
            $table->date('tanggal');
            $table->time('jam');
            $table->text('gambar')->nullable();

            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('id_platform')
                ->references('id_platform')->on('platform')
                ->onDelete('cascade');

            $table->foreign('id_akun')
                ->references('id_akun')->on('akun_platform')
                ->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('arsip_konten');
    }
};
