<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    public $timestamps = false;
    protected $table='Const_month';
    protected $primaryKey = 'month_id';
}
