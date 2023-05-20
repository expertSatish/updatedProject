<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProductBanner extends Model
{
    protected $table = 'product_sliders';
    protected $primaryKey = "id";
    protected $fillable = ['title','text_1','text_2','img_alt','image'];
    
    
}
