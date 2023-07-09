<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class m_purchasingOrder extends Model
{
    use HasFactory;

    public function allData()
    {
        return DB::table('purchasing')->get();
    }


    public function tampilPO_Supplier()
    {
        return DB::table('purchasing')->join('users','purchasing.default_supplier_id','=','users.id')->where('users.role_id', '3')->get();
    }

    public function getIdPO(){
        return DB::table('purchasing')->max('id_po');
    }

    public function tampilPO_Subcon()
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan','=','users.id')->where('users.role_id', '2')->get();
    }

    public function addData($table,$data)
    {
        DB::table($table)->insert($data);
    }
    
    public function editData($table,$key,$id,$data)
    {
        // dd($data);
        return DB::table($table)->where($key,$id)->update($data);
    }

    public function detailData($id)
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.id')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('purchasing_details.id_po', $id)->get();
    }

    public function getPOById($table,$id){
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.id')->where('id_po',$id)->first();
    }

    public function getDetailsByIdPO($id){
        return DB::table('purchasing_details')->where('id_po',$id)->get();
    }

    public function deleteData($table,$no)
    {
        return DB::table($table)->where('id_po', $no)->delete();
    }

    public function checkID()
    {
        return DB::table('purchasing')->count();
    }

    public function maxIditem()
    {
        return DB::table('purchasing')->max('no');
    }

    // PO DI HALAMAN SUBCON
    public function myPO_Subcon($id)
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.id')->where('id_tujuan_po', $id)->get();
    }

    public function fromPO($no)
    {
        return DB::table('purchasing')->join('users','purchasing.id_hki','=','users.id')->where('no', $no)->first();
    }

    public function listGroup($id_po)
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.id')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->join('users_detail','users.id','=','users_detail.id_user')->where('purchasing.id_po', $id_po)->get();
    }

    public function download($id_po)
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.id')->join('users_detail','users.id','=','users_detail.id_user')->where('purchasing.id_po', $id_po)->first();
    }

    public function sumAmount($id_po){
        return DB::table('purchasing_details')->where('purchasing_details.id_po',$id_po)->sum('purchasing_details.amount');
    }
    // bantu isi data tambah surat jalan
    public function ambilData($selectedValue,$id){
        return DB::table('purchasing')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('po_number', $selectedValue)->where('id_tujuan_po', $id)->get();
    }



    // END PO DI HALAMAN SUBCON

     // PO DI HALAMAN SUBCON

     public function myPO_Supplier($id)
     {
         return DB::table('purchasing')->join('users','purchasing.id_tujuan','=','users.id')->where('id_tujuan', $id)->get();
     }
      // END PO DI HALAMAN SUBCON


    //   Kondisi Ketika User dihapus dan User masih punya PO, maka PO akan dijadikan Log
    public function jadiLOG($id, $data)
    {
        return DB::table('purchasing')->where('id_tujuan', $id)->update($data);
    }
    
    // END Kondisi
}
