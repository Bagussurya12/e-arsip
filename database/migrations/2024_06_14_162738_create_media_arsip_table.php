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
        Schema::create('media_arsip', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_arsip')->constrained('arsip')->onDelete('cascade');
            $table->enum('jenis_media', ['Video', 'Gambar', 'PDF']);
            $table->string('nama_media');
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
        Schema::dropIfExists('media_arsip');
    }
};
