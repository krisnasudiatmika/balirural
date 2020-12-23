<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = "inventories";

    protected $fillable = ['nama_inventory', 'baik', 'rusak', 'total'];
    //
}
