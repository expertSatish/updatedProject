<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
    public function index(){
        $lists = \App\Models\HelpCenter::latest()->paginate(10);
        return view('admin.help.list',compact('lists'));
    }
    public function create(){
        return view('admin.help.add');
    }
    public function store(Request $request){
       $request->validate([
            'title' => 'required|max:255|string',
            'help_for' => 'required',
            'description' => 'required',
       ],[
            'title.required'=>'The title filed is required.',
            'help_for.required'=>'Help for is required.',
            'description.required'=>'The description filed is required.',
       ]);
       $data = new \App\Models\HelpCenter();
       $data->title = $request->title;
       $data->type = $request->help_for;
       $data->description = $request->description;
       $data->sequence = (\App\Models\HelpCenter::max('sequence') + 1);
       $data->save();
       return back()->with(['success'=>'Data Saved!']);
    }
    public function edit(Request $request){
        $lists = \App\Models\HelpCenter::find($request->id);
        return view('admin.help.edit',compact('lists'));
    }    
    public function update(Request $request){
        $request->validate([
            'title' => 'required|max:255|string',
            'help_for' => 'required',
            'description' => 'required',
       ],[
            'title.required'=>'The title filed is required.',
            'help_for.required'=>'Help for is required.',
            'description.required'=>'The description filed is required.',
       ]);
        $data = \App\Models\HelpCenter::find($request->id);
        $data->title = $request->title;
        $data->type = $request->help_for;
        $data->description = $request->description;       
        $data->save();
        return back()->with(['success'=>'Data Updated!']);
    }
    public function status(Request $request){
        $data =  \App\Models\HelpCenter::find($request->id);
        $data->is_publish = $request->status;
        $data->save();
    }
    public function destroy($id){
        $data =  \App\Models\HelpCenter::find($id)->delete();
        return back()->with(['success'=>'Data Removed!']);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence):
            $data =  \App\Models\HelpCenter::find($id);
            $data->sequence = $sequence;
            $data->save();
        endforeach;
        return back()->with(['success'=>'Sequence Updated!']);
    }
    public function bulkremove(Request $request){
        if(empty($request->check)){ return back()->with(['error'=>'Please choose at least one data']); }
        foreach($request->check as $id ):
            $data =  \App\Models\HelpCenter::find($id);
            $data->delete();
        endforeach;
        return back()->with(['success'=>'Data Removed!']);
    }


    ///// Query
    public function query(){
        $lists =  \App\Models\HelpQuery::latest()->paginate(100);
        return view('admin.help.query',compact('lists'));
    }
    public function querydestroy($id){
        $data =  \App\Models\HelpQuery::find($id)->delete();
        return back()->with(['success'=>'Data Removed!']);
    }
    public function querybulkremove(Request $request){
        if(empty($request->check)){ return back()->with(['error'=>'Please choose at least one data']); }
        foreach($request->check as $id ):
            $data =  \App\Models\HelpQuery::find($id);
            $data->delete();
        endforeach;
        return back()->with(['success'=>'Data Removed!']);
    }
}
