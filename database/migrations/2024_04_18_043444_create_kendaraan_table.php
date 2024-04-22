<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id('id_kendaraan');
            $table->string('plat_kendaraan')->unique();
            $table->string('ruang_parkir');
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar');
            $table->string('status');
            $table->double('biaya');
        });

        Schema::create('ruang_parkir', function (Blueprint $table) {
            $table->id('id_ruang');
            $table->string('nama_ruang');
            $table->string('kode_ruang')->unique();
            $table->string('status');
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
        Schema::dropIfExists('kendaraan');
        Schema::dropIfExists('ruang_parkir');
    }
}
