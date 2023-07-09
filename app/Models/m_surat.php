<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class m_surat extends Model
{
    use HasFactory;
    // tampil surat dari subcon di hki
    public function suratdarisub($nama)
    {
        return DB::table('surat')->join('users', 'surat.penerima', '=', 'users.nama')->where('penerima', $nama)->get();
    }
    // end tampil surat dari subcon di hki

    // buat tampilan read surat
    public function headSurat($no_surat)
    {
        return DB::table('surat')->where('no_surat',$no_surat)->first();
    }
    public function detailSurat($no_surat)
    {
        return DB::table('surat_details')->where('no_surat',$no_surat)->get();
    }
    
    public function detailPengirim($no_surat)
    {
        return DB::table('surat')->join('users', 'surat.pengirim','=','users.nama')->join('users_detail', 'users.id', '=', 'users_detail.id_user')->where('surat.no_surat',$no_surat)->first();
    }
    // end tampilan read surat

    protected $table = 'surat';
    public $timestamps = false;
    protected $fillable = [
        'po_number',
        'pengirim',
        'penerima',
        'tanggal',
    ];
    protected $primaryKey = 'no_surat';
    public $incrementing = false;
    protected $keyType = 'string';

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


    public function mySurat_Subcon($nama)
    {
        return DB::table('surat')->where('pengirim', $nama)->get();
    }


    // model surat dari supplier ke subcon
    public function mySuratSup_Subcon($nama)
    {
        return DB::table('surat')->where('penerima', $nama)->get();
    }
    public function editStatusSuratSup($no_surat, $data)
    {
        return DB::table('surat')->where('no_surat', $no_surat)->update($data);
    }
   
    //END model surat dari supplier ke subcon



    public function mySurat_supplier($nama)
    {
        return DB::table('surat')->where('pengirim', $nama)->get();
    }

    public function download($no)
    {
        return DB::table('surat')->join('users', 'surat.id_tujuan', '=', 'users.id')->join('users_detail', 'users.id', '=', 'users_detail.id_user')->where('no_surat', $no)->first();
    }

    public function deleteData($no)
    {
        return DB::table('surat')->where('no_surat', $no)->delete();
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
