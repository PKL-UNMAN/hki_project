<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use app\Models\m_purchasingOrder;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToCollection;

class POImport implements ToCollection,WithStartRow
{
    public function __construct($class,$id_tujuan_po)
    {
        $this->class = $class;
        $this->id_tujuan_po = $id_tujuan_po;
        $this->PO = new m_purchasingOrder();

    }
    /**
    * @param Collection $collection
    */
    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        $this->PO->addData('purchasing',[
            'class'=> $this->class,
            'id_tujuan_po'=> $this->id_tujuan_po,
            'delivery_time' => Date::excelToDateTimeObject($rows[0][5]),
            'status' => 'Unsend'
        ]);
        foreach ($rows as $row) 
        {
            $this->PO->addData('purchasing_details',[
                'id_po' => $this->PO->getIdPo(),
                'part_no' => $row[0],
                'part_name' => $row[1],
                'order_qty' => $row[2],
                'unit' => $row[3],
                'unit_price' => $row[4],
                'amount' => $row[6],
                'order_number' => $row[7]
            ]);
        }
        
    }
}
