<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $guarded = [];
	public $timestamps = false;
	protected $primaryKey = 'category_id';
}
