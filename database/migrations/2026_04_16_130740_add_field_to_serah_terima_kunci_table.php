<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('serah_terima_kunci', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('blok');
            $table->date('tanggal_serah_terima');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('serah_terima_kunci');
    }
};