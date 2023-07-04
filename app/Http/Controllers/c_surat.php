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
        $data = [
            'surat' => $this->surat->allData(),
        ];
        return view('hki.surat.index', $data);
    }

    // END Surat HKI


    // Surat Subcon

    public function tampilSurat_subcon()
    {
        $id = Auth::user()->id;
        $data = [
            'surat' => $this->surat->mySurat_Subcon($id),
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

    public function storeSurat_subcon(Request $request)
    {
        $now = Carbon::now()->format('d-m-Y');
        $validator = Validator::make($request->all(), [
            'part_no' => 'required',
            'id_tujuan' => 'required',
            'part_name' => 'required',
            'order_qty' => 'required',
            'weight' => 'required',
            'order_no' => 'required',
            'po_number' => 'required',
            'delivery_time' => 'required',
            'payment' => 'required',
        ]);

        if ($validator->fails()) {
            session()->flash('error', 'error');
            return redirect()->back();
        } else {
            $id = $this->surat->checkID();
            if ($id == null) {
                $id_baru = $id + 1;
                $data = [
                    'no_surat' => $id_baru,
                    'part_no' => $request->part_no,
                    'id_tujuan' => $request->id_tujuan,
                    'id_subcon' => Auth::user()->id,
                    'part_name' => $request->part_name,
                    'order_qty' => $request->order_qty,
                    'weight' => $request->weight,
                    'order_no' => $request->order_no,
                    'po_number' => $request->po_number,
                    'delivery_time' => $request->delivery_time,
                    'payment' => $request->payment,
                    'dibuat' => $now,
                    'status' => "On Progress",
                ];
            } else {
                $idMax = $this->surat->maxIditem();
                $id_baru = $idMax + 1;
                $data = [
                    'no_surat' => $id_baru,
                    'part_no' => $request->part_no,
                    'id_tujuan' => $request->id_tujuan,
                    'id_subcon' => Auth::user()->id,
                    'part_name' => $request->part_name,
                    'order_qty' => $request->order_qty,
                    'weight' => $request->weight,
                    'order_no' => $request->order_no,
                    'po_number' => $request->po_number,
                    'delivery_time' => $request->delivery_time,
                    'payment' => $request->payment,
                    'dibuat' => $now,
                    'status' => "On Progress",
                ];
            }

            $this->surat->addData($data);
            return redirect()->route('subcon.surat.index')->with('success', 'success');
        }
    }

    public function editSurat_Subcon($no)
    {
        $data = [
            'surat' => $this->surat->detailSurat($no),
            'hki' => $this->user->detailHKI(),
        ];
        return view('subcon.surat.edit', $data);
    }

    public function updateSurat_Subcon(Request $request, $no)
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
        ], [
            'part_no.required' => 'Part Nomor Wajib terisi',
            'id_tujuan.unique' => 'Supplier Wajib Diisi',
            'part_name.required' => 'Part Name Wajib terisi',
            'order_qty.required' => 'Order QTY Wajib terisi',
            'weight.required' => 'Weight Wajib terisi',
            'order_no.required' => 'Order No Wajib terisi',
            'po_number.required' => 'PO Number Wajib terisi',
            'delivery_time.required' => 'Delivery Time Wajib terisi',
        ]);

        $data = [
            'part_no' => $request->part_no,
            'id_tujuan' => $request->id_tujuan,
            'id_subcon' => Auth::user()->id,
            'part_name' => $request->part_name,
            'order_qty' => $request->order_qty,
            'weight' => $request->weight,
            'order_no' => $request->order_no,
            'po_number' => $request->po_number,
            'payment' => $request->payment,
            'delivery_time' => $request->delivery_time,
        ];



        $this->surat->editData($no, $data);
        return redirect()->route('subcon.surat.index')->with('success', 'Surat Berhasil diupdate.');
    }

    public function destroySurat_Subcon($no)
    {
        $this->surat->deleteData($no);
        return redirect()->route('subcon.surat.index')->with('success', 'Berhasil Dihapus');
    }


    // surat supplier
    public function tampilSurat_supplier()
    {
        $id = Auth::user()->id;
        $data = [
            'surat' => $this->surat->mySurat_supplier($id),
        ];
        return view('supplier.surat.index', $data);
    }

    public function createSurat_supplier()
    {
        $data = [
            'supplier' => $this->user->supplierData(),
        ];
        return view('supplier.surat.create', $data);
    }


    // tambah surat supplier
    public function storeSurat_supplier(Request $request)
    {
        $now = Carbon::now()->format('d-m-Y');
        $validator = Validator::make($request->all(), [
            'part_no' => 'required',
            'id_tujuan' => 'required',
            'part_name' => 'required',
            'order_qty' => 'required',
            'weight' => 'required',
            'order_no' => 'required',
            'po_number' => 'required',
            'delivery_time' => 'required',
            'payment' => 'required',
        ]);

        if ($validator->fails()) {
            session()->flash('error', 'error');
            return redirect()->back();
        } else {
            $id = $this->surat->checkID();
            if ($id == null) {
                $id_baru = $id + 1;
                $data = [
                    'no_surat' => $id_baru,
                    'part_no' => $request->part_no,
                    'id_tujuan' => $request->id_tujuan,
                    'id_supplier' => Auth::user()->id,
                    'part_name' => $request->part_name,
                    'order_qty' => $request->order_qty,
                    'weight' => $request->weight,
                    'order_no' => $request->order_no,
                    'po_number' => $request->po_number,
                    'delivery_time' => $request->delivery_time,
                    'payment' => $request->payment,
                    'dibuat' => $now,
                    'status' => "On Progress",
                ];
            } else {
                $idMax = $this->surat->maxIditem();
                $id_baru = $idMax + 1;
                $data = [
                    'no_surat' => $id_baru,
                    'part_no' => $request->part_no,
                    'id_tujuan' => $request->id_tujuan,
                    'id_supplier' => Auth::user()->id,
                    'part_name' => $request->part_name,
                    'order_qty' => $request->order_qty,
                    'weight' => $request->weight,
                    'order_no' => $request->order_no,
                    'po_number' => $request->po_number,
                    'delivery_time' => $request->delivery_time,
                    'payment' => $request->payment,
                    'dibuat' => $now,
                    'status' => "On Progress",
                ];
            }

            $this->surat->addDo($data);
            return redirect()->route('supplier.surat.index')->with('success', 'success');
        }
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
        $no_surat = $request->no_surat;
        $data = [
            'status' => "Finish",
        ];
        $this->surat->editData($no_surat, $data);
    }

    public function hki_lihatSurat(Request $request)
    {
        $no_surat = $request->no_surat;
        $data = [
            'surat' => $this->surat->detailSurat($request->no_surat),
        ];
        return view('hki.surat.read', $data);
    }

    public function subcon_lihatSurat(Request $request)
    {
        $no_surat = $request->no_surat;
        $data = [
            'surat' => $this->surat->detailSuratInSubcon($request->no_surat),
        ];
        return view('subcon.surat.read', $data);
    }
}
