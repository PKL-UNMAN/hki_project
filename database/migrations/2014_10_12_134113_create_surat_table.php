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
            $table->string('part_no', 255)->collation('utf8mb4_unicode_ci');
            $table->string('id_subcon', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('id_tujuan', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('part_name', 255)->collation('utf8mb4_unicode_ci');
            $table->integer('order_qty');
            $table->integer('weight');
            $table->string('order_no', 255)->collation('utf8mb4_unicode_ci');
            $table->string('po_number', 255)->collation('utf8mb4_unicode_ci');
            $table->string('payment', 255)->collation('utf8mb4_unicode_ci');
            $table->string('dibuat', 255)->collation('utf8mb4_unicode_ci');
            $table->string('delivery_time', 255)->collation('utf8mb4_unicode_ci');
            $table->string('status', 255)->nullable()->collation('utf8mb4_unicode_ci');

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
