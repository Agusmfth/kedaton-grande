<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('serah_terima_kunci', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->onDelete('cascade');
            $table->text('keterangan')->nullable()->after('tanggal_serah_terima');
        });
    }

    public function down(): void
    {
        Schema::table('serah_terima_kunci', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn('keterangan');
        });
    }
};
