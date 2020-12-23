<?php

namespace App\Exports;

use App\Beverage;
use Maatwebsite\Excel\Concerns\FromCollection;

class BeverageExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Beverage::all();
    }
}
