<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informationtype extends Model
{
    public $timestamps = false;
    protected $table='const_inf_type';
    protected $primaryKey = 'type_id';
}
