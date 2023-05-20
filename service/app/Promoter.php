<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promoter extends Model
{
    protected $table    =   'promoter';
    public $timestamps  =    false;
    public $primaryKey  =    'promoter_id';
    protected $fillable     = [
        'name', 'designation', 'description', 'facebook_url', 'instagram_url', 'twitter_url', 'youtube_url',
        'linkedin_url', 'status', 'image_url',
    ];
}
