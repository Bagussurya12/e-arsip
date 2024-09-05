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
        Schema::table('arsip', function (Blueprint $table) {
            $table->unsignedBigInteger('procurement_id')->nullable()->after('id'); // Sesuaikan 'existing_column' dengan kolom terakhir di tabel arsip
            $table->unsignedBigInteger('user_id')->nullable()->after('procurement_id');

            // Jika kamu ingin menambahkan foreign key untuk procurement_id dan user_id
            $table->foreign('procurement_id')->references('id')->on('procurements')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
            $table->dropForeign(['procurement_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn('procurement_id');
            $table->dropColumn('user_id');
        });
    }

};
