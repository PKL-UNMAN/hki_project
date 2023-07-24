<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_masterpart;
use App\Models\m_user;
use App\Models\m_role;

class c_masterpart extends Controller
{
    public function __construct()
    {
        $this->user = new m_user();
        $this->role = new m_role();
        $this->part = new m_masterpart();
       
    }
    public function index()
    {
        $data =[
            'part' => $this->part->datapart(),
        ];
        return view ('hki.managePart.index',$data);
    }
    public function create()
    {
        $data =[
            'produser' => $this->part->Dataproduser(),
        ];
        return view ('hki.managePart.create',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'part_no' => 'required',
            'part_name' => 'required',
            'composition' => 'required|numeric',
            'unit_price' => 'required|numeric',
        ]);
        $id=$this->part->checkID();
        if ($id==null) {
            $id_baru=$id+1;
        // Simpan data ke database berdasarkan request yang diterima
        m_masterpart::create([
            'id_part' => $id_baru,
            'id_user' => $request->id_user,
            'part_no' => $request->part_no,
            'part_name' => $request->part_name,
            'composition' => $request->composition,
            'unit_price' => $request->unit_price,
        ]);
        } else{
            $idMax=$this->part->maxIditem();
            $id_baru=$idMax+1;
            m_masterpart::create([
                'id_part' => $id_baru,
                'id_user' => $request->id_user,
                'part_no' => $request->part_no,
                'part_name' => $request->part_name,
                'composition' => $request->composition,
                'unit_price' => $request->unit_price,
            ]);
        }
        return redirect()->route('hki.part.index')->with('success', 'Part berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $this->part->deleteData($id);
        return redirect()->route('hki.part.index')->with('success','Berhasil Dihapus');
    }
    
}
