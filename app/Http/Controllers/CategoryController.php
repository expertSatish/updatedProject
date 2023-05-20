<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __invoke($alias,$subcat=null){
        $category = \App\Models\ExpertCategory::where(['is_publish'=>1,'alias'=>$alias])->first();
        if(empty($category)){ abort(404); }
        $expertise = [];
        foreach($category->expertise as $exp){
            if($subcat==$exp->alias){
                $expertise[]=$exp->id;
            }
            if(empty($subcat)){
                $expertise[]=$exp->id;
            }           
        }
        $experts = \App\Models\Expert::join('expert_expertises as expertises','experts.id','expertises.expert_id');
        $experts = $experts->where('experts.is_publish',1);
        $experts = $experts->whereIn('expertises.expertise_id',$expertise);
        $experts = $experts->groupBy('expertises.expert_id');
        $experts = $experts->select('experts.*');
        $experts = $experts->paginate(50);
        
        return view('expert-category',compact('experts','category'));
    } 
}
