<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_detail_surat extends Model
{
    use HasFactory;
    protected $table = 'surat_details';
    public $timestamps = false;
    protected $primaryKey = 'id_detail_surat';
    protected $fillable = [
        'id_detail_surat',
        'no_surat',
        'part_no',
        'part_name',
        'qty',
        'unit',
        'order_number',
    ];
}
