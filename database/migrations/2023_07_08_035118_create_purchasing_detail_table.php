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
        Schema::create('purchasing_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_po');
            $table->string('part_no', 255);
            $table->string('part_name', 255);
            $table->integer('unit_price');
            $table->integer('order_qty');
            $table->string('unit', 50);
            $table->string('composition', 128);
            $table->integer('amount');
            $table->string('order_number', 128);

            $table->foreign('id_po')->references('id_po')->on('purchasing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchasing_details');
    }
};
