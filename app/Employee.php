<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;
    protected $table='Const_employee';
    protected $primaryKey = 'emp_id';
}
