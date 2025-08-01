<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('arsip_konten', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tema')->nullable()->after('id_akun');
            $table->foreign('id_tema')
                  ->references('id_tema') // ✅ disesuaikan
                  ->on('tema_konten')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        // Drop FK secara manual untuk menghindari error jika tidak ada
        Schema::table('arsip_konten', function (Blueprint $table) {
            // Drop FK jika sudah terbentuk
            try {
                $table->dropForeign(['id_tema']);
            } catch (\Exception $e) {
                // Foreign key tidak ada, lewati
            }

            // Drop kolom jika ada
            if (Schema::hasColumn('arsip_konten', 'id_tema')) {
                $table->dropColumn('id_tema');
            }
        });
    }
};
