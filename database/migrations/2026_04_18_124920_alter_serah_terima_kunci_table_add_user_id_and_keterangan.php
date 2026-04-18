<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kolom user_id dan keterangan sudah ditambahkan oleh migration
        // 2026_04_18_124813_add_user_id_and_keterangan_to_serah_terima_kunci_table.
    }

    public function down(): void
    {
        // Tidak ada perubahan skema dari migration ini.
    }
};
