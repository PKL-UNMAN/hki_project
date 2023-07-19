<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Production extends Model
{
    use HasFactory;
    protected $fillable = [
        'line',
        'shift',
        'nilai',
        'tanggal'
    ];
    public $timestamps = false;

    public static function groupDate(){
        return DB::table('productions')
        ->select('tanggal')
        ->groupBy('tanggal')
        ->get();
    }

    public function getData(){
        return DB::table('productions')->get();
    }

    public static function groupingData(){
        return DB::table('productions')
        ->orderBy('tanggal', 'ASC')
        ->get();
    }


}
