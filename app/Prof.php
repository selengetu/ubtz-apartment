<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prof extends Model
{
    public $timestamps = false;
    protected $table='Const_profession';
    protected $primaryKey = 'profession_id';
}
