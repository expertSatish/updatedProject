<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CallingProcessController extends Controller
{
    public function index(){
        $lists = \App\Models\CallingProcess::latest()->paginate(10);
        return view('admin.callingprocess.list',compact('lists'));
    }
    public function store(Request $request){
       $request->validate([
        'title' => 'required|max:255|string|unique:three_icons',
        'image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:2024',
       ]);
       if(!empty($request->image)){
            $extension =  $request->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/callingprocess/',$request->image);
            }else{
                $FileName = autoheight('uploads/callingprocess/',55,$request->image);
            }
        }
       $data = new \App\Models\CallingProcess();
       $data->title = $request->title;
       $data->description = $request->description ?? '';
       $data->image = $FileName;
       $data->is_publish = 1;
       $data->sequence = (\App\Models\CallingProcess::max('sequence') + 1);
       $data->save();
       return back()->with(['success'=>'Data Saved!']);
    }
    public function edit(Request $request){
        $lists = \App\Models\CallingProcess::find($request->id);
        return view('admin.callingprocess.edit',compact('lists'));
    }    
    public function update(Request $request){
        $request->validate([
            'title' => 'required|max:255|string|unique:three_icons,title,'.$request->id.',id'
        ]);
        if(!empty($r->image)){
            $extension =  $r->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/callingprocess/',$r->image);
            }else{
                $FileName = autoheight('uploads/callingprocess/',55,$r->image);
            }
        }
        $data = \App\Models\CallingProcess::find($request->id);
        $data->title = $request->title;
        $data->description = $request->description;
        if(!empty($r->image)){ $data->image = $FileName; }
        $data->save();
        return response()->json([
            'success'=>'Data Updated!'
        ]);
    }
    public function status(Request $request){
        $data =  \App\Models\CallingProcess::find($request->id);
        $data->is_publish = $request->status;
        $data->save();
    }
    public function destroy($id){
        $data =  \App\Models\CallingProcess::find($id)->delete();
        return back()->with(['success'=>'Data Removed!']);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence):
            $data =  \App\Models\CallingProcess::find($id);
            $data->sequence = $sequence;
            $data->save();
        endforeach;
        return back()->with(['success'=>'Sequence Updated!']);
    }
    public function bulkremove(Request $request){
        if(empty($request->check)){ return back()->with(['error'=>'Please choose at least one data']); }
        foreach($request->check as $id ):
            $data =  \App\Models\CallingProcess::find($id);
            $data->delete();
        endforeach;
        return back()->with(['success'=>'Data Removed!']);
    }
}
