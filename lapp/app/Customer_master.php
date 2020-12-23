<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_master extends Model
{
    protected $table = "customer_masters";

    protected $fillable = ['id_customer', 'jenis', 'kategori', 'hrg_publish', 'hrg_contract'];
    //
}
