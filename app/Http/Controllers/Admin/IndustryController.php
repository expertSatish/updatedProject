<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public function index(){
        $lists = \App\Models\Industry::latest()->paginate(10);
        return view('admin.industry.list',compact('lists'));
    }
    public function store(Request $request){
       $request->validate([
        'title' => 'required|max:255|string|unique:industries'
       ]);
       $data = new \App\Models\Industry();
       $data->title = $request->title;
       $data->alias = generatealias('industries','alias',$request->title);
       $data->is_publish = 1;
       $data->sequence = (\App\Models\Industry::max('sequence') + 1);
       $data->save();
       return back()->with(['success'=>'Data Saved!']);
    }
    public function edit(Request $request){
        $lists = \App\Models\Industry::find($request->id);
        return view('admin.industry.edit',compact('lists'));
    }    
    public function update(Request $request){
        $request->validate([
            'title' => 'required|max:255|string|unique:industries,title,'.$request->id.',id'
        ]);
        $data = \App\Models\Industry::find($request->id);
        $data->title = $request->title;
        if($request->title!=$request->oldtitle){
           $data->alias = generatealias('industries','alias',$request->title);
        }
        $data->save();
        return response()->json([
            'success'=>'Data Updated!'
        ]);
    }
    public function status(Request $request){
        $data =  \App\Models\Industry::find($request->id);
        $data->is_publish = $request->status;
        $data->save();
    }
    public function destroy($id){
        $data =  \App\Models\Industry::find($id)->delete();
        return back()->with(['success'=>'Data Removed!']);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence):
            $data =  \App\Models\Industry::find($id);
            $data->sequence = $sequence;
            $data->save();
        endforeach;
        return back()->with(['success'=>'Sequence Updated!']);
    }
    public function bulkremove(Request $request){
        if(empty($request->check)){ return back()->with(['error'=>'Please choose at least one data']); }
        foreach($request->check as $id ):
            $data =  \App\Models\Industry::find($id);
            $data->delete();
        endforeach;
        return back()->with(['success'=>'Data Removed!']);
    }
}
