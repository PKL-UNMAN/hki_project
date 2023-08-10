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
    // dashboard hki
    public function countPo()
    {
        return DB::table('purchasing')->count();
    }
    public function poOnProgres()
    {
        return DB::table('purchasing')->where('status','!=', 'Finish')->count();
    }
    public function poFinish()
    {
        return DB::table('purchasing')->where('status','Finish')->count();
    }
    // end dashboard hki
    // dashboard subcon dan supplier
    public function countPo1($id_user)
    {
        return DB::table('purchasing')->join('users_detail','users_detail.id_perusahaan','purchasing.id_tujuan_po')->join('users','users.id','users_detail.id_user')->where('users.id',$id_user)->count();
    }
    public function poOnProgres1($id_user)
    {
        return DB::table('purchasing')->join('users_detail','users_detail.id_perusahaan','purchasing.id_tujuan_po')->join('users','users.id','users_detail.id_user')->where('users.id',$id_user)->where('status','!=', 'Finish')->count();
    }
    public function poFinish1($id_user)
    {
        return DB::table('purchasing')->join('users_detail','users_detail.id_perusahaan','purchasing.id_tujuan_po')->join('users','users.id','users_detail.id_user')->where('users.id',$id_user)->where('status', 'Finish')->count();
    }
    // end
    public function getData($table){
        return DB::table($table)->get();
    }

    public function getSisaBarang(){
        return DB::table('stocks')
        ->join('surat','stocks.no_surat','=','surat.no_surat')
        ->join('surat_details','stocks.no_surat','=','surat_details.no_surat')
        ->select('stocks.sisa','surat.po_number','surat_details.part_no','surat_details.part_name','stocks.tanggal','surat.pengirim','stocks.order_number')
        ->groupBy('stocks.sisa','surat.po_number','surat_details.part_no','surat_details.part_name','stocks.tanggal','surat.pengirim','stocks.order_number')
        ->orderBy('stocks.sisa', 'ASC')
        ->get();
    }


    public function groupNameSubcon(){
        return DB::table('purchasing')
        ->join('surat','purchasing.po_number','=','surat.po_number')
        ->join('users','users.nama','=','surat.pengirim')
        ->select('surat.pengirim','surat.po_number')
        ->groupBy('surat.pengirim','surat.po_number')
        ->where('users.role_id','2')
        ->get();
    }


    public function tampilPO_Supplier()
    {
        return DB::table('purchasing')->join('users_detail','purchasing.id_tujuan_po','=','users_detail.id_perusahaan')->join('users','users.id','=','users_detail.id_user')->where('users.role_id', '3')->get();
    }

    public function getIdPO(){
        return DB::table('purchasing')->max('id_po');
    }

    public function getsisaPO(){
        return DB::table('stocks')->min('sisa');
    }

    public function tampilPO_Subcon()
    {
        return DB::table('purchasing')->join('users_detail','purchasing.id_tujuan_po','=','users_detail.id_perusahaan')->join('users','users.id','=','users_detail.id_user')->where('users.role_id', '2')->get();
    }

    public function addData($table,$data)
    {
        DB::table($table)->insert($data);
    }
    
    public function editData($table,$key,$id,$data)
    {
        return DB::table($table)->where($key,$id)->update($data);
    }

    public function updateStock($id_po,$order_number,$sisa)
    {
        return DB::table('purchasing_details')
        ->where([
            'id_po' => $id_po,
            'order_number' => $order_number
        ])
        ->update(['order_qty' => $sisa]);
    }


    public function detailData($id)
    {
        return DB::table('purchasing')->join('users_detail','purchasing.id_tujuan_po','=','users_detail.id_perusahaan')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('purchasing_details.id_po', $id)->get();
    }

    public function detailPOSubcon()
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.role_id')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('purchasing.class', 'SUBCON')->get();
    }

    public function detailPOSupplier()
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.id')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('users.role_id', '3')->get();
    }

    public function getPOById($table,$id){
        return DB::table('purchasing')->join('users_detail','purchasing.id_tujuan_po','=','users_detail.id_perusahaan')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->join('users','users.id','=','users_detail.id_user')->where('purchasing_details.id_po',$id)->first();
    }

    public function getDetailsByIdPO($id){
        return DB::table('purchasing_details')->where('id_po',$id)->get();
    }

    public function deleteData($table,$no)
    {
        return DB::table($table)->where('id_po', $no)->delete();
    }

    public function deleteStock($no_surat){
        return DB::table('stocks')->where('no_surat',$no_surat)->delete();
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
        return DB::table('purchasing')->join('users_detail','purchasing.id_tujuan_po','=','users_detail.id_perusahaan')->join('users','users.id','=','users_detail.id_user')->where('users_detail.id_user', $id)->get();
    }

    public function fromPO($no)
    {
        return DB::table('purchasing')->join('users','purchasing.id_hki','=','users.id')->where('no', $no)->first();
    }

    public function listGroup($id_po)
    {
        return DB::table('purchasing')->join('users_detail','purchasing.id_tujuan_po','=','users_detail.id_perusahaan')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->join('users','users.id','=','users_detail.id_user')->where('purchasing.id_po', $id_po)->get();
    }

    public function download($id_po)
    {
        return DB::table('purchasing')->join('users_detail','purchasing.id_tujuan_po','=','users_detail.id_perusahaan')->join('users','users.id','=','users_detail.id_user')->where('purchasing.id_po', $id_po)->first();
    }

    public function sumAmount($id_po){
        return DB::table('purchasing_details')->where('purchasing_details.id_po',$id_po)->sum('purchasing_details.amount');
    }
    // bantu isi data tambah surat jalan
    public function ambilData_posubcon($selectedValue,$id){
        return DB::table('purchasing')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->join('users_detail','purchasing.id_tujuan_po','=','users_detail.id_perusahaan')->where('po_number', $selectedValue)->get();
    }
    public function ambilData_dposubcon($selectedPartno, $selectedPoNumber,$id){
        return DB::table('purchasing')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('po_number', $selectedPoNumber)->Where('purchasing_details.part_no', $selectedPartno)->get();
    }
    public function ambilData_posupp($selectedValue,$id){
        return DB::table('purchasing')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->join('users_detail','purchasing.id_tujuan_po','=','users_detail.id_perusahaan')->where('po_number', $selectedValue)->get();
    }
    public function ambilData_dposupp($selectedPartno, $selectedPoNumber,$id){
        return DB::table('purchasing')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->join('users_detail','purchasing.id_tujuan_po','=','users_detail.id_perusahaan')->join('users','users.id','=','users_detail.id_user')->where('po_number', $selectedPoNumber)->Where('purchasing_details.part_no', $selectedPartno)->Where('users.id', $id)->get();
    }
    public function ambilData_posupp_tujuan($selectedValue,$id){
        return DB::table('purchasing')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->join('users','purchasing.id_destination','=','users.id')->where('po_number', $selectedValue)->first();
    }


    public function sisaData(){
        return DB::table('purchasing')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->join('users','purchasing.id_destination','=','users.id')->get();
    }

    public function sumSisa(){
        return DB::table('purchasing')
        ->select('po_number',DB::raw('COUNT(*) as `count`'))
        ->groupBy('po_number')
        ->havingRaw('COUNT(*) > 1')
        ->get();
    }

    public function qtyPO(){
        return DB::table('purchasing')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')
        ->where('purchasing.class','=','SUBCON')
        ->where('purchasing.class','=','SUPPLIER')
        ->select('purchasing.po_number')
        ->groupBy('purchasing.po_number')
        ->get();
    }





    // END PO DI HALAMAN SUBCON

     // PO DI HALAMAN SUBCON

     public function myPO_Supplier($id)
     {
        return DB::table('purchasing')->join('users_detail','purchasing.id_tujuan_po','=','users_detail.id_perusahaan')->join('users','users.id','=','users_detail.id_user')->where('users_detail.id_user', $id)->get();
     }
      // END PO DI HALAMAN SUBCON


    //   Kondisi Ketika User dihapus dan User masih punya PO, maka PO akan dijadikan Log
    public function jadiLOG($id, $data)
    {
        return DB::table('purchasing')->where('id_tujuan', $id)->update($data);
    }
    
    public function validatePO($id_destination,$class){
        return DB::table('purchasing')
        ->where('purchasing.id_destination',$id_destination)
        ->where('purchasing.class',$class)
        ->first();
    }

    public function validatePOWithSurat($id){
        return DB::table('purchasing')->join('surat','purchasing.po_number','=','surat.po_number')->where('surat.id', $id)->first();
    }

    public function getPOWithSurat($id){
        return DB::table('surat')->join('purchasing','surat.po_number','=','purchasing.po_number')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('surat.id',$id)->get();
    }

    public function getSenderSurat($id){
        return DB::table('surat')->join('purchasing','surat.po_number','=','purchasing.po_number')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('surat.id',$id)->first();
    }
    // END Kondisi

    public function validatePOWithName($name){
        return DB::table('users')->where('users.nama', $name)->first();
    }

    public function qtyGroupPerItem(){
        return DB::table('purchasing_details')
        ->join('purchasing','purchasing_details.id_po','=','purchasing.id_po')
        ->where('purchasing.class','SUBCON')
        ->select('purchasing_details.id_po','purchasing_details.part_name','purchasing_details.order_qty','purchasing_details.order_number')
        ->groupBy('purchasing_details.id_po','purchasing_details.part_name','purchasing_details.order_qty','purchasing_details.order_number')
        ->get();
    }

    public function groupItem($order_number){
        return DB::table('purchasing_details')
        ->join('purchasing','purchasing_details.id_po','=','purchasing.id_po')
        ->where('purchasing.class','SUBCON')
        ->where('purchasing_details.order_number',$order_number)
        ->get();
    }

    public function getSumPOSent(){
        return DB::table('surat_details')
        ->join('surat','surat_details.no_surat','=','surat.no_surat')
        ->select('surat_details.order_number','surat.no_surat','surat_details.part_name','surat.tanggal',DB::raw('SUM(surat_details.qty) AS qty_sent'))
        ->groupBy('surat_details.order_number','surat.no_surat','surat_details.part_name')
        ->get();
    }

    public function validateNoSurat($no_surat){
        return DB::table('stocks')
        ->where('stocks.no_surat', $no_surat)
        ->first();
    }

    public function validateOrderNumber($order_number){
        return DB::table('stocks')
        ->where('stocks.order_number', $order_number)
        ->first();
    }


    public function maxIdStocks($order_number)
    {
        return DB::table('stocks')
        ->where('order_number',$order_number)
        ->min('sisa');
    }

    public function validateSurat($no_surat){
        return DB::table('surat_details')
        ->where('surat_details.no_surat', $no_surat)
        ->get();
    }
}
