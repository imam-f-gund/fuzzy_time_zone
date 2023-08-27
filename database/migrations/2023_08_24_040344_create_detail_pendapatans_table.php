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
        Schema::create('detail_pendapatans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pendapatan_id')->unsigned();
            $table->foreign('pendapatan_id')->references('id')->on('pendapatans')->onDelete('cascade')->onUpdate('cascade');
            $table->string('ukuran')->nullable();
            $table->string('warna')->nullable();
            $table->string('penjualan')->nullable();
            $table->string('jenis_kaos')->nullable();
            $table->string('pendapatan')->nullable();
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
        Schema::dropIfExists('detail_pendapatans');
    }
};
