<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(){
        $lists = \App\Models\Faq::latest()->paginate(20);
        return view('admin.faq.list',compact('lists'));
    }
    public function New(){
        $categories = \App\Models\FaqCategory::where(['faq_categories.is_publish'=>1]);
        $categories = $categories->get();
        return view('admin.faq.add',compact('categories'));    
    }
    public function Edit($Id){
        $data = \App\Models\Faq::find($Id);
        if(empty($data )){ abort(404); }
        $categories = \App\Models\FaqCategory::where(['is_publish'=>1,'parent'=>0])->get();
        return view('admin.faq.edit',compact('data','categories'));    
    }
    public function Save(Request $r){
        $validated = $r->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]); 
        $data = new \App\Models\Faq();
        $data->title = $r->title;
        $data->alias = generatealias('faqs','alias',$r->title);
        $data->sequence = (\App\Models\Faq::max('sequence') + 1); 
        $data->description = $r->description;
        $data->category_id = $r->category ?? 0;
        $data->meta_title = $r->meta_title ?? $r->title;
        $data->meta_keywords = $r->meta_keywords ?? $r->title;
        $data->meta_description = $r->meta_description ?? $r->title;
        $data->save();
        return back()->with('success', 'Data have been saved successfully.');
    }
    public function Update(Request $r){
        $validated = $r->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]); 
        
        $data = \App\Models\Faq::find($r->preid);
        $data->title = $r->title;
        if($r->title!=$r->oldtitle){ $data->alias = generatealias('faqs','alias',$r->title); } 
        $data->description = $r->description;
        $data->category_id = $r->category ?? 0;
        $data->meta_title = $r->meta_title ?? $r->title;
        $data->meta_keywords = $r->meta_keywords ?? $r->title;
        $data->meta_description = $r->meta_description ?? $r->title;
        $data->save();
        return back()->with('success', 'Data have been updated!');
    }
    public function Remove($removeId){
        $Data = \App\Models\Faq::find($removeId);
        $Data = $Data->delete();
        return back()->with('success', 'Data have been remove successfully.');
    }
    public function bulkdestory(Request $request){
        if(empty($request->check)){ return back()->with(['error' => 'Please choose at least one data.']); }
        foreach($request->check as $removeId){
            $data = \App\Models\Faq::find($removeId);            
            $data->delete();           
        }
        return back()->with('success', 'Data Removed!');
    }
    public function status(Request $request){
        \App\Models\Faq::where('id',$request->id)->update(['is_publish'=>$request->status]);
        return response()->json([
            'success' => 'Status updated!'
        ]);
    }
    public function homestatus(Request $request){
        \App\Models\Faq::where('id',$request->id)->update(['is_home'=>$request->status]);
        return response()->json([
            'success' => 'Status updated!'
        ]);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence){
            $data = \App\Models\Faq::find($id);
            $data->sequence = $sequence;
            $data->save();
        }
        return back()->with(['success' => 'Sequence updated!']);
    }
}
