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
        Schema::create('profil_kop_visi_misis', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['Visi', 'Misi']); // Jenis data: Visi atau Misi
            $table->text('isi');                      // Isi kontennya
            $table->integer('urutan')->default(0);    // Urutan tampilan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_kop_visi_misis');
    }
};
