<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Expertise extends Model
{
    use HasFactory,SoftDeletes;
    protected function title() : Attribute{
        return Attribute::make(
            set:fn ($value) => ucwords($value)
        );
    }
    public function category(){
        return $this->hasOne(ExpertCategory::class,'id','category_id');
    }
    public static function getName($id)
    {
        $data = Expertise::select('title')->where('id', $id)->first();
        return ($data)?$data->title:'';
    }
}
