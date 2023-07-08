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
        Schema::create('surat', function (Blueprint $table) {
            $table->bigIncrements('no_surat');
            $table->unsignedBigInteger('po_number');
            $table->string('pengirim', 255);
            $table->string('penerima', 255);
            $table->string('tanggal', 255);
            $table->string('status', 255);
            
        });
        Schema::create('surat_details', function (Blueprint $table) {
            $table->bigIncrements('no_surat');
            $table->string('part_no', 255);
            $table->string('part_name', 255);
            $table->string('qty', 255);
            $table->string('unit', 255);
            $table->foreign('no_surat')->references('no_surat')->on('surat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat');
    }
};
