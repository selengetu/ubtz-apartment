<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hurungu extends Model
{
    public $timestamps = false;
    protected $table='investment';
    protected $primaryKey = 'investment_id';
}
