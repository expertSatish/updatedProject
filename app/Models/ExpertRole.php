<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertRole extends Model
{
    use HasFactory;
    public function roleinfo(){
        return $this->hasOne(Role::class,'id','role');
    }
}
