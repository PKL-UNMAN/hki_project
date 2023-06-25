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
            'PO' => $this->PO->tampilPO_Supplier(),
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
        if($part_no == NULL){
            return redirect()->route('hki.po.supplier.index')->with('fail','Silakan lengkapi data terlebih dahulu!');
        }else{
            $parts = [];
            foreach ($part_no as $index => $part) {
                $parts[] = [
                    "po_number" => $request->po_number,
                    "id_tujuan" => $request->id_tujuan,
                    "id_destination" => $request->destination,
                    "default_supplier_id" => $request->default_id,
                    "issue_date" => $request->issue_date,
                    "class" => $request->classname,
                    "currency_code" => $request->currency,
                    "part_no" => $request->part_no[$index],
                    "part_name" => $request->part_name[$index],
                    "unit_price" => $request->unit_price[$index],
                    "composition" => $request->composition[$index],
                    "order_qty" => $request->qty[$index],
                    "unit" => $request->unit[$index],
                    "amount" => $request->amount[$index],
                    "delivery_time" => $request->delivery_date[$index],
                    "order_number" => $request->order_number[$index],
                    "status" => 'On Progress'
                ];
                $request->validate([
                    "po_number" => 'required', 
                    "id_tujuan" => 'required', 
                    "destination" => 'required',
                    "default_id" => 'required',
                    "issue_date" => 'required',
                    "classname" => 'required', 
                    "currency" => 'required',
                    "part_no" => 'required',
                    "part_name" => 'required',
                    "unit_price" => 'required',
                    "composition" => 'required',
                    "order_qty" => 'required',
                    "unit" => 'required',
                    "amount" => 'required',
                    "delivery_time" => 'required',
                    "order_number" => 'required'
                ],[
                    'po_number.required'=>'Nomor PO Wajib Diisi', 
                    'id_tujuan.required'=>'Tujuan Supplier Wajib Diisi', 
                    'destination.required'=>'Tujuan Pengiriman Wajib Diisi',
                    'default_id.required'=>'Supplier ID Wajib Diisi',
                    'issue_date.required'=>'Issue Date Wajib Diisi',
                    'classname.required'=>'Class Wajib Diisi', 
                    'currency.required'=>'Kode Currency Wajib Diisi',
                    'part_no.required'=>'Nomor Part Wajib Diisi',
                    'part_name.required'=>'Nama Part Wajib Diisi',
                    'unit_price.required'=>'Unit Price Wajib Diisi',
                    'composition.required'=>'Composition Wajib Diisi',
                    'order_qty.required'=>'QTY Order Wajib Diisi',
                    'unit.required'=>'Unit Wajib Diisi',
                    'amount.required'=>'Amount Wajib Diisi',
                    'delivery_time.required'=>'Delivery Time Wajib Diisi',
                    'order_number.required'=>'Order Number Wajib Diisi'
                ]);
        
                $this->PO->addData($parts);
                return redirect()->route('hki.po.supplier.index')->with('success','PO berhasil ditambahkan');
            }
        }

    }

    public function editPO_Supplier($no)
    {
        $data =[
            'PO' => $this->PO->detailData($no),
            'supplier' => $this->user->supplierData(),
        ];
        return view ('hki.po.supplier.edit', $data);
    }

    public function updatePO_Supplier(Request $request, $no)
    {

        $request->validate([
            'part_no' => 'required',
            'id_tujuan' => 'required',
            'part_name' => 'required',
            'order_qty' => 'required',
            'weight' => 'required',
            'order_no' => 'required',
            'po_number' => 'required',
            'delivery_time' => 'required',
            'payment' => 'required',
        ],[
            'part_no.required'=>'Part Nomor Wajib terisi',
            'id_tujuan.unique'=>'Supplier Wajib Diisi',
            'part_name.required'=>'Part Name Wajib terisi',
            'order_qty.required'=>'Order QTY Wajib terisi',
            'weight.required'=>'Weight Wajib terisi',
            'order_no.required'=>'Order No Wajib terisi',
            'po_number.required'=>'PO Number Wajib terisi',
            'delivery_time.required'=>'Delivery Time Wajib terisi',
            'payment.required'=>'Payment Wajib terisi',
        ]);

            $data = [
                'part_no' => $request->part_no,
                'id_tujuan' => $request->id_tujuan,
                'id_hki' => Auth::user()->id,
                'part_name' => $request->part_name,
                'order_qty' => $request->order_qty,
                'weight' => $request->weight,
                'order_no' => $request->order_no,
                'po_number' => $request->po_number,
                'payment' => $request->payment,
                'delivery_time' => $request->delivery_time,
            ];
           
        $this->PO->editData($no, $data);
        return redirect()->route('hki.po.supplier.index')->with('success', 'User Berhasil diupdate.');
           
        }
         
        // END HKI PO SUPPLIER

        // HKI PO SUBCON
        public function tampilPO_Subcon()
    {
        $data =[
            'PO' => $this->PO->tampilPO_Subcon(),
        ];
        return view ('hki.po.subcon.index', $data);
    }

    public function createPO_Subcon()
    {
        $data =[
            'subcon' => $this->user->subconData(),
        ];
        return view ('hki.po.subcon.create', $data);
    }

    public function storePO_Subcon(Request $request)
    {
        $now = Carbon::now()->format('d-m-Y');
        $request->validate([
            'part_no' => 'required',
            'id_tujuan' => 'required',
            'part_name' => 'required',
            'order_qty' => 'required',
            'weight' => 'required',
            'order_no' => 'required',
            'po_number' => 'required',
            'delivery_time' => 'required',
            'payment' => 'required',
        ],[
            'part_no.required'=>'Part Nomor Wajib terisi',
            'id_tujuan.unique'=>'Supplier Wajib Diisi',
            'part_name.required'=>'Part Name Wajib terisi',
            'order_qty.required'=>'Order QTY Wajib terisi',
            'weight.required'=>'Weight Wajib terisi',
            'order_no.required'=>'Order No Wajib terisi',
            'po_number.required'=>'PO Number Wajib terisi',
            'delivery_time.required'=>'Delivery Time Wajib terisi',
            'payment.required'=>'Payment Wajib terisi',
        ]);

        $id = $this->PO->checkID();
        if($id == null)
        {
            $id_baru = $id+1;
            $data =[
                'no'=> $id_baru,
                'part_no' => $request->part_no,
                'id_tujuan' => $request->id_tujuan,
                'id_hki' => Auth::user()->id,
                'part_name' => $request->part_name,
                'order_qty' => $request->order_qty,
                'weight' => $request->weight,
                'order_no' => $request->order_no,
                'po_number' => $request->po_number,
                'payment' => $request->payment,
                'issue_date' => $now,
                'delivery_time' => $request->delivery_time,
                'status'=> "On Progress",
            ];
          
        }else{
            $idMax = $this->PO->maxIditem();
            $id_baru = $idMax+1;
            $data =[
                'no'=> $id_baru,
                'part_no' => $request->part_no,
                'id_tujuan' => $request->id_tujuan,
                'id_hki' => Auth::user()->id,
                'part_name' => $request->part_name,
                'order_qty' => $request->order_qty,
                'weight' => $request->weight,
                'order_no' => $request->order_no,
                'po_number' => $request->po_number,
                'payment' => $request->payment,
                'issue_date' => $now,
                'delivery_time' => $request->delivery_time,
                'status'=> "On Progress",
            ];
        }
        $this->PO->addData($data);
        return redirect()->route('hki.po.subcon.index')->with('success','PO berhasil ditambahkan');
    }

    public function editPO_Subcon($no)
    {
        $data =[
            'PO' => $this->PO->detailData($no),
            'subcon' => $this->user->subconData(),
        ];
        return view ('hki.po.subcon.edit', $data);
    }

    public function updatePO_Subcon(Request $request, $no)
    {

        $request->validate([
            'part_no' => 'required',
            'id_tujuan' => 'required',
            'part_name' => 'required',
            'order_qty' => 'required',
            'weight' => 'required',
            'order_no' => 'required',
            'po_number' => 'required',
            'delivery_time' => 'required',
        ],[
            'part_no.required'=>'Part Nomor Wajib terisi',
            'id_tujuan.unique'=>'Supplier Wajib Diisi',
            'part_name.required'=>'Part Name Wajib terisi',
            'order_qty.required'=>'Order QTY Wajib terisi',
            'weight.required'=>'Weight Wajib terisi',
            'order_no.required'=>'Order No Wajib terisi',
            'po_number.required'=>'PO Number Wajib terisi',
            'delivery_time.required'=>'Delivery Time Wajib terisi',
        ]);

            $data = [
                'part_no' => $request->part_no,
                'id_tujuan' => $request->id_tujuan,
                'id_hki' => Auth::user()->id,
                'part_name' => $request->part_name,
                'order_qty' => $request->order_qty,
                'weight' => $request->weight,
                'order_no' => $request->order_no,
                'po_number' => $request->po_number,
                'payment' => $request->payment,
                'delivery_time' => $request->delivery_time,
            ];

           
           
        $this->PO->editData($no, $data);
        return redirect()->route('hki.po.subcon.index')->with('success', 'PO Berhasil diupdate.');
           
        }
         

        // END HKI PO SUBCON
    
        




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

    public function destroyPO_Supplier($no)
    {
        $this->PO->deleteData($no);
        return redirect()->route('hki.po.supplier.index')->with('success','Berhasil Dihapus');
    }

    public function destroyPO_Subcon($no)
    {
        $this->PO->deleteData($no);
        return redirect()->route('hki.po.subcon.index')->with('success','Berhasil Dihapus');
    }

    function detailPO_Supplier($no)
    {
        $data = [
            'PO'=> $this->PO->detailData($no)
        ];
        
        return view('hki.po.supplier.detail', $data);

    }

    public function myPO_Download($no)
    {
        $data =[
            'from'=> $this->PO->download($no),
            'hki'=> $this->user->detailHKI(),
        ];
        // return view('subcon.po.pdf', $data);
        $pdf = PDF::loadview('po.supplier.download', $data)->setPaper('legal', 'potrait');;
	    return $pdf->download('laporan-PO.pdf');
    }
    
}
