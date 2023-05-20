<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    protected $table    =   'online_payment';
    public $timestamps  =    false;
    public $primaryKey  =    'online_payment_id';
    protected $fillable     = [
        'name', 'amount', 'email', 'contact', 'message'
    ];
}
