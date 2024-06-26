<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arsip', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->string('jenis_surat');
            $table->string('asal_surat');
            $table->integer('tanggal');
            $table->string('bulan');
            $table->integer('tahun');
            $table->string('uraian_informasi');
            $table->integer('nomor_urut_perbulan');
            $table->string('nomor_dokumen');
            $table->integer('jumlah')->nullable();
            $table->string('tingkat_perkembangan')->nullable();
            $table->string('jenis_media')->nullable();
            $table->string('media')->nullable();
            $table->string('disposisi')->nullable();
            $table->string('terusan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arsip');
    }
};
