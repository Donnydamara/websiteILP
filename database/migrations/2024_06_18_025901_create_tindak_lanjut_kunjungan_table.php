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
        Schema::create('tindak_lanjut_kunjungan', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('posyandu');
            $table->timestamp('waktu');
            $table->string('nama');
            $table->string('nik');
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->string('no_telepon'); // Corrected this line
            $table->string('masalah_kesehatan_yang_ditemukan');
            $table->string('tindak_lanjut');
            $table->string('edukasi');
            $table->string('lapor_nakes');
            $table->integer('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjut_kunjungan');
    }
};
