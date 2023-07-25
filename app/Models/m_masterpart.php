<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class m_masterpart extends Model
{
    use HasFactory;
    protected $table = 'master_part';
    protected $primaryKey = 'id_part'; 
    public $timestamps = false;
    protected $fillable = ['id_user', 'part_no', 'part_name', 'composition', 'unit_price'];

    public function checkID()
    {
        return DB::table('master_part')->count();
    }
    public function maxIditem()
    {
        return DB::table('master_part')->max('id_part');
    }
    public function datapart()
    {
        return DB::table('master_part')->join('users','master_part.id_user', '=', 'users.id')->get();
    }
    public function Dataproduser()
    {
        return DB::table('users')->join('users_detail', 'users.id','=','users_detail.id_user')->where('users.role_id', '!=', 1)->get();
    }
    public function ambil_datapart($id_part)
    {
        return DB::table('master_part')->join('users','master_part.id_user', '=', 'users.id')->where('users.role_id', '!=', 1)->where('id_part', $id_part)->first();
    }
    public function deleteData($id)
    {
        return DB::table('master_part')->where('id_part', $id)->delete();
    }
}
