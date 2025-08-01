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
        Schema::table('arsip_konten', function (Blueprint $table) {
            $table->unsignedInteger('like')->nullable()->after('jam');   // atau after kolom terakhir lainnya
            $table->unsignedInteger('view')->nullable()->after('like');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arsip_konten', function (Blueprint $table) {
            $table->dropColumn(['like', 'view']);
        });
    }
};
