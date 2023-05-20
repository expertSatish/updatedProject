<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper as Helpers;
use Illuminate\Http\Request;

class PageController extends Controller{
    public function __invoke($alias){
        $nav_id = DB::table('nav_category')->where('alias', $alias)->first();
        if(empty($nav_id)){ abort(404);}
        $id = $nav_id->id;
        $process_heading = DB::table('nav_heading')->where('category_id', $id)->where('role', 1)->first();
        $advantages_heading = DB::table('nav_heading')->where('category_id', $id)->where('role', 2)->first();
        $documents_heading = DB::table('nav_heading')->where('category_id', $id)->where('role', 3)->first();
        $pre_requirement_heading = DB::table('nav_heading')->where('category_id', $id)->where('role', 4)->first();
        $annual_roc_heading = DB::table('nav_heading')->where('category_id', $id)->where('role', 5)->first();
        $pricing_heading = DB::table('nav_heading')->where('category_id', $id)->where('role', 6)->first();
        $faq_heading = DB::table('nav_heading')->where('category_id', $id)->where('role', 7)->first();
        $pre_requirment_list_heading = DB::table('pre_requirement_heading')->where('category_id', $id)->first();
        return view('service', compact('id', 'process_heading', 'advantages_heading', 'documents_heading', 'pre_requirement_heading', 'annual_roc_heading', 'pricing_heading', 'faq_heading', 'pre_requirment_list_heading'));
    }   
}