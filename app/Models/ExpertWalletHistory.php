<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpertWalletHistory extends Model
{
    use HasFactory,SoftDeletes;
    public function expert(){
        return $this->hasOne(Expert::class,'id','expert_id');
    }
    public function booking(){
        return $this->hasOne(SlotBook::class,'id','purchase_booking_id');
    }
}
