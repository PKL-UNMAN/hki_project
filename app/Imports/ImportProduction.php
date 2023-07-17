<?php

namespace App\Imports;

use App\Models\Production;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithStartRow;
// use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class ImportProduction implements WithStartRow, ToModel
{
    private $data;

    public function __construct()
    {
        $this->data = [];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 3;
    }


    public function model(array $row)
    {
        return new Production([
            'line' => $row[0],
            'shift' => $row[1],
            'tanggal' => date('Y-m-d'),
            'nilai' => $row[2],
        ]);
    }
}
