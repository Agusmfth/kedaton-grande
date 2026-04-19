<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('pengaduan', 'foto_pengaduan')) {
            Schema::table('pengaduan', function (Blueprint $table) {
                $table->string('foto_pengaduan')->nullable()->after('keluhan');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('pengaduan', 'foto_pengaduan')) {
            Schema::table('pengaduan', function (Blueprint $table) {
                $table->dropColumn('foto_pengaduan');
            });
        }
    }
};
