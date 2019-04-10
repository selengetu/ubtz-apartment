<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projecttype extends Model
{
    public $timestamps = false;
    protected $table='Const_project_type';
    protected $primaryKey = 'project_type_id';
}
