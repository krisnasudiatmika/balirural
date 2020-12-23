<?php

namespace App\Exports;

use App\Exports\TransaksiExport;
use App\Transaksi;
use DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class TransaksiExport implements FromQuery
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function __construct(String $start_date, String $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }
    public function query()
    {
        if (isset($this->start_date) && isset($this->end_date)) {
            return Transaksi::query()->where(DB::Raw("(DATE(created_at))"), '>=', $this->start_date)
                ->where(DB::Raw("(DATE(created_at))"), '<=', $this->end_date);
        } else if (isset($this->start_date)) {
            return Transaksi::query()->where(DB::Raw("(DATE(created_at))"), $this->end_date);
        }
    }

}
