<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CurrentOpening extends Model
{
   protected $table = 'current_opening';
   protected $primaryKey = 'Id';    
   protected $fillable = []; 
}
