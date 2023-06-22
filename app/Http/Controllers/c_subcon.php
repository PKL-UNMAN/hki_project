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

class c_subcon extends Controller
{
    public function __construct()
    {
        $this->user = new m_user();
        $this->role = new m_role();
        $this->PO = new m_purchasingOrder();
        $this->surat = new m_surat();
       
    }

    // PO SUBCON
    public function myPO_Subcon()
    {
        $id = Auth::user()->id;
        $data =[
            'PO' => $this->PO->myPO_Subcon($id),
        ];
        return view ('subcon.po.index', $data);
    }

    public function myPO_Download($no)
    {
        $data =[
            'from'=> $this->PO->download($no),
            'hki'=> $this->user->detailHKI(),
        ];
        // return view('subcon.po.pdf', $data);
        $pdf = PDF::loadview('subcon.po.pdf', $data)->setPaper('legal', 'potrait');;
	    return $pdf->download('laporan-PO.pdf');
    }



    // END PO SUBCON
    
    // Monitoring  Sisa
    public function mySisa_Subcon()
    {
        $id = Auth::user()->id;
        $data =[
            'surat' => $this->surat->mySurat_Subcon($id)
        ];
        return view ('subcon.sisa.index', $data);
    }
    // END Monitoring Sisa

    // SURAT SUBCON ke HKI
    public function mySurat_Subcon()
    {
        $id = Auth::user()->id;
        $data =[
            'surat' => $this->surat->mySurat_Subcon($id)
        ];
        return view ('subcon.surat.index', $data);
    }


    // END SURAT Ke HKI

     // SURAT DARI SUPPLIER
     public function mySuratSup_Subcon()
     {
         $id = Auth::user()->id;
         $data =[
             'surat' => $this->surat->mySuratSup_Subcon($id)
         ];
         return view ('subcon.suratSup.index', $data);
     }
     // END SURAT DARI SUPPLIER



    //Download Surat Subcon
    public function mySurat_Download($no)
    {
        $data =[
            'from'=> $this->surat->download($no),
            'hki'=> $this->user->detailHKI(),
        ];
        // return view('subcon.po.pdf', $data);
        $pdf = PDF::loadview('subcon.surat.pdf', $data)->setPaper('legal', 'potrait');;
	    return $pdf->download('laporan-Surat-Jalan.pdf');
    }




    // Ajax
    function detailPO_Subcon($no)
    {
        $data = [
            'PO'=> $this->PO->detailData($no)
        ];
        
        return view('subcon.po.detail', $data);

    }



    
}
