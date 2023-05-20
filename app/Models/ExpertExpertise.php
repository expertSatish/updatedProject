<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertExpertise extends Model
{
    use HasFactory;
    public function expertiseinfo(){
        return $this->hasOne(Expertise::class,'id','expertise_id');
    }
}
