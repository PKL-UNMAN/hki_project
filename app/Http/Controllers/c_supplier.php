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
    }

    // PO SUBCON
    public function myPO_Supplier()
    {
        $id = Auth::user()->id;
        $data = [
            'PO' => $this->PO->myPO_Supplier($id),
        ];
        return view('supplier.po.index', $data);
    }

    public function myPO_Download($no)
    {
        $data = [
            'from' => $this->PO->download($no),
            'hki' => $this->user->detailHKI(),
        ];
        // return view('subcon.po.pdf', $data);
        $pdf = PDF::loadview('supplier.po.pdf', $data);
        return $pdf->download('laporan-PO.pdf');
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

    // END SURAT


    // Ajax
    function detailPO_Supplier($no)
    {
        $data = [
            'PO' => $this->PO->detailData($no)
        ];

        return view('supplier.po.detail', $data);
    }
}
