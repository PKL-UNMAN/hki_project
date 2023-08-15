<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class m_surat extends Model
{
    use HasFactory;
    // dashboard hki
    public function jumlahSurat()
    {
        return DB::table('surat')->count();
    }
    public function suratFinish()
    {
        return DB::table('surat')->where('status', 'Finish')->count();
    }
    public function suratOnProgres()
    {
        return DB::table('surat')->where('status', 'On Progress')->count();
    }
    // end dashboard hki
    // dashboard subcon
    public function jumlahSurat1($nama)
    {
        return DB::table('surat')->where('pengirim', $nama)->count();
    }
    public function suratFinish1($nama)
    {
        return DB::table('surat')->where('pengirim', $nama)->where('status', 'Finish')->count();
    }
    public function suratOnProgres1($nama)
    {
        return DB::table('surat')->where('pengirim', $nama)->where('status', 'On Progress')->count();
    }
    // end
    // dashboard supplier

    // end
    // tampil surat dari subcon di hki
    public function suratdarisub($nama)
    {
        return DB::table('surat')->where('penerima', $nama)->get();
    }
    // end tampil surat dari subcon di hki

    public function monitorSurat(){
        return DB::table('surat')->join('users', 'surat.pengirim', '=', 'users.nama')->where('role_id','3')->get();
    }

    // buat tampilan read surat
    public function headSurat($id)
    {
        return DB::table('surat')->where('id',$id)->first();
    }
    public function headSurat2($no)
    {
        return DB::table('surat')->where('no_surat',$no)->first();
    }
    public function alamattujuan($id)
    {
        return DB::table('surat')->join('users', 'surat.penerima','=','users.nama')->join('users_detail', 'users.id', '=', 'users_detail.id_user')->where('surat.id',$id)->first();
    }
    public function detailSurat($id)
    {
        return DB::table('surat')->join('surat_details', 'surat.no_surat','=','surat_details.no_surat')->join('stocks', 'stocks.order_number','=','surat_details.order_number')->where('id',$id)->get();
    }
    public function detailSurat2($id)
    {
        return DB::table('surat')->join('surat_details', 'surat.no_surat','=','surat_details.no_surat')->where('id',$id)->get();
    }
    public function detailSurat3($no)
    {
        return DB::table('surat')->join('surat_details', 'surat.no_surat','=','surat_details.no_surat')->where('surat.no_surat',$no)->get();
    }
    public function detailPengirim($id)
    {
        return DB::table('surat')->join('users', 'surat.pengirim','=','users.nama')->join('users_detail', 'users.id', '=', 'users_detail.id_user')->where('surat.id',$id)->first();
    }
    public function detailPengirim2($no)
    {
        return DB::table('surat')->join('users', 'surat.pengirim','=','users.nama')->join('users_detail', 'users.id', '=', 'users_detail.id_user')->where('surat.no_surat',$no)->first();
    }
    // end tampilan read surat

    protected $table = 'surat';
    public $timestamps = false;
    protected $fillable = [
        'po_number',
        'pengirim',
        'penerima',
        'tanggal',
        'no_surat',
        'id',
        'status',
        'tanggal_terbit',
    ];
    protected $primaryKey = 'no_surat';
    public $incrementing = false;
    protected $keyType = 'string';

    public function editData($id, $data)
    {
        return DB::table('surat')->where('id', $id)->update($data);
    }

    public function checkID()
    {
        return DB::table('surat')->count();
    }

    public function maxIditem()
    {
        return DB::table('surat')->max('id');
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
    public function editStatusSuratSup($id, $data)
    {
        return DB::table('surat')->where('id', $id)->update($data);
    }
   
    //END model surat dari supplier ke subcon



    public function mySurat_supplier($nama)
    {
        return DB::table('surat')->where('pengirim', $nama)->get();
    }

    public function download($no)
    {
        return DB::table('surat')->join('users', 'surat.penerima', '=', 'users.nama')->join('users_detail', 'users.id', '=', 'users_detail.id_user')->join('purchasing', 'surat.po_number', '=', 'purchasing.po_number')->join('surat_details','surat.no_surat','=','surat_details.no_surat')->where('surat.no_surat', $no)->first();
    }

    public function deleteData($id,$no)
    {
        DB::table('surat_details')->where('no_surat', $no)->delete();
        DB::table('surat')->where('no_surat', $no)->delete();
    }
    public function detailSurat1()
    {
        return $this->hasMany(m_detail_surat::class, 'no_surat', 'no_surat');
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

    public function deleteRow($table,$key,$val){
        return DB::table($table)->where($key,$val)->delete();
    }

    public function getPoBySurat($id_surat){
        return DB::table('purchasing')
        ->join('surat','purchasing.po_number','=','surat.po_number')
        ->where('surat.no_surat','LIKE',$id_surat.'/DO-SU/%')
        ->first();
    }


    // END Kondisi
}
