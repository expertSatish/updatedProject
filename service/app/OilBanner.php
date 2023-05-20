<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class OilBanner extends Model
{
    protected $table = 'oil_sliders';
    protected $primaryKey = "id";
    protected $fillable = ['title','text_1','img_alt','image'];
    
    
}
