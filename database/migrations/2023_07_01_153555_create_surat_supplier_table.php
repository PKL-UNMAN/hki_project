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
            $table->string('part_no');
            $table->string('id_supplier')->nullable();
            $table->string('id_tujuan')->nullable();
            $table->string('part_name');
            $table->integer('order_qty');
            $table->integer('weight');
            $table->string('order_no');
            $table->string('po_number');
            $table->string('payment');
            $table->string('dibuat');
            $table->string('delivery_time');
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
