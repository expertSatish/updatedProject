<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpertCategoryController extends Controller
{
    public function index(){
        $lists = \App\Models\ExpertCategory::latest()->paginate(10);
        return view('admin.experts.categtory.list',compact('lists'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255|string|unique:expert_categories,deleted_at,NULL',
            'short_description' => 'required|max:255',
        ],[
            'title.required'=>'title filed is required.',
            'title.unique'=>'this title already exsist.'
        ]);
        
        $data = new \App\Models\ExpertCategory();
        $data->title = $request->title;        
        $data->short = $request->short_description;
        $data->alias = generatealias('expert_categories','alias',$request->title);
        $data->is_publish = 1;
        $data->sequence = (\App\Models\ExpertCategory::max('sequence') + 1);
        $data->save();
        return back()->with(['success'=>'Data Saved!']);
    }

    public function edit(Request $request){
        $lists = \App\Models\ExpertCategory::find($request->id);
        return view('admin.experts.categtory.edit',compact('lists'));
    }    
    public function update(Request $request){
        $request->validate([
            'title' => 'required|max:255|string|unique:expert_categories,title,'.$request->id.',id,deleted_at,NULL',
            'short_description' => 'required|max:255',
        ]);
        $data = \App\Models\ExpertCategory::find($request->id);
        $data->title = $request->title;
        $data->short = $request->short_description;
        if($request->title!=$request->oldtitle){
           $data->alias = generatealias('expert_categories','alias',$request->title);
        }
        $data->save();
        return response()->json([
            'success'=>'Data Updated!'
        ]);
    }
    public function status(Request $request){
        $data =  \App\Models\ExpertCategory::find($request->id);
        $data->is_publish = $request->status;
        $data->save();
    }
    public function homestatus(Request $request){
        $data =  \App\Models\ExpertCategory::find($request->id);
        $data->is_home = $request->status;
        $data->save();
    }
    public function destroy($id){
        $data =  \App\Models\ExpertCategory::find($id)->delete();
        return back()->with(['success'=>'Data Removed!']);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence):
            $data =  \App\Models\ExpertCategory::find($id);
            $data->sequence = $sequence;
            $data->save();
        endforeach;
        return back()->with(['success'=>'Sequence Updated!']);
    }
    public function bulkremove(Request $request){
        if(empty($request->check)){ return back()->with(['error'=>'Please choose at least one data']); }
        foreach($request->check as $id ):
            $data =  \App\Models\ExpertCategory::find($id);
            $data->delete();
        endforeach;
        return back()->with(['success'=>'Data Removed!']);
    }
}
