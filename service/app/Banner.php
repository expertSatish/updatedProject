<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Banner extends Model
{
    protected $table = 'sliders';
    protected $primaryKey = "id";
    protected $fillable = ['img_alt','image'];
    
    
}
