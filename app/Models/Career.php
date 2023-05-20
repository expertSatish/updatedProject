<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
class Career extends Model{
    use HasFactory,SoftDeletes;
    // public function title() : Attribute{
    //     return new Attribute(           
    //         set: fn($value)=>[
    //             'title' => $value,
    //             'alias' => generatealias('careers','alias',$value)
    //         ]
    //     );
    // }
    
}
