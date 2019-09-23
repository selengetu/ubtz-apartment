<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public $timestamps = false;
    protected $table='Const_season';
    protected $primaryKey = 'season_id';
}
