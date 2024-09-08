<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePenggunaFromArsipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('arsip', function (Blueprint $table) {
            // Menghapus kolom 'pengguna' dari tabel arsip
            if (Schema::hasColumn('arsip', 'pengguna', 'pengadaan')) {
                $table->dropColumn('pengguna');
                $table->dropColumn('id_pengadaan');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('arsip', function (Blueprint $table) {
            // Menambahkan kembali kolom 'pengguna' jika dilakukan rollback
            $table->string('pengguna')->nullable();
        });
    }
}
