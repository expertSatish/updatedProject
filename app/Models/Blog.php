<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class Blog extends Model

{

    use HasFactory,SoftDeletes; 

    public function category()

    {

        return $this->belongsTo(BlogCategory::class);

    }

    public function comments(){

        return $this->hasMany(BlogComment::class)->where('parent',0);

    }

    public function activecomments(){

        return $this->hasMany(BlogComment::class)->where(['status'=>1,'parent'=>0]);

    }

    public function allcomments(){

        return $this->hasMany(BlogComment::class);

    }

}