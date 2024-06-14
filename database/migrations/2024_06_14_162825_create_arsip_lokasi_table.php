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
        Schema::create('arsip_lokasi', function (Blueprint $table) {
            $table->foreignId('id_arsip')->constrained('arsip')->onDelete('cascade');
            $table->foreignId('id_lokasi')->constrained('lokasi_simpan')->onDelete('cascade');
            $table->timestamps();

            $table->primary(['id_arsip', 'id_lokasi']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arsip_lokasi');
    }
};
