<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

// seed user hki
        DB::table('users')->insert([
            'username' => 'hki',
            'nama' => 'Admin hki',
            'role_id' => 1,
            'password' => Hash::make('12345678'),
        ]);

        
        DB::table('users_detail')->insert([
            'id_detail' => '1',
            'id_user' => '1',
            'id_perusahaan' => '1',
            'class' => '',
            'email' => 'hki@gmail.com',
            'telepon'=> '021 88888',
            'fax' => '021 88888',
            'alamat' => 'Subang',
            'user_date' => '30-05-2023',
        ]);

// seed user subcon


        DB::table('users')->insert([
            'username' => 'subcon_bdg',
            'nama' => 'Subcon Bandung',
            'role_id' => 2,
            'password' => Hash::make('123456'),
        ]);

        DB::table('users_detail')->insert([
            'id_detail' => '2',
            'id_user' => '2',
            'id_perusahaan' => '2',
            'class' => '',
            'email' => 'subconbdg@gmail.com',
            'telepon'=> '021 88888',
            'fax' => '021 88888',
            'alamat' => 'Subang',
            'user_date' => '30-05-2023',
        ]);

        DB::table('users')->insert([
            'username' => 'subcon_sbg',
            'nama' => 'Subcon Subang',
            'role_id' => 2,
            'password' => Hash::make('123456'),
        ]);

        DB::table('users_detail')->insert([
            'id_detail' => '3',
            'id_user' => '3',
            'id_perusahaan' => '3',
            'class' => '',
            'email' => 'subconsub@gmail.com',
            'telepon'=> '021 88888',
            'fax' => '021 88888',
            'alamat' => 'Subang',
            'user_date' => '30-05-2023',
        ]);

        
        DB::table('users')->insert([
            'username' => 'supplier_bdg',
            'nama' => 'Supplier Bandung',
            'role_id' => 3,
            'password' => Hash::make('12345678'),
        ]);

        DB::table('users_detail')->insert([
            'id_detail' => '4',
            'id_user' => '4',
            'id_perusahaan' => '4',
            'class' => '',
            'email' => 'suppbdg@gmail.com',
            'telepon'=> '021 88888',
            'fax' => '021 88888',
            'alamat' => 'Subang',
            'user_date' => '30-05-2023',
        ]);

        DB::table('users')->insert([
            'username' => 'supplier_sbg',
            'nama' => 'Supplier Subang',
            'role_id' => 3,
            'password' => Hash::make('12345678'),
        ]);

        DB::table('users_detail')->insert([
            'id_detail' => '5',
            'id_user' => '5',
            'id_perusahaan' => '5',
            'class' => '',
            'email' => 'suppsub@gmail.com',
            'telepon'=> '021 88888',
            'fax' => '021 88888',
            'alamat' => 'Subang',
            'user_date' => '30-05-2023',
        ]);





        DB::table('role')->insert([
            'role_id' => '1',
            'role_name' => 'HKI',
        ]);
        
        DB::table('role')->insert([
            'role_id' => '2',
            'role_name' => 'Subcon',
        ]);

        DB::table('role')->insert([
            'role_id' => '3',
            'role_name' => 'Supplier',
        ]);






      
    }
}
