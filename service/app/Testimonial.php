<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Testimonial extends Model
{
   protected $table = 'testimonial';
   protected $primaryKey = 'Id';    
   protected $fillable = ['designation','title','content'];     
}
