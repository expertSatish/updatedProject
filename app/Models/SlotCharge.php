<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SlotCharge extends Model
{
    use HasFactory,SoftDeletes;
    public function time(){
        return $this->hasOne(SlotTime::class,'id','slot_time_id');
    }
}
