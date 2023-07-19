<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class m_user extends Model
{
    public function allData()
    {
        return DB::table('users')->join('users_detail', 'users.id','=','users_detail.id_user')->join('role', 'users.role_id','=','role.role_id')->get();
    }

    public function addData($data)
    {
        DB::table('users')->insert($data);
    }
    

    public function detailData($id)
    {
        return DB::table('users')->join('users_detail', 'users.id','=', 'users_detail.id_user')->where('users.id', $id)->first();
    }
    public function editData($id, $data)
    {
        return DB::table('users')->where('id', $id)->update($data);
    }

    public function edit($id)
    {
        return DB::table('users_detail')->join('users', 'users_detail.id_user','=', 'users.id')->where('id_user', $id)->first();
    }

    public function updateData($id, $data,$table,$key)
    {
        return DB::table($table)->where($key, $id)->update($data);
    }

    public function deleteData($id)
    {
        return DB::table('users')->where('id', $id)->delete();
    }

    
    public function hkiData()
    {
        return DB::table('users')->where('role_id', '1')->get();
    }

    public function detailHKI()
    {
        return DB::table('users')->join('users_detail','users.id','=','users_detail.id_user')->where('role_id', '1')->first();
    }


    public function subconData()
    {
        return DB::table('users')->where('role_id', '2')->get();
    }

    public function subconDataById($id)
    {
        return DB::table('users')->where('id', $id)->orWhere('id',NULL)->first();
    }


  
    public function supplierData()
    {
        return DB::table('users')->where('role_id', '3')->get();
    }

    public function supplierDataById($id)
    {
        return DB::table('users')->where('id', $id)->orWhere('id',NULL)->first();
    }


    public function checkID()
    {
        return DB::table('users')->count();
    }

    public function maxIditem()
    {
        return DB::table('users')->max('id');
    }


    // user detail
    public function detail_ADD($detail)
    {
        DB::table('users_detail')->insert($detail);
    }

    public function detail_EDIT($id, $detail)
    {
        return DB::table('users_detail')->where('id_user', $id)->update($detail);
    }

    public function detail_DELETE($id)
    {
        return DB::table('users_detail')->where('id_user', $id)->delete();
    }
}
