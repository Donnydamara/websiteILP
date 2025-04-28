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
        Schema::create('lingkungan_rumah', function (Blueprint $table) {
            $table->id();
            $table->integer('kk')->nullable();
            $table->string('nama')->nullable();
            $table->integer('AK_total')->nullable();
            $table->integer('AK_lansia')->nullable();
            $table->integer('jumlah_AK_dewasa')->nullable();
            $table->integer('AK_remaja')->nullable();
            $table->integer('AK_balita')->nullable();
            $table->integer('AK_bayi')->nullable();
            $table->integer('AK_ibu_bersalin_nifas')->nullable();
            $table->integer('AK_ibu_hamil')->nullable();
            $table->string('jkn_jamkesda')->nullable();
            $table->string('sarana_air')->nullable();
            $table->string('jenis_sumber_air')->nullable();
            $table->string('jamban')->nullable();
            $table->string('jenis_jamban')->nullable();
            $table->string('ventilasi')->nullable();
            $table->string('mengalami_gangguan_jiwa')->nullable();
            $table->string('TBC_hipertensi_millitus')->nullable();
            $table->integer('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lingkungan_rumah');
    }
};
