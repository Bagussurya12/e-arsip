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
        Schema::create('procurements', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->integer('tanggal');
                $table->string('bulan');
                $table->integer('tahun');
                $table->string('division');
                $table->string('procurement_number')->unique(); // Nomor pengadaan unik
                $table->string('status')->default('Pending'); // Status pengadaan
                $table->text('remarks')->nullable(); // Catatan tambahan
                $table->timestamps(); // created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procurements');
    }
};
