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
            $table->text('uraian_informasi')->nullable();
            $table->string('asal_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->integer('nomor_urut_perbulan')->nullable();
            $table->string('nomor_dokumen')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('tingkat_perkembangan')->nullable();
            $table->enum('keterangan', ['Surat Masuk', 'Surat Keluar']);
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
