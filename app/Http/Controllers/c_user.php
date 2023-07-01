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
use Carbon\Carbon;

class c_user extends Controller
{
    public function __construct()
    {
        $this->user = new m_user();
        $this->role = new m_role();
        $this->surat = new m_surat();
        $this->PO = new m_purchasingOrder();
       
    }
    public function index()
    {
        $data =[
            'user'=> $this->user->allData()
        ];
        return view ('hki.manageUser.index', $data);
    }

    public function create()
    {
        $data =[
            'role'=> $this->role->allData()
        ];
        return view ('hki.manageUser.create', $data);
    }

    public function store(Request $request)
    {
        $now = Carbon::now()->format('d-m-Y');
        $request->validate([
            'company' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required',
            'role_id' => 'required',
            'id_perusahaan' => 'required',
            'class' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'password' => 'required',
        ],[
            'company.required'=>'Nama User Wajib terisi',
            'username.unique'=>'Username Sudah Ada',
            'email.unique'=>'Username Sudah Ada',
            'role_id.required'=>'Role Name Wajib terisi',
            'id_perusahaan.required'=>'ID Perusahaan Name Wajib terisi',
            'class.required'=>'Class Wajib terisi',
            'alamat.required'=>'Alamat Wajib terisi',
            'telepon.required'=>'Nomor Telepon Wajib terisi',
            'password.required'=>'Password Wajib terisi',
        ]);

        $id = $this->user->checkID();
        if($id == null)
        {
            $idMax = $id+1;
            $data = [
                'id'=> $idMax,
                'nama' => $request->company,
                'username'=> $request->username,
                'role_id'=> $request->role_id,
                'password'=> Hash::make($request->password),
                'created_at' =>$now
            ];

            $detail = [
                'id_user'=> $idMax,
                'id_perusahaan'=> $request->id_perusahaan,
                'class'=> $request->class,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'fax'=> $request->fax,
                'alamat' => $request->alamat,
                'user_date'=> $now,
            ];

            
        }else{
            $idMax = $this->user->maxIditem();
            $idBaru = $idMax + 1;
            $data = [
                'id'=> $idBaru,
                'nama' => $request->company,
                'username'=> $request->username,
                'role_id'=> $request->role_id,
                'password'=> Hash::make($request->password),
                'created_at' =>$now
            ];

            $detail = [
                'id_user'=> $idBaru,
                'id_perusahaan'=> $request->id_perusahaan,
                'class'=> $request->class,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'fax'=> $request->fax,
                'alamat' => $request->alamat,
                'user_date'=> $now,
            ];
        }
              
            $this->user->addData($data);
            $this->user->detail_ADD($detail);
            return redirect()->route('hki.user.index')->with('success','User berhasil ditambahkan');
       
    }

    public function edit($id)
    {
        $data =[
            'user'=> $this->user->detailData($id),
            'role'=> $this->role->allData($id),
        ];
        return view ('hki.manageUser.edit', $data);
    }

    public function getProfile($id){
        $data =[
            'profile'=> $this->user->edit($id)
        ];
        return view ('profile', $data);
    }

    public function updateProfile(Request $request, $id)
    {
            $data = [
                'username'=> $request->username
            ];

            $detail = [
                'telepon' => $request->telepon,
                'email' => $request->email,
                'fax'=> $request->fax,
                'alamat' => $request->alamat,
            ];
        $this->user->updateData($id, $data,'users','id');
        $this->user->updateData($id, $detail,'users_detail','id_user');
        return redirect()->route('user.profile',$id)->with('success', 'Profile Berhasil diupdate.');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'nama' => 'required',
        ],[
            'nama.required'=>'Nama User Wajib terisi',
        ]);

        if($request->password <> null){
            $data = [
                'username'=> $request->username,
                'role_id'=> $request->role_id,
                'password'=> Hash::make($request->password),
            ];

            $detail = [
                'telepon' => $request->telepon,
                'email' => $request->email,
                'fax'=> $request->fax,
                'alamat' => $request->alamat,
            ];

        }else{
            $data = [
                'username'=> $request->username,
                'role_id'=> $request->role_id,
                'password'=> Hash::make($request->password),
            ];

            $detail = [
                'telepon' => $request->telepon,
                'email' => $request->email,
                'fax'=> $request->fax,
                'alamat' => $request->alamat,
            ];
           
        }
        $this->user->editData($id, $data);
        $this->user->detail_EDIT($id, $detail);

     
        return redirect()->route('hki.user.index')->with('success', 'User Berhasil diupdate.');
    }

    public function destroy($id)
    {
        $this->user->deleteData($id);
        $this->user->detail_DELETE($id);

        $data = [
            'id_tujuan' => null,
        ];
        $this->PO->jadiLOG($id, $data);

        $data = [
            'id_subcon' => null,
        ];
        $this->surat->jadiLOG($id, $data);



        
        return redirect()->route('hki.user.index')->with('success','Berhasil Dihapus');
    }
}
