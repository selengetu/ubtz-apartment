<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    public $timestamps = false;
    protected $table='information';
    protected $primaryKey = 'information_id';
}
