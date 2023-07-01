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
        Schema::create('users_detail', function (Blueprint $table) {
            $table->bigIncrements('id_detail')->unsigned()->autoIncrement();
            $table->string('id_user')->nullable();
            $table->integer('id_perusahaan');
            $table->string('class');
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('fax')->nullable();
            $table->string('alamat')->nullable();
            $table->string('user_date')->nullable();
            
        });

    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Hapus kunci utama pada kolom 'id_detail'
        Schema::table('users_detail', function (Blueprint $table) {
            $table->dropPrimary('users_detail_id_detail_primary');
        });

        Schema::dropIfExists('users_detail');
    }
};
