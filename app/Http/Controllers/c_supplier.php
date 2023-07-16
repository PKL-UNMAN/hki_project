<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\m_user;
use App\Models\m_role;
use App\Models\m_purchasingOrder;
use App\Models\m_surat;
use DB;
use File;
use Auth;
use PDF;

class c_supplier extends Controller
{
    public function __construct()
    {
        $this->user = new m_user();
        $this->role = new m_role();
        $this->PO = new m_purchasingOrder();
        $this->surat = new m_surat();

    }

    // PO SUBCON
    public function myPO_Supplier()
    {
        $id = Auth::user()->id;
        $data = [
            'PO' => $this->PO->myPO_Supplier($id),
            'detail_PO'=> $this->PO->detailPOSupplier(),
        ];
        // dd($data['detail_PO']);
        return view('supplier.po.index', $data);
    }

    public function myPO_Download($id_po)
    {
        $data =[
            'from'=> $this->PO->download($id_po),
            'group'=> $this->PO->listGroup($id_po),
            'sum_amount'=> $this->PO->sumAmount($id_po),
            'hki'=> $this->user->detailHKI(),
        ];
        $pdf = PDF::loadview('supplier.po.pdf', $data)->setPaper('legal', 'potrait');;
	    return $pdf->download('laporan-PO-Supplier.pdf');
    }


    // SURAT SUBCON
    public function mySurat_supplier()
    {
        $id = Auth::user()->id;
        $data = [
            'surat' => $this->surat->mySurat_supplier($id)
        ];
        return view('subcon.surat.index', $data);
    }

        //Download Surat Subcon
    public function mySurat_Download($no)
    {
        $data =[
            'from'=> $this->surat->download($no),
            'hki'=> $this->user->detailHKI(),
        ];
        $pdf = PDF::loadview('supplier.surat.pdf', $data)->setPaper('letter', 'landscape');
        return $pdf->download('laporan-Surat-Jalan.pdf');
    }
    // END SURAT


    // Ajax
    function detailPO_Supplier($no)
    {
        $data = [
            'detail_PO' => $this->PO->detailData($no),
            'PO'=> $this->PO->getPOById('purchasing',$no)
        ];

        return view('supplier.po.detail', $data);
    }
}
