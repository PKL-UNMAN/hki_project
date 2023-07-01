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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->autoIncrement();
            $table->string('username')->unique();
            $table->string('nama');
            $table->string('role_id');
            $table->string('password');
            $table->string('created_at')->nullable();
           
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Hapus kunci utama pada kolom 'id'
        Schema::table('users', function (Blueprint $table) {
            $table->dropPrimary('users_id_primary');
        });

        // Hapus kunci unik pada kolom 'username'
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_username_unique');
        });

        Schema::dropIfExists('users');
    }
};
