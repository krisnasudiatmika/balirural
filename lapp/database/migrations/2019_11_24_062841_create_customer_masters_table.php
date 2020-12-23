<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_customer');
            $table->enum('jenis', ['bce', 'vt', 'rbc', 'bd', 'bpb', 'lwn', 'hbw', 'guliang', 'put', 'rajalaya', 'bvd', 'nm']);
            $table->enum('kategori', ['standar_a', 'standar_d']);
            $table->integer('hrg_publish');
            $table->integer('hrg_contract');
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
        Schema::dropIfExists('customer_masters');
    }
}
