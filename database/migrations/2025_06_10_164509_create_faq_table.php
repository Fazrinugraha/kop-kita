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
        Schema::create('profil_kop_faq', function (Blueprint $table) {
            $table->id();
            $table->string('question'); // Pertanyaan
            $table->text('answer'); // Jawaban
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status untuk menandakan apakah FAQ aktif atau tidak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_kop_faq');
    }
};
