<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Heading extends Model
{
    protected $table    =   'heading';
    public $timestamps  =    false;
    public $primaryKey  =    'heading_id';
    protected $fillable     = [
        'service_id', 'page', 'title', 'description'
    ];
}
