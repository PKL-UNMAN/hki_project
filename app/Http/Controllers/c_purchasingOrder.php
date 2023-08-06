<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\m_user;
use App\Models\m_role;
use App\Models\Production;
use App\Models\m_purchasingOrder;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use App\Imports\ImportProduction;
use App\Imports\POImport;
use App\Exports\ExportProduction;
use Illuminate\Support\Collection;

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
        $this->Prod = new Production();
       
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
                    "delivery_time" => $request->delivery_date[$no]
                ];

                $no++;
            }

            $this->PO->addData('purchasing_details',$parts);
            return redirect()->route('hki.po.supplier.index')->with('success','PO berhasil ditambahkan');
        }

    }

    public function editPO_Supplier($id,$id_supplier)
    {
        $data =[
            'PO' => $this->PO->detailData($id),
            'POById'=> $this->PO->getPOById('purchasing',$id),
            'subcon' => $this->user->subconData(),
            'subconBy' => $this->user->subconData(),
            'supplier' => $this->user->supplierData(),
            'supplierBy' => $this->user->supplierDataById($id_supplier) 
        ];
        // dd($data[])
        return view ('hki.po.supplier.edit', $data);
    }

    public function editUploadPO_Supplier($id)
    {
        $data =[
            'PO' => $this->PO->detailData($id),
            'POById'=> $this->PO->getPOById('purchasing',$id),
            'subcon' => $this->user->subconData(),
            'subconBy' => $this->user->subconDataById(NULL),
            'supplier' => $this->user->supplierData(),
            'supplierBy' => $this->user->supplierDataById(NULL) 
        ];

        return view ('hki.po.supplier.editUpload', $data);
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
                "status" => 'On Progress'
            ];
        }
        $this->PO->editData('purchasing','id_po',$id_po, $po);
        return redirect()->route('hki.po.supplier.index')->with('success', 'PO Berhasil diupdate.');
           
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
                    "delivery_time" => $request->delivery_date[$no]
                ];
                $no++;
            }
            $this->PO->addData('purchasing_details',$parts);

            return redirect()->route('hki.po.subcon.index')->with('success','PO berhasil ditambahkan');
        }
    }

    public function sisa(){
        $this->countSisaBarang();
        $data = [
            'groupSubcon' => $this->PO->groupNameSubcon(),
            'sisa' => $this->PO->getSisaBarang()
        ];
       return view ('hki.sisabarang.index', $data);
    }

    public function countSisaBarang(){
        $qty_group_item = $this->PO->qtyGroupPerItem();
        $sumPOSent = $this->PO->getSumPoSent();
        dd($sumPOSent);
        //Looping data item beserta QTY PO untuk dapat nama part dan jumlah dari table purchasing details
        //Looping data item beserta QTY PO yang dikirimkan subcon dari table surat_details
        foreach($qty_group_item as $qty_item){
            foreach($sumPOSent as $sumSent){
                //Validasi jika terdapat nama item yang sama dari tabel purchasing_details dan surat_details
                if($qty_item->part_name === $sumSent->part_name){
                    //Jika terdapat data yang sama, lanjutkan kondisi jika tanggal di table surat <= current date
                    if($sumSent->tanggal <= date('Y-m-d H:i:s')){
                        dd($sumSent);
                        // if($this->PO->validateNoSurat($sumSent->no_surat) !== NULL){
                            if(count($sumPOSent) == 1){
                                //jika jumlah data row == 1
                                $sisa = intval($qty_item->order_qty) - $sumSent->qty_sent;
                                $data = [
                                    'no_surat'=>$sumSent->no_surat,
                                    'order_number'=>$qty_item->order_number,
                                    'tanggal'=>$sumSent->tanggal,
                                    'part_name'=>$qty_item->part_name,
                                    'qty_requested'=>$qty_item->order_qty,
                                    'qty_sent'=>$sumSent->qty_sent,
                                    'sisa'=>$sisa
                                ];
                                //add ke table stocks
                                $this->PO->addData('stocks',$data);
                                //update jumlah item pada table purchasing_details by order number dan id po
                                $this->PO->updateStock($qty_item->id_po,$qty_item->order_number,$sisa);
                            }else{
                                //jika jumlah data row > 1
                                $sisa = intval($qty_item->order_qty) - $sumSent->qty_sent;
                                $data = [
                                    'no_surat'=>$sumSent->no_surat,
                                    'order_number'=>$qty_item->order_number,
                                    'tanggal'=>$sumSent->tanggal,
                                    'part_name'=>$qty_item->part_name,
                                    'qty_requested'=>$qty_item->order_qty,
                                    'qty_sent'=>$sumSent->qty_sent,
                                    'sisa'=>$sisa
                                ];
                                //add ke table stocks
                                $this->PO->addData('stocks',$data);
                                //update jumlah item pada table purchasing_details by order number dan id po
                                $this->PO->updateStock($qty_item->id_po,$qty_item->order_number,$sisa);
                            }
                            
                        // }
                    }else{
                        echo 'belum dikirim';
                        // die;
                    }
                }
            }  
        }  
        // die;

                //     if($this->PO->validateNoSurat($sumSent->no_surat) !== NULL){
                //         //edit data existing pada table stocks
                //         $this->PO->deleteStock($sumSent->no_surat);
                //     }
            
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
    public function editUploadPO_Subcon($id){
        $data =[
            'PO' => $this->PO->detailData($id),
            'POById'=> $this->PO->getPOById('purchasing',$id),
            'hki' => $this->user->hkiData(),
            'subconBy' => $this->user->subconDataById(NULL),
            'supplier' => $this->user->supplierData(),
            'supplierBy' => $this->user->supplierDataById(NULL) 
        ];
        return view ('hki.po.subcon.editUpload', $data);
    }
    public function updatePO_Subcon(Request $request, $id_po)
    {
        $id_details = $this->PO->getDetailsByIdPO($id_po);
        $no = 0;
        if($id_details == NULL){
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
                "status" => 'On Progress'
            ];
        }
        $this->PO->editData('purchasing','id_po',$id_po, $po);
        return redirect()->route('hki.po.subcon.index')->with('success', 'PO Berhasil diupdate.');
           
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

    public function import(Request $request,$class){
        $data = Excel::toArray([], $request->file('file')->store('files'));
        if($this->PO->validatePOWithName($data[0][1][5]) !== NULL){
            $this->PO->addData('purchasing',
            [
                'po_number'=> $data[0][1][0],
                'class'=> $request->class,
                'currency_code'=>$data[0][1][18],
                'id_tujuan_po'=> $data[0][1][4],
                'default_supplier_id'=>$data[0][1][4],
                'issue_date'=>date('Y-m-d H:i:s'), 
                'status' => 'Unsend'
                ]
            );
            if($class === 'supplier'){
                Excel::import(new POImport(), $request->file('file')->store('files'));
                return redirect()->route('hki.po.supplier.index')->with('success','Berhasil Import PO Supplier');
            }else{
                Excel::import(new POImport(), $request->file('file')->store('files'));
                return redirect()->route('hki.po.subcon.index')->with('success','Berhasil Import PO Subcon');
            }
        }else{
            if($class === 'supplier'){
                return redirect()->route('hki.po.supplier.index')->with('fail','Gagal Import PO Supplier');
            }else{
                return redirect()->route('hki.po.subcon.index')->with('fail','Gagal Import PO Subcon');
            }
        }
    }

    public function getProduction(){
        $data = [
            'productions'=> $this->Prod->getData()
       ];
        return view('hki.production.index',$data);
    }

    public function uploadProduction(Request $request){
        $import = new ImportProduction;
        Excel::import($import, $request->file('file')->store('files'));
    }


    public function exportProduction(Request $request){
    //     $dt = DB::table('productions')
    //     ->select('nilai')
    //     ->groupBy('line','id')
    //     ->get();

        
    //     $no = 1;
    //     foreach($dt as $d){
    //         if($no <= 27){
    //             echo $no.' kolom (1) </br>';
    //         }elseif($no > 27){
    //             echo $no.' kolom (2) </br>';
    //         }
    //         $no++;
    //     }

    //     echo '<table>';
    //     echo '<tr>';
    //     for($i = 0; $i < 10; $i++) { 
    //         echo '<td>Column'.$i.'</td>';
    //     }
    // '</tr>';
    // '</table>';

        // return Excel::download(new exportProduction, 'productions.xlsx');
        
    }

    





    
}
