<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Executor extends Model
{
    public $timestamps = false;
    protected $table='Const_executor';
    protected $primaryKey = 'executor_id';
}
