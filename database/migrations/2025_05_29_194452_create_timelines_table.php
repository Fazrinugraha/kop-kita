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
        Schema::create('sejarahs', function (Blueprint $table) {
            $table->id();
            $table->year('tahun'); // Sesuai dengan penggunaan di controller
            $table->string('judul'); // Tambahkan ini
            $table->text('deskripsi'); // Rename dari 'description' supaya sesuai
            $table->string('file_gambar')->nullable(); // Tambah ini untuk upload gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sejarahs');
    }
};
