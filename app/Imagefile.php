<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagefile extends Model
{
    public $timestamps = false;
    protected $table='Process_img';
    protected $primaryKey = 'img_id';
}
