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
        //
        Schema::create('nota_dinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('arsip_id')->constrained('arsip')->onDelete('cascade');
            $table->string('nomor_dokumen')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('perihal')->nullable();
            $table->string('kepada')->nullable();
            $table->string('dari')->nullable();
            $table->text('isi')->nullable();
            $table->string('tembusan')->nullable();
            $table->string('foto')->nullable();

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
        //
        Schema::dropIfExists('nota_dinas');
    }
};
