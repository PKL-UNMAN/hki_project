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
        Schema::create('surat_details', function (Blueprint $table) {
            $table->unsignedBigInteger('no_surat');
            $table->string('part_no', 225);
            $table->string('part_name', 225);
            $table->string('qty', 225);
            $table->string('unit', 225);
            $table->foreign('no_surat')->references('no_surat')->on('surat')->onDelete('cascade')->onUpdate('cascade');
        });

        // Tambahkan kunci pada kolom 'po_number'
        Schema::table('surat_details', function (Blueprint $table) {
            $table->index('no_surat');
        });

   
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Hapus kunci utama pada kolom 'no_surat'
        Schema::table('surat_details', function (Blueprint $table) {
            $table->dropPrimary('surat_details_no_surat_primary');
        });

        // Hapus kunci pada kolom 'po_number'
        Schema::table('surat_details', function (Blueprint $table) {
            $table->dropIndex('surat_details_no_surat_index');
        });

        Schema::dropIfExists('surat_details');
    }
};
