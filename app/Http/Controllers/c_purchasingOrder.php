<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\m_user;
use App\Models\m_role;
use App\Models\m_purchasingOrder;
use DB;
use File;
use Auth;
use Carbon\Carbon;

class c_purchasingOrder extends Controller
{
    public function __construct()
    {
        $this->user = new m_user();
        $this->role = new m_role();
        $this->PO = new m_purchasingOrder();
       
    }

    // PO SUPPLIER
    public function tampilPO_Supplier()
    {
        $data =[
            'PO' => $this->PO->tampilPO_Supplier()
        ];
        return view ('hki.po.supplier.index', $data);
    }

    public function createPO_Supplier()
    {
        $data =[
            'supplier' => $this->user->supplierData(),
            'subcon' => $this->user->subconData(),
        ];
        return view ('hki.po.supplier.create', $data);
    }

    public function storePO_Supplier(Request $request)
    {
        $part_no = $request->part_no;
        $no = 0;
        if($part_no == NULL){
            return redirect()->route('hki.po.supplier.index')->with('fail','Silakan lengkapi data terlebih dahulu!');
        }else{
            $po = [
                "po_number" => $request->po_number,
                "id_tujuan_po" => $request->id_tujuan,
                "default_supplier_id" => $request->default_id,
                "class" => $request->classname,
                "issue_date" => $request->issue_date,
                "currency_code" => $request->currency,
                "id_destination" => $request->destination,
                "delivery_time" => $request->delivery_date,
                "status" => 'On Progress'
            ];
            $this->PO->addData('purchasing',$po);
            $parts = [];
            foreach ($part_no as $index) {

                $parts[] = [
                    "id_po" => $this->PO->getIdPo(),
                    "part_no" => $request->part_no[$no],
                    "part_name" => $request->part_name[$no],
                    "unit_price" => $request->unit_price[$no],
                    "order_qty" => $request->qty[$no],
                    "unit" => $request->unit[$no],
                    "composition" => $request->composition[$no],
                    "amount" => $request->amount[$no],
                    "order_number" => $request->order_number[$no],
                ];

                $this->sisaBarang($parts,$request->classname,$po);
                $no++;
            }
            $this->PO->addData('purchasing_details',$parts);
            return redirect()->route('hki.po.supplier.index')->with('success','PO berhasil ditambahkan');
        }

    }

    public function editPO_Supplier($id,$id_subcon,$id_supplier)
    {
        $data =[
            'PO' => $this->PO->detailData($id),
            'POById'=> $this->PO->getPOById('purchasing',$id),
            'subcon' => $this->user->subconData(),
            'subconBy' => $this->user->subconDataById($id_subcon),
            'supplier' => $this->user->supplierData(),
            'supplierBy' => $this->user->supplierDataById($id_supplier) 
        ];
        return view ('hki.po.supplier.edit', $data);
    }

    public function updatePO_Supplier(Request $request, $id_po)
    {
        $id_details = $this->PO->getDetailsByIdPO($id_po);
        $no = 0;
        if($id_details == NULL){
            return redirect()->route('hki.po.supplier.index')->with('fail','Silakan lengkapi data terlebih dahulu!');
        }else{
            $po = [
                "po_number" => $request->po_number,
                "id_tujuan_po" => $request->id_tujuan,
                "default_supplier_id" => $request->default_id,
                "class" => $request->classname,
                "issue_date" => $request->issue_date,
                "currency_code" => $request->currency,
                "id_destination" => $request->destination,
                "delivery_time" => $request->delivery_date
            ];
            $this->PO->editData('purchasing','id_po',$id_po, $po);
            $parts = [];
            foreach ($id_details as $items) {
                $parts= [
                    "part_no" => $request->part_no[$no],
                    "part_name" => $request->part_name[$no],
                    "unit_price" => $request->unit_price[$no],
                    "order_qty" => $request->qty[$no],
                    "unit" => $request->unit[$no],
                    "composition" => $request->composition[$no],
                    "amount" => $request->amount[$no],
                    "order_number" => $request->order_number[$no],
                ];
                $no++;
                $this->PO->editData('purchasing_details','id',$items->id,$parts);
            }
            
        }
        return redirect()->route('hki.po.supplier.index')->with('success', 'User Berhasil diupdate.');
           
        }
         
        // END HKI PO SUPPLIER

        // HKI PO SUBCON
        public function tampilPO_Subcon()
    {
        $data =[
            'PO' => $this->PO->tampilPO_Subcon(),
            'detail_PO'=> $this->PO->detailPOSubcon(),
        ];
        return view ('hki.po.subcon.index', $data);
    }

    public function createPO_Subcon()
    {
        $data =[
            'subcon' => $this->user->subconData()
        ];
        return view ('hki.po.subcon.create', $data);
    }

    public function storePO_Subcon(Request $request)
    {
        $part_no = $request->part_no;
        $no = 0;
        if($part_no == NULL){
            return redirect()->route('hki.po.subcon.index')->with('fail','Silakan lengkapi data terlebih dahulu!');
        }else{
            $po = [
                "po_number" => $request->po_number,
                "id_tujuan_po" => $request->id_tujuan,
                "default_supplier_id" => $request->default_id,
                "class" => $request->classname,
                "issue_date" => $request->issue_date,
                "currency_code" => $request->currency,
                "id_destination" => $request->destination,
                "delivery_time" => $request->delivery_date,
                "status" => 'On Progress'
            ];
            $this->PO->addData('purchasing',$po);
            $parts = [];
            foreach ($part_no as $index) {
                
                $parts[] = [
                    "id_po" => $this->PO->getIdPo(),
                    "part_no" => $request->part_no[$no],
                    "part_name" => $request->part_name[$no],
                    "unit_price" => $request->unit_price[$no],
                    "order_qty" => $request->qty[$no],
                    "unit" => $request->unit[$no],
                    "composition" => $request->composition[$no],
                    "amount" => $request->amount[$no],
                    "order_number" => $request->order_number[$no],
                ];
                $this->sisaBarang($parts,$request->classname,$po);
                $this->countSisaBarang($this->PO->getIdPo()-1);
                $no++;
            }
            $this->PO->addData('purchasing_details',$parts);

            return redirect()->route('hki.po.subcon.index')->with('success','PO berhasil ditambahkan');
        }
    }

    public function sisa(){
       $data = [
            'sisa' => $this->PO->getSisaBarang()
        ];
       return view ('hki.sisabarang.index', $data);
    }

    public function sisaBarang($parts,$classname,$po){
        $sum_qty=0;
        $sum_comp=0;
        foreach ($parts as $part) {
            $sum_qty+= $part['order_qty'];
            $sum_comp+= $part['composition'];
        }
        if($classname==='SUPPLIER'){
            $sisa = [
                'id_po'=>$this->PO->getIdPo(),
                'qty_sup'=>$sum_qty,
                'comp_sup'=>$sum_comp
            ];
            $this->PO->addData('stocks',$sisa);
        }else{
            $validatePO = $this->PO->validatePO($po['id_tujuan_po'],'SUPPLIER');
            if($validatePO !== NULL){
                $sisa = [
                    'qty_sub'=>$sum_qty,
                    'comp_sub'=>$sum_comp
                ];
                $this->PO->editData('stocks','id_po',$validatePO->id_po, $sisa);
            }
        }
    }

    public function countSisaBarang($id){
        $stocks = $this->PO->getData('stocks');
        foreach($stocks as $stock){
            $sisa = ($stock->qty_sup/$stock->comp_sup/$stock->comp_sub)-$stock->qty_sub;
            $total = [
                'total'=>$sisa
            ];
            $this->PO->editData('stocks','id_po',$id, $total);
        }
    }

    public function getSisaBarang(){
        $stocks = $this->PO->getData('stocks');
    }

    public function editPO_Subcon($id_po,$id_subcon)
    {
        $data =[
            'PO' => $this->PO->detailData($id_po),
            'subcon' => $this->user->subconData(),
            'POById'=> $this->PO->getPOById('purchasing_details',$id_po),
            'subconBy' => $this->user->subconDataById($id_subcon)
        ];

        return view ('hki.po.subcon.edit', $data);
    }

    public function updatePO_Subcon(Request $request, $id_po)
    {
        $id_details = $this->PO->getDetailsByIdPO($id_po);
        $no = 0;
        if($id_details == NULL){
            return redirect()->route('hki.po.supplier.index')->with('fail','Silakan lengkapi data terlebih dahulu!');
        }else{
            $po = [
                "po_number" => $request->po_number,
                "id_tujuan_po" => $request->id_tujuan,
                "default_supplier_id" => $request->default_id,
                "class" => $request->classname,
                "issue_date" => $request->issue_date,
                "currency_code" => $request->currency,
                "id_destination" => $request->destination,
                "delivery_time" => $request->delivery_date
            ];
            $this->PO->editData('purchasing','id_po',$id_po, $po);
            $parts = [];
            foreach ($id_details as $items) {
                $parts= [
                    "part_no" => $request->part_no[$no],
                    "part_name" => $request->part_name[$no],
                    "unit_price" => $request->unit_price[$no],
                    "order_qty" => $request->qty[$no],
                    "unit" => $request->unit[$no],
                    "composition" => $request->composition[$no],
                    "amount" => $request->amount[$no],
                    "order_number" => $request->order_number[$no],
                ];
                $no++;
                $this->PO->editData('purchasing_details','id',$items->id,$parts);
            }
            
        }
        return redirect()->route('hki.po.subcon.index')->with('success', 'User Berhasil diupdate.');
           
        }
         


    // Ajax
    function ubahStatus(Request $request)
    {
        $no = $request->no;
        $status = $request->status;
        $data = [
            'status'=> $status,
        ];
        $this->PO->editData($no, $data);

    }

    public function destroyPO_Supplier($id_po)
    {
        $this->PO->deleteData('purchasing_details',$id_po);
        $this->PO->deleteData('purchasing',$id_po);
        return redirect()->route('hki.po.supplier.index')->with('success','Berhasil Dihapus');
    }

    public function destroyPO_Subcon($id_po)
    {
        $this->PO->deleteData('purchasing_details',$id_po);
        $this->PO->deleteData('purchasing',$id_po);
        return redirect()->route('hki.po.subcon.index')->with('success','Berhasil Dihapus');
    }

    function detailPO_Supplier($no)
    {
        $data = [
            'detail_PO'=> $this->PO->detailData($no),
            'PO'=> $this->PO->getPOById('purchasing',$no)
        ];
        return view('hki.po.supplier.detail', $data);

    }





    
}
