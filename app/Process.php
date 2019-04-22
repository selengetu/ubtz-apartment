<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    public $timestamps = false;
    protected $table='Project_process';
    protected $primaryKey = 'process_id';
}
