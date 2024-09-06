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
       Schema::create('dokumentasi', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('procurement_id'); // Foreign key ke tabel arsip
        $table->unsignedBigInteger('user_id');  // Foreign key ke tabel users
        $table->string('title')->nullabe();
        $table->date('tanggal')->nullabe();
        $table->string('deskripsi')->nullabe();
        $table->string('foto')->nullable();
        $table->timestamps();

        // Jika menggunakan foreign key constraint
        $table->foreign('procurement_id')->references('id')->on('procurements')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('dokumentasi');
    }
};
