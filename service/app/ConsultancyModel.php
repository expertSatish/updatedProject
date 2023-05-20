<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultancyModel extends Model
{
    protected $table    =   'consultancy_enquiry';
    public $timestamps  =    false;
    public $primaryKey  =    'consultancy_enquiry_id';
    protected $fillable     = [
        'name', 'email', 'phone', 'message'
    ];
}
