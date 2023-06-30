<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class m_surat extends Model
{
    use HasFactory;

    public function allData()
    {
        return DB::table('surat')->join('users', 'surat.id_subcon', '=', 'users.id')->get();
    }

    public function detailSurat($no_surat)
    {
        return DB::table('surat')->join('users', 'surat.id_subcon', '=', 'users.id')->join('users_detail', 'users.id', '=', 'users_detail.id_user')->first();
    }

    public function detailSuratInSubcon($no_surat)
    {
        return DB::table('surat')->join('users', 'surat.id_tujuan', '=', 'users.id')->join('users_detail', 'users.id', '=', 'users_detail.id_user')->first();
    }


    public function addData($data)
    {
        DB::table('surat')->insert($data);
    }

    public function editData($no_surat, $data)
    {
        return DB::table('surat')->where('no_surat', $no_surat)->update($data);
    }

    public function checkID()
    {
        return DB::table('surat')->count();
    }

    public function maxIditem()
    {
        return DB::table('surat')->max('no_surat');
    }


    public function mySurat_Subcon($id)
    {
        return DB::table('surat')->join('users', 'surat.id_subcon', '=', 'users.id')->where('id_subcon', $id)->get();
    }


    // model surat dari supplier ke subcon
    public function mySuratSup_Subcon($id)
    {
        return DB::table('surat_supplier')->join('users', 'surat_supplier.id_tujuan', '=', 'users.id')->where('id_tujuan', $id)->get();
    }
    public function editStatusSuratSup($no_surat, $data)
    {
        return DB::table('surat_supplier')->where('no_surat', $no_surat)->update($data);
    }
    public function detailSurat_sup($no_surat)
    {
        return DB::table('surat_supplier')->join('users', 'surat_supplier.id_tujuan', '=', 'users.id')->join('users_detail', 'users.id', '=', 'users_detail.id_user')->first();
    }
    public function detailSurat_supInSubcon($no_surat)
    {
        return DB::table('surat_supplier')->join('users', 'surat_supplier.id_tujuan', '=', 'users.id')->join('users_detail', 'users.id', '=', 'users_detail.id_user')->first();
    }
    //END model surat dari supplier ke subcon



    public function mySurat_supplier($id)
    {
        return DB::table('surat_supplier')->join('users', 'surat_supplier.id_pengirim', '=', 'users.id')->where('id_pengirim', $id)->get();
    }

    public function download($no)
    {
        return DB::table('surat')->join('users', 'surat.id_tujuan', '=', 'users.id')->join('users_detail', 'users.id', '=', 'users_detail.id_user')->where('no_surat', $no)->first();
    }

    public function deleteData($no)
    {
        return DB::table('surat')->where('no_surat', $no)->delete();
    }

    //table surat do suppsubcon
    public function addDo($data)
    {
        DB::table('surat_supplier')->insert($data);
    }



    //   Kondisi Ketika User dihapus dan User masih punya surat, maka surat akan dijadikan Log
    public function jadiLOG($id, $data)
    {
        return DB::table('surat')->where('id_subcon', $id)->update($data);
    }
    public function checkIDdo()
    {
        return DB::table('surat_supplier')->count();
    }

    public function maxIditemdo()
    {
        return DB::table('surat_supplier')->max('no_surat');
    }


    // END Kondisi
}
