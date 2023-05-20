<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComposeMessage extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }    
    public function expert(){
        return $this->hasOne(Expert::class,'id','expert_id');
    }    
    public function attechments(){
        return $this->hasMany(ComposeMessageAttachment::class,'message_id','id');
    }
    public function reply(){
        return $this->hasMany(ComposeMessage::class,'reply_id','id');
    }
}
