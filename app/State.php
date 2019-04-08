<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $timestamps = false;
    protected $table='Const_state';
    protected $primaryKey = 'state_id';
}
