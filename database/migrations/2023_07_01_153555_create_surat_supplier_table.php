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
        Schema::create('surat_supplier', function (Blueprint $table) {
            $table->bigInteger('no_surat')->unsigned()->autoIncrement();
            $table->string('po_number');
            $table->string('id_pengirim')->nullable();
            $table->string('id_tujuan')->nullable();
            $table->string('tanggal');
            $table->string('part_no');
            $table->string('part_name');
            $table->string('qty');
            $table->string('unit');
            $table->string('status')->nullable();
            
        });

        // Tambahkan kunci pada kolom 'po_number'
        Schema::table('surat_supplier', function (Blueprint $table) {
            $table->index('po_number');
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
        Schema::table('surat_supplier', function (Blueprint $table) {
            $table->dropPrimary('surat_supplier_no_surat_primary');
        });

        // Hapus kunci pada kolom 'po_number'
        Schema::table('surat_supplier', function (Blueprint $table) {
            $table->dropIndex('surat_supplier_po_number_index');
        });

        Schema::dropIfExists('surat_supplier');
    }
};
