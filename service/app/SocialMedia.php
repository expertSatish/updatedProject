<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table    =   'social_media';
    public $timestamps  =    false;
    public $primaryKey  =    'id';
    protected $fillable     = [
        'name', 'icon', 'link', 'status'
    ];
}
