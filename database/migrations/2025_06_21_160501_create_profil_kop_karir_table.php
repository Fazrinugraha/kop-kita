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
        Schema::create('profil_kop_karir', function (Blueprint $table) {
            $table->id('id_karir'); // id custom dengan nama 'id_karir'
            $table->string('judul_posisi'); // contoh: Credit Collection Officer
            $table->string('divisi');       // contoh: Operational & Support Division
            $table->text('penempatan');     // Cabang penempatan (comma-separated)
            $table->text('deskripsi');      // Tugas & tanggung jawab
            $table->text('kualifikasi');    // Syarat
            $table->text('benefit')->nullable(); // Benefit
            $table->date('batas_lamar')->nullable();
            $table->unsignedInteger('kuota')->default(0); // kuota pendaftar
            $table->enum('status', ['Aktif', 'Non Aktif'])->default('Aktif'); // status lowongan
            $table->string('dokumen_syarat')->nullable(); // <-- kolom tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_kop_karir');
    }
};
