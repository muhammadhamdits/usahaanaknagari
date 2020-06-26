<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsulanUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_update', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->UnsignedBigInteger('usaha_id');
            $table->UnsignedBigInteger('jenis_usaha_id');
            $table->string('nama')->nullable();
            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();
            $table->text('alamat');
            $table->string('foto')->nullable();
            $table->geometry('geom');
            $table->text('barang_jasa');
            $table->text('ket')->nullable();
            $table->integer('status')->default(1);
            $table->string('pengusul');
            $table->timestamps();

            $table->foreign('usaha_id')->references('id')->on('usaha');
            $table->foreign('jenis_usaha_id')->references('id')->on('jenis_usaha');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usulan_update');
    }
}
