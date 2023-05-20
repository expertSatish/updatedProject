<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpertVideo extends Model
{
    use HasFactory,SoftDeletes;
    public function expert(){
        return $this->hasOne(Expert::class,'id','expert_id');
    }
    public function clicks(){
        return $this->hasMany(ExpertVideoClick::class,'video_id','id');
    }
}
