<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('order_id')->unsigned();   
            $table->string('product_name',100);
            $table->integer('qty')->unsigned();
            $table->float('price')->unsigned();

            $table->timestamps();

            // foreign key
            $table->foreign('order_id')->references('id')->on('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()  
    {
        Schema::dropIfExists('order_detail');
    }
}
