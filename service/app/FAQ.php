<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FAQ extends Model
{
   protected $table = 'faq';
   protected $primaryKey = 'Id';    
   protected $fillable = []; 
}
