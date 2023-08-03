<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiDetilsTable extends Migration
{
    public function up()
    {
        Schema::create('transaksi_detils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id');
            $table->string('barang');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi_detils');
    }
}
