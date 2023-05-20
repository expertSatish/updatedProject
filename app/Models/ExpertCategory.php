<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpertCategory extends Model
{
    use HasFactory,SoftDeletes;
    public function expertise(){
        return $this->hasMany(Expertise::class,'category_id','id');
    }
}
