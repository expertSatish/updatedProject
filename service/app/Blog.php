<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table    =   'blog_post';
    public $timestamps  =    false;
    public $primaryKey  =    'post_id';
   
}
