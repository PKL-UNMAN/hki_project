<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\m_user;
use App\Models\m_role;
use App\Models\m_purchasingOrder;
use App\Models\m_surat;
use App\Models\m_detail_surat;
use Illuminate\Support\Facades\Session;

use DB;
use File;
use Auth;
use PDF;
use Validator;
use Carbon\Carbon;

class c_surat extends Controller
{
    public function __construct()
    {
        $this->user = new m_user();
        $this->role = new m_role();
        $this->PO = new m_purchasingOrder();
        $this->surat = new m_surat();
    }

    // Surat HKI

    public function tampilSurat_HKI()
    {
        $nama = Auth::user()->nama;
        $data = [
            'surat' => $this->surat->suratdarisub( $nama),
        ];
        return view('hki.surat.index', $data);
    }
    public function hki_scanSurat()
    {
        return view('hki.surat.scan');
    }

    // END Surat HKI
    public function monitorSurat(){
        $data =[
            'surat' => $this->surat->monitorSurat()
        ];
        return view('hki.monitorSurat.index', $data);
    }

    // Surat Subcon

    public function tampilSurat_subcon()
    {
        $nama = Auth::user()->nama;
        $data = [
            'surat' => $this->surat->mySurat_Subcon($nama),
        ];
        return view('subcon.surat.index', $data);
    }

    public function createSurat_subcon()
    {
        $id = Auth::user()->id;
        $data = [
            'po' => $this->PO->myPO_Subcon($id),
            'tujuan'=> $this->user->hkiData(),
        ];
        return view('subcon.surat.create', $data);
    }

    public function ambilData_po_subcon($selectedValue){
        $id = Auth::user()->id;
        $data = $this->PO->ambilData_posubcon($selectedValue,$id);
        return response()->json(['data' => $data]);
    }
    public function ambilData_dpo_subcon($combinedData){
        // Anda dapat memisahkan kembali data yang telah digabungkan
        list($selectedPartno, $selectedPoNumber) = explode('_', $combinedData);
        $id = Auth::user()->id;
        $data = $this->PO->ambilData_dposubcon($selectedPartno, $selectedPoNumber,$id);
        return response()->json(['data' => $data]);
    }

    public function storeSurat_subcon(Request $request) {
      // Validasi data yang diterima dari permintaan AJAX
      $request->validate([
        'po_number' => 'required',
        'tanggal' => 'required',
        'pengirim' => 'required',
        'penerima' => 'required',
        'data_table' => 'required', // Data tabel harus berupa array dengan minimal 1 elemen
        'data_table.*.part_no' => 'required',
        'data_table.*.part_name' => 'required',
        'data_table.*.qty' => 'required',
        'data_table.*.unit' => 'required',
        'data_table.*.order_number' => 'required',
    ]);
    $lastSurat = m_surat::orderBy('tanggal_terbit', 'desc')->first();
    $idMax=$this->surat->maxIditem();
if ($lastSurat) {
    $lastNoSurat = $lastSurat->no_surat;
    list($lastNo, $lastDoSi, $lastMonth, $lastYear) = explode('/', $lastNoSurat);

    // Lakukan pengecekan untuk memastikan format bulan dan tahun sesuai dengan yang diinginkan
    $currentMonth = date('m');
    $currentYear = date('Y');

    if ($currentMonth == $lastMonth && $currentYear == $lastYear) {
        $newNo = $idMax + 1;
    } else {
        $newNo = 1;
    }
    } else {
        // Jika tidak ada "no surat" sebelumnya, beri nomor surat baru mulai dari 1
        $newNo = 1;
    }

    $noSurat = $newNo . '/DO-SU/' . date('m') . '/' . date('Y');

    $id=$this->surat->checkID();
        if ($id==null) {
            $id_baru=$id+1;
            $Surat=new m_surat();
            $Surat->id=$id_baru;
            $Surat->no_surat=$noSurat;
            $Surat->po_number = $request->po_number;
            $Surat->tanggal = $request->tanggal;
            $Surat->pengirim = $request->pengirim;
            $Surat->penerima = $request->penerima;
            $Surat->status="On Progress";
            $Surat->tanggal_terbit=date('Y-m-d');
            $Surat->save();
            foreach ($request->data_table as $item) {
                $detilSurat = new m_detail_surat;
                $detilSurat->no_surat = $Surat->no_surat; // Jika menggunakan model Surat
                $detilSurat->part_no = $item['part_no'];
                $detilSurat->part_name = $item['part_name'];
                $detilSurat->qty = $item['qty'];
                $detilSurat->unit = $item['unit'];
                $detilSurat->order_number = $item['order_number'];
                $detilSurat->save();
                //jika belum ada, tambah row baru
                $totalItem = $this->PO->groupItem($item['order_number']);
                if($this->PO->validateOrderNumber($item['order_number']) == NULL){
                    foreach ($totalItem as $items) {
                            $sisa = intval($items->order_qty) - intval($item['qty']);
                            $data = [
                                'no_surat'=>$Surat->no_surat,
                                'order_number'=>$item['order_number'],
                                'tanggal'=>$request->tanggal,
                                'part_name'=>$item['part_name'],
                                'qty_requested'=>$items->order_qty,
                                'qty_sent'=>$item['qty'],
                                'sisa'=>$sisa
                            ];
                            //update jumlah item pada table purchasing_details by order number dan id po
                            $this->PO->updateStock($items->id_po,$item['order_number'],$sisa); 
                            //add ke table stocks
                            $this->PO->addData('stocks',$data); 
                    }
                }

            }
        }else{
            $idMax=$this->surat->maxIditem();
            $id_baru=$idMax+1;
            $Surat=new m_surat();
            $Surat->id=$id_baru;
            $Surat->no_surat=$noSurat;
            $Surat->po_number = $request->po_number;
            $Surat->tanggal = $request->tanggal;
            $Surat->pengirim = $request->pengirim;
            $Surat->penerima = $request->penerima;
            $Surat->status="On Progress";
            $Surat->tanggal_terbit=date('Y-m-d');
            $Surat->save();
            foreach ($request->data_table as $item) {
                $detilSurat = new m_detail_surat;
                $detilSurat->no_surat = $Surat->no_surat; // Jika menggunakan model Surat
                $detilSurat->part_no = $item['part_no'];
                $detilSurat->part_name = $item['part_name'];
                $detilSurat->qty = $item['qty'];
                $detilSurat->unit = $item['unit'];
                $detilSurat->order_number = $item['order_number'];
                $detilSurat->save();
                $totalItem = $this->PO->groupItem($item['order_number']);
                    foreach ($totalItem as $items) {
                        $sisa = intval($items->order_qty) - intval($item['qty']);
                        $data = [
                            'no_surat'=>$Surat->no_surat,
                            'order_number'=>$item['order_number'],
                            'tanggal'=>$request->tanggal,
                            'part_name'=>$item['part_name'],
                            'qty_requested'=>$items->order_qty,
                            'qty_sent'=>$item['qty'],
                            'sisa'=>$sisa
                        ];
                        //update jumlah item pada table purchasing_details by order number dan id po
                        $this->PO->updateStock($items->id_po,$item['order_number'],$sisa); 
                        //add ke table stocks
                        $this->PO->addData('stocks',$data);  
                    }
            }
        }
        // Redirect ke halaman atau rute yang diinginkan setelah berhasil menyimpan data
        // $this->countSisaBarang();
        return redirect()->route('subcon.surat.index')->with('success', 'Data berhasil disimpan.');
    }



    public function editSurat_Subcon($id)
    {
        $data = [
            'surat' => $this->surat->headSurat($id),
            'detail'=> $this->surat->detailSurat($id),
            'po_details'=> $this->surat->getPoBySurat($id)
        ];

        Session::put('id_po', $data['po_details']->id_po);
        $no = 1;
        foreach ($data['detail'] as $session) {
            Session::put('qty_sent'.$no.'', $session->qty_sent);
            Session::put('qty_req'.$no.'', $session->qty_requested);
            $no++;
        }
        return view('subcon.surat.edit', $data);
    }

    public function readSurat_Subcon($id)
    {
        $data = [
            'perusahaan' => $this->surat->detailPengirim($id),
            'surat' => $this->surat->headSurat($id),
            'detail'=> $this->surat->detailSurat2($id)
        ];
        return view('subcon.surat.read', $data);
    }

    public function updateSurat_Subcon(Request $request, $id)
    {
        $surat = m_surat::where('id', $id)->firstOrFail();

        // Validasi input dari form
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'qty.*' => 'required|numeric',
        ]);

        $surat->tanggal = $request->input('tanggal');
        // Update atribut-atribut lainnya pada model Surat
        $surat->save();
        
        // Update detail surat jalan
        foreach ($request->input('qty') as $index => $qty) {
            $detail = m_detail_surat::findOrFail($request->input('detail_id')[$index]);
            //validasi jika qty existing tidak sama dengan qty yang dikirim
            if($detail->qty !== $qty){
                $this->returnQtyPO($detail->order_number,$qty);
            }
            $detail->qty = $qty;
            // Update atribut-atribut detail lainnya pada model DetailSurat
            $detail->save();
        }

        // Mengembalikan pengguna ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('subcon.surat.index')->with('success', 'Surat jalan berhasil diperbarui.');
    }

    public function returnQtyPO($ord_num,$qty){
        $id_po = Session::get('id_po');
        $no=1;
            if($this->PO->detailPOByOrderNumber($ord_num)){
                $qty_req = Session::get('qty_req'.$no);
                $back_qty = $qty_req - $qty;
                $this->PO->updatePODetails($ord_num,$id_po,['order_qty'=>$back_qty]);
                $this->PO->editData('stocks','order_number',$ord_num,[
                    'sisa'=> $back_qty,
                    'qty_sent' => $qty
                ]);
                $no++;
            }
    }

    public function destroySurat_Subcon(Request $request)
    {
        $id = $request->input('no_surat');
        $surat = m_surat::find($id);
        if (!$surat) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        
        //Ubah detail PO
        $stock = $this->surat->getStockBySurat($id);
        $this->PO->updatePODetail($stock->order_number,['order_qty'=>$stock->qty_requested]);

        //Hapus data stok
        $this->surat->deleteRow('stocks','no_surat',$id);
        // Hapus detail surat terlebih dahulu karena memiliki relasi dengan no_surat
        $surat->detailSurat1()->delete();
        // Hapus data surat
        $surat->delete();
        return redirect()->route('subcon.surat.index')->with('success', 'Berhasil Dihapus');
    }

    public function subcon_scanSurat()
    {
        return view('subcon.suratSup.scan');
    }


    // surat supplier
    public function tampilSurat_supplier()
    {
        $nama = Auth::user()->nama;
        $data = [
            'surat' => $this->surat->mySurat_supplier($nama),
        ];
        return view('supplier.surat.index', $data);
    }

    public function createSurat_supplier()
    {
        $id = Auth::user()->id;
        $data = [
            'po' => $this->PO->myPO_supp($id),
        ];
        return view('supplier.surat.create', $data);
    }


    // tambah surat supplier
    public function ambilData_po_supplier($selectedValue){
        $id = Auth::user()->id;
        $data = $this->PO->ambilData_posupp($selectedValue,$id);
        $tujuan =  $this->PO->ambilData_posupp_tujuan($selectedValue,$id);
        return response()->json(['data' => $data,'tujuan' => $tujuan]);
    }
    public function ambilData_dpo_supplier($combinedData){
        // Anda dapat memisahkan kembali data yang telah digabungkan
        list($selectedPartno, $selectedPoNumber) = explode('_', $combinedData);
        $id = Auth::user()->id;
        $data = $this->PO->ambilData_dposupp($selectedPartno, $selectedPoNumber,$id);
        return response()->json(['data' => $data]);
    }
    public function storeSurat_supplier(Request $request)
    {
        // Validasi data yang diterima dari permintaan AJAX
      $request->validate([
        'po_number' => 'required',
        'tanggal' => 'required',
        'pengirim' => 'required',
        'penerima' => 'required',
        'data_table' => 'required', // Data tabel harus berupa array dengan minimal 1 elemen
        'data_table.*.part_no' => 'required',
        'data_table.*.part_name' => 'required',
        'data_table.*.qty' => 'required',
        'data_table.*.unit' => 'required',
        'data_table.*.order_number' => 'required',
    ]);
    $lastSurat = m_surat::orderBy('no_surat', 'desc')->first();

if ($lastSurat) {
    $lastNoSurat = $lastSurat->no_surat;
    $idMax=$this->surat->maxIditem();
    list($lastNo, $lastDoSi, $lastMonth, $lastYear) = explode('/', $lastNoSurat);

    // Lakukan pengecekan untuk memastikan format bulan dan tahun sesuai dengan yang diinginkan
    $currentMonth = date('m');
    $currentYear = date('Y');

    if ($currentMonth == $lastMonth && $currentYear == $lastYear) {
        $newNo = $idMax + 1;
    } else {
        $newNo = $idMax + 1;
    }
} else {
    // Jika tidak ada "no surat" sebelumnya, beri nomor surat baru mulai dari 1
    $newNo = 1;
}

    $noSurat = $newNo . '/DO-SI/' . date('m') . '/' . date('Y');

    $id=$this->surat->checkID();
        if ($id==null) {
            $id_baru=$id+1;
            $Surat=new m_surat();
            $Surat->id=$id_baru;
            $Surat->no_surat=$noSurat;
            $Surat->po_number = $request->po_number;
            $Surat->tanggal = $request->tanggal;
            $Surat->pengirim = $request->pengirim;
            $Surat->penerima = $request->penerima;
            $Surat->status="On Progress";
            $Surat->tanggal_terbit=date('Y-m-d');
            $Surat->save();

            foreach ($request->data_table as $item) {
                $detilSurat = new m_detail_surat;
                $detilSurat->no_surat = $Surat->no_surat; // Jika menggunakan model Surat
                $detilSurat->part_no = $item['part_no'];
                $detilSurat->part_name = $item['part_name'];
                $detilSurat->qty = $item['qty'];
                $detilSurat->unit = $item['unit'];
                $detilSurat->order_number = $item['order_number'];
                $detilSurat->save();
            }
        }
        else {
            $idMax=$this->surat->maxIditem();
            $id_baru=$idMax+1;
            $Surat=new m_surat();
            $Surat->id=$id_baru;
            $Surat->no_surat=$noSurat;
            $Surat->po_number = $request->po_number;
            $Surat->tanggal = $request->tanggal;
            $Surat->pengirim = $request->pengirim;
            $Surat->penerima = $request->penerima;
            $Surat->status="On Progress";
            $Surat->tanggal_terbit=date('Y-m-d');
            $Surat->save();

            foreach ($request->data_table as $item) {
                $detilSurat = new m_detail_surat;
                $detilSurat->no_surat = $Surat->no_surat; // Jika menggunakan model Surat
                $detilSurat->part_no = $item['part_no'];
                $detilSurat->part_name = $item['part_name'];
                $detilSurat->qty = $item['qty'];
                $detilSurat->unit = $item['unit'];
                $detilSurat->order_number = $item['order_number'];
                $detilSurat->save();
            }
        }
        // Redirect ke halaman atau rute yang diinginkan setelah berhasil menyimpan data
        return redirect()->route('supplier.surat.index')->with('success', 'success');
    }
    public function destroySurat_supplier(Request $request)
    {
        $id = $request->input('no_surat');
        $surat = m_surat::find($id);
        if (!$surat) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        // Hapus detail surat terlebih dahulu karena memiliki relasi dengan no_surat
        $surat->detailSurat1()->delete();
        // Hapus data surat
        $surat->delete();
        return redirect()->route('subcon.surat.index')->with('success', 'Berhasil Dihapus');
    }
    public function editSurat_supplier($no)
    {
        $data = [
            'surat' => $this->surat->headSurat($no),
            'detail'=> $this->surat->detailSurat2($no)
        ];
        return view('supplier.surat.edit', $data);
    }
    public function updateSurat_supplier(Request $request, $id)
    {
        $surat = m_surat::where('id', $id)->firstOrFail();

        // Validasi input dari form
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'qty.*' => 'required|numeric',
        ]);

        $surat->tanggal = $request->input('tanggal');
        // Update atribut-atribut lainnya pada model Surat

        $surat->save();

        // Update detail surat jalan
        foreach ($request->input('qty') as $index => $qty) {
            $detail = m_detail_surat::findOrFail($request->input('detail_id')[$index]);
            $detail->qty = $qty;
            // Update atribut-atribut detail lainnya pada model DetailSurat
            $detail->save();
        }

        // Mengembalikan pengguna ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('supplier.surat.index')->with('success', 'Surat jalan berhasil diperbarui.');
    }
    public function readSurat_Supplier($id)
    {
        $data = [
            'perusahaan' => $this->surat->detailPengirim($id),
            'surat' => $this->surat->headSurat($id),
            'detail'=> $this->surat->detailSurat2($id)
        ];
        return view('supplier.surat.read', $data);
    }








    // Ajax
    public function detailPO($no)
    {
        $data = [
            'PO' => $this->PO->detailData($no)
        ];

        return view('subcon.po.detail', $data);
    }

    public function ubahStatus(Request $request)
    {
        $id = $request->id;
            $data = [
                'status' => "Finish",
            ];
        $this->surat->editStatusSuratSup($id, $data);
    }

    public function hki_lihatSurat($id)
    {
        $data = [
            'perusahaan' => $this->surat->detailPengirim($id),
            'surat' => $this->surat->headSurat($id),
            'detail'=> $this->surat->detailSurat2($id)
        ];
        return view('hki.surat.read', $data);
    }
    public function hki_tampilSurat(Request $request)
    {
        $no = $request->input('additionalData1');
        $data = [
            'perusahaan' => $this->surat->detailPengirim2($no),
            'surat' => $this->surat->headSurat2($no),
            'detail'=> $this->surat->detailSurat3($no)
        ];
        return view('hki.surat.read', $data);
    }
}
