<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsahaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usaha', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('jenis_usaha_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama');
            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();
            $table->text('alamat');
            $table->string('foto')->nullable();
            $table->geometry('geom');
            $table->text('barang_jasa');
            $table->text('ket');
            $table->integer('status')->default(1);
            $table->string('pengusul');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('jenis_usaha_id')->references('id')->on('jenis_usaha');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usaha');
    }
}
