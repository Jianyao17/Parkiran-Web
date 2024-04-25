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
            $table->string('ruang_parkir')->nullable();
            $table->dateTime('waktu_masuk')->nullable();
            $table->dateTime('waktu_keluar')->nullable();
            $table->string('status')->default('none');
            $table->double('biaya')->default(0.0);
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
