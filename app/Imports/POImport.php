<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use app\Models\m_purchasingOrder;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToCollection;

class POImport implements ToCollection,WithStartRow
{
    public function __construct()
    {
        $this->PO = new m_purchasingOrder();

    }

    /**
    * @param Collection $collection
    */
    public function startRow(): int
    {
        return 5;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        { 
            if($row[1]==="4=Credit Card" || $row[1]==NULL){
                echo 'gagal upload';
            }else{
                $detail_po = [
                    'id_po' => $this->PO->getIdPo(),
                    'part_no' => $row[1],
                    'part_name' => $row[2],
                    'order_qty' => $row[5],
                    'delivery_time' => Date::excelToDateTimeObject($row[18]),
                    'unit' => $row[6],
                    'unit_price' => $row[9],
                    'amount' => $row[10],
                    'order_number' => $row[11]
                ];
                $this->PO->addData('purchasing_details',$detail_po);
            }
        }

    }
}
