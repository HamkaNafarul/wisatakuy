<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekWisatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_wisatas', function (Blueprint $table) {
            $table->id('id_objek_wisata');
            $table->string('nama');
            $table->text('alamat');
            $table->unsignedBigInteger('kecamatan');
            $table->foreign('kecamatan')->references('id_kecamatan')->on('kecamatans');
            $table->unsignedBigInteger('jenis_wisata');
            $table->foreign('jenis_wisata')->references('id_jenis_wisata')->on('jenis_wisatas');
            $table->longText('deskripsi')->nullable();
            $table->text('latitude_Y');
            $table->text('longitude_X');
            $table->integer('harga');
            $table->unsignedBigInteger('id_gambar');
            $table->foreign('id_gambar')->references('id_gambar_objek')->on('gambar_objeks');
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
        Schema::dropIfExists('objek_wisatas');
    }
}
