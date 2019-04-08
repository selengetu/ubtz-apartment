<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constructor extends Model
{
    public $timestamps = false;
    protected $table='Const_department';
    protected $primaryKey = 'department_id';
}
