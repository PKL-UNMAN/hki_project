<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\m_purchasingOrder;
use App\Models\m_surat;

class c_login extends Controller
{
    public function __construct()
    {
        $this->PO = new m_purchasingOrder();
        $this->surat = new m_surat();
    }
    public function login_hki()
    {
        return view('login_hki');
    }

    public function login_subcon()
    {
        return view('login_subcon');
    }

    public function login_supplier()
    {
        return view('login_subcon');
    }


    public function check(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required'=>'Username wajib terisi',
            'password.required'=>'Password wajib terisi',
        ]);
        $user = $request->username;
        $pass = $request->password;
        if(auth()->attempt(array('username'=>$user,'password'=>$pass)))
        {
            $request->session()->put('id_user', Auth::user()->id);
            return redirect('/dashboard');
        }
        else
        {
            session()->flash('error', 'Username atau password salah');
            return redirect()->back();
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/');
        // Auth::logout();
        // $request->session()->flush();
        // return redirect()->route('user.login');
    }

    // Login multiuser
    public function dashboard(){
        if (Auth::user()->role_id == "1") {
            $data = [
                'po' => $this->PO->countPo(),
                'poFinish' => $this->PO->poFinish(),
                'poOnProgres' => $this->PO->poOnProgres(),
                'surat' => $this->surat->jumlahSurat(),
                'suratFinish' => $this->surat->suratFinish(),
                'suratOnProgres' => $this->surat->suratOnProgres(),
            ];
            return view('hki.dashboard',compact('data'));
        } elseif(Auth::user()->role_id == "2") {
            $id = Auth::user()->id;
            $nama = Auth::user()->nama;
            $data = [
                'po' => $this->PO->countPo1($id),
                'poFinish' => $this->PO->poFinish1($id),
                'poOnProgres' => $this->PO->poOnProgres1($id),
                'surat' => $this->surat->jumlahSurat1($nama),
                'suratFinish' => $this->surat->suratFinish1($nama),
                'suratOnProgres' => $this->surat->suratOnProgres1($nama),
            ];
            return view('subcon.dashboard',compact('data'));
        }elseif(Auth::user()->role_id == "3") {
            $id = Auth::user()->id;
            $nama = Auth::user()->nama;
            $data = [
                'po' => $this->PO->countPo1($id),
                'poFinish' => $this->PO->poFinish1($id),
                'poOnProgres' => $this->PO->poOnProgres1($id),
                'surat' => $this->surat->jumlahSurat1($nama),
                'suratFinish' => $this->surat->suratFinish1($nama),
                'suratOnProgres' => $this->surat->suratOnProgres1($nama),
            ];
            return view('supplier.dashboard',compact('data'));
        }
       
    }

   
}
