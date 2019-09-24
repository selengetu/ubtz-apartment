<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessImage extends Model
{
    public $timestamps = false;
    protected $table='V_Project_image2';
    protected $primaryKey = 'img_id';
}
