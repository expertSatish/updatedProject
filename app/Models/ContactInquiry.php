<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactInquiry extends Model
{
    use HasFactory,SoftDeletes;
    public function businesssector(){
        return $this->hasOne(ExpertCategory::class,'id','business_sector');
    }
}
