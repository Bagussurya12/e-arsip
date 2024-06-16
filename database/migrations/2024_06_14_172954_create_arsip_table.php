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
            $table->string('jenis_arsip');
            $table->integer('nomor_urut_perbulan');
            $table->string('nomor_dokumen');
            $table->string('uraian_informasi');
            $table->string('asal_surat');
            $table->date('tanggal_surat');
            $table->integer('jumlah')->nullable();
            $table->string('tingkat_perkembangan');
            $table->string('keterangan');
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
