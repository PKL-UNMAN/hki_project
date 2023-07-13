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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('id_sisa');
            $table->unsignedBigInteger('id_po');
            $table->integer('qty_sub');
            $table->integer('qty_sup');
            $table->integer('comp_sub');
            $table->integer('comp_sup');
            $table->integer('total');
            $table->foreign('id_po')->references('id_po')->on('purchasing')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
