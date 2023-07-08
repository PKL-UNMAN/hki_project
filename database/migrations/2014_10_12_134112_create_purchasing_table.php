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
            $table->id('id_po');
            $table->integer('po_number');
            $table->integer('id_tujuan_po');
            $table->unsignedBigInteger('default_supplier_id')->nullable();
            $table->string('class', 30);
            $table->string('issue_date', 30);
            $table->string('currency_code', 20);
            $table->integer('id_destination');
            $table->dateTime('delivery_time');
            $table->string('status')->nullable();
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
