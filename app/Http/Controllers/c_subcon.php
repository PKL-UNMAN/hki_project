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

    public function myPO_Download($po_num)
    {
        $data =[
            'from'=> $this->PO->download($po_num),
            'group'=> $this->PO->listGroup($po_num),
            'sum_amount'=> $this->PO->sumAmount($po_num),
            'hki'=> $this->user->detailHKI(),
        ];
        $pdf = PDF::loadview('subcon.po.pdf', $data)->setPaper('legal', 'potrait');;
	    return $pdf->download('laporan-PO-Subcon.pdf');
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
         $nama = Auth::user()->nama;
         $data =[
             'surat' => $this->surat->mySuratSup_Subcon($nama)
         ];
         return view ('subcon.suratSup.index', $data);
     }
      // ubah status
    public function ubahStatus_suratSup(Request $request)
    {
        $id = $request->id;
            $data = [
                'status' => "Finish",
            ];
            $this->surat->editStatusSuratSup($id, $data);
    }
    // end surat dari supplier ke subcon di subcon
    // read surat
    public function subcon_lihatSurat($no)
    {
        $data = [
            'perusahaan' => $this->surat->detailPengirim($no),
            'surat' => $this->surat->headSurat($no),
            'detail'=> $this->surat->detailSurat2($no)
        ];
        return view('subcon.suratSup.read', $data);
    }
    // end read surat
    // tampil surat
    public function subcon_tampilSurat(Request $request)
    {
        $no = $request->input('additionalData1');
        $data = [
            'perusahaan' => $this->surat->detailPengirim($no),
            'surat' => $this->surat->headSurat($no),
            'detail'=> $this->surat->detailSurat2($no)
        ];
        return view('subcon.suratSup.read', $data);
    }
    // end tampil surat

     // END SURAT DARI SUPPLIER



    //Download Surat Subcon
    public function mySurat_Download($id)
    {
        $data =[
            'details'=> $this->surat->detailSurat2($id),
            'from'=> $this->surat->headSurat($id)
        ];
        $pdf = PDF::loadview('subcon.surat.pdf', $data)->setPaper('a4', 'potrait');
	    return $pdf->download('laporan-Surat-Jalan.pdf');
    }




    // Ajax
    function detailPO_Subcon($no)
    {
        $data = [
            'detail_PO'=> $this->PO->detailData($no),
            'PO'=> $this->PO->getPOById('purchasing',$no)
        ];
        
        return view('subcon.po.detail', $data);

    }



    
}
