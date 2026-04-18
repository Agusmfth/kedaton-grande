<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('serah_terima_kunci', 'nama')) {
            Schema::table('serah_terima_kunci', function (Blueprint $table) {
                $table->dropColumn('nama');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('serah_terima_kunci', 'nama')) {
            Schema::table('serah_terima_kunci', function (Blueprint $table) {
                $table->string('nama')->nullable();
            });
        }
    }
};
