<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class WithdrawalRequest extends Model
{
    use HasFactory, softDeletes;
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function userbank(){
        return $this->hasOne(UserBank::class,'id','bank_id');
    }
    public function expertbank(){
        return $this->hasOne(ExpertBank::class,'id','bank_id');
    }
    public function expert(){
        return $this->hasOne(Expert::class,'id','expert_id');
    }
}
