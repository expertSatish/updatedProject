<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function index(){
        $lists = \App\Models\Mentor::latest()->paginate(10);
        return view('admin.mentor.list',compact('lists'));
    }
    public function store(Request $request){
       $request->validate([
        'title' => 'required|max:255|string|unique:three_icons',
        'description' => 'required'
       ]);
       
       $data = new \App\Models\Mentor();
       $data->title = $request->title;
       $data->description = $request->description ?? '';
       $data->is_publish = 1;
       $data->sequence = (\App\Models\Mentor::max('sequence') + 1);
       $data->save();
       return back()->with(['success'=>'Data Saved!']);
    }
    public function edit(Request $request){
        $lists = \App\Models\Mentor::find($request->id);
        return view('admin.mentor.edit',compact('lists'));
    }    
    public function update(Request $request){
        $request->validate([
            'title' => 'required|max:255|string|unique:three_icons,title,'.$request->id.',id',
            'description' => 'required',
        ]);
        
        $data = \App\Models\Mentor::find($request->id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->save();
        return response()->json([
            'success'=>'Data Updated!'
        ]);
    }
    public function status(Request $request){
        $data =  \App\Models\Mentor::find($request->id);
        $data->is_publish = $request->status;
        $data->save();
    }
    public function destroy($id){
        $data =  \App\Models\Mentor::find($id)->delete();
        return back()->with(['success'=>'Data Removed!']);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence):
            $data =  \App\Models\Mentor::find($id);
            $data->sequence = $sequence;
            $data->save();
        endforeach;
        return back()->with(['success'=>'Sequence Updated!']);
    }
    public function bulkremove(Request $request){
        if(empty($request->check)){ return back()->with(['error'=>'Please choose at least one data']); }
        foreach($request->check as $id ):
            $data =  \App\Models\Mentor::find($id);
            $data->delete();
        endforeach;
        return back()->with(['success'=>'Data Removed!']);
    }
}
