<?php

namespace App\Exports;

use App\Models\Production;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportProduction implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('hki.production.export', [
            'export' => Production::groupColumn(),
            'date' => Production::groupDate()
        ]);
    }
}
