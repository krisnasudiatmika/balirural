<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bvg_transaksi extends Model
{
    //
    protected $table = "bvg_transaksis";

    protected $fillable = ['jumlah_pembelian', 'invoice'];
}
