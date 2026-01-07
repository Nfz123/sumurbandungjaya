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
        Schema::create('ekspedisi_detail', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('ekspedisi_id');
        $table->string('tujuan');
        $table->integer('qty_terima');
        $table->integer('qty_tolak');
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
        Schema::dropIfExists('ekspedisidetail');
    }
};
