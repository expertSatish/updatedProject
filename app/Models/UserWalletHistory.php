<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserWalletHistory extends Model
{
    use HasFactory,SoftDeletes;
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function booking(){
        return $this->hasOne(SlotBook::class,'id','purchase_booking_id');
    }
}
