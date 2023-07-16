<?php

namespace App\Imports;

use App\Models\Production;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportProduction implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Production([
            //
        ]);
    }
}
