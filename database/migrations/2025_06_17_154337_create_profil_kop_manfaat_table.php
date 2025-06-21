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
        Schema::create('profil_kop_manfaat', function (Blueprint $table) {
            $table->bigIncrements('id_manfaat');
            $table->string('judul'); // Contoh: Menekan Pergerakan Tengkulak
            $table->text('deskripsi')->nullable(); // Penjelasan jika ada
            $table->string('img')->nullable(); // Path/URL gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_kop_manfaat');
    }
};
