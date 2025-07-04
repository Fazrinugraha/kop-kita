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
        Schema::create('profil_kop_dokumentasi_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokumentasi_id')->constrained('profil_kop_dokumentasi')->onDelete('cascade');
            $table->enum('jenis_media', ['foto', 'video']);
            $table->string('media_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_kop_dokumentasi_media');
    }
};
