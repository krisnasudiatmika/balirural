<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beverage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_item');
            $table->integer('jumlah');
            $table->integer('harga_total');
            $table->integer('diskon');
            $table->integer('summary_price');
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
        Schema::dropIfExists('beverage');
    }
}
