<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewToProfilKopKarirTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profil_kop_karir', function (Blueprint $table) {
            $table->unsignedInteger('view')->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_kop_karir', function (Blueprint $table) {
            $table->dropColumn('view');
        });
    }
}
