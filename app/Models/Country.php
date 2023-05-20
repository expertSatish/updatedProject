<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory,SoftDeletes;

    public static function getName($id)
    {
        $data = Country::select('name')->where('id', $id)->first();
        return ($data)?$data->name:'';
    }
}
