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
        Schema::create('profil_kop_regulasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_regulasi');  // Nama regulasi
            $table->string('file_dokumen');  // Lokasi atau URL dokumen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_kop_regulasi');
    }
};
