<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beverage extends Model
{
    protected $table = "beverage";

    protected $fillable = ['id_item', 'jumlah', 'harga_total', 'diskon', 'summary_price', 'invoice'];
    //
}
