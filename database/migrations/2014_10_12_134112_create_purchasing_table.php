<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasing', function (Blueprint $table) {
            $table->increments('id_po');
            $table->string('part_no', 255);
            $table->unsignedBigInteger('default_supplier_id')->nullable();
            $table->string('part_name', 255);
            $table->integer('order_qty');
            $table->string('unit', 50);
            $table->string('class', 30);
            $table->string('po_number', 255);
            $table->integer('unit_price');
            $table->integer('amount');
            $table->string('currency_code', 20);
            $table->dateTime('delivery_time');
            $table->string('issue_date', 30);
            $table->string('order_number', 128);
            $table->string('composition', 128);
            $table->integer('id_tujuan');
            $table->integer('id_destination');
            $table->string('status')->nullable();
        
            $table->foreign('default_supplier_id')->references('id')->on('users');
        });
     
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchasing');
    }

};
