<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeverageTransaksi extends Model
{
    //
    protected $table = "beverage_transaksi";

    protected $fillable = ['id_transaksi', 'jumlah_pembayaran', 'id_customer'];
}
