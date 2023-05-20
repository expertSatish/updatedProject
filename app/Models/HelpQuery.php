<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HelpQuery extends Model
{
    use HasFactory,SoftDeletes;
    public function user(){
        return $this->hasOne(User::class,'id','type_id');
    }
    public function expert(){
        return $this->hasOne(Expert::class,'id','type_id');
    }
}
