<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = false;
    protected $table='Project';
    protected $primaryKey = 'project_id';
}
