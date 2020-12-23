<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{

    protected $table = "customers";

    protected $fillable = ['tour_operators', 'address', 'contact', 'title', 'phone', 'fax', 'email'];
    //
}
