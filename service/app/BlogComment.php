<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $table    =   'blog_comment';
    public $timestamps  =    false;
    public $primaryKey  =    'blog_comment_id';
    protected $fillable     = [
        'name', 'email', 'comment', 'status','blog_id'
    ];
    
    public function blog(){
        return $this->hasOne(Blog::class,'post_id','blog_id');
    }
}
