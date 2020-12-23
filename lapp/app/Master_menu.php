<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master_menu extends Model
{
    protected $table = "master_menus";

    protected $fillable = ['id_menu', 'keterangan'];
    //
}
