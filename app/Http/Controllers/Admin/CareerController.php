<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;
class CareerController extends Controller
{
    public function create(){
        $banners = Career::latest()->paginate(20);
        return view('admin.career.list',compact('banners'));
    }
    public function add(){
        return view('admin.career.add');
    }
    public function edit($editid){
        $data = Career::find($editid);
        if(empty($data)){ return 'Sorry! this data is not available at this moment.'; }
        return view('admin.career.edit',compact('data'));
    }
    public function store(Request $request){
        $request->validate([
            'title'=>'required|max:255',
            'description'=>'required',
        ]);
        $data = new Career();       
        $data->title = $request->title; 
        $data->alias = generatealias('careers','alias',$request->title);
        $data->department = $request->department;
        $data->rol = $request->role;
        $data->location = $request->locations;
        $data->description = $request->description;
        $data->sequence = (Career::max('sequence') + 1);
        $data->meta_title = $request->meta_title ?? $request->title;
        $data->meta_keywords = $request->meta_keywords ?? $request->title;
        $data->meta_description = $request->meta_description ?? $request->title;
        $data->is_publish = 1;
        $data->save();
        return back()->with('success','Data have been saved!');
    }
    public function update(Request $request){
        $request->validate([
            'title'=>'required|max:255',
            'description'=>'required',
        ]);
        $data = Career::find($request->preid);        
        $data->title = $request->title;
        if($request->oldtitle!=$request->title){
            $data->alias = generatealias('careers','alias',$request->title);
        }
        $data->department = $request->department;
        $data->rol = $request->role;
        $data->location = $request->locations;
        $data->description = $request->description;
        $data->meta_title = $request->meta_title ?? $request->title;
        $data->meta_keywords = $request->meta_keywords ?? $request->title;
        $data->meta_description = $request->meta_description ?? $request->title;
        $data->save();
        return back()->with('success','Data have been updated!');
    }
    public function destory($removeId){
        $data = Career::find($removeId);
        $data->delete();
        return back()->with(['success'=>'Data have been removed!']);
    }
    public function bulkdestory(Request $request){
        if(empty($request->check)){ return back()->with(['error' => 'Please choose at least one data.']); }
        foreach($request->check as $removeId){
            $data = Career::find($removeId);
            $data->delete();
        }
        return back()->with(['success'=>'Data have been removed!']);
    }
    public function status(Request $request){
        Career::where('id',$request->id)->update(['is_publish'=>$request->status]);
        return response()->json([
            'success' => 'Status have been updated!'
        ]);
    }
    public function topstatus(Request $request){
        Career::where('id',$request->id)->update(['top'=>$request->status]);
        return response()->json([
            'success' => 'Status have been updated!'
        ]);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence){
            $data = Career::find($id);
            $data->sequence = $sequence;
            $data->save();
        }
        return back()->with(['success' => 'Sequence have been updated!']);
    }
}
