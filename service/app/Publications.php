<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Publications extends Model
{
    protected $table = 'publications';
   protected $primaryKey = 'id';    
   protected $fillable = ['designation','title','date','text','image']; 
}
