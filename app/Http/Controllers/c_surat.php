<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\m_user;
use App\Models\m_role;
use App\Models\m_purchasingOrder;
use App\Models\m_surat;
use App\Models\m_detail_surat;

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
        $this->countSisaBarang();
        return redirect()->route('subcon.surat.index')->with('success', 'Data berhasil disimpan.');
    }


    public function countSisaBarang(){
        $qty_group_item = $this->PO->qtyGroupPerItem();
        $sumPOSent = $this->PO->getSumPoSent();
        // dd($sumPOSent);
        //Looping data item beserta QTY PO untuk dapat nama part dan jumlah dari table purchasing details
        //Looping data item beserta QTY PO yang dikirimkan subcon dari table surat_details
        foreach($qty_group_item as $qty_item){
            foreach($sumPOSent as $sumSent){
                    if($sumSent->tanggal <= date("Y-m-d H:i:s")){
                        $lastSisa = $this->PO->maxIdStocks($sumSent->order_number);
                        if($lastSisa == NULL){
                            if($qty_item->order_number === $sumSent->order_number){
                                //jika jumlah data row == 1
                                $sisa = $qty_item->order_qty - $sumSent->qty_sent;
                                    $data = [
                                            'no_surat'=>$sumSent->no_surat,
                                            'order_number'=>$sumSent->order_number,
                                            'tanggal'=>$sumSent->tanggal,
                                            'part_name'=>$sumSent->part_name,
                                            'qty_requested'=>$qty_item->order_qty,
                                            'qty_sent'=>$sumSent->qty_sent,
                                            'sisa'=>$sisa
                                    ];
                                //add ke table stocks
                                $this->PO->addData('stocks',$data);
                                //update jumlah item pada table purchasing_details by order number dan id po
                                $this->PO->updateStock($qty_item->id_po,$sumSent->order_number,$sisa);
                            }
                        }else{
                            if($this->PO->validateOrderNumber($sumSent->order_number) !== NULL){
                                //jika jumlah data row == 1
                                $sisa = $qty_item->order_qty - $sumSent->qty_sent;
                                    $data = [
                                            'no_surat'=>$sumSent->no_surat,
                                            'order_number'=>$sumSent->order_number,
                                            'tanggal'=>$sumSent->tanggal,
                                            'part_name'=>$sumSent->part_name,
                                            'qty_requested'=>$qty_item->order_qty,
                                            'qty_sent'=>$sumSent->qty_sent,
                                            'sisa'=>$sisa
                                    ];
                                //add ke table stocks
                                $this->PO->editData('stocks','no_surat',$sumSent->no_surat,$data);
                                //update jumlah item pada table purchasing_details by order number dan id po
                                $this->PO->updateStock($qty_item->id_po,$sumSent->order_number,$sisa);
                            }
                        }
                    }else{
                        dd($sumSent->part_name);
                    }
            }  
        }  
            
    }

    public function countBarang(){
        $qty_group_item = $this->PO->qtyGroupPerItem();
        $sumPOSent = $this->PO->getSumPoSent();
        //Looping data item beserta QTY PO untuk dapat nama part dan jumlah dari table purchasing details
        //Looping data item beserta QTY PO yang dikirimkan subcon dari table surat_details
        foreach($qty_group_item as $qty_item){
            foreach($sumPOSent as $sumSent){
                $valOrderNumber =$this->PO->validateOrderNumber($sumSent->order_number);
                //Validasi jika terdapat nama item yang sama dari tabel purchasing_details dan surat_details
                if($qty_item->part_name === $sumSent->part_name){
                    //Jika terdapat data yang sama, lanjutkan kondisi jika tanggal di table surat <= current date
                    if($sumSent->tanggal <= date('Y-m-d H:i:s')){
                        // dd($sumSent);
                        $lastSisa = $this->PO->maxIdStocks($sumSent->order_number);
                        if($this->PO->validateNoSurat($sumSent->no_surat) !== NULL){
                            if(count($sumPOSent) == 1){
                                // dd($sumSent->no_surat);
                                // if()
                                if($qty_item->order_number === $sumSent->order_number){
                                    //jika jumlah data row == 1
                                    $sisa = $lastSisa - $sumSent->qty_sent;
                                    // dd($sumSent->qty_sent);
                                    $data = [
                                        'no_surat'=>$sumSent->no_surat,
                                        'order_number'=>$sumSent->order_number,
                                        'tanggal'=>$sumSent->tanggal,
                                        'part_name'=>$sumSent->part_name,
                                        'qty_requested'=>$qty_item->order_qty,
                                        'qty_sent'=>$sumSent->qty_sent,
                                        'sisa'=>$sisa
                                    ];
                                    //add ke table stocks
                                    $this->PO->editData('stocks','no_surat',$sumSent->no_surat,$data);
                                    //update jumlah item pada table purchasing_details by order number dan id po
                                    $this->PO->updateStock($qty_item->id_po,$sumSent->order_number,$sisa);
                                }
                            }else{
                                //jika jumlah data row > 1
                                if($qty_item->order_number === $sumSent->order_number){
                                    $sisa = $qty_item->order_qty - $sumSent->qty_sent;
                                    $data = [
                                        'no_surat'=>$sumSent->no_surat,
                                        'order_number'=>$sumSent->order_number,
                                        'tanggal'=>$sumSent->tanggal,
                                        'part_name'=>$sumSent->part_name,
                                        'qty_requested'=>$qty_item->order_qty,
                                        'qty_sent'=>$sumSent->qty_sent,
                                        'sisa'=>$sisa
                                    ];
    
                                    //add ke table stocks
                                    $this->PO->editData('stocks','no_surat',$sumSent->no_surat,$data);
                                    //update jumlah item pada table purchasing_details by order number dan id po
                                    $this->PO->updateStock($qty_item->id_po,$sumSent->order_number,$sisa);  
                                }

                            }
                        }else{
                            if($this->PO->validateOrderNumber($sumSent->order_number)!== NULL){
                                // dd($sumSent->order_number);
                                if(count($sumPOSent) == 1){
                                    if($qty_item->order_number === $sumSent->order_number){
                                        //jika jumlah data row == 1
                                        $sisa = $lastSisa - $sumSent->qty_sent;
                                        $data = [
                                            'no_surat'=>$sumSent->no_surat,
                                            'order_number'=>$sumSent->order_number,
                                            'tanggal'=>$sumSent->tanggal,
                                            'part_name'=>$sumSent->part_name,
                                            'qty_requested'=>$lastSisa,
                                            'qty_sent'=>$sumSent->qty_sent,
                                            'sisa'=>$sisa
                                        ];

                                        //add ke table stocks
                                        $this->PO->addData('stocks',$data);
                                        //update jumlah item pada table purchasing_details by order number dan id po
                                        $this->PO->updateStock($qty_item->id_po,$sumSent->order_number,$sisa);
                                    }
                                }else{
                                    if($qty_item->order_number === $sumSent->order_number){
                                        //jika jumlah data row == 1
                                        $sisa = $lastSisa - $sumSent->qty_sent;
                                        $data = [
                                            'no_surat'=>$sumSent->no_surat,
                                            'order_number'=>$sumSent->order_number,
                                            'tanggal'=>$sumSent->tanggal,
                                            'part_name'=>$sumSent->part_name,
                                            'qty_requested'=>$lastSisa,
                                            'qty_sent'=>$sumSent->qty_sent,
                                            'sisa'=>$sisa
                                        ];

                                        //add ke table stocks
                                        $this->PO->addData('stocks',$data);
                                        //update jumlah item pada table purchasing_details by order number dan id po
                                        $this->PO->updateStock($qty_item->id_po,$sumSent->order_number,$sisa);
                                    }
                                }
                                // die;
                            }else{
                                dd($sumSent->order_number);
                                if($qty_item->order_number === $sumSent->order_number){
                                    //jika jumlah data row == 1
                                    $sisa = $qty_item->order_qty - $sumSent->qty_sent;
                                    $data = [
                                        'no_surat'=>$sumSent->no_surat,
                                        'order_number'=>$sumSent->order_number,
                                        'tanggal'=>$sumSent->tanggal,
                                        'part_name'=>$sumSent->part_name,
                                        'qty_requested'=>$qty_item->order_qty,
                                        'qty_sent'=>$sumSent->qty_sent,
                                        'sisa'=>$sisa
                                    ];

                                    //add ke table stocks
                                    $this->PO->addData('stocks',$data);
                                    //update jumlah item pada table purchasing_details by order number dan id po
                                    $this->PO->updateStock($qty_item->id_po,$sumSent->order_number,$sisa);
                                }
                            }
                        }                   
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

    public function editSurat_Subcon($id)
    {
        $data = [
            'surat' => $this->surat->headSurat($id),
            'detail'=> $this->surat->detailSurat($id)
        ];
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
            $detail->qty = $qty;
            // Update atribut-atribut detail lainnya pada model DetailSurat
            $detail->save();
        }

        // Mengembalikan pengguna ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('subcon.surat.index')->with('success', 'Surat jalan berhasil diperbarui.');
    }

    public function destroySurat_Subcon(Request $request)
    {
        $id = $request->input('no_surat');
        $surat = m_surat::find($id);
        if (!$surat) {
            return response()->json(['message' => 'Data not found'], 404);
        }
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
            'po' => $this->PO->myPO_Subcon($id),
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
    list($lastNo, $lastDoSi, $lastMonth, $lastYear) = explode('/', $lastNoSurat);

    // Lakukan pengecekan untuk memastikan format bulan dan tahun sesuai dengan yang diinginkan
    $currentMonth = date('m');
    $currentYear = date('Y');

    if ($currentMonth == $lastMonth && $currentYear == $lastYear) {
        $newNo = intval($lastNo) + 1;
    } else {
        $newNo = 1;
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
            'perusahaan' => $this->surat->detailPengirim($no),
            'surat' => $this->surat->headSurat($no),
            'detail'=> $this->surat->detailSurat2($no)
        ];
        return view('hki.surat.read', $data);
    }
}
