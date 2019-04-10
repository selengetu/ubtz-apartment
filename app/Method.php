<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    public $timestamps = false;
    protected $table='Const_method';
    protected $primaryKey = 'method_code';
}
