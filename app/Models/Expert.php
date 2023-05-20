<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Expert extends Authenticatable
{
    use HasFactory, HasFactory, Notifiable,SoftDeletes;
    protected function name() : Attribute{
        return Attribute::make(
            set: fn($value,$userid) => [
                'name' => ucwords($value),
                // 'user_id' => generateexpertno()
            ]
        );
    }
    public function qualification(){
        return $this->hasOne(Qualification::class,'id','highest_qualification');
    }
    
    public function expertcategory(){
        return $this->hasOne(ExpertCategory::class,'id','category');
    }
    public function workingas(){
        return $this->hasOne(Working::class,'id','currently_working_as');
    }
    public function countires(){
        return $this->hasOne(Country::class,'id','country');
    }
    public function states(){
        return $this->hasOne(State::class,'id','state');
    }
    public function cities(){
        return $this->hasOne(City::class,'id','city');
    }
    public function expects(){
        return $this->hasMany(WhatExpect::class,'expert_id','id');
    }
    public function videos(){
        return $this->hasMany(ExpertVideo::class,'expert_id','id');
    }
    public function activevideos(){
        return $this->hasMany(ExpertVideo::class,'expert_id','id')->where('is_publish',1);
    }
    public function slotcharges(){
        return $this->hasMany(SlotCharge::class,'expert_id','id')->where('is_publish',1)->where('charges','>',0)->orderBy('charges','ASC');
    }
    public function defaultcharges(){
        return $this->hasOne(SlotCharge::class,'expert_id','id')->where(['is_publish'=>1])->where('charges','>',0)->orderBy('charges','ASC');
    }
    public function publishreviews(){
        return $this->hasMany(ExpertReview::class,'expert_id','id')->where(['is_publish'=>1]);
    }
    public function reviews(){
        return $this->hasMany(ExpertReview::class,'expert_id','id');
    }
    public function slots(){
        return $this->hasMany(SlotBook::class,'expert_id','id')->where(['payment'=>1]);
    } 
    public function roles(){
        return $this->hasMany(ExpertRole::class,'expert_id','id');
    } 
    public function industries(){
        return $this->hasMany(ExpertIndustry::class,'expert_id','id');
    }   
    public function languages(){
        return $this->hasMany(ExpertLanguage::class,'expert_id','id');
    }  
    public function expertise(){
        // return $this->hasOne(Expertise::class,'id','your_expertise');
        return $this->hasMany(ExpertExpertise::class,'expert_id','id');
    }
    public function availabilities(){
        return $this->hasMany(SlotAvailability::class,'expert_id','id');
    }
}
